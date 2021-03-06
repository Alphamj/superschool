	<div class="col-md-12">
        	<div class="x_title">
            	<div class="panel-title" >
					<?php echo get_phrase('add_expense');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/expense/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-2 control-label"><?php echo get_phrase('title');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>

					<div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('category');?></label>
                        <div class="col-sm-10">
                            <select name="expense_category_id" class="form-control" required>
                                <option value=""><?php echo get_phrase('select_expense_category');?></option>
                                <?php 
                                	$categories = $this->db->get('expense_category')->result_array();
                                	foreach ($categories as $row):
                                ?>
                                <option value="<?php echo $row['expense_category_id'];?>"><?php echo $row['name'];?></option>
                            <?php endforeach;?>
                            </select>
                        </div>
                    </div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('description');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="description" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-2 control-label"><?php echo get_phrase('amount');?></label>
                        
						<div class="col-sm-10">
							<input type="text" class="form-control" name="amount" value="" >
						</div> 
					</div>

					<div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('method');?></label>
                        <div class="col-sm-10">
                            <select name="method" class="form-control">
                                <option value="1"><?php echo get_phrase('cash');?></option>
                                <option value="2"><?php echo get_phrase('cheque');?></option>
                                <option value="3"><?php echo get_phrase('card');?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo get_phrase('date');?></label>
                        <div class="col-sm-10">
                            <input type="text" class="datepicker form-control" name="timestamp"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-blue btn-sm"><i class="entypo-plus"></i><?php echo get_phrase('save_expense');?></button>
						</div>
					</div>
                <?php echo form_close();?>
    </div>
</div>