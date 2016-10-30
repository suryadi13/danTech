<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><?=$setting;?></h3>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row gridPost">
	<div class="col-lg-12" style="padding-bottom:5px;">
									<a href="<?=site_url('admin/module/cmsadmin/sub_menu/menu_grup');?>" class="btn btn-default btn-xs pull-right">Sub Menu</a>
									<div class="btn btn-warning btn-xs pull-right">Menu Utama</div>
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->
<div class="row gridPost">
	<div class="col-lg-12">
		<div class="panel panel-warning" id="panel_utama">
			<div class="panel-heading" style="padding-top:2px;padding-bottom:5px;">
						<div class="row">
								<div class="col-lg-8" style="padding-top:8px;">
									<div class="dropdown"><button class="btn btn-primary dropdown-toggle btn-xs" type="button" id="ddMenuT" data-toggle="dropdown"><span class="fa fa-book fa-fw"></span></button>
										<ul class="dropdown-menu" role="menu" aria-labelledby="ddMenuT">
											<li role="presentation"><a role="menuitem" tabindex="-1" style="cursor:pointer;" onclick="loadForm('formtambah_menu_pengguna','xx','0','0');"><i class="fa fa-plus fa-fw"></i> Tambah Menu Pengguna</a></li>
										</ul>
										Daftar Menu
									</div>
								</div><!---/.col-lg-8 -->
								<div class="col-lg-4" style="padding-top:3px;">
										<select id="group_pil" onchange="loadIsiGrid(0,0);" class="form-control">
										<?php
										foreach($grup AS $key=>$val){
											$sl = ($key=0)?"selected":"";
											echo "<option value='".$val->group_id."' ".$sl.">".$val->group_name."</option>";
										}
										?>
										</select>
								</div><!---/.col-lg-4 -->
						</div><!---/.row -->
			</div>
			<div class="panel-body">
			<div class="table-responsive">
<table class="table table-striped table-hover">
<thead id=gridhead>
<tr height=35>
		<th width=100><b>NO.</b></th>
		<th width=65><b>AKSI</b></th>
		<th width=230><b>NAMA MENU</b></th>
		<th width=300><b>PATH MENU</b></th>
		<th><b>KETERANGAN</b></th>
		<th width=130><b>ICON MENU</b></th>
</tr>
</thead>
<tbody id=list>
<tr id=isi class=gridrow><td colspan=8 align=center><b>Isi Records</b></td></tr>
</tbody>
</table>
			</div><!-- table-responsive --->
			</div><!---/.panel-body -->
		</div><!-- /.panel -->
	</div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div id="formPost" style="display:none">Ini Form</div>
<script type="text/javascript"> 
$(document).ready(function(){
	loadIsiGrid(0,0)
});
////////////////////////////////////////////////////////////////////////////
function loadIsiGrid(idp,lvl){
var mulai=0;
var group_id = $('#group_pil').val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmsadmin/menu/getmenupengguna/",
				data:{"group_id": group_id,"idparent":idp,"level":lvl,"id_setting":"<?=$id_setting;?>","id_setting_ref":"<?=$id_setting_ref;?>"},
				success:function(data){
			if(idp==0){var ni="";} else{var ni=$("#nomer_"+idp+"").html()+".";}
			var table="";
			var j=0;
			var no=(mulai*1)+1;
			$.each( data.isi, function(index, item){
				if((no % 2) == 1){var seling="odd";}else{var seling="even";}
				table = table+ "<tr id='row_"+item.idchild+"'>";
				table = table+ "<td><b><div id='nomer_"+item.idchild+"'>"+ni+no+"</div></b></td>";
				table = table+ "<td>";
//tombol aksi-->
				if(item.cek!="ada"){
					if(item.toggle != "tutup"){
						table = table+ "<div id='tombol_hapus_"+item.idchild+"' class='btn btn-default btn-xs' onclick=\"loadForm('formhapus_menu_pengguna','"+item.idchild+"',"+(parseInt(lvl)+1)+",'"+item.id_parent+"');\" title='Klik untuk menghapus data'><i class='fa fa-trash fa-fw'></i></div>";
					}
				}
//tombol aksi<--
				table = table+ "</td>";
////////////////tombol treegrid && variabel kunci-->
				if(item.toggle == "tutup"){
					table = table+ "<td style='padding-left: "+ item.spare +"px;'><div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa tree fa-chevron-circle-right fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"no\"  id='"+item.idchild+"' onclick=\"loadIsiGrid('"+item.idchild+"','"+item.level+"');\"></i></div><div>"+item.nama_item+ "</div></td>";
				} else {
					table = table+ "<td style='padding-left: "+ item.spare +"px;'><div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa fa-file-o fa-fw\" style=\"font-size:16px;\" data-expand=\"no\"  id='"+item.idchild+"'></i></div><div>"+item.nama_item+ "</div></td>";
				}
////////////////tombol treegrid && variabel kunci<--
				table = table+ "<td>"+item.path_menu+"</td>";
				table = table+ "<td>"+item.keterangan+"</td>";
				table = table+ "<td>"+item.icon_menu+"</td>";
				table = table+ "</tr>";       
			no++;
			j++;
			}); //endeach
		if(lvl == 0){
			$('#list').html("<tr id=isi class=gridrow><td colspan=7 align=center><b>TIDAK ADA DATA</b></td></tr>");
			if(j!=0){$('#list').html(table);}
		} else {
			$(table).insertAfter("#row_"+idp);
			$("#"+idp).replaceWith("<span class=\"fa tree fa-chevron-circle-down fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"yes\"  id='"+idp+"'></span>");
		}

            }, //tutup::success
        dataType:"json"});
        return false;
}


////////////////////////////////////////////////////////////////////////////
$(document).on('click', '.fa.tree',function(){
	var lvl = $(this).attr("data-expand");
	var idp = $(this).attr("id");
	if(lvl=='yes'){
		$("[id^='row_"+idp+"_']").hide();
		$("#"+idp).replaceWith("<span class=\"fa tree fa-chevron-circle-right fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"no\"  id='"+idp+"'></span>");
	} else {
		$("[id^='"+idp+"_']").each(function(key,val) {
			var ini = $(this).attr("id");
			var status_ini = $(this).attr("data-expand");
			$("#row_"+ini+"").show();
			if(status_ini == "yes"){	$(this).removeClass("fa tree fa-chevron-circle-down fa-fw").addClass("fa tree fa-chevron-circle-right fa-fw").attr("data-expand","no");	}
		});
		$("[id^='"+idp+"_']").each(function(key,val) {	var ini = $(this).attr("id");	$("[id^='row_"+ini+"_']").hide();	});
		$("#"+idp).replaceWith("<span class=\"fa tree fa-chevron-circle-down fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"yes\"  id='"+idp+"'></span>");
	}
});
////////////////////////////////////////////////////////////////////////////
function loadForm(tujuan,idd,level,idparent){	
	var group_id=$("#group_pil").val();
	$("#formPost").html('');
	$(".gridPost").hide();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>cmsadmin/menu/"+tujuan+"/",
				data:{"idd":idd,"level":level,"idparent":idparent,"id_setting":"<?=$id_setting;?>","id_setting_ref":"<?=$id_setting_ref;?>","group_id": group_id },
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
