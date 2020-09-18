<?php
session_start();
if(!isset($_SESSION["loggedin"])){
    header("Location: index.php");
    exit();    
}
?>
<!doctype html>
<html lang="en">
  
<?php include_once("common-head.php");?>
<body>
<?php include_once("nav.php");?>
    <main role="main" class="container-fluid" id="page-container">
      <div class="container-fluid">
		<div class="row justify-content-center">
        <h4 id="show_data"></h4>
            <div class="col-sm-6">
            <form action="" id="upload_req" onsubmit="return false;">
            <div class="row justify-content-center">
            <div class="col-sm-6 form-group">
            <label for="starts">Start Date:</label>
            <input type="text" name="starts" class="form-control" id="example1">
            </div>
            <div class="col-sm-6 form-group">
            <label for="ends">End Date:</label>
            <input type="text" name="ends" class="form-control" id="example2">
            </div>          
            <div class="col-sm-6 form-group">
            <input type="submit" class="btn btn-dark col-sm-12 form-control" value="Submit">
            </div>
            </div>
            
                <!-- <input type="text" name="ends">
                <input type="text" class="form-control" id="example"> -->
            </form>

		    </div>

	  
	    	</div>
        
   
          </div>
        <div class="container-fluid">
            <div class="row justify-content-center" id="res">        
                <div class="col-sm-12">
                <div id="card">
                <span id="ideal_toggle" data-toggle="tooltip" title="Range 0.45 to 1.25 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#20b2aa"></i> Ideal Range</span>
                <span id="optimal_toggle" data-toggle="tooltip" title="Range 0.53 to 1.10 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#00ff00"></i> Optimal Range(Present Study)</span>
                <span id="optimal_l_toggle" data-toggle="tooltip" title="Range 0.8 to 0.95 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#808000"></i> Optimal Range</span>
                <!-- <span id="reset_toggle">Ideal Range</span> -->
                <!-- <h4> Comparing Outside VPD With Arellano's Equation </h4> -->
                <div id="chartContainer" style="height: 70vh; width: 100%;"></div>
                </div>
                </div>                
                <div class="col-sm-12">
                <div id="card">
                <span id="ideal_toggle1" data-toggle="tooltip" title="Range 0.45 to 1.25 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#20b2aa"></i> Ideal Range</span>
                <span id="optimal_toggle1" data-toggle="tooltip" title="Range 0.53 to 1.10 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#00ff00"></i> Optimal Range(Present Study)</span>
                <span id="optimal_l_toggle1" data-toggle="tooltip" title="Range 0.8 to 0.95 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#808000"></i> Optimal Range</span>
                <!-- <h4> Comparing Outside VPD With Arellano's Equation </h4> -->
                <div id="chartContainer1" style="height: 70vh; width: 100%;"></div>
                </div>
                </div>                
                <div class="col-sm-6">
                <div id="card">
                <span id="ideal_toggle2" data-toggle="tooltip" title="Range 0.45 to 1.25 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#20b2aa"></i> Ideal Range</span>
                <span id="optimal_toggle2" data-toggle="tooltip" title="Range 0.53 to 1.10 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#00ff00"></i> Optimal Range(Present Study)</span>
                <span id="optimal_l_toggle2" data-toggle="tooltip" title="Range 0.8 to 0.95 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#808000"></i> Optimal Range</span>
                <!-- <h4> Comparing Outside VPD With Arellano's Equation </h4> -->
                <div id="chartContainer2" style="height: 70vh; width: 100%;"></div>
                </div>
                </div> 
                <div class="col-sm-6">
                <div id="card">
                <span id="ideal_toggle3" data-toggle="tooltip" title="Range 0.45 to 1.25 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#20b2aa"></i> Ideal Range</span>
                <span id="optimal_toggle3" data-toggle="tooltip" title="Range 0.53 to 1.10 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#00ff00"></i> Optimal Range(Present Study)</span>
                <span id="optimal_l_toggle3" data-toggle="tooltip" title="Range 0.8 to 0.95 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#808000"></i> Optimal Range</span>
                <!-- <h4> Comparing Outside VPD With Arellano's Equation </h4> -->
                <div id="chartContainer3" style="height: 70vh; width: 100%;"></div>
                </div>
                </div>
                <div class="col-sm-12">
                <div id="card">
                <span id="ideal_toggle4" data-toggle="tooltip" title="Range 0.45 to 1.25 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#20b2aa"></i> Ideal Range</span>
                <span id="optimal_toggle4" data-toggle="tooltip" title="Range 0.53 to 1.10 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#00ff00"></i> Optimal Range(Present Study)</span>
                <span id="optimal_l_toggle4" data-toggle="tooltip" title="Range 0.8 to 0.95 kPa"><i class="fa fa-square" aria-hidden="true" style="color:#808000"></i> Optimal Range</span>
                <!-- <h4> Comparing Outside VPD With Arellano's Equation </h4> -->
                <div id="chartContainer4" style="height: 70vh; width: 100%;"></div>
                </div>
                </div> 
                
                </div>
                

             

        </div>

        </div>
        </div>


    </main><!-- /.container -->
        

    <?php
    include_once("footer.php");    
    include_once("common-js.php");
    ?>
    <script>
	$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    $("#res").hide();
    var min_date,max_date;
        $.ajax({
            url:'get_res.php',
            type:'GET',
            dataType:'json',
            success:function(res){

                $("#show_data").html("Data is Available from: " + res.minDate + " to " + res.maxDate);
                min_date = res.minDate;
                max_date = res.maxDate;
                console.log(min_date);
                $('#example1').datetimepicker({
                    format:'YYYY/MM/DD HH:mm:ss',
                    sideBySide:true,
                    minDate:min_date,
                    maxDate:max_date            
                });
                $('#example2').datetimepicker({
                    format:'YYYY/MM/DD HH:mm:ss',
                    sideBySide:true,
                    minDate:min_date,
                    maxDate:max_date,
                });
            }
        });

 		$("#upload_req").submit(function(){
            $.ajax({
                url:"get_res.php",
                type:"POST",
                data:$(this).serialize(),
                success:function(res){
                    $("#res").show();
                    var time = [];
                    var dateTime = [];
                    var date = [];
                    var inside_vpd = [];
                    var arellano_inside_vpd = [];
                    var outside_vpd = [];
                    var arellano_outside_vpd = [];
                    for(var i = 0; i < res.length; i++){
                        if(res[i].Date == "0"){
                            time[i] = res[i].Date1;
                            // console.log("Fired...");
                        }
                        else{
                            time[i] = res[i].Date + ":00";
                        }
                        dateTime[i] = res[i].Date2;
                        date[i] = res[i].Date1;
                        var sat_vap_pressure = 0.7392 * Math.exp(0.06264 * res[i].Tapc * (Math.exp(-0.0019 * res[i].Date)));
                        var actual_vap_pressure = 0.8427 * (res[i].Eapc) / 100 * Math.exp(0.06264 * res[i].Tapc * Math.exp(-0.0019 * res[i].Date) - 0.00021 * res[i].Date);
                         inside_vpd[i] = sat_vap_pressure - actual_vap_pressure;
                         inside_vpd[i] = inside_vpd[i].toFixed(2);
                        // inside_temp[i] = res[i].Tapc;
                        // inside_hum = res[i].Eapc;
                        // outside_temp = res[i].Taos;
                        outside_vpd[i] = 0.7392 * ( 1 - res[i].Eaos/100 ) * Math.exp(0.058 * res[i].Taos);
                        outside_vpd[i] = outside_vpd[i].toFixed(2);
                        arellano_inside_vpd[i] = 0.61078 * Math.exp((17.269* parseFloat(res[i].Tapc) ) / (273.3 + parseFloat(res[i].Tapc)) ) * ( 1 - parseFloat(res[i].Eapc) /100);
                        arellano_inside_vpd[i] = arellano_inside_vpd[i].toFixed(2);
                        // arellano_inside_vpd[i] = 0.61078 * Math.exp((17.269 * res[i].Tapc) / (res[i].Tapc + 237.3)) * (1 -res[i].Eapc / 100);
                        arellano_outside_vpd[i] = 0.61078 * Math.exp((17.269* parseFloat(res[i].Tapc) ) / (273.3 + parseFloat(res[i].Tapc)) ) * ( 1 - parseFloat(res[i].Eapc) /100);
                        arellano_outside_vpd[i] = arellano_outside_vpd[i].toFixed(2);
                    }
                    // console.log(time);
                    // console.log(arellano_inside_vpd);
                    // console.log(arellano_outside_vpd);
                    var insideVsOutside = [];
                    var insideVsInside_1 = [];
                    var outsideVsOutside_1 = [];
                    for(var i = 0; i < inside_vpd.length; i++){
                        insideVsOutside[i] = outside_vpd[i] - inside_vpd[i];
                        insideVsOutside[i] = Math.abs(insideVsOutside[i].toFixed(2));
                    }
                    for(var i = 0; i < inside_vpd.length; i++){
                        insideVsInside_1[i] = inside_vpd[i] - arellano_inside_vpd[i];
                        insideVsInside_1[i] = Math.abs(insideVsInside_1[i].toFixed(2));
                    }
                    for(var i = 0; i < inside_vpd.length; i++){
                        outsideVsOutside_1[i] = outside_vpd[i] - arellano_outside_vpd[i];
                        outsideVsOutside_1[i] = Math.abs(outsideVsOutside_1[i].toFixed(2));
                    }
                    var insideColors = [];
                    var outsideColors = [];
                    var otherColors = [];
                    var otherColors2 = [];
                    var gridColors = [];
                    var insideRadius = [];
                    $.each(inside_vpd, function( index,value ) {
                        if(value < 0.53 || value > 1.10){
                            insideColors[index]="";
                            insideRadius[index] = 2;
                        }else{
                            insideColors[index] ="rgb(255,166,0)";
                            insideRadius[index] = 6;
                        }
                        });
                        $.each(outside_vpd, function( index,value ) {
                        if(value < 0.53 || value > 1.10){
                            outsideColors[index]="";
                        }else{
                            outsideColors[index]="rgb(5,125,27)";
                        }
                        });
                        $.each(arellano_inside_vpd, function( index,value ) {
                        if(value < 0.53 || value > 1.10){
                            otherColors[index]="";
                        }else{
                            otherColors[index]="rgb(0,63,92)";
                        }
                        });
                        $.each(arellano_outside_vpd, function( index,value ) {
                        if(value < 0.53 || value > 1.10){
                            otherColors2[index]="";
                        }else{
                            otherColors2[index]="rgb(0,63,92)";
                        }
                        });
            var x = time;
            // var time = time.map(i => parseFloat(i));
             inside_vpd = inside_vpd.map(i => parseFloat(i));
             outside_vpd = outside_vpd.map(i => parseFloat(i));
             arellano_inside_vpd = arellano_inside_vpd.map(i => parseFloat(i));
             arellano_outside_vpd = arellano_outside_vpd.map(i => parseFloat(i));
            console.log(outside_vpd);
            var dataPointsInside = [];
            var dataPointsOutside = [];
            var dataPointsAInside = [];
            var dataPointsAOutside = [];
            console.log(Math.max(...inside_vpd));
            for (var i = 0; i < inside_vpd.length; i++) {
                    dataPointsInside.push({
                    label: dateTime[i],
                    x: new Date(dateTime[i]),
                    y: inside_vpd[i]
                });
                

            }
            for (var i = 0; i < outside_vpd.length; i++) {
            dataPointsOutside.push({
                label: dateTime[i],
                x : new Date(dateTime[i]),
                y: outside_vpd[i]
            });
            }
            for (var i = 0; i < arellano_inside_vpd.length; i++) {
            dataPointsAInside.push({
                label: dateTime[i],
                x : new Date(dateTime[i]),
                y: arellano_inside_vpd[i]
            });
            }
            for (var i = 0; i < arellano_outside_vpd.length; i++) {
            dataPointsAOutside.push({
                label: dateTime[i],
                x : new Date(dateTime[i]),
                y: arellano_outside_vpd[i]
            });
            }
            // console.log(dataPoints1);
            // console.log(dataPoints);
        //Inside Vs Arellano VPD CHart
        var chart = new CanvasJS.Chart("chartContainer", {
		title:{
			text: "VPD vs VPD1" ,
            fontFamily:"times new roman",             
        },
        zoomEnabled: true,
        legend: {
        fontFamily:"times new roman",
        dockInsidePlotArea: true,
        horizontalAlign: "center", // "center" , "right"
        verticalAlign: "top",  // "top" , "bottom"
        fontSize: 15,
        itemclick:toggleDataSeries,
        cursor: "pointer"
        },
        toolTip: {
        shared:true,
        content: "{name} at {label} : {y}"
       },
        axisX: {
            title:"Time (hours)",
            titleFontFamily:"times new roman",
            intervalType: "hour",
            labelMaxWidth: 100, // change label width accordingly
            // interlacedColor:"grey"
            labelFormatter: function (e) {
				return CanvasJS.formatDate( e.value, "DD MMM YYYY");
			},
            labelAngle: 0,
        },
        axisY:{
            title:"VPD (kPa)",
            titleFontFamily:"times new roman",
            gridThickness:0,
            stripLines:[
                {
                click:function(e){
                    alert("CLicked");
                },
                startValue:0.45,
                endValue:1.25,                
                color:"#20B2AA",
                // label : "Ideal Range",
                // labelFontColor: "#20B2AA",
                // opacity:0.5, 
                labelAlign:"near",
                labelPlacement:"inside",
                labelFontWeight:"bold",
                // showOnTop:true,

            },
                {
                startValue:0.53,
                endValue:1.10,                
                color:"#00FF00",
                // label : "Optimal Range (Present Study)",
                // labelFontColor: "#00FF00",
                labelPlacement:"inside",
                labelAlign:"center",
                // opacity:0.5,
                labelFontWeight:"bold",
                // showOnTop:true,

            },


            {
                startValue:0.8,
                endValue:0.95,                
                color:"#808000",
                // label : "Optimal Range",
                // labelFontColor: "#808000",
                // opacity:0.5, 
                labelAlign:"far",
                labelPlacement:"inside",
                labelFontWeight:"bold",
                // showOnTop:true,
            },
            
            ],
        
        // interlacedColor:"#F8F1E4"
        },
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
            name:"VPD",
            type: "line",
            showInLegend: true,
            legendText: "VPD",
			dataPoints: dataPointsInside,
        },
        {
            name:"VPD1",
            type: "line",
            showInLegend: true,
            legendText: "VPD1",
            dataPoints: dataPointsAInside,
        }
		],
        exportEnabled:true,
	});


        //Outside vs Arellano VPD CHart
        var chart1 = new CanvasJS.Chart("chartContainer1", {
		title:{
			text: "VPD' vs VPD1",
            fontFamily:"times new roman",              
        },
        zoomEnabled: true,
        legend: {
        fontFamily:"times new roman",
        dockInsidePlotArea: true,
        horizontalAlign: "center", // "center" , "right"
        verticalAlign: "top",  // "top" , "bottom"
        fontSize: 15,
        itemclick:toggleDataSeries,
        cursor: "pointer"
        },
        toolTip: {
        shared:true,
        fontFamily:"sans-serif",
        content: "{name} at {label} : {y}"
       },
        axisX: {
            title:"Time (hour)",
            titleFontFamily:"times new roman",
            intervalType: "hour",
            valueFormatString: "YYYY-MM-DD HH:mm:ss",
            labelMaxWidth: 100, // change label width accordingly
            // interlacedColor:"grey"
            labelFormatter: function (e) {
				return CanvasJS.formatDate( e.value, "DD MMM YYYY");
			},
            labelAngle: 0,
        },
        axisY:{
            title:"VPD (kPa)",
            titleFontFamily:"times new roman",
            gridThickness:0,
            stripLines:[      {
                startValue:0.45,
                endValue:1.25,                
                color:"#20B2AA",
                // label : "Ideal Range",
                // labelFontColor: "#20B2AA",
                // opacity:0.5, 
                labelAlign:"near",
                labelPlacement:"inside",
                labelFontWeight:"bold",
                // showOnTop:true,

            },
                {
                startValue:0.53,
                endValue:1.10,                
                color:"#00FF00",
                // label : "Optimal Range (Present Study)",
                // labelFontColor: "#00FF00",
                labelPlacement:"inside",
                labelAlign:"center",
                // opacity:0.5,
                labelFontWeight:"bold",
                // showOnTop:true,

            },


            {
                startValue:0.8,
                endValue:0.95,                
                color:"#808000",
                // label : "Optimal Range",
                // labelFontColor: "#808000",
                // opacity:0.5, 
                labelAlign:"far",
                labelPlacement:"inside",
                labelFontWeight:"bold",
                // showOnTop:true,
            },
          
        ],
        // interlacedColor:"#F8F1E4"
        },
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
            name:"VPD'",
            type: "line",
            showInLegend: true,
            legendText: "VPD'",
			dataPoints: dataPointsOutside,
        },
        {
            name:"VPD",
            type: "line",
            showInLegend: true,
            legendText: "VPD",
            dataPoints: dataPointsAInside,
        }
		],
        exportEnabled:true,
    	});
        //Inside VPD CHart
        var chart2 = new CanvasJS.Chart("chartContainer2", {
		title:{
			text: "VPD",
			fontFamily:"times new roman",
        },
        zoomEnabled: true,
        legend: {
        fontFamily:"times new roman",
        dockInsidePlotArea: true,
        horizontalAlign: "center", // "center" , "right"
        verticalAlign: "top",  // "top" , "bottom"
        fontSize: 15,
        itemclick:toggleDataSeries,
        cursor: "pointer"
        },
        toolTip: {
        shared:true,
        content: "{name} at {label} : {y}"
       },
        axisX: {
            title:"Time (hour)",
            titleFontFamily:"times new roman",
            intervalType: "hour",
            valueFormatString: "YYYY-MM-DD HH:mm:ss",
            labelMaxWidth: 100, // change label width accordingly
            // interlacedColor:"grey"
            labelFormatter: function (e) {
				return CanvasJS.formatDate( e.value, "DD MMM YYYY");
			},
            labelAngle: 0,
        },
        axisY:{
            title:"VPD (kPa)",
            gridThickness:0,
            titleFontFamily:"times new roman",
            stripLines:[      {
                startValue:0.45,
                endValue:1.25,                
                color:"#20B2AA",
                // label : "Ideal Range",
                // labelFontColor: "#20B2AA",
                // opacity:0.5, 
                labelAlign:"near",
                labelPlacement:"inside",
                labelFontWeight:"bold",
                // showOnTop:true,

            },
                {
                startValue:0.53,
                endValue:1.10,                
                color:"#00FF00",
                // label : "Optimal Range (Present Study)",
                // labelFontColor: "#00FF00",
                labelPlacement:"inside",
                labelAlign:"center",
                // opacity:0.5,
                labelFontWeight:"bold",
                // showOnTop:true,

            },


            {
                startValue:0.8,
                endValue:0.95,                
                color:"#808000",
                // label : "Optimal Range",
                // labelFontColor: "#808000",
                // opacity:0.5, 
                labelAlign:"far",
                labelPlacement:"inside",
                labelFontWeight:"bold",
                // showOnTop:true,
            },
          
        ],
        // interlacedColor:"#F8F1E4"
        },
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
            name:"VPD",
            type: "line",
            showInLegend: true,
            legendText: "VPD",
			dataPoints: dataPointsInside,
        },
		],
        exportEnabled:true,
	});
            //Outside VPD CHart
        var chart3 = new CanvasJS.Chart("chartContainer3", {
		title:{
			text: "VPD'",
			fontFamily:"times new roman",
        },
        zoomEnabled: true,
        legend: {
        fontFamily:"times new roman",
        dockInsidePlotArea: true,
        horizontalAlign: "center", // "center" , "right"
        verticalAlign: "top",  // "top" , "bottom"
        fontSize: 15,
        itemclick:toggleDataSeries,
        cursor: "pointer"
        },
        toolTip: {
        shared:true,
        content: "{name} at {label} : {y}"
       },
        axisX: {
            title:"Time (hour)",
            titleFontFamily:"times new roman",
            intervalType: "hour",
            valueFormatString: "YYYY-MM-DD HH:mm:ss",
            labelMaxWidth: 100, // change label width accordingly
            // interlacedColor:"grey"
            labelFormatter: function (e) {
				return CanvasJS.formatDate( e.value, "DD MMM YYYY");
			},
            labelAngle: 0,
        },
        axisY:{
            title:"VPD (kPd)",
            titleFontFamily:"times new roman",
            gridThickness:0,
            stripLines:[      {
                startValue:0.45,
                endValue:1.25,                
                color:"#20B2AA",
                // label : "Ideal Range",
                // labelFontColor: "#20B2AA",
                // opacity:0.5, 
                labelAlign:"near",
                labelPlacement:"inside",
                labelFontWeight:"bold",
                // showOnTop:true,

            },
                {
                startValue:0.53,
                endValue:1.10,                
                color:"#00FF00",
                // label : "Optimal Range (Present Study)",
                // labelFontColor: "#00FF00",
                labelPlacement:"inside",
                labelAlign:"center",
                // opacity:0.5,
                labelFontWeight:"bold",
                // showOnTop:true,

            },


            {
                startValue:0.8,
                endValue:0.95,                
                color:"#808000",
                // label : "Optimal Range",
                // labelFontColor: "#808000",
                // opacity:0.5, 
                labelAlign:"far",
                labelPlacement:"inside",
                labelFontWeight:"bold",
                // showOnTop:true,
            },
          
        ],
        // interlacedColor:"#F8F1E4"
        },
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
            name:"VPD'",
            type: "line",
            showInLegend: true,
            legendText: "VPD'",
			dataPoints: dataPointsOutside,
        },
		],
        exportEnabled:true,
	});
    //Inside VPD vs Outside VPD

        var chart4 = new CanvasJS.Chart("chartContainer4", {
		title:{
			text: "VPD vs VPD'",
			fontFamily:"times new roman",
        },
        zoomEnabled: true,
        legend: {
        fontFamily:"times new roman",
        dockInsidePlotArea: true,
        horizontalAlign: "center", // "center" , "right"
        verticalAlign: "top",  // "top" , "bottom"
        fontSize: 15,
        itemclick:toggleDataSeries,
        cursor: "pointer"
        },
        toolTip: {
        shared:true,
        content: "{name} at {label} : {y}"
       },
        axisX: {
            title:"Time (hour)",
            titleFontFamily:"times new roman",
            intervalType: "hour",
            valueFormatString: "YYYY-MM-DD HH:mm:ss",
            labelMaxWidth: 100, // change label width accordingly
            // interlacedColor:"grey"
            labelFormatter: function (e) {
				return CanvasJS.formatDate( e.value, "DD MMM YYYY");
			},
            labelAngle: 0,
        },
        axisY:{
            title:"VPD (kPa)",
            titleFontFamily:"times new roman",
            gridThickness:0,
            stripLines:[      {
                startValue:0.45,
                endValue:1.25,                
                color:"#20B2AA",
                // label : "Ideal Range",
                // labelFontColor: "#20B2AA",
                // opacity:0.5, 
                labelAlign:"near",
                labelPlacement:"inside",
                labelFontWeight:"bold",
                // showOnTop:true,

            },
                {
                startValue:0.53,
                endValue:1.10,                
                color:"#00FF00",
                // label : "Optimal Range (Present Study)",
                // labelFontColor: "#00FF00",
                labelPlacement:"inside",
                labelAlign:"center",
                // opacity:0.5,
                labelFontWeight:"bold",
                // showOnTop:true,

            },


            {
                startValue:0.8,
                endValue:0.95,                
                color:"#808000",
                // label : "Optimal Range",
                // labelFontColor: "#808000",
                // opacity:0.5, 
                labelAlign:"far",
                labelPlacement:"inside",
                labelFontWeight:"bold",
                // showOnTop:true,
            },
          
        ],
        // interlacedColor:"#F8F1E4"
        },
		data: [              
		{
			// Change type to "doughnut", "line", "splineArea", etc.
            name:"VPD",
            type: "line",
            showInLegend: true,
            legendText: "VPD",
			dataPoints: dataPointsInside,
        },
        {
            name:"VPD'",
            type: "line",
            showInLegend: true,
            legendText: "VPD'",
            dataPoints: dataPointsOutside,
        }
		],
        exportEnabled:true,
	});
    chart.render();
    chart1.render();
    chart2.render();
    chart3.render();
    chart4.render();
    function toggleDataSeries(e) {
        if(typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
        }
        else {
            e.dataSeries.visible = true;
        }
        chart.render();
        chart1.render();
    }
    jQuery.fn.clickToggle = function(a, b) {
    return this.on("click", function(ev) { [b, a][this.$_io ^= 1].call(this, ev) })
    };
    //For Chart Toggle between Spine Lines
    $("#ideal_toggle").clickToggle(function(ev){
        chart.axisY[0].stripLines[0].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart.axisY[0].stripLines[0].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    $("#optimal_toggle").clickToggle(function(ev){
        chart.axisY[0].stripLines[1].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart.axisY[0].stripLines[1].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    $("#optimal_l_toggle").clickToggle(function(ev){
        chart.axisY[0].stripLines[2].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart.axisY[0].stripLines[2].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    //For Chart1 Toggle between Spine Lines
    $("#ideal_toggle1").clickToggle(function(ev){
        chart1.axisY[0].stripLines[0].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart1.axisY[0].stripLines[0].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    $("#optimal_toggle1").clickToggle(function(ev){
        chart1.axisY[0].stripLines[1].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart1.axisY[0].stripLines[1].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    $("#optimal_l_toggle1").clickToggle(function(ev){
        chart1.axisY[0].stripLines[2].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart1.axisY[0].stripLines[2].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
        //For Chart2 Toggle between Spine Lines
        $("#ideal_toggle2").clickToggle(function(ev){
        chart2.axisY[0].stripLines[0].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart2.axisY[0].stripLines[0].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    $("#optimal_toggle2").clickToggle(function(ev){
        chart2.axisY[0].stripLines[1].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart2.axisY[0].stripLines[1].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    $("#optimal_l_toggle2").clickToggle(function(ev){
        chart2.axisY[0].stripLines[2].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart2.axisY[0].stripLines[2].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
        //For Chart3 Toggle between Spine Lines
        $("#ideal_toggle3").clickToggle(function(ev){
        chart3.axisY[0].stripLines[0].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart3.axisY[0].stripLines[0].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    $("#optimal_toggle3").clickToggle(function(ev){
        chart3.axisY[0].stripLines[1].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart3.axisY[0].stripLines[1].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    $("#optimal_l_toggle3").clickToggle(function(ev){
        chart3.axisY[0].stripLines[2].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart3.axisY[0].stripLines[2].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    //For Chart4 Toggle between Spine Lines
    $("#ideal_toggle4").clickToggle(function(ev){
        chart4.axisY[0].stripLines[0].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart4.axisY[0].stripLines[0].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    $("#optimal_toggle4").clickToggle(function(ev){
        chart4.axisY[0].stripLines[1].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart4.axisY[0].stripLines[1].set("opacity",1);  
        $(this).css("text-decoration","none");

    });
    $("#optimal_l_toggle4").clickToggle(function(ev){
        chart4.axisY[0].stripLines[2].set("opacity",0);
        $(this).css("text-decoration","line-through");
    },
    function(ev){
        chart4.axisY[0].stripLines[2].set("opacity",1);  
        $(this).css("text-decoration","none");

    });



                }
            })
        })
	})
	
	
	
	
	
	
    </script>
        <script>
            
            </script>
  </body>
</html>
