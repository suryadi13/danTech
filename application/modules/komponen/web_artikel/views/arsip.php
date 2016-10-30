			<div class="panel panel-default" style="margin-top:10px;">
				<div class="panel-heading">Arsip <?=$nama_kategori;?></div>
				<div class="panel-body">
                  <div id='lainnya_<?=$id_kategori;?>'></div>
				</div>
				<!--//panel-body-->
				<div class='panel-footer' id='paging_artikel'></div>
			</div>
			<!--//panel-->
<script type="text/javascript">
$(document).ready(function(){
	gridartikel(<?=$hal;?>);
});
function repaging_artikel(){
	$( "#paging_artikel .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_artikel .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridartikel(inu);	}
	});
}
////////////////////////////////////////////////////////////////////////////
function gridartikel(hal){
$('#lainnya_<?=$id_kategori;?>').html("<p style='text-align:center'><i class='fa fa-spinner fa-2x'></i></p>");
if(hal=="end"){var hali="end";} else {var hali=hal;}
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>web_artikel/getartikel/",
				data:{"hal": hali, "batas": <?=$batas;?>, "rubrik": <?=$id_kategori;?>},
				success:function(data){
if((data.hslquery.length)>0){
			var table=""; var nomor=0;
			$.each( data.hslquery, function(index, item){
					if(nomor%2==0){ var bgc="even";}else{ var bgc="odd";}
					if(item.id_konten == <?=$id_konten;?>){
						table = table+ "<div class='widget-sidebox item "+bgc+"'>";
					} else {
						table = table+ "<a href=\"<?=site_url();?>read/artikel/"+item.id_konten+"/"+item.kat_seo+"/"+item.seo+"\"><div class='widget-sidebox item ada "+bgc+"'>";
					}
					table = table+ "<small>"+ item.hari+", "+ item.tanggal+"</small>";
					table = table+ "<br />";
					table = table+item.judul;
					if(item.id_konten == <?=$id_konten;?>){
						table = table+ "</div>";
					} else {
						table = table+ "</div></a>";
					}
				nomor++;
			}); //endeach
			var hu=data.pager;
				$('#lainnya_<?=$id_kategori;?>').html(table);
				$('#paging_artikel').html(data.pager);
				repaging_artikel();
				rmsh();
		} else {
			$('#lainnya_<?=$id_kategori;?>').html("");
		}
}, 
        dataType:"json"});
}
////////////////////////////////////////////////////////////////////////////
</script>
<style>
#paging_artikel.panel-footer{padding-top:2px;padding-bottom:2px;text-align:right;	}
#paging_artikel.panel-footer .btn{padding:2px 8px 2px 8px;}
#paging_artikel.panel-body .btn{padding:2px 8px 2px 8px;}
</style>