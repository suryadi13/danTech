<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$nama;?> - <?=$slogan;?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url('assets/css/klasik.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?=base_url('assets/themes/cat_master/css/style.css'); ?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/font-awesome/font-awesome-4.4.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?=base_url('assets/js/jquery/jquery-1.11.0.min.js');?>"></script>
    <!-- Bootstrap Core JavaScript -->
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/js/bootstrap-timeout/bootstrap-session-timeout.min.js');?>"></script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
	<style>.page-header {	padding-top:5px; margin-top:5px;	}</style>
</head>
<body>

<nav class="navbar navbar-findcond navbar-fixed-top">
    <div class="container">
    <div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<div style="float:left;padding:5px 10px 0px 0px;"><img src="<?=base_url('assets/media/logo_kanal/'.$logo);?>" style='width:40px; vertical-align:middle;'></div>
		<span class="navbar-brand"><?=$gr->sub_judul;?></span>
	</div>
				<div class="collapse navbar-collapse" id="navbar">
				  <ul class="nav navbar-nav navbar-right"><?=$notif;?></ul>
				</div>
  </div>  
</nav>

<div class="container">
<div class="row" style="margin-top: 60px; margin-bottom:10px;">
<div class="col-lg-12">
<?=$pengenal;?>
	<div class="panel panel-warning">
		<div class="panel-body"><?php recSidebar($sidebar,$actt); ?><a href="<?=site_url('login/out');?>" class="btn btn-sq btn-primary"><i class="fa fa-sign-out fa-5x"></i><br><br/>Keluar</a></div>
	</div>
</div>
</div>


<div class="row">
	<div class="col-md-12">
        <div><?=$konten;?></div>
	</div>
</div>

<div class="col-md-12" style="border-top: solid 4px #ddd; text-align: center; padding-top: 10px; margin-top: 50px; margin-bottom: 20px">
	&copy; 2016 <?=$gr->judul_app;?>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'danTech<strong>': '' ?></p>
</div>


</div><!--/.container-->


<?php
function recSidebar($nav,$akv) {
    foreach ($nav as $key=>$val) {
		$cActt = ($akv==$val->id_menu)?"warning":"primary";
		if(isset($val->anak)){
			echo '<span class="dropdown"><button class="btn btn-sq btn-'.$cActt.' dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-'.$val->icon_menu.' fa-5x"></i><br><br/>'.$val->nama_menu.' </button>';
			echo '<ul class="dropdown-menu" role="menu">';
			foreach($val->anak AS $key2=>$val2){
				echo '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" href="'.site_url().'admin/'.$val2->path_menu.'"><i class="fa fa-'.$val2->icon_menu.' fa-fw"></i> '.$val2->nama_menu.'</a></li>';
			}
			echo '</ul></span>';
		} else {
			echo '<a href="'.site_url().'admin/'.$val->path_menu.'" class="btn btn-sq btn-'.$cActt.'"><i class="fa fa-'.$val->icon_menu.' fa-5x"></i><br><br/>'.$val->nama_menu.' </a>';
		} // end anak
    } // end foreach
} // end recKanal
?>
<form id="pindah" method="post"></form>
</body>
</html>
<script type="text/javascript">
function pindah_ke(app){
	$.ajax({
		type:"POST",
		url:"<?=site_url();?>admin/pindah",
		success:function(data){	
			$('#pindah').attr('action','<?=site_url();?>sso');
			var tab = '<input type="hidden" name="idd" value="'+data+'">';
			tab = tab+'<input type="hidden" name="app" value="'+app+'">';
			$('#pindah').html(tab).submit();
		}, // end success
	    dataType:"html"});
}
    $.sessionTimeout({
        keepAliveUrl: '<?=base_url();?>assets/js/bootstrap-timeout/examples/lanjutkan.html',
        logoutUrl: '<?=site_url();?>login/out',
        redirUrl: '<?=site_url();?>login/out',
        warnAfter: <?=(!isset($gr->alertafter))?40000:$gr->alertafter;?>,
        redirAfter: <?=(!isset($gr->logoutafter))?60000:($gr->alertafter+$gr->logoutafter);?>
    });
</script>
