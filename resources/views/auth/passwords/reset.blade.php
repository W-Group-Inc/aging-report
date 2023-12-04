@extends('layouts.app')

@section('content')

<div class="middle-box text-center loginscreen animated fadeInDown mt-5">
    <div>
        <div class="m-b-md mt-5">
            <img alt="image"  src="{{asset('images/front-logo.png')}}" style='width:135px;'>
        </div>
        <h3>{{ __('Reset Password') }}</h3>
        <form  method="POST" action="{{ route('password.update') }}" onsubmit='show()'>
            @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <input type="email" name='email' value="{{ old('email') }}" class="form-control" placeholder="Email Address" required="">
            </div>
            <div class="form-group">
                <input type="password" name='password' class="form-control" placeholder="Password" required="">
            </div>
            <div class="form-group">
                <input type="password" name='password_confirmation' class="form-control" placeholder="Confirm Password" required="">
            </div>
            @if($errors->any())
            <div class="form-group alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>{{$errors->first()}}</strong>
            </div>
            @endif
            <button type="submit" class="btn btn-primary block full-width m-b"> {{ __('Reset Password') }}</button>
            {{-- <a href='{{ asset('/user_guide.pdf') }}' target='_' class="btn btn-warning block full-width m-b">View User Guide</a> --}}
            {{-- <a href="{{ route('password.request') }}" onclick='show()'><small>Forgot password?</small></a> --}}
        </form>
        <p class="m-t"> <small>Copyright &copy; {{date('Y')}}</small> </p> 
    </div>
</div>
@endsection