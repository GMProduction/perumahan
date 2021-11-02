<?php


use App\Http\Controllers\Admin\PesananController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('/')->group(function (){
    Route::get('', function () {
        return view('admin.dashboard');
    });

    Route::get('/admin', function () {
        return view('admin');
    });


    Route::match(['POST','GET'],'/user', [\App\Http\Controllers\Admin\UserController::class,'index']);

    Route::match(['POST','GET'],'/pembelian', [PesananController::class,'index']);

    Route::prefix('/perkembangan')->group(function (){
        Route::get('/', [\App\Http\Controllers\Admin\PerkembanganController::class, 'index']);
        Route::match(['POST','GET'],'/{id}', [\App\Http\Controllers\Admin\PerkembanganController::class, 'detail']);
        Route::match(['POST','GET'],'/{id}/detail/{detail}/image', [\App\Http\Controllers\Admin\PerkembanganController::class, 'image'])->name('perkembanganImage');
    });
});





Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/register-member', [AuthController::class, 'registerMember']);

// Route::prefix('/user')->middleware(UserMiddleware::class)->group(function (){
//     Route::get('/', function () {
//         return view('user/dashboard');
//     });
//     Route::match(['get','post'],'/keranjang', [KeranjangController::class,'index']);
//     Route::get('/keranjang/{id}/delete', [KeranjangController::class,'delete']);
//     Route::match(['post','get'],'/pembayaran', [PembayaranController::class, 'index']);
//     Route::get('/menunggu', [MenungguController::class,'index']);
//     Route::get('/dikemas', [DikemasController::class,'index']);
//     Route::match(['post','get'],'/pengiriman', [PengirimanController::class,'index']);
//     Route::get('/selesai', [SelesaiController::class, 'index']);
//     Route::match(['post','get'],'/profile', [ProfileController::class, 'index']);

// });

// Route::prefix('/admin')->middleware(AdminMiddleware::class)->group(function (){
//     Route::get('/', [DashboardController::class, 'index']);

//     Route::match(['get','post'],'/bank', [BankController::class,'index']);
//     Route::get('/kategori', [KategoriController::class,'index']);
//     Route::post('/kategori', [KategoriController::class,'addKategori']);

//     Route::prefix('/produk')->group(function (){
//         Route::get('/', [ProdukController::class,'index']);
//         Route::match(['get','post'],'/data', [ProdukController::class,'data']);
//         Route::get('/kategori', [KategoriController::class,'dataKategori'])->name('produk_kategori');
//         Route::post('/kategori', [KategoriController::class,'addKategori']);
//         Route::match(['get','post'],'/image', [ProdukController::class,'addImage']);
//     });

//     Route::get('/pelanggan', [MemberController::class,'index']);
//     Route::get('/laporan', [LaporanController::class,'index']);

//     Route::match(['post','get'],'/baner', [BanerController::class,'index']);
//     Route::get('/baner/{id}/delete', [BanerController::class,'delete']);

//     Route::get('/pesanan', [PesananController::class,'index']);
//     Route::match(['post','get'],'/pesanan/{id}', [PesananController::class,'getDetailPesanan']);

//     Route::get('/cetaklaporan',[LaporanController::class, 'cetakLaporan']);
// });

// Route::get('/kategori', [KategoriController::class,'dataKategori'])->name('produk_kategori');
// Route::get('/get-produk-recomend', [\App\Http\Controllers\ProdukController::class,'dataProduk']);

// Route::get('/produk', [\App\Http\Controllers\ProdukController::class,'index']);
// Route::get('/produk/detail/{id}', [\App\Http\Controllers\ProdukController::class,'detail']);
// Route::post('/produk/detail/{id}', [\App\Http\Controllers\ProdukController::class,'simpanPesanan']);
// Route::get('/produk/detail/{id}/image', [\App\Http\Controllers\ProdukController::class,'getImageProduk']);

// Route::get('/baner', [HomeController::class,'baner']);
// Route::get('/bank', [BankController::class,'getBank']);
// Route::get('/get-city',[RajaOngkirController::class,'getCity']);
// Route::get('/get-cost',[RajaOngkirController::class,'cost']);


// Route::get('/get-keranjang',[HomeController::class,'getKeranjang']);




// Route::post('/register',[AuthController::class,'register']);
