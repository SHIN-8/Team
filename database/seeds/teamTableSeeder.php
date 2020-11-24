<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class teamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->truncate();
        $test = [
            'name' => 'チーム名',
            'comment' => 'コメント',
            'place' => '活動場所',
            'manager' => '代表者',
            'manager_name' => 'テスト',
            'manager_comment' => 'コメント',
            'Recruitment' => '選手募集について',
        ];
        DB::table('teams')->insert($test);

        DB::table('users')->delete();
        $sampleUser = [
        'user_image'=>'icon.png',
        'user_img'=>'noimage.png',
        'number' =>'0',
        'Name' =>'テスト',
        'password'=>'0000',
        'FullName'=>'テスト',
        'Birthday_y'=>'1900',
        'Birthday_m'=>'1',
        'Birthday_d'=>'1',
        'position'=>'投手',
        'dominant_hand'=>'右投右打',
        'height'=>'195',
        'weight'=>'60',
        'admin'=>'1',
        'created_at'=>'2020-1-1',
        'updated_at'=>'2020-1-1',
        ];
        DB::table('users')->insert($sampleUser);

        DB::table('blog')->truncate();
        $sampleBlog = [
        'title'=>'サンプル(タイトル)',
        'text'=>'サンプル(本文)',
        'writer'=>'1',
        'img' => '33a991809961f7b7fe1974109d87ddd3_s.jpg',
        'release' => '1',
        'created_at'=>'2020-1-1',
        'updated_at'=>'2020-1-1',
        ];
        DB::table('blog')->insert($sampleBlog);
        
        DB::table('place')->truncate();
        $samplePlace = [
        'name'=>'球場名',
        'adress'=>'球場の住所',
        'created_at'=>'2020-1-1',
        'updated_at'=>'2020-1-1',
        ];
        DB::table('place')->insert($samplePlace);
        
        DB::table('schedules')->truncate();
        $sampleSchedules = [
            'game'=>'公式戦',
            'date'=>'2020-12-31',
            'opponent'=>'対戦相手',
            's_t'=>'12:30',
            'f_t'=>'13:30',
            'place'=>'1',
            'created_at'=>'2020-1-1',
            'updated_at'=>'2020-1-1',    
        ];
        DB::table('schedules')->insert($sampleSchedules);

        DB::table('results')->truncate();
        $sampleResult = [
            'y'=>'2020',
            'm'=>'1',
            'd'=>'1',
            'game'=>'1',
            'S_name'=>'先行チーム',
            'K_name'=>'後攻チーム',
            'place'=>'1',
            'S1'=>'0',
            'S2'=>'1',
            'S3'=>'2',
            'S4'=>'3',
            'S5'=>'4',
            'S6'=>'5',
            'S7'=>'6',
            'S8'=>'7',
            'S9'=>'8',
            'K1'=>'0',
            'K2'=>'1',
            'K3'=>'2',
            'K4'=>'3',
            'K5'=>'4',
            'K6'=>'5',
            'K7'=>'6',
            'K8'=>'7',
            'K9'=>'8',
            'wl'=>'引き分け',
            'created_at'=>'2020-1-1',
            'updated_at'=>'2020-1-1',    
        ];
        DB::table('results')->insert($sampleResult);
        DB::table('userschedules')->truncate();
        DB::table('userresults')->truncate();
        DB::table('pitchresults')->truncate();


        factory(App\User::class,15)->create();
        factory(App\Place::class,5)->create();
        factory(App\Schedules::class,10)->create();
        factory(App\Userschedule::class,100)->create();
        factory(App\Result::class,10)->create();
        factory(App\Userresult::class,20)->create();
        factory(App\Pitchresult::class,20)->create();
    }
}
