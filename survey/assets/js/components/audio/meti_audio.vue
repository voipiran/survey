<template >
  <center>
    <a class="play-btn" @click="show()" style="width:33px;height:33px;margin:0;cursor:pointer"></a>
    <modal :id="modal_name" v-cloak>
      <template slot="title">{{title}}</template>
      <div slot="body">
        <a :href="src" target="_self">
          <img :src="download_path" style=";width:42px;cursor:pointer;" />
        </a>
        <!-- <audio :src="src" controls ></audio> -->
        <img :src="forward_path" @click="forward()" style=";width:42px;cursor:pointer;" />
        <img :src="stop_path" @click="stop()" style=";width:42px;cursor:pointer;" />
        <img :src="play_path" @click="play()" v-if="!playing" style=";width:42px;cursor:pointer;" />
        <img :src="pause_path" @click="pause()" v-if="playing" style=";width:42px;cursor:pointer;" />
        <img :src="backward_path" @click="backward()" style=";width:42px;cursor:pointer;" />
      </div>
      <div slot="footer">footer here</div>
    </modal>
  </center>
</template>

<script>
import { Howl, Howler } from "howler";
var src;
var sound = new Howl({
  src: [
    "http://localhost/phone_php/core/survey/voices/survey-5d7518e141e24.mp3"
  ],
  autoplay: false,
  loop: false,
  volume: 0.5,
  orientation: [1],
  onend: function() {
    console.log("Finished!");
  }
});

export default {
  props: [
    "src",
    "play_path",
    "modal_name",
    "title",
    "pause_path",
    "stop_path",
    "forward_path",
    "backward_path",
    "download_path"
  ],
  data() {
    return {
      time: 0,
      length: 0,
      player: null,
      playing: false
    };
  },
  methods: {
    play() {
      sound.play();
      this.playing = true;
    },
    seek_next() {
      console.log(sound.seek());
      sound.seek(sound.seek() + 50);
    },
    pause() {
      this.playing = false;
      sound.pause();
    },
    stop() {
      sound.stop();
      this.playing = false;
    },
    forward() {},
    backward() {},
    show() {
      VoerroModal.show(this.modal_name);
    }
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
  box-shadow: 0px 0px 25px 3px rgba(255, 0, 128, 0.8);
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
</style>