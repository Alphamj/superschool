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
					 <?php echo get_phrase('report_card'); ?>
					</div>
					</div>
		<?php 
			
			$get_system_settings	=	$this->crud_model->get_system_settings();
			echo '<input type="hidden" id="current_session" value="'.$get_system_settings[17]['description'].'">';
			echo form_open(base_url() . 'index.php?formtutor/tabulation_sheet');?>
			<div class="col-md-3">
				<div class="form-group">
					<select name="session_year" id="session_year" class="form-control selectboxit" onchange="show_students_session(this.value)">
                        
                        <?php 
                        
                        $sessions = $this->db->get('session')->result_array();
                        foreach($sessions as $row):
                        ?>
                            <option value="<?php echo $row['name'];?>"
                            	<?php if($sessoin_id){if (trim($sessoin_id) == trim($row['name'])){ echo 'selected'; }}else {if($row['name'] ==$get_system_settings[17]['description']){ echo 'selected'; } } ?>>
                            		 <?php echo $row['name'];?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select name="class_id"  id="class_ids" class="form-control selectboxit"  onchange="show_students(this.value)">
                        <option value=""><?php echo get_phrase('select_a_class');?></option>
                        <?php 
                        $classes = $this->db->get_where('class', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
				    foreach($classes as $row):
                        ?>
                            <option value="<?php echo $row['class_id'];?>"
                            	<?php if ($class_id == $row['class_id']) echo 'selected';?>>
                            		 <?php echo $row['name'];?>
                            </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					 <select name="student_id" id="student_id_0" class="form-control" style="float:left;">
                            <option value="">Select a student</option>
                            <?php 
								if($class_id){
									$current = 's';
									if($get_system_settings[17]['description'] ==$sessoin_id){
										$current = 'yes';
									}
									$students	=	$this->crud_model->student_session_get($class_id,$sessoin_id,$student_id,$current); 
								}
                            ?>
                    </select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select name="exam_id" class="form-control selectboxit">
                        	<option value=""><?php echo get_phrase('select_an_term');?></option>
                        	<?php 
                        	$exams = $this->db->get('exam')->result_array();
                        	foreach($exams as $row):
                        	?>
                            	<option value="<?php echo $row['exam_id'];?>"
                            	<?php if ($exam_id == $row['exam_id']) echo 'selected';?>>
                            		<?php echo $row['name'];?>
                            	</option>
                        	<?php
                        endforeach;
                        ?>
                    </select>
				</div>
			</div>
			<input type="hidden" name="operation" value="selection">
			<div class="col-md-3">
				<button type="submit" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-search"></i><?php echo get_phrase('get_student_results');?></button>
			</div>
		<?php echo form_close();?>
</div>

<?php if ($class_id != '' && $exam_id != '' && $student_id != ''):?>
<br>
<div class="row">
	<div class="col-md-12"></div>
	<div class="col-md-12" style="text-align: center;">
 <div class="x_panel" >
			<h3>
				<?php
					$exam_name  = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; 
					$student  = $this->db->get_where('student' , array('student_id' => $student_id))->result_array(); 
					$class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name; 
					echo get_phrase('report_card_for:').'&nbsp;&nbsp;'. $student[0]['name'].' '.$student[0]['surname'];;
				?>
			</h3>
			<h4><?php echo get_phrase('class') . ' ' . $class_name;?></h4>
			<h4><?php echo $exam_name;?></h4>
		</div>
	</div>
	<div class="col-md-12"></div>
</div>


<hr />
 <div class="x_panel tablu" >

<div class="row">
	<div class="col-md-12">
	<div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('student_result'); ?>
					</div>
					</div>
					<!-- CODE added on 05 june 2018 sandeep-->

		<!-- Senior Secondary -->
					<?php   $class_type = strtolower($this->crud_model->get_class_name($class_id)); 
					$jss = "no";
					if(strpos($class_type, 'jss') !== false ){
						$jss = "yes";
					}
					if (strpos($class_type, 'ss') !== false && $jss !='yes'){
					?>
			<style>
				.text-transform span {float: left;width: 100%;margin: 0 0 0 -22px;}
				.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); 
				-moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); 
				transform: rotate(270deg); width: 60px; max-width: 60px;}
			</style>
			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;overflow: auto;display: inline-block;vertical-align: top;">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A (70%)</th>
							<th class="tg-yw4l" rowspan="2">EXAM (30%)</th>
							<th class="tg-yw4l" rowspan="2">TOTAL (100%)</th>
							<th class="tg-yw4l" rowspan="2">AVERAGE SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">GRADES</th>
							<th class="tg-yw4l" rowspan="2">CLASS MAXIMUM</th>
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
					$total_markss = 0;
					$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
					$marks	=	$query->result_array();
					
					foreach($marks as $row2):
						$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
						$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
						
						$this->db->select("(ca_marks+mark_obtained) as total");
						$total_marks = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
						$i=$b=0;
						$total= 0;

						$this->db->select("student_id");
						$tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
						$stno = count($tstu);

						$this->db->select("subject_id");
						$sub = $this->db->get_where('mark',array('class_id'=>$class_id, 'exam_id' => $exam_id, 'student_id'=>$student_id,'session_year'=>$sessoin_id))->result_array();
						$subno = count($sub);

						$this->db->select("total_average as val");
						$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
						foreach($total_average as $avgg){
							$cav +=$avgg['val'];
						}

						foreach($total_marks as $marks_cal){
							$total +=$marks_cal['total'];
							$i++;
						}
						$subavg =  $total/ $stno;
						$avg += $subavg;
						
						$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
						$grade = grade_sys($total_sub_marks);
							?>
							<tr>
								<td><?php echo $subjects[0]['name']; ?>	</td>
								<td class="tg-yw4l"><?php echo $row2['ca_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['mark_obtained'];?></td>
								<td class="tg-yw4l"><?php echo ($row2['ca_marks']+$row2['mark_obtained']);?></td>
								<td class="tg-yw4l"><?php echo round($subavg); ?></td>
								<td class="tg-yw4l"><?php echo $grade;?></td>
								<td class="tg-yw4l"><?php $arr_max = max($total_marks); echo $arr_max['total']; ?></td>
								<td class="tg-yw4l"><?php echo $row2['effort_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['attitude_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['attentiveness_mark'];?></td>
								<td class="tg-yw4l"><?php echo $row2['assignment_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['interest_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['willingness_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['teacher']; ?></td>
                              
							 </tr>
							
					<?php
						$tot = $row2['ca_marks']+$row2['mark_obtained'];
						$total_markss +=$tot;		
					endforeach;
					
					?>
				 </tbody>
				
			   </table>
	<!-- Individual Total Average -->
		<?php 
			$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
						'student_id' => $student_id,'session_year'=>$sessoin_id);
			$query_Remark = $this->db->get_where('average' , $verify_data);

			if($query_Remark->num_rows() < 1){
			$this->db->insert('average' , $verify_data);
					}

			$stavg = $avg / $subno;
			$class_avg = $cav / $stno;
			$position = $this->crud_model->get_positions($class_id,$student_id,$exam_id,$sessoin_id);

			$datas['total_average'] = round($stavg);
			$datas['total_score'] = $total_markss;
			$datas['class_average'] = round($class_avg);
			$datas['position'] = $position;

				
				
			$this->db->where('class_id', $class_id);
        		$this->db->where('student_id', $student_id);
			$this->db->where('exam_id', $exam_id);
			$this->db->where('session_year', $sessoin_id);
			$this->db->update('average', $datas);

			echo $tavg;
		?>

			   <hr>
			   
	<!-- individual Assessment-->
			<table cellpadding="0" cellspacing="0" border="0" class="tg">
			<?php

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$sessoin_id);
				$query_remark = $this->db->get_where('Remark' , $verify_data);
				
				$student_remark = $query_remark->result_array();
				foreach($student_remark as $row):	

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
						<td class="tg-yw4l"><?php echo $row["R1"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Works indipendently.</td>
						<td class="tg-yw4l"><?php echo $row["R2"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Reasons logically.</td>
						<td class="tg-yw4l"><?php echo $row["R3"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">makes intelligent contributions in the class.</td>
						<td class="tg-yw4l"><?php echo $row["R4"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">is attentive and follows directions.</td>
						<td class="tg-yw4l"><?php echo $row["R5"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">checks and correct assignments.</td>
						<td class="tg-yw4l"><?php echo $row["R6"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Completes homework promptly.</td>
						<td class="tg-yw4l"><?php echo $row["R7"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Honest at work and play.</td>
						<td class="tg-yw4l"><?php echo $row["R8"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Neat in school work.</td>
						<td class="tg-yw4l"><?php echo $row["R9"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Neat in personal apperance.</td>
						<td class="tg-yw4l"><?php echo $row["R10"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">enjoys the conpany of classmates.</td>
						<td class="tg-yw4l"><?php echo $row["R11"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Participates in school activites.</td>
						<td class="tg-yw4l"><?php echo $row["R12"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Keeps schools rules and rgulations.</td>
						<td class="tg-yw4l"><?php echo $row["R13"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Respects school authority and staff.</td>
						<td class="tg-yw4l"><?php echo $row["R14"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Handles own and school proprety with care.</td>
						<td class="tg-yw4l"><?php echo $row["R15"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Punctual at school.</td>
						<td class="tg-yw4l"><?php echo $row["R16"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Sense of leadership.</td>
						<td class="tg-yw4l"><?php echo $row["R17"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Musical/Creatuve Skills.</td>
						<td class="tg-yw4l"><?php echo $row["R18"]; ?></td>
					</tr>
				</tbody>
				<?php endforeach; ?>
			</table>
			
			<hr>

	<!--COMMENT AREA-->
		<table style="width:100%; vertical-align: bottom;">
			<?php

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$sessoin_id);
				$query_comments = $this->db->get_where('comments' , $verify_data);

				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
					
					<tr>
						<th>Teacher's Name: <?php echo $row['TeacherName'];?></th>
						<th>Vice Principal's Name: <?php echo$row['VPName'];?></th>
					</tr>
					<tr>
						<th>Teacher's Comment</th>
						<th>Vice Principal's Comment</th>
					</tr>
					<tr>
						<td><?php echo $row['TeacherComment'];?></td>
						<td><?php echo $row['VPComment'];?></td>
					</tr>
				<?php endforeach; ?>

		</table>
		<!-- Junior Secondary -->
		
				 <?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){ ?>
					
						<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;display: inline-block;vertical-align: top;    overflow: auto;">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A (60%)</th>
							<th class="tg-yw4l" rowspan="2">EXAM (40%)</th>
							<th class="tg-yw4l" rowspan="2">TOTAL (100%)</th>
							<th class="tg-yw4l" rowspan="2">SUBJECT AVERAGE</th>
							<th class="tg-yw4l" rowspan="2">GRADES</th>
							<th class="tg-yw4l" rowspan="2">MAXIMUM CLASS</th>
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
					$total_markss = 0;
					$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
					$marks	=	$query->result_array();
					
					foreach($marks as $row2):
						$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
						$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
						
						$this->db->select("(ca_marks+mark_obtained) as total");
						$total_marks = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
						$i=$b=0;
						$total= 0;

						$this->db->select("student_id");
						$tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
						$stno = count($tstu);

						$this->db->select("subject_id");
						$sub = $this->db->get_where('mark',array('class_id'=>$class_id, 'exam_id' => $exam_id, 'student_id'=>$student_id,'session_year'=>$sessoin_id))->result_array();
						$subno = count($sub);

						$this->db->select("total_average as val");
						$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
						foreach($total_average as $avgg){
							$cav +=$avgg['val'];
						}

						foreach($total_marks as $marks_cal){
							$total +=$marks_cal['total'];
							$i++;
						}
						$subavg =  $total/ $stno;
						$avg += $subavg;
						
						$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
						$grade = grade_sys($total_sub_marks);
				?>
							<tr>
								<td><?php echo $subjects[0]['name']; ?>	</td>
								<td class="tg-yw4l"><?php echo $row2['ca_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['mark_obtained'];?></td>
								<td class="tg-yw4l"><?php echo ($row2['ca_marks']+$row2['mark_obtained']);?></td>
								<td class="tg-yw4l"><?php echo round($subavg); ?></td>
								<td class="tg-yw4l"><?php echo $grade;?></td>
								<td class="tg-yw4l"><?php $arr_max = max($total_marks); echo $arr_max['total']; ?></td>
								<td class="tg-yw4l"><?php echo $row2['effort_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['attitude_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['attentiveness_mark'];?></td>
								<td class="tg-yw4l"><?php echo $row2['assignment_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['interest_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['willingness_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['teacher']; ?></td>
                              
							 </tr>
							
					<?php
						$tot = $row2['ca_marks']+$row2['mark_obtained'];
						$total_markss +=$tot;		
					endforeach;
					
					?>
				 </tbody>
				
			   </table>
	<!-- Individual Total Average -->
		<?php 
			$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
						'student_id' => $student_id,'session_year'=>$sessoin_id);
			$query_Remark = $this->db->get_where('average' , $verify_data);

			if($query_Remark->num_rows() < 1){
			$this->db->insert('average' , $verify_data);
					}

			$stavg = $avg / $subno;
			$class_avg = $cav / $stno;
			$position = $this->crud_model->get_positions($class_id,$student_id,$exam_id,$sessoin_id);

			$datas['total_average'] = round($stavg);
			$datas['total_score'] = $total_markss;
			$datas['class_average'] = round($class_avg);
			$datas['position'] = $position;

				
				
			$this->db->where('class_id', $class_id);
        		$this->db->where('student_id', $student_id);
			$this->db->where('exam_id', $exam_id);
			$this->db->where('session_year', $sessoin_id);
			$this->db->update('average', $datas);

			echo $tavg;
		?>

			   <hr>
			   
	<!-- individual Assessment-->
			<table cellpadding="0" cellspacing="0" border="0" class="tg">
			<?php

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$sessoin_id);
				$query_remark = $this->db->get_where('Remark' , $verify_data);
				
				$student_remark = $query_remark->result_array();
				foreach($student_remark as $row):	

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
						<td class="tg-yw4l"><?php echo $row["R1"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Works indipendently.</td>
						<td class="tg-yw4l"><?php echo $row["R2"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Reasons logically.</td>
						<td class="tg-yw4l"><?php echo $row["R3"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">makes intelligent contributions in the class.</td>
						<td class="tg-yw4l"><?php echo $row["R4"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">is attentive and follows directions.</td>
						<td class="tg-yw4l"><?php echo $row["R5"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">checks and correct assignments.</td>
						<td class="tg-yw4l"><?php echo $row["R6"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Completes homework promptly.</td>
						<td class="tg-yw4l"><?php echo $row["R7"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Honest at work and play.</td>
						<td class="tg-yw4l"><?php echo $row["R8"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Neat in school work.</td>
						<td class="tg-yw4l"><?php echo $row["R9"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Neat in personal apperance.</td>
						<td class="tg-yw4l"><?php echo $row["R10"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">enjoys the conpany of classmates.</td>
						<td class="tg-yw4l"><?php echo $row["R11"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Participates in school activites.</td>
						<td class="tg-yw4l"><?php echo $row["R12"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Keeps schools rules and rgulations.</td>
						<td class="tg-yw4l"><?php echo $row["R13"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Respects school authority and staff.</td>
						<td class="tg-yw4l"><?php echo $row["R14"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Handles own and school proprety with care.</td>
						<td class="tg-yw4l"><?php echo $row["R15"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Punctual at school.</td>
						<td class="tg-yw4l"><?php echo $row["R16"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Sense of leadership.</td>
						<td class="tg-yw4l"><?php echo $row["R17"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Musical/Creatuve Skills.</td>
						<td class="tg-yw4l"><?php echo $row["R18"]; ?></td>
					</tr>
				</tbody>
				<?php endforeach; ?>
			</table>
			
			<hr>

	<!--COMMENT AREA-->
		<table style="width:100%; vertical-align: bottom;">
			<?php

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$sessoin_id);
				$query_comments = $this->db->get_where('comments' , $verify_data);

				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
					
					<tr>
						<th>Teacher's Name: <?php echo $row['TeacherName'];?></th>
						<th>Vice Principal's Name: <?php echo$row['VPName'];?></th>
					</tr>
					<tr>
						<th>Teacher's Comment</th>
						<th>Vice Principal's Comment</th>
					</tr>
					<tr>
						<td><?php echo $row['TeacherComment'];?></td>
						<td><?php echo $row['VPComment'];?></td>
					</tr>
				<?php endforeach; ?>

		</table>
				
		<!-- Primary -->		 
				<?php }else if (strpos($class_type, 'primary') !== false){ ?>

				<!-- Term 1 & 2 -->
					<?php if($exam_id < 3 && $class_id < 40) { ?> 
					<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 71%;display: inline-block;vertical-align: top;">
						<tbody>
							<tr>
								<td colspan="13"></td>
								<td colspan="41" style="text-align: center;"><?php echo $exam_name ?></td>	
							</tr>
							  <?php 
							   $verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
												'student_id' => $student_id,'session_year'=>$sessoin_id);
								$query_grade = $this->db->get_where('primary_student_grade' , $verify_data);
							
							$student_grades = $query_grade->result_array();
							  ?>
							<tr>
								<td></td>
								<td colspan="12">SUBJECTS</td>
								<td colspan="3" class="space" style="text-align: center;">CA 1<br>20</td>
								<td colspan="3" class="space" style="text-align: center;">CW<br>10</td>
								<td colspan="3" class="space" style="text-align: center;">CA 2<br>20</td>
								<td colspan="5" class="space" style="text-align: center;">PROJECT<br>10</td>
								<td colspan="5" class="space" style="text-align: center;">TOTAL CA<br>60</td>
								<td colspan="4" class="space" style="text-align: center;">EXAM<br>40</td>
								<td colspan="3" class="space" style="text-align: center;">TOTAL <br> SCORE</td>
								<td colspan="3" class="space" style="text-align: center;">SUBJECT <br> AVERAGE</td>
								<td colspan="3" class="space" style="text-align: center;">GRADE</td>
								<td width = 10% class="space" style="text-align: center;">REMARK</td>
								
								
							</tr>
							<?php 
							$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();
							 
							foreach($marks as $row2):
								$a++;
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								
								$this->db->select("(ca_marks+mark_obtained) as total");
								$total_marks = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
								$this->db->select("student_id");
								$tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
								$stno = count($tstu);
		 
								$this->db->select("subject_id");
								$sub = $this->db->get_where('mark',array('class_id'=>$class_id, 'exam_id' => $exam_id, 'student_id'=>$student_id,'session_year'=>$sessoin_id))->result_array();
								$subno = count($sub);

								$this->db->select("total_average as val");
								$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
								foreach($total_average as $avgg){
									$cav +=$avgg['val'];
								}
		 
								foreach($total_marks as $marks_cal){
									$total +=$marks_cal['total'];
									$i++;
									 
								}
								$subavg =  $total/ $stno;
								$avg += $subavg;
									
									
									$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
									$grade = grade_sys($total_sub_marks)
									?>
								
									<tr>
										<td><?php echo $a; ?></td>
										<td colspan="12"><?php echo $subjects[0]['name'];?></td>
										<td class="space" colspan="3"><?php echo $row2['ca_1'];?></td>
										<td class="space" colspan="3"><?php echo $row2['cw'];?></td>
										<td class="space" colspan="3"><?php echo $row2['ca_2'];?></td>
										<td class="space" colspan="5"><?php echo $row2['project_score'];?> </td>
										<td class="space" colspan="5"><?php echo $row2['ca_marks'];?></td>
										<td class="space" colspan="4"><?php echo $row2['mark_obtained'];?></td>
										<td class="space" colspan="3"><?php echo $row2['mark_total'];?></td>
										<td class="space" colspan="3"><?php echo round($subavg);?></td>
										<td class="space" colspan="3"><?php echo $grade;?></td>
										<td class="space" colspan="3"><?php echo $row2['remark'];?></td>
										</tr>
								<?php 
								$tot = $row2['mark_total'];
								$total_markss +=$tot;
								endforeach;
								?>
							</tbody>
					</table>
					<?php  }?>

				<!-- Term 3 -->
					<?php if($exam_id == 3 && $class_id < 40) {?> 

					<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 78%;display: inline-block;vertical-align: top;overflow: auto;">
						<tbody>
							<tr>
								<td colspan="13"></td>
								<td colspan="6" style="text-align: center;">TERM 1</td>
								<td colspan="6" style="text-align: center;">TERM 2</td>
								<td colspan="41" style="text-align: center;"><?php echo $exam_name ?></td>
								
							</tr>
							  <?php 
							   $verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
												'student_id' => $student_id,'session_year'=>$sessoin_id);
								$query_grade = $this->db->get_where('primary_student_grade' , $verify_data);
							
							$student_grades = $query_grade->result_array();
							  ?>
							<tr>
								<td></td>
								<td colspan="12">SUBJECTS</td>
								<td colspan="3" class="space" style="text-align: center;">EXAM</td>
								<td colspan="3" class="space" style="text-align: center;">GRADE</td>
								<td colspan="3" class="space" style="text-align: center;">EXAM</td>
								<td colspan="3" class="space" style="text-align: center;">GRADE</td>
								<td colspan="3" class="space" style="text-align: center;">CA 1<br>20</td>
								<td colspan="3" class="space" style="text-align: center;">CW<br>10</td>
								<td colspan="3" class="space" style="text-align: center;">CA 2<br>20</td>
								<td colspan="5" class="space" style="text-align: center;">PROJECT<br>10</td>
								<td colspan="5" class="space" style="text-align: center;">TOTAL CA<br>60</td>
								<td colspan="4" class="space" style="text-align: center;">EXAM<br>40</td>
								<td colspan="3" class="space" style="text-align: center;">TOTAL <br> SCORE</td>
								<td colspan="3" class="space" style="text-align: center;">AVERAGE</td>
								<td colspan="3" class="space" style="text-align: center;">GRADE</td>
								<td colspan="3" class="space" style="text-align: center;">REMARK</td>
								<td colspan="3" class="space" style="text-align: center;">CUMULATIVE <br>AVERAGE</td>
								<td colspan="3" class="space" style="text-align: center;">FINAL <br> GRADE</td>
							</tr>
							 <?php 
							//edited 8/11/19
							$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();

							foreach($marks as $row2):
     							$a++;
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								
								$this->db->select("(ca_marks+mark_obtained) as total");
								$total_marks = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
								$this->db->select("student_id");
								$tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
								$stno = count($tstu);
		 
								$this->db->select("subject_id");
								$sub = $this->db->get_where('mark',array('class_id'=>$class_id, 'exam_id' => $exam_id, 'student_id'=>$student_id,'session_year'=>$sessoin_id))->result_array();
								$subno = count($sub);

								$query1 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=>$class_id, 'exam_id' => 1, 'student_id'=>$student_id,'session_year'=>$sessoin_id));
								$marks1 = $query1->result_array();
								foreach($marks1 as $da){
									$c++;
									$exam_score1 = $da['mark_total'];
									$grade1 = grade_sys($exam_score1);
								}

								$query2 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=>$class_id, 'exam_id' => 2, 'student_id'=>$student_id,'session_year'=>$sessoin_id));
								$marks2 = $query2->result_array();
								foreach($marks2 as $da1){
									$d++;
									$exam_score2 = $da1['mark_total'];
									$grade2 = grade_sys($exam_score2);
								}

								$this->db->select("total_average as val");
								$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
								foreach($total_average as $avgg){
									$cav +=$avgg['val'];
								}
								
     							foreach($total_marks as $marks_cal){
									$i++;
          							$total +=$marks_cal['total'];
     							}
								$subavg =  $total/ $stno;
								$avg += $subavg;
										
								$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
								$grade = grade_sys($total_sub_marks);

								$cum = ($da['mark_total'] + $da1['mark_total'] + $row2['mark_total'])/3;
								$val = round($cum);
								$final_grade = grade_sys($val);
								?>
									
								<tr>
									<td><?php echo $a; ?></td>
									<td colspan="12"><?php echo $subjects[0]['name'];?></td>
									<td class="space" colspan="3"><?php echo $da['mark_obtained'];?></td>
									<td class="space" colspan="3"><?php echo $grade1;?></td>
									<td class="space" colspan="3"><?php echo $da1['mark_obtained'];?></td>
									<td class="space" colspan="3"><?php echo $grade2;?></td>
									<td class="space" colspan="3"><?php echo $row2['ca_1'];?></td>
									<td class="space" colspan="3"><?php echo $row2['cw'];?></td>
									<td class="space" colspan="3"><?php echo $row2['ca_2'];?></td>
									<td class="space" colspan="5"><?php echo $row2['project_score'];?> </td>
									<td class="space" colspan="5"><?php echo $row2['ca_marks'];?></td>
									<td class="space" colspan="4"><?php echo $row2['mark_obtained'];?></td>
									<td class="space" colspan="3"><?php echo $row2['mark_total'];?></td>
									<td class="space" colspan="3"><?php echo round($subavg);?></td>
									<td class="space" colspan="3"><?php echo $grade;?></td>
									<td class="space" colspan="3"><?php echo $row2['remark'];?></td>
									<td class="space" colspan="3"><?php echo round($cum);?></td>
									<td class="space" colspan="3"><?php echo $final_grade;?></td>
								</tr>

							<?php
							$tot = $row2['ca_marks']+$row2['mark_obtained'];
							$total_markss +=$tot;
							endforeach;
							?>
						</tbody>
					</table>
					<?php  }?>

				<!-- Individual Total Average -->
				<?php 
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$sessoin_id);
					$query_Remark = $this->db->get_where('average' , $verify_data);

					if($query_Remark->num_rows() < 1){
					$this->db->insert('average' , $verify_data);
							}

					$stavg = $avg / $subno;
					$class_avg = $cav / $stno;
					$position = $this->crud_model->get_positions($class_id,$student_id,$exam_id,$sessoin_id);

					$datas['total_average'] = round($stavg);
					$datas['total_score'] = $total_markss;
					$datas['class_average'] = $class_avg;
					$datas['position'] = $position;

						
						
					$this->db->where('class_id', $class_id);
        				$this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('session_year', $sessoin_id);
					$this->db->update('average', $datas);

					echo $tavg;
				?>
										
				<table style="width: 20%;display: inline-block;vertical-align: top;">
				<tbody>
					<tr>
						<td colspan="11" style="text-align: center;">AFECTIVE TRAITS</td>
					</tr>
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
						<td><span <?php if($student_grades[0]['punctuality_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['punctuality_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['punctuality_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['punctuality_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['punctuality_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
											
					</tr>
					<tr>
						<td colspan="6">Mental Alertness</td>
						<td><span <?php if($student_grades[0]['mental_grade'] =='A'){ echo 'class="grade-right"';} ?>></span> </td>
						<td><span <?php if($student_grades[0]['mental_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['mental_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['mental_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['mental_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
						
					</tr>
					<tr>
						<td colspan="6">Respect for Authority</td>
						<td><span <?php if($student_grades[0]['respect_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['respect_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['respect_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['respect_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['respect_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
						
					</tr>
					<tr>
						<td colspan="6">Neatness</td>
						<td><span <?php if($student_grades[0]['neatness_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['neatness_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['neatness_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['neatness_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['neatness_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
						
					</tr>
					<tr>
						<td colspan="6">POLITNESS</td>
						<td><span <?php if($student_grades[0]['politness_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['politness_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['politness_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['politness_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['politness_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
						
					</tr>
				<tr>
					<td colspan="6">HONESTY</td>
					<td><span <?php if($student_grades[0]['honesty_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['honesty_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['honesty_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['honesty_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['honesty_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
				</tr>
				<tr>
					<td colspan="6">RELATIONSHIP WITH PEERS</td>
					<td><span <?php if($student_grades[0]['peers_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['peers_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['peers_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['peers_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['peers_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
				</tr>
				<tr>
					<td colspan="6">WILLINGNESS TO LEARN</td>
					<td><span <?php if($student_grades[0]['learn_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['learn_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['learn_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['learn_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['learn_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
				</tr>
				<tr>
					<td colspan="6">SPIRIT OF TEAMWORK</td>
					<td><span <?php if($student_grades[0]['teamwork_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['teamwork_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['teamwork_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['teamwork_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['teamwork_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
				</tr>
				<tr>
					<td colspan="6">HEALTH</td>
					<td><span <?php if($student_grades[0]['health_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['health_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['health_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['health_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['health_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
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
					<td><span <?php if($student_grades[0]['verbal_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['verbal_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['verbal_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['verbal_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['verbal_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
				</tr>
				<tr>
					<td colspan="6">PARTICIPATION IN SPORTS</td>
					<td><span <?php if($student_grades[0]['sports_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['sports_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['sports_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['sports_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['sports_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
				</tr>
				<tr>
					<td colspan="6">ARTISTIC/CREATIVITY</td>
					<td><span <?php if($student_grades[0]['creativity_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['creativity_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['creativity_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['creativity_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['creativity_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
				</tr>
				<tr>
				
					<td colspan="6">MUSIC SKILLS</td>
					<td><span <?php if($student_grades[0]['music_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['music_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['music_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['music_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['music_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
				</tr>
				<tr>
					<td colspan="6">DANCE SKILLS</td>
					<td><span <?php if($student_grades[0]['dance_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['dance_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['dance_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['dance_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td><span <?php if($student_grades[0]['dance_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
				</tr>

				</tbody>
			</table>
	<!--COMMENT AREA-->

			<table style="width:70%; vertical-align: bottom;">
			<?php if ($exam_name == 'TERM 3'){$exam_id++;} //step in for Term 3

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$sessoin_id);
				$query_comments = $this->db->get_where('comments' , $verify_data);
				
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th>Teacher's Name: <?php echo ' ',$row['TeacherName'];?></th>
						<th>Head Teacher's Name: <?php echo ' ', $row['HeadTeacherName'];?></th>
					</tr>
					<tr>
						<th>Teacher's Comment</th>
						<th>Head Teacher's Comment</th>
					</tr>
					<tr>
						<td><?php echo $row['TeacherComment'];?></td>
						<td><?php echo $row['HeadTeacherComment'];?></td>
					</tr>
				<?php endforeach; ?>

			</table>

<!-- Nursery -->
		<?php }else if (strpos($class_type, 'nursery') !== false || strpos($class_type, 'nur') !== false || strpos($class_type, 'toddler') !== false){ ?>
		<style>
			table, tr, td, th {    border: 1px solid #000;border-collapse: collapse;font-family: sans-serif;font-size: 14px;}
			th { padding: 10px; margin-left: 100px;}td span {font-size: 13px; margin-left: 3px;}th {height: 130px;}
			.text-transform span {float: left;width: 100%;margin: 0 0 0 -22px;}
			.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); transform: rotate(270deg); width: 60px; max-width: 60px;}
			td.inner {padding: 0;}
			td.inner table {width: 100%;}
			td.inner table, td.inner tr {border: 0;}
			
		</style>

		<table>
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$sessoin_id);
				$query_marks = $this->db->get_where('nursery_student_marks' , $verify_data);
							
				$nursub = $query_marks->result_array();
			?>
			
			<tbody>
				<tr>
					<th colspan="12"><span><strong>SUBJECTS</strong></span></th>
					<th class="text-transform"><span><strong>Exceeding</strong></span></th>
					<th class="text-transform"><span><strong>Meeting Exceptations</strong></span></th>
					<th class="text-transform"><span><strong>Emerging Exceptations</strong></span></th>
					<th class="text-transform"><span><strong>Not Assessed</strong></span></th>
					<th colspan="12"><strong>SUBJECTS</strong></span></th>
					<th class="text-transform"><span><strong>Exceeding</strong></span></th>
					<th class="text-transform"><span><strong>Meeting Exceptations</strong></span></th>
					<th class="text-transform"><span><strong>Emerging Exceptations</strong></span></th>
					<th class="text-transform"><span><strong>Not Assessed</strong></span></th>
					<th colspan="12"><span><strong>SUBJECTS</strong></span></th>
					<th class="text-transform"><span><strong>Exceeding</strong></span></th>
					<th class="text-transform"><span><strong>Meeting Exceptations</strong></span></th>
					<th class="text-transform"><span><strong>Emerging Exceptations</strong></span></th>
					<th class="text-transform"><span><strong>Not Assessed</span></th>
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
						<td><span <?php if($nursub[0]['language'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($nursub[0]['language'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($nursub[0]['language'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($nursub[0]['language'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($nursub[0]['social'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($nursub[0]['social'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($nursub[0]['social'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 2))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language1'] =='A'){ echo  'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language1'] =='B'){ echo  'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language1'] =='C'){ echo  'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language1'] =='D'){ echo  'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social100'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social100'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social100'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social100'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge200'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge200'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge200'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge200'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 3))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language2'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language2'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language2'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language2'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social102'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social102'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social102'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social102'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge202'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge202'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge202'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge202'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 4))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language3'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language3'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language3'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language3'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social103'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social103'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social103'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social103'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge203'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge203'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge203'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge203'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 5))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language4'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language4'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language4'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language4'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social104'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social104'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social104'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social104'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge204'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge204'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge204'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge204'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 6))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language5'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language5'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language5'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language5'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social105'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social105'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social105'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social105'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge205'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge205'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge205'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge205'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 7))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language6'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language6'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language6'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language6'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social106'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social106'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social106'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social106'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge206'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge206'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge206'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge206'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 8))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language7'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language7'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language7'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language7'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social107'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social107'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social107'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social107'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span   <?php if($nursub[0]['knowledge207'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span   <?php if($nursub[0]['knowledge207'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span   <?php if($nursub[0]['knowledge207'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span   <?php if($nursub[0]['knowledge207'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 9))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language8'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language8'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language8'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language8'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social108'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social108'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social108'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social108'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge208'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge208'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge208'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge208'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 10))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language9'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language9'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language9'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language9'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social109'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social109'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social109'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social109'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge209'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge209'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge209'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge209'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 11))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language10'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language10'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language10'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language10'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social110'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social110'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social110'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social110'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge210'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge210'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge210'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge210'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 12))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language11'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language11'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language11'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language11'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social111'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social111'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social111'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social111'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 13))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language12'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language12'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language12'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language12'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social112'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social112'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social112'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social112'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><strong><?php echo $row[0]['knowledge']?></strong><span></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 14))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language13'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language13'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language13'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language13'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social113'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social113'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social113'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social113'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge213'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge213'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge213'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge213'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 15))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language14'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language14'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language14'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language14'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social114'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social114'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social114'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social114'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge214'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge214'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge214'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge214'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 16))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language15'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language15'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language15'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language15'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social115'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social115'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social115'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social115'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge215'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge215'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge215'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge215'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
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
						<td><span <?php if($nursub[0]['knowledge216'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge216'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge216'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge216'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
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
						<td><span <?php if($nursub[0]['knowledge217'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge217'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge217'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge217'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
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
						<td><span <?php if($nursub[0]['language19'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language19'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language19'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language19'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social119'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social119'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social119'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social119'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge219'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge219'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge219'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge219'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 21))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language20'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language20'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language20'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language20'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social120'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social120'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social120'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social120'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge220'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge220'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge220'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge220'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 22))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language21'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language21'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language21'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language21'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social121'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social121'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social121'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social121'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge221'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge221'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge221'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge221'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 23))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language22'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language22'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language22'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language22'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social122'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social122'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social122'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social122'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge222'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge222'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge222'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge222'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 24))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language23'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language23'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language23'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language23'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social123'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social123'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social123'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social123'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge223'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge223'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge223'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge223'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 25))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language24'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language24'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language24'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language24'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social124'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social124'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social124'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social124'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge224'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge224'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge224'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge224'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 26))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language25'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language25'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language25'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language25'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social125'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social125'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social125'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social125'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge225'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge225'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge225'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge225'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 27))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language26'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language26'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language26'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language26'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social126'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social126'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social126'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social126'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge226'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge226'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge226'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge226'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 28))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language27'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language27'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language27'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language27'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social127'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social127'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social127'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social127'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge227'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge227'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge227'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge227'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 29))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language28'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language28'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language28'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language28'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social128'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social128'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social128'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social128'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge228'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge228'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge228'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge228'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 30))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language29'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language29'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language29'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language29'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social129'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social129'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social129'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social129'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge229'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge229'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge229'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge229'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 31))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language30'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language30'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language30'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language30'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social130'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social130'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social130'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social130'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge230'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge230'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge230'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge230'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 32))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language31'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language31'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language31'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language31'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social131'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social131'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social131'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social131'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge231'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge231'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge231'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge231'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				<tr>
				<?php $row = $this->db->get_where('nursery_subject', array('nursub_id' => 33))->result_array();?>
					<td colspan="12"><span><?php echo $row[0]['language']?></span></td>
						<td><span <?php if($nursub[0]['language32'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language32'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language32'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['language32'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['social']?></span></td>
						<td><span <?php if($nursub[0]['social132'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social132'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social132'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['social132'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<td colspan="12"><span><?php echo $row[0]['knowledge']?></span></td>
						<td><span <?php if($nursub[0]['knowledge232'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge232'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge232'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge232'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
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
						<td><span <?php if($nursub[0]['knowledge234'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge234'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge234'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge234'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
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
						<td><span <?php if($nursub[0]['knowledge235'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge235'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge235'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge235'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
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
						<td><span <?php if($nursub[0]['knowledge236'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge236'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge236'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge236'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
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
						<td><span <?php if($nursub[0]['knowledge237'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge237'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge237'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge237'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
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
						<td><span <?php if($nursub[0]['knowledge238'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge238'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge238'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge238'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
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
						<td><span <?php if($nursub[0]['knowledge239'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge239'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge239'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge239'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
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
						<td><span <?php if($nursub[0]['knowledge240'] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge240'] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge240'] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0]['knowledge240'] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
				</tr>
				
			</tbody>
			</table>

			<hr>

		<!--COMMENT AREA-->

		<table style="width:98%; vertical-align: bottom; th.height: 10px;" cellpadding="0" cellspacing="0" border="0" class="tg">
			<?php if ($exam_name == 'TERM 3'){$exam_id++;} //step in for Term 3

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$sessoin_id);
				$query_comments = $this->db->get_where('comments' , $verify_data);
				
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th style="height:10px;">Teacher's Name: <?php echo ' ',$row['TeacherName'];?></th>
						<th style="height:10px;">Head Teacher's Name: <?php echo ' ', $row['HeadTeacherName'];?></th>
					</tr>
					<tr>
						<th style="height:10px;">Teacher's Comment</th>
						<th style="height:10px;">Head Teacher's Comment</th>
					</tr>
					<tr>
						<td style="height:fit-content"><?php echo $row['TeacherComment'];?></td>
						<td style="height:fit-content"><?php echo $row['HeadTeacherComment'];?></td>
					</tr>
				<?php endforeach; ?>

		</table>

		<br />

		<?php } ?>
		<center>
			<!-- <a href="<?php //echo base_url();?>index.php?formtutor/tabulation_sheet_print_view_control/<?php //echo $class_id;?>/<?php //echo $exam_id;?>/<?php //echo $sessoin_id;?>" 
				class="btn btn-orange btn-sm btn-icon icon-left" target="_blank">
				<i class="entypo-print"></i><?php //echo get_phrase('mass_report_card');?>
			</a> -->
			<a href="<?php echo base_url();?>index.php?formtutor/tabulation_sheet_print_single_control/<?php echo $class_id;?>/<?php echo $exam_id;?>/<?php echo $sessoin_id;?>/<?php echo $student_id;?>" 
				class="btn btn-orange btn-sm btn-icon icon-left" target="_blank">
				<i class="entypo-print"></i><?php echo get_phrase('print_report');?>
			</a>
		</center>
	</div>
</div>
</div>
<?php endif;?>
<script type="text/javascript">
  function show_students(class_id)
  {
	  var current_session = $("#current_session").val();
	  var session_year = $("#session_year").val();
		if(current_session == session_year){
			if(class_id && session_year){
				$.ajax({
					url: '<?php echo base_url();?>index.php?formtutor/student_session_year/' + session_year +'/'+class_id+'/current',
					success: function(response){
						if($.trim(response)){
							$("#student_id_0").html(response);
						}else{
							$("#student_id_0").html('');
						}
					}
				});
			}
		}else{
			if(class_id && session_year){
				$.ajax({
					url: '<?php echo base_url();?>index.php?formtutor/student_session_year/' + session_year +'/'+class_id,
					success: function(response){
						if($.trim(response)){
							$("#student_id_0").html(response);
						}else{
							$("#student_id_0").html('');
						}
					}
				});
			}
		}
  }
  function show_students_session(session_year){
	var class_id = $("#class_ids").val();
	 var current_session = $("#current_session").val();
	  if(current_session == session_year){
			if(class_id && session_year){
				$.ajax({
					url: '<?php echo base_url();?>index.php?formtutor/student_session_year/' + session_year +'/'+class_id+'/current',
					success: function(response){
						if($.trim(response)){
							$("#student_id_0").html(response);
						}else{
							$("#student_id_0").html('');
						}
					}
				});
			}
		}else{
			if(class_id && session_year){
				$.ajax({
					url: '<?php echo base_url();?>index.php?formtutor/student_session_year/' + session_year +'/'+class_id,
					success: function(response){
						if($.trim(response)){
							$("#student_id_0").html(response);
						}else{
							$("#student_id_0").html('');
							}
					}
				});
			}
		}
	
}

</script>

<?php if ($class_id == '' && $exam_id == '' && $student_id == ''):?>
 <div class="x_panel tablu" >	
 <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('student_result_details'); ?>
					</div>
					</div>
  
					<div class="alert alert-danger" align="center">No Information Selected</div>

</div>
<?php endif;?>

<?php
	function grade_sys($val){
		if($val >=90){
			$grade = 'A';
		}else if($val >=70 && $val<= 89){
			$grade = 'B';
		}else if($val >=60 && $val<= 69){
			$grade = 'C+';
		}else if($val >=50 && $val<= 59){
			$grade = 'C';
		}else if($val >=40 && $val<= 49){
			$grade = 'D';
		}else if($val >=0 && $val<= 39){
			$grade = 'E';
					}
		return $grade;
	}
?>