	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('add_expense');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?accountant/expense_category/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
                    
                   <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm btn-icon icon-left"><i class="entypo-plus"></i><?php echo get_phrase('add_expense');?></button>
						</div>
					</div>
                <?php echo form_close();?>
    </div>
</div>