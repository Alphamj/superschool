<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('student_class_list'); ?>
					</div>
					</div>
				
<table class="table">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('class_name');?></div></th>
                    		<th><div><?php echo get_phrase('numeric_name');?></div></th>
                    		<th><div><?php echo get_phrase('teacher');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	 <?php $classes = $this->db->get_where('class', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
					foreach ($classes as $row):
   					 ?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['name_numeric'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
							<td>
							
							<a href="<?php echo base_url(); ?>index.php?formtutor/student_information/<?php echo $row['class_id']; ?>"><button type="button" class="btn btn-orange btn-xs"><i class="entypo-users"></i>View Students</button></a>
			        
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			
            <!----TABLE LISTING ENDS--->