<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\User;
use App\Note;
use Auth;
use Faker\Provider\nl_NL\Text;
use Symfony\Component\Console\Input\Input;

class NoteController extends Controller
{
/* DB colums
    +------------+---------------------+------+-----+---------+----------------+
    | Field      | Type                | Null | Key | Default | Extra          |
    +------------+---------------------+------+-----+---------+----------------+
    | id         | bigint(20) unsigned | NO   | PRI | NULL    | auto_increment |
    | user_id    | int(11)             | NO   |     | NULL    |                |
    | text       | text                | NO   |     | NULL    |                |
    | created_at | timestamp           | YES  |     | NULL    |                |
    | updated_at | timestamp           | YES  |     | NULL    |                |
    | deleted_at | timestamp           | YES  |     | NULL    |                |
    +------------+---------------------+------+-----+---------+----------------+
    $table->binary('textnote');//20190821追加
*/

// return view('test',['test' => $form]);

    public function new(Request $req){
        return view('note.create');
    }

    public function index(Request $req){
        $items = User::find(Auth::id())->notes()->latest()->get();
        return view('note.index',['items' => $items, 'req' => $req]);
    }

    public function getNote(Request $req){
        $form = User::find(Auth::id())->notes()->where('id',$req->id)->first();
        return $form;
    }

    public function getTrashNote(Request $req){
        $form = Note::onlyTrashed()->where('user_id',Auth::id())->where('id',$req->id)->first();
        return $form;
    }

    public function getList(Request $req){
        $items = User::find(Auth::id())->notes()->latest()->get();
        return $items;
    }

    public function getTrashList(Request $req){
        $items = Note::onlyTrashed()->where('user_id',Auth::id())->orderBy('deleted_at','desc')->get();
        return $items;
    }

    public function create(Request $req){
        $this->validate($req,Note::$rules);
        $note = new Note;
        $form = $req->all();
        $form['text'] = strip_tags ($form['textnote']);
        unset($form['_token']);
        unset($form['files']);
        $form['user_id'] = Auth::id();
        $note->fill($form)->save();
        $req['id'] = $note->id;
        $data = $this->getNote($req);
        return $data;
    }

    public function edit(Request $req){
        $form = User::find(Auth::id())->notes()->where('id',$req->id)->first();
        return view('note.update',['form' => $form]);
    }

    public function update(Request $req){
        $this->validate($req,Note::$rules);
        $form = $req->all();
        $note = User::find(Auth::id())->notes()->where('id',$req->id)->first();
        $form['user_id'] = Auth::id();
        $form['text'] = strip_tags ($form['textnote']);
        unset($form['_token']);
        unset($form['files']);
        $note->fill($form)->save();
        // nullのときの処理を記述 if(null == $note){ this->index(this); }
        $data = $this->getNote($req);
        return $data;
    }

    public function delete(Request $req){
        User::find(Auth::id())->notes()->where('id',$req->id)->delete();
    }

    public function forceDelete(Request $req){
        Note::onlyTrashed()->where('user_id',Auth::id())->where('id',$req->id)->forceDelete();
    }

    public function trashList(Request $req){
        $items = Note::onlyTrashed()->where('user_id',Auth::id())->orderBy('deleted_at','desc')->get();
        return view('note.trash',['items' => $items,'req' => $req]);
    }

    public function restore(Request $req){
        Note::onlyTrashed()->where('user_id',Auth::id())->where('id',$req->id)->restore();
    }

    public function imageUpload(Request $req){
        logger("Ajax受信");
        if ($_FILES['file']['name']) {
            if (!$_FILES['file']['error']) {
                $name = md5(rand(100, 200));
                $ext = explode('.', $_FILES['file']['name']);
                $filename = $name . '.' . $ext[1];
                $destination = '/home/vagrant/code/journalapp/public/images/' . $filename; //change this directory
                $location = $_FILES["file"]["tmp_name"];
                move_uploaded_file($location, $destination);
                echo 'http://homestead.test/images/' . $filename;//change this URL
            }
            else
            {
              echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
            }
        }
    }

    public function ajax_get_json(Request $req) {
        /* get:json */
            // $json = array(
            //     "foo" => "aaaa",
            //     "bar" => "bbbb",
            // );
        logger($req->all());
        // return view('test',['test' => $req]);
    }
}
