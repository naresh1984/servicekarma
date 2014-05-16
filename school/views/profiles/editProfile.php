<?php
  /*echo "<pre>";
  print_r($profile);*/
  @$phone = explode('-',@$profile[0]['phone']);
 
?>
<form action="<?php echo BASE_FRONTEND_URL;?>profiles/editProfile" enctype="multipart/form-data" name="profile" id="profile" method="post">
<div id="EditProfilePopup" class="pro_window login_area btmpadding ">
  <div class="login_inner">
    <div class="login_inline">
      <div class="form_cont_full pro_window_header clearfix">
        <h4>Edit Profile</h4>
      </div>
      <div class="form_cont_full clearfix">
        <figure>
        
     <?php if(@$profile[0]['picture']!=''){ ?>
    <img src="<?php echo BASE_FRONTEND_URL.$profile[0]['picture']; ?>" alt="Profile Preview" width="100">
    <?php }else{ ?>
    <img src="<?php echo BASE_FRONTEND_URL; ?>includes/img/icon_profile-preview-big.png" alt="Profile Preview" width="100px">
    <?php } ?>
       </figure>
        <button class="button button-bluenew btn-third-one" id="image_upload">Change Picture</button>
        <input type="file" id="file" name="file" style="display: none;" />
      </div>
      
      <!--raw #1-->
      <div class="form_cont margin_right">
        <label>First Name</label>
        <small class="alt_sml"></small>
        <input name="firstname" id="firstname" value="<?php echo @$profile[0]['firstname']; ?>" type="text" tabindex="1" >
      </div>
      <div class="form_cont">
        <label>Last Name</label>
        <small class="alt_sml"></small>
        <input name="lastname" id="lastname" value="<?php echo @$profile[0]['lastname']; ?>" type="text" tabindex="2">
      </div>
      <div class="clear"></div>
      
      <!--raw #2-->
      <div class="form_cont margin_right">
        <label>Address</label>
        <small class="alt_sml"></small>
        <textarea id="address" name="address" rows="1" cols="1" tabindex="3"><?php echo @$profile[0]['street1']; ?></textarea>
      </div>
      <div class="form_cont">
       <label>State</label>
        <small class="alt_sml"></small>
      <select name="state" id="state" onChange="getCities(this.value)" tabindex="4">
          <option value="">Select Sate</option>
          <?php
				  foreach(@$allStates as $states):
				  ?>
          <option value="<?php echo @$states['id']; ?>" <?php if($states['id']==$profile[0]['state_id']){ ?> selected <?php } ?>><?php echo @$states['state']; ?></option>
          <?php
				  endforeach;
				  ?>
        </select>
       
      </div>
      <div class="clear"></div>
      
      <!--raw #3-->
      <div class="form_cont margin_right"  id="city_result">
        
         <label>City</label>
        <small class="alt_sml"></small>
        <select name="city" id="city" tabindex="5">
          <option value="">Select City</option>
          <?php
				  foreach(@$allCities as $cities):
				  ?>
          <option value="<?php echo @$cities['id']; ?>" <?php if($cities['id']==$profile[0]['city_id']){ ?> selected <?php } ?>><?php echo @$cities['city']; ?></option>
          <?php
				  endforeach;
				  ?>
        </select>
      </div>
      <div class="form_cont">
        <label>Zip Code</label>
        <small class="alt_sml"></small>
        <input name="zipcode" value="<?php echo @$profile[0]['zipcode']; ?>" type="text" id="zipcode" placeholder="Zipcode" tabindex="6">
      </div>
      <div class="clear"></div>
      <?php 
				@$phone = explode("-",@$profile[0]['phone']); 
			?>
      <!--raw #4-->
      <div class="form_cont margin_right">
        <label>Phone Number</label>
        <small class="alt_sml"></small>
        <input name="phone_1" id="phone_1"  value="<?php echo @$phone[0]; ?>" type="tel" class="sm_input" maxlength="3" tabindex="7">
        <input name="phone_2" id="phone_2"  value="<?php echo @$phone[1]; ?>" type="tel" class="sm_input" maxlength="3" tabindex="8">
        <input name="phone_3" id="phone_3"  value="<?php echo @$phone[2]; ?>" type="tel" class="mid_input" maxlength="4" tabindex="9">
         <div id="phone_num">
            </div>
      </div>
     
      <div class="form_cont">
        <label>Email</label>
        <small class="alt_sml"></small>
        <input name="email" id="email" type="email" value="<?php echo @$profile[0]['email']; ?>" readonly tabindex="10">
        <small class="alt_under">Email will be your username</small> </div>
      <div class="clear"></div>
      <?php 
				@$current_year = date("Y"); 
			?>
      <div class="form_cont buton_right">
      <input type="hidden" name="nav_url" id="nav_url" value="" >
      <input type="hidden" name="profile_id" id="profile_id" value="<?php echo @$profile[0]['profile_id']; ?>" >
      <input type="hidden" name="image_url" id="image_url" value="<?php echo @$profile[0]['picture']; ?>" >
        <input type="button" name="Save" id="Save" value="Save" class="button button-bluenew btn-two-half left"  onClick="return validate_editprofile();">
        <input type="button" class="button button-darkgray btn-two-half right"  onClick="close_fancy();" value="Cancel">
      </div>
    </div>
  </div>
</div>
</form>
<script language="javascript">
 var parentURL = window.parent.location.href
   $('#nav_url').val(parentURL);

function close_fancy(){$.fancybox.close(); return false;}
$("#image_upload").click(function() {
    $("input[id='file']").click();
	return false;
});
$('#phone_1').mask('000');
$('#phone_2').mask('000');
$('#phone_3').mask('0000');
$('#zipcode').mask('00000');
</script> 