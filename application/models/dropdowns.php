<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Dropdowns extends CI_Model {

  public function __construct() {
    parent::__construct();
  }


  function hari_konversi($asRef=false)  {
    $select ['Monday'] = 'Senin';
    $select ['Tuesday'] = 'Selasa';
    $select ['Wednesday'] = 'Rabu';
    $select ['Thursday'] = 'Kamis';
    $select ['Friday'] = "Jum'at";
    $select ['Saturday'] = 'Sabtu';
    $select ['Sunday'] = 'Minggu';
    
    return $select;
  }

  function bulan($asRef=false)  {
    if(!$asRef){
      $select [''] = 'Pilih Bulan';
    }else{
      $select [''] = '-';
    }
    $select [1] = 'Januari';
    $select [2] = 'Februari';
    $select [3] = 'Maret';
    $select [4] = 'April';
    $select [5] = 'Mei';
    $select [6] = 'Juni';
    $select [7] = 'Juli';
    $select [8] = 'Agustus';
    $select [9] = 'September';
    $select [10] = 'Oktober';
    $select [11] = 'November';
    $select [12] = 'Desember';
    
    return $select;
  }

}
