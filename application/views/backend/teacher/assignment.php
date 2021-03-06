<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_assignments'); ?>
					</div>
					</div>
<div class="table-responsive">
<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_assignment_add');" 
    class="btn btn-orange btn-xs">
        <i class="entypo-plus"></i><?php echo get_phrase('add_assignment'); ?>
</button>

<table class="table table-bordered table-striped datatable" id="table-2">
    <thead>
        <tr>
            <th><?php echo get_phrase('date');?></th>
            <th><?php echo get_phrase('title');?></th>
            <th><?php echo get_phrase('description');?></th>
            <th><?php echo get_phrase('class');?></th>
            <th><?php echo get_phrase('download');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
       <?php $a = $this->db->get_where('assignment', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
				 foreach ($a as $row):
				 ?>
            <tr>
                <td><?php echo $row['timestamp']; ?></td>
                <td><?php echo $row['title']?></td>
                <td><?php echo $row['description']?></td>
                <td>
                    <?php $name = $this->db->get_where('class' , array('class_id' => $row['class_id'] ))->row()->name;
                     echo $name;?>
                </td>
                <td> 
                    <?php echo $row['file_name']; ?>
                    <a href="<?php echo base_url().'uploads/assignment/'.$row['file_name']; ?>" class="btn btn-green btn-xs">
                        <i class="entypo-download"></i>
                    </a>
                </td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_assignment_edit/<?php echo $row['assignment_id']?>');" 
                        class="btn btn-orange btn-xs ">
                            <i class="entypo-pencil"></i>
                    </a>
                    <a href="<?php echo base_url();?>index.php?teacher/assignment/delete/<?php echo $row['assignment_id']?>" 
                        class="btn btn-red btn-xs" onclick="return confirm('Are you sure to delete?');">
                            <i class="entypo-cancel"></i>
                    </a>
                </td>
            </tr>
               <?php endforeach;?>
    </tbody>
</table>
</div>
</div>


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