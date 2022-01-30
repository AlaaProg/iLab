<template>
    <div class="block">
        <div class="p-4 flex items-center">
            <button class="btn btn-blue !py-1.5" @click="showDialog=true">
                Create
            </button>
            <div class="flex-1"></div>
        </div>
        <template v-if="showDialog">
            <Dialog>
                <h1 class="text-xl p-4">Form News</h1>
                <NewsForm 
                    ref="form"
                    :errors="errors"
                    :current="currentNews" 
                    @submit="submit" @close-dialog="close" 
                    :loading="isLoading"
                />
            </Dialog>
        </template>

        <template v-if="isLoading">
            <Dialog>
                <h1>Loading .. .. . . .</h1>
            </Dialog>
        </template>


        <!-- {{ dataNews }} -->
        <DataTable 
            @next="next"
            @prev="prev"
            @search="filterData"
            @delete="remove"
            @update="edit"
            :columns="columns"
            :data="dataNews"
        >
            <template v-slot:title="{row}">
                <p class="truncate ">
                    {{ row.title }}
                </p>
            </template>
            <template v-slot:text="{row}">
                <p class="truncate ">
                    {{ row.text }}
                </p>
            </template>
            <template v-slot:image="{row}">
                <img :src="`/storage/${row.image}`" class="w-10 h-10">
            </template>
        </DataTable>
    </div>
</template>


<script>
import DataTable from "../../components/DataTable.vue"
import NewsForm from "../../components/forms/newsForm.vue"
import Dialog from "../../components/Dialog.vue"
import { Icon } from '@iconify/vue2';
export default {
    components:{
        Icon,
        DataTable,
        Dialog,
        NewsForm
    },

    data(){
        return {
            columns: [
                {text:'#', name:'id', classes: 'w-4'},
                {text:'Title', name:'title', classes: 'w-45'},
                {text:'Text', name:'text', classes: 'w-15'},
                {text:'image', name:'image', classes: 'w-24'},
            ],
            errors: {},
            showDialog: false,
            isLoading: false,
            filter: {
                search: ''
            }
        }
    },
    computed:{
        currentNews(){

            return this.$store.state.newses.current
        },
        dataNews() {

            return this.$store.state.newses.data
        }
    },
    methods:{
        next(){
            this.data.meta.current_page+=1
            this.getAll()
        },
        prev(){
            this.data.meta.current_page-=1
            this.getAll()
        },

        submit() {
            this.isLoading=true
            let fd = new FormData(this.$refs.form.$el)

            if (this.currentNews.id) {

                this.$store.dispatch("newses/update", {
                    formData: fd,
                    id: this.currentNews.id
                }).then( ()=>{
                    this.isLoading=false
                    alert("Succesufly update !!")
                }).catch(()=>{
                    try {
                        this.errors = err.response.data.errors
                    } catch (error) {
                        this.errors = {
                            "message": ['Opps Server errors']
                        }
                    }
                })
            } else {
                this.$store.dispatch("newses/create", fd)
                    .then( ()=>{
                        this.isLoading=false
                        this.$refs.form.reset()
                        alert("Succesufly Create !!")
                        this.close()
                    }).catch( err=>{
                        this.isLoading=false
                        try {
                            this.errors = err.response.data.errors
                        } catch (error) {
                            this.errors = {
                                "message": ['Opps Server errors']
                            }
                        }
                    })
            }
        },
        close(){
            this.showDialog=false
            this.$refs.form.$el.reset()
            this.$store.commit("newses/SET_CURRENT_NEWS", {})
        },
        filterData(search="") {
            this.filter.search = search
            this.getAll()
        },
        edit(current) {
            this.isLoading=true
            this.$store.dispatch("newses/get", current.id)
                .then(()=>{
                    this.showDialog=true
                    this.isLoading=false
                })
        },
        remove(current) {
            this.isLoading=true
            this.$store.dispatch("newses/delete", current)
                .then(()=>{
                    this.isLoading = false
                })
        },
        getAll() {
            if (!this.isLoading){
                this.isLoading=true
                let page = this.dataNews.meta ? this.dataNews.meta .current_page : 1
                this.filter = {...this.filter, page: page}
                this.$store.dispatch("newses/all", this.filter)
                    .then(()=>{
                        this.isLoading = false
                    })
            }
        }
    },
    created() {
        this.getAll()
    }
}
</script>