<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-info">
			<div class="panel-heading" style="padding:0px;"> 


		<ul class="nav nav-tabs" role="tablist" id="myTab">
			<li class="active"><a data-toggle="tab" href="#spek_<?=$ini_kanal->id_kanal;?>"><i class="fa fa-cube fa-fw"></i> Atribut</a></li>
			<li id="triger_kategori_<?=$ini_kanal->id_kanal;?>" onclick="loadC('kategori','<?=$ini_kanal->id_kanal;?>','kategori');"><a data-toggle="tab" href="#kategori_<?=$ini_kanal->id_kanal;?>"><i class="fa fa-list fa-fw"></i> Kategori</a></li>
<!--
			<li class="dropdown">
				<a href="#" id="myTabDrop2" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book fa-fw"></i> Header <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop2">
					<li id="triger_logo_<?=$ini_kanal->id_kanal;?>" onclick="loadC('header','<?=$ini_kanal->id_kanal;?>','logo');"><a data-toggle="tab" href="#logo_<?=$ini_kanal->id_kanal;?>">Logo</a></li>
					<li id="triger_judul_<?=$ini_kanal->id_kanal;?>" onclick="loadC('header','<?=$ini_kanal->id_kanal;?>','judul');"><a data-toggle="tab" href="#judul_<?=$ini_kanal->id_kanal;?>">Judul</a></li>
					<li id="triger_sub_judul_<?=$ini_kanal->id_kanal;?>" onclick="loadC('header','<?=$ini_kanal->id_kanal;?>','sub_judul');"><a data-toggle="tab" href="#sub_judul_<?=$ini_kanal->id_kanal;?>">Sub Judul</a></li>
				</ul>
			</li>
-->
			<li class="dropdown">
				<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book fa-fw"></i> Body <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
					<li id="triger_topbar_<?=$ini_kanal->id_kanal;?>" onclick="loadC('widget','<?=$ini_kanal->id_kanal;?>','topbar');"><a data-toggle="tab" href="#topbar_<?=$ini_kanal->id_kanal;?>">Widget Topbar</a></li>
					<li id="triger_mainbar_<?=$ini_kanal->id_kanal;?>" onclick="loadC('widget','<?=$ini_kanal->id_kanal;?>','mainbar');"><a data-toggle="tab" href="#mainbar_<?=$ini_kanal->id_kanal;?>">Widget Mainbar</a></li>
					<li id="triger_sidebar_<?=$ini_kanal->id_kanal;?>" onclick="loadC('widget','<?=$ini_kanal->id_kanal;?>','sidebar');"><a data-toggle="tab" href="#sidebar_<?=$ini_kanal->id_kanal;?>">Widget Sidebar</a></li>
				</ul>
			</li>
<!--
			<li class="dropdown">
				<a href="#" id="myTabDrop3" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-book fa-fw"></i> Footer <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop3">
					<li id="triger_footer_topbar_<?=$ini_kanal->id_kanal;?>" onclick="loadC('footer','<?=$ini_kanal->id_kanal;?>','footer_topbar');"><a data-toggle="tab" href="#footer_topbar_<?=$ini_kanal->id_kanal;?>">Footer Topbar</a></li>
					<li id="triger_footer_mainbar_<?=$ini_kanal->id_kanal;?>" onclick="loadC('footer','<?=$ini_kanal->id_kanal;?>','footer_mainbar');"><a data-toggle="tab" href="#footer_mainbar_<?=$ini_kanal->id_kanal;?>">Footer Mainbar</a></li>
					<li id="triger_footer_sidebar_<?=$ini_kanal->id_kanal;?>" onclick="loadC('footer','<?=$ini_kanal->id_kanal;?>','footer_sidebar');"><a data-toggle="tab" href="#footer_sidebar_<?=$ini_kanal->id_kanal;?>">Footer Sidebar</a></li>
				</ul>
			</li>
-->
		</ul>
		<!-- Tab panes -->


			</div>
			<div class="panel-body">
					<div class="tab-content">
						<div id="spek_<?=$ini_kanal->id_kanal;?>" class="tab-pane fade in active">
<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-primary">
			<div class="panel-heading">Logo Kanal</div>
			<div class="panel-body">
							<div class="thumbnail" style="width:120px;">
								<div class="caption">
									<p><a href="" class="label label-info" onclick="viewUppl('logo',<?=$id_kanal;?>);return false;"><i class="fa fa-upload fa-fw"></i> Ganti logo</a></p>
									<?php if($hapus_logo=="ya") { ?>
									<p><a href="" class="label label-danger" onclick="hapusLogo(<?=$id_kanal;?>);return false;"><i class="fa fa-download fa-fw"></i> Logo Default</a></p>
									<?php } ?>
								</div>
								<img src='<?=$logo;?>' height=60 border=0>
							</div>
			</div><!---/.panel-body-->
		</div><!---/.panel-->
	</div><!---/.col-lg-4-->
	<div class="col-lg-8">
	
				<div class="panel panel-primary">
				<div class="panel-heading"><div class="btn btn-default btn-xs" onClick="loadForm('formeditheader','0','0','<?=$id_kanal;?>');"><i class="fa fa-pencil fa-fw"></i></div> Atribut Header</div>
				<div class="panel-body">
				<div class="table-responsive">
				<table class="table table-striped table-hover">
				<thead>
				<tr>
				<th style="vertical-align:middle">No.</th>
				<th style="vertical-align:middle">VARIABEL</th>
				<th style="vertical-align:middle">NILAI</th>
				</tr>
				</thead>
				<tbody id=list>
				<tr>
				<td>1</td>
				<td width=150>Judul kanal:</td>
				<td><?=$header->judul_header;?></td>
				</tr>
				<tr>
				<td>2</td>
				<td>Sub judul kanal:</td>
				<td><?=$header->sub_judul;?></td>
				</tr>
				<tr>
				<td>3</td>
				<td>...</td>
				<td>...</td>
				</tr>
				</tbody>
				</table>
				</div></div>
				</div>
	</div><!---/.col-lg-8-->
</div><!---/.row-->

						</div><!---/.home-pills-->
						<div id="kategori_<?=$ini_kanal->id_kanal;?>" class="tab-pane fade"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div>
						<div id="topbar_<?=$ini_kanal->id_kanal;?>" class="tab-pane fade"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div>
						<div id="mainbar_<?=$ini_kanal->id_kanal;?>" class="tab-pane fade"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div>
						<div id="sidebar_<?=$ini_kanal->id_kanal;?>" class="tab-pane fade"><p class="text-center"><i class="fa fa-spinner fa-spin fa-5x"></i><p></div>
						<div id="logo_<?=$ini_kanal->id_kanal;?>" class="tab-pane fade"><p class="text-center">LOGO</i><p></div>
						<div id="judul_<?=$ini_kanal->id_kanal;?>" class="tab-pane fade"><p class="text-center">JUDUL</i><p></div>
						<div id="sub_judul_<?=$ini_kanal->id_kanal;?>" class="tab-pane fade"><p class="text-center">SUB JUDUL</i><p></div>
						<div id="footer_topbar_<?=$ini_kanal->id_kanal;?>" class="tab-pane fade"><p class="text-center">LOGO</i><p></div>
						<div id="footer_mainbar_<?=$ini_kanal->id_kanal;?>" class="tab-pane fade"><p class="text-center">JUDUL</i><p></div>
						<div id="footer_sidebar_<?=$ini_kanal->id_kanal;?>" class="tab-pane fade"><p class="text-center">SUB JUDUL</i><p></div>
					</div><!--/.tab-content-->
			</div><!---/.panel-body-->
		</div><!---/.panel-->
	</div><!---/.col-lg-12-->
</div><!---/.row-->


		</div>
	</div>
</div></div>
<script type="text/javascript">
$('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
); 
</script>
<style>
	.nav-tabs { padding-top: 10px; padding-left: 10px;}
</style>
