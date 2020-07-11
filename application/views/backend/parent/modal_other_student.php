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
                    	 <?php
                    $children_of_parent = $this->db->get_where('student', array(
                                'parent_id' => $this->session->userdata('parent_id')
                            ))->result_array();
                    foreach ($children_of_parent as $row):
                        ?>
                        <tr>
                            <td><?php echo $row['student_id'];?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['name_numeric'];?></td>
							<td><?php echo $this->crud_model->get_type_name_by_id('teacher',$row['teacher_id']);?></td>
							<td>
							
							<a href="<?php echo base_url(); ?>index.php?parents/search_student/<?php echo $row['student_id']; ?>"><button type="button" class="btn btn-orange btn-xs"><i class="entypo-users"></i>View Students</button></a>
			        
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			
            <!----TABLE LISTING ENDS--->