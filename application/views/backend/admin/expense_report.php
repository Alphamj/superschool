<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
		<?php echo form_open(base_url() . 'index.php?admin/expense_report');?>

					 <?php echo get_phrase('expenses_information_page'); ?>
					</div>
					</div>
					
<div class="table-responsive">
                       
                        <div class="col-sm-3">
						
                            <input name="from" type="text" class="datepicker form-control" value ="<?php if ($from != ''){ echo $from;}?>" placeholder= 'Date From'>
                    </div>
					
                        
                        <div class="col-sm-3">
                            <input name="to" type="text" class="datepicker form-control"  value ="<?php if ($to != ''){ echo $to;}?>" placeholder= 'Date To'>
                    </div>
				<input type="hidden" name="operation" value="selection">

<button type="submit" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-chart-bar"></i><?php echo get_phrase('view_report');?></button>
<a href="<?php echo base_url(); ?>index.php?admin/manage_report"><button type="button" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-left"></i><?php echo get_phrase('back');?></button></a>

		<?php echo form_close();?>
</div>
</div>


<br>
 <div class="x_panel" >

	<div class="col-md-12">
<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('title');?></div></th>
            <th><div><?php echo get_phrase('amount');?></div></th>
            <th><div><?php echo get_phrase('date');?></div></th>
        </tr>
    </thead>
    <tbody>
	<?php
	if ($from != '' && $to != ''){
		$this->db->where('timestamp >=', strtotime($from));
		$this->db->where('timestamp <=', strtotime($to));
	}
	$query = $this->db->get('payment')->result_array();
	 foreach($query as $row):
	?>
        <tr>
		
            <td><?php echo $row['title'];?></td>
            <td><?php echo $row['amount'];?></td>
            <td><?php echo date('d M,Y', $row['timestamp']);?></td>
           
        </tr>
		<?php endforeach;?>
    </tbody>
</table>

</div>
</div>





<!-----  DATA TABLE EXPORT CONFIGURATIONS ----> 
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

