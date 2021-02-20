$teach_id = $this->db->get_where('class', array('class_id'=>$class_id))->result_array();
$teach_sign = $this->db->get_where('teacher', array('teacher_id'=>$teach_id[0]['teacher_id']))->result_array();
$head_sign = $this->db->get_where('head', array('section'=>'Secondary'))->result_array();


style="display:block; margin:auto; padding:auto" src="uploads/signature/<?php echo $teach_sign[0]['teacher_id'] . '.' . 'jpg';?>
style="display:block; margin:auto; padding:auto" src="uploads/signature/<?php echo $head_sign[0]['head_id'] . '.' . 'jpg';?>