			<div class="panel panel-default" style="margin-top:10px;">
				<div class="panel-heading"><?=$nama_kategori;?> lainnya</div>
				<div class="panel-body">
                  <div id='lainnya_<?=$id_kategori;?>'></div>
				</div>
				<!--//panel-body-->
                   <div id='paging_direktori' class='panel-footer'></div>
			</div>
			<!--//panel-->
<script type="text/javascript">
$(document).ready(function(){
	griddirektori(<?=$hal;?>);
});
function repaging_direktori(){
	$( "#paging_direktori .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_direktori .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	griddirektori(inu);	}
	});
}
////////////////////////////////////////////////////////////////////////////
function griddirektori(hal){
$('#lainnya_<?=$id_kategori;?>').html("<img src='<?=site_url();?>assets/images/loading1.gif'>");
if(hal=="end"){var hali="end";} else {var hali=hal;}
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>web_direktori/getdirektori/",
				data:{"hal": hali, "batas": <?=$batas;?>, "rubrik": <?=$id_kategori;?>},
				success:function(data){
if((data.hslquery.length)>0){
			var table=""; var nomor=data.mulai;
			$.each( data.hslquery, function(index, item){
					if(nomor%2==0){ var bgc="even";}else{ var bgc="odd";}
					if(item.id_konten == <?=$id_konten;?>){
						table = table+ "<div class='widget-sidebox item "+bgc+"'>";
					} else {
						table = table+ "<a href=\"<?=site_url();?>read/direktori/"+item.id_konten+"/"+item.kat_seo+"/"+item.seo+"\"><div class='widget-sidebox item ada "+bgc+"'>";
					}
					table = table+nomor+". "+item.judul;
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
				$('#paging_direktori').html(data.pager);
				repaging_direktori();
		} else {
			$('#lainnya_<?=$id_kategori;?>').html("");
		}
}, 
        dataType:"json"});
}
////////////////////////////////////////////////////////////////////////////
</script>
<style>
#paging_direktori.panel-footer{padding-top:2px;padding-bottom:2px;text-align:right;	}
#paging_direktori.panel-footer .btn{padding:2px 8px 2px 8px;}
#paging_direktori.panel-body .btn{padding:2px 8px 2px 8px;}
</style>