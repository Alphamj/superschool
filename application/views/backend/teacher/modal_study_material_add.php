<?php $class_info = $this->db->get('class')->result_array(); ?>


<div class="x_panel" >

            <div class="x_title">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_study_material'); ?></h3>
                </div>
            </div>


                <?php echo form_open(base_url().'index.php?teacher/study_material/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-1 control-label"><?php echo get_phrase('date'); ?></label>

                        <div class="col-sm-11">
                            <div class="date-and-time">
                                <input type="text" name="timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>
					
					<?php $a = $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
				 foreach ($a as $row4):
				 ?>
				 <input type="hidden" class="form-control" name="teacher_id" value="<?php echo $row4['teacher_id'];?>" data-validate="required">
<?php
								endforeach;
							  ?>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-1 control-label"><?php echo get_phrase('title'); ?></label>

                        <div class="col-sm-11">
                            <input type="text" name="title" class="form-control" id="field-1" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('info'); ?></label>

                        <div class="col-sm-11">
                            <textarea name="description" class="form-control wysihtml5" id="field-ta" data-stylesheet-url="assets/css/wysihtml5-color.css"></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('class'); ?></label>

                        <div class="col-sm-11">
                            <select name="class_id" class="form-control" >
                                    <option value=""><?php echo get_phrase('select_class'); ?></option>
                                   <?php 
                                   $classes = $this->db->get('class')->result_array();
                                   $sect = $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
                             foreach($classes as $row):
                                   ?>
                                      <?php if ($sect[0]['section'] == 'Secondary'): 
                                       if ($row['class_id'] > 19 && $row['class_id'] < 40){ ?>
                                               <option value="<?php echo $row['class_id'];?>"
                                                   <?php if ($class_id == $row['class_id']) echo 'selected';?>>
                                                        <?php echo $row['name'];?>
                                          </option> <?php } endif ?>
                                  
                               <?php if ($sect[0]['section'] == 'Primary'):
                                       if ($row['class_id'] > 0 && $row['class_id'] < 20){ ?>
                                               <option value="<?php echo $row['class_id'];?>"
                                                   <?php if ($class_id == $row['class_id']) echo 'selected';?>>
                                                        <?php echo $row['name'];?>
                                          </option> <?php } endif?>
                                          
                               <?php if ($sect[0]['section'] == 'Nursery'):
                                       if ($row['class_id'] > 40 && $row['class_id'] < 50){ ?>
                                               <option value="<?php echo $row['class_id'];?>"
                                                   <?php if ($class_id == $row['class_id']) echo 'selected';?>>
                                                        <?php echo $row['name'];?>
                                          </option> <?php } endif?>
   
                               <?php if ($sect[0]['section'] == 'Toddler'):
                                       if ($row['class_id'] == 40){ ?>
                                               <option value="<?php echo $row['class_id'];?>"
                                                   <?php if ($class_id == $row['class_id']) echo 'selected';?>>
                                                        <?php echo $row['name'];?>
                                               </option> <?php } endif?>
                                    <?php endforeach; ?>
                                        
                                </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-1 control-label"><?php echo get_phrase('file'); ?></label>

                        <div class="col-sm-11">

                            <input type="file" name="file_name" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> Browse" required/>

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-1 control-label"><?php echo get_phrase('file_type'); ?></label>

                        <div class="col-sm-11">
                            <select name="file_type" class="form-control">
                                <option value=""><?php echo get_phrase('select_file_type'); ?></option>
                                <option value="image"><?php echo get_phrase('image'); ?></option>
                                <option value="doc"><?php echo get_phrase('doc'); ?></option>
                                <option value="pdf"><?php echo get_phrase('pdf'); ?></option>
                                <option value="excel"><?php echo get_phrase('excel'); ?></option>
                                <option value="other"><?php echo get_phrase('other'); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
						<div class="col-sm-offset-1 col-sm-11">
							<button type="submit" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-pencil"></i><?php echo get_phrase('add_material');?></button>
						</div>
					</div>
                </form>

           
</div>