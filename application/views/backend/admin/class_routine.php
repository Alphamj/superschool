	 <a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_timetable_add/');" 
            	 class="btn btn-xs btn-blue btn-icon icon-left">
        <i class="entypo-plus"></i>
		<?php echo get_phrase('add_time_table');?>
		</a>
	<button type="button" name="b_print" class="btn btn-xs btn-green" onClick="printdiv('div_print');"><i class="entypo-print"></i></button>										

 <div class="x_panel" id="div_print">
       <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_time_table'); ?>
					</div>
					</div>
                	<?php 
					$toggle = true;
					$classes = $this->db->get('class')->result_array();
					foreach($classes as $row):
						?>
                             <div class="x_panel" >
                              <i class="entypo-book"></i> Class <?php echo $row['name'];?>
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
														$this->db->where('class_id' , $row['class_id']);
														$routines	=	$this->db->get('class_routine')->result_array();
														foreach($routines as $row2):
														?>
														<span class="btn btn-white btn-xs">
											 <?php echo $this->crud_model->get_subject_name_by_id($row2['subject_id']);?>
											   <?php
                                               if ($row2['time_start_min'] == 0 && $row2['time_end_min'] == 0) 
                                               echo '('.$row2['time_start'].'&#8594;'.$row2['time_end'].')';
                                               if ($row2['time_start_min'] != 0 || $row2['time_end_min'] != 0)
                                               echo '('.$row2['time_start'].':'.$row2['time_start_min'].'&#8594;'.$row2['time_end'].':'.$row2['time_end_min'].')';
											   echo '<br>'.'hall:'.$row2['room'];
											   ?>
												
												<br><a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_class_routine/<?php echo $row2['class_routine_id'];?>');"><button type="button" class="btn btn-orange btn-xs"><i class="entypo-pencil"></i></button></a>
												 
												 
												 <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/class_routine/delete/<?php echo $row2['class_routine_id'];?>');"><button type="button" class="btn btn-danger btn-xs"><i class="entypo-trash"></i></button></a>
												 
</span>																										
														<?php endforeach;?>

                                                    </td>
                                                </tr>
                                                <?php endfor;?>
                                                
                                            </tbody>
                                        </table>
										                                        
                                    </div>
								<hr style="color: #FF9933">
						<?php
					endforeach;
					?>
  				</div>
			
            <!----TABLE LISTING ENDS--->
            



<script type="text/javascript">
    function get_class_subject(class_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_class_subject/' + class_id ,
            success: function(response)
            {
                jQuery('#subject_selection_holder').html(response);
            }
        });
    }
</script>



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

