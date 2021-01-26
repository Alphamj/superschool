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
<!--<link rel="stylesheet" media="print" href="assets/css/print.css" type="text/css">-->
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
		$total = $a+$b+$d+$e;
?>
		  
<!-- CODE added on 04 june 2018 sandeep-->
	<?php if ($class_id > 19 && $class_id < 40){?>
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
						<?php if ($class_id > 19 && $class_id < 35){ ?>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">MID TERM REPORT</td>
						</tr>
						<?php } if ($class_id > 34 && $class_id <40){ ?>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">MOCK REPORT</td>
						</tr>
						<?php } ?>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 15px;"><?php  $exam_name = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; echo $exam_name.' , '.$sessoin_id.' SESSION';?></td>
						</tr>
					</tbody>
				</table>
			
				<table class="table" style="width: 70%; margin:auto; margin-bottom:10px;">
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
							<!--
							<?php //if ($class_id > 19 && $class_id < 35 ) { ?> 
							<td><strong>Attendance</strong></td>
							<td><?php //$attendence = $this->db->get_where('comments0',array('exam_id' => $exam_id,'student_id' => $student_id ,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->Attendances; echo $attendence //echo $present . '/' . $total;?></td>
							<?php //} ?> -->
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
			<!-- For SS 1 & 2 -->
			<?php if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?> 
			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
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
							$total_markss=$total_sub_marks1_all=$total_sub_marks2_all0 = 0;
							$d = 0;
							foreach($marks as $row2):
								if ($row2['mark_total'] != 0){
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
								if ($class_id > 28 && $class_id < 32 ){
									$verify_datas = array('exam_id' => $exam_id,'class_id' => 111, 
									'student_id' => $row2['student_id'],'session_year'=>$sessoin_id);
								 }
								if ($class_id > 31 && $class_id < 35 ){
									$verify_datas = array('exam_id' => $exam_id ,'class_id' => 112 , 
									'student_id' => $row2['student_id'],'session_year'=>$sessoin_id);
								 }

								$value	=	$this->db->get_where('average0' , $verify_datas)->result_array();

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

								$grade = grade_syssss($row2['mark_total']);
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
						
							<?php } endforeach; ?>
							<tr>
								<td colspan="3" style="text-align: center">Total Marks</td>
								<td style="text-align: center"><?php echo $value[0]['total_score'];?></td>
								<td colspan="2" style="text-align: center">Student Average</td>
								<td style="text-align: center"><?php echo $value[0]['total_average'];?></td>
							</tr>
							
						</tbody>
					</table>
					<!-- For SS3 -->
			<?php } if (strpos($class_type, 'ss 3') !== false) { ?> 
			
			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
				<thead>
					<tr>
						<th class="tg-yw4l" rowspan="2">SUBJECT</th>
						<th class="tg-yw4l" rowspan="2">MOCK <br />[100]</th>
						<th class="tg-yw4l" rowspan="2">GRADES</th>
						<th class="tg-yw4l" rowspan="2">CLASS <br /> MAXIMUM</th>
						<th class="tg-yw4l" rowspan="2">EFFORT</th>
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
						$query = $this->db->get_where('mark0' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
						$marks	=	$query->result_array();
						
						foreach($marks as $row2):
							if ($row2['mark_obtained'] != 0){
							$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
							$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
							
							$verify_datas = array('exam_id' => $exam_id ,'class_id' => 113 , 
								'student_id' => $row2['student_id'],'session_year'=>$sessoin_id);
							$value	=	$this->db->get_where('average0' , $verify_datas)->result_array();

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
						
					<?php } endforeach; ?>

							<tr>
								<td colspan="3" style="text-align: center">Total Marks</td>
								<td style="text-align: center"><?php echo $value[0]['total_score'];?></td>
								<td colspan="2" style="text-align: center">Student Average</td>
								<td style="text-align: center"><?php echo $value[0]['total_average'];?></td>
								<td colspan="2" style="text-align: center">Class Average</td>
								<td style="text-align: center"><?php echo $value[0]['class_average'];?></td>
								<!-- <td colspan="1" style="text-align: center">Position</td>
								<td style="text-align: center"><?php //echo $value[0]['position'];?></td> -->
							</tr>
						</tbody>
					</table>
					<br />
					<hr>
					<br />
			
			<div class="table-responsive">
				<table style="width:98%; margin:10px;" class="tg">
					
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
				
				<!--COMMENT AREA-->
					<?php 
						$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
										'student_id' => $student_id , 'session_year' => $sessoin_id);
						$query_comments = $this->db->get_where('comments0' , $verify_data);	
						$row = $query_comments->result_array();
					?>
				<table style="width:98%; margin:10px;" class="tg">

					<tr>
						<td colspan="6" style="width:50%;" class="tg" ><strong>TEACHER'S NAME: <?php echo ' ',$row[0]['TeacherNames'];?></strong></td>
						<td colspan="6" style="width:50%;" class="tg" ><strong>VICE PRINCIPAL'S NAME:<?php echo ' ',$row[0]['VPName'];?></strong></td>
					</tr>
					
					<tr>
						<th colspan="3" style="height:10px;  width: 25%;">TEACHER'S COMMENT</th>
						<th colspan="3" style="height:60px;  width: 25%;">SIGNATURE: <img src="uploads/signature/<?php echo $row[0]['teach_sign'];?>" style="width:30%; height:70%; display: block; margin:auto; padding:auto"></th>
						<th colspan="3" style="height:10px;  width: 25%;">VICE PRINCIPAL'S COMMENT</th>
						<th colspan="3" style="height:60px;  width: 25%;">SIGNATURE: <img src="uploads/signature/<?php echo $row[0]['head_sign'];?>" style="width:30%; height:70%; display: block; margin:auto; padding:auto"></th>
					</tr>
					<tr>
						<td colspan="6" style="height:10px; width: 50%; font-size: 15px;"><?php echo $row[0]['TeacherComments'];?></td>
						<td colspan="6" style="height:10px; width: 50%; font-size: 15px;"><?php echo $row[0]['VPComment'];?></td>
					</tr>
				</table>
			</div>
			<?php } if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { ?>
			
				</div>
				<br>
				<br>
				
			<table style="width:100%; font-size:14px;">
				<tr>
					<td colspan="6" style="text-align:left;">CLASS TEACHER <img src="uploads/signature/<?php echo $row[0]['teach_sign'];?>" style="width:15%; height:15%; display: block; margin:auto; padding:auto"></td>
					<td colspan="6" style="text-align:left;">PRINCIPAL <img src="uploads/signature/<?php echo $row[0]['head_sign'];?>" style="width:15%; height:15%; display: block; margin:auto; padding:auto"></td>
				</tr>
				<tr>
					<td colspan="2">KEYS TO GRADES:</td>
					<td colspan="2"><strong>A</strong> = Excellent </td>
					<td colspan="2"><strong>B</strong> = Very Good </td>
					<td colspan="2"><strong>C</strong> = Credit </td>
					<td colspan="2"><strong>D</strong> = Pass </td>
					<td colspan="2"><strong>E</strong> = Poor </td>
				</tr>
				<tr>
					<td colspan="2">KEYS:</td>
					<td colspan="2"><strong>Assignment</strong> = 10% </td>
					<td colspan="2"><strong>Project</strong> = 10% </td>
					<td colspan="2"><strong>Class Exercise</strong> = 10% </td>
					<td colspan="2"><strong>Affective Domain</strong> = 5% </td>
					<td colspan="2"><strong>Notes</strong> = 5% </td>
				</tr>
			</table>
			</div>
		</div>

		<br />
		<?php } ?>

<!--Junior Secondary-->
	<?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){?>
		<div style="width: 98.8%;display: inline-block;vertical-align: top; margin-left: 10px;">
			<?php //if ($exam_id = 4){ $exam_id--;} ?>
				<div class="table-responsive">
					<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
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
								if ($row2['mark_total'] != 0){
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
								if ($class_id > 19 && $class_id < 23 ){
									$verify_datas = array('exam_id' => $exam_id,'class_id' => 101, 
									'student_id' => $row2['student_id'],'session_year'=>$sessoin_id);
								 }
								 elseif ($class_id > 22 && $class_id < 26 ){
									$verify_datas = array('exam_id' => $exam_id ,'class_id' => 102 , 
									'student_id' => $row2['student_id'],'session_year'=>$sessoin_id);
								 }
								 elseif ($class_id > 25 && $class_id < 29 ){
									$verify_datas = array('exam_id' => $exam_id ,'class_id' => 103 , 
									'student_id' => $row2['student_id'],'session_year'=>$sessoin_id);
								 }
								$value	=	$this->db->get_where('average0' , $verify_datas)->result_array();

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

								$grade = grade_sysjss($row2['mark_total']);
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
						
								<?php }
							endforeach;
							
							?>
							<tr>
								<td colspan="3" style="text-align: center">Total Marks</td>
								<td style="text-align: center"><?php echo $value[0]['total_score'];?></td>
								<td colspan="2" style="text-align: center">Student Average</td>
								<td style="text-align: center"><?php echo $value[0]['total_average'];?></td>
							</tr>
							
						</tbody>
					</table>
				</div>
				<br>
				<br>
				
			<table style="width:100%; font-size:14px;">
				<?php 
										//Comment Area
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id, 'session_year' => $sessoin_id);
					$query_comments = $this->db->get_where('comments0' , $verify_data);
					$sign = $query_comments->result_array();
				?>
				<tr>
					<td colspan="6" style="text-align:left;">CLASS TEACHER: <img src="uploads/signature/<?php echo $sign[0]['teach_sign'];?>" style="width:10%; height:10%; display: block; margin:auto; padding:auto"></td>
					<td colspan="6" style="text-align:left;">PRINCIPAL: <img src="uploads/signature/<?php echo $sign[0]['head_sign'];?>" style="width:10%; height:10%; display: block; margin:auto; padding:auto"></td>
				</tr>
				<tr>
					<td colspan="2">KEYS TO GRADES:</td>
					<td colspan="2"><strong>A</strong> = Excellent </td>
					<td colspan="2"><strong>B</strong> = Very Good </td>
					<td colspan="2"><strong>C</strong> = Credit </td>
					<td colspan="2"><strong>D</strong> = Pass </td>
					<td colspan="2"><strong>E</strong> = Poor </td>
				</tr>
				<tr>
					<td colspan="2">KEYS:</td>
					<td colspan="2"><strong>Assignment</strong> = 10% </td>
					<td colspan="2"><strong>Project</strong> = 10% </td>
					<td colspan="2"><strong>Class Exercise</strong> = 10% </td>
					<td colspan="2"><strong>Affective Domain</strong> = 5% </td>
					<td colspan="2"><strong>Notes</strong> = 5% </td>
				</tr>
			</table>
			</div>
		</div>

		<br />

		

<!--Primary Print View Edited 27/05/2019-->
<?php }else if (strpos($class_type, 'primary') !== false){ 
	if($exam_id >= 4) {$exam_id = 3;}?>
		<div class="print" style="border:3px solid #000;">
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
							<td colspan="6"><?php $attendence = $this->db->get_where('comments0',array('exam_id' => $exam_id,'student_id' => $student_id ,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->Attendances; echo $attendence //$present . '/' . $total;?></td>
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
							 
							$query = $this->db->get_where('mark0_pri' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
							$marks	=	$query->result_array();
							$a = 0;
							 
							foreach($marks as $row2):
								if ($row2['ca_marks'] != 0){
								$a++;
								$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
								
								?>

								<?php if ($a == 2){
									$strand = $this->db->get('strand')->result_array();
									$c = 0;
									foreach($strand as $rowz):
										$strands = $this->db->get_where('strands0', array('exam_id' => $exam_id ,
																	'class_id' => $class_id ,
																	'strand_id' => $rowz['strand_id'] , 
																	'student_id' => $student_id,
																	'session_year'=> $sessoin_id))->result_array();
										foreach($strands as $rows):
											$c++;
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
												<td class="space" colspan="3"></td>
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
										<td class="space" colspan="3"><?php echo grade_remark($row2['ca_marks']);?></td>
									</tr>
								<?php }

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
									'student_id' => $student_id, 'session_year' => $sessoin_id);
					$query_comments = $this->db->get_where('comments0' , $verify_data);
					$student_comments = $query_comments->result_array();
					foreach($student_comments as $row):
				?>
				<tr>
					<td colspan="2">TEACHER:</td>
					<td colspan="8"><?php echo ' ',$row['TeacherName'];?></td>
				</tr>
				<tr>
					<td colspan="2">SIGNATURE:</td>
					<td colspan="8"><img src="uploads/signature/<?php echo $row['teach_sign'];?>" style="width:10%; height:10%; display: block; margin:auto; padding:auto"></td>
				</tr>
				<tr>
					<td colspan="2">KEYS:</td>
					<td colspan="1"><strong>A</strong> = Excellent (90-100%)</td>
					<td colspan="1"><strong>B</strong> = Very Good (70-89%)</td>
					<td colspan="1"><strong>C+</strong> = Good (60-69%)</td>
					<td colspan="1"><strong>C</strong> = Average (50-59%)</td>
					<td colspan="1"><strong>D</strong> = Fair (40-49%)</td>
					<td colspan="1"><strong>E</strong> = Poor (0-39%)</td>
				</tr>
				<?php endforeach; ?>
			</table>
			</div> <!-- border container -->


<!-- Nursery -->
	<?php } else if (strpos($class_type, 'nursery 3') !== false){ ?>
		<div class="print" style="border:1px solid #000;">
			<div class="table-responsive">
				<table class="tg" style="width: 70%; margin:auto; margin-bottom: 10px;">
					<tbody>
						<tr>
							<td colspan="1" rowspan="4"><img src="uploads/logo.png" style="max-height:100%; display: block; margin:auto; padding:auto"></td>
							<td colspan="17" style="text-align: center;font-size: 45px;font-family: 'canterburyregular';"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 20px;padding-bottom: 8px;">69A Road, Gwarinpa, Abuja</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">MID TERM PROGRESS REPORT</td>
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
							<td><strong>Sex</strong></td>
							<td><?php echo $sex;?></td>
						</tr>
					</tbody>
				</table>
				<br />

		<table cellpadding="0" cellspacing="0" class="tg" style="width:70%; margin:auto;">
			<?php 
				$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
								'student_id' => $student_id,'session_year'=>$sessoin_id);
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
		
		<br/>

		<!--COMMENT AREA-->

		<table class="tg" style="width: 70%; margin:auto; margin-bottom: 10px; font-size: 14px;">
				<?php
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id,'session_year'=>$sessoin_id);
					$query_comments = $this->db->get_where('comments0' , $verify_data);
					$student_comments = $query_comments->result_array();
					foreach($student_comments as $row):
				?>
				<tr>
					<td>TEACHER:<?php echo ' ',$row['TeacherName'];?></td>
				</tr>
				<tr>
					<td>SIGNATURE: <img src="uploads/signature/<?php echo $row['teach_sign'];?>" style="width:10%; height:10%; display: block; margin:auto; padding:auto"></td>
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

		<?php } else if (strpos($class_type, 'nursery 2') !== false){ ?>
			<div class="print" style="border:1px solid #000;">
			<div class="table-responsive">
				<table class="tg" style="width: 70%; margin:auto; margin-bottom: 10px;">
					<tbody>
						<tr>
							<td colspan="1" rowspan="4"><img src="uploads/logo.png" style="max-height:100%; display: block; margin:auto; padding:auto"></td>
							<td colspan="17" style="text-align: center;font-size: 45px;font-family: 'canterburyregular';"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 20px;padding-bottom: 8px;">69A Road, Gwarinpa, Abuja</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">MID TERM PROGRESS REPORT</td>
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
							<td><strong>Sex</strong></td>
							<td><?php echo $sex;?></td>
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
		
		<br/>

		<!--COMMENT AREA-->

		<table class="tg" style="width: 70%; margin:auto; margin-bottom: 10px; font-size: 14px;">
				<?php
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id,'session_year'=>$sessoin_id);
					$query_comments = $this->db->get_where('comments0' , $verify_data);
					$student_comments = $query_comments->result_array();
					foreach($student_comments as $row):
				?>
				<tr>
					<td>TEACHER:<?php echo ' ',$row['TeacherName'];?></td>
				</tr>
				<tr>
					<td>SIGNATURE <img src="uploads/signature/<?php echo $row['teach_sign'];?>" style="width:10%; height:10%; display: block; margin:auto; padding:auto">:</td>
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

	<?php } else if (strpos($class_type, 'nursery 1') !== false){ ?>
		<div class="print" style="border:1px solid #000;">
			<div class="table-responsive">
				<table class="tg" style="width: 70%; margin:auto; margin-bottom: 10px;">
					<tbody>
						<tr>
							<td colspan="1" rowspan="4"><img src="uploads/logo.png" style="max-height:100%; display: block; margin:auto; padding:auto"></td>
							<td colspan="17" style="text-align: center;font-size: 45px;font-family: 'canterburyregular';"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 20px;padding-bottom: 8px;">69A Road, Gwarinpa, Abuja</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">MID TERM PROGRESS REPORT</td>
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
							<td><strong>Sex</strong></td>
							<td><?php echo $sex;?></td>
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
		
		<br/>

		<!--COMMENT AREA-->

		<table class="tg" style="width: 70%; margin:auto; margin-bottom: 10px; font-size: 14px;">
				<?php
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id,'session_year'=>$sessoin_id);
					$query_comments = $this->db->get_where('comments0' , $verify_data);
					$student_comments = $query_comments->result_array();
					foreach($student_comments as $row):
				?>
				<tr>
					<td>TEACHER:<?php echo ' ',$row['TeacherName'];?></td>
				</tr>
				<tr>
					<td>SIGNATURE: <img src="uploads/signature/<?php echo $row['teach_sign'];?>" style="width:10%; height:10%; display: block; margin:auto; padding:auto"></td>
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

	<?php } else if (strpos($class_type, 'toddler') !== false){ ?>
		<div class="print" style="border:1px solid #000;">
			<div class="table-responsive">
				<table class="tg" style="width: 70%; margin:auto; margin-bottom: 10px;">
					<tbody>
						<tr>
							<td colspan="1" rowspan="4"><img src="uploads/logo.png" style="max-height:100%; display: block; margin:auto; padding:auto"></td>
							<td colspan="17" style="text-align: center;font-size: 45px;font-family: 'canterburyregular';"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 20px;padding-bottom: 8px;">69A Road, Gwarinpa, Abuja</td>
						</tr>
						<tr>
							<td colspan="17" style="text-align: center;font-size: 17px;">MID TERM PROGRESS REPORT</td>
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
							<td><strong>Sex</strong></td>
							<td><?php echo $sex;?></td>
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
		
		<br/>

		<!--COMMENT AREA-->

		<table class="tg" style="width: 70%; margin:auto; margin-bottom: 10px; font-size: 14px;">
				<?php
					$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
									'student_id' => $student_id,'session_year'=>$sessoin_id);
					$query_comments = $this->db->get_where('comments0' , $verify_data);
					$student_comments = $query_comments->result_array();
					foreach($student_comments as $row):
				?>
				<tr>
					<td>TEACHER:<?php echo ' ',$row['TeacherName'];?></td>
				</tr>
				<tr>
					<td>SIGNATURE: <img src="uploads/signature/<?php echo $row['teach_sign'];?>" style="width:10%; height:10%; display: block; margin:auto; padding:auto"></td>
				</tr>
				<?php endforeach; ?>
			</table>
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