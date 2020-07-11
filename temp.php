<?php 
$this->load->library('Pdf');
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetTitle('Print|Student Report Card');
    $pdf->SetHeaderMargin(10);
	$pdf->SetTopMargin(10);
	$pdf->SetLeftMargin(5);
	$pdf->SetRightMargin(5);
    $pdf->setFooterMargin(20);
    $pdf->SetAutoPageBreak(true);
    $pdf->SetAuthor('Author');
    $pdf->SetDisplayMode('real', 'default');

	$pdf->AddPage();
	
	$html = 
	'</head>
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
	</style> ';
	
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

	$html .= '
		<!-- CODE added on 04 june 2018 sandeep-->';
		if ($class_id > 19 && $class_id < 40){
			$html .= '<div class="print" style="border:1px solid #000; margin-top: 30px;">
				<div class="table-responsive" style="padding: 2px;">
					<table class="table-bordered" style="width: 80%; margin:auto; margin-bottom: 10px;">
						<tbody>
							<tr>
								<td colspan="1" rowspan="4"><img src="uploads/logo.png" style="max-height:100%; display: block; margin:auto; padding:auto"></td>
								<td colspan="17" style="text-align: center;font-size: 45px;font-family: canterburyregular;">'; echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description; $html .= '</td>
							</tr>
							<tr>
								<td colspan="17" style="text-align: center;font-size: 20px;padding-bottom: 8px;">(SECONDARY SECTION)</td>
							</tr>';
							 if ($class_id > 19 && $class_id < 35){
								$html .= '<tr>
								<td colspan="17" style="text-align: center;font-size: 17px;">END OF TERM REPORT</td>
							</tr>';
							} if ($class_id > 34 && $class_id <40){ 
								$html .= '<tr>
								<td colspan="17" style="text-align: center;font-size: 17px;">PRE-MOCK REPORT</td>
							</tr>';
							 }
							 $html .= '<tr>
								<td colspan="17" style="text-align: center;font-size: 15px;">'; $exam_name = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; echo $exam_name.' , '.$sessoin_id.' SESSION'; $html .= '</td>
							</tr>
						</tbody>
					</table>

					<table class="table" style="width: 80%; margin:auto; margin-bottom:10px;">
					<tbody>
						<tr>
							<td><strong>Name</strong></td>
							<td><strong>'; echo $row['surname'].' '.$row['name']; $html .= '<table class="table" style="width: 80%; margin:auto; margin-bottom:10px;">
					<tbody>
						<tr>
							<td><strong>Name</strong></td>
							<td><strong>'; echo $row['surname'].' '.$row['name']; $html .= '</strong></td>
							<td><strong>Class</strong></td>
							<td colspan="6">'; $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;echo $class_name; $html .= '</td>
						</tr>
						<tr>
							<td><strong>Admission No</strong></td>
							<td>'; echo $roll; $html .= '</td>
							<td><strong>Sex</strong></td>
							<td>'; echo $sex; $html .= '</td>';

							 //if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { 
								$html .= '<td><strong>Attendance</strong></td>
							<td>'; $attendence = $this->db->get_where('comments',array('exam_id' => $exam_id,'student_id' => $student_id ,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->Attendances; echo $attendence; $html .= '</td>';
							 //}
							 $html .= '</tr>';
						if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) { 
							$html .= '<tr>
							<td><strong>Next Term Begins</strong></td>
							<td>'; $resumption_date = $this->db->get_where('mark',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->resumption_date; echo $resumption_date; $html .= '</td>
							<td><strong>Date of Vacation</strong></td>
							<td colspan="6">'; $vacation_date = $this->db->get_where('mark',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->row() ->vacation_date; echo $vacation_date; $html .= '</td>
						</tr>';
						} 
						$html .= '</tbody>
				</table>';

	$html .= '<!--Senior Secondary-->';
		} $class_type = strtolower($this->crud_model->get_class_name($class_id)); 
			$jss = "no";
			if(strpos($class_type, 'jss') !== false ){
				$jss = "yes";
			}

			if (strpos($class_type, 'ss') !== false && $jss !='yes'){
		

	$html .= '<div style="width: 98.8%;display: inline-block;vertical-align: top; margin-left: 10px;">';
		//if ($exam_id = 4){ $exam_id--;} 
		$html .= '<div class="table-responsive">

				<!-- For SS 1 & 2 -->';
				if (strpos($class_type, 'ss 1') !== false || strpos($class_type, 'ss 2') !== false) {

				$html .= '<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
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
							<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'; $html .= " 'S REMARKS</th>";
							$html .= '<th class="tg-yw4l" rowspan="2">TEACHER</th>
						</tr>
						<tr>
							<td class="tg-yw4l">ATTITUDE <br /> TO WORK <br /> AND TASK</td>
							<td class="tg-yw4l">ATTENTIVENESS <br />IN CLASS</td>
							<td class="tg-yw4l">RESPONSE TO <br /> ASSIGNMENTS <br /> AND PROJECTS</td>
							<td class="tg-yw4l">INTEREST <br /> IN SUBJECT</td>
							<td class="tg-yw4l">WILLINGNESS <br /> TO WORK <br /> WITH OTHERS</td>
						</tr>
	                    </thead>';
					
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
							
								
								$html .= '<tr>
									<td>'; echo $subjects[0]['name']; $html .= '</td>
									<td class="tg-yw4l">'; echo $row2['ca_marks']; $html .= '</td>
									<td class="tg-yw4l">'; echo $row2['mark_obtained']; $html .= '</td>
									<td class="tg-yw4l">'; echo ($row2['ca_marks']+$row2['mark_obtained']); $html .= '</td>
									<td class="tg-yw4l">'; echo $average[0]['subject_average']; $html .= '</td>
									<td class="tg-yw4l">'; echo $grade; $html .= '</td>
									<td class="tg-yw4l">'; $arr_max = max($total_marks); echo $arr_max['total']; $html .= '</td>
									<td class="tg-yw4l">'; echo $row2['effort_marks']; $html .= '</td>
									<td class="tg-yw4l">'; echo $row2['attitude_marks']; $html .= '</td>
									<td class="tg-yw4l">'; echo $row2['attentiveness_mark']; $html .= '</td>
									<td class="tg-yw4l">'; echo $row2['assignment_marks']; $html .= '</td>
									<td class="tg-yw4l">'; echo $row2['interest_marks']; $html .= '</td>
									<td class="tg-yw4l">'; echo $row2['willingness_marks']; $html .= '</td>
									<td class="tg-yw4l">'; echo $row2['teacher']; $html .= '</td>
								</tr>';
								
									 } endforeach;
								$html .= '<tr>
									<td colspan="3" style="text-align: center">Total Marks</td>
									<td style="text-align: center">'; echo $value[0]['total_score']; $html .= '</td>
									<td colspan="2" style="text-align: center">Student Average</td>
									<td style="text-align: center">'; echo $value[0]['total_average']; $html .= '</td>
									<td colspan="2" style="text-align: center">Class Average</td>
									<td style="text-align: center">'; echo $value[0]['class_average']; $html .= '</td>
									<td colspan="1" style="text-align: center">Position</td>
									<td style="text-align: center">'; echo $value[0]['position']; $html .= '</td>
								</tr>
							</tbody>
						</table>
				<!-- For SS3 -->';
				} if (strpos($class_type, 'ss 3') !== false) { 
				
				$html .= '<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
					<thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">PRE-MOCK <br />[100]</th>
							<th class="tg-yw4l" rowspan="2">GRADES</th>
							<th class="tg-yw4l" rowspan="2">CLASS <br /> MAXIMUM</th>
							<th class="tg-yw4l" rowspan="2">EFFORT</th>
							<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'; $html .= " 'S"; $html .= ' REMARKS</th>
							<th class="tg-yw4l" rowspan="2">TEACHER</th>
						</tr>
						<tr>
							<td class="tg-yw4l">ATTITUDE <br /> TO WORK <br /> AND TASK</td>
							<td class="tg-yw4l">ATTENTIVENESS <br />IN CLASS</td>
							<td class="tg-yw4l">RESPONSE TO <br /> ASSIGNMENTS <br /> AND PROJECTS</td>
							<td class="tg-yw4l">INTEREST <br /> IN SUBJECT</td>
							<td class="tg-yw4l">WILLINGNESS <br /> TO WORK <br /> WITH OTHERS</td>
						</tr>
	                    </thead>';
						
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
						
								
							$html .= '<tr>
								<td>'; echo $subjects[0]['name']; $html .= '</td>
								<td class="tg-yw4l">'; echo $row2['mark_obtained']; $html .= '</td>
								<td class="tg-yw4l">'; echo $grade; $html .= '</td>
								<td class="tg-yw4l">'; $arr_max = max($class_max); echo $arr_max['total']; $html .= '</td>
								<td class="tg-yw4l">'; echo $row2['effort_marks']; $html .= '</td>
								<td class="tg-yw4l">'; echo $row2['attitude_marks']; $html .= '</td>
								<td class="tg-yw4l">'; echo $row2['attentiveness_mark']; $html .= '</td>
								<td class="tg-yw4l">'; echo $row2['assignment_marks']; $html .= '</td>
								<td class="tg-yw4l">'; echo $row2['interest_marks']; $html .= '</td>
								<td class="tg-yw4l">'; echo $row2['willingness_marks']; $html .= '</td>
								<td class="tg-yw4l">'; echo $row2['teacher']; $html .= '</td>
							</tr>';
								
						 } endforeach;

						 $html .= '<tr>
									<td colspan="3" style="text-align: center">Total Marks</td>
									<td style="text-align: center">'; echo $value[0]['total_score']; $html .= '</td>
									<td colspan="2" style="text-align: center">Student Average</td>
									<td style="text-align: center">'; echo $value[0]['total_average']; $html .= '</td>
									<td colspan="2" style="text-align: center">Class Average</td>
									<td style="text-align: center">'; echo $value[0]['class_average'];$html .= '</td>
									<!--<td colspan="1" style="text-align: center">Position</td>
									<td style="text-align: center">'; /*echo $value[0]['position']*/; $html .= '</td>-->
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
								
					<table style="width:70%; vertical-align: top; margin:10px;" class="tg">';
						 

							$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
											'student_id' => $student_id , 'session_year' => $sessoin_id);
							$query_comments = $this->db->get_where('comments' , $verify_data);

							$student_comments = $query_comments->result_array();
							foreach($student_comments as $row):
						

						$html .= '<tr>
							<td colspan="3" class="tg-yw4l">TEACHER'; $html .= " 'S NAME:</td>";
							$html .= '<td colspan="4" width="30%">'; echo ' ',$row['TeacherNames']; $html .= '</td>
							<td colspan="3" class="tg-yw4l">VICE PRINCIPAL'; $html .= "'S NAME:</td>";
							$html .= '<td colspan="4" width="30%">'; echo ' ',$row['VPName']; $html .= '</td>
						</tr>
							
						<tr>
							<td colspan="3" class="tg-yw4l">SIGNATURE:</td>
							<td colspan="4"></td>
							<td colspan="3" class="tg-yw4l">SIGNATURE:</td>
							<td colspan="4"></td>
						</tr>';

						 endforeach; 
					$html .= '</table>
				</div>';
				 } 
					$html .= '</div>
				</div>
			</div>

			<br />';
							
			if ($class_id > 28 && $class_id < 35) { 
				$html .= '<p style = "page-break-before:always">
			
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
					<table style="width:auto; vertical-align: bottom;float:left; margin-left:10px;" class="tg">';
					

						$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
										'student_id' => $student_id , 'session_year' => $sessoin_id);
						$query_remark = $this->db->get_where('Remark' , $verify_data);

						$student_remark = $query_remark->result_array();
						foreach($student_remark as $row):	

					
						$html .= '<thead>
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
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R1"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Works independently.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R2"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Reasons logically.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R3"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Makes intelligent contributions in the class.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R4"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Is attentive and follows directions.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R5"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Checks and correct assignments.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R6"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Completes homework promptly.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R7"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Honest at work and play.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R8"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;"colspan = "5">Neat in school work.</td>
								<td style=" font-size:15px;"class="tg-yw4l">'; echo $row["R9"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Neat in personal appearance.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R10"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Enjoys the company of classmates.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R11"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;"colspan = "5">Participates in school activites.</td>
								<td style=" font-size:15px;"class="tg-yw4l">'; echo $row["R12"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;"colspan = "5">Keeps school rules and regulations.</td>
								<td style=" font-size:15px;"class="tg-yw4l">';echo $row["R13"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Respects school authority and staff.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R14"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Handles own and school property with care.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R15"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Punctual at school.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R16"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Sense of leadership.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R17"]; $html .= '</td>
							</tr>
							<tr>
								<td style=" font-size:15px;" colspan = "5">Musical/Creative Skills.</td>
								<td style=" font-size:15px;" class="tg-yw4l">'; echo $row["R18"]; $html .= '</td>
							</tr>
						</tbody>';
						endforeach;
					$html .= '</table>

					<br />

					<!-- Commemt area -->
					<table style="width:50%; vertical-align: top; float:right; margin-right:10px;" class="tg">';
						

							$verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
											'student_id' => $student_id , 'session_year' => $sessoin_id);
							$query_comments = $this->db->get_where('comments' , $verify_data);

							$student_comments = $query_comments->result_array();
							foreach($student_comments as $row):
						

						$html .= '<tr>
							<td colspan="6" class="tg-yw4l">TEACHER'; $html .= "'S COMMENT:</td>";
							$html .= '<td colspan="8" class="tg-yw4l">'; echo $row['TeacherComments']; $html .= '</td>
						</tr>
						<tr>
							<td colspan="6" class="tg-yw4l">NAME:</td>
							<td colspan="8">'; echo ' ',$row['TeacherNames']; $html .= '</td>
						</tr>
							
						<tr>
							<td colspan="6" class="tg-yw4l">SIGNATURE:</td>
							<td colspan="8"></td>
						</tr>
						<tr>
							<td colspan="6"></td>
						</tr>
						<tr>
							<td colspan="6" class="tg-yw4l">VICE PRINCIPAL'; $html .= " 'S COMMENT:</td>";
							$html .= '<td colspan="8" class="tg-yw4l">'; echo ' ',$row['VPComment']; $html .= '<br></td>
						</tr>
						<tr>
							<td colspan="6" class="tg-yw4l">NAME:</td>
							<td colspan="8">'; echo ' ',$row['VPName']; $html .= '</td>
						</tr>
						<tr>
							<td colspan="6" style="width:25%" class="tg-yw4l">SIGNATURE:</td>
							<td colspan="8"></td>
						</tr>';

						 endforeach; 

					$html .= '</table>

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
			</div>';
			 }
		
					 
				 
				  }
				 
		  endforeach;
		  $html .= '</div>';
		 
		 
		
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
		 
		$html .= ' </body>';
		 ?>
		 <script type="text/javascript" src="js/html2canvas.min.js"></script>
		 <script type="text/javascript" src="js/jspdf.min.js"></script>
		 <script type="text/javascript">
			 var pages = $('.print');
			 var doc = new jsPDF();
			 var j = 0;
			 for (var i = 0 ; i < pages.length; i++) {
				 html2canvas(pages[i]).then(function(canvas) {
				 var img=canvas.toDataURL("image/png");
				 // debugger;
				 
				 var height =  canvas.height / 2000 * 300;
				 doc.addImage(img,'JPEG',5,5,200,height);
				 if (j < (pages.length - 1) ) doc.addPage();
				 if (j == (pages.length - 1) ) {doc.save('Report.pdf');}
				 j++;
				 });
				 console.log(height)
			 }
		 
		 </script>
		 
		
<?php 
		$html .= '$</html>';
	$pdf->Writehtml($html, true, false, true, false, '');


    $pdf->Output('My-File-Name.pdf', 'I');