<?php
namespace App\Library;
use Illuminate\Http\Request;

// 共通関数(TableControllerで使用)
class Common {
  public static function year(Request $request){
        $y = date("Y");
        $year = $request->input('year',$y);
        return $year;
  }

  public static function game(Request $request){
    $GAME = $request->input('GAME',4);
    return $GAME;
}
}
?>