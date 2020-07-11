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
	.tg th{font-family: Arial, sans-serif;font-size: 12px;padding: 8px;border-style: solid;border-width: 1px;overflow: hidden;word-break: normal;border-color: #ddd;color: #000;}
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
		$total = $a+$d+$e;
?>

		  
<!-- CODE added on 04 june 2018 sandeep-->
	<?php if ($class_id > 39 && $class_id <52){?>
		<div class="print" style="border:1px solid #000;">
			<div class="table-responsive">
				<table class="table-bordered" style="width: 70%; margin:auto; margin-bottom: 10px;">
					<tbody>
						<tr>
							<td colspan="1" rowspan="4"><img src="uploads/logo.png" style="max-height:100%; display: block; margin:auto; padding:auto"></td>
							<td colspan="17" style="text-align: center;font-size: 45px;font-family: 'canterburyregular';"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 20px;padding-bottom: 8px;">(SECONDARY SECTION)</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">MID TERM REPORT</td>
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
							<td><?php echo $row['name'].' '.$row['surname'];?></td>
							<td><strong>Class</strong></td>
							<td colspan="6"><?php $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;echo $class_name;?></td>
						</tr>
						<tr>
							<td><strong>Admission No</strong></td>
							<td><?php echo $roll;?></td>
							<td><strong>Gender</strong></td>
							<td><?php echo $sex;?></td>
							<td><strong>Date</strong></td>
							<td><?php echo $present . '/' . $total;?></td>
						</tr>
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
			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
				<thead>
					<tr>
						<th class="tg-yw4l" rowspan="2">SUBJECT</th>
						<th class="tg-yw4l" rowspan="2">C.A [40]</th>
						<th class="tg-yw4l" rowspan="2">TEST [20]</th>
						<th class="tg-yw4l" rowspan="2">TOTAL [60]</th>
						<th class="tg-yw4l" rowspan="2">GRADES</th>
						<th class="tg-yw4l" rowspan="2">CLASS MAXIMUM</th>
						<th class="tg-yw4l" rowspan="2">EFFORT</th>
						<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'S REMARKS</th>
						<th class="tg-yw4l" rowspan="2">TEACHER</th>
					</tr>
					<tr>
						<td class="tg-yw4l">ATTITUDE TO <br /> WORK AND TASK</td>
						<td class="tg-yw4l">ATTENTIVENESS IN CLASS</td>
						<td class="tg-yw4l">RESPONSE TO <br />ASSIGNMENTS <br /> AND PROJECTS</td>
						<td class="tg-yw4l">INTEREST IN SUBJECT</td>
						<td class="tg-yw4l">WILLINGNESS TO <br /> WORK WITH OTHERS</td>
					</tr>
                    </thead>
				<?php 
							$query = $this->db->get_where('mark0' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();
							$total_markss=$total_sub_marks1_all=$total_sub_marks2_all0;
							foreach($marks as $row2):
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
								
								$this->db->select("(ca_marks+mark_obtained) as total");
								$total_marks = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
					
								$this->db->select("student_id");
								$tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
								$stno = count($tstu);

								foreach($total_marks as $marks_cal){
									$total +=$marks_cal['total'];
									$i++;
									//echo $i;
								}
								$subavg =  $total/ $stno;
								
								
								$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
								$grade = grade_sys($total_sub_marks);
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
						
							<?php
							endforeach;
							
							?>
							<tr>
								<td colspan="2" style="text-align: center">Student's Average</td>
								<td style="text-align: center"><?php $student_average = $this->db->get_where('average0',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->total_average; echo $student_average;?></td>
							</tr>
							
						</tbody>
					</table>
				</div>
				<br>
				<br>
				<br>
				<br>
				<br>
			<table style="width:100%; font-size:14px;">
				<tr>
					<td colspan="6" style="text-align:center;">CLASS TEACHER</td>
					<td colspan="6" style="text-align:center;">PRINCIPAL</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:right">KEYS TO GRADES:</td>
					<td colspan="8"><strong>A</strong> = Excellent <strong>B</strong> = Very Good <strong>C</strong> = Credit <strong>D</strong> = Pass <strong>E</strong> = Poor </td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:right">KEYS:</td>
					<td colspan="8"><strong>Assignment</strong> = 10% <strong>Project</strong> = 10% <strong>Class Exercise</strong> = 10% <strong>Affective Domain</strong> = 5% <strong>Notes</strong> = 5% </td>
				</tr>
			</table>
			</div>
		</div>

		<br />


<!--Junior Secondary-->
	<?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){?>
		<div style="width: 98.8%;display: inline-block;vertical-align: top; margin-left: 10px;">
			<?php //if ($exam_id = 4){ $exam_id--;} ?>
				<div class="table-responsive">
					<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
						<thead>
							<tr>
								<th class="tg-yw4l" rowspan="2">SUBJECT</th>
								<th class="tg-yw4l" rowspan="2">C.A [40]</th>
								<th class="tg-yw4l" rowspan="2">TEST [20]</th>
								<th class="tg-yw4l" rowspan="2">TOTAL [60]</th>
								<th class="tg-yw4l" rowspan="2">GRADES</th>
								<th class="tg-yw4l" rowspan="2">CLASS MAXIMUM</th>
								<th class="tg-yw4l" rowspan="2">EFFORT</th>
								<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'S REMARKS</th>
								<th class="tg-yw4l" rowspan="2">TEACHER</th>
							</tr>
							<tr>
								<td class="tg-yw4l">ATTITUDE TO <br /> WORK AND TASK</td>
								<td class="tg-yw4l">ATTENTIVENESS <br /> IN CLASS</td>
								<td class="tg-yw4l">RESPONSE <br /> TO ASSIGNMENTS <br /> AND PROJECTS</td>
								<td class="tg-yw4l">INTEREST IN SUBJECT</td>
								<td class="tg-yw4l">WILLINGNESS <br /> TO WORK WITH  <br />OTHERS</td>
							</tr>
						
						</thead>
						<tbody>
				
						<?php 
							$query = $this->db->get_where('mark0' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();
							$total_markss=$total_sub_marks1_all=$total_sub_marks2_all0;
							foreach($marks as $row2):
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
								
								$this->db->select("(ca_marks+mark_obtained) as total");
								$total_marks = $this->db->get_where('mark0',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
					
								$this->db->select("student_id");
								$tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array();
								$stno = count($tstu);

								foreach($total_marks as $marks_cal){
									$total +=$marks_cal['total'];
									$i++;
									//echo $i;
								}
								$subavg =  $total/ $stno;
								
								
								$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
								$grade = grade_sys($total_sub_marks);
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
						
							<?php
							endforeach;
							
							?>
							<tr>
								<td colspan="2" style="text-align: center">Student's Average</td>
								<td style="text-align: center"><?php $student_average = $this->db->get_where('average0',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->total_average; echo $student_average;?></td>
							</tr>
							
						</tbody>
					</table>
				</div>
				<br>
				<br>
				<br>
				<br>
				<br>
			<table style="width:100%; font-size:14px;">
				<tr>
					<td colspan="6" style="text-align:center;">CLASS TEACHER</td>
					<td colspan="6" style="text-align:center;">PRINCIPAL</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:right">KEYS TO GRADES:</td>
					<td colspan="8"><strong>A</strong> = Excellent <strong>B</strong> = Very Good <strong>C</strong> = Credit <strong>D</strong> = Pass <strong>E</strong> = Poor </td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:right">KEYS:</td>
					<td colspan="8"><strong>Assignment</strong> = 10% <strong>Project</strong> = 10% <strong>Class Exercise</strong> = 10% <strong>Affective Domain</strong> = 5% <strong>Notes</strong> = 5% </td>
				</tr>
			</table>
			</div>
		</div>

		<br />

		

<!--Primary Print View Edited 27/05/2019-->
<?php }else if (strpos($class_type, 'primary') !== false){ 
	if($exam_id >= 4) {$exam_id = 3;}?>
		<div class="print" style="border:1px solid #000;">
			<div class="table-responsive">
				<table class="table-bordered" style="width: 80%; margin:auto; margin-bottom: 10px;">
					<tbody>
						<tr>
							<td colspan="1" rowspan="4"><img src="uploads/logo.png" style="max-height:100%; display: block; margin:auto; padding:auto"></td>
							<td colspan="17" style="text-align: center;font-size: 45px;font-family: 'canterburyregular';"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 20px;padding-bottom: 8px;">69a Road, Gwarinpa, Abuja</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">MID TERM PROGRESS REPORT</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 15px;"><?php  $exam_name = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; echo $exam_name.' , '.$sessoin_id.' SESSION';?></td>
						</tr>
					</tbody>
				</table>
				<?php $tstu = $this->db->get_where('student',array('class_id'=>$class_id))->result_array()?>
				<table class="table" style="width: 80%; margin:auto; margin-bottom:10px;">
					<tbody>
						<tr>
							<td colspan="2"><strong>Name</strong></td>
							<td colspan="4"><?php echo $row['name'].' '.$row['surname'];?></td>
							<td colspan="2"><strong>Admission No</strong></td>
							<td colspan="2"><?php echo $roll;?></td>
							<td colspan="4"><strong>Class</strong></td>
							<td colspan="2"><?php $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name2;echo $class_name;?></td>
							<td colspan="2"><strong>No in Class</strong></td>
							<td colspan="4"><?php echo count($tstu)?></td>
						</tr>
						<tr>
							<td colspan="2"><strong>Total Scores</strong></td>
							<td colspan="4"><?php $total_markss = $this->db->get_where('average0',array('exam_id' => $exam_id,'class_id'=>$class_id ,'student_id' => $student_id,'session_year'=>$sessoin_id))->row() ->total_score; echo $total_markss;?></td>
							<td colspan="2"><strong>Student average Score</strong></td>
							<td colspan="4"><?php $student_average = $this->db->get_where('average0',array('exam_id' => $exam_id,'student_id' => $student_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->total_average; echo $student_average;?></td>
							<td colspan="2"><strong>Attendance</strong></td>
							<td colspan="6"><?php echo $present . '/' . $total;?></td>
						</tr>
				</table>
			</div>

				<br/>

			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
					<div style="width: 98.8%;display: inline-block;vertical-align: top; margin-left: 10px;">
						<table class="table" style="width: 98%;float:left; margin-left: 10px;">
							<tbody>
								<tr>
									<td colspan="13"></td>
									<td colspan="41" style="text-align: center;"><?php echo $exam_name ?></td>	
								</tr>
								
								<tr >
									<td></td>
									<td colspan="12" class="tg-yw4l">SUBJECTS</td>
									<td colspan="3" class="space" style="text-align: center;">MARKS<br>OBTAINABLE</td>
									<td colspan="3" class="space" style="text-align: center;">CA 1<br>[20]</td>
									<td colspan="3" class="space" style="text-align: center;">CA 2<br>C.W [10]</td>
									<td colspan="5" class="space" style="text-align: center;">TOTAL CA<br>[30]</td>
									<td colspan="3" class="space" style="text-align: center;">REMARKS</td>
								</tr>

							<?php 
							 
							$query = $this->db->get_where('mark0' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();
							 
							foreach($marks as $row2):
								$a++;
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								
								?>
								
									<tr>
										<td><?php echo $a; ?></td>
										<td colspan="12"><?php echo $subjects[0]['name'];?></td>
										<td class="space" colspan="3">30</td>
										<td class="space" colspan="3"><?php echo $row2['ca_1'];?></td>
										<td class="space" colspan="3"><?php echo $row2['ca_2'];?></td>
										<td class="space" colspan="5"><?php echo $row2['ca_marks'];?></td>
										<td class="space" colspan="3"><?php echo $row2['remark'];?></td>
									</tr>
								<?php 
								endforeach;
								?>

							</tbody>
						</table>
					<?php  ?>
					</div>
					</div>
				</div>
				<br />
				<br />

				<table style="width: 80%; margin:auto; margin-bottom: 10px; font-size: 14px;">
				<?php
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id);
					$query_comments = $this->db->get_where('comments0' , $verify_data);
					$student_comments = $query_comments->result_array();
					foreach($student_comments as $row):
				?>
				<tr>
					<td>TEACHER:</td>
					<td><?php echo ' ',$row['TeacherName'];?></td>
				</tr>
				<tr>
					<td>SIGNATURE:</td>
					<td></td>
				</tr>
				<tr>
					<td>KEYS:</td>
					<td><strong>A</strong> = Excellent <strong>B</strong> = Very Good <strong>C</strong> = Average <strong>D</strong> = Fair <strong>E</strong> = Poor </td>
				</tr>
				<?php endforeach; ?>
			</table>
			</div> <!-- border container -->


<!-- Nursery -->

<?php } else if (strpos($class_type, 'nursery') !== false || strpos($class_type, 'nur') !== false || strpos($class_type, 'toddler') !== false){ ?>
		<div class="print" style="border:1px solid #000;">
			<div class="table-responsive">
				<table class="tg" style="width: 70%; margin:auto; margin-bottom: 10px;">
					<tbody>
						<tr>
							<td colspan="1" rowspan="4"><img src="uploads/logo.png" style="max-height:100%; display: block; margin:auto; padding:auto"></td>
							<td colspan="17" style="text-align: center;font-size: 45px;font-family: 'canterburyregular';"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 20px;padding-bottom: 8px;">69a Road, Gwarinpa, Abuja</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">MID TERN PROGRESS REPORT</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 15px;"><?php  $exam_name = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; echo $exam_name.' , '.$sessoin_id.' SESSION';?></td>
						</tr>
					</tbody>
				</table>

			
				<table class="tg" style="width: 70%; margin:auto; margin-bottom:10px;">
					<tbody>
						<tr>
							<td><strong>Name</strong></td>
							<td><?php echo $row['name'].' '.$row['surname'];?></td>
							<td><strong>Class</strong></td>
							<td colspan="6"><?php $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;echo $class_name;?></td>
						</tr>
						<tr>
							<td><strong>Admission No</strong></td>
							<td><?php echo $roll;?></td>
							<td><strong>Gender</strong></td>
							<td><?php echo $sex;?></td>
							<td><strong>Attendance</strong></td>
							<td><?php echo $present . '/' . $total;?></td>
						</tr>
						<tr>
							<td><strong>Next Term Begins</strong></td>
							<td><?php $resumption_date = $this->db->get_where('mark',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->resumption_date; echo $resumption_date;?></td>
							<td><strong>Date of Vacation</strong></td>
							<td colspan="6"><?php $vacation_date = $this->db->get_where('mark',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->vacation_date; echo $vacation_date;?></td>
						</tr>
					</tbody>
				</table>
				<br />

		<table cellpadding="0" cellspacing="0" class="tg" style="width:70%; margin:auto;">
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$sessoin_id);
				$query_mark0 = $this->db->get_where('mark0' , $verify_data);
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
					<td colspan="12"><span>PHSE</span></td>
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
			</tbody>
		</table>
		
		<br/>

		<!--COMMENT AREA-->

		<table class="tg" style="width: 70%; margin:auto; margin-bottom: 10px; font-size: 14px;">
				<?php
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id);
					$query_comments = $this->db->get_where('comments0' , $verify_data);
					$student_comments = $query_comments->result_array();
					foreach($student_comments as $row):
				?>
				<tr>
					<td>TEACHER:<?php echo ' ',$row['TeacherName'];?></td>
				</tr>
				<tr>
					<td>SIGNATURE:</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php ;?>
			</div>
		<style>
			table, tr, td, th {    border: 1px solid #808080;border-collapse: collapse;font-family: sans-serif;font-size: 14px;}
			th { padding: 10px; margin-left: 100px;}td span {font-size: 13px; margin-left: 3px;}th {height: 130px;}
			.text-transform span {float: left;width: 100%;margin: 0 0 0 -22px;}
			.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); transform: rotate(270deg); width: 60px; max-width: 60px;}
			td.inner {padding: 0;}
			td.inner table {width: 100%;}
			td.inner table, td.inner tr {border: 0;}
			
		</style>
		
		<?php } ?>
		
<?php  endforeach;?>
</div>


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
?>
</body>
<script type="text/javascript" src="js/html2canvas.min.js"></script>
<script type="text/javascript" src="js/jspdf.min.js"></script>
<script type="text/javascript">
  /*  var pages = $('.print');
    var doc = new jsPDF();
    var j = 0;
    for (var i = 0 ; i < pages.length; i++) {
        html2canvas(pages[i]).then(function(canvas) {
        var img=canvas.toDataURL("image/png");
        // debugger;
        var height =  canvas.height / 440 * 80;
        doc.addImage(img,'JPEG',10,0,190,height);
        if (j < (pages.length - 1) ) doc.addPage();
        if (j == (pages.length - 1) ) {doc.save('Report.pdf');}
        j++;
        });
    }*/
    
</script>
</html>