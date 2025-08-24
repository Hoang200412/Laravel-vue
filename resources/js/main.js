import { createApp, markRaw } from "vue";
import App from "./App.vue";
import router from "./router/index.js";
import { Drawer, List, Menu, Button, message, Table, Card, Avatar, Select, Input, Upload, Alert, Dropdown, Radio, Modal } from "ant-design-vue";
import { createPinia } from "pinia";
import axios from 'axios';

import 'ant-design-vue/dist/reset.css';
// import 'bootstrap/dist/css/bootstrap-grid.min.css' ;
// import 'bootstrap/dist/css/bootstrap-utilities.min.css';
import 'bootstrap/dist/js/bootstrap.min.js';
import 'bootstrap/dist/css/bootstrap.min.css';

const pinia = createPinia();

pinia.use(({ store }) => {
  store.router = markRaw(router);
});
window.axios = axios;
const app = createApp(App);
app.use(router);
app.use(pinia);
app.use(Button);
app.use(Drawer);
app.use(List);
app.use(Menu);
app.use(Table);
app.use(Card);
app.use(Select);
app.use(Avatar);
app.use(Input);
app.use(Upload);
app.use(Alert);
app.use(Dropdown);
app.use(Radio);
app.mount("#app");
app.config.globalProperties.$message = message;