<?php 
/*echo "<pre>";
print_r(@$assignmentDetails);*/
function convertToHoursMins($time) 
{
	settype($time, 'integer');
	if ($time < 1) 
	{
		return;
	}
	$hours = floor($time / 60);
	$minutes = ($time % 60);
	return array($hours, $minutes);
}

$convert_pending_minutes = convertToHoursMins($assignmentDetails[0]['pending_minutes']);
if(count($convert_pending_minutes) == 0)
{
	$convert_pending_minutes = array(0,0);
}

$convert_approved_minutes = convertToHoursMins($assignmentDetails[0]['approved_minutes']);
if(count($convert_approved_minutes) == 0)
{
	$convert_approved_minutes = array(0,0);
}
?>
 <div class="pro_window login_area btmpadding" style="width:90%; max-width:none;">
        <div class="login_inner">
          <div class="login_inline">
            <div class="form_cont_full pro_window_header clearfix">
              <h4>Approve Service Hours</h4>
              <!--<a href="#" class="btn-popup-close"></a>-->
              <div class="clear"></div>
            </div>
<div id="prowrap">
            <!--raw #1-->
            <div class="clear"></div>
            
            <!--raw #2-->
            <div class="clear"></div>
            
            <!--raw #3-->
            <div class="clear"></div>
            
            <!--raw #4-->
            <div class="clear"></div>
            <form name="form_assignments" id="form_assignments" method="post">
            	<div id="popwrap">
                	
                    <div id="popleftcol">
                    <div class="heading">Service Details</div>
                    <div class="popleftform">
                    <label>Organization / Event:</label>
                    <label class="label1"><?php echo @$assignmentDetails[0]['organization_event']; ?></label>
                    </div>
                    <div class="popleftform">
                    <label>Date Range:</label>
                    <label class="label1"><?php echo date("m/d/Y", strtotime(@$assignmentDetails[0]['from_date']))." - ".date("m/d/Y", strtotime(@$assignmentDetails[0]['to_date'])); ?></label>
                    </div>
                     <div class="popleftform">
                    <label>Location:</label>
                    <div class="leftcont" ><?php echo @$assignmentDetails[0]['street1']; ?><br />
                    <?php echo @$assignmentDetails[0]['city']." ".@$assignmentDetails[0]['state_code']; ?> - <?php echo @$assignmentDetails[0]['zipcode']; ?></div><br>
                    </div>
                     <br>

					<div class="popleftform">
                    <label>Number of Hours:</label>
                    <label class="label1"><?php echo $assignmentDetails[0]['hours'].":".$assignmentDetails[0]['minutes']; ?></label>
					</div>
                     <div class="popleftform">
                    <label>Comments / Notes:</label>
                     <div class="leftcont" >
                      <?php echo @$assignmentDetails[0]['comments']; ?>&nbsp;
                    </div>                   
                     </div>
                    <div class="popleftform">
                    <label>Document:</label>
                    <?php
					if($assignmentDetails[0]['document']!='')
					{
					?>
                    	<div class="leftcont"><a href="<?php echo BASE_URL."student/".$assignmentDetails[0]['document']; ?>" target="_blank" style="text-decoration:none;"><img src="<?php echo BASE_URL."student/".$assignmentDetails[0]['document']; ?>" alt="" style="width:1000px;" ></a></div>
                    <?php
					}
					else
					{
					?>
                    	<div class="leftcont">-<img src="<?php echo BASE_URL."student/upload/empty_document.png"; ?>" alt="" style="width:1000px;"/></div>
                    <?php
					}
					?>
                    </div>
                    
                    <div id="reject_reason_div" style="display:none;">
                        <div class="popleftform form_cont_full">
                        <label>Rejected Reason:</label>
                        <br>
                        <br>
                        <textarea rows="1" name="rejected_reason" id="rejected_reason" class="expandable"></textarea>
                       </div>
                    </div>
                  </div><!--popleftcol-->
                    
                    <div id="pop-vdivider" style="height:50px;;"></div>
                    
                    <div id="poprightcol">
                    
                    <div class="heading">Student Details</div>
                    <div class="poprightform">
                    <label>Student Name:</label>
                    <label class="label1"><?php echo $assignmentDetails[0]['firstname']." ".$assignmentDetails[0]['lastname']; ?></label>
                    </div>
                    
                     <div class="poprightform">
                    <label>Student ID:</label>
                    <label class="label1"><?php echo $assignmentDetails[0]['student_school_id']; ?></label>
                    </div>
                     <div class="poprightform">
                    <label>Pending service hours:</label>
                    <label class="label1"><?php echo $assignmentDetails[0]['pending_hours']+$convert_pending_minutes[0].":".$convert_pending_minutes[1]; ?></label>
                    </div>
                     
                     <br>

					<div class="poprightform">
                    <label>Approved service  hours:</label>
                    <label class="label1"><?php echo $assignmentDetails[0]['approved_hours']+$convert_pending_minutes[0].":".+$convert_pending_minutes[1]; ?></label>
					</div>     
                     
                                         
                  </div><!--poprightcol-->  
                
                </div><!--popwrap-->
             <input type="hidden" name="servicehour_id" id="servicehour_id" value="<?php echo $assignmentDetails[0]['service_hours_id']; ?>" >           
            <div class="form_cont buton_right">            	
                <input type="button" name="approve" value="Approve" class="button button-darkgray btn-third-one left" onClick="approve_reject_assignment('approve');">
                <input type="button" name="reject" value="Reject" class="button button-darkgray btn-third-one left" onClick="approve_reject_assignment('reject');">
                <input type="button" name="rejectemail" value="Reject and Send Mail" class="button button-darkgray btn-third-one left" onClick="approve_reject_assignment('rejectemail');">                
                <input type="button" class="button button-bluenew btn-third-one right"  onClick="close_fancy();" value="Cancel">
            </div>
            </form>
            <div class="clear"></div>
                
                
            <!--raw #5-->
            <div class="clear"></div>
            <div class="clear"></div>
            </div><!--prowrap-->
          </div>
        </div>
      </div>
      
<script language="javascript">
	function close_fancy(){$.fancybox.close(); return false;}
</script>