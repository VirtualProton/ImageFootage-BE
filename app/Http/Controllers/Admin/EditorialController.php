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
        $this->Editorial = new Editorial();
        $editoriallist = $this->Editorial->getEditorialData();
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

    public function store(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'type' => 'required',
            'status' => 'required',
        ]);

        // Custom validation for selectedImages
        $request->validate([
            'selectedImages' => 'required|array|min:1',
        ], [
            'selectedImages.required' => 'Please select at least one image.',
        ]);

        $dataToPass = json_decode($request->input('data_to_pass'), true);

        // Access individual values from the decoded array
        $title = isset($dataToPass['title']) ? $dataToPass['title'] : null;
        $search = isset($dataToPass['search']) ? $dataToPass['search'] : null;
        $mainImageId = isset($dataToPass['main_image_id']) ? $dataToPass['main_image_id'] : null;

        // Create a new Editorial instance and fill it with the validated data
        $editorial = new Editorial();
        $editorial->title = $title;
        $editorial->search_term = $search;
        $editorial->type = $request->input('type');
        $editorial->main_image_id = $mainImageId;

        $selectedImages = $request->input('selectedImages', []);
        $commaSeparatedImages = implode(',', $selectedImages);
        $editorial->selected_values = $commaSeparatedImages;
        $editorial->status = $request->input('status');

        if ($editorial->save()) {
            return redirect("admin/editorial/create")->with("success", "Editorial has been created successfully !!!");
        } else {
            return redirect("admin/editorial/create")->with("error", "Due to some error, editorial is not registered yet. Please try again!");
        }
        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Editorial added successfully.');
    }

    public function getEditorialImages(Request $request)
    {
        $title = $request->input('title');
        $searchTerm = $request->input('search');
        $mainImageId = $request->input('main_image_id');

        // Query the product table based on the given data
        $product = Product::where(function ($query) use ($title, $searchTerm, $mainImageId) {
            if ($title) {
                $query->Where('product_title', $title);
            }
            if ($mainImageId) {
                $query->Where('product_id', $mainImageId);
            }
            if ($searchTerm) {
                $query->WhereRaw("FIND_IN_SET('$searchTerm', product_keywords) > 0");
            }
        })->get();

        if ($product->isEmpty()) {
            return response()->json(['isValid' => false, 'data' => []]);
        } else {
            return response()->json(['isValid' => true, 'data' => $product]);
        }
    }
}
