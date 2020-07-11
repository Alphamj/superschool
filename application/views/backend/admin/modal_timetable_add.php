 <div class="x_panel" >
       <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_time_table'); ?>
					</div>
					</div>
					
		            
			<!----CREATION FORM STARTS---->
                	<?php echo form_open(base_url() . 'index.php?admin/class_routine/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('select_class');?></label>
                                <div class="col-sm-7">
                                    <select name="class_id" class="form-control" style="width:100%;"
                                        onchange="return get_class_subject(this.value)">
                                        <option value=""><?php echo get_phrase('select_class');?></option>
                                    	<?php 
										$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
		<a href="<?php echo base_url();?>index.php?admin/classes/"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('select_subject');?></label>
                                <div class="col-sm-7">
                                    <select name="subject_id" class="form-control" style="width:100%;" id="subject_selection_holder">
                                        <option value=""><?php echo get_phrase('select_class_first');?></option>
                                    	
                                    </select>
                                </div>
				<a href="<?php echo base_url();?>index.php?admin/subject/"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>

                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('select_day');?></label>
                                <div class="col-sm-10">
                                    <select name="day" class="form-control selectboxit" style="width:100%;">
                                        <option value="sunday">sunday</option>
                                        <option value="monday">monday</option>
                                        <option value="tuesday">tuesday</option>
                                        <option value="wednesday">wednesday</option>
                                        <option value="thursday">thursday</option>
                                        <option value="friday">friday</option>
                                        <option value="saturday">saturday</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('start_time');?></label>
                                <div class="col-sm-10">
                                    <div class="col-md-4">
                                        <select name="time_start" class="form-control selectboxit">
                                            <option value=""><?php echo get_phrase('H');?></option>
    										<?php for($i = 0; $i <= 12 ; $i++):?>
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="time_start_min" class="form-control selectboxit">
                                            <option value=""><?php echo get_phrase('M');?></option>
                                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="starting_ampm" class="form-control selectboxit">
                                        	<option value="1">am</option>
                                        	<option value="2">pm</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('end_time');?></label>
                                <div class="col-sm-10">
                                    <div class="col-md-4">
                                        <select name="time_end" class="form-control selectboxit">
                                            <option value=""><?php echo get_phrase('H');?></option>
    										<?php for($i = 0; $i <= 12 ; $i++):?>
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="time_end_min" class="form-control selectboxit">
                                            <option value=""><?php echo get_phrase('M');?></option>  
                                            <?php for($i = 0; $i <= 11 ; $i++):?>
                                                <option value="<?php echo $i * 5;?>"><?php echo $i * 5;?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="ending_ampm" class="form-control selectboxit">
                                        	<option value="1">am</option>
                                        	<option value="2">pm</option>
                                        </select>
                                    </div>
                                </div>
								</div>
								
								
								<div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('select_teacher');?></label>
                                <div class="col-sm-7">
                                    <select name="teacher_id" class="form-control" style="width:100%;" required>
                                        <option value=""><?php echo get_phrase('select_class');?></option>
                                    	<?php 
										$teachers = $this->db->get('teacher')->result_array();
										foreach($teachers as $row):
										?>
                                    		<option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
<a href="<?php echo base_url();?>index.php?admin/teacher/"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>
                            </div>
																
							
							<div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('hall_number');?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="room"/ required>
                                </div>
                            </div>
							
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-plus"></i><?php echo get_phrase('add_time_table');?></button>
                              </div>
							</div>
							<br>
                    </form>                
                </div>                
			<!----CREATION FORM ENDS-->	