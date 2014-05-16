<label>City</label>
<small class="alt_sml"></small>
<select name="city" id="city" tabindex="5">
  <option value="">Select City</option>
  <?php 
 foreach($Cities as $city):
 ?>
  <option value="<?php echo $city['id']; ?>" <?php if($city_id == $city['id']){ ?> selected <?php } ?> ><?php echo $city['city']; ?></option>
  <?php
 endforeach; 
 ?>
</select>
