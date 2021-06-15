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
			echo form_open(base_url() . 'index.php?teacher/score_sheet0');?>
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
					<select name="exam_id" class="form-control selectboxit">
                        	<option value=""><?php echo get_phrase('select_an_term');?></option>
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
					echo 'score sheet for:'.' '. $sessoin_id . ' '.'Academic Year';
				?>
			</h3>
			<h4><?php echo 'CLASS' . ' ' . $class_name;?></h4>
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
							<th class="tg-yw4l" rowspan="12">NAMES</th>
							<th class="tg-yw4l" rowspan="2">ENG</th>
							<th class="tg-yw4l" rowspan="2">CRW</th>
							<th class="tg-yw4l" rowspan="2">MTH</th>
							<th class="tg-yw4l" rowspan="2">BIO</th>
							<th class="tg-yw4l" rowspan="2">CVE</th>
							<th class="tg-yw4l" rowspan="2">ECO</th>
							<th class="tg-yw4l" rowspan="2">FRH</th>
							<th class="tg-yw4l" rowspan="2">PHY</th>
							<th class="tg-yw4l" rowspan="2">CHM</th>
							<th class="tg-yw4l" rowspan="2">GEO</th>
							<th class="tg-yw4l" rowspan="2">DAP</th>
							<th class="tg-yw4l" rowspan="2">FMS</th>
							<th class="tg-yw4l" rowspan="2">F&N</th>
							<th class="tg-yw4l" rowspan="2">GOV</th>
							<th class="tg-yw4l" rowspan="2">LIT</th>
							<th class="tg-yw4l" rowspan="2">HIS</th>
							<th class="tg-yw4l" rowspan="2">TOR</th>
							<th class="tg-yw4l" rowspan="2">ART</th>
							<th class="tg-yw4l" rowspan="2">COM</th>
							<th class="tg-yw4l" rowspan="2">CPS</th>
							<th class="tg-yw4l" rowspan="2">AGS</th>
							<th class="tg-yw4l" rowspan="2">T_D</th>
							<th class="tg-yw4l" rowspan="2">CRS</th>
							<th class="tg-yw4l" rowspan="2">IRS</th>
							<th class="tg-yw4l" rowspan="2">TOT</th>
							<th class="tg-yw4l" rowspan="2">AVG</th>
							<th class="tg-yw4l" rowspan="2">POS</th>
						</tr>
                    </thead>
                    <tbody>
				<?php
					if ($class_id > 28 && $class_id < 32 ){
						$this->db->distinct();
						$this->db->select('student_id')
			    				->from('mark0')
			    				->where('class_id', 29)
			    				->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 30)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud1 = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 31)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud2 = $query->result_array();

						$stud	=	array_merge($querystud,$querystud1,$querystud2);
					 }
					 elseif ($class_id > 31 && $class_id < 35 ){
						$this->db->distinct();
						$this->db->select('student_id')
			    				->from('mark0')
			    				->where('class_id', 32)
			    				->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 33)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud1 = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 34)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud2 = $query->result_array();

						$stud	=	array_merge($querystud,$querystud1,$querystud2);
					 }
					 elseif ($class_id > 34 && $class_id < 38 ){
						$this->db->distinct();
						$this->db->select('student_id')
			    				->from('mark0')
			    				->where('class_id', 35)
			    				->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 36)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud1 = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 37)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud2 = $query->result_array();

						$stud	=	array_merge($querystud,$querystud1,$querystud2);
					 }
					 
					foreach($stud as $row2):
						if ($class_id > 28 && $class_id < 32 ){
							$marks1	=	$this->db->get_where('mark0' , array('class_id' => 29, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks2	=	$this->db->get_where('mark0' , array('class_id' => 30, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks3	=	$this->db->get_where('mark0' , array('class_id' => 31, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks = array_merge($marks1,$marks2,$marks3);
						}
						 elseif ($class_id > 31 && $class_id < 35 ){
							$marks1	=	$this->db->get_where('mark0' , array('class_id' => 32, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks2	=	$this->db->get_where('mark0' , array('class_id' => 33, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks3	=	$this->db->get_where('mark0' , array('class_id' => 34, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks = array_merge($marks1,$marks2,$marks3);
						}
						 elseif ($class_id > 34 && $class_id < 37 ){
							$marks1	=	$this->db->get_where('mark0' , array('class_id' => 35, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks2	=	$this->db->get_where('mark0' , array('class_id' => 36, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks3	=	$this->db->get_where('mark0' , array('class_id' => 37, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks = array_merge($marks1,$marks2,$marks3);
						}
						$avgtmk = $this->db->get_where('subavg0',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
						$student_id = $row2['student_id'];
						if ($class_id > 28 && $class_id < 32 ){
							$verify_datas = array('exam_id' => $exam_id,'class_id' => 111, 
							'student_id' => $row2['student_id'],'session_year'=>$sessoin_id);
						 }
						 elseif ($class_id > 31 && $class_id < 35 ){
							$verify_datas = array('exam_id' => $exam_id ,'class_id' => 112 , 
							'student_id' => $row2['student_id'],'session_year'=>$sessoin_id);
						 }
						 elseif ($class_id > 34 && $class_id < 37 ){
							$verify_datas = array('exam_id' => $exam_id ,'class_id' => 113 , 
							'student_id' => $row2['student_id'],'session_year'=>$sessoin_id);
						 }
						 $average	=	$this->db->get_where('average0' , $verify_datas)->result_array();
						
				?>
							<tr>
								<?php $studd = $this->db->get_where('student' , array('student_id' => $row2['student_id']))->result_array();?>
								<td><?php echo $studd[0]['name'].' '.$studd[0]['surname'] ?>	</td>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'ENGLISH' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CREATIVE' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'MATHEMATICS' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'BIOLOGY' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CIVIC' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'ECON' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'FRENCH' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'PHYSICS' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CHEMISTRY' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'GEOGRAPHY' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'DATA' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'FURTHER' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'FOOD' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'GOVERNMENT' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'LITERATURE' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'HISTORY' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'TOURISM' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'VISUAL' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'COMMERCE' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'COMPUTER' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'AGRIC' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'DRAWING' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CRS' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'IRS' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php echo $average[0]['total_score'] ?></th>
								<th class="tg-yw4l"><?php echo $average[0]['total_average'] ?></th>
								<th class="tg-yw4l"><?php echo $average[0]['position'] ?></th>
                              
							 </tr>
					<?php endforeach; ?>
					
					<tr>
								<th class="tg-yw4l" rowspan="12">Subject Average</th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'ENGLISH' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'WRITING' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'MATHEMATICS' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'BIOLOGY' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CIVIC' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'ECONOMICS' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'FRENCH' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'PHYSICS' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CHEMISTRY' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'GEOGRAPHY' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'DATA' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'FURTHER' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'FOOD' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'GOVERNMENT' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'LITERATURE' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'HISTORY' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'TOURISM' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'ART' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'COMMERCE' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'COMPUTER' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'AGRIC' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'DRAWING' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CRS' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'IRS' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"></th>
								<th class="tg-yw4l" rowspan="2"></th>
								<th class="tg-yw4l" rowspan="2"></th>
							</tr>
				</tbody>
			</table>
          </div>
     </div>
          <!-- Junior Secondary -->
          	
		<?php }else if (strpos($class_type, 'junior secondary') !== false || strpos($class_type, 'jss') !== false){ ?>
			<table cellpadding="0" cellspacing="0" border="0" class="tg" style="width: 100%;display: inline-block;vertical-align: top;    overflow: auto;">
                    <thead>
						<tr>
							<th class="tg-yw4l" rowspan="12">NAMES</th>
							<th class="tg-yw4l" rowspan="2">ENG</th>
							<th class="tg-yw4l" rowspan="2">CRW</th>
							<th class="tg-yw4l" rowspan="2">MTH</th>
							<th class="tg-yw4l" rowspan="2">BAS</th>
							<th class="tg-yw4l" rowspan="2">PHE</th>
							<th class="tg-yw4l" rowspan="2">BAT</th>
							<th class="tg-yw4l" rowspan="2">CPS</th>
							<th class="tg-yw4l" rowspan="2">LIS</th>
							<th class="tg-yw4l" rowspan="2">HOE</th>
							<th class="tg-yw4l" rowspan="2">AGS</th>
							<th class="tg-yw4l" rowspan="2">CVE</th>
							<th class="tg-yw4l" rowspan="2">SOS</th>
							<th class="tg-yw4l" rowspan="2">SEC</th>
							<th class="tg-yw4l" rowspan="2">CRS</th>
							<th class="tg-yw4l" rowspan="2">IRS</th>
							<th class="tg-yw4l" rowspan="2">CCA</th>
							<th class="tg-yw4l" rowspan="2">FRH</th>
							<th class="tg-yw4l" rowspan="2">BSS</th>
							<th class="tg-yw4l" rowspan="2">HSA</th>
							<th class="tg-yw4l" rowspan="2">HIS</th>
							<th class="tg-yw4l" rowspan="2">TOT</th>
							<th class="tg-yw4l" rowspan="2">AVG</th>
							<th class="tg-yw4l" rowspan="2">POS</th>
						</tr>
						
                    </thead>
                    <tbody>
		
					
				<?php
					if ($class_id > 19 && $class_id < 23 ){
						$this->db->distinct();
						$this->db->select('student_id')
			    				->from('mark0')
			    				->where('class_id', 20)
			    				->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 21)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud1 = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 22)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud2 = $query->result_array();

						$stud	=	array_merge($querystud,$querystud1,$querystud2);
						
					 }
					 elseif ($class_id > 22 && $class_id < 26 ){
						$this->db->distinct();
						$this->db->select('student_id')
			    				->from('mark0')
			    				->where('class_id', 23)
			    				->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 24)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud1 = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 25)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud2 = $query->result_array();

						$stud	=	array_merge($querystud,$querystud1,$querystud2);
					 }
					 elseif ($class_id > 25 && $class_id < 29 ){
						$this->db->distinct();
						$this->db->select('student_id')
			    				->from('mark0')
			    				->where('class_id', 26)
			    				->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 27)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud1 = $query->result_array();
					
						$this->db->distinct();
						$this->db->select('student_id')
								->from('mark0')
								->where('class_id', 28)
								->where('session_year', $sessoin_id);
						$query = $this->db->get();
						$querystud2 = $query->result_array();

						$stud	=	array_merge($querystud,$querystud1,$querystud2);
					 }
					
					foreach($stud as $row2):
						if ($class_id > 19 && $class_id < 23 ){
							$marks1	=	$this->db->get_where('mark0' , array('class_id' => 20, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks2	=	$this->db->get_where('mark0' , array('class_id' => 21, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks3	=	$this->db->get_where('mark0' , array('class_id' => 22, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks = array_merge($marks1,$marks2,$marks3);
						}
						 elseif ($class_id > 22 && $class_id < 26 ){
							$marks1	=	$this->db->get_where('mark0' , array('class_id' => 23, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks2	=	$this->db->get_where('mark0' , array('class_id' => 24, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks3	=	$this->db->get_where('mark0' , array('class_id' => 25, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks = array_merge($marks1,$marks2,$marks3);
						}
						 elseif ($class_id > 25 && $class_id < 29 ){
							$marks1	=	$this->db->get_where('mark0' , array('class_id' => 26, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks2	=	$this->db->get_where('mark0' , array('class_id' => 27, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks3	=	$this->db->get_where('mark0' , array('class_id' => 28, 'student_id' => $row2['student_id'],'exam_id' => $exam_id, 'session_year' => $sessoin_id))->result_array();
							$marks = array_merge($marks1,$marks2,$marks3);
						}
						
						$avgtmk = $this->db->get_where('subavg0',array('exam_id' => $exam_id,'class_id'=>$class_id ,'session_year'=>$sessoin_id))->result_array();
						$student_id = $row2['student_id'];
						
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
						$average	=	$this->db->get_where('average0' , $verify_datas)->result_array();
						
				?>
							<tr>
								<?php $studd = $this->db->get_where('student' , array('student_id' => $row2['student_id']))->result_array();?>
								<td><?php echo $studd[0]['name'].' '.$studd[0]['surname'] ?>	</td>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'ENGLISH' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'WRITING' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'MATHEMATICS' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'BASIC SCIENCE' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'PHYSICAL' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'TECH' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'COMPUTER' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'LIBRARY' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'HOME' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'AGRIC' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CIVIC' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'SOCIAL' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'SECURITY' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CRS' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'IRS' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CULTURAL &' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'FRENCH' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'BUSINESS' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'HAUSA' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php 
								foreach ($marks as $val){
									$subject = $this->db->get_where('subject',array('subject_id' => $val['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'HISTORY' ) !== false){
											echo ($val['ca_marks']+$val['mark_obtained']);
										}
									}
								}
								?></th>
								<th class="tg-yw4l"><?php echo $average[0]['total_score'] ?></th>
								<th class="tg-yw4l"><?php echo $average[0]['total_average'] ?></th>
								<th class="tg-yw4l"><?php echo $average[0]['position'] ?></th>
                              
							</tr>
					<?php endforeach; ?>
					
							<tr>
								<th class="tg-yw4l" rowspan="12">Subject Average</th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'ENGLISH' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'WRITING' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'MATHEMATICS' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'BASIC SCIENCE' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'PHYSICAL' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'TECH' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'COMPUTER' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'LIBRARY' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'HOME' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'AGRIC' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CIVIC' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'SOCIAL' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'SECURITY' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'CRS' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'IRS' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'ART' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'FRENCH' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'BUSINESS' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'HAUSA' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"><?php 
								foreach ($avgtmk as $marks_cal){
									$subject = $this->db->get_where('subject',array('subject_id' => $marks_cal['subject_id']))->result_array();
									foreach ($subject as $subj){
										if (strpos($subj['name'], 'HISTORY' ) !== false){
											echo $marks_cal['subject_average'];
										}
									}
								}
								?></th>
								<th class="tg-yw4l" rowspan="2"></th>
								<th class="tg-yw4l" rowspan="2"></th>
								<th class="tg-yw4l" rowspan="2"></th>
							</tr>
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
			<!-- <a href="<?php //echo base_url();?>index.php?teacher/score_sheet0/<?php //echo $class_id;?>/<?php //echo $exam_id;?>/<?php //echo $sessoin_id;?>" 
				class="btn btn-orange btn-sm btn-icon icon-left" target="_blank">
				<i class="entypo-print"></i><?php //echo get_phrase('mass_report_card');?>
			</a> 
			<a href="<?php echo base_url();?>index.php?teacher/score_sheet0/<?php echo $class_id;?>/<?php echo $exam_id;?>/<?php echo $sessoin_id;?>" 
				class="btn btn-orange btn-sm btn-icon icon-left" target="_blank">
				<i class="entypo-print"></i><?php echo 'Print Score Sheet';?>
			</a>-->
		</center>
	</div>
</div>
</div>
<?php endif;?>




