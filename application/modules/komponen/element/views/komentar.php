			<div class="row"><div class="col-lg-12">
				<div class="panel panel-success">
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li id="isi_komentar_key" onclick="pg_show();" class="active"><a href="#isi_komentar_div" data-toggle="tab"><i class="fa fa-briefcase"></i> Komentar</a></li>
                                <li id="form_komentar_key" onclick="pg_hide();"><a href="#form_komentar_div" data-toggle="tab"><i class="fa fa-ra"></i> Form</a></li>
                            </ul>
                            <!-- Tab panes -->
							<div class="tab-content" style="padding:0px 15px 0px 15px;">
								<div id="isi_komentar_div" class="tab-pane fade in active" style="padding-top:15px;">...</div>
								<div id="form_komentar_div" class="tab-pane fade in" style="padding-top:15px;padding-bottom:15px;">
    <form id="coment-form" method="post" action="<?=site_url('element/komentar/savekomentar');?>" enctype="multipart/form-data">
											<div class="row" style="line-height:35px;">
												<div class="col-lg-2"><b>Nama :</b></div>
												<div class="col-lg-10">
													<input type="text" name="nama_komentator" id="nama_komentator" value='' class="form-control">
												</div>
											</div>
											<div class="row" style="line-height:35px;">
												<div class="col-lg-2"><b>Email :</b></div>
												<div class="col-lg-10">
													<input type="text" name="email_komentator" id="email_komentator" value='' class="form-control">
												</div>
											</div>
											<div class="row">
												<div class="col-lg-2"><b>Komentar :</b></div>
												<div class="col-lg-10">
													<textarea name="isi_komentar" id="isi_komentar" style="height: 100px;"  class="form-control"></textarea>
												</div>
											</div>
											<div class="row">
												<div class="col-lg-2">&nbsp;</div>
	<input type=hidden name=jebakan value=''>
	<input type=hidden name=jebakan_waktu value='<?=date('H:i:s');?>'>
	<input type=hidden name=id_konten value='<?=$id_konten;?>'>
												<div class="col-lg-10" style="padding-top:15px;"><div id="btAct" class="btn btn-warning btn-xl" onclick="simpan();"><i class="fa fa-fast-forward"></i> Kirim</div></div>
											</div>
	</form>
								</div>
							</div>
						</div>
                        <!-- panel body -->
						<div class="panel-footer" id="paging_komentar"></div>
				</div>
				<!-- panel -->
			</div></div>
<form id="sb_act" method="post"></form>
<style>
.panel.panel-success .panel-body  {	padding:0px;	}
.panel-success .panel-heading  { padding:7px 0px 3px 7px; border-bottom: 1px dotted #ccc; color:#0000FF;	}
.panel-success .panel-body .nav-tabs { background-color:#eee;padding-left:15px;padding-top:5px; }
.panel-success .panel-body .nav-tabs li a { padding-right: 15px; padding-left: 15px; padding-top:7px; padding-bottom:7px; margin-left:0px;	}

#paging_komentar{padding-top:2px;padding-bottom:2px;text-align:right;	}
#paging_komentar .btn{padding:2px 8px 2px 8px;}
#paging_komentar .btn{padding:2px 8px 2px 8px;}
</style>


<script type="text/javascript">
$(document).ready(function(){
	gridkomen(1);
});
function pg_hide(){	$('#paging_komentar').hide();	}
function pg_show(){	$('#paging_komentar').show();	}

function validasi_pengikut(){
	var data="";
	var dati="";
			var nama = $.trim($("#nama_komentator").val());
			var mail = $.trim($("#email_komentator").val());
			var komn = $.trim($("#isi_komentar").val());
			data=data+""+nama+"";
			if( nama ==""){	dati=dati+"NAMA tidak boleh kosong\n";	}
			if( mail ==""){	dati=dati+"EMAIL tidak boleh kosong\n";	}
			if( komn ==""){	dati=dati+"ISI KOMENTAR tidak boleh kosong\n";	}
	if( dati !=""){
		alert(dati);
		return false;
	} else {return data;}
}
////////////////////////////////////////////////////////////////////////////
function simpan(){
	var hasil=validasi_pengikut();
	if (hasil!=false) {
			$.ajax({
			type:"POST",
			url:	$("#coment-form").attr('action'),
			data:$("#coment-form").serialize(),
			beforeSend:function(){	
				$('#btAct').replaceWith('<span id="btAct"><i class="fa fa-spinner fa-spin fa-2x"></i></span>');
			},
			success:function(data){
					var arr_result = data.split("#");
					if(arr_result[0]=='sukses'){
						$('#form_komentar_key').removeClass("active");
						$('#isi_komentar_key').addClass("active");
						$('#form_komentar_div').removeClass("active");
						$('#isi_komentar_div').addClass("active in");
						$("#coment-form")[0].reset();
						pg_show();
						gridkomen(1);
					} else {
						ppost();
					}
			},
			dataType:"html"});
//			return false;
	} //endif Hasil
}
////////////////////////////////////////////////////////////////////////////
function repaging_komentar(){
	$( "#paging_komentar .pagingframe div" ).addClass("btn btn-default");
	$( "#paging_komentar .pagingframe div" ).click(function() {
		var ini = $( this ).html();
		if(ini=="Prev" || ini=="Next"){	var inu=$(this).attr('data-hal');	} else {	var inu=$(this).html();	}
		if(!$(this).hasClass("active"))	{	gridkomen(inu);	}
	});
}

function gridkomen(hal){
//$('#kTab_1').html("<img src='<?=site_url();?>assets/images/loading1.gif'>");
			$.ajax({
				type:"POST",
				url:"<?=site_url();?>element/komentar/getkomen/",
				data:{ "hal": hal,"batas": 5,"idd": <?=$id_konten;?>},
				success:function(data){
if((data.hslquery.length)>0){
			var table="";
			$.each( data.hslquery, function(index, item){
				table = table+ '<div class="row" style="margin-top:0px; border-bottom:1px dotted #ccc;"><div class="col-lg-12"><div style="margin:0px;padding-top:3px;padding-bottom:3px;">'+item.isi_komentar+'<br /><small>'+item.nama_komentator+' | '+item.email_komentator+' | '+item.tanggal_komentar+'</small></div>';
				if(item.jawab=="ada"){	table = table+ '<div class="row"><div class="col-lg-12" style="padding-left:50px;padding-bottom:5px;"><div class="well well-sm" style="margin:0px;padding-top:3px;padding-bottom:3px;">'+item.jawaban+'<br /><small>'+item.tanggal_jawaban+'</small></div></div></div>';	}
				table = table+ "</div></div>";
			}); //endeach
//			table = table+'<div style="text-align:right;padding-top:10px;padding-bottom:10px;" id="paging_komentar">'+data.pager+'</div>';
			table = table+"<div class='clr'></div>";
				$('#isi_komentar_div').html(table);
				$('#paging_komentar').html(data.pager);
				repaging_komentar();
		} else {
			$('#paging_komentar').html(data.pager);
			$('#isi_komentar_div').html('<div style="padding-top:15px;padding-bottom:15px;">Tidak ada komentar</div>');
		}
}, 
        dataType:"json"});
}
////////////////////////////////////////////////////////////////////////////
function ppost(hal){
	$('#sb_act').attr('action','<?=site_url();?>');
	$('#sb_act').submit();
}
</script>
