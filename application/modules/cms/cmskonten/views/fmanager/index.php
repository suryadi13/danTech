<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><?=$satu;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="row gridPost">
	<div class="col-lg-12">
		<div class="panel panel-warning" id="panel_utama">
			<div class="panel-heading">
						<div class="row">
								<div class="col-lg-6">
									<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-book fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm('formtambah_folder','xx','0','0');"><i class="fa fa-plus fa-fw"></i> Buat Folder</a></li>
										</ul>
										Daftar Folder
									</div>
								</div><!---/.col-lg-6 -->
						</div><!---/.row -->
			</div>
			<div class="panel-body">

<div class="table-responsive">
<table class="table table-striped table-hover">
<thead id=gridhead>
<tr height=35>
		<th width=100><b>NO.</b></th>
		<th width=65><b>AKSI</b></th>
		<th width=300><b>FOLDER / SUB-FOLDER</b></th>
		<th><b>KETERANGAN</b></th>
		<th width=130><b>FILE ISI FOLDER</b></th>
</tr>
</thead>
<tbody id=gridisi>
<tr height=20>
<td align=right colspan=8 class='gridcell left'>&nbsp;</td>
</tr>
</tbody>
</table>
</div>

			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->


<div id="formPost" style="display:none">Ini Form</div>
<script type="text/javascript"> 
$(document).ready(function(){
	loadIsiGrid(0,0);
});

////////////////////////////////////////////////////////////////////////////
function loadIsiGrid(idp,lvl){
var mulai=0;
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmskonten/fmanager/getitem/",
				data:{"idparent":idp,"level":lvl},
				success:function(data){
		if((data.isi.length)>0){
			if(idp==0){var ni="";} else{var ni=$("#nomer_"+idp+"").html()+".";}
			var table="";
			var j=0;
			var no=(mulai*1)+1;
			$.each( data.isi, function(index, item){
				table = table+ "<tr id='row_"+item.idchild+"'>";
				table = table+ "<td><b><div id='nomer_"+item.idchild+"'>"+ni+no+"</div></b></td>";
				table = table+ "<td>";
//tombol aksi-->
						table = table+ '<div class="dropdown"><button class="btn btn-default dropdown-toggle btn-xs" type="button" data-toggle="dropdown"><i class="fa fa-caret-down fa-fw"></i></button>';
						table = table+ '<ul class="dropdown-menu" role="menu">';
						table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="loadForm(\'formtambah_folder\',\''+item.id_appe+'\',\''+item.level +'\',\''+item.idchild +'\');"><i class="fa fa-plus fa-fw"></i> Tambah folder</a></li>';
						if(item.cek!="ada"){
							if(item.toggle != "tutup"){
								table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="loadForm(\'formedit_folder\',\''+item.idchild +'\','+(parseInt(lvl)+1)+',\''+item.idchild+'\');"><i class="fa fa-edit fa-fw"></i> Edit folder</a></li>';
								table = table+ '<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onClick="loadForm(\'formhapus_folder\',\''+item.idchild +'\','+(parseInt(lvl)+1)+',\''+item.idchild+'\');"><i class="fa fa-trash fa-fw"></i> Hapus folder</a></li>';
							}
						}
						table = table+ "</ul>";
						table = table+ "</div>";
//tombol aksi<--
				table = table+ "</td>";
////////////////tombol treegrid && variabel kunci-->
				if(item.toggle == "tutup"){
					table = table+ "<td style='padding-left: "+ item.spare +"px;'><div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa tree fa-folder fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"no\"  id='"+item.idchild+"' onclick=\"loadIsiGrid('"+item.idchild+"','"+item.level+"');\"></i></div><div>"+item.judul_appe+ "</div></td>";
				} else {
					table = table+ "<td style='padding-left: "+ item.spare +"px;'><div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa fa-folder-o fa-fw\" style=\"font-size:16px;\" data-expand=\"no\"  id='"+item.idchild+"'></i></div><div>"+item.judul_appe+ "</div></td>";
				}
////////////////tombol treegrid && variabel kunci<--
				if(item.banyak_file==0){	var banyak = "<div class='btn btn-default btn-xs' onClick=\"loadForm('formfile','"+item.idchild +"',"+(parseInt(lvl)+1)+",'"+item.idchild+"');\">kosong</div>";	} else {	var banyak = "<div class='btn btn-warning btn-xs' onClick=\"loadForm('formfile','"+item.idchild +"',"+(parseInt(lvl)+1)+",'"+item.idchild+"');\">"+item.banyak_file+" file</div>";	}
				table = table+ "<td>"+item.keterangan_appe+"</td>";
				table = table+ "<td>"+banyak+"</td>";
				table = table+ "</tr>";       
			no++;
			j++;
			}); //endeach

		if(lvl == 0){
			$("#gridisi").html("<tr id=isi><td colspan=6 align=center><b>TIDAK ADA DATA</b></td></tr>");
			if(j!=0){$('#isi').replaceWith(table);}
		} else {
			$(table).insertAfter("#row_"+idp);
			$("#"+idp).replaceWith("<span class=\"fa tree fa-folder-open fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"yes\"  id='"+idp+"'></span>");
		}

}  //tutup:: if data>0	
            }, //tutup::success
        dataType:"json"});
        return false;
}


////////////////////////////////////////////////////////////////////////////
function urutan( idini,idp,lvl,urutanini,idlawan,urutanlawan,opt){
	if(lvl!=0){	$("[id^='row_"+idp+"_']").remove();	} else {	$("[id^='row_']").remove();	}
	if(opt=="naik"){
		var id_ini = idini;
		var urutan_ini = urutanini;
		var id_lawan = idlawan;
		var urutan_lawan = urutanlawan;
	} else {
		var id_lawan = idini;
		var urutan_lawan = urutanini;
		var id_ini = idlawan;
		var urutan_ini = urutanlawan;
	}
	$.ajax({	type:"POST",	url:"<?=site_url();?>cmsadmin/menu/naik_aksi",	data:{"setting":"<?=$setting;?>","id_ini": id_ini,"id_lawan": id_lawan,"urutan_ini": urutan_ini,"urutan_lawan": urutan_lawan },
				success:function(data){	loadIsiGrid(idp,lvl); }, 
				dataType:"html"	});
}
////////////////////////////////////////////////////////////////////////////
$(document).on('click', '.fa.tree',function(){
	var lvl = $(this).attr("data-expand");
	var idp = $(this).attr("id");
	if(lvl=='yes'){
		$("[id^='row_"+idp+"_']").hide();
		$("#"+idp).replaceWith("<span class=\"fa tree fa-folder fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"no\"  id='"+idp+"'></span>");
	} else {
		$("[id^='"+idp+"_']").each(function(key,val) {
			var ini = $(this).attr("id");
			var status_ini = $(this).attr("data-expand");
			$("#row_"+ini+"").show();
			if(status_ini == "yes"){	$(this).removeClass("fa tree fa-folder-open fa-fw").addClass("fa tree fa-folder fa-fw").attr("data-expand","no");	}
		});
		$("[id^='"+idp+"_']").each(function(key,val) {	var ini = $(this).attr("id");	$("[id^='row_"+ini+"_']").hide();	});
		$("#"+idp).replaceWith("<span class=\"fa tree fa-folder-open fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"yes\"  id='"+idp+"'></span>");
	}
});
////////////////////////////////////////////////////////////////////////////
function loadForm(tujuan,idd,level,idparent){	
	$("#formPost").html('');
	$(".gridPost").hide();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmskonten/fmanager/"+tujuan+"/",
				data:{"idd":idd,"level":level,"idparent":idparent },
				success:function(data){
					$("#formPost").html(data);
					}, 
				dataType:"html"});
	$("#formPost").show();
	return false;
}	
function batal(){
	$("#formPost").hide();
	$(".gridPost").show();
	return false;
}
</script>
<style>
table th {	color:#fff; background-color:#ccc; line-height:35px; padding:0px;	}
</style>
