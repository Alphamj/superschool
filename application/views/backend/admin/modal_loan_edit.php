<?php 
$edit_data		=	$this->db->get_where('loan' , array('loan_id' => $param2) )->result_array();
foreach ( $edit_data as $row2):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('update_loan_approval');?>
            	</div>
            </div>
			<div class="panel-body">
                    <?php echo form_open(base_url() . 'index.php?admin/loan_approval/do_update/'.$row2['loan_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    
				
				   <div class="form-group">
                      <label  class="col-sm-2 control-label"><?php echo get_phrase('status');?></label>
                      <div class="col-sm-10">
 							  <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="Approved"><?php echo get_phrase('Approved'); ?></option>
                                <option value="Disapproved"><?php echo get_phrase('Disapproved'); ?></option>
                                <option value="Pending"><?php echo get_phrase('Pending'); ?></option>
                            </select>                              
                      </div>
                  </div>
                            
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i>&nbsp;<?php echo get_phrase('update_loan');?></button>
                            </div>
                        </div>
                <?php echo form_close();?>
    </div>
</div>

<?php
endforeach;
?>