<div class="col-md-5">
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_help_desk'); ?>
					</div>
					</div>
					<?php echo form_open(base_url() . 'index.php?admin/help_desk/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control"/ required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('purpose');?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="purpose"/ required>
                                </div>
                            </div>
							
							 <div class="form-group">
                                <label class="col-sm-2 control-label"><?php echo get_phrase('content');?></label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control" name="content" required></textarea>
                                </div>
                            </div>
                            
                           <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-plus"></i><?php echo get_phrase('add_link');?></button>
                              </div>
							</div>
							<br>
                    </form>                
					
</div>
</div>

<div class="col-md-7">
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_help_desk'); ?>
					</div>
					</div>
    
    	
<table class=" table " id="table-2">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('name');?></div></th>
                    		<th><div><?php echo get_phrase('purpose');?></div></th>
                    		<th><div><?php echo get_phrase('content');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($help_desk as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['purpose'];?></td>
							<td><?php echo $row['content'];?></td>
							<td>
							 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_help_desk/<?php echo $row['helpdesk_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							 <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/help_desk/delete/<?php echo $row['helpdesk_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>
							
                           
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
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