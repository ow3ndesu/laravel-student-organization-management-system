@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header"><b>{{ __("Archive") }}</b></div>

                <div class="card-body">
                    <div class="card">
                        <div class="card-header"><b>{{ __("Organizations") }}</b></div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Organization</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="organizationsTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card mt-2">
                        <div class="card-header"><b>{{ __("Event") }}</b></div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Organization ID</th>
                                        <th scope="col">Event</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="eventTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="card mt-2">
                        <div class="card-header"><b>{{ __("Announcement") }}</b></div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Organization ID</th>
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

                    <div class="card mt-2">
                        <div class="card-header"><b>{{ __("Students") }}</b></div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Fullname</th>
                                        <th scope="col">Email</th>
                                        <th scope="col"  class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="studentsTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>

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
        function showAll() {
            showOrganizations();
            showEvents();
            showAnnouncements();
            showStudents();
        }
        showAll();

        function getDateNow(plus) {
            var d = new Date($.now());
            var mos = (d.getMonth + 1 >= 10) ? d.getMonth() : ('0' + (d.getMonth() + 1));
            var day = (d.getDate() + 1 >= 10) ? d.getDate() + plus : ('0' + (d.getDate() + (1 + plus)));
            var hour = (d.getHours() >= 10) ? d.getHours() : ('0' + d.getHours());
            var min = (d.getMinutes() >= 10) ? d.getMinutes() : ('0' + (d.getMinutes()));
            var date_time = d.getFullYear() + '-' + mos + '-' + day + 'T' + hour + ":" + min;

            return date_time;
        }

        function showOrganizations() {
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('administrator.archive_organizations')}}",

                success: function (data) {
                    if (data.length != 0) {

                        $('#organizationsTableBody').empty();
                        data.forEach(element => {
                            var status = (element.status == 0) ? 'Pending' : (element.status == 1) ? 'Approved' : 'Removal';

                            $('#organizationsTableBody').append(`
                            <tr>
                                <td>`+ element.name + `</td>
                                <td>`+ status + `</td>
                                <td class="text-end">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" value="` +
                            element.id +
                            `" name="redoArchivedOrganization" class="btn btn-danger between" id="redoArchivedOrganization">
                                                <i class="fa fa-undo"></i>
                                        </button>
                                    </div>
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
                url: "{{route('administrator.archive_events')}}",

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

                            var teststart = Date.parse(data[index]['date_time']);
                            const testnow = Date.now();
                            var testend = Date.parse(data[index]['out']);

                            // console.log(data[index])
                            var status = (data[index]['status'] == 0) ? 'Pending' : (data[index]['status'] == 1) ? 'Approved' : 'Removal';
                            const imageurl = data[index]['image'];
                            const image = `<img class="avatar" src="{{ asset('` + imageurl + `') }}" alt="" width="50" height="50" style="border-radius: 50%">`;

                            $('#eventTableBody').append(
                                `<tr>
                                    <td>`+ image + `</td>
                                    <td>`+ data[index]['user_id'] + `</td>
                                    <td>`+ data[index]['name'] + `</td>
                                    <td>`+ date_time + `</td>
                                    <td>`+ status + `</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" value="` +
                                data[index]['id'] +
                                `" name="redoArchivedEvent" class="btn btn-danger between" id="redoArchivedEvent">
                                                 <i class="fa fa-undo"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>`
                            )

                        }
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
                url: "{{route('administrator.archive_announcements')}}",

                success: function (data) {
                    // Announcements
                    $('#announcementTableBody').empty();
                    if (data.length != 0) {
                        for (let index = 0; index < data.length; index++) {
                            var status = (data[index]['status'] == 0) ? 'Pending' : (data[index]['status'] == 1) ? 'Approved' : 'Removal';
                            $('#announcementTableBody').append(
                                `<tr>
                                    <td>`+ data[index]['user_id'] + `</td>
                                    <td>`+ data[index]['announcement'] + `</td>
                                    <td>`+ status + `</td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" value="` +
                                data[index]['id'] +
                                `" name="redoArchivedAnnouncement" class="btn btn-danger between" id="redoArchivedAnnouncement">
                                                 <i class="fa fa-undo"></i>
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

        function showStudents() {
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('administrator.archive_students')}}",

                success: function (data) {
                    // Students
                    $('#studentsTableBody').empty();
                    if (data.length != 0) {
                        data.forEach(element => {
                            $('#studentsTableBody').append(`
                                <tr>
                                    <td>`+ element.name + `</td>
                                    <td>`+ element.email + `</td>
                                    <td  class="text-end">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" value="` +
                                element.id +
                                `" name="redoArchivedStudent" class="btn btn-danger between" id="redoArchivedStudent">
                                                 <i class="fa fa-undo"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        $('#studentsTableBody').empty();
                    }
                }
            })
        }
        
        $(document).on('click', "button[name='redoArchivedAnnouncement']", function () {
            var id = $(this).val();
            var route = "{{ route('administrator.restoreAnnouncement', ':id')}}";
            route = route.replace(":id", id);

            var formData = new FormData();
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("_method", "DELETE");

            Swal.fire({
                title: 'Are you sure?',
                text: "This will revert this changes!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
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
                                    'Announcement Restored!',
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

        $(document).on('click', "button[name='redoArchivedEvent']", function () {
            var id = $(this).val();
            var route = "{{ route('administrator.restoreEvent', ':id')}}";
            route = route.replace(":id", id);

            var formData = new FormData();
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("_method", "DELETE");

            Swal.fire({
                title: 'Are you sure?',
                text: "This will revert this changes!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
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
                                    'Event Restored!',
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

        $(document).on('click', "button[name='redoArchivedOrganization']", function () {
            var id = $(this).val();
            var route = "{{ route('administrator.restoreOrganization', ':id')}}";
            route = route.replace(":id", id);

            var formData = new FormData();
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("_method", "DELETE");

            Swal.fire({
                title: 'Are you sure?',
                text: "This will revert this changes!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
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
                                    'Organization Restored!',
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
        
        $(document).on('click', "button[name='redoArchivedStudent']", function () {
            var id = $(this).val();
            var route = "{{ route('administrator.restoreStudent', ':id')}}";
            route = route.replace(":id", id);

            var formData = new FormData();
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );
            formData.append("_method", "DELETE");

            Swal.fire({
                title: 'Are you sure?',
                text: "This will revert this changes!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!'
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
                                    'Student Restored!',
                                    'success'
                                )
                                $('#studentsTableBody').empty();
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