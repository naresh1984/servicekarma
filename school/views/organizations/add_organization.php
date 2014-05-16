<?php 
/*echo "<pre>";
print_r(@$organizationDetails);*/

@$phone = explode('-',@$organizationDetails[0]['phone']);
?>
    
 <div id="EditProfilePopup" class="pro_window login_area btmpadding ">
        <div class="login_inner">
<div class="login_inner">
  <div class="login_inline">
    <div class="form_cont_full pro_window_header clearfix">
      <h4><?php if(count(@$organizationDetails) > 0){ echo 'Edit';}else{ echo 'Add'; } ?> Organization</h4>
      <div class="clear"></div>
    </div>
     
<form action="<?php if(count(@$organizationDetails) > 0){ echo BASE_FRONTEND_URL.'organizations/editOrganization'; } else{ echo BASE_FRONTEND_URL.'organizations/add'; } ?>" name="form_organizations"  id="form_organizations" method="post">    
<div id="prowrap">
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div id="popwrap">
        <div id="popleftcol">
        
          <div class="popleftform form_cont_full">
            <label>Organization Name:</label>
            <br>
            <br>
            <input type="text"  name="organization_name" id="organization_name" value="<?php echo @$organizationDetails[0]['organization_name']; ?>" tabindex="1">
          </div>      
          
          <div class="popleftform form_cont_full">
            <label>Address:</label>
            <br>
            <br>
            <textarea cols="1" rows="1" name="address" id="address" class="expandable" tabindex="5"><?php echo @$organizationDetails[0]['street1']; ?></textarea>
          </div>
          
          <div class="popleftform form_cont_full" id="city_result">
            <label>City:</label>
            <br>
            <br>
            <select name="city" id="city" tabindex="7">
              <option value="">Select City</option>
              <?php
				  foreach(@$allCities as $cities):
				  ?>
          <option value="<?php echo @$cities['id']; ?>" <?php if($cities['id']==$organizationDetails[0]['city_id']){ ?> selected <?php } ?>><?php echo @$cities['city']; ?></option>
          <?php
				  endforeach;
				  ?>
            </select>
          </div>
          
          <div class="popleftform form_cont_full">
            <label>Phone&nbsp; Number:</label>
            <br>
            <br>
            <input type="tel" class="sm_input" name="phone_1" id="phone_1" maxlength="3" value="<?php echo @$phone[0];?>" tabindex="9">
            <input type="tel" class="sm_input" name="phone_2" id="phone_2" maxlength="3" value="<?php echo @$phone[1];?>" tabindex="10">
            <input type="tel" class="mid_input" name="phone_3" id="phone_3" maxlength="4" value="<?php echo @$phone[2];?>" tabindex="11">
          </div>
          <div id="phone_num">             
          </div>
		  
		  <div class="popleftform form_cont_full">
            <label>Status:</label>
            <br>
            <br>
            <select name="status" id="status" tabindex="18">
              <option value="Active" selected="selected">Active</option>
			  <option value="Inactive" <?php if(@$organizationDetails[0]['organization_status'] == 'Inactive') { ?> selected="selected" <?php } ?>>Inactive</option>
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
            <label>Email:</label>
            <br>
            <br>
            <input type="text"  name="email" id="email" value="<?php echo @$organizationDetails[0]['email']; ?>" tabindex="3">
          </div>
          
          <div class="poprightform form_cont_full">
            <label>State:</label>
            <br>
            <br>
            <select name="state" id="state" onChange="getCitiesOrganizations(this.value)" tabindex="6">
              <option value="">Select State</option>
              <?php
			  foreach($allStates as $states):
			  ?>           
              <option value="<?php echo $states['id']; ?>" <?php if(@$organizationDetails[0]['state_id'] == $states['id']){ ?>  selected <?php } ?>><?php echo $states['state']; ?></option>
              <?php
			  endforeach;
			  ?>
            </select>
          </div>
          
          <div class="poprightform form_cont_full">
            <label>Zip Code:</label>
            <br>
            <br>
            <input type="text" id="zipcode" name="zipcode" maxlength="5" value="<?php echo @$organizationDetails[0]['zipcode']; ?>" tabindex="8">
          </div>    
          
          <div class="poprightform form_cont_full">
            <label>Website:</label>
            <br>
            <br>
            <input type="text" id="website" name="website"  value="<?php echo @$organizationDetails[0]['url']; ?>" tabindex="11">
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
        <input type="hidden" name="id" id="id" value="<?php echo @$organizationDetails[0]['organization_id']; ?>">
		<input type="hidden" name="profile_id" id="profile_id" value="<?php echo @$organizationDetails[0]['profile_id']; ?>">
        <input type="button" name="Add" value="<?php if(count(@$organizationDetails) > 0){ echo 'Save'; } else { echo 'Add'; } ?>" class="button button-darkgray btn-two-half left" onClick="validate_organizations();">
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