<?php 
$class_info                 = $this->db->get('class')->result_array();
$single_study_material_info = $this->db->get_where('examquestion', array('examquestion_id' => $param2))->result_array();
foreach ($single_study_material_info as $row5) {
?>
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-primary" data-collapsed="0">

                <div class="x_title">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_examquestion'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?teacher/examquestion/do_update/<?php echo $row['examquestion_id'] ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date'); ?></label>

                            <div class="col-sm-7">
                                <div class="date-and-time">
                                    <input type="text" name="timestamp" class="form-control datepicker" data-format="D, dd MM yyyy" 
                                           placeholder="date here" value="<?php echo date("d M, Y", $row5['timestamp']); ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
                        
						<div class="col-sm-5">
							<select name="class_id" class="form-control" data-validate="required" id="class_id" 
								data-message-required="<?php echo get_phrase('value_required');?>"
									onchange="return get_class_sections(this.value)">
                              <option value=""><?php echo get_phrase('select');?></option>
                               <?php $classes = $this->db->get_where('class', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
foreach ($classes as $row):
    ?>
                            		<option value="<?php echo $row['class_id'];?>">
											<?php echo $row['name'];?>
                                            </option>
                                <?php
								endforeach;
							  ?>
                          </select>
						</div> 
					</div>
					
				<div class="form-group">
                    <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('subject'); ?></label>
		                    <div class="col-sm-5">
		                        <select name="subject_id" class="form-control" id="section_selector_holder">
		                            <option value=""><?php echo get_phrase('select_class_first');?></option>
			                        
			                    </select>
			                </div>
					</div>
                        
                        <div class="form-group">
                            <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('description'); ?></label>

                            <div class="col-sm-9">
                                <textarea name="description" class="form-control wysihtml5" data-stylesheet-url="<?php echo base_url(); ?>assets/css/wysihtml5-color.css"
                                          id="field-ta"><?php echo $row5['description']; ?></textarea>
                            </div>
                        </div>

                       
						
						

                        <div class="col-sm-3 control-label col-sm-offset-1">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>

<script type="text/javascript">

	function get_class_sections(class_id) {

    	$.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#section_selector_holder').html(response);
            }
        });

    }

</script>