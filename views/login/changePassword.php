<?php 
include HOME . DS . 'includes' . DS . 'header.php'; ?>
<section id="body">
  <div class="container">
  
    <form action="" method="post" name="change" id="change">
        <table class="table2">
		  <tbody>
		  <tr>
		  <td style="color:#FF0000" colspan="2"><?php echo @$oldpwd_error."<br>".@$newpwd_error."<br>".@$msg; ?></td>
		  </tr>
		  <tr>
			<td>Enter Old Password:</td>
			<td><input type="password" name="oldpwd" id="oldpwd" class="required" value="<?php echo $oldpwd ;?>"></td>			
		  </tr>
		  <tr>
			<td>Enter New Password:</td>
			<td><input type="password" name="newpwd" id="newpwd" class="required password" value="<?php echo $newpwd ;?>"></td>			
		  </tr>
		   <tr>
			<td>Re-Enter New Password:</td>
			<td><input type="password" name="repwd" id="repwd" class="required password" value="<?php echo $repwd ;?>"></td>			
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" id="submit" class="button" value="Submit"></td>			
		  </tr>
		</tbody></table>
    </form>
  </div>
</section>
<script type="text/javascript" language="javascript">
$(document).ready(function(){ 
		$("#change").validate({
		 rules: {
			role: {
				required: true,
				minlength:1,
			}
			
		 } 
		}); 
	}); 
</script>

<?php include HOME . DS . 'includes' . DS . 'footer.php'; ?>