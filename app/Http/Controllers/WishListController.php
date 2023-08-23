<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\{
    User,
    ImageFootageWishlist,
    ImagefootageSharedWishlistsLog
};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class WishListController extends Controller
{
   public $userModel, $imageFootageWishlist, $imageFootageSharedWishlistLogModel;
   public function __construct(
        User $userModel,
        ImageFootageWishlist $imageFootageWishlist,
        ImagefootageSharedWishlistsLog $imageFootageSharedWishlistLogModel
   ) {
        $this->userModel = $userModel;
        $this->imageFootageWishlistModel = $imageFootageWishlist;
        $this->imageFootageSharedWishlistLogModel = $imageFootageSharedWishlistLogModel;
   }

   public function getWishList(Request $request)
    {
    	dd($request);
        /*try {
            $products = Keywords::where(function($query) use ($keyword) {
                // Filter the keywords when pass keywords as param
                $keyword = trim($keyword);
                if($keyword != "") {
                    $query->where("name", "like", "%$keyword%");
                } 
            })->get()->toArray();
            return response()->json(["status"=> true, "data"=> $products]);
        } catch (\Throwable $th) {
            return response()->json(["status"=> false, "message"=> "Cannot get keywords"]);
        }*/
    }

    # Create Share Wish list Link
    public function shareWishListCreateLink(Request $request)
    {
        $encryptedId = Crypt::encryptString($request->wishlist_id);
        return response()->json(["success" => true, "message" => "WishList link generated successfully.", "data" => $encryptedId], 200);
    }

    /**
     * Accept wish list link and add it to the user's account.
     *
     * This function handles the acceptance of a shared wish list link and associates it with the user's account.
     *
     * Request Parameters:
     *   - wishlist_id (required): The original wishlist id shared by another user ($sharingWishList).
     *   - Utype (required): The user's identity, represented by their user ID ($user).
     *
     * For Developer Guidance:
     *   - shared_by_user_id: User ID of the person who shared the wishlist ($sharingWishListUser).
     *   - shared_with_user_id: User ID of the recipient with whom the wishlist is being shared ($user).
     *   - shared_wishlist_id: Original wishlist id that is being shared ($sharingWishList).
     *   - new_wishlist_id: ID of the newly created wishlist after acceptance ($newWishlist).
     *
     * @param  Request  $request  The HTTP request object containing data.
     * @return \Illuminate\Http\JsonResponse  The JSON response indicating the result of the operation.
     */
    public function acceptWishlistFolder(Request $request) {
        $customMessages = [
            'wishlist_id.required' => "Oops, Can't access shared wishlist details.",
            'Utype.required' => "Oops, Can't access user identity.",
            'Utype.exists' => 'Oops, this user has been deleted from the system.',
        ];

        $validator = Validator::make($request->all(), [
            'wishlist_id' => 'required|string',
            'Utype' => 'required|exists:imagefootage_users,id',
        ], $customMessages);

        if (!$validator->fails()) {
            try {
                $userId = $request->Utype; // Current User Id
                $user = $this->userModel->find($userId); // Current User
                $wishlistId = Crypt::decryptString($request->wishlist_id); // Sharing Wishlist Id
                $sharingWishList = $this->imageFootageWishlistModel->find($wishlistId); // Sharing Wishlist

                if (!empty($sharingWishList)) {
                    $sharingWishListUser = $sharingWishList->user->first();
                    if ($user->id != $sharingWishListUser->id) {
                        $sharedWishListLogs = $this->imageFootageSharedWishlistLogModel
                            ->where('shared_by_user_id', $sharingWishListUser->id)
                            ->where('shared_with_user_id', $user->id)
                            ->where('shared_wishlist_id', $sharingWishList->id)
                            ->orderBy('id', 'desc')
                            ->first();

                        // If already Wishlist has not been shared
                        if (empty($sharedWishListLogs)) {
                            $userSharingWishlistProducts = $sharingWishList->products;
                            if (!empty($userSharingWishlistProducts)) {
                                $wishlistData = [];
                                $wishlistData['name'] = $sharingWishList->name;
                                $newWishlist = $this->imageFootageWishlistModel->create($wishlistData);
                                if (!empty($newWishlist->id)) {
                                    $userWishlistData = [
                                        'user_id' => $user->id,
                                        'wishlist_id' => $newWishlist->id,
                                        'created_at' => Carbon::now(),
                                        'updated_at' => Carbon::now(),
                                    ];

                                    $newUserWishlist = DB::table('imagefootage_users_wishlist')->insert($userWishlistData);
                                    if (!empty($newUserWishlist)) {
                                        $wishListProductRelationData = [];
                                        foreach ($userSharingWishlistProducts as $product) {
                                            $wishListProductRelation = [];
                                            $wishListProductRelation['wishlist_id'] = $newWishlist->id;
                                            $wishListProductRelation['product_id'] = $product->id;
                                            $wishListProductRelation['type'] = $product->pivot->type;
                                            $wishListProductRelation['created_at'] = Carbon::now();
                                            $wishListProductRelation['updated_at'] = Carbon::now();

                                            $wishListProductRelationData[] = $wishListProductRelation;
                                        }
                                        $newWishListProductRelation = DB::table('imagefootage_wishlist_products')->insert($wishListProductRelationData);

                                        // All Shared product ids of wishlist
                                        $sharedProductsIds = $userSharingWishlistProducts->pluck('id')->toArray();

                                        $imageFootageSharedWishlistLogData = [];
                                        $imageFootageSharedWishlistLogData['shared_by_user_id'] = $sharingWishListUser->id;
                                        $imageFootageSharedWishlistLogData['shared_wishlist_id'] = $sharingWishList->id;
                                        $imageFootageSharedWishlistLogData['shared_with_user_id'] = $user->id;
                                        $imageFootageSharedWishlistLogData['new_wishlist_id'] = $newWishlist->id;
                                        $imageFootageSharedWishlistLogData['shared_product_ids'] = $sharedProductsIds;

                                        $this->imageFootageSharedWishlistLogModel->create($imageFootageSharedWishlistLogData);
                                        if (!empty($newWishListProductRelation)) {
                                            return jsonResponse(false, "Wishlist successfully added.");
                                        } else {
                                            return jsonResponse(true, "Wishlist couldn't be added. Please try again later.");
                                        }
                                    }
                                    return jsonResponse(true, "Wishlist couldn't be added. Please try again later.");
                                }
                                return jsonResponse(true, "Wishlist couldn't be added. Please try again later.");
                            } else {
                                return jsonResponse(true, "The shared wishlist is empty and doesn't contain any products.");
                            }
                        } else { // If Already Shared Wishlist then Just Update newly added products into shared wishlist by reference of `new_wishlist_id`

                            // At Sharing time wishlist products ids/ Previously stored wishlist products at sharing time
                            $atSharingTimeWishlistProductIds = $sharedWishListLogs->shared_product_ids;

                            // At Current state sharing wishlist's product ids
                            $atCurrentStateWishlistProductIds = $sharedWishListLogs->sharedWishlist->products->pluck('id')->toArray();

                            // Products which were added into the original wishlist by the user who has previously shared this wishlist
                            // Newly Added products will be synced to the current user's newly created wishlist ($newWishlist)
                            $newProductIdsWillBeSyncedToNewWishList = array_diff($atCurrentStateWishlistProductIds, $atSharingTimeWishlistProductIds);

                            if (!empty($newProductIdsWillBeSyncedToNewWishList)) {
                                // Converting to numeric array
                                $newProductIdsWillBeSyncedToNewWishList = array_values($newProductIdsWillBeSyncedToNewWishList);
                                $newProductsWillBeSyncedToCurrentUserWishlist = $sharedWishListLogs->sharedWishlist->products->whereIn('id', $newProductIdsWillBeSyncedToNewWishList);

                                $wishListProductRelationData = [];
                                foreach ($newProductsWillBeSyncedToCurrentUserWishlist as $product) {
                                    $wishListProductRelation = [];
                                    $wishListProductRelation['wishlist_id'] = $sharedWishListLogs->new_wishlist_id;
                                    $wishListProductRelation['product_id'] = $product->id;
                                    $wishListProductRelation['type'] = $product->pivot->type;
                                    $wishListProductRelation['created_at'] = Carbon::now();
                                    $wishListProductRelation['updated_at'] = Carbon::now();

                                    $wishListProductRelationData[] = $wishListProductRelation;
                                }
                                $newWishListProductSyncedRelation = DB::table('imagefootage_wishlist_products')->insert($wishListProductRelationData);

                                if (!empty($newWishListProductSyncedRelation)) {
                                    $sharedWishListLogs->shared_product_ids = $atCurrentStateWishlistProductIds; // Updating Shared Wishlist Log
                                    $sharedWishListLogs->save();

                                    return jsonResponse(false, "Wishlist Updated");
                                } else {
                                    return jsonResponse(true, "Oops, Wishlist Couldn't be Updated!");
                                }
                            } else {
                                return jsonResponse(true, "This wishlist is already in your account, and no new products have been added.");
                            }
                        }
                    } else {
                        return jsonResponse(true, "You can't share a wishlist with yourself.");
                    }
                } else {
                    return jsonResponse(true, "Shared wishlist has been deleted");
                }
            } catch (\Exception $e) {
                return jsonResponse(true, "Oops, Something went wrong!");
            }
        } else {
            if (!empty($validator->errors()->first())) {
                $errorMessage = $validator->errors()->first();
            } else {
                $errorMessage = "Something is wrong";
            }
            return jsonResponse(true, $errorMessage);
        }
    }
}