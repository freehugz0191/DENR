@extends('layouts.app')
<link rel="stylesheet" href="css/css_home.css">

@section('content')
<?php
 
$dataPoints = array(
	array("label"=> "Pending", "y"=> $pending->count()),
  array("label"=> "Rejected", "y"=> $reject->count()),
  array("label"=> "Approved", "y"=> $approve->count())
	
	
);
	
?>
<div>
  <div class="pull-right">
    <div class="container1">
      <div class="clock">
        <div class="hour">
          <div class="hr" id="hr"></div>
        </div>
        <div class="min">
          <div class="mn" id="mn"></div>
        </div>
        <div class="sec">
          <div class="sc" id="sc"></div>
        </div>
        <h4 style="font-size: 15px; text-align:center" id="day"></h4>
      </div>
    </div>
  </div>
  <div>
    <h1 style="text-align: center; padding: 100px; margin-left: -80px">Welcome to CENRO-Panabo Document Tracking and Permitting System</h1>
  </div>
    <div class="card col-sm-5 pull-right">
      <div class="card-header"><strong>Recent Activities</strong> </div>
      <div style="margin-left: 10px" class="card-body">
       
          <ul>
            @foreach ($history as $item)
            <div class="row">
              <div class="col-sm-8 pull-left">
                <li><strong>{{ $item->name }}</strong> recently updated Transaction {{ $item->tran_id }}.
                  <p style="font-size: 10px; color: rgb(9, 136, 119)">{{ $item->updated_at->diffForHumans() }}</p>
                </li>
              </div>
              <div class="col-4">
                <a class="btn btn-outline-success pull-right" href="{{ url('CDSshow_transactions/'.$item->tran_id)}}">See Details</a>
              </div>
            </div>
          <br>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="card col-6 pull-left">
      <div class="card-header"><strong>Transactions Stats</strong></div>
      <div class="card-body">
        <div id="chartContainer" style="height: 370px; width: 100%; margin-top: 20px"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
      </div>
    </div>
   
</div>
<script type="text/javascript">
  const deg = 6;
  const hr = document.querySelector('#hr');
  const mn = document.querySelector('#mn');
  const sc = document.querySelector('#sc');

  setInterval(() => {
    let day = new Date();
    let hh = day.getHours() * 30;
    let mm = day.getMinutes() * deg;
    let ss = day.getSeconds() * deg;

    hr.style.transform = `rotateZ(${(hh)+(mm/12)}deg)`;
    mn.style.transform = `rotateZ(${mm}deg)`;
    sc.style.transform = `rotateZ(${ss}deg)`;
  })
  var d = new Date();
  
  var weekday = new Array(7);
  weekday[0] = "Sunday";
  weekday[1] = "Monday";
  weekday[2] = "Tuesday";
  weekday[3] = "Wednesday";
  weekday[4] = "Thursday";
  weekday[5] = "Friday";
  weekday[6] = "Saturday";
  var n = weekday[d.getDay()];
  
  var dd = String(d.getDate()).padStart(2, '0');
  var mm = String(d.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = d.getFullYear();
  d = mm + '/' + dd + '/' + yyyy;
  document.getElementById("day").innerHTML = n + ' ' + '<br><br><br>' + d;

</script>

<script>
  window.onload = function () {
   
  var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    exportEnabled: true,
    title:{
      text: "Status Average of Transaction in System"
    },
    subtitles: [{
      text: "All time Transactions"
    }],
    data: [{
      type: "pie",
      showInLegend: "true",
      legendText: "{label}",
      indexLabelFontSize: 16,
      indexLabel: "{label} - #percent%",
      yValueFormatString: "฿#,##0",
      dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
    }]
  });
  chart.render();
   
  }
</script>
<footer class="c-footer">
  <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
  <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
</footer>
@endsection