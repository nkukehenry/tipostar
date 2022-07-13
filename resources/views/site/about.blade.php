@extends('layouts.frontend.index')

@section('content')
<!-- Start About area -->
<div id="about" class="about-area area-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="section-headline text-center">
                    <h2>About us</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- single-well start-->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="single-well">
                    <p>
                        {{ __('gen.app_name') }}.com is not responsible for any decisions made,
                        financial or otherwise, based on the information,
                        emails or links provided on this website.
                        <hr>
                        Any sort of information posted on our site from other websites, persons or organizations should
                        be checked for accuracy and timeliness at the
                        sources themselves and no reliance should be placed on the same as it appears on our site.
                        <hr>
                        {{ __('gen.app_name') }}.com does not guarantee winnings and cannot be held
                        liable for losses resulting from the use of information obtained here. We do not offer
                        bookmaking or services related to bookmaking etc. In order to place bets, you must access the
                        bookmakers" web sites and comply with the bookmakers” terms and conditions.
                        <hr>
                        We also do not accept any responsibility or liability for the comments of our viewers as may be
                        posted on certain pages, example: message boards. If you are offended or are in any way
                        adversely affected by such contents, please contact us immediately and refrain from visiting
                        those pages. We are not liable to remove any offending messages on any pages within our site.
                        Please enter at your own risk!
                        <hr>
                        We do not offer refunds on our products or services. If you are having any issue with the
                        subscription or have any questions, please contact us, we will do our best to resolve the
                        problem.
                        <hr>
                        <div style="background: red; padding:10px; color:white;" >
                        WARNING: Betting can be very risky and users should only speculate with money that they can
                        comfortably afford to lose and should ensure that the risks involved are fully understood,
                        seeking advice if necessary.
                        </div>
                        <hr>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End About area -->
@endsection




