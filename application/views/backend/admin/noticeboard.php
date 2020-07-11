<div class="col-md-12">
<div class="x_panel " >
 <div class="alert alert-success">
                                        <?php 
                                            if ($active_sms_service == 'clickatell')
                                                echo 'Clickatell ' . get_phrase('clickatell_activated');
                                            if ($active_sms_service == 'twilio')
                                                echo 'Twilio ' . get_phrase('twilio_activated');
												 if ($active_sms_service == 'smsteams')
                                                echo 'smsteams ' . get_phrase('smsteams_activated');
                                            if ($active_sms_service == '' || $active_sms_service == 'disabled')
                                                echo get_phrase('activate_sms_to_send');
                                        ?>
                                    </div>
</div>
</div>
<div class="col-md-5">
<div class="x_panel " >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_notice'); ?>
					</div>
					</div>			
			<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'index.php?admin/noticeboard/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="notice_title"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('notice');?></label>
                                <div class="col-sm-9">
                                    <div class="box closable-chat-box">
                                        <div class="box-content padded">
                                                <div class="chat-message-box">
                                                <textarea name="notice" id="ttt" rows="5" placeholder="<?php echo get_phrase('add_notice');?>" class="form-control"></textarea>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="datepicker form-control" name="create_timestamp"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('location');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="location"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('sms_to_all_users');?></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="check_sms">
                                        <option value="1"><?php echo get_phrase('yes');?></option>
                                        <option value="2"><?php echo get_phrase('no');?></option>
                                    </select>                                   
                                </div>
                            </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <button type="submit" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-pencil"></i><?php echo get_phrase('add_notice');?></button>
                            </div>
						</div>
						<br>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
<div class="col-md-7">
<div class="x_panel table-responsive" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_notice'); ?>
					</div>
					</div>

                <table cellpadding="0" cellspacing="0" border="0" class="table" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('title');?></div></th>
                    		<th><div><?php echo get_phrase('notice');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($notices as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['notice_title'];?></td>
							<td class="span5"><?php echo $row['notice'];?></td>
							<td><?php echo date('d M,Y', $row['create_timestamp']);?></td>
							<td>
							
<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_notice/<?php echo $row['notice_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/noticeboard/delete/<?php echo $row['notice_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>							
							
                            
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
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
            
