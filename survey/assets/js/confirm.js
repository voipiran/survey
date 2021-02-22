
import VueSweetAlert from 'vue-sweetalert'
Vue.use(VueSweetAlert)

new Vue({
    el: '#confirm',
    methods: {
        clickHandler() {
            this.$swal('hello')
        }
    }
})
