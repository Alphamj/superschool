 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('all_invoice'); ?>
					</div>
					</div>
<div class="table-responsive">
				
                <table  class="table" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('title');?></div></th>
                    		<th><div><?php echo get_phrase('session');?></div></th>
                    		<th><div><?php echo get_phrase('due amount');?></div></th>
                    		<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<!--<th><div><?php echo get_phrase('options');?></div></th>-->
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($invoices as $row):?>
                        <tr>
							<td><?php echo $this->crud_model->get_type_fullname_by_id('student',$row['student_id']);?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['session_year'];?></td>
							<td><?php echo $row['due'];?></td>
							<td>
								<span class="label label-<?php if($row['status']=='paid')echo 'success';else echo 'warning';?>"><?php echo $row['status'];?></span>
							</td>
							<td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
							<!--<td>
                            <?php //echo form_open('student/invoice/make_payment');?>
                                	<input type="hidden" name="invoice_id" 		value="<?php //echo $row['invoice_id'];?>" />
                                		<button type="submit" class="btn btn-info"><i class="entypo-paypal"></i> Pay with paypal</button>
                                </form>
                                
                            
        					</td>-->
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
				
				
				<?php if($row['title'] == ''):?>
							<div class="alert alert-danger" align="center">You Have no Pending Invoice</div>
							<?php endif;?>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			
      
</div>

