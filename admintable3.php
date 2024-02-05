<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/toe/resource/php/class/core/init.php';
isLogin();
$viewtable = new viewtable();
$user = new user();
isAdmin($user->data()->groups);
$viewtable = new viewtable();



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
    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.min.css">
    <script src="vendor/js/jquery.js"></script>
    <link href="vendor/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="resource/css/styles.css">
    <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap-select.min.css">
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

    <div class="container-fluid m-4 p-2">
        <div class='row mb-2 justify-content-center'>
            <div class="col-md-12 card1 p-5" style='overflow:scroll;'>
                <?php $viewtable->viewPIA(); ?>
            </div>
        </div>
    </div>
</body>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="vendor/js/bootstrap.min.js"></script>
<script src="vendor/js/bootstrap-select.min.js"></script>


<script>

    $(document).ready(function () {
        window.$('#examTable').DataTable({
        });
    });
    $(document).ready(function () {
        window.$('#examTable2').DataTable({
            dom: 'frtipB',
            buttons: [
                {

                    extend: 'excelHtml5',
                    className: 'btn btn-success',
                    text: 'Excel',
                    titleAttr: 'Export to Excel',
                    title: 'Point Item Analysis(Incorrect Answers)',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }


                },

                {
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger',
                    text: 'PDF',
                    titleAttr: 'PDF',
                    title: 'Point Item Analysis(Incorrect Answers)',
                    orientation: 'portrait',
                    pageSize: 'TABLOID',
                    exportOptions: {
                        column: 'visible'

                    },


                    customize: function (doc) {
                        doc.pageMargins = [20, 20, 20, 20];
                        doc.defaultStyle.fontSize = 7;
                        doc.styles.tableHeader.fontSize = 22;
                        doc.styles.title.fontSize = 20;
                        doc.content[0].text = doc.content[0].text.trim();
                        doc['footer'] = (function (page, pages) {
                            return {
                                columns: [
                                    'Prepared By: <?php
                                        $currentDateTime = date('Y-m-d H:i:s');
                                        echo $user->data()->fname." ".$user->data()->lname."-".$currentDateTime; ?>',

                                    {
                                        alignment: 'right',
                                        text: ['page ', { text: page.toString() }, ' of ', { text: pages.toString() }]
                                    }


                                ],
                                margin: [10, 0]
                            }
                        });

                        var objLayout = {};
                        objLayout['hLineWidth'] = function (i) { return .5; };
                        objLayout['vLineWidth'] = function (i) { return .5; };
                        objLayout['hLineColor'] = function (i) { return '#aaa'; };
                        objLayout['vLineColor'] = function (i) { return '#aaa'; };
                        objLayout['paddingLeft'] = function (i) { return 4; };
                        objLayout['paddingRight'] = function (i) { return 4; };
                        doc.content[1].layout = objLayout;


                    }

                }
            ]

        });
    });
    $(document).ready(function () {
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
                    extend: 'pdfHtml5',
                    className: 'btn btn-danger',
                    text: 'PDF',
                    titleAttr: 'PDF',
                    title: 'Examination Questions',
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

</body>

</html>
