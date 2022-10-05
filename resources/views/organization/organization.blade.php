@extends('layouts.app') @section('content')
<!-- @php
echo request()->getRequestUri(); 
@endphp -->
<div class="container">
    <div class="row justify-content-center">
        <h3>{{ __("Student Organization") }}</h3>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    {{ __("Requirements") }}
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item active" id="info-li">
                            <i class="fas fa-hand-holding-medical" style="margin-right: 3px;"></i>
                            <a href="#Infographics" class="left-nav-links" id="info-link">Infographics</a>
                        </li>
                        <li @if($status == 'pending') class="list-group-item" @else class="list-group-item disabled" @endif id="app-li">
                            <i class="fas fa-file-contract" style="margin-right: 3px;"></i>
                            <a href="#Application" class="left-nav-links" id="app-link">Application</a>
                        </li>
                        <li @if($status == 'renewal') class="list-group-item" @else  class="list-group-item disabled" @endif id="ren-li">
                            <i class="fas fa-file-alt" style="margin-right: 3px;"></i>
                            <a href="#Renewal" class="left-nav-links" id="ren-link">Renewal</a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr />
            <div class="card">
                <div class="card-header">
                    {{ __("Events & Announcements") }}
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li @if($status == 'approved') class="list-group-item" @else  class="list-group-item disabled" @endif id="eve-li">
                            <i class="fas fa-calendar" style="margin-right: 3px;"></i>
                            <a href="#Events" class="left-nav-links" id="eve-link">Events</a>
                        </li>
                        <li @if($status == 'approved') class="list-group-item" @else  class="list-group-item disabled" @endif id="act-li">
                            <i class="fas fa-calendar-check" style="margin-right: 3px;"></i>
                            <a href="#Active" class="left-nav-links" id="act-link">Active Events</a>
                        </li>
                        <li @if($status == 'approved') class="list-group-item" @else  class="list-group-item disabled" @endif id="ann-li">
                            <i class="fas fa-bullhorn" style="margin-right: 3px;"></i>
                            <a href="#Announcements" class="left-nav-links" id="ann-link">Announcements</a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr />
            <div class="card">
                <div class="card-header">
                    {{ __("Others") }}
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li @if($status == 'approved') class="list-group-item" @else  class="list-group-item disabled" @endif id="off-li">
                            <i class="fas fa-users" style="margin-right: 3px;"></i>
                            <a href="#Officers" class="left-nav-links" id="off-link">Officers & Members</a>
                        </li>
                        <li class="list-group-item" id="abo-li">
                            <i class="fas fa-info-circle" style="margin-right: 3px;"></i>
                            <a href="#About" class="left-nav-links" id="abo-link">About</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card" id="Infographics">
                <div class="card-header">
                    {{ __("Infographics") }}
                </div>

                <div class="card-body" id="infographics-container">
                    <img src="{{ asset('img/infographics.svg') }}" alt="All you need to know">
                </div>
            </div>

            <div class="card" id="Application" style="display: none;">
                <div class="card-header">
                    {{ __("Application") }}
                </div>

                <div class="card-body" id="applicationMessage">
                    <form id="applyOrganizationForm" action="javascript:void(0);" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                {{ __("Organization Name :") }}
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="organizationname" id="organizationname" minlength="6" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __("Application Form") }}
                                    </div>
                                    <div class="card-body text-center">
                                        <!-- <i class="fas fa-plus text-black"></i> -->
                                        <input type="file" name="applicationform" id="applicationform" accept="application/pdf, application/vnd.ms-excel" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        {{ __("Adviser's Commitment Form") }}
                                    </div>
                                    <div class="card-body text-center">
                                        <!-- <i class="fas fa-plus text-black"></i> -->
                                        <input type="file" name="advisersform" id="advisersform" accept="application/pdf, application/vnd.ms-excel" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-primary" id="submitapplication" value="Apply" >
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card" id="Renewal" style="display: none;">
                <div class="card-header">
                    {{ __("Renewal") }}
                </div>

                <div class="card-body">
                    {{ __("This Feature is Under Development.") }}
                </div>
            </div>

            <div class="card" id="Events" style="display: none;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            {{ __("Events") }}
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addEventModal">
                                <i class="fas fa-plus text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Add Event Modal -->
                    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="addEventForm" action="javascript:void(0);" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addEventModalLabel">Add Event</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-2 col-form-label ">{{ __('Name') }}</label>
                                            <div class="col-md-10">

                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" required autocomplete="name" minlength="2"
                                                    autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="place" class="col-md-2 col-form-label ">{{ __('Place')
                                                }}</label>
                                            <div class="col-md-10">
                                                <input id="place" type="text"
                                                    class="form-control @error('place') is-invalid @enderror"
                                                    name="place" value="{{ old('place') }}" required
                                                    autocomplete="place" minlength="2" autofocus>

                                                @error('place')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="date" class="col-md-2 col-form-label ">{{ __('Date') }}</label>
                                            <div class="col-md-10">
                                                <input id="date" type="datetime-local"
                                                    class="form-control @error('date') is-invalid @enderror" name="date"
                                                    value="{{ old('date') }}" required autocomplete="date" autofocus>

                                                @error('date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="description" class="col-md-3 col-form-label ">{{
                                                __('Description') }}</label>
                                            <div class="col-md-9">
                                                <textarea id="description"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    name="description" value="{{ old('description') }}" required
                                                    autocomplete="description" autofocus rows="3"
                                                    placeholder="Description here..."></textarea>

                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" value="Submit" class="btn btn-primary"
                                            id="addEventSubmitButton">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Event Modal -->
                    <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="editEventForm" action="javascript:void(0);" method="PUT">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label for="new_name" class="col-md-2 col-form-label ">{{ __('Name')
                                                }}</label>
                                            <div class="col-md-10">

                                                <input id="new_name" type="text"
                                                    class="form-control @error('new_name') is-invalid @enderror"
                                                    name="new_name" value="{{ old('new_name') }}" required
                                                    autocomplete="new_name" autofocus>

                                                @error('new_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="new_place" class="col-md-2 col-form-label ">{{ __('Place')
                                                }}</label>
                                            <div class="col-md-10">
                                                <input id="new_place" type="text"
                                                    class="form-control @error('new_place') is-invalid @enderror"
                                                    name="new_place" value="{{ old('new_place') }}" required
                                                    autocomplete="new_place" autofocus>

                                                @error('new_place')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="new_date" class="col-md-2 col-form-label ">{{ __('Date')
                                                }}</label>
                                            <div class="col-md-10">
                                                <input id="new_date" type="datetime-local"
                                                    class="form-control @error('new_date') is-invalid @enderror"
                                                    name="new_date" value="{{ old('new_date') }}" required
                                                    autocomplete="new_date" min="" autofocus>

                                                @error('new_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="new_description" class="col-md-3 col-form-label ">{{
                                                __('Description') }}</label>
                                            <div class="col-md-9">
                                                <textarea id="new_description"
                                                    class="form-control @error('new_description') is-invalid @enderror"
                                                    name="new_description" value="{{ old('new_description') }}" required
                                                    autocomplete="new_description" autofocus rows="3"
                                                    placeholder="Description here..."></textarea>

                                                @error('new_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" value="Submit" class="btn btn-primary"
                                            id="editEventSubmitButton">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Place</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="eventTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card" id="Active" style="display: none;">
                <div class="card-header">
                    {{ __("Active Events") }}
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Place</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody id="activeEventTableBody">
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card" id="Announcements" style="display: none;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            {{ __("Announcements") }}
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addAnnouncementModal">
                                <i class="fas fa-plus text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Add Announcement Modal -->
                    <div class="modal fade" id="addAnnouncementModal" tabindex="-1"
                        aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="addAnnouncementForm" action="javascript:void(0);" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addAnnouncementModal">Add Announcement</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label for="title" class="col-md-2 col-form-label ">{{ __('Title')
                                                }}</label>
                                            <div class="col-md-10">

                                                <input id="title" type="text"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    name="title" value="{{ old('title') }}" required
                                                    autocomplete="title" minlength="2" autofocus>

                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="announcement" class="col-md-3 col-form-label ">{{
                                                __('Announcement') }}</label>
                                            <div class="col-md-9">
                                                <textarea id="announcement"
                                                    class="form-control @error('announcement') is-invalid @enderror"
                                                    name="announcement" value="{{ old('announcement') }}" required
                                                    autocomplete="announcement" autofocus rows="3"
                                                    placeholder="Description here..."></textarea>

                                                @error('announcement')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" value="Submit" class="btn btn-primary"
                                            id="addAnnouncementSubmitButton">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Announcement Modal -->
                    <div class="modal fade" id="editAnnouncementModal" tabindex="-1"
                        aria-labelledby="editAnnouncementModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="editAnnouncementForm" action="javascript:void(0);" method="PUT">
                                    @csrf
                                    <input type="hidden" name="id" id="id">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label for="new_title" class="col-md-2 col-form-label ">{{ __('Title')
                                                }}</label>
                                            <div class="col-md-10">

                                                <input id="new_title" type="text"
                                                    class="form-control @error('new_title') is-invalid @enderror"
                                                    name="new_title" value="{{ old('new_title') }}" required
                                                    autocomplete="new_title" minlength="2" autofocus>

                                                @error('new_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="new_announcement" class="col-md-3 col-form-label ">{{
                                                __('Announcement') }}</label>
                                            <div class="col-md-9">
                                                <textarea id="new_announcement"
                                                    class="form-control @error('new_announcement') is-invalid @enderror"
                                                    name="new_announcement" value="{{ old('new_announcement') }}"
                                                    required autocomplete="new_announcement" autofocus rows="3"
                                                    placeholder="Description here..."></textarea>

                                                @error('new_announcement')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" value="Submit" class="btn btn-primary"
                                            id="editAnnouncementSubmitButton">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Announcement</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody id="announcementTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card" id="Officers" style="display: none;">
                <div class="card-header">
                    {{ __("Officers & Members") }}
                </div>

                <div class="card-body">
                    {{ __("This Feature is Under Development.") }}
                </div>
            </div>

            <div class="card" id="About" style="display: none;">
                <div class="card-header">
                    {{ __("About") }}
                </div>

                <div class="card-body text-center">
                    <strong>
                        <h3 style="size: 24px;">{{ __("NEUST-SOMS") }}</h3>
                    </strong>
                    <hr>
                    {{ __("Nueva Ecija University") }} <br>
                    {{ __("of Science and Technology") }} <br>
                    {{ __("Student Organization") }} <br>
                    {{ __("Management System") }} <br>
                    <strong>Copyright &copy; 2022</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Remove Vue Error -->
</div>
</div>

<script>
    $(document).ready(function (e) {


        $('#info-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').toggle("slide");
            $('#Application').css('display', 'none');
            $('#Renewal').css('display', 'none');
            $('#Events').css('display', 'none');
            $('#Active').css('display', 'none');
            $('#Announcements').css('display', 'none');
            $('#Officers').css('display', 'none');
            $('#About').css('display', 'none');

            $('.active').removeClass('active');
            $('#info-li').addClass('active');

        });
        $('#app-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').css('display', 'none');
            $('#Application').toggle("slide");
            $('#Renewal').css('display', 'none');
            $('#Events').css('display', 'none');
            $('#Active').css('display', 'none');
            $('#Announcements').css('display', 'none');
            $('#Officers').css('display', 'none');
            $('#About').css('display', 'none');

            $('.active').removeClass('active');
            $('#app-li').addClass('active');

        });
        $('#ren-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').css('display', 'none');
            $('#Application').css('display', 'none');
            $('#Renewal').toggle("slide");
            $('#Events').css('display', 'none');
            $('#Active').css('display', 'none');
            $('#Announcements').css('display', 'none');
            $('#Officers').css('display', 'none');
            $('#About').css('display', 'none');

            $('.active').removeClass('active');
            $('#ren-li').addClass('active');
        });
        $('#eve-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').css('display', 'none');
            $('#Application').css('display', 'none');
            $('#Renewal').css('display', 'none');
            $('#Events').toggle("slide");
            $('#Active').css('display', 'none');
            $('#Announcements').css('display', 'none');
            $('#Officers').css('display', 'none');
            $('#About').css('display', 'none');

            $('.active').removeClass('active');
            $('#eve-li').addClass('active');

            var d = new Date($.now());
            var mos = (d.getMonth + 1 >= 10) ? d.getMonth() : ('0' + (d.getMonth() + 1));
            var day = (d.getDate() + 1 >= 10) ? d.getDate() : ('0' + (d.getDate() + 1));
            var hour = (d.getHours() >= 10) ? d.getHours() : ('0' + d.getHours());
            var min = (d.getMinutes() >= 10) ? d.getMinutes() : ('0' + (d.getMinutes()));
            var date_time = d.getFullYear() + '-' + mos + '-' + day + 'T' + hour + ":" + min;

            $('#date').attr('min', date_time);
            $('#new_date').attr('min', date_time);
        });
        $('#act-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').css('display', 'none');
            $('#Application').css('display', 'none');
            $('#Renewal').css('display', 'none');
            $('#Events').css('display', 'none');
            $('#Active').toggle("slide");
            $('#Announcements').css('display', 'none');
            $('#Officers').css('display', 'none');
            $('#About').css('display', 'none');

            $('.active').removeClass('active');
            $('#act-li').addClass('active');
        });
        $('#ann-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').css('display', 'none');
            $('#Application').css('display', 'none');
            $('#Renewal').css('display', 'none');
            $('#Events').css('display', 'none');
            $('#Active').css('display', 'none');
            $('#Announcements').toggle("slide");
            $('#Officers').css('display', 'none');
            $('#About').css('display', 'none');

            $('.active').removeClass('active');
            $('#ann-li').addClass('active');
        });
        $('#off-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').css('display', 'none');
            $('#Application').css('display', 'none');
            $('#Renewal').css('display', 'none');
            $('#Events').css('display', 'none');
            $('#Active').css('display', 'none');
            $('#Announcements').css('display', 'none');
            $('#Officers').toggle("slide");
            $('#About').css('display', 'none');

            $('.active').removeClass('active');
            $('#off-li').addClass('active');
        });
        $('#abo-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').css('display', 'none');
            $('#Application').css('display', 'none');
            $('#Renewal').css('display', 'none');
            $('#Events').css('display', 'none');
            $('#Active').css('display', 'none');
            $('#Announcements').css('display', 'none');
            $('#Officers').css('display', 'none');
            $('#About').toggle("slide");

            $('.active').removeClass('active');
            $('#abo-li').addClass('active');
        });

        function getDateNow(plus) {
            var d = new Date($.now());
            var mos = (d.getMonth + 1 >= 10) ? d.getMonth() : ('0' + (d.getMonth() + 1));
            var day = (d.getDate() + 1 >= 10) ? d.getDate() + plus : ('0' + (d.getDate() + (1 + plus)));
            var hour = (d.getHours() >= 10) ? d.getHours() : ('0' + d.getHours());
            var min = (d.getMinutes() >= 10) ? d.getMinutes() : ('0' + (d.getMinutes()));
            var date_time = d.getFullYear() + '-' + mos + '-' + day + 'T' + hour + ":" + min;

            return date_time;
        }

        function showAll() {
            showApplication();
            showEvents();
            showAnnouncements();
        }
        showAll();

        function showApplication() {
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('organization.myapplication')}}",

                success: function (data) {
                    if (data.length !== 0) {
                        $("#applicationMessage").empty().append(`
                            <div class="row mb-3">
                                <div class="col-md-12 text-center">
                                    {{ __("Please wait for approval.") }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-danger" name="deleteApplication" id="deleteApplication" value="` + data[0].id + `">Delete</button>
                                </div>
                            </div>
                        `)
                    } else {
                        $("#applicationMessage").empty().append(`
                            <form id="applyOrganizationForm" action="javascript:void(0);" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        {{ __("Organization Name :") }}
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="organizationname" id="organizationname" minlength="6" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __("Application Form") }}
                                            </div>
                                            <div class="card-body text-center">
                                                <!-- <i class="fas fa-plus text-black"></i> -->
                                                <input type="file" name="applicationform" id="applicationform" accept="application/pdf, application/vnd.ms-excel" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                {{ __("Adviser's Commitment Form") }}
                                            </div>
                                            <div class="card-body text-center">
                                                <!-- <i class="fas fa-plus text-black"></i> -->
                                                <input type="file" name="advisersform" id="advisersform" accept="application/pdf, application/vnd.ms-excel" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn btn-primary" id="submitapplication" value="Apply" >
                                    </div>
                                </div>
                            </form>
                        `)
                    }
                }
            })
        }
        function showEvents() {
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('organization.events')}}",

                success: function (data) {

                    // Events
                    if (data.length != 0) {
                        for (let index = 0; index < data.length; index++) {
                            var d = new Date(data[index]['date_time']);
                            var months = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                            ];
                            var month = months[d.getMonth()];
                            var day = (d.getDate() + 1 >= 10) ? d.getDate() : ('0' + (d.getDate() + 1));
                            var hour = (d.getHours() >= 10) ? d.getHours() : ('0' + d.getHours());
                            var min = (d.getMinutes() >= 10) ? d.getMinutes() : ('0' + (d.getMinutes()));
                            var date_time = month + ' ' + day + ', ' + d.getFullYear() + '. ' + ((hour > 12) ? hour - 12 : hour) + ':' + min + ' ' + ((hour < 12) ? 'AM' : 'PM');

                            // These lines of code is to override admin ability to select event status
                            var now = getDateNow(0);
                            var statusTester = ((data[index]['date_time'].substring(0,10)) === (now.substring(0,10))) ? data[index]['status'] : (parseInt(data[index]['date_time'].replace(/T|-|:/g,'')) < parseInt(now.replace(/T|-|:/g,''))) ? data[index]['status'] = 2 : data[index]['status'];
                            var edit = ``;
                            if (data[index]['status'] != 2) {
                                edit = `<button type="button" value="` +
                                data[index]['id'] +
                                `" name="editEvent" class="btn btn-primary" id="editEvent" data-bs-toggle="modal" data-bs-target="#editEventModal">
                                                <i class="fas fa-pen"></i>
                                            </button>`;
                            } 
                            // --------------------------------------------------------------------------

                            // console.log('db: ', parseInt(data[index]['date_time'].replace(/T|-|:/g,'')), 'now: ', parseInt(now.replace(/T|-|:/g,'')));

                            var status = (data[index]['status'] == 0) ? 'Pending' : (data[index]['status'] == 1) ? 'Approved' : 'Removal';

                            $('#eventTableBody').append(
                                `<tr>
                                    <td>`+ data[index]['name'] + `</td>
                                    <td>`+ data[index]['place'] + `</td>
                                    <td>`+ date_time + `</td>
                                    <td>`+ status + `</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            `+ edit +`
                                            <button type="button" value="` +
                                data[index]['id'] +
                                `" name="deleteEvent" class="btn btn-danger between" id="deleteEvent">
                                                 <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>`
                            )

                        }

                        // Active Events
                        $('#activeEventTableBody').empty();
                        data.forEach(element => {
                            var d = new Date(element.date_time);
                            var months = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                            ];
                            var month = months[d.getMonth()];
                            var day = (d.getDate() + 1 >= 10) ? d.getDate() : ('0' + (d.getDate() + 1));
                            var hour = (d.getHours() >= 10) ? d.getHours() : ('0' + d.getHours());
                            var min = (d.getMinutes() >= 10) ? d.getMinutes() : ('0' + (d.getMinutes()));
                            var date_time = month + ' ' + day + ', ' + d.getFullYear() + '. ' + ((hour > 12) ? hour - 12 : hour) + ':' + min + ' ' + ((hour < 12) ? 'AM' : 'PM');
                            var status = (element.status == 0) ? 'Pending' : (element.status == 1) ? 'Approved' : 'Removal';
                            
                            if (element.status == 1 && (element.date_time.substring(0,10)) === (now.substring(0,10))) {
                                $('#activeEventTableBody').append(
                                    `<tr>
                                        <td>`+ element.name + `</td>
                                        <td>`+ element.place + `</td>
                                        <td>`+ date_time + `</td>
                                        <td>`+ status + `</td>
                                    </tr>`
                                )
                            }
                        });
                    } else {
                        $('#eventTableBody').empty();
                    }
                }
            });
        }
        function showAnnouncements() {
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('organization.announcements')}}",

                success: function (data) {
                    // Announcements
                    $('#announcementTableBody').empty();
                    if (data.length != 0) {
                        for (let index = 0; index < data.length; index++) {
                            var status = (data[index]['status'] == 0) ? 'Pending' : (data[index]['status'] == 1) ? 'Approved' : 'Removal';
                            $('#announcementTableBody').append(
                                `<tr>
                                    <td>`+ data[index]['title'] + `</td>
                                    <td>`+ data[index]['announcement'] + `</td>
                                    <td>`+ status + `</td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" value="` +
                                data[index]['id'] +
                                `" name="editAnnouncement" class="btn btn-primary" id="editAnnouncement" data-bs-toggle="modal" data-bs-target="#editAnnouncementModal">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <button type="button" value="` +
                                data[index]['id'] +
                                `" name="deleteAnnouncement" class="btn btn-danger between" id="deleteAnnouncement">
                                                 <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>`
                            )
                        }
                    } else {
                        $('#announcementTableBody').empty();
                    }
                }
            })
        }
        
        $(document).unbind('submit').on("submit", "#applyOrganizationForm", function () {
            var name = $('#organizationname').val();
            var applicationform = $("#applicationform")[0].files;
            var advisersform = $("#advisersform")[0].files;

            var formData = new FormData();
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append('name', name);
            formData.append('applicationform', applicationform[0]);
            formData.append('advisersform', advisersform[0]);

            $.ajax({
                url: "{{ route('application.store') }}",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $('#applyOrganizationForm').trigger("reset");
                    showApplication();
                    if (data == 1) {
                        Swal.fire(
                            'Yeeeey!',
                            'Your application is submitted!',
                            'success'
                        );
                        
                    } else {
                        Swal.fire(
                            'Eeek!',
                            data[0] || data,
                            'error'
                        );
                    }
                }
            })
        });

        $(document).on('click', "#deleteApplication", function () {
            var id = $(this).val();
            var route = "{{ route('application.destroy', ':id')}}";
            route = route.replace(":id", id);

            var formData = new FormData();
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("_method", "DELETE");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: route,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        data: formData,
                        success: function (data) {
                            showApplication();
                            if (data >= 1) {
                                Swal.fire(
                                    'Yeeeey!',
                                    'Application Deleted!',
                                    'success'
                                )
                            } else {
                                Swal.fire(
                                    'Eeek!',
                                    'Something went wrong!',
                                    'error'
                                )
                            }
                        },
                    });
                }
            })
        });

        $(document).unbind('submit').on("submit", "#addEventForm", function () {

            var name = $('#name').val();
            var place = $('#place').val();
            var date = $('#date').val();
            var description = $('#description').val();

            var formData = new FormData();
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append('name', name);
            formData.append('place', place);
            formData.append('date_time', date);
            formData.append('description', description);

            $.ajax({
                url: "{{ route('event.store') }}",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    if (data == 1) {

                        $('#addEventModal').modal('hide');
                        Swal.fire(
                            'Yeeeey!',
                            'Event is listed for approval!',
                            'success'
                        )

                        $('#addEventForm').trigger('reset');
                        $('#eventTableBody').empty();
                        showAll();
                    } else {

                        $('#addEventModal').modal('hide');
                        Swal.fire(
                            'Eeek!',
                            'Something went wrong!',
                            'error'
                        )

                        $('#addEventForm').trigger('reset');
                    }
                }
            })
        });

        $(document).on('click', "button[name='editEvent']", function () {
            var id = $(this).val();
            var route = "{{ route('event.edit', ':id')}}";
            route = route.replace(":id", id);

            $.ajax({
                url: route,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (data) {
                    $('#id').val(data[0]['id']);
                    $('#new_name').val(data[0]['name']);
                    $('#new_place').val(data[0]['place']);
                    $('#new_date').val(data[0]['date_time']);
                    $('#new_description').val(data[0]['description'])
                }
            }),

                $(document).unbind('submit').on("submit", "#editEventForm", function () {
                    let id = $('#id').val();
                    let name = $('#new_name').val();
                    let place = $('#new_place').val();
                    let date = $('#new_date').val();
                    let description = $('#new_description').val();

                    let route = "{{ route('event.update', ':id')}}";
                    route = route.replace(':id', id);

                    let formData = new FormData();
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("_method", 'PUT');
                    formData.append('name', name);
                    formData.append('place', place);
                    formData.append('date_time', date);
                    formData.append('description', description);

                    $.ajax({
                        url: route,
                        method: 'POST',
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            if (data == 1) {
                                $('#editEventModal').modal('hide');
                                Swal.fire(
                                    'Yeeeey!',
                                    'Event Updated!',
                                    'success'
                                )

                                $('#editEventForm').trigger('reset');
                                $('#eventTableBody').empty();
                                showAll();
                            } else {
                                $('#editEventModal').modal('hide');
                                Swal.fire(
                                    'Eeek!',
                                    'Nothing Changes!',
                                    'error'
                                )

                                $('#editEventForm').trigger('reset');
                            }
                        }
                    })
                });
        });

        $(document).on('click', "button[name='deleteEvent']", function () {
            var id = $(this).val();
            var route = "{{ route('event.destroy', ':id')}}";
            route = route.replace(":id", id);

            var formData = new FormData();
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("_method", "DELETE");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: route,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        data: formData,
                        success: function (data) {
                            if (data >= 1) {
                                Swal.fire(
                                    'Yeeeey!',
                                    'Event Deleted!',
                                    'success'
                                )
                                $('#eventTableBody').empty();
                                showAll();
                            } else {
                                Swal.fire(
                                    'Eeek!',
                                    'Something went wrong!',
                                    'error'
                                )
                            }
                        },
                    });
                }
            })
        });

        $(document).unbind('submit').on("submit", "#addAnnouncementForm", function () {

            var title = $('#title').val();
            var announcement = $('#announcement').val();

            var formData = new FormData();
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append('title', title);
            formData.append('announcement', announcement);

            $.ajax({
                url: "{{ route('announcement.store') }}",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    if (data == 1) {

                        $('#addAnnouncementModal').modal('hide');
                        Swal.fire(
                            'Yeeeey!',
                            'Announcement is listed for approval!',
                            'success'
                        )

                        $('#addAnnouncementForm').trigger('reset');
                        $('#announcementTableBody').empty();
                        showAll();
                    } else {

                        $('#addAnnouncementModal').modal('hide');
                        Swal.fire(
                            'Eeek!',
                            'Something went wrong!',
                            'error'
                        )

                        $('#addAnnouncementForm').trigger('reset');
                    }
                }
            })
        });

        $(document).on('click', "button[name='editAnnouncement']", function () {
            var id = $(this).val();
            var route = "{{ route('announcement.edit', ':id')}}";
            route = route.replace(":id", id);

            $.ajax({
                url: route,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (data) {
                    $('#id').val(data[0]['id']);
                    $('#new_title').val(data[0]['title']);
                    $('#new_announcement').val(data[0]['announcement']);
                }
            }),
                $(document).unbind('submit').on("submit", "#editAnnouncementForm", function () {
                    let id = $('#id').val();
                    let title = $('#new_title').val();
                    let announcement = $('#new_announcement').val();

                    let route = "{{ route('announcement.update', ':id')}}";
                    route = route.replace(':id', id);

                    let formData = new FormData();
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("_method", 'PUT');
                    formData.append('title', title);
                    formData.append('announcement', announcement);

                    $.ajax({
                        url: route,
                        method: 'POST',
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            if (data == 1) {
                                $('#editAnnouncementModal').modal('hide');
                                Swal.fire(
                                    'Yeeeey!',
                                    'Announcement Updated!',
                                    'success'
                                )

                                $('#editAnnouncementForm').trigger('reset');
                                $('#announcementTableBody').empty();
                                showAll();
                            } else {
                                $('#editAnnouncementModal').modal('hide');
                                Swal.fire(
                                    'Eeek!',
                                    'Nothing Changes!',
                                    'error'
                                )

                                $('#editAnnouncementForm').trigger('reset');
                            }
                        }
                    })
                });
        });

        $(document).on('click', "button[name='deleteAnnouncement']", function () {
            var id = $(this).val();
            var route = "{{ route('announcement.destroy', ':id')}}";
            route = route.replace(":id", id);

            var formData = new FormData();
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("_method", "DELETE");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: route,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        data: formData,
                        success: function (data) {
                            if (data >= 1) {
                                Swal.fire(
                                    'Yeeeey!',
                                    'Announcement Deleted!',
                                    'success'
                                )
                                $('#announcementTableBody').empty();
                                showAll();
                            } else {
                                Swal.fire(
                                    'Eeek!',
                                    'Something went wrong!',
                                    'error'
                                )
                            }
                        },
                    });
                }
            })
        });

    });
</script>

@endsection