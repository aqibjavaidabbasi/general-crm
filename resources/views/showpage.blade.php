<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Site</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
    </script>
    <style>
        /* Adjust margins and paddings as needed */
        .container-fluid {
            margin-top: 20px;
        }

        .image-style-side {
            /* Add styles to match the editor's image layout */
            /* For example: */
            float: left;
            margin-right: 15px;
        }

        /* Adjust inline styles applied to the image */
        .image-style-side img {
            /* Add styles to match the editor's image layout */
            /* For example: */
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <h1>Hello-Bootstrap</h1>
    <div class="container-fluid">
        {!! $data->page_description !!}
    </div>
</body>

</body>


</html>