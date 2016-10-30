<div class="table-responsive" id="gridPost">
<table class="table table-striped table-hover" style="margin-bottom:0px;">
<tbody id=gridisi>
<tr height=20>
<td align=right colspan=8 class='gridcell left'>&nbsp;</td>
</tr>
</tbody>
</table>
</div>

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
				table = table+ "<tr id='row_"+item.idchild+"' height='25'>";
				if(item.banyak_file==0){	var banyak = item.judul_appe;	} else {	var banyak = item.judul_appe+' <div class="btn btn-warning btn-xs" onClick="loadForm(\'pilihmedia\',\''+item.idchild +'\','+(parseInt(lvl)+1)+',\''+item.idchild+'\');">: '+item.banyak_file+'</div>';	}
////////////////tombol treegrid && variabel kunci-->
				if(item.toggle == "tutup"){
					table = table+ "<td style='padding-left: "+ item.spare +"px;padding-top:1px;padding-bottom:0px;'><div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa tree fa-folder fa-fw\" style=\"font-size:16px; cursor: pointer;\" data-expand=\"no\"  id='"+item.idchild+"' onclick=\"loadIsiGrid('"+item.idchild+"','"+item.level+"');\"></i></div>"+banyak+ "</td>";
				} else {
					table = table+ "<td style='padding-left: "+ item.spare +"px;padding-top:1px;padding-bottom:0px;'><div style=\"float:left; padding:1px 5px 0px 0px;\"><i class=\"fa fa-folder-o fa-fw\" style=\"font-size:16px;\" data-expand=\"no\"  id='"+item.idchild+"'></i></div>"+banyak+"</td>";
				}
////////////////tombol treegrid && variabel kunci<--
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
	$("#gridPost").hide();
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
function batalX(){
	$("#formPost").hide();
	$("#gridPost").show();
	return false;
}
</script>
<style>
table th {	color:#fff; background-color:#ccc; line-height:35px; padding:0px;	}
</style>
