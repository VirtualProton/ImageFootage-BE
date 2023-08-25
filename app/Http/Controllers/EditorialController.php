<?php

namespace App\Http\Controllers;

use App\Models\Editorial;

use Illuminate\Http\Request;

class EditorialController extends Controller
{
    public function editorialListv2()
    {
        $editoriallist = [];
        //$editoriallist = Editorial::get()->toArray();

        // Sample Response     

        $editoriallist = [
            [
                "id" => 1,
                "title" => "Test 1",
                "type" => "story",
                "search_term" => "Christmas eve",
                "selected_values" => "https://mh-1-rest.panthermedia.net/media/previews/0027000000/27498000/27498651_preview.jpg,https://mh-2-rest.panthermedia.net/media/previews/0027000000/27498000/27498649_preview.jpg,https://mh-1-rest.panthermedia.net/media/previews/0019000000/19177000/19177077_preview.jpg",
                "main_image_id" => "IMGFT190",
                "main_image_selected_values" => "https://mh-2-rest.panthermedia.net/media/previews/0027000000/27498000/27498649_preview.jpg,https://mh-1-rest.panthermedia.net/media/previews/0027000000/27498000/27498651_preview.jpg",
                "main_image_upload" => null,
                "status" => 1,
                "created_at" => "2023-08-24 08:43:12",
                "updated_at" => "2023-08-24 08:43:12",
            ],
            [
                "id" => 2,
                "title" => "Test 2",
                "type" => "story",
                "search_term" => "Christmas eve",
                "selected_values" => "https://mh-1-rest.panthermedia.net/media/previews/0027000000/27498000/27498651_preview.jpg,https://mh-2-rest.panthermedia.net/media/previews/0027000000/27498000/27498649_preview.jpg,https://mh-1-rest.panthermedia.net/media/previews/0019000000/19177000/19177077_preview.jpg",
                "main_image_id" => "IMGFT190",
                "main_image_selected_values" => "https://mh-2-rest.panthermedia.net/media/previews/0027000000/27498000/27498649_preview.jpg,https://mh-1-rest.panthermedia.net/media/previews/0027000000/27498000/27498651_preview.jpg",
                "main_image_upload" => null,
                "status" => 0,
                "created_at" => "2023-08-24 08:43:12",
                "updated_at" => "2023-08-24 08:43:12",
            ],
            [
                "id" => 3,
                "title" => "Test 3",
                "type" => "collection",
                "search_term" => "Christmas eve",
                "selected_values" => "https://mh-1-rest.panthermedia.net/media/previews/0027000000/27498000/27498651_preview.jpg,https://mh-2-rest.panthermedia.net/media/previews/0027000000/27498000/27498649_preview.jpg,https://mh-1-rest.panthermedia.net/media/previews/0019000000/19177000/19177077_preview.jpg",
                "main_image_id" => "IMGFT190",
                "main_image_selected_values" => null,
                "main_image_upload" => "https://mh-2-rest.panthermedia.net/media/previews/0027000000/27498000/27498649_preview.jpg,https://mh-1-rest.panthermedia.net/media/previews/0027000000/27498000/27498651_preview.jpg",
                "status" => 1,
                "created_at" => "2023-08-24 08:43:12",
                "updated_at" => "2023-08-24 08:43:12",
            ],
        ];
        echo json_encode(["status" => "success", 'data' => $editoriallist]);
    }
}
