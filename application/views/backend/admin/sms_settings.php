<div class="col-md-12">
<div class="x_panel" >

            <div class="x_title">
                <div class="panel-title">
                    <?php echo get_phrase('sms_service_settings'); ?>
                </div>
            </div>
			<?php echo form_open(base_url() . 'index.php?admin/sms_settings/active_service' , 
						array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

					<div class="form-group">
						<label class="col-sm-1 control-label"><?php echo get_phrase('select_gateway');?></label>
                        <div class="col-sm-11">
							<select name="active_sms_service" class="form-control select2">
                              <option value=""<?php if ($active_sms_service == '') echo 'selected';?>>
                              		<?php echo get_phrase('choose_gateway');?>
                              	</option>
                        		<option value="clickatell"
                        			<?php if ($active_sms_service == 'clickatell') echo 'selected';?>>
                        				Clickatell
                        		</option>
								<option value="smsteams"
                        			<?php if ($active_sms_service == 'smsteams') echo 'selected';?>>
                        				SMS Teams
                        		</option>
                        		<option value="twilio"
                        			<?php if ($active_sms_service == 'twilio') echo 'selected';?>>
                        				Twilio
                        		</option>
                        		<option value="disabled"<?php if ($active_sms_service == 'disabled') echo 'selected';?>>
                        			<?php echo get_phrase('disabled');?>
                        		</option>
                          </select>
						</div> 
					</div>
					<div class="form-group">
	                    <div class="col-sm-offset-1 col-sm-7">
                         <button type="submit" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-pencil"></i><?php echo get_phrase('save_infomation');?></button>
	                    </div>
	                </div>
					<br>
	            <?php echo form_close();?>
				
</div>
</div>


<?php 
	$active_sms_service = $this->db->get_where('settings' , array(
		'type' => 'active_sms_service'
	))->row()->description;
?>
<div class="col-md-4">
<div class="x_panel" >

            <div class="x_title">
                <div class="panel-title">
                    <?php echo get_phrase('clickatell_settings'); ?>
						<?php if ($active_sms_service == 'clickatell'):?>  
							<span class="label label-success" style="color:#FFFFFF"><?php echo get_phrase('active');?></span>
						<?php endif;?>
                </div>
            </div>
			<?php echo form_open(base_url() . 'index.php?admin/sms_settings/clickatell' , 
						array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						<div class="form-group">
	                      <label  class="col-sm-3 control-label"><?php echo get_phrase('clickatell_username');?></label>
	                      	<div class="col-sm-9">
	                          	<input type="text" class="form-control" name="clickatell_user" 
	                            	value="<?php echo $this->db->get_where('settings' , array('type' =>'clickatell_user'))->row()->description;?>">
	                      	</div>
	                  	</div>
	                  	<div class="form-group">
	                        <label  class="col-sm-3 control-label"><?php echo get_phrase('clickatell_password');?></label>
	                        <div class="col-sm-9">
	                            <input type="text" class="form-control" name="clickatell_password" 
	                                value="<?php echo $this->db->get_where('settings' , array('type' =>'clickatell_password'))->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                      <label  class="col-sm-3 control-label"><?php echo get_phrase('clickatell_api_id');?></label>
	                        <div class="col-sm-9">
	                            <input type="text" class="form-control" name="clickatell_api_id" 
	                                value="<?php echo $this->db->get_where('settings' , array('type' =>'clickatell_api_id'))->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
		                    <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-plus"></i><?php echo get_phrase('add_data');?></button>
		                    </div>
		                </div>
						<br>
	                <?php echo form_close();?>
					
		<img src="uploads/sponsor_clickatell.png" width="300" height="100">
		<a href="https://www.clickatell.com/" target="_blank"><strong style="color:#000099">https://www.clickatell.com</strong></a>
		

</div>
</div>



<div class="col-md-4">
<div class="x_panel" >

            <div class="x_title">
                <div class="panel-title">
                    <?php echo get_phrase('twillio_settings'); ?>
						<?php if ($active_sms_service == 'twilio'):?>  
							<span class="label label-success" style="color:#FFFFFF"><?php echo get_phrase('active');?></span>
						<?php endif;?>
				
                </div>
            </div>
			<?php echo form_open(base_url() . 'index.php?admin/sms_settings/twilio' , 
						array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						<div class="form-group">
	                      <label  class="col-sm-4 control-label"><?php echo get_phrase('twilio_account');?> SID</label>
	                      	<div class="col-sm-8">
	                          	<input type="text" class="form-control" name="twilio_account_sid" 
	                            	value="<?php echo $this->db->get_where('settings' , array('type' =>'twilio_account_sid'))->row()->description;?>">
	                      	</div>
	                  	</div>
	                  	<div class="form-group">
	                        <label  class="col-sm-4 control-label"><?php echo get_phrase('authentication_token');?></label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" name="twilio_auth_token" 
	                                value="<?php echo $this->db->get_where('settings' , array('type' =>'twilio_auth_token'))->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                      <label  class="col-sm-4 control-label"><?php echo get_phrase('registered_number');?></label>
	                        <div class="col-sm-8">
	                            <input type="text" class="form-control" name="twilio_sender_phone_number" 
	                                value="<?php echo $this->db->get_where('settings' , array('type' =>'twilio_sender_phone_number'))->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
		                    <div class="col-sm-offset-4 col-sm-4">
                                  <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-plus"></i><?php echo get_phrase('add_data');?></button>
		                    </div>
		                </div>
						<br>
	                <?php echo form_close();?>
							<img src="uploads/twilio-logo.png" width="300" height="100">
				<a href="https://www.twilio.com/" target="_blank"><strong style="color: #FF0000">https://www.twilio.com/</strong></a>

</div>
</div>



<div class="col-md-4">
<div class="x_panel" >

            <div class="x_title">
                <div class="panel-title">
                    <?php echo get_phrase('smsteams_settings'); ?>
						<?php if ($active_sms_service == 'smsteams'):?>  
							<span class="label label-success" style="color:#FFFFFF"><?php echo get_phrase('active');?></span>
						<?php endif;?>
                </div>
            </div>
			<?php echo form_open(base_url() . 'index.php?admin/sms_settings/smsteams' , 
						array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
						<div class="form-group">
	                      <label  class="col-sm-3 control-label"><?php echo get_phrase('smsteams_username');?></label>
	                      	<div class="col-sm-9">
	                          	<input type="text" class="form-control" name="smsteams_username" 
	                            	value="<?php echo $this->db->get_where('settings' , array('type' =>'smsteams_user'))->row()->description;?>">
	                      	</div>
	                  	</div>
	                  	<div class="form-group">
	                        <label  class="col-sm-3 control-label"><?php echo get_phrase('smsteams_password');?></label>
	                        <div class="col-sm-9">
	                            <input type="text" class="form-control" name="smsteams_password" 
	                                value="<?php echo $this->db->get_where('settings' , array('type' =>'smsteams_password'))->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
	                      <label  class="col-sm-3 control-label"><?php echo get_phrase('smsteams_api_id');?></label>
	                        <div class="col-sm-9">
	                            <input type="text" class="form-control" name="smsteams_api_id" 
	                                value="<?php echo $this->db->get_where('settings' , array('type' =>'smsteams_api_id'))->row()->description;?>">
	                        </div>
	                    </div>
	                    <div class="form-group">
		                    <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-plus"></i><?php echo get_phrase('add_data');?></button>
		                    </div>
		                </div>
						<br>
	                <?php echo form_close();?>
					
						<img src="uploads/BulkSMS1.png" width="300" height="100">
				<a href="https://www.smsteams.com/" target="_blank"><strong style="color: #006600">https://www.smsteams.com/</strong></a>
</div>
</div>
