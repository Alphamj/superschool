<?php
	$class_name		 	= 	$this->db->get_where('class' , array('class_id' => $class_id))->row()->name;
	$exam_name  		= 	$this->db->get_where('exam' , array('exam_id' => $exam_id))->row()->name;
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
?>


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
	<style type="text/css">
		td {
			padding: 5px;
            /*color: #000 !important;*/
            border: 1px solid #D2CBCB;
		}
	</style>
<div id="print">

	<script src="assets/js/jquery-1.11.0.min.js"></script>
	<style type="text/css">
		td {
			padding: 5px;
		}
	</style>

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
                    <span style="text-align: center;font-size: 32px;"><?php echo $this->db->get_where('settings' , array('type' =>'system_name'))->row()->description;?></span>
                    <br/>
                    <span style="text-align: center;font-size: 20px;"><?php echo $this->db->get_where('settings' , array('type' =>'address'))->row()->description;?></span>
                    <br/>
                    <span style="text-align: center;font-size: 26px;">TERMINAL REPORT</span>
					
                </div>
            </div>
			<div class="col-md-2 logo" style="text-align: left;">
                <img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" style="max-height:100px;margin-right: 100px;">
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-1" style="text-align: left;"><h4>NAME</h4></div>
            <div class="col-md-6" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php  $name = $this->db->get_where('student' , array('student_id' => $student_id))->row()->name; echo $name;?></h4></div>
            <div class="col-md-2" style="text-align: center;"><h4>CLASS</h4></div>
            <div class="col-md-2" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php
             $class_name = $this->db->get_where('class' , array('class_id' => $class_id))->row()->name;echo $class_name;?></h4></div>
        </div>
      
        <div class="row">
            <div class="col-md-1" style="text-align: center;"><h4>SESSION</h4></div>
            <div class="col-md-2" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php echo $this->db->get_where('settings' , array('type' =>'session'))->row()->description;?></h4></div>
            <div class="col-md-2" style="text-align: center;"><h4>ROLL NO</h4></div>
            <div class="col-md-2" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php  $roll = $this->db->get_where('student' , array('student_id' => $student_id))->row()->roll; echo $roll;?></h4></div>
            <div class="col-md-1" style="text-align: center;"><h4>SEX</h4></div>
            <div class="col-md-3" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php  $sex = $this->db->get_where('student' , array('student_id' => $student_id))->row()->sex; echo $sex;?></h4></div>
        </div>
		
		  <div class="row">
            <div class="col-md-1" style="text-align: center;"><h4>POSITION</h4></div>
            <div class="col-md-6" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4></h4></div>
            <div class="col-md-2" style="text-align: center;"><h4>TERM</h4></div>
            <div class="col-md-2" style="border-bottom: 1px dotted #D2CBCB;text-align: center;height: 30px;"><h4><?php
             $class_name = $this->db->get_where('section' , array('class_id' => $class_id))->row()->name; echo $class_name;?></h4></div>
        </div>
		
        <br/>
   
	<table style="width:100%; border-collapse:collapse;border: 1px solid #ccc; margin-top: 10px;" border="1">
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
                        $marks = $this->db->get_where('mark' , array(
                                    'subject_id' => $row3['subject_id'],
                                        'exam_id' => $exam_id,
                                            'class_id' => $class_id,
                                                'student_id' => $student_id))->result_array();
                        
                        foreach ($marks as $row4) {
						$a = $row4['class_score'];
                            echo $a;
                        }
                    ?>
                </td>
				
				<td style="text-align: center;">
                    <?php
                        $marks = $this->db->get_where('mark' , array(
                                    'subject_id' => $row3['subject_id'],
                                        'exam_id' => $exam_id,
                                            'class_id' => $class_id,
                                                'student_id' => $student_id))->result_array();
                        
                        foreach ($marks as $row4) {
						$b = $row4['class_score2'];
                            echo $b;
                        }
                    ?>
                </td>
				
				<td style="text-align: center;">
                    <?php
                        $marks = $this->db->get_where('mark' , array(
                                    'subject_id' => $row3['subject_id'],
                                        'exam_id' => $exam_id,
                                            'class_id' => $class_id,
                                                'student_id' => $student_id))->result_array();
                        
                        foreach ($marks as $row4) {
						$c = $row4['class_score3'];
                            echo $c;
                        }
                    ?>
                </td>
				<td style="text-align: center;">
                    <?php
                        $marks = $this->db->get_where('mark' , array(
                                    'subject_id' => $row3['subject_id'],
                                        'exam_id' => $exam_id,
                                            'class_id' => $class_id,
                                                'student_id' => $student_id))->result_array();
                        
                        foreach ($marks as $row4) {
						$d = $row4['class_score4'];
                            echo $d;
                        }
                    ?>
                </td>
				
				<td style="text-align: center;">
                    <?php
                        $marks = $this->db->get_where('mark' , array(
                                    'subject_id' => $row3['subject_id'],
                                        'exam_id' => $exam_id,
                                            'class_id' => $class_id,
                                                'student_id' => $student_id))->result_array();
                        
                        foreach ($marks as $row4) {
						$e = $row4['mark_obtained'];
                            echo $e;
                        }
                    ?>
                </td>
				
								
								<td style="text-align: center;">
								
								
                          <?php echo ($e + $a + $b + $c + $d);?>
						  
						  
						  
                                </td>
								
								<td style="text-align: center;">
						    <?php 
							$aa = $e;
							$bb = $a;
							$cc= $b;
							$dd = $c;
							$ee = $d;
							
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
   <br>
</div>
<hr>
<center>
	  <button class="btn btn-success" onClick="window.print()"><i class="entypo-print"></i>Print Result</button>
	</center>
</div>

<script type="text/javascript">

	/*jQuery(document).ready(function($)
	{
		var elem = $('#print');
		PrintElem(elem);
		Popup(data);

	});

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title></title>');
        //mywindow.document.write('<link rel="stylesheet" href="assets/css/print.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        //mywindow.document.write('<style>.print{border : 1px;}</style>');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }*/
</script>
</body>
</html>