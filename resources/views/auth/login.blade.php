<x-guest-layout title="Login" bodyClass="page-login"> 
    <div class="form-group">
        <input type="email" placeholder="Your Email" />
    </div>
    <div class="form-group">
        <input type="password" placeholder="Your Password" />
    </div>
    <div class="text-right mb-medium">
        <a href="/password-reset.html" class="auth-page-password-reset">Reset Password</a>
    </div>

    <x-slot:buttonText> Login </x-slot>

    <x-slot:pageLink>
        <div class="login-text-dont-have-account">
            Don't have an account? -
            <a href="{{route('signup.create')}}"> Click here to create one</a>
        </div>
    </x-slot:pageLink>

</x-guest-layout>