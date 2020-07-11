<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('change_profile'); ?>
					</div>
					</div>
    
					<?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url() . 'index.php?parents/manage_profile/update_profile_info' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
<button type="submit" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-pencil"></i><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
                        </form>
						<?php
                    endforeach;
                    ?>
			</div>
            <!----EDITING FORM ENDS--->


<!--password-->
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('change_password'); ?>
					</div>
					</div>
    
					<?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url() . 'index.php?parents/manage_profile/change_password' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('current_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" value="<?php echo $row['password'];?>"/ readonly="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('confirm_new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-pencil"></i><?php echo get_phrase('update_password');?></button>
                              </div>
								</div>
                        </form>
						<?php
                    endforeach;
                    ?>
                </div>
            <!----EDITING FORM ENDS-->
            
