
<div class="col-md-5">

        <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_hostel_room'); ?>
					</div>
					</div>
<!----CREATION FORM STARTS---->
                	<?php echo form_open(base_url() . 'index.php?hostel/hostel_room/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('room_name_/_number');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name"/>
                                </div>
                            </div>
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('room_type');?></label>
                                <div class="col-sm-9">
                                    <select name="room_type_id" class="form-control" style="width:100%;">
									<option>Select Room Type</option>
                                    	<?php 
										$room_types = $this->db->get('room_type')->result_array();
										foreach($room_types as $row):
										?>
                                    		<option value="<?php echo $row['room_type_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('number_of_bed');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="num_bed"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('cost_/_bed');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="cost_bed"/>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-success btn-sm btn-icon icon-left"><i class="entypo-home"></i><?php echo get_phrase('add_hostel_room');?></button>
                              </div>
							</div>
							<br>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->


<div class="col-md-7">

        <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_hostel_rooms'); ?>
					</div>
					</div>
<div class="table-responsive">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table " id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('room_name');?></div></th>
                    		<th><div><?php echo get_phrase('room_type');?></div></th>
                    		<th><div><?php echo get_phrase('number_of_bed');?></div></th>
                    		<th><div><?php echo get_phrase('cost_/_bed');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('actions');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($hostel_rooms as $row):?>
                        <tr>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('room_type',$row['room_type_id']);?></td>
							<td><?php echo $row['num_bed'];?></td>
							<td><?php echo $row['cost_bed'];?></td>
							<td><?php echo $row['description'];?></td>
							<td>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_hostel_room/<?php echo $row['hostel_room_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?hostel/hostel_room/delete/<?php echo $row['hostel_room_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_hostel_room_student/<?php echo $row['hostel_room_id'];?>');"><button type="button" class="btn btn-xs btn-orange"> <i class="entypo-users"></i></button></a>
							
                            
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->