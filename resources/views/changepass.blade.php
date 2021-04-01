<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change password</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="w-100 h-100" style="background: url({{asset('img/bg.jpg')}});background-size: cover;background-repeat: no-repeat;background-attachment: fixed;">
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <div class="d-flex flex-column justify-content-center align-items-center border rounded px-5 py-3 card shadow" style="width: 450px;">
            <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="60px">
            <h2 class="logo-text text-primary mt-2">Chatlify</h2>
            <p>Chat your day away</p>
            <form class="mt-1">
                <div class="mb-3">
                    <label for="username" class="form-label grey-font">Email address or username</label>
                    <input type="username" class="border w-100 rounded-pill px-3 py-2" id="username" name="username" aria-describedby="usernameHelp" placeholder="Username or email">
                    <div id="usernameHelp" class="form-text"></div>
                  </div>
                <div class="mb-3">
                  <label for="old-password" class="form-label grey-font">Old password</label>
                  <input type="password" class="border w-100 rounded-pill px-3 py-2" id="old-password" name="old-password" placeholder="Your old password">
                  <div id="old-passwordHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                  <label for="new-password" class="form-label grey-font">New password</label>
                  <input type="password" class="border w-100 rounded-pill px-3 py-2" id="new-password" name="new-password" placeholder="Your new password">
                  <div id="new-passwordHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                  <label for="confirm-password" class="form-label grey-font">Confirm new password</label>
                  <input type="password" class="border w-100 rounded-pill px-3 py-2" id="confirm-password" name="confirm-password" placeholder="Must match new password">
                  <div id="confirm-passwordHelp" class="form-text"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Change password</button>
            </form>
            <span class="mt-3"><a href="/login">Log in</a> or <a href="/signup">Sign up</a></span>
        </div>
    </div>
</body>
</html>