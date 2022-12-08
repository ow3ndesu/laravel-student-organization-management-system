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
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <i class="far fa-calendar-check"></i>
                                            {{ __("Active Events") }}
                                        </div>
                                        <div class="col-md-4" id="active">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
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
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <i class="fas fa-sitemap"></i>
                                            {{ __("Organizations") }}
                                        </div>
                                        <div class="col-md-4" id="organization">
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
                            @if($status == 0)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                {{ __("Organization under approval! Please refer at Organization Tab above for more info about your application.") }}
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <i
                                                    class="far fas fa-bullhorn"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($status == 1)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                {{ __("Organization is now approved! See more at Organization Tab above.") }}
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <i
                                                    class="far fas fa-bullhorn"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($status == 2)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-10">
                                                {{ __("Organization under renewal! Please refer at Organization Tab anove for more info about your renewal.") }}
                                            </div>
                                            <div class="col-md-2 text-end">
                                                <i
                                                    class="far fas fa-bullhorn"
                                                ></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
                url: "{{route('organization.events')}}",
                success: function (data) {
                    data.forEach(element => {
                        var teststart = Date.parse(element.date_time);
                        const testnow = Date.now();
                        var testend = Date.parse(element.out);
                        
                        if ((element.status == 1 && (parseInt(teststart) <= parseInt(testnow)) && (parseInt(testend) >= parseInt(testnow))) || (element.status == 1 && (parseInt(teststart) >= parseInt(testnow)))) {
                            incomingEvents++;
                        }
                    });
                    
                    data.forEach(element => {
                        var teststart = Date.parse(element.date_time);
                        const testnow = Date.now();
                        var testend = Date.parse(element.out);
                        
                        if (element.status == 1 && (parseInt(teststart) <= parseInt(testnow)) && (parseInt(testend) >= parseInt(testnow))) {
                            activeEvents++; 
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
                url: "{{route('organization.announcements')}}",
                success: function (data) {
                    totalAnnouncements = data.length;
                },
            });
            return totalAnnouncements;
        };

        function getTotalOrganizations() {
            var totalOrganizations;

            $.ajax({
                async: false,
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('organization.organizations')}}",
                success: function (data) {
                    totalOrganizations = data.length;
                },
            });
            return totalOrganizations;
        };

        var events = getTotalEvents();
        var announcements = getTotalAnnouncements();
        var organizations = getTotalOrganizations();

        $('#active').append(`
            <p class="card-text text-end">` + events.active + `</p>
        `);
        $('#incoming').append(`
            <p class="card-text text-end">` + events.incoming + `</p>
        `);
        $('#announcement').append(`
            <p class="card-text text-end">` + announcements + `</p>
        `);
        $('#organization').append(`
            <p class="card-text text-end">` + organizations + `</p>
        `);
    });
</script>
@endsection