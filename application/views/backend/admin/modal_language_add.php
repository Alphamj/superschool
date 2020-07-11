	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
      <?php echo get_phrase('add_language');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/manage_language/add_language/' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('language');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="language" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-pencil"></i><?php echo get_phrase('add_language');?></button>
                              </div>
							</div>
                    <?php echo form_close();?> 
            </div>
        </div>