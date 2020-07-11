 <div class="col-md-5">
<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('add_news'); ?>
					</div>
					</div>
               
			<!----CREATION FORM STARTS---->

      <?php echo form_open(base_url().'index.php?admin/news/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
                        
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('news_title');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="news_title" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('uploader');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="uploader" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
                                <div class="col-sm-9">
                                    <input type="text" class="datepicker form-control" name="date" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                </div>
                            </div>
							
							 <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('short_content');?></label>
                                <div class="col-sm-9">
									<textarea rows="5" class="form-control" name="short_content" cols="30"  onKeyPress="return countit(this,30)" placeholder="Enter short contents here. Maximum word is 30"></textarea>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('full_content');?></label>
                                <div class="col-sm-9">
                                    <textarea type="text" class="form-control" name="news_content"></textarea>
                                </div>
                            </div>
							
							
						<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>
                        <div class="col-sm-9">
                        <input type="file" name="file_name" class="form-control file2 inline btn btn-primary btn-sm" data-label="<i class='glyphicon glyphicon-file'></i> Browse Image" />
<br><br>
						<div  style="color:#FF0000">920 X 783</div>
                        </div>
                    </div>
							
                        		<div class="form-group">
                              	<div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-success btn-sm btn-icon icon-left"><i class="fa fa-pencil"></i><?php echo get_phrase('add_news');?></button>
                              	</div>
								</div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->

<div class="col-md-7">
<div class="x_panel table-responsive" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_news'); ?>
					</div>
					</div>
    
    	
                <table  class="table" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('news_title');?></div></th>
                    		<th><div><?php echo get_phrase('news_content');?></div></th>
                    		<th><div><?php echo get_phrase('date');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php foreach($news as $row):?>
                        <tr>
							<td><?php echo $row['news_title'];?></td>
							<td><?php echo $row['news_content'];?></td>
							<td><?php echo $row['date'];?></td>
							<td>
							
<a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_news/<?php echo $row['news_id'];?>');"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>

<a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/news/delete/<?php echo $row['news_id'];?>');"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash"></i></button></a>

        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
			</div>
			
            <!----TABLE LISTING ENDS--->
            

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->    
<!-- added on 26 may 2018-->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  <div class="x_panel" >   

<script type="text/javascript">
	 $( function() {
		
			$( ".datepicker" ).datepicker({
				dateFormat: 'yy-mm-dd',
				changeMonth: true,
				changeYear: true
				
				
			});
		} );
		
</script>                  
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
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
