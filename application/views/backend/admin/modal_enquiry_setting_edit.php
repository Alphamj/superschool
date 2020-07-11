<?php 
$class_info                 = $this->db->get('enquiry_category')->result_array();
$single_study_material_info = $this->db->get_where('enquiry_category', array('enquirycat_id' => $param2))->result_array();
foreach ($single_study_material_info as $row) {
?>
        <div class="col-md-12">


                <div class="x_title">
                    <div class="panel-title">
                        <h3><?php echo get_phrase('edit_enquiry_category'); ?></h3>
                    </div>
                </div>

                <div class="panel-body">

                    <form role="form" class="form-horizontal form-groups-bordered" action="<?php echo base_url(); ?>index.php?admin/enquiry_setting/do_update/<?php echo $row['enquirycat_id'] ?>" method="post" enctype="multipart/form-data">

                      
					  
					     <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('category'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="category"  value="<?php echo $row['category']; ?>" class="form-control" id="field-1" >
                        </div>
                    </div>
					
                      <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('purpose'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="purpose"  value="<?php echo $row['purpose']; ?>" class="form-control" id="field-1" >
                        </div>
                    </div>
                        
                         <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('whom'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="whom"  value="<?php echo $row['whom']; ?>" class="form-control" id="field-1" >
                        </div>
                    </div>
					
                       <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_enquiry');?></button>
						</div>
					</div>
                    </form>

                </div>

            </div>

        </div>
    </div>
<?php } ?>