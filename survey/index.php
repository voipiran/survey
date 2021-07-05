<!DOCTYPE html>
<html>

<head>
    <?php
    (!file_exists('core/config/db.php')) ? header('location:install.php') : '';

    include 'core/config/config.php';
    include_once 'vendor/autoload.php';
    include 'core/config/db.php';
    include 'layouts/head.php';

    ?>

    <?php ?>
    <?php  ?>
    <!--    daterange picker-->
    <link href="dist/css/daterange/daterangepicker.css" rel="stylesheet" type="text/css" media="all" />
    <link href="dist/css/daterange/datepicker-theme.css" rel="stylesheet" type="text/css" media="all" />
    <link href="dist/css/toastr.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="dist/css/select2.min.css" rel="stylesheet" type="text/css" media="all" />
    <style>
        .tooltip-inner {
            display: none;
        }

        .tooltip-arrow {
            display: none;
        }

        hr {
            border-top: 1px solid #b5b5b5;
        }
    </style>
</head>
<?php


include 'core/dashboard/dashboard_funcs.php';
removeQueueIfRiched($conn);
checkLicense();
$res       = index();
$year      = $res[0];
$years     = $res[1];
$month     = $res[2];
?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <?php include 'layouts/header.php' ?>
        <!-- right side column. contains the logo and sidebar -->
        <?php include('layouts/sidebar.php')  ?>
        <script>
            var year = "<?= $year  ?>"
            var month = "<?= $month ?>"
        </script>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <li class="fa fa-home"></li> داشبورد
                    <!--        <small>توضیحات</small>-->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fas fa-home"></i> داشبورد</a></li>
                    <li class="active">عملکرد سالیانه</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content container-fluid">
                <div id="charts">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group text-center">
                            <div style="display: flex;justify-content:center">
                                <year_choose :years="<?= $years ?>"></year_choose>
                            </div>
                            <dashboard_bar></dashboard_bar>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group text-center">
                            <div style="display: flex;justify-content:center" class="input-group ">
                                <input type="text" id="date_time" onchange="alert('date changed')" class="form-control date-range" placeholder="بازه زمانی را انتخاب نمایید">
                                <span class="input-group-btn ">
                                    <button class="btn btn-xs btn-primary" @click="refreshpie" style="margin-top:0;"><i class="fas fa-search"> </i></button>
                                </span>
                            </div>
                            <dashboard_pie> </dashboard_pie>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group text-center">
                            <hr>
                            <strong>نمودار فعالیت اپراتورها به صورت ماهیانه</strong>
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div class="col-sm-5">
                                        سال :
                                        <date-picker v-model="year" type="year" v-model="year" @change="datepiker_change"></date-picker>
                                    </div>
                                    <div class="col-sm-5">
                                        ماه :
                                        <date-picker v-model="month" type="month" v-model="month" @change="datepiker_change"></date-picker>
                                    </div>
                                </div>
                            </div>
                            <dashboard_line> </dashboard_line>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group text-center">
                            <hr>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <strong> نمودار درصد رضایت مندی</strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                    <dashboard_sp_year_choose :years="<?= $years ?>"></dashboard_sp_year_choose>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6 col-6">
                                    <dashboard_op_choose> </dashboard_op_choose>
                                </div>
                            </div>
                            <dashboard_sp_bar></dashboard_sp_bar>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include 'layouts/footer.php' ?>
        <script src="dist/js/dashboard.js"></script>
        <script src="dist/js/daterange/moment.min.js" type="text/javascript"></script>
        <script src="dist/js/daterange/moment-jalaali.js"></script>
        <script src="dist/js/daterange/daterangepicker-fa-ex.js"></script>
        <script src="dist/js/toastr.min.js"></script>
        <script src="dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.js-example-basic-single').select2();
            });
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
                    minDate: '1390/01/01', // moment()
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

            function ref() {
                Event.$emit('get_pie_data');
            }
        </script>

        <script>
            toastr.options = {
                "positionClass": "toast-bottom-left"
            }
        </script>
</body>

</html>