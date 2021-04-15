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
			echo form_open(base_url() . 'index.php?teacher/tabulation_sheet');?>
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
                        	<option value=""><?php echo get_phrase('select_a_term');?></option>
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

			<!-- For SS 1 & 2 -->
			<?php if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?> 

			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;overflow: auto;display: inline-block;vertical-align: top;">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A [70]</th>
							<th class="tg-yw4l" rowspan="2">EXAM [30]</th>
							<th class="tg-yw4l" rowspan="2">TOTAL [100]</th>
							<th class="tg-yw4l" rowspan="2">SUBJECT AVERAGE </th>
							<th class="tg-yw4l" rowspan="2">GRADES</th>
							<th class="tg-yw4l" rowspan="2">CLASS MAXIMUM</th>
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
					$total_markss = $total = $cav = $avg = 0;
					$i = $h = $z = 0;
					$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
					$marks	=	$query->result_array();
					
					foreach($marks as $row2):
						$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
						$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
						$average = $this->db->get_where('subavg',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
						if ($class_id > 28 && $class_id < 33){
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark1 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=>29, 'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark2 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=>30,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark3 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=>31,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						}

						if ($class_id > 31 && $class_id < 35){
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark1 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 32, 'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark2 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 33,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark3 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 34,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						}

						$total_marks = array_merge($total_mark1,$total_mark2,$total_mark3);

						$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
						$grade = grade_syssec($total_sub_marks);
							?>
							<tr>
								<td><?php echo $subjects[0]['name']; ?>	</td>
								<td class="tg-yw4l"><?php echo $row2['ca_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['mark_obtained'];?></td>
								<td class="tg-yw4l"><?php echo ($row2['ca_marks']+$row2['mark_obtained']);?></td>
								<td class="tg-yw4l"><?php echo $average[0]['subject_average']; ?></td>
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
							
					<?php endforeach; ?>
				 </tbody>
				
			   </table>

			<!-- For SS3 -->
			<?php } if (strpos($class_type, 'ss 3') !== false) { ?> 

				<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;overflow: auto;display: inline-block;vertical-align: top;">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2"><?php if ($exam_id == 1) { echo 'MOCK 1';} ?><?php if ($exam_id == 2) { echo 'MOCK 2';} ?><br > [100]</th>
							<th class="tg-yw4l" rowspan="2">GRADE</th>
							<th class="tg-yw4l" rowspan="2">CLASS MAXIMUM</th>
							<th class="tg-yw4l" rowspan="2">EFFORT</th>
							<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'S REMARK</th>
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
					$total_markss = $total = $cav = $avg = 0;
					$i = $h = $z = 0;
					$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
					$marks	=	$query->result_array();
					
					foreach($marks as $row2):
						$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
						$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
						
						$this->db->select("(mark_obtained) as total");
						$total_mark1 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=>35, 'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

						$this->db->select("(mark_obtained) as total");
						$total_mark2 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=>36,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
						$this->db->select("(mark_obtained) as total");
						$total_mark3 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=>37,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
						$total_marks = array_merge($total_mark1,$total_mark2,$total_mark3);
						
							?>
							<tr>
								<td><?php echo $subjects[0]['name']; ?>	</td>
								<td class="tg-yw4l"><?php echo $row2['mark_obtained'];?></td>
								<td class="tg-yw4l"><?php echo grade_mock($row2['mark_obtained']);?></td>
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
					endforeach;
					
					?>
				 </tbody>
				</table>
			<?php } ?>


			<!-- Individual Total Average -->
			<?php 
					if ($class_id > 28 && $class_id < 32 ){
						$verify_datas = array('exam_id' => $exam_id,'class_id' => 111, 
						'student_id' => $student_id,'session_year'=>$sessoin_id);
					 }
					 elseif ($class_id > 31 && $class_id < 35 ){
						$verify_datas = array('exam_id' => $exam_id ,'class_id' => 112 , 
						'student_id' => $student_id,'session_year'=>$sessoin_id);
					 }
					 elseif ($class_id > 34 && $class_id < 38 ){
						$verify_datas = array('exam_id' => $exam_id ,'class_id' => 113 , 
						'student_id' => $student_id,'session_year'=>$sessoin_id);
					 }
					$query_Remark = $this->db->get_where('average' , $verify_datas);

					if($query_Remark->num_rows() < 1){
					$this->db->insert('average' , $verify_datas);
							}
					
					if ($class_id > 28 && $class_id < 32 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=> 111,'session_year'=>$sessoin_id))->result_array();
					 }
					 elseif ($class_id > 31 && $class_id < 35 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=> 112,'session_year'=>$sessoin_id))->result_array();
					 }
					 elseif ($class_id > 34 && $class_id < 38 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=> 113,'session_year'=>$sessoin_id))->result_array();
					 }
					
					 $cav = $z = 0;	
					foreach($total_average as $avgg){
						if ($avgg['total_average'] != 0){
							$z++;
							$cav +=$avgg['total_average'];}
					}
					$class_avg = $cav / $z;
					$position = $this->crud_model->get_positions($class_id,$student_id,$exam_id,$sessoin_id);
					
					if ($class_avg == ''){
						$datas['class_average'] = 0;
						$datas['position'] = 0;
					}

					if ($class_avg > 0){
						$datas['class_average'] = round($class_avg,1);
						$datas['position'] = $position;
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
	
	<!-- individual Assessment-->
		<?php if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?> 
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
						<td class="tg-yw4l"><?php echo $row["R1"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Works independently.</td>
						<td class="tg-yw4l"><?php echo $row["R2"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Reasons logically.</td>
						<td class="tg-yw4l"><?php echo $row["R3"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Makes intelligent contributions in the class.</td>
						<td class="tg-yw4l"><?php echo $row["R4"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Is attentive and follows directions.</td>
						<td class="tg-yw4l"><?php echo $row["R5"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Checks and correct assignments.</td>
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
						<td  colspan = "5">Neat in personal appearance.</td>
						<td class="tg-yw4l"><?php echo $row["R10"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Enjoys the company of classmates.</td>
						<td class="tg-yw4l"><?php echo $row["R11"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Participates in school activites.</td>
						<td class="tg-yw4l"><?php echo $row["R12"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Keeps school rules and regulations.</td>
						<td class="tg-yw4l"><?php echo $row["R13"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Respects school authority and staff.</td>
						<td class="tg-yw4l"><?php echo $row["R14"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Handles own and school property with care.</td>
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
						<td  colspan = "5">Musical/Creative Skills.</td>
						<td class="tg-yw4l"><?php echo $row["R18"]; ?></td>
					</tr>
				</tbody>
				<?php endforeach; ?>
			</table>
				<?php } ?>
			
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
						<th>Teacher's Name: <?php echo $row['TeacherNames'];?></th>
						<th>Vice Principal's Name: <?php echo$row['VPName'];?></th>
					</tr>
					<?php if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?> 
					<tr>
						<th>Teacher's Comment</th>
						<th>Vice Principal's Comment</th>
					</tr>
					<tr>
						<td><?php echo $row['TeacherComments'];?></td>
						<td><?php echo $row['VPComment'];?></td>
					</tr>
					<?php } ?>
				<?php endforeach; ?>

		</table>
		<!-- Junior Secondary -->
		
				 <?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){ ?>
					
						<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;display: inline-block;vertical-align: top;    overflow: auto;">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A [40]</th>
							<th class="tg-yw4l" rowspan="2">EXAM [60]</th>
							<th class="tg-yw4l" rowspan="2">TOTAL [100]</th>
							<th class="tg-yw4l" rowspan="2">SUBJECT AVERAGE</th>
							<th class="tg-yw4l" rowspan="2">GRADES</th>
							<th class="tg-yw4l" rowspan="2">CLASS MAXIMUM </th>
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
					$total_markss = $total = $cav = $avg = 0;
					$i = $h = $z = 0;
					$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
					$marks	=	$query->result_array();
					
					foreach($marks as $row2):
						$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
						$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
						$average = $this->db->get_where('subavg',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
						if ($class_id > 19 && $class_id < 23){
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark1 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 20, 'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark2 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 21,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark3 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 22,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						}

						elseif ($class_id > 22 && $class_id < 26){
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark1 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 23, 'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark2 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 24,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark3 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 25,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						}

						elseif ($class_id > 25 && $class_id < 29){
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark1 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 26,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark2 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 27,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark3 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'class_id'=> 28,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						}

						$total_marks = array_merge($total_mark1,$total_mark2,$total_mark3);
						
						$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
						$grade = grade_syssec($total_sub_marks);
					?>
							<tr>
								<td><?php echo $subjects[0]['name']; ?>	</td>
								<td class="tg-yw4l"><?php echo $row2['ca_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['mark_obtained'];?></td>
								<td class="tg-yw4l"><?php echo ($row2['ca_marks']+$row2['mark_obtained']);?></td>
								<td class="tg-yw4l"><?php echo $average[0]['subject_average']; ?></td>
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
					endforeach;
					
					?>
				 </tbody>
				
			   </table>
			<!-- Individual Total Average -->
			<?php 
					if ($class_id > 19 && $class_id < 23 ){
						$verify_datas = array('exam_id' => $exam_id,'class_id' => 101, 
						'student_id' => $student_id,'session_year'=>$sessoin_id);
					 }
					 elseif ($class_id > 22 && $class_id < 26 ){
						$verify_datas = array('exam_id' => $exam_id ,'class_id' => 102 , 
						'student_id' => $student_id,'session_year'=>$sessoin_id);
					 }
					 elseif ($class_id > 25 && $class_id < 29 ){
						$verify_datas = array('exam_id' => $exam_id ,'class_id' => 103 , 
						'student_id' => $student_id,'session_year'=>$sessoin_id);
					 }
					$query_Remark = $this->db->get_where('average' , $verify_datas);

					if($query_Remark->num_rows() < 1){
					$this->db->insert('average' , $verify_datas);
							}
					
					if ($class_id > 19 && $class_id < 23 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=> 101,'session_year'=>$sessoin_id))->result_array();
					 }
					 elseif ($class_id > 22 && $class_id < 26 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=> 102,'session_year'=>$sessoin_id))->result_array();
					 }
					 elseif ($class_id > 25 && $class_id < 29 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=> 103,'session_year'=>$sessoin_id))->result_array();
					 }
					
					 $cav = $z = 0;	
					 foreach($total_average as $avgg){
						if ($avgg['total_average'] != 0){
							$z++;
							$cav +=$avgg['total_average'];}
					}

					$class_avg = $cav / $z;
					$position = $this->crud_model->get_positions($class_id,$student_id,$exam_id,$sessoin_id);
					
					if ($class_avg == ''){
						$datas['class_average'] = 0;
						$datas['position'] = 0;
					}

					if ($class_avg > 0){
						$datas['class_average'] = round($class_avg,1);
						$datas['position'] = $position;
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
						<td class="tg-yw4l"><?php echo $row["R1"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Works independently.</td>
						<td class="tg-yw4l"><?php echo $row["R2"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Reasons logically.</td>
						<td class="tg-yw4l"><?php echo $row["R3"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Makes intelligent contributions in the class.</td>
						<td class="tg-yw4l"><?php echo $row["R4"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Is attentive and follows directions.</td>
						<td class="tg-yw4l"><?php echo $row["R5"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Checks and correct assignments.</td>
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
						<td  colspan = "5">Neat in personal appearance.</td>
						<td class="tg-yw4l"><?php echo $row["R10"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Enjoys the company of classmates.</td>
						<td class="tg-yw4l"><?php echo $row["R11"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Participates in school activites.</td>
						<td class="tg-yw4l"><?php echo $row["R12"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Keeps school rules and regulations.</td>
						<td class="tg-yw4l"><?php echo $row["R13"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Respects school authority and staff.</td>
						<td class="tg-yw4l"><?php echo $row["R14"]; ?></td>
					</tr>
					<tr>
						<td  colspan = "5">Handles own and school property with care.</td>
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
						<td  colspan = "5">Musical/Creative Skills.</td>
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
						<th>Teacher's Name: <?php echo $row['TeacherNames'];?></th>
						<th>Vice Principal's Name: <?php echo$row['VPName'];?></th>
					</tr>
					<tr>
						<th>Teacher's Comment</th>
						<th>Vice Principal's Comment</th>
					</tr>
					<tr>
						<td><?php echo $row['TeacherComments'];?></td>
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
							$query = $this->db->get_where('mark_pri' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();
							$h = $c = $i = $a  = $z = 0;
							$cav = $total = $avg = $total_scores = $total_markss = 0;
							foreach($marks as $row2):
								$a++;
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								
								$this->db->select("(ca_marks+mark_obtained) as total");
								$total_marks = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
								$this->db->select("student_id");
								$tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
								$stno = count($tstu);
		 
								$this->db->select("subject_id");
								$sub = $this->db->get_where('mark_pri',array('class_id'=>$class_id, 'exam_id' => $exam_id, 'student_id'=>$student_id,'session_year'=>$sessoin_id))->result_array();
								$subno = count($sub);

								$this->db->select("total_average as val");
								$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
						
								foreach($total_marks as $marks_cal){
									if ($marks_cal['total'] != 0){
										$i++;
										$total +=$marks_cal['total'];
									}
								}
								$subavg =  $total/ $i;
								
								$avg += $subavg;
									
									
									$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
									$grade = grade_sys($total_sub_marks)
									?>

									<?php if ($a == 2){
									$strand = $this->db->get('strand')->result_array();
									foreach($strand as $rowz):
										$strands = $this->db->get_where('strands', array('exam_id' => $exam_id ,
																	'class_id' => $class_id ,
																	'strand_id' => $rowz['strand_id'] , 
																	'student_id' => $student_id,
																	'session_year'=>$get_system_settings[17]['description']))->result_array();
										foreach($strands as $rows):
									?>
											<tr>
												<td><?php echo '*'; ?></td>
												<td colspan="12"><?php echo  $this->crud_model->get_subject_name_by_ids('strand',$rows['strand_id']);?></td>
												<td class="space" colspan="3"><?php echo $rows['ca_1'];?></td>
												<td class="space" colspan="3"><?php echo $rows['cw'];?></td>
												<td class="space" colspan="3"><?php echo $rows['ca_2'];?></td>
												<td class="space" colspan="5"><?php echo $rows['project_score'];?> </td>
												<td class="space" colspan="5"><?php echo $rows['ca_marks'];?></td>
												<td class="space" colspan="4"><?php echo $rows['mark_obtained'];?></td>
												<td class="space" colspan="3"><?php echo $rows['mark_total'];?></td>
												<td class="space" colspan="3"><?php ?></td>
												<td class="space" colspan="3"><?php ?></td>
												<td class="space" colspan="3"><?php ?></td>
											</tr>
									<?php 
										endforeach;
									endforeach; } 
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
										<td class="space" colspan="3"><?php echo round($subavg,2);?></td>
										<td class="space" colspan="3"><?php echo $grade;?></td>
										<td class="space" colspan="3"><?php echo grade_remark($row2['mark_total']);?></td>
										</tr>
								<?php 
								if (($row2['ca_marks']+$row2['mark_obtained']) != 0){
									$h++;
									$tot = $row2['ca_marks']+$row2['mark_obtained'];
									$total_markss +=$tot;}
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
							$query = $this->db->get_where('mark_pri' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();
							$d = $c = $i = $a = $h = $z = 0;
							$cav = $total = $avg = $total_scores = $total_markss = 0;

							foreach($marks as $row2):
     							$a++;
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								
								$this->db->select("(ca_marks+mark_obtained) as total");
								$total_marks = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
								$this->db->select("student_id");
								$tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
								$stno = count($tstu);
		 
								$this->db->select("subject_id");
								$sub = $this->db->get_where('mark_pri',array('class_id'=>$class_id, 'exam_id' => $exam_id, 'student_id'=>$student_id,'session_year'=>$sessoin_id))->result_array();
								$subno = count($sub);

								$query1 = $this->db->get_where('mark_pri',array("subject_id"=>$row2['subject_id'],'class_id'=>$class_id, 'exam_id' => 1, 'student_id'=>$student_id,'session_year'=>$sessoin_id));
								$marks1 = $query1->result_array();
								foreach($marks1 as $da){
									$c++;
									$exam_score1 = $da['mark_total'];
									$grade1 = grade_sys($exam_score1);
								}

								$query2 = $this->db->get_where('mark_pri',array("subject_id"=>$row2['subject_id'],'class_id'=>$class_id, 'exam_id' => 2, 'student_id'=>$student_id,'session_year'=>$sessoin_id));
								$marks2 = $query2->result_array();
								foreach($marks2 as $da1){
									$d++;
									$exam_score2 = $da1['mark_total'];
									$grade2 = grade_sys($exam_score2);
								}

     							foreach($total_marks as $marks_cal){
									if ($marks_cal['total'] != 0){
										$i++;
										$total +=$marks_cal['total'];
									}
								}
								$subavg =  $total/ $i;

								$avg += $subavg;
										
								$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
								$grade = grade_sys($total_sub_marks);

								$cum = ($da['mark_total'] + $da1['mark_total'] + $row2['mark_total'])/3;
								$val = round($cum,2);
								$final_grade = grade_sys($val);
								?>
								<?php if ($a == 2){
									$strand = $this->db->get('strand')->result_array();
									foreach($strand as $rowz):
										$strands = $this->db->get_where('strands', array('exam_id' => $exam_id ,
																	'class_id' => $class_id ,
																	'strand_id' => $rowz['strand_id'] , 
																	'student_id' => $student_id,
																	'session_year'=>$sessoin_id))->result_array();
										foreach($strands as $rows):
									?>
											<tr>
												<td><strong><?php echo '*'; ?></strong></td>
												<td colspan="12"><?php echo  $this->crud_model->get_subject_name_by_ids('strand',$rows['strand_id']);?></td>
												<td class="space" colspan="3"></td>
												<td class="space" colspan="3"></td>
												<td class="space" colspan="3"></td>
												<td class="space" colspan="3"></td>
												<td class="space" colspan="3"><?php echo $rows['ca_1'];?></td>
												<td class="space" colspan="3"><?php echo $rows['cw'];?></td>
												<td class="space" colspan="3"><?php echo $rows['ca_2'];?></td>
												<td class="space" colspan="5"><?php echo $rows['project_score'];?> </td>
												<td class="space" colspan="5"><?php echo $rows['ca_marks'];?></td>
												<td class="space" colspan="4"><?php echo $rows['mark_obtained'];?></td>
												<td class="space" colspan="3"><?php echo $rows['mark_total'];?></td>
												<td class="space" colspan="3"></td>
												<td class="space" colspan="3"></td>
												<td class="space" colspan="3"></td>
												<td class="space" colspan="3"></td>
												<td class="space" colspan="3"></td>
											</tr>
									<?php 
										endforeach;
									endforeach; } 
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
									<td class="space" colspan="3"><?php echo round($subavg,1);?></td>
									<td class="space" colspan="3"><?php echo $grade;?></td>
									<td class="space" colspan="3"><?php echo grade_remark($rows['mark_total']);?></td>
									<td class="space" colspan="3"><?php echo $val;?></td>
									<td class="space" colspan="3"><?php echo $final_grade;?></td>
								</tr>

							<?php
							if (($row2['ca_marks']+$row2['mark_obtained']) != 0){
								$h++;
								$tot = $row2['ca_marks']+$row2['mark_obtained'];
								$total_markss +=$tot;}
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

					$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
					foreach($total_average as $avgg){
						if($avgg['total_average'] > 0){
							$cav +=$avgg['total_average'];
							$z++;
						}
						
					}

					$class_avg = $cav / $z;
					$position = $this->crud_model->get_positions($class_id,$student_id,$exam_id,$sessoin_id);
					
					if ($class_avg == ''){
						$datas['class_average'] = 0;
						$datas['position'] = 0;
					}

					if ($class_avg > 0){
						$datas['class_average'] = round($class_avg,1);
						$datas['position'] = $position;
					}

					$this->db->where('class_id', $class_id);
        				$this->db->where('student_id', $student_id);
					$this->db->where('exam_id', $exam_id);
					$this->db->where('session_year', $sessoin_id);
					$this->db->update('average', $datas);
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
						<td colspan="6">PUNCTUALITY</td>
						<td><span <?php if($student_grades[0]['punctuality_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['punctuality_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['punctuality_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['punctuality_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['punctuality_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
											
					</tr>
					<tr>
						<td colspan="6">MENTAL ALERTNESS</td>
						<td><span <?php if($student_grades[0]['mental_grade'] =='A'){ echo 'class="grade-right"';} ?>></span> </td>
						<td><span <?php if($student_grades[0]['mental_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['mental_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['mental_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['mental_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
					
						
					</tr>
					<tr>
						<td colspan="6">RESPECT FOR AUTHORITY</td>
						<td><span <?php if($student_grades[0]['respect_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['respect_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['respect_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['respect_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['respect_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
						
					</tr>
					<tr>
						<td colspan="6">NEATNESS</td>
						<td><span <?php if($student_grades[0]['neatness_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['neatness_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['neatness_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['neatness_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
						<td><span <?php if($student_grades[0]['neatness_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
						
					</tr>
					<tr>
						<td colspan="6">POLITENESS</td>
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
						<td style='width: 50%;'><?php echo $row['TeacherComment'];?></td>
						<td style='width: 50%;'><?php echo $row['HeadTeacherComment'];?></td>
					</tr>
				<?php endforeach; ?>

			</table>

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
								'student_id' => $student_id,'session_year'=>$sessoin_id);
				$query_marks = $this->db->get_where('nursery_student_marks' , $verify_data);
							
				$nursub = $query_marks->result_array();
			?>
			
			<tbody>
			<tr>
					<th colspan="12"><span><strong>SUBJECTS</strong></span></th>
					<th class="text-transform"><span><strong>Exceeding</strong></span></th>
					<th class="text-transform"><span><strong>Meeting_Expectations</strong></span></th>
					<th class="text-transform"><span><strong>Emerging_Expectations</strong></span></th>
					<th class="text-transform"><span><strong>Not_Assessed</strong></span></th>
					<th colspan="12"><strong>SUBJECTS</strong></span></th>
					<th class="text-transform"><span><strong>Exceeding</strong></span></th>
					<th class="text-transform"><span><strong>Meeting_Expectations</strong></span></th>
					<th class="text-transform"><span><strong>Emerging_Expectations</strong></span></th>
					<th class="text-transform"><span><strong>Not_Assessed</strong></span></th>
					<th colspan="12"><span><strong>SUBJECTS</strong></span></th>
					<th class="text-transform"><span><strong>Exceeding</strong></span></th>
					<th class="text-transform"><span><strong>Meeting_Expectations</strong></span></th>
					<th class="text-transform"><span><strong>Emerging_Expectations</strong></span></th>
					<th class="text-transform"><span><strong>Not_Assessed</span></th>
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
				<?php // ******************NURSERY 1*******************
				if (strpos($class_type, 'nursery 1') !== false ) { ?>
				<?php
				if($sessoin_id  == '2019-2020'){ 
					if ($exam_id == 1) {$items = $this->db->get_where('nursery_subject')->result_array();}
					if ($exam_id == 2) {$items = $this->db->get_where('nursery_subject_2')->result_array();}
					if ($exam_id == 3) {$items = $this->db->get_where('nursery_subject_3')->result_array();}
				}
				else{
					if ($exam_id == 1) {$items = $this->db->get_where('nnursery_subject')->result_array();}
					if ($exam_id == 2) {$items = $this->db->get_where('nnursery_subject_2')->result_array();}
					if ($exam_id == 3) {$items = $this->db->get_where('nnursery_subject_3')->result_array();}
				}
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
						<td><span <?php if($nursub[0][$language] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<?php } ?>
					<?php if ($row['language'] == ''|| ctype_upper(str_replace(' ','',$row['language'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['social'])) == true) {echo '<strong>';}?><?php echo $row['social']?></strong></span></td>
					<?php if ($row['social'] != '' && ctype_upper(str_replace(' ','',$row['social'])) != true){ ?>
						<td><span <?php if($nursub[0][$social] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<?php } ?>
					<?php if ($row['social'] == '' || ctype_upper(str_replace(' ','',$row['social'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['knowledge'])) == true) {echo '<strong>';}?><?php echo $row['knowledge']?></strong></span></td>
					<?php if ($row['knowledge'] != '' && ctype_upper(str_replace(' ','',$row['knowledge'])) != true){ ?>
						<td><span <?php if($nursub[0][$knowledge] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<?php } ?>
					<?php if ($row['knowledge'] == '' || ctype_upper(str_replace(' ','',$row['knowledge'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
				</tr>

				<?php } ?>
				
			<?php // ******************NURSERY 2*****************88
				}if (strpos($class_type, 'nursery 2') !== false ) { ?>
				<?php 
					if($sessoin_id  == '2019-2020'){
						if ($exam_id == 1) {$items = $this->db->get_where('nursery_subject1')->result_array();}
						if ($exam_id == 2) {$items = $this->db->get_where('nursery_subject1_2')->result_array();}
						if ($exam_id == 3) {$items = $this->db->get_where('nursery_subject1_3')->result_array();}
					}
					else{
						if ($exam_id == 1) {$items = $this->db->get_where('nnursery_subject1')->result_array();}
						if ($exam_id == 2) {$items = $this->db->get_where('nnursery_subject1_2')->result_array();}
						if ($exam_id == 3) {$items = $this->db->get_where('nnursery_subject1_3')->result_array();}
					}
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
						<td><span <?php if($nursub[0][$language] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<?php } ?>
					<?php if ($row['language'] == ''|| ctype_upper(str_replace(' ','',$row['language'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['social'])) == true) {echo '<strong>';}?><?php echo $row['social']?></strong></span></td>
					<?php if ($row['social'] != '' && ctype_upper(str_replace(' ','',$row['social'])) != true){ ?>
						<td><span <?php if($nursub[0][$social] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<?php } ?>
					<?php if ($row['social'] == '' || ctype_upper(str_replace(' ','',$row['social'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['knowledge'])) == true) {echo '<strong>';}?><?php echo $row['knowledge']?></strong></span></td>
					<?php if ($row['knowledge'] != '' && ctype_upper(str_replace(' ','',$row['knowledge'])) != true){ ?>
						<td><span <?php if($nursub[0][$knowledge] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<?php } ?>
					<?php if ($row['knowledge'] == '' || ctype_upper(str_replace(' ','',$row['knowledge'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
				</tr>

				<?php } ?>
				
			<?php // ***************NURSERY 3***************
				}if (strpos($class_type, 'nursery 3') !== false ) { ?>
				<?php 
					//if($sessoin_id  = '2019-2020'){
						if ($exam_id == 1) {$items = $this->db->get_where('nursery_subject2')->result_array();}
						if ($exam_id == 2) {$items = $this->db->get_where('nursery_subject2_2')->result_array();}
						if ($exam_id == 3) {$items = $this->db->get_where('nursery_subject2_3')->result_array();}
					//}
					//else{
					//	if ($exam_id == 1) {$items = $this->db->get_where('nnursery_subject2')->result_array();}
					//	if ($exam_id == 2) {$items = $this->db->get_where('nnursery_subject2_2')->result_array();}
					//	if ($exam_id == 3) {$items = $this->db->get_where('nnursery_subject2_3')->result_array();}
					//}
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
						<td><span <?php if($nursub[0][$language] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<?php } ?>
					<?php if ($row['language'] == ''|| ctype_upper(str_replace(' ','',$row['language'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['social'])) == true) {echo '<strong>';}?><?php echo $row['social']?></strong></span></td>
					<?php if ($row['social'] != '' && ctype_upper(str_replace(' ','',$row['social'])) != true){ ?>
						<td><span <?php if($nursub[0][$social] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<?php } ?>
					<?php if ($row['social'] == '' || ctype_upper(str_replace(' ','',$row['social'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['knowledge'])) == true) {echo '<strong>';}?><?php echo $row['knowledge']?></strong></span></td>
					<?php if ($row['knowledge'] != '' && ctype_upper(str_replace(' ','',$row['knowledge'])) != true && strpos($row['knowledge'], ':') != true){ ?>
						<td><span <?php if($nursub[0][$knowledge] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<?php } ?>
					<?php if ($row['knowledge'] == '' || (ctype_upper(str_replace(' ','',$row['knowledge'])) == true && strpos($row['knowledge'], ':') == false)){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<?php if (strpos($row['knowledge'], ':') == true){ ?>
						<td colspan="4"><span ><?php echo ($nursub[0][$knowledge]); ?></span></td>
					<?php }?>
        				
				</tr>

				<?php } ?>
				
			<?php // **************TODDLER*****************
				}if (strpos($class_type, 'toddler') !== false ) { ?>
				<?php 
				//if($sessoin_id  = '2019-2020'){
					if ($exam_id == 1) {$items = $this->db->get_where('nursery_subject3')->result_array();}
					if ($exam_id == 2) {$items = $this->db->get_where('nursery_subject3_2')->result_array();}
					if ($exam_id == 3) {$items = $this->db->get_where('nursery_subject3_3')->result_array();}
				//}
				//else{
				//	if ($exam_id == 1) {$items = $this->db->get_where('nnursery_subject3')->result_array();}
				//	if ($exam_id == 2) {$items = $this->db->get_where('nnursery_subject3_2')->result_array();}
				//	if ($exam_id == 3) {$items = $this->db->get_where('nnursery_subject3_3')->result_array();}
				//}
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
						<td><span <?php if($nursub[0][$language] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$language] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<?php } ?>
					<?php if ($row['language'] == ''|| ctype_upper(str_replace(' ','',$row['language'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['social'])) == true) {echo '<strong>';}?><?php echo $row['social']?></strong></span></td>
					<?php if ($row['social'] != '' && ctype_upper(str_replace(' ','',$row['social'])) != true){ ?>
						<td><span <?php if($nursub[0][$social] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$social] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
					<?php } ?>
					<?php if ($row['social'] == '' || ctype_upper(str_replace(' ','',$row['social'])) == true){ ?>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					<?php } ?>
					<td colspan="12"><span><?php if (ctype_upper(str_replace(' ','',$row['knowledge'])) == true) {echo '<strong>';}?><?php echo $row['knowledge']?></strong></span></td>
					<?php if ($row['knowledge'] != '' && ctype_upper(str_replace(' ','',$row['knowledge'])) != true){ ?>
						<td><span <?php if($nursub[0][$knowledge] =='A'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='B'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='C'){ echo 'class="grade-right"'; } ?>></span></td>
						<td><span <?php if($nursub[0][$knowledge] =='D'){ echo 'class="grade-right"'; } ?>></span></td>
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

			<hr>

		<!--COMMENT AREA-->

		<table style="width: 99%;float:center; margin-left: 10px;" cellpadding="0" cellspacing="0" border="0" class="tg">
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
						<td style="height:10px; width: 50%;"><?php echo $row['TeacherComment'];?></td>
						<td style="height:10px; width: 50%;"><?php echo $row['HeadTeacherComment'];?></td>
					</tr>
				<?php endforeach; ?>

		</table>

		<br />

		<?php } ?>
		<center>
			<!-- <a href="<?php //echo base_url();?>index.php?teacher/tabulation_sheet_print_view_control/<?php //echo $class_id;?>/<?php //echo $exam_id;?>/<?php //echo $sessoin_id;?>" 
				class="btn btn-orange btn-sm btn-icon icon-left" target="_blank">
				<i class="entypo-print"></i><?php //echo get_phrase('mass_report_card');?>
			</a> -->
			<a href="<?php echo base_url();?>index.php?teacher/tabulation_sheet_print_single_control/<?php echo $class_id;?>/<?php echo $exam_id;?>/<?php echo $sessoin_id;?>/<?php echo $student_id;?>" 
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
					url: '<?php echo base_url();?>index.php?teacher/student_session_year/' + session_year +'/'+class_id+'/current',
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
					url: '<?php echo base_url();?>index.php?teacher/student_session_year/' + session_year +'/'+class_id,
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
					url: '<?php echo base_url();?>index.php?teacher/student_session_year/' + session_year +'/'+class_id+'/current',
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
					url: '<?php echo base_url();?>index.php?teacher/student_session_year/' + session_year +'/'+class_id,
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
		}else if($val >=70 && $val<= 89.9){
			$grade = 'B';
		}else if($val >=60 && $val<= 69.9){
			$grade = 'C+';
		}else if($val >=50 && $val<= 59.9){
			$grade = 'C';
		}else if($val >=40 && $val<= 49.9){
			$grade = 'D';
		}else if($val >=0 && $val<= 39.9){
			$grade = 'E';
					}
		return $grade;
	}

	function grade_remark($val){
		if($val >=90){
			$grade = 'EXCELLENT';
		}else if($val >=70 && $val<= 89.9){
			$grade = 'VERY GOOD';
		}else if($val >=60 && $val<= 69.9){
			$grade = 'GOOD';
		}else if($val >=50 && $val<= 59.9){
			$grade = 'AVERAGE';
		}else if($val >=40 && $val<= 49.9){
			$grade = 'PASS';
		}else if($val >=0 && $val<= 39.9){
			$grade = 'POOR';
					}
		return $grade;
	}

	function grade_syssec($val){
		if($val >=90){
			$grade = 'A+';
		}else if($val >=80 && $val<= 89){
			$grade = 'A';
		}else if($val >=70 && $val<= 79){
			$grade = 'B';
		}else if($val >=60 && $val<= 69){
			$grade = 'C';
		}else if($val >=50 && $val<= 59){
			$grade = 'D';
		}else if($val >=40 && $val<= 49){
			$grade = 'E';
		}else if($val >=0 && $val<= 39){
			$grade = 'UNGRADED';
					}
		return $grade;
	}

	function grade_mock($val){
		if($val >=75){
			$grade = 'A1';
		}else if($val >=70 && $val<= 74){
			$grade = 'B2';
		}else if($val >=65 && $val<= 69){
			$grade = 'B3';
		}else if($val >=60 && $val<= 64){
			$grade = 'C4';
		}else if($val >=55 && $val<= 59){
			$grade = 'C5';
		}else if($val >=50 && $val<= 54){
			$grade = 'C6';
		}else if($val >=45 && $val<= 49){
			$grade = 'D7';
		}else if($val >=40 && $val<= 44){
			$grade = 'E8';
		}else if($val >=0 && $val<= 39){
			$grade = 'F9';
					}
		return $grade;
	}
?>