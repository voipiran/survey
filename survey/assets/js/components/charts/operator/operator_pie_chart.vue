
<script>
    // MonthlyIncome.vue
    import { Pie } from 'vue-chartjs'
    import Axios from 'axios'

    export default {
        extends: Pie,
        props : [ 'when-refresh' ],
        computed : {
            datacollection(){
                return this.$store.state.Piedatacollection;
            }
        },
        events: {
            refreshpie: function() {
                this.renderChart(this.datacollection, {responsive: true, maintainAspectRatio: false});
            },
            get_pie_data: function() {
                var data = {
                    date_time    : document.getElementById("date_time").value,
                    agent_number : agent_number
                }
                Axios.post('functions.php?f=get_pie_data&date_time='+document.getElementById("date_time").value+ '&agent_number='+agent_number )
                    .then(response => {
                        this.$store.state.Piedatacollection.datasets[0].data = response.data['chart'];
                        Event.$emit('refreshpie');
                        if( response.data['empty']){
                            toastr.info('داده ای برای این بازه زمانی یافت نشد!')
                            // toastr('داده ای برای این بازه زمانی یافت نشد.' );
                        }
                    })
                    .catch(error => {
                        console.log(error.data);
                    });
            }
        },
        created(){
            Event.$on('refreshpie' , ()  => {
                    this.renderChart(this.datacollection, {responsive: true, maintainAspectRatio: false});
                });
            Event.$on('get_pie_data' , ()  => {
                var data = {
                    date_time    : document.getElementById("date_time").value,
                    agent_number : agent_number
                }
                Axios.post('functions.php?f=get_pie_data&date_time='+document.getElementById("date_time").value+ '&agent_number='+agent_number )
                    .then(response => {
                        this.$store.state.Piedatacollection.datasets[0].data = response.data['chart'];
                        Event.$emit('refreshpie');
                        if( response.data['empty']){
                            toastr.info('داده ای برای این بازه زمانی یافت نشد!')
                            // toastr('داده ای برای این بازه زمانی یافت نشد.' );
                        }
                    })
                    .catch(error => {
                        console.log(error.data);
                    });
            });
        },
        mounted(){
            this.renderChart(this.datacollection, {responsive: true, maintainAspectRatio: false})
        }
    }
</script>

<style scoped>

</style>