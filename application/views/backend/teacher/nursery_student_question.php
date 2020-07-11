<div class="col-md-5">
 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_question'); ?>
					</div>
					</div>
 <!----CREATION FORM STARTS---->

                	<?php 
						$get_system_settings	=	$this->crud_model->get_system_settings();
						$current_session = $get_system_settings[17]['description'];
						echo form_open(base_url() . 'index.php?teacher/nursery_student_question/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="form-group">
                               <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                               <div class="col-sm-6">
                                   <select name="class_id" id="class_id" class="form-control"  style="width:100%;" >
									 <option value="">Select Class</option>
                                   	<?php 
                                   	$this->db->from('class');
									$this->db->like('name', 'nurs');
									$this->db->or_like('name', 'toddler');
									$classes = $this->db->get()->result_array();
									foreach($classes as $row):
									?>
                                   		<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                       <?php
									endforeach;
									?>
                                   </select>
                               </div>
										
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label"><?php echo get_phrase('term');?></label>
                               <div class="col-sm-6">
                                   <select name="exam_id" class="form-control" style="width:100%;" >
									  
                                   	<?php 
									
									$classes = $this->db->get('exam')->result_array();
									foreach($classes as $row):
									?>
                                   		<option value="<?php echo $row['exam_id'];?>"><?php echo $row['name'];?></option>
                                       <?php
									endforeach;
									?>
                                   </select>
                               </div>
										
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label"><?php echo get_phrase('Subject');?></label>
                               <div class="col-sm-6">
                                   <select name="subject_id" id="subject_id" class="form-control" style="width:100%;" >
									  <option value="">Select Subject</option>
                                  
                                   </select>
                               </div>
										
                            </div>
                             <div class="form-group">
                               <label class="col-sm-3 control-label"><?php echo get_phrase('Question');?></label>
                               <div class="col-sm-6">
                                   <textarea name ="question_text" placeholder="Type..." required ></textarea>
                               </div>
										
                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
								  <input type="hidden" name="operation" value="insert">
								  <input type="hidden" name="session_year" value="<?php echo $current_session; ?>">
                                  <button type="submit" class=" btn-sm btn btn-blue"><i class="entypo-book"></i><?php echo get_phrase('add_question');?></button>
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
					 <?php echo get_phrase('list_questions'); ?>
					</div>
					</div>

				
                <table class="table" id="table_export">
                	<thead>
                		<tr>
							
							<th><div><?php echo get_phrase('class');?></div></th>
                    		<th><div><?php echo get_phrase('subject_name');?></div></th>
                    		<th><div><?php echo get_phrase('term');?></div></th>
                    		<th><div><?php echo get_phrase('question');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php  
							$questions =	$this->crud_model->get_nursery_student_question($current_session);
                    	
                    	$count = 1;foreach($questions as $row):?>
                        <tr>
							
							 <td><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>
							<td><?php echo $this->crud_model->get_subject_name_by_id($row['subject_id']);?></td>
							<td><?php $exam_info =  $this->crud_model->get_exam_info($row['exam_id']);echo $exam_info[0]['name']; ?></td>
							<td><?php echo $row['question'];?></td>
							<td>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_question/<?php echo $row['question_id'];?>')"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
				
                   
					 <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?teacher/nursery_student_question/delete/<?php echo $row['question_id'];?>')"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
					 
                            
        					</td>
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
		$("#class_id").change(function(){
			var class_id = $(this).val();
			if(class_id){
				$.ajax({
					url: '<?php echo base_url();?>index.php?teacher/nursery_subjects/'+class_id,
					success: function(response){
						if($.trim(response)){
							$("#subject_id").html(response);
						}else{
							$("#subject_id").html('');
						}
					}
				});
			}
		});

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>
