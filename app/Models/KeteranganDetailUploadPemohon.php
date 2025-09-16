<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganDetailUploadPemohon extends Model
{
    use HasFactory;
    protected $table = 'detail_ket_history_dok';
    protected $guarded = [];
    public function checked_by()
    {
        return $this->belongsTo(User::class, 'checked_by_user_id');
    }
}
