<?php 
	$edit_data	= $this->db->get_where('nursery_student_question', array('question_id' => $param2))->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_subject');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?teacher/nursery_student_question/' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                  <div class="form-group">
                               <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                               <div class="col-sm-6">
                                   <select name="class_id" id="class_id" class="form-control"  style="width:100%;" >
									<option value="<?php echo $row['class_id'];?>"><?php echo$this->crud_model->get_type_name_by_id('class',$row['class_id']);?></option>
                                   </select>
                               </div>
										
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label"><?php echo get_phrase('term');?></label>
                               <div class="col-sm-6">
                                   <select name="exam_id" class="form-control" style="width:100%;" >
									<option value="<?php echo $row['exam_id'];?>"><?php $exam_info =  $this->crud_model->get_exam_info($row['exam_id']);echo $exam_info[0]['name'];?></option>
                                      
                                   </select>
                               </div>
										
                            </div>
                            <div class="form-group">
                               <label class="col-sm-3 control-label"><?php echo get_phrase('Subject');?></label>
                               <div class="col-sm-6">
                                   <select name="subject_id" id="subject_id" class="form-control" style="width:100%;" >
									 
                                  <option value="<?php echo $row['subject_id'];?>"><?php echo $this->crud_model->get_subject_name_by_id($row['subject_id']); ?></option>
                                     
                                   </select>
                               </div>
										
                            </div>
                             <div class="form-group">
                               <label class="col-sm-3 control-label"><?php echo get_phrase('Question');?></label>
                               <div class="col-sm-6">
                                   <textarea name ="question_text" placeholder="Type..." required > <?php echo $row['question']; ?></textarea>
                               </div>
										
                            </div>
               <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">.
							<input type="hidden" name ="question_id" value="<?php echo $row['question_id']; ?>">
							<input type="hidden" name ="operation" value="update">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_subject');?></button>
						</div>
					</div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>



