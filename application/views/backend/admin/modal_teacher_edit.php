<?php 
$edit_data		=	$this->db->get_where('teacher' , array('teacher_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_teacher');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/teacher/do_update/'.$row['teacher_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                        		
                                <div class="form-group">
                                <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('photo');?></label>
                                
                                <div class="col-sm-10">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                            <img src="<?php echo $this->crud_model->get_image_url('teacher' , $row['teacher_id']);?>" alt="...">
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
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
                            <!--<div class="form-group">
                                <label class="col-sm-2 control-label"><?php //echo get_phrase('birthday');?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="datepicker form-control" name="birthday" value="<?php echo $row['birthday'];?>"/>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('sex');?></label>
                                <div class="col-sm-10">
                                    <select name="sex" class="form-control selectboxit">
                                    	<option value="Male" <?php if($row['sex'] == 'male')echo 'selected';?>><?php echo 'Male';?></option>
                                    	<option value="Female" <?php if($row['sex'] == 'female')echo 'selected';?>><?php echo 'Female';?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('address');?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('phone');?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo 'section';?></label>
                                <div class="col-sm-10">
                                    <select name="section" class="form-control selectboxit">
                                        <option value="Toddler" <?php if($row['section'] == 'Toddler')echo 'selected';?>><?php echo 'Toddler';?></option>
                                    	<option value="Nursery" <?php if($row['section'] == 'Nursery')echo 'selected';?>><?php echo 'Nursery';?></option>
                                    	<option value="Primary" <?php if($row['section'] == 'Primary')echo 'selected';?>><?php echo 'Primary';?></option>
                                        <option value="Secondary" <?php if($row['section'] == 'Secondary')echo 'selected';?>><?php echo 'Secondary';?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('Signature'); ?></label>
                                <div class="col-sm-10">
                                <input type="file" name="signature" class="form-control file2 inline btn btn-primary btn-sm" data-label="<i class='glyphicon glyphicon-file'></i> Browse Document" />
                                </div>
                            </div>

                       <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_teacher');?></button>
						</div>
					</div>
                <?php echo form_close();?>
    </div>
</div>

<?php
endforeach;
?>