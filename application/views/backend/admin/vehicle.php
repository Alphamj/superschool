<div class="col-md-5">
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_vehicle'); ?>
					</div>
					</div>
					   
			<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'index.php?admin/vehicle/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                           
						    
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('vehicle_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('vehicle_number');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="vehicle_no"/>
                                </div>
                            </div>

							
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('vehicle_model');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="vehicle_model"/>
                                </div>
                            </div>
							
								 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('year_made'); ?></label>
                        <div class="col-sm-9">
                            <div class="date-and-time">
                                <input type="text" name="year_made" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('driver_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="driver_name"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('driver_license');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="driver_license"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('driver_contact');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="driver_contact"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control" style="width:100%;">
                                    	<option value="available"><?php echo get_phrase('available');?></option>
                                    	<option value="unavailable"><?php echo get_phrase('unavailable');?></option>
                                    </select>
                                </div>
                            </div>
							
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="description"/>
                                </div>
                            </div>
                            
                            
							
							
					<div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('vehicle_image'); ?></label>

                    <div class="col-sm-9">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                            <div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
                                <img src="http://placehold.it/200x200" alt="...">
                            </div>
                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                            <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileinput-new">Select image</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" name="userfile" accept="image/*">
                                </span>
                                <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>

							
							
                        		<div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-success btn=sm btn-icon icon-left"><i class="entypo-flight"></i><?php echo get_phrase('add_vehicle');?></button>
                              </div>
								</div>
								<br>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS--->
					
					
<div class="col-md-7">
<div class="x_panel table-responsive">
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_vehicles'); ?>
					</div>
					</div>

					<table class="table" id="table-2">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('vehicle_name');?></div></th>
                    		<th><div><?php echo get_phrase('vehicle_number');?></div></th>
                    		<th><div><?php echo get_phrase('vehicle_model');?></div></th>
                    		<th><div><?php echo get_phrase('year_made');?></div></th>
                    		<th><div><?php echo get_phrase('driver_name');?></div></th>
                    		<th><div><?php echo get_phrase('driver_license');?></div></th>
                    		<th><div><?php echo get_phrase('driver_contact');?></div></th>
                    		<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($vehicles as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['vehicle_no'];?></td>
							<td><?php echo $row['vehicle_model'];?></td>
							<td><?php echo $row['year_made'];?></td>
							<td><?php echo $row['driver_name'];?></td>
							<td><?php echo $row['driver_license'];?></td>
							<td><?php echo $row['driver_contact'];?></td>
							<td><span class="label label-<?php if($row['status']=='available')echo 'success';else echo 'warning';?>"><?php echo $row['status'];?></span></td>
							<td><?php echo $row['description'];?></td>
							<td>
							
							 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_vehicle/<?php echo $row['vehicle_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
				
                   
					 <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/vehicle/delete/<?php echo $row['vehicle_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
							
							
                           
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->


<!-- added on 26 may 2018-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>                  
<script type="text/javascript">
	 $( function() {
		
			$( ".datepicker" ).datepicker({
				dateFormat: 'yy-mm-dd',
				changeMonth: true,
				changeYear: true
				
				
			});
		} );
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>
