<template>
  <center>
    <a class="play-btn" @click="show()" style="width:25px;height:25px;margin:0;cursor:pointer"></a>
    <!-- <div v-if="show_audio">
      <aplayer :audio="audio" fixed />
    </div> -->
    <modal :id="modal_name" v-cloak>
      <template slot="title"></template>
      <div slot="body">
        <a :href="src" target="_self" style="display:block" >
          <img :src="download_path" style="width:42px;cursor:pointer;" />
        </a>
        <audio controls>
          <source :src="audio.url" >
        </audio>

        <!-- <aplayer :audio="audio" :preload="none"  /> -->
      </div>
      <!-- <div slot="footer">footer here</div> -->
    </modal>
  </center>
</template>

<script>
export default {
  props: ["title", "modal_name", "src", "download_path", "cover_photo"],
  data() {
    return {
      show_audio: false,
      audio: {
        name: "ViopIran",
        artist: this.title,
        url: this.src,
        cover: this.cover_photo // prettier-ignore
      }
    };
  },
  methods: {
    show() {
    //   this.$emit("stop_audio");
    //   this.show_audio = true;
        VoerroModal.show(this.modal_name);
    }
  },
  mounted() {
    // this.$on("stop_audio", function() {
    //     console.log('audio stoped '+this.modal_name);
    //   this.show_audio = false;
    // });
  }
};
</script>

<style >
.play-btn {
  width: 100px;
  height: 100px;
  background: radial-gradient(
    rgba(255, 0, 128, 0.8) 60%,
    rgba(255, 255, 255, 1) 62%
  );
  border-radius: 50%;
  position: relative;
  display: block;
  margin: 100px auto;
  box-shadow: 0px 0px 5px 3px rgba(255, 0, 128, 0.8);
}

/* triangle */
.play-btn::after {
  content: "";
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translateX(-40%) translateY(-50%);
  transform: translateX(-40%) translateY(-50%);
  transform-origin: center center;
  width: 0;
  height: 0;
  border-top: 5px solid transparent;
  border-bottom: 5px solid transparent;
  border-left: 10px solid #fff;
  z-index: 100;
  -webkit-transition: all 400ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
  transition: all 400ms cubic-bezier(0.55, 0.055, 0.675, 0.19);
}

/* pulse wave */
.play-btn:before {
  content: "";
  position: absolute;
  width: 150%;
  height: 150%;
  -webkit-animation-delay: 0s;
  animation-delay: 0s;
  -webkit-animation: pulsate1 2s;
  animation: pulsate1 2s;
  -webkit-animation-direction: forwards;
  animation-direction: forwards;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
  -webkit-animation-timing-function: steps;
  animation-timing-function: steps;
  opacity: 1;
  border-radius: 50%;
  border: 5px solid rgba(255, 255, 255, 0.75);
  top: -30%;
  left: -30%;
  background: rgba(198, 16, 0, 0);
}

@-webkit-keyframes pulsate1 {
  0% {
    -webkit-transform: scale(0.6);
    transform: scale(0.6);
    opacity: 1;
    box-shadow: inset 0px 0px 25px 3px rgba(255, 255, 255, 0.75),
      0px 0px 25px 10px rgba(255, 255, 255, 0.75);
  }
  100% {
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 0;
    box-shadow: none;
  }
}

@keyframes pulsate1 {
  0% {
    -webkit-transform: scale(0.6);
    transform: scale(0.6);
    opacity: 1;
    box-shadow: inset 0px 0px 25px 3px rgba(255, 255, 255, 0.75),
      0px 0px 25px 10px rgba(255, 255, 255, 0.75);
  }
  100% {
    -webkit-transform: scale(1, 1);
    transform: scale(1);
    opacity: 0;
    box-shadow: none;
  }
}

.aplayer-author{
    font-family:'irsns';
}
</style>