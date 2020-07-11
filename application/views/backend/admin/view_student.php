<style>
    .exam_chart {
    width           : 100%;
        height      : 265px;
        font-size   : 11px;
}
  
</style>

<?php
$student_name = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
foreach ($student_name as $row):
    ?>
	<button type="button" name="b_print" class="btn btn-xs btn-orange" onClick="printdiv('div_print');"><i class="entypo-print"></i></button>	
																	 <a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_message/<?php echo $row['student_id']; ?>');"><button type="button" class="btn btn-green btn-xs"><i class="entypo-mail"></i></button></a>
									
<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_other_student/');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-users"></i><?php echo get_phrase('other_student'); ?></button></a> <button type="button" class="btn btn-green btn-xs" disabled="disabled">Login Details:&nbsp;Email:&nbsp;<?php echo $row ['email'];?>&nbsp;and&nbsp;Password:&nbsp;<?php echo $row ['password'];?></button>
<div class="x_panel" id="div_print">

<div class="x_panel" align="center" style="background-color:#5cb85c"><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="100" height="100" border="10px solid rgba(256,256,256,0.3); display: inline-block;"/>
<h2><strong style="color:#FFFFFF"><?php echo $row ['name'];?></strong></h2>

</div>


<h2><strong  style="color:#5cb85c">Personal Information</strong></h2>

							<table class="table">
                              <tbody>
                                <tr>
                                  <th>Register No</th>
                                  <td>:<?php echo $row ['roll'];?></td>
                                  <th>Mother Tougue</th>
                                  <td>:<?php echo $row ['m_tongue'];?></td>
                                </tr>
                                <tr>
                                  <th>Section</th>
                                  <td><?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;?></td>
                                  <th>City</th>
                                  <td>:<?php echo $row ['city'];?></td>
                                </tr>
                                <tr>
                                  <th>Gender</th>
                                  <td>:<?php echo $row ['sex'];?></td>
                                  <th>State</th>
                                  <td>:<?php echo $row ['state'];?></td>
                                </tr>
								<tr>
                                  <th>Mobile No</th>
                                  <td>:<?php echo $row ['phone'];?></td>
                                  <th>Email</th>
                                  <td>:<?php echo $row ['email'];?></td>
                                </tr>
								
								<tr>
                                  <th>Class</th>
                                  <td><?php echo $this->crud_model->get_class_name($row['class_id']);?></td>
                                  <th>Nationality</th>
                                  <td>:<?php echo $row ['nationality'];?></td>
                                </tr>
                                <tr>
                                  <th>Birthday</th>
                                  <td>:<?php echo $row ['birthday'];?></td>
                                  <th>Place Birth</th>
                                  <td><?php echo $row ['place_birth'];?></td>
                                </tr>
                                <tr>
                                  <th>Age</th>
                                  <td>:<?php echo $row ['age'];?></td>
                                  <th>Address</th>
                                  <td>:<?php echo $row ['address'];?></td>
                                </tr>
								<tr>
                                  <th>Blood Group</th>
                                  <td>:<?php echo $row ['blood_group'];?></td>
                                  <th>Physical Handicap</th>
                                  <td>:<?php echo $row ['physical_h'];?></td>
                                </tr>
								
                              </tbody>
                            </table>
<h2><strong  style="color:#5cb85c">Library Registration Information</strong></h2>

<?php if($row['card_number'] == ''):?>
							<div class="alert alert-danger" align="center">You have not done your library registration. Kindly visit your library now to complete your registratioon !</div>
							<?php endif;?>
							
							<?php if($row['card_number'] != ''):?>
							<table class="table">
<tbody>
<tr>
                                  <th>Library ID Number</th>
                                  <td>:<?php echo $row ['card_number'];?></td>
                                </tr>
								
								<tr>
								<th>Date Issued</th>
                                  <td>:<?php echo $row ['issue_date'];?></td>
								</tr>
								
								<tr>
								<th>Expiry Date</th>
                                  <td>:<?php echo $row ['expire_date'];?></td>
								</tr>
								
								
</tbody>
</table>
							<?php endif;?>

							
<h2><strong  style="color:#5cb85c">Previous School Attended Information</strong></h2>
<table class="table">
                              <tbody>
                                
                                <tr>
                                  <th>Previous School Name</th>
                                  <td>:<?php echo $row ['ps_attend'];?></td>
                                  <th>Admission Date</th>
                                  <td>:<?php echo $row ['am_date'];?></td>
                                </tr>
								<tr>
                                  <th>The Address</th>
                                  <td>:<?php echo $row ['ps_address'];?></td>
                                  <th>Transfer Certificate</th>
                                  <td>:<?php echo $row ['tran_cert'];?></td>
                                </tr>
								
								<tr>
                                  <th>Purpose Of Leaving</th>
                                  <td>:<?php echo $row ['ps_purpose'];?></td>
                                  <th>Birth Certificate</th>
                                  <td>:<?php echo $row ['dob_cert'];?></td>
                                </tr>
                                <tr>
                                  <th>Class In Which Was Studying</th>
                                  <td>:<?php echo $row ['class_study'];?></td>
                                  <th>Any Given Marksheet</th>
                                  <td>:<?php echo $row ['mark_join'];?></td>
                                </tr>
                                <tr>
                                  <th>Date Of Leaving</th>
                                  <td>:<?php echo $row ['date_of_leaving'];?></td>
                                  <th>Physical Challenge</th>
                                  <td>:<?php echo $row ['physical_h'];?></td>
                                </tr>
								
								
                              </tbody>
                            </table>
							
<h2><strong  style="color:#5cb85c">Parent Information</strong></h2>
<table class="table">
                              <tbody>
                                
                                <tr>
                                  <th>Parent Name:</th>
                                  <td><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->name;?></td>
                                </tr>
								<tr>
                                  <th>Email:</th>
                                  <td><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->email;?></td>
                                </tr>
								
								<tr>
                                  <th>Mobile No.:</th>
                                  <td><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->phone;?></td>
                                </tr>
                                <tr>
                                  <th>Address:</th>
                                  <td><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->address;?></td>
                                </tr>
                                <tr>
                                  <th>Profession:</th>
                                  <td><?php echo $this->db->get_where('parent' , array('parent_id' => $row['parent_id']))->row()->profession;?></td>
                                </tr>
								
								
                              </tbody>
                            </table>
	<h2><strong  style="color:#5cb85c">Hostel Information</strong></h2>
	<table class="table">

	 <tbody>
                                
                                <tr>
                                  <th>Hostel Name:</th>
                                  <td><?php echo $this->db->get_where('dormitory' , array('dormitory_id' => $row['dormitory_id']))->row()->name;?></td>
                                </tr>
								<tr>
                                  <th>Capacity:</th>
                                  <td><?php echo $this->db->get_where('dormitory' , array('dormitory_id' => $row['dormitory_id']))->row()->capacity;?></td>
                                </tr>
								
								<tr>
                                  <th>Address:</th>
                                  <td><?php echo $this->db->get_where('dormitory' , array('dormitory_id' => $row['dormitory_id']))->row()->address;?></td>
                                </tr>
                                
                                <tr>
                                  <th>Description:</th>
                                  <td><?php echo $this->db->get_where('dormitory' , array('dormitory_id' => $row['dormitory_id']))->row()->description;?></td>
                                </tr>
								
								
                              </tbody>
                            </table>
<h2><strong  style="color:#5cb85c">Tranportation Information</strong></h2>
<table class="table">

	 <tbody>
                                
                                <tr>
                                  <th>Transportation Name</th>
                                  <td><?php echo $this->db->get_where('transport' , array('transport_id' => $row['transport_id']))->row()->name;?></td>
                                </tr>
								<tr>
                                  <th>Number of Vehicle</th>
                                  <td><?php echo $this->db->get_where('transport' , array('transport_id' => $row['transport_id']))->row()->number_of_vehicle;?></td>
                                </tr>
								
								
                                <tr>
                                  <th>Route Fare</th>
                                  <td><?php echo $this->db->get_where('transport' , array('transport_id' => $row['transport_id']))->row()->route_fare;?></td>
                                </tr>
                                <tr>
                                  <th>Description</th>
                                  <td><?php echo $this->db->get_where('transport' , array('transport_id' => $row['transport_id']))->row()->description;?></td>
                                </tr>
								
								
                              </tbody>
                            </table>
<h2><strong  style="color:#5cb85c">Student Timetable</strong></h2>
							 <table cellpadding="0" cellspacing="0" border="0"  class="table">
                                            <tbody>
                                                <?php 
                                                for($d=1;$d<=7;$d++):
                                                
                                                if($d==1)$day='sunday';
                                                else if($d==2)$day='monday';
                                                else if($d==3)$day='tuesday';
                                                else if($d==4)$day='wednesday';
                                                else if($d==5)$day='thursday';
                                                else if($d==6)$day='friday';
                                                else if($d==7)$day='saturday';
                                                ?>
                                                <tr class="gradeA">
                                                    <td width="100"><?php echo strtoupper($day);?></td>
                                                    <td>
                                                    	<?php
														$this->db->order_by("time_start", "asc");
														$this->db->where('day' , $day);
														$this->db->where('class_id' , $class_id);
														$routines	=	$this->db->get('class_routine')->result_array();
														foreach($routines as $row2):
														?>
															<button class="btn btn-white" >
                                                         <?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?>
																<?php
                                                                    if ($row2['time_start_min'] == 0 && $row2['time_end_min'] == 0) 
                                                                        echo '('.$row2['time_start'].'-'.$row2['time_end'].')';
                                                                    if ($row2['time_start_min'] != 0 || $row2['time_end_min'] != 0)
                                                                        echo '('.$row2['time_start'].':'.$row2['time_start_min'].'-'.$row2['time_end'].':'.$row2['time_end_min'].')';
                                                                ?>
                                                            </button>
														<?php endforeach;?>

                                                    </td>
                                                </tr>
                                                <?php endfor;?>
                                                
                                            </tbody>
                                        </table>
</div>
<?php endforeach; ?>

<div class="x_panel" >

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
	
	span.grade-right::before { content: "\f00c"; font-family: fontawesome; color: green;}

</style>
<?php  
	$students_data   =   $this->crud_model->get_student_info($student_id); 
	$get_exams   =   $this->crud_model->get_exams(); 
	$sessoin_ids =  $this->crud_model->get_system_settings(); 
	$sessoin_id = $sessoin_ids[17]['description'];
	foreach($get_exams as $exam_data){
		
		$exam_id = $exam_data['exam_id'];
   // foreach($students as $row): 
        $student_id = $students_data[0]['student_id'];
        $roll = $students_data[0]['roll'];
        $sex = $students_data[0]['sex'];
        $class_id = $students_data[0]['class_id'];
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
		
            <div class="col-md-2 logo" style="text-align: centre;">
                <img src="uploads/logo.png" style="max-height:100px;margin-left: 0px;">
            </div>
            <div class="col-md-8" style="text-align: center;">
                <div class="tile-stats tile-white tile-white-primary">
                    <span style="text-align: center;font-size: 32px;"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></span>
                    <br/>
                    <span style="text-align: center;font-size: 20px;"><?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?></span>
                    <br/>
                    <span style="text-align: center;font-size: 26px;">TERMINAL REPORT</span><br>
                    <span style="text-align: center;font-size:16px"><?php  $exam_name = $this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name; echo $exam_name.' , '.$sessoin_id.' SESSION';?></span>
					
                </div>
            </div>
			<div class="col-md-2 logo" style="text-align: left;">
                <img src="<?php echo $this->crud_model->get_image_url('student',$students_data[0]['student_id']);?>" style="max-height:100px;margin-right: 100px;">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-2" style="text-align: left;"><h4>Name</h4></div>
            <div class="col-md-4" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php echo $students_data[0]['name'].' '.$students_data[0]['surname'];;?></h4></div>
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
					if ((strpos($class_type, 'senior secondary') !== false || strpos($class_type, 'ss') !== false) && strpos($class_type, 'jss') !== true){
					?>
             	<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;overflow: auto;display: inline-block;vertical-align: top;">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A (30%)</th>
							<th class="tg-yw4l" rowspan="2">EXAM (70%)</th>
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
							  <td colspan="2">B = VERRY GOOD</td>
							<td colspan="2">70-89%</td>
						 </tr>
						 <tr>
							
							<td colspan="7" rowspan="2">HEAD TEACHER COMMENT:</td>
							<td colspan="3">NAME:</td>
							<td colspan="2">c+ = VERRY GOOD</td>
							<td colspan="2">60-69%</td>
						 </tr>
						 <tr>
							
							
							<td colspan="3">SIGNATURE:</td>
							 <td colspan="2">C = VERRY GOOD</td>
							<td colspan="2">50-59%</td>
						 </tr>
						 <tr>
							<td colspan="7">NEXT TERM BEGINS:</td>
							<td colspan="3"></td>
							<td colspan="2">D = VERRY GOOD</td>
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
						<tr>
							<th class="tg-yw4l" rowspan="2">SUBJECT</th>
							<th class="tg-yw4l" rowspan="2">C.A (30%)</th>
							<th class="tg-yw4l" rowspan="2">EXAM (70%)</th>
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
		
					
				<?php 
					$query = $this->db->get_where('mark' , array('class_id' => $class_id, 'exam_id' => $exam_id, 'student_id' => $student_id,'session_year'=>$sessoin_id));
					$marks	=	$query->result_array();
					$total_markss=0;
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
                     </tbody>
                  </table>
					</div>	
				 
				 <?php }else if (strpos($class_type, 'primary') !== false){ ?>
					<div style="width: 71%;display: inline-block;vertical-align: top;">
							<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;">
							<tbody>
							<tr><td colspan="13"></td>
								<td colspan="23" style="text-align: center;">SECOND TERM</td>
								<td colspan="4" style="text-align: center;">TOTAL</td>
								
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
								<td colspan="3" class="space" style="text-align: center;">SCORE</td>
								<td colspan="3" class="space" style="text-align: center;">Grade</td>
								
								
							</tr>
							 <?php 
							 
						$students	=	$this->crud_model->get_subjects_by_class1($class_id);
						$i=0;
						foreach($students as $row3):
							$i++;
							$verify_data =   array(  'exam_id' => $exam_id ,
                                                        'class_id' => $class_id ,
                                                        'subject_id' => $row3['subject_id'] , 
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
							?>
                          
									<tr>
										<td><?php echo $i; ?></td>
										<td colspan="12"><?php echo  $this->crud_model->get_subject_name_by_ids('subject',$row3['subject_id']);?></td>
										<td class="space" colspan="3"><?php echo $row2['ca_1'];?></td>
										<td class="space" colspan="3"><?php echo $row2['cw'];?></td>
										<td class="space" colspan="3"><?php echo $row2['ca_2'];?></td>
										<td class="space" colspan="5"><?php echo $row2['project_score'];?> </td>
										<td class="space" colspan="5"><?php echo $row2['ca_marks'];?>"</td>
										<td class="space" colspan="4"><?php echo $row2['mark_obtained'];?></td>
										<td class="space" colspan="3"><?php echo $row2['mark_total'];?></td>
										<td class="space" colspan="3"><?php echo $grade;?></td>
										
										</tr>
										<?php 
							endforeach;
						 endforeach;
						 ?>
						 
						 <tr>
							 <td rowspan="5"></td>
							 <td colspan="26" rowspan="3" class="teacher comment">TEACHER COMMENT:</td>
							 <td colspan="13">NAME:</td>
						 </tr>
						 <tr>
							
							 <td colspan="13">SIGNATURE:</td>
						 </tr>
						 <tr>
							 <td colspan="13"></td>
						 </tr>
						 <tr>
							
							<td colspan="26" rowspan="2">HEAD TEACHER COMMENT:</td>
							<td colspan="13">NAME:</td>
						 </tr>
						 <tr>
							
							
							<td colspan="13">SIGNATURE:</td>
						 </tr>
						 <tr>
							<td></td>
							<td colspan="26">NEXT TERM BEGINS:</td>
							<td colspan="13"></td>
						 </tr>
    
      
</tbody>
</table>
					</div>
<div style="width: 28%;display: inline-block;vertical-align: top;">
<table  style="width: 100%">
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
<tr>
 <td colspan="11" style="text-align: center;">GRADE KEY:</td>
</tr>
<tr>
 <td colspan="6">A = EXCELLENT</td>
        <td colspan="5">90-100%</td>
</tr>
<tr>
 <td colspan="6">B = VERRY GOOD</td>
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
				foreach($students as $row3):
					$i++;$j++;
					$subject_id = $row3['subject_id'];
			?>
				
			<?php  if($i % 3 == 0){ ?>
					<tr>
			<?php } ?>
			<td colspan="20" class="inner">
				<table>
					<tbody>
						<tr>
							<td colspan="12"><span><?php echo $row3['name'];  ?></span></td>
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
							->where('subject_id',$row3['subject_id']);
				
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
 
    <?php //endforeach;
	}
    ?>
    </div>

                     
</div>

<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
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
