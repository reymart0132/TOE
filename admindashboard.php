<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/toe/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
isAdmin($user->data()->groups); 
$viewtable = new viewtable();

if(!empty($_GET['date1']) && !empty($_GET['date2'])){

    $capplicant = getTotalApplicant($_GET['date1'], $_GET['date2']);
    $dates[] = "";
    $count[] = "";
    foreach ($capplicant as $data) {
        $dates[] = $data["dit"];
        $count[] = $data["tots"];
    }
    $count = substr(implode("','", $count), 1) . "'";
    $date = substr(implode("','", $dates), 1) . "'";

    $incorrect = getIncorrect($_GET['date1'], $_GET['date2']);
    $item[] = "";
    $itemcount[] ="";
    
    foreach ($incorrect as $data1) {
        $item[] = "question-".$data1["question_id"];
        $itemcount[] = $data1["count"];
    }
    $item = "'" . implode("','", $item) . "'";
    $itemcount = "'" . implode("','", $itemcount) . "'";
    
    $correct = getCorrect($_GET['date1'], $_GET['date2']);
    $item2[] = "";
    $itemcount2[] ="";

    foreach ($correct as $data3) {
        $item2[] = "question-".$data3["question_id"];
        $itemcount2[] = $data3["count"];
    }


    $item2 = "'".implode("','", $item2). "'";
    $itemcount2 = "'".implode("','", $itemcount2). "'";

    $towns = getTown($_GET['date1'], $_GET['date2']);
    $town[] = "";
    $towncount[] = "";
    foreach ($towns as $data2) {
        $town[] = $data2["town"];
        $towncount[] = $data2["count"];
    }

    $town = "'".implode("','", $town). "'";
    $towncount = "'".implode("','", $towncount). "'";

    $genderData = getGender($_GET['date1'], $_GET['date2']);
    $gender = [];
    $gendercount = [];

    foreach ($genderData as $data5) {
        $gender[] = $data5["gender"];
        $gendercount[] = $data5["count"];
    }

    $implodedGender = "'" . implode("','", $gender) . "'";
    $implodedGenderCount = "'" . implode("','", $gendercount) . "'";

    $ageData = getAge($_GET['date1'], $_GET['date2']);
    $age = [];
    $ageCount = [];

    foreach ($ageData as $data6) {
        $age[] = $data6["age"];
        $ageCount[] = $data6["count"];
    }

    $implodedAge = "'" . implode("','", $age) . "'";
    $implodedAgeCount = "'" . implode("','", $ageCount) . "'";

}else{

    $capplicant = getTotalApplicant();
    $dates[] = "";
    $count[] = "";
    foreach ($capplicant as $data) {
        $dates[] = $data["dit"];
        $count[] = $data["tots"];
    }
    $count = substr(implode("','", $count), 1) . "'";
    $date = substr(implode("','", $dates), 1) . "'";

    $incorrect = getIncorrect();

    foreach ($incorrect as $data1) {
        $item[] = "question-" . $data1["question_id"];
        $itemcount[] = $data1["count"];
    }
    $item = "'" . implode("','", $item) . "'";
    $itemcount = "'" . implode("','", $itemcount) . "'";

    $correct = getCorrect();

    foreach ($correct as $data3) {
        $item2[] = "question-" . $data3["question_id"];
        $itemcount2[] = $data3["count"];
    }


    $item2 = "'" . implode("','", $item2) . "'";
    $itemcount2 = "'" . implode("','", $itemcount2) . "'";

    $towns = getTown();
    foreach ($towns as $data2) {
        $town[] = $data2["town"];
        $towncount[] = $data2["count"];
    }

    $town = "'" . implode("','", $town) . "'";
    $towncount = "'" . implode("','", $towncount) . "'";

    $genderData = getGender();
    $gender = [];
    $gendercount = [];

    foreach ($genderData as $data5) {
        $gender[] = $data5["gender"];
        $gendercount[] = $data5["count"];
    }

    $implodedGender = "'" . implode("','", $gender) . "'";
    $implodedGenderCount = "'" . implode("','", $gendercount) . "'";

    $ageData = getAge();
    $age = [];
    $ageCount = [];

    foreach ($ageData as $data6) {
        $age[] = $data6["age"];
        $ageCount[] = $data6["count"];
    }

    $implodedAge = "'" . implode("','", $age) . "'";
    $implodedAgeCount = "'" . implode("','", $ageCount) . "'";

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>TESDA Examination Portal</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap.min.css">
  <script src="vendor/js/jquery.js"></script>
  <link href="vendor/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css"  href="resource/css/styles.css">
  <link rel="stylesheet" type="text/css"  href="vendor/css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/css/dataTables.css">
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jquery.dataTables.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/dataTables.buttons.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/jszip.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/pdfmake.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/vfs_fonts.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.html5.min.js"></script>
  <script type="text/javascript" charset="utf8" src="vendor/js/dataTables/buttons.print.min.js"></script>

</head>
<body>

        <?php require_once('menu/adminmenu.php'); ?>
        <form class = "mt-2 p-3 border shadow-sm">
                <h1 class=""> Date Filter </h1>
                <div class="row justify-content-center">
                    <label for="monthPicker">Select Start Month and Year:</label>
                    <input type="month" id="monthPicker1" name="date1" class="form-control col-4 mr-2">
                    <label for="monthPicker">Select Start Month and Year:</label>
                    <input type="month" id="monthPicker2" name="date2" class="form-control col-4">
                    <input type = "submit" class= "btn btn-primary mt-4 col-4">
                </div>
         </form>
        <div class="container-fluid  p-2">
        <div class='row justify-content-center mb-5'>
                <div class="col-4 p-2">
                    <h5 class="text-info"><i class='fa fa-chart-bar '></i>Point Item Analysis(Incorrect Answers)</h5>
                    <canvas id="canvas2"></canvas>
                    <a  href="admintable3.php" class="btn btn-primary custom-btn mt-2"> View Table-Data </a>
                    <hr></hr>
                    <h5 class="text-info"><i class='fa fa-chart-bar '></i>Point Item Analysis (Correct Answers)</h5>
                    <canvas id="canvas4"></canvas>
                    <a  href="admintable4.php" class="btn btn-primary custom-btn mt-2"> View Table-Data </a>
                    <a  href="adminPIAGraph.php" class="btn btn-primary custom-btn mt-2"> View Complex Data Chart for PIA </a>
                </div>
            
                <div class="col-4 card border-muted p-5  mr-3 mt-4">
                    <div class="row">
                        <div class= "col-12">
                                <h5 class="text-info"><i class='fa fa-chart-bar mr-5'></i>Geographical Analysis</h5>
                            <canvas id="canvas3"></canvas>
                            <a  href="admintable2.php" class="btn btn-primary custom-btn mt-2"> View Table-Data </a>
                            <a  href="adminGeoGraph" class="btn btn-primary custom-btn mt-2"> View Complex Data Chart </a>
                        </div>
                        <div class= "col-12 py-5">
                                <h5 class="text-info"><i class='fa fa-chart-bar mr-5'></i>Age Analysis</h5>
                                <canvas id="canvas6"></canvas>
                                <a  href="admintable5.php" class="btn btn-primary custom-btn mt-2"> View Table-Data </a>
                                <a  href="adminAgeGraph.php" class="btn btn-primary custom-btn mt-2"> View Complex Data Chart </a>
                        </div>
                    </div>
                </div>

                <div class="col-3 p-2 mr-1 mb-5" >
                    <h5 class="text-info"><i class='fa fa-chart-bar mr-2'></i>Applicant Volume Per Day</h5>
                    <canvas id="canvas"></canvas>
                    <a  href="admintable1.php" class="btn btn-primary custom-btn mt-2"> View Table-Data </a>
                    <hr></hr>
                    <div class="row justify-content-center">
                        <div class= "col-9">
                            <h5 class="text-info"><i class='fa fa-chart-bar mr-5'></i>Gender Analysis</h5>
                            <canvas id="canvas5"></canvas>
                            <a  href="admintable6.php" class="btn btn-primary custom-btn mt-2"> View Table-Data </a>
                            <a  href="admingendergraph" class="btn btn-primary custom-btn mt-2"> View Complex Data Chart </a>
                        </div>
                       
                    </div>
                </div>
        </div>
         
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="vendor/js/bootstrap.min.js"></script>
<script src="vendor/js/bootstrap-select.min.js"></script>
    <script>
    $(document).ready(function(){
      window.$('#examTable').DataTable({
        });
    });
    

     $(document).ready(function(){
      window.$('#examTable2').DataTable({
        dom: 'frtipB',
        buttons: [
            {
                extend: 'excelHtml5',
                className: 'btn btn-success',
                text: 'Excel',
                titleAttr: 'Export to Excel',
                title: 'Exam Questions',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'csvHtml5',
                className: 'btn btn-primary',
                text: 'CSV',
                titleAttr: 'CSV',
                title: 'Exam Questions',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-danger',
                text: 'PDF',
                titleAttr: 'PDF',
                title: 'Exam Questions',
                orientation: 'landscape',
                pageSize: 'TABLOID',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            }
        ]
        });
    });


     $(document).ready(function(){
      window.$('#examTable3').DataTable({
        dom: 'frtipB',
        buttons: [
            {
                extend: 'excelHtml5',
                className: 'btn btn-success',
                text: 'Excel',
                titleAttr: 'Export to Excel',
                title: 'Exam Questions',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'csvHtml5',
                className: 'btn btn-primary',
                text: 'CSV',
                titleAttr: 'CSV',
                title: 'Exam Questions',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'btn btn-danger',
                text: 'PDF',
                titleAttr: 'PDF',
                title: 'Exam Questions',
                orientation: 'landscape',
                pageSize: 'TABLOID',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            }
        ]
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(231,233,237)'
      };

      var ctx = document.getElementById("canvas").getContext("2d");

      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: [<?php echo $date ?>],
            datasets: [{
                label: 'Applicants per day',
                backgroundColor: [ '#ADD8E6', '#87CEEB', '#00BFFF', '#1E90FF', '#6495ED', '#7B68EE', '#4169E1', '#0000FF', '#0000CD',
    '#00008B', '#000080', '#191970', '#4682B4', '#B0C4DE', '#5F9EA0', '#7FFFD4', '#AFEEEE', '#00CED1',
    '#20B2AA', '#87CEFA'],
                borderWidth: 2,
                fill: false,
                data: [<?php echo $count ?>]
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Chart.js Drsw Line on Chart'
            },
            tooltips: {
                mode: 'index',
                intersect: true
            },
            annotation: {
                annotations: [{
                    type: 'line',
                    mode: 'horizontal',
                    scaleID: 'y-axis-0',
                    endValue: 0,
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 4,
                    label: {
                        enabled: true,
                        content: 'Trendline',
                        yAdjust: -16,
                    }
                }]
            }
        }
    });
</script>
<script>
     window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(231,233,237)'
      };

      var ctx2 = document.getElementById("canvas2").getContext("2d");

      var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
          labels: [<?php echo $item ?>],
                datasets: [{
                    label: 'Point Item Analysis (Commonly wrong Item)',
                    backgroundColor: [ '#ADD8E6', '#87CEEB', '#00BFFF', '#1E90FF', '#6495ED', '#7B68EE', '#4169E1', '#0000FF', '#0000CD',
    '#00008B', '#000080', '#191970', '#4682B4', '#B0C4DE', '#5F9EA0', '#7FFFD4', '#AFEEEE', '#00CED1',
    '#20B2AA', '#87CEFA'] ,
                    borderWidth: 2,
                    fill: false,
                    data: [<?php echo $itemcount ?>]
                }]
            },
            options: {
                indexAxis: 'x',
                responsive: true,
                title: {
                    display: true,
                    text: 'Chart.js Drsw Line on Chart'
                },
                tooltips: {
                    mode: 'index',
                    intersect: true
                },
                annotation: {
                    annotations: [{
                        type: 'line',
                        mode: 'horizontal',
                        scaleID: 'y-axis-0',
                        endValue: 0,
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 4,
                        label: {
                            enabled: true,
                            content: 'Trendline',
                            yAdjust: -16,
                        }
                    }]
                }
            }
        });

</script> 
<script>
     window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(231,233,237)'
      };

      var ctx4 = document.getElementById("canvas4").getContext("2d");

      var myChart4 = new Chart(ctx4, {
        type: 'bar',
        data: {
          labels: [<?php echo $item2 ?>],
                datasets: [{
                    label: 'Point Item Analysis (Commonly Answered Correctly)',
                    backgroundColor: [ '#ADD8E6', '#87CEEB', '#00BFFF', '#1E90FF', '#6495ED', '#7B68EE', '#4169E1', '#0000FF', '#0000CD',
    '#00008B', '#000080', '#191970', '#4682B4', '#B0C4DE', '#5F9EA0', '#7FFFD4', '#AFEEEE', '#00CED1',
    '#20B2AA', '#87CEFA'] ,
                    borderWidth: 2,
                    fill: false,
                    data: [<?php echo $itemcount2 ?>]
                }]
            },
            options: {
                indexAxis: 'x',
                responsive: true,
                title: {
                    display: true,
                    text: 'Chart.js Drsw Line on Chart'
                },
                tooltips: {
                    mode: 'index',
                    intersect: true
                },
                annotation: {
                    annotations: [{
                        type: 'line',
                        mode: 'horizontal',
                        scaleID: 'y-axis-0',
                        endValue: 0,
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 4,
                        label: {
                            enabled: true,
                            content: 'Trendline',
                            yAdjust: -16,
                        }
                    }]
                }
            }
        });

</script> 

<script>

      var ctx3 = document.getElementById("canvas3").getContext("2d");

      var myChart3 = new Chart(ctx3, {
        type: 'bar',
        data: {
          labels: [<?php echo $town ?>],
            datasets: [{
                label: 'Geographical Analysis',
                backgroundColor: [ '#ADD8E6', '#87CEEB', '#00BFFF', '#1E90FF', '#6495ED', '#7B68EE', '#4169E1', '#0000FF', '#0000CD',
    '#00008B', '#000080', '#191970', '#4682B4', '#B0C4DE', '#5F9EA0', '#7FFFD4', '#AFEEEE', '#00CED1',
    '#20B2AA', '#87CEFA'] ,
                borderWidth: 2,
                fill: true,
                data: [<?php echo $towncount ?>]
            }]
        },
        options: {
            indexAxis: 'x',
            responsive: true,
            title: {
                display: true,
                text: 'Chart.js Drsw Line on Chart'
            },
            tooltips: {
                mode: 'index',
                intersect: true
            },
            annotation: {
                annotations: [{
                    type: 'line',
                    mode: 'horizontal',
                    scaleID: 'y-axis-0',
                    endValue: 0,
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 4,
                    label: {
                        enabled: true,
                        content: 'Trendline',
                        yAdjust: -16,
                    }
                }]
            }
        }
    });

</script>
<script>

      var ctx5 = document.getElementById("canvas5").getContext("2d");

      var myChart5 = new Chart(ctx5, {
        type: 'pie',
        data: {
          labels: [<?php echo $implodedGender ?>],
            datasets: [{
                label: 'Gender Analysis',
                backgroundColor: [ '#ADD8E6', '#87CEEB', '#00BFFF', '#1E90FF', '#6495ED', '#7B68EE', '#4169E1', '#0000FF', '#0000CD',
    '#00008B', '#000080', '#191970', '#4682B4', '#B0C4DE', '#5F9EA0', '#7FFFD4', '#AFEEEE', '#00CED1',
    '#20B2AA', '#87CEFA'],
                borderWidth: 2,
                fill: true,
                data: [<?php echo $implodedGenderCount ?>]
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            title: {
                display: true,
                text: 'Chart.js Drsw Line on Chart'
            },
            tooltips: {
                mode: 'index',
                intersect: true
            },
            annotation: {
                annotations: [{
                    type: 'line',
                    mode: 'horizontal',
                    scaleID: 'y-axis-0',
                    endValue: 0,
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 4,
                    label: {
                        enabled: true,
                        content: 'Trendline',
                        yAdjust: -16,
                    }
                }]
            }
        }
    });

</script>
<script>

      var ctx6 = document.getElementById("canvas6").getContext("2d");

      var myChart6 = new Chart(ctx6, {
        type: 'line',
        data: {
          labels: [<?php echo $implodedAge ?>],
            datasets: [{
                label: 'Age Analysis',
                backgroundColor: [ '#ADD8E6', '#87CEEB', '#00BFFF', '#1E90FF', '#6495ED', '#7B68EE', '#4169E1', '#0000FF', '#0000CD',
    '#00008B', '#000080', '#191970', '#4682B4', '#B0C4DE', '#5F9EA0', '#7FFFD4', '#AFEEEE', '#00CED1',
    '#20B2AA', '#87CEFA'],
                borderWidth: 2,
                fill: true,
                data: [<?php echo $implodedAgeCount ?>]
            }]
        },
        options: {
            indexAxis: 'x',
            responsive: true,
            title: {
                display: true,
                text: 'Chart.js Drsw Line on Chart'
            },
            tooltips: {
                mode: 'index',
                intersect: true
            },
            annotation: {
                annotations: [{
                    type: 'line',
                    mode: 'horizontal',
                    scaleID: 'y-axis-0',
                    endValue: 0,
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 4,
                    label: {
                        enabled: true,
                        content: 'Trendline',
                        yAdjust: -16,
                    }
                }]
            }
        }
    });

</script>

</body>
</html>
