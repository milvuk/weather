<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield( 'title' )</title>

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.0/simplex/bootstrap.min.css" rel="stylesheet" integrity="sha384-dGOMD5bzPwVfOGp4zGQiudlmCab9PN0dIsv1r1MCotfVsSXM3m5ZiqEVO56XzCCh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset( 'css/style.css' ) }}">

    @section('stylesheets')@show

</head>

<body>

@section( 'body' )@show

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="{{ asset( 'js/main.js' ) }}"></script>
@section('javascripts')@show

</body>

<script>
    let GLOBAL_URL_BASE = "{!! url('/') !!}" + "/";
</script>

</html>