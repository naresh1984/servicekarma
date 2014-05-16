<?php 
/*echo "<pre>";
print_r($userDetails);*/
@$phone = explode('-',@$userDetails[0]['phone']);
?>
    
 <div id="EditProfilePopup" class="pro_window login_area btmpadding ">
        <div class="login_inner">
<div class="login_inner">
  <div class="login_inline">
    <div class="form_cont_full pro_window_header clearfix">
      <h4><?php if(count(@$userDetails) > 0){ echo 'Edit';}else{ echo 'Add'; } ?> Student</h4>
      <div class="clear"></div>
    </div>
     
<form action="<?php if(count(@$userDetails) > 0){ echo BASE_FRONTEND_URL.'students/editUser'; } else{ echo BASE_FRONTEND_URL.'students/add'; } ?>" enctype="multipart/form-data" name="form_users"  id="form_users" method="post">    
<div id="prowrap">
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div id="popwrap">
        <div id="popleftcol">
        
          <div class="popleftform form_cont_full">
            <label>First Name:</label>
            <br>
            <br>
            <input type="text"  name="first_name" id="first_name" value="<?php echo @$userDetails[0]['firstname']; ?>" tabindex="1">
          </div>
          
          <div class="popleftform form_cont_full">
            <label>Email:</label>
            <br>
            <br>
            <input type="text"  name="email" id="email" value="<?php echo @$userDetails[0]['email']; ?>" tabindex="3">
          </div>
                
        <div class="popleftform form_cont_full">
            <label>Graduation Year:</label>
            <br>
            <br>
            <?php 
			 
			if(count(@$userDetails) > 0){
				    $graduation_year_start = date("Y", strtotime(@$userDetails[0]['created_date']))+1;
                    $num_years=$userDetails[0]['graduation_years']?$userDetails[0]['graduation_years']:0;
			}else{
				 $graduation_year_start = date('Y')+1;
				 $num_years = $establishmentDetails[0]['graduation_years']?$establishmentDetails[0]['graduation_years']:0;
			}?>
            <select name="graduation_year" id="graduation_year" tabindex="5">
                 <option value="">Select Graduation Year</option>
                <?php for($g=$graduation_year_start;$g<$graduation_year_start+$num_years;$g++){ ?>
                	<option value="<?php echo $g; ?>" <?php if(@$userDetails[0]['graduation_year']==$g){echo "selected";} ?>><?php echo $g; ?></option>
                <?php } ?>
            
            </select>
            
        </div>      

          <div class="popleftform form_cont_full">
            <label>State:</label>
            <br>
            <br>
            <select name="state" id="state" onChange="getCitiesUsers(this.value)" tabindex="7">
              <option value="">Select State</option>
              <?php
			  foreach($allStates as $states):
			  ?>           
              <option value="<?php echo $states['id']; ?>" <?php if(@$userDetails[0]['state_id'] == $states['id']){ ?>  selected <?php } ?>><?php echo $states['state']; ?></option>
              <?php
			  endforeach;
			  ?>
            </select>
          </div>
          <div class="popleftform form_cont_full">
            <label>Zip Code:</label>
            <br>
            <br>
            <input type="text" id="zipcode" name="zipcode" maxlength="5" value="<?php echo @$userDetails[0]['zipcode']; ?>" tabindex="9">
          </div>  
          
          
          <div class="popleftform form_cont_full">
            <label>Picture:</label>
            <br>
            <br>
            <input type="file" id="file" name="file" tabindex="13"><?php if(@$userDetails[0]['picture']!='') { ?><img src="<?php echo "../../student/".@$userDetails[0]['picture']; ?>" width="50"><?php } ?>
          </div>   
		  
		  <div class="popleftform form_cont_full">
            <label>Status:</label>
            <br>
            <br>
            <select name="status" id="status" tabindex="18">
              <option value="Active" selected="selected">Active</option>
			  <option value="Inactive" <?php if(@$userDetails[0]['user_status'] == 'Inactive') { ?> selected="selected" <?php } ?>>Inactive</option>
            </select>
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
            <label>Last Name:</label>
            <br>
            <br>
            <input type="text"  name="last_name" id="last_name" value="<?php echo @$userDetails[0]['lastname']; ?>" tabindex="2">
          </div>
                   
            <div class="poprightform form_cont_full">
            <label>Student ID:</label>
            <br>
            <br>
            <input type="text"  name="student_id" id="student_id" value="<?php echo @$userDetails[0]['student_id']; ?>" tabindex="4">
            </div> 
            <div class="poprightform form_cont_full">
                <label>Address:</label>
                <br>
                <br>
                <textarea cols="1" rows="1" name="address" id="address" class="expandable" tabindex="6"><?php echo @$userDetails[0]['street1']; ?></textarea>
              </div>      
          
          <div class="poprightform form_cont_full" id="city_result">
            <label>City:</label>
            <br>
            <br>
            <select name="city" id="city" tabindex="8">
              <option value="">Select City</option>
              <?php
				  foreach(@$allCities as $cities):
				  ?>
          <option value="<?php echo @$cities['id']; ?>" <?php if($cities['id']==$userDetails[0]['city_id']){ ?> selected <?php } ?>><?php echo @$cities['city']; ?></option>
          <?php
				  endforeach;
				  ?>
            </select>
          </div>
          <div class="poprightform form_cont_full">
            <label>Phone&nbsp; Number:</label>
            <br>
            <br>
            <input type="tel" class="sm_input" name="phone_1" id="phone_1" maxlength="3" value="<?php echo @$phone[0];?>" tabindex="10">
            <input type="tel" class="sm_input" name="phone_2" id="phone_2" maxlength="3" value="<?php echo @$phone[1];?>" tabindex="11">
            <input type="tel" class="mid_input" name="phone_3" id="phone_3" maxlength="4" value="<?php echo @$phone[2];?>" tabindex="12">
          </div>
          <div id="phone_num">             
          </div>
          
          <?php if(count(@$userDetails) <= 0){ ?>
      <div class="clear">&nbsp;</div>
      <div class="clear">&nbsp;</div>
      <?php } ?>
          <span style="<?php if(count(@$userDetails) > 0){ ?> display:none; <?php } ?>vertical-align:top;"><input type="checkbox" id="random_password" name="random_password" value="1" checked="checked" tabindex="13" onChange="validate_random_password();"> Generate Random Password</span>
          <div class="poprightform" style="border:1px thin; color:#ADADAD; <?php if(count(@$userDetails) > 0){ ?> display:block; <?php } else { ?>display:none; <?php } ?>" id="password_div">
              <div class="poprightform form_cont_full">
                <label>Password:</label>
                <br>
                <br>
                <input type="password" id="password" name="password" maxlength="12" value="" tabindex="14">
              </div> 
              <div class="poprightform form_cont_full">
                <label style="width:50%">Confirm Password:</label>
                <br>
                <br>
                <input type="password" id="cpassword" name="cpassword" maxlength="12" value="" tabindex="15">
              </div>               
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
	    <input type="hidden" name="image_url" id="image_url" value="../student/<?php echo @$userDetails[0]['picture']; ?>">
        <input type="hidden" name="id" id="id" value="<?php echo @$userDetails[0]['user_id']; ?>">
        <input type="hidden" name="created_date" id="created_date" value="<?php echo @$userDetails[0]['created_date']; ?>">
        <input type="hidden" name="profile_id" id="profile_id" value="<?php echo @$userDetails[0]['profile_id']; ?>">
        <input type="button" name="Add" value="<?php if(count(@$userDetails) > 0){ echo 'Save'; } else { echo 'Add'; } ?>" class="button button-darkgray btn-two-half left" onClick="validate_students();">
        <input type="button"  class="button button-bluenew btn-two-half left"  onClick="close_fancy();" value="Cancel">
      </div>
      <div class="clear"></div>
    </div>
<script language="javascript">

function close_fancy(){$.fancybox.close(); return false;}
$('#phone_1').mask('000');
$('#phone_2').mask('000');
$('#phone_3').mask('0000');
$('#zipcode').mask('00000');
</script> 