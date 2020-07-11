<?php 
$edit_data		=	$this->db->get_where('todays_thought' , array('tthought_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_todays_thought');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/todays_thought/do_update/'.$row['tthought_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('thought');?></label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" name="thought" ><?php echo $row['thought'];?></textarea>
                        </div>
                    </div>
					
            		<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_thought');?></button>
						</div>
					</div>
        		</form>
    </div>
</div>

<?php
endforeach;
?>


