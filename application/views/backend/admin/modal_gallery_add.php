<div class="col-md-12">
<div class="x_panel" >
      <?php echo form_open(base_url().'index.php?admin/gallery/create' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
 <div class="form-group">
<label class="col-sm-3 control-label"><?php echo get_phrase('news_title');?></label>
<div class="col-sm-9">
<input type="text" class="form-control" name="title" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label"><?php echo get_phrase('short_content');?></label>
<div class="col-sm-9">
<textarea rows="5" class="form-control" name="content" cols="30"  onKeyPress="return countit(this,30)" placeholder="Enter short contents here. Maximum word is 30"></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label"><?php echo get_phrase('date');?></label>
<div class="col-sm-9">
<input type="text" class="datepicker form-control" name="date" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
 </div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label"><?php echo get_phrase('file'); ?></label>
<div class="col-sm-9">
<input type="file" name="file_name" class="form-control file2 inline btn btn-primary btn-sm" data-label="<i class='glyphicon glyphicon-file'></i> Browse Image" />
<br><br>
<div  style="color:#FF0000">274 X 184</div>
</div>
</div>	

<div class="form-group">
<div class="col-sm-offset-3 col-sm-5">
<button type="submit" class="btn btn-success btn-sm btn-icon icon-left"><i class="fa fa-pencil"></i><?php echo get_phrase('add_gallery');?></button>
</div>
</div>										

<br>
 <?php echo form_close();?>
</div>
</div>


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