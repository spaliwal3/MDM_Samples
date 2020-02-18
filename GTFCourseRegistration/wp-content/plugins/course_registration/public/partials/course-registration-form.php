<?php
	global $STATE_LIST, $WORK_FACILITY, $YEAR_OF_EXPERIENCE, $DEPARTMENT, $COUNTY_LIST, $course_id;

	$payment_pref = get_post_meta($course_id, 'payment_preference', true);
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="form-horizontal">
			 
    <fieldset>
    	<legend>Personal Information</legend>
    	<div class="form-group">
		  <label class="col-md-4 control-label" for="first-name">First Name</label>  
		  <div class="col-md-5">
		  	<input id="first-name" name="first-name" type="text" placeholder="First Name" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['first-name'])) echo "error";?>" required="" value="<?php isset( $_POST['first-name']) ? $first_name : null; ?>">
		  </div>
		</div>
	    <div class="form-group">
		  <label class="col-md-4 control-label" for="last-name">Last Name</label>  
		  <div class="col-md-5">
		 	 <input id="last-name" name="last-name" type="text" placeholder="Last Name" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['last-name'])) echo "error";?>" required="" value="<?php isset( $_POST['last-name']) ? $last_name : null; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="last-4-ssn">Last 4 digits of SSN</label>  
		  <div class="col-md-5">
			  <input id="last-4-ssn" name="last-4-ssn" type="number" placeholder="Last 4 digits of SSN" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['last-4-ssn'])) echo "error";?>" required="" value="<?php isset( $_POST['last-4-ssn']) ? $last_4_ssn : null; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="degree">Degree</label>  
		  <div class="col-md-5">
			  <input id="degree" name="degree" type="text" placeholder="Degree" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['degree'])) echo "error";?>" required="" value="<?php isset( $_POST['degree']) ? $degree : null;?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="job-title">Job Title</label>  
		  <div class="col-md-5">
			  <input id="job-title" name="job-title" type="text" placeholder="Job Title" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['job-title'])) echo "error";?>" required="" value="<?php isset( $_POST['job-title']) ? $job_title : null; ?>">
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="work-facility">Work Facility</label>  
		  <div class="col-md-5">
			<select id="work-facility" name="work-facility" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['work-facility'])) echo "error";?>" required="" value="<?php isset( $_POST['work-facility']) ? $work_facility : null; ?>">
				<?php
				foreach ($WORK_FACILITY as $key => $value) {
					echo "<option value='$key'>$value</option>";
				}
				?>
			</select>
		  </div>
		</div>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="dietary-needs">Dietary Needs</label>  
		  <div class="col-md-5">
			  <input id="dietary-needs" name="dietary-needs" type="text" placeholder="Dietary Needs (optional)" class="form-control input-md" value="<?php isset( $_POST['dietary-needs']) ? $dietary_needs : null; ?>">
		  </div>
		</div>
    </fieldset>

	<fieldset>
		<legend>Contact Information</legend>
		<div class="form-group">
		  <label class="col-md-4 control-label" for="address-line-1">Address Line 1 </label>  
		  <div class="col-md-5">
		  	<input id="address-line-1" name="address-line-1" type="text" placeholder="Street address, etc" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['address-line-1'])) echo "error";?>" required="" value="<?php isset( $_POST['address-line-1']) ? $address_line_1 : null;?>">
		  	<span class="help-block highlight">Please enter the best address to receive program materials.</span>
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="address-line-2">Address Line 2 </label>  
		  <div class="col-md-5">
		  	<input id="address-line-2" name="address-line-2" type="text" placeholder="Apartment, etc (optional)" class="form-control input-md" value="<?php isset( $_POST['address-line-2']) ? $address_line_2 : null; ?>">
		  </div>
		</div>

		<div class="row">
			<div class="col-xs-6">
				<div class="form-group row">
				  <label class="col-md-8 control-label" for="city">City </label>  
				  <div class="col-md-4">
				  	<input id="city" name="city" type="text" placeholder="City" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['city'])) echo "error";?>" required="" value="<?php isset( $_POST['city']) ? $city : null ?>">
				  </div>
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group row">
				  <label class="col-md-2 control-label" for="county">County</label>  
				  <div class="col-md-4">
				 	 <select id="county" name="county" placeholder="County" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['county'])) echo "error";?>" required="" value="<?php isset( $_POST['county']) ? $state : null; ?>">
						 <?php
                        foreach($COUNTY_LIST as $key => $value)
                        {
                            echo "<option value='$key' >$value</option>";
                        }
                        ?>
					</select>
				  </div>
				</div>
			</div>
		</div>
		
	    
	    <div class="row">
	    	<div class="col-xs-6">
	    		<div class="form-group row">
				  <label class="col-md-8 control-label" for="state">State</label>  
				  <div class="col-md-4">
				 	 <select id="state" name="state" placeholder="State" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['state'])) echo "error";?>" required="" value="<?php isset( $_POST['state']) ? $state : null; ?>">
						 <?php
                        foreach($STATE_LIST as $key => $value)
                        {
                            if($key == 'GA')
                            {
                                echo "<option value='$key' selected='selected' >$value</option>";
                            }
                            else
                            {
                                echo "<option value='$key' >$value</option>";
                            }
                        }
                        ?>
					</select>
				  </div>
				</div>
	    	</div>
	    	<div class="col-xs-6">
	    		<div class="form-group">
				  <label class="col-md-2 control-label" for="zip">Zip</label>  
				  <div class="col-md-4">
				 	 <input id="zip" name="zip" type="text" placeholder="Zip Code" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['zip'])) echo "error";?>" required="" value="<?php isset( $_POST['zip']) ? $zip : null; ?>">
				  </div>
				</div>
	    	</div>
	    </div>
	    <div class="form-group">
		  <label class="col-md-4 control-label" for="phone">Phone</label>  
		  <div class="col-md-5">
			  <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['phone'])) echo "error";?>" required="" value="<?php isset( $_POST['phone']) ? $phone : null; ?>">
		  </div>
		</div>
	</fieldset>
    
	<fieldset>
    	<legend>Trauma Experience</legend>
		
		<div class="form-group">
		  <label class="col-md-4 control-label" for="years-exp">Years</label>  
		  <div class="col-md-5">
			<select id="years-exp" name="years-exp" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['years-exp'])) echo "error";?>" required="" value="<?php isset( $_POST['years-exp']) ? $years_exp : null; ?>">
				<?php
				foreach ($YEAR_OF_EXPERIENCE as $key => $value) {
					echo "<option value='$key'>$value</option>";
				}
				?>
			</select>
		  </div>
		</div>

		<div class="form-group">
		  <label class="col-md-4 control-label" for="worked-dept">Department Worked</label>  
		  <div class="col-md-5">
			<select id="worked-dept" name="worked-dept" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['worked-dept'])) echo "error";?>" required="" value="<?php isset( $_POST['worked-dept']) ? $worked_dept : null; ?>">
				<?php
				foreach ($DEPARTMENT as $value) {
					echo "<option value='$value'>$value</option>";
				}
				?>
			</select>
		  </div>
		</div>
	</fieldset>

    <fieldset style="margin-top:48px;">
		<div class="form-group">
		  <label class="col-md-4 control-label" for="email">Email Address</label>  
		  <div class="col-md-5">
			<input id="email" name="email" type="email" placeholder="Email Address" class="form-control input-md <?php if(isset( $_POST['btn-submit']) && empty($_POST['email'])) echo "error";?>" aria-describedby="help-email" required="" value="<?php isset( $_POST['email']) ? $email : null; ?>">
		 	<span id="help-email" class="help-block">You will receive the confirmation via email.</span> 	
		  </div>
		</div>
	</fieldset>
   
	<?php 
	if ( !empty($payment_pref) ) {
		?>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="alert alert-info" role="alert">
				<strong>Payment Information: </strong>
				<?php
				echo $payment_pref;
				?>
				</div>
			</div>
		</div>
		<?php 
	}
	?>

    <div class="form-group">
	  <label class="col-md-4 control-label" for="btn-submit"></label>
	  <div class="col-md-4">
	  	
	    <button id="btn-submit" name="btn-submit" class="btn btn-primary cr-btn-complete-registration">Complete Registration</button>
	  </div>
	</div>

</form>