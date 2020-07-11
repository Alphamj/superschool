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
                <?php echo form_open(base_url() . 'index.php?formtutor/manage_marks');?>
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
                                $classes = $this->db->get_where('class', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
                                foreach($classes as $row):
                                ?>
                                    <option value="<?php echo $row['class_id'];?>"
                                        <?php if($class_id == $row['class_id'])echo 'selected';?>>
                                            <?php echo $row['name'];?></option>
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



				<div class="x_panel tablu" >
					<div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('enter_student_score'); ?>
					</div>
					</div>

<!-- Senior Secondary -->
					<!-- CODE added on 04 june 2018 sandeep-->
<!-- change link -->	<?php echo form_open(base_url() . 'index.php?formtutor/marks/' . $exam_id . '/' . $class_id);?>
					<?php  $class_type = strtolower($this->crud_model->get_class_name($class_id)); 
					$jss = "no";
					if(strpos($class_type, 'jss') !== false ){
						$jss = "yes";
					}
					
					if (strpos($class_type, 'ss') !== false && $jss !='yes'){
					?>
				<table cellpadding="0" cellspacing="0" border="0" class="tg">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A (70%)</th>
							<th class="tg-yw4l" rowspan="2">EXAM (30%)</th>
							<th class="tg-yw4l" rowspan="2">TOTAL (100%)</th>
							<th class="tg-yw4l" rowspan="2">EFFORT</th>
							<th class="tg-yw4l" colspan="5"> SUBJECT TEACHER'S REMARKS</th>
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
						$students	=	$this->crud_model->get_subjects_by_class2($class_id,$student_id);
						foreach($students as $row):
						
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$get_system_settings[17]['description']);
														
							$query = $this->db->get_where('mark' , $verify_data);							 
							$marks	=	$query->result_array();
							foreach($marks as $row2):
							?>
                     
							<tr>
								<td>
									<?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']);?>
								</td>
								<td class="tg-yw4l"><input type="text" class="class_score form-control" value="<?php echo $row2['ca_marks'];?>" name="ca_marks_<?php echo $row['subject_id'];?>" id="ca_marks_<?php echo $row['subject_id'];?>" onchange="class_score_change1('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="class_score2 form-control" value="<?php echo $row2['mark_obtained'];?>" name="mark_obtained_<?php echo $row['subject_id'];?>" id="mark_obtained_<?php echo $row['subject_id'];?>" onchange="class_score_change2('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="form-control" value="<?php echo $row2['mark_total'];?>"  name="mark_total_<?php echo $row['subject_id'];?>" id="mark_total_<?php echo $row['subject_id'];?>" ></td>
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
							endforeach;
						 endforeach;
						 ?>
						 
                     </tbody>
			   </table>
			   
			   <hr>
			
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
						<th colspan = "8" class="tg-yw4l">APPTITUDE, WORK HABBITS, TRAITS AND SOCIAL SKILLS</th>
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
						<td  colspan = "5">Works indipendently.</td>
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
						<td  colspan = "5">makes intelligent contributions in the class.</td>
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
						<td  colspan = "5">is attentive and follows directions.</td>
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
						<td  colspan = "5">checks and correct assignments.</td>
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
						<td  colspan = "5">enjoys the conpany of classmates.</td>
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

			<hr>

	<!--COMMENT AREA-->
			<table style="width:100%; vertical-align: bottom;">
			<?php //echo $exam_id;
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
					</tr>
					<tr>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['TeacherName'];?>" name="TeacherName"></td>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['VPName'];?>" name="VPName"></td>
					</tr>
					
					<tr>
						<th>Teacher's Comment</th>
						<th>Vice Principal's Comment</th>
					</tr>
					<tr>
						<td><textarea class="class_score form-control" value="<?php echo $row['TeacherComment'];?>" cols="30" name = "TeacherComment"><?php echo $row['TeacherComment'];?></textarea></td>
						<td><textarea class="class_score form-control" value="<?php echo $row['VPComment'];?>" cols="30" name = "VPComment"><?php echo $row['VPComment'];?></textarea></td>
					</tr>
			<?php 
				endforeach;
			?>
			</table>
				 
	
<!-- Junior Secondary -->
				 <?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){ ?>
					<table cellpadding="0" cellspacing="0" border="0" class="tg">
                    	<thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A (60%)</th>
							<th class="tg-yw4l" rowspan="2">EXAM (40%)</th>
							<th class="tg-yw4l" rowspan="2">TOTAL (100%)</th>
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
						$students	=	$this->crud_model->get_subjects_by_class1($class_id);
						foreach($students as $row):
						
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$get_system_settings[17]['description']);
														
							$query = $this->db->get_where('mark' , $verify_data);							 
							$marks	=	$query->result_array();
							foreach($marks as $row2):
					?>
     <!-- change link -->	<?php echo form_open(base_url() . 'index.php?formtutor/marks/' . $exam_id . '/' . $class_id);?>
							<tr>
								<td>
									<?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']);;?>
								</td>
								<td class="tg-yw4l"><input type="text" class="class_score form-control" value="<?php echo $row2['ca_marks'];?>" name="ca_marks_<?php echo $row['subject_id'];?>" id="ca_marks_<?php echo $row['subject_id'];?>" onchange="class_score_change1_jss('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="class_score2 form-control" value="<?php echo $row2['mark_obtained'];?>" name="mark_obtained_<?php echo $row['subject_id'];?>" id="mark_obtained_<?php echo $row['subject_id'];?>" onchange="class_score_change2_jss('<?php echo $row['subject_id'];?>')" ></td>
								<td class="tg-yw4l"><input type="text" class="form-control" value="<?php echo $row2['mark_total'];?>"  name="mark_total_<?php echo $row['subject_id'];?>" id="mark_total_<?php echo $row['subject_id'];?>" ></td>
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
							endforeach;
						endforeach;
						 ?>
                     </tbody>
			   </table>

			   <hr>

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
						<th colspan = "8" class="tg-yw4l">APPTITUDE, WORK HABBITS, TRAITS AND SOCIAL SKILLS</th>
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
						<td  colspan = "5">Works indipendently.</td>
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
						<td  colspan = "5">makes intelligent contributions in the class.</td>
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
						<td  colspan = "5">is attentive and follows directions.</td>
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
						<td  colspan = "5">checks and correct assignments.</td>
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
						<td  colspan = "5">enjoys the conpany of classmates.</td>
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

			<hr>

	<!--COMMENT AREA-->
			<table style="width:100%; vertical-align: bottom;">
			<?php //echo $exam_id;
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
					</tr>
					<tr>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['TeacherName'];?>" name="TeacherName"></td>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['VPName'];?>" name="VPName"></td>
					</tr>
					
					<tr>
						<th>Vice Principal's Comment</th>
						<th>Head Teacher's Comment</th>
					</tr>
					<tr>
						<td><textarea class="class_score form-control" value="<?php echo $row['TeacherComment'];?>" cols="30" name = "TeacherComment"><?php echo $row['TeacherComment'];?></textarea></td>
						<td><textarea class="class_score form-control" value="<?php echo $row['VPComment'];?>" cols="30" name = "VPComment"><?php echo $row['VPComment'];?></textarea></td>
					</tr>
			<?php 
				endforeach;
			?>
			</table>

						 
						
<!-- Primary -->
				<?php } else if (strpos($class_type, 'primary') !== false || strpos($class_type, 'pri') !== false){ ?>
					<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 71%;display: inline-block;vertical-align: top;">
						<tbody>
						<tr><td colspan="13"></td>
							<td colspan="26" style="text-align: center;">SCORES</td>
							<td colspan="6" style="text-align: center;"></td>
							
						</tr>
						<?php 
						   	$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
											'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
							$query_grade = $this->db->get_where('primary_student_grade' , $verify_data);
						
							if($query_grade->num_rows() < 1){
								$this->db->insert('primary_student_grade' , $verify_data);
							}
							$student_grades = $query_grade->result_array();
						?>
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
							<td colspan="6" style="text-align: center;">REMARK</td>
							
							
							
						</tr>
						 <?php 
							 
						$students	=	$this->crud_model->get_subjects_by_class1($class_id);
						$i=0;
						foreach($students as $row):
							$i++;
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$get_system_settings[17]['description']);
														
							$query = $this->db->get_where('mark' , $verify_data);							 
							$marks	=	$query->result_array();
							foreach($marks as $row2):
							?>

									<tr>
										<td><?php echo $i; ?></td>
										<td colspan="12"><?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']);?></td>
										<td colspan="3"><input type="text" class="class_score form-control" value="<?php echo $row2['ca_1'];?>" name="ca_1_<?php echo $row['subject_id'];?>" id="ca_1_<?php echo $row['subject_id'];?>" onchange="ca_1('<?php echo $row['subject_id'];?>')" ></td>
										<td colspan="3"><input type="text" class="class_score2 form-control" value="<?php echo $row2['cw'];?>" name="cw_<?php echo $row['subject_id'];?>" id="cw_<?php echo $row['subject_id'];?>" onchange="cw('<?php echo $row['subject_id'];?>')" ></td>
										<td colspan="3"><input type="text" class="class_score3 form-control" value="<?php echo $row2['ca_2'];?>" name="ca_2_<?php echo $row['subject_id'];?>" id="ca_2_<?php echo $row['subject_id'];?>" onchange="ca_2('<?php echo $row['subject_id'];?>')" ></td>
										<td colspan="5"><input type="text" class="class_score3 form-control" value="<?php echo $row2['project_score'];?>" name="project_score_<?php echo $row['subject_id'];?>" id="project_score_<?php echo $row['subject_id'];?>" onchange="project_score('<?php echo $row['subject_id'];?>')" ></td>
										<td colspan="5"><input type="text" class="class_score4 form-control" value="<?php echo $row2['ca_marks'];?>" name="ca_marks_<?php echo $row['subject_id'];?>" id="ca_marks_<?php echo $row['subject_id'];?>"  ></td>
										<td colspan="4"><input type="text" class="class_score5 form-control" value="<?php echo $row2['mark_obtained'];?>" name="mark_obtained_<?php echo $row['subject_id'];?>" id="mark_obtained_<?php echo $row['subject_id'];?>"   onchange="mark_obtained('<?php echo $row['subject_id'];?>')" ></td>
										<td colspan="3"><input type="text" class="class_score6 form-control" value="<?php echo $row2['mark_total'];?>" name="mark_total_<?php echo $row['subject_id'];?>" id="mark_total_<?php echo $row['subject_id'];?>"    ></td>										
										<td width="15%">
											<select  class="class_score form-control"  name="remark_<?php echo $row['subject_id'];?>" required>
												<option value="" >Select remark</option>
												<option value="EXCELLENT" <?php if($row2['remark'] =='EXCELLENT'){ echo "selected";}?>>EXCELLENT</option>
												<option value="VERY GOOD" <?php if($row2['remark'] =='VERY GOOD'){ echo "selected";}?>>VERY GOOD</option>
												<option value="GOOD" <?php if($row2['remark'] =='GOOD'){ echo "selected";}?>>GOOD</option>
												<option value="PASS" <?php if($row2['remark'] =='PASS'){ echo "selected";}?>>PASS</option>
												<option value="FAIL" <?php if($row2['remark'] =='FAIL'){ echo "selected";}?>>FAIL</option>
											</select>
										</td>
										
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
				
				<table style="width: 20%;display: inline-block;vertical-align: top;">
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
						<td colspan="6">Puntuality</td>
						<td><input type ="radio" name="punctuality_grade" <?php if($student_grades[0]['punctuality_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="punctuality_grade" value="B" <?php if($student_grades[0]['punctuality_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="punctuality_grade" value="C" <?php if($student_grades[0]['punctuality_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="punctuality_grade" value="D" <?php if($student_grades[0]['punctuality_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="punctuality_grade" value="E" <?php if($student_grades[0]['punctuality_grade'] =='E'){ echo "checked"; } ?>></td>
											
					</tr>
					<tr>
					<td colspan="6">Mental Alertness</td>
						<td><input type ="radio" name="mental_grade" <?php if($student_grades[0]['mental_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="mental_grade" value="B" <?php if($student_grades[0]['mental_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="mental_grade" value="C" <?php if($student_grades[0]['mental_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="mental_grade" value="D" <?php if($student_grades[0]['mental_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="mental_grade" value="E" <?php if($student_grades[0]['mental_grade'] =='E'){ echo "checked"; } ?>></td>
								
					</tr>
					<tr>
					<td colspan="6">Respect for Authority</td>
							<td><input type ="radio" name="respect_grade" <?php if($student_grades[0]['respect_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
							<td><input type ="radio" name="respect_grade" value="B" <?php if($student_grades[0]['respect_grade'] =='B'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="respect_grade" value="C" <?php if($student_grades[0]['respect_grade'] =='C'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="respect_grade" value="D" <?php if($student_grades[0]['respect_grade'] =='D'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="respect_grade" value="E" <?php if($student_grades[0]['respect_grade'] =='E'){ echo "checked"; } ?>></td>
								
					</tr>
					<tr>
					<td colspan="6">Neatness</td>
							<td><input type ="radio" name="neatness_grade" <?php if($student_grades[0]['neatness_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
							<td><input type ="radio" name="neatness_grade" value="B" <?php if($student_grades[0]['neatness_grade'] =='B'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="neatness_grade" value="C" <?php if($student_grades[0]['neatness_grade'] =='C'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="neatness_grade" value="D" <?php if($student_grades[0]['neatness_grade'] =='D'){ echo "checked"; } ?>></td>
							<td><input type ="radio" name="neatness_grade" value="E" <?php if($student_grades[0]['neatness_grade'] =='E'){ echo "checked"; } ?>></td>
								
					</tr>
					<tr>
						<td colspan="6">POLITNESS</td>
						<td><input type ="radio" name="politness_grade" <?php if($student_grades[0]['politness_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="politness_grade" value="B" <?php if($student_grades[0]['politness_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="politness_grade" value="C" <?php if($student_grades[0]['politness_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="politness_grade" value="D" <?php if($student_grades[0]['politness_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="politness_grade" value="E" <?php if($student_grades[0]['politness_grade'] =='E'){ echo "checked"; } ?>></td>
			
					</tr>
					<tr>
						<td colspan="6">HONESTY</td>
						<td><input type ="radio" name="honesty_grade" <?php if($student_grades[0]['honesty_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="honesty_grade" value="B" <?php if($student_grades[0]['honesty_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="honesty_grade" value="C" <?php if($student_grades[0]['honesty_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="honesty_grade" value="D" <?php if($student_grades[0]['honesty_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="honesty_grade" value="E" <?php if($student_grades[0]['honesty_grade'] =='E'){ echo "checked"; } ?>></td>
			
					</tr>
					<tr>
						<td colspan="6">RELATIONSHIP WITH PEERS</td>
						<td><input type ="radio" name="peers_grade" <?php if($student_grades[0]['peers_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="peers_grade" value="B" <?php if($student_grades[0]['peers_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="peers_grade" value="C" <?php if($student_grades[0]['peers_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="peers_grade" value="D" <?php if($student_grades[0]['peers_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="peers_grade" value="E" <?php if($student_grades[0]['peers_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>
						<td colspan="6">WILLINGNESS TO LEARN</td>
						<td><input type ="radio" name="learn_grade" <?php if($student_grades[0]['learn_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="learn_grade" value="B" <?php if($student_grades[0]['learn_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="learn_grade" value="C" <?php if($student_grades[0]['learn_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="learn_grade" value="D" <?php if($student_grades[0]['learn_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="learn_grade" value="E" <?php if($student_grades[0]['learn_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>
						<td colspan="6">SPIRIT OF TEAMWORK</td>
						<td><input type ="radio" name="teamwork_grade" <?php if($student_grades[0]['teamwork_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="teamwork_grade" value="B" <?php if($student_grades[0]['teamwork_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="teamwork_grade" value="C" <?php if($student_grades[0]['teamwork_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="teamwork_grade" value="D" <?php if($student_grades[0]['teamwork_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="teamwork_grade" value="E" <?php if($student_grades[0]['teamwork_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>
						<td colspan="6">HEALTH</td>
						<td><input type ="radio" name="health_grade" <?php if($student_grades[0]['health_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="health_grade" value="B" <?php if($student_grades[0]['health_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="health_grade" value="C" <?php if($student_grades[0]['health_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="health_grade" value="D" <?php if($student_grades[0]['health_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="health_grade" value="E" <?php if($student_grades[0]['health_grade'] =='E'){ echo "checked"; } ?>></td>
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
						<td><input type ="radio" name="verbal_grade" <?php if($student_grades[0]['verbal_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="verbal_grade" value="B" <?php if($student_grades[0]['verbal_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="verbal_grade" value="C" <?php if($student_grades[0]['verbal_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="verbal_grade" value="D" <?php if($student_grades[0]['verbal_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="verbal_grade" value="E" <?php if($student_grades[0]['verbal_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>
						<td colspan="6">PARTICIPATION IN SPORTS</td>
						<td><input type ="radio" name="sports_grade" <?php if($student_grades[0]['sports_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="sports_grade" value="B" <?php if($student_grades[0]['sports_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="sports_grade" value="C" <?php if($student_grades[0]['sports_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="sports_grade" value="D" <?php if($student_grades[0]['sports_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="sports_grade" value="E" <?php if($student_grades[0]['sports_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>
						<td colspan="6">ARTISTIC/CREATIVITY</td>
						<td><input type ="radio" name="creativity_grade" <?php if($student_grades[0]['creativity_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="creativity_grade" value="B" <?php if($student_grades[0]['creativity_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="creativity_grade" value="C" <?php if($student_grades[0]['creativity_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="creativity_grade" value="D" <?php if($student_grades[0]['creativity_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="creativity_grade" value="E" <?php if($student_grades[0]['creativity_grade'] =='E'){ echo "checked"; } ?>></td>
					</tr>
					<tr>

					<td colspan="6">MUSIC SKILLS</td>
						<td><input type ="radio" name="music_grade" <?php if($student_grades[0]['music_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="music_grade" value="B" <?php if($student_grades[0]['music_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="music_grade" value="C" <?php if($student_grades[0]['music_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="music_grade" value="D" <?php if($student_grades[0]['music_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="music_grade" value="E" <?php if($student_grades[0]['music_grade'] =='E'){ echo "checked"; } ?>></td>
								
					</tr>
					<tr>
					<td colspan="6">DANCE SKILLS</td>
						<td><input type ="radio" name="dance_grade" <?php if($student_grades[0]['dance_grade'] =='A'){ echo "checked"; } ?> value="A"></td>
						<td><input type ="radio" name="dance_grade" value="B" <?php if($student_grades[0]['dance_grade'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="dance_grade" value="C" <?php if($student_grades[0]['dance_grade'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="dance_grade" value="D" <?php if($student_grades[0]['dance_grade'] =='D'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="dance_grade" value="E" <?php if($student_grades[0]['dance_grade'] =='E'){ echo "checked"; } ?>></td>
								
					
				</tbody>
			</table>

			<!--COMMENT AREA-->
			<table style="width:100%; vertical-align: bottom;">
			<?php 
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
					</tr>
					<tr>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['TeacherName'];?>" name="TeacherName"></td>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['HeadTeacherName'];?>" name="HeadTeacherName"></td>
					</tr>
					
					<tr>
						<th>Teacher's Comment</th>
						<th>Head Teacher's Comment</th>
					</tr>
					<tr>
						<td><textarea class="class_score form-control" value="<?php echo $row['TeacherComment'];?>" cols="30" name = "TeacherComment"><?php echo $row['TeacherComment'];?></textarea></td>
						<td><textarea class="class_score form-control" value="<?php echo $row['HeadTeacherComment'];?>" cols="30" name = "HeadTeacherComment"><?php echo $row['HeadTeacherComment'];?></textarea></td>
					</tr>
				<?php endforeach; ?>

			</table>

<!-- Nursery -->
<?php }else if (strpos($class_type, 'nursery') !== false || strpos($class_type, 'nur') !== false || strpos($class_type, 'toddler') !== false){ ?>
		<style>
			table, tr, td, th {    border: 1px solid #000;border-collapse: collapse;font-family: sans-serif;font-size: 14px;}
			th { padding: 10px; margin-left: 100px;}td span {font-size: 13px; margin-left: 2px;}th {height: 130px;}
			.text-transform span {float: left;width: 100%;margin: 0 0 0 -22px;}
			.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); transform: rotate(270deg); width: 60px; max-width: 60px;}
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
					<th style="width:20px" class="text-transform"><span>Exceeding</span></th>
					<th class="text-transform"><span>Meeting Exceptations</span></th>
					<th class="text-transform"><span>Emerging Exceptations</span></th>
					<th class="text-transform"><span>Not Assessed</span></th>
					<th colspan="12"><span>SUBJECTS</span></th>
					<th class="text-transform"><span>Exceeding</span></th>
					<th class="text-transform"><span>Meeting Exceptations</span></th>
					<th class="text-transform"><span>Emerging Exceptations</span></th>
					<th class="text-transform"><span>Not Assessed</span></th>
					<th colspan="12"><span>SUBJECTS</span></th>
					<th class="text-transform"><span>Exceeding</span></th>
					<th class="text-transform"><span>Meeting Exceptations</span></th>
					<th class="text-transform"><span>Emerging Exceptations</span></th>
					<th class="text-transform"><span>Not Assessed</span></th>
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
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 1))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language" value="A" <?php if($nursub[0]['language'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language" value="B" <?php if($nursub[0]['language'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language" value="C" <?php if($nursub[0]['language'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language" value="D" <?php if($nursub[0]['language'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social" value="A" <?php if($nursub[0]['social'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social" value="B" <?php if($nursub[0]['social'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social" value="C" <?php if($nursub[0]['social'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social" value="D" <?php if($nursub[0]['social'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge" value="A" <?php if($nursub[0]['knowledge'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge" value="B" <?php if($nursub[0]['knowledge'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge" value="C" <?php if($nursub[0]['knowledge'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge" value="D" <?php if($nursub[0]['knowledge'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 2))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language1" value="A" <?php if($nursub[0]['language1'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language1" value="B" <?php if($nursub[0]['language1'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language1" value="C" <?php if($nursub[0]['language1'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language1" value="D" <?php if($nursub[0]['language1'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social100" value="A" <?php if($nursub[0]['social100'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social100" value="B" <?php if($nursub[0]['social100'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social100" value="C" <?php if($nursub[0]['social100'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social100" value="D" <?php if($nursub[0]['social100'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge200" value="A" <?php if($nursub[0]['knowledge200'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge200" value="B" <?php if($nursub[0]['knowledge200'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge200" value="C" <?php if($nursub[0]['knowledge200'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge200" value="D" <?php if($nursub[0]['knowledge200'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 3))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language2" value="A" <?php if($nursub[0]['language2'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language2" value="B" <?php if($nursub[0]['language2'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language2" value="C" <?php if($nursub[0]['language2'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language2" value="D" <?php if($nursub[0]['language2'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social102" value="A" <?php if($nursub[0]['social102'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social102" value="B" <?php if($nursub[0]['social102'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social102" value="C" <?php if($nursub[0]['social102'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social102" value="D" <?php if($nursub[0]['social102'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge202" value="A" <?php if($nursub[0]['knowledge202'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge202" value="B" <?php if($nursub[0]['knowledge202'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge202" value="C" <?php if($nursub[0]['knowledge202'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge202" value="D" <?php if($nursub[0]['knowledge202'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 4))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language3" value="A" <?php if($nursub[0]['language3'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language3" value="B" <?php if($nursub[0]['language3'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language3" value="C" <?php if($nursub[0]['language3'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language3" value="D" <?php if($nursub[0]['language3'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social103" value="A" <?php if($nursub[0]['social103'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social103" value="B" <?php if($nursub[0]['social103'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social103" value="C" <?php if($nursub[0]['social103'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social103" value="D" <?php if($nursub[0]['social103'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge203" value="A" <?php if($nursub[0]['knowledge203'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge203" value="B" <?php if($nursub[0]['knowledge203'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge203" value="C" <?php if($nursub[0]['knowledge203'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge203" value="D" <?php if($nursub[0]['knowledge203'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 5))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language4" value="A" <?php if($nursub[0]['language4'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language4" value="B" <?php if($nursub[0]['language4'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language4" value="C" <?php if($nursub[0]['language4'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language4" value="D" <?php if($nursub[0]['language4'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social104" value="A" <?php if($nursub[0]['social104'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social104" value="B" <?php if($nursub[0]['social104'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social104" value="C" <?php if($nursub[0]['social104'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social104" value="D" <?php if($nursub[0]['social104'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge204" value="A" <?php if($nursub[0]['knowledge204'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge204" value="B" <?php if($nursub[0]['knowledge204'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge204" value="C" <?php if($nursub[0]['knowledge204'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge204" value="D" <?php if($nursub[0]['knowledge204'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 6))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language5" value="A" <?php if($nursub[0]['language5'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language5" value="B" <?php if($nursub[0]['language5'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language5" value="C" <?php if($nursub[0]['language5'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language5" value="D" <?php if($nursub[0]['language5'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social105" value="A" <?php if($nursub[0]['social105'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social105" value="B" <?php if($nursub[0]['social105'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social105" value="C" <?php if($nursub[0]['social105'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social105" value="D" <?php if($nursub[0]['social105'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge205" value="A" <?php if($nursub[0]['knowledge205'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge205" value="B" <?php if($nursub[0]['knowledge205'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge205" value="C" <?php if($nursub[0]['knowledge205'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge205" value="D" <?php if($nursub[0]['knowledge205'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 7))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language6" value="A" <?php if($nursub[0]['language6'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language6" value="B" <?php if($nursub[0]['language6'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language6" value="C" <?php if($nursub[0]['language6'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language6" value="D" <?php if($nursub[0]['language6'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social106" value="A" <?php if($nursub[0]['social106'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social106" value="B" <?php if($nursub[0]['social106'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social106" value="C" <?php if($nursub[0]['social106'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social106" value="D" <?php if($nursub[0]['social106'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge206" value="A" <?php if($nursub[0]['knowledge206'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge206" value="B" <?php if($nursub[0]['knowledge206'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge206" value="C" <?php if($nursub[0]['knowledge206'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge206" value="D" <?php if($nursub[0]['knowledge206'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 8))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language7" value="A" <?php if($nursub[0]['language7'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language7" value="B" <?php if($nursub[0]['language7'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language7" value="C" <?php if($nursub[0]['language7'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language7" value="D" <?php if($nursub[0]['language7'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social107" value="A" <?php if($nursub[0]['social107'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social107" value="B" <?php if($nursub[0]['social107'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social107" value="C" <?php if($nursub[0]['social107'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social107" value="D" <?php if($nursub[0]['social107'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge207" value="A" <?php if($nursub[0]['knowledge207'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge207" value="B" <?php if($nursub[0]['knowledge207'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge207" value="C" <?php if($nursub[0]['knowledge207'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge207" value="D" <?php if($nursub[0]['knowledge207'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 9))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language8" value="A" <?php if($nursub[0]['language8'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language8" value="B" <?php if($nursub[0]['language8'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language8" value="C" <?php if($nursub[0]['language8'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language8" value="D" <?php if($nursub[0]['language8'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social108" value="A" <?php if($nursub[0]['social108'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social108" value="B" <?php if($nursub[0]['social108'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social108" value="C" <?php if($nursub[0]['social108'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social108" value="D" <?php if($nursub[0]['social108'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge208" value="A" <?php if($nursub[0]['knowledge208'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge208" value="B" <?php if($nursub[0]['knowledge208'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge208" value="C" <?php if($nursub[0]['knowledge208'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge208" value="D" <?php if($nursub[0]['knowledge208'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 10))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language9" value="A" <?php if($nursub[0]['language9'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language9" value="B" <?php if($nursub[0]['language9'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language9" value="C" <?php if($nursub[0]['language9'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language9" value="D" <?php if($nursub[0]['language9'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social109" value="A" <?php if($nursub[0]['social109'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social109" value="B" <?php if($nursub[0]['social109'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social109" value="C" <?php if($nursub[0]['social109'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social109" value="D" <?php if($nursub[0]['social109'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge209" value="A" <?php if($nursub[0]['knowledge209'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge209" value="B" <?php if($nursub[0]['knowledge209'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge209" value="C" <?php if($nursub[0]['knowledge209'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge209" value="D" <?php if($nursub[0]['knowledge209'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 11))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language10" value="A" <?php if($nursub[0]['language10'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language10" value="B" <?php if($nursub[0]['language10'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language10" value="C" <?php if($nursub[0]['language10'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language10" value="D" <?php if($nursub[0]['language10'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social110" value="A" <?php if($nursub[0]['social110'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social110" value="B" <?php if($nursub[0]['social110'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social110" value="C" <?php if($nursub[0]['social110'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social110" value="D" <?php if($nursub[0]['social110'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge210" value="A" <?php if($nursub[0]['knowledge210'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge210" value="B" <?php if($nursub[0]['knowledge210'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge210" value="C" <?php if($nursub[0]['knowledge210'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge210" value="D" <?php if($nursub[0]['knowledge210'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 12))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language11" value="A" <?php if($nursub[0]['language11'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language11" value="B" <?php if($nursub[0]['language11'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language11" value="C" <?php if($nursub[0]['language11'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language11" value="D" <?php if($nursub[0]['language11'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social111" value="A" <?php if($nursub[0]['social111'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social111" value="B" <?php if($nursub[0]['social111'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social111" value="C" <?php if($nursub[0]['social111'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social111" value="D" <?php if($nursub[0]['social111'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 13))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language12" value="A" <?php if($nursub[0]['language12'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language12" value="B" <?php if($nursub[0]['language12'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language12" value="C" <?php if($nursub[0]['language12'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language12" value="D" <?php if($nursub[0]['language12'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social112" value="A" <?php if($nursub[0]['social112'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social112" value="B" <?php if($nursub[0]['social112'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social112" value="C" <?php if($nursub[0]['social112'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social112" value="D" <?php if($nursub[0]['social112'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><strong><?php echo $row[0]['knowledge']?></strong><span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 14))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language13" value="A" <?php if($nursub[0]['language13'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language13" value="B" <?php if($nursub[0]['language13'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language13" value="C" <?php if($nursub[0]['language13'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language13" value="D" <?php if($nursub[0]['language13'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social113" value="A" <?php if($nursub[0]['social113'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social113" value="B" <?php if($nursub[0]['social113'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social113" value="C" <?php if($nursub[0]['social113'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social113" value="D" <?php if($nursub[0]['social113'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge213" value="A" <?php if($nursub[0]['knowledge213'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge213" value="B" <?php if($nursub[0]['knowledge213'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge213" value="C" <?php if($nursub[0]['knowledge213'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge213" value="D" <?php if($nursub[0]['knowledge213'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 15))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language14" value="A" <?php if($nursub[0]['language14'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language14" value="B" <?php if($nursub[0]['language14'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language14" value="C" <?php if($nursub[0]['language14'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language14" value="D" <?php if($nursub[0]['language14'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social114" value="A" <?php if($nursub[0]['social114'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social114" value="B" <?php if($nursub[0]['social114'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social114" value="C" <?php if($nursub[0]['social114'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social114" value="D" <?php if($nursub[0]['social114'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge214" value="A" <?php if($nursub[0]['knowledge214'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge214" value="B" <?php if($nursub[0]['knowledge214'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge214" value="C" <?php if($nursub[0]['knowledge214'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge214" value="D" <?php if($nursub[0]['knowledge214'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 16))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language15" value="A" <?php if($nursub[0]['language15'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language15" value="B" <?php if($nursub[0]['language15'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language15" value="C" <?php if($nursub[0]['language15'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language15" value="D" <?php if($nursub[0]['language15'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social115" value="A" <?php if($nursub[0]['social115'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social115" value="B" <?php if($nursub[0]['social115'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social115" value="C" <?php if($nursub[0]['social115'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social115" value="D" <?php if($nursub[0]['social115'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge215" value="A" <?php if($nursub[0]['knowledge215'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge215" value="B" <?php if($nursub[0]['knowledge215'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge215" value="C" <?php if($nursub[0]['knowledge215'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge215" value="D" <?php if($nursub[0]['knowledge215'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 17))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge216" value="A" <?php if($nursub[0]['knowledge216'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge216" value="B" <?php if($nursub[0]['knowledge216'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge216" value="C" <?php if($nursub[0]['knowledge216'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge216" value="D" <?php if($nursub[0]['knowledge216'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 18))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge217" value="A" <?php if($nursub[0]['knowledge217'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge217" value="B" <?php if($nursub[0]['knowledge217'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge217" value="C" <?php if($nursub[0]['knowledge217'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge217" value="D" <?php if($nursub[0]['knowledge217'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 19))->result_array();?>
					<td colspan="12"><span><strong><?php echo $row[0]['language']?></strong></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><strong><?php echo $row[0]['social']?></strong></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><strong><?php echo $row[0]['knowledge']?></strong></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 20))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language19" value="A" <?php if($nursub[0]['language19'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language19" value="B" <?php if($nursub[0]['language19'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language19" value="C" <?php if($nursub[0]['language19'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language19" value="D" <?php if($nursub[0]['language19'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social119" value="A" <?php if($nursub[0]['social119'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social119" value="B" <?php if($nursub[0]['social119'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social119" value="C" <?php if($nursub[0]['social119'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social119" value="D" <?php if($nursub[0]['social119'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge219" value="A" <?php if($nursub[0]['knowledge219'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge219" value="B" <?php if($nursub[0]['knowledge219'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge219" value="C" <?php if($nursub[0]['knowledge219'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge219" value="D" <?php if($nursub[0]['knowledge219'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 21))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language20" value="A" <?php if($nursub[0]['language20'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language20" value="B" <?php if($nursub[0]['language20'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language20" value="C" <?php if($nursub[0]['language20'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language20" value="D" <?php if($nursub[0]['language20'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social120" value="A" <?php if($nursub[0]['social120'] =='A'){ echo "checked"; } ?> ></td>
						<td><input type ="radio" name="social120" value="B" <?php if($nursub[0]['social120'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social120" value="C" <?php if($nursub[0]['social120'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social120" value="D" <?php if($nursub[0]['social120'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge220" value="A" <?php if($nursub[0]['knowledge220'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge220" value="B" <?php if($nursub[0]['knowledge220'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge220" value="C" <?php if($nursub[0]['knowledge220'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge220" value="D" <?php if($nursub[0]['knowledge220'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 22))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language21" value="A" <?php if($nursub[0]['language21'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language21" value="B" <?php if($nursub[0]['language21'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language21" value="C" <?php if($nursub[0]['language21'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language21" value="D" <?php if($nursub[0]['language21'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social121" value="A" <?php if($nursub[0]['social121'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social121" value="B" <?php if($nursub[0]['social121'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social121" value="C" <?php if($nursub[0]['social121'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social121" value="D" <?php if($nursub[0]['social121'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge221" value="A" <?php if($nursub[0]['knowledge221'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge221" value="B" <?php if($nursub[0]['knowledge221'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge221" value="C" <?php if($nursub[0]['knowledge221'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge221" value="D" <?php if($nursub[0]['knowledge221'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 23))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language22" value="A" <?php if($nursub[0]['language22'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language22" value="B" <?php if($nursub[0]['language22'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language22" value="C" <?php if($nursub[0]['language22'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language22" value="D" <?php if($nursub[0]['language22'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social122" value="A" <?php if($nursub[0]['social122'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social122" value="B" <?php if($nursub[0]['social122'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social122" value="C" <?php if($nursub[0]['social122'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social122" value="D" <?php if($nursub[0]['social122'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge222" value="A" <?php if($nursub[0]['knowledge222'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge222" value="B" <?php if($nursub[0]['knowledge222'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge222" value="C" <?php if($nursub[0]['knowledge222'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge222" value="D" <?php if($nursub[0]['knowledge222'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 24))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language23" value="A" <?php if($nursub[0]['language23'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language23" value="B" <?php if($nursub[0]['language23'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language23" value="C" <?php if($nursub[0]['language23'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language23" value="D" <?php if($nursub[0]['language23'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social123" value="A" <?php if($nursub[0]['social123'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social123" value="B" <?php if($nursub[0]['social123'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social123" value="C" <?php if($nursub[0]['social123'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social123" value="D" <?php if($nursub[0]['social123'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge223" value="A" <?php if($nursub[0]['knowledge223'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge223" value="B" <?php if($nursub[0]['knowledge223'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge223" value="C" <?php if($nursub[0]['knowledge223'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge223" value="D" <?php if($nursub[0]['knowledge223'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 25))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language24" value="A" <?php if($nursub[0]['language24'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language24" value="B" <?php if($nursub[0]['language24'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language24" value="C" <?php if($nursub[0]['language24'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language24" value="D" <?php if($nursub[0]['language24'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social124" value="A" <?php if($nursub[0]['social124'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social124" value="B" <?php if($nursub[0]['social124'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social124" value="C" <?php if($nursub[0]['social124'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social124" value="D" <?php if($nursub[0]['social124'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge224" value="A" <?php if($nursub[0]['knowledge224'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge224" value="B" <?php if($nursub[0]['knowledge224'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge224" value="C" <?php if($nursub[0]['knowledge224'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge224" value="D" <?php if($nursub[0]['knowledge224'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 26))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language25" value="A" <?php if($nursub[0]['language25'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language25" value="B" <?php if($nursub[0]['language25'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language25" value="C" <?php if($nursub[0]['language25'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language25" value="D" <?php if($nursub[0]['language25'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social125" value="A" <?php if($nursub[0]['social125'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social125" value="B" <?php if($nursub[0]['social125'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social125" value="C" <?php if($nursub[0]['social125'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social125" value="D" <?php if($nursub[0]['social125'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge225" value="A" <?php if($nursub[0]['knowledge225'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge225" value="B" <?php if($nursub[0]['knowledge225'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge225" value="C" <?php if($nursub[0]['knowledge225'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge225" value="D" <?php if($nursub[0]['knowledge225'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 27))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language26" value="A" <?php if($nursub[0]['language26'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language26" value="B" <?php if($nursub[0]['language26'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language26" value="C" <?php if($nursub[0]['language26'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language26" value="D" <?php if($nursub[0]['language26'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social126" value="A" <?php if($nursub[0]['social126'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social126" value="B" <?php if($nursub[0]['social126'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social126" value="C" <?php if($nursub[0]['social126'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social126" value="D" <?php if($nursub[0]['social126'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge226" value="A" <?php if($nursub[0]['knowledge226'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge226" value="B" <?php if($nursub[0]['knowledge226'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge226" value="C" <?php if($nursub[0]['knowledge226'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge226" value="D" <?php if($nursub[0]['knowledge226'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 28))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language27" value="A" <?php if($nursub[0]['language27'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language27" value="B" <?php if($nursub[0]['language27'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language27" value="C" <?php if($nursub[0]['language27'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language27" value="D" <?php if($nursub[0]['language27'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social127" value="A" <?php if($nursub[0]['social127'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social127" value="B" <?php if($nursub[0]['social127'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social127" value="C" <?php if($nursub[0]['social127'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social127" value="D" <?php if($nursub[0]['social127'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge227" value="A" <?php if($nursub[0]['knowledge227'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge227" value="B" <?php if($nursub[0]['knowledge227'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge227" value="C" <?php if($nursub[0]['knowledge227'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge227" value="D" <?php if($nursub[0]['knowledge227'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 29))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language28" value="A" <?php if($nursub[0]['language28'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language28" value="B" <?php if($nursub[0]['language28'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language28" value="C" <?php if($nursub[0]['language28'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language28" value="D" <?php if($nursub[0]['language28'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social128" value="A" <?php if($nursub[0]['social128'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social128" value="B" <?php if($nursub[0]['social128'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social128" value="C" <?php if($nursub[0]['social128'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social128" value="D" <?php if($nursub[0]['social128'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge228" value="A" <?php if($nursub[0]['knowledge228'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge228" value="B" <?php if($nursub[0]['knowledge228'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge228" value="C" <?php if($nursub[0]['knowledge228'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge228" value="D" <?php if($nursub[0]['knowledge228'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 30))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language29" value="A" <?php if($nursub[0]['language29'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language29" value="B" <?php if($nursub[0]['language29'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language29" value="C" <?php if($nursub[0]['language29'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language29" value="D" <?php if($nursub[0]['language29'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social129" value="A" <?php if($nursub[0]['social129'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social129" value="B" <?php if($nursub[0]['social129'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social129" value="C" <?php if($nursub[0]['social129'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social129" value="D" <?php if($nursub[0]['social129'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge229" value="A" <?php if($nursub[0]['knowledge229'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge229" value="B" <?php if($nursub[0]['knowledge229'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge229" value="C" <?php if($nursub[0]['knowledge229'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge229" value="D" <?php if($nursub[0]['knowledge229'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 31))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language30" value="A" <?php if($nursub[0]['language30'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language30" value="B" <?php if($nursub[0]['language30'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language30" value="C" <?php if($nursub[0]['language30'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language30" value="D" <?php if($nursub[0]['language30'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social130" value="A" <?php if($nursub[0]['social130'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social130" value="B" <?php if($nursub[0]['social130'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social130" value="C" <?php if($nursub[0]['social130'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social130" value="D" <?php if($nursub[0]['social130'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge230" value="A" <?php if($nursub[0]['knowledge230'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge230" value="B" <?php if($nursub[0]['knowledge230'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge230" value="C" <?php if($nursub[0]['knowledge230'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge230" value="D" <?php if($nursub[0]['knowledge230'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 32))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language31" value="A" <?php if($nursub[0]['language31'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language31" value="B" <?php if($nursub[0]['language31'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language31" value="C" <?php if($nursub[0]['language31'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language31" value="D" <?php if($nursub[0]['language31'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social131" value="A" <?php if($nursub[0]['social131'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social131" value="B" <?php if($nursub[0]['social131'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social131" value="C" <?php if($nursub[0]['social131'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social131" value="D" <?php if($nursub[0]['social131'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge231" value="A" <?php if($nursub[0]['knowledge231'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge231" value="B" <?php if($nursub[0]['knowledge231'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge231" value="C" <?php if($nursub[0]['knowledge231'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge231" value="D" <?php if($nursub[0]['knowledge231'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 33))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><input type ="radio" name="language32" value="A" <?php if($nursub[0]['language32'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language32" value="B" <?php if($nursub[0]['language32'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language32" value="C" <?php if($nursub[0]['language32'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="language32" value="D" <?php if($nursub[0]['language32'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><input type ="radio" name="social132" value="A" <?php if($nursub[0]['social132'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social132" value="B" <?php if($nursub[0]['social132'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social132" value="C" <?php if($nursub[0]['social132'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="social132" value="D" <?php if($nursub[0]['social132'] =='D'){ echo "checked"; } ?>></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge232" value="A" <?php if($nursub[0]['knowledge232'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge232" value="B" <?php if($nursub[0]['knowledge232'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge232" value="C" <?php if($nursub[0]['knowledge232'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge232" value="D" <?php if($nursub[0]['knowledge232'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 34))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><strong><?php echo $row[0]['knowledge']?></strong></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 35))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge234" value="A" <?php if($nursub[0]['knowledge234'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge234" value="B" <?php if($nursub[0]['knowledge234'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge234" value="C" <?php if($nursub[0]['knowledge234'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge234" value="D" <?php if($nursub[0]['knowledge234'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 36))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge235" value="A" <?php if($nursub[0]['knowledge235'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge235" value="B" <?php if($nursub[0]['knowledge235'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge235" value="C" <?php if($nursub[0]['knowledge235'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge235" value="D" <?php if($nursub[0]['knowledge235'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 37))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge236" value="A" <?php if($nursub[0]['knowledge236'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge236" value="B" <?php if($nursub[0]['knowledge236'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge236" value="C" <?php if($nursub[0]['knowledge236'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge236" value="D" <?php if($nursub[0]['knowledge236'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 38))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge237" value="A" <?php if($nursub[0]['knowledge237'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge237" value="B" <?php if($nursub[0]['knowledge237'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge237" value="C" <?php if($nursub[0]['knowledge237'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge237" value="D" <?php if($nursub[0]['knowledge237'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 39))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge238" value="A" <?php if($nursub[0]['knowledge238'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge238" value="B" <?php if($nursub[0]['knowledge238'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge238" value="C" <?php if($nursub[0]['knowledge238'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge238" value="D" <?php if($nursub[0]['knowledge238'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 40))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge239" value="A" <?php if($nursub[0]['knowledge239'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge239" value="B" <?php if($nursub[0]['knowledge239'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge239" value="C" <?php if($nursub[0]['knowledge239'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge239" value="D" <?php if($nursub[0]['knowledge239'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 41))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><input type ="radio" name="knowledge240" value="A" <?php if($nursub[0]['knowledge240'] =='A'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge240" value="B" <?php if($nursub[0]['knowledge240'] =='B'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge240" value="C" <?php if($nursub[0]['knowledge240'] =='C'){ echo "checked"; } ?>></td>
						<td><input type ="radio" name="knowledge240" value="D" <?php if($nursub[0]['knowledge240'] =='D'){ echo "checked"; } ?>></td>
				</tr>
				
			</tbody>
		</table>

		<br />
		<hr>
		<br />

		<!--COMMENT AREA-->
		<table style="width:100%; vertical-align: bottom;" cellpadding="0" cellspacing="0" border="0" class="tg">
			<?php 
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
					</tr>
					<tr>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['TeacherName'];?>" name="TeacherName"></td>
						<td><input class="class_score6 form-control" type="text" value="<?php echo $row['HeadTeacherName'];?>" name="HeadTeacherName"></td>
					</tr>
					
					<tr>
						<th style="height:10px;">Teacher's Comment</th>
						<th style="height:10px;">Head Teacher's Comment</th>
					</tr>
					<tr>
						<td><textarea class="class_score form-control" value="<?php echo $row['TeacherComment'];?>" cols="30" name = "TeacherComment"><?php echo $row['TeacherComment'];?></textarea></td>
						<td><textarea class="class_score form-control" value="<?php echo $row['HeadTeacherComment'];?>" cols="30" name = "HeadTeacherComment"><?php echo $row['HeadTeacherComment'];?></textarea></td>
					</tr>
				<?php endforeach; ?>

		</table>
			
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
				<a href="<?php echo base_url();?>index.php?formtutor/subject/"><button type="button" class="btn btn-orange btn-icon icon-left btn-sm"><i class="entypo-plus"></i>Add</button></a>
			</div>
		<?php endif;?>
		<h5 id="error_message"  align="center" style="color: red;display: none;margin-left: 50px;"><strong style="color:#FF0000">Class score must be less than 30 or equal to 30 and exam score must be less than or equal to 70</strong></h5>
		
		<?php if($class_id != '' && $class_id < 52):
			$vacation_date = $this->crud_model->get_class_vacation_date($class_id,$exam_id,$get_system_settings[17]['description']);
			
		?>
		 
		<div class="vac-div">
			<label>Vacation Date: </label>
			<input type="text" name="vacation_date" id="datepicker" placeholder="Select Vacation Date" value="<?php echo $vacation_date[0]['vacation_date']; ?>" required>
			<label>Resumption Date: </label>
			<input type="text" name="resumption_date" id="datepicker2" placeholder="Select Resumption Date" value="<?php echo $vacation_date[0]['resumption_date']; ?>" required>
			<input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
     		<button type="submit" class="btn btn-sm btn-icon icon-left btn-orange"><i class="entypo-plus"></i><?php echo get_phrase('update_marks');?></button>
		</div>
		
		<?php endif;?>

		<?php if($class_id != '' && $class_id > 52):
			$vacation_date = $this->crud_model->get_class_vacation_daten($class_id,$exam_id,$get_system_settings[17]['description']);
			
		?>
		 
		<div class="vac-div">
			<label>Vacation Date: </label>
			<input type="text" name="vacation_date" id="datepicker" placeholder="Select Vacation Date" value="<?php echo $vacation_date[0]['vacation_date']; ?>" required>
			<label>Resumption Date: </label>
			<input type="text" name="resumption_date" id="datepicker2" placeholder="Select Resumption Date" value="<?php echo $vacation_date[0]['resumption_date']; ?>" required>
			<input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
     		<button type="submit" class="btn btn-sm btn-icon icon-left btn-orange"><i class="entypo-plus"></i><?php echo get_phrase('update_marks');?></button>
		</div>
		
		<?php endif;?>
                 
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
     if (value > 70) {
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
     if (value > 30) {
        class_scores[i].value = 0;
        $('#error_message').show();
      }
    }
    var ca_mark = $("#ca_marks_"+sub_id).val();
    var mark_obtained = $("#mark_obtained_"+sub_id).val();
    var total = parseInt(ca_mark)+parseInt(mark_obtained);
    $("#mark_total_"+sub_id).val(total);
  }
 function class_score_change1_jss(sub_id) {
  var class_scores = document.getElementsByClassName('class_score');
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
    console.log(ca_mark,mark_obtained);
    $("#mark_total_"+sub_id).val(total);
  }
function class_score_change2_jss(sub_id) {
  var class_scores = document.getElementsByClassName('class_score2');
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
			var cw = $("#cw_"+sub_id).val();
			var project = $("#project_score_"+sub_id).val();
			var totl = parseInt(ca1)+parseInt(ca2)+parseInt(cw)+parseInt(project);
			$("#ca_marks_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtained_"+sub_id).val();
			var ca_score = $("#ca_marks_"+sub_id).val();
			var totl = parseInt(mark_obtained)+parseInt(ca_score);
			$("#mark_total_"+sub_id).val(totl);
		}
	}
	function ca_2(sub_id){
		 $('#error_message').hide();
		var values = $("#ca_2_"+sub_id).val();
		if (values > 20) {
			$("#ca_2_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">Please enter CA2 score must be less than or equal to 20.  </strong>');
		}else{
			var ca1 = $("#ca_1_"+sub_id).val();
			var ca2 = $("#ca_2_"+sub_id).val();
			var cw = $("#cw_"+sub_id).val();
			var project = $("#project_score_"+sub_id).val();
			var totl = parseInt(ca1)+parseInt(ca2)+parseInt(cw)+parseInt(project);
			$("#ca_marks_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtained_"+sub_id).val();
			var ca_score = $("#ca_marks_"+sub_id).val();
			var totl = parseInt(mark_obtained)+parseInt(ca_score);
			$("#mark_total_"+sub_id).val(totl);
		}
	}
	function cw(sub_id){
		 $('#error_message').hide();
		var values = $("#cw_"+sub_id).val();
		if (values > 10) {
			$("#cw_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">Please enter CW score must be less than or equal to 10.  </strong>');
		}else{
			var ca1 = $("#ca_1_"+sub_id).val();
			var ca2 = $("#ca_2_"+sub_id).val();
			var cw = $("#cw_"+sub_id).val();
			var project = $("#project_score_"+sub_id).val();
			var totl = parseInt(ca1)+parseInt(ca2)+parseInt(cw)+parseInt(project);
			$("#ca_marks_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtained_"+sub_id).val();
			var ca_score = $("#ca_marks_"+sub_id).val();
			var totl = parseInt(mark_obtained)+parseInt(ca_score);
			$("#mark_total_"+sub_id).val(totl);
		}
	}
	function project_score(sub_id){
		 $('#error_message').hide();
		var values = $("#project_score_"+sub_id).val();
		if (values > 10) {
			$("#project_score_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">Please enter Project score must be less than or equal to 10.  </strong>');
		}else{
			var ca1 = $("#ca_1_"+sub_id).val();
			var ca2 = $("#ca_2_"+sub_id).val();
			var cw = $("#cw_"+sub_id).val();
			var project = $("#project_score_"+sub_id).val();
			var totl = parseInt(ca1)+parseInt(ca2)+parseInt(cw)+parseInt(project);
			$("#ca_marks_"+sub_id).val(totl);
			
			var mark_obtained = $("#mark_obtained_"+sub_id).val();
			var ca_score = $("#ca_marks_"+sub_id).val();
			var totl = parseInt(mark_obtained)+parseInt(ca_score);
			$("#mark_total_"+sub_id).val(totl);
		}
	}
	function mark_obtained(sub_id){
		 $('#error_message').hide();
		var values = $("#mark_obtained_"+sub_id).val();
		if (values > 40) {
			$("#mark_obtained_"+sub_id).val(0);
			 $('#error_message').show();
			$('#error_message').html('<strong style="color:#FF0000">Please enter mark obtained score must be less than or equal to 40.  </strong>');
		}else{
			var mark_obtained = $("#mark_obtained_"+sub_id).val();
			
			var ca_score = $("#ca_marks_"+sub_id).val();
			var totl = parseInt(mark_obtained)+parseInt(ca_score);
			$("#mark_total_"+sub_id).val(totl);
		}
	}

</script> 