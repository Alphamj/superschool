<?php 
$edit_data		=	$this->db->get_where('help_link' , array('helplink_id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
 <div class="x_panel" >
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_help_link');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?formtutor/help_link/do_update/'.$row['helplink_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="title" value="<?php echo $row['title'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('links');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="link" value="<?php echo $row['link'];?>"/>
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

                        <div class="col-sm-5">
                            <select name="class_id" class="form-control">
                                <option value=""><?php echo get_phrase('select_class'); ?></option>
                                <?php $classes = $this->db->get_where('class', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
foreach ($classes as $row):
    ?>
                                        <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                   
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-orange btn-sm"><i class="entypo-plus">&nbsp;<?php echo get_phrase('update_now');?></i></button>
						</div>
					</div>
        		</form>
    </div>
</div>

<?php
endforeach;
?>


