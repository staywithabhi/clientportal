<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    body{
    font-family: 'Ropa Sans', sans-serif;
    margin-top: 30px;
    background-color: #F0CA00;
    background-color: #3c8dbc;
    text-align: center;
    color: #fff;
}
.error-heading{
    margin: 50px auto;
    width: 250px;
    border: 5px solid #fff;
    font-size: 126px;
    line-height: 126px;
    border-radius: 30px;
    text-shadow: 6px 6px 5px #000;
}
.error-heading img{
    width: 100%;
}
.error-main h1{
    font-size: 72px;
    margin: 0px;
    color: #F3661C;
    text-shadow: 0px 0px 5px #fff;
}

    </style>
</head>
<body>
	<div class="error-main">
        <h1>Oops!</h1>
        <h1>Access Forbidden Restricted Area</h1>
		<div class="error-heading">403</div>
        <p>You do not have permission to access the document or program that you requested.</p>
        <a href="{{ url('/home') }}" class="btn btn-primary btn-add-new" style="border: 1px solid;">Go To Dashboard</a>
        <a href="{{ url('/logout') }}" class="btn btn-primary btn-add-new" style="border: 1px solid;">Logout</a>

	</div>
</body>
</html>
