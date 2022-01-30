<template>
    <div class="container mx-auto px-12 p-8 flex flex-col gap-6">
        <div class="w-full bg-white rounded-xl shadow p-4 flex md:flex-row flex-col items-center gap-2 ">
            <div class="flex md:flex-row flex-col gap-2 items-center md:w-1/2">
                <div class="field">
                    <input type="text" placeholder="Search" v-model="search">
                </div>
                <button class="btn btn-blue" @click="getData">
                    <Icon icon="fa:search" />
                </button>
            </div>
        </div>
        <div class="md:w-1/2 w-full">
            <div class="flex flex-col gap-6">
                <template v-for="(checkup, i) in checkups.data">
                    <CardCheckUp :key="i" :data="checkup" />
                </template>
                <template v-if="checkups.data && !checkups.data.length">
                    <h1 class="text-3xl p-6 text-gray-700">You don't have any Check ups</h1>
                </template>
            </div>
            <div class="w-full flex gap-6 py-12" v-if="checkups.meta && checkups.data.length">
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
    </div>
</template>

<script>
import CardCheckUp from "../components/CardCheckUp.vue"
import Dialog from "../components/Dialog.vue"
import CheckUPForm from "../components/forms/CheckUPForm.vue"
import { Icon } from '@iconify/vue2';
import axios from "../axios"
export default {
    components:{
        Icon, 
        CardCheckUp,
        Dialog,
        CheckUPForm
    },
    computed: {
        isLast() {

            return this.checkups.meta.current_page >= this.checkups.meta.last_page 
        },
        isFirst() {

            return this.checkups.meta.current_page == 1
        },
    },
    data:()=>({
        checkups: {},
        search: '',
        showDialog: false
    }),
    methods:{
        next(){
            this.news.meta.current_page+=1
            this.getData()
        },
        prev(){
            this.news.meta.current_page-=1
            this.getData()
        },
        getData() {
            let page = this.checkups.meta ? this.checkups.meta.current_page : 1

            axios.get(`checkups?page=${page}&search=${this.search}`)
                .then( data=>{
                    this.checkups = data.data
                })
        }
    },
    created(){
        this.getData()
    }
}
</script>
