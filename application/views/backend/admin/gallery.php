 <!-- added on 26 may 2018-->
   <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  <div class="x_panel" > 

 <div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_media'); ?>&nbsp;&nbsp;<button onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_gallery_add');" 
     class="btn btn-xs btn-orange">
        <i class="entypo-plus"></i><?php echo get_phrase('add_media'); ?>
</button>
					</div>
					</div>

					<?php 
                                $gallery	=	$this->db->get('gallery' )->result_array();
                                foreach($gallery as $row):?>
					 <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block;" src="<?php echo base_url().'uploads/gallery_image/'.$row['file_name']; ?>" />
                            <div class="mask no-caption">
                              <div class="tools tools-bottom">								
<a href="<?php echo base_url();?>index.php?admin/gallery/delete/<?php echo $row['gallery_id']?>" 
                        onclick="return confirm('Are you sure to delete?');">
                        <i class="fa fa-times"></i>
                        </a>                              
						    </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p><strong><?php echo $row['title']?></strong>
                            </p>
                            <p><?php echo $row['content']?></p>
                          </div>
                        </div>
                      </div>
					  <?php endforeach;?>
					
					
					
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
