<div id="EventServiceHour" class="pro_window login_area btmpadding ">
        <div class="login_inner">
          <div class="login_inline">
            
            <div class="form_cont_full pro_window_header clearfix">
              <h4>Enter Service hours</h4>
              
              <div class="clear"></div>
            </div>
            
            <div class="pro_window_content">
                    <!--raw #1-->
                    <div class="form_cont margin_right">
                      
                      <label>Organization / Event</label>
                      <small class="alt_sml">*</small>
                      <input name="" type="text" required>
<!--                      <select name="">
                        <option>Select Organization</option>
                      </select>
                      
                      <div class="clear"></div><br>
                      <small class="alt_sml"></small>
                      <input name="" type="text" placeholder="If Other" required>-->
                    </div>
                    <div class="form_cont">
                      <label><span style="display:inline-block; width:144px">Hours Volunteered</span> <span style="display:inline-block">Minutes</span></label>
                      <small class="alt_sml"></small>      
                      <!--<input id="spinner" name="" type="text" value="0" >-->               
                      <input id="hours" type="number" min="0" max="20" step="2" value="10" name="hours" class="mid_input"> 
                      &nbsp;&nbsp;
                      <select name="" class="mid_input">
                        <option>0</option>
                        <option>15</option>
                        <option>30</option>
                        <option>45</option>                        
                      </select>
                      
                      
                      
                    </div>
                    <div class="clear"></div>
                    
                    <!--raw #2-->            
                    <div class="form_cont margin_right">
                      <label>From Date</label>
                      <small class="alt_sml"></small>
                      <input type="date" name="" class="half_plus_input btn-one-third" id="from_date" placeholder="04-25-2014" >
                      <!--<img src="img/icon_calendar.png" alt="Select Date" class="calendar_icon">-->
                    </div>
                    <div class="form_cont">
                      <label>To Date</label>
                      <small class="alt_sml"></small>
                      <input type="date" name="" class="half_plus_input btn-one-third" placeholder="04-29-2014" id="to_date" >
                      <!--<img src="img/icon_calendar.png" alt="Select Date" class="calendar_icon">-->
                    </div>            
                    <div class="clear"></div>
                    
                    <!--raw #3-->
                    <div class="form_cont margin_right">
                      <label>Country</label>
                      <small class="alt_sml"></small>
                      <select name="">
                        <option>Select Country</option>
                      </select>
                    </div>
                    <div class="form_cont">
                      <label>Address</label>
                      <small class="alt_sml"></small>
                       <textarea class="expandable" placeholder="Address Comes here" rows="1" cols="1"></textarea>
                    </div>
                    <div class="clear"></div>           
                    
                    <!--raw #4-->
                    <div class="form_cont margin_right">
                      <label>City</label>
                      <small class="alt_sml"></small>
                      <input name="" type="text" placeholder="City">
                    </div>           
                    <div class="form_cont">
                      <label>State</label>
                      <small class="alt_sml"></small>
                      <select name="">
                        <option>Select State</option>
                      </select>
                    </div>
                    
                    <div class="clear"></div>
                    
                    <div class="form_cont margin_right">
                      <label>Zipcode</label>
                      <small class="alt_sml"></small>
                      <input name="" type="text" placeholder="Zipcode">
                    </div>
                    <div class="form_cont">
                      <label>Comments/Notes</label>
                      <small class="alt_sml"></small>
                      <textarea class="expandable" placeholder="Describe your contribution (Max 255 chars)" rows="1" cols="1"></textarea>
                    </div>
                    <div class="clear"></div>                    
                   <!-- /*Added on 28-10-13 by Kamlesh  */-->
                    <small class="alt_sml"></small>
                    <input type="checkbox" class="css-checkbox-check" id="form_required"><label class="css-label-check" for="form_required">No Form Required</label>                    
                    <!--/*End update 18-10-13*/-->
                    <div class="clear"></div>
                    
                    <div class="buton_right" align="center" style="width:50%; margin:0 auto;">
                        
                        <p class="text-light-grey left">Upload form</p>
                        <p class="text-light-grey right">No file selected.</p>
                        
                        <div class="clear"></div>
                        
                        <button class="button button-bluenew btn-full b-bottom-space-login">chooose file</button><br>
                        <button class="button button-bluenew btn-full b-bottom-space-login">submit hours</button><br>
                        <button class="button button-darkgray btn-full">Cancel</button>
                    </div>
                    <div class="clear"></div>
                    
                </div>
          </div>
        </div>
      </div>