<div class="col-md-5">
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_testimony'); ?>
					</div>
					</div>
					
					<?php echo form_open(base_url() . 'index.php?admin/testimony/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                           
						    <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                                <div class="col-sm-9">
                                    <input name="name" type="text" class="form-control"/ required>
                                </div>
                            </div>
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('position');?></label>
                                <div class="col-sm-9">
                                    <input name="position" type="text" class="form-control"/ required>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('content');?></label>
                                <div class="col-sm-9">
									<textarea rows="5" class="form-control" name="content" cols="30"  onKeyPress="return countit(this,30)" placeholder="Enter short contents here. Maximum word is 30"></textarea>
                                </div>
                            </div>
                            
                           <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-orange btn-sm btn-icon icon-left"><i class="fa fa-pencil"></i><?php echo get_phrase('add_testimony');?></button>
                              </div>
							</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
	

<div class="col-md-7">
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_testimony'); ?>
					</div>
					</div>

<table class=" table  datatable" id="table-2">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('name');?></div></th>
                    		<th><div><?php echo get_phrase('position');?></div></th>
                    		<th><div><?php echo get_phrase('content');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($testimony as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
							<td><?php echo $row['position'];?></td>
							<td><?php echo $row['content'];?></td>
							<td>
							
							 <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_testimony/<?php echo $row['testimony_id'];?>');"><button type="button" class="btn btn-blue btn-xs"> <i class="entypo-pencil"></i></button></a>
							 <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/testimony/delete/<?php echo $row['testimony_id'];?>');"> <button type="button" class="btn btn-red btn-xs"> <i class="entypo-trash"></i></button></a>
							 
                          
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
            <!----TABLE LISTING ENDS--->
			
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

<script language="JavaScript">
function countit(fldobj,max)
{
var count=0
var len=0
var formcontent=fldobj.value // grab the text from the textarea
formcontent=formcontent.split(" ") // split the words into an array
for(i=0;i<formcontent.length;i++)
{
if(formcontent[i]=="") // Count the number of spaces or nulls
{
count++
}
}
len=formcontent.length-count // subtract spaces or nulls from the length
window.status="You have entered "+len+" words."
if(len>max)
{alert(max+" WORDS ARE ONLY ACCEPTED HERE!")}
}
</script>