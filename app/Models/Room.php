<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'nev',
        'rovid_nev',
        'megjegyzes',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public static function getForPdf() {
        $rooms = Room::all();
        $result = array();
        foreach($rooms as $room) {
            $result[$room->id] = $room->toArray();
        }
        return $result;
    }

    public static function getValidationRules()
    {
        return array(
            'nev' => "required|max:25",
            'rovid_nev' => "required|max:10",
            'megjegyzes' => "required|max:50"
        );
    }

}
