<?php
$edit_book = $this->db->get_where('student', array('student_id' => $param2))->result_array();
foreach ($edit_book as $row):
    ?>
		<div class="panel-body" id="div_print">
<div class="x_panel" >
                <div class="x_title">
                    <div class="panel-title" align="center" >
                       <strong> <?php echo get_phrase('student_library_card'); ?></strong>
                    </div>
                </div>
          <table class="table">
<tbody>
								<tr>
								  <th rowspan="5"><div align="center" style="width:155px;height:160px;border:1px solid #FF0000; background-color:#8ee38e">
		<img src="<?php echo $this->crud_model->get_image_url('student' , $row['student_id']);?>"  width="150" height="120" />
		</div></th>
                                  <th>Student Name</th>
                                  <td>:<?php echo $row ['name'];?></td>
                                </tr>
								
								<tr>
								  <th>Student Class</th>
                                  <td><?php echo $this->crud_model->get_class_name($row['class_id']);?></td>
                                </tr>
								<tr>
								  <th>Library ID Number</th>
                                  <td>:<?php echo $row ['card_number'];?></td>
                                </tr>
								
								<tr>
								  <th>Date Issued</th>
                                  <td>:<?php echo $row ['issue_date'];?></td>
								</tr>
								
								<tr>
								  <th>Expiry Date</th>
                                  <td>:<?php echo $row ['expire_date'];?></td>
								</tr>
</tbody>
</table>
		  
		            
    	</div>
    	</div>

    <?php
endforeach;
?>
<div align="center"><button type="button" name="b_print" class="btn btn-xs btn-orange" onClick="printdiv('div_print');"><i class="entypo-print"></i></button></div>	

<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
<script type="text/javascript" src="js/html2canvas.min.js"></script>
<script type="text/javascript" src="js/jspdf.min.js"></script>
<script type="text/javascript">
    var pages = $('.print');
    var doc = new jsPDF();
    var j = 0;
    for (var i = 0 ; i < pages.length; i++) {
        html2canvas(pages[i]).then(function(canvas) {
        var img=canvas.toDataURL("image/png");
        // debugger;
        var height =  canvas.height / 440 * 80;
        doc.addImage(img,'JPEG',10,0,190,height);
        if (j < (pages.length - 1) ) doc.addPage();
        if (j == (pages.length - 1) ) {doc.save('Report.pdf');}
        j++;
        });
    }
    
</script>
     