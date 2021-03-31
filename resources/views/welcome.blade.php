<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chatlify</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="w-100 h-100">
    <div class="d-flex justify-content-center align-items-center flex-column w-100 h-100">
        <div class="d-flex justify-content-center align-items-center flex-column border rounded p-5 card">
            <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="150px">
            <br/>
            <h2 class="logo-text text-primary mt-2">Chatlify</h2>
            <p>Chat your day away</p>
            <button class="btn btn-primary btn-block">Start chatting away</button>
            <span class="small-text mt-4">Built to ridicule the social media mess</span>
        </div>
    </div>
</body>
</html>