<?php 
/*echo "<pre>";
print_r(@$categoryDetails);*/
?>
    
 <div id="EditProfilePopup" class="pro_window login_area btmpadding ">
        <div class="login_inner">
<div class="login_inner">
  <div class="login_inline">
    <div class="form_cont_full pro_window_header clearfix">
      <h4><?php if(count(@$categoryDetails) > 0){ echo 'Edit';}else{ echo 'Add'; } ?> Category</h4>
      <div class="clear"></div>
    </div>
     
<form action="<?php if(count(@$categoryDetails) > 0){ echo BASE_FRONTEND_URL.'categories/editCategory'; } else{ echo BASE_FRONTEND_URL.'categories/add'; } ?>" name="form_categories"  id="form_categories" method="post">    
<div id="prowrap">
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div class="clear"></div>
      <div id="popwrap">
        <div style="padding-left:160px">
        
          <div class="form_cont margin_right" style="width:65%">
            <label style="padding-left:0px;">Category Name:</label>           
            <input type="text"  name="category_name" id="category_name" value="<?php echo @$categoryDetails[0]['category_name']; ?>" tabindex="1">
          </div>  
		  
		  <div class="form_cont margin_right" style="width:65%">
            <label style="padding-left:0px;">Status:</label>            
            <select name="status" id="status" tabindex="2">
              <option value="Active" selected="selected">Active</option>
			  <option value="Inactive" <?php if(@$categoryDetails[0]['status'] == 'Inactive') { ?> selected="selected" <?php } ?>>Inactive</option>
            </select>
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
        <input type="hidden" name="id" id="id" value="<?php echo @$categoryDetails[0]['id']; ?>">	
        <input type="button" name="Add" value="<?php if(count(@$categoryDetails) > 0){ echo 'Save'; } else { echo 'Add'; } ?>" class="button button-darkgray" onClick="validate_category();" tabindex="3">
        <input type="button"  class="button button-bluenew"  onClick="close_fancy();" value="Cancel" tabindex="4">
      </div>
      <div class="clear"></div>
    </div>
<script language="javascript">
	function close_fancy(){$.fancybox.close(); return false;}
</script> 