<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_transportation'); ?>
					</div>
					</div>
<div class="table-responsive">

                <table class="table" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('transport_name');?></div></th>
                    		<th><div><?php echo get_phrase('route_name');?></div></th>
                    		<th><div><?php echo get_phrase('vehicle_name');?></div></th>
                    		<th><div><?php echo get_phrase('number_of_vehicle');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('route_fare');?></div></th>
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
							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS-->
            

</div>