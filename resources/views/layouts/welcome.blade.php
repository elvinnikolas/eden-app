<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EdenApp</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html {
            background: url('/images/cover.jpg') no-repeat center;
            overflow: auto;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            background-position: fixed;
            -webkit-background-size: cover;
            -webkit-filter: cover;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .text-lg {
            font-size: 1.5rem
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        a {
            color: inherit;
            text-decoration: inherit
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body>
    <div>
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <button class="text-lg" type="button">
                <a href="{{ url('/home') }}">Home</a>
            </button>
            @else
            <button class="text-lg" type="button">
                <a href="{{ route('login') }}">Login</a>
            </button>
            @endauth
        </div>
        @endif
    </div>
</body>

</html>