<template>
  <div class="chart" id="CanvasChartDiv">
    <canvas ref="devicesChart" id="devicesChart" class="chart-canvas"></canvas>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "result project chart",
      version: 1
    };
  },
  mounted() {
    this.SetUpQuizProjects();
  },
  methods: {
    SetUpQuizProjects() {
      console.log("canvas holder ", this.$refs.devicesChart);
      //   return;
      var ctx = this.$refs.devicesChart.getContext("2d");
      var myChart = new Chart(ctx, {
        type: "doughnut",
        data: {
          labels: ["Correct Answers", "Incorrect Answers"],
          datasets: [
            {
              label: "# of Votes",
              data: [
                this.results.result,
                this.results.total - this.results.result
              ],
              backgroundColor: ["rgb(4, 158, 94)", "rgba(228, 0, 0, 0.97)"],
              borderColor: ["rgb(4, 158, 94)", "rgba(228, 0, 0, 0.97)"],
              borderWidth: 1
            }
          ]
        },
        options: {}
      });
    }
  },
  props: ["results"]
};
</script>
