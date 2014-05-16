<?php 
/*echo "<pre>";
print_r(@$servicerecordDetails);*/
?>
    <section id="data_container clearfix">      
      <!--white-popup mfp-hide    (Add mfp-hide for hid popup)-->
      <div id="EventServiceHour" class="pro_window login_area btmpadding ">
        <div class="login_inner">
          <div class="login_inline">
            
            <div class="form_cont_full pro_window_header clearfix">
              <h4>Service Details</h4>             
              <div class="clear"></div>
            </div>
            
            <div class="pro_window_content">
            
            	<div class="col col-100" style="background:#efefef;">
                	
                    <table cellpadding="0" cellspacing="0" border="0" class="theme_table" width="100%">
                        <tbody>
                            <tr>
                              <td width="40%">Organization / Event:</td>
                              <td><?php echo @$servicerecordDetails[0]['organization_event']; ?></td>                         
                            </tr> 
                            
                            <tr>
                              <td>Date Range:</td>
                              <td><?php echo date("m/d/Y", strtotime(@$servicerecordDetails[0]['from_date']))." - ".date("m/d/Y", strtotime(@$servicerecordDetails[0]['to_date'])); ?></td>                         
                            </tr>
                            
                            <tr>
                              <td>Location:</td>
                              <td><?php echo @$servicerecordDetails[0]['street1']; ?><br />
                    <?php echo @$servicerecordDetails[0]['city']." ".@$servicerecordDetails[0]['state_code']; ?> - <?php echo @$servicerecordDetails[0]['zipcode']; ?></td>                         
                            </tr>
                            
                            <tr>
                              <td>Number of hours:</td>
                              <td><?php echo $servicerecordDetails[0]['hours'].":".$servicerecordDetails[0]['minutes']; ?></td>                         
                            </tr>
                            
                            <tr>
                              <td>Comments/Notes:</td>
                              <td><?php echo @$servicerecordDetails[0]['comments']; ?>&nbsp;</td>                         
                            </tr>
                            
                            <tr>
                              <td>Document:</td>
                              <td>
                              <?php
								if($servicerecordDetails[0]['document']!='')
								{
							  ?>
                              		<a href="<?php echo BASE_URL."student/".$servicerecordDetails[0]['document']; ?>" target="_blank" style="text-decoration:none;"><img src="<?php echo BASE_URL."student/".$servicerecordDetails[0]['document']; ?>" alt="" width="200px;"/></a>
                               <?php
								}
								else
								{
								?>
                                 -
                                <?php
								}
								?>
                              </td>                         
                            </tr>
                            
                            <tr>
                              <td>Status:</td>
                              <td><?php echo @$servicerecordDetails[0]['is_approved']; ?></td>                         
                            </tr>
                         <?php 
						  if(@$servicerecordDetails[0]['is_approved']=='Rejected')
						  {
							if(@$servicerecordDetails[0]['rejected_reason']!='')
						  	{
						  ?>   
                                <tr>
                                  <td>Reason for Rejected:</td>
                                  <td>Reason</td>                         
                                </tr>
                         <?php
							}
						  }
						 ?>
                        </tbody>
                      </table>
                    
                    
                </div>
                
<!--                <div class="col col-40">
                	
                    <table cellpadding="0" cellspacing="0" border="0" class="theme_table" width="100%">
                    	<thead class="lightheader">
                        	<tr>
                            	<th colspan="2" height="30px" class="text-white">
                                	<h3 class="text-white">Student Details</h3>                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>Student Name:</td>
                              <td>John Doe</td>                         
                            </tr> 
                            
                            <tr>
                              <td>Student ID:</td>
                              <td>A1234567</td>                         
                            </tr>
                            
                            <tr>
                              <td>Pending service hours:</td>
                              <td>10</td>                         
                            </tr>
                            
                            <tr>
                              <td>Approved service hours:</td>
                              <td>60</td>                         
                            </tr>
                                                   
                            </tr>
                                
                        </tbody>
                      </table>
                    
                </div>-->
                
                   
                <div class="clear"></div>
                <div class="buton_right" align="center" >
                
                	
<!--                    <button class="button button-green btn-two-half">Reject</button>
                    <button class="button button-green btn-two-half">Reject and send email</button>
                    
                    <div class="clear"></div>
                    <br>
                                        
                	<button class="button button-bluenew btn-two-half">Approve</button>
                    <button class="button button-darkgray btn-two-half">Cancel</button>
                    <br>  -->                  
                    
                </div>
                <div class="clear"></div>
                
            </div>
            
            
          </div>
        </div>
      </div>   