<!DOCTYPE html>
<html>
<head>
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            p{
                color: #000;
                letter-spacing: 1px;
                font-size: 20px;
                font-family: 'Raleway', sans-serif;
            }
            p a {
                font-weight: bold;
    /* text-decoration: none; */
    color: #000;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 36px;
                padding: 20px;
            }
        </style>
        <title>404! Page Not Found</title>
</head>
<body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                                    <div class="login-logo">
                <a href="{{ url('/home') }}">
                <img src="{{ asset('/img/logo.png') }}">
                </a>
            </div>
                <div class="title">
        <h1>Oops! 404</h1>
 
        <h1> Sorry, the page you are looking for could not be found.</h1>
                </div>
    <p>If this continues to happen please contact Westgate IT. </p>
        <!-- <div class="error-heading">403</div> -->
        <!-- <p>You do not have permission to access the document or program that you requested.</p> -->


        <a href="{{ url('/home') }}" class="btn btn-primary btn-add-new" style="border: 1px solid;">Home</a>
     <!--    <a href="{{ url('/logout') }}" class="btn btn-primary btn-add-new" style="border: 1px solid;">Logout</a> -->

    </div>
</div>
</body>
</html>
