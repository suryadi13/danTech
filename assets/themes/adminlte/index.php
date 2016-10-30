<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?=$nama;?> - <?=$slogan;?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?=base_url('assets/css/klasik.css');?>" rel="stylesheet">
    <!-- Bootstrap 3.3.2 -->
    <link href="<?=base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- FontAwesome 4.3.0 -->
    <link href="<?=base_url('assets/css/font-awesome/font-awesome-4.4.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <!-- Theme style -->
    <link href="<?=base_url('assets/css/adminlte/AdminLTE.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?=base_url('assets/css/adminlte/skins/_all-skins.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?=base_url('assets/js/jquery/jquery-1.11.0.min.js');?>"></script>
    <!-- Morris Charts CSS -->
    <link href="<?=base_url('assets/css/plugins/morris.css');?>" rel="stylesheet">

    <!-- Bootstrap Core JavaScript -->
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url('assets/js/adminlte/app.min.js');?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/jquery/maskmoney/3.0.2/jquery.maskMoney.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/js/bootstrap-timeout/bootstrap-session-timeout.min.js');?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo"><div style="float:left;padding:0px;"><img src="<?=base_url('assets/media/logo_kanal/'.$logo);?>" style='width:40px;padding-bottom:4px;'> <?=$gr->judul_app;?></div></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav"><?=$notif;?></ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar"><!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
			<?=$pengenal;?>
          <ul class="sidebar-menu"><?php recSidebar($sidebar,$actt); ?><li><a href="<?=site_url();?>login/out"><i class="fa fa-sign-out fa-fw"></i>  Keluar</a></li></ul>
        </section><!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <section class="content"><?=$konten;?></section>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Powered by &copy; 2014-2015 <a href="#">Almsaeed Studio</a>.</strong> Feat. by Prakom 2016.
      </footer>
    </div><!-- ./wrapper -->


  </body>
</html>
<form id="pindah" method="post"></form>
<?php
function recSidebar($nav,$akv) {
    foreach ($nav as $key=>$val) {
		if(isset($val->anak)){
			$cActt = ($akv==$val->id_menu)?"active":"";
			echo '<li class="treemenu '.$cActt.'"><a href="#"><i class="fa fa-'.$val->icon_menu.' fa-fw"></i>  '.$val->nama_menu.'<i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu">';
			recSidebar($val->anak,$akv);
			echo '</ul></li>';
		} else {
		$cActt = ($akv==$val->id_menu)?"class=\"active\"":"";
			echo '<li '.$cActt.'><a href="'.site_url().'admin/'.$val->path_menu.'"><i class="fa fa-'.$val->icon_menu.' fa-fw"></i> '.$val->nama_menu.'</a></li>';
		} // end anak
    } // end foreach
} // end recKanal
?>
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
function loadSegment(segmen,page){
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>"+page,
				beforeSend:function(){	$('#'+segmen).html('').html('<p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p>');	},
				success:function(data){	$('#'+segmen).html(data);	}, // end success
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
<style>
.user-dantech	{text-align:center;padding-top:5px;border-bottom:1px solid #ccc; color:#fff;}
</style>
