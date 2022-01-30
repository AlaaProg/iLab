<template>
    <div class="bg-gray-900 px-2 xl:w-1/6 lg:w-1/4 w-1/2 hidden md:flex flex-col gap-2 py-8 pt-24 -z-2">
        <router-link 
            :to="{name: 'users'}" 
            class="w-full text-white py-2 px-3 rounded-lg hover:bg-indigo-500 flex text-lg items-center capitalize gap-3"
        >
            <Icon icon="ph:users-three" class="w-8 h-8 "  />
            users
        </router-link>
        <router-link 
            :to="{name: 'news'}" 
            class="w-full text-white py-2 px-3 rounded-lg hover:bg-indigo-500 flex text-lg items-center capitalize gap-3"
        >
            <Icon icon="fluent:news-28-regular" class="w-8 h-8 "  />
            news
        </router-link>
        <router-link 
            :to="{name: 'checkup'}" 
            class="w-full text-white py-2 px-3 rounded-lg hover:bg-indigo-500 flex text-lg items-center capitalize gap-3"
        >
            <Icon icon="tabler:checkup-list" class="w-8 h-8 "  />
            checkups
        </router-link> 
    </div>
</template>

<script>
import { Icon } from '@iconify/vue2';
export default {
    components:{
        Icon
    }
}
</script>


<style scoped>
.router-link-active{
    @apply bg-indigo-500
}
</style>