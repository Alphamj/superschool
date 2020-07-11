<div class="x_panel" >
            
                    <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('unpaid_invoice'); ?>
					</div>
					</div>
	<div class="table-responsive">		
<table class="table" id="table-2">
                	<thead>
                		<tr>
                			<th>#</th>
                    		<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('title');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                            <th><div><?php echo get_phrase('total');?></div></th>
                            <th><div><?php echo get_phrase('paid');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('payment_status');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
                    		$count = 1;
                    		$this->db->where('status' , 'unpaid');
                    		$this->db->order_by('creation_timestamp' , 'desc');
                    		$invoices = $this->db->get('invoice')->result_array();
                    		foreach($invoices as $row):
                    	?>
                        <tr>
                        	<td><?php echo $count++;?></td>
							<td><?php echo $this->crud_model->get_type_fullname_by_id('student',$row['student_id']);?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['description'];?></td>
							<td><?php echo $row['amount'];?></td>
                            <td><?php echo $row['amount_paid'];?></td>
							<td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
							<td>
<span class="label label-<?php if($row['status']=='paid')echo 'success'; elseif ($row['status']=='unpaid') echo 'danger'; else echo 'warning';?>"><?php echo $row['status'];?></span>
							</td>

							<td>
							 <?php if ($row['due'] != 0):?>
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_take_payment/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-bookmarks"></i></button></a>
							 <?php endif;?>
							 
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-orange btn-xs"><i class="entypo-credit-card"></i></button></a>
							 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?accountant/invoice/delete/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn  btn-red btn-xs"><i class="entypo-trash"></i></button></a>
							
                           
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
					
				</div>
				</div>
				
<br>
<div class="x_panel" >
 <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('payment_history'); ?>
					</div>
					</div>
						<div class="table-responsive">		

<table class="table" id="table-1">
					    <thead>
					        <tr>
							  <th><div>#</div></th>
							  <th><div><?php echo get_phrase('student');?></div></th>
					            <th><div><?php echo get_phrase('title');?></div></th>
					            <th><div><?php echo get_phrase('description');?></div></th>
					            <th><div><?php echo get_phrase('method');?></div></th>
					            <th><div><?php echo get_phrase('amount');?></div></th>
					            <th><div><?php echo get_phrase('date');?></div></th>
					            <th><div><?php echo get_phrase('actions');?></div></th>
					        </tr>
					    </thead>
					    <tbody>
					        <?php 
					        	$count = 1;
					        	$this->db->where('payment_type' , 'income');
					        	$this->db->order_by('timestamp' , 'desc');
					        	$payments = $this->db->get('payment')->result_array();
					        	foreach ($payments as $row):
					        ?>
					        <tr>
							  <td><?php echo $count++;?></td>
							  <td><?php echo $this->crud_model->get_type_fullname_by_id('student',$row['student_id']);?></td>
					            <td><?php echo $row['title'];?></td>
					            <td><?php echo $row['description'];?></td>
					            <td>
					            	<?php 
					            		if ($row['method'] == 1)
					            			echo get_phrase('cash');
					            		if ($row['method'] == 2)
					            			echo get_phrase('check');
					            		if ($row['method'] == 3)
					            			echo get_phrase('card');
					                    if ($row['method'] == 'paypal')
					                    	echo 'paypal';
					            	?>
					            </td>
					            <td><?php echo $row['amount'];?></td>
					            <td><?php echo date('d M,Y', $row['timestamp']);?></td>
					            <td >
			<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');"> <button type="button" class="btn btn-orange btn-xs"><i class="entypo-print"></i></button></a>	            	
					            </td>
					        </tr>
					        <?php endforeach;?>
					    </tbody>
					</table>
						
			
</div>
</div>

<script type="text/javascript">
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


<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-1").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-1 tbody input[type=checkbox]").each(function (i, el)
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
