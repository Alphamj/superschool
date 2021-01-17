	<div class="col-md-6">
		<div class="x_panel" data-collapsed="0">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('admission_form');?>
					<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/student_bulk_add/');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-plus"></i><?php echo get_phrase('multiple_students'); ?></button></a>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/student/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('running_session'); ?></label>

                    <div class="col-sm-9">
                  <input type="text" class="form-control" name="session"  value="<?php echo $this->db->get_where('settings', array('type' => 'session'))->row()->description; ?>" readonly="true">
                    </div>
                </div>
				
	
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo 'First Name';?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo 'Surname';?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="surname" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('parent');?></label>
                        
						<div class="col-sm-7">
							<select name="parent_id" class="form-control select2">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$parents = $this->db->get('parent')->result_array();
								foreach($parents as $row):
									?>
                            		<option value="<?php echo $row['parent_id'];?>">
										<?php echo $row['name'];?>
                                    </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						 
						</div> 
	<a href="<?php echo base_url();?>index.php?admin/parent/student_add"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>
						</div>
					
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
						<div class="col-sm-7">
							<select name="class_id" class="form-control" data-validate="required" id="class_id" 
								data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
								$classes = $this->db->get('class')->result_array();
								foreach($classes as $row):
									?>
                            		<option value="<?php echo $row['class_id'];?>">
											<?php echo $row['name'];?>
                                            </option>
                                <?php
								endforeach;
							  ?>
                          </select>

						</div> 
						 <a href="<?php echo base_url();?>index.php?admin/classes/student_add"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>

					</div>

					
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('admission_no');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" id="admission_no" name="roll" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus >
						</div> 
					</div>
					
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('birthday');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
						</div> 
					</div>
					
					
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('age');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" id="cal_age" name="age" value="" readonly >
						</div> 
					</div>
					
					<!--<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('place_birth');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="place_birth" value="" >
						</div> 
					</div>-->
					
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('sex');?></label>
                        
						<div class="col-sm-9">
							<select name="sex" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="Male"><?php echo get_phrase('male');?></option>
                              <option value="Female"><?php echo get_phrase('female');?></option>
                          </select>
						</div> 
					</div>
					
					<!--<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('mother_tongue');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="m_tongue" value="" >
						</div> 
					</div>-->
					
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('religion');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="religion" value="" >
						</div> 
					</div>
					
					<!--<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('blood_group');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="blood_group" value="" >
						</div> 
					</div>-->
					
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-9">
					<textarea name="address" cols="" class="form-control" rows=""></textarea>
						</div> 
					</div>
					
					
					<!--<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('city');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="city" value="" >
						</div> 
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('state');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="state" value="" >
						</div> 
					</div>-->
					
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('nationality');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="nationality" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="phone" value="" >
						</div> 
					</div>
                    
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="email" value="">
						</div>
					</div>
					
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
                        
						<div class="col-sm-9">
							<input type="password" class="form-control" name="password" value="" >
						</div> 
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-9">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>

					<br><br><br>				
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"> <i class="entypo-plus"></i><?php echo get_phrase('save_student');?></button>
						</div>
					</div>
				<?php echo form_close();?>
            </div>
        </div>
    </div>


	<!--<div class="col-md-6">
		<div class="x_panel" data-collapsed="0">
        	<div class="x_title">
            	<div class="panel-title" >
            		
					<?php //echo get_phrase('admission_form');?>
            	</div>
            </div>
			<div class="panel-body">
				
               
	
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('previous_school_name');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="ps_attend" data-validate="required" value="" autofocus>
						</div>
					</div>
					<br><br><br>
					
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('the_address');?></label>
                        
						<div class="col-sm-9">
						<textarea name="ps_address" cols="" class="form-control" rows=""></textarea>
						</div>
					</div>
					<br><br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('purpose_of_leaving');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="ps_purpose" data-validate="required" value="" autofocus>
						</div>
					</div>
					<br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('class_in_which_was_studying');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="class_study" data-validate="required" value="" autofocus>
						</div>
					</div>
					<br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('date_of_leaving');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control datepicker" name="date_of_leaving" value="" data-start-view="2">
						</div> 
					</div>
					<br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('admission_date');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control datepicker" id="am_date" name="am_date" value="" data-start-view="2">
						</div> 
					</div>
					<br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo 'Notes';?></label>
                        
						<div class="col-sm-9">
							<textarea type="text" class="form-control" id="notes" name="notes" ></textarea>
						</div> 
					</div>
					<br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('transfer_certificate');?></label>
                        
						<div class="col-sm-9">
							<select name="tran_cert" class="form-control select2">
                              <option value=""><?php //echo get_phrase('select');?></option>
                              
                            <option value="Yes">Yes</option>
                            <option value="No">No</option> 
                          </select>
						</div> 
					</div>
					
					<br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('birth_certificate');?></label>
                        
						<div class="col-sm-9">
							<select name="dob_cert" class="form-control select2">
                              <option value=""><?php //echo get_phrase('select');?></option>
                              
                            <option value="Yes">Yes</option>
                            <option value="No">No</option> 
                          </select>
						</div> 
					</div>
					<br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('any_given_marksheet');?></label>
                        
						<div class="col-sm-9">
							<select name="mark_join" class="form-control select2">
                              <option value=""><?php //echo get_phrase('select');?></option>
                              
                            <option value="Yes">Yes</option>
                            <option value="No">No</option> 
                          </select>
							
						</div> 
					</div>
					<br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('physical_handicap');?></label>
                        
						<div class="col-sm-9">
							<select name="physical_h" class="form-control select2">
                              <option value=""><?php //echo get_phrase('select');?></option>
                              
                            <option value="Yes">Yes</option>
                            <option value="No">No</option> 
                          </select>
						</div> 
					</div>

<br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('dormitory');?></label>
                        
						<div class="col-sm-7">
							<select name="dormitory_id" class="form-control select2">
                              <option value=""><?php //echo get_phrase('select');?></option>
	                              <?php 
	                              	//$dormitories = $this->db->get('dormitory')->result_array();
	                              	//foreach($dormitories as $row):
	                              ?>
                              		<option value="<?php //echo $row['dormitory_id'];?>"><?php echo $row['name'];?></option>
                          		<?php //endforeach;?>
                          </select>

						</div> 
		<a href="<?php //echo base_url();?>index.php?admin/dormitory/student_add"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>

					</div>
<br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('transport_route');?></label>
                        
						<div class="col-sm-7">
							<select name="transport_id" class="form-control select2">
                              <option value=""><?php //echo get_phrase('select');?></option>
	                              <?php 
	                              	//$transports = $this->db->get('transport')->result_array();
	                              	//foreach($transports as $row):
	                              ?>
                              		<option value="<?php //echo $row['transport_id'];?>"><?php echo $row['name'];?></option>
                          		<?php //endforeach;?>
                          </select>
						</div> 
				<a href="<?php //echo base_url();?>index.php?admin/transport/student_add"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>

					</div>
	<br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo get_phrase('photo');?></label>
                        
						<div class="col-sm-9">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
					 <br><br><br>
				<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo 'Birth Certificate';?></label>
                        <div class="col-sm-9">
							<div class="fileinputs fileinput-news">
								<div>
									<span class="btn btn-white btn-file">
										<span  id="file2">Choose file... </span>
										<input type="file" name="userfile2" id ="userfile2">
									</span>
								
								</div>
							</div>
						</div>
					</div>
					 <br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo 'Transfer Certificate';?></label>
                        <div class="col-sm-9">
							<div class="fileinputs fileinput-news">
								<div>
									<span class="btn btn-white btn-file">
										<span  id="file3">Choose file... </span>
										<input type="file" name="userfile3" id ="userfile3">
									</span>
								
								</div>
							</div>
						</div>
					</div>
					 <br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo 'Medical Certificate';?></label>
                        <div class="col-sm-9">
							<div class="fileinputs fileinput-news">
								<div>
									<span class="btn btn-white btn-file">
										<span  id="file4">Choose file... </span>
										<input type="file" name="userfile4" id ="userfile4">
									</span>
								
								</div>
							</div>
						</div>
					</div>
					 <br><br><br>
				<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo 'Other1';?></label>
                        <div class="col-sm-9">
							<div class="fileinputs fileinput-news" >
								<div>
									<span class="btn btn-white btn-file">
										<span  id="file5">Choose file... </span>
										<input type="file" name="userfile5" id ="userfile5">
									</span>
								
								</div>
							</div>
						</div>
					</div>
					 <br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo 'Other2';?></label>
                        <div class="col-sm-9">
							<div class="fileinputs fileinput-news" >
								<div>
									<span class="btn btn-white btn-file">
										<span  id="file6">Choose file... </span>
										<input type="file" name="userfile6" id ="userfile6">
									</span>
								
								</div>
							</div>
						</div>
					</div>
					 <br><br><br>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php //echo 'Other3';?></label>
                        <div class="col-sm-9">
							<div class="fileinputs fileinput-news" >
								<div>
									<span class="btn btn-white btn-file">
										<span  id="file7">Choose file... </span>
										<input type="file" name="userfile7" id ="userfile7">
									</span>
								
								</div>
							</div>
						</div>
					</div>
                    <br><br><br><br><br><br><hr>					
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"> <i class="entypo-plus"></i><?php echo get_phrase('save_student');?></button>
						</div>
					</div>
					
                <?php //echo form_close();?>
            </div>
        </div>
    </div>-->
<!-----  add code on 26 may 2018 ---->   
 
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
<script type="text/javascript">
	 $( function() {
		$( ".datepicker" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			maxDate: new Date(),
			 onSelect: function(date, instance) {
				var age = calcAge(date);
				$("#cal_age").val(age);
            }
		});
		$( "#am_date" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			maxDate: new Date()
			
		});
		$("#admission_no").blur(function(){
			var roll = $(this).val();
			if(roll){
				$.ajax({
					url: '<?php echo base_url();?>index.php?admin/student_check/' + roll ,
					success: function(response){
						if($.trim(response) =='Exist'){
							$("#admission_no").val('');
							$("#admission_no + .validate-has-errors").remove();
							$("#admission_no").after('<span class="validate-has-errors">Admission no. already exist.</span>');
						}else{
							$("#admission_no + .validate-has-errors").remove();
						}
					}
				});
			}else{
				$("#admission_no + .validate-has-errors").remove();
			}
			
		});
		$("#userfile2").on("change", function(){
			
			if($(this).val()!=""){
				var file = this.files[0].name;
				$("#file2").text(file);
			} else {
				$("#file2").text("Choose file...");
			}
		});
		$("#userfile3").on("change", function(){
			
			if($(this).val()!=""){
				var file = this.files[0].name;
				$("#file3").text(file);
			} else {
				$("#file3").text("Choose file...");
			}
		});
		$("#userfile4").on("change", function(){
			
			if($(this).val()!=""){
				var file = this.files[0].name;
				$("#file4").text(file);
			} else {
				$("#file4").text("Choose file...");
			}
		});
		$("#userfile5").on("change", function(){
			
			if($(this).val()!=""){
				var file = this.files[0].name;
				$("#file5").text(file);
			} else {
				$("#file5").text("Choose file...");
			}
		});
		
		$("#userfile6").on("change", function(){
			
			if($(this).val()!=""){
				var file = this.files[0].name;
				$("#file6").text(file);
			} else {
				$("#file6").text("Choose file...");
			}
		});
		$("#userfile7").on("change", function(){
			
			if($(this).val()!=""){
				var file = this.files[0].name;
				$("#file7").text(file);
			} else {
				$("#file7").text("Choose file...");
			}
		});
	} );
	
	function calcAge(dateString) {
		var birthday = +new Date(dateString);
		return~~ ((Date.now() - birthday) / (31557600000));
	}
	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

</script>
