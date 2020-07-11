
  <!-- added on 26 may 2018-->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_loan'); ?>
					</div>
					</div>
         
 <?php echo form_open(base_url() . 'index.php?admin/loan_applicant/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
                        <label for="field-1" class="col-sm-1 control-label"><?php echo get_phrase('date_application'); ?></label>

                        <div class="col-sm-11">
                            <div class="date-and-time">
                                <input type="text" name="date" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('applicant_id');?></label>
                      <div class="col-sm-11">
 			<select class="form-control select2" name="staff_name" required>
            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
            <optgroup label="<?php echo get_phrase('admin'); ?>">
                <?php
                $admins = $this->db->get('admin')->result_array();
                foreach ($admins as $row):
                    ?>

                    <option value="<?php echo $row['admin_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			
			
			<optgroup label="<?php echo get_phrase('teacher'); ?>">
                <?php
                $teachers = $this->db->get('teacher')->result_array();
                foreach ($teachers as $row):
                    ?>

                    <option value="<?php echo $row['teacher_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			
            <optgroup label="<?php echo get_phrase('student'); ?>">
                <?php
                $students = $this->db->get('student')->result_array();
                foreach ($students as $row):
                    ?>

                    <option value="<?php echo $row['student_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('parent'); ?>">
                <?php
                $parents = $this->db->get('parent')->result_array();
                foreach ($parents as $row):
                    ?>

                    <option value="<?php echo $row['parent_id']; ?>">
                        - <?php echo $row['name']; ?></option>
						
						
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('librarian'); ?>">
                <?php
                $librarians = $this->db->get('librarian')->result_array();
                foreach ($librarians as $row):
                    ?>

                    <option value="<?php echo $row['librarian_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			
			 <optgroup label="<?php echo get_phrase('accountant'); ?>">
                <?php
                $accountants = $this->db->get('accountant')->result_array();
                foreach ($accountants as $row):
                    ?>

                    <option value="<?php echo $row['accountant_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			 <optgroup label="<?php echo get_phrase('hostel'); ?>">
                <?php
                $hostels = $this->db->get('hostel')->result_array();
                foreach ($hostels as $row):
                    ?>

                    <option value="<?php echo $row['hostel_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
        </select>                      
                      </div>
                  </div>
				  
				  
			<!-- FOR DISPLAYING LOAN APPLICANT INFORMATION -->	  
				  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('applicant_name');?></label>
                      <div class="col-sm-11">
 			<select class="form-control select2" name="name" required>

            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
            <optgroup label="<?php echo get_phrase('admin'); ?>">
                <?php
                $admins = $this->db->get('admin')->result_array();
                foreach ($admins as $row):
                    ?>

                    <option value="<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			
			
			<optgroup label="<?php echo get_phrase('teacher'); ?>">
                <?php
                $teachers = $this->db->get('teacher')->result_array();
                foreach ($teachers as $row):
                    ?>

                    <option value="<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			
            <optgroup label="<?php echo get_phrase('student'); ?>">
                <?php
                $students = $this->db->get('student')->result_array();
                foreach ($students as $row):
                    ?>

                    <option value="<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('parent'); ?>">
                <?php
                $parents = $this->db->get('parent')->result_array();
                foreach ($parents as $row):
                    ?>

                    <option value="<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>
						
						
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('librarian'); ?>">
                <?php
                $librarians = $this->db->get('librarian')->result_array();
                foreach ($librarians as $row):
                    ?>

                    <option value="<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			
			 <optgroup label="<?php echo get_phrase('accountant'); ?>">
                <?php
                $accountants = $this->db->get('accountant')->result_array();
                foreach ($accountants as $row):
                    ?>

                    <option value="<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			 <optgroup label="<?php echo get_phrase('hostel'); ?>">
                <?php
                $hostels = $this->db->get('hostel')->result_array();
                foreach ($hostels as $row):
                    ?>

                    <option value="<?php echo $row['name']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
        </select> 
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('loan_amount');?></label>
                      <div class="col-sm-11">
                          <input type="number" class="form-control" name="amount" / required>
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('purpose');?></label>
                      <div class="col-sm-11">
                          <textarea type="text" class="form-control" name="purpose" required></textarea>                      
				   </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('loan_duration');?></label>
                      <div class="col-sm-11">

						
						<select name="l_duration" class="form-control" required>
				  <option value="One Month">One Month</option>
				  <option value="Two Month">Two Months</option>
				  <option value="Three Months">Three Months</option>
				  <option value="Four Months">Four Months</option>
				   <option value="Five Month">Five Month</option>
				  <option value="Six Month">Six Months</option>
				  <option value="Seven Months">Seven Months</option>
				  <option value="Eight Months">Eight Months</option>
				  <option value="Nine Months">Nine Months</option>				 
				   <option value="Ten Months">Ten Months</option>
				  <option value="Eleven Months">Eleven Months</option>
				  <option value="One Year">One Year</option>
				  <option value="Two Years">Two Years</option>
				  <option value="Above Two Years">Above Two Years</option>
				  </select>
					                  
                      </div>
                  </div>
                    
                  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('payment_mode');?></label>
                      <div class="col-sm-11">
				  <select name="mop" class="form-control" required>
				  <option value="Daily">Daily</option>
				  <option value="Weekly">Weekly</option>
				  <option value="Bi-weekly">Bi-weekly</option>
				  <option value="Monthly">Monthly</option>
				  <option value="Bi-Monthly">Bi-Monthly</option>
				  <option value="Yearly">Yearly</option>
				  </select>                                                            
                      </div>
                  </div>
<hr>	
<div class="alert-danger">&nbsp;GUARANTOR'S INFORMATION</div>
<hr>
				  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('guarantor_name');?></label>
                      <div class="col-sm-11">
                          <input type="text" class="form-control" name="g_name"  / required>
                              
                      </div>
                  </div>
				  
				  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('relationship');?></label>
                      <div class="col-sm-11">
                          <input type="text" class="form-control" name="g_relationship"  / required>
                              
                      </div>
                  </div>
				  
				  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('guarantor_number');?></label>
                      <div class="col-sm-11">
                          <input type="text" class="form-control" name="g_number"  /required>
                              
                      </div>
                  </div>
				  
				   <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('guarantor_address');?></label>
                      <div class="col-sm-11">
                          <textarea type="text" class="form-control" name="g_address" required></textarea>
                              
                      </div>
                  </div>
				  
				  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('guanrator_country');?></label>
                      <div class="col-sm-11">
                          <input type="text" class="form-control" name="g_country"  /required>
                              
                      </div>
                  </div>
<hr>	
<div class="alert-danger">&nbsp;COLLATERAL INFORMATION</div>
<hr>
				  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('collaral_name');?></label>
                      <div class="col-sm-11">
                          <input type="text" class="form-control" name="c_name"  /required>
                              
                      </div>
                  </div>
				  
				  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('collaral_type');?></label>
                      <div class="col-sm-11">
                          <input type="text" class="form-control" name="c_type"  /required>
                              
                      </div>
                  </div>
				  
				  
				  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('collaral_model');?></label>
                      <div class="col-sm-11">
                          <input type="text" class="form-control" name="model"  /required>
                              
                      </div>
                  </div>
				  
				  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('collaral_make');?></label>
                      <div class="col-sm-11">
                          <input type="text" class="form-control" name="make"  /required>
                              
                      </div>
                  </div>
				  
				   <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('serial_number');?></label>
                      <div class="col-sm-11">
                          <input type="text" class="form-control" name="serial_number"  /required>
                              
                      </div>
                  </div>
				  
				  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('collateral_value');?></label>
                      <div class="col-sm-11">
                          <input type="number" class="form-control" name="value" placeholder= "How Much Does it Worth" /required>
                              
                      </div>
                  </div>
				  
				  <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('condition');?></label>
                      <div class="col-sm-11">
				  <select name="condition" class="form-control" required>
				  <option value="Daily">fair</option>
				  <option value="Weekly">Bad</option>
				  <option value="Bi-weekly">Good</option>
				  <option value="Monthly">Others</option>
				  </select>                              
                      </div>
                  </div>
				  
				    
                    <div class="form-group">
                        <label class="col-sm-1 control-label"><?php echo get_phrase('collateral_documents'); ?></label>
                        <div class="col-sm-11">
                        <input type="file" name="file_name" class="form-control file2 inline btn btn-success" data-label="<i class='glyphicon glyphicon-file'></i> Browse" />
						<p><div style="color:#FF0000">Note that you are to submit hardcopy the adminstrattive officer for proper verifications.<br>
												   You can upload zip files here, so zip all the documents and upload here.</div></p>

                    </div>
                    </div>
				  
				   <div class="form-group">
                      <label  class="col-sm-1 control-label"><?php echo get_phrase('status');?></label>
                      <div class="col-sm-11">
                          <input type="text" class="form-control" name="status" value="Pending" readonly="true"/required>
                              
                      </div>
                  </div>
                
                   <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-11">
                                <button type="submit" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>&nbsp;<?php echo get_phrase('save_loan');?></button>
                            </div>
                        </div>
				<br>
                    <?php echo form_close();?>
</div>
<script>
 $( function() {
		
			$( ".datepicker" ).datepicker({
				dateFormat: 'yy-mm-dd',
				changeMonth: true,
				changeYear: true
				
				
			});
		} );
</script>
