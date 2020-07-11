<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('list_academic_syllabus'); ?>
					</div>
					</div>
<div class="table-responsive">
&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/academic_syllabus_add/');" 
	class="btn btn-xs btn-orange">
    	<i class="entypo-book"></i>
			<?php echo get_phrase('add_academic_syllabus');?>
</a> 
	<br><br>
		<div class="tabs-vertical-env">
		
			<ul class="nav tabs-vertical">
			<?php 
				$classes = $this->db->get('class')->result_array();
				foreach ($classes as $row):
			?>
				<li class="<?php if ($row['class_id'] == $class_id) echo 'active';?>">
					<a href="<?php echo base_url();?>index.php?admin/academic_syllabus/<?php echo $row['class_id'];?>">
						<i class="entypo-dot"></i>
						<?php echo get_phrase('class');?> <?php echo $row['name'];?>
					</a>
				</li>
			<?php endforeach;?>
			</ul>
			
			<div class="tab-content">

				<div class="tab-pane active">
<table class=" table  datatable" id="table-2">
						<thead>
							<tr>
								<th>#</th>
								<th><?php echo get_phrase('title');?></th>
								<th><?php echo get_phrase('description');?></th>
                                 <th><?php echo get_phrase('subject');?></th>
								<th><?php echo get_phrase('uploader');?></th>
								<th><?php echo get_phrase('date_submitted');?></th>
								<th><?php echo get_phrase('file_name');?></th>
								<th><?php echo get_phrase('download_document');?></th>
							</tr>
						</thead>
						<tbody>

						<?php
							$count    = 1;
							$academic_syllabus = $this->db->get_where('academic_syllabus' , array(
								'class_id' => $class_id
							))->result_array();
							foreach ($academic_syllabus as $row):
						?>
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $row['title'];?></td>
								<td><?php echo $row['description'];?></td>
                                                                <td>
									<?php 
										echo $this->db->get_where('subject' , array(
											'subject_id' => $row['subject_id']
										))->row()->name;
									?>
								</td>
								<td>
									<?php 
										echo $this->db->get_where($row['uploader_type'] , array(
											$row['uploader_type'].'_id' => $row['uploader_id']
										))->row()->name;
									?>
								</td>
								<td><?php echo date("d/m/Y" , $row['timestamp']);?></td>
								<td>
									<?php echo substr($row['file_name'], 0, 20);?><?php if(strlen($row['file_name']) > 20) echo '...';?>
								</td>
								<td>
								<a href="<?php echo base_url();?>index.php?admin/download_academic_syllabus/<?php echo $row['academic_syllabus_code'];?>">	<button type="button" class="btn  btn-blue btn-xs"><i class="entypo-download"></i></button></a>

									<a href="<?php echo base_url();?>index.php?admin/<?php echo $id;?>/delete/<?php echo $row['id'];?>"> <button type="button" class="btn  btn-danger btn-xs" onclick="return confirm('Are you sure to delete?');"><i class="entypo-trash"></i></button></a>
									
						
									
								</td>
							</tr>
						<?php endforeach;?>
							
						</tbody>
					</table>
				</div>

			</div>
			
		</div>	
	
	</div>
</div>