<form action="<?php echo BASE_FRONTEND_URL;?>profiles/changepassword" enctype="multipart/form-data" name="change_pwd" id="change_pwd" method="post">
<div id="EditProfilePopup" class="pro_window login_area btmpadding ">
  <div class="login_inner" style=" padding-bottom: 120px; background-color:#fff">
    <div class="login_inline">
      <div class="form_cont_full pro_window_header clearfix">
        <h4>Change Password</h4>
       </div>
      <!--raw #1-->
      <div style="padding-left:160px">
       <div class="form_cont margin_right" style="width:65%">
       <label>Old Password</label>
        <small class="alt_sml"></small>
        <input name="old_pwd" id="old_pwd" value="" type="password" tabindex="1" >
      </div>
      
      <div class="form_cont margin_right" style="width:65%">
         <label>New Password</label>
        <small class="alt_sml"></small>
        <input name="new_pwd" id="new_pwd" value="" type="password" tabindex="2">
      </div>
     
      <div class="form_cont margin_right" style="width:65%">
      <label>Confirm New Password</label>
        <small class="alt_sml"></small>
        <input name="conf_pwd" id="conf_pwd" value="" type="password" tabindex="3">
      </div>
      </div>
      <div class="form_cont buton_right">
      <input type="hidden" name="nav_url" id="nav_url" value="" >
       <input type="button" name="Save" id="Save" value="Save" class="button button-bluenew btn-two-half left"  onClick="return validate_changepassword();">
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
</script> 