 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_news'); ?>
					</div>
					</div>
<div class="table-responsive">
		
    	
                <table  class="table" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('news_title');?></div></th>
                    		<th><div><?php echo get_phrase('news_content');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($newss as $row):?>
                        <tr>
							<td><?php echo $row['news_title'];?></td>
							<td><?php echo $row['news_content'];?></td>
							<td><?php echo $row['date'];?></td>
							
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
				<?php if($row['news_title'] == ''):?>
							<div class="alert alert-danger" align="center">No Data to be Displayed</div>
							<?php endif;?>
				
			</div>
			</div>
          
			
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>