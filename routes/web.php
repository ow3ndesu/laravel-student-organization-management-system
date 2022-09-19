<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
})->middleware('guest');

Auth::routes();

Route::get(substr(request()->getRequestUri(), 0, strrpos(request()->getRequestUri(), '/')) . '/' . 'profile', [\App\Http\Controllers\HomeController::class, 'profileView'])->name('profile');
Route::post(substr(request()->getRequestUri(), 0, strrpos(request()->getRequestUri(), '/')) . '/' . 'update', [\App\Http\Controllers\HomeController::class, 'update'])->name('profile.update');

Route::group(["middleware" => "administrator", "prefix" => "administrator"], function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'adminView'])->name('administrator.dashboard');
    Route::get('administrators', [App\Http\Controllers\HomeController::class, 'administratorsTab'])->name('administrator.administratorsTab');
    Route::get('organizations', [App\Http\Controllers\HomeController::class, 'organizationsTab'])->name('administrator.organizationsTab');
    Route::get('students', [App\Http\Controllers\HomeController::class, 'studentsTab'])->name('administrator.studentsTab');

    Route::post('get-events', [App\Http\Controllers\EventController::class, 'getAllEventsNonAuthor'])->name('administrator.events');
    Route::post('get-announcements', [App\Http\Controllers\AnnouncementController::class, 'getAllAnnouncementsNonAuthor'])->name('administrator.announcements');
    Route::post('get-organizations', [App\Http\Controllers\OrganizationController::class, 'getAllOrganizationsNonAuthor'])->name('administrator.organizations');
    Route::post('get-students', [App\Http\Controllers\StudentController::class, 'getAllStudents'])->name('administrator.students');
    Route::post('get-administrators', [App\Http\Controllers\AdministratorController::class, 'getAllAdministrators'])->name('administrator.administrators');

    Route::resource('/event/edit', App\Http\Controllers\EventController::class)->names(['edit' => 'administrator.editEvent']);
    Route::resource('/event/update', App\Http\Controllers\EventController::class)->names(['update' => 'administrator.updateEvent']);
    Route::resource('/event/destroy', App\Http\Controllers\EventController::class)->names(['destroy' => 'administrator.destroyEvent']);
    Route::resource('/announcement/store', App\Http\Controllers\AnnouncementController::class)->names(['store' => 'administrator.storeAnnouncement']);
    Route::resource('/announcement/destroy', App\Http\Controllers\AnnouncementController::class)->names(['destroy' => 'administrator.destroyAnnouncement']);
    Route::resource('/announcement/edit', App\Http\Controllers\AnnouncementController::class)->names(['edit' => 'administrator.editAnnouncement']);
    Route::resource('/announcement/update', App\Http\Controllers\AnnouncementController::class)->names(['update' => 'administrator.updateAnnouncement']);

    Route::resource('/student', App\Http\Controllers\StudentController::class);
    Route::resource('/administrator', App\Http\Controllers\AdministratorController::class);
});

Route::group(["middleware" => "organization", "prefix" => "organization"], function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'organizationView'])->name('organization.dashboard');
    Route::get('organization', [App\Http\Controllers\HomeController::class, 'organizationTab'])->name('organization.organization');
    Route::post('get-events', [App\Http\Controllers\EventController::class, 'getAllEvents'])->name('organization.events');
    Route::post('get-active-events', [App\Http\Controllers\EventController::class, 'getAllActiveEvents'])->name('organization.active-events');
    Route::post('get-announcements', [App\Http\Controllers\AnnouncementController::class, 'getAllAnnouncements'])->name('organization.announcements');
    Route::post('get-organizations', [App\Http\Controllers\OrganizationController::class, 'getAllOrganizations'])->name('organization.organizations');

    Route::resource('/organization/event', App\Http\Controllers\EventController::class);
    Route::resource('/organization/announcement', App\Http\Controllers\AnnouncementController::class);
});

Route::group(["middleware" => "student", "prefix" => "student"], function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'studentView'])->name('student.dashboard');
    Route::get('feed', [App\Http\Controllers\HomeController::class, 'feedTab'])->name('student.feed');
    Route::post('get-events', [App\Http\Controllers\EventController::class, 'getAllEventsNonAuthor'])->name('student.events');
    Route::post('get-announcements', [App\Http\Controllers\AnnouncementController::class, 'getAllAnnouncementsNonAuthor'])->name('student.announcements');
});
