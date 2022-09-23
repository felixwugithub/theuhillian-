@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center flex flex-col justify-center items-center h-11/12">
        <div>
            <div class="card w-96 mt-6 px-10 py-10 bg-felixSalmon rounded-lg justify-center shadow-md overflow-hidden">
                <div class="text-center font-ooga text-xl">{{ __('Register') }}</div>

                <div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="block mt-5 font-slim">{{ __('Username') }}</label>

                            <div class="">
                                <input id="username" type="text" class="mt-5 focus:ring-hotPink focus:border-hotPink input1 rounded-full h-7 form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback text-xs text-hotPink" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror
                                <label for="password" class="block mt-5 font-slim text-sm text-gray-700">You cannot change your username. Do not use your real name or put any personal information here.</label>
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block mt-5 font-slim">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="mt-5 focus:ring-hotPink focus:border-hotPink input1 rounded-full h-7 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="text-xs text-hotPink" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <div>
                                <label for="password" class="block mt-5 font-slim text-sm text-gray-700 container relative w-full items-center">You must use a student email.<a href="/about-info-protection" class="text-hotPink text-xs font-slim hover:underline right-4 absolute">Why?</a></label>

                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="block mt-5 font-slim">{{ __('Password') }}</label>


                            <div>
                                <input id="password" type="password" class="mt-5 focus:ring-hotPink focus:border-hotPink input1 rounded-full h-7 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="text-xs text-hotPink" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <label for="password" class="block mt-5 font-slim text-sm text-gray-700 w-full container relative items-center">Pick a <span class="font-comfortaa text-xs text-spicyPink">unique</span> password and write it down. You cannot change/reset it. <a href="/about-info-protection" class="text-hotPink text-xs right-4 absolute font-slim hover:underline"> Why?</a> </label>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="block mt-5 font-slim">{{ __('Confirm Password') }}</label>




                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control mt-5 input1 rounded-full focus:ring-hotPink focus:border-hotPink" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="items-center block bg-hotPink text-white font-slim rounded hover:bg-pink-500 mt-5 p-0.5">
                                    {{ __('Register') }}
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
