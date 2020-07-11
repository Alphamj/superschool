<?php 
$edit_data		=	$this->db->get_where('exam' , array('exam_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_exam_term');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/exam/edit/do_update/'.$row['exam_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('date');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="datepicker form-control" name="date" value="<?php echo $row['date'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('comment');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="comment" value="<?php echo $row['comment'];?>"/>
                    </div>
                </div>
                <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_exam');?></button>
						</div>
					</div>
            </form>
    </div>
</div>

<?php
endforeach;
?>





