
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
                            label: 'نمودار نظرسنجی 1',
                            backgroundColor: 'rgba(120, 180,20, 0.4)',
                            data: [40 , 128 , 34 , 20, 50 , 90 , 40, 80 , 27 , 20, 88 , 90],
                            fill : 1
                        },
                        {
                            label: 'نمودار نظرسنجی 2',
                            backgroundColor: 'rgba(20, 200, 88, 0.4)',
                            data: [40, 128 , 20 , 55, 88 , 90 , 11, 33 , 27 , 78, 88 , 90],
                            fill : 1
                        },
                        {
                            label: ' نمودار نظرسنجی 3',
                            backgroundColor: 'rgba(150, 68, 188, 0.4)',
                            data: [31, 12 , 48 , 22, 50 , 113 , 97, 80 , 13 , 20, 22 , 12],
                            fill : 2
                        }
                    ] ,
                    options : [
                        {
                            width  : '400' ,
                            height : '200',
                            title: {
                                display: true,
                                text: 'Custom Chart Title'
                            }

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