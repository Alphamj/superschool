<?php 
$edit_data		=	$this->db->get_where('subject' , array('subject_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_subject');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/subject/do_update/'.$row['subject_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-10 controls">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
                <!-- comment on 28 may 2018 sandeep --> 
               <!--  <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('class');?></label>
                    <div class="col-sm-10 controls">
                        <select name="class_id" class="form-control">
                            <?php 
                          /*  $classes = $this->db->get('class')->result_array();
                            foreach($classes as $row2):*/
                            ?>
                                <option value="<?php echo $row2['class_id'];?>"
                                    <?php //if($row['class_id'] == $row2['class_id'])echo 'selected';?>>
                                        <?php //echo $row2['name'];?>
                                            </option>
                            <?php
                          //  endforeach;
                            ?>
                        </select>
                    </div>
                </div>-->
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('teacher');?></label>
                    <div class="col-sm-10 controls">
                        <select name="teacher_id" class="form-control">
                            <option value=""></option>
                            <?php 
                            $teachers = $this->db->get('teacher')->result_array();
                            foreach($teachers as $row2):
                            ?>
                                <option value="<?php echo $row2['teacher_id'];?>"
                                    <?php if($row['teacher_id'] == $row2['teacher_id'])echo 'selected';?>>
                                        <?php echo $row2['name'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
               <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
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



