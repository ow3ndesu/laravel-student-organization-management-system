@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header"><b>{{ __("Events History") }}</b></div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Place</th>
                                <th scope="col">Date</th>
                                <th scope="col">End at</th>
                            </tr>
                        </thead>
                        <tbody id="historyTableBody">
                        </tbody>
                    </table>
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
            showHistory();
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

        function showHistory() {
            $.ajax({
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                url: "{{route('events.history')}}",

                success: function (data) {
                    // Events
                    console.log(data)
                    if (data.length != 0) {

                        $('#historyTableBody').empty();
                        data.forEach(element => {
                            var start = new Date(element.date_time);
                            const now = new Date();
                            var end = new Date(element.out);

                            var teststart = Date.parse(element.date_time);
                            const testnow = Date.now();
                            var testend = Date.parse(element.out);

                            var months = ["January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November", "December"
                            ];
                            var month = months[start.getMonth()];
                            var day = (start.getDate() + 1 >= 10) ? start.getDate() : ('0' + (start.getDate() + 1));
                            var hour = (start.getHours() >= 10) ? start.getHours() : ('0' + start.getHours());
                            var min = (start.getMinutes() >= 10) ? start.getMinutes() : ('0' + (start.getMinutes()));
                            var date_time = month + ' ' + day + ', ' + start.getFullYear() + '. ' + ((hour > 12) ? hour - 12 : hour) + ':' + min + ' ' + ((hour < 12) ? 'AM' : 'PM');

                            //End
                            var emonth = months[end.getMonth()];
                            var eday = (end.getDate() + 1 >= 10) ? end.getDate() : ('0' + (end.getDate() + 1));
                            var ehour = (end.getHours() >= 10) ? end.getHours() : ('0' + end.getHours());
                            var emin = (end.getMinutes() >= 10) ? end.getMinutes() : ('0' + (end.getMinutes()));
                            var out = emonth + ' ' + eday + ', ' + end.getFullYear() + '. ' + ((ehour > 12) ? ehour - 12 : ehour) + ':' + emin + ' ' + ((ehour < 12) ? 'AM' : 'PM');

                            const imageurl = element.image;
                            const image = `<img class="avatar" src="{{ asset('` + imageurl + `') }}" alt="" width="50" height="50" style="border-radius: 50%">`;

                            console.log("in: " + start);
                            console.log("now: " + now);
                            console.log("out: " + end);
                            console.log("passed: " , (parseInt(testend) <= parseInt(testnow)));

                            if ((parseInt(testend) <= parseInt(testnow))) {
                                $('#historyTableBody').append(
                                    `<tr>
                                        <td>`+ image + `</td>
                                        <td>`+ element.name + `</td>
                                        <td>`+ element.place + `</td>
                                        <td>`+ date_time + `</td>
                                        <td>`+ out + `</td>
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
    });
</script>
@endsection