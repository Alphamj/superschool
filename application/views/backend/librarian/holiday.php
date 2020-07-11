<div class="x_panel table-responsive" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_holidays'); ?>
					</div>
					</div>    
	
            <!----TABLE LISTING STARTS-->
                <table class="table" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('title');?></div></th>
                    		<th><div><?php echo get_phrase('holiday');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($holidays as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['holiday'];?></td>
							<td><?php echo $row['date'];?></td>
							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
				<?php if($row['title'] == ''):?>
							<div class="alert alert-danger" align="center">No Data to be Displayed !</div>
							<?php endif;?>
				
			</div>
            <!----TABLE LISTING ENDS-->
