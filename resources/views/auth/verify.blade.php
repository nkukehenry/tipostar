@extends('layouts.frontend.index')

@section('content')
<div id="signin" class="area-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2>Verify email address</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2 col-xs-12">
                <div class="card-body">
                    @if (session('resent'))
                    <div class="bg-info info-discalaimer">
                        <p>
                            A fresh verification link has been sent to your email address.  
                        </p>
                    </div>
                    @endif

                    <div class="bg-info info-discalaimer">
                        <p>
                            Before proceeding, please check your email for a verification link.
                        </p>
                        <p>
                            If you did not receive the email, <a href="{{ route('verification.resend') }}">click here to request another</a>.  
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
