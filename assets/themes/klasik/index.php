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
    <link href="<?=base_url('assets/css/bootstrap2.min.css');?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?=base_url('assets/css/font-awesome/font-awesome-4.4.0/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <link href="<?=base_url('assets/css/klasik.css');?>" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?=base_url('assets/js/jquery/jquery-1.11.0.min.js');?>"></script>
    <!-- Bootstrap Core JavaScript -->
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/js/bootstrap-timeout/bootstrap-session-timeout.min.js');?>"></script>
</head>
<body  style="padding-top:0px;">

	<div class="container"><!---HEADER-->
		<div class="row">
				<div class="col-lg-6">
					<div style="float:left;padding:5px 10px 5px 0px;"><img src="<?=base_url('assets/media/logo_kanal/'.$logo);?>" style='width:60px; vertical-align:middle;'></div>
					<div style="float:left;display:table;padding-top:10px; width:64%;">
						<div><h3 style="margin:0px;padding:0px;"><?=$gr->judul_app;?></h3></div>
						<div><?=$gr->sub_judul;?></div>
					</div>
				</div>  <!--col-lg-6--->
				<div class="col-lg-6"><div style="text-align:right;padding-top:20px;color:#FF0000;"><?=$pengenal;?></div></div><!--col-lg-6--->
		</div> <!--row--->
	</div> <!--container--->


    <div class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0px;border-top:1px solid #eee;"><!---NAVBAR-->
      <div class="container">
        <div class="navbar-header"  style="clear:both;">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div><!--/.navbar-header -->
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-top-links navbar-right">
			<?=$notif;?>
            </ul><!-- navbar-top-links -->
		<ul class="nav navbar-nav">
		<?php recSidebar($sidebar,$actt); ?><li style="margin:0px;padding:0px;"><a href="<?=site_url();?>login/out" style="margin:5px;padding:5px;"><i class="fa fa-sign-out"></i> Keluar</a></li>
		</ul>
        </div><!--/.navbar-collapse -->
      </div><!--/.container-->
    </div><!--/.navbar -->

<?php
function recSidebar($nav,$akv) {
    foreach ($nav as $key=>$val) {
		if(isset($val->anak)){
			$cActt = ($akv==$val->id_menu)?"active":"";
			echo '<li class="dropdown '.$cActt.'" style="margin:0px;padding:0px;"><a href="#"  class="dropdown-toggle" data-toggle="dropdown" style="margin:5px;padding:5px;"><i class="fa fa-'.$val->icon_menu.' fa-fw"></i> '.$val->nama_menu.' <b class="caret"></b></a><ul class="dropdown-menu">';
			recSidebar($val->anak,$akv);
			echo '</ul></li>';
		} else {
			$cActt = ($akv==$val->id_menu)?"class=\"active\"":"";
			echo '<li '.$cActt.' style="margin:0px;padding:0px;"><a href="'.site_url().'admin/'.$val->path_menu.'" style="margin:5px;padding:5px;"><i class="fa fa-'.$val->icon_menu.' fa-fw"></i> '.$val->nama_menu.'</a></li>';
		} // end anak
    } // end foreach
} // end recKanal
?>


<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<?=$konten;?>
		</div>
	</div><!-- /.row -->
</div><!--//container-->



<div class="container"><!---FOOTER-->
	<div class="row">
		<div class="col-lg-12">
		<hr>
				<div class="footer">
					Copyright &copy; 2015 - Prakom 11 - All Rights Reserved. Page rendered in <strong>{elapsed_time}</strong> seconds
				</div>
		</div><!-- /.col-lg-12 -->
	</div><!-- /.row -->
</div><!--//container-->

<form id="pindah" method="post"></form>
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
</body>
</html>