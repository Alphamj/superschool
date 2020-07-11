<div class="col-md-5">
        <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_hostel'); ?>
					</div>
					</div>
<!----CREATION FORM STARTS---->
                	<?php echo form_open(base_url() . 'index.php?admin/dormitory/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('dormitory_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name"/>
                                </div>
                            </div>
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('hostel_category');?></label>
                                <div class="col-sm-9">
                                    <select name="hostel_category_id" class="form-control" style="width:100%;">
									<option>Select hostel category</option>
                                    	<?php 
										$hostel_categorys = $this->db->get('hostel_category')->result_array();
										foreach($hostel_categorys as $row):
										?>
                                    		<option value="<?php echo $row['hostel_category_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('hostel_room');?></label>
                                <div class="col-sm-9">
                                    <select name="hostel_room_id" class="form-control" style="width:100%;">
									<option>Select hostel category</option>
                                    	<?php 
										$hostel_rooms = $this->db->get('hostel_room')->result_array();
										foreach($hostel_rooms as $row):
										?>
                                    		<option value="<?php echo $row['hostel_room_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
                            </div>
                            
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('capacity');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="capacity"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="address"/>
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
                                  <button type="submit" class="btn btn-success btn-sm btn-icon icon-left"><i class="entypo-home"></i><?php echo get_phrase('add_dormitory');?></button>
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
					 <?php echo get_phrase('list_hostels'); ?>
					</div>
					</div>
<div class="table-responsive">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="table " id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('hostel_name');?></div></th>
                    		<th><div><?php echo get_phrase('hostel_room');?></div></th>
                    		<th><div><?php echo get_phrase('category');?></div></th>
                    		<th><div><?php echo get_phrase('capacity');?></div></th>
                    		<th><div><?php echo get_phrase('address');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($dormitories as $row):?>
                        <tr>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('hostel_room',$row['hostel_room_id']);?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('hostel_category',$row['hostel_category_id']);?></td>
							<td><?php echo $row['capacity'];?></td>
							<td><?php echo $row['address'];?></td>
							<td><?php echo $row['description'];?></td>
							<td>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_dormitory/<?php echo $row['dormitory_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/dormitory/delete/<?php echo $row['dormitory_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
							
							
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_dormitory_student/<?php echo $row['dormitory_id'];?>');"><button type="button" class="btn btn-xs btn-orange"> <i class="entypo-users"></i></button></a>
							
                            
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