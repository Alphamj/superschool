<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family: Arial, sans-serif;font-size: 12px;padding: 8px;border: 1px solid #E6E9ED;border-width: 1px;overflow: hidden;word-break: normal;color: #000;}
.tg th{font-family: Arial, sans-serif;font-size: 14px;font-weight: normal;padding: 10px 5px;border: 1px solid #E6E9ED;border-width: 1px;overflow: hidden;word-break: normal;}
.tg .tg-yw4l{vertical-align:middle;text-align: center;}
.tg.table-two {margin: 100px 0 0 0;}
.tg tr th, .tg tr td {color: #000;}
.tg thead tr:last-child td:nth-child(odd) { background-color: transparent;}
td {font-family: Arial, sans-serif;font-size: 12px;padding: 8px;border: 1px solid #E6E9ED;border-width: 1px;overflow: hidden;word-break: normal;color: #000;}


</style>
 <div class="x_panel tablu" >
					<div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('student_mark'); ?>
					</div>
					</div>

            <!----TABLE LISTING STARTS-->
            <div class="tab-pane  <?php if(!isset($edit_data) && !isset($personal_profile) && !isset($academic_result) )echo 'active';?>" id="list">
				<center>
                <?php echo form_open(base_url() . 'index.php?teacher/manage_marks0');?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                	<tr>
                        <td><?php echo get_phrase('select_term');?></td>
                        <td><?php echo get_phrase('select_class');?></td>
                        <td><?php echo get_phrase('select_student');?></td>
                        <td>&nbsp;</td>
                	</tr>
                	<tr>
                        <td>
                        	<select name="exam_id" class="form-control"  style="float:left;" required>
                                <option value=""><?php echo get_phrase('select_term');?></option>
                                <?php 
                                $exams = $this->db->get('exam')->result_array();
                                foreach($exams as $row):
                                ?>
                                    <option value="<?php echo $row['exam_id'];?>"
                                        <?php if($exam_id == $row['exam_id'])echo 'selected';?>>
                                           <?php echo $row['name2'];?></option>
                                <?php
                                endforeach;
                                ?>
                         </select>
                        </td>
                        <td>
                        	<select name="class_id" class="form-control"  onchange="show_students(this.value)"  style="float:left;" required>
                                <option value=""><?php echo get_phrase('select_a_class');?></option>
                                <?php 
                                $classes = $this->db->get('class')->result_array();
						  $sect = $this->db->get_where('teacher', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
						  foreach($classes as $row):
                                ?>
                                   <?php if ($sect[0]['section'] == 'Secondary'): 
									if ($row['class_id'] > 19 && $row['class_id'] < 40){ ?>
                            				<option value="<?php echo $row['class_id'];?>"
                            					<?php if ($class_id == $row['class_id']) echo 'selected';?>>
                            				 		<?php echo $row['name'];?>
							   		</option> <?php } endif ?>
							   
							<?php if ($sect[0]['section'] == 'Primary'):
									if ($row['class_id'] > 0 && $row['class_id'] < 20){ ?>
                            				<option value="<?php echo $row['class_id'];?>"
                            					<?php if ($class_id == $row['class_id']) echo 'selected';?>>
                            				 		<?php echo $row['name'];?>
									   </option> <?php } endif?>
									   
							<?php if ($sect[0]['section'] == 'Nursery'):
									if ($row['class_id'] > 40 && $row['class_id'] < 47){ ?>
                            				<option value="<?php echo $row['class_id'];?>"
                            					<?php if ($class_id == $row['class_id']) echo 'selected';?>>
                            				 		<?php echo $row['name'];?>
									   </option> <?php } endif?>
									   
							<?php if ($sect[0]['section'] == 'Toddler'):
									if ($row['class_id'] == 40){ ?>
                            				<option value="<?php echo $row['class_id'];?>"
                            					<?php if ($class_id == $row['class_id']) echo 'selected';?>>
                            				 		<?php echo $row['name'];?>
                            				</option> <?php } endif?>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </td>
                        <td>
                        	<!---SELECT SUBJECT ACCORDING TO SELECTED CLASS-->
							<?php 
                                $classes	=	$this->crud_model->get_classes(); 
                                foreach($classes as $row): ?>
                                
                                <select name="<?php if($class_id == $row['class_id'])echo 'student_id';else echo 'temp';?>" 
                                      id="student_id_<?php echo $row['class_id'];?>" 
                                          style="display:<?php if($class_id == $row['class_id'])echo 'block';else echo 'none';?>;" class="form-control"  style="float:left;" >
                                  
                                    <option value="">Students of class <?php echo $row['name'];?></option>
                                    
                                    <?php 
                                    $students	=	$this->crud_model->get_students($row['class_id']); 
                                    foreach($students as $row2): ?>
                                    <option class="student_id" value="<?php echo $row2['student_id'];?>"
                                        <?php if(isset($student_id) && $student_id == $row2['student_id'])
                                                echo 'selected="selected"';?>><?php echo $row2['name'].' '.$row2['surname'];?>
                                    </option>
                                    <?php endforeach;?>
                                    
                                    
                                </select> 
                            <?php endforeach;?>
                            
                            
                            <select name="temp" id="student_id_0" 
                              style="display:<?php if(isset($student_id) && $student_id >0)echo 'none';else echo 'block';?>;" class="form-control" style="float:left;">
                                    <option value="">Select a class first</option>
                            </select>
                        </td>
                        <td>
                        	<input type="hidden" name="operation" value="selection" />
							<button type="submit" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-search"></i>&nbsp;<?php echo get_phrase('browse_marks'); ?></button>

                        </td>
                	</tr>
                </table>
                </form>
                </center>
        	</div>
        	</div>

                
               <?php
					$get_system_settings	=	$this->crud_model->get_system_settings();
					
               if($exam_id > 0 && $class_id > 0 && $student_id > 0 ):?>
               	



				<div class="x_panel tablu" >
					<div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('enter_student_score'); ?>
					</div>
					</div>

<!-- Senior Secondary -->
					<!-- CODE added on 04 june 2018 sandeep-->
<!-- change link -->	<?php echo form_open(base_url() . 'index.php?teacher/marks0/' . $exam_id . '/' . $class_id);?>
<?php  $class_type = strtolower($this->crud_model->get_class_name($class_id)); 
					$jss = "no";
					if(strpos($class_type, 'jss') !== false ){
						$jss = "yes";
					}
					
					if (strpos($class_type, 'ss') !== false && $jss !='yes'){
					
						////CREATE THE MARK ENTRY ONLY IF NOT EXISTS////
						$teacher_id = $this->session->userdata('login_user_id');
						$students	=	$this->crud_model->get_subjects_by_class2($class_id, $student_id, $teacher_id);
						foreach($students as $row):
							$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id ,'subject_id' => $row['subject_id'] , 
												'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
							$query = $this->db->get_where('mark0' , $verify_data);
							
							if($query->num_rows() < 1)
								$this->db->insert('mark0' , $verify_data);
						endforeach;
					?>

				<!-- For SS 1 & 2 -->
				<?php if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?> 

				<table cellpadding="0" cellspacing="0" border="0" class="tg">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A [20]</th>
							<th class="tg-yw4l" rowspan="2">TEST [10]</th>
							<th class="tg-yw4l" rowspan="2">TOTAL [30]</th>
							<th class="tg-yw4l" rowspan="2">EFFORT</th>
							<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'S REMARKS</th>
							<th class="tg-yw4l" rowspan="2">TEACHER</th>
							
						</tr>
						<tr>
							<td class="tg-yw4l">ATTITUDE TO WORK AND TASK</td>
							<td class="tg-yw4l">ATTENTIVENESS IN CLASS</td>
							<td class="tg-yw4l">RESPONSE TO ASSIGNMENTS AND PROJECTS</td>
							<td class="tg-yw4l">INTEREST IN SUBJECT</td>
							<td class="tg-yw4l">WILLINGNESS TO WORK WITH OTHERS</td>
						</tr>
                    </thead>
                    <tbody>
                    	
                        <?php 
                        //cod e added on 4 june sandeep
				    		
				    	$students	=	$this->crud_model->get_subjects_by_class2($class_id, $student_id, $teacher_id);
						foreach($students as $row):
						
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$get_system_settings[17]['description']);
														
							$query = $this->db->get_where('mark0' , $verify_data);							 
							$marks	=	$query->result_array();
							if ($class_id > 28 && $class_id < 32){
								$avgtmk1 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>29 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk2 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>30 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk3 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>31 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							}
							if ($class_id > 31 && $class_id < 35){
								$avgtmk1 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>32 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk2 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>33 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk3 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>34 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							}
							
							$avgtmk = array_merge($avgtmk1,$avgtmk2,$avgtmk3);
							foreach($marks as $row2):
							?>
                     
							<tr>
								<td>
									<?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']);?>
								</td>
								<td class="tg-yw4l"><input type="text" class="class_score form-control" value="<?php echo $row2['ca_marks'];?>" name="ca_marks_<?php echo $row['subject_id'];?>" id="ca_marks_<?php echo $row['subject_id'];?>" onchange="class_score_change1('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="class_score2 form-control" value="<?php echo $row2['mark_obtained'];?>" name="mark_obtained_<?php echo $row['subject_id'];?>" id="mark_obtained_<?php echo $row['subject_id'];?>" onchange="class_score_change2('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="form-control" value="<?php echo $row2['mark_total'];?>"  name="mark_total_<?php echo $row['subject_id'];?>" id="mark_total_<?php echo $row['subject_id'];?>" readonly="true"></td>
								<td class="tg-yw4l">
									<select  class="class_score form-control"  name="effort_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['effort_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['effort_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['effort_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['effort_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['effort_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
									</td>
								<td class="tg-yw4l">
									<select  class="class_score form-control" name="attitude_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['attitude_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['attitude_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['attitude_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['attitude_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['attitude_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control" name="attentiveness_mark_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['attentiveness_mark'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['attentiveness_mark'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['attentiveness_mark'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['attentiveness_mark'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['attentiveness_mark'] =='E'){ echo "selected";}?>>E</option>
									
									</select>	
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control"  name="assignment_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['assignment_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['assignment_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['assignment_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['assignment_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['assignment_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control" name="interest_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['interest_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['interest_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['interest_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['interest_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['interest_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control"  name="willingness_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['willingness_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['willingness_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['willingness_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['willingness_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['willingness_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td width = '13%'>
								
									<select class="class_score form-control" name="teacher_<?php echo $row['subject_id'];?>"  required>
                                				<option value=""><?php echo 'select_teacher';?></option>
											<?php 
											$teachers = $this->db->get('teacher')->result_array();
                                					foreach($teachers as $teacher):
                                					?>
                                    					<option value="<?php echo $teacher['name'];?>"
												 <?php if($row2['teacher'] == $teacher['name']) echo 'selected';?>>
													   <?php echo $teacher['name'];?>
												</option>
                                					<?php
                                					endforeach;
                                					?>
                         				</select>
								</td>
								
                                <input type="hidden" name="mark_id_<?php echo $row['subject_id'];?>" value="<?php echo $row2['mark_id'];?>" />
                                   
                                <input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
                                <input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
                                <input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
                                <input type="hidden" name="session_year" value="<?php echo $get_system_settings[17]['description'];?>" />
                                <input type="hidden" name="operation" value="update" />
							 </tr>

							 <?php 
			   					$verify_data = array("subject_id"=>$row['subject_id'],'exam_id' => $exam_id ,'class_id' => $class_id , 
								   'session_year'=>$get_system_settings[17]['description']);
					   			$query_subavg = $this->db->get_where('subavg0' , $verify_data);
   
					   			if($query_subavg->num_rows() < 1){
					   				$this->db->insert('subavg0' , $verify_data);
							   	}
								$q = $total = 0;
					   			
								foreach($avgtmk as $totmk){
									if ((floatval($totmk['mark_obtained']))!= 0){
										$q++;
										$total +=($totmk['ca_marks']+$totmk['mark_obtained']);
									}
								}
								$subavg =  $total/ $q;
								if ($subavg > 0){
									$data['subject_average'] = round($subavg,1);}
								else {
									$data['subject_average'] = 0;}
   
								$this->db->where('subject_id',$row['subject_id']);
								$this->db->where('class_id', $class_id);
					   			$this->db->where('exam_id', $exam_id);
					   			$this->db->where('session_year', $get_system_settings[17]['description']);
					   			$this->db->update('subavg0', $data);
			   				?>


                            
                         	<?php
							endforeach;
						 endforeach;
						 ?>
						 
                     </tbody>
			   </table>

		<!-- For SS3 -->
		<?php } if (strpos($class_type, 'ss 3') !== false) { ?> 
			<table cellpadding="0" cellspacing="0" border="0" class="tg">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">MOCK [100]</th>
							<th class="tg-yw4l" rowspan="2">EFFORT</th>
							<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'S REMARKS</th>
							<th class="tg-yw4l" rowspan="2">TEACHER</th>
							
						</tr>
						<tr>
							<td class="tg-yw4l">ATTITUDE TO WORK AND TASK</td>
							<td class="tg-yw4l">ATTENTIVENESS IN CLASS</td>
							<td class="tg-yw4l">RESPONSE TO ASSIGNMENTS AND PROJECTS</td>
							<td class="tg-yw4l">INTEREST IN SUBJECT</td>
							<td class="tg-yw4l">WILLINGNESS TO WORK WITH OTHERS</td>
						</tr>
                    </thead>
                    <tbody>
                    	
                        <?php 
                        //cod e added on 4 june sandeep
				    		
				    	$students	=	$this->crud_model->get_subjects_by_class2($class_id, $student_id, $teacher_id);
						foreach($students as $row):
						
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$get_system_settings[17]['description']);
														
							$query = $this->db->get_where('mark0' , $verify_data);							 
							$marks	=	$query->result_array();
							$avgtmk1 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>35 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							$avgtmk2 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>36 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							$avgtmk3 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>37 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							$avgtmk = array_merge($avgtmk1,$avgtmk2,$avgtmk3);
							foreach($marks as $row2):
							?>
                     
							<tr>
								<td>
									<?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']);?>
								</td>
								<td class="tg-yw4l"><input type="text" class="class_score01 form-control" value="<?php echo $row2['mark_obtained'];?>" name="mark_obtained_<?php echo $row['subject_id'];?>" id="mark_obtained_<?php echo $row['subject_id'];?>" onchange="class_score_change01('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l">
									<select  class="class_score form-control"  name="effort_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['effort_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['effort_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['effort_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['effort_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['effort_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
									</td>
								<td class="tg-yw4l">
									<select  class="class_score form-control" name="attitude_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['attitude_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['attitude_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['attitude_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['attitude_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['attitude_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control" name="attentiveness_mark_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['attentiveness_mark'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['attentiveness_mark'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['attentiveness_mark'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['attentiveness_mark'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['attentiveness_mark'] =='E'){ echo "selected";}?>>E</option>
									
									</select>	
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control"  name="assignment_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['assignment_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['assignment_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['assignment_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['assignment_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['assignment_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control" name="interest_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['interest_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['interest_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['interest_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['interest_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['interest_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control"  name="willingness_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['willingness_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['willingness_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['willingness_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['willingness_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['willingness_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td width = '13%'>
								
									<select class="class_score form-control" name="teacher_<?php echo $row['subject_id'];?>"  required>
                                				<option value=""><?php echo 'select_teacher';?></option>
											<?php 
											$teachers = $this->db->get('teacher')->result_array();
                                					foreach($teachers as $teacher):
                                					?>
                                    					<option value="<?php echo $teacher['name'];?>"
												 <?php if($row2['teacher'] == $teacher['name']) echo 'selected';?>>
													   <?php echo $teacher['name'];?>
												</option>
                                					<?php
                                					endforeach;
                                					?>
                         				</select>
								</td>
								
                                <input type="hidden" name="mark_id_<?php echo $row['subject_id'];?>" value="<?php echo $row2['mark_id'];?>" />
                                   
                                <input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
                                <input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
                                <input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
                                <input type="hidden" name="session_year" value="<?php echo $get_system_settings[17]['description'];?>" />
                                <input type="hidden" name="operation" value="update" />
							 </tr>
						
							 <?php 
			   					$verify_data = array("subject_id"=>$row['subject_id'],'exam_id' => $exam_id ,'class_id' => $class_id , 
								   'session_year'=>$get_system_settings[17]['description']);
					   			$query_subavg = $this->db->get_where('subavg0' , $verify_data);
   
					   			if($query_subavg->num_rows() < 1){
					   				$this->db->insert('subavg0' , $verify_data);
							   	}
								$q = $total = 0;
					   			
								foreach($avgtmk as $totmk){
									if ((floatval($totmk['mark_obtained']))!= 0){
										$q++;
										$total +=($totmk['mark_obtained']);
									}
								}
								$subavg =  $total/ $q;
								if ($subavg > 0){
									$data['subject_average'] = round($subavg,1);}
								else {
									$data['subject_average'] = 0;}
   
								$this->db->where('subject_id',$row['subject_id']);
								$this->db->where('class_id', $class_id);
					   			$this->db->where('exam_id', $exam_id);
					   			$this->db->where('session_year', $get_system_settings[17]['description']);
					   			$this->db->update('subavg0', $data);
			   				?>
                            
                         	<?php 
							endforeach;
						 endforeach;
						 ?>
						 
                     </tbody>
			   </table> <?php }?>

			<!-- Individual Total Average -->
			<?php 
					
					if ($class_id > 28 && $class_id < 32 ){
						$verify_datas = array('exam_id' => $exam_id ,'class_id' => 111 , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
					 }
					 elseif ($class_id > 31 && $class_id < 35 ){
						$verify_datas = array('exam_id' => $exam_id ,'class_id' => 112 , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
					 }
					 elseif ($class_id > 31 && $class_id < 35 ){
						$verify_datas = array('exam_id' => $exam_id ,'class_id' => 113 , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
					 }
					$query_Remark = $this->db->get_where('average0' , $verify_datas);

					if($query_Remark->num_rows() < 1){
					$this->db->insert('average0' , $verify_datas);
							}
					
					$tscores = $this->db->get_where('mark0',array('exam_id' => $exam_id ,'class_id' => $class_id , 
					'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']))->result_array();
					$m = 0;
					foreach($tscores as $scores){
						if (($scores['mark_obtained']) != 0){
							$m++;
							$tot = $scores['ca_marks']+$scores['mark_obtained'];
							$total_markss +=$tot;}
					}

					$stavg = $total_markss / $m;
					
					if ($total_markss == ''){
						$datas['total_average'] = 0;
						$datas['total_score'] = 0;
					}

					if ($total_markss > 0){
						$datas['total_average'] = round($stavg,2);
						$datas['total_score'] = $total_markss;
					}

					if ($class_id > 28 && $class_id < 32 ){
						$this->db->where('class_id', 111);
					 }
					 elseif ($class_id > 31 && $class_id < 35 ){
						$this->db->where('class_id', 112);
					 }
					 elseif ($class_id > 34 && $class_id < 38 ){
						$this->db->where('class_id', 113);
					 }
        				$this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('session_year', $get_system_settings[17]['description']);
					$this->db->update('average0', $datas);
				?>
			   
			   <hr>

	<?php $test = $this->db->get_where('class', array('class_id' => $class_id ))->result_array(); 
		if($test[0]['teacher_id'] == $this->session->userdata('login_user_id')){
	?>
						 
		<!--COMMENT AREA-->
		<table style="width:100%; vertical-align: bottom;">
			<?php //echo $exam_id;
				$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
				$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();
				$head_sign = $this->db->get_where('head', array('section'=>'Secondary'))->result_array();

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments0' , $verify_data);
							
				if($query_comments->num_rows() < 1){
						$this->db->insert('comments0' , $verify_data);
								}
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
					<?php if ($class_id > 34 && $class_id < 38) { ?>
					<tr>
						<th>Teacher's Name</th>
						<th>Vice Principal's Name</th>
						<th>Attendance</th>
						
					</tr>
					<tr>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['TeacherNames'];?>" name="TeacherNames"></td>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['VPName'];?>" name="VPName"></td>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['Attendances'];?>" name="Attendances">Example: Attendance / No of time school opened</td>
					</tr>
					<tr>
						<th>Teacher's Comment</th>
						<th>Vice Principal's Comment</th>
					</tr>
					<tr>
						<td><textarea class="class_score form-control" value="<?php echo $row['TeacherComments'];?>" cols="30" name = "TeacherComments"><?php echo $row['TeacherComments'];?></textarea></td>
						<td><textarea class="class_score form-control" value="<?php echo $row['VPComment'];?>" cols="30" name = "VPComment"><?php echo $row['VPComment'];?></textarea></td>
						<input type="hidden" name="teach_sign" value="<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg' ?>" />
						<input type="hidden" name="head_sign" value="<?php echo $head_sign[0]['head_id'] . '.' . 'jpg' ?>" />
					</tr>
					<?php } ?>
			<?php endforeach; ?>
			
			</table> 
			
			<?php } ?> 
			   
			   <hr>
	
<!-- Junior Secondary -->
				 <?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){ ?>
					<?php 
						////CREATE THE MARK ENTRY ONLY IF NOT EXISTS////
						$students	=	$this->crud_model->get_subjects_by_class1($class_id);
						foreach($students as $row):
							$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id ,'subject_id' => $row['subject_id'] , 
												'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
							$query = $this->db->get_where('mark0' , $verify_data);
							
							if($query->num_rows() < 1)
								$this->db->insert('mark0' , $verify_data);
						 endforeach;
					?>
					<table cellpadding="0" cellspacing="0" border="0" class="tg">
                    	<thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A [25]</th>
							<th class="tg-yw4l" rowspan="2">TEST [15]</th>
							<th class="tg-yw4l" rowspan="2">TOTAL [40]</th>
							<th class="tg-yw4l" rowspan="2">EFFORT</th>
							<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'S REMARKS</th>
							<th class="tg-yw4l" rowspan="2">TEACHER</th>
							
						</tr>
						<tr>
							<td class="tg-yw4l">ATTITUDE TO WORK AND TASK</td>
							<td class="tg-yw4l">ATTENTIVENESS IN CLASS</td>
							<td class="tg-yw4l">RESPONSE TO ASSIGNMENTS AND PROJECTS</td>
							<td class="tg-yw4l">INTEREST IN SUBJECT</td>
							<td class="tg-yw4l">WILLINGNESS TO WORK WITH OTHERS</td>
						</tr>
					</thead>
					<tbody>
                    	
                        <?php 
						$teacher_id = $this->session->userdata('login_user_id');
						$students	=	$this->crud_model->get_subjects_by_class3($class_id, $teacher_id);
						foreach($students as $row):
						
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$get_system_settings[17]['description']);
														
							$query = $this->db->get_where('mark0' , $verify_data);							 
							$marks	=	$query->result_array();
							if ($class_id > 19 && $class_id < 23){
								$avgtmk1 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>20 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk2 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>21 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk3 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>22 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							}
							elseif ($class_id > 22 && $class_id < 26){
								$avgtmk1 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>23 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk2 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>24 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk3 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>25 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							}
							elseif ($class_id > 25 && $class_id < 29){
								$avgtmk1 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>26 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk2 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>27 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk3 = $this->db->get_where('mark0',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>28 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							}
							$avgtmk = array_merge($avgtmk1,$avgtmk2,$avgtmk3);
							foreach($marks as $row2):
					?>
     <!-- change link -->	<?php echo form_open(base_url() . 'index.php?teacher/marks0/' . $exam_id . '/' . $class_id);?>
							<tr>
								<td>
									<?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']);;?>
								</td>
								<td class="tg-yw4l"><input type="text" class="class_score form-control" value="<?php echo $row2['ca_marks'];?>" name="ca_marks_<?php echo $row['subject_id'];?>" id="ca_marks_<?php echo $row['subject_id'];?>" onchange="class_score_change1_jss('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="class_score2 form-control" value="<?php echo $row2['mark_obtained'];?>" name="mark_obtained_<?php echo $row['subject_id'];?>" id="mark_obtained_<?php echo $row['subject_id'];?>" onchange="class_score_change2_jss('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="form-control" value="<?php echo $row2['mark_total'];?>"  name="mark_total_<?php echo $row['subject_id'];?>" id="mark_total_<?php echo $row['subject_id'];?>" readonly="true"></td>
								<td class="tg-yw4l">
									<select  class="class_score form-control"  name="effort_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['effort_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['effort_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['effort_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['effort_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['effort_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
									</td>
								<td class="tg-yw4l">
									<select  class="class_score form-control" name="attitude_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['attitude_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['attitude_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['attitude_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['attitude_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['attitude_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control" name="attentiveness_mark_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['attentiveness_mark'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['attentiveness_mark'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['attentiveness_mark'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['attentiveness_mark'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['attentiveness_mark'] =='E'){ echo "selected";}?>>E</option>
									
									</select>	
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control"  name="assignment_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['assignment_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['assignment_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['assignment_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['assignment_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['assignment_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control" name="interest_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['interest_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['interest_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['interest_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['interest_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['interest_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td class="tg-yw4l">
									<select class="class_score form-control"  name="willingness_marks_<?php echo $row['subject_id'];?>" >
										<option value="A" <?php if($row2['willingness_marks'] =='A'){ echo "selected";}?>>A</option>
										<option value="B" <?php if($row2['willingness_marks'] =='B'){ echo "selected";}?>>B</option>
										<option value="C" <?php if($row2['willingness_marks'] =='C'){ echo "selected";}?>>C</option>
										<option value="D" <?php if($row2['willingness_marks'] =='D'){ echo "selected";}?>>D</option>
										<option value="E" <?php if($row2['willingness_marks'] =='E'){ echo "selected";}?>>E</option>
									</select>
								</td>
								<td width = '13%'>
								
									<select class="class_score form-control" name="teacher_<?php echo $row['subject_id'];?>"  required>
                                				<option value=""><?php echo 'select_teacher';?></option>
											<?php 
											$teachers = $this->db->get('teacher')->result_array();
                                					foreach($teachers as $teacher):
                                					?>
                                    					<option value="<?php echo $teacher['name'];?>"
												 <?php if($row2['teacher'] == $teacher['name']) echo 'selected';?>>
													   <?php echo $teacher['name'];?>
												</option>
                                					<?php
                                					endforeach;
                                					?>
                         				</select>
								</td>
								
								<input type="hidden" name="mark_id_<?php echo $row['subject_id'];?>" value="<?php echo $row2['mark_id'];?>" />
                                   
                              		<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
                             		 	<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
                              		<input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
                              		<input type="hidden" name="session_year" value="<?php echo $get_system_settings[17]['description'];?>" />
                              		<input type="hidden" name="operation" value="update" />
							</tr>

							<?php 
			   					$verify_data = array("subject_id"=>$row['subject_id'],'exam_id' => $exam_id ,'class_id' => $class_id , 
								   'session_year'=>$get_system_settings[17]['description']);
					   			$query_subavg = $this->db->get_where('subavg0' , $verify_data);
   
					   			if($query_subavg->num_rows() < 1){
					   				$this->db->insert('subavg0' , $verify_data);
							   	}
								$q = $total = 0;
					   			
								foreach($avgtmk as $totmk){
									if ((floatval($totmk['mark_obtained']))!= 0){
										$q++;
										$total +=($totmk['ca_marks']+$totmk['mark_obtained']);
									}
								}
								$subavg =  $total/ $q;
								if ($subavg > 0){
									$data['subject_average'] = round($subavg,1);}
								else {
									$data['subject_average'] = 0;}
   
								$this->db->where('subject_id',$row['subject_id']);
								$this->db->where('class_id', $class_id);
					   			$this->db->where('exam_id', $exam_id);
					   			$this->db->where('session_year', $get_system_settings[17]['description']);
					   			$this->db->update('subavg0', $data);
			   				?>
                            
                         	<?php
							endforeach;
						 endforeach;
						?>
                     </tbody>
			   </table>
			<!-- Individual Total Average -->
			<?php 
					
					if ($class_id > 19 && $class_id < 23 ){
						$verify_datas = array('exam_id' => $exam_id,'class_id' => 101, 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
					 }
					 elseif ($class_id > 22 && $class_id < 26 ){
						$verify_datas = array('exam_id' => $exam_id ,'class_id' => 102 , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
					 }
					 elseif ($class_id > 25 && $class_id < 29 ){
						$verify_datas = array('exam_id' => $exam_id ,'class_id' => 103 , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
					 }
					$query_Remark = $this->db->get_where('average0' , $verify_datas);

					if($query_Remark->num_rows() < 1){
					$this->db->insert('average0' , $verify_datas);
							}

					$tscores = $this->db->get_where('mark0',array('exam_id' => $exam_id ,'class_id' => $class_id , 
					'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']))->result_array();
					$m = 0;
					foreach($tscores as $scores){
						if (($scores['mark_obtained']) != 0){
							$m++;
							$tot = $scores['ca_marks']+$scores['mark_obtained'];
							$total_markss +=$tot;}
					}

					$stavg = $total_markss / $m;
					
					if ($total_markss == ''){
						$datas['total_average'] = 0;
						$datas['total_score'] = 0;
					}

					if ($total_markss > 0){
						$datas['total_average'] = round($stavg,2);
						$datas['total_score'] = $total_markss;
					}

					if ($class_id > 19 && $class_id < 23 ){
						$this->db->where('class_id', 101);
					 }
					 elseif ($class_id > 22 && $class_id < 26 ){
						$this->db->where('class_id', 102);
					 }
					 elseif ($class_id > 25 && $class_id < 29 ){
						$this->db->where('class_id', 103);
					 }
        				$this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('session_year', $get_system_settings[17]['description']);
					$this->db->update('average0', $datas);
				?>
			   <hr>
		 
						
<!-- Primary -->
				<?php } else if (strpos($class_type, 'primary') !== false || strpos($class_type, 'pri') !== false){ ?>

			<?php $test = $this->db->get_where('class', array('class_id' => $class_id ))->result_array(); 
				if($test[0]['teacher_id'] == $this->session->userdata('login_user_id')){
			?>

					<?php 
						////CREATE THE STRAND ENTRY ONLY IF NOT EXISTS////
						$strands	= $this->db->get('strand')->result_array();
						foreach($strands as $rows):
							$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id ,'strand_id' => $rows['strand_id'] , 
												'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
							$query = $this->db->get_where('strands0' , $verify_data);

							if($query->num_rows() < 1)
								$this->db->insert('strands0' , $verify_data);
						 endforeach;
					?>

					<?php 
						////CREATE THE MARK ENTRY ONLY IF NOT EXISTS////
						$students	=	$this->crud_model->get_subjects_by_class1($class_id);
						foreach($students as $row):
							$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id ,'subject_id' => $row['subject_id'] , 
												'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
							$query = $this->db->get_where('mark0_pri' , $verify_data);
							
							if($query->num_rows() < 1)
								$this->db->insert('mark0_pri' , $verify_data);
						 endforeach;
					?>

					<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width:auto; display: inline-block;">
						<tbody>
						<tr><td colspan="17"></td>
							<td colspan="24" style="text-align: center;">SCORES</td>
							
						</tr>
						<tr>
							<td></td>
                                   <td colspan="16">SUBJECTS</td>
                                   <td colspan="3" style="text-align: center;">MARKS<br>OBTAINABLE</td>
							<td colspan="3" style="text-align: center;">C.A 1 [20]</td>
							<td colspan="3" style="text-align: center;">CW [10]</td>
							<td colspan="5" style="text-align: center;">TOTAL C.A<br>[30]</td>
							
							
							
						</tr>
						 <?php 
						$i=0;
						foreach($students as $row):
							$i++;
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$get_system_settings[17]['description']);
														
							$query = $this->db->get_where('mark0_pri' , $verify_data);							 
							$marks	=	$query->result_array();
							foreach($marks as $row2):
							?>
								<?php if ($i == 2){
									$strand = $this->db->get('strand')->result_array();
									foreach($strand as $rowz):
										$strands = $this->db->get_where('strands0', array('exam_id' => $exam_id ,
																	'class_id' => $class_id ,
																	'strand_id' => $rowz['strand_id'] , 
																	'student_id' => $student_id,
																	'session_year'=>$get_system_settings[17]['description']))->result_array();
										foreach($strands as $rows):
											
								?>
											<tr>
												<td><?php echo '*'; ?></td>
												<td colspan="16"><?php echo  $this->crud_model->get_subject_name_by_ids('strand',$rows['strand_id']);?></td>
												<?php if ($rowz['strand_id'] == 4)
													{echo '<td colspan="3" style="text-align:center">20</td>';}
													else { echo '<td colspan="3" style="text-align:center">10</td>';} ?>
												<td colspan="3"><input type="text" class="class_score form-control" value="<?php echo $rows['ca_1'];?>" name="ca_1s_<?php echo $rowz['strand_id'];?>" id="ca_1s_<?php echo $rowz['strand_id'];?>" onchange="ca_1s('<?php echo $rowz['strand_id'];?>')" ></td>
												<td colspan="3"><input type="text" class="class_score3 form-control" value="<?php echo $rows['ca_2'];?>" name="ca_2s_<?php echo $rowz['strand_id'];?>" id="ca_2s_<?php echo $rowz['strand_id'];?>" onchange="ca_2s('<?php echo $rowz['strand_id'];?>')" ></td>
												<td colspan="5"><input type="text" class="class_score4 form-control" value="<?php echo $rows['ca_marks'];?>" name="ca_markss_<?php echo $rowz['strand_id'];?>" id="ca_markss_<?php echo $rowz['strand_id'];?>" readonly="true" ></td>
											</tr>
											
											<input type="hidden" name="strands_id_<?php echo $rowz['strand_id'];?>" value="<?php echo $rows['strands_id'];?>" />
									<?php //echo $rowz['strand_id'];
										endforeach;
									endforeach; } 
									?>
									<tr>
										<td><?php echo $i; ?></td>
                                                  <td colspan="16"><?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']);?></td>
                                                  <td colspan="3" style="text-align:center">30</td>
										<td colspan="3"><input type="text" class="class_score form-control" value="<?php echo $row2['ca_1'];?>" name="ca_1_<?php echo $row['subject_id'];?>" id="ca_1_<?php echo $row['subject_id'];?>" onchange="ca_1('<?php echo $row['subject_id'];?>')" ></td>
										<td colspan="3"><input type="text" class="class_score3 form-control" value="<?php echo $row2['ca_2'];?>" name="ca_2_<?php echo $row['subject_id'];?>" id="ca_2_<?php echo $row['subject_id'];?>" onchange="ca_2('<?php echo $row['subject_id'];?>')" ></td>
										<td colspan="5"><input type="text" class="class_score4 form-control" value="<?php echo $row2['ca_marks'];?>" name="ca_marks_<?php echo $row['subject_id'];?>" id="ca_marks_<?php echo $row['subject_id'];?>"readonly="true" ></td>
									</tr>
									<input type="hidden" name="mark_id_<?php echo $row['subject_id'];?>" value="<?php echo $row2['mark_id'];?>" />
							<?php 
							
							endforeach;
						 endforeach;
						 
						 ?>
						
						<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
						<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
						<input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
						<input type="hidden" name="class_types" value="primary" />
						<input type="hidden" name="session_year" value="<?php echo $get_system_settings[17]['description'];?>" />
						<input type="hidden" name="operation" value="update" />
						
				</tbody>
				</table>

	
			<!--COMMENT AREA-->
			<table style="width:100%; vertical-align: bottom;">
			<?php 
				$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
				$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments0' , $verify_data);
							
				if($query_comments->num_rows() < 1){
						$this->db->insert('comments0' , $verify_data);
								}
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th>Teacher's Name</th>
						<th>Head Teacher's Name</th>
						<th>Attendance</th>
					</tr>
					<tr>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['TeacherName'];?>" name="TeacherName"></td>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['HeadTeacherName'];?>" name="HeadTeacherName"></td>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['Attendances'];?>" name="Attendances">Example: Attendance / No of times school opened</td>
						<input type="hidden" name="teach_sign" value="<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg' ?>" />
					</tr>
					
					<!--<tr>
						<th>Teacher's Comment</th>
						<th>Head Teacher's Comment</th>
					</tr>
					<tr>
						<td><textarea class="class_score form-control" value="<?php //echo $row['TeacherComment'];?>" cols="30" name = "TeacherComment"><?php //echo $row['TeacherComment'];?></textarea></td>
						<td><textarea class="class_score form-control" value="<?php //echo $row['HeadTeacherComment'];?>" cols="30" name = "HeadTeacherComment"><?php //echo $row['HeadTeacherComment'];?></textarea></td>
					</tr> -->
				<?php endforeach; ?>

			</table>
				<?php } ?>

<!-- Nursery -->
<?php } else if (strpos($class_type, 'nursery 3') !== false){ ?>
		
	<?php $test = $this->db->get_where('class', array('class_id' => $class_id ))->result_array(); 
			if($test[0]['teacher_id'] == $this->session->userdata('login_user_id')){
	?>
          <table cellpadding="0" cellspacing="0" border="0" class="tg" style="width:auto">
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_mark0 = $this->db->get_where('mark0_nur' , $verify_data);
							
				if($query_mark0->num_rows() < 1){
						$this->db->insert('mark0_nur' , $verify_data);
								}
				$row2 = $query_mark0->result_array();
			?>
			
			<tbody>
				<tr>
					<th colspan="12"><span>SUBJECTS</span></th>
					<th><span>Exceeding</span></th>
					<th><span>Meeting <br /> Exceptations</span></th>
					<th><span>Emerging <br /> Exceptations</span></th>
					<th><span>Not <br /> Assessed</span></th>
                    </tr>
                    <tr>
					<td colspan="12"><span>LITERACY</span></td>
						<td><input type ="radio" name="literacy" value="A" <?php if($row2[0]['effort_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="literacy" value="B" <?php if($row2[0]['effort_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="literacy" value="C" <?php if($row2[0]['effort_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="literacy" value="D" <?php if($row2[0]['effort_marks'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>NUMERACY</span></td>
						<td><input type ="radio" name="numeracy" value="A" <?php if($row2[0]['attitude_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="numeracy" value="B" <?php if($row2[0]['attitude_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="numeracy" value="C" <?php if($row2[0]['attitude_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="numeracy" value="D" <?php if($row2[0]['attitude_marks'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>KUTW</span></td>
						<td><input type ="radio" name="kutw" value="A" <?php if($row2[0]['attentiveness_mark'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="kutw" value="B" <?php if($row2[0]['attentiveness_mark'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="kutw" value="C" <?php if($row2[0]['attentiveness_mark'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="kutw" value="D" <?php if($row2[0]['attentiveness_mark'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>PSHE</span></td>
						<td><input type ="radio" name="phse" value="A" <?php if($row2[0]['assignment_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="phse" value="B" <?php if($row2[0]['assignment_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="phse" value="C" <?php if($row2[0]['assignment_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="phse" value="D" <?php if($row2[0]['assignment_marks'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>RHYME</span></td>
						<td><input type ="radio" name="rhyme" value="A" <?php if($row2[0]['interest_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="rhyme" value="B" <?php if($row2[0]['interest_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="rhyme" value="C" <?php if($row2[0]['interest_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="rhyme" value="D" <?php if($row2[0]['interest_marks'] =='D'){ echo "checked";} ?>></td>
				</tr>
                    <tr>
					<td colspan="12"><span>CREATIVE ART</span></td>
						<td><input type ="radio" name="creative" value="A" <?php if($row2[0]['willingness_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="creative" value="B" <?php if($row2[0]['willingness_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="creative" value="C" <?php if($row2[0]['willingness_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="creative" value="D" <?php if($row2[0]['willingness_marks'] =='D'){ echo "checked";} ?>></td>
				</tr>
				<tr>
					<td colspan="12"><span>SCIENCE</span></td>
						<td><input type ="radio" name="science" value="A" <?php if($row2[0]['science'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="science" value="B" <?php if($row2[0]['science'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="science" value="C" <?php if($row2[0]['science'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="science" value="D" <?php if($row2[0]['science'] =='D'){ echo "checked";} ?>></td>
				</tr>
				<tr>
					<td colspan="12"><span>HANDWRITING</span></td>
						<td><input type ="radio" name="hand_writing" value="A" <?php if($row2[0]['hand_writing'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="hand_writing" value="B" <?php if($row2[0]['hand_writing'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="hand_writing" value="C" <?php if($row2[0]['hand_writing'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="hand_writing" value="D" <?php if($row2[0]['hand_writing'] =='D'){ echo "checked";} ?>></td>
				</tr>
			</tbody>
          </table>

          <hr>
			
		<!--COMMENT AREA-->
		<table style="width:100%; vertical-align: bottom;">
			<?php 
				$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
				$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments0' , $verify_data);
							
				if($query_comments->num_rows() < 1){
						$this->db->insert('comments0' , $verify_data);
								}
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th>Teacher's Name</th>
					</tr>
					<tr>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['TeacherName'];?>" name="TeacherName"></td>
						<input type="hidden" name="teach_sign" value="<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg' ?>" />
					</tr>
				<?php endforeach; ?>

			</table>
			<?php } ?>

		<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
        	<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
        	<input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
        	<input type="hidden" name="session_year" value="<?php echo $get_system_settings[17]['description'];?>" />
        	<input type="hidden" name="operation" value="update" />
        	<input type="hidden" name="class_types" value="nursery 3" />

	<?php } else if (strpos($class_type, 'nursery 2') !== false) { ?>
		
	<?php $test = $this->db->get_where('class', array('class_id' => $class_id ))->result_array(); 
			if($test[0]['teacher_id'] == $this->session->userdata('login_user_id')){
	?>
          <table cellpadding="0" cellspacing="0" border="0" class="tg" style="width:auto">
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_mark0 = $this->db->get_where('mark0_nur' , $verify_data);
							
				if($query_mark0->num_rows() < 1){
						$this->db->insert('mark0_nur' , $verify_data);
								}
				$row2 = $query_mark0->result_array();
			?>
			
			<tbody>
				<tr>
					<th colspan="12"><span>SUBJECTS</span></th>
					<th><span>Exceeding <br /> Expectation</span></th>
					<th><span>Meeting <br /> Expectation</span></th>
					<th><span>Emerging <br /> Expectation</span></th>
					<th><span>Not <br /> Assessed</span></th>
                    </tr>
                    <tr>
					<td colspan="12"><span>LITERACY</span></td>
						<td><input type ="radio" name="literacy" value="A" <?php if($row2[0]['effort_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="literacy" value="B" <?php if($row2[0]['effort_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="literacy" value="C" <?php if($row2[0]['effort_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="literacy" value="D" <?php if($row2[0]['effort_marks'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>NUMERACY</span></td>
						<td><input type ="radio" name="numeracy" value="A" <?php if($row2[0]['attitude_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="numeracy" value="B" <?php if($row2[0]['attitude_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="numeracy" value="C" <?php if($row2[0]['attitude_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="numeracy" value="D" <?php if($row2[0]['attitude_marks'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>KUTW</span></td>
						<td><input type ="radio" name="kutw" value="A" <?php if($row2[0]['attentiveness_mark'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="kutw" value="B" <?php if($row2[0]['attentiveness_mark'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="kutw" value="C" <?php if($row2[0]['attentiveness_mark'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="kutw" value="D" <?php if($row2[0]['attentiveness_mark'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>PSHE</span></td>
						<td><input type ="radio" name="phse" value="A" <?php if($row2[0]['assignment_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="phse" value="B" <?php if($row2[0]['assignment_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="phse" value="C" <?php if($row2[0]['assignment_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="phse" value="D" <?php if($row2[0]['assignment_marks'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>RHYME</span></td>
						<td><input type ="radio" name="rhyme" value="A" <?php if($row2[0]['interest_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="rhyme" value="B" <?php if($row2[0]['interest_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="rhyme" value="C" <?php if($row2[0]['interest_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="rhyme" value="D" <?php if($row2[0]['interest_marks'] =='D'){ echo "checked";} ?>></td>
				</tr>
                    <tr>
					<td colspan="12"><span>CREATIVE ART</span></td>
						<td><input type ="radio" name="creative" value="A" <?php if($row2[0]['willingness_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="creative" value="B" <?php if($row2[0]['willingness_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="creative" value="C" <?php if($row2[0]['willingness_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="creative" value="D" <?php if($row2[0]['willingness_marks'] =='D'){ echo "checked";} ?>></td>
				</tr>
				<tr>
					<td colspan="12"><span>HANDWRITING</span></td>
						<td><input type ="radio" name="hand_writing" value="A" <?php if($row2[0]['hand_writing'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="hand_writing" value="B" <?php if($row2[0]['hand_writing'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="hand_writing" value="C" <?php if($row2[0]['hand_writing'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="hand_writing" value="D" <?php if($row2[0]['hand_writing'] =='D'){ echo "checked";} ?>></td>
				</tr>
				<tr>
					<td colspan="12"><span>WORK HABIT</span></td>
						<td><input type ="radio" name="work_habbit" value="A" <?php if($row2[0]['work_habbit'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="work_habbit" value="B" <?php if($row2[0]['work_habbit'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="work_habbit" value="C" <?php if($row2[0]['work_habbit'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="work_habbit" value="D" <?php if($row2[0]['work_habbit'] =='D'){ echo "checked";} ?>></td>
				</tr>
			</tbody>
          </table>

          <hr>
			
		<!--COMMENT AREA-->
		<table style="width:100%; vertical-align: bottom;">
			<?php 
				$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
				$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments0' , $verify_data);
							
				if($query_comments->num_rows() < 1){
						$this->db->insert('comments0' , $verify_data);
								}
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th>Teacher's Name</th>
					</tr>
					<tr>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['TeacherName'];?>" name="TeacherName"></td>
						<input type="hidden" name="teach_sign" value="<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg' ?>" />
					</tr>
				<?php endforeach; ?>

			</table>
			<?php } ?>

		<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
        	<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
        	<input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
        	<input type="hidden" name="session_year" value="<?php echo $get_system_settings[17]['description'];?>" />
        	<input type="hidden" name="operation" value="update" />
        	<input type="hidden" name="class_types" value="nursery 2" />

<?php } else if (strpos($class_type, 'nursery 1') !== false) { ?>
		
	<?php $test = $this->db->get_where('class', array('class_id' => $class_id ))->result_array(); 
			if($test[0]['teacher_id'] == $this->session->userdata('login_user_id')){
	?>
          <table cellpadding="0" cellspacing="0" border="0" class="tg" style="width:auto">
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_mark0 = $this->db->get_where('mark0_nur' , $verify_data);
							
				if($query_mark0->num_rows() < 1){
						$this->db->insert('mark0_nur' , $verify_data);
								}
				$row2 = $query_mark0->result_array();
			?>
			
			<tbody>
				<tr>
					<th colspan="12"><span>SUBJECTS</span></th>
					<th><span>Exceeding <br /> Expectation</span></th>
					<th><span>Meeting <br /> Expectation</span></th>
					<th><span>Emerging <br /> Expectation</span></th>
					<th><span>Not <br /> Assessed</span></th>
                    </tr>
                    <tr>
					<td colspan="12"><span>LITERACY</span></td>
						<td><input type ="radio" name="literacy" value="A" <?php if($row2[0]['effort_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="literacy" value="B" <?php if($row2[0]['effort_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="literacy" value="C" <?php if($row2[0]['effort_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="literacy" value="D" <?php if($row2[0]['effort_marks'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>NUMERACY</span></td>
						<td><input type ="radio" name="numeracy" value="A" <?php if($row2[0]['attitude_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="numeracy" value="B" <?php if($row2[0]['attitude_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="numeracy" value="C" <?php if($row2[0]['attitude_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="numeracy" value="D" <?php if($row2[0]['attitude_marks'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>KUTW</span></td>
						<td><input type ="radio" name="kutw" value="A" <?php if($row2[0]['attentiveness_mark'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="kutw" value="B" <?php if($row2[0]['attentiveness_mark'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="kutw" value="C" <?php if($row2[0]['attentiveness_mark'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="kutw" value="D" <?php if($row2[0]['attentiveness_mark'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>PSHE</span></td>
						<td><input type ="radio" name="phse" value="A" <?php if($row2[0]['assignment_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="phse" value="B" <?php if($row2[0]['assignment_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="phse" value="C" <?php if($row2[0]['assignment_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="phse" value="D" <?php if($row2[0]['assignment_marks'] =='D'){ echo "checked";} ?>></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>RHYME</span></td>
						<td><input type ="radio" name="rhyme" value="A" <?php if($row2[0]['interest_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="rhyme" value="B" <?php if($row2[0]['interest_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="rhyme" value="C" <?php if($row2[0]['interest_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="rhyme" value="D" <?php if($row2[0]['interest_marks'] =='D'){ echo "checked";} ?>></td>
				</tr>
                    <tr>
					<td colspan="12"><span>CREATIVE ART</span></td>
						<td><input type ="radio" name="creative" value="A" <?php if($row2[0]['willingness_marks'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="creative" value="B" <?php if($row2[0]['willingness_marks'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="creative" value="C" <?php if($row2[0]['willingness_marks'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="creative" value="D" <?php if($row2[0]['willingness_marks'] =='D'){ echo "checked";} ?>></td>
				</tr>
				<tr>
					<td colspan="12"><span>WORK HABIT</span></td>
						<td><input type ="radio" name="work_habbit" value="A" <?php if($row2[0]['work_habbit'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="work_habbit" value="B" <?php if($row2[0]['work_habbit'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="work_habbit" value="C" <?php if($row2[0]['work_habbit'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="work_habbit" value="D" <?php if($row2[0]['work_habbit'] =='D'){ echo "checked";} ?>></td>
				</tr>
				<tr>
					<td colspan="12"><span>COMMUNICATION SKILLS</span></td>
						<td><input type ="radio" name="comm_skills" value="A" <?php if($row2[0]['comm_skills'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="comm_skills" value="B" <?php if($row2[0]['comm_skills'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="comm_skills" value="C" <?php if($row2[0]['comm_skills'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="comm_skills" value="D" <?php if($row2[0]['comm_skills'] =='D'){ echo "checked";} ?>></td>
				</tr>
				<tr>
					<td colspan="12"><span>GROSS MOTOR SKILLS</span></td>
						<td><input type ="radio" name="gms" value="A" <?php if($row2[0]['gms'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="gms" value="B" <?php if($row2[0]['gms'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="gms" value="C" <?php if($row2[0]['gms'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="gms" value="D" <?php if($row2[0]['gms'] =='D'){ echo "checked";} ?>></td>
				</tr>
				<tr>
					<td colspan="12"><span>FINE MOTOR SKILLS</span></td>
						<td><input type ="radio" name="fms" value="A" <?php if($row2[0]['fms'] =='A'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="fms" value="B" <?php if($row2[0]['fms'] =='B'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="fms" value="C" <?php if($row2[0]['fms'] =='C'){ echo "checked";} ?>></td>
						<td><input type ="radio" name="fms" value="D" <?php if($row2[0]['fms'] =='D'){ echo "checked";} ?>></td>
				</tr>
			</tbody>
          </table>

          <hr>
			
		<!--COMMENT AREA-->
		<table style="width:100%; vertical-align: bottom;">
			<?php 
				$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
				$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments0' , $verify_data);
							
				if($query_comments->num_rows() < 1){
						$this->db->insert('comments0' , $verify_data);
								}
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th>Teacher's Name</th>
					</tr>
					<tr>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['TeacherName'];?>" name="TeacherName"></td>
					</tr>
				<?php endforeach; ?>

			</table>
			<?php } ?>
			
		<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
        	<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
        	<input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
        	<input type="hidden" name="session_year" value="<?php echo $get_system_settings[17]['description'];?>" />
        	<input type="hidden" name="operation" value="update" />
		   <input type="hidden" name="class_types" value="nursery 1" />
		   

		<?php } else if (strpos($class_type, 'toddler') !== false){ ?>
		
		<?php $test = $this->db->get_where('class', array('class_id' => $class_id ))->result_array(); 
				if($test[0]['teacher_id'] == $this->session->userdata('login_user_id')){
		?>
			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width:auto">
				<?php 
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
					$query_mark0 = $this->db->get_where('mark0_nur' , $verify_data);
								
					if($query_mark0->num_rows() < 1){
							$this->db->insert('mark0_nur' , $verify_data);
									}
					$row2 = $query_mark0->result_array();
				?>
				
				<tbody>
					<tr>
						<th colspan="12"><span>SUBJECTS</span></th>
						<th><span>Exceeding <br /> Expectation</span></th>
						<th><span>Meeting <br /> Expectation</span></th>
						<th><span>Emerging <br /> Expectation</span></th>
						<th><span>Not <br /> Assessed</span></th>
                    	</tr>
                    	<tr>
						<td colspan="12"><span>NUMERACY</span></td>
							<td><input type ="radio" name="numeracy" value="A" <?php if($row2[0]['attitude_marks'] =='A'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="numeracy" value="B" <?php if($row2[0]['attitude_marks'] =='B'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="numeracy" value="C" <?php if($row2[0]['attitude_marks'] =='C'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="numeracy" value="D" <?php if($row2[0]['attitude_marks'] =='D'){ echo "checked";} ?>></td>
                    	</tr>
                    	<tr>
						<td colspan="12"><span>KNOWLEDGE AND UNDERSTANDING OF THE WORLD (KUTW)</span></td>
							<td><input type ="radio" name="kutw" value="A" <?php if($row2[0]['attentiveness_mark'] =='A'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="kutw" value="B" <?php if($row2[0]['attentiveness_mark'] =='B'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="kutw" value="C" <?php if($row2[0]['attentiveness_mark'] =='C'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="kutw" value="D" <?php if($row2[0]['attentiveness_mark'] =='D'){ echo "checked";} ?>></td>
                    	</tr>
                    	<tr>
						<td colspan="12"><span>PERSONAL, SOCIAL AND HEALTH EDUCATION (PSHE)</span></td>
							<td><input type ="radio" name="phse" value="A" <?php if($row2[0]['assignment_marks'] =='A'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="phse" value="B" <?php if($row2[0]['assignment_marks'] =='B'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="phse" value="C" <?php if($row2[0]['assignment_marks'] =='C'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="phse" value="D" <?php if($row2[0]['assignment_marks'] =='D'){ echo "checked";} ?>></td>
                    	</tr>
                    	<tr>
						<td colspan="12"><span>RHYME</span></td>
							<td><input type ="radio" name="rhyme" value="A" <?php if($row2[0]['interest_marks'] =='A'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="rhyme" value="B" <?php if($row2[0]['interest_marks'] =='B'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="rhyme" value="C" <?php if($row2[0]['interest_marks'] =='C'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="rhyme" value="D" <?php if($row2[0]['interest_marks'] =='D'){ echo "checked";} ?>></td>
					</tr>
                    	<tr>
						<td colspan="12"><span>SOCIAL SKILLS</span></td>
							<td><input type ="radio" name="social_skills" value="A" <?php if($row2[0]['social_skills'] =='A'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="social_skills" value="B" <?php if($row2[0]['social_skills'] =='B'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="social_skills" value="C" <?php if($row2[0]['social_skills'] =='C'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="social_skills" value="D" <?php if($row2[0]['social_skills'] =='D'){ echo "checked";} ?>></td>
					</tr>
					<tr>
						<td colspan="12"><span>COMMUNICATION SKILLS</span></td>
							<td><input type ="radio" name="comm_skills" value="A" <?php if($row2[0]['comm_skills'] =='A'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="comm_skills" value="B" <?php if($row2[0]['comm_skills'] =='B'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="comm_skills" value="C" <?php if($row2[0]['comm_skills'] =='C'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="comm_skills" value="D" <?php if($row2[0]['comm_skills'] =='D'){ echo "checked";} ?>></td>
					</tr>
					<tr>
						<td colspan="12"><span>GROSS MOTOR SKILLS</span></td>
							<td><input type ="radio" name="gms" value="A" <?php if($row2[0]['gms'] =='A'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="gms" value="B" <?php if($row2[0]['gms'] =='B'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="gms" value="C" <?php if($row2[0]['gms'] =='C'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="gms" value="D" <?php if($row2[0]['gms'] =='D'){ echo "checked";} ?>></td>
					</tr>
					<tr>
						<td colspan="12"><span>FINE MOTOR SKILLS</span></td>
							<td><input type ="radio" name="fms" value="A" <?php if($row2[0]['fms'] =='A'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="fms" value="B" <?php if($row2[0]['fms'] =='B'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="fms" value="C" <?php if($row2[0]['fms'] =='C'){ echo "checked";} ?>></td>
							<td><input type ="radio" name="fms" value="D" <?php if($row2[0]['fms'] =='D'){ echo "checked";} ?>></td>
					</tr>
				</tbody>
			</table>
			<hr>
				
			<!--COMMENT AREA-->
			<table style="width:100%; vertical-align: bottom;">
				<?php 
					$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
					$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();
					
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
					$query_comments = $this->db->get_where('comments0' , $verify_data);
								
					if($query_comments->num_rows() < 1){
							$this->db->insert('comments0' , $verify_data);
									}
					$student_comments = $query_comments->result_array();
					foreach($student_comments as $row):	
	
				?>
				
						<tr>
							<th>Teacher's Name</th>
						</tr>
						<tr>
							<td><input class="class_score6 form-control" type="text" value="<?php echo $row['TeacherName'];?>" name="TeacherName"></td>
							<input type="hidden" name="teach_sign" value="<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg' ?>" />
						</tr>
					<?php endforeach; ?>
	
				</table>
				<?php } ?>
	
			<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
			   <input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
			   <input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
			   <input type="hidden" name="session_year" value="<?php echo $get_system_settings[17]['description'];?>" />
			   <input type="hidden" name="operation" value="update" />
			   <input type="hidden" name="class_types" value="toddler" />
		<?php } ?>


		<?php if($class_id == ''):?>
			<div class="alert alert-danger" align="center">Add Subject To Selected Class First&nbsp;&nbsp;
				<a href="<?php echo base_url();?>index.php?teacher/subject/"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>
			</div>
		<?php endif;?>
		<h5 id="error_message"  align="center" style="color: red;display: none;margin-left: 50px;"><strong style="color:#FF0000">CA must be less than or equal to 20 and test score must be less than or equal to 10</strong></h5>
		

			<?php 
				$vacation_date = $this->crud_model->get_class_vacation_date0($class_id,$exam_id,$get_system_settings[17]['description']);
				
			?>

			<div class="text-center">
				<input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
     			<button type="submit" class="btn btn-sm btn-icon icon-left btn-orange"><i class="entypo-plus"></i><?php echo get_phrase('update_marks');?></button>
			</div>
		
                 
		<?php echo form_close();?>
      </div>
    <?php endif;?>


<?php if($exam_id == 0 && $class_id == 0 && $student_id == 0 ):?>
	<div class="x_panel tablu" >
	    <div class="alert alert-danger" align="center">No Informtion to be displayed right now, please select TERM, CLASS AND STUDENT</div>
             
            <!----TABLE LISTING ENDS-->
   </div>      
<?php endif;?>
   <!-----  add code on 30 june 2018 ---->   
 
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  

<script type="text/javascript">
	
	$( function() {
		$( "#datepicker,#datepicker2" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true
			
		});
	});
  function show_students(class_id)
  {
      for(i=0;i<=50;i++)
      {

          try
          {
              document.getElementById('student_id_'+i).style.display = 'none' ;
	  		  document.getElementById('student_id_'+i).setAttribute("name" , "temp");
          }
          catch(err){}
      }
      if (class_id == "") {
        class_id = "0";
      }
      document.getElementById('student_id_'+class_id).style.display = 'block' ;
	  document.getElementById('student_id_'+class_id).setAttribute("name" , "student_id");
      var student_id = $(".student_id");
      for(var i = 0; i < student_id.length; i++)
        student_id[i].selected = "";
  }

// SS 3
function class_score_change01(sub_id) {
  var class_scores = document.getElementsByClassName('class_score01');
   for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
     if (value > 100) {
        class_scores[i].value = 0;
        $('#error_message').show();
      }
    }
    var mark_obtained = $("#mark_obtained_"+sub_id).val();
    var total = (mark_obtained);
    $("#mark_total_"+sub_id).val(total);
  }
function class_score_change() {
  var class_scores = document.getElementsByClassName('class_score');
   for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
     if (value > 10) {
        class_scores[i].value = 0;
        $('#error_message').show();
      }
    }
  }
function class_score_change1(sub_id) {
  var class_scores = document.getElementsByClassName('class_score');
   for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
     if (value > 20) {
        class_scores[i].value = 0;
        $('#error_message').show();
      }
    }
    var ca_mark = $("#ca_marks_"+sub_id).val();
    var mark_obtained = $("#mark_obtained_"+sub_id).val();
    var total = parseFloat(ca_mark)+parseFloat(mark_obtained);
    console.log(ca_mark,mark_obtained);
    $("#mark_total_"+sub_id).val(total);
  }
function class_score_change2(sub_id) {
  var class_scores = document.getElementsByClassName('class_score2');
   for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
     if (value > 10) {
        class_scores[i].value = 0;
        $('#error_message').show();
      }
    }
    var ca_mark = $("#ca_marks_"+sub_id).val();
    var mark_obtained = $("#mark_obtained_"+sub_id).val();
    var total = parseFloat(ca_mark)+parseFloat(mark_obtained);
    $("#mark_total_"+sub_id).val(total);
  }
 function class_score_change1_jss(sub_id) {
  var class_scores = document.getElementsByClassName('class_score');
   for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
     if (value > 25) {
        class_scores[i].value = 0;
        $('#error_message').show();
        $('#error_message').html('<strong style="color:#FF0000">CA must be less than or equal to 25 and test score must be less than or equal to 15</strong>');
      }
    }
    var ca_mark = $("#ca_marks_"+sub_id).val();
    var mark_obtained = $("#mark_obtained_"+sub_id).val();
    var total = parseFloat(ca_mark)+parseFloat(mark_obtained);
    console.log(ca_mark,mark_obtained);
    $("#mark_total_"+sub_id).val(total);
  }
function class_score_change2_jss(sub_id) {
  var class_scores = document.getElementsByClassName('class_score2');
   for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
     if (value > 15) {
        class_scores[i].value = 0;
        $('#error_message').show();
        $('#error_message').html('<strong style="color:#FF0000">CA must be less than or equal to 25 and test score must be less than or equal to 15</strong>');
      }
    }
    var ca_mark = $("#ca_marks_"+sub_id).val();
    var mark_obtained = $("#mark_obtained_"+sub_id).val();
    var total = parseFloat(ca_mark)+parseFloat(mark_obtained);
    $("#mark_total_"+sub_id).val(total);
  }

  function exam_score_change() {
    var exam_scores = document.getElementsByClassName('exam_score');
    for (var i = exam_scores.length - 1; i >= 0; i--) {
      var value = exam_scores[i].value;
      if (value > 70) {
        exam_scores[i].value = 0;
        $('#error_message').show();
      }
    }
  }
	function ca_1(sub_id){
		 $('#error_message').hide();
		var values = $("#ca_1_"+sub_id).val();
		if (values > 20) {
			$("#ca_1_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">Please enter CA1 score must be less than or equal to 20.  </strong>');
		}else{
			var ca1 = $("#ca_1_"+sub_id).val();
			var ca2 = $("#ca_2_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2);
			$("#ca_marks_"+sub_id).val(totl);
		}
	}
	function ca_2(sub_id){
		 $('#error_message').hide();
		var values = $("#ca_2_"+sub_id).val();
		if (values > 10) {
			$("#ca_2_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">Please enter CA2 score must be less than or equal to 10.  </strong>');
		}else{
			var ca1 = $("#ca_1_"+sub_id).val();
			var ca2 = $("#ca_2_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2);
			$("#ca_marks_"+sub_id).val(totl);
		}
	}

	//// STRAND ////

	function ca_1s(sub_id){
		 $('#error_message').hide();
		var values = $("#ca_1s_"+sub_id).val();
		if (values > 20) {
			$("#ca_1s_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">CA1 score must be less than or equal to 20.  </strong>');
		}else{
			var ca1 = $("#ca_1s_"+sub_id).val();
			var ca2 = $("#ca_2s_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2);
			$("#ca_markss_"+sub_id).val(totl);
		}
	}
	function ca_2s(sub_id){
		 $('#error_message').hide();
		var values = $("#ca_2s_"+sub_id).val();
		if (values > 20) {
			$("#ca_2s_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">CA2 score must be less than or equal to 20.  </strong>');
		}else{
			var ca1 = $("#ca_1s_"+sub_id).val();
			var ca2 = $("#ca_2s_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2);
			$("#ca_markss_"+sub_id).val(totl);
		}
	}

</script> 