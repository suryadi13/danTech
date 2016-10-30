<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$nama;?> - <?=$slogan;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?=base_url('assets/css/plugins/metisMenu/metisMenu.min.css');?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?=base_url('assets/css/sb-admin-2.css');?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?=base_url('assets/css/font-awesome/font-awesome-4.4.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">
    <!-- Morris Charts CSS -->
    <link href="<?=base_url('assets/css/plugins/morris.css');?>" rel="stylesheet">

    <!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?=base_url('assets/js/jquery/jquery-1.11.0.min.js');?>"></script>
    <!-- Bootstrap Core JavaScript -->
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
    <!-- Metis Menu Plugin JavaScript -->
	<script type="text/javascript" src="<?=base_url('assets/js/plugins/metisMenu/metisMenu.min.js');?>"></script>
    <!-- Custom Theme JavaScript -->
	<script type="text/javascript" src="<?=base_url('assets/js/sb-admin-2.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/js/bootstrap-timeout/bootstrap-session-timeout.min.js');?>"></script>
</head>

<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
				<div style="float:left;padding:2px 0px 0px 15px;"><img src="<?=base_url('assets/media/logo_kanal/'.$logo);?>" style='width:40px; vertical-align:middle;'></div>
				<div style="float:left;display:table;padding-top:3px; padding-left:15px;">
					<div><h4 style="margin:0px;padding:0px;"><?=$gr->judul_app;?></h4></div>
					<div><?=$gr->sub_judul;?></div>
				</div>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div><!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
			<?=$notif;?>
            </ul><!-- navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse"><div style="padding-top:30px;"><?=$pengenal;?></div><ul class="nav" id="side-menu"><?php recSidebar($sidebar,$actt); ?><li><a href="<?=site_url();?>login/out"><i class="fa fa-sign-out fa-fw"></i>  Keluar</a></li></ul></div><!-- /.sidebar-collapse -->
            </div><!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper"><?=$konten;?></div>
<form id="pindah" method="post"></form>
</body>
</html>
<?php
function recSidebar($nav,$akv) {
    foreach ($nav as $key=>$val) {
		$cActt = ($akv==$val->id_menu)?"class=\"active\"":"";
		if(isset($val->anak)){
			echo '<li><a href="#" '.$cActt.'><i class="fa fa-'.$val->icon_menu.' fa-fw"></i> '.$val->nama_menu.' <span class="fa arrow"></span></a><ul class="nav nav-second-level collapse">';
			recSidebar($val->anak,$akv);
			echo '</ul></li>';
		} else {
			echo '<li><a href="'.site_url().'admin/'.$val->path_menu.'" '.$cActt.'><i class="fa fa-'.$val->icon_menu.' fa-fw"></i> '.$val->nama_menu.'</a></li>';
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
.user-dantech	{text-align:center;padding-top:5px;border-bottom:1px solid #eee; color:#6699FF;	}
</style>

