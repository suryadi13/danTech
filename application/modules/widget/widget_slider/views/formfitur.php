<div class="table-responsive"  id="settingGrid">
<table class="table table-striped table-hover" width=800>
<thead>
<tr>
<th width=100>No.</th>
<th>KONTEN</th>
<th width=150>SLIDER</th>
</tr>
</thead>
				<tbody>
<?php
foreach($daftar AS $key=>$val){
?>
<tr>
<td><?=$key+1;?></td>
<td><small><?=$val->hari;?>, <?=$val->tanggal;?> :: <?=$val->nama_kategori;?></small><div><h4 style="margin-top:0px;"><?=$val->judul;?></h4></td>
<td style="padding:3px;">
<div class="thumbnail" style="width:120px;"><div class="caption"><p><a href="#" class="label label-info" onclick="upslider('<?=$val->id_konten;?>');return false;"><i class="fa fa-upload fa-fw"></i> Atur File</a></p></div><?=$val->slider;?></div>
</td>
</tr>
<?php
}
?>
				</tbody>
			</table>
</div>

<div id="settingForm" style="display:none;">nkkjj</div>
<script type="text/javascript">
$(document).ready(function(){
	cap_hover();
});

function upslider(idd){	
	$("#settingForm").html('');
	$("#settingGrid").hide();
	var rubrik = $("#rubrik").val();
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>widget_hl_slider/formadmin/form_upload",
				data:{"idd": idd },
				beforeSend:function(){	 },
				success:function(data){
					$("#settingForm").html(data);
//					loadDialogTutup();
					}, 
				dataType:"html"});
	$("#settingForm").show();
	return false;
}	

function cap_hover(){
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 
}

function kembali(){
	$("#settingForm").html('').hide();
	$("#settingGrid").show();
}

</script>
<style>
table th {	color:#fff; background-color:#ccc; line-height:35px; padding:0px;	}
.pagingframe {	float:right;	}
.pagingframe div {	padding-left:7px;padding-right:7px;	}
.thumbnail {	position:relative;	overflow:hidden; margin-bottom:0px;	}
.caption {    position:absolute;    top:0;    right:0;    background:rgba(66, 139, 202, 0.75);    width:100%;    height:100%;    padding:2%;    display: none;    text-align:center;    color:#fff !important;	z-index:2;	}
</style>
