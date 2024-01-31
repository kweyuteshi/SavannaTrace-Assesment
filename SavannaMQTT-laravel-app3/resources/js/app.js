import './bootstrap';


import {createApp} from 'vue/dist/vue.esm-bundler.js';
import IpAddress from "./components/IpAddress.vue";

const app = createApp({
    components: {
        'ip-address':IpAddress,
    },
});

app.mount("#app");