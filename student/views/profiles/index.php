    
      <section id="portfolio_wrapper" class="clearfix">
        <h2 class="page-header">My Profile</h2>
        <section class="por_contentainer clearfix">
          <figure class="por_picture"> <img src="<?php echo BASE_FRONTEND_URL; ?>includes/img/icon_profile-preview-big.png" alt="Profile Preview" > </figure>
          <section class="por_content">
            <div class="por_content_title">
              <h3 class="text-white"><strong class="left"><?php echo $profile[0]['firstname']." ".$profile[0]['lastname']; ?></strong><span class="right"><?php echo $profile[0]['establishment_name']; ?></span></h3>
              <div class="clear"></div>
            </div>
            <div class="por_content_inner">
              <table cellpadding="0" cellspacing="0" border="0" width="100%" class="theme_table pro_table">
                <tr>
                  <td><a href="mailto:<?php echo $profile[0]['email']; ?>"><?php echo $profile[0]['email']; ?></a></td>
                </tr>
                <tr>
                  <td><?php echo $profile[0]['street1']; ?>  <br>			
                    <?php echo $profile[0]['city']; ?> <?php echo $profile[0]['state_code']; ?> - <?php echo $profile[0]['zipcode']; ?><br>
                    <?php echo $profile[0]['phone']; ?> </td>
                </tr>
              </table>
              <div class="clear"></div>
              <div class="button-raw clearfix">
                <button class="button button-bluenew btn-two-half fancybox fancybox.ajax" href="profiles/editProfile">Edit Profile</button>
                <button class="button button-bluenew btn-two-quater b-top-space  fancybox fancybox.ajax" href="<?php echo BASE_URL . 'login/changePassword'; ?>">Change&nbsp;Password</button>
              </div>
            </div>
          </section>
        </section>
      </section>
 