<!DOCTYPE html>
<html lang="en">
<head>
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, width=device-width" />
<link rel="stylesheet" href="<?php echo BASE_FRONTEND_URL; ?>includes/css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo BASE_FRONTEND_URL; ?>includes/css/mediaqueries.css" type="text/css" media="all">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<header>
    <div class="container">
    	<h1 id="logo" style="margin:0 auto; float:none; width:199px; margin-top:50px;"><a href="<?php echo BASE_FRONTEND_URL . 'login/index'; ?>" title="Logictree IT Solutions Pvt. Ltd.">Logictree IT Solutions Pvt. Ltd.</a></h1>
    </div>
</header>
<section id="body">
  <div class="container">
	<?php
	    
        if (isset($errors))
        {
            echo '<ul class="errors">';
            foreach ($errors as $e)
            {
                echo '<li>' . $e . '</li>';
            }
            echo '</ul>';
        } 
        
        if(isset($saveError))
        {
            echo "<h2>Error saving data. Please try again.</h2>" . $saveError;
        }
		$url = 'login/checkLogin/';
		if(@$redirect_url!=""){
			$url .= 'redirect='.@$redirect_url;
		}
    ?>  
    <form method="post" action="<?php echo BASE_FRONTEND_URL . $url ?>">
    	<div style="background:#f9f9f9; border:solid 1px #0d5478; padding:30px; margin:0 auto; border-radius:10px;" class="login">
        <table class="table2 login">
		  <tbody>
          <tr>
			<td>Username:</td>
			<td><input type="text" name="username" id="username"></td>			
		  </tr>
		  <tr>
			<td>Password:</td>
			<td><input type="password" name="password" id="password"></td>			
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="loginSubmit" class="button" value="Submit"></td>			
		  </tr>
		</tbody></table>
        </div>
    </form>
  </div>
</section>
<?php include HOME . DS . 'includes' . DS . 'footer.php'; ?>