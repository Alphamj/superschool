<?php
$edit_book = $this->db->get_where('student', array('student_id' => $param2))->result_array();
foreach ($edit_book as $row):
    ?>
			  <div class="x_panel" >
                <div class="x_title">
                    <div class="panel-title" >
                        <?php echo get_phrase('student_card_number'); ?>
                    </div>
                </div>
				<div align="center">
		<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" class="img-circle" width="100" height="100" />
		</div>
		
                <div class="panel-body">

                    <?php echo form_open(base_url() . 'index.php?admin/student/' . $row['class_id'] . '/edit_book/' . $row['student_id'], array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data')); ?>
                   
					<div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('issue_date'); ?></label>

                        <div class="col-sm-10">
                            <div class="date-and-time">
                                <input type="text" name="issue_date" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>
				
					<div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('expire_date'); ?></label>

                        <div class="col-sm-10">
                            <div class="date-and-time">
                                <input type="text" name="expire_date" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>
					
				
					<div class="form-group">
                    <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('card_number'); ?></label>
					<div class="col-sm-10">
	<?php
	function generateRandomString($length = 5) {
    $characters = '012345678987654321076543210654321010234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
?>   
					<input type="text" name="card_number" class="form-control"  value="<?php echo generateRandomString(); ?>" readonly="true">

						</div>
						</div>

				
                    

                    <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-book"></i><?php echo get_phrase('issue_number');?></button>
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
     