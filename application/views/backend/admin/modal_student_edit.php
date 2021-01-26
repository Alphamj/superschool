<?php
$edit_data = $this->db->get_where('student', array('student_id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>
        <div class="col-md-12">
                <div class="x_title">
                    <div class="panel-title" >
                        <?php echo get_phrase('edit_student'); ?>
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?admin/student/' . $row['class_id'] . '/do_update/' . $row['student_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>



                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('photo'); ?></label>

                        <div class="col-sm-10">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                    <img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" alt="...">
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
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('name'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="<?php echo $row['name']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('surname'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="surname" data-validate="required" data-message-required="<?php echo get_phrase('value_required'); ?>" value="<?php echo $row['surname']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('parent'); ?></label>

                        <div class="col-sm-10">
                            <select name="parent_id" class="form-control"  >
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $parents = $this->db->get('parent')->result_array();
                                foreach ($parents as $row3):
                                    ?>
                                    <option value="<?php echo $row3['parent_id']; ?>"
                                            <?php if ($row['parent_id'] == $row3['parent_id']) echo 'selected'; ?>>
                                                <?php echo $row3['name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('class'); ?></label>

                        <div class="col-sm-10">
                            <select name="class_id" class="form-control" data-validate="required" id="class_id" 
                                    data-message-required="<?php echo get_phrase('value_required'); ?>"   >
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $classes = $this->db->get('class')->result_array();
                                foreach ($classes as $row2):
                                    ?>
                                    <option value="<?php echo $row2['class_id']; ?>"
                                            <?php if ($row['class_id'] == $row2['class_id']) echo 'selected'; ?>>
                                                <?php echo $row2['name']; ?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div> 
                    </div>


                    <div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('roll'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="roll" value="<?php echo $row['roll']; ?>" >
                        </div> 
                    </div>
					<div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('birthday'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control datepicker_student" name="birthday" value="<?php echo $row['birthday']; ?>" data-start-view="2">
                        </div> 
                    </div>
					<div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('age'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control" id="cal_age" name="age" value="<?php echo $row['age']; ?>" >
                        </div> 
                    </div>
					
					<div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('religion'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="religion" value="<?php echo $row['religion']; ?>" >
                        </div> 
                    </div>
					
					<!--<div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php //echo get_phrase('mother_tongue'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="m_tongue" value="<?php //echo $row['m_tongue']; ?>" >
                        </div> 
                    </div>-->

                    

                    <div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('gender'); ?></label>

                        <div class="col-sm-10">
                            <select name="sex" class="form-control selectboxit">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <option value="MALE" <?php if ($row['sex'] == 'MALE') echo 'selected'; ?>><?php echo 'MALE'; ?></option>
                                <option value="FEMALE"<?php if ($row['sex'] == 'FEMALE') echo 'selected'; ?>><?php echo 'FEMALE'; ?></option>
                            </select>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('address'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" value="<?php echo $row['address']; ?>" >
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('phone'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" value="<?php echo $row['phone']; ?>" >
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('email'); ?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php /*echo get_phrase('notes'); ?></label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" name="notes" ><?php echo $row['notes']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('dormitory'); ?></label>

                        <div class="col-sm-10">
                            <select name="dormitory_id" class="form-control selectboxit">
                                <option value=""><?php echo get_phrase('select'); ?></option>
                                <?php
                                $dormitories = $this->db->get('dormitory')->result_array();
                                foreach ($dormitories as $row2):
                                    ?>
                                    <option value="<?php echo $row2['dormitory_id']; ?>" 
                                            <?php if ($row['dormitory_id'] == $row2['dormitory_id']) echo 'selected'; ?>>
                                                <?php echo $row2['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('transportation'); ?></label>

                        <div class="col-sm-10">
                            <select name="transport_id" class="form-control selectboxit">
                                <option value=""><?php echo get_phrase('select_transport'); ?></option>
                                <?php
                                $transports = $this->db->get('transport')->result_array();
                                foreach ($transports as $row2):
                                    ?>
                                    <option value="<?php echo $row2['transport_id']; ?>"
                                            <?php if ($row['transport_id'] == $row2['transport_id']) echo 'selected'; ?>>
                                                <?php echo $row2['name']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div> 
                    </div>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('birth certificate');?></label>
                        <div class="col-sm-9">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div>
									<span class="btn btn-white btn-file">
										<span  id="file2">Choose file... </span>
										<input type="file" name="userfile2" id ="userfile2">
									</span>
								
								</div>
							</div>
						</div>
						<?php $birth_image= $this->crud_model->get_user_image_url('birth_certificate', $row['student_id']); ?>
						<a href="uploads/student_image/birth_certificate/<?php echo $birth_image; ?>"><span><?php echo $birth_image; ?></span></a>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('transfer certificate');?></label>
                        <div class="col-sm-9">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div>
									<span class="btn btn-white btn-file">
										<span  id="file3">Choose file... </span>
										<input type="file" name="userfile3" id ="userfile3">
									</span>
								
								</div>
							</div>
						</div>
						<?php $transfer_image= $this->crud_model->get_user_image_url('transfer_certificate', $row['student_id']); ?>
						<a href="uploads/student_image/transfer_certificate/<?php echo $transfer_image; ?>"><span><?php echo $transfer_image; ?></span></a>
					</div>
					<div class="form-group">
						<label  class="col-sm-3 control-label"><?php echo get_phrase('medical certificate');?></label>
                        <div class="col-sm-9">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div>
									<span class="btn btn-white btn-file">
										<span  id="file4">Choose file... </span>
										<input type="file" name="userfile4" id ="userfile4">
									</span>
								
								</div>
							</div>
						</div>
						<?php $medical_image= $this->crud_model->get_user_image_url('medical_certificate', $row['student_id']); ?>
						<a href="uploads/student_image/medical_certificate/<?php echo $medical_image; ?>"><span><?php echo $medical_image; */?></span></a>
					</div>-->
                    <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_student');?></button>
						</div>
					</div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

    <?php
endforeach;
?>

<script type="text/javascript">
	jQuery(document).ready(function ($){
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


         $('a[href^="</div"]').each(function(){ 
            var oldUrl = $(this).attr("href"); // Get current url
            var newUrl = "#"; // Create new url
            $(this).attr("href", newUrl); // Set herf value
        });



	});
    function get_class_sections(class_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>index.php?admin/get_class_section/' + class_id,
            success: function (response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

    var class_id = $("#class_id").val();

    $.ajax({
        url: '<?php echo base_url(); ?>index.php?admin/get_class_section/' + class_id,
        success: function (response)
        {
            jQuery('#section_selector_holder').html(response);
        }
    });


</script>
