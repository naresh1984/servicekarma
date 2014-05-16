function validate_login(){
	var error = 0;
	$('#invalid').removeClass('form-error');
	$('#invalid_error').remove();
	if($.trim($('#username').val()) == ""){
		if(!$('#username').hasClass('form-error')){
			$('#username').addClass('form-error').after('<div id="username_error" class="error-message">Please enter username</div>');
		}
		error++;
	} else {
		$('#username').removeClass('form-error');
		$('#username_error').remove();
	}

	if($.trim($('#password').val()) == ""){
		if(!$('#password').hasClass('form-error')){
			$('#password').addClass('form-error').after('<div id="password_error" class="error-message">Please enter password</div>');
		}
		error++;
	} else {
		$('#password').removeClass('form-error');
		$('#password_error').remove();
	}
	if(error){
		return false;
	}else{
		return true;
	}

}
function validate_sociallogin(){
	var error = 0;
	$('#invalid').removeClass('form-error');
	$('#invalid_error').remove();
	if($.trim($('#first_name').val()) == ""){
		if(!$('#first_name').hasClass('form-error')){
			$('#first_name').addClass('form-error').after('<div id="first_name_error" class="error-message">Please enter first name</div>');
		}
		error++;
	} else {
		$('#first_name').removeClass('form-error');
		$('#first_name_error').remove();
	}

	if($.trim($('#last_name').val()) == ""){
		if(!$('#last_name').hasClass('form-error')){
			$('#last_name').addClass('form-error').after('<div id="last_name_error" class="error-message">Please enter last name</div>');
		}
		error++;
	} else {
		$('#last_name').removeClass('form-error');
		$('#last_name_error').remove();
	}
	if($.trim($('#studentid').val()) == ""){
		if(!$('#studentid').hasClass('form-error')){
			$('#studentid').addClass('form-error').after('<div id="studentid_error" class="error-message">Please enter studentid</div>');
		}
		error++;
	} else {
		$('#studentid').removeClass('form-error');
		$('#studentid_error').remove();
	}

	if($.trim($('#email').val()) == ""){
		if(!$('#email').hasClass('form-error')){
			$('#email').addClass('form-error').after('<div id="email_error" class="error-message">Please enter email</div>');
		}
		error++;
	} else {
		$('#email').removeClass('form-error');
		$('#email_error').remove();
	}
	if($.trim($('#establishment').val()) == ""){
		if(!$('#establishment').hasClass('form-error')){
			$('#establishment').addClass('form-error').after('<div id="establishment_error" class="error-message">Please select  establishment</div>');
		}
		error++;
	} else {
		$('#establishment').removeClass('form-error');
		$('#establishment_error').remove();
	}


	if(error){
		return false;
	}else{
		return true;
	}

}
