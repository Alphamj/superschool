
<!-- added on 26 may 2018-->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
                            <th><div><?php echo get_phrase('term');?></div></th>
                            <th><div><?php echo get_phrase('session');?></div></th>
                    		<th><div><?php echo get_phrase('status');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                        <?php foreach($invoices as $row):
                            $exam_id = $this->db->get_where('exam',array('exam_id' => $row['exam_id']))->result_array();
                        ?>
                        <tr>
							<td><?php echo $this->crud_model->get_type_fullname_by_id('student',$row['student_id']);?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $exam_id[0]['name'];?></td>
                            <td><?php echo $row['session_year'];?></td>
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
							  <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/invoice/delete/<?php echo $row['invoice_id'];?>');"><button type="button" class="btn  btn-danger btn-xs"><i class="entypo-trash"></i></button></a>

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
            <?php echo form_open(base_url() . 'index.php?admin/invoice/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
              
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('student');?></label>
                                    <div class="col-sm-10">
                                        <select name="student_id" class="form-control">
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
                                        <input type="text" value="School Fees" class="form-control" name="title" readonly="true"/>
                                    </div>
                                </div>

                                <?php $get_system_settings	=	$this->crud_model->get_system_settings();?>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('session');?></label>
                                    <div class="col-sm-10">
                                        <select name="session_year" id="session_year" class="form-control" onchange="show_students_session(this.value)">
                                            <?php 
                                            $sessions = $this->db->get('session')->result_array();
                                            foreach($sessions as $row):
                                            ?>
                                                <option value="<?php echo $row['name'];?>"
                                                    <?php if($sessoin_id){if (trim($sessoin_id) == trim($row['name'])){ echo 'selected'; }}else {if($row['name'] ==$get_system_settings[17]['description']){ echo 'selected'; } } ?>>
                                                         <?php echo $row['name'];?>
                                                </option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
								
								 <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('Term');?></label>
                                    <div class="col-sm-10">
                                        <select name="exam_id" class="form-control"  style="float:left;" required>
                                            <option value=""><?php echo get_phrase('select_term');?></option>
                                            <?php 
                                            $exams = $this->db->get('exam')->result_array();
                                            foreach($exams as $row):
                                            ?>
                                                <option value="<?php echo $row['exam_id'];?>"
                                                    <?php if($exam_id == $row['exam_id'])echo 'selected';?>>
                                                       <?php echo $row['name'];?></option>
                                            <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
								
								<!-- <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php //echo get_phrase('payment');?></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="amount_paid"
                                            placeholder="<?php //echo get_phrase('enter_payment_amount');?>"/>
                                    </div>
                                </div> -->

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
                                            <option value="unpaid"><?php echo get_phrase('unpaid');?></option>
                                            <option value="part_payment"><?php echo get_phrase('part_payment');?></option>
                                            <option value="paid"><?php echo get_phrase('paid');?></option>
                                        </select>
                                    </div>
                                </div>

                                <!--<div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo get_phrase('method');?></label>
                                    <div class="col-sm-10">
                                        <select name="method" class="form-control">
                                            <option value="1"><?php //echo get_phrase('bank_payment');?></option>
                                            <option value="2"><?php //echo get_phrase('bank_transfer');?></option>
                                            <option value="3"><?php //echo get_phrase('card');?></option>
                                        </select>
                                    </div>
                                </div>-->

                        <div class="form-group">
                           <div class="col-sm-5 col-sm-offset-2">
                                <button type="submit" class="btn btn-blue"><i class="entypo-book"></i><?php echo get_phrase('add_invoice');?></button>
                            </div>
                        </div>
<br>
            <?php echo form_close();?>

			<!----CREATION FORM ENDS-->
            
		</div>
    </div>
    
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

