<?php 
/*echo "<pre>";
print_r(@$eventDetails);*/
$hours = array();
$hours = array("00","01","02","03","04","05","06","07","08","09","10","11","12");
$minutes = array("00","15","30","45");
@$phone = explode('-',@$eventDetails[0]['phone']);
@$start_time = explode(' ',@$eventDetails[0]['start_time']);
@$end_time = explode(' ',@$eventDetails[0]['end_time']);
?> 
  
 <div id="EditProfilePopup" class="pro_window login_area btmpadding ">
        <div class="login_inner">
<div class="login_inner">
  <div class="login_inline">
    <div class="form_cont_full pro_window_header clearfix">
      <h4><?php if(count(@$eventDetails) > 0){ echo 'Edit';}else{ echo 'Add'; } ?> Event</h4>
      <div class="clear"></div>
    </div>
     
<form action="<?php if(count(@$eventDetails) > 0){ echo BASE_FRONTEND_URL.'events/editEvent'; } else{ echo BASE_FRONTEND_URL.'events/add'; } ?>" name="form_events"  id="form_events" method="post">    
<div id="prowrap">
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div id="popwrap">
        <div id="popleftcol">
        
          <div class="popleftform form_cont_full">
            <label>Event Title:</label>
            <br>
            <br>
            <input type="text"  name="event_title" id="event_title" value="<?php echo @$eventDetails[0]['event_title']; ?>" tabindex="1">
          </div>  
          
          <div class="popleftform form_cont_full">
            <label>Organization:</label>
            <br>
            <br>
            <select name="organization" id="organization" onChange="validate_other_organization(this.value);" tabindex="4">
              <option value="">Select Organization</option>
              <?php
			  foreach($allOrganizations as $organization):
			  ?>           
              <option value="<?php echo $organization['organization_id']; ?>" <?php if(@$eventDetails[0]['organization_id'] == $organization['organization_id']){ ?>  selected <?php } ?>><?php echo $organization['organization_name']; ?></option>
              <?php
			  endforeach;
			  ?>
              <option value="0">Other</option>
            </select>
          </div>
          
          <div class="popleftform form_cont_full" id="other_organization_div" style="display:none;">
            <label style="width:50%;">Organization Name:</label>
            <br>
            <br>
            <input type="text"  name="other_organization_name" id="other_organization_name" value="" tabindex="4">
          </div>
          
          <div class="popleftform form_cont_full">
            <label>Start Date:</label>
            <br>
            <br>
            <input type="text" name="from_date" id="from_date" value="<?php if(@$eventDetails[0]['from_date']!='') { echo date("m/d/Y", strtotime(@$eventDetails[0]['from_date'])); } ?>" readonly style="background:url(<?php echo BASE_FRONTEND_URL ; ?>includes/img/icon_calendar.png) right no-repeat;" tabindex="6"/>                   
          </div>
          
            <div class="popleftform form_cont_full">
                <label>Start Time:</label>
                <br><br>
                <select name="start_hour" id="start_hour" style="width:30%" tabindex="8">
                <?php
					foreach ($hours as $hour)
					{
				?>
                	<option value="<?php echo $hour; ?>" <?php if(@$start_time[0]==$hour) { echo "selected='selected'"; } ?>><?php echo $hour; ?></option>
                <?php
					}
				?>
                </select>
                <select name="start_minute" id="start_minute" style="width:30%" tabindex="9">
                <?php
					foreach ($minutes as $minute)
					{
				?>
                	<option value="<?php echo $minute; ?>" <?php if(@$start_time[1]==$minute) { echo "selected='selected'"; } ?>><?php echo $minute; ?></option>
                <?php
					}
				?>
                </select>
                <select name="start_am_pm" id="start_am_pm" style="width:30%" tabindex="10">
                    <option <?php if(@$start_time[2]=="AM") { echo "selected='selected'"; } ?>>AM</option>
                    <option <?php if(@$start_time[2]=="PM") { echo "selected='selected'"; } ?>>PM</option>
                </select>
            </div>            
          
          <div class="popleftform form_cont_full">
            <label>Address:</label>
            <br>
            <br>
            <textarea cols="1" rows="1" name="address" id="address" class="expandable" tabindex="14"><?php echo @$eventDetails[0]['street1']; ?></textarea>
          </div>
          
          <div class="popleftform form_cont_full" id="city_result">
            <label>City:</label>
            <br>
            <br>
            <select name="city" id="city" tabindex="16">
              <option value="">Select City</option>
              <?php
				  foreach(@$allCities as $cities):
				  ?>
          <option value="<?php echo @$cities['id']; ?>" <?php if($cities['id']==$eventDetails[0]['city_id']){ ?> selected <?php } ?>><?php echo @$cities['city']; ?></option>
          <?php
				  endforeach;
				  ?>
            </select>
          </div>
          
          <div class="popleftform form_cont_full">
            <label>Phone&nbsp; Number:</label>
            <br>
            <br>
            <input type="tel" class="sm_input" name="phone_1" id="phone_1" maxlength="3" value="<?php echo @$phone[0];?>" tabindex="18">
            <input type="tel" class="sm_input" name="phone_2" id="phone_2" maxlength="3" value="<?php echo @$phone[1];?>" tabindex="19">
            <input type="tel" class="mid_input" name="phone_3" id="phone_3" maxlength="4" value="<?php echo @$phone[2];?>" tabindex="20">
          </div>
          <div id="phone_num">             
          </div>
          
          <div class="popleftform form_cont_full">
            <label style="width:50%;">Volunteer Capacity:</label>
            <br>
            <br>
            <input type="text" id="volunteer_capacity" name="volunteer_capacity"  value="<?php echo @$eventDetails[0]['volunteer_capacity']; ?>" tabindex="22">
          </div>
          
          <div class="popleftform form_cont_full" style="padding-top:30px;">
         	 <input type="checkbox" id="is_proof_required" name="is_proof_required" value="1" <?php if(@$eventDetails[0]['is_proof_required'] == 'Yes') { ?> checked="checked" <?php } ?> tabindex="24"> Is Proof Required?
		  </div>
          
          
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
            <label>Category:</label>
            <br>
            <br>
            <select name="category" id="category"  onChange="validate_other_category(this.value);" tabindex="2">
              <option value="">Select Category</option>
              <?php
			  foreach($allCategories as $category):
			  ?>           
              <option value="<?php echo $category['id']; ?>" <?php if(@$eventDetails[0]['category_id'] == $category['id']){ ?>  selected <?php } ?>><?php echo $category['category_name']; ?></option>
              <?php
			  endforeach;
			  ?>
              <option value="0">Other</option>
            </select>
          </div>
          
          <div class="poprightform form_cont_full" id="other_category_div" style="display:none;">
            <label>Category Name:</label>
            <br>
            <br>
            <input type="text"  name="other_category_name" id="other_category_name" value="" tabindex="3">
          </div>
        
         <div class="poprightform form_cont_full">
            <label>Contact Email:</label>
            <br>
            <br>
            <input type="text"  name="email" id="email" value="<?php echo @$eventDetails[0]['email']; ?>" tabindex="5">
          </div>
          
          <div class="poprightform form_cont_full">
            <label>End Date:</label>
            <br>
            <br>
            <input type="text" name="to_date" id="to_date" value="<?php if(@$eventDetails[0]['to_date']!='') { echo date("m/d/Y", strtotime(@$eventDetails[0]['to_date'])); } ?>" readonly style="background:url(<?php echo BASE_FRONTEND_URL ; ?>includes/img/icon_calendar.png) right no-repeat;" tabindex="7"/>                   
          </div>
          
         <div class="poprightform form_cont_full">
            <label>End Time:</label>
            <br><br>
            <select name="end_hour" id="end_hour" style="width:30%" tabindex="11">
            <?php
                foreach ($hours as $hour)
                {
            ?>
                <option value="<?php echo $hour; ?>" <?php if(@$end_time[0]==$hour) { echo "selected='selected'"; } ?>><?php echo $hour; ?></option>
            <?php
                }
            ?>
            </select>
            <select name="end_minute" id="end_minute" style="width:30%" tabindex="12">
            <?php
                foreach ($minutes as $minute)
                {
            ?>
                <option value="<?php echo $minute; ?>" <?php if(@$end_time[1]==$minute) { echo "selected='selected'"; } ?>><?php echo $minute; ?></option>
            <?php
                }
            ?>
            </select>
            <select name="end_am_pm" id="end_am_pm" style="width:30%" tabindex="13">
                <option value="AM" <?php if(@$end_time[2]=="AM") { echo "selected='selected'"; } ?>>AM</option>
                <option value="PM" <?php if(@$end_time[2]=="PM") { echo "selected='selected'"; } ?>>PM</option>
            </select>
        </div> 
          
          <div class="poprightform form_cont_full">
            <label>State:</label>
            <br>
            <br>
            <select name="state" id="state" onChange="getCitiesEvents(this.value)" tabindex="15">
              <option value="">Select State</option>
              <?php
			  foreach($allStates as $states):
			  ?>           
              <option value="<?php echo $states['id']; ?>" <?php if(@$eventDetails[0]['state_id'] == $states['id']){ ?>  selected <?php } ?>><?php echo $states['state']; ?></option>
              <?php
			  endforeach;
			  ?>
            </select>
          </div>
          
          <div class="poprightform form_cont_full">
            <label>Zip Code:</label>
            <br>
            <br>
            <input type="text" id="zipcode" name="zipcode" maxlength="5" value="<?php echo @$eventDetails[0]['zipcode']; ?>" tabindex="17">
          </div>    
          
          <div class="poprightform form_cont_full">
            <label style="width:60%;">Link to Event page (url):</label>
            <br>
            <br>
            <input type="text" id="website" name="website"  value="<?php echo @$eventDetails[0]['url']; ?>" tabindex="21">
          </div>
                    
           <div class="poprightform form_cont_full">
            <label>Description:</label>
            <br>
            <br>
            <textarea cols="1" rows="1" name="description" id="description" class="expandable" tabindex="23"><?php echo @$eventDetails[0]['description']; ?></textarea>
          </div>
          
          <div class="poprightform form_cont_full">
            <label>Status:</label>
            <br>
            <br>
            <select name="status" id="status" tabindex="25">
              <option value="Active" selected="selected">Active</option>
			  <option value="Inactive" <?php if(@$eventDetails[0]['event_status'] == 'Inactive') { ?> selected="selected" <?php } ?>>Inactive</option>
            </select>
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
        <input type="hidden" name="id" id="id" value="<?php echo @$eventDetails[0]['event_id']; ?>">
		<input type="hidden" name="profile_id" id="profile_id" value="<?php echo @$eventDetails[0]['profile_id']; ?>">
        <input type="button" name="Add" value="<?php if(count(@$eventDetails) > 0){ echo 'Save'; } else { echo 'Add'; } ?>" class="button button-darkgray btn-two-half left" onClick="validate_events();">
        <input type="button"  class="button button-bluenew btn-two-half left"  onClick="close_fancy();" value="Cancel">
      </div>
      <div class="clear"></div>
    </div>
<script language="javascript">

function close_fancy(){$.fancybox.close(); return false;}
$('#zipcode').mask('00000');
$('#phone_1').mask('000');
$('#phone_2').mask('000');
$('#phone_3').mask('0000');
/*$('#volunteer_capacity').mask('000000');*/

$('#from_date').datetimepicker({step:15,format:'m/d/Y',validateOnBlur:false,timepicker:false});
$('#to_date').datetimepicker({step:15,format:'m/d/Y',validateOnBlur:false,timepicker:false});

</script> 