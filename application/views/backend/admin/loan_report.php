<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
		<?php echo form_open(base_url() . 'index.php?admin/loan_report');?>

					 <?php echo get_phrase('loan_information_page'); ?>
					</div>
					</div>
					
<div class="table-responsive">
                       
                        <div class="col-sm-3">
                         <input name="from" type="text" class="datepicker form-control"  value ="<?php if ($from != ''){ echo $from;}?>"  placeholder= 'Date From'>
                    </div>
					
                        
                        <div class="col-sm-3">
                            <input name="to"type="text" class="datepicker form-control"  value ="<?php if ($to != ''){ echo $to;}?>" placeholder= 'Date To'>
                    </div>
									<input type="hidden" name="operation" value="selection">


<div class="col-md-3">
<button type="submit" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-chart-bar"></i><?php echo get_phrase('view_report');?></button>
<a href="<?php echo base_url(); ?>index.php?admin/manage_report"><button type="button" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-left"></i><?php echo get_phrase('back');?></button></a>
</div>
<?php echo form_close();?>

</div>
</div>


<br>
 <div class="x_panel" >

	<div class="col-md-12">

<table class="table table-bordered datatable" id="table_export">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('staff_name');?></th>
            <th><?php echo get_phrase('amount');?></th>

            <th><?php echo get_phrase('purpose');?></th>
            <th><?php echo get_phrase('loan_duration');?></th>
            <th><?php echo get_phrase('mode_of_payment');?></th>
			
			<th><?php echo get_phrase('guarantor_name');?></th>
            <th><?php echo get_phrase('number');?></th>
            <th><?php echo get_phrase('collateral_name');?></th>
            <th><?php echo get_phrase('colateral_value');?></th>
        </tr>
    </thead>

    <tbody>
       <?php
		if ($from != '' && $to != ''){
			$this->db->where('date >=', strtotime($from));
			$this->db->where('date <=', strtotime($to));
		}
		$query = $this->db->get('loan')->result_array();
	 foreach($query as $row):
	?>
            <tr>
                <td><?php echo $row['loan_id']?></td>
                <td><?php echo $row['date']; ?></td>

                <td><?php echo $row['staff_name']?></td>

                <td><?php echo $row['amount']?></td>
				
				 <td><?php echo $row['purpose']?></td>
                <td><?php echo $row['l_duration']; ?></td>
                <td><?php echo $row['mop']?></td>
                <td><?php echo $row['g_name']?></td>
				
				 <td><?php echo $row['g_number']?></td>
                <td><?php echo $row['c_name']; ?></td>
                <td><?php echo $row['value']?></td> 

                
            </tr>
               <?php endforeach;?>
    </tbody>
</table>
</div>
</div>

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

