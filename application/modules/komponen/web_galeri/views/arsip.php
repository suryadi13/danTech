			<div class="panel panel-default" style="margin-top:10px;">
				<div class="panel-heading">Arsip <?=$nama_kategori;?></div>
				<div class="panel-body">
                  <div id='lainnya_<?=$id_kategori;?>'></div>
				</div>
				<!--//panel-body-->
				<div class='panel-footer' id='paging_galeri'></div>
			</div>
<script type="text/javascript">
$(document).ready(function(){
	gridgaleri(<?=$hal;?>);
});
function repaging_galeri(){
	$( "#paging_galeri .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_galeri .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridgaleri(inu);	}
	});
}
////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
function gridgaleri(hal){
$('#lainnya_<?=$id_kategori;?>').html("<img src='<?=site_url();?>assets/images/loading1.gif'>");
if(hal=="end"){var hali="end";} else {var hali=hal;}
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>web_galeri/getgaleri/",
				data:{"hal": hali, "batas": <?=$batas;?>, "rubrik": <?=$id_kategori;?>},
				success:function(data){
if((data.hslquery.length)>0){
			var table=""; var nomor=data.mulai;
			$.each( data.hslquery, function(index, item){
					if(nomor%2==0){ var bgc="even";}else{ var bgc="odd";}
					if(item.id_konten == <?=$id_konten;?>){
						table = table+ "<div class='widget-sidebox item "+bgc+"'>";
					} else {
						table = table+ "<a href=\"<?=site_url();?>read/galeri/"+item.id_konten+"/"+item.kat_seo+"/"+item.seo+"\"><div class='widget-sidebox item ada "+bgc+"'>";
					}
					table = table+ "<small>"+ item.hari_buat+", "+ item.tanggal+"</small>";
					table = table+ "<br />";
					table = table+item.judul;
					if(item.id_konten == <?=$id_konten;?>){
						table = table+ "</div>";
					} else {
						table = table+ "</div></a>";
					}
				nomor++;
			}); //endeach
//			table = table+"</ul>";
			var hu=data.pager;
				$('#lainnya_<?=$id_kategori;?>').html(table);
				$('#paging_galeri').html(data.pager);
				repaging_galeri();
		} else {
			$('#lainnya_<?=$id_kategori;?>').html("");
		}
}, 
        dataType:"json"});
}
////////////////////////////////////////////////////////////////////////////
</script>
<style>
#paging_galeri.panel-footer{padding-top:2px;padding-bottom:2px;text-align:right;	}
#paging_galeri.panel-footer .btn{padding:2px 8px 2px 8px;}
#paging_galeri.panel-body .btn{padding:2px 8px 2px 8px;}
</style>