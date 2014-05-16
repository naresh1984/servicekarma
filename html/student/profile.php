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
<title>My Profile</title>
<link href="css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">

<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="css/magnific-popup.css">

<!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- Magnific Popup core JS file -->
<script src="js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript">
	/*$('.open-popup-link').magnificPopup({
		type:'inline',
		midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
	});*/
	
	/*$('.open-popup-link').magnificPopup({		
	  type:'inline',
	  midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
	});	*/
	$( document ).ready(function() {
		$('.edit-profile').magnificPopup({
		  items: {
			  src: '#EditProfilePopup',
			  type: 'inline'
		  }
		});	
	});	
	
    </script>

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
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="js/jquery.fancybox.css?v=2.1.5" media="screen" />       
<script type="text/javascript" language="javascript">
$(document).ready(function() {			
			$('.fancybox').fancybox();
		});
</script>  
</head>
<body class="main_databg">
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
        <ul class="top-nav">
          <li>
            <div class="user-picture"><img src="img/icon_profile-preview-small.png" alt="Profile"></div>
            <b><span>Welcome</span><a href="#">John!</a></b></li>
          <li><a href="#">My profile</a></li>
          <li><a href="login.php">Logout</a></li>
        </ul>
      </div>
      <div class="clear"></div>
    </header>
    <section id="data_container clearfix">
      <section id="portfolio_wrapper" class="clearfix">
        <h2 class="page-header">My Profile</h2>
        <section class="por_contentainer clearfix">
          <figure class="por_picture"> <img src="img/icon_profile-preview-big.png" alt="Profile Preview" > </figure>
          <section class="por_content">
            <div class="por_content_title">
              <h3 class="text-white"><strong class="left">John Smith</strong><span class="right">Irvington High</span></h3>
              <div class="clear"></div>
            </div>
            <div class="por_content_inner">
              <table cellpadding="0" cellspacing="0" border="0" width="100%" class="theme_table pro_table">
                <tr>
                  <td><a href="mailto:jsmith@gmail.com">jsmith@gmail.com</a></td>
                </tr>
                <tr>
                  <td>A10045678</td>
                </tr>
                <tr>
                  <td>9th grade</td>
                </tr>
                <tr>
                  <td>201 S 4th Street  Apt 532<br>
                    San Jose CA - 95112<br>
                    408-727-1100 </td>
                </tr>
              </table>
              <div class="clear"></div>
              <div class="button-raw clearfix">
                <button class="button button-bluenew btn-two-half fancybox fancybox.ajax" href="edit_profile.php">Edit Profile</button>
                <button class="button button-bluenew btn-two-quater b-top-space">Change&nbsp;Password</button>
              </div>
            </div>
          </section>
        </section>
      </section>
      <!--white-popup mfp-hide    (Add mfp-hide for hid popup)-->
      <br>
      <br>
    </section>
    <footer><small>Servicekarma 2013</small> 
      
      <!--<div class="soc_area">
        	<a href="" class="fbicn"></a><a href="" class="twticn"></a><a href="" class="blgicn"></a>
        </div>-->
    <div class="ftr_link"> <a href="">About</a> &nbsp;| <a href="">contact</a> &nbsp;| <a href="">feedback</a> </div>
    </footer>
  </div>
</div>
</body>
</html>
