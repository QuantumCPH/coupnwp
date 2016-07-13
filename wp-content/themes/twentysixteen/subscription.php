<?php

/*
 * Template Name: Subscription Page
 */

?>

<?php get_header(); ?>

<div style="clear: both; height: 15em;"></div>

    <?php $subscription = getSingleSubscription( $_GET['id'] ); ?>

<div class="container subScribe1">

        <script type="text/javascript">
           
            (function($,W,D)
            {
                var JQUERY4U = {};

                JQUERY4U.UTIL =
                {
                    setupFormValidation: function()
                    {

                        /*
                         username: {minlength: 3, required: true},
                         email: {email: true, required: true, remote: {url: "./validation/checkUnameEmail.php", type : "post"}},
                         dataType:"json",  contentType: "application/json" ,
                         contentType: "application/json; charset=utf-8",  crossDomain: true, async:true,
                         */

                        //form validation rules
                        $("#register-form").validate({
                            rules: {
                                firstname: "required",
                                lastname: "required",
                                username: {
                                    required: true,
                                    required: true,
                                    remote: {url: "http://mallappbackend.zap-itsolutions.com/uservarification", type : "post" }
                                },

                                email: {
                                    email: true,
                                    required: true,
                                    remote: { url: "http://mallappbackend.zap-itsolutions.com/uservarification", type : "post"}
                                },

                                password: {
                                    required: true,
                                    minlength: 5
                                },
                                cpassword: {
                                    equalTo: "#password"
                                },
                                agree: "required"
                            },
                            messages: {
                                firstname: "Please enter your firstname",
                                lastname: "Please enter your lastname",
                                password: {
                                    required: "Please provide a password",
                                    minlength: "Your password must be at least 5 characters long"
                                },
                                email: {
                                    required: "This field is required",
                                    email: "Please enter a valid email address",
                                    remote: "Email already exists. Use another email"
                                },
                                username: {
                                    required: "This field is required",
                                    remote: "Username already exists. Use another username"
                                },
                                agree: "Please accept our policy"
                            },
                            submitHandler: function(form) {
                                form.submit();
                            }
                        });
                    }
                };

                //when the dom has loaded setup form validation rules
                $(D).ready(function($) {
                    JQUERY4U.UTIL.setupFormValidation();
                });

            })(jQuery, window, document);


        </script>
        <div class="divFullWidth">
            <?php

            $packageId= $subscription->Id;
            $packageAmount=$subscription->Price;
            $packageName=$subscription->Name;


            $monthDate=date('j');
            $totalDaysInMonth=date('t');


            $amountPerDayPackage=$packageAmount/$totalDaysInMonth;

            $numberofDayForCharge=$totalDaysInMonth-$monthDate+1;



            if($numberofDayForCharge>=7){
                $packageAmountForthisMonth=$amountPerDayPackage*$numberofDayForCharge;
            }else{
                $packageAmountForthisMonth=$amountPerDayPackage*7;
            }
            $packageAmountWithVat=$packageAmountForthisMonth*1.25;
            $vatAmount=$packageAmountForthisMonth/100*25;

            ?>
            <div class="col-md-5 col-xs-12">

                <div class="offers" id="pricing">
                    <div class="title"><?= $subscription->Name; ?></div>
                    <span class="pRole">Coupon App</span>

                    <div class="innerOffer">

                        <div class="col-md-6 col-xs-12 rightAl">
                            <span>Subscription Fee:</span>
                        </div>
                        <div class="col-md-6 col-xs-12 leftAl">
                            <span><?=strtoupper( $subscription->Currency ); ?> <?=number_format($packageAmount,2,".",",") ?> per  month</span>
                        </div>

                        <hr />
                        <div class="col-xs-12">
                            <div class="col-md-6 col-xs-12 rightAl">

                                <span>Price for this month:</span>
                                <span class="sepSpan">You pay only for the remaining days of this month</span>
                            </div>
                            <div class="col-md-6 col-xs-12 leftAl">
                                <span><?=strtoupper( $subscription->Currency ); ?> <?=number_format($packageAmountForthisMonth,2,".",",")?></span>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 rightAl">
                            <span>Discount:</span>
                        </div>
                        <div class="col-md-6 col-xs-12 leftAl">
                            <span><?=strtoupper( $subscription->Currency ); ?> 0,00</span>
                        </div>

                        <hr />

                        <div class="col-md-6 col-xs-12 rightAl">
                            <span>Net Price:</span>
                        </div>
                        <div class="col-md-6 col-xs-12 leftAl">
                            <span><?=strtoupper( $subscription->Currency ); ?> <?=number_format($packageAmountForthisMonth,2,".",",")?></span>
                        </div>

                        <div class="col-md-6 col-xs-12 rightAl">
                            <span>VAT (25%):</span>
                        </div>
                        <div class="col-md-6 col-xs-12 leftAl">
                            <span><?=strtoupper( $subscription->Currency ); ?> <?=number_format($vatAmount,2,".",",")?></span>
                        </div>
                        <hr />
                        <div class="col-md-6 col-xs-12 rightAl">
                            <span>Total:</span>
                        </div>
                        <div class="col-md-6 col-xs-12 leftAl">
                            <span><?=strtoupper( $subscription->Currency ); ?> <?=number_format($packageAmountWithVat,2,".",",");  ?></span>
                        </div>

                        <div class="innerInner">

                        </div>

                    </div>
                </div>

            </div>

            <div class="col-md-7 col-xs-12">
                <form role="form" method="post" action="<?=esc_url( admin_url('admin-post.php') )?>" id="register-form" novalidate="novalidate" autocomplete="off">

                    <input type="hidden" name="action" value="process_payment">
                    <input style="display:none">
                    <input type="text" style="display:none">
                    <input type="password" style="display:none">

                    <input type="hidden" name="subscriptionId" value="<?= $packageId;  ?>" class="form-control" id="pID">
                    <input type="hidden" name="amount" value="<?=number_format($packageAmountWithVat,2,",",".")?>" class="form-control" id="pAmount">
                    <input type="hidden" name="packagename" value="<?= $packageName;  ?>" class="form-control" id="pName">

                    <div class="col-md-6 col-xs-12">

                        <div class="form-group">
                            <label for="email">Full Name</label>
                            <input type="text" name="fullname" required="required" placeholder="Full Name" class="form-control" id="name" autocomplete="false">
                        </div>

                        <div class="form-group">
                            <label for="pwd">Email</label>
                            <input type="email" name="email" placeholder="Email" class="form-control" required="required" id="email" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password</label>
                            <input type="password" name="password" placeholder="Password" required="required" class="form-control" id="password" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Confirm Password</label>
                            <input type="password" name="cpassword" placeholder="Confirm Password" required="required" class="form-control" id="confirmPass" autocomplete="false">
                        </div>


                        <div class="form-group">
                            <label for="pwd">CVR</label>
                            <input type="text" name="cvr" placeholder="CVR"  class="form-control" id="cvr" autocomplete="false">
                        </div>

                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="email">Username</label>
                            <input type="text" required="required" placeholder="Username" class="form-control" name="username" id="username" autocomplete="false">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Mobile Number</label>
                            <input type="text" name="mobile" placeholder="Mobile Number" class="form-control" required="required" id="phone" autocomplete="false">
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>

                            <select name="country" class="form-control" id="country">
                                <?php $countryArr = getCountryName( strtoupper( $subscription->Currency ) ); var_dump( $subscription->Currency );exit;?>
                                <option value="<?=$countryArr['code']?>"><?=strtoupper( $countryArr['country'] ); ?></option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Company Name</label>
                            <input type="text" name="companyname" placeholder="Company Name" required="required" class="form-control" id="companyname" autocomplete="false">
                        </div>

                        <div class="form-group">
                            <label for="pwd">Partner Code </label>
                            <input type="text" name="patnercode" placeholder="Partner Code"  class="form-control" id="patnercode" autocomplete="false">
                        </div>


                    </div>

                    <div class="col-xs-12">
                        <hr />
                        <div class="form-group">

                            <button type="submit" class="btn btn-default submitStandard">Register</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
</div>

<style>

    @import url(http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,300,600,700);

    .submitF {
        height: 37px;
        width: 97% !important;
        border-radius: 5px !important;
    }

    .uploadCO {
        background: #663399;
        outline: none;
        border: none;
        margin-top: -6px;
        font-family: open sans;
        font-size: 13px;
        vertical-align: middle;
        line-height: 12px;
        padding: 12px;
        border-radius: 5px !important;
    }

    .cols3BTN {
        float: left;
        margin-left: 20px;
        width: 96%;
        border-top: solid 1px #e9e8e8;
        padding-top: 20px;
        margin-top: 20px;
    }

    .input-group-addon{
        padding-right:6px;
        padding-left:6px;
    }

    .loginPopup{
        position: absolute;
        z-index: 1;
        background: white;
        height: 59%;
        width: 250px;
        right:4.3%;
        top: 2.7%;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }


    .loginContent{
        width:100%;
        margin: 0 auto;
        text-align: center;
        line-height: 40px;
    }

    .popupTextField{
        width: 80%;
        border-radius: 8px;
        border: 2px solid #E5E5E5;
        outline: 0px none;
        height: 35px;
        font-size: 0.4em;
        padding: 0px 5px;
        color: rgb(0, 175, 240);
        position: relative;
        line-height: 22px;
        font-family: 'PT Sans', sans-serif;
    }

    .FP{
        font-size: 10px;
        color: rgb(0, 175, 240);
        text-align: left;
        text-decoration: none;
        margin-left: 25px;
        margin-top: -10px;
        height: 35px;
        overflow: hidden;
        line-height: 45px;
        font-family: 'PT Sans', sans-serif;
    }

    .remember{
        font-size: 10px;
        color: rgb(0, 175, 240);
        text-align: left;
        text-decoration: none;
        margin: 0 auto;
        text-align: left;
        height: 22px;
        overflow: hidden;
        line-height: 12px;
        width: 80%;
        font-family: 'PT Sans', sans-serif;
    }

    .loginButtonDiv{
        /*height: 3.4vw;
        margin-top: -1vw;*/
    }

    .loginButton{
        background-image: url("../images/loginButton.png");
        background-repeat: no-repeat;
        background-size: 100%;
        font-size: 15px;
        color: white;
        font-family: 'PT Sans', sans-serif;
        line-height: 28px;
        overflow: hidden;
        width: 85px;
        margin: 0 auto;
        cursor: pointer;
    }
    .featureBoxes {
        float:left; width:100%; border-radius:10px;  min-height:90px;
        padding:10px 5px 5px 5px; background:#fff; margin-top:15px; margin-bottom:10px;
    }
    .logo-signUp{float:left; width:100%; padding:25px 0 10px 0; text-align:center;}
    .partnerLogos {
        float:left; width:25%;
        text-align:center;
    }
    .featureBoxes h2 {
        font-family: 'open-sans';
        font-style: normal;
        font-size: 24px;
        font-weight: 600;
        float:left;
        width:100%;
        margin-top:8px;
        margin-bottom:10px;
        text-align:left;
    }
    .priceBtm {
        width:100%;
        max-width:960px;
        text-align:center;
        margin:0 auto;
        margin-top:20px;
    }
    .priceBtm p{float:left; width:100%; text-align:left; color:#fff; margin:0;
        font-family: open-sans, sans-serif;
        font-size: 15px;
        display: inline-block;
        margin-top:5px;
        padding-left:34%;
    }

    .priceBtm img{float:left; margin-top:8px;}

    .priceBtmS {
        width:100%;
        float: left;
        margin-top: 20px;
        padding-bottom: 15px;
    }
    .priceBtmS li{
        float:left; width:100%; text-align:left; color:#333; margin:2px 0;
        font-family: open-sans, sans-serif;
        font-size: 14px;
        padding-left:5%;
    }
    .priceBtmS img{float:left; margin-top:8px;}

    .featureBoxes h2 span{width:auto; margin-right:10px; text-align:left; float:left;}
    .featureBoxes h2 span img{max-width:95%;}
    .featureBoxes p{
        font-family: open-sans, sans-serif;
        font-size: 16px;
        display: inline-block;
        text-align:left;
        color:#626877;
        float:left;
        width:100%;
        margin-top:0;
        margin-bottom:5px;
        min-height:45px;
    }
    .separator{
        font-size: 15px;
        height: 15px;
        margin-top: 0;
        vertical-align: top;
        overflow: hidden;
        line-height: 15px;
        color: #737888;
        font-family: 'PT Sans', sans-serif;
    }
    .registerLanding{float:right;}
    .registerLanding li{float:left; padding-top:20px; padding-right:0;}
    .registerLanding li a {
        float:left; width:120px; border:solid 1px #DBDBDB; color:#22252A; text-align:center; padding:5px 0 5px 0; text-decoration:none; border-radius:4px; font-family:open-sans; text-transform:capitalize; font-size:14px;
    }
    .registerLink a{background:#663399; color:#fff !important;}
    .registerLanding #signIn a:hover{background:#666; color:#fff;}
    .registerLink a:hover{border:solid 1px #663399; background:#4e277a;}
    .bottomText{
        font-family: 'PT Sans', sans-serif;
        font-size: 15px;
        line-height: 15px;
        overflow: hidden;
        height: 45px;
        color: #40b5ec;
        padding-top: 5px;
    }

    .slider{
        width: 100%;
        padding-top: 0;
        position: relative;
        float:left;
    }

    .slider-content{
        width: 100%;
    }
    .topLang{float:left; width:100%; background:#EBEBEB; text-align:right; padding:10px 0;}
    .topLang a {font-size:14px; font-family: advent-pro, sans-serif; float:right; padding:0 2px; color:#663399;}
    .topLang p{float:right; margin:0; padding:0;}
    .topLang img { float:left; margin:4px;}
    .topLang span{float:left; font-family:open-sans; text-transform:capitalize; padding-top: 1px;}
    .slider img{
        width:100%;
    }

    .slider .sliderButton{
        width: 170px;
        float:right; text-align:right;
    }

    .slider-text{
        font-family: advent-pro, sans-serif;
        font-weight: 400;
        font-style: normal;
        font-size: 42px;
        color: white;
        text-align: right;
        line-height: 48px;
    }

    .slider-text b{
        font-size: 56px;
    }

    .slider-text-tagline{
        font-family: 'Alegreya Sans', sans-serif;
        font-weight: 500;
        font-style: normal;
        font-size: 22px;
        color: white;
        text-align: right;
    }


    .button, .button:link, .button:active, .button:visited{
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        font-family: open-sans, sans-serif;
        color: #ffffff;
        font-size: 22px;
        background: #663399;
        padding: 4px 25px;
        text-decoration: none;
    }

    .button_test{

        border-radius: 4px;
        font-family: open-sans, sans-serif;
        color: #ffffff;
        font-size: 22px;
        background: #663399;
        padding: 5px 51px;
        text-decoration: none;
        border: none;
        line-height: 26px;
        padding-top: 6px;
        padding-bottom: 10px;
    }


    .button:hover {
        background: #663399;
        background-image: -webkit-linear-gradient(top, #663399, #4e277a);
        background-image: -moz-linear-gradient(top, #663399, #4e277a);
        background-image: -ms -linear-gradient(top, #663399, #4e277a);
        background-image: -o-linear-gradient(top, #663399, #4e277a);
        background-image: linear-gradient(to bottom, #663399, #4e277a);
        text-decoration: none;
        color: white;
    }

    .main-content{
        width: 100%;
        float:left;
    }

    .main-content .heading{
        font-family: open-sans, sans-serif;
        font-weight: 400;
        font-style: normal;
        text-align: center;
        font-size: 36px;
        padding-top: 20px;
        padding-bottom: 10px;
        color: #234257;
    }

    .main-content .howItWorks{
        margin: 0 auto;
        text-align: center;
        float:left; width:100%;
    }

    .main-content .cols3{
        width: 28%;
        display: inline-block;
        padding: 0px 5px;
        vertical-align: top;
    }

    .main-content .howItWorks .subHeading{
        font-family: 'PT Sans', sans-serif;
        font-style: normal;
        font-size: 24px;
        padding: 10px 0px 15px 0px;
        font-weight: 500;
        margin-bottom: 10px;
        width:70%; margin-left:15%;
        float:left;
        border-bottom:solid 1px #ccc;
    }

    .cols3 .tagline{
        font-family: 'Alegreya Sans', sans-serif;
        font-weight: 400;
        font-style: normal;
        font-size: 18px;
        width:70%; margin-left:15%;
        text-align:center;
    }

    .cols9 a{
        padding-top: 60px;
    }

    .cols9 a:hover {
        color: #fff;
        text-decoration: none;
    }

    .features{
        width: 100%;
        margin: 25px auto 0px;
        text-align: center;
        background-color: #fff;
        padding-bottom:15px;
        float:left;
    }

    .features .heading{
        background:#663399;
        color: white;
        font-family: open-sans, sans-serif;
        font-size: 36px;
        text-align: center;
        padding:30px 0;
    }
    .buyNowButton a{
        color: #fff; text-decoration: none;
    }
    .buyNowButton a:hover{
        color: #fff; text-decoration: none;
    }
    .bgHeading{
        background:#663399;
        color: white;
        font-family: open-sans, sans-serif;
        font-size: 36px;
        text-align: center;
        padding:30px 0;
        float: left;
        width: 100%;
        margin-bottom: 30px;
    }

    .bgHeading2{
        float: left; width: 100%; padding: 50px 0;
    }

    .features .tagline{
        color: white;
        font-family: 'PT Sans', sans-serif;
        font-size: 20px;
        text-align: center;
    }

    .features .cols3{
        width: 28%;
        display: inline-block;
        padding: 0px 15px;
        vertical-align: top;
        margin: 15px auto;
    }

    .features .cols3 img{
        width: auto;
        padding: 0px;
    }


    .offers{
        width: 100%;
        background-color: #663399;
        margin: 0 auto;
        text-align:center;
        float:left;
        margin-bottom:0px;
        min-height: 500px;
    }

    .divFullWidth .offers{
        width: 100%;
        background-color: #f7f7f7;
        margin: 0 auto;
        text-align:center;
        float:left;
        margin-bottom:0px;
        min-height: 500px;

    }

    .pRole{float: left; width: 100%; text-align: center; font-size: 16px;}
    .innerOffer{float: left; width: 80%; margin-left: 10%; margin-bottom: 50px; background: #fff; padding: 30px 0 30px 0; margin-top: 30px;}
    .innerOffer .col-md-6{ padding-left: 8px !important; padding-right: 8px !important;}
    .leftAl span{text-align: left; width: 100%; float: left; font-size: 13px;}
    .rightAl span{text-align: right; width: 100%; float: left; font-weight: 600; font-size: 13px;}

    .offers .circle{
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -o-border-radius: 50%;
        border-radius: 50%;
        border: 4px solid #FFF;
        width:210px;
        height: 210px;
        font-size: 42px;
        color: #FFF;
        text-align: center;
        background: none repeat scroll 0% 0% #663399;
        margin: 0px auto 15px;
    }
    .innerInner{float: left; width: 100%; background: #e6e6e6; margin-top: 30px; display: none;}
    .offers .title{
        font-family: 'Alegreya Sans', sans-serif;
        font-weight: 500;
        font-style: normal;
        font-size: 28px;
        color: #fff;
        padding: 35px 0px 0px 0px;
        text-transform:uppercase;
    }

    .divFullWidth .offers .title{
        font-family: 'Alegreya Sans', sans-serif;
        font-weight: 500;
        font-style: normal;
        font-size: 28px;
        color: #663399;
        padding: 35px 0px 0px 0px;
        text-transform:uppercase;
    }

    .offers .smallText{
        font-family: open-sans, sans-serif;
        font-size: 18px;
        display: inline-block;
        position: relative;
        left: 5.9%;
        margin-right:10px;
    }

    .offers .offerPrice{
        font-family: open-sans, sans-serif;
        font-size: 1.27em;
        display: inline-block;
    }

    .offers hr{
        margin: 0 auto;
        padding: 0px;
    }
    .subScribe1 label{display: none;}
    .divFullWidth hr{
        margin: 0 auto;
        padding: 0px;
        margin: 20px 0;
        float: left; width: 100%;
    }
    .divFullWidth .form-group{margin-top: 45px;}
    .sepSpan{
        font-size: 11px !important;
        width: 75% !important;
        float: right !important;
        font-weight: 400 !important;
        margin-right: 2px;
        color: #999;
        margin-bottom: 20px;

    }
    .offers .desc{
        font-family: open-sans, sans-serif;
        font-size: 15px;
        display: inline-block;
        margin-top: 10px;
        float: left;
        width: 90%; text-align: center;
        margin-left: 5%;
    }
    .desc2{
        font-family: open-sans, sans-serif;
        font-size: 19px;
        display: inline-block;
        margin-top: 80px;
    }
    .logoP{ margin:0 auto; width:95%; max-width:960px; height:75px; padding-top:10px;}
    .partners{
        font-family: open-sans, sans-serif;
        font-weight: 600;
        font-style: normal;
        font-size: 36px;
        text-align: center;
        margin: 0 auto;
        padding-bottom:35px;
    }

    .ourMission{
        text-align: center;
        margin: 0 auto;
        padding-bottom:35px;
    }

    .ourMission .heading{
        background:#663399;
        color: white;
        font-family: open-sans, sans-serif;
        font-size: 36px;
        text-align: center;
        padding:30px 0;
    }

    .ourMission .tagline{
        color: white;
        font-family: 'PT Sans', sans-serif;
        font-size: 20px;
        text-align: center;
    }

    .ourMission .headline{
        font-family: open-sans, sans-serif;
        font-style: normal;
        width: 80%;
        padding-bottom:15px;
        margin: 0 auto;
        color: #23749A;
        font-size: 27px;
        font-weight: bold;
        border-bottom:solid 1px #C2DEEC;
        margin-top:35px;
    }

    .ourMission hr{
        margin-top: 15px;
        margin-bottom: 15px;
        border: 0;
        border-top: 1px solid #9E9494;
    }

    .ourMission .description{
        font-family: 'PT Sans', sans-serif;
        font-weight: 500;
        font-style: normal;
        font-size: 23px;
        width: 80%;
        margin: 0 auto;
        color: #333;
        margin-bottom: 25px;
    }

    .ourMission a:hover{
        text-decoration: none;
        color: #fff;
    }

    .howItWorksDiv{
        margin: 0 auto;
        text-align: center;
        background-color: #663399;
        padding-bottom:40px;
    }

    .howItWorksDiv .heading{
        font-family: open-sans, sans-serif;
        font-weight: 500;
        font-style: normal;
        font-size: 36px;
        color: white;
    }

    .packageTable h3{
        font-size:28px;
        margin-bottom: 0px;
        padding-bottom: 0;
        margin-top: 20px;
        line-height:15px;
        font-family:'Alegreya Sans', sans-serif;
    }
    .howItWorksDiv .description{
        font-family: 'PT Sans', sans-serif;
        font-weight: 500;
        font-style: normal;
        font-size: 23px;
        width: 80%;
        margin: 0 auto;
        color: white;
        margin-bottom: 40px;
    }

    .contactUs{
        margin: 0 auto;
        text-align: center;
        padding-bottom:30px;
        float:left;
        width:100%;
    }

    .contactUs .heading{
        font-family: open-sans, sans-serif;
        font-weight: 500;
        font-style: normal;
        font-size: 36px;
        color: #234257;
        padding-top:30px;
    }

    .contactUs .left{
        width: 60%;
        display: inline-block;
        vertical-align: top;
        float:left;
        margin-top:30px;
    }
    .contactUs iframe{width:100%;}
    .contactUs .mid{
        width: 15%;
        display: inline-block;
        vertical-align: top;
    }
    .contactUs .map{
        width:100%;
        border:solid 2px #eee;
    }

    .contactUs .innerLeft{
        width: 26%;
        text-align: left;
        font-family: 'open-sans', sans-serif;
        display: inline-block;
        font-size: 14px;
        float:left;
        font-weight:600;
        margin-left:40px;
    }

    .contactUs .innerMid{
        width: 9%;
        display: inline-block;
    }

    .contactUs .innerRight{
        width: 23%;
        text-align: left;
        font-family: 'open-sans', sans-serif;
        display: inline-block;
        font-size: 14px;
        margin-left:40px;
        font-weight:600;
        margin-right:20px;
    }
    .contactUs .left h4{float:left;font-weight:600; width:100%; margin-top:25px; border-bottom:solid 1px #eee; font-family: 'open-sans', sans-serif; font-size: 14px; padding-bottom:5px;}
    .contactUs .right{
        width: 320px;
        display: inline-block;
        text-align: left;
        vertical-align: top;
        line-height: 1em;
        padding-left: 0;
        padding-top: 10px;
        margin-bottom: 1vw;
        float:right;
        font-weight:600;
        font-size: 14px;
        font-family: 'open-sans', sans-serif;
    }

    .contactUs .inputDiv{
        float:right;
        width:320px;
        padding: 15px 0 6px 0;
    }
    span.wpcf7-not-valid-tip{ margin-bottom: -9px; font-size:13px; font-weight:normal;}
    div.wpcf7-response-output{ float:left; margin-top:0; }
    .contactUs .textbox, .wpcf7 input {
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
        border: 2px solid #E5E5E5;
        outline:0;
        float:left;
        width:100%;
        line-height:20px;
        font-size: 14px;
        padding: 8px;
        font-family: "open-sans", sans-serif;
        font-weight:400;
    }
    .text-banner {
        float:right;
        margin-top:-370px;
        position:relative;
        z-index:999999;
    }
    .contactUs .textboxLarge, .wpcf7-textarea {
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
        border: 2px solid #E5E5E5;
        outline:0;
        height:140px;
        width: 100%;
        font-size: 14px;
        padding: 8px 5px;
        font-weight:400;
        line-height:25px;
    }

    .contactUs .rightText{
        font-family: 'open-sans', sans-serif;
        text-align: left;
        font-size: 16px;
        color: #74808C;
        line-height:15px;
        margin-top:20px;
        float:left;
        width:100%;
        margin-bottom:7px;
        font-weight:400;
    }

    .contactUs .rightText-bottomMargin{
        font-family: 'open-sans', sans-serif;
        text-align: left;
        font-size: 16px;
        line-height:20px;
        color: #74808C;
        float:left;
        width:100%;
        margin-top:15px;
        margin-bottom:7px;
        font-weight:400;
    }

    .contactUsButton, .wpcf7-submit{
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        font-family: open-sans, sans-serif;
        color: #ffffff;
        font-size: 22px;
        background: #663399;
        padding: 1px 30px;
        border: solid #ffffff 0px !important;
        min-width:110px;
        text-decoration: none;
        float:left;
        line-height:35px;
        font-weight:400;
    }

    .contactUsButton:hover, .wpcf7-submit:hover {
        background: #663399;
        background-image: -webkit-linear-gradient(top, #663399, #4e277a);
        background-image: -moz-linear-gradient(top, #663399, #4e277a);
        background-image: -ms-linear-gradient(top, #663399, #4e277a);
        background-image: -o-linear-gradient(top, #663399, #4e277a);
        background-image: linear-gradient(to bottom, #663399, #4e277a);
        text-decoration: none;
        cursor: pointer;
    }

    .contactUs .submitButton{
        margin: 10px 0;
        float:right;
    }

    .footer{
        background-color: #47494D;
        text-align: center;
        margin: 0 auto;
        color: white;
        font-family: 'PT Sans', sans-serif;
        font-size: 16px;
        float:left;
        width:100%;
    }

    .footer .navBar{
        margin: 0px;
        padding-top:20px;
    }

    .footer .navBarItems{
        display: inline-block;
        color: white;
        padding: 15px;
        font-family: open-sans, sans-serif;
        font-weight: 500;
        font-style: normal;
        font-size: 16px;
    }

    /* -- -- -- -- SIGN UP PAGE -- -- -- -- */
    .topLine{
        height: 8px;
        background-color: #663399;
        overflow: hidden;
    }

    .main-content-SignUp{
        width: 100%;
        margin: 0 auto;
        text-align: center;
        float:left;
        margin-bottom:50px;
    }
    .innSignUp{margin:0 auto; max-width:1110px;}
    .innSignUpInner{
        width:96%; float:left;
        background-color: #fff;
        vertical-align: middle;
        margin: auto auto;
        margin-left:2%;
        text-align: center;
        margin-top: 30px;
        -webkit-box-shadow: 0px 0px 24px -1px rgba(163,163,163,1);
        -moz-box-shadow: 0px 0px 24px -1px rgba(163,163,163,1);
        box-shadow: 0px 0px 10px -1px rgba(163,163,163,1);
        padding: 0px 0 0 60px;

    }
    .compoanyInfo{
        width: 96%;
        margin-left:2%;
        float:left;
    }
    .cols3SU{
        display: inline-block;
        vertical-align: top;
        width: 320px;
        line-height: 35px;
        overflow: hidden;
        float:left;
    }
    .inputDIVSignUp .button-cInfo{margin-top:100px !important;}
    .cols3SUL{
        display: inline-block;
        vertical-align: top;
        width: 280px;
        /*line-height: 3vw;*/
        overflow: hidden;
        float:left;
        margin: 0;
        /*margin-top:85px;*/
        margin-top:0px;
        margin-left: 4px;
    }
    .cols3SULL{
        display: inline-block;
        vertical-align: top;
        width: 400px;
        line-height: 19px;
        overflow: hidden;
        float:right;
        margin: 0;
        background: #663399;
    }
    .successPayment {
        float: left;
        font-size: 20px;
        font-family: open-sans;
        width: 658px;
        font-weight: bold;
        line-height: 30px;
        text-align: left;
        color: #7f8ea0;
        padding-bottom:35px;
    }
    .step2Div {
        float:left;
        width:100%;
        margin-top:15px;
        margin-bottom:30px;
    }
    .innerSt {
        width:900px;
        margin:0 auto;
    }
    .innerSt2 {
        float:left; padding:20px; background:#f9f9f9; border-radius:4px; padding-bottom:0;
    }
    .comInfo1{
        display: inline-block;
        vertical-align: top;
        width: 45%;
        overflow: hidden;
        margin: 0;
    }

    .boxTitle{
        font-family: 'PT Sans', sans-serif;
        text-align: left;
        font-size: 16px;
        color: #74808C;
        overflow: hidden;
        line-height: 20px;
        float:left; width:100%; margin-top:10px;
    }

    .textboxSignUp, inputDIVSignUp select {
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border:1px solid #e5e5e5;
        outline:0;
        height: 38px;
        width: 255px;
        font-size: 14px;
        padding: 7px;
        font-family: open-sans, sans-serif;
        float:left;
        margin-top:5px;
    }

    .textboxSignUp:focus {
        border: 0.2px solid rgba(0, 175, 240,1);
        box-shadow: 0 0 0.2px rgba(0, 175, 240,1);
    }


    .textboxSignUp-user {
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border:1px solid #e5e5e5;
        outline:0;
        height: 38px;
        width: 255px;
        font-size: 14px;
        padding: 0px 7px;
        font-family: open-sans, sans-serif;
    }

    .textboxSignUp-user:focus {
        border: 2px solid rgba(0, 175, 240,1);
        box-shadow: 0 0 0 2px rgba(0, 175, 240,1);
    }


    .inputDIVSignUp{
        margin-bottom: 5px;
        text-align: left;
        padding-left: 18px;
        margin-top:0px !important;
    }

    #showPassword {
        float: right;
        text-align:right;
        width:100%
    }
    .denishL span{color:#999;}
    .englishL span{color:#333;}
    .button-sUP, .button-sUP:link, .button-sUP:active, .button-sUP:visited{
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        font-family: open-sans, sans-serif;
        color: #ffffff;
        font-size: 14px;
        line-height: 10px;
        background: #663399;
        padding: 20px;
        border: solid #ffffff 2px;
        text-decoration: none;
        font-weight: 400;
        margin-top: 10px;
        height: 25px;
        border: none;
        outline: none;
    }

    .button-sUP:hover .button-sUP:focus {
        background: #663399;
        background-image: -webkit-linear-gradient(top, #663399, #4e277a);
        background-image: -moz-linear-gradient(top, #663399, #4e277a);
        background-image: -ms-linear-gradient(top, #663399, #4e277a);
        background-image: -o-linear-gradient(top, #663399, #4e277a);
        background-image: linear-gradient(to bottom, #663399, #4e277a);
        text-decoration: none;
        color: white;
    }

    .margin-top-2vw{
        margin-top: 0;
    }

    .padding-top-sUP{
        padding-top: 40px;
    }

    .sUP .circle{
        -webkit-border-radius: 250vw;
        -moz-border-radius: 250vw;
        -o-border-radius: 250vw;
        border-radius: 250vw;
        border: 0.3vw solid #FFF;
        width: 15vw;
        height: 15vw;
        font-size: 3vw;
        border: 0.24vw solid #fff;
        box-shadow: 0 0 0 0.3vw #663399;
        color: #FFF;
        text-align: center;
        background: none repeat scroll 0% 0% #663399;
        margin: 0px auto 2.7vw;
        line-height: 2vw;
        display:none;
    }

    .sUP .centerText{
        font-family: open-sans, sans-serif;
        font-size: 1em;
        display: inline-block;
        line-height: 3.6vw;
    }

    .sUP .title{
        font-family: 'Alegreya Sans', sans-serif;
        font-weight: 500;
        font-style: normal;
        font-size: 2.7vw;
        color: #663399;
        padding: 0vw 0px 3vw 0px;
    }

    .sUP .smallText{
        font-family: open-sans, sans-serif;
        font-size: 0.72vw;
        display: inline-block;
        position: relative;
        left: 5.9%;
    }

    .sUP .offerPrice{
        font-family: open-sans, sans-serif;
        font-size: 1.27em;
        display: inline-block;
    }

    .sUP hr{
        margin: 0 auto;
        padding: 0px;
        width: 205px;
    }


    .sUP .desc{
        font-family: open-sans, sans-serif;
        font-size: 1.14vw;
        display: inline-block;
    }

    .signUpLogin {
        float: right;
        width: 110px;
        border: solid 1px #DBDBDB;
        background: #663399;
        color: #fff;
        text-align: center;
        padding: 8px 0 9px 0;
        text-decoration: none;
        border-radius: 4px;
        font-family: 'Open Sans';
        text-transform: capitalize;
        font-size: 14px;
        margin:18px 0 -50px 0;
    }
    .signUpLogin:hover{border: solid 1px #663399;
        background: #4e277a; color:#fff;}
    .sUP .packageTable{
        border-radius:0;
        overflow: hidden;
        margin: 0 auto;
        text-align: center;
        color: white;
        font-family: 'PT Sans', sans-serif;
        margin-top:0px;
        width:60%; margin-left:20%;
        border:solid 3px #fff;
        border-radius:30px;
        margin-top:23px;
        margin-bottom:23px;
        line-height:28px;
        padding-bottom:15px;
    }
    .singnUpBTM{float:left; width:100%; background:#0181B4;}
    .singnUpBTM h3{ float:left; width:100%; text-align:center; line-height:45px; margin-top:20px; font-size:28px; font-family: advent-pro, sans-serif; color:#fff;}
    .singnUpBTM h2{ float:left; width:100%; text-align:center; font-size:35px; font-weight:normal; font-family: advent-pro, sans-serif; color:#fff;}
    .singnUpBTM h2 strong{font-weight:bold;}
    .singnUpBTM p{font-size:14px; float:left; width:90%; margin:20px 0 0 5%; border-top:solid 1px #06709A; padding:14px 0; font-family:'Open Sans'; color:#fff; line-height:22px;}
    .packageTextContainer{
        width:85%;
        margin: 0 auto;
        height: auto;
        overflow: hidden;
    }

    .goLeft{
        float: left;
    }

    .goRight{
        float: right;
    }

    .headingPrice{
        font-size: 18px;
        text-align: center;
    }

    .textBelow{
        font-size: 12px;
    }

    .textBelow2{
        font-size:12px;
        width:120px;
        line-height:14px;
        text-align:left;
        padding-bottom:8px;
    }
    .textBelow2{
        font-size:12px;
        width:120px;
        line-height:14px;
        text-align:left;
        float:left;
        padding-bottom:8px;
    }

    .textBelow3{
        font-size:12px;
        width:120px;
        text-align:left;

    }


    .loginPopupSignUp{
        position: absolute;
        z-index: 1;
        background:rgb(244, 246, 255);
        height: 1858%;
        width: 250px;
        right: 2.3%;
        top: 98.7%;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
    }

    .height18 {
        display: block;
        font-family: 'PT Sans', sans-serif;
        font-size: 12px;
        color: red;
        height: 0;
        line-height: 18px;
    }
    #pwdImage{width:18px !important; margin:-28px 15px 0 0; float:right;}
    .headingLine {
        font-family: "Alegreya Sans", sans-serif;
        font-size: 22px;
        color: #4BEAFF;
        position: absolute;
        padding-top: 12px;
        padding-left: 20px;
        width: 700px;
    }

    .loadingScreen{
        /*position: absolute;
        width: 100%;
        height: 48vw;
        top: 0px;
        bottom: 0px;
        right:0px;
        display: block;
        background: rgba(0, 0, 0, 0.4);*/

        position: fixed;
        width: 100%;
        height: 100%;
        right: 0px;
        top: 0px;
        display: block;
        background: rgba(0, 0, 0, 0.4);
    }
    .loadingScreenInc{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0px;
        bottom: 0px;
        display: block;
        background: rgba(0, 0, 0, 0.4);
    }
    /* -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */


    /* -- -- -- -- Verified before Login Screen -- -- -- -- */
    .verifyBox{
        vertical-align: middle;
        width: 29%;
        text-align: center;
        height: 200px;
        background: rgba(255, 255, 255, 0.9);
        margin: 120px auto;
        padding-top: 25px;
    }

    .vLHeading{
        font-family: 'PT Sans';
        font-size: 28px;
        font-weight: 700;
        margin: 10px auto;
        color: #663399;
    }

    .vLSubHeading{
        font-family: 'PT Sans', sans-serif;
        color: #663399;
        font-size: 20px;
        font-weight: 700;
    }

    .login-main{
        width:100%;
        text-align:center;
        margin-top:95px;
    }

    .logo-registration2{
        width:100%;
        text-align:center;
        margin-top:30px;
    }

    .login-box{
        width:529px;
        background-color:#F90;
        height:294px;
        vertical-align: middle;
        margin: auto auto;
        text-align:center;
        margin-top:57px;
        -webkit-box-shadow: 0px 0px 24px -1px rgba(163,163,163,1);
        -moz-box-shadow: 0px 0px 24px -1px rgba(163,163,163,1);
        box-shadow: 0px 0px 24px -1px rgba(163,163,163,1);
        padding:52px;
        background-color:#FFF;
    }
    .laba_log {
        font-family:Arial; font-size:14px; margin-top:5px;
    }

    .login-bottom{
        padding-top:5px;

    }

    .not-member{
        float:left; padding-left:45px;
    }

    .join-now{
        float:right; padding-right:50px; padding-bottom:50px; padding-top:5px;
    }

    /*~~~~~~~~~ SIGN IN PAGE STYLING ~~~~~~~~~~~*/

    .signInBg{
        width: 1050px;
        height: 600px;
        /*background: url(../images/slide1.jpg);*/
        background-repeat: no-repeat;
        background-size: 130%;
        background-position: 0 0;
        vertical-align: middle;
        text-align: center;
        display: table-cell;
    }

    .forgotBg{
        width: 100%;
        padding-top:95px;
        /*background: url(../images/slide1.jpg);*/
        background-repeat: no-repeat;
        background-size: 130%;
        background-position: 0 0;
        vertical-align: middle;
        text-align: center;
        display: table-cell;
        float:left;
    }

    .signInBg2{
        background:#fcfcfc;
        margin-bottom:50px;
    }

    .signInBox{
        vertical-align: middle;
        width: 29%;
        text-align: center;
        height: 250px;
        background: rgba(255, 255, 255, 0.9);
        margin: auto auto;
        padding-top: 20px;
    }

    .textboxSignIn{
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 1px solid #CFCFCF;
        outline: 0;
        width: 78%;
        font-size: 14px;
        padding: 7px;
        font-family: open-sans, sans-serif;
        margin-top: 10px;
        line-height:normal;
    }

    .pwdboxSignIn{
        border-radius: 5px;
        border: 0.2px solid #CFCFCF;
        outline: 0;
        height: 35px;
        width: 70%;
        font-size: 12px;
        padding: 0px 5px;
        font-family: open-sans, sans-serif;
        margin-top: 12px;
        vertical-align: middle;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .signInButton{
        background: #00a2de;
        background-image: -webkit-linear-gradient(top, #00a2de, #663399);
        background-image: -moz-linear-gradient(top, #00a2de, #663399);
        background-image: -ms-linear-gradient(top, #00a2de, #663399);
        background-image: -o-linear-gradient(top, #00a2de, #663399);
        background-image: linear-gradient(to bottom, #00a2de, #663399);
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        color: #ffffff;
        font-family: open-sans, sans-serif;
        font-size: 16px;
        text-decoration: none;
        outline: none;
        width: 78%;
        padding-top: 10px;
        padding-bottom: 10px;
        margin-top: 10px;
        border: none;
    }

    .signInButton:hover {
        background: #663399;
        background-image: -webkit-linear-gradient(top, #663399, #00a2de);
        background-image: -moz-linear-gradient(top, #663399, #00a2de);
        background-image: -ms-linear-gradient(top, #663399, #00a2de);
        background-image: -o-linear-gradient(top, #663399, #00a2de);
        background-image: linear-gradient(to bottom, #663399, #00a2de);
        text-decoration: none;
    }

    .signInBox label{
        font-size: 12px;
        width: 100%;
        text-align: center;
        margin: 12px auto;
        font-family: 'PT Sans', sans-serif;
    }

    .signInFP{
        width: 8%;
        height: 35px;
        vertical-align: middle;
        background: white;
        margin-top: 12px;
        border-left: none;
        border: 2px solid #CFCFCF;
        border-left-width: 0;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        font-family: 'PT Sans', sans-serif;
        font-size: 15px;
        outline: none;
        line-height: 35px;
        display: inline-block;
        cursor: pointer;
    }

    .signInFP strong{line-height: 20px;}
    .signInFP:hover{text-decoration:none;}

    .signInFP span{
        z-index: 10;
        display: none;
        padding: 10px 15px;
        margin-top: 0;
        margin-left: 10px;
        width: 200px;
        line-height: 1px;
        font-size: 14px;
        cursor: default;
    }

    .signInFP:hover span{
        display:inline; position:absolute; color:#111;
        border:1px solid #DCA; background:#fff;margin-top: 0;
    }

    /*CSS3 extras*/
    .warningMessage{
        position: absolute;
        margin: 20px auto 0;
        text-align: center;
        left: 27.3vw;
        width: 45.5vw;
        font-family: 'Alegreya Sans', sans-serif;
        font-size: 1.2vw;
    }
    .signUpHeading{float:left; width:100%; text-align:center; font-family:open-sans; color:#727272; font-size:28px; padding-bottom: 1px;}

    /* ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ---- Forgot Password Client ---- ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ */

    .fpText{
        font-family: open-sans, sans-serif;
        width: 29vw;
        margin: 0 auto;
        font-size: 1.3vw;
        line-height: 2vw;
        color: #747d86;
        margin-top: 0vw;
    }

    /*COMPANY INFORMATION PAGE*/

    .stepsDiv{
        margin-left: -24vw;
        margin-top: 2vw;
        margin: 150px auto 0 auto;
        max-width: 890px;
        border-bottom: solid 1px #e9e9e9;
        padding-bottom: 10px;
    }

    .stepsDiv-registration2{
        margin-left: -24vw;
        margin-top: 2vw;
        margin: 32px auto 0 auto;
        max-width: 890px;
        padding-bottom: 10px;
    }

    .stepsDiv-registration2-dahboard{
        margin-left: -24vw;
        margin-top: 2vw;
        margin:auto 0 auto;
        max-width: 890px;
        padding-bottom: 10px;
        padding-left: 72px;
        padding-top:20px;
    }

    .success-image {
        float: left; margin-left: 10px; padding-right:10px; padding-top:4px;/* text-align: center; */
    }

    .stepsDiv h3 {
        margin:0;
        padding:0;
        font-family:'Alegreya Sans', sans-serif;
        font-size:36px;
        text-align:left;
    }

    .inputDIVCompanyInfo{
        margin-bottom: 1vw;
        text-align: left;
        float:left; width:100%;
    }

    .headingDiv{
        height: 1.3vw;
        line-height: 1vw;
        text-align: left;
        font-weight: 600;
        margin-bottom: 1vw;
    }

    .cols3CI{
        display: inline-block;
        vertical-align: top;
        width: 430px;
        line-height: 3vw;
        overflow: visible;
        color: #717171;
        float:left;
    }

    .infoHeading{
        font-family: open-sans, sans-serif;
        font-size: 1.2vw;
        color: #7F8E9F;
    }

    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        background: red;
        cursor: inherit;
        display: block;
    }
    input[readonly] {
        cursor: text !important;
        outline: none;
    }



    .uploadButton{
        background: #663399;
        outline: none;
        border: none;
        height: 2vw;
        font-family: 'PT Sans', sans-serif;
        font-size: 0.9vw;
        vertical-align: middle;
        line-height: 1vw;
        padding: 0.4vw;
    }

    .uploadButton:hover{
        background: #03A3DF;
        outline: none;
        border: none;
    }

    #uploadLoc{
        border: 0.11vw solid #EAEAEA;
        outline: 0;
        height: 2vw;
        width: 10.8vw;
        font-size: 0.8vw;
        padding: 0px 0.5vw;
        font-family: open-sans, sans-serif;
        line-height: 1.3vw;
        margin-top: 0.4vw;
    }

    #uploadLoc:focus{
        outline: 0;
        text-decoration: none;
    }

    .subHeadingComapnyInfo{
        font-family: open-sans, sans-serif;
        font-size: 1vw;
        line-height: 1vw;
        font-weight: 400;
        font-style: italic;
        display: inline-block;
    }

    input[type=date]{

    }

    input[type=date]::-webkit-inner-spin-button{
        display:none;
    }
    input[type=date]::-moz-inner-spin-button{
        display:none;
    }
    input[type=date]::-o-inner-spin-button{
        display:none;
    }

    .inputB .button-cInfo{
        color:#FFF !important;
        font-size:18px;
    }
    a:focus{outline:none !important;}
    .button-cInfo, .button-cInfo:link, .button-cInfo:visited{
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
        font-family: open-sans, sans-serif;
        color: #ffffff;
        font-size: 22px;
        vertical-align: middle;
        background: #663399;
        padding: 8px 25px;
        text-decoration: none;

        line-height: 22px;
        border: none;
        height: auto;
        outline: none;
    }

    .button-cInfo:hover, .button-cInfo:focus {
        background: #663399;
        background-image: -webkit-linear-gradient(top, #663399, #4e277a);
        background-image: -moz-linear-gradient(top, #663399, #4e277a);
        background-image: -ms-linear-gradient(top, #663399, #4e277a);
        background-image: -o-linear-gradient(top, #663399, #4e277a);
        background-image: linear-gradient(to bottom, #663399, #4e277a);
        text-decoration: none;
        color: white;
    }


    /* -- -- -- -- Verify Screen -- -- -- -- */

    .information-verify{
        margin: 35px 17vw;
        font-family: 'Alegreya Sans', sans-serif;
        font-size: 20px;
        font-weight: 400;
        line-height:25px;
    }

    .smallInformation{
        margin-top: 5vw;
        font-size: 1vw;
    }

    /* Added by Abdul Mateen Arif For Crop Images Functionality */
    .imageBox
    {
        position: relative;
        height: 310px;
        width: 380px;
        border:1px solid #aaa;
        background: #fff;
        overflow: hidden;
        background-repeat: no-repeat;
        cursor:move;
    }

    .imageBox .thumbBox
    {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 200px;
        height: 200px;
        margin-top: -100px;
        margin-left: -100px;
        box-sizing: border-box;
        border: 1px solid rgb(102, 102, 102);
        box-shadow: 0 0 0 1000px rgba(0, 0, 0, 0.5);
        background: none repeat scroll 0% 0% transparent;
    }

    .imageBox .spinner
    {
        position: absolute;
        top: -50px;
        left: 0;
        bottom: 0;
        right: 0;
        text-align: center;
        line-height: 400px;
        background: rgba(0,0,0,0.7);
    }
    .resMenu{display:none; float:right; margin:18px 0px 0 10px; cursor:pointer;}
    .resMenu img{width:38px;}
    .signupUpper{float:left; width:575px; margin-top:80px;}
    .submitBtn{float:right;margin-right:8px;}
    @media screen and (max-width: 1100px) {
        .innSignUpInner{padding-left:30px;}
        .cols3SULL{width:320px;}
        .sUP .packageTable{width:80%; margin-left:10%;}
    }
    @media screen and (max-width: 1024px) {
        .text-banner {
            margin-top:-270px;
        }
        .logo {
            margin-top:15px;
        }
        .slider-text-tagline{font-size:16px;}
        .offers hr{width:100%;}
        .main-content-SignUp{width:98%; margin-left:1%;}
        .innSignUpInner{padding-left:20px;}
        .cols3SUL{width:250px;}
        .sUP hr{width:90%;}
        .inputDIVSignUp{padding-left:10px;}
        .innSignUpInner{padding-left:0px;}
        .textboxSignUp, inputDIVSignUp select{width:98%;}
        .signupUpper{ width:520px;}

    }


    .featureBoxes {min-height:150px;}
    .container{width:100%}
    .nav-item{padding-right:10px; padding-left:10px;}

    @media screen and (max-width: 960px) {
        .registerLanding li a { width:100px;
        }
        .nav-item { padding-left:5px;
        }
        #navigation { margin-left:20px;
        }
        .logo img{ width:140px; margin-top:5px;
        }
    }
    @media screen and (max-width: 910px) {
        .signupUpper{float:none; margin:0 auto; margin-top:30px;}
        .cols3SULL{width:350px; float:none; margin:0 auto; margin-top:30px;}
    }
    @media screen and (max-width: 810px) {

        #navigation {
            display:none;
            width: 200px;
            position: absolute;
            z-index: 99999999;
            background: #333; right:15px; top:95px;
        }
        #navigation li {
            padding:10px 0; float:left; width:100%; text-align:center; border-bottom:solid 1px #999;
        }
        #navigation a{float:left; color:#fff; width:100%; }
        #navigation a:hover{ color:#ccc;}
        .resMenu{display:block;}
        .logo {
            margin-top:20px;
        }
        .text-banner { margin-top:-220px;
        }
        .featureBoxes sub{ float:left; width:100%; margin-top:0; margin-top:10px; line-height:18px; font-size:14px;}
        .featureBoxes p { font-size:14px;    }
        .contactUs .left { width:100%;    }
        .contactUs .right { float:left; width:80%; margin-left:10%; }
        .contactUs .right input[type=text]{ width:100%; }
        .contactUs .inputDiv{width:100%;}
        .features .tagline, .ourMission .tagline, .cols3 .tagline, .footer .navBarItems, .footer, .ourMission .description
        {font-size:16px;}
        .slider-text b{font-size:42px;}
        .slider-text{font-size:32px;}
        .featureBoxes{min-height:180px; margin-top:0;}
        .features .cols3 { padding: 0 10px;}
        .buyNowButton{font-size:18px;}
        .partnerLogos{max-width:95%;}
        .partnerLogos img{max-width:90%;}
        .ourMission .heading, .contactUs .heading, .partners .heading, .main-content .heading{font-size:24px;}
        .features .cols3{width:31%;}
        .padding-top-36{padding-top:20px;}
        .main-content .howItWorks .subHeading{font-size:20px; width:94%; margin-left:3%;}
        .cols3 .tagline{width:100%; margin:0 0 0 0;}
        .features .cols3{ margin-bottom:10px;}
        .offers .cols3{ width:48%; }

    }

    @media screen and (max-width: 668px) {
        .featureBoxes p {
            font-size: 12px;
        }
    }

    @media screen and (max-width: 600px) {
        .text-banner {
            margin-top: -180px;
        }
        .slider-text b{font-size:32px;}
        .slider-text{font-size:22px;}
        .main-content .howItWorks .subHeading{font-size:18px; padding-bottom:10px;}
        .slider-text p{ margin-bottom:0px; line-height:30px;}
        .slider-text-tagline{margin-bottom:10px;}
        .login-box{max-width:96%; padding:40px 10px; height:auto;}
        .login-main{margin-top:40px !important;}
        .login-logo img{width:180px;}
        .signupUpper{width:320px;}
        .cols3SUL{width:100%;}
        .inputDIVSignUp .button-cInfo{margin-top:20px !important;}
    }

    @media screen and (max-width: 415px) {
        .logo img{ width:120px;
        }
        .registerLanding{float:right; position:absolute; top:-14px; right:15px;}
        .registerLanding li{padding:20px 0px 0 5px;}
        .registerLanding li a{width:80px; font-size:13px; padding:2px 0; border:solid 1px  #999;}
        .button, .button:link, .button:active, .button:visited{font-size:15px; padding:4px 10px;}
        .text-banner{margin-top:-135px;}
        .main-content .cols3{width:80%; margin-left:0; margin-top:0px;}
        .ourMission .heading, .contactUs .heading, .partners .heading, .main-content .heading{font-size:20px;}
        .featureBoxes sub{width:auto;}
        .featureBoxes p{line-height:20px;}
        .featureBoxes{min-height:60px; padding-bottom:0; padding-top:0;}
        .offers .cols3{width:48% !important;}
        .features .cols3{margin-top:0; margin-bottom:0;}
        .priceBtm p{padding-left:10%;}
        .contactUs .innerLeft{width:90%; margin-left:0%;}
        .contactUs .innerRight{width:94%; margin-left:0%;}
        .topLang p{float:left;}
        #signIn a{ border:solid 1px #999;}
        .resMenu{margin-top:15px; margin-bottom:15px;}
        #solutions .heading{margin-top:15px; font-size:18px;}
        .featureBoxes{margin-bottom:0; margin-top:10px;}
        .contactUs .heading{padding-top:10px;}
        #solutions img{width:55px; margin-top:10px;}
        #features{margin-top:15px;}
        .ourMission .description{width:90%;}
        .contactUs .left h4 {font-size:16px;}
        .contactUs .right{width:100%; margin-left:0;}
        .features .heading {
            margin-bottom:20px;
        }
        .featureBoxes p { min-height:20px;
        }
        .contactUs{margin-top:20px;}
        .footer{font-size:14px;}
        .contactUsButton {font-size:18px; }
        .contactUs .textbox{padding:5px;}
        .contactUs .rightText{margin-top:15px;}
        .contactUs .textboxLarge{height:120px;}
        .offers .circle{width:135px; height:135px; border:solid 2px #fff;}
        .offers .title{font-size:24px;}
        .offers .desc{font-size:12px; float:left; width:100%; text-align:center;}
        .offers .offerPrice{font-size:28px;}
        .offers .smallText{margin-right:0; margin-left:-10px;}
        .padding-top-36 {padding-top:5px;}
        .desc2{font-size:14px; margin-top:40px;}
        .slider-text b{font-size:20px;}
        .slider-text{font-size:16px;}
        .slider-text p{line-height:20px;}
        .slider-text-tagline p{margin-bottom:0;}
        .footer .navBarItems{padding:7px; font-size:14px;}
        .cols3SULL{width:300px;}
        .singnUpBTM h2 {
            font-size: 28px;
        }
        .singnUpBTM h3{font-size:26px;}
        .textboxSignUp, .inputDIVSignUp select{width:96%;}
        .submitBtn{float:left; margin-top:-6px !important;}

    }
    @media screen and (max-width: 320px) {
        .text-banner{ margin-top:-100px;}
        .topLang a{font-size:12px;}
        .slider-text-tagline{display:none;}
        .slider-text{margin-bottom:10px;}
        .offers .cols3{padding:5px;}
    }
</style>




<script type='text/javascript' src="http://mallappbackend.zap-itsolutions.com/global/scripts/jquery.validate.min.js"></script>
<?php get_footer(); ?>
