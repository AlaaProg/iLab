<template>
    <div class="w-full py-2 border-b px-4 flex items-center z-50 bg-white">
        <router-link to="/" class=" p-2 font-mono text-lg flex items-center gap-2 rounded-3xl px-5 font-semibold  ">
            <Icon icon="medical-icon:i-laboratory" class="text-2xl" />
            iLab 
        </router-link>
        <div class="flex-1"></div>
        <!-- <DropDown text="User" :items="items" /> -->
        <router-link :to="{name:'login'}"  class="btn btn-blue" v-if="!isLogin">
            Log IN
        </router-link>
        <template v-else>
            <DropDown :text="isLoading ? 'looading ...':profile.name" :items="items" >
                <template v-slot:logout>    
                    <a  
                        @click="logout"
                        class="block cursor-pointer px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 capitalize">
                        logout
                    </a>
                </template>
            </DropDown>
        </template>
    </div>
    
</template>

<script>
import DropDown from "./Dropdown.vue"
import { Icon } from '@iconify/vue2';
import { mapState } from "vuex"
export default {
    components:{
        Icon,
        DropDown
    },

    methods: {
        logout() {
            this.$store.dispatch("auth/logout")
            this.$router.push({name: "home"})
        }
    },
    computed:{
        ...mapState('auth', {
            isLoading: state => state.isLoadingProfile,
            profile: state => state.profile,
            isLogin: state => state.isLogin,
        }),
        items() {
            let items = [
                {name:"profile", text: "profile", to: "/me"},
                {name:"logout", text: "logout", to: "/"},
            ]

            if (this.isLogin) {
                switch(this.profile.role) {
                    case 'lab':
                        items.unshift({name:"checkup", text: "check ups", to: "/lab"})
                        break
                    case 'sick':
                        items.unshift({name:"checkup", text: "check ups", to: "/checkup"})
                        break
                    case 'admin':
                        items.unshift({name:"admin", text: "Dashboard", to: "/admin"})
                        break
                }  
            }

            return items 
        }
    },
}
</script>