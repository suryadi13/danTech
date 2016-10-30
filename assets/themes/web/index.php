<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title><?=$nama_app;?> | <?=$slogan_app;?></title>

	<link rel="shortcut icon" href="<?=base_url();?>assets/media/logo_kanal/<?=$favicon_app;?>" type="image/x-icon" />
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?=base_url('assets/css/font-awesome/font-awesome-4.4.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?=base_url('assets/js/jquery/jquery-1.11.0.min.js');?>"></script>
    <!-- Bootstrap Core JavaScript -->
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
</head>
<body  style="padding-top:0px;">
<?php
echo $cHeader;
echo $cNav;
echo $cTop;
?>
<div class="container">
	<div class="row">
		<div class="col-lg-8">
			<?=$cMain;?>
		</div>
		<div class="col-lg-4">
			<?=$cSide;?>
		</div>
	</div><!-- /.row -->
</div><!--//container-->
<?php
echo $cFooter;
?>
</body>
</html>