<!-- added on 26 may 2018-->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  <div class="x_panel" >   

<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					
					 <?php echo form_open(base_url() . 'index.php?accountant/expense');?>

					 <?php echo get_phrase('list_expenses'); ?>
					</div>
					</div>
					                       
                        <div class="form-group">
                        <div class="col-sm-12">
                            <select name="expence_category_id" class="form-control" onchange='this.form.submit()' required>
                              <option value=""><?php echo get_phrase('select_expence_category');?></option>
                              		<?php 
									$expense_category = $this->db->get('expense_category')->result_array();
									foreach($expense_category as $row):
										?>
                                		<option value="<?php echo $row['expense_category_id'];?>" <?php if ($expence_category_id != ''){ if ($expence_category_id ==$row['expense_category_id']){ echo "selected";}} ?>>
												<?php echo $row['name'];?>
                                                </option>
                                    <?php
									endforeach;
								?>
                          </select>
                        </div>
                    </div> 

				<input type="hidden" name="operation" value="selection">

<noscript><button type="submit" class="btn btn-green btn-icon icon-left"><i class="entypo-search"></i><?php echo get_phrase('get_cat_list');?></button></noscript>

		<?php echo form_close();?>
					</div>
					</div>
<div class="table-responsive">
&nbsp;&nbsp;&nbsp;&nbsp;
<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_add/');" 
 class="btn btn-xs btn-orange">
        <i class="entypo-plus"></i>
<?php echo get_phrase('add_new_expense');?>
</a> 
<br>
<table class="table" id="table_export">
    <thead>
        <tr>
            <th><div>#</div></th>
            <th><div><?php echo get_phrase('title');?></div></th>
            <th><div><?php echo get_phrase('category');?></div></th>
            <th><div><?php echo get_phrase('method');?></div></th>
            <th><div><?php echo get_phrase('amount');?></div></th>
            <th><div><?php echo get_phrase('date');?></div></th>
            <th><div><?php echo get_phrase('options');?></div></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        	$count = 1;
        	if($expence_category_id !=''){
				
				$this->db->where('expense_category_id' ,$expence_category_id);
				$this->db->where('payment_type' , 'expense');
				$this->db->order_by('timestamp' , 'desc');
				$expenses = $this->db->get('payment')->result_array();
			}else{
				
				$this->db->where('payment_type' , 'expense');
				$this->db->order_by('timestamp' , 'desc');
				$expenses = $this->db->get('payment')->result_array();
			}
			
        	foreach ($expenses as $row):
        ?>
        <tr>
            <td><?php echo $count++;?></td>
            <td><?php echo $row['title'];?></td>
            <td>
                <?php 
                    if ($row['expense_category_id'] != 0 || $row['expense_category_id'] != '')
                        echo $this->db->get_where('expense_category' , array('expense_category_id' => $row['expense_category_id']))->row()->name;
                ?>
            </td>
            <td>
            	<?php 
            		if ($row['method'] == 1)
            			echo get_phrase('cash');
            		if ($row['method'] == 2)
            			echo get_phrase('check');
            		if ($row['method'] == 3)
            			echo get_phrase('card');
            	?>
            </td>
            <td><?php echo $row['amount'];?></td>
            <td><?php echo date('d M,Y', $row['timestamp']);?></td>
            <td>
			
			<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/expense_edit/<?php echo $row['payment_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
				
                   
					<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?accountant/expense/delete/<?php echo $row['payment_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
					 
                
               
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

</div>
</div>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [1,2,3,4,5]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2,3,4,5]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(6, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(0, true);
									  datatable.fnSetColumnVis(6, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>

