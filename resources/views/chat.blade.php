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
    <div class="containers w-100 h-100 m-0 p-0">
        <div class="row w-100 h-100 m-0">
            <div class="col-4 bg-white p-1 m-0">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row align-items-center my-2 mx-3">
                        <img src="{{ asset('img/logo.svg') }}" alt="Chatlify" width="45px"/>
                        <input type="text" class="border w-100 rounded-pill px-3 py-2 ml-2" id="search" name="search"
                            aria-describedby="searchHelp" placeholder="Search people"/>
                    </div>
                    <div class="scroll-y pt-2" style="height: 600px">
                        @for ($i = 0; $i < 50; $i++)
                            @include('chatRowItem')
                        @endfor
                    </div>
                </div>
            </div>
            
            <div class="col-8 p-0 m-0">
                @include('chatPane')
            </div>
        </div>
    </div>
</body>

</html>
