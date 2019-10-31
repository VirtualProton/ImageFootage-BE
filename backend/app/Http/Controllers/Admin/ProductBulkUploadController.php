<?php
namespace App\Http\Controllers\Admin;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\MultipartUploader;
use Aws\Exception\MultipartUploadException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Image;
use File;
use Mail;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\Contributor;
use App\Models\ProductImages;
use App\Models\ProductColors;
use App\Models\ProductGenders;
use App\Models\ProductImageTypes;
use App\Models\ProductImageSizes;
use App\Models\ProductAgeWises;
use App\Models\ProductEthinicities;
use App\Models\ProductLocations;
use App\Models\ProductFilters;
use App\Models\ProductPeoples;
use App\Models\ImageResolution;
use App\Models\ProductOrientations;
use App\Models\ImageSortTypes;

class ProductBulkUploadController extends Controller
{
   public function uploadCSV(){
	   return view('admin.product.uploadproductscsv');
   }
}
