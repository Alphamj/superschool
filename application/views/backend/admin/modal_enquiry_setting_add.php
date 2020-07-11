<?php $class_info = $this->db->get('class')->result_array(); ?>
    <div class="col-md-12">


            <div class="x_title">
                <div class="panel-title">
                    <h3><?php echo get_phrase('add_enquiry_setting'); ?></h3>
                </div>
            </div>

            <div class="panel-body">

                <?php echo form_open(base_url().'index.php?admin/enquiry_setting/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

                   
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('category'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="category" class="form-control" id="field-1" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="field-ta" class="col-sm-2 control-label"><?php echo get_phrase('purpose'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="purpose" class="form-control" id="field-1" >
                        </div>
                    </div>
                    
					 <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('whom'); ?></label>

                        <div class="col-sm-10">
                            <input type="text" name="whom" class="form-control" id="field-1" >
                        </div>
                    </div>

                    <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-plus"></i><?php echo get_phrase('save_enquiry');?></button>
						</div>
					</div>
                </form>


    </div>
</div>