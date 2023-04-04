<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lastname', 'email', 'phone', 'image'];


    public static function saveAuthor($data, $url){
        $author = Author::create([
            'name' => $data->name,
            'lastname' => $data->lastname,
            'email' => $data->email,
            'phone' => $data->phone,
            'image' => $url
        ]);

        return $author;
    }

    public function updateAuthor($data, $url){
        $this->update([
            'name' => $data->name,
            'lastname' => $data->lastname,
            'email' => $data->email,
            'phone' => $data->phone,
            'image' => $url
        ]);
    }

}
