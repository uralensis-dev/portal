/* trigger when page is ready */
$(document).ready(function (e) {
    $(".init_pin input").jqueryPincodeAutotab();
});
$(document).ready(function () {
    function passwordValidation() {
        var prepass = $("#prepass").val();
        var newpassword = $("#newpassword").val();
        var confirmpassword = $("#confirmpassword").val();
        var user_id = $("#user_id").val();
        var passStatus = Number($("#password_status").val());
        var error = 0;
        var prepassbit = 0;
        var newpassbit = 0;
        var confirmpassbit = 0;
        if (prepass == "") {
            error++;
            $("#prepass").parent().addClass("custom-error");
            $("#prepass").parent().removeClass("custom-success");
        } else {
            prepassbit = 1;
            $("#prepass").parent().removeClass("custom-error");
            $("#prepass").parent().addClass("custom-success");
        }

        if (newpassword == "" || passStatus == 0) {
            error++;
            $("#newpassword").parent().addClass("custom-error");
            $("#newpassword").parent().removeClass("custom-success");
        } else {
            newpassbit = 1;
            $("#newpassword").parent().removeClass("custom-error");
            $("#newpassword").parent().addClass("custom-success");
        }
        if (confirmpassword == "") {
            error++;
            $("#confirm_span").hide();
            $("#confirmpassword").parent().addClass("custom-error");
            $("#confirmpassword").parent().removeClass("custom-success");
        } else if (confirmpassword != newpassword) {
            error++;
            $("#confirm_span").show();
            $("#confirmpassword").parent().addClass("custom-error");
            $("#confirmpassword").parent().removeClass("custom-success");
        } else {
            $("#confirm_span").hide();
            $("#confirmpassword").parent().removeClass("custom-error");
            $("#confirmpassword").parent().addClass("custom-success");
        }
        $("#prepass_span").hide();
        $("#pass_span").hide();
        $.ajax({
            type: "POST",
            url: _base_url + '/auth/checkpassword',
            data: $("#update_password_form").serialize() + "&prepassbit=" + prepassbit + "&newpassword=" + newpassbit,
            dataType: "json",
            success: function (response) {
                if (response.prepassbit == 1) {
                    $("#prepass").parent().removeClass("custom-error");
                    $("#prepass").parent().addClass("custom-success");
                    $("#prepass_span").hide();
                } else if (response.prepassbit == 0) {
                    $("#prepass").parent().addClass("custom-error");
                    $("#prepass").parent().removeClass("custom-success");
                    $("#prepass_span").show();
                    $("#prepass_span").text(response.premessage);
                }
                if (response.passbit == 1) {
                    $("#newpassword").parent().removeClass("custom-error");
                    $("#newpassword").parent().addClass("custom-success");
                    $("#pass_span").hide();
                } else if (response.passbit == 0) {
                    $("#newpassword").parent().addClass("custom-error");
                    $("#newpassword").parent().removeClass("custom-success");
                    $("#pass_span").show();
                    $("#pass_span").text(response.passmessage);
                }
            }
        });
        return error === 0;
    }

    function pinValidation() {
        var error = 0;
        var pin_status = Number($("#pin_status").val());
        // var current_pin = $("#pre_pin").val();
        var prePin = $("#current_pin_code").val();
        if($(".pre_pin")[0]){
            var current_pin = "";
            $(".pre_pin").each(function (index,obj) {
                current_pin += $(this).val();
            });
            if (current_pin != prePin || current_pin=="") {
                error++;
                $(this).parent().addClass("custom-error");
                $(this).parent().removeClass("custom-success");
                var textS = (current_pin==""?"Pre PIN is required":"Pre PIN in incorrect");
                $("#pin_span").text(textS);
                $("#pin_span").show();
            } else {
                $(this).parent().removeClass("custom-error");
                $(this).parent().addClass("custom-success");
                $("#pin_span").hide();
            }
        }
        var user_pin = "";
        // if(thisClass=="user_pin"){
            $(".user_pin").each(function (index,obj) {
                user_pin += $(this).val();
            });
            if (user_pin=="") {
                error++;
                $(this).parent().addClass("custom-error");
                $(this).parent().removeClass("custom-success");
                $("#user_pin_span").show();
            } else {
                $(this).parent().removeClass("custom-error");
                $(this).parent().addClass("custom-success");
                $("#user_pin_span").hide();
            }
        // }

        var confirm_user_pin = "";
        // if(thisClass=="confirm_user_pin"){
            $(".confirm_user_pin").each(function (index,obj) {
                confirm_user_pin += $(this).val();
            });
            if (confirm_user_pin=="") {
                error++;
                console.log("testing aaa");
                $(this).parent().addClass("custom-error");
                $(this).parent().removeClass("custom-success");
                $("#confirm_user_pin_span").text("Confirm PIN is required");
                $("#confirm_user_pin_span").show();
            } else if(confirm_user_pin!=user_pin) {
                error++;
                console.log("testing  ss");
                $(this).parent().addClass("custom-error");
                $(this).parent().removeClass("custom-success");
                $("#confirm_user_pin_span").text("Confirm PIN not matched with PIN");
                $("#confirm_user_pin_span").show();
            } else {
                console.log("testing");
                $(this).parent().removeClass("custom-error");
                $(this).parent().addClass("custom-success");
                $("#confirm_user_pin_span").hide();
            }
        console.log(confirm_user_pin);
        console.log(user_pin);

        // }

        if(error===0){
            return true;
        } else {
            return false;
        }
    }

    $(".pr-password").passwordRequirements({});

    $("#prepass,#newpassword,#confirmpassword").on("change keyup", function () {
        passwordValidation();
    });

    $(".check_password").on("keyup", function () {
        var getId = $(this).attr("id");
        var getVal = $(this).val();
        if (getId == "password_confirm") {
            var password = $("#password").val();
            if (getVal != password) {
                $("#user-create-btn").prop('disabled', true);
                $(this).parent().addClass("custom-error");
                $(this).parent().removeClass("custom-success");

                $("#confirm_span").show();
            } else {
                $("#user-create-btn").prop('disabled', false);
                $(this).parent().removeClass("custom-error");
                $(this).parent().addClass("custom-success");


                $("#confirm_span").hide();
            }
        } else {
            var passwordStatus = Number($("#password_status").val());
            if (passwordStatus != 1) {
                $("#user-create-btn").prop('disabled', true);
                $(this).parent().addClass("custom-error");
                $(this).parent().removeClass("custom-success");
            } else {
                $("#user-create-btn").prop('disabled', false);
                $(this).parent().removeClass("custom-error");
                $(this).parent().addClass("custom-success");
            }
        }
    });
    

    $(".email_check").on("keyup", function () {
        var getId = $(this).attr("id");
        var getVal = $(this).val();
        console.log(getId);
        if (getId == "email_confirm") {
            var email = $("#email").val();
            console.log(getVal + " ===> " + email);
            if (getVal != email) {
                $("#user-create-btn").prop('disabled', true);
                $(this).parent().addClass("custom-error");
                $(this).parent().removeClass("custom-success");

                $("#email_confirm_span").show();
            } else {
                $("#user-create-btn").prop('disabled', false);
                $(this).parent().removeClass("custom-error");
                $(this).parent().addClass("custom-success");


                $("#email_confirm_span").hide();
            }
        } else {
            // var passwordStatus = Number($("#email_status").val());
            // if (passwordStatus != 1) {
            //     $("#user-create-btn").prop('disabled', true);
            //     $(this).parent().addClass("custom-error");
            //     $(this).parent().removeClass("custom-success");
            // } else {
            //     $("#user-create-btn").prop('disabled', false);
            //     $(this).parent().removeClass("custom-error");
            //     $(this).parent().addClass("custom-success");
            // }
        }
    });

    $(".init_pin input").on("keydown", function (){
        var thisClass = $(this).attr("data-class");
        pinValidation();
    });

    $(".check_email").on("keyup", function () {
        var emailSel = $(this);
        $.ajax({
            type: "POST",
            url: _base_url + '/auth/check_email_existance',
            data: $(".create_user_form").serialize(),
            dataType: "json",
            success: function (response) {
                // var specimenId = $('#block_specimen_id').val();
                if (response.status == "fail") {
                    $("#user-create-btn").prop('disabled', true);
                    emailSel.parent().addClass("custom-error");
                    emailSel.parent().removeClass("custom-success");
                    $("#email_span").text(response.message);
                    $("#email_span").show();

                    // senior_dev@oxbridgemedica.com
                } else {
                    $("#user-create-btn").prop('disabled', false);
                    emailSel.parent().removeClass("custom-error");
                    emailSel.parent().addClass("custom-success");
                    // emailSel.css("border-color", "#e3e3e3");
                    $("#email_span").hide();
                }
            }
        });
    });

    $(".password-submit-btn").on("click", function () {
        var passStatus = Number($("#password_status").val());
        var passStatus = Number($("#email_status").val());
        if (passwordValidation()) {
            $.ajax({
                type: "POST",
                url: _base_url + '/auth/update_password',
                data: $("#update_password_form").serialize(),
                dataType: "json",
                success: function (response) {
                    // var specimenId = $('#block_specimen_id').val();
                    if (response.status === 'success') {
                        $('#add_leave_modal').modal('hide');
                        // $("#specimen_" + specimenId + " .block_table").append(response.data);
                        $.sticky(response.message, {
                            classList: 'success',
                            speed: 200,
                            autoclose: 7000
                        });
                        window.location.replace(_base_url);
                    } else {
                        $.sticky(response.message, {
                            classList: 'important',
                            speed: 200,
                            autoclose: 7000
                        });
                    }
                }
            });
        }
    });

    var formSelector = $("#update_pin_form");
    formSelector.validate({
        // ignore: ":hidden",
        rules: {
        },
        submitHandler: function (form) {
            if(pinValidation()){
                $.ajax({
                    type: "POST",
                    url: _base_url + '/auth/update_pin',
                    data: $(form).serialize(),
                    dataType: "json",
                    success: function (response) {
                        // var specimenId = $('#block_specimen_id').val();
                        if (response.status === 'success') {
                            $('#add_leave_modal').modal('hide');
                            // $("#specimen_" + specimenId + " .block_table").append(response.data);
                            $.sticky(response.message, {
                                classList: 'success',
                                speed: 200,
                                autoclose: 7000
                            });
                            location.reload();
                        } else {
                            $.sticky(response.message, {
                                classList: 'important',
                                speed: 200,
                                autoclose: 7000
                            });
                        }
                    }
                });
                return false; // required to block normal submit since you used ajax
            }
        }
    });

    $("body").on('click', '.view_password', function () {
        if ($(this).closest(".tg-inputwithicon").find(".show_pass").attr("type") === "password") {
            $(this).closest(".tg-inputwithicon").find(".show_pass").attr("type", "text");
            $(this).find("i").removeClass("fa-eye");
            $(this).find("i").addClass("fa-eye-slash");
        } else {
            $(this).closest(".tg-inputwithicon").find(".show_pass").attr("type", "password");
            $(this).find("i").removeClass("fa-eye-slash");
            $(this).find("i").addClass("fa-eye");
        }

    });
})
;