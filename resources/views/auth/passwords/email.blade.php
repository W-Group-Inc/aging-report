@extends('layouts.app')

@section('content')

<div class="middle-box text-center loginscreen animated fadeInDown mt-5">
    <div>
        <div class="m-b-md mt-5">
            <img alt="image"  src="{{asset('images/front-logo.png')}}" style='width:135px;'>
        </div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h3>  {{ __('Reset Password') }}</h3>
        <form method="POST" action="{{ route('password.email') }}"  onsubmit='show()'>
            @csrf
            <div class="form-group">
                <input type="email" name='email' value="{{ old('email') }}" class="form-control" placeholder="Email" required="">
            </div>
            @if($errors->any())
            <div class="form-group alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <strong>{{$errors->first()}}</strong>
            </div>
            @endif
            <button type="submit" class="btn btn-primary block full-width m-b"> {{ __('Send Password Reset Link') }}</button>
            {{-- <a href='{{ asset('/user_guide.pdf') }}' target='_' class="btn btn-warning block full-width m-b">View User Guide</a> --}}
            <a href="{{ route('login') }}" onclick='show()'><small>Back to login page</small></a>
        </form>
        <p class="m-t"> <small>Copyright &copy; {{date('Y')}}</small> </p> 
    </div>
</div>
@endsection