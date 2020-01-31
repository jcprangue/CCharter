<template>
    <div class="wrapper">
        <navigation></navigation>
        <sidenav></sidenav>
        <div class="container-fluid h-100">
            
           <router-view></router-view>
       </div>
    </div>
</template>
<script>
import Nav from '../layout/navigation.vue';
import sidenav from '../layout/sidenav.vue'
import main from '../layout/main.vue'
export default {
    components:{
        'navigation': Nav,
        'sidenav': sidenav,
        'maincontent': main,
    }
}
</script>