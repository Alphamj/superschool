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
					 <?php echo get_phrase('score_sheet'); ?>
					</div>
					</div>
		<?php 
			
			$get_system_settings	=	$this->crud_model->get_system_settings();
			echo '<input type="hidden" id="current_session" value="'.$get_system_settings[17]['description'].'">';
			echo form_open(base_url() . 'index.php?formtutor/score_sheet');?>
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
                        $classes = $this->db->get_where('class', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
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
					<select name="exam_id" class="form-control selectboxit">
                        	<option value=""><?php echo get_phrase('select_an_term');?></option>
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
				<button type="submit" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-search"></i><?php echo get_phrase('get_details');?></button>
			</div>
		<?php echo form_close();?>
</div>

<?php if ($class_id != '' && $exam_id != ''):?>
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
					 <?php echo get_phrase('score_sheet'); ?>
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
	
     <div class="table">
          <div class="table-responsive">
			<table cellpadding="0" cellspacing="0" class="tg" style="width:100%; margin:auto;">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="12" rowspan="12">NAMES</th>
							<th class="tg-yw4l" rowspan="4" style="width:70px">C.A</th>
							<th class="tg-yw4l" rowspan="2">EXAM / TEST</th>
							<th class="tg-yw4l" rowspan="2">TOTAL</th>
							<th class="tg-yw4l" rowspan="2">EFFORT</th>
							<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'S REMARKS</th>
						</tr>
						<tr>
							<td class="tg-yw4l">ATTITUDE TO <br/> WORK AND TASK</td>
							<td class="tg-yw4l">ATTENTIVENESS <br/> IN CLASS</td>
							<td class="tg-yw4l">RESPONSE TO <br/> ASSIGNMENTS <br/> AND PROJECTS</td>
							<td class="tg-yw4l">INTEREST <br/>IN SUBJECT</td>
							<td class="tg-yw4l">WILLINGNESS <br/> TO WORK <br/> WITH OTHERS</td>
						</tr>
                    </thead>
                    <tbody>
				<?php
					$query = $this->db->get_where('student' , array('class_id' => $class_id));
					$marks	=	$query->result_array();
					
					foreach($marks as $row2):
						
				?>
							<tr>
								<td><?php echo $row2['name'].$row2['surname']; ?>	</td>
								<td class="tg-yw4l"></td>
								<td class="tg-yw4l"></td>
								<td class="tg-yw4l"></td>
								<td class="tg-yw4l"></td>
								<td class="tg-yw4l"></td>
								<td class="tg-yw4l"></td>
								<td class="tg-yw4l"></td>
								<td class="tg-yw4l"></td>
								<td class="tg-yw4l"></td>
                              
							 </tr>
                         <?php endforeach; ?>
				</tbody>
			</table>
          </div>
     </div>
          <!-- Junior Secondary -->
          	
		<?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){ ?>
			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;display: inline-block;vertical-align: top;    overflow: auto;">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="2">NAME</th>
							<th class="tg-yw4l" rowspan="2">C.A</th>
							<th class="tg-yw4l" rowspan="2">EXAM </th>
							<th class="tg-yw4l" rowspan="2">TOTAL</th>
							<th class="tg-yw4l" rowspan="2">EFFORT</th>
							<th class="tg-yw4l" colspan="5">SUBJECT TEACHER'S REMARKS</th>
						</tr>
						<tr>
							<td class="tg-yw4l">ATTITUDE TO <br/> WORK AND TASK</td>
							<td class="tg-yw4l">ATTENTIVENESS <br/> IN CLASS</td>
							<td class="tg-yw4l">RESPONSE TO <br/> ASSIGNMENTS <br/> AND PROJECTS</td>
							<td class="tg-yw4l">INTEREST <br/>IN SUBJECT</td>
							<td class="tg-yw4l">WILLINGNESS <br/> TO WORK <br/> WITH OTHERS</td>
						</tr>
                    </thead>
                    <tbody>
		
					
				<?php
					$query = $this->db->get_where('student' , array('class_id' => $class_id));
					$marks	=	$query->result_array();
					
					foreach($marks as $row2):
				?>
						<tr>
							<td><?php echo $row2['name']; ?></td>
							<td class="tg-yw4l"></td>
							<td class="tg-yw4l"></td>
							<td class="tg-yw4l"></td>
							<td class="tg-yw4l"></td>
							<td class="tg-yw4l"></td>
							<td class="tg-yw4l"></td>
							<td class="tg-yw4l"></td>
							<td class="tg-yw4l"></td>
							<td class="tg-yw4l"></td>
                         
						 </tr>
							
					<?php		
					endforeach;
					?>
				</tbody>
			</table>
				
		<!-- Primary -->		 
				<?php }else if (strpos($class_type, 'primary') !== false){ ?>
					<table class="tg" style="width: auto;">
						<tbody>
							<tr>
								<td colspan="12"></td>
								<td colspan="42" style="text-align: center;"><?php echo $exam_name ?></td>	
							</tr>
							<tr>
								<td colspan="12">NAME</td>
								<td colspan="3" class="space" style="text-align: center;">CA 1</td>
								<td colspan="3" class="space" style="text-align: center;">CW</td>
								<td colspan="3" class="space" style="text-align: center;">CA</td>
								<td colspan="5" class="space" style="text-align: center;">PROJECT</td>
								<td colspan="5" class="space" style="text-align: center;">TOTAL CA</td>
								<td colspan="4" class="space" style="text-align: center;">EXAM</td>
								<td colspan="3" class="space" style="text-align: center;">TOTAL <br> SCORE</td>
								<td colspan="3" class="space" style="text-align: center;">SUBJECT <br> AVERAGE</td>
								<td colspan="3" class="space" style="text-align: center;">GRADE</td>
								<td width = 10% class="space" style="text-align: center;">REMARK</td>
								
								
							</tr>
							<?php 
							$query = $this->db->get_where('student' , array('class_id' => $class_id));
							$marks	=	$query->result_array();
							 
							foreach($marks as $row2):
							?>
								<tr>
									<td colspan="12"><?php echo $row2['name'].$row2['surname'];?></td>
									<td class="space" colspan="3" ></td>
									<td class="space" colspan="3" ></td>
									<td class="space" colspan="3" ></td>
									<td class="space" colspan="5" ></td>
									<td class="space" colspan="5" ></td>
									<td class="space" colspan="4" ></td>
									<td class="space" colspan="3" ></td>
									<td class="space" colspan="3" ></td>
                                             <td class="space" colspan="3" ></td>
                                             <td class="space" width = 10% ></td>
								</tr>
							<?php
							endforeach;
							?>
						</tbody>
					</table>

<!-- Nursery -->
		<?php }else if (strpos($class_type, 'nursery') !== false || strpos($class_type, 'nur') !== false || strpos($class_type, 'toddler') !== false){ ?>
		<style>
			table, tr, td, th {    border: 1px solid #000;border-collapse: collapse;font-family: sans-serif;font-size: 14px;}
			th { padding: 10px; margin-left: 100px;}td span {font-size: 13px; margin-left: 3px;}th {height: 130px;}
			.text-transform span {float: left;width: 100%;margin: 0 0 0 -22px;}
			.text-transform { text-align: center;g-origin: 50% 50%;-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg);  -ms-transform: rotate(90deg);  -o-transform: rotate(90deg); transform: rotate(270deg); width: 60px; max-width: 60px;}
			td.inner {padding: 0;}
			td.inner table {width: 100%;}
			td.inner table, td.inner tr {border: 0;}
			
		</style>

		<?php } ?>
		<center>
			<!-- <a href="<?php //echo base_url();?>index.php?formtutor/score_sheet/<?php //echo $class_id;?>/<?php //echo $exam_id;?>/<?php //echo $sessoin_id;?>" 
				class="btn btn-orange btn-sm btn-icon icon-left" target="_blank">
				<i class="entypo-print"></i><?php //echo get_phrase('mass_report_card');?>
			</a> -->
			<a href="<?php echo base_url();?>index.php?formtutor/score_sheet/<?php echo $class_id;?>/<?php echo $exam_id;?>/<?php echo $sessoin_id;?>" 
				class="btn btn-orange btn-sm btn-icon icon-left" target="_blank">
				<i class="entypo-print"></i><?php echo 'Print Score Sheet';?>
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
					url: '<?php echo base_url();?>index.php?formtutor/student_session_year/' + session_year +'/'+class_id+'/current',
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
					url: '<?php echo base_url();?>index.php?formtutor/student_session_year/' + session_year +'/'+class_id,
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
					url: '<?php echo base_url();?>index.php?formtutor/student_session_year/' + session_year +'/'+class_id+'/current',
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
					url: '<?php echo base_url();?>index.php?formtutor/student_session_year/' + session_year +'/'+class_id,
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

