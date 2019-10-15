<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class Note extends Model
{
/*
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
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = array('id');

    public static $rules = array(
        // 'text'      => 'required',
        'textnote'  => 'required',
    );

    public static $e_msg =[
        'text.required' => 'ノートを入力してください',
    ];

    public function getShortText(){
        //文字列頭の空白文字を削除して50文字まで表示させる
        $text = mb_substr(trim($this->text, " "),0,50);
        return $text;
    }

}
