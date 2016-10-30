	<div class="container" style="margin-top:<?=$header->margin_top;?>;margin-bottom:<?=$header->margin_bottom;?>;">
		<div class="row" style="height:<?=$header->tinggi_header;?>;padding-top:<?=$header->padding_top;?>;padding-bottom:<?=$header->padding_bottom;?>">
				<div class="col-lg-8">
					<a href="<?=site_url('kanal/'.$pth);?>">
					<div style="float:left;padding:10px 10px 10px 0px;"><img src="<?=$logo_app;?>" style='width:80px; vertical-align:middle;'></div>
					<div style="float:left;display:table;padding-top:20px; width:64%;">
						<div><h3 style="margin:0px;padding:0px;"><?php echo $header->judul_header; ?></h3></div>
						<div><?php echo $header->sub_judul; ?></div>
					</div>
					</a>
				</div>  <!--col-lg-8--->
				<div class="col-lg-4" style="margin-bottom:0px;padding:20px 15px 0px 0px;vertical-align:bottom;">
						<form role="form" id="cariForm" accept-charset="utf-8" method="post" action="<?=site_url();?>web/cari">
					<div class="input-group" style="width:240px; float:right; padding: 10px 15px 10px 0px;">
						<input id="kata_kunci" name="kata_kunci" type="text" class="form-control" placeholder="Masukkan kata kunci...">
						<span class="input-group-btn"><button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button></span>
					</div>
						</form>
				</div>  <!--col-lg-4--->
		</div> <!--row--->
	</div> <!--container--->
