<?php 
$collors=array('#ED3238','#FF6600','#0099CC','#CCCCCC');
/*
function randomColor() {
    $str = '#';
    for($i = 0 ; $i < 6 ; $i++) {
        $randNum = rand(0 , 15);
        switch ($randNum) {
            case 10: $randNum = 'A'; break;
            case 11: $randNum = 'B'; break;
            case 12: $randNum = 'C'; break;
            case 13: $randNum = 'D'; break;
            case 14: $randNum = 'E'; break;
            case 15: $randNum = 'F'; break;
        }
        $str .= $randNum;
    }
    return $str;
}*/

$page_title = "Service Karma"; ?>
<?php include HOME . DS . 'includes' . DS . 'header.php'; ?>    

<div id="main">  

<?php include HOME . DS . 'includes' . DS . 'navigation.php'; ?> 
    
   
   <section id="data_container" class="up-event">
    
    	<div class="wrapper-910">
        	<div class="header-wrap">
            	<h2 class="page-header">List of Upcoming Events</h2>                
            </div>
        </div>
        
        <div class="wrapper-910 clearfix">        
        	
            <section class="up-event-content">
            	
            	<div class="por_content_inner entr_area" style="height:400px;">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%" class="theme_table pro_table no_odd">
                    <?php $i=0;$j=0; $categories = array();$collor_of_events=array(); foreach($upcomingevent_details as $upevents):
					 if(!in_array($upevents['category_name'], $categories)){
					 	$categories[$upevents['category_id']] = $upevents['category_name'];
						$collor_of_events[$upevents['category_id'].'_color'] = $collors[$j];//randomColor();//
						$j++;
					  }
					if($i==0){
						 $pdw = date('m/d/Y', strtotime($upevents['from_date']));
						 $i++;
					?>
                    <tr class="sub-header">
                    	<td colspan="3"><?php echo date("l M j", strtotime(@$upevents['from_date'])); ?></td>
                    </tr>
                    <?php	  
					 }else{
	  					$ldw = date('m/d/Y', strtotime($upevents['from_date']));
						if($pdw !=$ldw){
								 $pdw = date('m/d/Y', strtotime($upevents['from_date']));
					?>
                     <tr class="sub-header">
                    	<td colspan="3"><?php echo date("l M j", strtotime(@$upevents['from_date'])); ?></td>
                    </tr>		
                    <?php	 
						}
					 }
					 ?>
                    
                  	
                    <tr>
                      <td><?php echo preg_replace('/ /', ':', @$upevents['start_time'], 1); ?></td>
                      <td>	
                      		
                            <strong><?php echo @$upevents['event_title']; ?></strong><br>
                            <?php echo @$upevents['category_name']; ?><br>
                            <?php echo @$upevents['organization_name']; ?><br>
                            <a href="<?php echo @$upevents['url']; ?>" target="_blank"><?php echo @$upevents['url']; ?></a>
                        	
                      </td>
                      <td class="event-mark" style="background-color: <?php echo $collor_of_events[$upevents['category_id'].'_color']; ?>;"></td>
                    </tr>                    
                   <?php endforeach; ?> 
                  </table>
                
                </div>           
            
            </section>
            <aside class="up-event-sidebar">
            	<div class="event-calender">
                	
                </div>
            	
                <ul class="event-list">
                 <?php foreach($categories as $key=>$cat): ?>
                	<li><div class="event-mark-box" style="background-color: <?php echo $collor_of_events[$key.'_color']; ?>;"></div><span style="color:<?php echo $collor_of_events[$key.'_color']; ?>;"><?php echo $cat; ?></span></li>
                    <!--<li><div class="event-mark-box evn-humanitarian"></div><span class="text-green">Humanitarian Event</span></li>
                    <li><div class="event-mark-box evn-environmental"></div><span class="text-blue">Environmental Event</span></li>-->
                 <?php endforeach; ?>   
                </ul>
                                            	
            </aside>          
        
        </div>   
      
    </section>

    <div class="clear40"></div>
    
  </div>
</div>
</div><!--main-->
</div><!--wrap-->

<?php include HOME . DS . 'includes' . DS . 'footer.php'; ?>