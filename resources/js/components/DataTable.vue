<template>
    <div class="shadow-md sm:rounded-lg" >
        
        <div class="py-4 px-4">
            <div class="my-4 bg-white shadow p-2 rounded-lg flex items-center w-full gap-6">
                <slot name="filter">
                    <div class="w-full flex">
                        <input type="text" v-model="search" placeholder="Search" class="ring-0 outline-none border w-1/2 py-1 px-2">
                        <button @click="$emit('search', search)" class="border py-1.5 px-2 text-lg hover:bg-blue-500 hover:text-white">
                            <Icon icon="ant-design:search-outlined" />
                        </button>
                    </div>
                </slot>
                <div class="flex-1"></div>
                <template v-if="data.meta">
                    <button 
                        :disabled="isFirst"
                        :class="{'!bg-gray-500 text-gray-400 cursor-not-allowed hover:text-gray-400 !ring-0': isFirst}"
                        @click="$emit('prev')"
                        class="rounded-full ring-1 py-1.5 px-2 text-lg hover:bg-blue-500 hover:text-white"
                    >
                        <Icon icon="dashicons:arrow-left-alt2" />
                    </button>
                    <div class="text-lg border rounded-full px-4">
                        {{ data.meta.current_page }}/{{ data.meta.last_page }}
                    </div>
                    <button 
                        :disabled="isLast"
                        :class="{'!bg-gray-500 text-gray-400 cursor-not-allowed hover:text-gray-400 !ring-0': isLast}"
                        @click="$emit('next')" 
                        class="rounded-full ring-1 py-1.5 px-2 text-lg hover:bg-blue-500 hover:text-white"
                    >
                        <Icon icon="dashicons:arrow-right-alt2" />
                    </button>
                </template>
            </div>
        </div>
        <table class="table-fixed w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <template v-for="(col, i) in columns" >
                        <th 
                            :key="i" 
                            class="column"
                            :class="col.classes"
                        >
                            {{ col.text }}
                        </th>
                    </template>
                    <th class="column w-32">
                       Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <template v-for="(row, i) in data.data">
                    <tr class="row" :key="i">
                        <template v-for="(col, i) in columns">
                            <td :key="i" class="call">
                                <slot :name="col.name" v-bind="{row, col}">
                                    {{ row[col.name] }}
                                </slot>
                            </td>
                        </template>
                        <td class="call flex gap-6 w-32">
                            <slot name="actions" v-bind="row">
                                <button class="text-blue-400 hover:text-blue-600" @click="$emit('update', row)">
                                    Edit
                                </button>
                                <button class="text-red-400 hover:text-red-600" @click="$emit('delete', row)">
                                    Delete
                                </button>
                            </slot>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
import { Icon } from '@iconify/vue2';
export default {
    components:{
        Icon,
    },
    props: {
        columns: {
            type: Array,
            defautl: ()=> []
        },
        data: Object|Array,
    },
    data: ()=>({
        search: ''
    }),
    computed: {
        isLast() {

            return this.data.meta.current_page >= this.data.meta.last_page 
        },
        isFirst() {

            return this.data.meta.current_page == 1
        }
    }
}
</script>

<style scoped>
.column {
    @apply py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400;
}
.row {
    @apply bg-white border-b dark:bg-gray-800 dark:border-gray-700;
}
.call {
    @apply py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white;
}
</style>