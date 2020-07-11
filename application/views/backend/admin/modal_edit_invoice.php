<?php 
$edit_data		=	$this->db->get_where('invoice' , array('invoice_id' => $param2) )->result_array();
?>

<div class="tab-pane box active" id="edit" style="padding: 5px">
    <div class="box-content">
        <?php foreach($edit_data as $row):?>
            <?php $exam = $row['exam_id']; 
                    $secti = $row['session_year'];?>
        <?php echo form_open(base_url() . 'index.php?admin/invoice/do_update/'.$row['invoice_id'], array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('student');?></label>
                    <div class="col-sm-5">
                        <select name="student_id" class="form-control" style="width:400px;" >
                            <?php 
                            $this->db->order_by('class_id','asc');
                            $students = $this->db->get('student')->result_array();
                            foreach($students as $row2):
                            ?>
                                <option value="<?php echo $row2['student_id'];?>"
                                    <?php if($row['student_id']==$row2['student_id'])echo 'selected';?>>
                                    class <?php echo $this->crud_model->get_class_name($row2['class_id']);?> -
                                    roll <?php echo $row2['roll'];?> -
                                    <?php echo $row2['name'];?>
                                </option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="title" value="<?php echo $row['title'];?>" readonly="true"/>
                    </div>
                </div>
                <?php $get_system_settings	=	$this->crud_model->get_system_settings();?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('session');?></label>
                    <div class="col-sm-5">
                    <input type="text" class="datepicker form-control" name="date" 
                            value="<?php echo $secti;?>" readonly="true"/>
                    </div>
                </div>
                <div class="form-group"><?php echo $term[0]['name'];?>
                    <label class="col-sm-3 control-label"><?php echo get_phrase('term');?></label>
                    <div class="col-sm-5">
                        <?php $term = $this->db->get_where('exam', array('exam_id' => $exam))->result_array(); ?>
                        <input type="text" class="datepicker form-control" name="date" 
                            value="<?php echo $term[0]['name'];?>" readonly="true"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('status');?></label>
                    <div class="col-sm-5">
                        <select name="status" class="form-control">
                            <option value="unpaid" <?php if($row['status']=='unpaid')echo 'selected';?>><?php echo get_phrase('unpaid');?></option>
                            <option value="part payment" <?php if($row['status']=='part payment')echo 'selected';?>><?php echo get_phrase('part_payment');?></option>
                            <option value="paid" <?php if($row['status']=='paid')echo 'selected';?>><?php echo get_phrase('paid');?></option>
                        </select>
                    </div>
                </div>
               
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-5">
                      <button type="submit" class="btn btn-blue"><i class="entypo-book"></i><?php echo get_phrase('save_now');?></button>
                  </div>
                </div>
        </form>
        <?php endforeach;?>
    </div>
</div>