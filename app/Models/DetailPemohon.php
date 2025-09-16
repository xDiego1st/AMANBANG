<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DetailPemohon extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $guarded = [];
// App\Models\DetailPemohon.php
    protected $casts = [
        'verified_operator_at' => 'datetime',
        'finish_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('upload_syarat_krk')
            ->singleFile()
            ->useDisk('uploads');
        $this->addMediaCollection('krk')
            ->singleFile()
            ->useDisk('uploads');
    }
    public function uploadFile(?UploadedFile $file, string $collectionName, string $filePrefix): array
    {
        $acceptedMimeTypes = [
            'image/jpeg',
            'image/png',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];

        if ($file) {
            try {
                $extension = $file->getClientOriginalExtension();
                $mimeType = $file->getMimeType();

                if (!in_array($mimeType, $acceptedMimeTypes)) {
                    // Jika tipe mime tidak diterima, kembalikan false
                    return [
                        'status' => false,
                        'message' => "Tipe file \"$mimeType\" tidak diizinkan.",
                    ];
                }

                $newFileName = $filePrefix . '_' . time() . '.' . $extension;

                $media = $this->addMedia($file)
                    ->usingFileName($newFileName)
                    ->toMediaCollection($collectionName);

                return [
                    'status' => true,
                ];
            } catch (\Throwable $th) {
                return [
                    'status' => false,
                    'message' => "Exception saat upload file: " . $th->getMessage(),
                ];
            }
        }

        return [
            'status' => true,
        ];
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function verifikatorAssignments()
    {
        return $this->hasMany(VerifikatorHasPengajuan::class, 'pengajuan_id');
    }
    public function history()
    {
        return $this->hasMany(HistoryUploadDokumenPemohon::class, 'pengajuan_id');
    }
    public function latestHistoryByType($dok_type)
    {
        return $this->history()
            ->where('dokumen_type_id', $dok_type)
            ->latestOfMany(); // Laravel 9+
    }

    public function verifikators()
    {
        return $this->hasMany(VerifikatorHasPengajuan::class, 'pengajuan_id')
            ->whereHas('user', fn($q) => $q->where('role', User::ROLE_VERIFIKATOR));
    }
    public function verifikatorTPT()
    {
        return $this->hasMany(VerifikatorHasPengajuan::class, 'pengajuan_id')
            ->whereHas('user', fn($q) => $q->where('jenis_user', 'TPT'));
    }
    public function verifikatorTPA()
    {
        return $this->hasMany(VerifikatorHasPengajuan::class, 'pengajuan_id')
            ->whereHas('user', fn($q) => $q->where('jenis_user', 'TPA'));
    }
    public function verifikatorTPAByDok($type_validator)
    {
        if ($this->team_penilai_ba == "TPA") {
            return $this->hasMany(VerifikatorHasPengajuan::class, 'pengajuan_id')
                ->whereHas('user', fn($q) => $q->where([
                    'jenis_user' => 'TPA',
                    'type_validator' => $type_validator,
                ]));
        } else {
            return $this->hasMany(VerifikatorHasPengajuan::class, 'pengajuan_id')
                ->whereHas('user', fn($q) => $q->where([
                    'jenis_user' => 'TPT',
                    'type_validator' => '5',
                ]));
        }

    }
    public function pengawas()
    {
        return $this->hasMany(VerifikatorHasPengajuan::class, 'pengajuan_id')
            ->whereHas('user', fn($q) => $q->where('role', User::ROLE_PENGAWAS));
    }

    public function jumlahUploadDokumenUser($dok_type)
    {
        return $this->history()
            ->where('dokumen_type_id', $dok_type)
            ->count();
    }
    public function LatestDokumenUser($dok_type)
    {
        return $this->history()
            ->with('ket_detail_upload') // load relasi dari HistoryUploadDokumenPemohon
            ->where('dokumen_type_id', $dok_type)
            ->latest()
            ->first();
    }

}
