<?php

use Illuminate\Support\Facades\Route;

// ============================================
// LANDING PAGE - Guest bisa akses
// ============================================
Route::get('/', App\Livewire\LandingPage::class)->name('landing');

// ============================================
// AUTH ROUTES (Livewire)
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', \App\Livewire\Auth\Login::class)->name('login');
    Route::get('/register', \App\Livewire\Auth\Register::class)->name('register');
});

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');  // ← Redirect ke landing page
})->name('logout')->middleware('auth');

// ============================================
// USER ROUTES (Protected, Livewire)
// ============================================
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', \App\Livewire\User\Dashboard::class)->name('dashboard');
    Route::get('/video', \App\Livewire\User\VideoList::class)->name('video');
    Route::get('/artikel', \App\Livewire\User\ArtikelList::class)->name('artikel');
    Route::get('/artikel/{id}', \App\Livewire\User\ArtikelDetail::class)->name('artikel.show');
    Route::get('/favorit', \App\Livewire\User\FavoritList::class)->name('favorit');
    
    // Category Page
    Route::get('/category/{id}', \App\Livewire\User\CategoryShow::class)->name('category.show');
    
    // Content Request Routes
    Route::get('/request/new', \App\Livewire\User\ContentRequestForm::class)->name('request.form');
    Route::get('/request/list', \App\Livewire\User\ContentRequestList::class)->name('request.list');
});

// ============================================
// ADMIN ROUTES (Protected + Admin Only, Livewire)
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', \App\Livewire\Admin\Dashboard::class)->name('dashboard');
    Route::get('/users', \App\Livewire\Admin\UserManagement::class)->name('users');
    
    // Video Management
    Route::get('/videos', \App\Livewire\Admin\VideoManagement::class)->name('videos');
    Route::get('/videos/create', \App\Livewire\Admin\VideoCreate::class)->name('videos.create');
    
    // Article Management
    Route::get('/articles', \App\Livewire\Admin\ArticleManagement::class)->name('articles');
    Route::get('/articles/create', \App\Livewire\Admin\ArticleCreate::class)->name('articles.create');
    
    // Request Management
    Route::get('/requests', \App\Livewire\Admin\RequestManagement::class)->name('requests');
});