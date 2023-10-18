// import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from "axios";

import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

axios.defaults.baseURL = import.meta.env.VITE_BASE_API_URL;

const vuetify = createVuetify({
    components,
    directives,
})

const app = createApp(App)

app.use(router)
app.use(vuetify)

app.mount('#app')
