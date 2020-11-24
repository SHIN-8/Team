@extends('layouts.table')

@section('title','ave')

@section('content')
<thead>
    <tr>
        <th>
            <div class="playertitle contents text-nowrap">野手</div></th>
        <th>

        </th>
        <th>
            <div class="title text-nowrap">
            <a  href="{{ route('table.games',['year'=>$year,'GAME'=>$GAME]) }}">試合数</a>
            </div>
        </th>
        <th>
            <div class="titleSelect  text-nowrap">
                <a  href="{{ route('table.index',['year'=>$year,'GAME'=>$GAME]) }}">打率</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.r',['year'=>$year,'GAME'=>$GAME]) }}">打点</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.hits',['year'=>$year,'GAME'=>$GAME]) }}">安打</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.two',['year'=>$year,'GAME'=>$GAME]) }}">二塁打</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.three',['year'=>$year,'GAME'=>$GAME]) }}">三塁打</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.homerun',['year'=>$year,'GAME'=>$GAME]) }}">本塁打</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.atbat',['year'=>$year,'GAME'=>$GAME]) }}">打席</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.bat',['year'=>$year,'GAME'=>$GAME]) }}">打数</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.steal',['year'=>$year,'GAME'=>$GAME]) }}">盗塁</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.fourball',['year'=>$year,'GAME'=>$GAME]) }}">四死球</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.k',['year'=>$year,'GAME'=>$GAME]) }}">三振</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.bant',['year'=>$year,'GAME'=>$GAME]) }}">犠打</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.sacrificefly',['year'=>$year,'GAME'=>$GAME]) }}">犠飛</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.onbase',['year'=>$year,'GAME'=>$GAME]) }}">出塁率</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.slugging',['year'=>$year,'GAME'=>$GAME]) }}">長打率</a>
            </div>
        </th>
        <th>
            <div class="title text-nowrap">
                <a  href="{{ route('table.ops',['year'=>$year,'GAME'=>$GAME]) }}">OPS</a>
            </div>
        </th>
    </tr>
</thead>

@endsection

@section('content2')
        <?php
        if($GAME == 4){
            $game = App\Result::where('y',$year)->get()->count();
            $regular = $game*1.2;
            $orderresult = App\Userresult::groupBy('user_id')->where('y',$year);
        }else{
            $game = App\Result::where('y',$year)->where('game',$GAME)->get()->count();
            $regular = $game*1.2;
            $orderresult = App\Userresult::groupBy('user_id')->where('y',$year)->where('game',$GAME);
        }
            $STEAL = $orderresult->select('user_id',DB::raw('sum(steal) as total'))->get()->sortByDesc('total');
            $maxSTEAL = $STEAL->max('total');
            $GAMES = $orderresult->select('user_id',DB::raw('count(*) as total'))->get()->sortByDesc('total');
            $maxGAMES = $GAMES->max('total');
            $R = $orderresult->select('user_id',DB::raw('sum(ar)+sum(br)+sum(cr)+sum(dr)+sum(er)+sum(fr)+sum(gr)+sum(hr)+sum(ir) as total'))->get()->sortByDesc('total');
            $maxR = $R->max('total');
            $HITS = $orderresult->select('user_id',DB::raw('count(a = "安" or null)+count(b = "安" or null)+count(c = "安" or null)+count(d = "安" or null)+count(e = "安" or null)+count(f = "安" or null)+count(g = "安" or null)+count(h = "安" or null)+count(i = "安" or null)+count(a = "２" or null)+count(b = "２" or null)+count(c = "２" or null)+count(d = "２" or null)+count(e = "２" or null)+count(f = "２" or null)+count(g = "２" or null)+count(h = "２" or null)+count(i = "２" or null)+count(a = "３" or null)+count(b = "３" or null)+count(c = "３" or null)+count(d = "３" or null)+count(e = "３" or null)+count(f = "３" or null)+count(g = "３" or null)+count(h = "３" or null)+count(i = "３" or null)+count(a = "本" or null)+count(b = "本" or null)+count(c = "本" or null)+count(d = "本" or null)+count(e = "本" or null)+count(f = "本" or null)+count(g = "本" or null)+count(h = "本" or null)+count(i = "本" or null) as total'))->get()->sortByDesc('total');
            $maxHITS = $HITS->max('total');
            $TWO = $orderresult->select('user_id',DB::raw('count(a = "２"or null)+count(b = "２" or null)+count(c = "２" or null)+count(d = "２" or null)+count(e = "２" or null)+count(f = "２" or null)+count(g = "２" or null)+count(h = "２" or null)+count(i = "２" or null) as total'))->get()->sortByDesc('total');
            $maxTWO = $TWO->max('total');
            $THREE = $orderresult->select('user_id',DB::raw('count(a = "３"or null)+count(b = "３" or null)+count(c = "３" or null)+count(d = "３" or null)+count(e = "３" or null)+count(f = "３" or null)+count(g = "３" or null)+count(h = "３" or null)+count(i = "３" or null) as total'))->get()->sortByDesc('total');
            $maxTHREE = $THREE->max('total');
            $HOMERUN = $orderresult->select('user_id',DB::raw('count(a = "本"or null)+count(b = "本" or null)+count(c = "本" or null)+count(d = "本" or null)+count(e = "本" or null)+count(f = "本" or null)+count(g = "本" or null)+count(h = "本" or null)+count(i = "本" or null) as total'))->get()->sortByDesc('total');
            $maxHOMERUN = $HOMERUN->max('total');
            $NUMBEROFATBAT = $orderresult->select('user_id',DB::raw('count(a)+count(b)+count(c)+count(d)+count(e)+count(f)+count(g)+count(h)+count(i) as total'))->get()->sortByDesc('total');
            $maxNUMBEROFATBAT = $NUMBEROFATBAT->max('total');
            $FOURDEADBALL = $orderresult->select('user_id',DB::raw('count(a = "四球"or null)+count(b = "四球" or null)+count(c = "四球" or null)+count(d = "四球" or null)+count(e = "四球" or null)+count(f = "四球" or null)+count(g = "四球" or null)+count(h = "四球" or null)+count(i = "四球" or null)+count(a = "死球"or null)+count(b = "死球" or null)+count(c = "死球" or null)+count(d = "死球" or null)+count(e = "死球" or null)+count(f = "死球" or null)+count(g = "死球" or null)+count(h = "死球" or null)+count(i = "死球" or null) as total'))->get()->sortByDesc('total');
            $maxFOURDEADBALL = $FOURDEADBALL->max('total');
            $K= $orderresult->select('user_id',DB::raw('count(a = "三振"or null)+count(b = "三振" or null)+count(c = "三振" or null)+count(d = "三振" or null)+count(e = "三振" or null)+count(f = "三振" or null)+count(g = "三振" or null)+count(h = "三振" or null)+count(i = "三振" or null) as total'))->get()->sortByDesc('total');
            $maxK = $K->max('total');
            $BANT = $orderresult->select('user_id',DB::raw('count(a = "犠"or null)+count(b = "犠" or null)+count(c = "犠" or null)+count(d = "犠" or null)+count(e = "犠" or null)+count(f = "犠" or null)+count(g = "犠" or null)+count(h = "犠" or null)+count(i = "犠" or null) as total'))->get()->sortByDesc('total');
            $maxBANT = $BANT->max('total');
            $SACRIFICEFLY = $orderresult->select('user_id',DB::raw('count(a = "犠飛"or null)+count(b = "犠飛" or null)+count(c = "犠飛" or null)+count(d = "犠飛" or null)+count(e = "犠飛" or null)+count(f = "犠飛" or null)+count(g = "犠飛" or null)+count(h = "犠飛" or null)+count(i = "犠飛" or null) as total'))->get()->sortByDesc('total');
            $maxSACRIFICEFLY = $SACRIFICEFLY->max('total');
            $ATBAT = $orderresult->select('user_id',DB::raw('(count(a)+count(b)+count(c)+count(d)+count(e)+count(f)+count(g)+count(h)+count(i))-(count(a = "四球"or null)+count(b = "四球" or null)+count(c = "四球" or null)+count(d = "四球" or null)+count(e = "四球" or null)+count(f = "四球" or null)+count(g = "四球" or null)+count(h = "四球" or null)+count(i = "四球" or null)+count(a = "死球"or null)+count(b = "死球" or null)+count(c = "死球" or null)+count(d = "死球" or null)+count(e = "死球" or null)+count(f = "死球" or null)+count(g = "死球" or null)+count(h = "死球" or null)+count(i = "死球" or null))-(count(a = "犠"or null)+count(b = "犠" or null)+count(c = "犠" or null)+count(d = "犠" or null)+count(e = "犠" or null)+count(f = "犠" or null)+count(g = "犠" or null)+count(h = "犠" or null)+count(i = "犠" or null))-(count(a = "犠飛"or null)+count(b = "犠飛" or null)+count(c = "犠飛" or null)+count(d = "犠飛" or null)+count(e = "犠飛" or null)+count(f = "犠飛" or null)+count(g = "犠飛" or null)+count(h = "犠飛" or null)+count(i = "犠飛" or null)) as total'))->get()->sortByDesc('total');
            $maxATBAT = $ATBAT->max('total');
            $AVE = $orderresult->select('user_id',DB::raw('count(a)+count(b)+count(c)+count(d)+count(e)+count(f)+count(g)+count(h)+count(i) as atbat'),DB::raw('(count(a = "安" or null)+count(b = "安" or null)+count(c = "安" or null)+count(d = "安" or null)+count(e = "安" or null)+count(f = "安" or null)+count(g = "安" or null)+count(h = "安" or null)+count(i = "安" or null)+count(a = "２" or null)+count(b = "２" or null)+count(c = "２" or null)+count(d = "２" or null)+count(e = "２" or null)+count(f = "２" or null)+count(g = "２" or null)+count(h = "２" or null)+count(i = "２" or null)+count(a = "３" or null)+count(b = "３" or null)+count(c = "３" or null)+count(d = "３" or null)+count(e = "３" or null)+count(f = "３" or null)+count(g = "３" or null)+count(h = "３" or null)+count(i = "３" or null)+count(a = "本" or null)+count(b = "本" or null)+count(c = "本" or null)+count(d = "本" or null)+count(e = "本" or null)+count(f = "本" or null)+count(g = "本" or null)+count(h = "本" or null)+count(i = "本" or null))/((count(a)+count(b)+count(c)+count(d)+count(e)+count(f)+count(g)+count(h)+count(i))-(count(a = "四球"or null)+count(b = "四球" or null)+count(c = "四球" or null)+count(d = "四球" or null)+count(e = "四球" or null)+count(f = "四球" or null)+count(g = "四球" or null)+count(h = "四球" or null)+count(i = "四球" or null)+count(a = "死球"or null)+count(b = "死球" or null)+count(c = "死球" or null)+count(d = "死球" or null)+count(e = "死球" or null)+count(f = "死球" or null)+count(g = "死球" or null)+count(h = "死球" or null)+count(i = "死球" or null))-(count(a = "犠"or null)+count(b = "犠" or null)+count(c = "犠" or null)+count(d = "犠" or null)+count(e = "犠" or null)+count(f = "犠" or null)+count(g = "犠" or null)+count(h = "犠" or null)+count(i = "犠" or null))-(count(a = "犠飛"or null)+count(b = "犠飛" or null)+count(c = "犠飛" or null)+count(d = "犠飛" or null)+count(e = "犠飛" or null)+count(f = "犠飛" or null)+count(g = "犠飛" or null)+count(h = "犠飛" or null)+count(i = "犠飛" or null))) as total'))->get()->sortByDesc('total');
            $maxAVE = $AVE->where('atbat','>=',$regular)->max('total');
            $ONBASE = $orderresult->select('user_id',DB::raw('count(a)+count(b)+count(c)+count(d)+count(e)+count(f)+count(g)+count(h)+count(i) as atbat'),DB::raw('((count(a = "安" or null)+count(b = "安" or null)+count(c = "安" or null)+count(d = "安" or null)+count(e = "安" or null)+count(f = "安" or null)+count(g = "安" or null)+count(h = "安" or null)+count(i = "安" or null)+count(a = "２" or null)+count(b = "２" or null)+count(c = "２" or null)+count(d = "２" or null)+count(e = "２" or null)+count(f = "２" or null)+count(g = "２" or null)+count(h = "２" or null)+count(i = "２" or null)+count(a = "３" or null)+count(b = "３" or null)+count(c = "３" or null)+count(d = "３" or null)+count(e = "３" or null)+count(f = "３" or null)+count(g = "３" or null)+count(h = "３" or null)+count(i = "３" or null)+count(a = "本" or null)+count(b = "本" or null)+count(c = "本" or null)+count(d = "本" or null)+count(e = "本" or null)+count(f = "本" or null)+count(g = "本" or null)+count(h = "本" or null)+count(i = "本" or null))+(count(a = "四球"or null)+count(b = "四球" or null)+count(c = "四球" or null)+count(d = "四球" or null)+count(e = "四球" or null)+count(f = "四球" or null)+count(g = "四球" or null)+count(h = "四球" or null)+count(i = "四球" or null)+count(a = "死球"or null)+count(b = "死球" or null)+count(c = "死球" or null)+count(d = "死球" or null)+count(e = "死球" or null)+count(f = "死球" or null)+count(g = "死球" or null)+count(h = "死球" or null)+count(i = "死球" or null)))/(count(a)+count(b)+count(c)+count(d)+count(e)+count(f)+count(g)+count(h)+count(i)) as total'))->get()->sortByDesc('total');
            $maxONBASE = $ONBASE->where('atbat','>=',$regular)->max('total');
            $SLUGGING = $orderresult->select('user_id',DB::raw('count(a)+count(b)+count(c)+count(d)+count(e)+count(f)+count(g)+count(h)+count(i) as atbat'),DB::raw('(count(a = "安" or null)+count(b = "安" or null)+count(c = "安" or null)+count(d = "安" or null)+count(e = "安" or null)+count(f = "安" or null)+count(g = "安" or null)+count(h = "安" or null)+count(i = "安" or null)+count(a = "２" or null)*2+count(b = "２" or null)*2+count(c = "２" or null)*2+count(d = "２" or null)*2+count(e = "２" or null)*2+count(f = "２" or null)*2+count(g = "２" or null)*2+count(h = "２" or null)*2+count(i = "２" or null)*2+count(a = "３" or null)*3+count(b = "３" or null)*3+count(c = "３" or null)*3+count(d = "３" or null)*3+count(e = "３" or null)*3+count(f = "３" or null)*3+count(g = "３" or null)*3+count(h = "３" or null)*3+count(i = "３" or null)*3+count(a = "本" or null)*4+count(b = "本" or null)*4+count(c = "本" or null)*4+count(d = "本" or null)*4+count(e = "本" or null)*4+count(f = "本" or null)*4+count(g = "本" or null)*4+count(h = "本" or null)*4+count(i = "本" or null)*4)/((count(a)+count(b)+count(c)+count(d)+count(e)+count(f)+count(g)+count(h)+count(i))-(count(a = "四球"or null)+count(b = "四球" or null)+count(c = "四球" or null)+count(d = "四球" or null)+count(e = "四球" or null)+count(f = "四球" or null)+count(g = "四球" or null)+count(h = "四球" or null)+count(i = "四球" or null)+count(a = "死球"or null)+count(b = "死球" or null)+count(c = "死球" or null)+count(d = "死球" or null)+count(e = "死球" or null)+count(f = "死球" or null)+count(g = "死球" or null)+count(h = "死球" or null)+count(i = "死球" or null))-(count(a = "犠"or null)+count(b = "犠" or null)+count(c = "犠" or null)+count(d = "犠" or null)+count(e = "犠" or null)+count(f = "犠" or null)+count(g = "犠" or null)+count(h = "犠" or null)+count(i = "犠" or null))-(count(a = "犠飛"or null)+count(b = "犠飛" or null)+count(c = "犠飛" or null)+count(d = "犠飛" or null)+count(e = "犠飛" or null)+count(f = "犠飛" or null)+count(g = "犠飛" or null)+count(h = "犠飛" or null)+count(i = "犠飛" or null))) as total'))->get()->sortByDesc('total');
            $maxSLUGGING = $SLUGGING->where('atbat','>=',$regular)->max('total');
            $OPS = $orderresult->select('user_id',DB::raw('count(a)+count(b)+count(c)+count(d)+count(e)+count(f)+count(g)+count(h)+count(i) as atbat'),DB::raw('((count(a = "安" or null)+count(b = "安" or null)+count(c = "安" or null)+count(d = "安" or null)+count(e = "安" or null)+count(f = "安" or null)+count(g = "安" or null)+count(h = "安" or null)+count(i = "安" or null)+count(a = "２" or null)+count(b = "２" or null)+count(c = "２" or null)+count(d = "２" or null)+count(e = "２" or null)+count(f = "２" or null)+count(g = "２" or null)+count(h = "２" or null)+count(i = "２" or null)+count(a = "３" or null)+count(b = "３" or null)+count(c = "３" or null)+count(d = "３" or null)+count(e = "３" or null)+count(f = "３" or null)+count(g = "３" or null)+count(h = "３" or null)+count(i = "３" or null)+count(a = "本" or null)+count(b = "本" or null)+count(c = "本" or null)+count(d = "本" or null)+count(e = "本" or null)+count(f = "本" or null)+count(g = "本" or null)+count(h = "本" or null)+count(i = "本" or null))+(count(a = "四球"or null)+count(b = "四球" or null)+count(c = "四球" or null)+count(d = "四球" or null)+count(e = "四球" or null)+count(f = "四球" or null)+count(g = "四球" or null)+count(h = "四球" or null)+count(i = "四球" or null)+count(a = "死球"or null)+count(b = "死球" or null)+count(c = "死球" or null)+count(d = "死球" or null)+count(e = "死球" or null)+count(f = "死球" or null)+count(g = "死球" or null)+count(h = "死球" or null)+count(i = "死球" or null)))/(count(a)+count(b)+count(c)+count(d)+count(e)+count(f)+count(g)+count(h)+count(i))+(count(a = "安" or null)+count(b = "安" or null)+count(c = "安" or null)+count(d = "安" or null)+count(e = "安" or null)+count(f = "安" or null)+count(g = "安" or null)+count(h = "安" or null)+count(i = "安" or null)+count(a = "２" or null)*2+count(b = "２" or null)*2+count(c = "２" or null)*2+count(d = "２" or null)*2+count(e = "２" or null)*2+count(f = "２" or null)*2+count(g = "２" or null)*2+count(h = "２" or null)*2+count(i = "２" or null)*2+count(a = "３" or null)*3+count(b = "３" or null)*3+count(c = "３" or null)*3+count(d = "３" or null)*3+count(e = "３" or null)*3+count(f = "３" or null)*3+count(g = "３" or null)*3+count(h = "３" or null)*3+count(i = "３" or null)*3+count(a = "本" or null)*4+count(b = "本" or null)*4+count(c = "本" or null)*4+count(d = "本" or null)*4+count(e = "本" or null)*4+count(f = "本" or null)*4+count(g = "本" or null)*4+count(h = "本" or null)*4+count(i = "本" or null)*4)/((count(a)+count(b)+count(c)+count(d)+count(e)+count(f)+count(g)+count(h)+count(i))-(count(a = "四球"or null)+count(b = "四球" or null)+count(c = "四球" or null)+count(d = "四球" or null)+count(e = "四球" or null)+count(f = "四球" or null)+count(g = "四球" or null)+count(h = "四球" or null)+count(i = "四球" or null)+count(a = "死球"or null)+count(b = "死球" or null)+count(c = "死球" or null)+count(d = "死球" or null)+count(e = "死球" or null)+count(f = "死球" or null)+count(g = "死球" or null)+count(h = "死球" or null)+count(i = "死球" or null))-(count(a = "犠"or null)+count(b = "犠" or null)+count(c = "犠" or null)+count(d = "犠" or null)+count(e = "犠" or null)+count(f = "犠" or null)+count(g = "犠" or null)+count(h = "犠" or null)+count(i = "犠" or null))-(count(a = "犠飛"or null)+count(b = "犠飛" or null)+count(c = "犠飛" or null)+count(d = "犠飛" or null)+count(e = "犠飛" or null)+count(f = "犠飛" or null)+count(g = "犠飛" or null)+count(h = "犠飛" or null)+count(i = "犠飛" or null))) as total'))->get()->sortByDesc('total');
            $maxOPS = $OPS->where('atbat','>=',$regular)->max('total');
            $players = $AVE;
        ?>
@endsection

@section('content3')
<form action="{{ url('table') }}" method="get">
    <div class="row">
        <div class="d-flex align-items-start col-sm-3">
          <label for="custom-select-1b" class="text-nowrap"><h4>年度</h4></label>
            <input type="text" name="year" class="col-8" value="{{$year}}">
        </div>
        <div class="d-flex align-items-start col-sm-4">
          <label for="custom-select-1b" class="text-nowrap"><h4>形式</h4></label>
              <select name="GAME" id="custom-select-1b" class="custom-select form-control-sm col-8" value="{{$GAME}}">
                  @if($GAME == 4)
                    <option value="4">全て</option>
                  @elseif($GAME == 1)
                    <option value="1">大会</option>
                  @elseif($GAME == 2)
                    <option value="2">練習試合</option>
                  @elseif($GAME == 3)
                    <option value="3">練習</option>
                  @else
                    <option></option>
                  @endif
                    <option value="1">大会</option>
                    <option value="2">練習試合</option>
                    <option value="3">練習</option>
                    <option value="4">全て</option>
              </select>
        </div>
            <div class="col-sm-2">
                <input type="submit" class="btn btn-info btn-block" value="検索">
            </div>
      </form>
  <br>
  @endsection
