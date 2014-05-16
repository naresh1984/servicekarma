<?php
$temp = explode("/",$_SERVER['REQUEST_URI']);
//echo "somu". $temp[count($temp)-2];

?>
<nav>    	 
         <a href="<?php echo BASE_FRONTEND_URL; ?>contributions/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='contributions') { ?>  class="active" <?php } ?>>home</a>   
        <a href="<?php echo BASE_FRONTEND_URL; ?>servicerecord/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='servicerecord') { ?>  class="active" <?php } ?>>My Service Record</a>
        <a href="<?php echo BASE_FRONTEND_URL; ?>upcomingevents/" <?php if($temp[count($temp)-1]?$temp[count($temp)-1]:$temp[count($temp)-2]=='upcomingevents') { ?>  class="active" <?php } ?>>Upcoming Events</a>
       &nbsp;&nbsp;
        <div class="mnu_ebtn">
        	<button class="button button-bluenew right fancybox fancybox.ajax" href="<?php echo BASE_FRONTEND_URL; ?>servicehours/add">enter service hours</button>
        </div>
    </nav>