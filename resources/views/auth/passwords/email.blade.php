@extends('layouts.frontend.index')

@section('content')
<div id="email" class="area-padding">
    <div class="container">
        <div class="row" style="margin-top:40px;">
            <div class="col-md-4 col-sm-4 col-md-offset-4 col-sm-offset-4 col-xs-12">
                @if (session('status'))
                    <div class="bg-info info-discalaimer">
                        <p>
                            {{ session('status') }}
                        </p>
                    </div>
                @endif
                <form id="signin-form" class="email-form"method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" 
                            required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="text-center"><button type="submit">Send Password Reset Link</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection