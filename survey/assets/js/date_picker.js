import Vue from 'vue';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
Vue.component('date-picker', VuePersianDatetimePicker);

new Vue({
    el : '#date_picker'
});
