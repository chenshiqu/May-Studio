    <div id="footer">
    	&copy;MayStudio - 
        <a href="<?php echo base_url(); ?>index.php/maystudio/about">About</a>
        <a href="<?php echo base_url(); ?>index.php/maystudio/about">Contact</a>
    </div>
    
</div>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/jquery.validate.js"></script>
<?php if(isset($js))
{
	foreach ($js as $value) 
	{?>
	<script src="js/<?php echo $value ?>.js" ></script>
<?php  	}
} ?>
<!-- <script src="js/signin_validation.js"></script> -->
<script src="js/requestNextAnimationFrame.js"></script>
<script src="js/sprites.js"></script>
<script src="js/motion-parallax.js"></script>
<script src="js/slider.js"></script>
<script src="js/window.js"></script>
<script src="js/modal-init.js"></script>
<script src="js/load.js"></script>


</body>
</html>
