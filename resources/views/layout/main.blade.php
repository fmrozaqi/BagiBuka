<!doctype html>
<html>

<head>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>

    <style>
        .vertical-input-group .input-group:first-child {
            padding-bottom: 0;
        }

        .vertical-input-group .input-group:first-child * {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .vertical-input-group .input-group:last-child {
            padding-top: 0;
        }

        .vertical-input-group .input-group:last-child * {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .vertical-input-group .input-group:not(:last-child):not(:first-child) {
            padding-top: 0;
            padding-bottom: 0;
        }

        .vertical-input-group .input-group:not(:last-child):not(:first-child) * {
            border-radius: 0;
        }

        .vertical-input-group .input-group:not(:first-child) * {
            border-top: 0;
        }

    </style>

    <title>@yield('title')</title>

</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light mx-auto" style="max-width: 500px;">
            <div class="container-fluid" >
                <a class="navbar-brand text-success" href="{{ url('/') }}"><strong>BagiBuka</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/transaction') }}">Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">RM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin') }}">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    @yield('main')
</body>

</html>
