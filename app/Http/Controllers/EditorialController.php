<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use App\Models\Product;

use Illuminate\Http\Request;

class EditorialController extends Controller
{
    public function editorialListv2()
    {
        $editoriallist = Editorial::where('status', 1)
            ->where('type','collection')
            ->get();  

        $selectedValues = [];
        // Retrive all occured products Ids
        foreach ($editoriallist as $editorial) {
            $editorialValue = json_decode($editorial['selected_values'], true);

            if (is_array($editorialValue)) {
                $selectedValues = array_merge($selectedValues, $editorialValue);
            }
        }

        // Retrive URLs based on Ids
        $products = Product::select('product_id', 'product_main_image')->whereIn('product_id', $selectedValues)->get();

        $productUrlMap = [];
        foreach ($products as $product) {
            $productUrlMap[$product->product_id] = $product->product_main_image;
        }

        foreach ($editoriallist as $editorial) {
            $editorialValue = json_decode($editorial['selected_values'], true);
            if (is_array($editorialValue)) {
                $updatedEditorialValue = [];
                foreach ($editorialValue as $productId) {
                    if (isset($productUrlMap[$productId])) {
                        $updatedEditorialValue[] = $productUrlMap[$productId];
                    }
                }
                $editorial['selected_values'] = implode(',', $updatedEditorialValue);
                $editorial['selected_values_count'] = count($updatedEditorialValue);
            }
            if (!empty($editorial['main_image_upload'])) {
                $editorial['main_image_upload'] = asset('uploads/editorialmainimage/' . $editorial['main_image_upload']);
            }
        }
        echo json_encode(["status" => "success", 'data' => $editoriallist]);
    }

    public function editorialDetailv2($id)
    {
        $editoriallist = Editorial::find($id);

        if (!$editoriallist) {
            echo response()->json(['message' => 'Editorial not found'], 404);
        } else {
            $editorial = [];
            $editorialValue = json_decode($editoriallist['selected_values']);
            $products_urls = Product::whereIn('product_id', $editorialValue)
                ->pluck('product_main_image')
                ->toArray();
            $editoriallist->selected_values_count = count($products_urls);
            $editoriallist->selected_values = implode(',', $products_urls);

            $editorial =
                [
                    "id"                         => $editoriallist->id,
                    "title"                      => $editoriallist->title,
                    "type"                       => $editoriallist->type,
                    "search_term"                => $editoriallist->search_term,
                    "selected_values"            => $editoriallist->selected_values,
                    "main_image_selected_values" => $editoriallist->main_image_selected_values,
                    "main_image_upload"          => $editoriallist->main_image_upload,
                    "status"                     => $editoriallist->status,
                    "created_at"                 => $editoriallist->created_at,
                    "updated_at"                 => $editoriallist->updated_at,
                ];


            echo json_encode(["status" => "success", 'data' => $editorial]);
        }
    }
}
