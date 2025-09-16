<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HistoryUploadDokumenPemohon extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $table="history_upload";
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('upload_arsitektur')
            ->singleFile()
            ->useDisk('uploads');

        $this->addMediaCollection('upload_struktur')
            ->singleFile()
            ->useDisk('uploads');

        $this->addMediaCollection('upload_mep')
            ->singleFile()
            ->useDisk('uploads');

        $this->addMediaCollection('upload_correction_verifikator')
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
    public function type_dokumen()
    {
        return $this->belongsTo(DokumenPemohon::class, 'dokumen_type_id');
    }
    public function pengajuan()
    {
        return $this->belongsTo(DetailPemohon::class, 'pengajuan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function verified_by()
    {
        return $this->belongsTo(User::class, 'verified_by_user_id');
    }
    public function ket_detail_upload()
    {
        return $this->hasMany(KeteranganDetailUploadPemohon::class, 'dokumen_upload_id');
    }
    public static function latestDokumenPerUser()
    {
        $latestDocuments = HistoryUploadDokumenPemohon::select('user_id', 'dokumen_type_id', DB::raw('MAX(id) as latest_id'))
            ->groupBy('user_id', 'dokumen_type_id');
        return $latestDocuments;
    }
}
