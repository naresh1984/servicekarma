<?php
$temp = explode("/",$_SERVER['REQUEST_URI']);
//echo "somu". $temp[count($temp)-2];

?>
<nav>
    <a href="<?php echo BASE_FRONTEND_URL; ?>assignments/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='assignments') { ?>  class="active" <?php } ?>>home</a>
    <a href="<?php echo BASE_FRONTEND_URL; ?>users/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='users') { ?>  class="active" <?php } ?>>Accounts</a>
    <a href="<?php echo BASE_FRONTEND_URL; ?>students/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='students') { ?>  class="active" <?php } ?>>Students</a>
     <a href="<?php echo BASE_FRONTEND_URL; ?>reports/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='reports') { ?>  class="active" <?php } ?>>Reports</a>
    <a href="<?php echo BASE_FRONTEND_URL; ?>events/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='events') { ?>  class="active" <?php } ?> >Events</a>
    <a href="<?php echo BASE_FRONTEND_URL; ?>organizations/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='organizations') { ?>  class="active" <?php } ?> >Organizations</a>   
    <a href="<?php echo BASE_FRONTEND_URL; ?>categories/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='categories') { ?>  class="active" <?php } ?> >Categories</a> 
</nav>