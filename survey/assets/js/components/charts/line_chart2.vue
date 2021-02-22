
<script>
    // MonthlyIncome.vue
    import { Line } from 'vue-chartjs'

    export default {
        extends: Line,
        data() {
            return {
                datacollection: {
                    labels: ['فروردین' , 'اردیبهشت' , 'خرداد' , 'تیر' , 'مرداد' , 'شهریور' , 'مهر' , 'آبان' , 'آذر' , 'دی' , 'بهمن' , 'اسفند' , ],
                    datasets: [
                        {
                            label: 'نمودار نظرسنجی ',
                            backgroundColor: 'rgba(20, 0,255, 0.4)',
                            data: [40 , 128 , 34 , 20, 50 , 90 , 40, 80 , 27 , 20, 88 , 90],
                            fill : 'origin'
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