	<button type="button" name="b_print" class="btn btn-xs btn-orange" onClick="printdiv('div_print');"><i class="entypo-print"></i></button>	

<div  id="div_print" >
            
            <!----TABLE LISTING STARTS-->

					<?php 
					$toggle = true;
					$classes = $this->db->get_where('class', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
					foreach($classes as $row):
						?>
					<div class="x_panel" >
            
                	<div class="x_title">
                    <div class="panel-title">
					<?php echo get_phrase('class_name'); ?>:&nbsp;&nbsp; <strong><?php echo $row ['name']; ?></strong>
					</div>
					</div>
                                        <table cellpadding="0" cellspacing="0" border="0"  class="table table-bordered">
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
										</div>

						<?php
					endforeach;
					?>
                            </div>

            <!----TABLE LISTING ENDS-->
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