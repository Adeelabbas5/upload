<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/create-admin', function () {
    \App\Models\User::updateOrCreate(
        ['email' => 'syedadeelabbas151@gmail.com'],
        [
            'name' => 'Admin',
            'password' => bcrypt('Alimola1214'),
        ]
    );
    return 'Admin user created/updated successfully!';
});

Route::get('/', [HomeController::class, 'index']);
Route::post('/contact', [HomeController::class, 'store'])->name('contact.store');

Route::get('/service/{id}', [ServicesController::class, 'show'])->name('service.show');

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');

Route::get('/admin/about', [AdminController::class, 'about'])->name('admin.about.index');
Route::get('/admin/about/edit', [AdminController::class, 'editAbout'])->name('admin.about.edit');
Route::put('/admin/about', [AdminController::class, 'updateAbout'])->name('admin.about.update');
Route::delete('/admin/about', [AdminController::class, 'destroyAbout'])->name('admin.about.destroy');

Route::get('/admin/contacts', [AdminController::class, 'contacts']);
Route::delete('/admin/contacts/{id}', [AdminController::class, 'destroyContact'])->name('admin.contacts.destroy');

Route::get('/admin/services', [AdminController::class, 'services']);
Route::post('/admin/services', [AdminController::class, 'storeService'])->name('admin.services.store');
Route::put('/admin/services/{id}', [AdminController::class, 'updateService'])->name('admin.services.update');
Route::delete('/admin/services/{id}', [AdminController::class, 'destroyService'])->name('admin.services.destroy');

Route::post('/admin/services/{serviceId}/works', [AdminController::class, 'storeWork'])->name('admin.services.works.store');
Route::put('/admin/services/{serviceId}/works/{workId}', [AdminController::class, 'updateWork'])->name('admin.services.works.update');
Route::delete('/admin/services/{serviceId}/works/{workId}', [AdminController::class, 'destroyWork'])->name('admin.services.works.destroy');

Route::get('/admin/skills', [AdminController::class, 'skills']);
Route::post('/admin/skills', [AdminController::class, 'storeSkill'])->name('admin.skills.store');
Route::put('/admin/skills/{id}', [AdminController::class, 'updateSkill'])->name('admin.skills.update');
Route::delete('/admin/skills/{id}', [AdminController::class, 'destroySkill'])->name('admin.skills.destroy');