
<div class="col-md-5">

        <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_email_template'); ?>
					</div>
					</div>
<!----CREATION FORM STARTS---->
                	<?php echo form_open(base_url() . 'index.php?admin/email_template/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                         
						 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email_type');?></label>
                                <div class="col-sm-9">
                                    <select name="email_type" class="form-control" style="width:100%;">
									<option>Select Email Type</option>
									<option value="Content">Content</option>
									<option value="Header">Header</option>
									<option value="Footer">Footer</option>
                                       
                                    </select>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="subject"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('from_email');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="from_email"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('from_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="from_name"/>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email_content');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email_content"/>
                                </div>
                            </div>
					
					 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date_added'); ?></label>
                        <div class="col-sm-9">
                            <div class="date-and-time">
                                <input type="text" name="date" class="form-control datepicker" data-format="D, dd MM yyyy" placeholder="date here">
                            </div>
                        </div>
                    </div>
					
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-success btn-sm btn-icon icon-left"><i class="entypo-home"></i><?php echo get_phrase('add_email_template');?></button>
                              </div>
							</div>
							<br>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->


<div class="col-md-7">

        <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_email_templates'); ?>
					</div>
					</div>
<div class="table-responsive">
            <!--TABLE LISTING STARTS-->
                <table cellpadding="0" cellspacing="0" border="0" class="table " id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('email_type');?></div></th>
                    		<th><div><?php echo get_phrase('subject');?></div></th>
                    		<th><div><?php echo get_phrase('from_email');?></div></th>
                    		<th><div><?php echo get_phrase('from_name');?></div></th>
                    		<th><div><?php echo get_phrase('email_content');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('actions');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($email_templates as $row):?>
                        <tr>
							<td><?php echo $row['email_type'];?></td>
							<td><?php echo $row['subject'];?></td>
							<td><?php echo $row['from_email'];?></td>
							<td><?php echo $row['from_name'];?></td>
							<td><?php echo $row['email_content'];?></td>
							<td><?php echo $row['date'];?></td>
							<td>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_email_template/<?php echo $row['email_template_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/email_template/delete/<?php echo $row['email_template_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
														
                            
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->
 <!-- added on 26 may 2018-->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  <div class="x_panel" >   

<script type="text/javascript">
	 $( function() {
		
			$( ".datepicker" ).datepicker({
				dateFormat: 'yy-mm-dd',
				changeMonth: true,
				changeYear: true
				
				
			});
		} );
		
</script>
