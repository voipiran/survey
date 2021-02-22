import Vue from "vue";

import VueSweetAlert from "vue-sweetalert";
import axios from "axios";
// import Axios from "axios/index";
import meti_audio from "./components/audio/meti_audio";
import { Modal, VoerroModal } from "@voerro/vue-modal";
import mitismirza from "./components/audio/mitismirza";
import APlayer from "@moefe/vue-aplayer";
Vue.use(APlayer, {
  defaultCover: "https://github.com/u3u.png",
  productionTip: true,
});

Vue.component("modal", Modal);
window.VoerroModal = VoerroModal;

import AudioVisual from "vue-audio-visual";

Vue.use(AudioVisual);
Vue.use(VueSweetAlert);

const app = new Vue({
  el: "#audio",
  // store: store,
  methods: {
    showAudio(id) {
      VoerroModal.show("surveyAudio"+id);
    },
    disableCause() {
      this.$swal(
        "",
        "برای استفاده از این قابلیت لطفا لایسنس با دسترسی کامل را خریداری نمایید.",
        "success"
      );
    },
    clickHandler(id) {
      this.$swal({
        title: "آیا از حذف این مورد اطمینان دارید؟",
        text: "در صورت حذف ، امکان بازیابی وجود نخواهد داشت.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
      }).then((result) => {
        if (result) {
          axios
            .get("delete.php?id=" + id)
            .then((response) => {
              if (response.data == "deleted") {
                this.$swal(
                  "حذف شد!",
                  "رکورد مورد نظر با موفقیت حذف شد.",
                  "success"
                );
                setTimeout(function() {
                  window.location.replace(
                    BASE_PATH + "core/settings/?update=deleted"
                  );
                }, 1000);
              }
            })
            .catch((error) => {
              console.log(error);
            });
        }
      });
    },
    clickHandler_survey(id) {
      this.$swal({
        title: "آیا از حذف این مورد اطمینان دارید؟",
        text: "در صورت حذف ، امکان بازیابی وجود نخواهد داشت.",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "بله",
        cancelButtonText: "خیر",
      }).then((result) => {
        if (result) {
          axios
            .get("delete.php?id=" + id)
            .then((response) => {
              if (response.data == "deleted") {
                this.$swal(
                  "حذف شد!",
                  "رکورد مورد نظر با موفقیت حذف شد.",
                  "success"
                );
                setTimeout(function() {
                  window.location.replace(
                    BASE_PATH + "core/survey/?update=deleted"
                  );
                }, 1000);
              }
            })
            .catch((error) => {
              console.log(error);
            });
        }
      });
    },
  },
  components: {
    meti_audio,
    mitismirza,
  },
});
