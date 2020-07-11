<div class="col-md-5">

        <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_actions'); ?>
					</div>
					</div>
<!----CREATION FORM STARTS---->
                	<?php echo form_open(base_url() . 'index.php?admin/actions/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                         
						
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('action_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="action_name"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('display');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="display"/>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('parent_name');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="parent_name"/>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('parent_key');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="parent_key"/>
                                </div>
                            </div>
					
				
					
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-success btn-sm btn-icon icon-left"><i class="entypo-home"></i><?php echo get_phrase('add_actions');?></button>
                              </div>
							</div>
							<br>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->


<div class="col-md-7">

        <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_sidebar_actions'); ?>
					</div>
					</div>
				<div class="table-responsive">
            <!--TABLE LISTING STARTS-->
						<table class=" table  datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('action_name');?></div></th>
                    		<th><div><?php echo get_phrase('display');?></div></th>
                    		<th><div><?php echo get_phrase('parent_name');?></div></th>
                    		<th><div><?php echo get_phrase('parent_key');?></div></th>
                    		<th><div><?php echo get_phrase('actions');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($actionss as $row):?>
                        <tr>
							<td><?php echo $row['action_name'];?></td>
							<td><?php echo $row['display'];?></td>
							<td><?php echo $row['parent_name'];?></td>
							<td><?php echo $row['parent_key'];?></td>
							<td>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_actions/<?php echo $row['action_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/actions/delete/<?php echo $row['action_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
														
                            
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->
			
			<script type="text/javascript">

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

