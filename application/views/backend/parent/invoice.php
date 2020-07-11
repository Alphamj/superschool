<?php 
    $child_of_parent = $this->db->get_where('student' , array(
        'student_id' => $student_id
    ))->result_array();
    foreach ($child_of_parent as $row):
?>

               <div class="x_panel" >

                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_invoices'); ?>
					</div>
					</div>
				
                <table  class="table" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('title');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		<th><div><?php echo get_phrase('total amount');?></div></th>
                    		<th><div><?php echo get_phrase('paid amount');?></div></th>
                    		<th><div><?php echo get_phrase('due amount');?></div></th>
                    		<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<!--<th><div><?php echo get_phrase('options');?></div></th>-->
						</tr>
					</thead>
                    <tbody>
                    	<?php 
                            $invoices = $this->db->get_where('invoice' , array(
                                'student_id' => $row['student_id']
                            ))->result_array();
                            foreach($invoices as $row2):
                        ?>
                        <tr>
							<td><?php echo $this->crud_model->get_type_fullname_by_id('student',$row2['student_id']); ?></td>
							<td><?php echo $row2['title'];?></td>
							<td><?php echo $row2['description'];?></td>
							<td><?php echo $row2['amount'];?></td>
							<td><?php echo $row2['amount_paid'];?></td>
							<td><?php echo $row2['due'];?></td>
							<td>
								<span class="label label-<?php if($row2['status']=='paid')echo 'success';else echo 'warning';?>"><?php echo $row2['status'];?></span>
							</td>
							<td><?php echo date('d M,Y', $row2['creation_timestamp']);?></td>
							<!--<td>
                            <?php //echo form_open(base_url() . 'index.php?parents/invoice/' . $row['student_id'] . '/make_payment');?>
                                	<input type="hidden" name="invoice_id" value="<?php //echo $row2['invoice_id'];?>" />
                                	<button type="submit" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-paypal"></i> Paypal Payment</button>
                                </form>
                            </td>-->
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
				
				<?php if($row2['title'] == ''):?>
							<div class="alert alert-danger" align="center">No Data to be Displayed for <?php echo $row ['name']; ?> !</div>
							<?php endif;?>
				
				
			</div>
            <!----TABLE LISTING ENDS-->

<?php endforeach;?>
