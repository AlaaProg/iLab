<template>
    <div :class="{fullscreen: isFullscreen}">
        <template v-if="isFullscreen">
            <button @click="isFullscreen=false" class="fixed bottom-10 right-20 bg-blue-500 text-white rounded-full p-4">
                <Icon icon="fa:close"/>
            </button>
        </template>
        <div class="w-full rounded-lg p-1 " :class="{'hover:shadow-lg': !isFullscreen}">
            <img 
                :src="`storage/${data.image}`" 
                alt="" 
                class="w-full  object-cover border shadow-sm rounded-lg"
                :class="{'h-52': !isFullscreen}"
            >
            <div class="py-4 px-2">
            <h1 class="text-gray-500 text-sm ">
                {{ data.created_at| moment }}
            </h1>
            <a class="text-lg cursor-pointer text-gray-700 hover:underline font-semibold" @click="isFullscreen=true">
                {{ data.title }}
            </a>
            <div class="pt-2 text-gray-600">
                <p :class="{'whitespace-nowrap truncate': !isFullscreen}">
                    {{ data.text }}
                </p>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Icon } from '@iconify/vue2';
export default {
    components:{
        Icon
    },
    props: ["data"],
    data: ()=>({
        isFullscreen: false
    })
}
</script>

<style scoped>
.fullscreen {
    @apply fixed overflow-y-scroll left-0 top-0 bg-white w-full h-full p-12 ;
}
</style>