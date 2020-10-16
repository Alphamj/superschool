<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_all_teachers'); ?>
					</div>
					</div>
<div class="table-responsive">
               <table class="table table-bordered datatable" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <!--<th><div><?php //echo get_phrase('mobile_no');?></div></th>
                            <th><div><?php //echo get_phrase('address');?></div></th>-->
                            <th><div><?php echo get_phrase('send_message');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $teachers	=	$this->db->get('teacher' )->result_array();
                                foreach($teachers as $row):?>
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('teacher',$row['teacher_id']);?>" class="img-circle" width="30" /></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <!--<td><?php //echo $row['phone'];?></td>
                            <td><?php //echo $row['address'];?></td>-->
                            <td>
<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_teacher_message/<?php echo $row['teacher_id']; ?>');"><button type="button" class="btn btn-green btn-xs"><i class="entypo-mail"></i></button></a>
							</td>
                            
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>

							<?php if($row['name'] == ''):?>
							<div class="alert alert-danger" align="center">Sorry! no teacher(s) has been assign to your class yet.</div>
							<?php endif;?>
</div>
</div>


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

