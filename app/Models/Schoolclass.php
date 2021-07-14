<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schoolclass extends Model
{
    use HasFactory;

    protected $fillable = [
        'evfolyam',
        'betujel',
        'nev',
        'rovid_nev',
    ];

    protected $casts = [
        'id' => 'integer',
        'evfolyam' => 'integer',
    ];

    public static function getForPdf() {
        $classes = Schoolclass::all();
        $result = array();
        foreach($classes as $c) {
            $result[$c->id] = $c->toArray();
        }
        return $result;
    }

    public static function getValidationRules()
    {
        return array(
            'nev' => "required|max:30",
            'rovid_nev' => "required|max:10",
            'evfolyam' => "integer|min:9|max:16",
            'betujel' => "required|max:3"
        );
    }

}
