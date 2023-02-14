$(function () {
    $("#fname_error_message").hide();
    $("#sname_error_message").hide();
    $("#email_error_meassage").hide();
    $("#password_error_message").hide();
    $("#retype_password_error_message").hide();
    $("#phone_error_message").hide();


var error_fname = false;
    var error_sname = false;
    var error_email = false;
    var error_password = false;
    var error_retype_password = false;
    var error_phone = false;



$("#form_fname").focusout(function () {
        check_fname();
    });

    $("#form_sname").focusout(function () {
        check_sname();
    });

    $("#form_email").focusout(function () {
        check_email();
    });

    $("#form_password").focusout(function () {
        check_password();
    });

    $("#form_retype_password").focusout(function () {
        check_retype_password();
    });

    $("#form_phone").focusout(function () {
        check_phone();
    });




 function check_phone() {
        var phone = $("#form_phone").val();
        var pattern = /^[6,7,8,9][0-9]{0,9}$/;
        if (phone.length == 10 && pattern.test(phone)) {
            $("#phone_error_message").hide();
            $("#form_phone").css("border-bottom", "2px solid #34F458");
        } else if (phone == "") {
            $("#phone_error_message").html("Phone number cannot be blank");
            $("#phone_error_message").show();
            $("form_phone").css("border-bottom", "2px solid #F90A0A");
            error_phone = true;
        } else {
            $("#phone_error_message").html("Enter valid phone number");
            $("#phone_error_message").show();
            $("form_phone").css("border-bottom", "2px solid #F90A0A");
            error_phone = true;
        }
    }

    function check_fname() {
        var pattern = /^[a-zA-Z/s]*$/;
        var fname = $("#form_fname").val();
        if (pattern.test(fname) && fname !== "") {
            $("#fname_error_message").hide();
            $("#form_fname").css("border-bottom", "2px solid #34F458");
        } else if (fname == "") {
            $("#fname_error_message").html("This column cannot be blank");
            $("#fname_error_message").show();
            $("#form_fname").css("border-bottom", "2px solid #F90A0A");
            error_fname = true;
        } else {
            $("#fname_error_message").html("It should contain only charachters");
            $("#fname_error_message").show();
            $("#form_fname").css("border-bottom", "2px solid #F90A0A");
            error_fname = true;
        }
    }

    

    function check_password() {
        var password = $("#form_password").val();
        var patternn = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{8,20}$)/;
        if (patternn.test(password) && password !== "") {
            $("#password_error_message").hide();
            $("#form_password").css("border-bottom", "2px solid #34F458");
        } else if (password == "") {
            $("#password_error_message").html("Password cannot be blank");
            $("#password_error_message").show();
            $("form_password").css("border-bottom", "2px solid #F90A0A");
            error_password = true;
        } else {
            $("#password_error_message").html("Atleast 8 characters and A Uppercase letter , Special Symbol");
            $("#password_error_message").show();
            $("#form_password").css("border-bottom", "2px solid #F90A0A");
            error_password = true;
        }
    }

    function check_retype_password() {
        var password = $("#form_password").val();
        var retype_password = $("#form_retype_password").val();
        if (password !== retype_password) {
            $("#retype_password_error_message").html("   Password is not matching");
            $("#retype_password_error_message").show();
            $("#retype_form_password").css("border-bottom", "2px solid #F90A0A");
            error_retype_password = true;
        } else {
            $("#retype_password_error_message").hide();
            $("#form_retype_password").css("border-bottom", "2px solid #34F458");
        }
    }
    function check_email() {
        var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        var email = $("#form_email").val();
        if (pattern.test(email) && email !== "") {
            $("#email_error_message").hide();
            $("form_email").css("border-bottom", "2px solid #F90A0A");
        } else {
            $("#email_error_message").html("Email should be in proper format and cannot be blank");
            $("#email_error_message").show();
            $("#form_email").css("border-bottom", "2px solid #34F458");
            error_email = true;
        }
    }




 $("#registration_form").submit(function () {
        error_fname = false;
        error_sname = false;
        error_email = false;
        error_password = false;
        error_retype_password = false;
        error_phone = false;




 check_fname();
        check_sname();
        check_email();
        check_password();
        check_retype_password();

check_phone();



 if (
            error_fname === false &&
            error_sname === false &&
            error_email === false &&




  error_phone === false &&
            error_password === false &&
            error_retype_password === false
        ) {
            return true;
        } else {
            alert("Please fill the form Correctly");

            return false
        }
    });




 });
