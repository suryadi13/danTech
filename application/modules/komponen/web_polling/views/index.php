<?php
$konten->isi_konten=str_replace("thumbs_","",$konten->isi_konten);		
$konten->isi_konten=str_replace('src="assets','src="'.base_url().'assets',$konten->isi_konten);		
?>
    <div class="container">
		<div class="row" style="padding-top:10px;">


        <!--content-->
        <div class="col-lg-8">

			<div class="row"><div class="col-lg-12"><ol class="breadcrumb"><?=$jkanal;?></ol></div></div>
			<div class="row"><div class="col-lg-12">
				<b><?=strtoupper(@$konten->nama_kategori);?></b>
			</div></div>
<?php
echo Modules::run("element/gambar",@$konten->id_konten);
?>
			<div class="row"><div class="col-lg-12" style="padding-bottom:20px;">
            	 <h2><?=@$konten->judul;?></h2>
				 <?php
				 foreach($pilihan AS $key=>$val){
				 ?>
				 <?=$val->judul_appe;?> - <?=$val->nilai;?><br/>
				 <?php
				 }
				 ?>
			</div></div>

<?php
echo Modules::run("element/lampiran/index",@$konten->id_konten);
echo Modules::run("element/komentar/index",@$konten->id_konten);
?>
        </div>
        <!--content-->
        <!--sidebar-->
        <div class="col-lg-4">
			<div id=rubrik style='display:none'><?=@$konten->id_kategori; ?></div>
			<div class="panel panel-primary">
				<div class="panel-heading">Arsip <?=@$konten->nama_kategori;?></div>
				<div class="panel-body">
                  <div id='lainnya_<?=@$konten->id_kategori;?>'></div>
                   
				</div>
				<!--//panel-body-->
				<div id='paging_polling' class='panel-footer'></div>
			</div>
			<!--//panel-->
			<div class="panel panel-primary">
				<div class="panel-heading">Rubrik lainnya</div>
				<div class="panel-body">
<?php
echo Modules::run("element",@$konten->id_kanal,"polling",@$konten->id_kategori);
?>
				</div>
				<!--//panel-body-->
			</div>
			<!--//panel-->
        </div>
        <!--sidebar-->
		</div>
		<!--//row-->
    </div>
	<!--//container-->
<script type="text/javascript">
$(document).ready(function(){
	gridpolling(<?=$hal;?>);
});
function repaging_polling(){
	$( "#paging_polling .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_polling .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridpolling(inu);	}
	});
}
////////////////////////////////////////////////////////////////////////////
function gridpolling(hal){
var rubrik = $("#rubrik").html();
$('#lainnya_'+rubrik+'').html("<img src='<?=site_url();?>assets/images/loading1.gif'>");
if(hal=="end"){var hali="end";} else {var hali=hal;}
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>web_polling/getpolling/",
				data:{"hal": hali, "batas": <?=$batas;?>, "rubrik": rubrik},
				success:function(data){
if((data.hslquery.length)>0){
			var table=""; var nomor=0;
			$.each( data.hslquery, function(index, item){
					if(nomor%2==0){ var bgc="even";}else{ var bgc="odd";}
					if(item.id_konten == <?=@$konten->id_konten;?>){
						table = table+ "<div class='widget-sidebox item "+bgc+"'>";
					} else {
						table = table+ "<a href=\"<?=site_url();?>read/artikel/"+item.id_konten+"/"+item.kat_seo+"/"+item.seo+"\"><div class='widget-sidebox item ada "+bgc+"'>";
					}
//					table = table+ "<small>"+ item.hari+", "+ item.tanggal+"</small>";
//					table = table+ "<br />";
					table = table+item.judul;
					if(item.id_konten == <?=@$konten->id_konten;?>){
						table = table+ "</div>";
					} else {
						table = table+ "</div></a>";
					}
				nomor++;
			}); //endeach
			var hu=data.pager;
				$('#lainnya_'+rubrik+'').html(table);
				$('#paging_polling').html(data.pager);
				repaging_polling();
				$('#status_'+rubrik+'').html("lama");
		} else {
			$('#lainnya_'+rubrik+'').html("");
		}
}, 
        dataType:"json"});
}
////////////////////////////////////////////////////////////////////////////
</script>
