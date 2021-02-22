<script>
// MonthlyIncome.vue
import { Bar } from "vue-chartjs";
Chart.defaults.global.defaultFontFamily = "irsns";
export default {
  extends: Bar,
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
            },
          },
        },
      },
    };
  },
  created() {
    Event.$on("refreshbar", () => {
      this.renderChart(this.$store.state.Bardatacollection, this.options);
    });
  },
  mounted() {
    this.renderChart(this.$store.state.Bardatacollection, this.options);
  },
};
</script>

<style scoped></style>
