@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
    <section class="content">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Editorial</h3><a href="{{ URL::to('admin/editorials') }}" class="btn pull-right">Back</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('url' => URL::to('admin/editorials/'.$editorial['id']), 'method' => 'PUT', 'class'=>"form-horizontal",'id'=>'editorialform','files'=> true,'autocomplete'=>false,'enctype' => 'multipart/form-data')) !!}
            @include('admin.partials.message')

            <div class="box-body">
                <input type="hidden" name="data_to_pass" id="data_to_pass" value="">

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $editorial['title'] ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group" id="typeButton">
                    <label for="inputPassword3" class="col-sm-2 control-label">Type</label>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="form-control" name="type" id="type">
                                <option value="">Select</option>
                                <option value="story" @if ($editorial['type']=="story" ) {{ 'selected' }} @endif>Story</option>
                                <option value="collection" @if ($editorial['type']=="collection" ) {{ 'selected' }} @endif>Collection</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Search Term</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" id="search" placeholder="Search Term" value="<?php echo $editorial['search_term'] ?>">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success" onclick="findImages()" id="search_term">Search</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div id="imagesContainer">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Main Image ID</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" name="main_image_id" id="main_image_id" placeholder="Main Image ID" value="<?php echo $editorial['main_image_id'] ?>">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success" onclick="getMainImage()" id="search_main_image">Search</button>
                                </span>
                            </div>
                            <small class="text-muted">Image dimensions must be 415x315.</small>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div id="mainImagesContainer">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label"></label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <b>OR</b>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Main Image Upload</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="file" class="form-control" name="main_image_upload" id="main_image_upload">
                            <small class="text-muted">Image dimensions must be 415x315</small>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="statusButton">
                    <label for="inputPassword3" class="col-sm-2 control-label">Staus</label>
                    <div class="col-sm-4">
                        <div class="form-group">

                            <select class="form-control" name="status" id="status">
                                <option value="">Select</option>
                                <option value="1" @if ($editorial['status']=="1" ) {{ 'selected' }} @endif>Active</option>
                                <option value="0" @if ($editorial['status']=="0" ) {{ 'selected' }} @endif>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ URL::previous() }}">
                        <button type="button" class="btn btn-default">Cancel</button></a>
                    <!-- <button type="button" class="btn btn-default">Cancel</button> -->
                    {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'validateButton2')) !!}
                </div>
                <!-- /.box-footer -->
                {!! Form::close() !!}
            </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('scripts')
<script src="{{ asset('js/formvalidation/formValidation.min.js') }}"></script>
<script src="{{ asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>

<script>
    var phpImageUrls = <?php echo json_encode($selected_values); ?>;

    $(document).ready(function($) {
        findImages();
        getMainImage();
    });

    function findImages() {
        var search = document.getElementById("search").value;
        var type = document.getElementById("type").value; // Get the selected type

        $('#type').on('change', function() {
            var typeField = $(this);
            var errorMessage = typeField.closest('.form-group').find('.help-block');
            if (errorMessage.length > 0) {
                errorMessage.remove();
            }

            var searchField = $('#search');
            searchField.val(''); // Clear search term
            var imagesContainer = $('#imagesContainer');
            imagesContainer.empty(); // Clear search result
        });

        if (!type) {
            // Display an error message
            var typeField = document.getElementById("type");
            var errorMessage = document.createElement("div");
            errorMessage.className = "help-block";
            errorMessage.textContent = "Type is required to search.";
            errorMessage.style.color = "red";
            typeField.parentNode.appendChild(errorMessage);
            return;
        }

        $.ajax({
            url: "{{ url('admin/get-editorial-images')}}",
            type: "POST",
            data: {
                search: search,
            },
            success: function(result) {
                if (result.isValid == true) {

                    imagesContainer.innerHTML = "";

                    // Create a label for the searched images
                    var label = document.createElement("label");
                    label.textContent = "Result";
                    label.className = "col-sm-2 control-label";

                    // Append the label to the imagesContainer
                    imagesContainer.appendChild(label);

                    var imageWrapperContainer = document.createElement("div");
                    imageWrapperContainer.className = "col-sm-10"; // Set the column size

                    result.data.forEach(function(image) {
                        var imageWrapper = document.createElement("div");
                        imageWrapper.className = "col-sm-1";
                        imageWrapper.style.marginBottom = "15px";
                        imageWrapper.style.marginRight = "10px";

                        imageWrapper.style.display = "inline-block";

                        var checkboxDiv = document.createElement("div");
                        checkboxDiv.className = "checkbox-wrapper";

                        var checkboxInput = document.createElement("input");
                        checkboxInput.type = "checkbox";
                        checkboxInput.name = "selectedImages[]";
                        checkboxInput.value = image.product_main_image;
                        checkboxInput.style.transform = "scale(1.5)";
                        checkboxInput.style.position = "absolute";
                        checkboxInput.style.position = "absolute";
                        checkboxInput.style.right = "-6";
                        checkboxInput.style.top = "0";

                        if (type === 'story') { // If type is 'story', automatically check the checkbox
                            checkboxInput.checked = true;
                            checkboxInput.style.display = "none";
                        }
                        if (phpImageUrls.indexOf(image.product_main_image) !== -1) {
                            checkboxInput.checked = true;
                        }

                        var imgElement = document.createElement("img");
                        imgElement.src = image.product_main_image;
                        imgElement.alt = image.product_title;
                        imgElement.width = 100; // Set width
                        imgElement.height = 100; // Set height

                        // Append the checkbox input and img element to the checkbox div
                        checkboxDiv.appendChild(checkboxInput);
                        imageWrapper.appendChild(checkboxDiv);
                        imageWrapper.appendChild(imgElement);

                        // Append the image wrapper to the images container
                        imageWrapperContainer.appendChild(imageWrapper);
                    });
                    imagesContainer.appendChild(imageWrapperContainer);

                } else {
                    imagesContainer.innerHTML = "";

                    // Create a label for the searched images
                    var label = document.createElement("label");
                    label.className = "col-sm-2 control-label";
                    imagesContainer.appendChild(label);

                    // Create a message element for displaying "No images found."
                    var message = document.createElement("p");
                    message.textContent = "No images found.";
                    message.style.color = "red";
                    imagesContainer.appendChild(message);
                }
            },
        });
    }

    function getMainImage() {
        var phpMainImageUrls = <?php echo json_encode($main_images_selected_values); ?>;

        var main_image_id = document.getElementById("main_image_id").value;
        $.ajax({
            url: "{{ url('admin/get-main-images')}}",
            type: "POST",
            data: {
                main_image_id: main_image_id
            },
            success: function(result) {
                if (result.isValid == true) {

                    mainImagesContainer.innerHTML = "";
                    var label = document.createElement("label");
                    label.textContent = "Main Image Result";
                    label.className = "col-sm-2 control-label";

                    // Append the label to the imagesContainer
                    mainImagesContainer.appendChild(label);

                    var mainImageWrapperContainer = document.createElement("div");
                    mainImageWrapperContainer.className = "col-sm-10"; // Set the column size

                    result.data.forEach(function(image) {
                        var mainImageWrapper = document.createElement("div");
                        mainImageWrapper.className = "col-sm-1";
                        mainImageWrapper.style.marginBottom = "15px";
                        mainImageWrapper.style.marginRight = "10px";

                        mainImageWrapper.style.display = "inline-block";

                        var checkboxMainDiv = document.createElement("div");
                        checkboxMainDiv.className = "checkbox-wrapper";

                        var checkboxMainInput = document.createElement("input");
                        checkboxMainInput.type = "checkbox";
                        checkboxMainInput.name = "selectedMainImages[]";
                        checkboxMainInput.value = image.product_main_image;
                        checkboxMainInput.style.transform = "scale(1.5)";
                        checkboxMainInput.style.position = "absolute";
                        checkboxMainInput.style.position = "absolute";
                        checkboxMainInput.style.right = "-6";
                        checkboxMainInput.style.top = "0";

                        if (phpMainImageUrls.indexOf(image.product_main_image) !== -1) {
                            checkboxMainInput.checked = true;
                        }
                        var mainImgElement = document.createElement("img");
                        mainImgElement.src = image.product_main_image;
                        mainImgElement.alt = image.product_title;
                        mainImgElement.width = 100; // Set width
                        mainImgElement.height = 100; // Set height

                        // Append the checkbox input and img element to the checkbox div
                        checkboxMainDiv.appendChild(checkboxMainInput);
                        mainImageWrapper.appendChild(checkboxMainDiv);
                        mainImageWrapper.appendChild(mainImgElement);

                        // Append the image wrapper to the images container
                        mainImageWrapperContainer.appendChild(mainImageWrapper);
                    });
                    mainImagesContainer.appendChild(mainImageWrapperContainer); // Append mainImageWrapperContainer

                } else {
                    mainImagesContainer.innerHTML = "";

                    // Create a label for the searched images
                    var label = document.createElement("label");
                    label.className = "col-sm-2 control-label";

                    // Append the label to the imagesContainer
                    mainImagesContainer.appendChild(label);

                    // Create a message element for displaying "No images found."
                    var message = document.createElement("p");
                    message.textContent = "No images found.";
                    message.style.color = "red"; // Set the text color to red

                    // Append the message to the imagesContainer
                    mainImagesContainer.appendChild(message); // Append message
                }
            },
        });
    }
</script>
@stop