
<script>
    // MonthlyIncome.vue
    import { Pie } from 'vue-chartjs'

    export default {
        extends: Pie,
        data() {
            return {
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            }
        },
        created(){
            Event.$on('refreshpie' , ()  => {
                this.renderChart(this.$store.state.Piedatacollection, this.options);
            })
            Event.$on('get_pie_data' , ()  => {
                var  date_time = document.getElementById('date_time').value;
                console.log(date_time)
                this.$store.commit('create_pie' , date_time );
            })
        },
        mounted(){
            this.renderChart(this.$store.state.Piedatacollection, this.options);
        }
    }
</script>

<style scoped>

</style>