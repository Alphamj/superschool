<?php 
$edit_data		=	$this->db->get_where('help_desk' , array('helpdesk_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_help_desk');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/help_desk/do_update/'.$row['helpdesk_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('purpose');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="purpose" value="<?php echo $row['purpose'];?>"/>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('purpose');?></label>
                        <div class="col-sm-10">
                        <textarea type="text" class="form-control" name="content"><?php echo $row['content'];?></textarea>
                        </div>
                    </div>
					
                   
            		<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_help_desk');?></button>
						</div>
					</div>
        		</form>
    </div>
</div>

<?php
endforeach;
?>


