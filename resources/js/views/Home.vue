<template>
    <div class="md:px-24 md:p-9 grid md:grid-cols-2 grid-cols-1">
        
        <div class="flex flex-col gap-4">
            <template v-for="(_new, i) in news.data">
                <CardNews :key="i" :data="_new" />
            </template>
            <div class="w-full flex gap-6" v-if="news.meta">
                <button 
                    :disabled="isFirst"
                    :class="{'!bg-gray-500 !ring-0': isFirst}"
                    class="btn btn-blue !rounded-full" 
                    @click="prev"
                >
                    <Icon icon="dashicons:arrow-left-alt2" />
                </button>
                <button 
                    :disabled="isLast"
                    :class="{'!bg-gray-500 !ring-0': isLast}"
                    class="btn btn-blue !rounded-full" 
                    @click="next"
                >
                    <Icon icon="dashicons:arrow-right-alt2" />
                </button>
            </div>
        </div>
        <div class="md:px-12 py-6 md:order-last order-first">
            <div class="shadow bg-gray-100 p-4 flex flex-col gap-2">
                <h1 class="text-gray-600 p-5">Search News by Title</h1>
                <input v-model="search" type="text" class="outline-none rounded border p-2 w-full" placeholder="Search News">
                <button 
                    :disabled="isLoading"
                    @click="getNews" 
                    class="w-1/4  rounded py-1.5 px-4 bg-blue-500 text-white ring-blue-500 hover:bg-blue-600 ring-2 active:ring-1">
                    <span v-if="isLoading">
                        loading ...
                    </span>
                    <span v-else>Search</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import CardNews from "./../components/CardNews.vue"
import { Icon } from '@iconify/vue2';
export default {
    components:{
        Icon,
        CardNews
    },
    computed: {
        news() {    
            return this.$store.state.news.dataNews
        },
        isLast() {

            return this.news.meta.current_page >= this.news.meta.last_page 
        },
        isFirst() {

            return this.news.meta.current_page == 1
        }
    },
    data: ()=>({
        search: '',
        isLoading: false
    }),
    methods: {
        next(){
            this.news.meta.current_page+=1
            this.getNews()
        },
        prev(){
            this.news.meta.current_page-=1
            this.getNews()
        },
        getNews(){
            if (!this.isLoading){
                this.isLoading=true
                let page = this.news.meta ? this.news.meta .current_page : 1
                this.$store.dispatch(
                    "news/get", 
                    {
                        search: this.search,
                        page: page
                    }
                )
                    .catch(()=>{})
                    .then(()=> this.isLoading=false)
            }
        },
    },
    created() {
        this.getNews()
    }
}
</script>