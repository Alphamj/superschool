<?php 
	$edit_data	=	$this->db->get_where('expense_category' , array(
		'expense_category_id' => $param2
	))->result_array();
	foreach ($edit_data as $row):
?>

	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('edit_expense');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/expense_category/edit/' . $row['expense_category_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="<?php echo $row['name'];?>">
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-pencil"></i><?php echo get_phrase('update_category');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>
<script type="text/javascript">
	jQuery(document).ready(function ($){
         $('a[href^="</div"]').each(function(){ 
            var oldUrl = $(this).attr("href"); // Get current url
            var newUrl = "#"; // Create new url
            $(this).attr("href", newUrl); // Set herf value
        });
	});
</script>