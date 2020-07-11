<div class="col-md-4">
 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_subjects'); ?>
					</div>
					</div>
 <!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'index.php?admin/modify_subject/display' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                         <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo 'Class';?></label>
                              <div class="col-sm-6">
                                   <select name="class_id" class="form-control"  onchange="show_students(this.value)"  style="float:left;" required>
                                        <option value=""><?php echo get_phrase('select_a_class');?></option>
                                             <?php 
                                             $classes = $this->db->get('class')->result_array();
                                             foreach($classes as $row):
                                                  if ($row['class_id'] > 28 && $row['class_id'] < 40){
                                             ?>
                                                       <option value="<?php echo $row['class_id'];?>"
                            					          <?php if ($class_id == $row['class_id']) echo 'selected';?>>
                            				 	     	<?php echo $row['name'];?>
							   		          </option>
						               <?php } endforeach; ?>
                                   </select>
                                </div>
                         </div>
                         
                         <div class="form-group">
                              <label class="col-sm-3 control-label"><?php echo 'Student';?></label>
                              <div class="col-sm-6">
                                   <?php 
                                   $classes	=	$this->crud_model->get_classes(); 
                                   foreach($classes as $row): ?>
                                        <select name="<?php if($class_id == $row['class_id'])echo 'student_id';else echo 'temp';?>" 
                                             id="student_id_<?php echo $row['class_id'];?>" 
                                               style="display:<?php if($class_id == $row['class_id'])echo 'block';else echo 'none';?>;" class="form-control"  style="float:left;" required>

                                             <option value="">Students of class <?php echo $row['name'];?></option>
                                                  
                                             <?php 
                                             $students	=	$this->crud_model->get_students($row['class_id']); 
                                             foreach($students as $row2): ?>
                                                  <option class="student_id" value="<?php echo $row2['student_id'];?>"
                                                  <?php if(isset($student_id) && $student_id == $row2['student_id'])
                                                     echo 'selected="selected"';?>><?php echo $row2['name'].' '.$row2['surname'];?>
                                                  </option>
                                             <?php endforeach;?>
                                   </select>
                                   <?php endforeach;?>
                                   <select name="temp" id="student_id_0" 
                                   style="display:<?php if(isset($student_id) && $student_id >0)echo 'none';else echo 'block';?>;" class="form-control" style="float:left;" required>
                                   <option value="">Select a class first</option>
                                   </select>
                              </div>
                         </div>
                              <div class="form-group">
                                   <div class="col-sm-offset-3 col-sm-5">
                                       <button type="submit" class=" btn-sm btn btn-blue"><i class="entypo-book"></i><?php echo get_phrase('get_subjects');?></button>
                                   </div>
						</div>
                    </form>
                </div>                
			</div>
               <!----CREATION FORM ENDS-->
               <?php echo form_close(); ?>
               
               <?php //echo $class_id, '____', $student_id?>

               <?php if ($class_id > 0 && $student_id > 0): ?>
               
               
<div class="col-md-8">
     <div class="x_panel table-responsive">
            
          <div class="x_title">
               <div class="panel-title">
				<?php echo get_phrase('list_subjects'); ?>
			</div>
		</div>
          
          
          <table class="table" id="table_export">
               <thead>
                    <tr>
                         <th><div><?php echo get_phrase('subject_name');?></div></th>
                         <th><div><?php echo get_phrase('teacher');?></div></th>
                         <th><div><?php echo get_phrase('modify');?></div></th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                    $subject = $this->db->get_where('class_subject', array('student_id' => $student_id))->result_array();
                    foreach($subject as $rows):
                         $subject = $this->db->get_where('subject', array('subject_id' => $rows['subject_id']))->result_array();
                         $teachers = $this->db->get_where('teacher', array('teacher_id' => $rows['teacher_id']))->result_array();
                    ?>
                         <tr>
                             <td><?php echo $subject[0]['name'];?></td>
                             <td><?php echo $teachers[0]['name'];?></td>
                             <td>
						     <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_modify_subject/<?php echo $rows['subject_id'];?>/<?php echo $class_id;?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
						     <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/modify_subject/delete/<?php echo $rows['subject_id'];?>/<?php echo $class_id;?>/<?php echo $student_id;?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
						</td>
                         </tr>
                    <?php endforeach;?>

               </tbody>
          </table>
          <?php endif; ?>
     </div>
</div>
            <!----TABLE LISTING ENDS--->
 
			          
<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
     function show_students(class_id)
  {
      for(i=0;i<=50;i++)
      {

          try
          {
              document.getElementById('student_id_'+i).style.display = 'none' ;
	  		  document.getElementById('student_id_'+i).setAttribute("name" , "temp");
          }
          catch(err){}
      }
      if (class_id == "") {
        class_id = "0";
      }
      document.getElementById('student_id_'+class_id).style.display = 'block' ;
	  document.getElementById('student_id_'+class_id).setAttribute("name" , "student_id");
      var student_id = $(".student_id");
      for(var i = 0; i < student_id.length; i++)
        student_id[i].selected = "";
  }
</script>
