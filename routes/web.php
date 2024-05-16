<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Kemahasiswaan\PDFLpjKegiatanController;
use App\Http\Controllers\Kemahasiswaan\PDFpengajuanController;
use App\Http\Controllers\Kemahasiswaan\PDFproposalKegiatanController;
use App\Http\Controllers\kemahasiswaan\PDFskLegalitasController;
use App\Http\Controllers\Kemahasiswaan\UpdateProfilController;
use App\Http\Controllers\Pembina\UpdateProfilPembinaController;
use App\Http\Controllers\SuperAdmin\EditKemahasiswaanController;
use App\Http\Controllers\SuperAdmin\HistoryKemahasiswaanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Ormawa\OrmawaController;
use App\Http\Controllers\Pembina\BerandaPembinaController;
use App\Http\Controllers\Pembina\ProposalKegiatanController;
use App\Http\Controllers\Pembina\SKlegalitasPembinaController;
use App\Http\Controllers\Pembina\LpjKegiatanPembinaController;
use App\Http\Controllers\Pembina\ViewOrmawaController;
use App\Http\Controllers\SuperAdmin\BerandaSuperAdminController;
use App\Http\Controllers\Ormawa\PengajuanLegalitasController;
use App\Http\Controllers\Ormawa\ProposalKegiatanOrmawaController;
use App\Http\Controllers\Ormawa\UpdateDataOrmawaController;
use App\Http\Controllers\Ormawa\LPJKegiatanController;
use App\Http\Controllers\Ormawa\SkLegalitasController;
use App\Http\Controllers\Kemahasiswaan\BerandaKemahasiswaanController;
use App\Http\Controllers\Kemahasiswaan\laporanakhirController;
use App\Http\Controllers\Kemahasiswaan\lpjkegiatankemasiswaanController;
use App\Http\Controllers\Kemahasiswaan\ormawakemahasiswaanController;
use App\Http\Controllers\Kemahasiswaan\pembinakemahasiswaanController;
use App\Http\Controllers\Kemahasiswaan\pengajuanlegalitaskemahasiswaanController;
use App\Http\Controllers\Kemahasiswaan\proposalkegiatankemahasiswaanController;
use App\Http\Controllers\Kemahasiswaan\skLegalitaskemahasiswaanController;




use App\Http\Middleware\RedirectByRole;
use App\Http\Middleware\Authenticate;

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingPageController::class, 'index'])->name('/');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::prefix('/ormawa')->middleware('auth')->group(function () {
    
    Route::get('/beranda', [OrmawaController::class, 'index'])->name('ormawa');
    // Pengajuan Legalitas
    Route::get('/legalitas', [PengajuanLegalitasController::class, 'index'])->name('legalitas');
    Route::post('/legalitas/upload', [PengajuanLegalitasController::class, 'store'])->name('legalitas.upload');
    // Route::post('/legalitas/upload', [PengajuanLegalitasController::class, 'store'])->name('legalitas.upload');
    route::get('/legalitas/menunggu', [PengajuanLegalitasController::class, 'waitRevision'])->name('waitingrevision');
    route::get('/legalitas/daftarRevisi', [PengajuanLegalitasController::class, 'listRevisi'])->name('listRevisi');
    route::get('/legalitas/revision', [PengajuanLegalitasController::class, 'revision'])->name('revision');
    route::patch('/legalitas/revisi', [PengajuanLegalitasController::class, 'update'])->name('revisi.pengajuan');

    // Proposal Kegiatan
    Route::get('/proposalKegiatan/beranda', [ProposalKegiatanOrmawaController::class, 'index'])->name('index.proposalKegiatan'); 
    Route::get('/proposalKegiatan', [ProposalKegiatanOrmawaController::class, 'unggah'])->name('proposalKegiatan'); 
    Route::post('/proposalKegiatan/upload', [ProposalKegiatanOrmawaController::class, 'store'])->name('proposalkegiatan.upload');
    Route::get('/proposalKegiatan/menunggu', [ProposalKegiatanOrmawaController::class, 'menunggu'])->name('menungguProposalKegiatan'); 
    Route::get('/proposalKegiatan/daftarRevisi', [ProposalKegiatanOrmawaController::class, 'listRevisi'])->name('ListRevisiproposalKegiatan'); 
    Route::get('/proposalKegiatan/Revisi', [ProposalKegiatanOrmawaController::class, 'Revisi'])->name('RevisiproposalKegiatan');
    

    //LPJ Kegiatan
    Route::get('/LPJKegiatan/index', [LPJKegiatanController::class, 'index'])->name('LPJkegiatan.beranda');
    Route::get('/LPJKegiatan/{id}/unggah', [LPJKegiatanController::class, 'unggah'])->name('LPJKegiatan');
    Route::post('/LPJKegiatan/upload', [LPJKegiatanController::class, 'store'])->name('lpjkegiatan.upload');
    Route::get('/LPJKegiatan/menunggu', [LPJKegiatanController::class, 'menunggu'])->name('menungguLPJKegiatan'); 
    Route::get('/LPJKegiatan/daftarRevisi', [LPJKegiatanController::class, 'listRevisi'])->name('ListRevisiLPJKegiatan'); 
    Route::get('/LPJKegiatan/Revisi/{id}', [LPJKegiatanController::class, 'revisi'])->name('RevisiLPJKegiatan'); 
    
    //Sk Legalitas
    Route::get('/SKlegalitas', [SkLegalitasController::class, 'index'])->name('Sklegalitas');
    //view untuk editedit
    Route::get('/SKlegalitas/view', [SkLegalitasController::class, 'download'])->name('Sklegalitasview'); 

    
    //UpdateDataOrmawa
    Route::get('/profil', [UpdateDataOrmawaController::class, 'index'])->name('ormawa.update');
    Route::post('/update/profil', [UpdateDataOrmawaController::class, 'updateOrmawa'])->name('ormawa.update.ormawa');
    Route::get('/profil/Kepengurusan', [UpdateDataOrmawaController::class, 'indexKepengurusan'])->name('index.Kepengurusan');
    Route::post('/update/Kepengurusan', [UpdateDataOrmawaController::class, 'updateKepengurusan'])->name('update.Kepengurusan');
    Route::get('/index/Kegiatan', [UpdateDataOrmawaController::class, 'indexKegiatan'])->name('index.Kegiatan');
    Route::get('/edit/Kegiatan/{id}', [UpdateDataOrmawaController::class, 'editKegiatan'])->name('edit.Kegiatan');
    Route::post('/update/Kegiatan', [UpdateDataOrmawaController::class, 'updateKegiatan'])->name('update.Kegiatan');
});

Route::prefix('/pembina')->middleware('auth')->group(function () {
    Route::get('/beranda', [BerandaPembinaController::class, 'index'])->name('pembina');
    Route::resource('/proposalKegiatanPembina', ProposalKegiatanController::class);
    Route::resource('/LPJKegiatanPembina', LpjKegiatanPembinaController::class);
    Route::resource('/Ormawa', ViewOrmawaController::class);
    Route::resource('/SKlegalitas', SKlegalitasPembinaController::class);
    Route::resource('/edit-profil-pembina', UpdateProfilPembinaController::class);
    Route::patch('/update-profil-pembina', [UpdateProfilPembinaController::class, 'updateProfil'])->name('updateProfilPembina');
});

Route::prefix('/kemahasiswaan')->middleware('auth')->group(function () {
    Route::get('/beranda', [BerandaKemahasiswaanController::class, 'index'])->name('kemahasiswaan');

    //Pengajuan Legalitas
    Route::resource('/pengajuanlegalitas',pengajuanlegalitaskemahasiswaanController::class);
    Route::get('/edit_pengajuanlegalitas/{id}/{type}', [PDFpengajuanController::class, 'edit'])->name('edit_pengajuanpdf');

    // Proposal Kegiatan
    Route::resource('/proposalKegiatan',proposalkegiatankemahasiswaanController::class);
    Route::get('/edit_proposalkegiatan/{id}/{type}', [PDFproposalKegiatanController::class, 'edit'])->name('edit_proposalpdf');

    // LPJ Kegiatan
    Route::resource('/LPJKegiatan', lpjkegiatankemasiswaanController::class);
    Route::get('/edit_LPJKegiatan/{id}/{type}', [PDFLpjKegiatanController::class, 'edit'])->name('edit_LPJkegiatanpdf');

    // Edit Ormawa
    Route::resource('/editOrmawa', ormawakemahasiswaanController::class);
    Route::get('/editOrmawa/{id}/edit', [ormawakemahasiswaanController::class, 'edit'])->name('edit.Ormawa');
    Route::post('/editOrmawa/{id}', [ormawakemahasiswaanController::class, 'update'])->name('update.Ormawa');
    Route::delete('editOrmawa/{id}/destroy', 'OrmawaController@destroy')->name('destroy.Ormawa');

    // Edit Pembina
    Route::resource('/Pembina', pembinakemahasiswaanController::class);
    Route::get('/editPembina/{id}/edit', [pembinakemahasiswaanController::class, 'edit'])->name('edit.Pembina');
    Route::post('/editPembina/{id}', [pembinakemahasiswaanController::class, 'update'])->name('update.Pembina');

    // edit Sk
    Route::resource('/editSKlegalitas', sklegalitaskemahasiswaanController::class); 
    Route::get('/edit_Sklegalitas/{id}/{type}', [PDFskLegalitasController::class, 'edit'])->name('edit_SKlegalitaspdf');
    Route::resource('/editProfil', UpdateProfilController::class);
    // Definisikan rute untuk metode uploadLogo
    Route::post('/editProfil/uploadLogo', [UpdateProfilController::class, 'uploadLogo'])->name('updateProfil.uploadLogo');
    Route::delete('/editProfil/deleteLogo', [UpdateProfilController::class, 'deleteLogo'])->name('updateProfil.deleteLogo');
    Route::patch('/update-profil', [UpdateProfilController::class, 'updateProfil'])->name('updateProfil');
    Route::resource('/laporanakhir', laporanAKhirController::class);
});

Route::prefix('/superadmin')->middleware('auth')->group(function () {
    Route::get('/beranda', [BerandaSuperAdminController::class, 'index'])->name('superadmin');
    Route::get('/profil-kemahasiswaan', [EditKemahasiswaanController::class, 'index'])->name('profil.kemahasiswaan');
    Route::get('/history-kemahasiswaan', [EditKemahasiswaanController::class, 'indexHistory'])->name('history.kemahasiswaan');
    Route::get('/edit-kemahasiswaan', [EditKemahasiswaanController::class, 'edit'])->name('edit.kemahasiswaan');
    Route::post('/buat-kemahasiswaan', [EditKemahasiswaanController::class, 'store'])->name('create.kemahasiswaan');
    Route::patch('/edit-kemahasiswaan/{id}/nonaktifkan', [EditKemahasiswaanController::class, 'nonaktifkan'])->name('kemahasiswaan.nonaktifkan');
});


Route::middleware(['auth'])->group(function (){
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Route::get('/superadmin', [BerandaSuperAdminController::class, 'index'])->name('superadmin');
});