<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_/_add_help_links'); ?>
					</div>
					</div>
<div class="table-responsive">
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab">
					<?php echo get_phrase('link_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab">
					<?php echo get_phrase('add_link');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
        
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
<table class="table table-bordered table-striped datatable" id="table-2">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('title');?></div></th>
                    		<th><div><?php echo get_phrase('link');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($help_links as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['title'];?></td>
							<td><?php echo $row['link'];?></td>
							<td>
							
							<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_help_link/<?php echo $row['helplink_id'];?>');">
                           <button type="button" class="btn btn-xs btn-green"> <i class="entypo-pencil"></i></button></a>
                        
                   <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?teacher/help_link/delete/<?php echo $row['helplink_id'];?>');"><button type="button" class="btn btn-xs btn-red"> <i class="entypo-cancel"></i></button></a>
                    
                            
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?teacher/help_link/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                                <div class="col-sm-5">
                                    <input name="title" type="text" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('link');?></label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="link"/>
                                </div>
                            </div>
							
							
							 <div class="form-group">
                        <label for="field-ta" class="col-sm-3 control-label"><?php echo get_phrase('class'); ?></label>

                        <div class="col-sm-5">
                            <select name="class_id" class="form-control">
                                <option value=""><?php echo get_phrase('select_class'); ?></option>
                                <?php $classes = $this->db->get_where('class', array('teacher_id' => $this->session->userdata('login_user_id')))->result_array();
foreach ($classes as $row):
    ?>
                                        <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                            
                           <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-plus"></i><?php echo get_phrase('add_link');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
		</div>
	</div>
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