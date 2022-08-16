<?php

namespace App\Library;

use Illuminate\Support\Facades\Facade;

class Func extends Facade
{

  public function convertEmptyValueToNull($val){
    $result=(strlen($val)>0)?$val:null;
    return $result;
  }

}
