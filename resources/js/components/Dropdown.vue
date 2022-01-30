<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="relative inline-block text-left">
        <div>
            <button @click="show=!show" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="menu-button" aria-expanded="true" aria-haspopup="true">
                <slot>
                    {{ text }}
                </slot>
                <!-- Heroicon name: solid/chevron-down -->
                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>


        <template v-if="show">
            <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                <div class="py-1" role="none">
                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                    <template v-for="(item, i) in items">
                        <slot :name="item.text">
                            <router-link 
                                :key="i" 
                                :to="item.to"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 capitalize"
                                :class="item.classes"
                            >
                                {{ item.text }}
                            </router-link>
                        </slot>
                    </template>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
export default {
    data: ()=>({
        show: false
    }),
    props: ['items', 'text']
}
</script>