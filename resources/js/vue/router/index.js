import Vue from 'vue'
import VueRouter from 'vue-router'


// Serch Result
import searchResult from '../pages/result.vue';
import main from '../layout/main.vue';
import charter from '../pages/charter.vue';
import table from '../pages/DataTable.vue';
import paginate from '../pages/paginate.vue';
import event from '../pages/event.vue';
import moment from 'moment'


import axios from 'axios';
import { library } from '@fortawesome/fontawesome-svg-core'
import { 
    faUserSecret, 
    faCalendarWeek,
    faUsers,
    faFile,
    faHome
} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

Vue.filter('FormatMonth', function (value) {
    if (value) {
        return moment(String(value)).format('MMMM')
    }
});
Vue.filter('FormatDate', function (value) {
    if (value) {
        return moment(String(value)).format('DD')
    }
});

Vue.prototype.$http = axios;
// Vue.prototype.$ServerName = "http://192.168.255.18:8001";

library.add(
    faUserSecret,
    faCalendarWeek,
    faUsers,
    faFile,
    faHome
)

Vue.component('icon', FontAwesomeIcon)
Vue.component('CustomTable', table)
Vue.component('paginate', paginate)


Vue.use(VueRouter);
const router = new VueRouter({

    // mode: "history",
    // history: true,
    // hashbag: false,
    routes: [
        { path: '/', component: main, name: 'Main-Panel'},
        { path: '/search-charter/:textsearch', component: searchResult, name: 'Search-Result', props: true},
        { path: '/charter/:id', component: charter, name: 'Charter', props: true},
        { path: '/events', component: event, name: 'event', props: true},
    ]
});

export default router;