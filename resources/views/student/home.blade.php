@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __("Dashboard") }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session("status") }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <i
                                                class="far fa-calendar-check"
                                            ></i>
                                            {{ __("Active Events") }}
                                        </div>
                                        <div class="col-md-4" id="active">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <i class="far fa-calendar"></i>
                                            {{ __("Incoming Events") }}
                                        </div>
                                        <div class="col-md-4" id="incoming">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <i class="fas fa-bullhorn"></i>
                                            {{ __("Announcements") }}
                                        </div>
                                        <div class="col-md-4" id="announcement">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    {{ __("Notifications") }}
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12" id="notifications">
                            <!-- <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            {{ __("There is a new event coming this Aug 1, 2022.") }}
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <i
                                                class="far fas fa-bullhorn"
                                            ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            {{ __("Go join us now at Astro World Convention | Gymnasium") }}
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <i
                                                class="far fas fa-bullhorn"
                                            ></i>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
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
    $(document).ready(function () {
        function getTotalEvents() {
            var totalEvents;
            var activeEvents = 0;
            var incomingEvents = 0;
            var d = new Date($.now());
            var mos = (d.getMonth + 1 >= 10) ? d.getMonth() : ('0' + (d.getMonth() + 1));
            var day = (d.getDate() + 1 >= 10) ? d.getDate() : ('0' + (d.getDate() + 1));
            var hour = (d.getHours() >= 10) ? d.getHours() : ('0' + d.getHours());
            var min = (d.getMinutes() >= 10) ? d.getMinutes() : ('0' + (d.getMinutes()));
            var date_time = d.getFullYear() + '-' + mos + '-' + day + 'T' + hour + ":" + min;

            $.ajax({
                async: false,
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('student.events')}}",
                success: function (data) {
                    $("#notifications").empty();
                    data.forEach(element => {
                        var teststart = Date.parse(element.date_time);
                        const testnow = Date.now();
                        var testend = Date.parse(element.out);

                        var months = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                            ];

                        var start = new Date(element.date_time);
                        var dmonth = months[start.getMonth()];
                        var dday = (start.getDate() + 1 >= 10) ? start.getDate() : ('0' + (start.getDate() + 1));
                        var dhour = (start.getHours() >= 10) ? start.getHours() : ('0' + start.getHours());
                        var dmin = (start.getMinutes() >= 10) ? start.getMinutes() : ('0' + (start.getMinutes()));
                        var ddate_time = dmonth + ' ' + dday + ', ' + start.getFullYear() + '. ' + ((dhour > 12) ? dhour - 12 : dhour) + ':' + dmin + ' ' + ((dhour < 12) ? 'AM' : 'PM');
                        
                        if ((element.status == 1 && (parseInt(teststart) >= parseInt(testnow)))) {
                            incomingEvents++;
                            $("#notifications").append(`
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            {{ __("There is a new event coming this `+ ddate_time +`, see more at feed.") }}
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <i
                                                class="far fas fa-bullhorn"
                                            ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                        }
                    });
                    
                    data.forEach(element => {
                        var teststart = Date.parse(element.date_time);
                        const testnow = Date.now();
                        var testend = Date.parse(element.out);
                        
                        if (element.status == 1 && (parseInt(teststart) <= parseInt(testnow)) && (parseInt(testend) >= parseInt(testnow))) {
                            activeEvents++; 
                            $("#notifications").append(`
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            {{ __("Come join us now at `+ element.name +` | `+ element.place +`, see more at feed.") }}
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <i
                                                class="far fas fa-bullhorn"
                                            ></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `);
                        }
                    });

                    totalEvents = data.length;
                },
            });
            return {total: totalEvents, active: activeEvents, incoming: incomingEvents};
        };

        function getTotalAnnouncements() {
            var totalAnnouncements;

            $.ajax({
                async: false,
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('student.announcements')}}",
                success: function (data) {
                    totalAnnouncements = data.length;
                },
            });
            return totalAnnouncements;
        };

        var events = getTotalEvents();
        var announcements = getTotalAnnouncements();

        $('#active').append(`
            <p class="card-text text-end">` + events.active + `</p>
        `);
        $('#incoming').append(`
            <p class="card-text text-end">` + events.incoming + `</p>
        `);
        $('#announcement').append(`
            <p class="card-text text-end">` + announcements + `</p>
        `);
    });
</script>
@endsection
