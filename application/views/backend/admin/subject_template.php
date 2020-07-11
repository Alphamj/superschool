<div class="col-md-5">
 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_subjects_template'); ?>
					</div>
					</div>
 <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'index.php?admin/subject_template/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
					
					 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('subject');?></label>
                                <div class="col-sm-6">
                                    <select name="subject_id" class="form-control" style="width:100%;">
                                    	<?php 
										$teachers = $this->db->get('subject')->result_array();
										foreach($teachers as $row):
										?>
                                    		<option value="<?php echo $row['subject_id'];?>"><?php echo $row['name'];?></option>
                                        <?php
										endforeach;
										?>
                                    </select>
                                </div>
					
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" style="width:100%;" name="template_name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
                            <!-- comment on 28 may 2018 sandeep --> 
                          
                           
						<a href="<?php echo base_url();?>index.php?admin/subject/"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>

                            </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class=" btn-sm btn btn-blue"><i class="entypo-book"></i><?php echo get_phrase('add_subject_template');?></button>
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
					 <?php echo get_phrase('list_subjects_template'); ?>
					</div>
					</div>

				
                <table class="table" id="table_export">
                	<thead>
                		<tr>
							 <!-- Comment on 28 may 2018 sandeep -->
							 	<th><div><?php echo get_phrase('Subject');?></div></th>
                    		<th><div><?php echo get_phrase('subject_template');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($subjects as $row):?>
                        <tr>
							 <!-- Comment on 28 may 2018 sandeep -->
							<td><?php echo $this->crud_model->get_type_name_by_id('subject',$row['Subject_id']);?></td>
							<td><?php echo $row['Template_name'];?></td>
							<td>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_subject_template/<?php echo $row['Subject_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
				
                   
					      <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/subject_template/delete/<?php echo $row['Subject_id'];?>/<?php echo $class_id;?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
					 
                            
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
