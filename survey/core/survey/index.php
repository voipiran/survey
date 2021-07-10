<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>

    <?php
    include_once '../../vendor/autoload.php';
    include_once  '../config/config.php';
    include_once '../config/db.php';
    include '../../layouts/head.php';
    include_once 'functions.php';

    removeQueueIfRiched($conn);
    checkLicense();
    ?>
    <link href="<?= BASE_PATH ?>dist/css/toastr.min.css" rel="stylesheet" type="text/css" media="all" />
    <style>
        .swal2-content,
        button {
            font-family: irsns;
        }
    </style>
    <link href="<?= BASE_PATH ?>dist/css/daterange/daterangepicker.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?= BASE_PATH ?>dist/css/daterange/datepicker-theme.css" rel="stylesheet" type="text/css" media="all" />
    <style>
        #confirm {
            min-width: 90px;
        }

        .tooltip-inner {
            display: none;
        }

        .tooltip-arrow {

            display: none;
        }

        canvas {
            display: none;
        }

        .modal-content {
            background-color: white !important;
            width: auto !important;
        }

        .modal-footer {
            width: 180px !important;
        }

        .modal-footer .btn-secondary {
            background: #f0f0f0 !important;
        }

        .download-form{
            display: inline-block;
        }
        .download-form button{
            background: none;
            border: none;
        }
    </style>

    <script>
        var BASE_PATH = "<?= BASE_PATH ?>";
    </script>
    <script src="https://unpkg.com/wavesurfer.js"></script>

    <!-- modal and audioplay amplitude  -->
    <link rel='stylesheet' href='<?= BASE_PATH ?>dist/css/audioplayer.css' />
    <link rel='stylesheet' href='<?= BASE_PATH ?>dist/css/modal.css' />
    <style>
        a {
            color: #4a4a4a;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        input[type=range] {
            direction: ltr;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include '../../layouts/header.php' ?>
        <!-- right side column. contains the logo and sidebar -->
        <?php include('../../layouts/sidebar.php')  ?>
        <?php include_once 'grid.php' ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <li class="fa fa-cogs"></li> نظرسنجی
                    <!--                <small>توضیحات</small>-->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?= BASE_PATH ?>"><i class="fa fa-home"></i> داشبورد</a></li>
                    <li class="active"><i class="fa fa-area-chart"></i> نظرسنجی </li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content container-fluid">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="col-lg-10">
                                <h3 class="box-title">نظرسنجی</h3>
                            </div>
                            <div class="col-lg-2">
                                <a href="<?= BASE_PATH . 'core/survey' ?>"><button class="btn btn-success"><i class="fas fa-redo"></i></button></a>
                                <div class="btn-group" role="group" aria-label="...">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-file-export"></i>
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= BASE_PATH . 'core/survey/pdf.php' ?>"> <i class="fas fa-file-pdf-o"></i> پی دی اف </a></li>
                                            <li><a href="<?= BASE_PATH . 'uploads/xlsx/survey.xlsx' ?>"> <i class="fas fa-file-excel-o"></i> اکسل </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <form action="">
                                <?php
                                function removeqsvar($url, $varname)
                                {
                                    list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
                                    parse_str($qspart, $qsvars);
                                    unset($qsvars[$varname]);
                                    $newqs = http_build_query($qsvars);
                                    return $urlpart . '?' . $newqs;
                                }
                                if ($current_url != BASE_PATH . 'core/survey/') {
                                    // means have some filters . so add sort to end of it
                                    if (isset($_GET['sort_by']) || isset($_GET['sort_dir'])) {
                                        $old_dir = $_GET['sort_dir'];
                                        $sort_url = removeqsvar($current_url, 'sort_by');
                                        $sort_url = removeqsvar($sort_url, 'sort_dir');
                                        $sort_url = $sort_url . '&sort_by=';
                                    } else {
                                        $sort_url = $current_url . '&sort_by=';
                                    }
                                } else {
                                    $sort_url = BASE_PATH . 'core/survey/?sort_by=';
                                }
                                if (isset($old_dir)) {
                                    if ($old_dir == 'asc') {
                                        $sort_dir = 'desc';
                                    }
                                    if ($old_dir == 'desc') {
                                        $sort_dir = 'asc';
                                    }
                                } else {
                                    $sort_dir = 'asc';
                                }
                                ?>
                                <div style="overflow:auto;">
                                    <table class="table table-bordered table-hover dataTable" id="audio">
                                        <tr>
                                            <th style="text-align: center;"> <a href="<?= $sort_url . 'id&sort_dir=' . $sort_dir ?>" title='مرتب سازی بر اساس شناسه            '>شناسه </a> </th>
                                            <th style="text-align: center;"> <a href="<?= $sort_url . 'uniqueid&sort_dir=' . $sort_dir ?>" title='مرتب سازی بر اساس شناسه یکتا       '>شناسه یکتا </a> </th>
                                            <th style="text-align: center;"> <a href="<?= $sort_url . 'date_time&sort_dir=' . $sort_dir ?>" title='مرتب سازی بر اساس تاریخ و زمان        '>تاریخ و زمان </a> </th>
                                            <th style="text-align: center;"> <a href="<?= $sort_url . 'agent_number&sort_dir=' . $sort_dir ?>" title='مرتب سازی بر اساس شماره اپراتور    '>شماره اپراتور </a> </th>
                                            <th style="text-align: center;"> <a href="<?= $sort_url . 'agent_name&sort_dir=' . $sort_dir ?>" title='مرتب سازی بر اساس نام اپراتور      '>نام اپراتور </a> </th>
                                            <th style="text-align: center;"> <a href="<?= $sort_url . 'caller_number&sort_dir=' . $sort_dir ?>" title='مرتب سازی بر اساس شماره تماس گیرنده'>شماره تماس گیرنده</a> </th>
                                            <th style="text-align: center;"> <a href="<?= $sort_url . 'caller_name&sort_dir=' . $sort_dir ?>" title='مرتب سازی بر اساس نام تماس گیرنده  '>نام تماس گیرنده </a> </th>
                                            <th style="text-align: center;"> <a href="<?= $sort_url . 'survey_value&sort_dir=' . $sort_dir ?>" title='مرتب سازی بر اساس مقدار نظرسنجی    '>مقدار نظرسنجی </a> </th>
                                            <th style="text-align: center;"> <a href="<?= $sort_url . 'survey_location&sort_dir=' . $sort_dir ?>" title='مرتب سازی بر اساس شماره صف         '>شماره صف </a> </th>
                                            <th style="text-align: center;min-width:101px"> <a href="">پیام مشتری </a> </th>
                                            <th style="text-align: center;min-width:101px"> <a href="">صدای مکالمه </a> </th>
                                            <th></th>
                                        </tr>
                                        <!--filters-->
                                        <tr>
                                            <td><input type="text" class="form-control" name="id" value="<?= (isset($_GET['id'])) ? $_GET['id']  : '' ?>"></td>
                                            <td><input type="text" class="form-control" name="uniqueid" value="<?= (isset($_GET['uniqueid'])) ? $_GET['uniqueid']  : '' ?>"></td>
                                            <td><input type="text" class="form-control date-range" name="date_time" value="<?= (isset($_GET['date_time'])) ? $_GET['date_time']  : '' ?>"></td>
                                            <td><input type="text" class="form-control" name="agent_number" value="<?= (isset($_GET['agent_number'])) ? $_GET['agent_number']  : '' ?>"></td>
                                            <td><input type="text" class="form-control" name="agent_name" value="<?= (isset($_GET['agent_name'])) ? $_GET['agent_name']  : '' ?>"></td>
                                            <td><input type="text" class="form-control" name="caller_number" value="<?= (isset($_GET['caller_number'])) ? $_GET['caller_number']  : '' ?>"></td>
                                            <td><input type="text" class="form-control" name="caller_name" value="<?= (isset($_GET['caller_name'])) ? $_GET['caller_name']  : '' ?>"></td>
                                            <td><input type="text" class="form-control" name="survey_value" value="<?= (isset($_GET['survey_value'])) ? $_GET['survey_value']  : '' ?>"></td>
                                            <td><input type="text" class="form-control" name="survey_location" value="<?= (isset($_GET['survey_location'])) ? $_GET['survey_location']  : '' ?>"></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <button class="btn btn-xs btn-primary "><i class="fas fa-filter"></i></button>
                                            </td>
                                        </tr>
                            </form>
                            <!-- ------------------ Start datagrid ------------------ -->
                            <?php
                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['uniqueid'] ?></td>
                                        <td> <?= jDateTime::date('Y/m/d', strtotime($row['date_time'])) . ' ' . date('H:i:s', strtotime($row['date_time']), 'Asia/Tehran') ?></td>
                                        <td><?= $row['agent_number'] ?></td>
                                        <td><?= $row['agent_name'] ?></td>
                                        <td><?= $row['caller_number'] ?></td>
                                        <td><?= $row['caller_name'] ?></td>
                                        <td><?= $row['survey_value'] ?></td>
                                        <td><?= $row['survey_location'] ?></td>
                                        <td style="width:120px;text-align:center">
                                            <?php
                                            if (empty($row['customer_voice_path'])) {
                                                echo 'بدون پیام';
                                            } else {
                                            ?>
                                                <?php
                                                $src = BASE_PATH . 'core/survey/voices/' . $row['customer_voice_path'];
                                                ?>
                                                <!-- <a href="<?= $src ?>" download="<?= $row['customer_voice_path'] ?>">دانلود</a> -->
                                                <form action="download.php" method="get" class="download-form" >
                                                    <input type="hidden" name="url" value="<?= $src ?>">
                                                    <button>دانلود</button>
                                                </form>
                                                | <span onclick="initAmplitude('<?= $src ?>' , '<?= $row['caller_name'] . '-' . $row['caller_number'] ?>' )" class="cursor-pointer">پخش</span>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $customerVoiceSrc = getCustomerVoice($asteriskdbConn, $row['uniqueid']);
                                            if ($customerVoiceSrc) {
                                            ?>
                                                <!-- <a href="<?= $customerVoiceSrc ?>" download="<?= $row['customer_voice_path'] ?>">دانلود</a> -->
                                                <!-- <mitismirza play_path=<?= $play_path ?> src="<?= $customerVoiceSrc ?>" download_path="<?= $download_path ?>" modal_name="<?= 'modal_' . $row['id'] ?>" cover_photo="<?= $cover_photo ?>" title="<?= $row['caller_name'] . '-' . $row['caller_number'] ?>"> </mitismirza> -->
                                                <form action="download.php" method="get" class="download-form" >
                                                    <input type="hidden" name="url" value="<?= $customerVoiceSrc ?>">
                                                    <button>دانلود</button>
                                                </form>
                                                | <span onclick="initAmplitude('<?= $customerVoiceSrc ?>' , '<?= $row['caller_name'] . '-' . $row['caller_number'] ?>' )" class="cursor-pointer">پخش</span>
                                            <?php
                                            } else {
                                                echo 'بدون صوت';
                                            }
                                            ?>
                                        </td>
                                        <td id="confirm">
                                            <?php
                                            if (can('removeSurvey')) {
                                            ?>
                                                <button type="button" title="حذف" @click="clickHandler_survey(<?= $row['id'] ?>)" class="btn btn-danger btn-xs">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            <?php
                                            }
                                            ?>

                                            <?php
                                            if (can('editSurvey')) {
                                            ?>
                                                <a href="edit.php?id=<?= $row['id'] ?>"><button title="ویرایش" type="button" class="btn btn-warning btn-xs">
                                                        <i class="fas fa-edit"></i>
                                                    </button></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                            <!-- ------------------ End datagrid ------------------ -->
                            </table>
                        </div>
                    </div>
                    <div class="box-footer" style="text-align: center;">
                        <!--                        paginate-->
                        <?php

                        # Show the Previous Link, Custom HTML is accepted

                        # Show the Numbers, Custom HTML is accepted
                        # Parameter1: For Loop Number with a Link
                        # Parameter2: Loop Number of Current Page (no link)

                        # Show the Previous Link, Custom HTML is accepted

                        //                        echo $nav->get_html('themes/bootstrap'); # Load Configuration from Theme File
                        $url = $current_url;
                        if (isset($_GET['id'])) {
                            $url = $current_url . '&page={nr}';
                        } elseif (isset($_GET['page']) && !isset($_GET['id'])) {
                            (strpos($url, 'page')) ? $url = $_GET['page'] = '?page={nr}' : $url = $current_url . '?page={nr}';
                        } elseif (isset($_GET['id']) && isset($_GET['page'])) {
                            $_GET['page'] = 'page={nr}';
                            $url = $current_url;
                        } else {
                            $url = $current_url . '?page={nr}';
                        }
                        ?>
                        <ul class="pagination" style="direction: rtl">
                            <li class="paginate_button next"><?= $nav->last("<a href=$url> <<</a>")  ?></li>
                            <li class="paginate_button next"><?= $nav->next(" <a href=$url>بعدی</a>")  ?></li>
                            <?= $nav->numbers("<li class=\"paginate_button \"><a href=$url>{nr}</a></li> ", "<li class=\"paginate_button active\"><a href=$url > {nr}</a></li>", true) ?>
                            <li class="paginate_button previous"> <?= $nav->previous("<a href=$url>قبلی</a>")  ?></li>
                            <li class="paginate_button previous"> <?= $nav->first(" <a href=$url> >></a>");  ?></li>
                        </ul>
                    </div>
                    <div style="text-align: left; padding: 5px;">
                        <?= $nav->info('صفحه {page} از مجموع {pages} صفحه'); ?>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include '../../layouts/footer.php' ?>

    <script src="<?= BASE_PATH ?>dist/js/toastr.min.js"></script>

    <script>
        toastr.options = {
            "positionClass": "toast-bottom-left"
        }
    </script>
    <?php
    if (isset($_GET['update'])) {
        if ($_GET['update'] == 'success') {
    ?>
            <script>
                toastr.success('بروزرسانی با موفقیت انجام شد.');
            </script>
        <?php
        }

        if ($_GET['update'] == 'deleted') {
        ?>
            <script>
                toastr.success('حذف با موفقیت انجام شد.');
            </script>
    <?php
        }
    }
    ?>
    <script src="<?= BASE_PATH ?>dist/js/daterange/moment.min.js" type="text/javascript"></script>
    <script src="<?= BASE_PATH ?>dist/js/daterange/moment-jalaali.js"></script>
    <script src="<?= BASE_PATH ?>dist/js/daterange/daterangepicker-fa-ex.js"></script>
    <script src="<?= BASE_PATH  ?>dist/js/audio.js"></script>

    <script>
        $(document).ready(function() {
            var night;
            var isRtl = true;
            var dateFormat = isRtl ? 'jYYYY/jMM/jDD' : 'YYYY/MM/DD';
            var dateFrom = false ? moment("") : undefined;
            var dateTo = false ? moment("") : undefined;
            var $dateRanger = $(".date-range");

            $dateRanger.daterangepicker({
                clearLabel: 'Clear',
                autoUpdateInput: !!(dateFrom && dateTo),
                // minDate: moment(),
                autoApply: true,
                opens: isRtl ? 'left' : 'right',
                locale: {
                    separator: ' - ',
                    format: dateFormat
                },
                startDate: dateFrom,
                endDate: dateTo,
                jalaali: isRtl,
                showDropdowns: true
            }).on('apply.daterangepicker', function(ev, picker) {
                night = picker.endDate.diff(picker.startDate, 'days');
                if (night > 0) {
                    $(this).val(picker.startDate.format(dateFormat));
                    $('.date-range').val(picker.startDate.format(dateFormat) + ' - ' + picker.endDate.format(dateFormat));
                } else {
                    $(this).val('')
                }
            });

            $(document).on('mouseover', '.daterangepicker .calendar td', function() {
                var gagDate = $(this).attr('data-original-title');
                $('.date-hover').text('');
                $('.date-hover').text(gagDate);

                $('[data-toggle="tooltip"]').tooltip()
            });

        });

        function popUp(address) {
            window.open(address, '_blank', "height=150,top=0,width=500");
        }
    </script>



    <!-- modal audio here  -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div id="single-song-player">
            <span class="close" onclick="closeAmplitude()">×</span>
            <div class="bottom-container">
                <!-- <progress class="amplitude-song-played-progress" id="song-played-progress"></progress> -->
                <input type="range" class="amplitude-song-slider" data-amplitude-song-index="0">

                <div class="time-container">
                    <span class="current-time">
                        <span class="amplitude-current-minutes"></span>:<span class="amplitude-current-seconds"></span>
                    </span>
                    <span class="duration">
                        <span class="amplitude-duration-minutes"></span>:<span class="amplitude-duration-seconds"></span>
                    </span>
                </div>

                <div class="control-container">
                    <div class="amplitude-play-pause" id="play-pause"></div>
                    <div class="meta-container">
                        <span data-amplitude-song-info="name" class="song-name"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- amplitude audioplayer javascript  -->
    <script type='text/javascript' src='<?= BASE_PATH ?>dist/js/amplitude.min.js'></script>
    <script>
        /**init audio player  */
        function initAmplitude(songRef, title) {
            $("#myModal").css('display', 'block');
            Amplitude.init({
                "bindings": {
                    37: 'prev',
                    39: 'next',
                    32: 'play_pause'
                },
                "songs": [{
                    "name": title,
                    "url": songRef,
                }]
            });
        }

        /**close audio player  */
        function closeAmplitude() {
            Amplitude.stop();
            $("#myModal").css('display', 'none');
        }
    </script>

</body>

</html>