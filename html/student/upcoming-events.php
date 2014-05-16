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
<title>Home :: Student Upcoming Events</title>
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
    	<a href="index.php">home</a>
        <a href="service-record.php">My Service Record</a>
        <a href="#" class="active right_border">Upcoming Events</a>
        
        <div class="mnu_ebtn">
        	<button class="button button-bluenew right fancybox fancybox.ajax" href="enter_service_hours.php">enter service hours</button>
        </div>
    </nav>
    
    
    <section id="data_container" class="up-event">
    
    	<div class="wrapper-910">
        	<div class="header-wrap">
            	<h2 class="page-header">List of Upcoming Events</h2>                
            </div>
        </div>
        
        <div class="wrapper-910 clearfix">        
        	
            <section class="up-event-content">
            	
            	<div class="por_content_inner entr_area">
                	
                    
                    <table cellpadding="0" cellspacing="0" border="0" width="100%" class="theme_table pro_table no_odd">
                  	<tr class="sub-header">
                    	<td colspan="3">Wednesday, Sep 18</td>
                    </tr>
                    <tr>
                      <td>10:00 am</td>
                      <td>	
                      		
                            <strong>Blood Drive</strong><br>
                            American Red Cross <br>
                            <a href="http://www.redcross.org/donateblood" target="_blank">http://www.redcross.org/donateblood</a>
                        	
                      </td>
                      <td class="event-mark evn-educational"></td>
                    </tr>                    
                    <tr>
                      <td>10:00 am</td>
                      <td>	
                      		
                            <strong>Blood Drive</strong><br>
                            American Red Cross <br>
                            <a href="http://www.redcross.org/donateblood" target="_blank">http://www.redcross.org/donateblood</a>
                        	
                      </td>
                      <td class="event-mark evn-humanitarian"></td>
                    </tr>
                    
                    <tr class="sub-header">
                    	<td colspan="3">Wednesday, Sep 18</td>
                    </tr>                    
                    <tr>
                      <td>5:00 pm</td>
                      <td>	
                      		
                            <strong>Creek Cleanup</strong><br>
                            Clear Creek Services<br>
                            <a href="http://www.redcross.org/creekcleanup" target="_blank">http://www.redcross.org/creekcleanup</a>
                        
                      </td>
                      <td class="event-mark evn-environmental"></td>
                    </tr>
                    
                    <tr class="sub-header">
                    	<td colspan="3">Wednesday, Sep 18</td>
                    </tr>                    
                     <tr>
                      <td>5:00 pm</td>
                      <td>	
                        
                            <strong>Creek Cleanup</strong><br>
                            Clear Creek Services<br>
                            <a href="http://www.redcross.org/creekcleanup" target="_blank">http://www.redcross.org/creekcleanup</a>
                        	
                      </td>
                      <td class="event-mark evn-environmental"></td>
                    </tr>
                  </table>
                
                </div>           
            
            </section>
            <aside class="up-event-sidebar">
            	<div class="event-calender">
                	
                </div>
            	
                <ul class="event-list">
                	<li><div class="event-mark-box evn-educational"></div><span class="text-red">Educational Event</span></li>
                    <li><div class="event-mark-box evn-humanitarian"></div><span class="text-green">Humanitarian Event</span></li>
                    <li><div class="event-mark-box evn-environmental"></div><span class="text-blue">Environmental Event</span></li>
                </ul>
                                            	
            </aside>          
        
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
