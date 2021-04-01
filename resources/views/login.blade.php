<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="w-100 h-100" style="background: url({{asset('img/bg.jpg')}});background-size: cover;background-repeat: no-repeat;background-attachment: fixed;">
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <div class="d-flex flex-column justify-content-center align-items-center border rounded p-5 card shadow">
            <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="90px">
            <h2 class="logo-text text-primary mt-2">Chatlify</h2>
            <p>Chat your day away</p>
            <form class="mt-1">
                <div class="mb-3">
                  <label for="username" class="form-label grey-font">Email address or username</label>
                  <input type="username" class="border w-100 rounded-pill px-3 py-2" id="username" name="username" aria-describedby="usernameHelp" placeholder="Username or email">
                  <div id="usernameHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label grey-font">Password</label>
                  <input type="password" class="border w-100 rounded-pill px-3 py-2" id="password" name="password" placeholder="Your password">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </form>
            <span class="mt-3">Don't have an account? <a href="/signup">Sign up</a></span>
            <a href="/forgotpass" class="mt-2">Forgot password?</a>
        </div>
    </div>
</body>
</html>