<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family: Arial, sans-serif;font-size: 12px;padding: 8px;border: 1px solid #E6E9ED;border-width: 1px;overflow: hidden;word-break: normal;color: #000;}
.tg th{font-family: Arial, sans-serif;font-size: 14px;font-weight: normal;padding: 10px 5px;border: 1px solid #E6E9ED;border-width: 1px;overflow: hidden;word-break: normal;}
.tg .tg-yw4l{vertical-align:middle;text-align: center;}
.tg.table-two {margin: 100px 0 0 0;}
.tg tr th, .tg tr td {color: #000;}
.tg thead tr:last-child td:nth-child(odd) { background-color: transparent;}
td {font-family: Arial, sans-serif;font-size: 12px;padding: 8px;border: 1px solid #E6E9ED;border-width: 1px;overflow: hidden;word-break: normal;color: #000;}

</style>
<div class="x_panel tablu" >
	<div class="x_title">
          <div class="panel-title">
			<?php echo get_phrase('manage_events'); ?>
		</div>
	</div>

	<?php 
			
			$get_system_settings	=	$this->crud_model->get_system_settings();
			echo form_open(base_url() . 'index.php?admin/event');?>
			<?php 
			$sessoin_id = $get_system_settings[17]['description'];
			$status = $this->db->get_where('status', array('session_year' => $sessoin_id))->result_array();
			$ex = $this->db->get_where('exam', array('exam_id' => $status[0]['exam_id']))->result_array();
			?>
			<div class="col-md-3">
				<div class="form-group">
					Manage Result Status
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select name="exam_id" class="form-control selectboxit" required>
                        	<option value="">Select term</option>
                        	<?php 
                        	$exams = $this->db->get('exam')->result_array();
                        	foreach($exams as $row):
                        	?>
                            	<option value="<?php echo $row['exam_id'];?>"
                            	<?php if ($exam_id == $row['exam_id']) echo 'selected';?>>
                            		<?php echo $row['name'];?>
                            	</option>
                        	<?php
                        endforeach;
                        ?>
                    </select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select name="status" class="form-control selectboxit" required>
                              <option value="">Select result status</option>
                              <option value="opened" <?php if ($status[0]['ststus'] == 'opened') echo 'selected'; ?>><?php echo get_phrase('opened'); ?></option>
                              <option value="closed" <?php if ($status[0]['ststus'] == 'closed') echo 'selected'; ?>><?php echo get_phrase('closed'); ?></option>
                         </select>
				</div>
			</div>
			
			<?php
			$i = 0;
			while ($i != 3) {
				$i++;
				$verify_data = array('session_year'=>$sessoin_id,'exam_id' => $i);
				$query_Remark = $this->db->get_where('status' , $verify_data);

				if($query_Remark->num_rows() < 1){
				$this->db->insert('status' , $verify_data);}
			}
			?>

			<input type="hidden" name="operation" value="update">
			<input type="hidden" name="session" value="<?php echo $sessoin_id ?>">
			<div class="col-md-3">
				<button type="submit" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-search"></i><?php echo get_phrase('update_status');?></button>
			</div>
			<?php //echo $exam_id;?>
		<?php echo form_close();?>
</div>

<div class="x_panel" >
      <div class="x_title">
          <div class="panel-title">
			<?php echo get_phrase('list_status'); ?>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table " id="table_export">
	          <thead>
	              <tr>
	                  <th>S/N</th>
	                  <th><div><?php echo get_phrase('status');?></div></th>
	                  <th><div><?php echo get_phrase('term');?></div></th>
	                  <th><div><?php echo get_phrase('session');?></div></th>
	              </tr>
	          </thead>
	          <tbody>
	              <?php
	                  $count = 1; 
	                  $stats   =   $this->db->get_where('status', array('session_year'=>$sessoin_id) )->result_array();
				   foreach($stats as $row):
						$exx = $this->db->get_where('exam', array('exam_id' => $row['exam_id']))->result_array();
				   ?>
	              <tr>
	                  <td><?php echo $count++;?></td>
	                  <td><?php echo $row['status'];?></td>
	                  <td><?php echo $exx[0]['name'];?></td>
	                  <td><?php echo $row['session_year'];?></td>
	              </tr>
	              <?php endforeach;?>
	          </tbody>
	      </table>
	</div>
</div>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

    jQuery(document).ready(function($)
    {
        

        var datatable = $("#table_export").dataTable({
            "sPaginationType": "bootstrap",
            "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-3 col-left'i><'col-xs-9 col-right'p>>",
            "oTableTools": {
                "aButtons": [
                    
                    {
                        "sExtends": "xls",
                        "mColumns": [1,2,3,4,5]
                    },
                    {
                        "sExtends": "pdf",
                        "mColumns": [1,2,3,4,5]
                    },
                    {
                        "sExtends": "print",
                        "fnSetText"    : "Press 'esc' to return",
                        "fnClick": function (nButton, oConfig) {
                            datatable.fnSetColumnVis(5, false);
                            
                            this.fnPrint( true, oConfig );
                            
                            window.print();
                            
                            $(window).keyup(function(e) {
                                  if (e.which == 27) {
                                      datatable.fnSetColumnVis(5, true);
                                  }
                            });
                        },
                        
                    },
                ]
            },
            
        });
        
        $(".dataTables_wrapper select").select2({
            minimumResultsForSearch: -1
        });
    });
        
</script>



                
              