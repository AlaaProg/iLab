<template>
    <div class="flex min-h-screen">
        <div class="w-full h-full fixed top-0 left-0 bg-gray-50 -z-50"></div>
        <Sidenav />
        <div class="w-full p-24 bg-gray-50">
            <div class="bg-white rounded-xl s shadow p-8 h-full">
                <router-view></router-view>
            </div>
        </div> 
    </div>
</template>


<script>

import Sidenav from "../../components/Sidenav.vue"
import { Icon } from '@iconify/vue2';
export default {
    components:{
        Icon,
        Sidenav
    },

    data(){
        return {

        }
    }
}
</script>