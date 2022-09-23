@extends('layout')

@section('content')

    <div class="rounded-2xl bg-pinkie m-5 p-5">

        <div>
            <h1 class="text-spicyPink font-ooga text-3xl underline">Why do we require your school email?</h1>
            <p class="text-spicyPink font-slim text-lg">
                Your student email indicates that you are a legitimate student. We use this to prevent irrelevant personnel from raiding this community.
                Additionally, we can be confident that banned users will not be able to return with alt accounts.
            </p>

            <p class="text-spicyPink font-slim text-lg">We will NEVER disclose the student email associated with your registration, nor will we attempt to identify you with it.
                We will never send you emails other than the initial verification email, which will not contain any uniquely identifiable information about your account.

                Other users can see your username, but NOT your email.
            </p>
            <p class="text-spicyPink font-ooga text-xl">Building this website took unimaginable efforts, and the last thing we want is to betray your trust.</p>
        </div>
    </div>

    <div class="rounded-2xl bg-pinkie m-5 p-5">

        <div>
            <h1 class="text-spicyPink font-ooga text-3xl underline">Why do we not allow password resets?</h1>

            <p class="text-spicyPink font-slim text-lg">
                The organization that your student email belongs to might be able to access your inbox. If they do, they can then exploit conventional password reset emails to gain access to
                any account that you've registered with your student email.

                <span class="font-ooga text-red-900"> If we allowed password-resets, the school may be able to log into your account on theuhillian.com even if you never told them your password.</span>
            </p>

            <p class="text-spicyPink font-slim text-lg">
                For that reason, we've disabled this feature in order to ensure that the only person that can access your account is you.
            </p>

            <p class="text-spicyPink font-ooga text-xl">You cannot reset/change your password, so pick something unique and write it down somewhere secure. If you believe that your account has been
            compromised, email theuhillian@gmail.com ASAP.</p>
        </div>
    </div>

    <div class="rounded-2xl bg-pinkie m-5 p-5">

        <div>
            <h1 class="text-spicyPink font-ooga text-3xl underline">How do we protect your information?</h1>

            <p class="text-spicyPink font-slim text-lg">
                This website uses a back-end framework with robust and tested security measures.
            </p>

            <p class="text-spicyPink font-slim text-lg">
                Your password is hashed. Even if the database is compromised (which is near impossible, you'd have to physically obtain my computer and then do some nerd shit to get into a remote server), no one can actually view the original, un-hashed password.
                Nevertheless, we still advise you to use a unique and lengthy password and write it down somewhere secure.
            </p>

            <p class="text-spicyPink font-slim text-lg">
                All your info is stored in a database that uses the same authentication & encryption protocols as other reputable, mainstream websites. We had to pay some money to get all that. The owner of this site has a doomsday script that can wipe everything.
            </p>

            <p class="text-spicyPink font-ooga text-xl">If you discover security vulnerabilities, please email theuhillian@gmail.com ASAP. We might offer you a job ;)</p>
        </div>
    </div>

@endsection