var base_url = 'http://183.82.1.3:8090/servicekarma/admin/establishments/';


function ValidateEmail(email) {
	
        var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return expr.test(email);
}
function validate_establishments(){
	var error = 0;
	
	var avatar = $("#file").val();
	var extension = avatar.split('.').pop().toUpperCase();
	if(extension != '') {
		if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG"){
			if(!$('#file').hasClass('form-error')){
			$('#file').addClass('form-error').after('<div id="file_error" class="error-message">Invalid extension '+extension+'</div>');
		}
		error++;
		}
		else{
			$('#file').removeClass('form-error');
			$('#file_error').remove();
	    }
	}else{
			$('#file').removeClass('form-error');
			$('#file_error').remove();
	    }
	
	if($.trim($('#est_name').val()) == ""){
		if(!$('#est_name').hasClass('form-error')){
			$('#est_name').addClass('form-error').after('<div id="est_name_error" class="error-message">Please enter Establishment Name</div>');
		}
		error++;
	} else {
		$('#est_name').removeClass('form-error');
		$('#est_name_error').remove();
	}

	if($.trim($('#address').val()) == ""){
		if(!$('#address').hasClass('form-error')){
			$('#address').addClass('form-error').after('<div id="address_error" class="error-message">Please enter Address</div>');
		}
		error++;
	} else {
		$('#address').removeClass('form-error');
		$('#address_error').remove();
	}
	if($.trim($('#city').val()) == ""){
		if(!$('#city').hasClass('form-error')){
			$('#city').addClass('form-error').after('<div id="city_error" class="error-message">Please select City</div>');
		}
		error++;
	} else {
		$('#city').removeClass('form-error');
		$('#city_error').remove();
	}
	if($.trim($('#phone_1').val()) == ""){
		if(!$('#phone_1').hasClass('form-error')){
			$('#phone_1').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">Please enter phone number</div>');
		}
		error++;
	} else {
		$('#phone_1').removeClass('form-error');
		$('#phone_1_error').remove();
		$('#phone_num_error').remove();
	}
	if($.trim($('#phone_2').val()) == ""){
		if(!$('#phone_2').hasClass('form-error')){
			$('#phone_2').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">Please enter phone number</div>');
		}
		error++;
	} else {
		$('#phone_2').removeClass('form-error');
		$('#phone_2_error').remove();
		$('#phone_num_error').remove();
	}
	if($.trim($('#phone_3').val()) == ""){
		if(!$('#phone_3').hasClass('form-error')){
			$('#phone_3').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">Please enter phone number</div>');
		}
		error++;
	} else {
		$('#phone_3').removeClass('form-error');
		$('#phone_3_error').remove();
		$('#phone_num_error').remove();
	}
	if($.trim($('#email').val()) == ""){
		if(!$('#email').hasClass('form-error')){
			$('#email').addClass('form-error').after('<div id="email_error" class="error-message">Please enter email</div>');
		}
		error++;
	}else if (!ValidateEmail($("#email").val()) && $.trim($('#email').val()) != "") {
        if(!$('#email').hasClass('form-error')){
			$('#email').addClass('form-error').after('<div id="email_error" class="error-message">Invalid Email ID</div>');
		}
		error++;
    } else {
		$('#email').removeClass('form-error');
		$('#email_error').remove();
	}
	if($.trim($('#state').val()) == ""){
		if(!$('#state').hasClass('form-error')){
			$('#state').addClass('form-error').after('<div id="state_error" class="error-message">Please select state</div>');
		}
		error++;
	} else {
		$('#state').removeClass('form-error');
		$('#state_error').remove();
	}
	if($.trim($('#zipcode').val()) == ""){
		if(!$('#zipcode').hasClass('form-error')){
			$('#zipcode').addClass('form-error').after('<div id="zipcode_error" class="error-message">Please enter zip code</div>');
		}
		error++;
	} else {
		$('#zipcode').removeClass('form-error');
		$('#zipcode_error').remove();
	}
	if(error){
		return false;
	}else{
		
		if($.trim($('#profile_id').val()) > 0){
			var url = 'editEst';
		}else{
			var url = 'add';
		}
		$.ajax({
		   type: "POST",
		   url: url,
		   data: $('#form_est').serialize()+"&ajaxcheck=1&xxxxx="+Math.random(),
		   success: function(result){
			  
			   var err = 0;
			   var arr = result.split(',');
			    err = arr.length;
			   if($.inArray('1', arr) > -1){
				   $('#est_name_error').remove();
					$('#est_name').addClass('form-error').after('<div id="est_name_error" class="error-message">Establishment Name already in used</div>');
			   }
			   else if($.inArray('2', arr) > -1){
				   $('#email_error').remove();
					$('#email').addClass('form-error').after('<div id="email_error" class="error-message">Email already in used</div>');
						
			   }else{
					
					$( "#form_est" ).submit(); 
				}
			}
	    });
	
		
		//return true;	
		
	}

}
function getCities(state_id,city_id){
if(state_id > 0){	
	$.ajax({
		   type: "GET",
		   url: base_url+"getcities",
		   data: "state_id="+state_id+"&city_id="+city_id+"&xxxxx="+Math.random(),
		   success: function(result){
			  	$('#city_result').html(result);
			}
	 });
}
}
function validate_editprofile(){
		var error = 0;
	
	var avatar = $("#file").val();
	var extension = avatar.split('.').pop().toUpperCase();
	if(extension != '') {
		if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG"){
			if(!$('#image_upload').hasClass('form-error')){
			$('#image_upload').after('<div id="image_upload_error" class="error-message">&nbsp;&nbsp;&nbsp;Invalid extension '+extension+'</div>');
		}
		error++;
		}
		else{
			$('#image_upload').removeClass('form-error');
			$('#image_upload_error').remove();
	    }
	}else{
			$('#file').removeClass('form-error');
			$('#file_error').remove();
	    }	
		
		
		if($.trim($('#firstname').val()) == ""){
		if(!$('#firstname').hasClass('form-error')){
			$('#firstname').addClass('form-error').after('<div id="firstname_error" class="error-message">&nbsp;&nbsp;&nbsp;Please enter First Name</div>');
		}
		error++;
	} else {
		$('#firstname').removeClass('form-error');
		$('#firstname_error').remove();
	}
		
		
		if($.trim($('#address').val()) == ""){
		if(!$('#address').hasClass('form-error')){
			$('#address').addClass('form-error').after('<div id="address_error" class="error-message">&nbsp;&nbsp;&nbsp;Please enter Address</div>');
		}
		error++;
	} else {
		$('#address').removeClass('form-error');
		$('#address_error').remove();
	}
	if($.trim($('#city').val()) == ""){
		if(!$('#city').hasClass('form-error')){
			$('#city').addClass('form-error').after('<div id="city_error" class="error-message">&nbsp;&nbsp;&nbsp;Please select City</div>');
		}
		error++;
	} else {
		$('#city').removeClass('form-error');
		$('#city_error').remove();
	}
	if($.trim($('#state').val()) == ""){
		if(!$('#state').hasClass('form-error')){
			$('#state').addClass('form-error').after('<div id="state_error" class="error-message">&nbsp;&nbsp;&nbsp;Please select state</div>');
		}
		error++;
	} else {
		$('#state').removeClass('form-error');
		$('#state_error').remove();
	}
	if($.trim($('#phone_1').val()) == ""){
		if(!$('#phone_1').hasClass('form-error')){
			$('#phone_1').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">&nbsp;&nbsp;&nbsp;Please enter phone number</div>');
		}
		error++;
	} else {
		$('#phone_1').removeClass('form-error');
		$('#phone_1_error').remove();
		$('#phone_num_error').remove();
	}
	if($.trim($('#phone_2').val()) == ""){
		if(!$('#phone_2').hasClass('form-error')){
			$('#phone_2').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">&nbsp;&nbsp;&nbsp;Please enter phone number</div>');
		}
		error++;
	} else {
		$('#phone_2').removeClass('form-error');
		$('#phone_2_error').remove();
		$('#phone_num_error').remove();
	}
	if($.trim($('#phone_3').val()) == ""){
		if(!$('#phone_3').hasClass('form-error')){
			$('#phone_3').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">&nbsp;&nbsp;&nbsp;Please enter phone number</div>');
		}
		error++;
	} else {
		$('#phone_3').removeClass('form-error');
		$('#phone_3_error').remove();
		$('#phone_num_error').remove();
	}
		
	if(error){
		return false;
	}else{
		
		$( "#profile" ).submit(); 
	}
}



/*function validate_users(){
	var error = 0;
	
	var avatar = $("#file").val();
	var extension = avatar.split('.').pop().toUpperCase();
	if(extension != '') {
		if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG"){
			if(!$('#file').hasClass('form-error')){
			$('#file').addClass('form-error').after('<div id="file_error" class="error-message">Invalid extension '+extension+'</div>');
		}
		error++;
		}
		else{
			$('#file').removeClass('form-error');
			$('#file_error').remove();
	    }
	}else{
			$('#file').removeClass('form-error');
			$('#file_error').remove();
	    }
		
	if($.trim($('#first_name').val()) == ""){
		if(!$('#first_name').hasClass('form-error')){
			$('#first_name').addClass('form-error').after('<div id="first_name_error" class="error-message">Please enter First Name</div>');
		}
		error++;
	} else {
		$('#first_name').removeClass('form-error');
		$('#first_name_error').remove();
	}
	
	if($.trim($('#last_name').val()) == ""){
		if(!$('#last_name').hasClass('form-error')){
			$('#last_name').addClass('form-error').after('<div id="last_name_error" class="error-message">Please enter Last Name</div>');
		}
		error++;
	} else {
		$('#last_name').removeClass('form-error');
		$('#last_name_error').remove();
	}

	if($.trim($('#address').val()) == ""){
		if(!$('#address').hasClass('form-error')){
			$('#address').addClass('form-error').after('<div id="address_error" class="error-message">Please enter Address</div>');
		}
		error++;
	} else {
		$('#address').removeClass('form-error');
		$('#address_error').remove();
	}
	if($.trim($('#city').val()) == ""){
		if(!$('#city').hasClass('form-error')){
			$('#city').addClass('form-error').after('<div id="city_error" class="error-message">Please select City</div>');
		}
		error++;
	} else {
		$('#city').removeClass('form-error');
		$('#city_error').remove();
	}
	if($.trim($('#phone_1').val()) == ""){
		if(!$('#phone_1').hasClass('form-error')){
			$('#phone_1').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">Please enter Phone Number</div>');
		}
		error++;
	} else {
		$('#phone_1').removeClass('form-error');
		$('#phone_1_error').remove();
		$('#phone_num_error').remove();
	}
	if($.trim($('#phone_2').val()) == ""){
		if(!$('#phone_2').hasClass('form-error')){
			$('#phone_2').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">Please enter Phone Number</div>');
		}
		error++;
	} else {
		$('#phone_2').removeClass('form-error');
		$('#phone_2_error').remove();
		$('#phone_num_error').remove();
	}
	if($.trim($('#phone_3').val()) == ""){
		if(!$('#phone_3').hasClass('form-error')){
			$('#phone_3').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">Please enter Phone Number</div>');
		}
		error++;
	} else {
		$('#phone_3').removeClass('form-error');
		$('#phone_3_error').remove();
		$('#phone_num_error').remove();
	}
	if($.trim($('#email').val()) == ""){
		if(!$('#email').hasClass('form-error')){
			$('#email').addClass('form-error').after('<div id="email_error" class="error-message">Please enter Email</div>');
		}
		error++;
	}else if (!ValidateEmail($("#email").val()) && $.trim($('#email').val()) != "") {
        if(!$('#email').hasClass('form-error')){
			$('#email').addClass('form-error').after('<div id="email_error" class="error-message">Invalid Email</div>');
		}
		error++;
    } else {
		$('#email').removeClass('form-error');
		$('#email_error').remove();
	}
	if($.trim($('#establishment').val()) == ""){
		if(!$('#establishment').hasClass('form-error')){
			$('#establishment').addClass('form-error').after('<div id="establishment_error" class="error-message">Please select Establishment</div>');
		}
		error++;
	} else {
		$('#establishment').removeClass('form-error');
		$('#establishment_error').remove();
	}
	if($.trim($('#state').val()) == ""){
		if(!$('#state').hasClass('form-error')){
			$('#state').addClass('form-error').after('<div id="state_error" class="error-message">Please select State</div>');
		}
		error++;
	} else {
		$('#state').removeClass('form-error');
		$('#state_error').remove();
	}
	if($.trim($('#zipcode').val()) == ""){
		if(!$('#zipcode').hasClass('form-error')){
			$('#zipcode').addClass('form-error').after('<div id="zipcode_error" class="error-message">Please enter Zip Code</div>');
		}
		error++;
	} else {
		$('#zipcode').removeClass('form-error');
		$('#zipcode_error').remove();
	}
	if(error){
		return false;
	}else{			
		if($.trim($('#id').val()) > 0){
			var url = '../users/editUser';
		}else{
			var url = '../users/add';
		}	
		$.ajax({
		   type: "POST",
		   url: url,
		   data: $('#form_users').serialize()+"&ajaxcheck=1&xxxxx="+Math.random(),
		   success: function(result){	
		  	   //alert(result);		 
			   var err = 0;
			   var arr = result.split(',');
			   err = arr.length;
			   if(result==''){
				   $( "#form_users" ).submit(); 						
			   }else{					
					$('#email_error').remove();
					$('#email').addClass('form-error').after('<div id="email_error" class="error-message">Email already in used</div>');
				}
			}
	    });
		//return true;			
	}
}*/


function validate_users(){
	var error = 0;
	
	var avatar = $("#file").val();
	var extension = avatar.split('.').pop().toUpperCase();
	if(extension != '') {
		if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG"){
			if(!$('#file').hasClass('form-error')){
			$('#file').addClass('form-error').after('<div id="file_error" class="error-message">Invalid extension '+extension+'</div>');
		}
		error++;
		}
		else{
			$('#file').removeClass('form-error');
			$('#file_error').remove();
	    }
	}else{
			$('#file').removeClass('form-error');
			$('#file_error').remove();
	    }
		
	if($.trim($('#first_name').val()) == ""){
		if(!$('#first_name').hasClass('form-error')){
			$('#first_name').addClass('form-error').after('<div id="first_name_error" class="error-message">Please enter First Name</div>');
		}
		error++;
	} else {
		$('#first_name').removeClass('form-error');
		$('#first_name_error').remove();
	}
	
	if($.trim($('#last_name').val()) == ""){
		if(!$('#last_name').hasClass('form-error')){
			$('#last_name').addClass('form-error').after('<div id="last_name_error" class="error-message">Please enter Last Name</div>');
		}
		error++;
	} else {
		$('#last_name').removeClass('form-error');
		$('#last_name_error').remove();
	}

	if($.trim($('#address').val()) == ""){
		if(!$('#address').hasClass('form-error')){
			$('#address').addClass('form-error').after('<div id="address_error" class="error-message">Please enter Address</div>');
		}
		error++;
	} else {
		$('#address').removeClass('form-error');
		$('#address_error').remove();
	}
	if($.trim($('#city').val()) == ""){
		if(!$('#city').hasClass('form-error')){
			$('#city').addClass('form-error').after('<div id="city_error" class="error-message">Please select City</div>');
		}
		error++;
	} else {
		$('#city').removeClass('form-error');
		$('#city_error').remove();
	}
	if($.trim($('#phone_1').val()) == ""){
		if(!$('#phone_1').hasClass('form-error')){
			$('#phone_1').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">Please enter Phone Number</div>');
		}
		error++;
	} else {
		$('#phone_1').removeClass('form-error');
		$('#phone_1_error').remove();
		$('#phone_num_error').remove();
	}
	if($.trim($('#phone_2').val()) == ""){
		if(!$('#phone_2').hasClass('form-error')){
			$('#phone_2').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">Please enter Phone Number</div>');
		}
		error++;
	} else {
		$('#phone_2').removeClass('form-error');
		$('#phone_2_error').remove();
		$('#phone_num_error').remove();
	}
	if($.trim($('#phone_3').val()) == ""){
		if(!$('#phone_3').hasClass('form-error')){
			$('#phone_3').addClass('form-error').after('');
			$('#phone_num_error').remove();
			$('#phone_num').after('<div id="phone_num_error" class="error-message">Please enter Phone Number</div>');
		}
		error++;
	} else {
		$('#phone_3').removeClass('form-error');
		$('#phone_3_error').remove();
		$('#phone_num_error').remove();
	}
	if($.trim($('#email').val()) == ""){
		if(!$('#email').hasClass('form-error')){
			$('#email').addClass('form-error').after('<div id="email_error" class="error-message">Please enter Email</div>');
		}
		error++;
	}else if (!ValidateEmail($("#email").val()) && $.trim($('#email').val()) != "") {
        if(!$('#email').hasClass('form-error')){
			$('#email').addClass('form-error').after('<div id="email_error" class="error-message">Invalid Email</div>');
		}
		error++;
    } else {
		$('#email').removeClass('form-error');
		$('#email_error').remove();
	}
	if($.trim($('#establishment').val()) == ""){
		if(!$('#establishment').hasClass('form-error')){
			$('#establishment').addClass('form-error').after('<div id="establishment_error" class="error-message">Please select Establishment</div>');
		}
		error++;
	} else {
		$('#establishment').removeClass('form-error');
		$('#establishment_error').remove();
	}
	if($.trim($('#state').val()) == ""){
		if(!$('#state').hasClass('form-error')){
			$('#state').addClass('form-error').after('<div id="state_error" class="error-message">Please select State</div>');
		}
		error++;
	} else {
		$('#state').removeClass('form-error');
		$('#state_error').remove();
	}
	if($.trim($('#zipcode').val()) == ""){
		if(!$('#zipcode').hasClass('form-error')){
			$('#zipcode').addClass('form-error').after('<div id="zipcode_error" class="error-message">Please enter Zip Code</div>');
		}
		error++;
	} else {
		$('#zipcode').removeClass('form-error');
		$('#zipcode_error').remove();
	}
	

	//alert($.trim($('#random_password').is(":checked")));
	
	if(!($('#random_password').is(":checked")))
	{	
		if($.trim($('#password').val()) == ""){
			if(!$('#password').hasClass('form-error')){
				$('#password').addClass('form-error').after('<div id="password_error" class="error-message">Please enter Password</div>');
			}
			error++;
		}else if($.trim($('#password').val()).length <=5){
		$('#password').removeClass('form-error');
		$('#password_error').remove();
		if(!$('#password').hasClass('form-error')){
			$('#password').addClass('form-error').after('<div id="password_error" class="error-message">&nbsp;&nbsp;&nbsp;Password should be minimum 6 characters length</div>');
		}
		error++;
	}  else {
			$('#password').removeClass('form-error');
			$('#password_error').remove();
		}
		if($.trim($('#cpassword').val()) == ""){
			if(!$('#cpassword').hasClass('form-error')){
				$('#cpassword').addClass('form-error').after('<div id="cpassword_error" class="error-message">Please enter Confirm Password</div>');
			}
			error++;
		} else {
			$('#cpassword').removeClass('form-error');
			$('#cpassword_error').remove();
		}
		if(($.trim($('#password').val()) != "") && ($.trim($('#cpassword').val()) != ""))
		{
				if($.trim($('#password').val()) != $.trim($('#cpassword').val()))
				{
							if(!$('#cpassword').hasClass('form-error')){
								$('#cpassword').addClass('form-error').after('<div id="cpassword_error" class="error-message">Password and Confirm Password doesn\'t matched</div>');
							}
							error++;							
				}
		}
	}
	else
	{
		if($.trim($('#id').val()) != ""){
			if($.trim($('#cpassword').val()) != ""){
				$('#cpassword').removeClass('form-error');
				$('#cpassword_error').remove();
				if($.trim($('#password').val()) == ""){
					if(!$('#password').hasClass('form-error')){
						$('#password').addClass('form-error').after('<div id="password_error" class="error-message">Please enter Password</div>');
					}
					error++;
				}else if($.trim($('#password').val()).length <=5){
				$('#password').removeClass('form-error');
				$('#password_error').remove();
				if(!$('#password').hasClass('form-error')){
					$('#password').addClass('form-error').after('<div id="password_error" class="error-message">&nbsp;&nbsp;&nbsp;Password should be minimum 6 characters length</div>');
				}
				error++;
			}  else {
					$('#password').removeClass('form-error');
					$('#password_error').remove();
				}
			}
			else if($.trim($('#password').val()) != ""){
				$('#password').removeClass('form-error');
				$('#password_error').remove();			
				if($.trim($('#cpassword').val()) == ""){
				if(!$('#cpassword').hasClass('form-error')){
					$('#cpassword').addClass('form-error').after('<div id="cpassword_error" class="error-message">Please enter Confirm Password</div>');
				}
				error++;
				} else {
					$('#cpassword').removeClass('form-error');
					$('#cpassword_error').remove();
				}
			}
			if(($.trim($('#password').val()) != "") && ($.trim($('#cpassword').val()) != ""))
			{
					if($.trim($('#password').val()) != $.trim($('#cpassword').val()))
					{
								if(!$('#cpassword').hasClass('form-error')){
									$('#cpassword').addClass('form-error').after('<div id="cpassword_error" class="error-message">Password and Confirm Password doesn\'t matched</div>');
								}
								error++;							
					}
			}
		}
	}

	if(error){
		return false;
	}else{			
		if($.trim($('#id').val()) > 0){
			var url = '../users/editUser';
		}else{
			var url = '../users/add';
		}	
		$.ajax({
		   type: "POST",
		   url: url,
		   data: $('#form_users').serialize()+"&ajaxcheck=1&xxxxx="+Math.random(),
		   success: function(result){	
		  	   //alert(result);		 
			   var err = 0;
			   var arr = result.split(',');
			   err = arr.length;
			   if(result==''){
				   $( "#form_users" ).submit(); 						
			   }else{					
					$('#email_error').remove();
					$('#email').addClass('form-error').after('<div id="email_error" class="error-message">Email already in used</div>');
				}
			}
	    });
		//return true;			
	}
}


function validate_random_password()
{
	//alert($.trim($('#random_password').is(":checked")));
	if(($('#random_password').is(":checked")))
	{	
			$('#password_div').hide();
			$('#password').removeClass('form-error');
			$('#password_error').remove();
			$('#cpassword').removeClass('form-error');
			$('#cpassword_error').remove();
	}
	else
	{
			$('#password_div').show();
	}
}


function getCitiesUsers(state_id, city_id){
	$.ajax({
		   type: "GET",
		   url: "../users/getcitiesusers",		   
		   data: "state_id="+state_id+"&city_id="+city_id+"&xxxxx="+Math.random(),
		   success: function(result){
			  	$('#city_result').html(result);
			}
	 });
}

function getEstablishmentUsers(establishment_id){
	$.ajax({
		   type: "GET",
		   url: "../users/getestablishmentusers",
		   data: "establishment_id="+establishment_id+"&xxxxx="+Math.random(),
		   success: function(result){
			  	$('#users_list_div').html(result);
			}
	 });
}
function validate_changepassword(){
	
	var error = 0;
	if($.trim($('#old_pwd').val()) == ""){
		if(!$('#old_pwd').hasClass('form-error')){
			$('#old_pwd').addClass('form-error').after('<div id="old_pwd_error" class="error-message">&nbsp;&nbsp;&nbsp;Please enter old password</div>');
		}
		error++;
	}else {
		$('#old_pwd').removeClass('form-error');
		$('#old_pwd_error').remove();
	}
	if($.trim($('#new_pwd').val()) == ""){
		
		if(!$('#new_pwd').hasClass('form-error')){
			$('#new_pwd').addClass('form-error').after('<div id="new_pwd_error" class="error-message">&nbsp;&nbsp;&nbsp;Please enter new password</div>');
		}
		error++;
	}else if($.trim($('#new_pwd').val()).length <=5){
		$('#new_pwd').removeClass('form-error');
		$('#new_pwd_error').remove();
		if(!$('#new_pwd').hasClass('form-error')){
			$('#new_pwd').addClass('form-error').after('<div id="new_pwd_error" class="error-message">&nbsp;&nbsp;&nbsp;New password should be minimum 6 characters length</div>');
		}
		error++;
	} else {
		$('#new_pwd').removeClass('form-error');
		$('#new_pwd_error').remove();
	}
	if($.trim($('#conf_pwd').val()) == ""){
		if(!$('#conf_pwd').hasClass('form-error')){
			$('#conf_pwd').addClass('form-error').after('<div id="conf_pwd_error" class="error-message">&nbsp;&nbsp;&nbsp;Please enter confirm password</div>');
		}
		error++;
	} else if($.trim($('#conf_pwd').val())!="" && $.trim($('#new_pwd').val())!="" && $.trim($('#conf_pwd').val())!=$.trim($('#new_pwd').val())){
		
		$('#conf_pwd').removeClass('form-error');
		$('#conf_pwd_error').remove();
		
		if(!$('#conf_pwd').hasClass('form-error')){
			$('#conf_pwd').addClass('form-error').after('<div id="conf_pwd_error" class="error-message">&nbsp;&nbsp;&nbsp;Confirm password does not match</div>');
		}
		error++;
	} else {
		$('#conf_pwd').removeClass('form-error');
		$('#conf_pwd_error').remove();
	}
	
	if(error){
		return false;
	}else{
		$.ajax({
		   type: "POST",
		   url: base_url+"changepassword",
		   data: $('#change_pwd').serialize()+"&ajaxcheck=1&xxxxx="+Math.random(),
		   success: function(result){
			   var err = 0;
			   var arr = result.split(',');
			    err = arr.length;
			   if($.inArray('1', arr) > -1){
				   $('#old_pwd_error').remove();
					$('#old_pwd').addClass('form-error').after('<div id="old_pwd_error" class="error-message">&nbsp;&nbsp;&nbsp;Old password does not match</div>');
			   }
			   else{
					
					$( "#change_pwd" ).submit(); 
				}
			}
	    });
	}
}