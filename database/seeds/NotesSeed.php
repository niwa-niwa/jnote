<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
*/
    public function run()
    {
        $param =[
            'user_id' => 2,
            'text' => "これはユーザーナンバー2の人のノートです",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        DB::table('notes')->insert($param);

        $param =[
            'user_id' => 2,
            'text' => "DBがなかなかうまく行かないので悩んでいます。",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        DB::table('notes')->insert($param);

        $param =[
            'user_id' => 2,
            'text' => "果たしてこの先私は大丈夫なのでしょうか?",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        DB::table('notes')->insert($param);

        $param =[
            'user_id' => 2,
            'text' => "時間が足りない、もっと余裕をもって一日を過ごしたい",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        DB::table('notes')->insert($param);

        $param =[
            'user_id' => 2,
            'text' =>"絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!" ,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        DB::table('notes')->insert($param);


        $param =[
            'user_id' => 3,
            'text' => "これはユーザーナンバー3の人のノートです",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        DB::table('notes')->insert($param);

        $param =[
            'user_id' => 3,
            'text' => "DBを極めれば絶対に先が見えるはずDBを極めれば絶対に先が見えるはずDBを極めれば絶対に先が見えるはずDBを極めれば絶対に先が見えるはずDBを極めれば絶対に先が見えるはず。",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        DB::table('notes')->insert($param);

        $param =[
            'user_id' => 3,
            'text' => "心配なし!仕事も恋愛もうまくいく!心配なし!仕事も恋愛もうまくいく!心配なし!仕事も恋愛もうまくいく!心配なし!仕事も恋愛もうまくいく!心配なし!仕事も恋愛もうまくいく!心配なし!仕事も恋愛もうまくいく!心配なし!仕事も恋愛もうまくいく!",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        DB::table('notes')->insert($param);

        $param =[
            'user_id' => 3,
            'text' => "時間が足りない、もっと余裕をもって一日を過ごしたい時間が足りない、もっと余裕をもって一日を過ごしたい時間が足りない、もっと余裕をもって一日を過ごしたい時間が足りない、もっと余裕をもって一日を過ごしたい時間が足りない、もっと余裕をもって一日を過ごしたい時間が足りない、もっと余裕をもって一日を過ごしたい",
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        DB::table('notes')->insert($param);

        $param =[
            'user_id' => 3,
            'text' =>"絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!絶対にやるぞ!" ,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        DB::table('notes')->insert($param);
    }
}
