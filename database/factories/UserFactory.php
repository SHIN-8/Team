<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Place;
use App\Schedules;
use App\Userschedule;
use App\Result;
use App\Userresult;
use App\Pitchresult;
use Faker\Generator as Faker;
use Faker\Provider\UserAgent;

$factory->define(User::class, function (Faker $faker) {
    $position = ['投手','一塁手','二塁手','三塁手'];
    $subPosition = ['捕手','外野手','遊撃手'];
    $dominant = ['右投右打','右投左打','左投右打','左投左打','両投右打','両投左打','両投両打'];

    return [
        
        'number' =>$faker->unique()->numberBetween($min=1,$max=15),
        'Name' =>$faker->lastName,
        'password'=>$faker->password,
        'user_image'=>'icon.png',
        'user_img'=>'noimage.png',
        'FullName'=>$faker->name,
        'Birthday_y'=>$faker->year,
        'Birthday_m'=>$faker->month,
        'Birthday_d'=>$faker->dayOfMonth,
        'position'=>$faker->randomElement($position),
        'SubPosition'=>$faker->randomElement($subPosition),
        'dominant_hand'=>$faker->randomElement($dominant),
        'height'=>$faker->numberBetween($min=160,$max=190),
        'weight'=>$faker->numberBetween($min=60,$max=100),
        'admin'=>$faker->numberBetween($min=0,$max=1),
    ];
});

$factory->define(Place::class, function (Faker $faker) {

    return [
        'name'=>$faker->city,
        'adress'=>$faker->address,
    ];
});

$factory->define(Schedules::class, function (Faker $faker) {

    return [
       'game'=>$faker->numberBetween($min=1,$max=3),
       'date'=>$faker->dateTimeBetween($startDate='now',$endDate='+2years'),
       'opponent'=>$faker->word,
       's_t'=>$faker->time($format='H:i'),
       'f_t'=>$faker->time($format='H:i'),
       'place'=>$faker->numberBetween($min=1,$max=5),
    ];
});

$factory->define(Userschedule::class, function (Faker $faker) {
    return [
        'id'=>$faker->numberBetween($min=1,$max=16),
        'schedule_id'=>$faker->numberBetween($min=1,$max=11),
        'participation'=>$faker->numberBetween($min=1,$max=3),
    ];
});

$factory->define(Result::class, function (Faker $faker) {
    $wl = ['勝','負','引き分け'];
    $y = ['2020','2019'];


    return [
        'y'=>$faker->randomElement($y),
        'm'=>$faker->month,
        'd'=>$faker->dayOfMonth,
        'game'=>$faker->numberBetween($min=1,$max=3),
        'S_name'=>$faker->word,
        'K_name'=>$faker->word,
        'place'=>$faker->numberBetween($min=1,$max=5),
        'S1'=>$faker->numberBetween($min=0,$max=4),
        'S2'=>$faker->numberBetween($min=0,$max=4),
        'S3'=>$faker->numberBetween($min=0,$max=4),
        'S4'=>$faker->numberBetween($min=0,$max=4),
        'S5'=>$faker->numberBetween($min=0,$max=4),
        'S6'=>$faker->numberBetween($min=0,$max=4),
        'S7'=>$faker->numberBetween($min=0,$max=4),
        'S8'=>$faker->numberBetween($min=0,$max=4),
        'S9'=>$faker->numberBetween($min=0,$max=4),
        'K1'=>$faker->numberBetween($min=0,$max=4),
        'K2'=>$faker->numberBetween($min=0,$max=4),
        'K3'=>$faker->numberBetween($min=0,$max=4),
        'K4'=>$faker->numberBetween($min=0,$max=4),
        'K5'=>$faker->numberBetween($min=0,$max=4),
        'K6'=>$faker->numberBetween($min=0,$max=4),
        'K7'=>$faker->numberBetween($min=0,$max=4),
        'K8'=>$faker->numberBetween($min=0,$max=4),
        'K9'=>$faker->numberBetween($min=0,$max=4),
        'wl'=>$faker->randomElement($wl),
    ];
});

$factory->define(Userresult::class, function (Faker $faker) {
    $y = ['2020','2019'];
    $position = ['投','捕','一','二','遊','三','左','中','右','DH'];
    $def = ['投','捕','一','二','遊','三','左','中','右'];
    $re = ['安','２','３','本','ゴ','飛','直','三振','犠','犠飛','死球','四球'];

    return [
        'user_id'=>$faker->numberBetween($min=0,$max=15),
        'game_id'=>$faker->numberBetween($min=1,$max=10),
        'y'=>$faker->randomElement($y),
        'm'=>$faker->month,
        'day'=>$faker->dayOfMonth,
        'game'=>$faker->numberBetween($min=1,$max=3),
        'steal'=>$faker->numberBetween($min=0,$max=2),
        'ord'=>$faker->numberBetween($min=1,$max=9),
        'generation'=>$faker->numberBetween($min=1,$max=3),
        'position'=>$faker->randomElement($position),
        'ad'=>$faker->randomElement($def),
        'a'=>$faker->randomElement($re),
        'ar'=>$faker->numberBetween($min=0,$max=2),
        'bd'=>$faker->randomElement($def),
        'b'=>$faker->randomElement($re),
        'br'=>$faker->numberBetween($min=0,$max=2),
        'cd'=>$faker->randomElement($def),
        'c'=>$faker->randomElement($re),
        'cr'=>$faker->numberBetween($min=0,$max=2),
        'dd'=>$faker->randomElement($def),
        'd'=>$faker->randomElement($re),
        'dr'=>$faker->numberBetween($min=0,$max=2),
        'ed'=>$faker->randomElement($def),
        'e'=>$faker->randomElement($re),
        'er'=>$faker->numberBetween($min=0,$max=2),
        'fd'=>$faker->randomElement($def),
        'f'=>$faker->randomElement($re),
        'fr'=>$faker->numberBetween($min=0,$max=2),
        'gd'=>$faker->randomElement($def),
        'g'=>$faker->randomElement($re),
        'gr'=>$faker->numberBetween($min=0,$max=2),
        'hd'=>$faker->randomElement($def),
        'h'=>$faker->randomElement($re),
        'hr'=>$faker->numberBetween($min=0,$max=2),
        'i_d'=>$faker->randomElement($def),
        'i'=>$faker->randomElement($re),
        'ir'=>$faker->numberBetween($min=0,$max=2),

    ];
});

$factory->define(Pitchresult::class, function (Faker $faker) {
    $w = ['勝','負','Ｓ',''];
    $y = ['2020','2019'];
    $g = ['1'];


    return [
        'user_id'=>$faker->numberBetween($min=0,$max=15),
        'game_id'=>$faker->numberBetween($min=1,$max=10),
        'y'=>$faker->randomElement($y),
        'm'=>$faker->month,
        'd'=>$faker->dayOfMonth,
        'pitch_order'=>$faker->numberBetween($min=1,$max=3),
        'pitch_games'=>$faker->numberBetween($min=1,$max=3),
        'wins'=>$faker->randomElement($w),
        'inning'=>$faker->numberBetween($min=0,$max=4),
        'inningathird'=>$faker->numberBetween($min=0,$max=2),
        'earned_run'=>$faker->numberBetween($min=0,$max=2),
        'runs_allowed'=>$faker->numberBetween($min=0,$max=2),
        'k'=>$faker->numberBetween($min=0,$max=4),
        'give_four_dead_balls'=>$faker->numberBetween($min=0,$max=4),
    ];
});
