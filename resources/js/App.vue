<template>
    <div class="h-full block">
        <Navbar  class="fixed" />
        
        <div class="min-h-full pt-12 ">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Navbar from "./components/Navbar.vue"
import SideNav from "./components/Sidenav.vue"
export default {
    components:{
        SideNav,
        Navbar
    }
}
</script>