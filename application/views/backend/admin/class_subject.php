
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
		<?php echo form_open(base_url() . 'index.php?admin/class_subject');?>

					 <?php echo get_phrase('get_subjects'); ?>
					</div>
					</div>
					                       
                        <div class="form-group">
                        <div class="col-sm-12">
                            <select name="class_id" class="form-control" onchange='this.form.submit()' required>
                              <option value=""><?php echo get_phrase('select_class_first');?></option>
                              		<?php 
									//$classes = $this->db->get('class')->result_array();
									foreach($classes as $row):
										?>
                                		<option value="<?php echo $row['class_id'];?>" <?php if ($class_id != ''){ if ($class_id ==$row['class_id']){ echo "selected";}} ?>>
												<?php echo $row['name'];?>
                                                </option>
                                    <?php
									endforeach;
								?>
                          </select>
                        </div>
                    </div> 

				<input type="hidden" name="operation" value="selection">

<noscript><button type="submit" class="btn btn-green btn-icon icon-left"><i class="entypo-search"></i><?php echo get_phrase('get_student_list');?></button></noscript>

		<?php echo form_close();?>
</div>		
</div>		
<div class="col-md-5">
 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_subjects'); ?>
					</div>
					</div>
 <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'index.php?admin/class_subject/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                           
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                                <div class="col-sm-6">
                                    <select name="class_ids" class="form-control" style="width:100%;">
                                    	<?php 
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
											if ($row['class_id'] < 40){
										?>
                                    		<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
											<?php }
										endforeach;
										?>
                                    </select>
                                </div>
										
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                                <div class="col-sm-6">
                                   	<div id="custom-select-option-box" style="display: block;">
										<div class="custom-select" id="custom-select">Select Subject</div>
                                    	<?php 
										$subject = $this->db->get('subject')->result_array();
										foreach($subject as $rows):
											$teachers = $this->db->get_where('teacher', array('teacher_id' => $rows['teacher_id']))->result_array();
										?>
										<div class="custom-select-option" style="background: rgb(198, 231, 237);">
                                    		<input class="custom-select-option-checkbox" type="checkbox" name="subject_ids[]" value="<?php echo $rows['subject_id'];?>"> <?php echo $rows['name'];?> - <?php echo $teachers[0]['name']; ?>
										</div>
                                        <?php
										endforeach;
										?>
                                    </div>
                                </div>
						     </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class=" btn-sm btn btn-blue"><i class="entypo-book"></i><?php echo get_phrase('add_subject');?></button>
                              </div>
						   </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->

 <div class="col-md-7">
 <div class="x_panel table-responsive">
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_subjects'); ?>
					</div>
					</div>

				
                <table class="table" id="table_export">
                	<thead>
                		<tr>
							<th><div><?php echo get_phrase('class');?></div></th>
                    		<th><div><?php echo get_phrase('subject_name');?></div></th>
                    		<th><div><?php echo get_phrase('teacher');?></div></th>
                    		
						</tr>
					</thead>
                    <tbody>
                    	<?php
                    	if($class_id){
							$subjects=$this->db->get_where('class_subject', array('class_id' => $class_id))->result_array();
						}else{
							$subjects= $this->db->get('class_subject')->result_array();
                    	}
                    
						$count = 1;foreach($subjects as $row):
						$class_dat =  $this->crud_model->get_type_name_by_id1('class',$row['class_id']);
							
                    	 ?>
                        <tr>
							<td><?php echo $class_dat[0]['name']; ?></td>
							<td><?php echo $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']); ?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('teacher',$class_dat[0]['teacher_id']); ?></td>
							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->
 
			          
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>
