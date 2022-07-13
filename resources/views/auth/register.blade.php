@extends('layouts.frontend.index')

@section('content')
<!-- Start Register area -->
<div id="signup" class="signup-area area-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2>It's free to signup!</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-sm-8  col-md-offset-2 col-sm-offset-2 col-xs-12">
                <form id="signup-form" class="signup-form" method="post" action="{{ route('register')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="personal-info">
                                <h5><i class="fa fa-user"></i> Personal info:</h5>
                                 <div class="bg-info info-discalaimer">
                                        <p>
                                            Get a chance to receive expert predictions  when you register an account with us
                                        </p>
                                    </div>
                                <div class="form-group">
                                    <label for="first-name">First name:</label>
                                    <input type="text" class="form-control" name="first_name" id="first-name"
                                        placeholder="First name" />
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Last name:</label>
                                    <input type="text" class="form-control" name="last_name" id="last-name"
                                        placeholder="Last name" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email" />
                                </div>
                                <div class="form-group">
                                    <div class="bg-info info-discalaimer">
                                        <p>
                                            All passwords must contain at least 8 characters.
                                            We also suggest having at least one capital and one lower-case letter
                                            (Aa-Zz),
                                            one special symbol (#, &, % etc), and one number (0-9) in your password
                                            for
                                            the best strength.
                                        </p>
                                    </div>
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="New password" />
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm password:</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" placeholder="Confirm password" />
                                </div>
                            
                                <div class="form-group">
                                    <label for="country_selector">Country:</label>
                                    <input id="country_selector" name="country" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <p>By creating a Soccertipstar account, you agree to our<a href="{{ route('home') }}#about"> Terms of service</a>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-md-offset-md-4 col-sm-offset-4 col-xs-12">
                            <div class="text-center"><button type="submit">Submit</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Register area -->
@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function () {
      
        /* Generate country drop down list */
        $("#country_selector").countrySelect({
            defaultStyling: "inside",
            responsiveDropdown: true

        });

        /* Validate from */
        $("#signup-form").validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true,
                    remote: "{{ url('checkUserEmailExists') }}"
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                },
                country: {
                    required: true,
                }
            },
            messages: {
                first_name: {
                    required: 'First name is required.'
                },
                last_name: {
                    required: 'Last name is required.'
                },
                email: {
                    required: 'Email is required.',
                    email: 'Email must be a valid email address.',
                    remote: 'This email has already been taken.'
                },
                password: {
                    required: 'Password is required.',
                    minlength: 'Password must be atleast 8 characters long.'
                },
                password_confirmation: {
                    equalTo: 'The passwords don\'t match'
                },
                country: {
                    required: 'Country is required',
                },
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
        });
    });

</script>
@endsection
