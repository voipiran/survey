window.Vue = require('vue');
import Vuex from 'vuex'
Vue.use(Vuex)
import Axios from 'axios'
window.axios = Axios;
window.Event = new Vue();
import dashboard_bar from './components/charts/dashboard/dashboard_bar';
import dashboard_sp_bar from './components/charts/dashboard/dashboard_sp_bar';
import dashboard_line from './components/charts/dashboard/dashboard_line';
import dashboard_pie from './components/charts/dashboard/dashboard_pie';
import year_choose from './components/charts/dashboard/dashboard_year_choose';
import dashboard_sp_year_choose from './components/charts/dashboard/dashboard_sp_year_choose';
import dashboard_op_choose from './components/charts/dashboard/dashboard_op_choose';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

Vue.component('date-picker', VuePersianDatetimePicker);
Vue.component('year_choose', year_choose);


const store = new Vuex.Store({
    state: {
        selected_op: '',
        operators: '',
        selected_year: '',
        sp_selected_year: '',
        Bardatacollection: '',
        SpBardatacollection: '',
        Linedatacollection: '',
        Piedatacollection: {
            labels: ['نتایج  1', 'نتایج  2', 'نتایج  3', 'نتایج  4', 'نتایج  5'],
            datasets: [{
                backgroundColor: ['rgba(255, 10 ,10, 0.4)', 'rgba(255, 180,20, 0.4)', 'rgba(100, 100,155, 0.4)', 'rgba(10, 10,255, 0.4)', 'rgba(0, 255,0, 0.4)'],
                data: [],
            }]
        }
    },
    mutations: {
        get_this_year(state) {
            Axios.post('get_this_year')
                .then(response => {
                    state.selected_year = response.data;
                })
                .catch(error => {
                    console.log(error.data);
                })
        },
        change_year(state, payload) {
            state.selected_year = payload;
            Axios.post('core/dashboard/dashboard_funcs.php?f=create_bar&year=' + payload)
                .then(response => {
                    state.Bardatacollection = response.data;
                    Event.$emit('refreshbar');
                })
                .catch(error => {
                    console.log(error);
                })
        },
        sp_change_year(state, payload) {
            state.selected_year = payload;
            Axios.post('core/dashboard/dashboard_funcs.php?f=create_bar&year=' + payload)
                .then(response => {
                    state.SpBardatacollection = response.data;
                    Event.$emit('refreshspbar');
                })
                .catch(error => {
                    console.log(error);
                })
        },
        create_bar(state, payload) {
            Axios.post('core/dashboard/dashboard_funcs.php?f=create_bar&year=' + payload)
                .then(response => {
                    state.Bardatacollection = response.data;
                    Event.$emit('refreshbar');
                })
                .catch(error => {
                    console.log(error.data);
                })
        },
        create_sp_bar(state, payload) {
            Axios.post('core/dashboard/dashboard_funcs.php?f=create_sp_bar&year=' + year + '&operator_number=' + payload)
                .then(response => {
                    state.SpBardatacollection = response.data;
                    Event.$emit('refreshspbar');
                })
                .catch(error => {
                    console.log(error.data);
                })
        },
        create_line(state, payload) {
            Axios.post('core/dashboard/dashboard_funcs.php?f=create_line&year=' + payload.year + '&month=' + payload.month)
                .then(response => {
                    state.Linedatacollection = response.data;
                    Event.$emit('refreshline');
                })
                .catch(error => {
                    console.log(error.data);
                })
        },
        create_pie(state, payload) {
            Axios.post('core/dashboard/dashboard_funcs.php?f=create_pie&date_time=' + payload)
                .then(response => {
                    state.Piedatacollection.datasets[0].data = response.data['chart'];
                    document.getElementById('date_time').value = response.data['date_time'];
                    Event.$emit('refreshpie');
                    // console.log( response.data['empty'])
                    if (response.data['empty']) {
                        toastr.info('داده ای برای این بازه زمانی یافت نشد!')
                            // toastr('داده ای برای این بازه زمانی یافت نشد.' );
                    }
                })
                .catch(error => {
                    console.log(error.data);
                });
        }
    }
})


const chart = new Vue({
    el: '#charts',
    store: store,
    data: {
        date_time: '',
        year: year,
        month: month
    },
    components: {
        'dashboard_pie': dashboard_pie,
        'dashboard_bar': dashboard_bar,
        'dashboard_line': dashboard_line,
        'dashboard_sp_bar': dashboard_sp_bar,
        'dashboard_sp_year_choose': dashboard_sp_year_choose,
        'dashboard_op_choose': dashboard_op_choose
    },
    methods: {
        refreshpie() {
            var date_time = document.getElementById('date_time').value;
            this.$store.commit('create_pie', date_time);
            Event.$emit('refreshpie');
        },
        datepiker_change() {
            var data = {
                year: this.year,
                month: this.month
            }
            this.$store.commit('create_line', data);
        }
    },
    async created() {
        await Axios.post("core/dashboard/dashboard_funcs.php?f=operators")
            .then(response => {
                this.$store.state.operators = response.data;
                this.$store.state.selected_op = response.data[0]['agent_number'];
            })
            .catch(error => {
                console.log(error.data);
            });
        var operator_number = this.$store.state.operators[0]['agent_number'];
        this.$store.commit('create_bar', year);
        this.$store.commit('create_sp_bar', operator_number);
        this.$store.commit('create_pie', 'no_set');
        var data = {
            year: this.year,
            month: this.month,
        }
        this.$store.commit('create_line', data);
    }
});