<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OAuthSSOPKUController;
use App\Livewire\Admin\PageDaftarAkunAhliArsitektur;
use App\Livewire\Admin\PageDaftarAkunAhliStruktur;
use App\Livewire\Admin\PageDaftarAkunAhliUtilitas;
use App\Livewire\Admin\PageDaftarAkunOperator;
use App\Livewire\Admin\PageDaftarAkunPemohon;
use App\Livewire\Admin\PageDaftarAkunPengawas;
use App\Livewire\Admin\PageDaftarAkunVerifikatorSLF;
use App\Livewire\Admin\PageDaftarPemohonPBG;
use App\Livewire\Admin\PageDaftarPemohonSLF;
use App\Livewire\Admin\PageDaftarPengajuanKrk;
use App\Livewire\Data\TableUserList;
use App\Livewire\PageApplicant\DetailPengajuanPemohon;
use App\Livewire\PageApplicant\DetailUploadDokumenPemohon;
use App\Livewire\PageApplicant\FormPageDataPemohon;
use App\Livewire\PageApplicant\PageListTableBangunanPemohon;
use App\Livewire\PageApplicant\PagePrototype;
use App\Livewire\PageVerifikator\DetailPemohonVerifikatorTPT;
use App\Livewire\Page\Login\Dashboard;
use App\Livewire\Page\Login\DetailsPengajuan;
use App\Livewire\Page\Login\ProfileSettings;
use App\Livewire\Page\Login\WebManages;
use App\Livewire\Page\PageOperator\DaftarRekapKrkPemohon;
use App\Livewire\Page\PageOperator\DataPengajuanKrkPemohon;
use App\Livewire\Page\PageOperator\DataPengajuanPemohonBelumTerdataNomorSimbg;
use App\Livewire\Page\PageVerifikator\DaftarSignatureBeritaAcaraVerifikator;
use App\Livewire\Page\PageVerifikator\PageDataMasterPemohonVerifikator;
use App\Livewire\Page\PageVerifikator\RiwayatPengajuanSelesai;
use App\Livewire\Page\RegisterApplicant;
use App\Livewire\VerifikasiDokumen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'redirectUser'])->name("Home");
Route::get('/register', RegisterApplicant::class)->name('register.applicant');

Route::middleware(['auth:sanctum', 'accessrole', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('pengajuan-baru', FormPageDataPemohon::class)->name('FormPageDataPemohon');
});
Route::middleware(['auth:sanctum', 'accessrole', 'checknewuser', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/web/settings', WebManages::class)->name('web.settings');

    Route::get('data/user/list', TableUserList::class)->name('user.list');

    Route::get('/user/profile', ProfileSettings::class)->name('profile.show');

    Route::prefix('pengajuan')->name('pengajuan.')->group(function () {
        Route::get('details/{id}', DetailsPengajuan::class)->name('details');
        Route::get('detail/{dokId}/{id}', DetailUploadDokumenPemohon::class)->name('detail.upload');
    });

    Route::prefix('pemohon')->name('pemohon.')->group(function () {
        // Route Page Registration Fun Run
        Route::get('pengajuan', PageListTableBangunanPemohon::class)->name('pengajuan');
        Route::get('pengajuan/dashboard/{id}', DetailPengajuanPemohon::class)->name('pengajuan.dashboard.upload');
    });

    Route::prefix('operator')->name('operator.')->group(function () {
        // Route Page Registration Fun Run
        Route::get('list/data/verifikasi-pengajuan', PageDaftarPengajuanKrk::class)->name('data.pengajuan.pemohon');
        Route::get('list/data/belum-terdata-penomoran-registrasi-simbg', DataPengajuanPemohonBelumTerdataNomorSimbg::class)->name('data.pengajuan.pemohon.belum.penomoran.simbg');
    });

    Route::prefix('verifikator')->name('verifikator.')->group(function () {
        // Route Page Registration Fun Run
        Route::get('informasi', FormPageDataPemohon::class)->name('FormPageDataPemohon');
        Route::get('list/data/pemohon', PageDataMasterPemohonVerifikator::class)->name('data.pemohon');
        Route::get('list/signature/ba', DaftarSignatureBeritaAcaraVerifikator::class)->name('list.signature.ba');
        Route::get('pengajuan/detailtpt/{id}', DetailPemohonVerifikatorTPT::class)->name('detail.upload.tpt');
        Route::get('list/pengajuan/complete', RiwayatPengajuanSelesai::class)->name('list.pengajuan.selesai');
    });
    Route::get('/verifikasi/{kode}', VerifikasiDokumen::class)
        ->name('dokumen.verifikasi');
    Route::prefix('data/account/')->name('list.')->group(function () {
        Route::get('pemohon', PageDaftarAkunPemohon::class)->name('data.akun.pemohon');
        Route::get('pengawas', PageDaftarAkunPengawas::class)->name('data.akun.pengawas');
        Route::get('operator', PageDaftarAkunOperator::class)->name('data.akun.operator');

        //TPA
        Route::get('arsitektur', PageDaftarAkunAhliArsitektur::class)->name('data.akun.arsitektur');
        Route::get('struktur', PageDaftarAkunAhliStruktur::class)->name('data.akun.struktur');
        Route::get('utilitas', PageDaftarAkunAhliUtilitas::class)->name('data.akun.utilitas');

        //TPT
        Route::get('verifikator-slf', PageDaftarAkunVerifikatorSLF::class)->name('data.akun.verifikator-slf');
    });
    Route::prefix('data/all/')->name('list.')->group(function () {
        Route::get('krk/pemohon/', DaftarRekapKrkPemohon::class)->name('data.master.krk.pemohon');
        Route::get('pemohon-pbg', PageDaftarPemohonPBG::class)->name('data.master.pbg');
        Route::get('pemohon-slf', PageDaftarPemohonSLF::class)->name('data.master.slf');

        Route::get('dokumen-prototype', PagePrototype::class)->name('data.master.prototype');
    });
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    // Route::get('s/file/{id}/media/{collectionName}', [MediaController::class, 'showMedia'])->name('media.show');
    // Route::get('d/file/{id}/media/{collectionName}', [MediaController::class, 'downloadMedia'])->name('media.download');
    Route::get('generate/pdf/ba/{idpengajuan}', [MediaController::class, 'generatePDF'])->name('genarate.pdf.ba');
});

// require_once __DIR__ . '/jetstream.php';
Route::get('/logout', function () {
    Auth::guard('web')->logout(); // logout user
    request()->session()->invalidate(); // hapus session
    request()->session()->regenerateToken(); // regenerasi token CSRF
    return redirect('/login'); // arahkan ke login
})->name('logout.custom');

if (request()->getHttpHost() == 'amanbang.pekanbaru.go.id' or config('app.env') == 'production') {
    URL::forceScheme('https');
}
Route::get('sso-auth-pku/redirect', [OAuthSSOPKUController::class, 'redirect'])->name('sso-auth-pku.redirect');
Route::get('sso-auth-pku/callback', [OAuthSSOPKUController::class, 'callback'])->name('sso-auth-pku.callback');
Route::get('file/offset/{luna}', [MediaController::class, 'downloadOffset'])->name('offset.download');

// Route wildcard untuk menangkap semua permintaan yang tidak ada
Route::fallback(function () {
    return redirect('/');
});
