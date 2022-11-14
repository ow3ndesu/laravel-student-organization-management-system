@extends('layouts.app') @section('content')
<!-- @php
echo request()->getRequestUri(); 
@endphp -->
<div class="container">
    <div class="row justify-content-center">
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
                        <li class="list-group-item" id="app-li">
                            <i class="fas fa-file-contract" style="margin-right: 3px;"></i>
                            <a href="#Application" class="left-nav-links" id="app-link">Applications</a>
                        </li>
                        <li class="list-group-item" id="ren-li">
                            <i class="fas fa-file-alt" style="margin-right: 3px;"></i>
                            <a href="#Renewal" class="left-nav-links" id="ren-link">Renewals</a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr />
            <div class="card">
                <div class="card-header">
                    {{ __("Organizations") }}
                </div>

                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" id="org-li">
                            <i class="fas fa-sitemap" style="margin-right: 3px;"></i>
                            <a href="#Organizations" class="left-nav-links" id="org-link">Organizations</a>
                        </li>
                        <li class="list-group-item" id="eve-li">
                            <i class="fas fa-calendar" style="margin-right: 3px;"></i>
                            <a href="#Events" class="left-nav-links" id="eve-link">Events</a>
                        </li>
                        <li class="list-group-item" id="act-li">
                            <i class="fas fa-calendar-check" style="margin-right: 3px;"></i>
                            <a href="#Active" class="left-nav-links" id="act-link">Active Events</a>
                        </li>
                        <li class="list-group-item" id="ann-li">
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
                    <div id="slider">
                        <ul id="slideWrap">
                            <li><img src="{{ asset('img/infographics.svg') }}" alt=""></li>
                            @foreach($events as $row)
                            <li><img class="bd-placeholder-img" src="{{asset("{$row->image}")}}" alt="">
                            </li>
                            @endforeach
                        </ul>
                        <a id="prev" href="#">&#8810;</a>
                        <a id="next" href="#">&#8811;</a>
                    </div>
                </div>
            </div>

            <div class="card" id="Application" style="display: none;">
                <div class="card-header">
                    {{ __("Application") }}
                </div>

                <div class="card-body">
                    <!-- View Application Modal -->
                    <div class="modal fade" id="viewApplicationModal" tabindex="-1"
                        aria-labelledby="viewApplicationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="viewApplicationForm" action="javascript:void(0);" method="PUT">
                                    @csrf
                                    <input type="hidden" name="applicationid" id="applicationid">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewApplicationModalLabel">View Application</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-2">
                                            <label for="new_name" class="col-md-2 col-form-label ">{{ __('Name')
                                                }}</label>
                                            <div class="col-md-10">

                                                <input id="new_name" type="text"
                                                    class="form-control @error('new_name') is-invalid @enderror"
                                                    name="new_name" value="{{ old('new_name') }}" required
                                                    autocomplete="new_name" autofocus readonly>

                                                @error('new_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="new_handler" class="col-md-2 col-form-label ">{{ __('Handler')
                                                }}</label>
                                            <div class="col-md-10">
                                                <input id="new_handler" type="text"
                                                    class="form-control @error('new_handler') is-invalid @enderror"
                                                    name="new_handler" value="{{ old('new_handler') }}" required
                                                    autocomplete="new_handler" autofocus readonly>

                                                @error('new_handler')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2 text-center">
                                            <label for="new_handler" class="col-md-2 col-form-label ">{{ __('Files')
                                                }}</label>
                                            <div class="col-md-5 preview">
                                                <a id="appForm" target="_blank" rel="noopener noreferrer"
                                                    class="form-control text-decoration-none">Application Form</a>
                                            </div>
                                            <div class="col-md-5 preview">
                                                <a id="commForm" target="_blank" rel="noopener noreferrer"
                                                    class="form-control text-decoration-none">Adviser's Commitment
                                                    Form</a>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <label for="new_title" class="col-md-2 col-form-label ">{{ __('Status')
                                                }}</label>
                                            <div class="col-md-10">

                                                <select id="new_applicationstatus"
                                                    class="form-control @error('new_applicationstatus') is-invalid @enderror"
                                                    name="new_applicationstatus"
                                                    value="{{ old('new_applicationstatus') }}" required
                                                    autocomplete="new_applicationstatus" autofocus>
                                                    <option value="0">Pending</option>
                                                    <option value="1">Approved</option>
                                                    <option value="3">Disapproved</option>
                                                </select>

                                                @error('new_applicationstatus')
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
                                            id="editApplicationSubmitButton">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Organization</th>
                                <th scope="col">Handler</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody id="applicationTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card" id="Renewal" style="display: none;">
                <div class="card-header">
                    {{ __("Renewal") }}
                </div>

                <div class="card-body">
                    <!-- View Renewal Modal -->
                    <div class="modal fade" id="viewRenewalModal" tabindex="-1" aria-labelledby="viewRenewalModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="viewRenewalForm" action="javascript:void(0);" method="PUT">
                                    @csrf
                                    <input type="hidden" name="renewalid" id="renewalid">
                                    <input type="hidden" name="_method" value="POST">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewApplicationModalLabel">View Renewal</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-2">
                                            <label for="re_name" class="col-md-2 col-form-label ">{{ __('Name')
                                                }}</label>
                                            <div class="col-md-10">

                                                <input id="re_name" type="text"
                                                    class="form-control @error('re_name') is-invalid @enderror"
                                                    name="re_name" value="{{ old('re_name') }}" required
                                                    autocomplete="re_name" autofocus readonly>

                                                @error('re_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="re_handler" class="col-md-2 col-form-label ">{{ __('Handler')
                                                }}</label>
                                            <div class="col-md-10">
                                                <input id="re_handler" type="text"
                                                    class="form-control @error('re_handler') is-invalid @enderror"
                                                    name="re_handler" value="{{ old('re_handler') }}" required
                                                    autocomplete="re_handler" autofocus readonly>

                                                @error('re_handler')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2 text-center">
                                            <div class="col-12">
                                                <div class="row">
                                                    <label for="new_handler" class="col-md-2 col-form-label ">{{
                                                        __('Files')
                                                        }}</label>
                                                    <div class="col-md-5 preview">
                                                        <a id="renewalletter" target="_blank" rel="noopener noreferrer"
                                                            class="form-control text-decoration-none">Renewal Letter</a>
                                                    </div>
                                                    <div class="col-md-5 preview">
                                                        <a id="accomplishmentreport" target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="form-control text-decoration-none">Accomplishment
                                                            Report</a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="new_handler" class="col-md-2 col-form-label ">{{
                                                        __('')
                                                        }}</label>
                                                    <div class="col-md-5 preview">
                                                        <a id="budgetaryreport" target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="form-control text-decoration-none">Budgetary
                                                            Report</a>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mb-2">
                                            <label for="re_status" class="col-md-2 col-form-label ">{{ __('Status')
                                                }}</label>
                                            <div class="col-md-10">

                                                <select id="re_status"
                                                    class="form-control @error('re_status') is-invalid @enderror"
                                                    name="re_status" value="{{ old('re_status') }}" required
                                                    autocomplete="re_status" autofocus>
                                                    <option value="2">Renewal</option>
                                                    <option value="1">Approved</option>
                                                    <option value="3">Disapproved</option>
                                                </select>

                                                @error('re_status')
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
                                <th scope="col">Organization</th>
                                <th scope="col">Handler</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody id="renewalTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card" id="Organizations" style="display: none;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            {{ __("Organizations") }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- View Organization Modal -->
                    <div class="modal fade" id="viewOrganizationModal" tabindex="-1" aria-labelledby="viewOrganizationModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="viewOrganizationForm" action="javascript:void(0);" method="PUT">
                                    @csrf
                                    <input type="hidden" name="organizationid" id="organizationid">
                                    <input type="hidden" name="_method" value="POST">

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewOrganizationModalLabel">View Organization</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-2">
                                            <label for="re_name" class="col-md-2 col-form-label ">{{ __('Name')
                                                }}</label>
                                            <div class="col-md-10">

                                                <input id="re_name" type="text"
                                                    class="form-control @error('re_name') is-invalid @enderror"
                                                    name="re_name" value="{{ old('re_name') }}" required
                                                    autocomplete="re_name" autofocus readonly>

                                                @error('re_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="re_handler" class="col-md-2 col-form-label ">{{ __('Handler')
                                                }}</label>
                                            <div class="col-md-10">
                                                <input id="re_handler" type="text"
                                                    class="form-control @error('re_handler') is-invalid @enderror"
                                                    name="re_handler" value="{{ old('re_handler') }}" required
                                                    autocomplete="re_handler" autofocus readonly>

                                                @error('re_handler')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="re_status" class="col-md-2 col-form-label ">{{ __('Status')
                                                }}</label>
                                            <div class="col-md-10">

                                                <select id="re_status"
                                                    class="form-control @error('re_status') is-invalid @enderror"
                                                    name="re_status" value="{{ old('re_status') }}" required
                                                    autocomplete="re_status" autofocus>
                                                    <option value="0">Pending</option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Renewal</option>
                                                    <option value="3">Disapproved</option>
                                                </select>

                                                @error('re_status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12 " style="border: 1px solid #ccc; border-radius: 10px;">
                                                <div class="row">
                                                    <small><b>Applications</b></small>
                                                    <div class="col-md-6 text-center preview">
                                                        <a id="appForm" target="_blank" rel="noopener noreferrer"
                                                            class="form-control text-decoration-none">Application Form</a>
                                                    </div>
                                                    <div class="col-md-6 text-center preview">
                                                        <a id="commForm" target="_blank" rel="noopener noreferrer"
                                                            class="form-control text-decoration-none">Adviser's Commitment
                                                            Form</a>
                                                    </div>  
                                                </div>
                                                <div class="row mt-2">
                                                    <small><b>Renewals</b></small>
                                                    <div class="col-md-6 text-center preview">
                                                        <a id="renewalletter" target="_blank" rel="noopener noreferrer"
                                                            class="form-control text-decoration-none">Renewal Letter</a>
                                                    </div>
                                                    <div class="col-md-6 text-center preview">
                                                        <a id="accomplishmentreport" target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="form-control text-decoration-none">Accomplishment
                                                            Report</a>
                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-md-12 text-center preview">
                                                        <a id="budgetaryreport" target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="form-control text-decoration-none">Budgetary
                                                            Report</a>
                                                    </div>
                                                </div>
                                                <div class="row mt-1 mb-2">
                                                    <div class="col-md-12 preview">
                                                        <b>Officers & Members</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" value="Submit" class="btn btn-primary"
                                            id="editOrganizationSubmitButton">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Organization</th>
                                <th scope="col">Handler</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody id="organizationsTableBody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card" id="Events" style="display: none;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            {{ __("Events") }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
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
                                            <div class="col-md-12">

                                                <div id="imagedata" class="" style="width: 300px; margin: auto;">

                                                </div>

                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="new_eventname" class="col-md-2 col-form-label ">{{ __('Name')
                                                }}</label>
                                            <div class="col-md-10">

                                                <input id="new_eventname" type="text"
                                                    class="form-control @error('new_eventname') is-invalid @enderror"
                                                    name="new_eventname" value="{{ old('new_eventname') }}" required
                                                    autocomplete="new_eventname" autofocus readonly>

                                                @error('new_eventname')
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
                                                    autocomplete="new_place" autofocus readonly>

                                                @error('new_place')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="new_date" class="col-md-2 col-form-label ">{{ __('Time in')
                                                }}</label>
                                            <div class="col-md-10">
                                                <input id="new_date" type="datetime-local"
                                                    class="form-control @error('new_date') is-invalid @enderror"
                                                    name="new_date" value="{{ old('new_date') }}" required
                                                    autocomplete="new_date" min="" autofocus readonly>

                                                @error('new_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="new_dateout" class="col-md-2 col-form-label ">{{ __('Time out')
                                                }}</label>
                                            <div class="col-md-10">
                                                <input id="new_dateout" type="datetime-local"
                                                    class="form-control @error('new_dateout') is-invalid @enderror"
                                                    name="new_dateout" value="{{ old('new_dateout') }}" required
                                                    autocomplete="new_dateout" min="" autofocus readonly>

                                                @error('new_dateout')
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
                                                    placeholder="Description here..." readonly></textarea>

                                                @error('new_description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="new_title" class="col-md-3 col-form-label ">{{ __('Status')
                                                }}</label>
                                            <div class="col-md-9">

                                                <select id="new_status"
                                                    class="form-control @error('new_status') is-invalid @enderror"
                                                    name="new_status" value="{{ old('new_status') }}" required
                                                    autocomplete="new_status" autofocus>
                                                    <option value="0">Pending</option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Removal</option>
                                                </select>

                                                @error('new_status')
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
                                <th scope="col">Image</th>
                                <th scope="col">Organization</th>
                                <th scope="col">Event</th>
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
                                <th scope="col">Organization</th>
                                <th scope="col">Event</th>
                                <th scope="col">Date</th>
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
                                            <label for="new_title" class="col-md-3 col-form-label ">{{ __('Title')
                                                }}</label>
                                            <div class="col-md-9">

                                                <input id="new_title" type="text"
                                                    class="form-control @error('new_title') is-invalid @enderror"
                                                    name="new_title" value="{{ old('new_title') }}" required
                                                    autocomplete="new_title" minlength="2" autofocus readonly>

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
                                                    placeholder="Description here..." readonly></textarea>

                                                @error('new_announcement')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="new_title" class="col-md-3 col-form-label ">{{ __('Status')
                                                }}</label>
                                            <div class="col-md-9">

                                                <select id="new_announcementstatus"
                                                    class="form-control @error('new_status') is-invalid @enderror"
                                                    name="new_status" value="{{ old('new_status') }}" required
                                                    autocomplete="new_status" autofocus>
                                                    <option value="0">Pending</option>
                                                    <option value="1">Approved</option>
                                                </select>

                                                @error('new_status')
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
                                <th scope="col">Organization</th>
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

<script src="{{ asset('js/carousel.js') }}"></script>
<script>
    $(document).ready(function (e) {


        $('#info-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').toggle("slide");
            $('#Application').css('display', 'none');
            $('#Renewal').css('display', 'none');
            $('#Organizations').css('display', 'none');
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
            $('#Organizations').css('display', 'none');
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
            $('#Organizations').css('display', 'none');
            $('#Events').css('display', 'none');
            $('#Active').css('display', 'none');
            $('#Announcements').css('display', 'none');
            $('#Officers').css('display', 'none');
            $('#About').css('display', 'none');

            $('.active').removeClass('active');
            $('#ren-li').addClass('active');
        });
        $('#org-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').css('display', 'none');
            $('#Application').css('display', 'none');
            $('#Renewal').css('display', 'none');
            $('#Organizations').toggle("slide");
            $('#Events').css('display', 'none');
            $('#Active').css('display', 'none');
            $('#Announcements').css('display', 'none');
            $('#Officers').css('display', 'none');
            $('#About').css('display', 'none');

            $('.active').removeClass('active');
            $('#org-li').addClass('active');
        });
        $('#eve-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').css('display', 'none');
            $('#Application').css('display', 'none');
            $('#Renewal').css('display', 'none');
            $('#Organizations').css('display', 'none');
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
            $('#Organizations').css('display', 'none');
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
            $('#Organizations').css('display', 'none');
            $('#Events').css('display', 'none');
            $('#Active').css('display', 'none');
            $('#Announcements').toggle("slide");
            $('#Officers').css('display', 'none');
            $('#About').css('display', 'none');

            $('.active').removeClass('active');
            $('#ann-li').addClass('active');
        });
        $('#abo-link').click(function (e) {
            e.stopPropagation();
            e.preventDefault();
            $('#Infographics').css('display', 'none');
            $('#Application').css('display', 'none');
            $('#Renewal').css('display', 'none');
            $('#Organizations').css('display', 'none');
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
            showOrganizations();
            showEvents();
            showAnnouncements();
            showApplications();
            showRenewals();
        }
        showAll();

        function showOrganizations() {
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('administrator.organizations')}}",

                success: function (data) {
                    if (data.length != 0) {

                        $('#organizationsTableBody').empty();
                        data.forEach(element => {

                            var edit = "";
                            if (element.status != 2) {
                                edit = `<button type="button" value="` +
                                    element.id +
                                    `" name="viewOrganization" class="btn btn-primary" id="viewOrganization" data-bs-toggle="modal" data-bs-target="#viewOrganizationModal">
                                                <i class="fas fa-eye"></i>
                                            </button>`;
                            }
                            var status = (element.status == 0) ? 'Pending' : (element.status == 1) ? 'Approved' : 'Removal';

                            $('#organizationsTableBody').append(`
                            <tr>
                                <td>`+ element.name + `</td>
                                <td>`+ element.user_name + `</td>
                                <td>`+ status + `</td>
                                <td  class="text-end">
                                    `+ edit +`
                                </td>
                             </tr>
                            `)
                        });
                    } else {
                        $('#organizationsTableBody').empty();
                    }
                }
            });
        }
        function showEvents() {
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('administrator.events')}}",

                success: function (data) {
                    // Events
                    console.log(data)
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

                            var now = getDateNow(0);

                            var teststart = Date.parse(data[index]['date_time']);
                            const testnow = Date.now();
                            var testend = Date.parse(data[index]['out']);
                            
                            var statusTester = ((data[index]['status'] == 1 && (parseInt(teststart) <= parseInt(testnow)) && (parseInt(testend) >= parseInt(testnow)))) ? data[index]['status'] : (data[index]['status'] == 1 && (parseInt(testend) <= parseInt(testnow))) ? data[index]['status'] = 2 : data[index]['status'];
                            var edit = ``;
                            if (data[index]['status'] != 2) {
                                edit = `<button type="button" value="` +
                                    data[index]['id'] +
                                    `" name="editEvent" class="btn btn-primary" id="editEvent" data-bs-toggle="modal" data-bs-target="#editEventModal">
                                                <i class="fas fa-pen"></i>
                                            </button>`;
                            }

                            // console.log(data[index])
                            var status = (data[index]['status'] == 0) ? 'Pending' : (data[index]['status'] == 1) ? 'Approved' : 'Removal';
                            const imageurl = data[index]['image'];
                            const image = `<img class="avatar" src="{{ asset('` + imageurl + `') }}" alt="" width="50" height="50" style="border-radius: 50%">`;

                            $('#eventTableBody').append(
                                `<tr>
                                    <td>`+ image + `</td>
                                    <td>`+ data[index]['author'] + `</td>
                                    <td>`+ data[index]['name'] + `</td>
                                    <td>`+ date_time + `</td>
                                    <td>`+ status + `</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            `+ edit + `
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

                            if (element.status == 1 && (element.date_time.substring(0, 10)) === (now.substring(0, 10))) {
                                $('#activeEventTableBody').append(
                                    `<tr>
                                        <td>`+ element.author + `</td>
                                        <td>`+ element.name + `</td>
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
                url: "{{route('administrator.announcements')}}",

                success: function (data) {
                    // Announcements
                    $('#announcementTableBody').empty();
                    if (data.length != 0) {
                        for (let index = 0; index < data.length; index++) {
                            var status = (data[index]['status'] == 0) ? 'Pending' : (data[index]['status'] == 1) ? 'Approved' : 'Removal';
                            $('#announcementTableBody').append(
                                `<tr>
                                    <td>`+ data[index]['author'] + `</td>
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
        function showApplications() {
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('administrator.applications')}}",

                success: function (data) {
                    if (data.length != 0) {
                        $('#applicationTableBody').empty();
                        data.forEach(element => {
                            var status = (element.status == 0) ? 'Pending' : (element.status == 1) ? 'Approved' : 'Removal';

                            $('#applicationTableBody').append(`
                            <tr>
                                <td>`+ element.name + `</td>
                                <td>`+ element.user_name + `</td>
                                <td>`+ status + `</td>
                                <td  class="text-end">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" value="` + element.id + `" name="viewApplication" class="btn btn-primary" id="viewApplication" data-bs-toggle="modal" data-bs-target="#viewApplicationModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" value="` + element.id + `" name="deleteApplication" class="btn btn-danger between" id="deleteApplication">
                                                <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            `)
                        });
                    } else {
                        $('#applicationTableBody').empty();
                    }
                }
            })
        }
        function showRenewals() {
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('administrator.renewals')}}",

                success: function (data) {
                    if (data.length != 0) {
                        $('#renewalTableBody').empty();
                        data.forEach(element => {
                            var status = (element.status == 2) ? 'Pending' : (element.status == 1) ? 'Renewed' : 'Removal';

                            $('#renewalTableBody').append(`
                            <tr>
                                <td>`+ element.name + `</td>
                                <td>`+ element.user_name + `</td>
                                <td>`+ status + `</td>
                                <td  class="text-end">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" value="` + element.id + `" name="viewRenewal" class="btn btn-primary" id="viewRenewal" data-bs-toggle="modal" data-bs-target="#viewRenewalModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" value="` + element.id + `" name="deleteRenewal" class="btn btn-danger between" id="deleteRenewal">
                                                <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            `)
                        });
                    } else {
                        $('#renewalTableBody').empty();
                    }
                }
            })
        }

        $(document).on('click', "button[name='viewOrganization']", function () {
            
        });

        $(document).on('click', "button[name='viewApplication']", function () {
            var id = $(this).val();
            var route = "{{ route('administrator.viewApplication', ':id')}}";
            route = route.replace(":id", id);

            $.ajax({
                url: route,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (data) {
                    $('#applicationid').val(data[0]['application_id']);
                    $('#new_name').val(data[0]['name']);
                    $('#new_handler').val(data[0]['handler'])
                    $('#appForm').attr('href', '../' + data[0].application_form)
                    $('#commForm').attr('href', '../' + data[0].advisers_commitment_form)
                    $('#new_applicationstatus').val(data[0]['status'])
                }
            }),
                $(document).unbind('submit').on("submit", "#viewApplicationForm", function () {
                    let id = $('#applicationid').val();
                    let status = $('#new_applicationstatus').val();

                    let route = "{{ route('administrator.updateApplication', ':id')}}";
                    route = route.replace(':id', id);

                    let formData = new FormData();
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("_method", 'PUT');
                    formData.append("from", "ADMIN");
                    formData.append('status', status);

                    $.ajax({
                        url: route,
                        method: 'POST',
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            if (data >= 1) {
                                $('#viewApplicationModal').modal('hide');
                                Swal.fire(
                                    'Yeeeey!',
                                    'Event Updated!',
                                    'success'
                                )

                                $('#viewApplicationForm').trigger('reset');
                                $('#applicationTableBody').empty();
                                showApplications();
                            } else {
                                $('#viewApplicationForm').modal('hide');
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

        $(document).on('click', "button[name='viewRenewal']", function () {
            var id = $(this).val();
            var route = "{{ route('administrator.viewRenewal', ':id')}}";
            route = route.replace(":id", id);

            $.ajax({
                url: route,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (data) {
                    $('#renewalid').val(data[0]['renewal_id']);
                    $('#re_name').val(data[0]['name']);
                    $('#re_handler').val(data[0]['handler'])
                    $('#renewalletter').attr('href', '../' + data[0].renewal_letter)
                    $('#accomplishmentreport').attr('href', '../' + data[0].accomplishment_report)
                    $('#budgetaryreport').attr('href', '../' + data[0].budgetary_report)
                    $('#re_status').val(data[0]['status'])
                }
            }),
                $(document).unbind('submit').on("submit", "#viewRenewalForm", function () {
                    let id = $('#renewalid').val();
                    let status = $('#re_status').val();

                    let route = "{{ route('administrator.updateRenewal', ':id')}}";
                    route = route.replace(':id', id);

                    let formData = new FormData();
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("_method", 'PUT');
                    formData.append("from", "ADMIN");
                    formData.append('status', status);

                    $.ajax({
                        url: route,
                        method: 'POST',
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            if (data >= 1) {
                                $('#viewRenewalModal').modal('hide');
                                Swal.fire(
                                    'Yeeeey!',
                                    'Event Updated!',
                                    'success'
                                )

                                $('#viewRenewalForm').trigger('reset');
                                $('#renewalTableBody').empty();
                                showRenewals();
                            } else {
                                $('#viewRenewalForm').modal('hide');
                                Swal.fire(
                                    'Eeek!',
                                    'Nothing Changes!',
                                    'error'
                                )

                                $('#viewRenewalForm').trigger('reset');
                            }
                        }
                    })
                });
        });

        $(document).on('click', "button[name='editEvent']", function () {
            var id = $(this).val();
            var route = "{{ route('administrator.editEvent', ':id')}}";
            route = route.replace(":id", id);

            $.ajax({
                url: route,
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (data) {
                    const link = data[0]['image'];
                    $('#id').val(data[0]['id']);
                    $('#imagedata').empty().append(`
                        <img class="bd-placeholder-img" src="{{asset('` + link + `')}}" alt="" width="100%" style="border-radius: 10px">
                    `);
                    $('#new_eventname').val(data[0]['name']);
                    $('#new_place').val(data[0]['place']);
                    $('#new_date').val(data[0]['date_time']);
                    $('#new_dateout').val(data[0]['out']);
                    $('#new_description').val(data[0]['description'])
                    $('#new_status').val(data[0]['status'])
                }
            }),

                $(document).unbind('submit').on("submit", "#editEventForm", function () {
                    let id = $('#id').val();
                    let status = $('#new_status').val();

                    let route = "{{ route('administrator.updateEvent', ':id')}}";
                    route = route.replace(':id', id);

                    let formData = new FormData();
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("_method", 'PUT');
                    formData.append("from", "ADMIN");
                    formData.append('status', status);

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
                                showEvents();
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
            var route = "{{ route('administrator.destroyEvent', ':id')}}";
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
            formData.append("from", "ADMIN");
            formData.append('title', title);
            formData.append('announcement', announcement);
            formData.append('status', '1');

            $.ajax({
                url: "{{ route('administrator.storeAnnouncement') }}",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    if (data == 1) {

                        $('#addAnnouncementModal').modal('hide');
                        Swal.fire(
                            'Yeeeey!',
                            'Announcement is posted!',
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
            var route = "{{ route('administrator.editAnnouncement', ':id')}}";
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
                    $('#new_announcementstatus').val(data[0]['status']);
                }
            }),
                $(document).unbind('submit').on("submit", "#editAnnouncementForm", function () {
                    let id = $('#id').val();
                    let status = $('#new_announcementstatus').val();

                    let route = "{{ route('administrator.updateAnnouncement', ':id')}}";
                    route = route.replace(':id', id);

                    let formData = new FormData();
                    formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    formData.append("_method", 'PUT');
                    formData.append("from", 'ADMIN');
                    formData.append('status', status);

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
            var route = "{{ route('administrator.destroyAnnouncement', ':id')}}";
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