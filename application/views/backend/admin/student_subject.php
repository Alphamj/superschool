
<div class="x_panel" >
    <div class="x_title">
        <div class="panel-title">
        <?php echo form_open(base_url() . 'index.php?admin/student_subject');?>

        <?php echo get_phrase('get_students'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <select name="class_id" class="form-control" onchange='this.form.submit()' required>
                <option value=""><?php echo get_phrase('select_class_first');?></option>
                    <?php 
                        $classes = $this->db->get('class')->result_array();
                        foreach($classes as $row):
                            if ($row['class_id'] > 28 && $row['class_id'] < 40){
                            ?>
                            <option value="<?php echo $row['class_id'];?>" <?php if ($class_id != ''){ if ($class_id == $row['class_id']){ echo "selected";}} ?>>
                                <?php $class_name = $row['name'];?>
                                <?php echo $class_name;?>
                            </option>
                            <?php }
                        endforeach;
                        ?>
            </select>
        </div>
    </div> 

    <input type="hidden" name="operation" value="selection">

    <noscript><button type="submit" class="btn btn-green btn-icon icon-left"><i class="entypo-search"></i><?php echo get_phrase('get_student_list');?></button></noscript>
    <?php echo form_close();?>
</div>
    

<div class="alert alert-danger" align="center">Please Select Students to Matching Subjects</div>

<?php echo form_open(base_url() . 'index.php?admin/student_subject/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

<div class="form-group">
    <label class="col-sm-3 control-label"><?php echo get_phrase('class');?></label>
        <div class="col-sm-6">
            <select name="class_ids" class="form-control" style="width:100%;" required>
            <option value=""><?php echo get_phrase('select_class_first');?></option>
            	<?php 
				$classes = $this->db->get('class')->result_array();
                foreach($classes as $row):
                    if ($row['class_id'] > 28 && $row['class_id'] < 40){
				?>
            		<option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                    <?php }
				endforeach;
				?>
            </select>
        </div>
</div>

<br />

<div class="col-md-4">
    <div class="x_panel table-responsive">
        <div class="x_title">
            <div class="panel-title">
                <?php echo get_phrase('list_students'); ?>
            </div>
        </div>
        <?php if($class_id == ''){} ?>
        <?php if($class_id != ''){ ?>
        <table class="table">
            <thead>
                <tr>
                    <th><div><?php echo get_phrase('check');?></div></th>
                    <th><div><?php echo get_phrase('student_name');?></div></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $quary = $this->db->get_where('student', array( 'class_id' => $class_id));
                $student = $quary->result_array();
                foreach($student as $rows):
                     
                ?>
                <tr>
                           <td><input class="custom-select-option-checkbox" type="checkbox" name="student_ids[]" value="<?php echo $rows['student_id'];?>"></td>
                           <td><?php echo $rows['name'] . ' ' . $rows['surname'];?></td>
                           
                           
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <?php } ?>
    </div>
</div>
        
        <!----TABLE LISTING ENDS--->

<div class="col-md-8">
    <div class="x_panel table-responsive">
        <div class="x_title">
            <div class="panel-title">
            <?php echo get_phrase('list_subjects'); ?>
            </div>
        </div>

        <?php //echo form_open(base_url() . 'index.php?admin/student_subject/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
        <?php if($class_id == ''){} ?>
        <?php if($class_id > 0){ ?>
        <table class="table" id="table_export">
            <thead>
                <tr>
                    <th><div><?php echo get_phrase('check');?></div></th>
                    <th><div><?php echo get_phrase('subject_name');?></div></th>
                    <th><div><?php echo get_phrase('teacher');?></div></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $subject = $this->db->get('subject')->result_array();
                foreach($subject as $rows):
                     $teachers = $this->db->get_where('teacher', array('teacher_id' => $rows['teacher_id']))->result_array();
                ?>
                <tr>
                    <td><input class="custom-select-option-checkbox" type="checkbox" name="subject_ids[]" value="<?php echo $rows['subject_id'];?>"></td>
                    <td><?php echo $rows['name'];?></td>
                    <td><?php echo $teachers[0]['name'];?></td>
                </tr>
                
                <?php endforeach;?>

            </tbody>
            
        </table>
        
        
        <?php } ?>
    </div>
</div>
        <!----TABLE LISTING ENDS--->

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
        <button type="submit" class=" btn-sm btn btn-blue"><i class="entypo-book"></i><?php echo get_phrase('add_subject');?></button>
        <?php echo form_close();?>
    </div>
</div>

            <!-- TEACHERS IDS CORRECTION FOR STUDENTS SUBJECTS -->
<?php 
$student_subject = $this->db->get('class_subject')->result_array();
foreach($student_subject as $item):
    $sub_teacher_id = $this->db->get_where('subject',array('subject_id' => $item['subject_id']))->result_array();

    $data['teacher_id'] = $sub_teacher_id[0]['teacher_id'];
    $this->db->where('subject_id', $item['subject_id']);
    $this->db->update('class_subject', $data);
endforeach;
?>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

 jQuery(document).ready(function($)
 {
      

      var datatable = $("#table_export").dataTable();
      
      $(".dataTables_wrapper select").select2({
           minimumResultsForSearch: -1
      });
 });
      
</script>
