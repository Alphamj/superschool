</div>
</div>
</div>
<!-- Footer -->
<!--<hr>-->
<!--<footer class="main" align="right" style="background:none; border: none; text-align: right"><?php echo $footer; ?></footer>-->


<footer>
    <div class="pull-right">
        <?php echo $footer; ?>
    </div>
    <div class="clearfix"></div>
</footer>
<script type="text/javascript">
	jQuery(document).ready(function ($){
         $('a[href^="</div"]').each(function(){ 
            var oldUrl = $(this).attr("href"); // Get current url
            var newUrl = "#"; // Create new url
            $(this).attr("href", newUrl); // Set herf value
        });
	});
</script>
