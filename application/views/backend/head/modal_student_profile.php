<?php
$student_info	=	$this->crud_model->get_student_info($param2);
foreach($student_info as $row):?>


		<div class="x_panel" >

		<div align="center">
		<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" class="img-circle" width="100" height="100" />
		</div>
		<br>
	      <table class="table">
                 <tr>
                        <th>Student Name</th>
                        <th><b><?php echo $row ['name'];?></b></th>
                    </tr>
                    <?php if($row['class_id'] != ''):?>
                    <tr>
                        <th>Class</th>
                        <th><b><?php echo $this->crud_model->get_class_name($row['class_id']);?></b></th>
                    </tr>
                    <?php endif;?>

                    <?php if($row['section_id'] != '' && $row['section_id'] != 0):?>
                    <tr>
                        <th>Section</th>
                        <th><b><?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?></b></th>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['roll'] != ''):?>
                    <tr>
                        <th>Admission No.</th>
                        <th><b><?php echo $row['roll'];?></b></th>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['birthday'] != ''):?>
                    <tr>
                        <th>Birthday</th>
                        <th><b><?php echo $row['birthday'];?></b></th>
                    </tr>
                    <?php endif;?>
					
					 <?php if($row['m_tongue'] != ''):?>
                    <tr>
                        <th>Mother Tongue</th>
                        <th><b><?php echo $row['m_tongue'];?></b></th>
                    </tr>
                    <?php endif;?>
									
					 <?php if($row['religion'] != ''):?>
                    <tr>
                        <th>Religion</th>
                        <th><b><?php echo $row['religion'];?></b></th>
                    </tr>
                    <?php endif;?>
					
					 <?php if($row['blood_group'] != ''):?>
                    <tr>
                        <th>Blood Group</th>
                        <th><b><?php echo $row['blood_group'];?></b></th>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['sex'] != ''):?>
                    <tr>
                        <th>Gender</th>
                        <th><b><?php echo $row['sex'];?></b></th>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['phone'] != ''):?>
                    <tr>
                        <th>Phone</th>
                        <th><b><?php echo $row['phone'];?></b></th>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['email'] != ''):?>
                    <tr>
                        <th>Email</th>
                        <th><b><?php echo $row['email'];?></b></th>
                    </tr>
                    <?php endif;?>
                
                    <?php if($row['address'] != ''):?>
                    <tr>
                        <th>Address</th>
                        <th><b><?php echo $row['address'];?></b>
                        </th>
                    </tr>
                    <?php endif;?>
                    <?php if($row['parent_id'] != ''):?>
                    <tr>
                        <th>Parent</th>
                        <th><b><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->name;?></b></th>
                    </tr>
                    <tr>
                        <th>Parent Phone</th>
                        <th><b><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->phone;?></b></th>
                    </tr>
                    <?php endif;?>
                    
                </table>
	
	
	
</div>


<?php endforeach;?>