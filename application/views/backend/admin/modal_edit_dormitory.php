<?php 
$edit_data		=	$this->db->get_where('dormitory' , array('dormitory_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?admin/dormitory/do_update/'.$row['dormitory_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('hostel_name');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
				
				 <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('hostel_room');?></label>
                    <div class="col-sm-10 controls">
                        <select name="hostel_room_id" class="form-control">
                            <?php 
                            $classes = $this->db->get('hostel_room')->result_array();
                            foreach($classes as $row2):
                            ?>
                                <option value="<?php echo $row2['hostel_room_id'];?>"
                                    <?php if($row['hostel_room_id'] == $row2['hostel_room_id'])echo 'selected';?>>
                                        <?php echo $row2['room_name'];?>
                                            </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
				
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('capacity');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="capacity" value="<?php echo $row['capacity'];?>"/>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('address');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="address" value="<?php echo $row['address'];?>"/>
                    </div>
                </div>
				
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"/>
                    </div>
                </div>
            </div>
           <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-plus"></i><?php echo get_phrase('save_dormitory');?></button>
						</div>
					</div>
        </form>
        <?php endforeach;?>
    </div>
</div>