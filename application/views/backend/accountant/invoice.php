<div class="col-md-12">

        <div class="x_panel" >

            <div class="x_title">
                <div class="panel-title">
                    <?php echo get_phrase('payment_lists'); ?>
                </div>
            </div>
		
                <table  class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('student');?></div></th>
                    		<th><div><?php echo get_phrase('title');?></div></th>
                            <th><div><?php echo get_phrase('total');?></div></th>
                            <th><div><?php echo get_phrase('paid');?></div></th>
                    		<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($invoices as $row):?>
                        <tr>
							<td><?php echo $this->crud_model->get_type_fullname_by_id('student',$row['student_id']);?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['amount'];?></td>
                            <td><?php echo $row['amount_paid'];?></td>
							<td>
								<span class="label label-<?php if($row['status']=='paid')echo 'success';else echo 'danger';?>"><?php echo $row['status'];?></span>
							</td>
							<td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>
							<td>
							
							 <?php if ($row['due'] != 0):?>
							 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_take_payment/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn  btn-blue btn-xs"><i class="entypo-bookmarks"></i></button></a>
							<?php endif;?>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn  btn-orange btn-xs"><i class="entypo-credit-card"></i></button></a>
							 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_invoice/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn  btn-success btn-xs"><i class="entypo-pencil"></i></button></a>
							  <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?accountant/invoice/delete/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn  btn-danger btn-xs"><i class="entypo-trash"></i></button></a>

        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->
            
<div class="col-md-12">

        <div class="x_panel" >

            <div class="x_title">
                <div class="panel-title">
                    <?php echo get_phrase('payment_lists'); ?>
                </div>
            </div>
            <?php echo form_open(base_url() . 'index.php?accountant/invoice/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
              
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('student');?></label>
                                    <div class="col-sm-10">
                                        <select name="student_id" class="form-control" style="" >
                                            <?php 
                                            $this->db->order_by('class_id','asc');
                                            $students = $this->db->get('student')->result_array();
                                            foreach($students as $row):
                                            ?>
                                                <option value="<?php echo $row['student_id'];?>">
                                                    class <?php echo $this->crud_model->get_class_name($row['class_id']);?> -
                                                    roll <?php echo $row['roll'];?> -
                                                    <?php echo $row['name'].' '.$row['surname'];?>
                                                </option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('title');?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="title"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('description');?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="description"/>
                                    </div>
                                </div>
								
								 <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('total');?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="amount"
                                            placeholder="<?php echo get_phrase('enter_total_amount');?>"/>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('payment');?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="amount_paid"
                                            placeholder="<?php echo get_phrase('enter_payment_amount');?>"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('date');?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="datepicker form-control" name="date"/>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('status');?></label>
                                    <div class="col-sm-10">
                                        <select name="status" class="form-control">
                                            <option value="paid"><?php echo get_phrase('paid');?></option>
                                            <option value="unpaid"><?php echo get_phrase('unpaid');?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('method');?></label>
                                    <div class="col-sm-10">
                                        <select name="method" class="form-control">
                                            <option value="1"><?php echo get_phrase('cash');?></option>
                                            <option value="2"><?php echo get_phrase('check');?></option>
                                            <option value="3"><?php echo get_phrase('card');?></option>
                                        </select>
                                    </div>
                                </div>

                        <div class="form-group">
                           <div class="col-sm-5 col-sm-offset-2">
                                <button type="submit" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-book"></i><?php echo get_phrase('add_invoice');?></button>
                            </div>
                        </div>
<br>
            <?php echo form_close();?>

			<!----CREATION FORM ENDS-->
            
		</div>
	</div>

