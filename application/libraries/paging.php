<?php
////////////////////////////////////////////////////////////////
class Paging {
	function halaman($banyakItem,$banyakBat,$hal,$banyakHal){
		$batas=($hal-1)*$banyakBat;
		$atas=$batas+$banyakBat;
		$page=ceil($banyakItem/$banyakBat);
		$pagel=ceil($page/$banyakHal);
		$beem=ceil($hal/$banyakHal);
		$beem_a=(($beem-1)*$banyakHal)+1;
		$beem_z=($beem!=$pagel)?$beem_a+$banyakHal:$page+1;

		$hasilHal['hal'][0]=($beem!=1)?"<div data-hal='".($beem-1)*$banyakHal."'>Prev</div>":"<div class='active'>Prev</div>";
			$i=1;
		for($bw=$beem_a;$bw<$beem_z;$bw++){
			$hasilHal['hal'][$i]=($hal!=$bw)?"<div>$bw</div>":"<div class='active'>$bw</div>";
			$i++;
		}
		$hasilHal['hal'][$i]=($beem!=$pagel)?"<div data-hal='".$bw."'>Next</div>":"<div class='active'>Next</div>";
		$hasilHal['b_halmax']=$page;

		return $hasilHal;
	}
	function halamanB($banyakItem,$banyakBat,$hal,$banyakHal){
		$batas=($hal-1)*$banyakBat;
		$atas=$batas+$banyakBat;
		$page=ceil($banyakItem/$banyakBat);
		$pagel=ceil($page/$banyakHal);
		$beem=ceil($hal/$banyakHal);
		$beem_a=(($beem-1)*$banyakHal)+1;
		$beem_z=($beem!=$pagel)?$beem_a+$banyakHal:$page+1;

		$hasilHal['hal'][0]=($beem!=1)?"<div><a href='XX/".($beem-1)*$banyakHal."/YY'>Prev</a></div>":"<div class='active'>Prev</div>";
			$i=1;
		for($bw=$beem_a;$bw<$beem_z;$bw++){
			$hasilHal['hal'][$i]=($hal!=$bw)?"<a href='XX/$bw/YY' class='btn btn-default'>$bw</a>":"<div class='active'>$bw</div>";
			$i++;
		}
		$hasilHal['hal'][$i]=($beem!=$pagel)?"<div><a href='XX/$bw/YY'>Next</a></div>":"<div class='active'>Next</div>";
		$hasilHal['b_halmax']=$page;

		return $hasilHal;
	}
}
?>