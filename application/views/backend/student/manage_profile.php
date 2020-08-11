<?php 
                    foreach($edit_data as $row):
                        ?>
						<button type="button" name="b_print" class="btn btn-xs btn-orange" onClick="printdiv('div_print');"><i class="entypo-print"></i></button>

<!--<button type="button" class="btn btn-green btn-xs" disabled="disabled">Login Details:&nbsp;Email:&nbsp;<?php echo $row ['email'];?>&nbsp;and&nbsp;Password:&nbsp;<?php echo $row ['password'];?></button>-->

<!--<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_profile_update/<?php echo $row['student_id'];?>/');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i><?php echo get_phrase('update_details'); ?></button></a>-->

<?php endforeach ;?>

	
 <div class="x_panel" id="div_print">
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('my_profile'); ?>
					 
					</div>
					</div>
					

					<?php 
                    foreach($edit_data as $row):
                        ?>
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
<a href="#" onclick="showAjaxModal('<?php echo base_url(); ?>index.php?modal/popup/modal_student_book_view/<?php echo $row['student_id']; ?>');"><button type="button" class="btn  btn-orange btn-xs"><i class="entypo-book"></i>View</button></a>							<table class="table">
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
<?php endforeach; ?>	
					
					
					
</div>




<div class="col-md-6">
 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('my_profile'); ?>
					</div>
					</div>

					<?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url() . 'index.php?student/manage_profile/update_profile_info' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top' , 'enctype' => 'multipart/form-data'));?>
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" readonly/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                            <!--
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label"><?php //echo get_phrase('photo');?></label>
                                
                                <div class="col-sm-5">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;" data-trigger="fileinput">
                                            <img src="<?php //echo $this->crud_model->get_image_url('student' , $row['student_id']);?>" alt="..." >
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="userfile" accept="image/*">
                                            </span>
                                            <a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    -->
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-green btn-sm"><i class="entypo-plus"></i><?php echo get_phrase('update_profile');?></button>
                                </div>
							</div>
							<br>
                        </form>
						<?php
                    endforeach;
                    ?>
                </div>
			</div>
            <!--EDITING FORM ENDS-->



<!--password-->
<div class="col-md-6">

 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('change_password'); ?>
					</div>
					</div>

					<?php 
                    foreach($edit_data as $row):
                        ?>
                        <?php echo form_open(base_url() . 'index.php?student/manage_profile/change_password' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('current_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('confirm_new_password');?></label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="confirm_new_password" value=""/>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-green btn-sm"><i class="entypo-plus"></i><?php echo get_phrase('update_profile');?></button>
                              </div>
								</div>
								<br>
                        </form>
						<?php
                    endforeach;
                    ?>
                </div>
			</div>
            <!----EDITING FORM ENDS-->
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