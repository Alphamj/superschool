<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_class_mate'); ?>
					</div>
					</div>
<div class="table-responsive">
               <table class="table" id="table_export">
                    <thead>
                        <tr>
                            <th width="80"><div><?php echo get_phrase('photo');?></div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
            				<th><?php echo get_phrase('class');?></th>
                            <!--<th><div><?php //echo get_phrase('email');?></div></th>-->
                            <th><div><?php echo get_phrase('mobile_no');?></div></th>
                            <th><div><?php echo get_phrase('send_message');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
						$this->db->where('class_id' , $class_id);
						$students	=	$this->db->get('student')->result_array();
						foreach($students as $row):?>
                        <tr>
                            <td><img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" class="img-circle" width="30" height="30" /></td>
                            <td><?php echo $row['name'];?></td>
							<td>
                    			<?php $name = $this->db->get_where('class' , array('class_id' => $row['class_id'] ))->row()->name;
                    			 echo $name;?>
               				 </td>
                            <!--<td><?php //echo $row['email'];?></td>-->
                            <td><?php echo $row['phone'];?></td>
                            <td>
<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_message/<?php echo $row['student_id']; ?>');"><button type="button" class="btn btn-green btn-xs"><i class="entypo-mail"></i></button></a>
							</td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
				
				
				
				<?php if($row['name'] == ''):?>
							<div class="alert alert-danger" align="center">Sorry! You have no class mate(s) yet.</div>
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

