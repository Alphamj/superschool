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
                <?php echo form_open(base_url() . 'index.php?teacher/manage_marks');?>
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
                                           <?php echo $row['name'];?></option>
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
									if ($row['class_id'] > 40 && $row['class_id'] < 50){ ?>
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
<!-- change link -->	<?php echo form_open(base_url() . 'index.php?teacher/marks/' . $exam_id . '/' . $class_id);?>
					<?php  $class_type = strtolower($this->crud_model->get_class_name($class_id)); 
					$jss = "no";
					if(strpos($class_type, 'jss') !== false ){
						$jss = "yes";
					}
					
					if (strpos($class_type, 'ss') !== false && $jss !='yes'){
					?>

					<?php 
						////CREATE THE MARK ENTRY ONLY IF NOT EXISTS////
						$teacher_id = $this->session->userdata('login_user_id');
						$students	=	$this->crud_model->get_subjects_by_class2($class_id, $student_id, $teacher_id);
						foreach($students as $row):
							$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id ,'subject_id' => $row['subject_id'] , 
												'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
							$query = $this->db->get_where('mark' , $verify_data);
							
							if($query->num_rows() < 1)
								$this->db->insert('mark' , $verify_data);
						 endforeach;
					?>
				<!-- For SS 1 & 2 -->
				<?php if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?> 

				<table cellpadding="0" cellspacing="0" border="0" class="tg">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A [30]</th>
							<th class="tg-yw4l" rowspan="2">EXAM [70]</th>
							<th class="tg-yw4l" rowspan="2">TOTAL [100]</th>
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
						$h = $z = 0;
						foreach($students as $row):
						
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$get_system_settings[17]['description']);
														
							$query = $this->db->get_where('mark' , $verify_data);							 
							$marks	=	$query->result_array();
							if ($class_id > 28 && $class_id < 32){
								$avgtmk1 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>29 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk2 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>30 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk3 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>31 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							}
							if ($class_id > 31 && $class_id < 35){
								$avgtmk1 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>32 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk2 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>33 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk3 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>34 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							}
							
							$avgtmk = array_merge($avgtmk1,$avgtmk2,$avgtmk3);
							foreach($marks as $row2):
							?>
                     
							<tr>
								<td>
									<?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']);?>
								</td>
								<td class="tg-yw4l"><input type="text" class="class_score1 form-control" value="<?php echo $row2['ca_marks'];?>" name="ca_marks_<?php echo $row['subject_id'];?>" id="ca_marks_<?php echo $row['subject_id'];?>" onchange="class_score_change1('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="class_score2 form-control" value="<?php echo $row2['mark_obtained'];?>" name="mark_obtained_<?php echo $row['subject_id'];?>" id="mark_obtained_<?php echo $row['subject_id'];?>" onchange="class_score_change2('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="class_score form-control" value="<?php echo $row2['mark_total'];?>"  name="mark_total_<?php echo $row['subject_id'];?>" id="mark_total_<?php echo $row['subject_id'];?>" readonly="true"></td>
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
					   			$query_subavg = $this->db->get_where('subavg' , $verify_data);
   
					   			if($query_subavg->num_rows() < 1){
					   				$this->db->insert('subavg' , $verify_data);
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
					   			$this->db->update('subavg', $data);
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
							<th class="tg-yw4l" rowspan="2"><?php if ($exam_id == 1) { echo 'MOCK 1';} ?><?php if ($exam_id == 2) { echo 'MOCK 2';} ?><br > [100]</th>
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
							
                    </thead>
                    <tbody>
                    	
                        <?php 
				    //cod e added on 4 june sandeep
				    		
						$students	=	$this->crud_model->get_subjects_by_class2($class_id, $student_id, $teacher_id);
						$h = $z = 0;
						foreach($students as $row):
						
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$get_system_settings[17]['description']);
														
							$query = $this->db->get_where('mark' , $verify_data);							 
							$marks	=	$query->result_array();
							$avgtmk1 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>35 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							$avgtmk2 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>36 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							$avgtmk3 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>37 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
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
					   			$query_subavg = $this->db->get_where('subavg' , $verify_data);
   
					   			if($query_subavg->num_rows() < 1){
					   				$this->db->insert('subavg' , $verify_data);
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
					   			$this->db->update('subavg', $data);
			   				?>
						<?php
							endforeach;
						 endforeach;
						 ?>
						 
                     </tbody>
			   </table> <?php } ?>

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
					$query_Remark = $this->db->get_where('average' , $verify_datas);

					if($query_Remark->num_rows() < 1){
					$this->db->insert('average' , $verify_datas);
							}
					
					$tscores = $this->db->get_where('mark',array('exam_id' => $exam_id ,'class_id' => $class_id , 
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
					$this->db->update('average', $datas);
				?>

			   <hr>

			<?php //if (count($students)  > 0) { ?>
	<?php $test = $this->db->get_where('class', array('class_id' => $class_id ))->result_array(); 
		if($test[0]['teacher_id'] == $this->session->userdata('login_user_id')){
	?>

	<?php if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?> 
		
		<!-- individual Assessment-->
		<table cellpadding="0" cellspacing="0" border="0" class="tg">
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_Remark = $this->db->get_where('Remark' , $verify_data);

				if($query_Remark->num_rows() < 1){
					$this->db->insert('Remark' , $verify_data);
							}
				
				$student_Remark = $query_Remark->result_array();
				foreach($student_Remark as $row):	

			?>
				<thead>
					<tr>	
						<th colspan = "8" class="tg-yw4l">APPTITUDE, WORK HABITS, TRAITS AND SOCIAL SKILLS</th>
					</tr>
					<tr>
						<th colspan = "5" class="tg-yw4l">COMPONENTS</th>
						<th colspan = "3" class="tg-yw4l">REMARKS</th>
					</tr>
				</thead>	
				<tbody>
					<tr>
						<td  colspan = "5">Quick at understanding new concept.</td>
						<td>
							<select  class="class_score form-control" name="R1">
								<option value="A" <?php if($row['R1'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R1'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R1'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R1'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R1'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Works independently.</td>
						<td>
							<select  class="class_score form-control" name="R2">
								<option value="A" <?php if($row['R2'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R2'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R2'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R2'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R2'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Reasons logically.</td>
						<td>
							<select  class="class_score form-control" name="R3">
								<option value="A" <?php if($row['R3'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R3'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R3'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R3'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R3'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Makes intelligent contributions in the class.</td>
						<td>
							<select  class="class_score form-control" name="R4">
								<option value="A" <?php if($row['R4'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R4'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R4'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R4'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R4'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Is attentive and follows directions.</td>
						<td>
							<select  class="class_score form-control" name="R5">
								<option value="A" <?php if($row['R5'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R5'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R5'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R5'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R5'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Checks and correct assignments.</td>
						<td>
							<select  class="class_score form-control" name="R6">
								<option value="A" <?php if($row['R6'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R6'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R6'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R6'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R6'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Completes homework promptly.</td>
						<td>
							<select  class="class_score form-control" name="R7">
								<option value="A" <?php if($row['R7'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R7'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R7'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R7'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R7'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Honest at work and play.</td>
						<td>
							<select  class="class_score form-control" name="R8">
								<option value="A" <?php if($row['R8'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R8'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R8'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R8'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R8'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Neat in school work.</td>
						<td>
							<select  class="class_score form-control" name="R9">
								<option value="A" <?php if($row['R9'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R9'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R9'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R9'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R9'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Neat in personal apperance.</td>
						<td>
							<select  class="class_score form-control" name="R10">
								<option value="A" <?php if($row['R10'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R10'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R10'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R10'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R10'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Enjoys the conpany of classmates.</td>
						<td>
							<select  class="class_score form-control" name="R11">
								<option value="A" <?php if($row['R11'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R11'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R11'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R11'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R11'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Participates in school activites.</td>
						<td>
							<select  class="class_score form-control" name="R12">
								<option value="A" <?php if($row['R12'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R12'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R12'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R12'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R12'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Keeps schools rules and rgulations.</td>
						<td>
							<select  class="class_score form-control" name="R13">
								<option value="A" <?php if($row['R13'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R13'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R13'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R13'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R13'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Respects school authority and staff.</td>
						<td>
							<select  class="class_score form-control" name="R14">
								<option value="A" <?php if($row['R14'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R14'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R14'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R14'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R14'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Handles own and school proprety with care.</td>
						<td>
							<select  class="class_score form-control" name="R15">
								<option value="A" <?php if($row['R15'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R15'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R15'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R15'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R15'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Punctual at school.</td>
						<td>
							<select  class="class_score form-control" name="R16">
								<option value="A" <?php if($row['R16'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R16'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R16'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R16'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R16'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Sense of leadership.</td>
						<td>
							<select  class="class_score form-control" name="R17">
								<option value="A" <?php if($row['R17'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R17'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R17'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R17'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R17'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Musical/Creatuve Skills.</td>
						<td>
							<select  class="class_score form-control" name="R18">
								<option value="A" <?php if($row['R18'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R18'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R18'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R18'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R18'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
				</tbody>
				<?php endforeach;?>
			</table>
		<?php } ?>

			<hr>

	
	<!--COMMENT AREA-->
			<table style="width:100%; vertical-align: bottom;">
			<?php //echo $exam_id;
				$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
				$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();
				$head_sign = $this->db->get_where('head', array('section'=>'Secondary'))->result_array();

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments' , $verify_data);
							
				if($query_comments->num_rows() < 1){
						$this->db->insert('comments' , $verify_data);
								}
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
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
			<?php 
				endforeach;
			?>
			</table>
			<?php } ?>
	
<!-- Junior Secondary -->
				 <?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){ ?>

					<?php 
						////CREATE THE MARK ENTRY ONLY IF NOT EXISTS////
						$students	=	$this->crud_model->get_subjects_by_class1($class_id);
						foreach($students as $row):
							$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id ,'subject_id' => $row['subject_id'] , 
												'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
							$query = $this->db->get_where('mark' , $verify_data);
							
							if($query->num_rows() < 1)
								$this->db->insert('mark' , $verify_data);
						 endforeach;
					?>
					
					<table cellpadding="0" cellspacing="0" border="0" class="tg">
                    	<thead>
						<tr>
						<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A [40]</th>
							<th class="tg-yw4l" rowspan="2">EXAM [60]</th>
							<th class="tg-yw4l" rowspan="2">TOTAL [100]</th>
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
						$h = 0;
						foreach($students as $row):
						
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$get_system_settings[17]['description']);
														
							$query = $this->db->get_where('mark' , $verify_data);							 
							$marks	=	$query->result_array();
							if ($class_id > 19 && $class_id < 23){
								$avgtmk1 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>20 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk2 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>21 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk3 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>22 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							}
							elseif ($class_id > 22 && $class_id < 26){
								$avgtmk1 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>23 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk2 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>24 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk3 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>25 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							}
							elseif ($class_id > 25 && $class_id < 29){
								$avgtmk1 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>26 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk2 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>27 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
								$avgtmk3 = $this->db->get_where('mark',array('subject_id' => $row['subject_id'],'exam_id' => $exam_id,'class_id'=>28 ,'session_year'=>$get_system_settings[17]['description']))->result_array();
							}
							$avgtmk = array_merge($avgtmk1,$avgtmk2,$avgtmk3);
							foreach($marks as $row2):
					?>
     <!-- change link -->	<?php echo form_open(base_url() . 'index.php?teacher/marks/' . $exam_id . '/' . $class_id . '/' . $student_id);?>
							<tr>
								<td>
									<?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']);;?>
								</td>
								<td class="tg-yw4l"><input type="text" class="class_score1 form-control" value="<?php echo $row2['ca_marks'];?>" name="ca_marks_<?php echo $row['subject_id'];?>" id="ca_marks_<?php echo $row['subject_id'];?>" onchange="class_score_change1_jss('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="class_score2 form-control" value="<?php echo $row2['mark_obtained'];?>" name="mark_obtained_<?php echo $row['subject_id'];?>" id="mark_obtained_<?php echo $row['subject_id'];?>" onchange="class_score_change2_jss('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="class_score form-control" value="<?php echo $row2['mark_total'];?>"  name="mark_total_<?php echo $row['subject_id'];?>" id="mark_total_<?php echo $row['subject_id'];?>" readonly="true"></td>
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
					   			$query_subavg = $this->db->get_where('subavg' , $verify_data);
   
					   			if($query_subavg->num_rows() < 1){
					   				$this->db->insert('subavg' , $verify_data);
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
					   			$this->db->update('subavg', $data);
			   				?>
						<?php 
							endforeach;
						endforeach;
						 ?>
                     </tbody>
			   </table>
			   <?php 
			   
			   ?>

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
					$query_Remark = $this->db->get_where('average' , $verify_datas);

					if($query_Remark->num_rows() < 1){
					$this->db->insert('average' , $verify_datas);
							}

					$tscores = $this->db->get_where('mark',array('exam_id' => $exam_id ,'class_id' => $class_id , 
					'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']))->result_array();
					$m = 0;
					foreach($tscores as $scores){
						if (($scores['mark_obtained']) != 0){
							$m++;
							$tot = $scores['ca_marks']+$scores['mark_obtained'];
							$total_markss +=$tot;}
					}

					$stavg = $total_markss / $m;

					$tscore = $this->db->get_where('average',$very)->result_array();
					
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
					$this->db->update('average', $datas);
				?>

			   <hr>

	<?php $test = $this->db->get_where('class', array('class_id' => $class_id ))->result_array(); 
		if($test[0]['teacher_id'] == $this->session->userdata('login_user_id')){
	?>
	<!-- individual Assessment-->
			<table cellpadding="0" cellspacing="0" border="0" class="tg">
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_Remark = $this->db->get_where('Remark' , $verify_data);

				if($query_Remark->num_rows() < 1){
					$this->db->insert('Remark' , $verify_data);
							}
				
				$student_Remark = $query_Remark->result_array();
				foreach($student_Remark as $row):	

			?>
				<thead>
					<tr>	
						<th colspan = "8" class="tg-yw4l">APTITUDE, WORK HABITS, TRAITS AND SOCIAL SKILLS</th>
					</tr>
					<tr>
						<th colspan = "5" class="tg-yw4l">COMPONENTS</th>
						<th colspan = "3" class="tg-yw4l">REMARKS</th>
					</tr>
				</thead>	
				<tbody>
					<tr>
						<td  colspan = "5">Quick at understanding new concept.</td>
						<td>
							<select  class="class_score form-control" name="R1">
								<option value="A" <?php if($row['R1'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R1'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R1'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R1'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R1'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Works independently.</td>
						<td>
							<select  class="class_score form-control" name="R2">
								<option value="A" <?php if($row['R2'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R2'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R2'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R2'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R2'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Reasons logically.</td>
						<td>
							<select  class="class_score form-control" name="R3">
								<option value="A" <?php if($row['R3'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R3'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R3'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R3'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R3'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Makes intelligent contributions in the class.</td>
						<td>
							<select  class="class_score form-control" name="R4">
								<option value="A" <?php if($row['R4'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R4'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R4'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R4'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R4'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Is attentive and follows directions.</td>
						<td>
							<select  class="class_score form-control" name="R5">
								<option value="A" <?php if($row['R5'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R5'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R5'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R5'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R5'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Checks and correct assignments.</td>
						<td>
							<select  class="class_score form-control" name="R6">
								<option value="A" <?php if($row['R6'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R6'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R6'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R6'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R6'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Completes homework promptly.</td>
						<td>
							<select  class="class_score form-control" name="R7">
								<option value="A" <?php if($row['R7'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R7'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R7'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R7'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R7'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Honest at work and play.</td>
						<td>
							<select  class="class_score form-control" name="R8">
								<option value="A" <?php if($row['R8'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R8'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R8'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R8'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R8'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Neat in school work.</td>
						<td>
							<select  class="class_score form-control" name="R9">
								<option value="A" <?php if($row['R9'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R9'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R9'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R9'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R9'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Neat in personal appearance.</td>
						<td>
							<select  class="class_score form-control" name="R10">
								<option value="A" <?php if($row['R10'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R10'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R10'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R10'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R10'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Enjoys the company of classmates.</td>
						<td>
							<select  class="class_score form-control" name="R11">
								<option value="A" <?php if($row['R11'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R11'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R11'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R11'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R11'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Participates in school activites.</td>
						<td>
							<select  class="class_score form-control" name="R12">
								<option value="A" <?php if($row['R12'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R12'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R12'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R12'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R12'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Keeps schools rules and regulations.</td>
						<td>
							<select  class="class_score form-control" name="R13">
								<option value="A" <?php if($row['R13'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R13'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R13'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R13'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R13'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Respects school authority and staff.</td>
						<td>
							<select  class="class_score form-control" name="R14">
								<option value="A" <?php if($row['R14'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R14'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R14'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R14'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R14'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Handles own and school proprety with care.</td>
						<td>
							<select  class="class_score form-control" name="R15">
								<option value="A" <?php if($row['R15'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R15'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R15'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R15'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R15'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Punctual at school.</td>
						<td>
							<select  class="class_score form-control" name="R16">
								<option value="A" <?php if($row['R16'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R16'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R16'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R16'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R16'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Sense of leadership.</td>
						<td>
							<select  class="class_score form-control" name="R17">
								<option value="A" <?php if($row['R17'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R17'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R17'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R17'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R17'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
					<tr>
						<td  colspan = "5">Musical/Creative Skills.</td>
						<td>
							<select  class="class_score form-control" name="R18">
								<option value="A" <?php if($row['R18'] =='A'){ echo "selected";}?>>A</option>
								<option value="B" <?php if($row['R18'] =='B'){ echo "selected";}?>>B</option>
								<option value="C" <?php if($row['R18'] =='C'){ echo "selected";}?>>C</option>
								<option value="D" <?php if($row['R18'] =='D'){ echo "selected";}?>>D</option>
								<option value="E" <?php if($row['R18'] =='E'){ echo "selected";}?>>E</option>
							</select>
						</td>
					</tr>
				</tbody>
				<?php endforeach;?>
			</table>

			<hr>

	<!--COMMENT AREA-->
			<table style="width:100%; vertical-align: bottom;">
			<?php //echo $exam_id;
				$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
				$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();
				$head_sign = $this->db->get_where('head', array('section'=>'Secondary'))->result_array();

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments' , $verify_data);
							
				if($query_comments->num_rows() < 1){
						$this->db->insert('comments' , $verify_data);
								}
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
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
			<?php 
				endforeach;
			?>
			</table>

			<?php } ?>
			
						 
						
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
								$query = $this->db->get_where('strands' , $verify_data);

								if($query->num_rows() < 1)
									$this->db->insert('strands' , $verify_data);
							 endforeach;
						?>
						<?php 
							////CREATE THE MARK ENTRY ONLY IF NOT EXISTS////
							$students	=	$this->crud_model->get_subjects_by_class1($class_id);
							foreach($students as $row):
								$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id ,'subject_id' => $row['subject_id'] , 
													'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
								$query = $this->db->get_where('mark_pri' , $verify_data);

								if($query->num_rows() < 1)
									$this->db->insert('mark_pri' , $verify_data);
							 endforeach;
						?>
					<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 71%;display: inline-block;vertical-align: top;">
						<tbody>
						<tr><td colspan="13"></td>
							<td colspan="26" style="text-align: center;">SCORES</td>
							<td colspan="6" style="text-align: center;"></td>
							
						</tr>
						<tr>
							<td></td>
							<td colspan="12">SUBJECTS</td>
							<td colspan="3" style="text-align: center;">CA 1<br>20</td>
							<td colspan="3" style="text-align: center;">CW<br>10</td>
							<td colspan="3" style="text-align: center;">CA 2<br>20</td>
							<td colspan="5" style="text-align: center;">PROJECT<br>10</td>
							<td colspan="5" style="text-align: center;">TOTAL CA<br>60</td>
							<td colspan="4" style="text-align: center;">EXAM<br>40</td>
							<td colspan="3" style="text-align: center;">TOTAL<br>SCORE</td>
							
							
							
						</tr>
						 <?php 
							 
						$students	=	$this->crud_model->get_subjects_by_class1($class_id);
						$i= $h = 0;
						foreach($students as $row):
							$i++;
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$get_system_settings[17]['description']);
														
							$query = $this->db->get_where('mark_pri' , $verify_data);							 
							$marks	=	$query->result_array();
							foreach($marks as $row2):
								$marks0 = $this->db->get_where('mark0_pri' , $verify_data)->result_array();
							?>
								<?php if ($i == 2){
									$strand = $this->db->get('strand')->result_array();
									foreach($strand as $rowz):
										$strands = $this->db->get_where('strands', array('exam_id' => $exam_id ,
																	'class_id' => $class_id ,
																	'strand_id' => $rowz['strand_id'] , 
																	'student_id' => $student_id,
																	'session_year'=>$get_system_settings[17]['description']))->result_array();
										foreach($strands as $rows):
											$strands0 = $this->db->get_where('strands0', array('exam_id' => $exam_id ,
																	'class_id' => $class_id ,
																	'strand_id' => $rowz['strand_id'] , 
																	'student_id' => $student_id,
																	'session_year'=>$get_system_settings[17]['description']))->result_array();
								?>
											<tr>
												<td><?php echo '*'; ?></td>
												<td colspan="12"><?php echo  $this->crud_model->get_subject_name_by_ids('strand',$rows['strand_id']);?></td>
												<td colspan="3"><input type="text" class="class_score form-control" value="<?php echo $strands0[0]['ca_1'];?>" name="ca_1s_<?php echo $rowz['strand_id'];?>" id="ca_1s_<?php echo $rowz['strand_id'];?>" onchange="ca_1s('<?php echo $rowz['strand_id'];?>')" readonly = 'true'></td>
												<td colspan="3"><input type="text" class="class_score2 form-control" value="<?php echo $strands0[0]['ca_2'];?>" name="cws_<?php echo $rowz['strand_id'];?>" id="cws_<?php echo $rowz['strand_id'];?>" onchange="cws('<?php echo $rowz['strand_id'];?>')" readonly = 'true'></td>
												<td colspan="3"><input type="text" class="class_score3 form-control" value="<?php echo $rows['ca_2'];?>" name="ca_2s_<?php echo $rowz['strand_id'];?>" id="ca_2s_<?php echo $rowz['strand_id'];?>" onchange="ca_2s('<?php echo $rowz['strand_id'];?>')" ></td>
												<td colspan="5"><input type="text" class="class_score3 form-control" value="<?php echo $rows['project_score'];?>" name="project_scores_<?php echo $rowz['strand_id'];?>" id="project_scores_<?php echo $rowz['strand_id'];?>" onchange="project_scores('<?php echo $rowz['strand_id'];?>')" ></td>
												<td colspan="5"><input type="text" class="class_score4 form-control" value="<?php echo $rows['ca_marks'];?>" name="ca_markss_<?php echo $rowz['strand_id'];?>" id="ca_markss_<?php echo $rowz['strand_id'];?>" readonly="true" ></td>
												<td colspan="4"><input type="text" class="class_score5 form-control" value="<?php echo $rows['mark_obtained'];?>" name="mark_obtaineds_<?php echo $rowz['strand_id'];?>" id="mark_obtaineds_<?php echo $rowz['strand_id'];?>"   onchange="mark_obtaineds('<?php echo $rowz['strand_id'];?>')" ></td>
												<td colspan="3"><input type="text" class="class_score6 form-control" value="<?php echo $rows['mark_total'];?>" name="mark_totals_<?php echo $rowz['strand_id'];?>" id="mark_totals_<?php echo $rowz['strand_id'];?>" readonly="true"   ></td>										
											</tr>
											<input type="hidden" name="strands_id_<?php echo $rowz['strand_id'];?>" value="<?php echo $rows['strands_id'];?>" />
									
									<?php //echo $rowz['strand_id'];
										endforeach;
									endforeach; } 
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td colspan="12"><?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']);?></td>
										<td colspan="3"><input type="text" class="class_score form-control" value="<?php echo $marks0[0]['ca_1'];?>" name="ca_1_<?php echo $row['subject_id'];?>" id="ca_1_<?php echo $row['subject_id'];?>" onchange="ca_1('<?php echo $row['subject_id'];?>')" readonly = 'true'></td>
										<td colspan="3"><input type="text" class="class_score2 form-control" value="<?php echo $marks0[0]['ca_2'];?>" name="cw_<?php echo $row['subject_id'];?>" id="cw_<?php echo $row['subject_id'];?>" onchange="cw('<?php echo $row['subject_id'];?>')" readonly = 'true'></td>
										<td colspan="3"><input type="text" class="class_score3 form-control" value="<?php echo $row2['ca_2'];?>" name="ca_2_<?php echo $row['subject_id'];?>" id="ca_2_<?php echo $row['subject_id'];?>" onchange="ca_2('<?php echo $row['subject_id'];?>')" ></td>
										<td colspan="5"><input type="text" class="class_score3 form-control" value="<?php echo $row2['project_score'];?>" name="project_score_<?php echo $row['subject_id'];?>" id="project_score_<?php echo $row['subject_id'];?>" onchange="project_score('<?php echo $row['subject_id'];?>')" ></td>
										<td colspan="5"><input type="text" class="class_score4 form-control" value="<?php echo $row2['ca_marks'];?>" name="ca_marks_<?php echo $row['subject_id'];?>" id="ca_marks_<?php echo $row['subject_id'];?>"  readonly="true"></td>
										<td colspan="4"><input type="text" class="class_score5 form-control" value="<?php echo $row2['mark_obtained'];?>" name="mark_obtained_<?php echo $row['subject_id'];?>" id="mark_obtained_<?php echo $row['subject_id'];?>"   onchange="mark_obtained('<?php echo $row['subject_id'];?>')" ></td>
										<td colspan="3"><input type="text" class="class_score6 form-control" value="<?php echo $row2['mark_total'];?>" name="mark_total_<?php echo $row['subject_id'];?>" id="mark_total_<?php echo $row['subject_id'];?>"  readonly="true"  ></td>										
									</tr>
									<input type="hidden" name="mark_id_<?php echo $row['subject_id'];?>" value="<?php echo $row2['mark_id'];?>" />
							<?php 
							if (($row2['ca_marks']+$row2['mark_obtained']) != 0){
								$h++;
								$tot = $row2['ca_marks']+$row2['mark_obtained'];
								$total_markss +=$tot;}
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
				
				
				<!-- Individual Total Average -->
				<?php 
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
					$query_Remark = $this->db->get_where('average' , $verify_data);

					if($query_Remark->num_rows() < 1){
					$this->db->insert('average' , $verify_data);
							}

					$stavg = $total_markss / $h;

					if ($total_markss == ''){
						$datas['total_average'] = 0;
						$datas['total_score'] = 0;
					}

					if ($total_markss > 0){
						$datas['total_average'] = round($stavg,2);
						$datas['total_score'] = $total_markss;
					}

					$this->db->where('class_id', $class_id);
        				$this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('session_year', $get_system_settings[17]['description']);
					$this->db->update('average', $datas);
				?>

				<table style="width: 20%;display: inline-block;vertical-align: top;">
				<?php 
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
					$query_grades = $this->db->get_where('primary_student_grade' , $verify_data);

					if($query_grades->num_rows() < 1){
						$this->db->insert('primary_student_grade' , $verify_data);
								}
							
					$student_grades = $query_grades->result_array();
					foreach($student_grades as $row):	

				?>
				<tbody>
					<tr>
						<td colspan="6">BEHAVIOUR</td>
						<td>A</td>
						<td>B</td>
						<td>C</td>
						<td>D</td>
						<td>E</td>
					</tr>
					<tr>
						<td colspan="6">PUNCTUALITY</td>
						<td><input type ="radio" name="punctuality_grade" value="A" <?php if($row['punctuality_grade'] =='A'){ echo "checked"; } ?> ></td>
						<td><input type ="radio" name="punctuality_grade" value="B" <?php if($row['punctuality_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="punctuality_grade" value="C" <?php if($row['punctuality_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="punctuality_grade" value="D" <?php if($row['punctuality_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="punctuality_grade" value="E" <?php if($row['punctuality_grade'] =='E'){ echo "checked"; } ?>></td>
											
					</tr>
					<tr>
					<td colspan="6">MENTAL ALERTNESS</td>
						<td><input type ="radio" name="mental_grade" <?php if($row['mental_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="mental_grade" value="B" <?php if($row['mental_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="mental_grade" value="C" <?php if($row['mental_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="mental_grade" value="D" <?php if($row['mental_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="mental_grade" value="E" <?php if($row['mental_grade'] =='E'){ echo "checked"; } ?>></td>
								
					</tr>
					<tr>
					<td colspan="6">RESPECT FOR AUTHORITY</td>
							<td><input type ="radio" name="respect_grade" <?php if($row['respect_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
							<td><input type ="radio" name="respect_grade" value="B" <?php if($row['respect_grade'] =='B'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="respect_grade" value="C" <?php if($row['respect_grade'] =='C'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="respect_grade" value="D" <?php if($row['respect_grade'] =='D'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="respect_grade" value="E" <?php if($row['respect_grade'] =='E'){ echo "checked"; } ?>></td>
								
					</tr>
					<tr>
					<td colspan="6">NEATNESS</td>
							<td><input type ="radio" name="neatness_grade" <?php if($row['neatness_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
							<td><input type ="radio" name="neatness_grade" value="B" <?php if($row['neatness_grade'] =='B'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="neatness_grade" value="C" <?php if($row['neatness_grade'] =='C'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="neatness_grade" value="D" <?php if($row['neatness_grade'] =='D'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="neatness_grade" value="E" <?php if($row['neatness_grade'] =='E'){ echo "checked"; } ?>></td>
								
					</tr>
					<tr>
						<td colspan="6">POLITENESS</td>
						<td><input type ="radio" name="politness_grade" <?php if($row['politness_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="politness_grade" value="B" <?php if($row['politness_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="politness_grade" value="C" <?php if($row['politness_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="politness_grade" value="D" <?php if($row['politness_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="politness_grade" value="E" <?php if($row['politness_grade'] =='E'){ echo "checked"; } ?>></td>
			
					</tr>
					<tr>
						<td colspan="6">HONESTY</td>
						<td><input type ="radio" name="honesty_grade" <?php if($row['honesty_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="honesty_grade" value="B" <?php if($row['honesty_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="honesty_grade" value="C" <?php if($row['honesty_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="honesty_grade" value="D" <?php if($row['honesty_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="honesty_grade" value="E" <?php if($row['honesty_grade'] =='E'){ echo "checked"; } ?>></td>
			
					</tr>
					<tr>
						<td colspan="6">RELATIONSHIP WITH PEERS</td>
						<td><input type ="radio" name="peers_grade" <?php if($row['peers_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="peers_grade" value="B" <?php if($row['peers_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="peers_grade" value="C" <?php if($row['peers_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="peers_grade" value="D" <?php if($row['peers_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="peers_grade" value="E" <?php if($row['peers_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>
						<td colspan="6">WILLINGNESS TO LEARN</td>
						<td><input type ="radio" name="learn_grade" <?php if($row['learn_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="learn_grade" value="B" <?php if($row['learn_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="learn_grade" value="C" <?php if($row['learn_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="learn_grade" value="D" <?php if($row['learn_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="learn_grade" value="E" <?php if($row['learn_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>
						<td colspan="6">SPIRIT OF TEAMWORK</td>
						<td><input type ="radio" name="teamwork_grade" <?php if($row['teamwork_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="teamwork_grade" value="B" <?php if($row['teamwork_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="teamwork_grade" value="C" <?php if($row['teamwork_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="teamwork_grade" value="D" <?php if($row['teamwork_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="teamwork_grade" value="E" <?php if($row['teamwork_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>
						<td colspan="6">HEALTH</td>
						<td><input type ="radio" name="health_grade" <?php if($row['health_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="health_grade" value="B" <?php if($row['health_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="health_grade" value="C" <?php if($row['health_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="health_grade" value="D" <?php if($row['health_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="health_grade" value="E" <?php if($row['health_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>
						<td colspan="11" style="text-align: center;">PSYCHOMOTOR SKILLS</td>
					</tr>
					<tr>
						<td colspan="6"></td>
						<td>A</td>
						<td>B</td>
						<td>C</td>
						<td>D</td>
						<td>E</td>
					</tr>
					<tr>
						<td colspan="6">VERBAL SKILLS</td>
						<td><input type ="radio" name="verbal_grade" <?php if($row['verbal_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="verbal_grade" value="B" <?php if($row['verbal_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="verbal_grade" value="C" <?php if($row['verbal_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="verbal_grade" value="D" <?php if($row['verbal_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="verbal_grade" value="E" <?php if($row['verbal_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>
						<td colspan="6">PARTICIPATION IN SPORTS</td>
						<td><input type ="radio" name="sports_grade" <?php if($row['sports_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="sports_grade" value="B" <?php if($row['sports_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="sports_grade" value="C" <?php if($row['sports_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="sports_grade" value="D" <?php if($row['sports_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="sports_grade" value="E" <?php if($row['sports_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>
						<td colspan="6">ARTISTIC/CREATIVITY</td>
						<td><input type ="radio" name="creativity_grade" <?php if($row['creativity_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="creativity_grade" value="B" <?php if($row['creativity_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="creativity_grade" value="C" <?php if($row['creativity_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="creativity_grade" value="D" <?php if($row['creativity_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="creativity_grade" value="E" <?php if($row['creativity_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>

					<td colspan="6">MUSIC SKILLS</td>
						<td><input type ="radio" name="music_grade" <?php if($row['music_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="music_grade" value="B" <?php if($row['music_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="music_grade" value="C" <?php if($row['music_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="music_grade" value="D" <?php if($row['music_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="music_grade" value="E" <?php if($row['music_grade'] =='E'){ echo "checked"; } ?>></td>
								
					</tr>
					<tr>
					<td colspan="6">DANCE SKILLS</td>
						<td><input type ="radio" name="dance_grade" <?php if($row['dance_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="dance_grade" value="B" <?php if($row['dance_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="dance_grade" value="C" <?php if($row['dance_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="dance_grade" value="D" <?php if($row['dance_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="dance_grade" value="E" <?php if($row['dance_grade'] =='E'){ echo "checked"; } ?>></td>
								
					
				</tbody>
					<?php endforeach; ?>
			</table>

			<hr>

	<?php } $test = $this->db->get_where('class', array('class_id' => $class_id ))->result_array(); 
			if($test[0]['teacher_id'] == $this->session->userdata('login_user_id')){
	?>
			<!--COMMENT AREA-->
			<table style="width:100%; vertical-align: bottom;">
			<?php 
				$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
				$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();
				$head_sign = $this->db->get_where('head', array('section'=>'Primary'))->result_array();

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments' , $verify_data);
							
				if($query_comments->num_rows() < 1){
						$this->db->insert('comments' , $verify_data);
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
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['Attendance'];?>" name="Attendance">Example: Attendance / No of times school opened</td>
					</tr>
					
					<tr>
						<th>Teacher's Comment</th>
						<th>Head Teacher's Comment</th>
						<th>Student's Average</th>
					</tr>
					<tr>
						<td><textarea class="class_score form-control" value="<?php echo $row['TeacherComment'];?>" cols="30" name = "TeacherComment"><?php echo $row['TeacherComment'];?></textarea></td>
						<td><textarea class="class_score form-control" value="<?php echo $row['HeadTeacherComment'];?>" cols="30" name = "HeadTeacherComment"><?php echo $row['HeadTeacherComment'];?></textarea></td>
						<td><input class="class_score6 form-control" type="text" value="<?php $student_average = $this->db->get_where('average',array('exam_id' => $exam_id,'student_id' => $student_id ,'class_id'=>$class_id ,'session_year'=>$get_system_settings[17]['description']))->row() ->total_average; echo $student_average;?>" name="" readonly = 'true'></td>
						<input type="hidden" name="teach_sign" value="<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg' ?>" />
						<input type="hidden" name="head_sign" value="<?php echo $head_sign[0]['head_id'] . '.' . 'jpg' ?>" />
					</tr>
				<?php endforeach; ?>

			</table>
				<?php } ?>

<!-- Nursery -->
<?php }else if (strpos($class_type, 'nursery') !== false || strpos($class_type, 'nur') !== false || strpos($class_type, 'toddler') !== false){ ?>
		<style>
			table, tr, td, th {    border: 1px solid #000;border-collapse: collapse;font-family: sans-serif;font-size: 14px;}
			th { padding: 10px; margin-left: 100px;}td span {font-size: 13px; margin-left: 2px;}th {height: 200px; }
			.text-transform span {float: left;width: 100%;margin: 0 0 0 -93px;}
			.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); transform: rotate(270deg); width: 10px; max-width: 10px;}
			td.inner {padding: 0;}
			td.inner table {width: 100%;}
			td.inner table, td.inner tr {border: 0;}
		</style>

		<table>
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_marks = $this->db->get_where('nursery_student_marks' , $verify_data);
							
				if($query_marks->num_rows() < 1){
						$this->db->insert('nursery_student_marks' , $verify_data);
								}
				$nursub = $query_marks->result_array();
			?>
			
			<tbody>
			<tr>
					<th colspan="12"><span>SUBJECTS</span></th>
					<th class="text-transform"><span>Exceeding</span></th>
					<th class="text-transform"><span>Meeting_Expectations</span></th>
					<th class="text-transform"><span>Emerging_Expectations</span></th>
					<th class="text-transform"><span>Not_Assessed</span></th>
					<th colspan="12"><span>SUBJECTS</span></th>
					<th class="text-transform"><span>Exceeding</span></th>
					<th class="text-transform"><span>Meeting_Expectations</span></th>
					<th class="text-transform"><span>Emerging_Expectations</span></th>
					<th class="text-transform"><span>Not_Assessed</span></th>
					<th colspan="12"><span>SUBJECTS</span></th>
					<th class="text-transform"><span>Exceeding</span></th>
					<th class="text-transform"><span>Meeting_Expectations</span></th>
					<th class="text-transform"><span>Emerging_Expectations</span></th>
					<th class="text-transform"><span>Not_Assessed</span></th>
				</tr>
				<tr>
					<td colspan="12"><span><strong>LANGUAGE ART</strong></span></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td colspan="12"><span><strong>SOCIAL-EMOTIONAL DEVELOPMENT</strong></span></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td colspan="12"><span><strong>KNOWLEDGE AND UNDERSTANDING<br /> OF THE WORLD</strong></span></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			<?php // ************nursery 1****************
				if (strpos($class_type, 'nursery 1') !== false ) { ?>
				<?php
					if ($exam_id == 1) {$items = $this->db->get_where('nnursery_subject')->result_array();}
					if ($exam_id == 2) {$items = $this->db->get_where('nnursery_subject_2')->result_array();}
					if ($exam_id == 3) {$items = $this->db->get_where('nnursery_subject_3')->result_array();}
					$a = 0;$b = 100;$c = 200;
					foreach ($items as $row){
					
						
						if ($a == 0){
							$language = 'language';
							$social = 'social';
							$knowledge = 'knowledge';}
						else {
							$language = strval('language'.$a);
							$social = strval('social'.$b);
							$knowledge = strval('knowledge'.$c);	
						}
						$b++;$c++;$a++;
				?>
				<tr>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['language'])) == true) {echo '<strong>';}?><?php echo $row['language']?></strong></span></td>
					<?php if ($row['language'] != '' && ctype_upper(str_replace(' ','',$row['language'])) != true){ ?>
						<td><input type ="radio" name=<?php echo $language ?> value="A" <?php if($nursub[0][$language] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="B" <?php if($nursub[0][$language] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="C" <?php if($nursub[0][$language] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="D" <?php if($nursub[0][$language] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['language'] == ''|| ctype_upper(str_replace(' ','',$row['language'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['social'])) == true) {echo '<strong>';}?><?php echo $row['social']?></strong></span></td>
					<?php if ($row['social'] != '' && ctype_upper(str_replace(' ','',$row['social'])) != true){ ?>
						<td><input type ="radio" name=<?php echo $social ?> value="A" <?php if($nursub[0][$social] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="B" <?php if($nursub[0][$social] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="C" <?php if($nursub[0][$social] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="D" <?php if($nursub[0][$social] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['social'] == '' || ctype_upper(str_replace(' ','',$row['social'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['knowledge'])) == true) {echo '<strong>';}?><?php echo $row['knowledge']?></strong></span></td>
					<?php if ($row['knowledge'] != '' && ctype_upper(str_replace(' ','',$row['knowledge'])) != true){ ?>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="A" <?php if($nursub[0][$knowledge] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="B" <?php if($nursub[0][$knowledge] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="C" <?php if($nursub[0][$knowledge] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="D" <?php if($nursub[0][$knowledge] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['knowledge'] == '' || ctype_upper(str_replace(' ','',$row['knowledge'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
				</tr>

				<?php } ?>
				
			<?php // ************Nursery 2*****************
				} if (strpos($class_type, 'nursery 2') !== false) { ?>
				<?php 
					if ($exam_id == 1) {$items = $this->db->get_where('nnursery_subject1')->result_array();}
					if ($exam_id == 2) {$items = $this->db->get_where('nnursery_subject1_2')->result_array();}
					if ($exam_id == 3) {$items = $this->db->get_where('nnursery_subject1_3')->result_array();}
					$a = 0;$b = 100;$c = 200;
					foreach ($items as $row){
					
						
						if ($a == 0){
							$language = 'language';
							$social = 'social';
							$knowledge = 'knowledge';}
						else {
							$language = strval('language'.$a);
							$social = strval('social'.$b);
							$knowledge = strval('knowledge'.$c);	
						}
						$b++;$c++;$a++;
				?>
				<tr>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['language'])) == true) {echo '<strong>';}?><?php echo $row['language']?></strong></span></td>
					<?php if ($row['language'] != '' && ctype_upper(str_replace(' ','',$row['language'])) != true){ ?>
						<td><input type ="radio" name=<?php echo $language ?> value="A" <?php if($nursub[0][$language] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="B" <?php if($nursub[0][$language] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="C" <?php if($nursub[0][$language] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="D" <?php if($nursub[0][$language] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['language'] == ''|| ctype_upper(str_replace(' ','',$row['language'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['social'])) == true) {echo '<strong>';}?><?php echo $row['social']?></strong></span></td>
					<?php if ($row['social'] != '' && ctype_upper(str_replace(' ','',$row['social'])) != true){ ?>
						<td><input type ="radio" name=<?php echo $social ?> value="A" <?php if($nursub[0][$social] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="B" <?php if($nursub[0][$social] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="C" <?php if($nursub[0][$social] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="D" <?php if($nursub[0][$social] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['social'] == '' || ctype_upper(str_replace(' ','',$row['social'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['knowledge'])) == true) {echo '<strong>';}?><?php echo $row['knowledge']?></strong></span></td>
					<?php if ($row['knowledge'] != '' && ctype_upper(str_replace(' ','',$row['knowledge'])) != true){ ?>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="A" <?php if($nursub[0][$knowledge] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="B" <?php if($nursub[0][$knowledge] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="C" <?php if($nursub[0][$knowledge] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="D" <?php if($nursub[0][$knowledge] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['knowledge'] == '' || ctype_upper(str_replace(' ','',$row['knowledge'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
				</tr>

				<?php } ?>

			<?php // ************Nursery 3*************
				} if (strpos($class_type, 'nursery 3') !== false) { ?>
				<?php 
					if ($exam_id == 1) {$items = $this->db->get_where('nursery_subject2')->result_array();}
					if ($exam_id == 2) {$items = $this->db->get_where('nursery_subject2_2')->result_array();}
					if ($exam_id == 3) {$items = $this->db->get_where('nursery_subject2_3')->result_array();}
					$a = 0;$b = 100;$c = 200;
					foreach ($items as $row){
					
						
						if ($a == 0){
							$language = 'language';
							$social = 'social';
							$knowledge = 'knowledge';}
						else {
							$language = strval('language'.$a);
							$social = strval('social'.$b);
							$knowledge = strval('knowledge'.$c);	
						}
						$b++;$c++;$a++;
					?>
				<tr>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['language'])) == true) {echo '<strong>';}?><?php echo $row['language']?></strong></span></td>
					<?php if ($row['language'] != '' && ctype_upper(str_replace(' ','',$row['language'])) != true){ ?>
						<td><input type ="radio" name=<?php echo $language ?> value="A" <?php if($nursub[0][$language] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="B" <?php if($nursub[0][$language] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="C" <?php if($nursub[0][$language] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="D" <?php if($nursub[0][$language] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['language'] == ''|| ctype_upper(str_replace(' ','',$row['language'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['social'])) == true) {echo '<strong>';}?><?php echo $row['social']?></strong></span></td>
					<?php if ($row['social'] != '' && ctype_upper(str_replace(' ','',$row['social'])) != true){ ?>
						<td><input type ="radio" name=<?php echo $social ?> value="A" <?php if($nursub[0][$social] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="B" <?php if($nursub[0][$social] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="C" <?php if($nursub[0][$social] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="D" <?php if($nursub[0][$social] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['social'] == '' || ctype_upper(str_replace(' ','',$row['social'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['knowledge'])) == true) {echo '<strong>';}?><?php echo $row['knowledge']?></strong></span></td>
					<?php if ($row['knowledge'] != '' && ctype_upper(str_replace(' ','',$row['knowledge'])) != true && strpos($row['knowledge'], ':') != true){ ?>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="A" <?php if($nursub[0][$knowledge] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="B" <?php if($nursub[0][$knowledge] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="C" <?php if($nursub[0][$knowledge] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="D" <?php if($nursub[0][$knowledge] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['knowledge'] == '' || (ctype_upper(str_replace(' ','',$row['knowledge'])) == true && strpos($row['knowledge'], ':') == false)){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<?php if (strpos($row['knowledge'], ':') == true){ ?>
						<td colspan="4"><input type ="text" name=<?php echo $knowledge ?> value= "<?php echo $nursub[0][$knowledge];?>"></td>
					<?php }?>
        				
				</tr>

				<?php } ?>
				
				
			<?php // **********************TODDLER************************
				} if (strpos($class_type, 'toddler') !== false) { ?>
				<?php 
					if ($exam_id == 1) {$items = $this->db->get_where('nursery_subject3')->result_array();}
					if ($exam_id == 2) {$items = $this->db->get_where('nursery_subject3_2')->result_array();}
					if ($exam_id == 3) {$items = $this->db->get_where('nursery_subject3_3')->result_array();}
					$a = 0;$b = 100;$c = 200;
					foreach ($items as $row){
					
						
						if ($a == 0){
							$language = 'language';
							$social = 'social';
							$knowledge = 'knowledge';}
						else {
							$language = strval('language'.$a);
							$social = strval('social'.$b);
							$knowledge = strval('knowledge'.$c);	
						}
						$b++;$c++;$a++;
					?>
				<tr>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['language'])) == true) {echo '<strong>';}?><?php echo $row['language']?></strong></span></td>
					<?php if ($row['language'] != '' && ctype_upper(str_replace(' ','',$row['language'])) != true){ ?>
						<td><input type ="radio" name=<?php echo $language ?> value="A" <?php if($nursub[0][$language] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="B" <?php if($nursub[0][$language] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="C" <?php if($nursub[0][$language] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $language ?> value="D" <?php if($nursub[0][$language] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['language'] == ''|| ctype_upper(str_replace(' ','',$row['language'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['social'])) == true) {echo '<strong>';}?><?php echo $row['social']?></strong></span></td>
					<?php if ($row['social'] != '' && ctype_upper(str_replace(' ','',$row['social'])) != true){ ?>
						<td><input type ="radio" name=<?php echo $social ?> value="A" <?php if($nursub[0][$social] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="B" <?php if($nursub[0][$social] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="C" <?php if($nursub[0][$social] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $social ?> value="D" <?php if($nursub[0][$social] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['social'] == '' || ctype_upper(str_replace(' ','',$row['social'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['knowledge'])) == true) {echo '<strong>';}?><?php echo $row['knowledge']?></strong></span></td>
					<?php if ($row['knowledge'] != '' && ctype_upper(str_replace(' ','',$row['knowledge'])) != true){ ?>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="A" <?php if($nursub[0][$knowledge] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="B" <?php if($nursub[0][$knowledge] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="C" <?php if($nursub[0][$knowledge] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name=<?php echo $knowledge ?> value="D" <?php if($nursub[0][$knowledge] =='D'){ echo "checked"; } ?>></td>
					<?php } ?>
					<?php if ($row['knowledge'] == '' || ctype_upper(str_replace(' ','',$row['knowledge'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
				</tr>

				<?php }} ?>
			</tbody>
		</table>

		<br />
		<hr>
		<br />


	<?php $test = $this->db->get_where('class', array('class_id' => $class_id ))->result_array(); 
			if($test[0]['teacher_id'] == $this->session->userdata('login_user_id')){
	?>
		<!--COMMENT AREA-->
		<table style="width:100%; vertical-align: bottom;" cellpadding="0" cellspacing="0" border="0" class="tg">
			<?php 
				$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
				$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();
				$head_sign = $this->db->get_where('head', array('section'=>'Primary'))->result_array();

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments' , $verify_data);
							
				if($query_comments->num_rows() < 1){
						$this->db->insert('comments' , $verify_data);
								}
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th style="height:10px;">Teacher's Name</th>
						<th style="height:10px;">Head Teacher's Name</th>
						<th style="height:10px;">Attendance</th>
					</tr>
					<tr>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['TeacherName'];?>" name="TeacherName"></td>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['HeadTeacherName'];?>" name="HeadTeacherName"></td>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['Attendance'];?>" name="Attendance">Example: Attendance / No of times school opened</td>
					</tr>
					
					<tr>
						<th style="height:10px;">Teacher's Comment</th>
						<th style="height:10px;">Head Teacher's Comment</th>
					</tr>
					<tr>
						<td><textarea class="class_score form-control" value="<?php echo $row['TeacherComment'];?>" cols="30" name = "TeacherComment"><?php echo $row['TeacherComment'];?></textarea></td>
						<td><textarea class="class_score form-control" value="<?php echo $row['HeadTeacherComment'];?>" cols="30" name = "HeadTeacherComment"><?php echo $row['HeadTeacherComment'];?></textarea></td>
						<input type="hidden" name="teach_sign" value="<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg' ?>" />
						<input type="hidden" name="head_sign" value="<?php echo $head_sign[0]['head_id'] . '.' . 'jpg' ?>" />
					</tr>
				<?php endforeach; ?>

		</table>
			
	<?php } ?>
		<?php 
		?>

		<input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
        	<input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
        	<input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
        	<input type="hidden" name="session_year" value="<?php echo $get_system_settings[17]['description'];?>" />
        	<input type="hidden" name="operation" value="update" />
        	<input type="hidden" name="class_types" value="nursery" />
	<?php } ?>


		<?php if($class_id == ''):?>
			<div class="alert alert-danger" align="center">Add Subject To Selected Class First&nbsp;&nbsp;
				<a href="<?php echo base_url();?>index.php?teacher/subject/"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>
			</div>
		<?php endif;?>
		<h5 id="error_message"  align="center" style="color: red;display: none;margin-left: 50px;"><strong style="color:#FF0000">Class score must be less than 30 or equal to 30 and exam score must be less than or equal to 70</strong></h5>
		
		 
		 <?php 
			if($class_id != '' && $class_id > 19 && $class_id < 40){
				$vacation_date = $this->crud_model->get_class_vacation_date($class_id,$exam_id,$get_system_settings[17]['description']);
			}

			if($class_id != '' && $class_id < 20){
				$vacation_date = $this->crud_model->get_class_vacation_datep($class_id,$exam_id,$get_system_settings[17]['description']);
			}

			if($class_id != '' && $class_id > 37){
				$vacation_date = $this->crud_model->get_class_vacation_daten($class_id,$exam_id,$get_system_settings[17]['description']);
			}
		?>
		 
		<div class="text-center">
		<?php $test = $this->db->get_where('class', array('class_id' => $class_id ))->result_array(); 
			if($test[0]['teacher_id'] == $this->session->userdata('login_user_id')){
		?>
			<label>Vacation Date: </label>
			<input type="text" name="vacation_date" id="datepicker" placeholder="Select Vacation Date" value="<?php echo $vacation_date[0]['vacation_date']; ?>" required>
			<label>Resumption Date: </label>
			<input type="text" name="resumption_date" id="datepicker2" placeholder="Select Resumption Date" value="<?php echo $vacation_date[0]['resumption_date']; ?>" required>
		<?php } ?>
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

//SSS
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
  var class_scores = document.getElementsByClassName('class_score1');
   for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
     if (value > 30) {
        class_scores[i].value = 0;
        $('#error_message').show();
      }
    }
    var ca_mark = $("#ca_marks_"+sub_id).val();
    var mark_obtained = $("#mark_obtained_"+sub_id).val();
    var total = parseInt(ca_mark)+parseInt(mark_obtained);
    console.log(ca_mark,mark_obtained);
    $("#mark_total_"+sub_id).val(total);
  }
function class_score_change2(sub_id) {
  var class_scores = document.getElementsByClassName('class_score2');
   for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
     if (value > 70) {
        class_scores[i].value = 0;
        $('#error_message').show();
      }
    }
    var ca_mark = $("#ca_marks_"+sub_id).val();
    var mark_obtained = $("#mark_obtained_"+sub_id).val();
    var total = parseInt(ca_mark)+parseInt(mark_obtained);
    $("#mark_total_"+sub_id).val(total);
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
//JSS
 function class_score_change1_jss(sub_id) {
  var class_scores = document.getElementsByClassName('class_score1');
   for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
     if (value > 40) {
        class_scores[i].value = 0;
	   $('#error_message').show();
        $('#error_message').html('<strong style="color:#FF0000">Class score must be less than or equal to 40 and exam score must be less than or equal to 40</strong>');
      }
    }
    var ca_mark = $("#ca_marks_"+sub_id).val();
    var mark_obtained = $("#mark_obtained_"+sub_id).val();
    var total = parseInt(ca_mark)+parseInt(mark_obtained);
    console.log(ca_mark,mark_obtained);
    $("#mark_total_"+sub_id).val(total);
  }
function class_score_change2_jss(sub_id) {
  var class_scores = document.getElementsByClassName('class_score2');
   for (var i = class_scores.length - 1; i >= 0; i--) {
      var value = class_scores[i].value;
     if (value > 60) {
        class_scores[i].value = 0;
	   $('#error_message').show();
        $('#error_message').html('<strong style="color:#FF0000">Class score must be less than or equal to 40 and exam score must be less than or equal to 40</strong>');
      }
    }
    var ca_mark = $("#ca_marks_"+sub_id).val();
    var mark_obtained = $("#mark_obtained_"+sub_id).val();
    var total = parseInt(ca_mark)+parseInt(mark_obtained);
    $("#mark_total_"+sub_id).val(total);
  }

  function exam_score_change() {
    var exam_scores = document.getElementsByClassName('exam_score');
    for (var i = exam_scores.length - 1; i >= 0; i--) {
      var value = exam_scores[i].value;
      if (value > 100) {
        exam_scores[i].value = 0;
        $('#error_message').show();
      }
    }
  }
  

  // PRIMARY
	function ca_1(sub_id){
		 $('#error_message').hide();
		var values = $("#ca_1_"+sub_id).val();
		if (values > 20) {
			$("#ca_1_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">CA1 score must be less than or equal to 20.  </strong>');
		}else{
			var ca1 = $("#ca_1_"+sub_id).val();
			var ca2 = $("#ca_2_"+sub_id).val();
			var cw = $("#cw_"+sub_id).val();
			var project = $("#project_score_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2)+parseFloat(cw)+parseFloat(project);
			$("#ca_marks_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtained_"+sub_id).val();
			var ca_score = $("#ca_marks_"+sub_id).val();
			var totl = parseFloat(mark_obtained)+parseFloat(ca_score);
			$("#mark_total_"+sub_id).val(totl);
		}
	}
	function ca_2(sub_id){
		 $('#error_message').hide();
		var values = $("#ca_2_"+sub_id).val();
		if (values > 20) {
			$("#ca_2_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">CA2 score must be less than or equal to 20.  </strong>');
		}else{
			var ca1 = $("#ca_1_"+sub_id).val();
			var ca2 = $("#ca_2_"+sub_id).val();
			var cw = $("#cw_"+sub_id).val();
			var project = $("#project_score_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2)+parseFloat(cw)+parseFloat(project);
			$("#ca_marks_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtained_"+sub_id).val();
			var ca_score = $("#ca_marks_"+sub_id).val();
			var totl = parseFloat(mark_obtained)+parseFloat(ca_score);
			$("#mark_total_"+sub_id).val(totl);
		}
	}
	function cw(sub_id){
		 $('#error_message').hide();
		var values = $("#cw_"+sub_id).val();
		if (values > 10) {
			$("#cw_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">CW score must be less than or equal to 10.  </strong>');
		}else{
			var ca1 = $("#ca_1_"+sub_id).val();
			var ca2 = $("#ca_2_"+sub_id).val();
			var cw = $("#cw_"+sub_id).val();
			var project = $("#project_score_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2)+parseFloat(cw)+parseFloat(project);
			$("#ca_marks_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtained_"+sub_id).val();
			var ca_score = $("#ca_marks_"+sub_id).val();
			var totl = parseFloat(mark_obtained)+parseFloat(ca_score);
			$("#mark_total_"+sub_id).val(totl);
		}
	}
	function project_score(sub_id){
		 $('#error_message').hide();
		var values = $("#project_score_"+sub_id).val();
		if (values > 10) {
			$("#project_score_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">Project score must be less than or equal to 10.  </strong>');
		}else{
			var ca1 = $("#ca_1_"+sub_id).val();
			var ca2 = $("#ca_2_"+sub_id).val();
			var cw = $("#cw_"+sub_id).val();
			var project = $("#project_score_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2)+parseFloat(cw)+parseFloat(project);
			$("#ca_marks_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtained_"+sub_id).val();
			var ca_score = $("#ca_marks_"+sub_id).val();
			var totl = parseFloat(mark_obtained)+parseFloat(ca_score);
			$("#mark_total_"+sub_id).val(totl);
		}
	}
	function mark_obtained(sub_id){
		 $('#error_message').hide();
		var values = $("#mark_obtained_"+sub_id).val();
		if (values > 40) {
			$("#mark_obtained_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">Exam score must be less than or equal to 40.  </strong>');
		}else{
			var mark_obtained = $("#mark_obtained_"+sub_id).val();
			
			var ca_score = $("#ca_marks_"+sub_id).val();
			var totl = parseFloat(mark_obtained)+parseFloat(ca_score);
			$("#mark_total_"+sub_id).val(totl);
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
			var cw = $("#cws_"+sub_id).val();
			var project = $("#project_scores_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2)+parseFloat(cw)+parseFloat(project);
			$("#ca_markss_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtaineds_"+sub_id).val();
			var ca_score = $("#ca_markss_"+sub_id).val();
			var totl = parseFloat(mark_obtained)+parseFloat(ca_score);
			$("#mark_totals_"+sub_id).val(totl);
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
			var cw = $("#cws_"+sub_id).val();
			var project = $("#project_score_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2)+parseFloat(cw)+parseFloat(project);
			$("#ca_markss_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtaineds_"+sub_id).val();
			var ca_score = $("#ca_markss_"+sub_id).val();
			var totl = parseFloat(mark_obtained)+parseFloat(ca_score);
			$("#mark_totals_"+sub_id).val(totl);
		}
	}
	function cws(sub_id){
		 $('#error_message').hide();
		var values = $("#cws_"+sub_id).val();
		if (values > 20) {
			$("#cws_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">CW score must be less than or equal to 20.  </strong>');
		}else{
			var ca1 = $("#ca_1s_"+sub_id).val();
			var ca2 = $("#ca_2s_"+sub_id).val();
			var cw = $("#cws_"+sub_id).val();
			var project = $("#project_scores_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2)+parseFloat(cw)+parseFloat(project);
			$("#ca_markss_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtaineds_"+sub_id).val();
			var ca_score = $("#ca_markss_"+sub_id).val();
			var totl = parseFloat(mark_obtained)+parseFloat(ca_score);
			$("#mark_totals_"+sub_id).val(totl);
		}
	}
	function project_scores(sub_id){
		 $('#error_message').hide();
		var values = $("#project_scores_"+sub_id).val();
		if (values > 20) {
			$("#project_scores_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">Project score must be less than or equal to 20.  </strong>');
		}else{
			var ca1 = $("#ca_1s_"+sub_id).val();
			var ca2 = $("#ca_2s_"+sub_id).val();
			var cw = $("#cws_"+sub_id).val();
			var project = $("#project_scores_"+sub_id).val();
			var totl = parseFloat(ca1)+parseFloat(ca2)+parseFloat(cw)+parseFloat(project);
			$("#ca_markss_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtaineds_"+sub_id).val();
			var ca_score = $("#ca_markss_"+sub_id).val();
			var totl = parseFloat(mark_obtained)+parseFloat(ca_score);
			$("#mark_totals_"+sub_id).val(totl);
		}
	}
	function mark_obtaineds(sub_id){
		 $('#error_message').hide();
		var values = $("#mark_obtaineds_"+sub_id).val();
		if (values > 20) {
			$("#mark_obtaineds_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">Exam score must be less than or equal to 20.  </strong>');
		}else{
			var mark_obtained = $("#mark_obtaineds_"+sub_id).val();
			
			var ca_score = $("#ca_markss_"+sub_id).val();
			var totl = parseFloat(mark_obtained)+parseFloat(ca_score);
			$("#mark_totals_"+sub_id).val(totl);
		}
	}

</script> 