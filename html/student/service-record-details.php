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
<title>Approve Service Hour</title>
<link href="css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="css/default.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css">

<!-- Magnific Popup core CSS file -->
<!--<link rel="stylesheet" href="css/magnific-popup.css">-->
<link type="text/css" href="css/jquery.datepick.css" rel="stylesheet">

<!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<!-- Magnific Popup core JS file -->
<!--<script src="js/jquery.magnific-popup.min.js"></script>-->


<script type="text/javascript" src="js/jquery.datepick.js"></script>

<script type="text/javascript">

	jQuery().ready(function($)  {
		
		
  		//your code here
		
		
		$('#from_date').datepick({showTrigger: '<img src="img/icon_calendar.png" alt="From Date" class="calendar_icon"></img>'});
		$('#to_date').datepick({showTrigger: '<img src="img/icon_calendar.png" alt="To Date" class="calendar_icon"></img>'});
		
		
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
<script src="js/modernizr.js"></script>

<!--				check box				-->
<script type='text/javascript' src="js/custom-form-elements.js"></script>

<!--					check box				-->

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
          <li class="user-text"><div class="user-picture"><img src="img/icon_profile-preview-small.png" alt="Profile"></div><b><span>Welcome</span><a href="#">John!</a></b> <span>|</span></li>
          <li><a href="profile.php">My profile</a><span>|</span></li>
          <li><a href="login.php">Logout</a></li>
        </ul>
      </div>
      <div class="clear"></div>
    </header>
    <section id="data_container clearfix">
      
      <!--white-popup mfp-hide    (Add mfp-hide for hid popup)-->
      <div id="EventServiceHour" class="pro_window login_area btmpadding ">
        <div class="login_inner">
          <div class="login_inline">
            
            <div class="form_cont_full pro_window_header clearfix">
              <h4>Service Details</h4>
              <a href="#" class="btn-popup-close"></a>
              <div class="clear"></div>
            </div>
            
            <div class="pro_window_content">
            
            	<div class="col col-100" style="background:#efefef;">
                	
                    <table cellpadding="0" cellspacing="0" border="0" class="theme_table" width="100%">
                        <tbody>
                            <tr>
                              <td>Organization:</td>
                              <td>Red Cross</td>                         
                            </tr> 
                            
                            <tr>
                              <td>Type of Event:</td>
                              <td>Humantarian</td>                         
                            </tr>
                            
                            <tr>
                              <td>Date Range:</td>
                              <td>9/5/13 - 9/10/13</td>                         
                            </tr>
                            
                            <tr>
                              <td>Location:</td>
                              <td>
                              	One Washinton Street<br>
                                San Jose<br>
                                CA - 95192
                              </td>                         
                            </tr>
                            
                            <tr>
                              <td>Number of hours:</td>
                              <td>4</td>                         
                            </tr>
                            
                            <tr>
                              <td>Comments/Notes:</td>
                              <td>Trained for a year to prepare for White Stag Leadership Camp learning leadership skills</td>                         
                            </tr>
                            
                            <tr>
                              <td>Document:</td>
                              <td>
                              	<img src="img/icon_profile-preview-big.png" alt="Img1">
                                <br>
                              	Img1.png
                              </td>                         
                            </tr>
                            
                            <tr>
                              <td>Status:</td>
                              <td>Rejected</td>                         
                            </tr>
                            
                            <tr>
                              <td>Reason for Rejected:</td>
                              <td>Reason</td>                         
                            </tr>
                                
                        </tbody>
                      </table>
                    
                    
                </div>
                
<!--                <div class="col col-40">
                	
                    <table cellpadding="0" cellspacing="0" border="0" class="theme_table" width="100%">
                    	<thead class="lightheader">
                        	<tr>
                            	<th colspan="2" height="30px" class="text-white">
                                	<h3 class="text-white">Student Details</h3>                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>Student Name:</td>
                              <td>John Doe</td>                         
                            </tr> 
                            
                            <tr>
                              <td>Student ID:</td>
                              <td>A1234567</td>                         
                            </tr>
                            
                            <tr>
                              <td>Pending service hours:</td>
                              <td>10</td>                         
                            </tr>
                            
                            <tr>
                              <td>Approved service hours:</td>
                              <td>60</td>                         
                            </tr>
                                                   
                            </tr>
                                
                        </tbody>
                      </table>
                    
                </div>-->
                
                   
                <div class="clear"></div>
                <div class="buton_right" align="center" >
                
                	
<!--                    <button class="button button-green btn-two-half">Reject</button>
                    <button class="button button-green btn-two-half">Reject and send email</button>
                    
                    <div class="clear"></div>
                    <br>
                                        
                	<button class="button button-bluenew btn-two-half">Approve</button>
                    <button class="button button-darkgray btn-two-half">Cancel</button>
                    <br>  -->                  
                    
                </div>
                <div class="clear"></div>
                
            </div>
            
            
          </div>
        </div>
      </div>
   
    
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
