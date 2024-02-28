<?php

use App\Enums\Permission;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Management\Master\PermissionController;
use App\Http\Controllers\Management\Master\RoleController;
use App\Http\Controllers\Management\ProfileController;
use App\Http\Controllers\Management\UserController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelPengajarController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\AllMateriController;
use App\Http\Controllers\ForumController;
use App\Models\Forum;
use App\Models\Mapel;
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

Route::get('/', function () {
    return view('welcome');
});


Route::group([], __DIR__ . "/Auth/AuthRoute.php");
Route::group([], __DIR__ . "/Auth/ForgotPasswordRoute.php");
Route::group([], __DIR__ . "/Auth/RegistrationRoute.php");


/**
 * GET
 * POST
 * PUT
 * PATCH
 * DELETE
 * mapel
 *
 * jurusan/1/mapel/edit/1
 */

Route::middleware("auth")->group(function () {
//    Route::get("mapel", [MapelController::class, "index"])->name("mapel.index");
//    Route::get("mapel/create", [MapelController::class, "index"])->name("mapel.create");
//    Route::get("mapel/edit", [MapelController::class, "index"])->name("mapel.edit");
//    Route::get("mapel/destroy", [MapelController::class, "index"])->name("mapel.destroy");

    Route::prefix("jurusan/{jurusanId}/mapel")->name("mapel.")->controller(MapelController::class)->group(function (){
        Route::get("", "index")->name("index");
        Route::get("/create", "create")->name("create");
        Route::post("", "store")->name("store");
        Route::get("/{id}/edit", "edit")->name("edit"); // Gunakan URL yang berbeda untuk mengedit
        Route::put("/{id}/update", "update")->name("update"); // Gunakan metode PUT untuk pembaruan
        Route::delete("/{id}/destroy", "destroy")->name("destroy"); // Gunakan metode DELETE untuk penghapusan
        Route::get("/{id}/detail", "detail")->name("detail");
    });

    Route::prefix("jurusan/{jurusanId}/kelas")->name("kelas.")->controller(KelasController::class)->group(function (){
        Route::get("", "index")->name("index");
        Route::get("/create", "create")->name("create");
        Route::post("/store", "store")->name("store"); // Gunakan metode POST yang berbeda untuk menyimpan data
        Route::get("/{id}/edit", "edit")->name("edit"); // Gunakan URL yang berbeda untuk mengedit
        Route::put("/{id}/update", "update")->name("update"); // Gunakan metode PUT untuk pembaruan
        Route::delete("/{id}/destroy", "destroy")->name("destroy"); // Gunakan metode DELETE untuk penghapusan
    });

    Route::prefix("mapelpengajar")->name("pengajar.")->group(function (){
        Route::get("/", [MapelPengajarController::class, "index"])->name("index");
        Route::get("{user_id}/create", [MapelPengajarController::class, "create"])->name("create");
        Route::post("{user_id}/store", [MapelPengajarController::class, "store"])->name("store");
        Route::get("/{pengajar_id}/pengajar", [MapelPengajarController::class, "pengajar"])->name("pengajar");
        Route::delete("/{mapel_id}/{user_id}/destroy", [MapelPengajarController::class, "destroy"])->name("destroy"); 
    });

    Route::prefix("jurusan")->name("jurusan.")->group(function (){
        Route::get("/", [JurusanController::class, "index"])->name("index");
        Route::get("/create", [JurusanController::class, "create"])->name("create");
        Route::post("{/store", [JurusanController::class, "store"])->name("store");
        Route::delete("/{jurusanId}/destroy", [JurusanController::class, "destroy"])->name("destroy"); 
        Route::get("/{jurusanId}/edit", [JurusanController::class, "edit"])->name("edit"); // Gunakan URL yang berbeda untuk mengedit
        Route::put("/{jurusanId}/update", [JurusanController::class, "update"])->name("update"); 
    });

    Route::prefix("materi")->name("materi.")->group(function (){
        Route::get("/", [MateriController::class, "index"])->name("index");
        Route::get("/create", [MateriController::class, "create"])->name("create");
        Route::post("{/store", [MateriController::class, "store"])->name("store");
        Route::delete("/{id}/destroy", [MateriController::class, "destroy"])->name("destroy"); 
        Route::get("/{id}/edit", [MateriController::class, "edit"])->name("edit"); // Gunakan URL yang berbeda untuk mengedit
        Route::put("/{id}/update", [MateriController::class, "update"])->name("update"); 
    });

    Route::prefix("allmateri")->name("allmateri.")->group(function (){
        Route::get("/", [AllMateriController::class, "index"])->name("index");
        Route::get("/show", [AllMateriController::class, "show"])->name("show");
        Route::get("/{id}/edit", [AllMateriController::class, "edit"])->name("edit"); 
        Route::get("/{id}/detail", [AllMateriController::class, "detail"])->name("detail");
        
    });

    Route::prefix("forum")->name("forum.")->group(function (){
        Route::get("/", [ForumController::class, "index"])->name("index");
        Route::get("/create", [ForumController::class, "create"])->name("create");
        Route::post("{/store", [ForumController::class, "store"])->name("store");
        Route::get("/{id}/edit", [ForumController::class, "edit"])->name("edit"); 
        Route::put("/{id}/update", [ForumController::class, "update"])->name("update"); 
        Route::delete("/{id}/destroy", [ForumController::class, "destroy"])->name("destroy"); 
    });

    Route::prefix("management")->name("management.")->group(function () {
        Route::prefix("master")->name("master.")->group(function (){
            Route::get("/permissions", PermissionController::class)->name("permissions.index")->middleware("permission:" . Permission::PERMISSIONS_INDEX->value);
            Route::prefix("roles")->name("roles.")->controller(RoleController::class)->group(function (){
                Route::get("/", "index")->name("index")->middleware("permission:".Permission::ROLES_INDEX->value);
                Route::get("/create", "create")->name("create")->middleware("permission:".Permission::ROLES_STORE->value);
                Route::post("/", "store")->name("store")->middleware("permission:".Permission::ROLES_STORE->value);
                Route::get("/{id}", "edit")->name("edit")->middleware("permission:".Permission::ROLES_UPDATE->value);
                Route::put("/{id}", "update")->name("update")->middleware("permission:".Permission::ROLES_UPDATE->value);
            });
        });

        Route::prefix("users")->name("users.")->controller(UserController::class)->group(function (){
            Route::get("/", "index")->name("index")->middleware("permission:".Permission::USERS_INDEX->value);
            
            Route::get("/{id}", "edit")->name("edit")->middleware("permission:".Permission::USERS_EDIT->value);
            Route::put("/{id}", "update")->name("update")->middleware("permission:".Permission::USERS_UPDATE->value);
        });


        Route::prefix("profiles")->name("profiles.")->controller(ProfileController::class)->group(function (){
            Route::get("", "edit")->name("edit");
            Route::patch("", "update")->name("update");
        });
    });

    Route::get("images/{path}", \App\Http\Controllers\ImageController::class)->name("images");
    Route::get("/dashboard", DashboardController::class)->name("dashboard.index");
});
