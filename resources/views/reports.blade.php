<?php
 
$dataPoints1 = array(
	array("label"=> "Jan", "y"=> 4),
	array("label"=> "Feb", "y"=> 7),
	array("label"=> "Mar", "y"=> 0),
	array("label"=> "Apr", "y"=> 0),
	array("label"=> "May", "y"=> 0),
	array("label"=> "Jun", "y"=> 0),
	array("label"=> "Jul", "y"=> 0),
  array("label"=> "Aug", "y"=> 0),
  array("label"=> "Sep", "y"=> 0),
  array("label"=> "Oct", "y"=> 0),
  array("label"=> "Nov", "y"=> 0),
  array("label"=> "Dec", "y"=> 0)
);
$dataPoints2 = array(
	array("label"=> "Jan", "y"=> 4),
	array("label"=> "Feb", "y"=> 3),
	array("label"=> "Mar", "y"=> 0),
	array("label"=> "Apr", "y"=> 0),
	array("label"=> "May", "y"=> 0),
	array("label"=> "Jun", "y"=> 0),
	array("label"=> "Jul", "y"=> 0),
  array("label"=> "Aug", "y"=> 0),
  array("label"=> "Sep", "y"=> 0),
  array("label"=> "Oct", "y"=> 0),
  array("label"=> "Nov", "y"=> 0),
  array("label"=> "Dec", "y"=> 0)
);
$dataPoints3 = array(
	array("label"=> "Jan", "y"=> 2),
	array("label"=> "Feb", "y"=> 1),
	array("label"=> "Mar", "y"=> 0),
	array("label"=> "Apr", "y"=> 0),
	array("label"=> "May", "y"=> 0),
	array("label"=> "Jun", "y"=> 0),
	array("label"=> "Jul", "y"=> 0),
  array("label"=> "Aug", "y"=> 0),
  array("label"=> "Sep", "y"=> 0),
  array("label"=> "Oct", "y"=> 0),
  array("label"=> "Nov", "y"=> 0),
  array("label"=> "Dec", "y"=> 0)
);
	
?>
@extends('layouts.app')

<script>
  window.onload = function () {
   
  var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    title:{
      text: "Comparison Between Pending, Approved, and Rejected Transactions in Monthly Basis"
    },
    axisY:{
      includeZero: true
    },
    legend:{
      cursor: "pointer",
      verticalAlign: "center",
      horizontalAlign: "right",
      itemclick: toggleDataSeries
    },
    data: [{
      type: "column",
      name: "Pending",
      indexLabel: "{y}",
      yValueFormatString: "#0",
      showInLegend: true,
      dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
    },{
      type: "column",
      name: "Approved",
      indexLabel: "{y}",
      yValueFormatString: "#0",
      showInLegend: true,
      dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
    },
    {
      type: "column",
      name: "Rejected",
      indexLabel: "{y}",
      yValueFormatString: "#0",
      showInLegend: true,
      dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
    }]
  });
  chart.render();
   
  function toggleDataSeries(e){
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
      e.dataSeries.visible = false;
    }
    else{
      e.dataSeries.visible = true;
    }
    chart.render();
  }
   
  }
</script>
@section('content')

<div style="text-align: center" id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@endsection