<?php $page_title = "Service Karma"; ?>
<?php include HOME . DS . 'includes' . DS . 'header.php'; ?>    

<div id="main">  

<?php include HOME . DS . 'includes' . DS . 'navigation.php'; ?>
    
<?php
/*echo "<pre>";
print_r($allPendingServiceRecords);
print_r($allApprovedServiceRecords);
print_r($allRejectedServiceRecords);
*/
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

$convert_pending_minutes = convertToHoursMins($allServiceRecordsHours['pending_minutes']);
if(count($convert_pending_minutes) == 0)
{
	$convert_pending_minutes = array(0,0);
}

$convert_approved_minutes = convertToHoursMins($allServiceRecordsHours['approved_minutes']);
if(count($convert_approved_minutes) == 0)
{
	$convert_approved_minutes = array(0,0);
}

$convert_rejected_minutes = convertToHoursMins($allServiceRecordsHours['rejected_minutes']);
if(count($convert_rejected_minutes) == 0)
{
	$convert_rejected_minutes = array(0,0);
}

$convert_all_minutes = convertToHoursMins($allServiceRecordsHours['approved_minutes']+$allServiceRecordsHours['pending_minutes']+$allServiceRecordsHours['rejected_minutes']);
if(count($convert_all_minutes) == 0)
{
	$convert_all_minutes = array(0,0);
}
?>   



		<style>

			.tabs li {
				list-style:none;
				display:inline;
			}

			.tabs a {
				padding:5px 10px;
				display:inline-block;				
				color:#000000;
				text-decoration:none;
			}

			.tabs a.active {
				background:#9CA6BA;
				color:#ffffff;
			}

		</style>
	
		<script>
			// Wait until the DOM has loaded before querying the document
			$(document).ready(function(){
				$('ul.tabs').each(function(){
					// For each set of tabs, we want to keep track of
					// which tab is active and it's associated content
					var $active, $content, $links = $(this).find('a');

					// If the location.hash matches one of the links, use that as the active tab.
					// If no match is found, use the first link as the initial active tab.
					$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
					$active.addClass('active');

					$content = $($active[0].hash);

					// Hide the remaining content
					$links.not($active).each(function () {
						$(this.hash).hide();
					});

					// Bind the click event handler
					$(this).on('click', 'a', function(e){
						// Make the old tab inactive.
						$active.removeClass('active');
						$content.hide();

						// Update the variables with the new link and content
						$active = $(this);
						$content = $(this.hash);

						// Make the tab active.
						$active.addClass('active');
						$content.show();

						// Prevent the anchor's default click action
						e.preventDefault();
					});
				});
			});
		</script>
        
        
        
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
		  backgroundColor: 'transparent',
          title: '',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
 
<section id="data_container clearfix">
      <section id="home_wrapper" class="clearfix">
        <h2 class="page-header">My Contributions
<!--            <div class="title_ebtn">
                <button class="button button-bluenew">enter service hours</button>
            </div>-->
        </h2>
        
        
        <section class="home_contentainer hme_con_margin clearfix">
          
          
            <div class="por_content_title">
              <h4 class="text-white">Total number of hours <?php echo $allServiceRecordsHours['approved_hours']+$allServiceRecordsHours['pending_hours']+$allServiceRecordsHours['rejected_hours']+$convert_all_minutes[0]; ?>:<?php echo $convert_all_minutes[1]; ?></h4>
              <div class="clear"></div>
            </div>
            <div class="por_content_inner">             	
                <div id="donutchart" style="width:500px; height:250px;"></div>
              <div class="clear"></div>
              <div class="button-raw h_cont_hght clearfix">
               		<p class="contain_p">
                    	Approved Service Hours
                    	<span><?php echo $allServiceRecordsHours['approved_hours']+$convert_approved_minutes[0].":".$convert_approved_minutes[1]; ?></span>
                    </p>
                    <p class="contain_p">
                    	Pending Service Hours
                    	<span><?php echo $allServiceRecordsHours['pending_hours']+$convert_pending_minutes[0].":".$convert_pending_minutes[1]; ?></span>
                    </p>
                    <p class="contain_p">
                    	Rejected Service Hours
                    	<span><?php echo $allServiceRecordsHours['rejected_hours']+$convert_rejected_minutes[0].":".$convert_rejected_minutes[1]; ?></span>
                    </p>
                   
              </div>
            </div>
         
        </section>
        
        <section class="home_contentainer clearfix">
          
          
            <div class="por_content_title">
              <h4 class="text-white">How I changed the world!</h4>
              <div class="clear"></div>
            </div>
            
            
       <div class="noti_icons">     
            <ul class='tabs'>
                <li><a href='#tab1'>Approved</a></li><span style="color:#FFFFFF;">|</span>
                <li><a href='#tab2'>Pending</a></li><span style="color:#FFFFFF;">|</span>
                <li><a href='#tab3'>Rejected</a></li>
            </ul>
        </div>
		<div class="por_content_inner entr_area" id='tab1'>
			<?php
				if(count($allApprovedServiceRecords)>0)
				{
			 ?>			
              <table cellpadding="0" cellspacing="0" border="0" width="100%" class="theme_table pro_table">
              <?php
              	foreach($allApprovedServiceRecords as $approvedServiceRecord):
			   ?>
                <tr>
                  <td>
                  		<span class="app_licon"></span>
                  		<p class="noti_p">Hours for <strong><?php echo $approvedServiceRecord['organization_event']; ?></strong> approved
                        	<small><?php echo date("jS F, h:i:s a", strtotime($approvedServiceRecord['approved_date'])); ?></small>
                        </p>
                        
                   </td>
                 </tr>     
                <?php endforeach; ?>             
              </table>  
             <?php
				}
			 ?>
		</div>
		<div class="por_content_inner entr_area" id='tab2'>
			<?php
				if(count($allPendingServiceRecords)>0)
				{
			 ?>			
              <table cellpadding="0" cellspacing="0" border="0" width="100%" class="theme_table pro_table">
              <?php
              	foreach($allPendingServiceRecords as $pendingServiceRecord):
			   ?>
                <tr>
                  <td>
                  		<span class="app_licon"></span>
                  		<p class="noti_p">Hours for <strong><?php echo $pendingServiceRecord['organization_event']; ?></strong> pending</p>
                   </td>
                 </tr>     
                <?php endforeach; ?>             
              </table>  
             <?php
				}
			 ?>
		</div>
		<div class="por_content_inner entr_area" id='tab3'>
			<?php
				if(count($allRejectedServiceRecords)>0)
				{
			 ?>			
              <table cellpadding="0" cellspacing="0" border="0" width="100%" class="theme_table pro_table">
              <?php
              	foreach($allRejectedServiceRecords as $rejectedServiceRecord):
			   ?>
                <tr>
                  <td>
                  		<span class="app_licon"></span>
                  		<p class="noti_p">Hours for <strong><?php echo $rejectedServiceRecord['organization_event']; ?></strong> rejected
                        	<small><?php echo date("jS F, h:i:s a", strtotime($rejectedServiceRecord['rejected_date'])); ?></small>
                        </p>
                        
                   </td>
                 </tr>     
                <?php endforeach; ?>             
              </table>  
             <?php
				}
			 ?>
		</div>
         	  <div class="button-raw txt_algn_center clearfix">
                <button class="button button-blue btn-two-half b-top-space" onClick="window.location.href='<?php echo BASE_FRONTEND_URL; ?>servicerecord/'" >see all entries</button>  
              </div>
        </section>
        
        
      </section>
      <!--white-popup mfp-hide    (Add mfp-hide for hid popup)-->
      
    </section>
    <a class="fancybox fancybox.ajax" id="newcontact" href="comingsoon" ></a>
<?php include HOME . DS . 'includes' . DS . 'footer.php'; ?>
<script language="javascript">
function coming(){
	 $("#newcontact").fancybox({helpers   : { 
   overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox 
  }}).trigger('click');
}
</script>