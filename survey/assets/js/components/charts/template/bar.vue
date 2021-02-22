
<script>
    import { Bar } from 'vue-chartjs'

    export default {
        extends: Bar,
        props: {
            chartdata: {
                type: Object,
                default: null
            },
            options: {
                type: Object,
                default: null
            }
        },
        methods : {
            chart_render_bar(){
                // this.renderChart(this.chartdata, this.options);
                console.log('bar rendered!');
            }
        },
        mounted () {
            this.renderChart(this.chartdata, this.options);
        }
    }
</script>
