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
<body class="w-100 h-100" style="background: url({{asset('img/bg.jpg')}});background-size: cover;background-repeat: no-repeat;background-attachment: fixed;">
    <div class="d-flex justify-content-center align-items-center flex-column w-100 h-100">
        <div class="d-flex justify-content-center align-items-center flex-column border rounded p-5 card">
            <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="150px">
            <h2 class="logo-text text-primary mt-2">Chatlify</h2>
            <p>Chat your day away</p>
            <a href="/login" class="btn btn-primary btn-block">Start chatting away</a>
            <span class="small-text mt-4">Built to ridicule the social media mess</span>
        </div>
        <div class="text-white d-flex flex-row justify-content-end w-100">
            <span class="mr-3 mt-5">Photo by <a href="https://unsplash.com/@cristina_gottardi?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText" class="text-white">Cristina Gottardi</a> on <a href="https://unsplash.com/s/photos/chat?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText" class="text-white">Unsplash</a><span/>
        </div>
    </div>
</body>
</html>