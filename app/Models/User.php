<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'phone',
        'solapin',
        'image',
        'role',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function saveUser($data, $url){
        $roles = ['administrador', 'vicerector', 'asistente', 'comunidad universitaria'];
        if(in_array($data->role, $roles)){
            $rol = $data->role;
        }else{
            $rol = 'comunidad universitaria';
        }
        $user = User::create([
            'name' => $data->name,
            'lastname' => $data->lastname,
            'email' => $data->email,
            'password' => Hash::make($data->password),
            'phone' => $data->phone,
            'solapin' => $data->solapin,
            'image' => $url,
            'role' => $rol,
        ]);

        return $user;
    }

    public function updateUser($data, $url){
        $roles = ['administrador', 'vicerector', 'asistente', 'comunidad universitaria'];
        if(in_array($data->role, $roles)){
            $rol = $data->role;
        }else{
            $rol = 'comunidad universitaria';
        }
        if($data->password){
            $this->update([
                'password' => Hash::make($data->password)
            ]);
        }

        $this->update([
            'name' => $data->name,
            'lastname' => $data->lastname,
            'email' => $data->email,
            'phone' => $data->phone,
            'solapin' => $data->solapin,
            'image' => $url,
            'role' => $rol,
        ]);

    }

    public function scores(){
        return $this->hasMany(Score::class);
    }
}
