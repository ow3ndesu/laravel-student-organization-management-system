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

Route::post('get-history', [App\Http\Controllers\EventController::class, 'getEventsHistory'])->name('events.history');
Route::get(substr(request()->getRequestUri(), 0, strrpos(request()->getRequestUri(), '/')) . '/' . 'history', [\App\Http\Controllers\HomeController::class, 'historyView'])->name('history');
Route::get(substr(request()->getRequestUri(), 0, strrpos(request()->getRequestUri(), '/')) . '/' . 'archive', [\App\Http\Controllers\HomeController::class, 'archiveView'])->name('archive');
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
    Route::post('get-applications', [App\Http\Controllers\ApplicationController::class, 'getAllApplications'])->name('administrator.applications');
    Route::post('get-renewals', [App\Http\Controllers\RenewalController::class, 'getAllRenewals'])->name('administrator.renewals');

    Route::post('get-archivedorganizations', [App\Http\Controllers\ArchiveOrganizationController::class, 'loadArchivedOrganizations'])->name('administrator.archive_organizations');
    Route::post('get-archivedevents', [App\Http\Controllers\ArchiveEventController::class, 'loadArchivedEvents'])->name('administrator.archive_events');
    Route::post('get-archivedannouncements', [App\Http\Controllers\ArchiveAnnouncementController::class, 'loadArchivedAnnouncements'])->name('administrator.archive_announcements');
    Route::post('get-archivedstudents', [App\Http\Controllers\ArchiveStudentController::class, 'loadArchivedStudents'])->name('administrator.archive_students');

    Route::resource('/archivedannouncement/destroy', App\Http\Controllers\ArchiveAnnouncementController::class)->names(['destroy' => 'administrator.restoreAnnouncement']);
    Route::resource('/archivedevent/destroy', App\Http\Controllers\ArchiveEventController::class)->names(['destroy' => 'administrator.restoreEvent']);
    Route::resource('/archivedorganization/destroy', App\Http\Controllers\ArchiveOrganizationController::class)->names(['destroy' => 'administrator.restoreOrganization']);
    Route::resource('/archivedstudent/destroy', App\Http\Controllers\ArchiveStudentController::class)->names(['destroy' => 'administrator.restoreStudent']);

    Route::resource('/organization/view', App\Http\Controllers\OrganizationController::class)->names(['edit' => 'administrator.viewOrganization']);
    Route::resource('/organization/update', App\Http\Controllers\OrganizationController::class)->names(['update' => 'administrator.updateOrganization']);
    Route::resource('/application/view', App\Http\Controllers\ApplicationController::class)->names(['edit' => 'administrator.viewApplication']);
    Route::resource('/application/update', App\Http\Controllers\ApplicationController::class)->names(['update' => 'administrator.updateApplication']);
    Route::resource('/renewal/view', App\Http\Controllers\RenewalController::class)->names(['edit' => 'administrator.viewRenewal']);
    Route::resource('/renewal/update', App\Http\Controllers\RenewalController::class)->names(['update' => 'administrator.updateRenewal']);
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
    Route::post('get-application', [App\Http\Controllers\ApplicationController::class, 'getMyApplication'])->name('organization.myapplication');
    Route::post('get-renewal', [App\Http\Controllers\RenewalController::class, 'getMyRenewal'])->name('organization.myrenewal');

    Route::resource('/organization/event', App\Http\Controllers\EventController::class);
    Route::resource('/organization/application', App\Http\Controllers\ApplicationController::class);
    Route::resource('/organization/renewal', App\Http\Controllers\RenewalController::class);
    Route::resource('/organization/announcement', App\Http\Controllers\AnnouncementController::class);
});

Route::group(["middleware" => "student", "prefix" => "student"], function () {
    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'studentView'])->name('student.dashboard');
    Route::get('feed', [App\Http\Controllers\HomeController::class, 'feedTab'])->name('student.feed');
    Route::post('get-events', [App\Http\Controllers\EventController::class, 'getAllEventsNonAuthor'])->name('student.events');
    Route::post('get-announcements', [App\Http\Controllers\AnnouncementController::class, 'getAllActiveAnnouncementsNonAuthor'])->name('student.announcements');
});
