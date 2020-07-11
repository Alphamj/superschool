 <div class="x_panel" >              
<div class="table-responsive">
  			
			<?php echo form_open(base_url() . 'index.php?admin/payment_report');?>
			                       
                     <div class="col-sm-4">
                    <input name="from" type="text" class="datepicker form-control"  value ="<?php if ($from != ''){ echo $from;}?>" placeholder= 'Date From'>
                    </div>
					
                        
                    <div class="col-sm-4">
                    <input name="to"type="text" class="datepicker form-control" value ="<?php if ($to != ''){ echo $to;}?>" placeholder= 'Date To'>
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
		
										
<table class="table table-bordered table-striped datatable" id="table-2">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('title');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                            <th><div><?php echo get_phrase('total');?></div></th>
                            <th><div><?php echo get_phrase('paid');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('payment_status');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
                    	if ($from != '' && $to != ''){
							$this->db->where('creation_timestamp >=', strtotime($from));
							$this->db->where('creation_timestamp <=', strtotime($to));
						}
						$query = $this->db->get('invoice')->result_array();
	 					foreach($query as $row):
	?>
                        <tr>
							<td><?php echo $this->crud_model->get_type_name_by_id('student',$row['student_id']);?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['description'];?></td>
							<td><?php echo $row['amount'];?></td>
                            <td><?php echo $row['amount_paid'];?></td>
							<td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
							<td>
<span class="label label-<?php if($row['status']=='paid')echo 'success'; elseif ($row['status']=='unpaid') echo 'danger'; else echo 'warning';?>"><?php echo $row['status'];?></span>
							</td>
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
