  <!-- added on 26 may 2018-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
 <div class="x_panel" >
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_alumni'); ?>
					</div>
					</div>
<div class="table-responsive">

           &nbsp;&nbsp;&nbsp;&nbsp;
            <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_alumni_add/');" 
            	 class="btn btn-xs btn-orange">
        <i class="entypo-plus"></i>
            	<?php echo get_phrase('add-alumni');?>
                </a> 
           
               <table class="table" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('sex');?></div></th>
                            <th><div><?php echo get_phrase('address');?></div></th>
   							<th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('profession');?></div></th>
						   	<th><div><?php echo get_phrase('graduation_year');?></div></th>
                            <th><div><?php echo get_phrase('school_club');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $alumnis	=	$this->db->get('alumni' )->result_array();
                                foreach($alumnis as $row):?>
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('alumni',$row['alumni_id']);?>" class="img-circle" width="30" /></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['sex'];?></td>
                            <td><?php echo $row['address'];?></td>

							 <td><?php echo $row['phone'];?></td>
                            <td><?php echo $row['profession'];?></td>
                            <td><?php echo $row['g_year'];?></td>
                            <td><?php echo $row['club'];?></td>

                            <td>

								<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_alumni_edit/<?php echo $row['alumni_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
				
                   
					<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/alumni/delete/<?php echo $row['alumni_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
					
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

