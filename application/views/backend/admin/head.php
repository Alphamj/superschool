<div class="col-md-5">

        <div class="x_panel" >
		
		<div class="x_title">
            	<div class="panel-title" >
					<?php echo 'add head';?>
            	</div>
            </div>
				
                <?php echo form_open(base_url() . 'index.php?admin/head/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					
					<!--<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php //echo get_phrase('birthday');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control datepicker" name="birthday" value="" data-start-view="2">
						</div> 
					</div>-->
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>
                        
						<div class="col-sm-9">
							<select name="sex" class="form-control selectboxit">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <option value="Male"><?php echo 'Male';?></option>
                              <option value="Female"><?php echo 'Female';?></option>
                          </select>
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="address" value="" >
						</div> 
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="phone" value="" >
						</div> 
                         </div>
                         <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo 'Section';?></label>
                        
					<div class="col-sm-9">
						<select name="section" class="form-control selectboxit">
                                   <option value=""><?php echo get_phrase('select');?></option>
                                   <option value="Nursery"><?php echo 'Nursery';?></option>
                                   <option value="Primary"><?php echo 'Primary';?></option>
                                   <option value="Secondary"><?php echo 'Secondary';?></option>
                              </select>
                         </div> 
                         
					</div>
                         <div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="email" value="">
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('password');?></label>
                        
						<div class="col-sm-9">
							<input type="password" class="form-control" name="password" value="" >
						</div> 
					</div>

					<div class="form-group">
                    	<label class="col-sm-3 control-label"><?php echo get_phrase('Signature'); ?></label>
                    	<div class="col-sm-9">
              				<input type="file" name="signature" class="form-control file2 inline btn btn-primary btn-sm" data-label="<i class='glyphicon glyphicon-file'></i> Browse Document" />
						</div>
					</div>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('photo');?></label>
                        
						<div class="col-sm-9">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<div class="fileinput-new thumbnail" style="width: 100px; height: 100px;" data-trigger="fileinput">
									<img src="http://placehold.it/200x200" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="userfile" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
						</div>
					</div>
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-orange btn-sm btn-icon icon-left"> <i class="entypo-plus"></i><?php echo 'add head';?></button>
						</div>
					</div>
					<br>
                <?php echo form_close();?>
            </div>
        </div>




 <div class="col-md-7">

        <div class="x_panel" >
		                <div class="x_title">
                    <div class="panel-title">
					 <?php echo 'list head'; ?>
					</div>
					</div>
<div class="table-responsive">

<table class=" table  datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('section');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $heads	=	$this->db->get('head' )->result_array();
                                foreach($heads as $row):?>
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('head',$row['head_id']);?>" class="img-circle" width="30" /></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['section'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_head_edit/<?php echo $row['head_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/head/delete/<?php echo $row['head_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
							<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_head_message/<?php echo $row['head_id']; ?>');"><button type="button" class="btn btn-green btn-xs"><i class="entypo-mail"></i></button></a>

							
                                
                               
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
</div>
</div>
</div>


<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->   
<!-----  add code on 26 may 2018 ---->   
 
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>                             
<script type="text/javascript">
	 $( function() {
		$( ".datepicker" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
			maxDate: new Date()
		});
	} );
	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable({
			"sPaginationType": "bootstrap",
			"sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
			"oTableTools": {
				"aButtons": [
					
					{
						"sExtends": "xls",
						"mColumns": [1,2]
					},
					{
						"sExtends": "pdf",
						"mColumns": [1,2]
					},
					{
						"sExtends": "print",
						"fnSetText"	   : "Press 'esc' to return",
						"fnClick": function (nButton, oConfig) {
							datatable.fnSetColumnVis(0, false);
							datatable.fnSetColumnVis(3, false);
							
							this.fnPrint( true, oConfig );
							
							window.print();
							
							$(window).keyup(function(e) {
								  if (e.which == 27) {
									  datatable.fnSetColumnVis(0, true);
									  datatable.fnSetColumnVis(3, true);
								  }
							});
						},
						
					},
				]
			},
			
		});
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script>

