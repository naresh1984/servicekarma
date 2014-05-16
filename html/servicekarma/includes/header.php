<?php ob_start();

?><!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title; ?></title>
<meta charset="utf-8">
<link rel="stylesheet" href="<?php echo BASE_FRONTEND_URL; ?>includes/css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo BASE_FRONTEND_URL; ?>includes/css/mediaqueries.css" type="text/css" media="all">
<script type="text/javascript" src="<?php echo BASE_FRONTEND_URL; ?>includes/js/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo BASE_FRONTEND_URL; ?>includes/js/jquery.validate.min.js"></script>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>
<body>
<header>
  <div class="container">
    <section class="userdetails">
	<span class="fleft"><strong><?php echo $_SESSION['employ'][0]['firstname']." ".$_SESSION['employ'][0]['lastname']." - ".$_SESSION['user_details'][0]['id']; ?></strong></span>
        <a href="<?php echo BASE_FRONTEND_URL . 'login/logout'; ?>" class="button fright">Sign Out</a>
    </section>
  	<h1 id="logo"><a href="<?php echo BASE_FRONTEND_URL; ?>employees/appliedLeaves" title="Logictree IT Solutions Pvt. Ltd.">Logictree IT Solutions Pvt. Ltd.</a></h1>
  </div>
  <nav class="clearfix">
  	<div class="container">
        <ul id="menu" class="clearfix">
            <li <?php if($page == 'rl') { echo "class='active'"; } ?>><a href="<?php echo BASE_FRONTEND_URL . 'employees/requestLeave'; ?>">Request for Leave</a></li>
            <li <?php if($page == 'al') { echo "class='active'"; } ?>><a href="<?php echo BASE_FRONTEND_URL . 'employees/appliedLeaves'; ?>">Applied Leaves</a></li>
			<?php if(  count($_SESSION['employ'])>1 && in_array("3",@$_SESSION['roles']) ){?>
            <li <?php if($page == 'el') { echo "class='active'"; } ?>><a href="<?php echo BASE_FRONTEND_URL . 'manager/employeeLeaves'; ?>">Employee's Leaves</a></li>
			<?php } ?>
            <li <?php if($page == 'cp') { echo "class='active'"; } ?>><a href="<?php echo BASE_FRONTEND_URL . 'login/changePassword'; ?>">Change Password</a></li>                        
        </ul>
        <a href="#" id="pull"><span>Menu</span></a>
    </div>
  </nav>
</header>