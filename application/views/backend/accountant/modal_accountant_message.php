<?php
$edit_data = $this->db->get_where('accountant', array('accountant_id' => $param2))->result_array();
foreach ($edit_data as $row):
    ?>
			  <div class="x_panel" >
                <div class="x_title">
                    <div class="panel-title" >
                        <?php echo get_phrase('new_message'); ?>
                    </div>
                </div>
                <div class="panel-body">
    <?php echo form_open(base_url() . 'index.php?accountant/message/send_new/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>
                   
				   <div align="center">
		<img src="<?php echo $this->crud_model->get_image_url('accountant' , $row['accountant_id']);?>" class="img-circle" width="100" height="100" />
		</div>
		<br>

                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('accountant_name'); ?></label>

                        <div class="col-sm-10">
      					<input type="hidden" class="form-control" name="reciever"  value="accountant-<?php echo $row['accountant_id']; ?>" readonly="true">
						<input type="text" class="form-control"  value="<?php echo $row['name']; ?>" readonly="true">
                        </div>
                    </div>
					<br><br>
					<div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('message'); ?></label>
					<div class="col-sm-10">
					<textarea name="message" class="form-control" id="optimum-editor" placeholder= "Please type your new message here for the selected accountant to read." required></textarea>
						</div>
						</div>

					<br><br><br><br>
                    

                    <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-mail"></i><?php echo get_phrase('send_message');?></button>
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
     