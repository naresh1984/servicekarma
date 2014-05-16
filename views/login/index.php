<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, width=device-width" />
<link rel="stylesheet" href="<?php echo BASE_FRONTEND_URL; ?>includes/css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo BASE_FRONTEND_URL; ?>includes/css/boilerplate.css" type="text/css" media="all">
<script src="<?php echo BASE_FRONTEND_URL; ?>includes/js/validate.js"></script>
<script src="<?php echo BASE_FRONTEND_URL; ?>includes/js/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_FRONTEND_URL; ?>includes/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_FRONTEND_URL; ?>includes/js/jquery.fancybox.css?v=2.1.5" media="screen" />
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script>
// Developer:Naresh
//Google auth code started 
var OAUTHURL = 'https://accounts.google.com/o/oauth2/auth?';
var VALIDURL = 'https://www.googleapis.com/oauth2/v1/tokeninfo?access_token=';
var SCOPE = 'https://www.googleapis.com/auth/userinfo.email';
var CLIENTID = '877801708031-61rejj9mr6l4t56sflvjdn9vmc6dkhfm.apps.googleusercontent.com';
//var REDIRECT = 'http://localhost:8888/MAMP/html5/oauth/';
var REDIRECT = 'http://183.82.1.3:8090/servicekarma/';
var LOGOUT = 'http://accounts.google.com/Logout';
var TYPE = 'token';
var _url = OAUTHURL + 'scope=' + SCOPE + '&client_id=' + CLIENTID + '&redirect_uri=' + REDIRECT + '&response_type=' + TYPE;
var acToken;
var tokenType;
var expiresIn;
var user;
var loggedIn = false;

function login() {
var win = window.open(_url, "windowname1", 'width=800, height=600');

var pollTimer = window.setInterval(function() {
try {
console.log(win.document.URL);
if (win.document.URL.indexOf(REDIRECT) != -1) {
window.clearInterval(pollTimer);
var url = win.document.URL;
acToken = gup(url, 'access_token');
tokenType = gup(url, 'token_type');
expiresIn = gup(url, 'expires_in');
win.close();

validateToken(acToken);
}
} catch(e) {
}
}, 500);
}

function validateToken(token) {
$.ajax({
url: VALIDURL + token,
data: null,
success: function(responseText){
getUserInfo();
loggedIn = true;
$('#loginText').hide();
$('#logoutText').show();
},
dataType: "jsonp"
});
}

function getUserInfo() {
$.ajax({
url: 'https://www.googleapis.com/oauth2/v1/userinfo?access_token=' + acToken,
data: null,
success: function(resp) {
user = resp;
console.log(user);
//$('#uName').text('Welcome ' + user.name);
$('#first_name').val(user.given_name);
$('#last_name').val(user.family_name);
$('#email').val(user.email);
$('.modalbox').trigger('click');
$('#imgHolder').attr('src', user.picture);
console.log(user);
},
dataType: "jsonp"
});
}

//credits: http://www.netlobo.com/url_query_string_javascript.html
function gup(url, name) {
name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
var regexS = "[\\#&]"+name+"=([^&#]*)";
var regex = new RegExp( regexS );
var results = regex.exec( url );
if( results == null )
return "";
else
return results[1];
}

function startLogoutPolling() {
$('#loginText').show();
$('#logoutText').hide();
loggedIn = false;
alert('startLogoutPolling');
//alert(user.name);
//alert(user.picture);
//alert(user.email);
//alert(user.family_name);
//alert(user.given_name);
//alert(user.gender);

$('#uName').text('Welcome ');
$('#imgHolder').attr('src', 'none.jpg');
}

//Google auth code end

//Facebook auth code started 


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '774124319287636', // App ID
      channelUrl : 'http://183.82.1.3:8090/servicekarma/', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });
    
    
	FB.Event.subscribe('auth.authResponseChange', function(response) 
	{
 	 if (response.status === 'connected') 
  	{
  		//document.getElementById("message").innerHTML +=  "<br>Connected to Facebook";
  		//SUCCESS
  		
  	}	 
	else if (response.status === 'not_authorized') 
    {
    	document.getElementById("message").innerHTML +=  "<br>Failed to Connect";

		//FAILED
    } else 
    {
    	document.getElementById("message").innerHTML +=  "<br>Logged Out";

    	//UNKNOWN ERROR
    }
	});	
	
    };
    
   	function Login()
	{
	
		FB.login(function(response) {
		   if (response.authResponse) 
		   {
		    	getUserInfofb();
  			} else 
  			{
  	    	 console.log('User cancelled login or did not fully authorize.');
   			}
		 },{scope: 'email,user_photos,user_videos'});
	
	
	}

  function getUserInfofb() {
	    FB.api('/me', function(response) {  

              $('#first_name').val(response.first_name);
              $('#last_name').val(response.last_name);
              $('#email').val(response.email);          
              $('.modalbox').trigger('click'); 
            	    
    });
    }
	function getPhoto()
	{
	  FB.api('/me/picture?type=normal', function(response) {

		  var str="<br/><b>Pic</b> : <img src='"+response.data.url+"'/>";
	  	  document.getElementById("status").innerHTML+=str;
	  	  	    
    });
	
	}
	function Logout()
	{
		FB.logout(function(){document.location.reload();});
	}

  // Load the SDK asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));

//Facebook auth code end 


</script>


</head>
<body>
<?php
$url = 'login/checkLogin/';
?>
<body class="bgbody">
<div class="gridContainer clearfix">
<div id="LayoutDiv1">
<form method="post" action="<?php echo BASE_FRONTEND_URL . $url ?>"  onsubmit="return validate_login();" >
  <section>
    <div class="logo_area"></div>
    <div class="login-box">
      <div class="login_area btmpadding">
        <div class="login_inner">
          <div class="login_inline">
            <div class="login_txtara"> 
              <!--<h1 class="login_hedr"></h1>-->
              <div class="error-message" id="invalid_error">
			  <?php	echo @$errors;  ?>	
            </div>
              <div class="form_cont_full">
                <div class="usr_icon"></div>
                <input type="text" name="username" id="username" value="" class="input_full" placeholder="username"/>
              </div>
              <div class="form_cont_full ">
                <div class="pswrd_icon"></div>
                <input type="password" name="password"  id="password" value="" class="input_full" placeholder="password"/>
              </div>
              <div class="fgp_ara">
                <div class="rem_ara">
                  <input id="demo_box_1" class="css-checkbox" type="checkbox" />
                  <label for="demo_box_1" class="css-label"><strong style="font-size:12px">Remember Me</strong></label>
                </div>
                <a href="forgot-password.php"><strong style="font-size:12px">Forgot password?</strong></a></div>
              <div class="nwusr_ara">
                <input type="submit" value="Login" class="button button-blue btn-full b-bottom-space-login">
                <div id="or"></div>
                <div id="center"><strong> Login With:</strong><br>
                  <br>
                  <img src="<?php echo BASE_FRONTEND_URL; ?>includes/img/facebook.png" alt="" onclick="Login()"  style="cursor:pointer;" />&nbsp;&nbsp;<img src="<?php echo BASE_FRONTEND_URL; ?>includes/img/google.png" alt="" onclick='login();' style="cursor:pointer;" /></div>
                <button class="button button-darkgray btn-full" onClick="window.location.href='register.php'">New User? Register today</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
</body>
<?php include HOME . DS . 'includes' . DS . 'footer.php'; ?>

<!--social popup start-->
<a class="modalbox" href="#inline" style="display:none">click to open</a>
<form id="ff" method="post">
<div id="inline">
<div id="prowrap">
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div id="popwrap">
       <div class="popleftform form_cont_full error" style="display:none" >
        <span style="display:none" class="error2" style="font-size:15px;">Your Account is deactivated.Please contact administrator.</span>
        <span style="display:none" class="error1" style="font-size:15px;">Invalied account detail.Please check one.</span>
      
       </div>
        <div id="popleftcol">
       
          <div class="popleftform form_cont_full">
            <label>First Name:</label>
            <br>
            <br>
            <input type="text"  name="first_name" id="first_name" value="<?php echo @$userDetails[0]['firstname']; ?>" tabindex="1">
          </div>
          
          <div class="popleftform form_cont_full">
            <label>Email:</label>
            <br>
            <br>
            <input type="text"  name="email" id="email" value="<?php echo @$userDetails[0]['email']; ?>" tabindex="3">
          </div>      
          
          <div class="popleftform form_cont_full">
            <label>Student Id:</label>
            <br>
            <br>
           <input type="text"  name="studentid" id="studentid" value="" tabindex="3">
          </div>
            
       <div class="popleftform form_cont_full">
          
	    
        <input type="button" name="Add" value="<?php if(count(@$userDetails) > 0){ echo 'Save'; } else { echo 'Submit'; } ?>" class="button button-darkgray btn-two-half left submit"  onclick="return validate_sociallogin();">
        
 
            </div>
          
        
          
          <div class="popleftform"></div>
          <div class="popleftform"></div>
          <div class="popleftform"><br>
          </div>
          <br>
          <div class="popleftform"> </div>
        </div>
        <div id="pop-vdividernull"></div>
        <div id="poprightcol">
        
         <div class="poprightform form_cont_full">
            <label>Last Name:</label>
            <br>
            <br>
            <input type="text"  name="last_name" id="last_name" value="<?php echo @$userDetails[0]['lastname']; ?>" tabindex="2">
          </div>
          
          <div class="poprightform form_cont_full" style="padding-bottom:10px;">
            <label>Establishment:</label>
            <br>
            <br>
            <select name="establishment" id="establishment" tabindex="4">
              <option value="">Select Establishment</option>
              <?php
			  foreach($allEstablishments as $establishments):
			  ?>
              <option value="<?php echo $establishments['id']; ?>" <?php if(@$userDetails[0]['establishment_id'] == $establishments['id']) { ?> selected="selected" <?php } ?> ><?php echo $establishments['establishment_name']; ?></option>
              <?php
			  endforeach;
			  ?>
            </select>
          </div> 
     
         
   

          <div class="popleftform"></div>
          <div class="popleftform"></div>
          <div class="popleftform"><br>
          </div>
          <br>
          <div class="popleftform"> </div>
        </div>
      </div>
</div>
</form>

<script type="text/javascript">
$(document).ready(function() {
$(".modalbox").fancybox();

$(".submit").click(function() {

var email = $("#email").val();
var studentid = $("#studentid").val();
var establishment = $("#establishment").val();

var dataString = 'email='+ email + '&studentid=' + studentid + '&establishment=' + establishment;

if(email=='' || studentid=='' || establishment=='')
{

$('.success').fadeOut(200).hide();
//$('.error').fadeOut(200).show();
}
else
{
$.ajax({
type: "POST",
url: "http://183.82.1.3:8090/<?php echo BASE_FRONTEND_URL; ?>login/checksociallogin",
data: dataString,
success: function(response){

 //document.getElementById("success").innerHTML=response;
 if(response=='0'){
 $('.error').fadeOut(5000).show();
 $('.error1').fadeOut(5000).show();
 } 
 else if(response=='Inactive' || response=='-1'){
 $('.error').fadeOut(5000).show();
 $('.error2').fadeOut(5000).show();
 }else{
  parent.$.fancybox.close();
  window.parent.location.href = "http://183.82.1.3:8090/"+response;
}


//$('.success').fadeIn(200).show();

}
});
}
return false;
});



});
</script>


