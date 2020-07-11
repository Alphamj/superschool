<?php 
$edit_data		=	$this->db->get_where('vehicle' , array('vehicle_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?admin/vehicle/do_update/'.$row['vehicle_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
           <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('vehicle_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>


		   <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('vehicle_number');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="vehicle_no" value="<?php echo $row['vehicle_no'];?>"/>
                                </div>
                            </div>

							
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('vehicle_model');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="vehicle_model" value="<?php echo $row['vehicle_model'];?>"/>
                                </div>
                            </div>
							
								 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('year_made'); ?></label>
                        <div class="col-sm-9">
                            <div class="date-and-time">
                                <input type="text" name="year_made" class="form-control datepicker" data-format="D, dd MM yyyy" value="<?php echo $row['year_made'];?>">
                            </div>
                        </div>
                    </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('driver_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="driver_name" value="<?php echo $row['driver_name'];?>"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('driver_license');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="driver_license" value="<?php echo $row['driver_license'];?>"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('driver_contact');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="driver_contact" value="<?php echo $row['driver_contact'];?>"/>
                                </div>
                            </div>
							
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control selectboxit">
                                    	<option value="available" <?php if($row['status'] == 'available')echo 'selected';?>><?php echo get_phrase('available');?></option>
                                    	<option value="unavailable" <?php if($row['status'] == 'unavailable')echo 'selected';?>><?php echo get_phrase('unavailable');?></option>
                                    </select>
                                </div>
                            </div>
							
                		<div class="form-group">
                   	 <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                    	<div class="col-sm-9">
                        <input type="text" class="form-control" name="description" value="<?php echo $row['description'];?>"/>
                    	</div>
                		</div>
				
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-blue btn-sm"><i class="entypo-book"></i><?php echo get_phrase('edit_vehicle');?></button>
              </div>
            </div>
        </form>
        <?php endforeach;?>
    </div>
</div>