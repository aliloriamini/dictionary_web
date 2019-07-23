<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class word extends Model
{
    protected $fillable = [
        'words', 'meaning', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function Search ($request_type)
    {
        $words = DB::select('SELECT * FROM words WHERE (words LIKE ? || meaning LIKE ?) && user_id = ?', [$request_type,$request_type, auth()->user()->id]);
        return $words;
    }


}
