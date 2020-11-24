<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('album', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img',255);
            $table->timestamps();
        });

        Schema::create('blog', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('img',255)->nullable();
            $table->text('text');
            $table->string('writer',20);
            $table->integer('release');
            $table->timestamps();
        });

        Schema::create('pitchresults', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('game_id');
            $table->integer('y');
            $table->integer('m');
            $table->integer('d');
            $table->integer('pitch_order');
            $table->integer('pitch_games');
            $table->string('wins',20)->nullable();
            $table->integer('inning')->nullable();
            $table->integer('inningathird')->nullable();
            $table->integer('earned_run')->nullable();
            $table->integer('runs_allowed')->nullable();
            $table->integer('k')->nullable();
            $table->integer('give_four_dead_balls')->nullable();
            $table->timestamps();
        });

        Schema::create('place', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
            $table->text('adress')->nullable();
            $table->timestamps();
        });

        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('y');
            $table->integer('m');
            $table->integer('d');
            $table->integer('game');
            $table->string('S_name',20);
            $table->string('K_name',20);
            $table->integer('place');
            $table->integer('S1')->default(0);
            $table->integer('S2')->default(0);
            $table->integer('S3')->default(0);
            $table->integer('S4')->default(0);
            $table->integer('S5')->default(0);
            $table->integer('S6')->default(0);
            $table->integer('S7')->default(0);
            $table->integer('S8')->default(0);
            $table->integer('S9')->default(0);
            $table->integer('K1')->default(0);
            $table->integer('K2')->default(0);
            $table->integer('K3')->default(0);
            $table->integer('K4')->default(0);
            $table->integer('K5')->default(0);
            $table->integer('K6')->default(0);
            $table->integer('K7')->default(0);
            $table->integer('K8')->default(0);
            $table->integer('K9')->default(0);
            $table->string('wl',20);
            $table->timestamps();
        });
        
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('game',20);
            $table->date('date');
            $table->string('opponent',20);
            $table->time('s_t');
            $table->time('f_t');
            $table->integer('place');
            $table->string('a',20)->nullable();
            $table->string('an',20)->nullable();
            $table->string('b',20)->nullable();
            $table->string('bn',20)->nullable();
            $table->string('c',20)->nullable();
            $table->string('cn',20)->nullable();
            $table->string('d_',20)->nullable();
            $table->string('dn',20)->nullable();
            $table->string('e',20)->nullable();
            $table->string('en',20)->nullable();
            $table->string('f',20)->nullable();
            $table->string('fn',20)->nullable();
            $table->string('g',20)->nullable();
            $table->string('gn',20)->nullable();
            $table->string('h',20)->nullable();
            $table->string('hn',20)->nullable();
            $table->string('i',20)->nullable();
            $table->string('i_n',20)->nullable();
            $table->timestamps();
        });


        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
            $table->string('img',255)->nullable();
            $table->text('comment');
            $table->string('place',20);
            $table->string('manager',20);
            $table->string('manager_name',20)->default('監督');
            $table->string('manager_comment',255);
            $table->string('Recruitment',255);
            $table->timestamps();
        });

        Schema::create('userresults', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('game_id');
            $table->integer('y');
            $table->integer('m');
            $table->integer('day');
            $table->integer('game');
            $table->integer('steal')->default(null)->nullable();
            $table->integer('ord');
            $table->integer('generation')->default(1);
            $table->string('position',20);
            $table->string('ad',3)->nullable();
            $table->string('a',3)->nullable();
            $table->integer('ar')->nullable();
            $table->string('bd',3)->nullable();
            $table->string('b',3)->nullable();
            $table->integer('br')->nullable();
            $table->string('cd',3)->nullable();
            $table->string('c',3)->nullable();
            $table->integer('cr')->nullable();
            $table->string('dd',3)->nullable();
            $table->string('d',3)->nullable();
            $table->integer('dr')->nullable();
            $table->string('ed',3)->nullable();
            $table->string('e',3)->nullable();
            $table->integer('er')->nullable();
            $table->string('fd',3)->nullable();
            $table->string('f',3)->nullable();
            $table->integer('fr')->nullable();
            $table->string('gd',3)->nullable();
            $table->string('g',3)->nullable();
            $table->integer('gr')->nullable();
            $table->string('hd',3)->nullable();
            $table->string('h',3)->nullable();
            $table->integer('hr')->nullable();
            $table->string('i_d',3)->nullable();
            $table->string('i',3)->nullable();
            $table->integer('ir')->nullable();
            $table->timestamps();

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number')->index();
            $table->string('Name',20)->default('名無し');
            $table->string('user_image',255)->default('icon.png')->nullable();
            $table->string('user_img',255)->default('noimage.png')->nullable();
            $table->string('password',255)->default(0000)->index();
            $table->string('remember_token',100)->nullable();
            $table->string('FullName',20)->default('名無し');
            $table->integer('Birthday_y')->nullable();
            $table->integer('Birthday_m')->nullable();
            $table->integer('Birthday_d')->nullable();
            $table->string('position',20)->nullable();
            $table->string('SubPosition',20)->nullable();
            $table->string('dominant_hand',20)->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('alma_mater',20)->nullable();
            $table->text('comment')->nullable();
            $table->integer('admin')->default(0);
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::create('userschedules', function (Blueprint $table) {
            $table->increments('user_schedule_id');
            $table->string('id');
            $table->integer('schedule_id');
            $table->string('participation');
            $table->timestamps();
        });
    });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('album');
        Schema::dropIfExists('blog');
        Schema::dropIfExists('pitchresults');
        Schema::dropIfExists('place');
        Schema::dropIfExists('results');
        Schema::dropIfExists('schedules');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('userresults');
        Schema::dropIfExists('users');
        Schema::dropIfExists('userschedules');
    }
}
