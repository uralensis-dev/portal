<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style type="text/css">
    .header {
        display: none
    }

    .content {
        padding: 0
    }
    .eye_statement {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
    }
    

    .sticky-queue {
        margin-top: 0;
    }

    .sticky-note {
        padding: 10px !important;
    }
    .cust_tooltip{
        float: right;
        padding: 15px 25px;
    }
    .cust_tooltip .fa{
        position: relative;
        left: unset;
        right: unset;
        top: unset;
        color: #777
    }
    .sticky-close {
        top: 12px !important;
    }

    .important {
        background: #777777 !important;
    }
    .eye_statement p{
        margin-bottom:10px;
    }
    .checkbox-wrap {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        margin-top:15px;
    }
    .checkbox-primary {
        color: 717375;
    }
    .checkbox-wrap input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
    }
    .checkmark:after {
        content: "\f0c8";
        font-family: "FontAwesome";
        position: absolute;
        color: rgba(0, 0, 0, 0.1);
        font-size: 25px;
        margin-top: -4px;
        -webkit-transition: 0.3s;
        -o-transition: 0.3s;
        transition: 0.3s;
        line-height: 1.25;
    }
    .checkbox-wrap input:checked ~ .checkmark:after {
        display: block;
        content: "\f14a";
        font-family: "FontAwesome";
        color: rgba(0, 0, 0, 0.2);
    }
    .checkbox-primary input:checked ~ .checkmark:after {
        color: #0075f6;
    }
    .live_logo{
        max-width: 300px;
        margin: 0 auto 15px;
    }
    .login_wrap  .pwd_toggle {
        left: 90%;
        cursor: pointer;
    }
</style>
<main>

    <div class="login_wrap">
        <div class="login_wrap2" style="padding: 20px 40px 20px; max-height: 540px; overflow-y: auto;">
           
            <div class="live_logo">
                <img src="<?php echo base_url()?>assets/img/live_login_logo.jpg-removebg-preview.png" alt="" style="max-width: 70%;" class="img-responsive img-fluid">
            </div>
           
            <div id="infoMessage"><?php echo html_purify($message); ?></div>

            <!-- Account Form -->
            <?php
            $attributes = array('id' => 'wizard', 'class' => 'uralensis_login_form');
            echo form_open("auth/login", $attributes);
            ?>
            <div>
                <div class="sticky-queue" style="top: 7px !important; right: 75px !important; width: 315px;"></div>
                <h3>Step 1</h3>
                <section>
                    <div class="form-group">
                        <span><i class="fa fa-user"></i></span>
                        <?php echo form_input($identity, '', 'class="form-control" placeholder="Email Address"'); ?>
                    </div>
                    <div class="form-group">
                        <span><i class="fa fa-lock"></i></span>
                        <span><i class="fa fa-eye pwd_toggle fa-eye-slash"></i><!--<i class="fa fa-eye pwd_toggle"></i> --> </span>
                        <?php echo form_input($password, '', 'class="form-control"   placeholder="Password" '); ?>
                       
                    </div>
                </section>
                <h3>Step 2</h3>
                <section>
                    <div class="form-group">
                        <?php $random = mt_rand(1, 10); ?>
                        <?php echo form_input($memorable1, '', 'class="form-control" placeholder="Enter Memorable Word - Letter: ' . $random . '" maxlength="1" size="1"'); ?>
                        <input type="hidden" value="<?php echo $random; ?>" name="mem" id="mem">
                    </div>
                    <div class="form-group">
                        <?php

                        function generateRandomNumber($random)
                        {
                            $random2 = mt_rand(1, 10);
                            if ($random === $random2) {
                                $random2 = generateRandomNumber($random);
                            }
                            return $random2;
                        }

                        $random2 = generateRandomNumber($random);
                        ?>
                        <?php echo form_input($memorable2, '', 'class="form-control" placeholder="Enter Memorable Word - Letter: ' . $random2 . '" maxlength="1" size="1"'); ?>
                        <input type="hidden" value="<?php echo $random2; ?>" name="mem2" id="mem2">

                    </div>
                </section>
                <h3>Step 3</h3>
                <section>
                    <div class="form-group">
                        <?php echo form_input($auth_token, '', 'class="form-control" placeholder="PathHub token sent to registered email:" maxlength="5" size="1"'); ?>
                        <input type="hidden" value="<?php echo $random; ?>" name="mem" id="mem">

                    </div>
                    <div class="form-group">
                    <div class="row">
                        <div class="col-md-8">
                            <label class="checkbox-wrap checkbox-primary">Trust this computer
                                <input type="checkbox" name="remember_this_access" id="remember_this_access">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <div class="cust_tooltip login">
                                <!-- <i class="fa fa-eye" data-toggle="tooltip" title="Memorable word and token remembered for one month"></i> -->
                                <i class="fa fa-eye" data-toggle="collapse" data-target="#eye_statement"></i>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12 collapse" id="eye_statement">
                            <div class="eye_statement">
                               <!--  <p><strong>Your trusted computer don't ask for a verification code every time you sign in.</strong></p>
                                <p>If you lose your phone. you might be able to access your account from a trusted computer without needing a code. We recommend that you make this trusted computer only if you trust peoples who have access to it.</p> -->
                                <p>If you trust this computer then check the box and a verification code will not be required every time you sign in for up to one month.</p>
                                <p style="margin-bottom: 0">We recommend that you make this a trusted computer only if you trust the people who may have access to it.</p>
                            </div>
                        </div>
                        
                    </div>
                </div>

                </section>


                <?php echo form_close(); ?>
            </div>
            <br>
            <div class="text-center">PathHub version 6.0</div>
        </div>
        <div class="pathhub">
            <a class="pathub_a" target="_blank" href="https://www.pathhub.com">
                Uralensis Innov8
            </a>
        </div>
    </div>

 