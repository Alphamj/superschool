<?php 
$edit_data		=	$this->db->get_where('holiday' , array('holiday_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_holiday');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/holiday/do_update/'.$row['holiday_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" value="<?php echo $row['title'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('holiday');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="holiday" value="<?php echo $row['holiday'];?>"/>
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
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_holiday');?></button>
						</div>
					</div>
        		</form>
    </div>
</div>

<?php
endforeach;
?>


