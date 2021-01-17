<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
td {font-family: Arial, sans-serif;font-size: 12px;padding: 8px;border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #ddd;color: #000;}
th {font-family: Arial, sans-serif;font-size: 12px;padding: 8px;border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #ddd;color: #000;}
.tg .tg-yw4l{vertical-align:middle;text-align: center;}
.tg.table-two {margin: 100px 0 0 0;}
.tg tr th, .tg tr td {color: #000;}
.table td {font-family: Arial, sans-serif;font-size: 12px;padding: 8px !important;border: 1px solid #E6E9ED !important;border-width: 1px;overflow: hidden;word-break: normal;color: #000 !important;}
.tg thead tr:last-child td:nth-child(odd) {background-color: transparent;}
td.space {min-width: 85px;text-align: center;}
td h5 {color: #000 !important;}

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
			echo form_open(base_url() . 'index.php?admin/tabulation_sheet_midterm');?>
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
					 <select name="student_id" id="student_id_0" class="form-control " style="float:left;">
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
                            		<?php echo $row['name2'];?>
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
<?php
	$nclass = $this->db->get_where('mark0',array('student_id'=>$student_id,'session_year'=>$sessoin_id))->result_array();
	$class_id = $nclass[0]['class_id'];
	$student_id = $nclass[0]['student_id'];
	$sessoin_id = $nclass[0]['session_year'];
?>
<?php if ($class_id != '' && $exam_id != '' && $student_id != ''):?>
<br>
<div class="row">
	<div class="col-md-12"></div>
	<div class="col-md-12" style="text-align: center;">
 <div class="x_panel" >
			<h3>
				<?php
					$exam_name  = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name2; 
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
					<?php   $class_type = strtolower($this->crud_model->get_class_name($class_id)); 
					$jss = "no";
					if(strpos($class_type, 'jss') !== false ){
						$jss = "yes";
					}
					if (strpos($class_type, 'ss') !== false && $jss !='yes'){
					?>
		<!-- Senior secondary -->	
		
		<!-- For SS 1 & 2 -->
		<?php if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?> 		
			<table cellpadding="0" cellspacing="0" border="1" class="tg" style="width: 100%;overflow: auto;display: inline-block;vertical-align: top;">
                    <thead>
				<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A [20]</th>
							<th class="tg-yw4l" rowspan="2">TEST [10]</th>
							<th class="tg-yw4l" rowspan="2">TOTAL [30]</th>
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
					$total_markss = 0;
					$query = $this->db->get_where('mark0' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
					$marks	=	$query->result_array();
					
					foreach($marks as $row2):
						$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
						$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
						
						if ($class_id > 28 && $class_id < 33){
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark1 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=>29, 'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark2 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=>30,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark3 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=>31,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						}

						if ($class_id > 31 && $class_id < 35){
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark1 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 32, 'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark2 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 33,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark3 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 34,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						}

						$total_marks = array_merge($total_mark1,$total_mark2,$total_mark3); 
						
						$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
						$grade = grade_syssss($total_sub_marks);
				?>
							<tr>
								<td><?php echo $subjects[0]['name']; ?>	</td>
								<td class="tg-yw4l"><?php echo $row2['ca_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['mark_obtained'];?></td>
								<td class="tg-yw4l"><?php echo ($row2['ca_marks']+$row2['mark_obtained']);?></td>
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
							<th class="tg-yw4l" rowspan="2">PRE-MOCK [100]</th>
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
					$query = $this->db->get_where('mark0' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
					$marks	=	$query->result_array();
					
					foreach($marks as $row2):
						$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
						$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
						
						
						$this->db->select("(mark_obtained) as total");
						$total_mark1 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=>35, 'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

						$this->db->select("(mark_obtained) as total");
						$total_mark2 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=>36,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
						$this->db->select("(mark_obtained) as total");
						$total_mark3 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=>37,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
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
							
					<?php endforeach; ?>

				 </tbody>
				</table>

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
					$query_Remark = $this->db->get_where('average0' , $verify_datas);

					if($query_Remark->num_rows() < 1){
					$this->db->insert('average0' , $verify_datas);
							}
					
					if ($class_id > 28 && $class_id < 32 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average0',array('exam_id' => $exam_id,'class_id'=> 111,'session_year'=>$sessoin_id))->result_array();
					 }
					 elseif ($class_id > 31 && $class_id < 35 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average0',array('exam_id' => $exam_id,'class_id'=> 112,'session_year'=>$sessoin_id))->result_array();
					 }
					 elseif ($class_id > 34 && $class_id < 38 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average0',array('exam_id' => $exam_id,'class_id'=> 113,'session_year'=>$sessoin_id))->result_array();
					 }
					
					 $cav = $z = 0;	
					foreach($total_average as $avgg){
						$z++;
						$cav +=$avgg['total_average'];
					}
					$class_avg = $cav / $z;
					$position = $this->crud_model->get_positions0($class_id,$student_id,$exam_id,$sessoin_id);
					
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
					$this->db->update('average0', $datas);
				?>

				<hr> 
				
				<!--COMMENT AREA-->
				<div class="table-responsive">
			<table style="width:100%; vertical-align: bottom;" class="print">
			<?php

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$sessoin_id);
				$query_comments = $this->db->get_where('comments0' , $verify_data);
				
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th style="width:50%;">Teacher's Name: <?php echo $row['TeacherNames'];?></th>
						<th style="width:50%;">Vice Principal's Name: <?php echo$row['VPName'];?></th>
					</tr>
					<tr>
						<th style="width:50%;">Teacher's Comment</th>
						<th style="width:50%;">Vice Principal's Comment</th>
					</tr>
					<tr>
						<td style="width:50%;"><?php echo $row['TeacherComments'];?></td>
						<td style="width:50%;"><?php echo $row['VPComment'];?></td>
					</tr>
				<?php endforeach; ?>

			</table>
				</div>
				
			<?php } ?>
			
			   <hr>
	<!-- Junior secondary -->
	<?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){ ?>
			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;display: inline-block;vertical-align: top;    overflow: auto;">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A [25]</th>
							<th class="tg-yw4l" rowspan="2">TEST [15]</th>
							<th class="tg-yw4l" rowspan="2">TOTAL [40]</th>
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
					$query = $this->db->get_where('mark0' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
					$marks	=	$query->result_array();
					
					foreach($marks as $row2):
						$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
						$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
						
						if ($class_id > 19 && $class_id < 23){
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark1 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 20, 'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark2 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 21,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark3 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 22,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						}

						elseif ($class_id > 22 && $class_id < 26){
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark1 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 23, 'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark2 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 24,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark3 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 25,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						}

						elseif ($class_id > 25 && $class_id < 29){
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark1 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 26,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();

							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark2 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 27,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						
							$this->db->select("(ca_marks+mark_obtained) as total");
							$total_mark3 = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'class_id'=> 28,'exam_id' => $exam_id,'session_year'=>$sessoin_id))->result_array();
						}

						$total_marks = array_merge($total_mark1,$total_mark2,$total_mark3); 
						
						$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
						$grade = grade_sysjss($total_sub_marks);
				?>
							<tr>
								<td><?php echo $subjects[0]['name']; ?>	</td>
								<td class="tg-yw4l"><?php echo $row2['ca_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['mark_obtained'];?></td>
								<td class="tg-yw4l"><?php echo ($row2['ca_marks']+$row2['mark_obtained']);?></td>
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
					$query_Remark = $this->db->get_where('average0' , $verify_datas);

					if($query_Remark->num_rows() < 1){
					$this->db->insert('average0' , $verify_datas);
							}
					
					if ($class_id > 19 && $class_id < 23 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average0',array('exam_id' => $exam_id,'class_id'=> 101,'session_year'=>$sessoin_id))->result_array();
					 }
					 elseif ($class_id > 22 && $class_id < 26 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average0',array('exam_id' => $exam_id,'class_id'=> 102,'session_year'=>$sessoin_id))->result_array();
					 }
					 elseif ($class_id > 25 && $class_id < 29 ){
						$this->db->select('total_average');
						$total_average = $this->db->get_where('average0',array('exam_id' => $exam_id,'class_id'=> 103,'session_year'=>$sessoin_id))->result_array();
					 }
					
					 $cav = $z = 0;	
					foreach($total_average as $avgg){
						$z++;
						$cav +=$avgg['total_average'];
					}
					$class_avg = $cav / $z;
					$position = $this->crud_model->get_positions0($class_id,$student_id,$exam_id,$sessoin_id);
					
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
					$this->db->update('average0', $datas);
				?>

				<hr>
	<!-- Primary --> 
		<?php }else if (strpos($class_type, 'primary') !== false){ ?>
			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width:auto; display: inline-block;">
						<tbody>
							<tr>
								<td colspan="13"></td>
								<td colspan="41" style="text-align: center;"><?php echo $exam_name ?></td>	
							</tr>
							<tr>
								<td></td>
								<td colspan="12">SUBJECTS</td>
								<td colspan="3" class="space" style="text-align: center;">MARKS<br>OBTAINABLE</td>
								<td colspan="3" class="space" style="text-align: center;">C.A 1<br>[20]</td>
								<td colspan="3" class="space" style="text-align: center;">C.A 2<br>C.W [10]</td>
								<td colspan="5" class="space" style="text-align: center;">TOTAL CA<br>[30]</td>
								<td width = "20%" class="space" style="text-align: center;">REMARKS</td>
								
								
							</tr>
							<?php 
							$query = $this->db->get_where('mark0_pri' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();
							 
							foreach($marks as $row2):
								if ($row2['ca_marks'] != 0){
									$a++;
									$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
									?>

									<?php if ($a == 2){
									$strand = $this->db->get('strand')->result_array();
									$c = 0;
									foreach($strand as $rowz):
										$c++;
										$strands = $this->db->get_where('strands0', array('exam_id' => $exam_id ,
																	'class_id' => $class_id ,
																	'strand_id' => $rowz['strand_id'] , 
																	'student_id' => $student_id,
																	'session_year'=>$get_system_settings[17]['description']))->result_array();
										foreach($strands as $rows):
									?>
											<tr>
												<td><?php echo '*'; ?></td>
												<td colspan="12"><?php echo  $this->crud_model->get_subject_name_by_ids('strand',$rows['strand_id']);?></td>
												<?php if ($c == 4){echo '<td class="space" colspan="3">20</td>';} 
													else echo '<td class="space" colspan="3">10</td>';
												?>
												<td class="space" colspan="3"><?php echo $rows['ca_1'];?></td>
												<td class="space" colspan="3"><?php echo $rows['ca_2'];?></td>
												<td class="space" colspan="5"><?php echo $rows['ca_marks'];?></td>
												<td class="space" width = "20%"><?php ?></td>
											</tr>
									<?php 
										endforeach;
									endforeach; } 
									?>
									<tr>
										<td><?php echo $a; ?></td>
										<td colspan="12"><?php echo $subjects[0]['name'];?></td>
										<td class="space" colspan="3">30</td>
										<td class="space" colspan="3"><?php echo $row2['ca_1'];?></td>
										<td class="space" colspan="3"><?php echo $row2['ca_2'];?></td>
										<td class="space" colspan="5"><?php echo $row2['ca_marks'];?></td>
										<td class="space" width = "20%"><?php echo grade_remark($row2['ca_marks']);?></td>
										</tr>
									<?php 
									if ($row2['ca_marks'] != 0){
										$d++;
									$tot = $row2['ca_marks'];
									$total_markss +=$tot;} 
								}
								endforeach;
								?>
							</tbody>
					</table>

		<!-- Individual Total Average -->
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
							'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_Remark = $this->db->get_where('average0' , $verify_data);

				if($query_Remark->num_rows() < 1){
					$this->db->insert('average0' , $verify_data);
						}

				$this->db->select('total_average');
				$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=> $class_id,'session_year'=>$sessoin_id))->result_array();

				$stavg = $total_markss / $d;
				
				$cav = $z = 0;	
				foreach($total_average as $avgg){
					$z++;
					$cav +=$avgg['total_average'];
				}
				//$position = $this->crud_model->get_positions0($class_id,$student_id,$exam_id,$sessoin_id);

				if ($total_markss > 0) {
					$datas['total_average'] = round($stavg,1);
					$datas['total_score'] = $total_markss;
					$datas['class_average'] = round($cav,1);}
					//$datas['position'] = $position;}
				
					if ($total_markss == Null) {
						$datas['total_average'] = 0;
						$datas['total_score'] = 0;
						$datas['class_average'] = 0;}
						//$datas['position'] = 'Null';}

					
					
				$this->db->where('class_id', $class_id);
        		$this->db->where('student_id', $student_id);
				$this->db->where('exam_id', $exam_id);
				$this->db->where('session_year', $sessoin_id);
				$this->db->update('average0', $datas);

				//echo $tavg;
			?>
			<hr>
				
			<!--COMMENT AREA-->
			<table style="width:100%; vertical-align: bottom;">
			<?php 
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
			
		
			<hr>
	<!-- Nursery-->
		<?php }else if (strpos($class_type, 'nursery 3') !== false){ ?>
			<style>table, tr, td, th {    border: 1px solid #000;border-collapse: collapse;font-family: sans-serif;font-size: 14px;}
				
				td, th { padding: 10px;}td span {font-size: 12px;}th {height: 100px;}
				.text-transform span {float: left;width: 100%;margin: 0 0 0 -22px;}
				.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); transform: rotate(270deg); width: 60px; max-width: 60px;}
				td.inner {padding: 0;}
				td.inner table {width: 100%;}
				td.inner table, td.inner tr {border: 0;}
			</style>

			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width:auto">
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_mark0 = $this->db->get_where('mark0_nur' , $verify_data);
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
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>NUMERACY</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>KUTW</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>PSHE</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>RHYME</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
                    <tr>
					<td colspan="12"><span>CREATIVE ART</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
					<td colspan="12"><span>SCIENCE</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['science'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['science'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['science'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['science'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
					<td colspan="12"><span>HANDWRITING</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['hand_writing'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['hand_writing'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['hand_writing'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['hand_writing'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
			</tbody>
          </table>

		<hr>

		<!--COMMENT AREA-->

		<table style="width:70%; vertical-align: bottom;">
			<?php if ($exam_name == 'TERM 3'){$exam_id++;} //step in for Term 3

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments0' , $verify_data);
				
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th style="height:fit-content">Teacher's Name: <?php echo ' ',$row['TeacherName'];?></th>
					</tr>
				<?php endforeach; ?>

			</table>

			<?php }else if (strpos($class_type, 'nursery 2') !== false){ ?>
			<style>table, tr, td, th {    border: 1px solid #000;border-collapse: collapse;font-family: sans-serif;font-size: 14px;}
				
				td, th { padding: 10px;}td span {font-size: 12px;}th {height: 100px;}
				.text-transform span {float: left;width: 100%;margin: 0 0 0 -22px;}
				.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); transform: rotate(270deg); width: 60px; max-width: 60px;}
				td.inner {padding: 0;}
				td.inner table {width: 100%;}
				td.inner table, td.inner tr {border: 0;}
			</style>

			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width:auto">
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_mark0 = $this->db->get_where('mark0_nur' , $verify_data);
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
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>NUMERACY</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>KUTW</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>PSHE</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>RHYME</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
                    <tr>
					<td colspan="12"><span>CREATIVE ART</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
					<td colspan="12"><span>HANDWRITING</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['hand_writing'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['hand_writing'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['hand_writing'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['hand_writing'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
					<td colspan="12"><span>WORK HABIT</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['work_habbit'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['work_habbit'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['work_habbit'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['work_habbit'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				
			</tbody>
          </table>

		<hr>

		<!--COMMENT AREA-->

		<table style="width:70%; vertical-align: bottom;">
			<?php if ($exam_name == 'TERM 3'){$exam_id++;} //step in for Term 3

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments0' , $verify_data);
				
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th style="height:fit-content">Teacher's Name: <?php echo ' ',$row['TeacherName'];?></th>
					</tr>
				<?php endforeach; ?>

			</table>

			<?php }else if (strpos($class_type, 'nursery 1') !== false){ ?>
			<style>table, tr, td, th {    border: 1px solid #000;border-collapse: collapse;font-family: sans-serif;font-size: 14px;}
				
				td, th { padding: 10px;}td span {font-size: 12px;}th {height: 100px;}
				.text-transform span {float: left;width: 100%;margin: 0 0 0 -22px;}
				.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); transform: rotate(270deg); width: 60px; max-width: 60px;}
				td.inner {padding: 0;}
				td.inner table {width: 100%;}
				td.inner table, td.inner tr {border: 0;}
			</style>

			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width:auto">
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_mark0 = $this->db->get_where('mark0_nur' , $verify_data);
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
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['effort_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>NUMERACY</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>KUTW</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>PSHE</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>RHYME</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
                    <tr>
					<td colspan="12"><span>CREATIVE ART</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['willingness_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
					<td colspan="12"><span>WORK HABIT</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['work_habbit'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['work_habbit'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['work_habbit'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['work_habbit'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
					<td colspan="12"><span>COMMUNICATION SKILLS</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['comm_skills'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['comm_skills'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['comm_skills'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['comm_skills'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
					<td colspan="12"><span>GROSS MOTOR SKILLS</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['gms'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['gms'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['gms'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['gms'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
					<td colspan="12"><span>FINE MOTOR SKILLS</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['fms'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['fms'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['fms'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['fms'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
			</tbody>
          </table>

		<hr>

		<!--COMMENT AREA-->

		<table style="width:70%; vertical-align: bottom;">
			<?php if ($exam_name == 'TERM 3'){$exam_id++;} //step in for Term 3

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments0' , $verify_data);
				
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th style="height:fit-content">Teacher's Name: <?php echo ' ',$row['TeacherName'];?></th>
					</tr>
				<?php endforeach; ?>

			</table>

			<?php }else if (strpos($class_type, 'toddler') !== false){ ?>
			<style>table, tr, td, th {    border: 1px solid #000;border-collapse: collapse;font-family: sans-serif;font-size: 14px;}
				
				td, th { padding: 10px;}td span {font-size: 12px;}th {height: 100px;}
				.text-transform span {float: left;width: 100%;margin: 0 0 0 -22px;}
				.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); transform: rotate(270deg); width: 60px; max-width: 60px;}
				td.inner {padding: 0;}
				td.inner table {width: 100%;}
				td.inner table, td.inner tr {border: 0;}
			</style>

			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width:auto">
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_mark0 = $this->db->get_where('mark0_nur' , $verify_data);
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
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attitude_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>KNOWLEDGE AND UNDERSTANDING OF THE WORLD (KUTW)</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['attentiveness_mark'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>PERSONAL, SOCIAL AND HEALTH EDUCATION (PSHE)</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['assignment_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
                    </tr>
                    <tr>
					<td colspan="12"><span>RHYME</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['interest_marks'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
                    <tr>
					<td colspan="12"><span>SOCIAL SKILLS</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['social_skills'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['social_skills'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['social_skills'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['social_skills'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
					<td colspan="12"><span>COMMUNICATION SKILLS</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['comm_skills'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['comm_skills'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['comm_skills'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['comm_skills'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
					<td colspan="12"><span>GROSS MOTOR SKILLS</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['gms'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['gms'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['gms'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['gms'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
				<tr>
					<td colspan="12"><span>FINE MOTOR SKILLS</span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['fms'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['fms'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['fms'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
						<td style="text-align:center;"><span <?php if($row2[0]['fms'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
				</tr>
			</tbody>
          </table>

		<hr>

		<!--COMMENT AREA-->

		<table style="width:70%; vertical-align: bottom;">
			<?php if ($exam_name == 'TERM 3'){$exam_id++;} //step in for Term 3

				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$get_system_settings[17]['description']);
				$query_comments = $this->db->get_where('comments0' , $verify_data);
				
				$student_comments = $query_comments->result_array();
				foreach($student_comments as $row):	

			?>
			
					<tr>
						<th style="height:fit-content">Teacher's Name: <?php echo ' ',$row['TeacherName'];?></th>
					</tr>
				<?php endforeach; ?>

			</table>

		<?php } ?>
		
		<center>
			<a href="<?php echo base_url();?>index.php?admin/tabulation_sheet_midterm_print_view_control/<?php echo $class_id;?>/<?php echo $exam_id;?>/<?php echo $sessoin_id;?>" 
				class="btn btn-orange btn-sm btn-icon icon-left" target="_blank">
				<i class="entypo-print"></i><?php echo get_phrase('mass_report_card');?>
			</a>
			<a href="<?php echo base_url();?>index.php?admin/tabulation_sheet_midterm_print_single_control/<?php echo $class_id;?>/<?php echo $exam_id;?>/<?php echo $sessoin_id;?>/<?php echo $student_id;?>" 
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
					url: '<?php echo base_url();?>index.php?admin/student_session_year/' + session_year +'/'+class_id+'/current',
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
					url: '<?php echo base_url();?>index.php?admin/student_session_year/' + session_year +'/'+class_id,
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
					url: '<?php echo base_url();?>index.php?admin/student_session_year/' + session_year +'/'+class_id+'/current',
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
					url: '<?php echo base_url();?>index.php?admin/student_session_year/' + session_year +'/'+class_id,
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
		if($val >=54){
			$grade = 'A';
		}else if($val >=42 && $val<= 53){
			$grade = 'B';
		}else if($val >=36 && $val<= 41){
			$grade = 'C+';
		}else if($val >=30 && $val<= 35){
			$grade = 'C';
		}else if($val >=24 && $val<= 29){
			$grade = 'D';
		}else if($val >=0 && $val<= 23){
			$grade = 'E';
					}
		return $grade;
	}

	function grade_syssss($val){
		if($val >=25){
			$grade = 'A';
		}else if($val >=20 && $val<= 24){
			$grade = 'B';
		}else if($val >=15 && $val<= 19){
			$grade = 'C';
		}else if($val >=10 && $val<= 14){
			$grade = 'D';
		}else if($val >=5 && $val<= 9){
			$grade = 'E';
		}else if($val >=0 && $val<= 4){
			$grade = 'UNGRADED';
					}
		return $grade;
	}
	function grade_sysjss($val){
		if($val >=35){
			$grade = 'A';
		}else if($val >=30 && $val<= 53){
			$grade = 'B';
		}else if($val >=25 && $val<= 41){
			$grade = 'C';
		}else if($val >=20 && $val<= 35){
			$grade = 'D';
		}else if($val >=15 && $val<= 29){
			$grade = 'E';
		}else if($val >=0 && $val<= 14){
			$grade = 'UNGRADED';
					}
		return $grade;
	}

	function grade_remark($val){
		if($val >=27){
			$grade = 'EXCELLENT';
		}else if($val >=21 && $val<= 26.9){
			$grade = 'VERY GOOD';
		}else if($val >=17 && $val<= 20.9){
			$grade = 'GOOD';
		}else if($val >=15 && $val<= 16.9){
			$grade = 'AVERAGE';
		}else if($val >=10 && $val<= 14.9){
			$grade = 'PASS';
		}else if($val >=0 && $val<= 9.9){
			$grade = 'POOR';
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
