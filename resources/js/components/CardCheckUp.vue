<template>
    <div class="flex shadow rounded p-4 items-start gap-6 card-checkup">
        <div class="w-10/12">
            <h1 class="text-lg font-semibold capitalize">
                {{ data.lab.name }}
            </h1>
            <h1 class="text-gray-400 -mt-1 text-sm font-semibold">
                {{ data.created_at|moment }}
            </h1>
            <p class="text-gray-500 py-2 truncate notes-text">
                {{ data.notes }}
            </p>
        </div>
        <a :href="`storage/${data.file}`" target="_blank" class="btn btn-blue">
            <Icon icon="akar-icons:download" />
        </a>
    </div>
</template>


<script>
import { Icon } from '@iconify/vue2';
export default {
    components:{
        Icon, 
    },
    props: ['data'],
}
</script>


<style scoped>
.card-checkup:hover .notes-text {
    @apply whitespace-normal overflow-visible 
}
</style>