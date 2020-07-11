<?php 
$edit_data		=	$this->db->get_where('subject' , array('subject_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_student');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/modify_subject_jss/do_update/'.$row['subject_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('class');?></label>
                        <div class="col-sm-10">
                            <select name="class_ids" class="form-control"  style="float:left;" required>
                                        <option value=""><?php echo get_phrase('select_a_class');?></option>
                                             <?php 
                                             $classes = $this->db->get('class')->result_array();
                                             foreach($classes as $rows):
                                                  if ($rows['class_id'] > 19 && $rows['class_id'] < 29){
                                             ?>
                                                       <option value="<?php echo $rows['class_id'];?>"
                            					          <?php if ($class_ids == $rows['class_id']) echo 'selected';?>>
                            				 	     	<?php echo $rows['name'];?>
							   		          </option>
						               <?php } endforeach; ?>
                                   </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('subject');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" readonly = 'true'/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('teacher');?></label>
                        <div class="col-sm-10">
                              <?php  $teachers = $this->db->get_where('teacher', array('teacher_id' => $row['teacher_id']))->result_array(); ?>
                              <input type="text" class="form-control" name="teacher_id1" value="<?php echo $teachers[0]['name'];?>" readonly = 'true'/>
                              <input type="hidden" name="teacher_id1" value="<?php echo $row['teacher_id'];?>" readonly = 'true'/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('subject');?></label>
                        <div class="col-sm-10">
                            <select name="sub_id" class="form-control">
                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php 
                                $subject = $this->db->get('subject')->result_array();
                                foreach($subject as $row2):
                                ?>
                                    <option value="<?php echo $row2['subject_id'];?>"
                                        <?php if($row['teacher_id'] == $row2['teacher_id'])echo 'selected';?>>
                                             <?php $subj = $this->db->get_where('teacher',array('teacher_id' => $row2['teacher_id']))->result_array(); ?>
                                                  <?php echo $row2['name'],'', ' => ', '', $subj[0]['name'];?>
                                                </option>
                                <?php
                                endforeach;;
                                ?>

                            </select>
                        </div>
                    </div>
            		<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_class');?></button>
						</div>
					</div>
        		</form>
    </div>
</div>

<?php
endforeach;
?>
<script type="text/javascript">
    $('a[href^="</div"]').each(function(){ 
            var oldUrl = $(this).attr("href"); // Get current url
            var newUrl = "#"; // Create new url
            $(this).attr("href", newUrl); // Set herf value
        });
</script>

