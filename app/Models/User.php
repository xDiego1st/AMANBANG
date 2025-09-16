<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Http as FacadesHttp;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use Prunable;
    use InteractsWithMedia;
    protected $guarded = [];
    const ROLE_SUPER_ADMIN = 'SUPER-ADMIN';
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_VERIFIKATOR = 'VERIFIKATOR';
    const ROLE_PEMOHON = 'PEMOHON';
    const ROLE_PENGAWAS = 'PENGAWAS';
    const TYPE_VALIDATOR_ARSITEKTUR = '1';
    const TYPE_VALIDATOR_STRUKTUR = '2';
    const TYPE_VALIDATOR_UTILITAS = '3';
    const TYPE_VALIDATOR_TATABANGUNAN = '4';
    const TYPE_VALIDATOR_SLF = '5';

    // Definisi roles dengan informasi tambahan
    const ROLES = [
        self::ROLE_SUPER_ADMIN => [
            'role' => 'Super Admin',
            'bg-color' => 'bg-danger',
            'text-color' => 'text-black',
        ],
        self::ROLE_ADMIN => [
            'role' => 'OPERATOR',
            'bg-color' => 'bg-info',
            'text-color' => 'text-danger',
            'sop' => '1 Hari Kerja',
        ], self::ROLE_VERIFIKATOR => [
            'role' => 'Verifikator',
            'bg-color' => 'bg-primary',
            'text-color' => 'text-warning',
            'sop' => '3-27 Hari Kerja',
        ], self::ROLE_PEMOHON => [
            'role' => 'Pemohon',
            'bg-color' => 'bg-success',
            'text-color' => 'text-primary',
        ], self::ROLE_PENGAWAS => [
            'role' => 'Pengawas',
            'bg-color' => 'bg-success',
            'text-color' => 'text-info',
            'text-color' => 'text-black',
            'sop' => '1 Hari Kerja',
        ],
    ];

    // Definisi type_validator dengan informasi tambahan
    const TYPE_VALIDATORS = [
        self::TYPE_VALIDATOR_ARSITEKTUR => [
            'name' => 'Tim Ahli Arsitektur',
            'bg-color' => 'badge-dim bg-outline-danger',
            'text-color' => 'text-white',
        ],
        self::TYPE_VALIDATOR_STRUKTUR => [
            'name' => 'Ahli Struktur',
            'bg-color' => 'badge-dim bg-outline-info',
            'text-color' => 'text-white',
        ], self::TYPE_VALIDATOR_UTILITAS => [
            'name' => 'Ahli Utilitas & Electrical ( MEP )',
            'bg-color' => 'badge-dim bg-outline-warning',
            'text-color' => 'text-white',
        ], self::TYPE_VALIDATOR_TATABANGUNAN => [
            'name' => 'Pemeriksa Tata Bangunan',
            'bg-color' => 'badge-dim bg-outline-success',
            'text-color' => 'text-white',
        ], self::TYPE_VALIDATOR_SLF => [
            'name' => 'Tim Penilai Teknis',
            'bg-color' => 'bg-info',
            'text-color' => 'text-white',
        ],
    ];

    public function roleColor()
    {
        if (array_key_exists($this->role, self::ROLES)) {
            return self::ROLES[$this->role]['bg-color'];
        } else {
            // Default color if role not found
            return 'bg-light';
        }
    }
    public function roleSOP()
    {
        if (array_key_exists($this->role, self::ROLES)) {
            return self::ROLES[$this->role]['sop'];
        } else {
            // Default color if role not found
            return 'Tidak Mempunyai SOP';
        }
    }
    public function type_validator_color()
    {
        if (array_key_exists($this->type_validator, self::TYPE_VALIDATORS)) {
            return self::TYPE_VALIDATORS[$this->type_validator]['bg-color'];
        } else {
            // Default color if role not found
            return 'bg-light';
        }
    }
    public function type_validator_name()
    {
        if (array_key_exists($this->type_validator, self::TYPE_VALIDATORS)) {
            return self::TYPE_VALIDATORS[$this->type_validator]['name'];
        } else {
            // Default color if role not found
            return;
        }
    }

    public function prunable()
    {
        return static::where('deleted_at', '<=', now()->subMonth());
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
    public static function totalUser()
    {
        return static::count();
    }
    public function detailPemohon()
    {
        return DetailPemohon::where('user_id', $this->id)->first();
    }
    public function pengajuan(): HasMany
    {
        return $this->hasMany(DetailPemohon::class, 'user_id');
    }
    public function verifikator(): HasMany
    {
        return $this->hasMany(VerifikatorHasPengajuan::class, 'user_id');
    }
    public function sendMessageWA($phone, $message, $file = null)
    {
        return true;
        // $http = FacadesHttp::withOptions([
        //     'verify' => false, // Nonaktifkan SSL verification (hati-hati di production)
        // ]);

        // if ($file) {
        //     // Jika $file berupa path lokal
        //     $http = $http->attach(
        //         'file', // key yang sesuai dengan API
        //         file_get_contents($file), // isi file
        //         basename($file) // nama file
        //     );
        // }

        // $response = $http->post('https://sapapemko.pekanbaru.go.id/api/send-message/02c5749b-a1b5-40ad-a0a5-1a830252c5e0', [
        //     'phone' => $phone,
        //     'message' => $message,
        // ]);

        // return $response->successful();
    }

    public function sendNotification($user, $title, $keterangan, $url, $type)
    {
        $notif = Notification::create([
            'user_id' => $user,
            'title' => $title,
            'keterangan' => $keterangan,
            'url' => $url,
            'type' => $type,
        ]);
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('signature')
            ->singleFile()
            ->useDisk('signatures');
    }
    public function registerMediaConversions(Media $media = null): void
    {
        // thumbnail 300x300, crop center
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued(); // -> hapus baris ini jika ingin diproses via queue
    }
    public function uploadedFile(?UploadedFile $file, string $collectionName, string $filePrefix): array
    {
        $acceptedMimeTypes = [
            'image/jpeg',
            'image/png',
            'application/pdf',
            // 'application/msword',
            // 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
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

                $newFileName = $filePrefix . '_' . time() . '_' . rand(1000, 9999) . '.' . $extension;

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
}
