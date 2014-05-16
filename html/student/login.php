<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link href="css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">

<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

Do the following if you're using your customized build of modernizr (http://www.modernizr.com/):
* insert the link to your js here
* remove the link below to the html5shiv
* add the "no-js" class to the html tags at the top
* you can also remove the link to respond.min.js if you included the MQ Polyfill in your modernizr build 
-->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="js/respond.min.js"></script>

<!--				check box				-->
<script type='text/javascript' src="js/custom-form-elements.js"></script>

<!--					check box				-->

</head>
<body class="bgbody">

    <div class="gridContainer clearfix">
    
    	<div id="LayoutDiv1">
        
            <header>
              <div class="top_color"> 
                <!--<ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>--> 
                
               <a href="" class="school_logo"><img src="img/servicekarma-logo.png" /></a> 
                <!--<div class="topmenu_area">
                        <div class="setting_btnara">
                            <a href="" class="set_icon">Settings</a>|
                            <a href="" class="noti_icon">Notifications</a>|
                            <a href="" class="log_icon">Logout</a>
                        </div>
                        
                        <div class="main_menu">
                            <a href="" class="mnu_act">Create New Account</a>
                            <a href="">Manage Accounts</a>
                            <a href="">Generate Reports</a>
                        </div>
                        
                        
                    </div>-->
                <div class="clear"></div>
              </div>
              
            </header>
        
            <section>
              <div class="logo_area"></div>
              <div class="login-box">
                <div class="login_area btmpadding">
                  <div class="login_inner">
                    <div class="login_inline">
                      <div class="login_txtara">
                        <!--<h1 class="login_hedr"></h1>-->
                        <div class="form_cont_full">
                          <div class="usr_icon"></div>
                          <input type="text" placeholder="username" class="input_full" />
                        </div>
                        <div class="form_cont_full ">
                          <div class="pswrd_icon"></div>
                          <input type="password" placeholder="******" class="input_full" />
                        </div>
                        <div class="fgp_ara">
                          <div class="rem_ara">
                            <input id="demo_box_1" class="css-checkbox" type="checkbox" />
                            <label for="demo_box_1" class="css-label">Remember Me</label>
                          </div>
                          <a href="forgot-password.php">Forgot password?</a></div>
                        <div class="nwusr_ara">
                          <button class="button button-blue btn-full b-bottom-space-login" onClick="window.location.href='index.php'">Login</button>
                          
                          <div id="or"></div>
                          <div id="center">
                          Login With:<br><br>

                          <img src="img/facebook.png" alt=""/>&nbsp;&nbsp;  <img src="img/google.png" alt=""/></div>
                          <button class="button button-darkgray btn-full" onClick="window.location.href='register.php'">New User? Register today</button>
                        </div>
                        <!-- <div class="nwusr_ara">
                                    <input type="button" class="loginbtn" value="Login">
                                    <input type="button" class="loginbtn" value="New User? Register today">
                                </div>-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            
            <footer>
                <small>Servicekarma 2013</small>
                <div class="ftr_link"> <a href="">About</a> &nbsp;| <a href="">contact</a> &nbsp;| <a href="">feedback</a> </div>
            </footer>
        
      	</div>
        
    </div>
    
</body>
</html>
