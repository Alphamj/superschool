<div class="col-md-5">
<div class="x_panel" >
 					<div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_transportation'); ?>
					</div>
					</div>
<!--CREATION FORM STARTS-->

                	<?php echo form_open(base_url() . 'index.php?admin/transport/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('transport_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name"/ required>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('transport_route');?></label>
                                <div class="col-sm-6">
                                    <select name="transport_route_id" class="form-control" style="width:100%;" required>
									<option>Select Transport Route</option>
                                    	<?php 
										$classes = $this->db->get('transport_route')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['transport_route_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
<a href="<?php echo base_url();?>index.php?admin/transport_route/"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>

                            </div>
							
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('vehicle');?></label>
                                <div class="col-sm-6">
                                    <select name="vehicle_id" class="form-control" style="width:100%;" required>
									<option>Select Vehicle</option>
                                    	<?php 
										$classes = $this->db->get('vehicle')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['vehicle_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
<a href="<?php echo base_url();?>index.php?admin/vehicle/"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>

                            </div>
							
							
							
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('number_of_vehicle');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="number_of_vehicle"/ required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('route_fare');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="route_fare"/>
                                </div>
                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-flight"></i><?php echo get_phrase('add_transport');?></button>
                              </div>
							</div>
							<br>
                    </form>                
                </div>                
			</div>
			<!--CREATION FORM ENDS-->


<div class="col-md-7">
<div class="x_panel table-responsive" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_transportation'); ?>
					</div>
					</div>

                <table class="table " id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('transport_name');?></div></th>
                    		<th><div><?php echo get_phrase('route_name');?></div></th>
                    		<th><div><?php echo get_phrase('vehicle');?></div></th>
                    		<th><div><?php echo get_phrase('number_of_vehicle');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('route_fare');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($transports as $row):?>
                        <tr>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('transport_route',$row['transport_route_id']);?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('vehicle',$row['vehicle_id']);?></td>
							<td><?php echo $row['number_of_vehicle'];?></td>
							<td><?php echo $row['description'];?></td>
							<td><?php echo $row['route_fare'];?></td>
							<td>
							
							 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_transport_student/<?php echo $row['transport_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-users"></i></button></a>
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/transport/delete/<?php echo $row['transport_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>

        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
            <!--TABLE LISTING ENDS-->
