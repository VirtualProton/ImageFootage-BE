<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\LicenceType;
use Illuminate\Validation\Rule;
/**
 * 
 * Price Controller
 */
class PriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * 
     * List Prices
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = Price::with('licenceType')->get();
        return view('admin.price.index', compact('prices'));
    }

    /**
     * 
     * Show Create Price Form
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Price";
        $licenceTypes = LicenceType::all();
        return view('admin.price.create', compact('title', 'licenceTypes'));
    }

    /**
     * 
     * Store Price
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'license_type' => [
                'required',
                Rule::unique('imagefootage_prices')->where(function ($query) use ($request) {
                    return $query->where('product_type', $request->product_type)
                        ->where('license_type', $request->license_type);
                })
            ],
            'product_type' => 'required|in:image,footage,music',
        ], [
            'license_type.unique' => 'A price already exists for this license type and product type combination.'
        ]);

        $price = Price::create($request->only([
            'license_type',
            'product_type',
            'small_image_price',
            'medium_image_price',
            'large_image_price',
            'extra_large_image_price',
            'music_price',
            'high_resolution_footage_price',
            '4k_footage_price'
        ]));

        if ($price) {
            return redirect("admin/price")->with("success", "Price created successfully!");
        } else {
            return redirect("admin/price/create")->with("error", "Error creating price!");
        }
    }

    /**
     * 
     * Edit Price
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Edit Price";
        $price = Price::findOrFail($id);
        $licenceTypes = LicenceType::all();
        return view('admin.price.edit', compact('title', 'price', 'licenceTypes'));
    }

    /**
     * 
     * Update Price
     * 
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'license_type' => [
                'required',
                Rule::unique('imagefootage_prices')->where(function ($query) use ($request) {
                    return $query->where('product_type', $request->product_type)
                        ->where('license_type', $request->license_type);
                })->ignore($id)
            ],
            'product_type' => 'required|in:image,footage,music',
        ], [
            'license_type.unique' => 'A price already exists for this license type and product type combination.'
        ]);

        $price = Price::findOrFail($id);
        $price->update($request->only([
            'license_type',
            'product_type',
            'small_image_price',
            'medium_image_price',
            'large_image_price',
            'extra_large_image_price',
            'music_price',
            'high_resolution_footage_price',
            '4k_footage_price'
        ]));

        return redirect("admin/price")->with("success", "Price updated successfully!");
    }

    /**
     * 
     * Delete Price
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        $price->delete();

        return redirect('admin/price')->with('success', 'Price deleted successfully!');
    }

    /**
     * 
     * Check if combination already exists (AJAX)
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function checkDuplicate(Request $request)
    {
        $query = Price::where('product_type', $request->product_type)
            ->where('license_type', $request->license_type);

        // Exclude current record when editing
        if ($request->has('exclude_id') && $request->exclude_id) {
            $query->where('id', '!=', $request->exclude_id);
        }

        $exists = $query->exists();

        return response()->json(['exists' => $exists]);
    }
}
