 <div class="x_panel">
 <div class="x_title">
                <div class="panel-title">
                    <?php echo get_phrase('all_messages'); ?>
                </div>
            </div>
<?php
$messages = $this->db->get_where('message', array('message_thread_code' => $current_message_thread_code))->result_array();
foreach ($messages as $row):

    $sender = explode('-', $row['sender']);
    $sender_account_type = $sender[0];
    $sender_id = $sender[1];
    ?>
    <div class="mail-info">
        <div class="mail-sender " style="padding:5px;">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo $this->crud_model->get_image_url($sender_account_type, $sender_id); ?>" class="img-circle" width="30" height="30"> 
                <span><?php echo $this->db->get_where($sender_account_type, array($sender_account_type . '_id' => $sender_id))->row()->name; ?></span>
            </a>
			 <span class="label label-success pull-right"><?php echo date("d M, Y", $row['timestamp']); ?></span> 
        </div>
    </div>

     <div class="x_panel">	
        <p> <?php echo $row['message']; ?></p>
    </div>

<?php endforeach; ?>

<?php echo form_open(base_url() . 'index.php?teacher/message/send_reply/' . $current_message_thread_code, array('enctype' => 'multipart/form-data')); ?>
<div class="mail-reply">
    <div class="compose-message-editor">
        <textarea row="5" class="form-control wysihtml5" data-stylesheet-url="assets/css/wysihtml5-color.css" name="message" 
                  placeholder="<?php echo get_phrase('reply_message'); ?>" id="sample_wysiwyg"></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-orange btn-sm btn-icon pull-right">
        <i class="entypo-mail"></i> <?php echo get_phrase('send_message'); ?>
       
    </button>
	<a href="<?php echo base_url(); ?>index.php?teacher/message" class="btn btn-blue btn-sm ">
                <?php echo get_phrase('back_to_inbox'); ?>
                <i class="entypo-back"></i>
            </a>
    <br><br>
</div>
</form>
</div>