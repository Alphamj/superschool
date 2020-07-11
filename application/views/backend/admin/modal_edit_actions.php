<?php 
$edit_data		=	$this->db->get_where('actions' , array('action_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?admin/actions/do_update/'.$row['action_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
           
							  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('action_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="action_name" value="<?php echo $row['action_name'];?>"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('display');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="display" value="<?php echo $row['display'];?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('parent_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="parent_name" value="<?php echo $row['parent_name'];?>"/>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('parent_key');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="parent_key" value="<?php echo $row['parent_key'];?>"/>
                                </div>
                            </div>
					
					
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-blue btn-sm"><i class="entypo-book"></i><?php echo get_phrase('edit_actions');?></button>
              </div>
            </div>

        </form>
        <?php endforeach;?>
    </div>
</div>