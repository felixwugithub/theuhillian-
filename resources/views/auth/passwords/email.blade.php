@extends('layout')

@section('content')
<div class="container">
    <div>
        <div>
            <div class="flex flex-col justify-center items-center h-5/12">
                <div class="text-lg font-ooga pt-12 space-y-5">{{ __('Reset Password') }}</div>

                <div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3 mt-4">
                            <label for="email" class="font-slim">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="mt-5 input1 rounded-full focus:border-hotPink focus:ring-hotPink form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="text-hotPink text-sm" role="alert">
                                     {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="">
                                <button type="submit" class="block bg-hotPink text-white font-slim rounded hover:bg-pink-500 mt-5 p-1">
                                    {{ __('Send Password Reset Link') }}
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
