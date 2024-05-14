<?php
session_start();
if(!isset($_SESSION['LOGIN']['SALON']))
	{
	?>
			<script type="text/javascript" language="javascript">
                window.location="index.php";
            </script>
     <?php 	
	}
session_destroy();
?>
			<script type="text/javascript" language="javascript">
                window.location="index.php";
            </script>	
    