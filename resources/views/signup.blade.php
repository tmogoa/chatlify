<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="w-100 h-100" style="background: url({{asset('img/bg.jpg')}});background-size: cover;background-repeat: no-repeat;background-attachment: fixed;">
    <div class="d-flex flex-column justify-content-center align-items-center w-100 h-100">
        <div class="d-flex flex-column justify-content-center align-items-center border rounded px-5 py-3 bg-white welcome-card flex-grow-1" style="width: 450px;">
            <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="40px">
            <h2 class="logo-text text-primary mt-2">Chatlify</h2>
            <p>Chat your day away</p>
            <form class="mt-1">
                <div class="d-flex flex-row justify-content-between">
                  <div class="mb-3 mr-2">
                    <label for="firstName" class="form-label grey-font">Firstname</label>
                    <input type="firstName" class="border w-100 rounded-pill px-3 py-2" id="firstName" name="firstName" aria-describedby="firstNameHelp" placeholder="First name">
                    <div id="firstNameHelp" class="form-text"></div>
                  </div>
                  <div class="mb-3">
                    <label for="lastName" class="form-label grey-font">Last name</label>
                    <input type="text" class="border w-100 rounded-pill px-3 py-2" id="lastName" name="lastName" aria-describedby="lastNameHelp" placeholder="Last name">
                    <div id="lastNameHelp" class="form-text"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="username" class="form-label grey-font">Choose a username e.g johndoe</label>
                  <input type="text" class="border w-100 rounded-pill px-3 py-2" id="username" name="username" aria-describedby="usernameHelp" placeholder="Username or email">
                  <div id="usernameHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label grey-font">Email address</label>
                  <input type="email" class="border w-100 rounded-pill px-3 py-2" id="email" name="email" aria-describedby="emailHelp" placeholder="Your email address">
                  <div id="usernameHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label grey-font">Password</label>
                  <input type="password" class="border w-100 rounded-pill px-3 py-2" id="password" name="password" placeholder="Your password">
                  <div id="passwordHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                  <label for="confirm-password" class="form-label grey-font">Confirm Password</label>
                  <input type="password" class="border w-100 rounded-pill px-3 py-2" id="confirm-password" name="confirm-password" placeholder="Passwords must match">
                  <div id="confirm-passwordHelp" class="form-text"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Create account</button>
                <div class="smaller-text text-center grey-text mt-1">By creating an account you agree to our Privacy Policy and our Terms and Conditions</div>
            </form>
            <span class="mt-1"><a href="/login">Log in</a></span>
        </div>
    </div>
</body>
</html>