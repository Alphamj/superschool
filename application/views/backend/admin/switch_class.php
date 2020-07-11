
<div class="x_panel" >
    <div class="x_title">
        <div class="panel-title">
        <?php echo form_open(base_url() . 'index.php?admin/switch_class');?>

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
    

<div class="alert alert-danger" align="center">Please Select Students to Change Class</div>

<?php echo form_open(base_url() . 'index.php?admin/switch_class/update' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>

<div class="form-group">
    <label class="col-md-1"><?php echo get_phrase('session');?></label>
        <div class="col-md-3">
            <select name="session_year" class="form-control" onchange="show_students_session(this.value)">
                        
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
            </select>
        </div>
    <label class="col-md-1"><?php echo get_phrase('from_class');?></label>
        <div class="col-md-3">
            <select name="class_id1" class="form-control" style="width:100%;" required>
            <option value=""><?php echo get_phrase('select_class_first');?></option>
            	<?php 
				$classes = $this->db->get('class')->result_array();
                foreach($classes as $row):
                    if ($row['class_id'] > 28 && $row['class_id'] < 40){
				?>
                    <option value="<?php echo $row['class_id'];?>"
                    <?php if($class_ids == $row['class_id'])echo 'selected';?>>
                    <?php echo $row['name'];?></option>
                    <?php }
				endforeach;
				?>
            </select>
        </div>
    <label class="col-md-1"><?php echo get_phrase('to_class');?></label>
        <div class="col-md-3">
            <select name="class_ids" class="form-control" style="width:100%;" required>
            <option value=""><?php echo get_phrase('select_class_first');?></option>
            	<?php 
				$classes = $this->db->get('class')->result_array();
                foreach($classes as $row):
                    if ($row['class_id'] > 28 && $row['class_id'] < 40){
				?>
                    <option value="<?php echo $row['class_id'];?>"
                    <?php if($class_ids == $row['class_id'])echo 'selected';?>>
                    <?php echo $row['name'];?></option>
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

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-5">
        <button type="submit" class=" btn-sm btn btn-blue"><i class="entypo-book"></i><?php echo get_phrase('update_info');?></button>
        <?php echo form_close();?>
    </div>
</div>


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
