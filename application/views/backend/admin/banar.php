<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('bannar_information_page'); ?>
					</div>
					</div>
<div class="table-responsive">
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_banar_add/');" 
            	class="btn  btn-orange btn-xs">
                <i class="entypo-plus"></i>
            	<?php echo get_phrase('add_new_bannar');?>
                </a> 
                <br>
               <table class="table " id="table_export">
                    <thead>
                        <tr>
                            <th><div><?php echo get_phrase('b_text_one');?></div></th>
                            <th><div><?php echo get_phrase('b_text_two');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                       			<?php 
                                $banars	=	$this->db->get('banar' )->result_array();
                                foreach($banars as $row):?>
                        <tr>
                            <td><?php echo $row['b_text_one'];?></td>
                            <td><?php echo $row['b_text_two'];?></td>
                            <td>
		<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_banar_edit/<?php echo $row['banar_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/banar/delete/<?php echo $row['banar_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
                                
                               
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>

</div>
</div>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
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

