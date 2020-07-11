 <div class="x_panel">
<div class="mail-header" style="padding-bottom: 15px ;">
    <!-- title -->
  <div class="x_title">
                <div class="panel-title">
                    <?php echo get_phrase('write_new_message'); ?>
                </div>
            </div>
			<a href="<?php echo base_url(); ?>index.php?accountant/message" class="btn btn-blue btn-sm ">
                <?php echo get_phrase('back_to_inbox'); ?>
                <i class="entypo-back"></i>
            </a>
  
</div>

<div class="mail-compose">

    <?php echo form_open(base_url() . 'index.php?accountant/message/send_new/', array('class' => 'form', 'enctype' => 'multipart/form-data')); ?>


    <div class="form-group">
        <label for="subject"><?php echo get_phrase('select_message_destination'); ?>:</label>
        <br><br>
           <select class="form-control select2" name="reciever" required>

            <option value=""><?php echo get_phrase('select_a_user'); ?></option>
            <optgroup label="<?php echo get_phrase('admin'); ?>">
                <?php
                $admins = $this->db->get('admin')->result_array();
                foreach ($admins as $row):
                    ?>

                    <option value="admin-<?php echo $row['admin_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			
			
			<optgroup label="<?php echo get_phrase('teacher'); ?>">
                <?php
                $teachers = $this->db->get('teacher')->result_array();
                foreach ($teachers as $row):
                    ?>

                    <option value="teacher-<?php echo $row['teacher_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			
            <optgroup label="<?php echo get_phrase('student'); ?>">
                <?php
                $students = $this->db->get('student')->result_array();
                foreach ($students as $row):
                    ?>

                    <option value="student-<?php echo $row['student_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('parent'); ?>">
                <?php
                $parents = $this->db->get('parent')->result_array();
                foreach ($parents as $row):
                    ?>

                    <option value="parent-<?php echo $row['parent_id']; ?>">
                        - <?php echo $row['name']; ?></option>
						
						
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="<?php echo get_phrase('librarian'); ?>">
                <?php
                $librarians = $this->db->get('librarian')->result_array();
                foreach ($librarians as $row):
                    ?>

                    <option value="librarian-<?php echo $row['librarian_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			
			 <optgroup label="<?php echo get_phrase('accountant'); ?>">
                <?php
                $accountants = $this->db->get('accountant')->result_array();
                foreach ($accountants as $row):
                    ?>

                    <option value="accountant-<?php echo $row['accountant_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
			 <optgroup label="<?php echo get_phrase('hostel'); ?>">
                <?php
                $hostels = $this->db->get('hostel')->result_array();
                foreach ($hostels as $row):
                    ?>

                    <option value="hostel-<?php echo $row['hostel_id']; ?>">
                        - <?php echo $row['name']; ?></option>

                <?php endforeach; ?>
            </optgroup>
        </select>
    </div>


    <div class="compose-message-editor">
	
		
	
        <textarea row="5" class="form-control wysihtml5-toolbar" data-stylesheet-url="assets/css/wysihtml5" 
            name="message" placeholder="<?php echo get_phrase('write_new_message'); ?>" 
            id="sample_wysiwyg"></textarea>
    </div>

    <hr>

    <button type="submit" class="btn btn-orange btn-sm btn-icon pull-right">
        <?php echo get_phrase('send_message'); ?>
        <i class="entypo-mail"></i>

    </button>
</form>

</div>
</div>