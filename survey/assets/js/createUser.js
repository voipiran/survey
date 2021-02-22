import Vue from "vue";
import Multiselect from "vue-multiselect";

// register globally
Vue.component("multiselect", Multiselect);

const app = new Vue({
  el: "#app",
  data: {
    queue: null,
    queues : [8005]
  },
  mounted(){
      this.queues = queues;
      if(queue){
        this.queue = queue;
      }
  }
});
