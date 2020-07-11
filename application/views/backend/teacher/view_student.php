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
									
<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_other_student/');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-users"></i><?php echo get_phrase('other_student'); ?></button></a> 
<div class="x_panel" id="div_print">

<div class="x_panel" align="center" style="background-color:#5cb85c"><img src="<?php echo $this->crud_model->get_image_url('student', $row['student_id']); ?>" class="img-circle" width="100" height="100" border="10px solid rgba(256,256,256,0.3); display: inline-block;"/>
<h2><strong style="color:#FFFFFF"><?php echo $row ['name'].' '.$row ['surname'];?></strong></h2>

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

<?php 
    $student_info = $this->crud_model->get_student_info($student_id);
    $exams         = $this->crud_model->get_exams();
    foreach ($student_info as $row1):
    foreach ($exams as $row2):
?>
    <div class="col-md-12">
        <div class="panel panel-success panel-shadow">
            <div class="panel-heading">
                <div class="panel-title"><?php echo $row2['name'];?></div>
            </div>
			</div>
           
		<table class=" table  datatable" >
                       <thead>
                        <tr>
                            <td style="text-align: center;">SUBJECT</td>
                            <td style="text-align: center;">1ST SCORE</td>
                            <td style="text-align: center;">2ND SCORE</td>
							<td style="text-align: center;">3RD SCORE</td>
                            <td style="text-align: center;">4TH SCORE</td>
                            <td style="text-align: center;">EXAM SCORE</td>
                            <td style="text-align: center;">TOTAL SCORE</td>
                            <td style="text-align: center;">AVERAGE</td>
                            <td style="text-align: center;">COMMENT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $total_marks = 0;
                            $total_grade_point = 0;
                            $subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
                            foreach ($subjects as $row3):
                        ?>
                            <tr>
                                <td style="text-align: center;"><?php echo $row3['name'];?></td>
								<td style="text-align: center;">
								
								<?php
                                        $obtained_mark_query = $this->db->get_where('mark' , array(
                                                    'subject_id' => $row3['subject_id'],
                                                        'exam_id' => $row2['exam_id'],
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id));
                                        if ( $obtained_mark_query->num_rows() > 0) {
                                            $marks = $obtained_mark_query->result_array();
                                            foreach ($marks as $row4) {
											
                                                $obtained_class_score = $row4['class_score'];												
                                            echo $obtained_class_score;
                                            }
                                        }
                                    ?>
								
								</td>
								<td style="text-align: center;">
								
								
								<?php
                                        $obtained_mark_query = $this->db->get_where('mark' , array(
                                                    'subject_id' => $row3['subject_id'],
                                                        'exam_id' => $row2['exam_id'],
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id));
                                        if ( $obtained_mark_query->num_rows() > 0) {
                                            $marks = $obtained_mark_query->result_array();
                                            foreach ($marks as $row4) {
                                                
												$obtained_class_score2 = $row4['class_score2'];												
                                            echo $obtained_class_score2;
                                                
                                            }
                                        }
                                    ?>
								
								
								</td>
								<td style="text-align: center;">
								
								<?php
                                        $obtained_mark_query = $this->db->get_where('mark' , array(
                                                    'subject_id' => $row3['subject_id'],
                                                        'exam_id' => $row2['exam_id'],
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id));
                                        if ( $obtained_mark_query->num_rows() > 0) {
                                            $marks = $obtained_mark_query->result_array();
                                            foreach ($marks as $row4) {
											
                                            $obtained_class_score3 = $row4['class_score3'];												
                                            echo $obtained_class_score3;
                                                
                                            }
                                        }
                                    ?>
								
								</td>
								<td style="text-align: center;">
								
								<?php
                                        $obtained_mark_query = $this->db->get_where('mark' , array(
                                                    'subject_id' => $row3['subject_id'],
                                                        'exam_id' => $row2['exam_id'],
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id));
                                        if ( $obtained_mark_query->num_rows() > 0) {
                                            $marks = $obtained_mark_query->result_array();
                                            foreach ($marks as $row4) {
											
											$obtained_class_score4 = $row4['class_score4'];												
                                            echo $obtained_class_score4;
                                                
                                            }
                                        }
                                    ?>
								
								
								</td>
                                <td style="text-align: center;">
                                    <?php
                                        $obtained_mark_query = $this->db->get_where('mark' , array(
                                                    'subject_id' => $row3['subject_id'],
                                                        'exam_id' => $row2['exam_id'],
                                                            'class_id' => $class_id,
                                                                'student_id' => $student_id));
                                        if ( $obtained_mark_query->num_rows() > 0) {
                                            $marks = $obtained_mark_query->result_array();
                                            foreach ($marks as $row4) 
											
											{
											$obtained_marks = $row4['mark_obtained'];
                                                echo $obtained_marks;
                                                
                                            }
                                        }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                          <?php echo ($obtained_marks + $obtained_class_score + $obtained_class_score2 + $obtained_class_score3 + $obtained_class_score4);?>
                                </td>
                                <td style="text-align: center;">
                                    
									<?php 
							$a = $obtained_marks;
							$b = $obtained_class_score;
							$c = $obtained_class_score2;
							$d = $obtained_class_score3;
							$e = $obtained_class_score4;
							
							$sum = $a + $b + $c + $d + $e;
							$average = $sum/5;
							
							echo $average; 
							?>
                                </td>
                                <td style="text-align: center;"><?php echo $row4['comment'];?></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                   </table>

                  <?php 
    					$student_info = $this->crud_model->get_student_info($student_id);
    					foreach ($student_info as $row8):
					?>
                    <a href="<?php echo base_url();?>index.php?teacher/student_marksheet_print_view/<?php echo $row8['student_id'];?>/<?php echo $row2['exam_id'];?>" 
                        class="btn btn-orange btn-xs" target="_blank">
                        <i class="entypo-print"></i>&nbsp;<?php echo get_phrase('print_report_card');?>
                    </a>
			   
			   <?php endforeach;?>
<br>
</div>
 <div class="col-md-6">
                   <div id="chartdiv<?php echo $row2['exam_id'];?>" class="exam_chart"></div>
                       <script type="text/javascript">
                            var chart<?php echo $row2['exam_id'];?> = AmCharts.makeChart("chartdiv<?php echo $row2['exam_id'];?>", {
                                "theme": "light",
                                "type": "serial",
                                "dataProvider": [
                                        <?php 
                                            foreach ($subjects as $subject) :
                                        ?>
                                        {
                                            "subject": "<?php echo $subject['name'];?>",
                                            "mark_obtained": 
                                            <?php
                                            $obtained_mark = $this->crud_model->get_obtained_marks( $row2['exam_id'] , $class_id , $subject['subject_id'] , $row1['student_id']);
                                                echo $obtained_mark;
                                            ?>,
                                            "mark_highest": 
                                            <?php
                                                $highest_mark = $this->crud_model->get_highest_marks( $row2['exam_id'] , $class_id , $subject['subject_id'] );
                                                echo $highest_mark;
                                            ?>
                                        },
                                        <?php 
                                            endforeach;

                                        ?>
                                    
                                ],
                                "valueAxes": [{
                                    "stackType": "3d",
                                    "unit": "%",
                                    "position": "left",
                                    "title": "Mark Score Vs Highest Mark"
                                }],
                                "startDuration": 1,
                                "graphs": [{
                                    "balloonText": "Mark Score In [[category]]: <b>[[value]]</b>",
                                    "fillAlphas": 0.9,
                                    "lineAlpha": 0.2,
                                    "title": "2004",
                                    "type": "column",
                                    "fillColors":"#0e4d39",
                                    "valueField": "mark_obtained"
                                }, {
                                    "balloonText": "Highest Mark In [[category]]: <b>[[value]]</b>",
                                    "fillAlphas": 0.9,
                                    "lineAlpha": 0.2,
                                    "title": "2005",
                                    "type": "column",
                                    "fillColors":"#72c02c",
                                    "valueField": "mark_highest"
                                }],
                                "plotAreaFillAlphas": 0.1,
                                "depth3D": 20,
                                "angle": 45,
                                "categoryField": "subject",
                                "categoryAxis": {
                                    "gridPosition": "start"
                                },
                                "exportConfig":{
                                    "menuTop":"20px",
                                    "menuRight":"20px",
                                    "menuItems": [{
                                        "format": 'png'   
                                    }]  
                                }
                            });
                    </script>
               </div>
               
<?php
    endforeach;
        endforeach;
?>
                           
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
    var pages = $('.print');
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
    }
    
</script>
