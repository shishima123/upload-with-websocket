<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 mt-5">
            <input type="file" name="myfile" id="fileUpload">
            <button class="btn btn-primary" id="uploadFile">
                upload
            </button>
            <div class="progress mt-4">
                <div id="uploadProgressBar" class="progress-bar" role="progressbar" style="width: 0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
            <p id="loaded_n_total">0</p>
            <p id="status">0</p>
        </div>
    </div>

    {{-- ADD THIS--}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        Echo.channel('upload')
            .listen('UploadEvent', e => {
                console.log(e.message)
            })
    </script>
    {{-- ADD THIS--}}
</div>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#uploadFile").click(function (event) {
            event.preventDefault();
            var file = $("#fileUpload")[0].files[0];
            var formData = new FormData();
            formData.append("file1", file);

            $.ajax({
                url: '{{ route('upload') }}',
                method: 'POST',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress",
                        uploadProgressHandler,
                        false
                    );
                    xhr.addEventListener("load", loadHandler, false);
                    xhr.addEventListener("error", errorHandler, false);
                    xhr.addEventListener("abort", abortHandler, false);

                    return xhr;
                }
            });
        });
    });

    function uploadProgressHandler(event) {
        $("#loaded_n_total").html("Uploaded " + event.loaded + " bytes of " + event.total);
        var percent = (event.loaded / event.total) * 100;
        var progress = Math.round(percent);
        $("#uploadProgressBar").html(progress + " percent na ang progress").css("width", progress + "%");
        $("#status").html(progress + "% uploaded... please wait");
    }

    function loadHandler(event) {
        $("#status").html(event.target.responseText);
        $("#uploadProgressBar").css("width", "0%");
    }

    function errorHandler(event) {
        $("#status").html("Upload Failed");
    }

    function abortHandler(event) {
        $("#status").html("Upload Aborted");
    }
</script>
</body>
</html>
