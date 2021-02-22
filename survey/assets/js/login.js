import Vue from "vue";
import Axios from "axios";
import swal from "sweetalert2";

const app = new Vue({
  el: "#app",
  data: {
    userName: null,
    password: null,
  },
  methods: {
    async login() {
      if (!this.userName || !this.password) {
        swal.fire("", "تمامی فیلدها الزامی هستند", "error");
        return;
      }
      try {
        swal.showLoading();
        let data = {
          method: "loginAttempt",
          userName: this.userName,
          password: this.password,
          _token: token,
        };
        let res = await Axios.post("functions.php", data);
        setTimeout(function() {
          location.href = dashboardUrl;
        }, 1000);
      } catch (error) {
        console.log(error);
        swal.fire("", "نام کاربری یا کلمه عبور صحیح نمی باشد.", "error");
        return;
      }

      swal.fire({
        html: "ورود موفقیت آمیز! <br> در حال انتقال به داشبورد...",
        icon: "success",
        showConfirmButton: false,
      });
    },
  },
});
