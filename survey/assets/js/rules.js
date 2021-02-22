import Vue from 'vue';
import { Modal, VoerroModal } from '@voerro/vue-modal';

Vue.component('modal', Modal);
window.VoerroModal = VoerroModal;

const app = new Vue({
    el : '#rules' , 
    methods: {
        show(){
            VoerroModal.show('rules-modal');

        },
        hide(){
            VoerroModal.hide('rules-modal');
        }
    }
});