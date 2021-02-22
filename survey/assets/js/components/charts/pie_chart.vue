
<script>
    // MonthlyIncome.vue
    import { Pie } from 'vue-chartjs'

    export default {
        extends: Pie,
        data() {
            return {
                datacollection: {
                    labels: [ 'نمودار نظرسنجی 1' ,  'نمودار نظرسنجی 2' , 'نمودار نظرسنجی 3' , 'نمودار نظرسنجی 4'],
                    datasets: [
                        {
                            backgroundColor: ['rgba(255, 255 ,10, 0.4)' ,'rgba(120, 100,200, 0.4)','rgba(30, 180,80, 0.4)','rgba(200, 20,20, 0.4)'],
                            data: [90 , 20 , 70 , 100 ],
                        }
                    ]
                }
            }
        },
        mounted(){
            this.renderChart(this.datacollection, {responsive: true, maintainAspectRatio: false})
        }
    }
</script>

<style scoped>

</style>