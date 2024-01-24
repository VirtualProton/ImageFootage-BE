<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\{
    User,
    ImageFootageWishlist,
    ImagefootageSharedWishlistsLog,
    Product,
};
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class WishListController extends Controller
{
   public $userModel, $imageFootageWishlist, $imageFootageSharedWishlistLogModel, $productModel;
   public function __construct(
        User $userModel,
        ImageFootageWishlist $imageFootageWishlist,
        ImagefootageSharedWishlistsLog $imageFootageSharedWishlistLogModel,
        Product $productModel
   ) {
        $this->userModel = $userModel;
        $this->imageFootageWishlistModel = $imageFootageWishlist;
        $this->imageFootageSharedWishlistLogModel = $imageFootageSharedWishlistLogModel;
        $this->productModel = $productModel;
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

    /**
     * Add selected products to the user's wishlist.
     *
     * @param  Request $request The HTTP request object containing user's input data.
     * @return JsonResponse A JSON response indicating the success or failure of the operation.
     */
    public function addProductToWishlist(Request $request) {
        $postData = $request->all();

        $customMessages = [
            'wishlist_id.required' => "Sorry, we couldn't access the shared wishlist details.",
            'wishlist_id.exists' => "Oops, the selected wishlist doesn't exist.",
            'Utype.required' => "Oops, it seems we can't identify the user.",
            'Utype.exists' => 'Oops, this user is no longer active in our system.',
            'products.required' => 'Please select at least one product to proceed.',
            'products.array' => 'There seems to be an issue with the selected products.',
            'products.*.product_id.exists' => 'Some of the selected products are not available.',
            'products.*.type.required' => 'Please specify the type of product.',
            'products.*.type.in' => 'Invalid product type selected.',
        ];

        $rules = [
            'wishlist_id' => 'required|exists:imagefootage_wishlists,id',
            'Utype' => 'required|exists:imagefootage_users,id',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:imagefootage_products,product_id',
            'products.*.type' => 'required|in:image,footage,music',
        ];

        $validator = Validator::make($postData, $rules, $customMessages);
        if (!$validator->fails()) {
            try {
                $userId = $postData['Utype'];
                $wishlistId = $postData['wishlist_id'];
                $products = $postData['products'];

                $productIds = Arr::pluck($products, 'product_id');

                // Getting products primary keys based on passed product_id
                $allProductPrimaryIds = $this->productModel
                    ->whereIn('product_id', $productIds)
                    ->pluck('id')->toArray();

                // Getting products which are already added to wishlist but passed in payload
                $productsAlreadyLinkedToWishlist = DB::table('imagefootage_wishlist_products')
                    ->where('wishlist_id', $wishlistId)
                    ->whereIn('product_id', $allProductPrimaryIds)
                    ->pluck('product_id')->toArray();

                // Filtering products_id of products which are not already added to wishlist
                $addToWishListProductIds = array_values(array_diff($allProductPrimaryIds, $productsAlreadyLinkedToWishlist));

                // Getting products based on products_id which are not already added to wishlist and need to add to wishlist
                $addToWishListProducts = $this->productModel->select('id', 'product_id')
                    ->whereIn('id', $addToWishListProductIds)
                    ->get()->toArray();

                $wishListProductRelationData = [];
                foreach ($addToWishListProducts as $product) {
                    // Filtering data for getting product type based on product_id
                    $filteredData = array_filter($products, function ($item) use($product) {
                        return $item['product_id'] === $product['product_id'];
                    });

                    $wishListProductRelation = [];
                    $wishListProductRelation['wishlist_id'] = $wishlistId;
                    $wishListProductRelation['product_id'] = $product['id'];
                    $wishListProductRelation['product_path_id'] = $product['product_id'];
                    $wishListProductRelation['type'] = $filteredData[0]['type'];
                    $wishListProductRelation['created_at'] = Carbon::now();
                    $wishListProductRelation['updated_at'] = Carbon::now();

                    // Preparing data for bulk inserting records
                    $wishListProductRelationData[] = $wishListProductRelation;
                }

                if (!empty($wishListProductRelation)) {
                    $newWishListProductRelation = DB::table('imagefootage_wishlist_products')
                        ->insert($wishListProductRelationData);

                    if (!empty($newWishListProductRelation)) {
                        $successMessage = "Congratulations! The product has been successfully added to your wishlist.";
                        if (!empty($productsAlreadyLinkedToWishlist)) {
                            $alreadyAddedCount = count($productsAlreadyLinkedToWishlist);
                            $successMessage = "Success! {$alreadyAddedCount} in wishlist, others added.";
                        }
                        return jsonResponse(false, $successMessage);
                    } else {
                        return jsonResponse(true, "Oops, Something went wrong!");
                    }
                } else {
                    $productCount = count($products);
                    if ($productCount == 1) {
                        $errorMessage = "Sorry, this product is already added to your wishlist.";
                    } else {
                        $errorMessage = "Sorry, these products are already added to your wishlist.";
                    }
                    return jsonResponse(true, $errorMessage);
                }
            } catch (\Exception $e) {
                return $e->getMessage();
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

    /**
     * Add selected products to the user's wishlist.
     *
     * @param  Request $request The HTTP request object containing user's input data.
     * @return JsonResponse A JSON response indicating the success or failure of the operation.
     */
    public function getUserWishlistData(Request $request) {
        $postData = $request->all();
        $userId = $postData['Utype'];               

        $results = DB::table('imagefootage_users_wishlist')
        ->join('imagefootage_wishlist_products', 'imagefootage_users_wishlist.wishlist_id', '=', 'imagefootage_wishlist_products.wishlist_id')
        ->join('imagefootage_products', 'imagefootage_wishlist_products.product_id', '=', 'imagefootage_products.id')
        ->where('imagefootage_users_wishlist.user_id', '=', $userId)
        ->select('imagefootage_wishlist_products.product_path_id','imagefootage_products.product_thumbnail')
        ->get();            
        return json_encode(["status"=>"success",'data'=>$results]);                
    }

    /**
     * Create or update a user's wishlist along with adding products if provided.
     *
     * @param  Request $request The HTTP request object containing user's input data.
     * @return JsonResponse A JSON response indicating the success or failure of the operation.
     */
    public function createOrUpdateWishlist(Request $request) {
        $postData = $request->all();

        $customMessages = [
            'wishlist_id.required' => "Sorry, we couldn't access the shared wishlist details.",
            'wishlist_id.exists' => "Oops, the selected wishlist doesn't exist.",
            'Utype.required' => "Oops, it seems we can't identify the user.",
            'Utype.exists' => 'Oops, this user is no longer active in our system.',
            'wishlist_name.required' => 'The wishlist name is required.',
            'wishlist_name.string' => 'The wishlist name must be a string.',
            'wishlist_name.min' => 'The wishlist name must be at least :min characters.',
            'products.required' => 'Please select at least one product to proceed.',
            'products.array' => 'There seems to be an issue with the selected products.',
            'products.*.product_id.required' => 'Product ID is required.',
            'products.*.product_id.exists' => 'Some of the selected products are not available.',
            'products.*.type.required' => 'Please specify the type of product.',
            'products.*.type.in' => 'Invalid product type selected.',
        ];

        $rules = [
            'Utype' => 'required|exists:imagefootage_users,id',
            'wishlist_name' => 'required|string|min:3'
        ];

        if (!empty($postData['wishlist_id'])) {
            $rules['wishlist_id'] = 'required|exists:imagefootage_wishlists,id';
        } else {
            if (isset($rules['products'])) {
                $rules['products'] = 'required|array|min:1';
                $rules['products.*.product_id'] = 'required|exists:imagefootage_products,product_id';
                $rules['products.*.type'] = 'required|in:type,image';
            }
        }

        $validator = Validator::make($postData, $rules, $customMessages);
        if (!$validator->fails()) {

            $userId = $postData['Utype'];
            // Update Wishlist
            if (!empty($postData['wishlist_id'])) {
                $wishlistId = $postData['wishlist_id'];
                $wishlistName = $postData['wishlist_name'];

                $updateWishlistNameStatus = $this->imageFootageWishlistModel
                    ->where('id', $wishlistId)
                    ->update(['name' => $wishlistName]);

                if (!empty($updateWishlistNameStatus)) {
                    return jsonResponse(false, "Your wishlist name has been successfully updated.");
                } else {
                    return jsonResponse(true, "Oops! Your wishlist name couldn't be updated. Please try again later.");
                }

            } else { // Create User Wishlist
                $wishlistName = $postData['wishlist_name'];

                // Creating new Wishlist
                $wishlistData = [];
                $wishlistData['name'] = $wishlistName;
                $newWishlist = $this->imageFootageWishlistModel->create($wishlistData);

                if (!empty($newWishlist->id)) {
                    $userWishlistData = [
                        'user_id' => $userId,
                        'wishlist_id' => $newWishlist->id,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];

                    // Assigning new created wishlist to user account
                    $newUserWishlist = DB::table('imagefootage_users_wishlist')->insert($userWishlistData);
                    if (!empty($newUserWishlist)) {

                        // Create wishlist and also add products
                        if (!empty($postData['products'])) {
                            $products = $postData['products'];
                            $productIds = Arr::pluck($products, 'product_id');

                            // Getting products primary keys based on passed product_id
                            $allProductPrimaryIds = $this->productModel
                                ->select('id', 'product_id')
                                ->whereIn('product_id', $productIds)
                                ->get()->toArray();

                            $wishListProductRelationData = [];
                            foreach ($allProductPrimaryIds as $product) {
                                // Filtering data for getting product type based on product_id
                                $filteredData = array_filter($products, function ($item) use($product) {
                                    return $item['product_id'] === $product['product_id'];
                                });

                                $wishListProductRelation = [];
                                $wishListProductRelation['wishlist_id'] = $newWishlist->id;
                                $wishListProductRelation['product_id'] = $product['id'];
                                $wishListProductRelation['type'] = $filteredData[0]['type'];
                                $wishListProductRelation['created_at'] = Carbon::now();
                                $wishListProductRelation['updated_at'] = Carbon::now();

                                // Preparing data for bulk inserting records
                                $wishListProductRelationData[] = $wishListProductRelation;
                            }

                            $newWishListProductRelation = DB::table('imagefootage_wishlist_products')
                                ->insert($wishListProductRelationData);

                            if (!empty($newWishListProductRelation)) {
                                $successMessage = "Congratulations! Wishlist created and product added successfully!";
                                return jsonResponse(false, $successMessage);
                            } else {
                                return jsonResponse(true, "Oops! Something went wrong while adding the product to your wishlist. Please try again.");
                            }
                        } else { // Only Create Wishlist
                            return jsonResponse(false, "Congratulations! Your wishlist collection has been created successfully!");
                        }
                    }
                }
                return jsonResponse(true, "Wishlist collection couldn't be created. Please try again later.");
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

    /**
     * Remove selected products from a user's wishlist.
     *
     * @param  Request $request The HTTP request object containing user's input data.
     * @return JsonResponse A JSON response indicating the success or failure of the operation.
     */
    public function removeProductFromWishlist(Request $request) {
        $postData = $request->all();

        $customMessages = [
            'wishlist_id.required' => "Sorry, we couldn't access the shared wishlist details.",
            'wishlist_id.exists' => "Oops, the selected wishlist doesn't exist.",
            'Utype.required' => "Oops, it seems we can't identify the user.",
            'Utype.exists' => 'Oops, this user is no longer active in our system.',
            'product_id.required' => 'Please select at least one product to proceed.',
            'product_id.array' => 'There seems to be an issue with the selected products.',
            'product_id.*.exists' => 'Some of the selected products are not available.',
        ];

        $rules = [
            'wishlist_id' => 'required|exists:imagefootage_wishlists,id',
            'Utype' => 'required|exists:imagefootage_users,id',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'exists:imagefootage_products,product_id',
        ];

        $validator = Validator::make($postData, $rules, $customMessages);
        if (!$validator->fails()) {
            $userId = $postData['Utype'];
            $wishlistId = $postData['wishlist_id'];
            $productIds = $postData['product_id'];

            // Get Primary Ids of products for deleting from wishlist
            $allProductPrimaryIds = $this->productModel
                ->whereIn('product_id', $productIds)
                ->pluck('id')->toArray();

            DB::table('imagefootage_wishlist_products')
                ->where('wishlist_id', $wishlistId)
                ->whereIn('product_id', $allProductPrimaryIds)
                ->delete();

            $successMessage = "Product Removed from wishlist";
            return jsonResponse(false, $successMessage);
        } else {
            if (!empty($validator->errors()->first())) {
                $errorMessage = $validator->errors()->first();
            } else {
                $errorMessage = "Something is wrong";
            }
            return jsonResponse(true, $errorMessage);
        }
    }

    public function deleteWishlist(Request $request) {   

        $collectionData = $request->all();
        if(!empty($collectionData)){
            if($collectionData['id']){

                DB::table('imagefootage_shared_wishlists_logs')
                ->where('new_wishlist_id', $collectionData['id'])
                ->delete();

                DB::table('imagefootage_wishlists')
                ->where('id', $collectionData['id'])
                ->delete();
            } 
            foreach($collectionData['products'] as $product){
                $allSelectedValues[] = $product['id'];
            }

            if(isset($allSelectedValues) && !empty($allSelectedValues)){
                DB::table('imagefootage_wishlist_products')
                ->whereIn('product_id', $allSelectedValues)
                ->delete();
            }

            return response()->json([ 
                'status' => "success",            
                'message' => "Collection Removed Succesfully.",
            ]);
        }else{
            return response()->json([ 
                'status' => "failed" ,               
                'message' => "Collection not found.",
            ]);
        }
    }

    public function getWishlistData(Request $request) {        
        

        $title = $request->input('title');
        $productId = $request->input('product_id');
        $url = $request->input('url');        

        $query = Product::query();

        if (!empty($productId)) {
            $query->where('product_id', $productId);
        } else {
            $query->where(function ($query) use ($title, $url) {
                $query->where('product_title', $title);
                $query->where('product_thumbnail', $url);
            });
        }

        $product = $query->first();
        

        if (!empty($product)) {   
            echo json_encode(["status"=>"success",'data'=>$product]);
        } else {           
            echo json_encode(["status"=>"failed",'data'=>null]);
        }
    }
}