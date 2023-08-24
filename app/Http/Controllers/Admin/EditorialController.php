<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Editorial;

class EditorialController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('login', 'logout');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editorial = new Editorial();
        $editoriallist = $editorial->getEditorialData();
        return view('admin.editorial.index', compact('editoriallist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Add Editorial";
        return view('admin.editorial.create', compact('title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editorial = Editorial::find($id);
        $selected_values = [];
        if (!empty($editorial['selected_values'])) {
            $editorial_selected_values = json_decode($editorial['selected_values']);
            $editorial_selected_values = array($editorial_selected_values);
            $images = Product::whereIn('product_id', $editorial_selected_values[0])->pluck('product_main_image');
            $selected_values = $images->toArray();
        }
        $main_images_selected_values = explode(',', $editorial['main_image_selected_values']);
        return view('admin.editorial.edit', compact('editorial', 'selected_values', 'main_images_selected_values'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'title' => 'required|max:100',
            'search' => 'required|max:50',
            'type' => 'required',
            'status' => 'required',
            'selectedMainImages' => 'required_without_all:main_image_upload',
            'main_image_upload' => 'required_without_all:selectedMainImages|file|mimes:jpeg,png'
        ]);

        // Custom validation for selectedImages
        $request->validate([
            'selectedImages' => 'required|array|min:1',
        ], [
            'selectedImages.required' => 'Please select at least one image from search result.',
        ]);

        // Create a new Editorial instance and fill it with the validated data
        $editorial = new Editorial();
        $editorial->title = $request->input('title');
        $editorial->type = $request->input('type');

        // Selected Images
        $editorial->search_term = $request->input('search');
        $selectedImages = $request->input('selectedImages', []);
        $images = $editorial->getImageIdsFromUrls($selectedImages);
        $editorial->selected_values = json_encode($images);

        // Selected Main Images
        $editorial->main_image_id = $request->input('main_image_id');
        $selectedMainImages = $request->input('selectedMainImages', []);
        $commaSeparatedMainImages = implode(
            ',',
            $selectedMainImages
        );
        $editorial->main_image_selected_values = $commaSeparatedMainImages;
        $editorial->main_image_upload = $request->hasFile('main_image_upload');
        $editorial->status = $request->input('status');

        if ($editorial->save()) {
            return redirect("admin/editorials")->with("success", "Editorial has been created successfully!");
        } else {
            return redirect("admin/editorials/create")->with("error", "Due to some error, editorial is not registered yet. Please try again!");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $this->validate($request, [
            'title' => 'required|max:100',
            'search' => 'required|max:50',
            'type' => 'required',
            'status' => 'required',
            'selectedMainImages' => 'required_without_all:main_image_upload',
            'main_image_upload' => 'required_without_all:selectedMainImages|file|mimes:jpeg,png'
        ]);

        // Custom validation for selectedImages
        $request->validate([
            'selectedImages' => 'required|array|min:1',
        ], [
            'selectedImages.required' => 'Please select at least one image from search result.',
        ]);

        $editorial = Editorial::find($id);
        $editorial->title = $request->input('title');
        $editorial->type = $request->input('type');

        // Selected Images
        $editorial->search_term = $request->input('search');
        $selectedImages = $request->input('selectedImages', []);
        $images = $editorial->getImageIdsFromUrls($selectedImages);
        $editorial->selected_values = json_encode($images);

        // Selected Main Images
        $editorial->main_image_id = $request->input('main_image_id');
        $selectedMainImages = $request->input('selectedMainImages', []);
        $commaSeparatedMainImages = implode(
            ',',
            $selectedMainImages
        );
        $editorial->main_image_selected_values = $commaSeparatedMainImages;
        $editorial->main_image_upload = $request->hasFile('main_image_upload');
        $editorial->status = $request->input('status');

        if ($editorial->save()) {
            return redirect("admin/editorials")->with("success", "Promo code has been updated successfully !");
        } else {
            return redirect("admin/editorials/$id/edit")->with("error", "Due to some error, Promo code is not updated yet. Please try again!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $editorial = Editorial::find($id);
        $editorial->delete();
        return redirect('admin/editorials')->with('success', 'Successfully deleted the admin/agent!');
    }

    public function getEditorialImages(Request $request)
    {
        $searchTerm = $request->input('search');

        //Query the product table based on the given data        
        $product = Product::whereRaw("FIND_IN_SET(?, product_keywords)", [$searchTerm])
            ->get();

        if ($product->isEmpty()) {
            return response()->json(['isValid' => false, 'data' => []]);
        } else {
            return response()->json(['isValid' => true, 'data' => $product]);
        }
    }

    public function getMainImages(Request $request)
    {
        $mainImageId = $request->input('main_image_id');

        //Query the product table based on the given data        
        $product = Product::where('product_id', $mainImageId)->get();

        if ($product->isEmpty()) {
            return response()->json(['isValid' => false, 'data' => []]);
        } else {
            return response()->json(['isValid' => true, 'data' => $product]);
        }
    }

    public function changeStatus($status, $id)
    {
        $result = Editorial::where('id', $id)->update(array('status' => $status));
        if ($result) {
            return back()->with('success', 'Editorial status changed successfully.');
        } else {
            return back()->with('warning', 'Some problem occured.');
        }
    }
}
