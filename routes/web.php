<?php



use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PetitionController;

Route::get('/', [\App\Http\Controllers\PageController::class, 'home'])->name('home');
Route::controller(\App\Http\Controllers\PetitionController::class)->group(function () {

    Route::get('petitions/index', 'index')->name('petitions.index');
    Route::get('petitions/{id}', 'show')->name('petitions.show');

    Route::get('mypetitions', 'listMine')->name('petitions.mine')->middleware('auth');

    Route::get('petition/add', 'create')->name('petitions.create')->middleware('auth');
    Route::post('petition', 'store')->name('petition.store')->middleware('auth');

    Route::get("petition/sign/{id}", "sign")->name('petition.sign')->middleware('auth');
    Route::get("mysignedpetitions", "signedPetitions")->name('petition.signedpetitions')->middleware('auth');



    Route::get('peticionesfirmadas', 'peticionesFirmadas')->name('peticiones.peticionesfirmadas');
    Route::get('peticiones/{id}', 'show')->name('peticiones.show');

    Route::delete('peticiones/{id}', 'delete')->name('peticiones.delete');
    Route::put('peticiones/{id}', 'update')->name('peticiones.update');
    Route::post('peticiones/firmar/{id}', 'firmar')->name('peticiones.firmar');
    Route::get('peticiones/edit/{id}', 'update')->name('peticiones.edit');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- ZONA DE ADMINISTRACIÓN (Protegida por middleware 'admin') ---
Route::middleware(['auth', 'admin'])->group(function () {

    // Redirección del panel principal a peticiones
    Route::get('/admin', function () {
        return redirect()->route('admin.peticiones.index');
    })->name('admin.home');

    // Rutas de Peticiones (Admin)
    Route::controller(\App\Http\Controllers\Admin\AdminPetitionController::class)->group(function() {
        Route::get('admin', 'index')->name('admin.home');
        Route::delete('admin/{petition}/delete', 'delete')->name('admin.destroy');
    });




});

require __DIR__ . '/auth.php';
