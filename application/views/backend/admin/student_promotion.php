<?php 
    $active_sms_service = $this->db->get_where('settings' , array('type' => 'active_sms_service'))->row()->description;
    
?>

<div class="x_panel" >
   <div class="x_title">
        <div class="panel-title">
			<?php echo get_phrase('student_promotion_page'); ?>
		</div>
	</div>
<form method="post" action="<?php echo base_url();?>index.php?admin/student_promotion" class="form">
<div class="row">
    <div class="col-sm-3 form-group" style="margin-top: 15px;">
        <label class="control-label" style="margin-bottom: 5px;">Current Session</label>
        <select name="running_year" class="form-control selectboxit " required>
            <option>
                <?php
                    $year = date('Y') - 2;
                    $next_year = $year + 1;
                    $running_year = $year."-".$next_year;
                    echo $running_year;
                ?>
            </option>
        </select>
    </div>

    <div class="col-sm-3 form-group" style="margin-top: 15px;">
        <label class="control-label" style="margin-bottom: 5px;">Promote To Session</label>
        <select name="next_running_year" class="form-control selectboxit" required>
            <option>
                <?php
                    $year_after_year = $next_year + 1;
                    $next_running_year = $next_year."-".$year_after_year;
                    echo $next_running_year;
                ?>
            </option>
        </select>
    </div>

    <div class="col-sm-3 form-group" style="margin-top: 15px;">
        <label class="control-label" style="margin-bottom: 5px;">Promotion From Class</label>
        <select name="from_class" class="form-control selectboxit" required> 
            <option value="">select</option>
            <?php 
            $classes    =   $this->db->get('class')->result_array();
            foreach($classes as $row):?>
            <option value="<?php echo $row['class_id'];?>"
                    <?php if(isset($from_class) && $from_class==$row['class_id'])echo 'selected="selected"';?> style="display:none;">
                    <?php echo $row['name'];?>
            </option>
            <?php endforeach;?>
        </select>
    </div>
     <!-- added on 28 may 2018 sandeep -->
	<!--<div class="col-sm-3 form-group" style="margin-top: 15px;">
        <label class="control-label" style="margin-bottom: 5px;">Promotion From Section</label>
        <select name="from_section" class="form-control selectboxit" required> 
            <option value="">select</option>
            <?php 
            /*$sections    =   $this->db->get('section')->result_array();
            foreach($sections as $row1):?>
            <option value="<?php echo $row1['section_id'];?>"
                    <?php if(isset($from_section) && $from_section==$row1['section_id'])echo 'selected="selected"';?> style="display:none;">
                    <?php echo $row1['name'];?>
            </option>
            <?php endforeach; */?>
        </select>
    </div>-->
    <div class="col-sm-3 form-group" style="margin-top: 15px;">
        <label class="control-label" style="margin-bottom: 5px;">Promotion To Class</label>
        <select name="to_class" class="form-control selectboxit" required>
            <option value="">select</option>
            <?php 
            $classes    =   $this->db->get('class')->result_array();
            foreach($classes as $row):?>
            <option value="<?php echo $row['class_id'];?>"
                    <?php if(isset($to_class) && $to_class==$row['class_id'])echo 'selected="selected"';?> style="display:none;">
                    <?php echo $row['name'];?>
            </option>
            <?php endforeach;?>
        </select>
    </div>
     <!-- added on 28 may 2018 sandeep -->
	<!--<div class="col-sm-3 form-group" style="margin-top: 15px;">
        <label class="control-label" style="margin-bottom: 5px;">Promotion To Section</label>
        <select name="to_section" class="form-control selectboxit" required> 
            <option value="">select</option>
            <?php 
          /*  $sections1    =   $this->db->get('section')->result_array();
            foreach($sections1 as $row11):?>
            <option value="<?php echo $row11['section_id'];?>"
                    <?php if(isset($to_section) && $to_section==$row11['section_id'])echo 'selected="selected"';?> style="display:none;">
                    <?php echo $row11['name'];?>
            </option>
            <?php endforeach;*/?>
        </select>
    </div>-->
    <center>
        <button type="submit" style="margin:10px;" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-search"></i>List Student</button>
    </center>

</div>

<div id="students_for_promotion_holder"></div>

</form>
</div>

<br/>

<?php if($from_class!='' && $to_class!=''):?>

<div class="x_panel" >
<div class="row" style="text-align: center;">
    <div class="col-sm-12"></div>
    <div class="col-sm-12">
            
            <h2 style="color: #696969;">ALL STUDENTS IN <?php
            $classes    =   $this->db->get('class')->result_array();
            foreach ($classes as $row) {
                if(isset($from_class) && $from_class==$row['class_id']) $calss_name = $row['name'];
            } 
            echo $calss_name;?></h2>
    </div>
	</div>
    <div class="col-sm-4"></div>
</div>
<div class="x_panel" >
<form method="post" id="export_contact_form" name="export_contact_form" action="<?php echo base_url();?>index.php?admin/manage_enrollment" class="form">
    <div class="row">
        <div class="col-md-12">
		 <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('manage_promotion'); ?>
					</div>
					</div>
<table class=" table  datatable">
                <thead align="center">
                    <tr>
                        <td align="left"><input name="main_user" type="checkbox" class="noborder1" id="main_user" value="checkbox" />Select All</td>
                        <td align="left">Student Image</td>
                        <td align="left">Student Name</td>
                        <td align="left">Sex</td>
                        <!--<td align="left">Current Section</td>-->
                        <td align="left">Admission No</td>
                        <td align="left">Student Results</td>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php 
                  //change on 28 may 2018 sandeep/
                    $students   =   $this->crud_model->get_students($from_class);
                    foreach($students as $rowz){
                        if ($to_class > 28 && $to_class < 38){
                         $data['class_id'] = $to_class;

                        $this->db->where('student_id', $rowz['student_id']);
                        $this->db->update('class_subject', $data);
                        }
                    }
                  //  $students   =   $this->crud_model->get_students_section($from_class,$from_section);
                    foreach($students as $row): ?>
                    <tr>
                    <td> <input name="bulk_id[]" type="checkbox" class="noborder"  value="<?php echo $row['student_id'];?>"></td>
                    <td> <img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" style="max-height:30px;margin-right: 30px;"></td>
                    <td align="left" name="enroll_<?php echo $row['student_id'];?>" value="<?php echo $row['student_id'];?>">
                            <?php echo $row['name'].' '.$row['surname'];?>          
                        </td>
			 <td align="left"><?php echo $row['sex'];?></td>

                        <!--<td align="left">
                           <?php
                           /* $sections    =   $this->db->get('section')->result_array();
                            foreach ($sections as $row2) {
                                if($row['section_id']==$row2['section_id']) echo $row2['name'];
                            }*/
                            ?>
                        </td>-->
                        <td align="left"><?php echo $row['roll'];?></td>
                        <td align="left">
						
						 <a href="<?php echo base_url(); ?>index.php?admin/student_marksheet_print_view/<?php echo $row['student_id'];?>/<?php echo $from_class;?>" target="_blank">
                         <button  type="button" class="btn btn-xs btn-blue btn-icon icon-left"><i class="entypo-chart-bar"></i>
                         <?php echo get_phrase('view_result'); ?></button>
                         </a>
						 
                       
                        </td>
                       
                    </tr>
                    
                    <?php endforeach;?>
                </tbody>
            </table>
			
			<br>
			 <div class="row">
				  <!-- added on 28 may 2018 sandeep --> 
				 <!--<input type="hidden" name="from_sections" value="<?php //echo $from_section; ?>">
                 <input type="hidden" name="to_sections" value="<?php //echo $to_section; ?>">-->
        <center>
            <input type="text" name="from_class" value="<?php echo $from_class;?>" style="display: none;">
            <input type="text" name="to_classes" value="<?php echo $to_class;?>" style="display: none;">
            <button type="submit" id="promote_btn" class="btn btn-orange btn-sm btn-icon icon-left">
                <i class="entypo-right"></i>Promote Student
            </button>
        </center>
    </div>
        </div>
    </div>
    </div>

   
</form>
<?php endif;?>




<?php if($from_class =='' && $to_class ==''):?>

<div class="x_panel" >

                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_students'); ?>
					</div>
					</div>
<table class=" table  datatable" id="table_export2">
                <thead align="center">
                    <tr>
                        <td align="left">Student Image</td>
                        <td align="left">Student Name</td>
                        <td align="left">Sex</td>
                        <td align="left">Current Section</td>
                        <td align="left">Admission No</td>
                        <td align="left">Student Results</td>
                        <td align="left">Manage Promotion</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $students   =   $this->crud_model->get_students($from_class);
                    foreach($students as $row): ?>
                    
                    <tr>
                    <td> <img src="<?php echo $this->crud_model->get_image_url('student',$row['student_id']);?>" style="max-height:30px;margin-right: 30px;"></td>
                    <td align="left" name="enroll_<?php echo $row['student_id'];?>" value="<?php echo $row['student_id'];?>">
                            <?php echo $row['name'];?>          
                        </td>
			 <td align="left"><?php echo $row['sex'];?></td>

                        <td align="left">
                           <?php
                            $sections    =   $this->db->get('section')->result_array();
                            foreach ($sections as $row2) {
                                if($row['section_id']==$row2['section_id']) echo $row2['name'];
                            }
                            ?>
                        </td>
                        <td align="left"><?php echo $row['roll'];?></td>
                        <td align="left">
						
						 <a href="<?php echo base_url(); ?>index.php?admin/student_marksheet/<?php echo $row['student_id'];?>/<?php echo $from_class;?>" target="_blank">
                         <span class="label label-success"><i class="entypo-chart-bar"></i>
                         <?php echo get_phrase('view_result'); ?></span>
                         </a>
                       
                        </td>
                        <td>
                            <?php 
                            $classes    =   $this->db->get('class')->result_array();
                            foreach ($classes as $row2) {
                                if(isset($from_class) && $from_class==$row2['class_id']) $calss_from = $row2['name'];
                                if(isset($to_class) && $to_class==$row2['class_id']) $calss_to = $row2['name'];
                            }
                            $verify_data    =   array(  'student_id' => $row['student_id'],
                                                        'from_class_id' => $from_class,
                                                        'to_class_id' => $to_class);
                            $query = $this->db->get_where('enroll' , $verify_data);
                            if($query->num_rows() < 1){
                                ?>
                                <select name="to_class_<?php echo $row['student_id'];?>" class="form-control selectboxit">
                                    <option value="<?php echo $to_class;?>">Enroll To Class - <?php echo $calss_to;?></option>
                                    <option value="<?php echo $from_class;?>">Enroll To Class - <?php echo $calss_from;?></option>
                                </select>
                                <?php
                            }
                            else{
                                ?>
                                    <button type="button" class="btn btn-green btn-xs btn-icon icon-left">
                                        <i class="entypo-check"></i> Enrolled Student 
                                    </button>
                                <?php
                            }
                           ?> 
                        </td>
                    </tr>
                    
                    <?php endforeach;?>
                </tbody>
            </table>
			<div class="alert alert-danger" align="center">No Information Selected</div>
			
        </div>
</form>
<?php endif;?>

<script type="text/javascript">

    jQuery(document).ready(function ($)
    {
	$("#main_user").click(function () {
		if($("#main_user").is(":checked")){
			$('.noborder').prop('checked',true);
		}else
			$('.noborder').prop('checked',false);
	});
	$(".noborder").click(function(){
		if($(".noborder").length == $(".noborder:checked").length) {
			$("#main_user").attr("checked", "checked");
		} else {
			$("#main_user").removeAttr("checked");
		}
	});
	
	$("#promote_btn").click(function(event){
		event.preventDefault();
		var flag = false;
		var comments = window.document.export_contact_form.elements.length;
		for(j=0;j<comments;j++) {
			if(window.document.export_contact_form.elements[j].type=="checkbox") {
				if(window.document.export_contact_form.elements[j].checked==true) {
					flag = true;
				}
			}
		}
		if(flag == false) {
			alert("Please select at least one checkbox to promote student");
		} else {
			$("#export_contact_form").submit();
		}
	});
        var datatable = $("#table_export2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    {
                        "sExtends": "xls",
                        "mColumns": [0, 2, 3, 4]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [0, 2, 3, 4]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText": "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(1, false);
                            datatable.fnSetColumnVis(5, false);

                            this.fnPrint(true, oConfig);

                            window.print();

                            $(window).keyup(function (e) {
                                if (e.which == 27) {
                                    datatable.fnSetColumnVis(1, true);
                                    datatable.fnSetColumnVis(5, true);
                                }
                            });
                        },
                    },
                ]
            },
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
        
        
    });

</script>
