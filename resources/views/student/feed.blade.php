@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4" id="Infographics">
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
            <div class="card">
                <div class="card-header">
                    {{ __("Feed") }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session("status") }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ __("Events") }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="events">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{ __("Announcements") }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="announcements">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="enlargeEventModal" tabindex="-1" aria-labelledby="enlargeEventModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="enlargeEventModalLabel">Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="enlargedViewBody">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
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

<script src="{{ asset('js/carousel.js') }}"></script>
<script>
    $(document).ready(function () {
        function getTotalEvents() {
            var totalEvents;
            var activeEvents = [];
            var incomingEvents = [];
            var actIncEvents = [];
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
                    data.forEach(element => {
                        if (element.date_time > date_time) {
                            incomingEvents.push(element);
                            actIncEvents.push(element);
                        }
                    });

                    data.forEach(element => {
                        if ((element.date_time.substring(0, 10)) === (date_time.substring(0, 10))) {
                            activeEvents.push(element);
                            actIncEvents.push(element);
                        }
                    });

                    totalEvents = data;
                },
            });
            return { total: totalEvents, active: activeEvents, incoming: incomingEvents, joined: actIncEvents };
        };

        function getTotalAnnouncements() {
            var totalAnnouncements = [];

            $.ajax({
                async: false,
                method: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('student.announcements')}}",
                success: function (data) {
                    data.forEach(element => {
                        totalAnnouncements.push(element);
                    });
                },
            });
            return totalAnnouncements;
        };

        function updateFeed() {
            var events = getTotalEvents();
            var announcements = getTotalAnnouncements();

            if (events.joined.length != 0) {
                events.joined.forEach(element => {
                    var d = new Date(element.date_time);
                    var months = ["January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"
                    ];
                    var month = months[d.getMonth()];
                    var day = (d.getDate() + 1 >= 10) ? d.getDate() : ('0' + (d.getDate() + 1));
                    var hour = (d.getHours() >= 10) ? d.getHours() : ('0' + d.getHours());
                    var min = (d.getMinutes() >= 10) ? d.getMinutes() : ('0' + (d.getMinutes()));
                    var date_time = month + ' ' + day + ', ' + d.getFullYear() + '. ' + ((hour > 12) ? hour - 12 : hour) + ':' + min + ' ' + ((hour < 12) ? 'AM' : 'PM');

                    var teststart = Date.parse(element.date_time);
                    const testnow = Date.now();
                    var testend = Date.parse(element.out);

                    if ((element.status == 1 && (parseInt(teststart) <= parseInt(testnow)) && (parseInt(testend) >= parseInt(testnow))) || (element.status == 1 && (parseInt(teststart) >= parseInt(testnow)))) {
                        const imageurl = element.image;
                        const image = `<img class="avatar" src="{{ asset('` + imageurl + `') }}" alt="" width="100%" style="border-radius: 10px">`;
                        $('#events').append(`
                                <div onclick="enlargeEvent(\'`+ element.id +`\')" title="View Event" style="cursor: pointer">
                                    `+ image +`
                                    <hr style="width: 10%; height: 5px;">
                                    <div class="row">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <b>{{ __("`+ element.name + `") }} | {{ __("`+ element.place + `") }}</b> <br>
                                                {{ __("`+ element.description + `") }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-end">
                                                {{ __("`+ element.author + `") }} <br>
                                                {{ __("`+ date_time + `") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        `)
                    }
                });

            } else {
                $('#events').append(`
                            <p class="text-center">{{ __("No Events") }}</p>
                    `)
            }

            if (announcements.length != 0) {
                $('#announcements').empty();
                    announcements.forEach(element => {
                        if (element.status == 1) {
                            $('#announcements').append(`
                                        <hr style="width: 10%; height: 5px;">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <b>`+ element.title + `</b> <br>
                                                    {{ __("`+ element.announcement + `") }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-end">
                                                    {{ __("`+ element.author + `") }} <br>
                                                    {{ __("`+ element.email + `") }}
                                                </div>
                                            </div>
                                        </div>
                            `);
                        }
                });
            } else {
                $('#announcements').append(`
                            <p class="text-center">{{ __("No Announcements") }}</p>
                    `)
            }
        };

        updateFeed();

    });

    function getTotalEvents() {
        var totalEvents;
        var activeEvents = [];
        var incomingEvents = [];
        var actIncEvents = [];
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
                data.forEach(element => {
                    if (element.date_time > date_time) {
                        incomingEvents.push(element);
                        actIncEvents.push(element);
                    }
                });

                data.forEach(element => {
                    if ((element.date_time.substring(0, 10)) === (date_time.substring(0, 10))) {
                        activeEvents.push(element);
                        actIncEvents.push(element);
                    }
                });

                totalEvents = data;
            },
        });
        return { total: totalEvents, active: activeEvents, incoming: incomingEvents, joined: actIncEvents };
    };
    
    function enlargeEvent(event_id) {
        events = getTotalEvents();
        events = events.joined;
        const selectedevent = events.find((e) => e.id == event_id);
        
        const imageurl = selectedevent.image;
        const image = `<img class="avatar" src="{{ asset('` + imageurl + `') }}" alt="" width="100%" style="border-radius: 10px">`;
        $("#enlargeEventModalLabel").empty().text(selectedevent.name);
        $("#enlargedViewBody").empty().append(`
            <div>
                `+ image +`
                <hr style="width: 10%; height: 5px;">
                <div class="row">
                    <div class="row">
                        <div class="col-md-12">
                            {{ __("Posted By: `+ selectedevent.author + `") }} <br>
                            <b>{{ __("`+ selectedevent.name + `") }} | {{ __("`+ selectedevent.place + `") }}</b> <br>
                            {{ __("`+ selectedevent.description + `") }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            {{ __("`+ dateToWords(selectedevent.date_time) + `") }} <br>
                            {{ __("Until `+ dateToWords(selectedevent.out) + `") }}
                        </div>
                    </div>
                </div>
            </div>
        `)
        $("#enlargeEventModal").modal('show');
    }

    function dateToWords(str_date) {
        const dateObj = new Date(str_date);
        const months = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        const month = months[dateObj.getMonth()];
        const day = (dateObj.getDate() + 1 >= 10) ? dateObj.getDate() : ('0' + (dateObj.getDate() + 1));
        const hour = (dateObj.getHours() >= 10) ? dateObj.getHours() : ('0' + dateObj.getHours());
        const min = (dateObj.getMinutes() >= 10) ? dateObj.getMinutes() : ('0' + (dateObj.getMinutes()));

        return (month + ' ' + day + ', ' + dateObj.getFullYear() + '. ' + ((hour > 12) ? hour - 12 : hour) + ':' + min + ' ' + ((hour < 12) ? 'AM' : 'PM'));
    }
</script>
@endsection