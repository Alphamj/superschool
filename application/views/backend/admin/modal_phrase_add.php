	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
      <?php echo get_phrase('add_string');?>
            	</div>
            </div>
			<div class="panel-body">
				
               <?php echo form_open(base_url() . 'index.php?admin/manage_language/add_phrase/' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('new_string');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="phrase" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-plus"></i><?php echo get_phrase('add_string');?></button>
                              </div>
							</div>
                    <?php echo form_close();?>       
            </div>
        </div>