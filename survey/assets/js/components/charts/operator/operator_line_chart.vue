
<script>
    import { Line } from 'vue-chartjs'
    Chart.defaults.global.defaultFontFamily = 'irsns';

    export default {
        extends: Line,
        data(){
            return{
                chartdata : {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [
                        {
                            label: 'Data One',
                            backgroundColor: '#f87979',
                            data: [40, 39, 10, 40, 39, 80, 40]
                        }
                    ]
                },
                options :  {
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
                                return label;
                            },
                            title : function (tooltipItem , data) {
                                return ' روز '+tooltipItem[0].xLabel + ' ام ';
                            }
                        }
                    }
                }
            }
        },
        created(){
            Event.$on('refreshline' , ()  => {
                this.renderChart(this.$store.state.Linedatacollection, this.options);
            })
        },
        mounted(){
            this.renderChart(this.$store.state.Linedatacollection, this.options)
        }
    }
</script>