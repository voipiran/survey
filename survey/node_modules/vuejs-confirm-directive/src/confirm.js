import Vue from 'vue';
import axios from 'axios';

var VueConfirm = Vue.directive('confirm', {
  inserted(el, binding) {
    // if no reload and callback not give, throw error
    if (typeof binding.modifiers.reload == 'undefined'
      && typeof binding.value.callback == 'undefined') {
      throw "A callback should be defined if reload is turned off."
    }

    el.addEventListener('click', () => {
      var confirm = window.confirm(binding.value.message);

      if (confirm === true) {
        var data = {};

        // check for data
        if (binding.value.data != null && binding.value.data != '') {
          data = binding.value.data;
        }

        axios.post(binding.value.link, data).then(response => {
          if (binding.modifiers.reload && binding.modifiers.reload === true) {
            location.reload();
          } else {
            if (isFunction(binding.value.callback)) {
              binding.value.callback(response);
            }
          }
        });
      }
    });
  }
});

function isFunction(functionToCheck) {
  return functionToCheck && {}.toString.call(functionToCheck) === '[object Function]';
 }

export default VueConfirm;
