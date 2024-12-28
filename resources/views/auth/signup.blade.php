<x-guest-layout title="Sign Up" bodyClass="page-login">


    <div class="form-group">
        <input type="email" placeholder="Your Email" />
    </div>
    <div class="form-group">
        <input type="password" placeholder="Your Password" />
    </div>
    <div class="form-group">
        <input type="password" placeholder="Repeat Password" />
    </div>
    <hr />
    <div class="form-group">
        <input type="text" placeholder="First Name" />
    </div>
    <div class="form-group">
        <input type="text" placeholder="Last Name" />
    </div>
    <div class="form-group">
        <input type="text" placeholder="Phone" />
    </div>
    
    <x-slot:buttonText>Sign Up</x-slot>

    <x-slot:pageLink>
        <div class="login-text-dont-have-account">
            Already have an account? -
            <a href="{{route('login.show')}}"> Click here to login</a>
        </div>
    </x-slot:pageLink>

</x-guest-layout>
