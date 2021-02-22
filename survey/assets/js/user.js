import Vue from "vue";
import Axios from "axios";
import swal from "sweetalert2";

const app = new Vue({
  el: "#app",
  methods: {
    async distroy(id) {
      try {
        let confirm = false;
        await swal
          .fire({
            title: "",
            text: "از حذف این مورد اطمینان دارید؟",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ff0000",
            cancelButtonColor: "dodgerBlue",
            confirmButtonText: "بله حذف کن",
            cancelButtonText: "خیر",
          })
          .then((result) => {
            if (result.value) {
              confirm = true;
            }
          });

        if (confirm) {
          swal.showLoading();

          let data = {
            method: "destroyUser",
            id    : id,
            _token: token,
          };
          let res = await Axios.post("functions.php", data);
          swal.fire({
            text             : "کاربر با موفقیت حذف شد.",
            allowEnterKey    : false,
            allowEscapeKey   : false,
            allowOutsideClick: false,
            showConfirmButton: false,
            icon             : 'success'
          });
          setTimeout(() => {
            location.reload();
          }, 1500);
        }
      } catch (error) {
        console.log(error);
        swal.fire("", "متاسفانه خطایی هنگام حذف رخ داده است.", "error");
      }
    },
  },
});
