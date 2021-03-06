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
                    <img src="{{ asset('img/admin-orgs-infographics.svg') }}" alt="All you need to know">
                </div>
            </div>

            <div class="card" id="Application" style="display: none;">
                <div class="card-header">
                    {{ __("Application") }}
                </div>

                <div class="card-body">
                    {{ __("This Feature is Under Development.") }}
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

            <div class="card" id="Organizations" style="display: none;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            {{ __("Organizations") }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Organization</th>
                                <th scope="col">Handler</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody id="organizationTableBody">
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
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ __("This Feature is Under Development.") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" value="Submit" class="btn btn-primary"
                                        id="editEventSubmitButton">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
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
                        <div class="col-md-12">
                            {{ __("Announcements") }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Edit Announcement Modal -->
                    <div class="modal fade" id="editAnnouncementModal" tabindex="-1"
                        aria-labelledby="editAnnouncementModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editAnnouncementModalLabel">Edit Announcement</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ __("This Feature is Under Development.") }}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" value="Submit" class="btn btn-primary"
                                        id="editAnnouncementSubmitButton">Submit</button>
                                </div>
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
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('administrator.organizations')}}",

                success: function (data) {
                    if (data.length != 0) {

                        $('#organizationTableBody').empty();
                        data.forEach(element => {
                            var status = (element.status == 0) ? 'Pending' : (element.status == 1) ? 'Approved' : 'Removal';

                            $('#organizationTableBody').append(`
                            <tr>
                                <td>`+ element.name + `</td>
                                <td>`+ element.user_name + `</td>
                                <td>`+ status + `</td>
                                <td  class="text-end">
                                    Under Development.
                                </td>
                             </tr>
                            `)
                        });
                    } else {
                        $('#organizationTableBody').empty();
                    }
                }
            });

            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('administrator.events')}}",

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

                            var now = getDateNow(0);
                            var statusTester = ((data[index]['date_time'].substring(0, 10)) === (now.substring(0, 10))) ? data[index]['status'] : (parseInt(data[index]['date_time'].replace(/T|-|:/g, '')) < parseInt(now.replace(/T|-|:/g, ''))) ? data[index]['status'] = 2 : data[index]['status'];
                            var edit = ``;
                            if (data[index]['status'] != 2) {
                                edit = `<button type="button" value="` +
                                    data[index]['id'] +
                                    `" name="editEvent" class="btn btn-primary" id="editEvent" data-bs-toggle="modal" data-bs-target="#editEventModal">
                                                <i class="fas fa-pen"></i>
                                            </button>`;
                            }
                            
                            var status = (data[index]['status'] == 0) ? 'Pending' : (data[index]['status'] == 1) ? 'Approved' : 'Removal';

                            $('#eventTableBody').append(
                                `<tr>
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
        showAll();

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