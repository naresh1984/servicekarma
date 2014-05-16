<?php
/* echo "<pre>";
 print_r($userDetails);*/
 
                $gradeArr = array("1"=>"12","2"=>"11","3"=>"10","4"=>"9");
				$current_year =date("Y", strtotime(@$userDetails[0]['created_date']));
				$graduation_year_diff = $userDetails[0]['graduation_year']-$current_year;
				@$grade = $gradeArr[$graduation_year_diff];
?>


<div class="pro_window login_area btmpadding ">
      <div class="tooltip_inner">
          <div class="tooltip_inline">
            <div class="form_cont_full pro_window_header clearfix">
              <h4><?php echo $userDetails[0]['firstname'].' '.$userDetails[0]['lastname']; ?> Details</h4>
              <!--<a href="#" class="btn-popup-close"></a>-->
              <div class="clear"></div>
            </div>
<div id="prowrap" style="padding:0px;">
           
            
            <div class="clear"></div>
            	<div id="popwrap"><!--popleftcol--><!--poprightcol-->
                <div id="poppro">
                <?php if($userDetails[0]['picture']!=''){ ?>
                <div id="center"><img src="../../student/<?php echo $userDetails[0]['picture']; ?>" width="103"></div>
                <?php }else{ ?>
                <div id="center"><img src="<?php echo BASE_FRONTEND_URL; ?>includes/img/icon_profile-preview-small.png" width="103"></div>
                <?php } ?>
				<div class="clear"></div>
                <br>
                <?php echo $userDetails[0]['establishment_name']; ?><br>
                <?php echo $userDetails[0]['student_id']; ?><br>
                <?php echo @$grade; ?>th grade
                
                
                </div>
                
                <div id="poppro-details">
                <strong><?php echo $userDetails[0]['firstname'].' '.$userDetails[0]['lastname']; ?></strong>
                <br>
				<?php echo $userDetails[0]['email']; ?><br>
				<?php echo $userDetails[0]['street1']; ?><br>
                <?php echo $userDetails[0]['city'].' '.$userDetails[0]['state_code']; ?> - <?php echo $userDetails[0]['zipcode']; ?><br>
                <?php echo $userDetails[0]['phone']; ?>
                </div>
                </div><!--popwrap-->
                
            <div class="clear"></div>

            <div class="clear"></div>
            </div><!--prowrap-->
          </div>
          </div>
      </div>