<?php

/*
# =============================================================
# Plotly Live Graph
# =============================================================
# create date:2019/11/19     writen By Tanzila Islam
# modify date:
# =============================================================
*/

$tmp = array();
$dt = array();

// read csv file 
$csvFile = file('data.csv');
// keep csv data in an array
$data = [];
foreach ($csvFile as $line) {
        $data[] = str_getcsv($line);
}
foreach ($data as $key => $value) {
// Returns date formatted according to given format
  // $date = new DateTime($value[0]);
  // $time = new DateTime($value[1]);
  // $datetime = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));
  // $datetime = $datetime->format('Y-m-d H:i:s');
  // // converting an English textual date-time description to a UNIX timestamp
  // $datetime = strtotime($datetime);
  // $datetime =  $datetime. 000;
  $datetime = $value[1];
  $temperature = $value[27]/1000;
  $tmp[] =  $temperature;
  $dt[] =  $datetime;
}
// return a json encoded string
$jsondt = json_encode($dt);
$jsonTmp = json_encode($tmp);

//print_a($jsonTmp);
//print_a($jsondt);

function print_a($array){
  echo "<div style='text-align:left;'>";
    echo "<pre>";
      print_r($array);
    echo "</pre>";
  echo "</div>";
}

?>

<html>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <script src="plotly.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
   <!--  <div class="navbar"><span>Real-Time Chart with Plotly.js</span></div> -->
    <div class="wrapper">

        <div id="chart" style="width: 50%; height: 500px; margin: 0 auto;"></div>
        <script>

            function getData() {
               // var time = new Date();
                var jsondata = {
                x: <?php echo $jsondt; ?>,
                // x: [time],
                y: <?php echo $jsonTmp; ?>,
                type: 'line+markers', 
            };

            var data = [jsondata];
            return data;
            }

            var layout = {
              title: {
                text:'Display CPU Temperature',
                font: {
                  family: 'Courier New, monospace',
                  size: 24
                },
                xref: 'paper',
                x: 0.05,
              },
              xaxis: {
                title: {
                  text: 'Time',
                  font: {
                    family: 'Courier New, monospace',
                    size: 18,
                    color: '#7f7f7f'
                  }
                },
              },
              yaxis: {
                title: {
                  text: 'Temperature',
                  font: {
                    family: 'Courier New, monospace',
                    size: 18,
                    color: '#7f7f7f'
                  }
                }
              }
            };
            Plotly.newPlot('chart', getData(), layout);


          //   var cnt = 0;

          //   var interval = setInterval(function() {

          //   var time = new Date();

          //   var update = {
          //   x:  [[time]],
          //   y: <?php //echo $jsonTmp; ?>
          //   }

          //   var olderTime = time.setMinutes(time.getMinutes() - 1);
          //   var futureTime = time.setMinutes(time.getMinutes() + 1);

          //   var minuteView = {
          //         xaxis: {
          //           type: 'date',
          //           range: [olderTime,futureTime]
          //         }
          //       };

          //   Plotly.relayout('graph', minuteView);
          //   Plotly.extendTraces('graph', update, [0])

          //   if(++cnt === 100) clearInterval(interval);
          // }, 1000);
            //alert(getData());
            // function getData() {
            //     return Math.random();
            // }  
            // Plotly.plot('chart',[{
            //     y:[getData()],
            //     type:'line'
            // }]);
            
            // var cnt = 0;

            // setInterval(function(){

            //     Plotly.extendTraces('chart',{ y:[[getData()]]}, [0]);
            //     cnt++;
            //     if(cnt > 500) {
            //         Plotly.relayout('chart',{
            //             xaxis: {
            //                 range: [cnt-500,cnt]
            //             }
            //         });
            //     }
            // },15);
        </script>

  
    </div>
    </body>
</html>
