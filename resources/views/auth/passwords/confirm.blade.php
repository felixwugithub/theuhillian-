@extends('layout')


@section('content')
<div class="container">
    <div class="flex flex-col justify-center items-center h-5/12">
        <div class="text-lg font-ooga pt-12 space-y-5">
            <div>
                <div>{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="font-slim">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="mt-5 input1 rounded-full focus:border-hotPink focus:ring-hotPink  form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="block bg-hotPink text-white font-slim rounded hover:bg-pink-500 mt-5 p-1">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
