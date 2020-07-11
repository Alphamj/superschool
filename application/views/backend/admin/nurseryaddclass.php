<div class="col-md-5">
        <div class="x_panel" >

            <div class="x_title">
                <div class="panel-title">
                    <?php echo get_phrase('add_class'); ?>
                </div>
            </div>

               <?php echo form_open(base_url() . 'index.php?admin/teacher/create/' , array('class' => 'form-horizontal form-groups-bordered validate'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Class Name');?></label>
                        
						<div class="col-sm-9">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-orange btn-sm btn-icon icon-left"> <i class="entypo-plus"></i><?php echo get_phrase('add_class');?></button>
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
					 <?php echo get_phrase('list_classes'); ?>
					</div>
					</div>
				<div class="table-responsive">
				<table class=" table  datatable" id="table_export">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        		<?php 
                                $teachers	=	array('name'=>'');//$this->db->get('teacher' )->result_array();
                                foreach($teachers as $row):?>
                        <tr>
                            <td><?php echo $row['name'];?></td>
                            <td>
							<?php
							if($row['name']!=''){
							?>
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_teacher_edit/<?php //echo $row['teacher_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/teacher/delete/<?php //echo $row['teacher_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
                            </td>
							<?php
							}
							?>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
				
				<?php if($row['name'] == ''):?>
							<div class="alert alert-danger" align="center">No Data to be Displayed !</div>
							<?php endif;?>
				
				
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

