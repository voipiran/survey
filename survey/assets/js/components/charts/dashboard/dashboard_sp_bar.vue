
<script>
    // MonthlyIncome.vue
    import { Bar } from 'vue-chartjs'
    Chart.defaults.global.defaultFontFamily = 'irsns';
    export default {
        extends: Bar,
        data() {
            return {
                options :  {
                    scales: {
                        yAxes: [{
                            ticks: {
                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    return value+'%';
                                }
                            }
                        }]
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var label = data.datasets[tooltipItem.datasetIndex].label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += Math.round(tooltipItem.yLabel * 100) / 100;
                                return label+' درصد';
                            }
                        }
                    }
                }
            }
        },
        created(){
            Event.$on('refreshspbar' , ()  => {
                this.renderChart(this.$store.state.SpBardatacollection, this.options)
            })
        },
        mounted(){
            this.renderChart(this.$store.state.SpBardatacollection, this.options)
        }
    }
</script>

<style scoped>
</style>