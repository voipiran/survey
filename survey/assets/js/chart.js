window.Vue = require('vue');
import Vuex from 'vuex'
Vue.use(Vuex)
import Axios from 'axios'
window.axios = Axios;
window.Event = new Vue();
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
// import { Bar, Line } from 'vue-chartjs';
import bar_chart from './components/charts/bar_chart';
import line_chart from './components/charts/line_chart';
import line_chart2 from './components/charts/line_chart2';
import pie_chart from './components/charts/pie_chart';
import operator_bar_chart from './components/charts/operator/operator_bar_chart';
import operator_pie_chart from './components/charts/operator/operator_pie_chart';
import operator_line_chart from './components/charts/operator/operator_line_chart';
import year_choose from './components/charts/operator/year_choose'
import sp_year_choose from './components/charts/operator/sp_year_choose'
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
import operator_sp_bar from './components/charts/operator/operator_sp_bar';

// import "../../node_modules/select2/dist/js/select2.min.js";
// import "../../node_modules/select2/dist/css/select2.min.css";

Vue.component('date-picker', VuePersianDatetimePicker);

Vue.component('year_choose', year_choose);

const store = new Vuex.Store({
    state: {
        selected_year: '',
        sp_selected_year: '',
        Bardatacollection: '',
        Spdatacollection: '',
        Linedatacollection: '',
        Piedatacollection: {
            labels: ['نتایج  1', 'نتایج  2', 'نتایج  3', 'نتایج  4', 'نتایج  5'],
            datasets: [{
                backgroundColor: ['rgba(255, 10 ,10, 0.4)', 'rgba(255, 180,20, 0.4)', 'rgba(100, 100,155, 0.4)', 'rgba(100, 100,255, 0.4)', 'rgba(0, 255,0, 0.4)'],
                data: [7, 5, 12, 8, 4],
            }]
        }
    },
    mutations: {
        get_this_year(state) {
            Axios.get('functions.php?f=get_this_year')
                .then(response => {
                    state.selected_year = response.data;
                })
                .catch(error => {
                    console.log(error.data);
                })
        },
        change_year(state, payload) {
            state.selected_year = payload;
            var data = {
                year: payload,
                agent_number: agent_number
            }
            Axios.get('functions.php?f=get_bar_data&year=' + payload + '&agent_number=' + agent_number)
                .then(response => {
                    state.Bardatacollection = response.data;
                    Event.$emit('refreshbar');
                })
                .catch(error => {
                    console.log(error);
                })
        },
        sp_change_year(state, payload) {
            state.sp_selected_year = payload;
            var data = {
                year: payload,
                agent_number: agent_number
            }
            Axios.get('functions.php?f=sp_get_bar_data&year=' + payload + '&agent_number=' + agent_number)
                .then(response => {
                    state.Spdatacollection = response.data;
                    Event.$emit('refreshspbar');
                })
                .catch(error => {
                    console.log(error);
                })
        },
        create_line(state, payload) {
            Axios.post('functions.php?f=create_line&year=' + payload.year + '&month=' + payload.month + '&agent_number=' + payload.agent_number)
                .then(response => {
                    state.Linedatacollection = response.data;
                    Event.$emit('refreshline');
                })
                .catch(error => {
                    console.log(error.data);
                })
        }
    }
})


const chart = new Vue({
    el: '#charts',
    store: store,
    data: {
        date_time: '',
        bar_chart_data: {},
        sp_bar_chart_data: {},
        year: year,
        month: month,
        agent_number: agent_number

    },
    components: {
        'bar_chart': bar_chart,
        'line_chart': line_chart,
        'line_chart2': line_chart2,
        'pie_chart': pie_chart,
        'operator_bar_chart': operator_bar_chart,
        'operator_pie_chart': operator_pie_chart,
        'operator_line_chart': operator_line_chart,
        'operator_sp_bar': operator_sp_bar,
        'sp_year_choose': sp_year_choose
    },
    methods: {
        refreshpiebar() {
            var data = {
                date_time: document.getElementById("date_time").value,
                agent_number: agent_number
            }
            Axios.post('functions.php?f=get_pie_data&date_time=' + document.getElementById("date_time").value + '&agent_number=' + agent_number)
                .then(response => {
                    this.$store.state.Piedatacollection.datasets[0].data = response.data['chart'];
                    Event.$emit('refreshpie');
                    if (response.data['empty']) {
                        toastr.info('داده ای برای این بازه زمانی یافت نشد!')
                            // toastr('داده ای برای این بازه زمانی یافت نشد.' );
                    }
                })
                .catch(error => {
                    console.log(error.data);
                });
        },
        datepiker_change() {
            var data = {
                year: this.year,
                month: this.month,
                agent_number: this.agent_number
            }
            this.$store.commit('create_line', data);
        }
    },
    created() {
        this.$store.commit('get_this_year');
        Axios.get('functions.php?f=get_pie_data&date_time=no_set&agent_number=' + agent_number)
            .then(response => {
                this.$store.state.Piedatacollection.datasets[0].data = response.data['chart'];
                this.date_time = response.data['date_time'];
                document.getElementById('date_time').value = response.data['date_time'];
                Event.$emit('refreshpie');
            })
            .catch(error => {
                console.log(error.data);
            });
        Axios.get('functions.php?f=chart&agent_number=' + agent_number)
            .then(response => {
                this.bar_chart_data = response.data;
                this.$store.state.Bardatacollection = response.data;
                Event.$emit('refreshbar');
            })
            .catch(error => {
                console.log(error.data);
            });

        Axios.get('functions.php?f=sp_chart&agent_number=' + agent_number)
            .then(response => {
                this.sp_bar_chart_data = response.data;
                this.$store.state.Spdatacollection = response.data;
                Event.$emit('refreshspbar');
            })
            .catch(error => {
                console.log(error.data);
            });

        var data = {
            year: this.year,
            month: this.month,
            agent_number: this.agent_number
        }
        this.$store.commit('create_line', data);
    }
});