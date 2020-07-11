<?php 
$edit_data		=	$this->db->get_where('circular' , array('circular_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_circular');?>
            	</div>
            </div>
			<div class="panel-body">
			
                <?php echo form_open(base_url() . 'index.php?admin/circular/do_update/'.$row['circular_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="subject" value="<?php echo $row['subject'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('reference_no');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ref" value="<?php echo $row['ref'];?>"/>
                        </div>
                    </div>
					
					<div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('content');?></label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="content"><?php echo $row ['content'];?></textarea>
                                </div>
                            </div>
					
							
                    <div class="form-group">
                        <label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('date'); ?></label>

                        <div class="col-sm-10">
                            <div class="date-and-time">
                                <input type="text" value="<?php echo $row['date'];?>" name="date" class="form-control datepicker" data-format="D, dd MM yyyy">
                            </div>
                        </div>
                    </div>
                            
					
                   
            		<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_circular');?></button>
						</div>
					</div>
        		</form>
    </div>
</div>

<?php
endforeach;
?>


