$(document).ready(function () {
	$("#fname-error").hide();
	$("#lname-error").hide();
	$("#uname-error").hide();
	$("#email-error").hide();
	$("#pwd-error").hide();
	$("#pwd2-error").hide();

	var fname_error = false;
	var lname_error = false;
	var uname_error = false;
	var email_error = false;
	var pwd_error = false;
	var pwd2_error = false;

	$("#form_fname").focusout(function () {
		check_fname();
	});

	$("#form_lname").focusout(function () {
		check_lname();
	});

	$("#form_uname").focusout(function () {
		check_uname();
	});

	$("#form_email").focusout(function () {
		check_email();
	});

	$("#form_pwd").focusout(function () {
		check_pwd();
	});

	$("#form_pwd2").focusout(function () {
		check_pwd2();
	});

	function check_fname() {
		var letters = /^[A-Za-z]+$/;
		console.log($("#form_fname").val());
		if ($("#form_fname").val() == "") {
			$("#fname-error").html("Please enter a first name.");
			$("#fname-error").show();
			fname_error = true;
			return;
		}
		if (!$("#form_fname").val().match(letters)) {
			$("#fname-error").html(
				"First name should be alphabetical characters only."
			);
			$("#fname-error").show();
			fname_error = true;
		} else {
			$("#fname-error").hide();
		}
	}

	function check_lname() {
		var letters = /^[A-Za-z]+$/;
		console.log($("#form_lname").val());
		if ($("#form_lname").val() == "") {
			$("#lname-error").html("Please enter a last name.");
			$("#lname-error").show();
			lname_error = true;
			return;
		}
		if (!$("#form_lname").val().match(letters)) {
			$("#lname-error").html(
				"Last name should be alphabetical characters only."
			);
			$("#lname-error").show();
			lname_error = true;
		} else {
			$("#lname-error").hide();
		}
	}

	function check_uname() {
		console.log($("#form_uname").val());
		if ($("#form_uname").val() == "") {
			$("#uname-error").html("Please enter a username.");
			$("#uname-error").show();
			uname_error = true;
		} else {
			$("#uname-error").hide();
			uname_error = false;
		}
	}

	function check_email() {
		console.log($("#form_email").val());
		if ($("#form_email").val() == "") {
			$("#email-error").html("Please enter an email.");
			$("#email-error").show();
			email_error = true;
		} else {
			$("#email-error").hide();
			email_error = false;
		}
	}

	function check_pwd() {
		console.log($("#form_pwd").val());
		if ($("#form_pwd").val() == "") {
			$("#pwd-error").html("Please enter a password.");
			$("#pwd-error").show();
			pwd_error = true;
			return;
		} else {
			$("#pwd-error").hide();
			pwd_error = false;
		}

		var pwd_length = $("#form_pwd").val().length;

		if (pwd_length < 6) {
			$("#pwd-error").html(
				"Password must be at least 6 characters long."
			);
			$("#pwd-error").show();
			pwd_error = true;
		} else {
			$("#pwd-error").hide();
		}
	}

	function check_pwd2() {
		if ($("#form_pwd").val() !== $("#form_pwd2").val()) {
			$("#pwd2-error").html("Passwords must match.");
			$("#pwd2-error").show();
			pwd2_error = true;
			return;
		} else {
			$("#pwd2-error").hide();
			pwd2_error = false;
		}

		if ($("#form_pwd2").val() == "") {
			$("#pwd2-error").html("Please enter a password.");
			$("#pwd2-error").show();
			pwd_error = true;
			return;
		} else {
			$("#pwd2-error").hide();
			pwd_error = false;
		}
	}

	$("#reg_form").submit(function () {
		fname_error = false;
		lname_error = false;
		uname_error = false;
		email_error = false;
		pwd_error = false;
		pwd2_error = false;

		check_fname();
		check_lname();
		check_uname();
		check_email();
		check_pwd();
		check_pwd2();

		if (
			fname_error == false &&
			lname_error == false &&
			uname_error == false &&
			email_error == false &&
			pwd_error == false &&
			pwd2_error == false
		) {
			return true;
		} else {
			return false;
		}
	});

	$("#login_form").submit(function () {
		email_error = false;
		pwd_error = false;

		check_email();
		check_pwd();

		if (email_error == false && pwd_error == false) {
			return true;
		} else {
			return false;
		}
	});

	$("#pwd_form").submit(function () {
		fname_error = false;
		lname_error = false;
		email_error = false;
		pwd_error = false;

		check_fname();
		check_lname();
		check_email();
		check_pwd();

		if (
			fname_error == false &&
			lname_error == false &&
			email_error == false &&
			pwd_error == false
		) {
			return true;
		} else {
			return false;
		}
	});
});
