<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lastname', 'email', 'phone'];


    public static function saveAuthor($data){
        $author = Author::create([
            'name' => $data->name,
            'lastname' => $data->lastname,
            'email' => $data->email,
            'phone' => $data->phone
        ]);

        return $author;
    }

    public function updateAuthor($data){
        $this->update([
            'name' => $data->name,
            'lastname' => $data->lastname,
            'email' => $data->email,
            'phone' => $data->phone
        ]);
    }


    public function culturalWork(){
        return $this->hasMany(CulturalWork::class);
    }
}
