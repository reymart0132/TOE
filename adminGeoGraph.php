<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/toe/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
isAdmin($user->data()->groups); 

if(!empty($_GET['town'])){
    $data=getGeoComplex($_GET['town']);
}else{
    $data = getGeoComplex();
}
$x=0;

// var_dump($data);

$town[] = "";
foreach ($data as $info) {
    $town[] = $info["town"];
    // $count[] = $info["tots"];
}
// $count = substr(implode("','", $count), 1) . "'";
$town = substr(implode("','", $town), 2) . "'";

// var_dump($town);

$genderGroup = [];
foreach ($data[0] as $key => $value) {
    if ($key !== 'town') {
        $genderGroup[] = "'".$key."'";
    }
}
// var_dump($genderGroup);

$gGroups = '[' . implode(', ', $genderGroup) . ']';

$genderGroups = [];
if(count($data) >0){
foreach ($data[0] as $key => $value) {
    if ($key !== 'town') {
        $genderGroups[] = $key;
    }
}
}

$output = [];
foreach ($genderGroups as $group) {
    $groupData = [];
    foreach ($data as $entry) {
        $value = isset($entry[$group]) ? intval($entry[$group]) : 0;
        $groupData[] = $value;
    }
    $output[] = '[' . implode(',', $groupData) . '],';
}

// Remove the last comma in the output array
$output[count($output) - 1] = rtrim($output[count($output) - 1], ',');

// var_dump($output);

$result = implode(PHP_EOL, $output);
$result = rtrim($result, ',');
// var_dump($result);

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
</head>
<body>
    <?php require_once('menu/adminmenu.php'); ?>
    <form class = "mt-2 p-3 border shadow-sm">
                <h1 class=""> Town Filter </h1>
                <div class="row justify-content-left">
                    <label for="town" class="mr-3">Select Town</label>
                    <select id="town" name="town" class="form-control col-9">
                        <?php findTowns(); ?>
                    </select><br>
                    <input type = "submit" class= "btn btn-primary mt-4 col-4">
                </div>
    </form>
    <div class="container mt-5">
        <h1>Registrants by Town segrated by Gender Group</h1>
        <canvas id="myChart" width="800" height="400"></canvas>
        <div class="mt-3">
            <button onclick="filterData('Male')" class="btn btn-primary">Male</button>
            <button onclick="filterData('Female')" class="btn btn-danger">Female</button>
            <button onclick="filterData('Other')" class="btn btn-success">Other</button>
            <button onclick="showAllData()" class="btn btn-info">Show All Data</button>
        </div>
    </div>


    <script>
        // Dummy data representing "month-year" on the x-axis
        const town = <?php echo "[" .$town. "]"; ?> ;
        // Dummy data representing counts of registrants per age group
        const genderGroup =  <?php echo $gGroups; ?> ; ;
        const genderCount = [
            <?php echo $result; ?>       // Senior
        ];

        const originalData = {
                labels: town,
                datasets: genderGroup.map((group, index) => ({
                    label: group,
                    backgroundColor: [
                        '#ffe0b3', // Pale Orange
                        '#98FB98', // Pale Peach
                        '#Cc99ff', // Pale Sky
                        '#ccf2ff', // Pale Aqua
                        '#E78587', // Pale Turquoise
                        '#ff9999'  // Additional color for Senior
                    ][index], // Choose colors based on index
                    data: genderCount[index],
                })),
            };

        let currentData = { ...originalData };

        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: currentData,
            options: {
                events: false,
                tooltips: {
                    enabled: false
                },
                hover: {
                    animationDuration: 0
                },
                animation: {
                    duration: 1,
                    onComplete: function () {
                        const chartInstance = this.chart,
                            ctx = chartInstance.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            const meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                const data = dataset.data[index];
                                ctx.fillText(data, bar._model.x, bar._model.y - 5);
                            });
                        });
                    }
                },
                
                 scales: {
                   x: {
                         beginAtZero: true,
                         stacked: true,
                     },
                     y: {
                         beginAtZero: true,
                         stacked: true,
                     },
                },
                // other options...
            
            }
        });

        // Function to filter data by index
        function filterData(gender) {
            currentData.datasets = originalData.datasets.filter((dataset) => dataset.label === gender);
            myChart.update();
        }

        // Function to show all the original data
        function showAllData() {
            currentData.datasets = originalData.datasets;
            myChart.update();
        }

        function getMaxValue() {
                let maxVal = 0;
            currentData.datasets.forEach((dataset) => {
                const maxDatasetVal = Math.max(...dataset.data);
                console.log("Dataset:", dataset.label, "Max Value:", maxDatasetVal);
                if (maxDatasetVal > maxVal) {
                    maxVal = maxDatasetVal;
                }
            });
            console.log("Overall Max Value:", maxVal);
            return maxVal;
            }
    </script>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="vendor/js/bootstrap.min.js"></script>
<script src="vendor/js/bootstrap-select.min.js"></script>
   

</body>
</html>
