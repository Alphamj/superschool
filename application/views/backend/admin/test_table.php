<!DOCTYPE html>
<html>
<head>
	<title>Print|Student Report Card</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div class="container">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/css/font-icons/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/report-card.css">
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
	.print {padding: 10px;}
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
        ?>

	<hr>

    <div class="print" style="border:1px solid #000;">
        <br/>
        <br/>
        <br/>
        <br/>
        <div class="row">
		
            <div class="col-md-2 logo" style="text-align: right;">
                <img src="uploads/logo.png" style="max-height:100px;margin-left: 100px;">
            </div>
            <div class="col-md-8" style="text-align: center;">
                <div class="tile-stats tile-white tile-white-primary">
                    <span style="text-align: center;font-size: 32px;font-family: 'canterburyregular';"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></span>
                    <br/>
                    <span style="text-align: center;font-size: 20px;"><?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?></span>
                    <br/>
                    <span style="text-align: center;font-size: 26px;">End of Term Report</span><br>
                    <span style="text-align: center;font-size:16px"><?php  $exam_name = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; echo $exam_name.' , '.$sessoin_id.' SESSION';?></span>
					
                </div>
            </div>
			<div class="col-md-2 logo" style="text-align: left;">
                <img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" style="max-height:100px;margin-right: 100px;">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-2" style="text-align: left;"><h4>Name</h4></div>
            <div class="col-md-4" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php echo $row['name'].' '.$row['surname'];;?></h4></div>
            <div class="col-md-2" style="text-align: center;"><h4>Class</h4></div>
            <div class="col-md-3" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;echo $class_name;?></h4></div>
        </div>
      
        <div class="row">
            <div class="col-md-2" style="text-align: center;"><h4>Roll No</h4></div>
            <div class="col-md-4" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php echo $roll;?></h4></div>
            <div class="col-md-2" style="text-align: center;"><h4>Sex</h4></div>
            <div class="col-md-3" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php echo $sex;?></h4></div>
			
        </div>
		
		  <div class="row">
			<div class="col-md-2" style="text-align: center;"><h4>Position</h4></div>
            <div class="col-md-4" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php echo $marks_position  =   $this->crud_model->get_positions($class_id,$row['student_id'],$exam_id,$sessoin_id); ?> </h4></div>    
            
            <div class="col-md-2" style="text-align: center;"><h4>Date of vacation </h4></div>
            <div class="col-md-3" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php  $vacation_date  =   $this->crud_model->get_class_vacation_date($class_id,$exam_id,$sessoin_id);echo $vacation_date[0]['vacation_date']; ?> </h4></div>
            
            
        </div>
		  <div class="row">
			<div class="col-md-2" style="text-align: center;"><h4>Date of resumption </h4></div>
            <div class="col-md-2" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php echo $vacation_date[0]['resumption_date']; ?> </h4></div>
            
            <div class="col-md-2" style="text-align: center;"><h4>Student average</h4></div>
            <div class="col-md-1" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php echo $get_student_average  =   $this->crud_model->get_student_average($class_id,$row['student_id'],$exam_id,$sessoin_id); ?> </h4></div>
            
            <div class="col-md-2" style="text-align: center;"><h4>Class average </h4></div>
            <div class="col-md-2" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php echo $get_class_average  =   $this->crud_model->get_class_average($class_id,$exam_id,$sessoin_id); ?> </h4></div>
            
        </div>
		
        <br/>
        <br/>

        <div class="row">
            <div class="col-md-12">
				<!-- CODE added on 04 june 2018 sandeep-->
					<?php  $class_type = strtolower($this->crud_model->get_class_name($class_id)); 
					$jss = "no";
					if(strpos($class_type, 'jss') !== false ){
						$jss = "yes";
					}
					
					if (strpos($class_type, 'ss') !== false && $jss !='yes'){
					?>
             	<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;overflow: auto;display: inline-block;vertical-align: top;">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A (70%)</th>
							<th class="tg-yw4l" rowspan="2">EXAM (30%)</th>
							<th class="tg-yw4l" rowspan="2">TOTAL (100%)</th>
							<th class="tg-yw4l" rowspan="2">AVERAGE SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">GRADES</th>
							<th class="tg-yw4l" rowspan="2">MAXIMUM CLASS</th>
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
		
					
				<?php $total_markss =0;
					$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
					$marks	=	$query->result_array();
					foreach($marks as $row2):
						$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
						$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
					
						$this->db->select("(ca_marks+mark_obtained) as total");
						$total_marks = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
						$i=$total= 0;
						$average ='';
						foreach($total_marks as $marks_cal){
							$i++;
							$total +=$marks_cal['total'];
						}
						$average =  $total/ $i;
						
						$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
						$grade ='';
						if($total_sub_marks >=90){
							$grade = 'A+';
						}else if($total_sub_marks >=80 && $total_sub_marks<= 89){
							$grade = 'A';
						}else if($total_sub_marks >=70 && $total_sub_marks<= 79){
							$grade = 'B';
						}else if($total_sub_marks >=60 && $total_sub_marks<= 69){
							$grade = 'C';
						}else if($total_sub_marks >=50 && $total_sub_marks<= 59){
							$grade = 'D';
						}else if($total_sub_marks >=40 && $total_sub_marks<= 49){
							$grade = 'E';
						}
							?>
                           
							<tr>
								<td><?php echo $subjects[0]['name']; ?>	</td>
								<td class="tg-yw4l"><?php echo $row2['ca_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['mark_obtained'];?></td>
								<td class="tg-yw4l"><?php echo ($row2['ca_marks']+$row2['mark_obtained']);?></td>
								<td class="tg-yw4l"><?php echo round($average); ?></td>
								<td class="tg-yw4l"><?php echo $grade;?></td>
								<td class="tg-yw4l"><?php $arr_max = max($total_marks); echo $arr_max['total']; ?></td>
								<td class="tg-yw4l"><?php echo $row2['effort_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['attitude_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['attentiveness_mark'];?></td>
								<td class="tg-yw4l"><?php echo $row2['assignment_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['interest_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['willingness_marks'];?></td>
								
								<td class="tg-yw4l"><?php echo $teacher[0]['name']; ?></td>
                              
							 </tr>
							 

                            
                         	<?php 
                         	$tot = $row2['ca_marks']+$row2['mark_obtained'];
                         	$total_markss +=$tot;
							endforeach;
					
						 ?>
						 <tr>
						<td colspan="3">Total Marks</td>
						<td><?php echo $total_markss; ?></td>
						</tr>
						 <tr>
							 <td colspan="7" rowspan="3" class="teacher comment">TEACHER COMMENT:</td>
							 <td colspan="3">NAME:</td>
							 <td colspan="4" style="text-align: center;">GRADE KEY:</td>
						 </tr>
						 <tr>
							
							 <td colspan="3">SIGNATURE:</td>
							 <td colspan="2">A = EXCELLENT</td>
							<td colspan="2">90-100%</td>
						 </tr>
						 <tr>
							 <td colspan="3"></td>
							  <td colspan="2">B = VERY GOOD</td>
							<td colspan="2">70-89%</td>
						 </tr>
						 <tr>
							
							<td colspan="7" rowspan="2">HEAD TEACHER COMMENT:</td>
							<td colspan="3">NAME:</td>
							<td colspan="2">c+ = VERY GOOD</td>
							<td colspan="2">60-69%</td>
						 </tr>
						 <tr>
							
							
							<td colspan="3">SIGNATURE:</td>
							 <td colspan="2">C = VERY GOOD</td>
							<td colspan="2">50-59%</td>
						 </tr>
						 <tr>
							<td colspan="7">NEXT TERM BEGINS:</td>
							<td colspan="3"></td>
							<td colspan="2">D = VERY GOOD</td>
							<td colspan="2">40-49%</td>
						 </tr>
						 </tr>
						 <td colspan="10"></td>
						 <td colspan="2">F = POOR</td>
						<td colspan="2">0-39%</td>
						</tr>
                     </tbody>
                  </table>
				<?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){ ?>
					<div style="width: 71%;display: inline-block;vertical-align: top;">
						<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
                    <thead>
						<?php /*if(strtolower($exam_name) =='term 3'){ ?>
						<tr>
							<th class="tg-yw4l" rowspan="2" >SUBJECT</th>
							<th class="tg-yw4l" colspan="2">TERM 1</th>
							<th class="tg-yw4l" colspan="2">TERM 2</th>
							<th class="tg-yw4l" colspan="7">TERM 3</th>
							<th class="tg-yw4l" colspan="5"> SUBJECT TEACHER'S REMARKS</th>
							<th class="tg-yw4l" rowspan="2">TEACHER</th>
						</tr>
						<tr>
							<th class="tg-yw4l" >EXAM</th>
							<th class="tg-yw4l" >GRADE</th>
							<th class="tg-yw4l" >EXAM</th>
							<th class="tg-yw4l" >GRADE</th>
							<th class="tg-yw4l" >C.A (40%)</th>
							<th class="tg-yw4l" >EXAM (60%)</th>
							<th class="tg-yw4l" >TOTAL (100%)</th>
							<th class="tg-yw4l" >AVERAGE SUBJECT</th>
							<th class="tg-yw4l" >GRADES</th>
							<th class="tg-yw4l" >MAXIMUM CLASS</th>
							<th class="tg-yw4l" >EFFORT</th>
							<td class="tg-yw4l">ATTITUDE TO WORK AND TASK</td>
							<td class="tg-yw4l">ATTENTIVENESS IN CLASS</td>
							<td class="tg-yw4l">RESPONSE TO ASSIGNMENTS AND PROJECTS</td>
							<td class="tg-yw4l">INTEREST IN SUBJECT</td>
							<td class="tg-yw4l">WILLINGNESS TO WORK WITH OTHERS</td>
						</tr>
						<?php } else{*/ ?>
							<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A (60%)</th>
							<th class="tg-yw4l" rowspan="2">EXAM (40%)</th>
							<th class="tg-yw4l" rowspan="2">TOTAL (100%)</th>
							<th class="tg-yw4l" rowspan="2">AVERAGE SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">GRADES</th>
							<th class="tg-yw4l" rowspan="2">MAXIMUM CLASS</th>
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
						<?php //} ?>
                    </thead>
                    <tbody>
		
					
				<?php 
					$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
					$marks	=	$query->result_array();
					$total_markss=$total_sub_marks1_all=$total_sub_marks2_all0;
					foreach($marks as $row2):
						$subjects = 	$this->db->get_where('subject' , array('subject_id' =>  $row2['subject_id']))->result_array();
						$teacher = 	$this->db->get_where('teacher' , array('teacher_id' =>  $subjects[0]['teacher_id']))->result_array();
					
						$this->db->select("(ca_marks+mark_obtained) as total");
						$total_marks = $this->db->get_where('mark',array("subject_id"=>$row2['subject_id'],'exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
						$i=$total= 0;
						$average ='';
						foreach($total_marks as $marks_cal){
							$i++;
							$total +=$marks_cal['total'];
						}
						$average =  $total/ $i;
						
						$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
						$grade ='';
						if($total_sub_marks >=90){
							$grade = 'A+';
						}else if($total_sub_marks >=80 && $total_sub_marks<= 89){
							$grade = 'A';
						}else if($total_sub_marks >=70 && $total_sub_marks<= 79){
							$grade = 'B';
						}else if($total_sub_marks >=60 && $total_sub_marks<= 69){
							$grade = 'C';
						}else if($total_sub_marks >=50 && $total_sub_marks<= 59){
							$grade = 'D';
						}else if($total_sub_marks >=40 && $total_sub_marks<= 49){
							$grade = 'E';
						}
						/*if(strtolower($exam_name) =='term 3'){
							$this->db->select('(t2.ca_marks+ t2.mark_obtained) as total_term1')
								->from('mark as t2')
								->where('t2.class_id', $class_id)
								->where('t2.session_year', $sessoin_id)
								->where('t2.subject_id', $row2['subject_id'])
								->where('t2.student_id', $student_id)
								->join('exam as t1', 't1.exam_id = t2.exam_id')
								->where('t1.name', "TERM 1");
							$query = $this->db->get();
							$query_array_term1 = $query->result_array();
							
							$total_sub_marks1 = $query_array_term1[0]['total_term1'];
							$grade1 ='';
							if($total_sub_marks1 >=90){
								$grade1 = 'A+';
							}else if($total_sub_marks1 >=80 && $total_sub_marks1<= 89){
								$grade1 = 'A';
							}else if($total_sub_marks1 >=70 && $total_sub_marks1<= 79){
								$grade1 = 'B';
							}else if($total_sub_marks1 >=60 && $total_sub_marks1 <= 69){
								$grade1 = 'C';
							}else if($total_sub_marks1 >=50 && $total_sub_marks1 <= 59){
								$grade1 = 'D';
							}else if($total_sub_marks1 >=40 && $total_sub_marks1 <= 49){
								$grade1 = 'E';
							}
							$total_sub_marks1_all += $total_sub_marks1;
							//code for term 2
							$this->db->select('(t2.ca_marks+ t2.mark_obtained) as total_term1')
								->from('mark as t2')
								->where('t2.class_id', $class_id)
								->where('t2.session_year', $sessoin_id)
								->where('t2.subject_id', $row2['subject_id'])
								->where('t2.student_id', $student_id)
								->join('exam as t1', 't1.exam_id = t2.exam_id')
								->where('t1.name', "TERM 2");
							$query = $this->db->get();
							$query_array_term2 = $query->result_array();
							
							$total_sub_marks2 = $query_array_term2[0]['total_term1'];
							$grade2 ='';
							if($total_sub_marks2 >=90){
								$grade2 = 'A+';
							}else if($total_sub_marks2 >=80 && $total_sub_marks2 <= 89){
								$grade2 = 'A';
							}else if($total_sub_marks2 >=70 && $total_sub_marks2 <= 79){
								$grade2 = 'B';
							}else if($total_sub_marks2 >=60 && $total_sub_marks2 <= 69){
								$grade2 = 'C';
							}else if($total_sub_marks2 >=50 && $total_sub_marks2 <= 59){
								$grade2 = 'D';
							}else if($total_sub_marks2 >=40 && $total_sub_marks2 <= 49){
								$grade2 = 'E';
							}
							
							$total_sub_marks2_all += $total_sub_marks2;
						}*/
							?>
                           
							<tr>
								<td><?php echo $subjects[0]['name']; ?>	</td>
								<?php /*if(strtolower($exam_name) =='term 3'){ ?>
								<td class="tg-yw4l"><?php echo $total_sub_marks1; ?></td>
								<td class="tg-yw4l"><?php echo $grade1; ?></td>
								<td class="tg-yw4l"><?php echo $total_sub_marks2; ?></td>
								<td class="tg-yw4l"><?php echo $grade2; ?></td>
								<?php } */?>
								<td class="tg-yw4l"><?php echo $row2['ca_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['mark_obtained'];?></td>
								<td class="tg-yw4l"><?php echo ($row2['ca_marks']+$row2['mark_obtained']);?></td>
								<td class="tg-yw4l"><?php echo round($average); ?></td>
								<td class="tg-yw4l"><?php echo $grade;?></td>
								<td class="tg-yw4l"><?php $arr_max = max($total_marks); echo $arr_max['total']; ?></td>
								<td class="tg-yw4l"><?php echo $row2['effort_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['attitude_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['attentiveness_mark'];?></td>
								<td class="tg-yw4l"><?php echo $row2['assignment_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['interest_marks'];?></td>
								<td class="tg-yw4l"><?php echo $row2['willingness_marks'];?></td>
								
								<td class="tg-yw4l"><?php echo $teacher[0]['name']; ?></td>
                              
							 </tr>

                            
                         	<?php 
                         	$tot = $row2['ca_marks']+$row2['mark_obtained'];
                         		$total_markss +=$tot;
							endforeach;
					
						 ?>
						 <tr>
						<td >Total Marks</td>
						<!--<td colspan="2"><?php //echo $total_sub_marks1_all; ?></td>
						<td colspan="2"><?php //echo $total_sub_marks2_all; ?></td>
						<td></td>
						<td></td>-->
						<td><?php echo $total_markss; ?></td>
						</tr>
                     </tbody>
                  </table>
					</div>	
				 
				 <?php }else if (strpos($class_type, 'primary') !== false){ ?>
					<div style="width: 71%;display: inline-block;vertical-align: top;">
							<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
							<tbody>
							<?php if(strtolower($exam_name) =='term 3'){ ?>
								<tr>
								<td colspan="13"></td>
								<td colspan="2">Term 1</td>
								<td colspan="2">Term 2</td>
								<td colspan="23" style="text-align: center;">Term 3</td>
								<td colspan="4" style="text-align: center;">TOTAL</td>
								
							</tr>
							  
							<tr>
								<td></td>
								<td colspan="12">SUBJECTS</td>
								<td  class="space" style="text-align: center;">Exam</td>
								<td  class="space" style="text-align: center;">Grade</td>
								<td  class="space" style="text-align: center;">Exam</td>
								<td  class="space" style="text-align: center;">Grade</td>
								<td colspan="3" class="space" style="text-align: center;">CA 1<br>20</td>
								<td colspan="3" class="space" style="text-align: center;">CW<br>10</td>
								<td colspan="3" class="space" style="text-align: center;">CA 2<br>20</td>
								<td colspan="5" class="space" style="text-align: center;">PROJECT<br>10</td>
								<td colspan="5" class="space" style="text-align: center;">TOTAL CA<br>60</td>
								<td colspan="4" class="space" style="text-align: center;">EXAM<br>40</td>
								<td colspan="3" class="space" style="text-align: center;">SCORE</td>
								<td colspan="3" class="space" style="text-align: center;">Grade</td>
								
								
							</tr>
							<?php }else{ ?>
							<tr>
								<td colspan="13"></td>
								<td colspan="23" style="text-align: center;">SECOND TERM</td>
								<td colspan="6" style="text-align: center;">TOTAL</td>
								
							</tr>
							  
							<tr>
								<td></td>
								<td colspan="12">SUBJECTS</td>
								<td colspan="3" class="space" style="text-align: center;">CA 1<br>20</td>
								<td colspan="3" class="space" style="text-align: center;">CW<br>10</td>
								<td colspan="3" class="space" style="text-align: center;">CA 2<br>20</td>
								<td colspan="5" class="space" style="text-align: center;">PROJECT<br>10</td>
								<td colspan="5" class="space" style="text-align: center;">TOTAL CA<br>60</td>
								<td colspan="4" class="space" style="text-align: center;">EXAM<br>40</td>
								<td colspan="3" class="space" style="text-align: center;">SCORE</td>
								<td colspan="3" class="space" style="text-align: center;">Grade</td>
								
								
							</tr>
							<?php }?>
							<?php 
							   $verify_data = array('exam_id' => $exam_id ,'class_id' => $class_id , 
												'student_id' => $student_id,'session_year'=>$sessoin_id);
								$query_grade = $this->db->get_where('primary_student_grade' , $verify_data);
							
							$student_grades = $query_grade->result_array();
							  ?>
							 <?php 
							 
						$students	=	$this->crud_model->get_subjects_by_class1($class_id);
						$i=$total_sub_marks1_all=$total_sub_marks2_all=$term3_total=0;
						foreach($students as $row):
							$i++;
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row['subject_id'] , 
                                                        'student_id' => $student_id,
                                                        'session_year'=>$sessoin_id);
														
							$query = $this->db->get_where('mark' , $verify_data);							 
							$marks	=	$query->result_array();
							foreach($marks as $row2):
							
								$total_sub_marks = $row2['ca_marks']+$row2['mark_obtained'];
								$grade ='';
								if($total_sub_marks >=90){
									$grade = 'A';
								}else if($total_sub_marks >=70 && $total_sub_marks<= 89){
									$grade = 'B';
								}else if($total_sub_marks >=60 && $total_sub_marks<= 69){
									$grade = 'C+';
								}else if($total_sub_marks >=50 && $total_sub_marks<= 59){
									$grade = 'C';
								}else if($total_sub_marks >=40 && $total_sub_marks<= 49){
									$grade = 'D';
								}else if($total_sub_marks >=0 && $total_sub_marks<= 39){
									$grade = 'E';
								}
						if(strtolower($exam_name) =='term 3'){
							$this->db->select('(t2.ca_marks+ t2.mark_obtained) as total_term1')
								->from('mark as t2')
								->where('t2.class_id', $class_id)
								->where('t2.session_year', $sessoin_id)
								->where('t2.subject_id', $row['subject_id'])
								->where('t2.student_id', $student_id)
								->join('exam as t1', 't1.exam_id = t2.exam_id')
								->where('t1.name', "TERM 1");
							$query = $this->db->get();
							$query_array_term1 = $query->result_array();
							
							$total_sub_marks1 = $query_array_term1[0]['total_term1'];
							$grade1 ='';
							if($total_sub_marks1 >=90){
								$grade1 = 'A+';
							}else if($total_sub_marks1 >=80 && $total_sub_marks1<= 89){
								$grade1 = 'A';
							}else if($total_sub_marks1 >=70 && $total_sub_marks1<= 79){
								$grade1 = 'B';
							}else if($total_sub_marks1 >=60 && $total_sub_marks1 <= 69){
								$grade1 = 'C';
							}else if($total_sub_marks1 >=50 && $total_sub_marks1 <= 59){
								$grade1 = 'D';
							}else if($total_sub_marks1 >=40 && $total_sub_marks1 <= 49){
								$grade1 = 'E';
							}
							$total_sub_marks1_all += $total_sub_marks1;
							//code for term 2
							$this->db->select('(t2.ca_marks+ t2.mark_obtained) as total_term1')
								->from('mark as t2')
								->where('t2.class_id', $class_id)
								->where('t2.session_year', $sessoin_id)
								->where('t2.subject_id', $row['subject_id'])
								->where('t2.student_id', $student_id)
								->join('exam as t1', 't1.exam_id = t2.exam_id')
								->where('t1.name', "TERM 2");
							$query = $this->db->get();
							$query_array_term2 = $query->result_array();
							
							$total_sub_marks2 = $query_array_term2[0]['total_term1'];
							$grade2 ='';
							if($total_sub_marks2 >=90){
								$grade2 = 'A+';
							}else if($total_sub_marks2 >=80 && $total_sub_marks2 <= 89){
								$grade2 = 'A';
							}else if($total_sub_marks2 >=70 && $total_sub_marks2 <= 79){
								$grade2 = 'B';
							}else if($total_sub_marks2 >=60 && $total_sub_marks2 <= 69){
								$grade2 = 'C';
							}else if($total_sub_marks2 >=50 && $total_sub_marks2 <= 59){
								$grade2 = 'D';
							}else if($total_sub_marks2 >=40 && $total_sub_marks2 <= 49){
								$grade2 = 'E';
							}
							
							$total_sub_marks2_all += $total_sub_marks2;
							echo '<style>td.space {min-width: 49px;text-align: center;}</style>';
						}
							?>
                          
									<tr>
										<td><?php echo $i; ?></td>
										<td colspan="12"><?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row['subject_id']);?></td>
										<?php if(strtolower($exam_name) =='term 3'){ ?>
										<td class="space" ><?php echo $total_sub_marks1; ?></td>
										<td class="space" ><?php echo $grade1; ?></td>
										<td class="space" ><?php echo $total_sub_marks2; ?></td>
										<td class="space" ><?php echo $grade2; ?></td>
										<?php } ?>
										<td class="space" colspan="3"><?php echo $row2['ca_1'];?></td>
										<td class="space" colspan="3"><?php echo $row2['cw'];?></td>
										<td class="space" colspan="3"><?php echo $row2['ca_2'];?></td>
										<td class="space" colspan="5"><?php echo $row2['project_score'];?> </td>
										<td class="space" colspan="5"><?php echo $row2['ca_marks'];?></td>
										<td class="space" colspan="4"><?php echo $row2['mark_obtained'];?></td>
										<td class="space" colspan="3"><?php echo $row2['mark_total'];?></td>
										<td class="space" colspan="3"><?php echo $grade;?></td>
										
										</tr>
										<?php 
										$term3_total +=  $row2['mark_total']; 
							endforeach;
						 endforeach;
						 ?>
						 <?php if(strtolower($exam_name) =='term 3'){ ?>
						 <tr>
							<td colspan="13">Total</td>
							<td colspan="2"><?php echo $total_sub_marks1_all; ?></td>
							<td colspan="2"><?php echo $total_sub_marks2_all; ?></td>
							<td colspan="23"></td>
							<td colspan="4"><?php echo $term3_total; ?></td>
						 </tr>
						 <?php }else{ ?>
						 <tr>
							<td colspan="13">Total</td>
							
							<td colspan="23"></td>
							<td colspan="4"><?php echo $term3_total; ?></td>
						 </tr>
						 <?php } ?>
						 <tr>
							 <td rowspan="5"></td>
							 <td colspan="26" rowspan="3" class="teacher comment">TEACHER COMMENT:</td>
							 <td colspan="17">NAME:</td>
						 </tr>
						 <tr>
							
							 <td colspan="17">SIGNATURE:</td>
						 </tr>
						 <tr>
							 <td colspan="17"></td>
						 </tr>
						 <tr>
							
							<td colspan="26" rowspan="2">HEAD TEACHER COMMENT:</td>
							<td colspan="17">NAME:</td>
						 </tr>
						 <tr>
							
							
							<td colspan="17">SIGNATURE:</td>
						 </tr>
						 <tr>
							<td></td>
							<td colspan="26">NEXT TERM BEGINS:</td>
							<td colspan="17"></td>
						 </tr>
    
      
</tbody>
</table>
					</div>
<div style="width: 100%;display: inline-block;vertical-align: top;">
<table  style="width: 33%;float:left;">
	<tbody>
		<tr>
			<td colspan="6">BEHAVIOUR</td>
			<td>A</td>
			<td>B</td>
			<td>c</td>
			<td>D</td>
			<td>E</td>
		</tr>
		<tr>
			<td colspan="6">Puntuality</td>
			<td><span <?php if($student_grades[0]['punctuality_grade'] =='A'){ echo 'class="grade-right"';} ?>></span></td>
			<td><span <?php if($student_grades[0]['punctuality_grade'] =='B'){ echo 'class="grade-right"';} ?>></span></td>
			<td> <span <?php if($student_grades[0]['punctuality_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
			<td> <span <?php if($student_grades[0]['punctuality_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
			<td> <span <?php if($student_grades[0]['punctuality_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
								
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
			<td> <span <?php if($student_grades[0]['health_grade'] =='C'){ echo 'class="grade-right"';} ?>></span></td>
			<td><span <?php if($student_grades[0]['health_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
			<td><span <?php if($student_grades[0]['health_grade'] =='E'){ echo 'class="grade-right"';} ?>></span></td>
			
		</tr>
	</tbody>
	<table style="width: 33%;float:left;">
		<tbody>
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
			<td> <span <?php if($student_grades[0]['music_grade'] =='D'){ echo 'class="grade-right"';} ?>></span></td>
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
<table style="width: 34.2%;float:left;">
		<tbody>
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
 <td colspan="6">c+ = GOOD</td>
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
 <td colspan="6">E = POOR</td>
        <td colspan="5">0-39%</td>
</tr>
	</tbody>
</table>
</div>
			 		<?php }else if (strpos($class_type, 'nursery') !== false || strpos($class_type, 'nur') !== false || strpos($class_type, 'toddler') !== false){ ?>
			<style>table, tr, td, th {    border: 1px solid #000;border-collapse: collapse;font-family: sans-serif;font-size: 14px;}
				
				td, th { padding: 10px;}td span {font-size: 12px;}th {height: 100px;}
				.text-transform span {float: left;width: 100%;margin: 0 0 0 -22px;}
				.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); transform: rotate(270deg); width: 60px; max-width: 60px;}
			</style>

			<table>
			<tbody>
			<tr>
				<th colspan="12"><span>SUBJECTS</span></th>
				<th colspan="2" class="text-transform" style=""><span>Exceeding</span></th>
				<th colspan="2" class="text-transform" style=""><span>Meeting Exceptations</span></th>
				<th colspan="2" class="text-transform" style=""><span>Emerging Exceptations</span></th>
				<th colspan="2" class="text-transform" style=""><span>Not Assessed</span></th>
				<th colspan="12"><span>SUBJECTS</span></th>
				<th colspan="2" class="text-transform" style=""><span>Exceeding</span></th>
				<th colspan="2" class="text-transform" style=""><span>Meeting Exceptations</span></th>
				<th colspan="2" class="text-transform" style=""><span>Emerging Exceptations</span></th>
				<th colspan="2" class="text-transform" style=""><span>Not Assessed</span></th>
				<th colspan="12"><span>SUBJECTS</span></th>
				<th colspan="2" class="text-transform" style=""><span>Exceeding</span></th>
				<th colspan="2" class="text-transform" style=""><span>Meeting Exceptations</span></th>
				<th colspan="2" class="text-transform" style=""><span>Emerging Exceptations</span></th>
				<th colspan="2" class="text-transform" style=""><span>Not Assessed</span></th>
			</tr>
			
			<?php 
				$students	=	$this->crud_model->get_subjects_nursery_class1($class_id);
				$i=2; $j=0;
				foreach($students as $row):
					$i++;$j++;
					$subject_id = $row['subject_id'];
			?>
				
			<?php  if($i % 3 == 0){ ?>
					<tr>
			<?php } ?>
			<td colspan="20" class="inner">
				<table>
					<tbody>
						<tr>
							<td colspan="12"><span><?php echo $row['name'];  ?></span></td>
							<td colspan="2"></td>
							<td colspan="2"></td>
							<td colspan="2"></td>
							<td colspan="2"></td>
						</tr>
						<?php
						
						$this->db->select('mark_id')
							->from('mark')
							->where('class_id',$class_id)
							->where('exam_id',$exam_id)
							->where('student_id',$student_id)
							->where('session_year',$sessoin_id)
							->where('subject_id',$row['subject_id']);
				
						$query_marks = $this->db->get()->result_array();
						$marks_id  = $query_marks[0]['mark_id'];
					
						$questions = $this->crud_model->get_subjects_nursery_questions($subject_id,$class_id,$exam_id,$sessoin_id);
						foreach($questions as $question_id){
							
							$this->db->select('question_value')
								->from('nursery_student_marks')
								->where('marks_id',$marks_id)
								->where('question_id',$question_id['question_id']);
							
				
						$query_ans = $this->db->get()->result_array();
						$ans_result = $query_ans[0]['question_value'];
						?>
						<tr>
							<td colspan="12"><span><?php echo $question_id['question']; ?></span></td>
							<td colspan="2"><span <?php if($ans_result=='exceeding'){echo 'class="grade-right"'; }?>></span> </td>
							<td colspan="2"><span <?php if($ans_result=='meeting'){echo 'class="grade-right"'; }?> ></span></td>
							<td colspan="2"> <span <?php if($ans_result=='emerging'){echo 'class="grade-right"'; }?>></span></td>
							<td colspan="2"><span <?php if($ans_result=='not_assessed'){echo 'class="grade-right"'; }?>></span></td>
						</tr>
						<?php } ?>	
					</tbody>
				</table>
			</td>
		<?php  if($j % 3 == 0){ ?>
			</tr>
		<?php } ?>	
			<?php  endforeach; ?>
		</tbody>
		</table>
		<?php } ?>
		
            </div>
        </div>

        <br/>
        
    </div>
    <br/>
    <br/>
 
    <?php endforeach;?>
    </div>
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
