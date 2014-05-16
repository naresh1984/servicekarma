<label>City:</label>
<br>
<br>
<select name="city" id="city">
  <option value="">Select City</option>
 <?php 
 foreach($Cities as $city):
 ?>
 <option value="<?php echo $city['id']; ?>" <?php if($city_id == $city['id']){ ?> selected <?php } ?> ><?php echo $city['city']; ?></option>
 <?php
 endforeach; 
 ?>
</select>
