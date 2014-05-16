<?php 
/*echo "<pre>";
print_r(@$servicehoursDetails);*/
$minutes = array();
$minutes = array("00","15","30","45");
@$phone = explode('-',@$servicehoursDetails[0]['phone']);
//print_r($minutes);
?>
    
 <div id="EditProfilePopup" class="pro_window login_area btmpadding ">
        <div class="login_inner">
<div class="login_inner">
  <div class="login_inline">
    <div class="form_cont_full pro_window_header clearfix">
      <h4><?php if(count(@$servicehoursDetails) > 0){ echo 'Edit';}else{ echo 'Enter'; } ?> Service hours</h4>
      <div class="clear"></div>
    </div>
     
<form action="<?php if(count(@$servicehoursDetails) > 0){ echo BASE_FRONTEND_URL.'servicehours/editServicehours'; } else{ echo BASE_FRONTEND_URL.'servicehours/add'; } ?>" enctype="multipart/form-data" name="form_servicehours"  id="form_servicehours" method="post">    
<div id="prowrap">
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div id="popwrap">
        <div id="popleftcol">
        
          <div class="popleftform form_cont_full">
            <label style="width:50%;">Organization / Event:</label>
            <br>
            <br>        
            <div id="auto_organization_event" style="vertical-align:middle;">    
            	<input type="text"  name="organization_event" id="organization_event" value="<?php echo @$servicehoursDetails[0]['organization_event']; ?>" tabindex="1">  
            </div>         
          </div>
          
          <div class="popleftform form_cont_full">
            <label>From Date:</label>
            <br>
            <br>
            <input type="text" name="from_date" id="from_date" value="<?php if(@$servicehoursDetails[0]['from_date']!='') { echo date("m/d/Y", strtotime(@$servicehoursDetails[0]['from_date'])); } ?>" readonly style="background:url(<?php echo BASE_FRONTEND_URL ; ?>includes/img/icon_calendar.png) right no-repeat;" tabindex="4"/>     
          </div>
          
          <div class="popleftform form_cont_full">
            <label>Email:</label>
            <br>
            <br>
            <input type="text"  name="email" id="email" value="<?php echo @$servicehoursDetails[0]['email']; ?>" tabindex="6">
          </div>   
          
          <div class="popleftform form_cont_full">
            <label>State:</label>
            <br>
            <br>
            <select name="state" id="state" onChange="getCitiesUsers(this.value)" tabindex="8">
              <option value="">Select State</option>
              <?php
			  foreach($allStates as $states):
			  ?>           
              <option value="<?php echo $states['id']; ?>" <?php if(@$servicehoursDetails[0]['state_id'] == $states['id']){ ?>  selected <?php } ?>><?php echo $states['state']; ?></option>
              <?php
			  endforeach;
			  ?>
            </select>
          </div>   
          
          <div class="popleftform form_cont_full">
            <label>Zip Code:</label>
            <br>
            <br>
            <input type="text" id="zipcode" name="zipcode" maxlength="5" value="<?php echo @$servicehoursDetails[0]['zipcode']; ?>" tabindex="10">
          </div>  
          
          <div class="popleftform form_cont_full">
            <label>Comments/Notes:</label>
            <br>
            <br>
            <textarea cols="1" rows="1" name="comments" id="comments" class="expandable" tabindex="14"><?php echo @$servicehoursDetails[0]['comments']; ?></textarea>
          </div>
          
<?php /*?>          <div class="popleftform form_cont_full">
            <label>Picture:</label>
            <br>
            <br>
            <input type="file" id="file" name="file" tabindex="12"><?php if(@$servicehoursDetails[0]['picture']!='') { ?><img src="<?php echo "../../school/".@$servicehoursDetails[0]['picture']; ?>" width="50"><?php } ?>
          </div> <?php */?>  
          
          <div class="popleftform"></div>
          <div class="popleftform"></div>
          <div class="popleftform"><br>
          </div>
          <br>
          <div class="popleftform"> </div>
        </div>
        <div id="pop-vdividernull"></div>
        <div id="poprightcol">
        
         <div class="poprightform form_cont_full">
            <label style="width:100%"><span style="width:60%">Hours Volunteered</span> &nbsp; <span style="width:30%; float:right;">Minutes</span></label>
            <br>
            <br>
            <input type="text"  name="hours_volunteered" id="hours_volunteered" value="<?php echo @$servicehoursDetails[0]['hours_volunteered']; ?>" tabindex="2" style="width:60%;" maxlength="3">
            <select name="minutes_volunteered" id="minutes_volunteered" style="width:30%" tabindex="3">
            <?php		
                foreach($minutes as $minute)
                {
					
            ?>
               <option value="<?php echo $minute; ?>" <?php if(@$servicehoursDetails[0]['minutes_volunteered']==$minute) { echo "selected='selected'"; } ?>><?php echo $minute; ?></option>
            <?php
                }
            ?>
            </select>
          </div>
        
          <div class="poprightform form_cont_full">
            <label>To Date:</label>
            <br>
            <br>
            <input type="text" name="to_date" id="to_date" value="<?php if(@$servicehoursDetails[0]['to_date']!='') { echo date("m/d/Y", strtotime(@$servicehoursDetails[0]['to_date'])); } ?>" readonly style="background:url(<?php echo BASE_FRONTEND_URL ; ?>includes/img/icon_calendar.png) right no-repeat;" tabindex="5"/>                   
          </div>
          
          <div class="poprightform form_cont_full">
            <label>Address:</label>
            <br>
            <br>
            <textarea cols="1" rows="1" name="address" id="address" class="expandable" tabindex="7"><?php echo @$servicehoursDetails[0]['street1']; ?></textarea>
          </div>    
          
          <div class="poprightform form_cont_full" id="city_result">
            <label>City:</label>
            <br>
            <br>
            <select name="city" id="city" tabindex="9">
              <option value="">Select City</option>
              <?php
				  foreach(@$allCities as $cities):
				  ?>
          <option value="<?php echo @$cities['id']; ?>" <?php if($cities['id']==$servicehoursDetails[0]['city_id']){ ?> selected <?php } ?>><?php echo @$cities['city']; ?></option>
          <?php
				  endforeach;
				  ?>
            </select>
          </div> 
          
         <div class="poprightform form_cont_full">
            <label>Phone&nbsp; Number:</label>
            <br>
            <br>
            <input type="tel" class="sm_input" name="phone_1" id="phone_1" maxlength="3" value="<?php echo @$phone[0];?>" tabindex="11">
            <input type="tel" class="sm_input" name="phone_2" id="phone_2" maxlength="3" value="<?php echo @$phone[1];?>" tabindex="12">
            <input type="tel" class="mid_input" name="phone_3" id="phone_3" maxlength="4" value="<?php echo @$phone[2];?>" tabindex="13">
          </div>
          <div id="phone_num">             
          </div>
  

          <div class="popleftform"></div>
          <div class="popleftform"></div>
          <div class="popleftform"><br>
          </div>
          <br>
          <div class="popleftform"> </div>
        </div>
      </div>
      <div class="clear"></div>
      <div class="form_cont buton_right">
	    <input type="hidden" name="image_url" id="image_url" value="<?php echo @$servicehoursDetails[0]['picture']; ?>">
        <input type="hidden" name="id" id="id" value="<?php echo @$servicehoursDetails[0]['user_id']; ?>">
		<input type="hidden" name="profile_id" id="profile_id" value="<?php echo @$servicehoursDetails[0]['profile_id']; ?>">
        <input type="file" id="file" name="file" style="display: none;" tabindex="15"/>
        <input type="button"  class="button button-bluenew left" id="image_upload" name="image_upload" onClick="#" value="chooose file" style="width:30%; margin-right:5px;">        
        <input type="button" name="Add" value="<?php if(count(@$servicehoursDetails) > 0){ echo 'Save'; } else { echo 'Submit'; } ?>" class="button button-bluenew left" onClick="validate_servicehours();" style="width:30%; margin-right:5px;" tabindex="16">
        <input type="button"  class="button button-darkgray left"  onClick="close_fancy();" value="Cancel" style="width:30%; margin-right:5px;" tabindex="17">
      </div>
      <div class="clear"></div>
    </div>

<script language="javascript">
function close_fancy(){$.fancybox.close(); return false;}
$('#phone_1').mask('000');
$('#phone_2').mask('000');
$('#phone_3').mask('0000');
$('#zipcode').mask('00000');
$('#hours_volunteered').mask('000');

$('#from_date').datetimepicker({step:15,format:'m/d/Y',validateOnBlur:false,timepicker:false});
$('#to_date').datetimepicker({step:15,format:'m/d/Y',validateOnBlur:false,timepicker:false});

$("#image_upload").click(function() {
    $("input[id='file']").click();
	return false;
});
</script> 



