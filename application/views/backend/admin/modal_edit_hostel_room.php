<?php 
$edit_data		=	$this->db->get_where('hostel_room' , array('hostel_room_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?admin/hostel_room/do_update/'.$row['hostel_room_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('room_name');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('dormitory');?></label>
                    <div class="col-sm-5">
                        <select name="room_type_id" class="form-control">
                            <?php 
										$room_types = $this->db->get('room_type')->result_array();
										foreach($room_types as $row2):
										?>
                                <option value="<?php echo $row2['room_type_id'];?>"
                                    <?php if($row['room_type_id']==$row2['room_type_id'])echo 'selected';?>><?php echo $row2['name'];?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
				
				
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('number_of_bed');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="num_bed" value="<?php echo $row['num_bed'];?>"/>
                    </div>
                </div>
				
				 <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('cost_/_bed');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="cost_bed" value="<?php echo $row['cost_bed'];?>"/>
                    </div>
                </div>
				
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-blue btn-sm"><i class="entypo-book"></i><?php echo get_phrase('edit_hostel_room');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>