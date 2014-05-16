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
<title>Home</title>
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
          <li><a href="profile.php">My profile</a></li>
          <li><a href="login.php">Logout</a></li>
        </ul>
      </div>
      <div class="clear"></div>
    </header>
    
    <nav>
    	<a href="#" class="active">home</a>
        <a href="service-record.php">My Service Record</a>
        <a href="upcoming-events.php" class="right_border">Upcoming Events</a>
       
        <div class="mnu_ebtn">
        	<button class="button button-bluenew right fancybox fancybox.ajax" href="enter_service_hours.php">enter service hours</button>
        </div>
    </nav>
    
    
    <section id="data_container clearfix">
      <section id="home_wrapper" class="clearfix">
        <h2 class="page-header">My Contributions
<!--            <div class="title_ebtn">
                <button class="button button-bluenew">enter service hours</button>
            </div>-->
        </h2>
        
        
        <section class="home_contentainer hme_con_margin clearfix">
          
          
            <div class="por_content_title">
              <h4 class="text-white">Total number of hours: 40</h4>
              <div class="clear"></div>
            </div>
            <div class="por_content_inner">
             	<div class="h_chart"><img src="img/graph.png"></div>
              <div class="clear"></div>
              <div class="button-raw h_cont_hght clearfix">
               		<p class="contain_p">
                    	Approved Service Hours
                    	<span>20</span>
                    </p>
                    <p class="contain_p">
                    	Pending Service Hours
                    	<span>15</span>
                    </p>
                    <p class="contain_p">
                    	Rejected Service Hours
                    	<span>5</span>
                    </p>
                   
              </div>
            </div>
         
        </section>
        
        <section class="home_contentainer clearfix">
          
          
            <div class="por_content_title">
              <h4 class="text-white">How I changed the world!</h4>
              <div class="clear"></div>
            </div>
            
            <div class="noti_icons">
            	<span class="app_icon">Approved</span>
                <span class="pend_icon bor_line">Pending</span>
                <span class="rej_icon">Rejected</span>
            </div>
            
            <div class="por_content_inner entr_area">
              <table cellpadding="0" cellspacing="0" border="0" width="100%" class="theme_table pro_table">
                <tr>
                  <td>
                  		<span class="app_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="pend_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="rej_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="pend_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                 <tr>
                  <td>
                  		<span class="app_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="pend_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="rej_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="pend_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                
                 <tr>
                  <td>
                  		<span class="app_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="pend_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="rej_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="pend_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                
                 <tr>
                  <td>
                  		<span class="app_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="pend_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="rej_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                <tr>
                  <td>
                  		<span class="pend_licon"></span>
                  		<p class="noti_p">Hours for Redcross approved
                        	<small>Sep 16 at 4:00pm</small>
                        </p>
                  </td>
                </tr>
                
                
              </table>
              <div class="clear"></div>
            
            </div>
         	  <div class="button-raw txt_algn_center clearfix">
                <button class="button button-blue btn-two-half b-top-space">see all entries</button>
              </div>
        </section>
        
        
      </section>
      <!--white-popup mfp-hide    (Add mfp-hide for hid popup)-->
      
    </section>
    <footer> <small>Servicekarma 2013</small> 
      
      <!--<div class="soc_area">
        	<a href="" class="fbicn"></a><a href="" class="twticn"></a><a href="" class="blgicn"></a>
        </div>-->
      <div class="ftr_link"> <a href="">About</a> &nbsp;| <a href="">contact</a> &nbsp;| <a href="">feedback</a> </div>
    </footer>
  </div>
</div>
</body>
</html>
