 <div class="x_panel">

<div class="mail-header">
    <!-- title -->
    <h3 class="mail-title" align="right">
<a href="<?php echo base_url(); ?>index.php?formtutor/message/message_new" class="btn btn-green btn-sm "> <i class="entypo-pencil"></i>
                <?php echo get_phrase('compose_new_message'); ?>
               
            </a>
    </h3>
   
            
	
	</div>

</div>
<div class="x_panel table-responsive">
<table class="table" id="table-2">
                	<thead>
                		<tr>
						<th>Sender</th>
						<th>Message</th>
						<th>Actions</th>
						</tr>
					</thead>
                    <tbody>
					<?php
					$current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
					$this->db->where('sender', $current_user);
					$this->db->or_where('reciever', $current_user);
					$message_threads = $this->db->get('message_thread')->result_array();
					foreach ($message_threads as $row):

                	// defining the user to show
                	if ($row['sender'] == $current_user)
                    $user_to_show = explode('-', $row['reciever']);
                	if ($row['reciever'] == $current_user)
                    $user_to_show = explode('-', $row['sender']);

                $user_to_show_type = $user_to_show[0];
                $user_to_show_id = $user_to_show[1];
                $unread_message_number = $this->crud_model->count_unread_message_of_thread($row['message_thread_code']);
                ?>
					 <tr>
					<td><?php if (isset($current_message_thread_code) && $current_message_thread_code == $row['message_thread_code']) echo 'active'; ?>
                    <a href="<?php echo base_url(); ?>index.php?formtutor/message/message_read/<?php echo $row['message_thread_code']; ?>" style="padding:12px;">
                        <i class="entypo-book"></i>

                        <?php echo $this->db->get_where($user_to_show_type, array($user_to_show_type . '_id' => $user_to_show_id))->row()->name; ?>
						
					 <?php if ($unread_message_number > 0): ?>
                            <span class="badge bg-blue pull-right">
                                <?php echo $unread_message_number; ?> New Message(s)
                            </span>
                        <?php endif; ?></a>
                 
					</td>
					<td><a href="<?php echo base_url(); ?>index.php?formtutor/message/message_read/<?php echo $row['message_thread_code']; ?>"><button type="button" class="btn btn-orange btn-xs"><i class="entypo-mail"></i>Read Message</button></a>
					</td>
					<td>  <a href="<?php echo base_url(); ?>index.php?formtutor/message/message_read/<?php echo $row['message_thread_code']; ?>"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-reply"></i></button></a></td>
					</tr>
		  <?php endforeach; ?>
                    </tbody>
                </table>
				
				<?php if($row['message_thread_code'] == ''):?>
							<div class="alert alert-danger" align="center">No message for you, Please check back later !</div>
							<?php endif;?>
				
 

    <div>
      <!-- SELECT INBOX MESSAGE -->
    </div>
</div>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">
    jQuery(window).load(function ()
    {
        var $ = jQuery;

        $("#table-2").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>"
        });

        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });

        // Highlighted rows
        $("#table-2 tbody input[type=checkbox]").each(function (i, el)
        {
            var $this = $(el),
                    $p = $this.closest('tr');

            $(el).on('change', function ()
            {
                var is_checked = $this.is(':checked');

                $p[is_checked ? 'addClass' : 'removeClass']('highlight');
            });
        });

        // Replace Checboxes
        $(".pagination a").click(function (ev)
        {
            replaceCheckboxes();
        });
    });
</script>