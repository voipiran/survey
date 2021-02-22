<?php
function url()
{
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['REQUEST_URI']
    );
}
$url  = url();
$url = str_replace('install.php', '', $url);
?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>راه اندازی نظر سنجی ویپ ایران</title>
    <link rel="icon" href="dist/img/favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/installation.css">
    <link rel="stylesheet" type="text/css" href="dist/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="dist/css/font.css">
    <link rel="stylesheet" href="dist/css/app.css">
    <script>
        var url = "<?= $url ?>";
    </script>
</head>

<body>
    <div class="container h-100 d-flex justify-content-center" id="installation" v-cloak>
        <div class="card my-auto">
            <div class="card-body">
                <form-wizard ref="wz" @on-complete="onComplete" finish-button-text="ثبت نهایی" next-button-text="مرحله بعد" back-button-text="مرحله قبل" title="راه اندازی نظرسنجی ویپ ایران" subtitle="لطفا تنظیمات پیکربندی سرور خود را وارد نمایید">
                    <tab-content title="تنظیمات" icon="ti-settings" :before-change="step1">
                        <div v-on:keyup.enter="nextTab">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">نام دیتابیس:</label>
                                        <input type="text" class="form-control" style="direction:ltr;text-align:left" v-model="db_name">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="">نام هاست دیتابیس:</label>
                                        <input type="text" class="form-control" style="direction:ltr;text-align:left" v-model="db_host">
                                        <div style="direction:ltr;text-align:left">
                                            <small>For example: localhost</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="">نام کاربری دیتابیس:</label>
                                        <input type="text" class="form-control" style="direction:ltr;text-align:left" v-model="db_username">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="password" style="opacity: 0;position: absolute; ">
                                        <label for="">کلمه عبور دیتابیس:</label>
                                        <input type="password" class="form-control" style="direction:ltr;text-align:left" v-model="db_password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tab-content>
                    <tab-content title="لایسنس" icon="ti-user">
                        <div class="form-group">
                            <div class="alert alert-danger">
                                نام کاربری ورود به محیط وب admin و رمز آن ۱۲۳۴۵۶ خواهد بود لطفا پس از ورود تغییر دهید
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">کد لایسنس را در این قسمت وارد کنید</label>
                            <textarea style="direction:ltr;text-align:left" v-model="license" class="form-control" id="" cols="30" rows="6"></textarea>
                            <small style="display: block">لطفا قبل از ثبت نهایی از اتصال اینترنت خود مطمئن شوید</small>
                            <!-- <p-check  v-model="asterisk_status" style="margin-top:10px" color="primary">مایل به استفاده از استریسک هستم</p-check> -->
                            <p-check v-model="rules" style="margin-top:10px" color="primary">شرایط و قوانین استفاده از نرم افزار را می پذیرم</p-check>
                            <a href="#" @click="showRules"><small>مطالعه شرایط و قوانین</small></a>
                            <!-- Start Rules  -->
                            <modal id="inline-modal" v-cloak>
                                <template slot="title">شرایط و قوانین استفاده از نرم افزار</template>

                                <div slot="body">
                                    <strong>شرایط و قوانین استفاده از نظرسنجی ویپ ایران</strong> <br>
                                    این محصول تجاری و متعلق به مجموعه ویپ ایران است، هر گونه استفاده غیر قانونی و بدون تهیه لایسنس پیگرد قانونی دارد.<br>
                                    1. این محصول از زمان اولین استفاده تا یکسال دارای پشتیبانی برای رفع ایرادات است اما لایسنس خریداری شده بدون محدودیت زمانی است.<br>
                                    2. لایسنس خریداری شده فقط بر روی یک سیستم تلفنی قابل نصب است.<br>
                                    3. در طی مدت یکساله پشتیبانی در صورت تغییر سرور و احتیاج به نصب مجدد فقط یکبار می توانید درخواست لایسنس جدید بدهید.<br>
                                    4. لایسنس خریداری شده مربوط به نسخه جاری در زمان خرید محصول است و نه نسخه های آینده<br>
                                </div>

                                <div slot="footer">
                                    <a target="_blank" href="https://voipiran.io">
                                        <button class="btn btn-md btn-info">VOIPIRAN</button>
                                    </a>
                                    <button @click="close" class="btn btn-md btn-danger">بستن</button>
                                </div>
                            </modal>
                            <!-- End Rules  -->

                        </div>
                    </tab-content>
                </form-wizard>
            </div>
        </div>
    </div>

    <script src="dist/js/jquery-3.4.1.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="dist/js/installation.js"></script>
    <style>
        .swal2-title {
            font-size: 16px !important;
        }

        .swal2-content {
            font-size: 14px;
        }
    </style>

</body>

</html>