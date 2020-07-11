 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('exam_subject'); ?>
					</div>
					</div>
            <!----TABLE LISTING STARTS-->
            
                            <div class="panel-body table-responsive">
                                <div class="form-group">
						<h4>
						<div align="center">
								<div class="alert alert-success">
								Exam Date:
                                    <?php
                                    date_default_timezone_set('Asia/Hong_Kong');
                                   echo date('Y.m.d');
                                    ?>
									</div>
									</div>
									</h4>
                                </div>
<hr style="color:#FF0000">
                                <div class="form-group">
                                    <?php
                                    foreach ($subject_list as $row):
                                        if ($row['result_count'] > 0) {
                                            ?>
                                            <button class="btn btn-primary disabled">
                                                <?php echo $row['subject']; ?>(<?php echo $row['session']; ?>) | <?php echo $row['marks']; ?> / <?php echo $row['question_count'];
                                                ?>
                                            </button>
                                            <?php
                                        } else {
                                            ?>
                                            <button class="btn btn-success" onclick="location.href = '<?php echo base_url(); ?>index.php?student/exam/second/<?php echo $row['subject_id']; ?>/<?php echo $row['session']; ?>';">
                                                <?php echo $row['subject']; ?>(<?php echo $row['session']; ?>)
                                            </button>
                                            <?php
                                        }
                                    endforeach;
                                    ?>
<hr>
<?php if($row['subject'] != ''):?>
<div class="alert alert-default"><p style="color:#FF0000" align="center">Please read these instructions carefully. Any candidate who breaches the Examination Regulations will be liable to disciplinary action not limited to suspension or expulsion from the school.</p><br>

<p><b>Timings</b></p>
<li>Examinations will be conducted during the allocated times shown in the examination timetable.</li><br>

<li>The examination hall will be open for admission 30 minutes before the time scheduled for the commencement of the examination. You are to find your allocated seat but do NOT turn over the question paper until instructed at the time of commencement of the examination.</li>

<li>You will not be admitted for the examination after one hour of the commencement of the examination.</li><br>

<b>Personal Belongings</b>
   
    <li>All your personal belongings (such as bags, pouches, ear/headphones, laptops etc.) must be placed at the designated area outside the examination hall. Please do not bring any valuable belongings except the essential materials required for the examinations.  </li>   
               
<li>Any unauthorised materials, such as books, paper, documents, pictures and electronic devices with communication and/or storage capabilities such as tablet PC, laptop, smart watch, portable audio/video/gaming devices etc. are not to be brought into the examination hall.</li>


<li>Hand phones brought into the examination hall must be switched off at ALL times. If your hand phone is found to be switched on in the examination hall, the handphone will be confiscated and retained for investigation of possible violation of regulations.</li>

<li>Photography is NOT allowed in the examination hall at ALL times.</li>

<li>All materials and/or devices which are found in violation of any examination regulations will be confiscated.</li>
<li>The University will not be responsible for the loss or damage of any belongings in or outside the examination hall.</li><br>

<b>At the Start of the Examination</b>

<li>Please place your identification documents (such as matric card, identity card, passport, driving licence) at the top right corner of your examination desk for the marking of attendance and verification of identity during the examination.</li><br>

<b>During Examination</b>

<li>You are not allowed to communicate by word of mouth or otherwise with other candidates (this includes the time when answer scripts are being collected).</li>

<li>Please raise your hand if you wish to communicate with an invigilator.</li>

<li>Unless granted permission by an invigilator, you are not allowed to leave your seat.</li>
<li>Once you have entered the examination hall, you will not be allowed to leave the hall until one hour after the examination has commenced.
    If, for any reason, you are given permission to leave the hall temporarily, you must be accompanied by an invigilator throughout your absence from the examination hall. You are required to leave your hand phone on your desk when you leave the hall temporarily.</li>
<li>All answers, with the exception of graphs, sketches, diagrams, etc. should be written in black or blue pen, unless otherwise specified. Answers written in pencil will not be marked. The blank pages in the answer book are to be used only for candidates' rough work. Solutions or any other materials written on these blank pages will not be marked.</li>
<li>Do not write on, mark, highlight or deface any reference materials provided for the examination. If found doing so, the reference materials will be removed from your use for the rest of the examination and you will be made to pay for the cost of the materials that have to be replaced.</li><br>

<b>At the End of the Examination</b>
<li>You are NOT allowed to leave the examination hall during the last 15 minutes of the examination and during the collection of the answer scripts. All candidates must remain seated throughout this period for invigilators to properly account for all answer scripts to be collected.</li>
<li>Do NOT continue to write after the examination has ended. You are to remain seated quietly while your answer scripts are being collected and counted.</li>
<li>No papers, used or unused, may be removed from the examination hall. You may take your own question paper with you unless otherwise instructed.</li>
<li>You are to stay in the examination hall until the Chief Invigilator has given the permission to leave. Do NOT talk until you are outside of the examination hall.</li>
<li>You are responsible to ensure that your answer scripts are submitted at the end of the examination. If you are present for the examination and do not submit your answer script, you will be deemed to have sat for and failed the examination concerned. Any unauthorized removal of answer script or part of answer script from the examination hall would deem the answer script as null and void.</li>
<li>Once dismissed, you should leave the examination hall quickly and quietly. Remember to take your personal belongings with you.</li>

</div>
<?php endif;?>

</div>
<!----TABLE LISTING ENDS--->
</div>
</div>

<?php if($row['subject'] == ''):?>
							<div class="alert alert-danger" align="center">No Exam Set For Your Class Yet !</div>
							<?php endif;?>