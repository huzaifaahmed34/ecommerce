<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {

public static function insertdata($data){
	 DB::table('contact')->insert($data);
      return 1;
}


}