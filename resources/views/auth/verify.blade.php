@extends('layout')

@section('content')
<div class="container">
    <div class="flex flex-col justify-center items-center h-5/12">
        <div>
            <div class="w-96 mt-6 px-10 py-10 bg-felixSalmon rounded-lg justify-center shadow-md overflow-hidden">
                <div class="font-ooga text-lg text-center">{{ __('Verify Your Email Address') }}</div>

                <div class="font-slim">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link. Your account may be terminated if you do not verify your email within 24 hours.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="block bg-hotPink text-white font-slim rounded hover:bg-pink-500 mt-5 p-1">{{ __('click here to request another.') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
