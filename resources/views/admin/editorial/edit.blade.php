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
            {!! Form::open(array('url' => URL::to('admin/editorials/'.$editorial['id']), 'method' => 'PUT', 'class'=>"form-horizontal",'id'=>'editorialform','files'=> true,'autocomplete'=>false)) !!}
            @include('admin.partials.message')

            <div class="box-body">
                <input type="hidden" name="data_to_pass" id="data_to_pass" value="">

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $editorial['title'] ?>" disabled>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Search Term</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search" value="<?php echo $editorial['search_term'] ?>" disabled>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Main Image ID</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="main_image_id" id="main_image_id" placeholder="Main Image ID" value="<?php echo $editorial['main_image_id'] ?>" disabled>
                        </div>
                    </div>
                </div>
                <?php $selected_values = explode(",", $editorial['selected_values']); ?>
                <div class="form-group">
                    <div id="imagesContainer">
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
        prepareAndSubmitData();
    });

    function prepareAndSubmitData() {
        var title = document.getElementById("title").value;
        var search = document.getElementById("search").value;
        var main_image_id = document.getElementById("main_image_id").value;

        // Combine the data into an object
        var dataToPass = {
            title: title,
            search: search,
            main_image_id: main_image_id
        };

        // Set the value of the hidden input field
        $('#data_to_pass').val(JSON.stringify(dataToPass));
    }


    function findImages() {

        var title = document.getElementById("title").value;
        var search = document.getElementById("search").value;
        var main_image_id = document.getElementById("main_image_id").value;
        $.ajax({
            url: "{{ url('admin/get-editorial-images')}}",
            type: "POST",
            data: {
                title: title,
                search: search,
                main_image_id: main_image_id
            },
            success: function(result) {
                if (result.isValid == true) {

                    // Disabled field
                    var main_image_id = document.getElementById("main_image_id");
                    main_image_id.disabled = true;
                    var title = document.getElementById("title");
                    title.disabled = true;
                    var search = document.getElementById("search");
                    search.disabled = true;

                    // Clear existing content from imagesContainer
                    imagesContainer.innerHTML = "";

                    // Create a label for the searched images
                    var label = document.createElement("label");
                    label.textContent = "Searched Images";
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
                        checkboxInput.value = image.product_thumbnail;
                        checkboxInput.style.transform = "scale(1.5)";
                        checkboxInput.style.position = "absolute";
                        checkboxInput.style.position = "absolute";
                        checkboxInput.style.right = "-6";
                        checkboxInput.style.top = "0";
                        // Check if the image URL should be selected
                        if (phpImageUrls.indexOf(image.product_thumbnail) !== -1) {
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

                    // Append the label to the imagesContainer
                    imagesContainer.appendChild(label);

                    // Create a message element for displaying "No images found."
                    var message = document.createElement("p");
                    message.textContent = "No images found.";
                    message.style.color = "red"; // Set the text color to red

                    // Append the message to the imagesContainer
                    imagesContainer.appendChild(message);
                }
            },
        });
    }
</script>
@stop