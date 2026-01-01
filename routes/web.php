<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Protected Group: Authenticated users only
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [EventController::class, 'index'])->name('dashboard');

    // USER PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==========================================
    // ADMIN ONLY ROUTES
    // ==========================================
    
    // 1. Show Audit Logs
    Route::get('/admin/audit-logs', function () {
        if (auth()->user()->email !== 'admin@example.com') { 
             abort(403, 'Unauthorized action.');
        }
        $logs = App\Models\AuditLog::latest()->get();
        return view('admin.audit_logs', compact('logs'));
    })->name('audit.logs');

    // 2. Show Create Event Form (Fixed: No middleware error)
    Route::get('/admin/events/create', function () {
        // Security Check
        if (auth()->user()->email !== 'admin@example.com') { abort(403, 'Unauthorized action.'); }
        // Call the controller manually
        return app(EventController::class)->adminCreate();
    })->name('admin.events.create');

    // 3. Process Create Event (Fixed: No middleware error)
    Route::post('/admin/events/store', function (Illuminate\Http\Request $request) {
        // Security Check
        if (auth()->user()->email !== 'admin@example.com') { abort(403, 'Unauthorized action.'); }
        // Call the controller manually
        return app(EventController::class)->adminStore($request);
    })->name('admin.events.store');

    // 4. Delete Audit Log Route (Admin Only)
    Route::delete('/admin/audit-logs/{id}', function ($id) {
        // Security Check
        if (auth()->user()->email !== 'admin@example.com') { abort(403, 'Unauthorized action.'); }
        // Call the controller manually
        return app(EventController::class)->adminDeleteLog($id);
    })->name('admin.logs.delete');

    // ==========================================
    // REGULAR USER ROUTES
    // ==========================================

    // Show Available Events
    Route::get('/events/available', [EventController::class, 'available'])->name('events.available');
    
    // Register for Event
    Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');

    // Other User Actions
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

}); 

require __DIR__.'/auth.php';