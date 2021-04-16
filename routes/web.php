<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\{Midtrans, Order, DeleteOrder};
use App\Http\Controllers\{AdminController, HomeSavingController, PaymentController, ProfileController, UserController, Saving};

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



Route::get("login", [AuthController::class, "login"])->name("login");
Route::post("authenticate", [AuthController::class, "auth_login"])->name("auth_login");


// Halaman Home
Route::view("/", "view.home")->name("home");
// Halaman Harga Kamar Kost
// Route::get("harga/kamar-kost", [UserController::class, "price_page"])->name("harga_kost");

// Saran Dan Kritik
Route::post("store/saran-kritik", [UserController::class, "store_saran_kritik"])->name("store_saran_kritik");


Route::group(["middleware" => ["auth"]], function() {


    // Route Route Resource Untuk Page Tabungan
    Route::get("saving/home", [HomeSavingController::class, "index"]);

    Route::resource('saving', Saving::class);

    // --------------------------------- //
    Route::get("pembayaran/cicilan", [PaymentController::class, "cicilan"])
    ->name("cicilan")->middleware([Midtrans::class, Order::class]);

    Route::get("pembayaran/bulanan", [PaymentController::class, "bulanan"])->name("bulanan")->middleware([Midtrans::class, Order::class]);

    Route::get("mount", [PaymentController::class, "mount"])->name("bayar")->middleware([Midtrans::class, Order::class]);

    Route::get("daftar-transaksi", [PaymentController::class, "list_transaction"])
    ->middleware(Midtrans::class, DeleteOrder::class)
    ->name("daftar_transaksi");

    Route::get("detail-transaksi/{payment_result::order_id}", [PaymentController::class, "detail_transaction"])
    ->middleware(Midtrans::class)
    ->name("detail_transaksi");

// ---------------------------- //

    // Admin Page
    Route::prefix("admin")->group(function()
    {
        Route::group(["middleware", "Check_Authentication:admin"], function()
        {
            Route::get("akun-mbak-kost", [AdminController::class, "home_admin"])
            ->name("home_admin");

            Route::get("buat-akun-mbak-kost", [AdminController::class, "create_account"])
            ->name("buat_akun_mbak_kost");

            Route::post("store/akun", [AdminController::class, "store_account"])
            ->name("store_account");

            Route::delete("delete/akun/{user:slug}", [AdminController::class, "delete_account"])
            ->name("delete_account");

            Route::get("list-kritik-saran", [AdminController::class, "list_kritik_saran"])
            ->name("list_kritik_saran");

            Route::delete("delete/saran_kritik/{saran:id}", [AdminController::class, "delete_saran_kritik"])->name("delete_saran_kritik");

            Route::get("edit/akun-mbak-kost/{user:slug}",[AdminController::class, "edit_account"])
            ->name("edit_akun_kost");

            Route::patch("update/akun-mbak-kost/{user:slug}", [AdminController::class, "update_mbak_kost"])->name("update_akun_kost");

            Route::prefix('kamar_kost')->group(function () {
                Route::get("/", [AdminController::class, "index_kamar_kost"])->name("index.kamar_kost");
                //
                Route::get("tambah-kamar", [AdminController::class, "tambah_kamar_kost"])->name("tambah.kamar_kost");
                Route::post("store-kamar", [AdminController::class, "store_kamar_kost"])->name("store.kamar_kost");
                //
                Route::get("edit-kamar/{kamar_kost:no_kamar}", [AdminController::class, "edit_kamar_kost"])->name("edit.kamar_kost");
                Route::patch("update-kamar/{kamar_kost:no_kamar}", [AdminController::class, "update_kamar_kost"])->name("update.kamar_kost");
            });

        });
    });

    // General Role Menu

    // Route Profile
    Route::get("profile/{user:slug}", [ProfileController::class, "index"])->name("profile");
    // Update Data Profile
    Route::patch("/update/profile/{profile:id}", [ProfileController::class, "update"])->name("update.profile");
    // Logout
    Route::get("logout", [AuthController::class, "logout"])->name("logout");


});
