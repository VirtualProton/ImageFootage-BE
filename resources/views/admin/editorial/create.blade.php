@extends('admin.layouts.default')

@section('content')
<div class="content-wrapper">
    <section class="content">

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Add Editorial</h3><a href="{{ URL::to('admin/editorial/create') }}" class="btn pull-right">Back</a> <!-- Need to update path after listing page is done.-->
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! Form::open(array('url' => URL::to('admin/editorial'), 'method' => 'post', 'class'=>"form-horizontal",'id'=>'adminform','files'=> true,'autocomplete'=>false)) !!}
            @include('admin.partials.message')

            <div class="box-body">
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Search Term</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" id="search" placeholder="Search">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Main Image ID</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="main_image_id" id="main_image_id" placeholder="Main Image ID">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div id="imagesContainer">

                    </div>
                </div>
                <br />
                <div class="form-group" id="typeButton">
                    <label for="inputPassword3" class="col-sm-2 control-label">Type</label>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <select class="form-control" name="type" id="type">
                                <option value="">Select</option>
                                <option value="story">Story</option>
                                <option value="collection">Collection</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="statusButton">
                    <label for="inputPassword3" class="col-sm-2 control-label">Staus</label>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="radio" name="status" value="1" /> Active
                            <input type="radio" name="status" value="0" /> Inactive
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{ URL::previous() }}">
                        <button type="button" class="btn btn-default" id="cancelButton">Cancel</button></a>
                    {!! Form::submit('Submit', array('class' => 'btn btn-info', 'id' => 'submitButton')) !!}

                    <button type="button" class="btn btn-succsess" onclick="findImages()" id="searchButton">Search</button>
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
<script src=" {{ asset('js/formvalidation/formValidation.min.js') }}"></script>
<script src="{{ asset('js/formvalidation/framework/bootstrap.min.js') }}"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

<script>
    $(document).ready(function() {

        var typeButtonDiv = document.getElementById("typeButton");
        typeButtonDiv.style.display = "none";

        var statusButtonDiv = document.getElementById("statusButton");
        statusButtonDiv.style.display = "none";

        var submitButton2Div = document.getElementById("submitButton");
        submitButton2Div.style.display = "none";

        var cancelButton2Div = document.getElementById("cancelButton");
        cancelButton2Div.style.display = "none";

        (function() {
            $('#adminform').formValidation({
                framework: "bootstrap",
                button: {
                    selector: '#submitButton',
                    disabled: 'disabled'
                },
                icon: null,
                fields: {

                    type: {
                        validators: {
                            notEmpty: {
                                message: 'Type is required'
                            }
                        }
                    },
                    status: {
                        validators: {
                            notEmpty: {
                                message: 'Status is required'
                            }
                        }
                    },
                    'selectedImages[]': {
                        validators: {
                            notEmpty: {
                                message: 'Images selection is required'
                            }
                        }
                    },



                }
            });
        })();


    });

    function validateFields() {
        var title = document.getElementById("title").value;
        var search = document.getElementById("search").value;
        var main_image_id = document.getElementById("main_image_id").value;

        if (title === "" && search === "" && main_image_id === "") {

            imagesContainer.innerHTML = "";

            var label = document.createElement("label");
            label.className = "col-sm-2 control-label";

            imagesContainer.appendChild(label);

            var message = document.createElement("p");
            message.textContent = "Please select at least one field (Title, Search Term, or Main Image ID).";
            message.style.color = "red"; // Set the text color to red

            imagesContainer.appendChild(message);

            return false;
        }
        return true;
    }


    function findImages() {
        if (!validateFields()) {
            return;
        }
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

                    searchButton.style.display = "none"; // Hide the search button
                    typeButton.style.display = "block";
                    statusButton.style.display = "block";
                    submitButton.style.display = "inline";
                    cancelButton.style.display = "inline";

                    // Clear existing content from imagesContainer
                    imagesContainer.innerHTML = "";

                    // Create a label for the searched images
                    var label = document.createElement("label");
                    label.textContent = "Searched Images";
                    label.className = "col-md-2 control-label";

                    // Append the label to the imagesContainer
                    imagesContainer.appendChild(label);

                    result.data.forEach(function(image) {
                        var imageWrapper = document.createElement("div");
                        imageWrapper.className = "image-wrapper col-md-1";
                        imageWrapper.style.marginBottom = "15px";
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
                        checkboxInput.style.right = "19";
                        checkboxInput.style.top = "0";


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
                        imagesContainer.appendChild(imageWrapper);
                    });

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