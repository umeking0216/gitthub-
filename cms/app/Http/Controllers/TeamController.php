<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team; //この行を上に追加
use App\Models\User;//この行を上に追加
use Auth;//この行を上に追加
use Validator;//この行を上に追加

class TeamController extends Controller
{
     public function index(){
        //本の全件データ取得
    $teams = Team::get();

    return view('teams',['teams'=>$teams]);
    
    }  
    
    
    public function store(Request $request){

    //バリデーション 
    $validator = Validator::make($request->all(), [
        'team_name' => 'required|max:255'
    ]);
    
    //バリデーション:エラー
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    
    //以下に登録処理を記述（Eloquentモデル）
    $teams = new Team;
    $teams->team_name = $request->team_name;
    $teams->user_id = Auth::id();//ここでログインしているユーザidを登録しています
    $teams->save();
    //多対多のリレーションもここで登録
     $teams->members()->attach( Auth::user(),['role'=>'owner'] );//<-ここが変わってるよ！！
    
    return redirect('/teams');

}

public function join($team_id)
{
    //ログイン中のユーザーを取得
    $user = Auth::user();
    
    //お気に入りする記事
    $team = Team::find($team_id);
    
    //リレーションの登録
    $team->members()->attach($user);
    
    return redirect('/teams');
    
}


//チーム編集画面表示
public function edit (Team $team) {
        
   return view('teamsedit', ['team' => $team]);
        
}

//更新処理
public function update (Request $request) {
        
         //バリデーション 
        $validator = Validator::make($request->all(), [
            'team_name' => 'required|max:255',
        ]);
        
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        //対象のチームを取得
        $team = Team::find($request->id);
        $team->team_name = $request->team_name;
        $team->save();
        
        return redirect('/teams');
        
}

    
}
