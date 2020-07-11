<div class="col-md-5">
 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_subjects'); ?>
					</div>
					</div>
 <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'index.php?admin/subject/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <!-- comment on 28 may 2018 sandeep --> 
                          <!--  <div class="form-group">
                                <label class="col-sm-3 control-label"><?php //echo get_phrase('class');?></label>
                                <div class="col-sm-6">
                                    <select name="class_id" class="form-control" style="width:100%;">
                                    	<?php 
										/*$classes = $this->db->get('class')->result_array();
										foreach($classes as $row):
										?>
                                    		<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;*/
										?>
                                    </select>
                                </div>
										<a href="<?php // echo base_url();?>index.php?admin/classes/"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>

                            </div>-->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('teacher');?></label>
                                <div class="col-sm-6">
                                    <select name="teacher_id" class="form-control" style="width:100%;">
                                    	<?php 
										$teachers = $this->db->get('teacher')->result_array();
										foreach($teachers as $row):
										?>
                                    		<option value="<?php echo $row['teacher_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
							<a href="<?php echo base_url();?>index.php?admin/teacher/"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>

                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class=" btn-sm btn btn-blue"><i class="entypo-book"></i><?php echo get_phrase('add_subject');?></button>
                              </div>
						   </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->

 <div class="col-md-7">
 <div class="x_panel table-responsive">
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_subjects'); ?>
					</div>
					</div>

				
                <table class="table" id="table_export">
                	<thead>
                		<tr>
							 <!-- Comment on 28 may 2018 sandeep -->
                    		<!--<th><div><?php echo get_phrase('class');?></div></th>-->
                    		<th><div><?php echo get_phrase('subject_name');?></div></th>
                    		<th><div><?php echo get_phrase('teacher');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($subjects as $row):?>
                        <tr>
							 <!-- Comment on 28 may 2018 sandeep -->
							 <!--<td><?php echo $this->crud_model->get_type_name_by_id('class',$row['class_id']);?></td>-->
							<td><?php echo $row['name'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
							<td>
								<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_subject/<?php echo $row['subject_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
								<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/subject/delete/<?php echo $row['subject_id'];?>/<?php echo $class_id;?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
							</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->
 
			          
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>
