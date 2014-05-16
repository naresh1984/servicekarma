<?php
/*echo "<pre>";
print_r($profile);*/
?>



<div class="wrapper-910">
<h2 class="page-header">My Profile</h2>
<div>
<div style="display: block;" id="sc1" class="tabcontent">
  <section class="por_contentainer clearfix">
    <figure class="por_picture"> 
    <?php if(@$profile[0]['picture']!=''){ ?>
    <img src="<?php echo BASE_ADMIN_URL.$profile[0]['picture']; ?>" alt="Profile Preview" width="172" >
    <?php }else{ ?>
    <img src="<?php echo BASE_FRONTEND_URL; ?>includes/img/icon_profile-preview-big.png" alt="Profile Preview" width="172">
    <?php } ?>
    </figure>
    <section class="por_content">
      <div class="por_content_title">
        <h3 class="text-white"><strong class="left"><?php echo @$profile[0]['firstname']." ".@$profile[0]['lastname']; ?></strong></h3>
        <div class="clear"></div>
      </div>
      <div class="por_content_inner">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="theme_table pro_table">
          <tr>
            <td><a href="mailto:<?php echo @$profile[0]['email']; ?>"><?php echo @$profile[0]['email']; ?></a></td>
          </tr>
          <tr>
            <td><?php echo @$profile[0]['street1']; ?> <br>
              <?php echo @$profile[0]['state']; ?> <?php echo @$profile[0]['city']; ?> <br>
              <?php echo @$profile[0]['state_code']; ?> - <?php echo @$profile[0]['zipcode']; ?><br>
              <?php echo @$profile[0]['phone']; ?></td>
          </tr>
        </table>
        <div class="clear"></div>
        <div class="button-pro clearfix">
        <a href="<?php echo BASE_ADMIN_URL; ?>establishments/editProfile" class="fancybox fancybox.ajax"><button class="button button-bluenew btn-two-half">Edit Profile</button></a> 
          <br>
          <a href="<?php echo BASE_ADMIN_URL; ?>establishments/changepassword" class="fancybox fancybox.ajax"><button class="button button-bluenew btn-two-half">Change Password</button></a></div>
      </div>
    </section>
  </section>
</div>
