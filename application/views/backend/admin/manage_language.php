<div class="x_panel" >
            
                <div class="x_title">
                    <div class="panel-title">
					 <?php echo get_phrase('language_information_page'); ?>
					</div>
					</div>
				<div class="x_panel" >
	
					<?php 
	$language = $this->db->get_where('settings' , array(
		'type' => 'language'
	))->row()->description;
?>

<?php if ($language == 'english'):?>  
<span class="badge bg-red" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'arabic'):?>  
<span class="badge bg-orange" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'spanish'):?>  
<span class="badge bg-red" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'russian'):?>  
<span class="badge bg-blue" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'turkish'):?>  
<span class="badge bg-red" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'hindi'):?>  
<span class="badge bg-blue" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'german'):?>  
<span class="badge bg-red" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'french'):?>  
<span class="badge bg-blue" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'chinese'):?>  
<span class="badge bg-orange" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'bengali'):?>  
<span class="badge bg-red" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'portuguese'):?>  
<span class="badge bg-green" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>


<?php if ($language == 'thai'):?>  
<span class="badge bg-blue" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>


<?php if ($language == 'japanese'):?>  
<span class="badge bg-red" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'urdu'):?>  
<span class="badge bg-green" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>

<?php if ($language == 'korean'):?>  
<span class="badge bg-blue" style="color:#FFFFFF"><?php echo get_phrase('active_language');?>:&nbsp;<?php echo $language; ?></span>
<?php endif;?>


<div align="right">
 <a href="<?php echo base_url(); ?>index.php?admin/manage_language"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-back"></i>Back</button></a>

<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_language_add/');"><button type="button" class="btn btn-orange btn-xs"><i class="entypo-plus"></i>Language</button></a>

<a href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_phrase_add/');"><button type="button" class="btn btn-green btn-xs"><i class="entypo-plus"></i>String</button></a>
</div>
</div>

<div class="table-responsive">
		<div class="tab-content">
            <!----PHRASE EDITING TAB STARTS-->
            <?php if (isset($edit_profile)):?>
			<div class="tab-pane active" id="edit" style="padding: 5px">
                <div class="">


						<div class="row">
                    	<?php 
						$current_editing_language	=	$edit_profile;
						echo form_open(base_url() . 'index.php?admin/manage_language/update_phrase/'.$current_editing_language  , array('id' => 'phrase_form'));
						$count = 1;
						$language_phrases	=	$this->db->query("SELECT `phrase_id` , `phrase` , `$current_editing_language` FROM `language`")->result_array();
						foreach($language_phrases as $row)
						{
							$count++;
							$phrase_id			=	$row['phrase_id'];					//id number of phrase
							$phrase				=	$row['phrase'];						//basic phrase text
							$phrase_language	=	$row[$current_editing_language];	//phrase of current editing language
							?>
                            <!----phrase box starts-->
                            <div class="col-sm-3">
                                
                                    
                                    
                                    <h3><?php echo $row['phrase'];?></h3>
                                    <p>
                                    <input type="text" name="phrase<?php echo $row['phrase_id'];?>" value="<?php echo $phrase_language;?>" class="form-control"/>
                                    </p>
                                
                            </div>
                            <!----phrase box ends-->
							<?php 
						}
						?>
						</div>
                        <input type="hidden" name="total_phrase" value="<?php echo $count;?>" />
                        <input type="submit" value="<?php echo get_phrase('update_phrase');?>" onClick="document.getElementById('phrase_form').submit();" class="btn btn-blue"/>	
                        <?php
						echo form_close();
						?>
                                     
                </div>                
			</div>
            <?php endif;?>
            <!----PHRASE EDITING TAB ENDS-->
            <!----TABLE LISTING STARTS-->

            <div class="tab-pane <?php if(!isset($edit_profile))echo 'active';?>" id="list">  
                <table class="table" id="table_export">
                	<thead>
                    	<tr>
                        	<th><?php echo get_phrase('all_languages');?> </th>
                        	<th><div align="right"><?php echo get_phrase('actions');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                    	<?php
								$fields = $this->db->list_fields('language');
								foreach($fields as $field)
								{
									 if($field == 'phrase_id' || $field == 'phrase')continue;
									?>
                    	<tr>
                        	<td> <?php echo ucwords($field);?> </td>
                        	<td><div align="right">
<a href="<?php echo base_url();?>index.php?admin/manage_language/edit_phrase/<?php echo $field;?>"><button type="button" class="btn btn-blue btn-xs"><i class="entypo-pencil"></i></button></a>
							<a href="<?php echo base_url();?>index.php?admin/manage_language/delete_language/<?php echo $field;?>"><button type="button" class="btn btn-red btn-xs"><i class="entypo-trash" onclick="return confirm('Delete Language ?');"></i></button></a></div>		
							
							
      
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->	
            
		</div>
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
