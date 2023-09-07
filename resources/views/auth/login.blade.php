<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['../resources/sass/app.scss', '../resources/js/app.js'])
    <style>
        .card {
            max-width: 400px;
        }

        .card-header {
            text-align: center;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), url('images/bg-01.jpg');
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
            height: 200px;
            color: #fff !important;
            font-size: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        body.login {
            background-image: url('images/bg.jpg');
            background-position: center center;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>


<body class="login">
    <div id="app">

        <main class="py-4">
            {{-- <div class="container"> --}}
            <div class="row justify-content-center"
                style="height: 80vh; flex-direction:column; display:flex; align-items:center">
                <div class="col-md-5 d-flex justify-content-center">
                    <div class="card">
                        <div class="card-header text-center">
                            <h1>{{ __('Login') }}</h1>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="nip"
                                        class="col-md-4 col-form-label text-md-end">{{ __('NIP') }}</label>

                                    <div class="col-md-6">
                                        <input id="nip" type="text"
                                            class="form-control @error('nip') is-invalid @enderror" name="nip"
                                            value="{{ old('nip') }}" required autocomplete="email" autofocus>

                                        @error('nip')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
        </main>
    </div>
</body>

</html>
