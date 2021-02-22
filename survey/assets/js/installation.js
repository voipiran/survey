import Vue from 'vue';
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import Axois from 'axios';
import swal from 'sweetalert2';
import Axios from 'axios';
import PrettyInput from 'pretty-checkbox-vue/input';
import PrettyCheck from 'pretty-checkbox-vue/check';
import PrettyRadio from 'pretty-checkbox-vue/radio';

import { Modal, VoerroModal } from '@voerro/vue-modal';

Vue.component('modal', Modal);
window.VoerroModal = VoerroModal;

Vue.component('p-input', PrettyInput);
Vue.component('p-check', PrettyCheck);
Vue.component('p-radio', PrettyRadio);


Vue.use(VueFormWizard)

const installation = new Vue({
    el: '#installation',
    data: {
        rules: false,
        base_path: null,
        db_name: 'visurvey',
        db_host: 'localhost',
        db_username: 'root',
        db_password: '',
        license: null,
        asterisk_status: false
    },
    methods: {
        close(){
            VoerroModal.hide('inline-modal');
        },
        nextTab() {
            this.$refs.wz.nextTab();
        },
        showRules() {
            VoerroModal.show('inline-modal');
        },
        async step1() {
            var validate = true;
            // (!this.base_path) ? validate = false : '';
            (!this.db_name) ? validate = false : '';
            (!this.db_host) ? validate = false : '';
            (!this.db_username) ? validate = false : '';
            if (validate) {
                swal.fire({
                    title: 'در حال بررسی اتصال پایگاه داده ، لطفا شکیبا باشید...',
                    allowOutsideClick: false
                });
                swal.showLoading();
                var conn = true;
                await Axios.get(url + 'core/config/conn_check.php?'
                    + 'db_name=' + this.db_name
                    + '&db_host=' + this.db_host
                    + '&db_username=' + this.db_username
                    + '&db_password=' + this.db_password
                )
                    .then(response => {
                        swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'برقراری ارتباط موفقیت آمیز بود',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    })
                    .catch(error => {
                        swal.fire('خطا', 'اتصال با پایگاه داده برقرار نشد ، لطفا ورودی ها را بررسی و دوباره امتحان کنید.', 'error');
                        console.log(error);
                        conn = false;
                    });
                if (!conn) {
                    return false;
                }
                return true;
            }
            swal.fire('خطا', 'تمامی فیلد ها را کامل کنید', 'error');
            return false;
        },
        async onComplete() {
            try {
                if (!this.license) {
                    swal.fire({
                        text: 'لایسنس الزامی است',
                        icon: 'error',
                        confirmButtonText: 'بسیارخب'
                    });
                    return;
                }
                if (!this.rules) {
                    swal.fire({
                        text: 'پذیرش شرایط و قوانین استفاده از نرم افزار الزامی است.',
                        icon: 'error',
                        confirmButtonText: 'بسیارخب'
                    });
                    return;
                }
                swal.fire({
                    title: 'در حال بررسی لایسنس ، لطفا شکیبا باشید...',
                    allowOutsideClick: false,
                    allowEnterKey: false,
                    allowEscapeKey: false
                });
                swal.showLoading();
                // check license ...
                let type;
                const prms = new FormData();
                prms.append('license', this.license);
                var ls = true;
                let lsc = await Axios({
                    method: 'post',
                    url: 'https://license.voipiran.io/api/v1/license',
                    data: prms,
                })
                .then(response =>{
                    type = response.data.license;
                })
                .catch(error => {
                    ls = false;
                    swal.fire('', 'لایسنس معتبر نمی باشد', 'error');
                });
                if (!ls) { return false }
                swal.fire({
                    title: 'در حال ایجاد جداول دیتابیس ، لطفا شکیبا باشید...',
                    allowOutsideClick: false,
                    allowEnterKey: false,
                    allowEscapeKey: false
                });
                swal.showLoading();

                // make configuration 
                const params = new FormData();
                params.append('db_host', this.db_host);
                params.append('db_username', this.db_username);
                params.append('db_password', this.db_password);
                params.append('db_name', this.db_name);
                params.append('base_path', url);
                params.append('asterisk_status', this.asterisk_status);
                params.append('license_type', type);
                let res = await Axios({
                    method: 'post',
                    url: url + 'core/config/set_config.php',
                    data: params
                });

                swal.fire({
                    text: 'جداول با موفقیت ایجاد شدند ، در حال هدایت به داشبورد ، لطفا شکیبا باشید...',
                    allowOutsideClick: false,
                    allowEnterKey: false,
                    allowEscapeKey: false
                });
                swal.showLoading();
                window.location.href = url;
            } catch (error) {
                swal.fire('', error.message, 'error');
            }
        }
    }
});