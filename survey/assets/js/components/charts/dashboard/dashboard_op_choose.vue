<template>
  <div>
    اپراتور :
    <select 
      @change="change($event)"
      style="border-radius: 5px ; padding-left: 5px ; padding-right: 5px"
    >
      <option
        v-for="operator in operators"
        v-bind:value="operator.agent_number"
        v-bind:key="operator.agent_number"
      >{{ operator.agent_name }}</option>
    </select>
  </div>
</template>

<script>
import Axios from "axios";
export default {
  name: "OpChoose",
  methods: {
    change(event) {
      this.$store.commit("create_sp_bar", event.target.value);
    }
  },
  computed : {
      operators(){
          return this.$store.state.operators;
      }
  }
};
</script>