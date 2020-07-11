 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_enquiries'); ?>
					</div>
					</div>
           &nbsp;&nbsp;&nbsp;&nbsp;
<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_enquiry_setting_add');" 
    class="btn btn-orange btn-xs">
        <i class="entypo-book"></i><?php echo get_phrase('add_category'); ?>
</button>
<div style="clear:both;"></div>
<div class="table-responsive">
			
<table class=" table  datatable" id="table-2">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo get_phrase('category');?></th>
            <th><?php echo get_phrase('purpose');?></th>
            <th><?php echo get_phrase('who_to_visit');?></th>
            <th><?php echo get_phrase('options');?></th>
        </tr>
    </thead>

    <tbody>
        <?php 
                                $enquiry_category	=	$this->db->get('enquiry_category' )->result_array();
                                foreach($enquiry_category as $row):?>
            <tr>
                <td><?php echo $row['enquirycat_id']?></td>
                <td><?php echo $row['category']?></td>
                <td><?php echo $row['purpose']; ?></td>
                <td><?php echo $row['whom']?></td>
                <td>
                    <a  onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_enquiry_setting_edit/<?php echo $row['enquirycat_id']?>');" 
                        class="btn btn-info btn-xs btn-icon icon-left">
                            <i class="entypo-pencil"></i>
                            Edit
                    </a>
                    <a href="<?php echo base_url();?>index.php?admin/enquiry_setting/delete/<?php echo $row['enquirycat_id']?>" 
                        class="btn btn-danger btn-xs btn-icon icon-left" onclick="return confirm('Are you sure to delete?');">
                            <i class="entypo-cancel"></i>
                            Delete
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
