<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use App\User;


class SettingController extends Controller
{
    public function index(Request $req){
        $items = Auth::user();
        return view('setting.index',['items' => $items, 'req' => $req]);
    }
    public function settingName(Request $req){
        $user = Auth::user();
        $user->name = $req->get('name');
        $user->save();
        return "名前変更完了";
    }

    public function settingMail(Request $req){
        $user = Auth::user();
        $user->email = $req->get('mail');
        $user->save();
        return "メールアドレス変更完了";
    }

    public function settingPassword(Request $req){
        $message = null;
        if(Hash::check($req->get('current_pw'), Auth::user()->password)) {
            $user = Auth::user();
            $user->password = bcrypt($req->get('new_pw'));
            $user->save();
            $message = "パスワード変更完了";
        }else{
            $message = "現在のパスワードが間違っています。";
        }
        return $message;
    }

    public function settingDelete(){
        $user = User::find(Auth::id());
        $user->delete();
        return redirect('/');
    }

}
