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
              return label;
            }
          }
        },
        type: Object,
        default: null
      }
    };
  },
  created() {
    Event.$on("refreshbar", () => {
      this.renderChart(this.$store.state.Bardatacollection, this.options);
    });
  },
  mounted() {
    this.renderChart(this.chartdata, this.options);
  }
};
</script>