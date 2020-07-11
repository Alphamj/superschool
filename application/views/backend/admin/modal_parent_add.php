	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title">
					<?php echo get_phrase('add_parent');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/parent/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"  autofocus
                            	value="">
						</div>
					</div>
                    
					<div class="form-group">
						<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="email" 
                            	value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('password');?></label>
                        
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password" value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="phone" value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="address" value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('profession');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="profession" value="">
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-plus"></i><?php echo get_phrase('add_parent');?></button>
						</div>
					</div>
                <?php echo form_close();?>
    </div>
</div>