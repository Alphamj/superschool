<!DOCTYPE html>
<html>
<head>
	<title>Print|Student Report Card</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="container-fluid">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/report-card.css" type="text/css">
<!-- <link rel="stylesheet" media="print" href="assets/css/print.css" type="text/css"> -->
<style type="text/css">
	td {padding: 8px;color: #000 !important;border: 1px solid #D2CBCB;font-size: 12px;}
	.tg  {border-collapse:collapse;border-spacing:0;}
	.tg td{font-family: Arial, sans-serif;font-size: 12px;padding: 8px;border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #ddd;color: #000;}
	.tg th{font-family: Arial, sans-serif;font-size: 12px;padding: 8px;border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #ddd;color: #111;}
	.tg .tg-yw4l{vertical-align:middle;text-align: center;}
	.tg.table-two {margin: 100px 0 0 0;}
	.tg tr th, .tg tr td {color: #000;}
	td.space {min-width: 85px;text-align: center;}
	td h5 {color: #000 !important;}
	.print {padding: 10px;border: 4px;}
	.print h4, .print h2 {text-align: left;}
	span.grade-right::before {content: "\f00c";font-family: fontawesome;color: green;}
</style>
<?php  
	$students   =   $this->crud_model->get_student_info($student_id); 
    foreach($students as $row): 
        $student_id = $row['student_id'];
        $roll = $row['roll'];
	    $sex = $row['sex'];
        $total_marks = 0;
        $total_class_score = 0;

	   $total_grade_point = 0;

	$query = $this->db->get_where('attendance', array('exam_id' => $exam_id ,'class_id' => $class_id, 'student_id' => $student_id,'session_year'=> $sessoin_id));
		$att = $query->result_array();
		$a=$b=$c=$d=$e=$total=$present=0;
		foreach($att as $attend){
			if ($attend['status'] == 1){$a++;}
			elseif ($attend['status'] == 2){$b++;}
			elseif ($attend['status'] == 3){$c++;}
			elseif ($attend['status'] == 4){$d++;}
			elseif ($attend['status'] == 5){$e++;}
		}
		$present = $a+$d+$e;
		$total = $a+$b+$d+$e;
?>

		  
<!-- CODE added on 04 june 2018 sandeep-->
	<?php if ($class_id > 19 && $class_id < 40){?>
		<div class="print" style="border:1px solid #000; margin-top: 30px;">
			<div class="table-responsive" style="padding: 2px;">
				<table class="table-bordered" style="width: 80%; margin:auto; margin-bottom: 10px;">
					<tbody>
						<tr>
							<td colspan="1" rowspan="4"><img style="display: inline;" src="uploads/logo.png" style="max-height:100%; display: block; margin:auto; padding:auto"></td>
							<td colspan="17" style="text-align: center;font-size: 45px;font-family: 'canterburyregular';"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 20px;padding-bottom: 8px;">(SECONDARY SECTION)</td>
						</tr>
						<?php if ($class_id > 19 && $class_id < 35){ ?>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">END OF TERM REPORT</td>
						</tr>
						<?php } if ($class_id > 34 && $class_id <40){ ?>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">PRE-MOCK REPORT</td>
						</tr>
						<?php } ?>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 15px;"><?php  $exam_name = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; echo $exam_name.' , '.$sessoin_id.' SESSION';?></td>
						</tr>
					</tbody>
				</table>
			
				<table class="table" style="width: 80%; margin:auto; margin-bottom:10px;">
					<tbody>
						<tr>
							<td><strong>Name</strong></td>
							<td><strong><?php echo $row['surname'].' '.$row['name'];?></strong></td>
							<td><strong>Class</strong></td>
							<td colspan="6"><?php $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name2;echo $class_name;?></td>
						</tr>
						<tr>
							<td><strong>Admission No</strong></td>
							<td><?php echo $roll;?></td>
							<td><strong>Sex</strong></td>
							<td><?php echo $sex;?></td>

							<?php if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?> 
							<td><strong>Attendance</strong></td>
							<td><?php $attendence = $this->db->get_where('comments',array('exam_id' => $exam_id,'student_id' => $student_id ,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->Attendances; echo $attendence //echo $present . '/' . $total;?></td>
							<?php } ?>
						</tr>
						<?php if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?> 
						<tr>
							<td><strong>Next Term Begins</strong></td>
							<td><?php $resumption_date = $this->db->get_where('mark',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->resumption_date; echo $resumption_date;?></td>
							<td><strong>Date of Vacation</strong></td>
							<td colspan="6"><?php $vacation_date = $this->db->get_where('mark',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->vacation_date; echo $vacation_date;?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>

<!--Senior Secondary-->
	<?php } $class_type = strtolower($this->crud_model->get_class_name($class_id)); 
		$jss = "no";
		if(strpos($class_type, 'jss') !== false ){
			$jss = "yes";
		}
				
		if (strpos($class_type, 'ss') !== false && $jss !='yes'){
	?>
					
<div style="width: 98.8%;display: inline-block;vertical-align: top; margin-left: 10px;">
	<?php //if ($exam_id = 4){ $exam_id--;} ?>
		<div class="table-responsive">

			<!-- For SS 1 & 2 -->
			<?php if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?> 

			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
				<thead>
					<tr>
						<th class="tg-yw4l" rowspan="2">SUBJECT</th>
						<th class="tg-yw4l" rowspan="2">C.A <br /> [30]</th>
						<th class="tg-yw4l" rowspan="2">EXAM <br />[70]</th>
						<th class="tg-yw4l" rowspan="2">TOTAL <br /> [100]</th>
						<th class="tg-yw4l" rowspan="2">SUBJECT <br />AVERAGE </th>
						<th class="tg-yw4l" rowspan="2">G<br />R<br />A<br />D<br />E<br />S</th>
						<th class="tg-yw4l" rowspan="2">CLASS <br /> MAXIMUM</th>
						<th class="tg-yw4l" rowspan="2">E<br />F<br />F<br />O<br />R<br />T</th>
						<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'S REMARKS</th>
						<th class="tg-yw4l" rowspan="2">TEACHER</th>
					</tr>
					<tr>
						<td class="tg-yw4l">ATTITUDE <br /> TO WORK <br /> AND TASK</td>
						<td class="tg-yw4l">ATTENTIVENESS <br />IN CLASS</td>
						<td class="tg-yw4l">RESPONSE TO <br /> ASSIGNMENTS <br /> AND PROJECTS</td>
						<td class="tg-yw4l">INTEREST <br /> IN SUBJECT</td>
						<td class="tg-yw4l">WILLINGNESS <br /> TO WORK <br /> WITH OTHERS</td>
					</tr>
                    </thead>
				<?php 
							$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();
							if ($class_id > 28 && $class_id < 32 ){
								$value = $this->db->get_where('average',array('exam_id' => $exam_id, 'student_id' => $student_id,'class_id'=> 111,'session_year'=>$sessoin_id))->result_array();
							 }
							 elseif ($class_id > 31 && $class_id < 35 ){
								$value = $this->db->get_where('average',array('exam_id' => $exam_id, 'student_id' => $student_id,'class_id'=> 112,'session_year'=>$sessoin_id))->result_array();
							 }
							 elseif ($class_id > 34 && $class_id < 38 ){
								$value = $this->db->get_where('average',array('exam_id' => $exam_id, 'student_id' => $student_id,'class_id'=> 113,'session_year'=>$sessoin_id))->result_array();
							 }
							$total_markss=$total_sub_marks1_all=$total_sub_marks2_all0;
							foreach($marks as $row2):
								if ($row2['mark_total'] != 0){
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
						
								<?php } endforeach; ?>
							<tr>
								<td colspan="3" style="text-align: center">Total Marks</td>
								<td style="text-align: center"><?php echo $value[0]['total_score'];;?></td>
								<td colspan="2" style="text-align: center">Student Average</td>
								<td style="text-align: center"><?php echo $value[0]['total_average'];?></td>
								<td colspan="2" style="text-align: center">Class Average</td>
								<td style="text-align: center"><?php echo $value[0]['class_average'];?></td>
								<td colspan="1" style="text-align: center">Position</td>
								<td style="text-align: center"><?php echo $value[0]['position'];?></td>
							</tr>
						</tbody>
					</table>
			<!-- For SS3 -->
			<?php } if (strpos($class_type, 'ss 3') !== false) { ?> 
			
			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
				<thead>
					<tr>
						<th class="tg-yw4l" rowspan="2">SUBJECT</th>
						<th class="tg-yw4l" rowspan="2">PRE-MOCK <br />[100]</th>
						<th class="tg-yw4l" rowspan="2">G<br />R<br />A<br />D<br />E<br />S</th>
						<th class="tg-yw4l" rowspan="2">CLASS <br /> MAXIMUM</th>
						<th class="tg-yw4l" rowspan="2">E<br />F<br />F<br />O<br />R<br />T</th>
						<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'S REMARKS</th>
						<th class="tg-yw4l" rowspan="2">TEACHER</th>
					</tr>
					<tr>
						<td class="tg-yw4l">ATTITUDE <br /> TO WORK <br /> AND TASK</td>
						<td class="tg-yw4l">ATTENTIVENESS <br />IN CLASS</td>
						<td class="tg-yw4l">RESPONSE TO <br /> ASSIGNMENTS <br /> AND PROJECTS</td>
						<td class="tg-yw4l">INTEREST <br /> IN SUBJECT</td>
						<td class="tg-yw4l">WILLINGNESS <br /> TO WORK <br /> WITH OTHERS</td>
					</tr>
                    </thead>
					<?php 
						$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
						$marks	=	$query->result_array();
						$value = $this->db->get_where('average', array('class_id' => 113, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id))->result_array();
						$total_markss=$total_sub_marks1_all=$total_sub_marks2_all0;
						foreach($marks as $row2):
							if ($row2['mark_obtained'] != 0){
							$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
							$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
							
							$this->db->select("(mark_obtained) as total");
							$class_max1 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=> 35 ,'session_year'=>$sessoin_id))->result_array();
							$this->db->select("(mark_obtained) as total");
							$class_max2 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id, 'class_id'=>36, 'session_year'=>$sessoin_id))->result_array();
							$this->db->select("(mark_obtained) as total");
							$class_max3 = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id, 'class_id'=> 37, 'session_year'=>$sessoin_id))->result_array();
				
							$class_max = array_merge($class_max1,$class_max2,$class_max3);
							$this->db->select("student_id");
							$tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
							
							$total_sub_marks = $row2['mark_obtained'];
							$grade = grade_mock($total_sub_marks);
					?>
						
						<tr>
							<td><?php echo $subjects[0]['name']; ?>	</td>
							<td class="tg-yw4l"><?php echo $row2['mark_obtained'];?></td>
							<td class="tg-yw4l"><?php echo $grade;?></td>
							<td class="tg-yw4l"><?php $arr_max = max($class_max); echo $arr_max['total']; ?></td>
							<td class="tg-yw4l"><?php echo $row2['effort_marks'];?></td>
							<td class="tg-yw4l"><?php echo $row2['attitude_marks'];?></td>
							<td class="tg-yw4l"><?php echo $row2['attentiveness_mark'];?></td>
							<td class="tg-yw4l"><?php echo $row2['assignment_marks'];?></td>
							<td class="tg-yw4l"><?php echo $row2['interest_marks'];?></td>
							<td class="tg-yw4l"><?php echo $row2['willingness_marks'];?></td>
							<td class="tg-yw4l"><?php echo $row2['teacher']; ?></td>
						</tr>
						
					<?php } endforeach; ?>

						<tr>
								<td colspan="3" style="text-align: center">Total Marks</td>
								<td style="text-align: center"><?php echo $value[0]['total_score'];?></td>
								<td colspan="2" style="text-align: center">Student Average</td>
								<td style="text-align: center"><?php echo $value[0]['total_average'];?></td>
								<td colspan="2" style="text-align: center">Class Average</td>
								<td style="text-align: center"><?php echo $value[0]['class_average'];?></td>
								<!--<td colspan="1" style="text-align: center">Position</td>
								<td style="text-align: center"><?php //echo $value[0]['position'];?></td>-->
							</tr>
						</tbody>
					</table>
				<br />
				<hr>
				<br />
			
			<div class="table-responsive">
				<table style=" margin:10px;" class="tg">
					
					<tr>
						<td style=" font-size:20px;">key:</td>
						<td style=" font-size:13px;"><strong>A1</strong> = Excellent (75-100) </td>
						<td style=" font-size:13px;"><strong>B2</strong> = V.GOOD (70-74) </td>
						<td style=" font-size:13px;"><strong>B3</strong> = GOOD (65-69) </td>
						<td style=" font-size:13px;"><strong>C4</strong> = CREDIT (60-64) </td>
						<td style=" font-size:13px;"><strong>C5</strong> = CREDIT (55-59) </td>
						<td style=" font-size:13px;"><strong>C6</strong> = CREDIT (50-54) </td>
						<td style=" font-size:13px;"><strong>D7</strong> = PASS (45-49) </td>
						<td style=" font-size:13px;"><strong>D8</strong> = PASS (40-44) </td>
						<td style=" font-size:13px;"><strong>F9</strong> = FAIL (0-39) </td>
					</tr>
					<tr>
						<td style=" font-size:15px;" colspan="1" rowspan="3">Definitions:</td>
						<td style=" font-size:15px;" colspan="1">Grade -</td>
						<td style=" font-size:15px;" colspan="8">Assessment level of academic achievement based on the total score</td>
					</tr>
					<tr>
						<td style=" font-size:15px;" colspan="1">Class max -</td>
						<td style=" font-size:15px;" colspan="8">Highest grade obtained in the subject</td>
					</tr>
					<tr>
						<td style=" font-size:15px;" colspan="1">Effort -</td>
						<td style=" font-size:15px;" colspan="8">Assessment of the level of intrest and seriousness</td>
					</tr>
				</table>

				<br />
				
				<table style="width:70%; vertical-align: top; margin:10px;" class="tg">
					<?php 

						$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
										'student_id' => $student_id , 'session_year' => $sessoin_id);
						$query_comments = $this->db->get_where('comments' , $verify_data);

						$student_comments = $query_comments->result_array();
						foreach($student_comments as $row):
					?>

					<tr>
						<td colspan="3" class="tg-yw4l">TEACHER'S NAME:</td>
						<td colspan="4" width="30%"><?php echo ' ',$row['TeacherNames'];?></td>
						<td colspan="3" class="tg-yw4l">VICE PRINCIPAL'S NAME:</td>
						<td colspan="4" width="30%"><?php echo ' ',$row['VPName'];?></td>
					</tr>
					
					<tr>
						<td colspan="3" class="tg-yw4l">SIGNATURE:</td>
						<td colspan="4"><img src="uploads/signature/<?php echo $row['teach_sign'];?>" style="width:25%; height:25%; display: block; margin:auto; padding:auto"></td>
						<td colspan="3" class="tg-yw4l">SIGNATURE:</td>
						<td colspan="4"><img src="uploads/signature/<?php echo $row['head_sign'];?>" style="width:25%; height:25%; display: block; margin:auto; padding:auto"></td>
					</tr>

					<?php endforeach; ?>
				</table>
			</div>
			<?php } ?>
				</div>
			</div>
		</div>

		<br />
		
		<?php if ($class_id > 28 && $class_id < 35) { ?>
		<p style = "page-break-before:always">
		
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

		<div class="print" style="width:99%; margin:auto; border:1px solid #000;">
			<div class="table-responsive">
				<table style="width:auto; margin-left:10px;" class="tg">
					<tr>
						<td style=" font-size:20px;">key:</td>
						<td style=" font-size:14px;"><strong>A+</strong> = Excellent (90-100) </td>
						<td style=" font-size:14px;"><strong>A</strong> = Very Good (80-89) </td>
						<td style=" font-size:14px;"><strong>B</strong> = Good (70-79) </td>
						<td style=" font-size:14px;"><strong>C</strong> = Fair (60-69) </td>
						<td style=" font-size:14px;"><strong>D</strong> = Poor (50-59) </td>
						<td style=" font-size:14px;"><strong>E</strong> = Weak (40-49) </td>
					</tr>
					<tr>
						<td style=" font-size:15px;" colspan="1" rowspan="3">Definitions:</td>
						<td style=" font-size:15px;" colspan="1">Grade -</td>
						<td style=" font-size:15px;" colspan="8">Assessment level of academic achievement based on the total score</td>
					</tr>
					<tr>
						<td style=" font-size:15px;" colspan="1">Class max -</td>
						<td style=" font-size:15px;" colspan="8">Highest grade obtained in the subject</td>
					</tr>
					<tr>
						<td style=" font-size:15px;" colspan="1">Effort -</td>
						<td style=" font-size:15px;" colspan="8">Assessment of the level of intrest and seriousness</td>
					</tr>
				</table>

				<br />

				<!-- individual Assessment-->
				<table style="width:auto; vertical-align: bottom;float:left; margin-left:10px;" class="tg">
				<?php

					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id , 'session_year' => $sessoin_id);
					$query_remark = $this->db->get_where('Remark' , $verify_data);

					$student_remark = $query_remark->result_array();
					foreach($student_remark as $row):	

				?>
					<thead>
						<tr>	
							<th style=" font-size:15px;"colspan = "8" class="tg-yw4l">APTITUDE, WORK HABITS, TRAITS AND SOCIAL SKILLS</th>
						</tr>
						<tr>
							<th style=" font-size:15px;" colspan = "5" class="tg-yw4l">COMPONENTS</th>
							<th style=" font-size:15px;" colspan = "3" class="tg-yw4l">REMARKS</th>
						</tr>
					</thead>	
					<tbody>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Quick at understanding new concept.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R1"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Works independently.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R2"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Reasons logically.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R3"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Makes intelligent contributions in the class.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R4"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Is attentive and follows directions.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R5"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Checks and correct assignments.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R6"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Completes homework promptly.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R7"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Honest at work and play.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R8"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;"colspan = "5">Neat in school work.</td>
							<td style=" font-size:15px;"class="tg-yw4l"><?php echo $row["R9"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Neat in personal appearance.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R10"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Enjoys the company of classmates.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R11"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;"colspan = "5">Participates in school activites.</td>
							<td style=" font-size:15px;"class="tg-yw4l"><?php echo $row["R12"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;"colspan = "5">Keeps school rules and regulations.</td>
							<td style=" font-size:15px;"class="tg-yw4l"><?php echo $row["R13"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Respects school authority and staff.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R14"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Handles own and school property with care.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R15"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Punctual at school.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R16"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Sense of leadership.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R17"]; ?></td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan = "5">Musical/Creative Skills.</td>
							<td style=" font-size:15px;" class="tg-yw4l"><?php echo $row["R18"]; ?></td>
						</tr>
					</tbody>
					<?php endforeach; ?>
				</table>

				<br />

				<!-- Commemt area -->
				<table style="width:50%; vertical-align: top; float:right; margin-right:10px;" class="tg">
					<?php 
						$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
						$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();
						$head_sign = $this->db->get_where('head', array('section'=>'Secondary'))->result_array();

						$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
										'student_id' => $student_id , 'session_year' => $sessoin_id);
						$query_comments = $this->db->get_where('comments' , $verify_data);

						$student_comments = $query_comments->result_array();
						foreach($student_comments as $row):
					?>

					<tr>
						<td colspan="6" class="tg-yw4l">TEACHER'S COMMENT:</td>
						<td colspan="8" class="tg-yw4l"><?php echo $row['TeacherComments'];?></td>
					</tr>
					<tr>
						<td colspan="6" class="tg-yw4l">NAME:</td>
						<td colspan="8"><?php echo ' ',$row['TeacherNames'];?></td>
					</tr>
					
					<tr>
						<td colspan="6" class="tg-yw4l">SIGNATURE:</td>
						<td colspan="8"><img style="display: block; margin:auto; width:100px;" src="uploads/signature/<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg';?>" style="width:25%; height:25%; display: block; margin:auto; padding:auto"></td>
					</tr>
					<tr>
						<td colspan="6"></td>
					</tr>
					<tr>
						<td colspan="6" class="tg-yw4l">VICE PRINCIPAL'S COMMENT:</td>
						<td colspan="8" class="tg-yw4l"><?php echo ' ',$row['VPComment'];?><br></td>
					</tr>
					<tr>
						<td colspan="6" class="tg-yw4l">NAME:</td>
						<td colspan="8"><?php echo ' ',$row['VPName'];?></td>
					</tr>
					<tr>
						<td colspan="6" style="width:25%" class="tg-yw4l">SIGNATURE:</td>
						<td colspan="8"><img style="display: block; margin:auto; width:100px;" src="uploads/signature/<?php echo $head_sign[0]['head_id'] . '.' . 'jpg';?>" style="width:25%; height:25%; display: block; margin:auto; padding:auto"></td>
					</tr>

					<?php endforeach; ?>

				</table>

				<table style="width:50%; vertical-align: top; float:right; margin-right:10px; margin-top:10px;" class="tg">
					<tbody>
						<tr>
							<td style=" font-size:15px;" >Rating Key:</td>
							<td style=" font-size:15px;" >A:</td>
							<td style=" font-size:15px;" >Maintain an excellent degree of observed trait.</td>
						</tr>
						<tr>
							<td style=" font-size:15px;" colspan="1" rowspan="4"></td>	
							<td style=" font-size:15px;" >B:</td>
							<td style=" font-size:15px;" >Maintains a high level of observed trait.</td>
						</tr>
						<tr>
							<td style=" font-size:15px;" >C:</td>
							<td style=" font-size:15px;" >Maintains acceptable level.</td>
						</tr>
						<tr>
							<td style=" font-size:15px;" >D:</td>
							<td style=" font-size:15px;" >Shows minimal regards for trait.</td>
						</tr>
						<tr>
							<td style=" font-size:15px;" >E:</td>
							<td style=" font-size:15px;" >Has no regard for the observed trait.</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<?php } ?>
	

<!--Junior Secondary-->
	<?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){?>
		<div style="width: 98.8%;display: inline-block;vertical-align: top; margin-left: 10px;">
			<?php //if ($exam_id = 4){ $exam_id--;} ?>
				<div class="table-responsive">
					<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
						<thead>
							<tr >
								<th class="tg-yw4l" rowspan="2">SUBJECT</th>
								<th class="tg-yw4l" rowspan="2">C.A <br /> [40]</th>
								<th class="tg-yw4l" rowspan="2">EXAM <br /> [60]</th>
								<th class="tg-yw4l" rowspan="2">TOTAL <br /> [100]</th>
								<th class="tg-yw4l" rowspan="2">SUBJECT <br /> AVERAGE</th>
								<th class="tg-yw4l" rowspan="2">G<br />R<br />A<br />D<br />E<br />S</th>
								<th class="tg-yw4l" rowspan="2">CLASS <br /> MAXIMUM</th>
								<th class="tg-yw4l" rowspan="2">E<br />F<br />F<br />O<br />R<br />T</th>
								<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'S REMARKS</th>
								<th class="tg-yw4l" rowspan="3">TEACHER</th>
							</tr>
							<tr>
								<td class="tg-yw4l">ATTITUDE <br /> TO WORK <br /> AND TASK</td>
								<td class="tg-yw4l">ATTENTIVENESS <br /> IN CLASS</td>
								<td class="tg-yw4l">RESPONSE TO <br /> ASSIGNMENTS <br />AND PROJECTS</td>
								<td class="tg-yw4l">INTEREST <br /> IN SUBJECT</td>
								<td class="tg-yw4l">WILLINGNESS <br /> TO WORK <br /> WITH OTHERS</td>
							</tr>
						
						</thead>
						<tbody>
				
						<?php 
							$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();
							if ($class_id > 19 && $class_id < 23 ){
								$value = $this->db->get_where('average',array('exam_id' => $exam_id, 'student_id' => $student_id,'class_id'=> 101,'session_year'=>$sessoin_id))->result_array();
							 }
							 elseif ($class_id > 22 && $class_id < 26 ){
								$value = $this->db->get_where('average',array('exam_id' => $exam_id, 'student_id' => $student_id,'class_id'=> 102,'session_year'=>$sessoin_id))->result_array();
							 }
							 elseif ($class_id > 25 && $class_id < 29 ){
								$value = $this->db->get_where('average',array('exam_id' => $exam_id, 'student_id' => $student_id,'class_id'=> 103,'session_year'=>$sessoin_id))->result_array();
							 }
							$total_markss=$total_sub_marks1_all=$total_sub_marks2_all0;
							foreach($marks as $row2):
								if ($row2['mark_total'] != 0){
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
						
							<?php } endforeach; ?>
							<tr>
								<td colspan="3" style="text-align: center">Total Marks</td>
								<td style="text-align: center"><?php echo $value[0]['total_score'];;?></td>
								<td colspan="2" style="text-align: center">Student Average</td>
								<td style="text-align: center"><?php echo $value[0]['total_average'];?></td>
								<td colspan="2" style="text-align: center">Class Average</td>
								<td style="text-align: center"><?php echo $value[0]['class_average'];?></td>
								<td colspan="1" style="text-align: center">Position</td>
								<td style="text-align: center"><?php echo $value[0]['position'];?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<br />

		<p style = "page-break-before:always">
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		
		<div class="print" style="width:100%; margin:auto; border:1px solid #000;">
			<div class="table-responsive">
				<table style="width:auto; margin-left:10px;" class="tg">
					<tr>
						<td >key:</td>
						<td colspan="2"><strong>A+</strong> = Excellent (90-100) <strong>A</strong> = Very Good (80-89) <strong>B</strong> = Good (70-79) <strong>C</strong> = Fair (60-69) <strong>D</strong> = Poor (50-59) <strong>E</strong> = Weak (40-49)</td>
					</tr>
					<tr>
						<td colspan="1" rowspan="3">Definitions:</td>
						<td colspan="1">Grade -</td>
						<td colspan="1">Assessment level of academic achievement based on the total score</td>
					</tr>
					<tr>
						<td colspan="1">Class max -</td>
						<td colspan="1">Highest grade obtained in the subject</td>
					</tr>
					<tr>
						<td colspan="1">Effort -</td>
						<td colspan="1">Assessment of the level of intrest and seriousness</td>
					</tr>
				</table>

				<br />

				<!-- individual Assessment-->
				<table style="width:auto; vertical-align: bottom;float:left; margin-left:10px;" class="tg">
				<?php

					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id , 'session_year' => $sessoin_id);
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

				<br />

				<!-- Commemt area -->
				<table style="width:50%; vertical-align: top; float:right; margin-right:10px;" class="tg">
					<?php
						$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
						$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();
						$head_sign = $this->db->get_where('head', array('section'=>'Secondary'))->result_array();
						
						$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
										'student_id' => $student_id , 'session_year' => $sessoin_id);
						$query_comments = $this->db->get_where('comments' , $verify_data);

						$student_comments = $query_comments->result_array();
						foreach($student_comments as $row):
					?>

					<tr>
						<td colspan="6" class="tg-yw4l">TEACHER'S COMMENT:</td>
						<td colspan="8" class="tg-yw4l"><?php echo $row['TeacherComments'];?></td>
					</tr>
					<tr>
						<td colspan="6" class="tg-yw4l">NAME:</td>
						<td colspan="8"><?php echo ' ',$row['TeacherNames'];?></td>
					</tr>
					
					<tr>
						<td colspan="6" class="tg-yw4l">SIGNATURE:</td>
						<td colspan="8"><img style="display: block; margin:auto; width:100px;" src="uploads/signature/<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg';?>" style="width:25%; height:50%; display: block; margin:auto; padding:auto"></td>
					</tr>
					<tr>
						<td colspan="6"></td>
					</tr>
					<tr>
						<td colspan="6" class="tg-yw4l">VICE PRINCIPAL'S COMMENT:</td>
						<td colspan="8" class="tg-yw4l"><?php echo ' ',$row['VPComment'];?><br></td>
					</tr>
					<tr>
						<td colspan="6" class="tg-yw4l">NAME:</td>
						<td colspan="8"><?php echo ' ',$row['VPName'];?></td>
					</tr>
					<tr>
						<td colspan="6" style="width:25%" class="tg-yw4l">SIGNATURE:</td>
						<td colspan="8"><img style="display: block; margin:auto; width:100px;" src="uploads/signature/<?php echo $head_sign[0]['head_id'] . '.' . 'jpg';?>" style="width:25%; height:50%; display: block; margin:auto; padding:auto"></td>
					</tr>

					<?php endforeach; ?>

				</table>

				

				<table style="width:50%; vertical-align: top; float:right; margin-right:10px; margin-top:10px;" class="tg">
					<tbody>
						<tr>
							<td >Rating Key:</td>
							<td >A:</td>
							<td>Maintain an excellent degree of observed trait.</td>
						</tr>
						<tr>
							<td colspan="1" rowspan="4"></td>	
							<td >B:</td>
							<td >Maintains a high level of observed trait.</td>
						</tr>
						<tr>
							<td >C:</td>
							<td >Maintains acceptable level.</td>
						</tr>
						<tr>
							<td >D:</td>
							<td >Shows minimal regards for trait.</td>
						</tr>
						<tr>
							<td >E:</td>
							<td >Has no regard for the observed trait.</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

<!--Primary Print View Edited 27/05/2019-->
<?php }else if (strpos($class_type, 'primary') !== false){ 
	if($exam_id >= 4) {$exam_id = 3;}?>
		<div class="print" style="border:1px solid #000;">
			<div class="table-responsive">
				<?php
				$this->db->select("(total_average) as total");
				$cavgg = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=> $class_id ,'session_year'=>$sessoin_id))->result_array();
				
					$summ = $ad = 0; 
					foreach ($cavgg as $avgg) {
						$ad++;
						$summ += $avgg['total_average'];
					}
					
					?>
				<table class="table-bordered" style="width: 80%; margin:auto; margin-bottom: 10px;">
					<tbody>
						<tr>
							<td colspan="1" rowspan="4"><img src="uploads/logo.png" style="max-height:100%; display: block; margin:auto; padding:auto"></td>
							<td colspan="17" style="text-align: center;font-size: 45px;font-family: 'canterburyregular';"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 20px;padding-bottom: 8px;">69A Road, Gwarinpa, Abuja</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 20px;"><strong>PROGRESS REPORT</strong></td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 15px;"><?php  $exam_name = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; echo $exam_name.' , '.$sessoin_id.' SESSION';?></td>
						</tr>
					</tbody>
				</table>
			
				<table class="table" style="width: 80%; margin:auto; margin-bottom:10px;">
					<tbody>
						<tr>
							<td colspan="2"><strong>Name</strong></td>
							<td colspan="4"><?php echo $row['surname'].' '.$row['name'];?></td>
							<td colspan="2"><strong>Admission No</strong></td>
							<td colspan="2"><?php echo $roll;?></td>
							<td colspan="2"><strong>Class</strong></td>
							<td colspan="2"><?php $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name2;echo $class_name;?></td>
							<td colspan="2"><strong>DOB</strong></td>
							<td colspan="3"><?php $dob = $this->db->get_where('student' , array('student_id' => $student_id))->row()->birthday;echo $dob;?></td>
						</tr>
						<tr>
							<td colspan="2"><strong>Sex</strong></td>
							<td colspan="2"><?php echo $sex;?></td>
							<td colspan="2"><strong>Total Scores</strong></td>
							<td colspan="2"><?php $total_markss = $this->db->get_where('average',array('exam_id' => $exam_id,'student_id' => $student_id ,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->total_score; echo $total_markss;?></td>
							<td colspan="2"><strong>Student average Score</strong></td>
							<td colspan="2"><?php $student_average = $this->db->get_where('average',array('exam_id' => $exam_id,'student_id' => $student_id ,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->total_average; echo $student_average;?></td>
							<td colspan="2"><strong>Class Average Score</strong></td>
							<td colspan="2"><?php $class_average = $this->db->get_where('average',array('exam_id' => $exam_id,'student_id' => $student_id ,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->class_average; echo $class_average;?></td>
							<td colspan="2"><strong>Grade</strong></td>
							<td colspan="2"><?php echo grade_sys($student_average);?></td>
						</tr>
						<tr>
							<td colspan="3"><strong>Attendance</strong></td>
							<td colspan="3"><?php $attendence = $this->db->get_where('comments',array('exam_id' => $exam_id,'student_id' => $student_id ,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->Attendance; echo $attendence//echo $present . '/' . $total;?></td>
							<td colspan="3"><strong>Next Term Begins</strong></td>
							<td colspan="3"><?php $resumption_date = $this->db->get_where('mark_pri',array('exam_id' => $exam_id,'class_id'=>$class_id ,'student_id' => $student_id ,'session_year'=>$sessoin_id))->row() ->resumption_date; echo $resumption_date;?></td>
							<td colspan="3"><strong>Date of Vacation</strong></td>
							<td colspan="4"><?php $vacation_date = $this->db->get_where('mark_pri',array('exam_id' => $exam_id,'class_id'=>$class_id ,'student_id' => $student_id ,'session_year'=>$sessoin_id))->row() ->vacation_date; echo $vacation_date;?></td>
						</tr>
					</tbody>
				</table>
			</div>

				<br/>

			<div class="row">
				<div class="col-md-12">
					<!-- Term 1 & 2 -->
					<?php if($exam_id < 3 && $class_id < 40){ ?>
					<div class="table-responsive">
					<div style="width: 98.8%;display: inline-block;vertical-align: top; margin-left: 10px;">
						<table class="table" style="width: 98%;float:left; margin-left: 10px;">
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
								<tr >
									<td></td>
									<td colspan="12">SUBJECTS</td>
									<td colspan="3" class="space" style="text-align: center;">CA 1<br>20</td>
									<td colspan="3" class="space" style="text-align: center;">CW<br>10</td>
									<td colspan="3" class="space" style="text-align: center;">CA 2<br>20</td>
									<td colspan="5" class="space" style="text-align: center;">PROJECT<br>10</td>
									<td colspan="5" class="space" style="text-align: center;">TOTAL CA<br>60</td>
									<td colspan="4" class="space" style="text-align: center;">EXAM<br>40</td>
									<td colspan="3" class="space" style="text-align: center;">TOTAL<br>SCORE</td>
									<td colspan="3" class="space" style="text-align: center;">AVERAGE</td>
									<td colspan="3" class="space" style="text-align: center;">GRADE</td>
									<td colspan="3" class="space" style="text-align: center;">REMARKS</td>
								</tr>

							<?php 
							 
							$total_markss = 0;
							$query = $this->db->get_where('mark_pri' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();
							$a = 0;
							foreach($marks as $row2):
								if ($row2['mark_total'] != 0){
								$a++;
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								
								$this->db->select("(ca_marks+mark_obtained) as total");
								$total_marks = $this->db->get_where('mark_pri',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								$i=$b=0;
								$total= 0;
		 
								$this->db->select("student_id");
								$tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
								$stno = count($tstu);

								$this->db->select("total_average as val");
								$total_average = $this->db->get_where('average',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
								foreach($total_average as $avgg){
									$cav +=$avgg['val'];
								}
		 
								foreach($total_marks as $marks_cal){
									if ($marks_cal['total'] != 0){
										$i++;
										$total +=$marks_cal['total'];
									}
								}
								$subavg =  $total/ $i;
									
								$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
								
								$grade = grade_sys($total_sub_marks);
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
												<td><?php echo '*'; ?></td>
												<td colspan="12"><?php echo  $this->crud_model->get_subject_name_by_ids('strand',$rows['strand_id']);?></td>
												<td class="space" colspan="3"><?php echo $rows['ca_1'];?></td>
												<td class="space" colspan="3"><?php echo $rows['cw'];?></td>
												<td class="space" colspan="3"><?php echo $rows['ca_2'];?></td>
												<td class="space" colspan="5"><?php echo $rows['project_score'];?> </td>
												<td class="space" colspan="5"><?php echo $rows['ca_marks'];?></td>
												<td class="space" colspan="4"><?php echo $rows['mark_obtained'];?></td>
												<td class="space" colspan="3"></td>
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
								<?php }
								endforeach;
								?>

							</tbody>
						</table>
					<?php  }?>
					</div>
					</div>
					

					<!-- Term 3 -->
					<?php if($exam_id == 3 && $class_id < 40){ ?>
					<div style="width: 98.8%;display: inline-block;vertical-align: top; margin-left: 10px;">
					<div class="table-responsive">
						<table class="table" style="width: 99%;float:left; margin-left: 10px;">
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
									<td colspan="3" class="space" style="text-align: center;">TOTAL<br>SCORE</td>
									<td colspan="3" class="space" style="text-align: center;">AVERAGE</td>
									<td colspan="3" class="space" style="text-align: center;">GRADE</td>
									<td colspan="3" class="space" style="text-align: center;">REMARKS</td>
									<td colspan="3" class="space" style="text-align: center;">CUM</td>
									<td colspan="3" class="space" style="text-align: center;">FINAL<br>GRADE</td>
								</tr>

							<?php
							$query = $this->db->get_where('mark_pri' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();

							foreach($marks as $row2):
								if ($row2['mark_total'] != 0){
     							$a++;
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								
								$this->db->select("(ca_marks+mark_obtained) as total");
								$total_marks = $this->db->get_where('mark_pri',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
								
								$this->db->select("student_id");
								$tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
								$stno = count($tstu);

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
												<td><?php echo '*'; ?></td>
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
												<td class="space" colspan="3"></td>
												<td class="space" colspan="3"><?php ?></td>
												<td class="space" colspan="3"><?php ?></td>
												<td class="space" colspan="3"><?php ?></td>
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
									<td class="space" colspan="3"><?php echo round($subavg,2);?></td>
									<td class="space" colspan="3"><?php echo $grade;?></td>
									<td class="space" colspan="3"><?php echo grade_remark($row2['mark_total']);?></td>
									<td class="space" colspan="3"><?php echo $val;?></td>
									<td class="space" colspan="3"><?php echo $final_grade;?></td>
								</tr>

								<?php }
									endforeach;
								?>
							</tbody>
						</table>
					<?php  }?>
					</div>
				</div>
				</div>
			</div> <!-- border container -->

			<br />
			<p style = "page-break-before:always">
			<br />
			<br />
			<br />

<!-- individual Assessment primary-->
			<div class="print" style="width:80%; margin:auto; border:1px solid #000;">
				<div class="table-responsive">
					<table  style="width: 20%;float:left;margin-right: 10px;">
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

					<table style="width:50%; vertical-align: top; float:right; margin-right:10px; margin-top:10px;" class="tg">
						</tbody>
							<tr>
								<td colspan="11" style="text-align: center;">GRADE KEY:</td>
							</tr>
							<tr>
								<td colspan="6">A = EXCELLENT</td>
								<td colspan="5">90-100%</td>
							</tr>
							<tr>
								<td colspan="6">B = VERY GOOD</td>
								<td colspan="5">70-89%</td>
							</tr>
							<tr>
								<td colspan="6">C+ = GOOD</td>
								<td colspan="5">60-69%</td>
							</tr>
							<tr>
								<td colspan="6">C = AVERAGE</td>
								<td colspan="5">50-59%</td>
							</tr>
							<tr>
								<td colspan="6">D = FAIR</td>
								<td colspan="5">40-49%</td>
							</tr>
								<td colspan="6">F = POOR</td>
								<td colspan="5">0-39%</td>
							</tr>
						</tbody>
					</table>

					<br />

				<!-- Commemt area -->
					<table style="width:50%; vertical-align: top; float:right; margin-right:10px; margin-top:10px;" class="tg">
						<?php //if ($exam_name == 'TERM 3'){$exam_id++;} //step in for Term 3
							$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
							$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();
							$head_sign = $this->db->get_where('head', array('section'=>'Primary'))->result_array();

							$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
											'student_id' => $student_id, 'session_year' => $sessoin_id);
							$query_comments = $this->db->get_where('comments' , $verify_data);
							$student_comments = $query_comments->result_array();
							foreach($student_comments as $row):
						?>

						<tr>
							<td colspan="6">TEACHER'S COMMENT:</td>
							<td colspan="8"><?php echo $row['TeacherComment'];?></td>
						</tr>
						<tr>
							<td colspan="6">NAME:</td>
							<td colspan="8"><?php echo ' ',$row['TeacherName'];?></td>
						</tr>
						<tr>
							<td colspan="6">SIGNATURE:</td>
							<td colspan="8"><img style="display: block; margin:auto; width:100px;" src="uploads/signature/<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg';?>" style="width:25%; height:25%; display: block; margin:auto; padding:auto"></td>
						</tr>
						<tr>
							<td colspan="6"></td>
						</tr>
						<tr>
							<td colspan="6">HEAD TEACHER'S COMMENT:</td>
							<td colspan="8"><?php echo ' ',$row['HeadTeacherComment'];?><br></td>
						</tr>
						<tr>
							<td colspan="6">NAME:</td>
							<td colspan="8"><?php echo ' ',$row['HeadTeacherName'];?></td>
						</tr>
						<tr>
							<td colspan="6" style="width:25%">SIGNATURE:</td>
							<td colspan="8"><img style="display: block; margin:auto; width:100px;" src="uploads/signature/<?php echo $head_sign[0]['head_id'] . '.' . 'jpg';?>" style="width:25%; height:25%; display: block; margin:auto; padding:auto"></td>
						</tr>

						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>	
<!-- end for Primary -->

<!-- Nursery -->

<?php } else if (strpos($class_type, 'nursery') !== false || strpos($class_type, 'nur') !== false || strpos($class_type, 'toddler') !== false){ ?>
		<style>
			table, tr, td, th { border: 1px solid #ccccbe;border-collapse: collapse;font-family: sans-serif;font-size: 15px;}
			th { padding: 10px;}td span {font-size: 15px; margin-left: 2px;}th {height: 200px; }
			.text-transform span {float: left;width: 100%;margin: 0 0 0 -93px;}
			.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); transform: rotate(270deg); width: 10px; max-width: 10px;}
		</style>
		<?php 
			$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id, 
								'student_id' => $student_id, 'session_year' => $sessoin_id);
				$query_comments = $this->db->get_where('comments' , $verify_data);
				$student_comments = $query_comments->result_array();
		?>
		<div class="print" style="border:2px solid #000;">
			<div class="table-responsive">
				<table class="table-bordered" style="width: 70%; margin:auto; margin-bottom: 10px;">
					<tbody>
						<tr>
							<td colspan="1" rowspan="4"><img style="display: block; margin:auto;" src="uploads/logo.png" style="max-height:100%; display: block; margin:auto; padding:auto"></td>
							<td colspan="17" style="text-align: center;font-size: 45px;font-family: 'canterburyregular';"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 20px;padding-bottom: 8px;">69A Road, Gwarinpa, Abuja</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">PROGRESS REPORT</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 15px;"><?php  $exam_name = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; echo $exam_name.' , '.$sessoin_id.' SESSION';?></td>
						</tr>
					</tbody>
				</table>
			
				<table class="table" style="width: 70%; margin:auto; margin-bottom:10px;">
					<tbody>
						<tr>
							<td><strong>Name</strong></td>
							<td><?php echo $row['surname'].' '.$row['name'];?></td>
							<td><strong>Class</strong></td>
							<td><?php $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;echo $class_name;?></td>
							<td><strong>Sex</strong></td>
							<td><?php echo $sex;?></td>
						</tr>
						<tr>
							<td><strong>Admission No</strong></td>
							<td><?php echo $roll;?></td>
							<td><strong>DOB</strong></td>
							<td><?php $dob = $this->db->get_where('student' , array('student_id' => $student_id))->row()->birthday;echo $dob;?></td>
							<td><strong>Attendance</strong></td>
							<td><?php echo $student_comments[0]['Attendance']; //$present . '/' . $total;?></td>
						</tr>
						<tr>
							<td><strong>Next Term Begins</strong></td>
							<td><?php $resumption_date = $this->db->get_where('nursery_student_marks',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->resumption_date; echo $resumption_date;?></td>
							<td><strong>Date of Vacation</strong></td>
							<td colspan="6"><?php $vacation_date = $this->db->get_where('nursery_student_marks',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->vacation_date; echo $vacation_date;?></td>
						</tr>
					</tbody>
				</table>
			</div>
		
		
	<div style="width: 98.8%;display: inline-block;vertical-align: top; margin-left: 10px;">
		<div >
		<table style="width: 99%;float:center; margin: auto;">
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
					<th class="text-transform"><span><strong>Meeting_Expectation</strong></span></th>
					<th class="text-transform"><span><strong>Emerging_Expectation</strong></span></th>
					<th class="text-transform"><span><strong>Not_Assessed</strong></span></th>
					<th colspan="12"><strong>SUBJECTS</strong></span></th>
					<th class="text-transform"><span><strong>Exceeding</strong></span></th>
					<th class="text-transform"><span><strong>Meeting_Expectation</strong></span></th>
					<th class="text-transform"><span><strong>Emerging_Expectation</strong></span></th>
					<th class="text-transform"><span><strong>Not_Assessed</strong></span></th>
					<th colspan="12"><span><strong>SUBJECTS</strong></span></th>
					<th class="text-transform"><span><strong>Exceeding</strong></span></th>
					<th class="text-transform"><span><strong>Meeting_Expectation</strong></span></th>
					<th class="text-transform"><span><strong>Emerging_Expectation</strong></span></th>
					<th class="text-transform"><span><strong>Not_Assessed</span></th>
				</tr>
				<tr>
					<td colspan="16"><span><strong>LANGUAGE ART</strong></span></td>
					<td colspan="16"><span><strong>SOCIAL-EMOTIONAL DEVELOPMENT</strong></span></td>
					<td colspan="16"><span><strong>KNOWLEDGE AND UNDERSTANDING OF THE WORLD</strong></span></td>
				</tr>
			<?php // NURSERY 1
				if (strpos($class_type, 'nursery 1') !== false ) { ?>
				<?php 
				if($sessoin_id  = '2019-2020'){
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
			<?php // NURSERY 2
				}if (strpos($class_type, 'nursery 2') !== false ) { ?>
				<?php 
				if($sessoin_id  = '2019-2020'){  
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
				
			<?php // NURSERY 3
				}if (strpos($class_type, 'nursery 3') !== false ) { ?>
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

			<?php // TODDLER
				}if (strpos($class_type, 'toddler') !== false ) { ?>
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
		</div>
	</div>
	
		<br/>
		<br/>

		<!--COMMENT AREA-->

		<table class="print" style="width: 98%; margin:auto;font-size: 20px;">
			<?php
			$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
			$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();
			$head_sign = $this->db->get_where('head', array('section'=>'Primary'))->result_array();

			foreach($student_comments as $row):
			?>
			
				<tr>
					<th colspan="6" style="height:10px;">Teacher's Name: <?php echo ' ',$row['TeacherName'];?></th>
					<th colspan="6" style="height:10px;">Head Teacher's Name: <?php echo ' ', $row['HeadTeacherName'];?></th>
				</tr>
				<tr>
					<th colspan="2" style="height:10px;  width: 10%;">Teacher's Comment</th>
					<th colspan="2" style="height:100px;  width: 10%;">signature:</th>
					<th colspan="2" style="height:100px;  width: 15%;"><img style="display: block; margin:auto; width:100px;" src="uploads/signature/<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg';?>" style="width:50%; height:100%; display: block; margin:auto; padding:auto"></th>
					<th colspan="2" style="height:10px;  width: 10%;">Head Teacher's Comment</th>
					<th colspan="2" style="height:100px;  width: 10%;">signature:</th>
					<th colspan="2" style="height:100px;  width: 15%;"><img style="display: block; margin:auto; width:100px;" src="uploads/signature/<?php echo $head_sign[0]['head_id'] . '.' . 'jpg';?>" style="width:50%; height:100%; display: block; margin:auto; padding:auto"></th>
				</tr>
				<tr>
					<td colspan="6" style="height:10px; width: 50%; font-size: 15px;"><?php echo $row['TeacherComment'];?></td>
					<td colspan="6" style="height:10px; width: 50%; font-size: 15px;"><?php echo $row['HeadTeacherComment'];?></td>
				</tr>
				<?php endforeach; ?>
		</table>
		
		<?php } ?>
		
<?php  endforeach;?>
</div>


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
</body>
<script type="text/javascript" src="js/html2canvas.min.js"></script>
<script type="text/javascript" src="js/jspdf.min.js"></script>
<script type="text/javascript">/*
    var pages = $('.print');
    var doc = new jsPDF();
    var j = 0;
    for (var i = 0 ; i < pages.length; i++) {
        html2canvas(pages[i]).then(function(canvas) {
        var img=canvas.toDataURL("image/png");
        // debugger;
		
		var height =  canvas.height / 250 * 37;
        doc.addImage(img,'JPEG',5,5,200,height);
        if (j < (pages.length - 1) ) doc.addPage();
        if (j == (pages.length - 1) ) {doc.save('Report.pdf');}
        j++;
		});
		console.log(height)
	}*/

</script>
</html>