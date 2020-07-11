<?php 
$edit_data		=	$this->db->get_where('email_template' , array('email_template_id' => $param2) )->result_array();

?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
        <?php echo form_open(base_url() . 'index.php?admin/email_template/do_update/'.$row['email_template_id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
            
			
								
								
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email_type');?></label>
                                <div class="col-sm-9">
                                    <select name="email_type" class="form-control selectboxit">
                                    	<option value="Content" <?php if($row['email_type'] == 'Content')echo 'selected';?>><?php echo get_phrase('Content');?></option>
                                    	<option value="Header" <?php if($row['email_type'] == 'Header')echo 'selected';?>><?php echo get_phrase('Header');?></option>
                                    	<option value="Footer" <?php if($row['email_type'] == 'Footer')echo 'selected';?>><?php echo get_phrase('Footer');?></option>
                                    </select>
                                </div>
                            </div>
					
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="subject" value="<?php echo $row['subject'];?>"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('from_email');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="from_email" value="<?php echo $row['from_email'];?>"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('from_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="from_name" value="<?php echo $row['from_name'];?>"/>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email_content');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email_content" value="<?php echo $row['email_content'];?>"/>
                                </div>
                            </div>
					
					 <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date_added'); ?></label>
                        <div class="col-sm-9">
                            <div class="date-and-time">
                                <input type="text" name="date" class="form-control datepicker" data-format="D, dd MM yyyy" value="<?php echo $row['date'];?>">
                            </div>
                        </div>
                    </div>
					
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-5">
                  <button type="submit" class="btn btn-blue btn-sm"><i class="entypo-book"></i><?php echo get_phrase('edit_email_template');?></button>
              </div>
            </div>

        </form>
        <?php endforeach;?>
    </div>
</div>