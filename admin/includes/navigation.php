<?php
$temp = explode("/",$_SERVER['REQUEST_URI']);
//echo "somu". $temp[count($temp)-1];

?>

<nav>
    <a href="<?php echo BASE_ADMIN_URL; ?>establishments/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='establishments') { ?>  class="active" <?php } ?> >Establishments</a>   
    <a href="<?php echo BASE_ADMIN_URL; ?>users/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='users') { ?>  class="active" <?php } ?> >Users</a>
    <a href="<?php echo BASE_ADMIN_URL; ?>reports/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='reports') { ?>  class="active" <?php } ?> >Reports</a>   
</nav>