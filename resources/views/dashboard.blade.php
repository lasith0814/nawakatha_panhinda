@extends('layouts.app', ['activePage' => 'Dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">


        </div>
        <div class="card text-white bg-primary mb-3" style="height: 20rem; justify-content: center; text-align: center">
            <div class="card-header"><span style="font-size: 25px" id="times">&nbsp;</span> <br><h3>Welcome !!! <br>{{Config::get('app.name')}} <br> Content Management System</h3></div>
            <div class="card-body">
                <span class="row " style="font-size: 25px; text-align: center; justify-content: center; " id="date">&nbsp;</span> <br>
                <span class="row " style="font-size: 25px; text-align: center; justify-content: center; " id="clock"></span>
            </div>
        </div>
    </div>


    </div>

@endsection

<script type="text/javascript">

    function updateClock()
    {
        var currentTime = new Date ();
        var year = currentTime.getFullYear();
        var month = currentTime.getMonth()+1;
        var date = currentTime.getDate();
        month = ( month < 10 ? "0" : "" ) + month;
        date = ( date < 10 ? "0" : "" ) + date;
        var dateToday = year + "-" + month + "-" + date;

        var currentHours = currentTime.getHours();
        var currentMinutes = currentTime.getMinutes();
        var currentSeconds = currentTime.getSeconds();

        currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
        currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
        currentHours = ( currentHours < 10 ? "0" : "" ) + currentHours;

        // Choose either "AM" or "PM" as appropriate
        var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
        if(currentHours < 12){
            var goodtime = 'Good Morning !!!';
        }
        else if(currentHours >= 12 && currentHours < 17 ){
            var goodtime = 'Good Afternoon !!!';
        }
        else if(currentHours >= 17 && currentHours < 20 ){
            var goodtime = 'Good Evening !!!';
        }
        else{
            var goodtime = 'Good Night !!!';
        }

        var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds;

        document.getElementById("clock").innerHTML = currentTimeString;
        document.getElementById("times").firstChild.nodeValue = goodtime;
        document.getElementById("date").firstChild.nodeValue = dateToday;

    }

    // updateClock()
    setInterval('updateClock()', 1000 );
</script>
