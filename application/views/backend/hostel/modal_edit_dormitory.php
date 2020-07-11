<?php 
$edit_data		=	$this->db->get_where('dormitory' , array('dormitory_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?hostel/dormitory/do_update/'.$row['dormitory_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            <div class="padded">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo get_phrase('hostel_name');?></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                    </div>
                </div>
				
				  <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('hostel_room');?></label>
                                <div class="col-sm-10">
                                    <select name="hostel_room_id" class="form-control" style="width:100%;">
									<option>Select hostel category</option>
                                    	<?php 
										$hostel_rooms = $this->db->get('hostel_room')->result_array();
										foreach($hostel_rooms as $row7):
										?>
                                    		<option value="<?php echo $row7['hostel_room_id'];?>"><?php echo $row7['name'];?></option>
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