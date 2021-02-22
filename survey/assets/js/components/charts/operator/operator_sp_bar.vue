<script>
import { Bar } from "vue-chartjs";

export default {
  extends: Bar,
  props: {
    chartdata: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      options: {
        scales: {
          yAxes: [
            {
              ticks: {
                // Include a dollar sign in the ticks
                callback: function(value, index, values) {
                  return value + "%";
                }
              }
            }
          ]
        },
        responsive: true,
        maintainAspectRatio: false,
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
              var label = data.datasets[tooltipItem.datasetIndex].label || "";
              if (label) {
                label += ": ";
              }
              label += Math.round(tooltipItem.yLabel * 100) / 100;
              return label+' درصد';
            }
          }
        },
        type: Object,
        default: null
      }
    };
  },
  created() {
    Event.$on("refreshspbar", () => {
      this.renderChart(this.$store.state.Spdatacollection, this.options);
    });
  },
  mounted() {
    this.renderChart(this.chartdata, this.options);
  }
};
</script>