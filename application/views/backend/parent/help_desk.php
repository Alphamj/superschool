      
           		<!----CREATION FORM STARTS---->
 <div class="x_panel" >
                <div class="x_title">
                    <div class="panel-title">
                        <?php echo get_phrase('submit_complaint_here');?>
                    </div>
                </div>
				
                	<?php echo form_open(base_url() . 'index.php?parents/help_desk/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
							                <div class="panel-body">

							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
							 <?php $students = $this->db->get_where('parent', array('parent_id' => $this->session->userdata('login_user_id')))->result_array();
					foreach ($students as $row):
   					 ?>
                                    <input name="name" type="text"  value="<?php echo $row ['name']; ?>"class="form-control"/ readonly="true">
					<?php  endforeach;?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('purpose');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="purpose"/>
                                </div>
                            </div>
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('content');?></label>
                                <div class="col-sm-5">
                                    <textarea type="text" class="form-control" name="content"></textarea>
                                </div>
                            </div>
                            
                           <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-blue btn-sm"><i class="entypo-plus"></i><?php echo get_phrase('submit');?></button>
                              </div>
							</div>
                    </form>                
					        
                </div>                
			            <?php echo form_close();?>

			<!----CREATION FORM ENDS-->
			
			
	</div>
