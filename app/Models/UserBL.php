<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use GuzzleHttp\Client;
class UserBL extends Model
{
    use Notifiable;
    use HasFactory;
    use HasApiTokens;
    protected $table = "users_bl";
    protected $guarded = [];
    // protected $fillable = [
    //     'role',
    //     'name',
    //     'username',
    //     'password',
    //     'email',
    //     'status_account',
    //     'no_wa',
    //     'last_login_at',
    //     'last_login_ip',
    //     'active_until',
    // ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isActive()
    {
        return $this->status_account === 1 && ($this->active_until === null || $this->active_until > now());
    }

    public function getCurrentTime()
    {
        $client = new Client();
        $response = $client->get('http://worldtimeapi.org/api/ip');
        $data = json_decode($response->getBody(), true);

        return $data['datetime']; // Mengembalikan waktu dalam format ISO 8601
    }
}
