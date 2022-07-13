@extends('layouts.frontend.index')

@section('content')
<div id="signin" class="area-padding">
    <div class="container">
   
        <div class="row">
            <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4 col-xs-12">


                <form id="signin-form" class="signin-form" method="POST" action="{{ route('login') }}">
                   
                
                 <div class="section-headline text-center">
                    <h2>signin</h2>
                 </div>

                @csrf
                    <div class="form-group has-feedback">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group has-feedback">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="text-center"><button type="submit">signin</button></div>
                    </div>
                </form>
                <div style="padding-top:20px;">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a><br>
                            @endif
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                            <a href="{{ route('register') }}">{{ __('Signup') }}</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
