<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\User;
use App\Userschedule;
use App\Userresult;
use App\Pitchresult;
use App\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function index(){
        $users = User::get()->sortBy('number');

        return view('users.index',compact('users'));
    }

    public function show($id){
        $y = date("Y");
        $auth = Auth::user();
        $user = User::findOrFail($id);
        $userresults = Userresult::where('user_id',$user->number)->where('y',$y)->get();
        $a = Userresult::select('a')->where('user_id',$user->number)->where('y',$y)->get();
        $b = Userresult::select('b')->where('user_id',$user->number)->where('y',$y)->get();
        $c = Userresult::select('c')->where('user_id',$user->number)->where('y',$y)->get();
        $d = Userresult::select('d')->where('user_id',$user->number)->where('y',$y)->get();
        $e = Userresult::select('e')->where('user_id',$user->number)->where('y',$y)->get();
        $f = Userresult::select('f')->where('user_id',$user->number)->where('y',$y)->get();
        $g = Userresult::select('g')->where('user_id',$user->number)->where('y',$y)->get();
        $h = Userresult::select('h')->where('user_id',$user->number)->where('y',$y)->get();
        $i = Userresult::select('i')->where('user_id',$user->number)->where('y',$y)->get();
        $ad = Userresult::select('ad')->where('user_id',$user->number)->where('y',$y)->get();
        $bd = Userresult::select('bd')->where('user_id',$user->number)->where('y',$y)->get();
        $cd = Userresult::select('cd')->where('user_id',$user->number)->where('y',$y)->get();
        $dd = Userresult::select('dd')->where('user_id',$user->number)->where('y',$y)->get();
        $ed = Userresult::select('ed')->where('user_id',$user->number)->where('y',$y)->get();
        $fd = Userresult::select('fd')->where('user_id',$user->number)->where('y',$y)->get();
        $gd = Userresult::select('gd')->where('user_id',$user->number)->where('y',$y)->get();
        $hd = Userresult::select('hd')->where('user_id',$user->number)->where('y',$y)->get();
        $i_d = Userresult::select('i_d')->where('user_id',$user->number)->where('y',$y)->get();

        $pitchresults = Pitchresult::where('user_id',$user->number)->where('y',$y)->get();
        $wins = Pitchresult::select('wins')->where('user_id',$user->number)->where('y',$y)->get();

        return view('users.show',compact(
        'user','userresults','pitchresults',
        'a','b','c','d','e','f','g','h','i',
        'ad','bd','cd','dd','ed','fd','gd','hd','i_d',
        'wins','y'
    ));
    }

    public function total($id){
        $y = date("Y");

        $user = User::findOrFail($id);
        $userresultsT = Userresult::where('user_id',$user->number)->get();
        $aT = Userresult::select('a')->where('user_id',$user->number)->get();
        $bT = Userresult::select('b')->where('user_id',$user->number)->get();
        $cT = Userresult::select('c')->where('user_id',$user->number)->get();
        $dT = Userresult::select('d')->where('user_id',$user->number)->get();
        $eT = Userresult::select('e')->where('user_id',$user->number)->get();
        $fT = Userresult::select('f')->where('user_id',$user->number)->get();
        $gT = Userresult::select('g')->where('user_id',$user->number)->get();
        $hT = Userresult::select('h')->where('user_id',$user->number)->get();
        $iT = Userresult::select('i')->where('user_id',$user->number)->get();
        $adT = Userresult::select('ad')->where('user_id',$user->number)->get();
        $bdT = Userresult::select('bd')->where('user_id',$user->number)->get();
        $cdT = Userresult::select('cd')->where('user_id',$user->number)->get();
        $ddT = Userresult::select('dd')->where('user_id',$user->number)->get();
        $edT = Userresult::select('ed')->where('user_id',$user->number)->get();
        $fdT = Userresult::select('fd')->where('user_id',$user->number)->get();
        $gdT = Userresult::select('gd')->where('user_id',$user->number)->get();
        $hdT = Userresult::select('hd')->where('user_id',$user->number)->get();
        $i_dT = Userresult::select('i_d')->where('user_id',$user->number)->get();

        $pitchresultsT = Pitchresult::where('user_id',$user->number)->get();
        $winsT = Pitchresult::select('wins')->where('user_id',$user->number)->get();

        return view('users.total',compact(
        'user','y','userresultsT','pitchresultsT','aT','bT','cT','dT','eT','fT','gT','hT','iT',
        'adT','bdT','cdT','ddT','edT','fdT','gdT','hdT','i_dT',
        'winsT'
    ));
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $users = User::get()->sortBy('number');
        if(Auth::check()){
            if(Auth::user()->admin == 1 || Auth::user()->id == $user->id){
                return view('users.edit',compact('user'));
            }else{
                return redirect()->route('users.index',compact('users'))
                ->withInput()->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }
    }

    public function create(){
        $users = User::get()->sortBy('number');

        if(Auth::check()){
            if(Auth::user()->admin == 1){
                return view('users.create');
            }else{
                return redirect()->route('users.index',compact('users'))
                ->withInput()->with('message','管理者としてログインして下さい');
            }
        }else{
            return redirect()->route('login')->withInput()->with('message','ログインして下さい');
        }
            return view('users.create');
    }


    public function store(Request $request,user $user){
        $rules = [
            'number' => ['required','integer','digits_between:1,3','unique:users,number'],
            'Name' => ['required'],
            'FullName' => ['required'],
            'Birthday_y' => ['required',],
            'Birthday_m' => ['required'],
            'Birthday_d' => ['required'],
            'position' => ['required'],
            'SubPosition' => ['nullable','different:position'],
            'dominant_hand' => ['required'],
            'height' => ['nullable','integer','between:100,200'],
            'weight' => ['nullable','integer','between:30,150'],
            'alma_mater' => ['nullable'],
            'user_img' => ['nullable'],
            'user_image' => ['nullable'],

        ];
        $this->validate($request,$rules);

        // 以下画像登録処理(もう少しスマートに書きたい)
        if($request->hasFile('user_img') && $request->hasFile('user_image')){
        User::create([
            'number' => $request['number'],
            'Name' => $request['Name'],
            'FullName' => $request['FullName'],
            'Birthday_y' => $request['Birthday_y'],
            'Birthday_m' => $request['Birthday_m'],
            'Birthday_d' => $request['Birthday_d'],
            'position' => $request['position'],
            'SubPosition' => $request['SubPosition'],
            'dominant_hand' => $request['dominant_hand'],
            'height' => $request['height'],
            'weight' => $request['weight'],
            'alma_mater' => $request['alma_mater'],
            'password' => Hash::make($request['password']),
            'user_img' => $name = $request->file('user_img')->getClientOriginalName(),
            'user_image' => $filename = $request->file('user_image')->getClientOriginalName(),
        ]);
        $request->file('user_img')->storeAs('public/img',$name);
        $request->file('user_image')->storeAs('public/img',$filename);
        }elseif($request->hasFile('user_img')){
            User::create([
                'number' => $request['number'],
                'Name' => $request['Name'],
                'FullName' => $request['FullName'],
                'Birthday_y' => $request['Birthday_y'],
                'Birthday_m' => $request['Birthday_m'],
                'Birthday_d' => $request['Birthday_d'],
                'position' => $request['position'],
                'SubPosition' => $request['SubPosition'],
                'dominant_hand' => $request['dominant_hand'],
                'height' => $request['height'],
                'weight' => $request['weight'],
                'alma_mater' => $request['alma_mater'],
                'password' => Hash::make($request['password']),
                'user_img' => $name = $request->file('user_img')->getClientOriginalName(),
            ]);
            $request->file('user_img')->storeAs('public/img',$name);
       }elseif($request->hasFile('user_image')){
        User::create([
            'number' => $request['number'],
            'Name' => $request['Name'],
            'FullName' => $request['FullName'],
            'Birthday_y' => $request['Birthday_y'],
            'Birthday_m' => $request['Birthday_m'],
            'Birthday_d' => $request['Birthday_d'],
            'position' => $request['position'],
            'SubPosition' => $request['SubPosition'],
            'dominant_hand' => $request['dominant_hand'],
            'height' => $request['height'],
            'weight' => $request['weight'],
            'alma_mater' => $request['alma_mater'],
            'password' => Hash::make($request['password']),
            'user_image' => $filename = $request->file('user_image')->getClientOriginalName(),
        ]);
       }else{
        User::create([
            'number' => $request['number'],
            'Name' => $request['Name'],
            'FullName' => $request['FullName'],
            'Birthday_y' => $request['Birthday_y'],
            'Birthday_m' => $request['Birthday_m'],
            'Birthday_d' => $request['Birthday_d'],
            'position' => $request['position'],
            'SubPosition' => $request['SubPosition'],
            'dominant_hand' => $request['dominant_hand'],
            'height' => $request['height'],
            'weight' => $request['weight'],
            'alma_mater' => $request['alma_mater'],
            'password' => Hash::make($request['password']),
        ]);
       }        
        return redirect()
         ->route('users.index',compact('user'))
         ->with('status','登録しました。');
    }


    public function update(Request $request, user $user)
    {
        $rules = [
            'number' => ['required','integer','digits_between:1,3','unique:users,number,'.$request->number.',number',],
            'Name' => ['required'],
            'FullName' => ['required'],
            'Birthday_y' => ['required',],
            'Birthday_m' => ['required'],
            'Birthday_d' => ['required'],
            'password' => ['required'],
            'position' => ['required'],
            'SubPosition' => ['nullable','different:position'],
            'dominant_hand' => ['required'],
            'height' => ['nullable','integer','between:100,200'],
            'weight' => ['nullable','integer','between:30,150'],
            'alma_mater' => ['nullable'],
            'user_img' => ['nullable'],
            'user_image' => ['nullable'],
        ];
        $this->validate($request,$rules);
        $user->update($request->all());
        $user->password = Hash::make($request['password']);
        $user->save();
        if($request->hasFile('user_image')){
            $user->user_image = $request->file('user_image')->getClientOriginalName();
            $user->save();
            $name = $user->user_image;
            $request->file('user_image')->storeAs('public/img',$name);
        }
        if($request->hasFile('user_img')){
            $user->user_img = $request->file('user_img')->getClientOriginalName();
            $user->save();
            $name = $user->user_img;
            $request->file('user_img')->storeAs('public/img',$name);
        }

        return redirect()
        ->route('users.show',compact('user'))
        ->with('status','更新しました。');
    }

        public function destroy(User $user,Userschedule $userschedules,Userresult $userresults,Pitchresult $pitchresults)
    {
        
        $userschedules = Userschedule::where('id',$user->id)->delete();
        $userresults = Userresult::where('user_id',$user->number)->delete();
        $pitchresults = Pitchresult::where('user_id',$user->number)->delete();
        $blog = Blog::where('writer',$user->id)->delete();
        $user->delete();

        return redirect()
        ->route('users.index'
        ,compact('user','userresults','pitchresults','blog'))
        ->with('status','削除しました。');
    }

    }
