<?php ob_start(); ?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<title><?php echo @$page_title?$page_title:'::SERVICEKARMA::'; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="<?php echo BASE_ADMIN_URL; ?>includes/css/boilerplate.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_ADMIN_URL; ?>includes/css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_ADMIN_URL; ?>includes/css/datatable.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_ADMIN_URL; ?>includes/css/demo_page.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo BASE_ADMIN_URL; ?>includes/js/validate.js"></script>
<script type="text/javascript" src="<?php echo BASE_ADMIN_URL; ?>includes/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASE_ADMIN_URL; ?>includes/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_ADMIN_URL; ?>includes/js/jquery.dataTables.js" ></script>
<script type="text/javascript" src="<?php echo BASE_ADMIN_URL; ?>includes/js/jquery.dataTables.columnFilter.js"></script>
<script type="text/javascript" src="<?php echo BASE_ADMIN_URL; ?>includes/js/FixedHeader.js" ></script>
<script type="text/javascript" src="<?php echo BASE_ADMIN_URL; ?>includes/js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_ADMIN_URL; ?>includes/js/jquery.fancybox.css?v=2.1.5" media="screen" />
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
        <a href="" class="school_logo"><img src="<?php echo BASE_FRONTEND_URL; ?>includes/img/servicekarma-logo.png" /></a>
        <ul class="top-nav">
            <li><div class="user-picture">
            <?php if($_SESSION['user_details'][0]['picture']!=''){?>
            <img src="<?php echo BASE_ADMIN_URL.$_SESSION['user_details'][0]['picture']; ?>" alt="Profile"  height="27">
            <?php }else{ ?>
            <img src="<?php echo BASE_FRONTEND_URL; ?>includes/img/icon_profile-preview-small.png" alt="Profile">
            <?php } ?>
            </div>
                <b><span>Welcome</span><a href="#"><?php echo @$_SESSION['user_details'][0]['firstname']; ?></a></b>
            </li>
            <li><a href="<?php echo BASE_ADMIN_URL; ?>establishments/getProfile" class="fancybox fancybox.ajax">My profile</a></li>
            <li><a href="../../login/logout">Logout</a></li>
        </ul>
    </div>
    <div class="clear"></div>
</header>
<?php include HOME . DS . 'includes' . DS . 'navigation.php'; ?>