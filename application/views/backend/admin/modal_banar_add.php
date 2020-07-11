	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('add_banar');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/banar/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('banner_text_1');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="b_text_one" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
				
				
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('banner_text_2');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="b_text_two" value="" >
						</div> 
					</div>
                    
					
				
					 <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('image'); ?></label>
                        <div class="col-sm-10">
                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary btn-sm" data-label="<i class='glyphicon glyphicon-file'></i> Browse Image" />
						<br><br>
						<div  style="color:#FF0000">920 X 783</div>
					   </div>
					   
                    <br><br><br>
                   <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-orange btn-sm"><i class="entypo-plus"></i><?php echo get_phrase('save_bannar');?></button>
						</div>
					</div>
                <?php echo form_close();?>
    </div>
</div>