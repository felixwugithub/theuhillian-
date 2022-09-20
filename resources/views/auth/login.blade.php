@extends('layout')
@section('content')
<div class="container">
    <div class="flex flex-col justify-center items-center h-5/12">
        <div>
            <div class="w-96 mt-6 px-10 py-10 bg-felixSalmon rounded-lg justify-center shadow-md overflow-hidden">
                <div class="text-lg font-ooga text-center">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="block mt-5 font-slim">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="mt-5 input1 rounded-full focus:ring-hotPink focus:border-hotPink form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-xs text-hotPink">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="block mt-5 font-slim">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="mt-5 input1 rounded-full focus:border-hotPink focus:ring-hotPink form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="focus:border-hotPink focus:ring-hotPink bg-pinkie" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="font-slim" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="rounded-2xl p-5 bg-spicyPink text-white text-lg font-sansMid">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="row mb-0">
                            <div>
                                <button type="submit" class="block bg-hotPink text-white font-slim rounded hover:bg-pink-500 mt-5 p-0.5">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
