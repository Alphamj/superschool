<?php 
$edit_data		=	$this->db->get_where('nnursery_subject_3' , array('nursub_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        <div class="x_title">
        	<div class="panel-title" >
				<?php echo get_phrase('edit_subject');?>
        	</div>
        </div>
		<div class="panel-body">
            <?php echo form_open(base_url() . 'index.php?admin/nursery_subject_3/do_update/'.$row['nursub_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo get_phrase('language');?></label>
                <div class="col-sm-10 controls">
                    <input type="text" class="form-control" name="language" value="<?php echo $row['language'];?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo get_phrase('social');?></label>
                <div class="col-sm-10 controls">
                    <input type="text" class="form-control" name="social" value="<?php echo $row['social'];?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><?php echo get_phrase('knowledge');?></label>
                <div class="col-sm-10 controls">
                    <input type="text" class="form-control" name="knowledge" value="<?php echo $row['knowledge'];?>"/>
                </div>
            </div>
                
            <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_subject');?></button>
				</div>
			</div>
        	</form>
        </div>
    </div>

<?php
endforeach;
?>



