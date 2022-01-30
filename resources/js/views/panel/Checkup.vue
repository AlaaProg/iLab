<template>
    <div class="block ">
        <div class="p-4 flex items-center">
            <button class="btn btn-blue !py-1.5" @click="showDialog=true">
                Create
            </button>
            <div class="flex-1"></div>
        </div>
        <template v-if="showDialog">
            <Dialog>
                <h1 class="text-xl p-4">Form Checkup</h1>
                <CheckUPForm 
                    ref="form"
                    :errors="errors"
                    :current="currentCheckup" 
                    @submit="submit" 
                    @close-dialog="close" 
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
            :data="dataCheckup"
        >
            <template v-slot:notes="{row}">
                <p class="truncate">
                    {{ row.notes }}
                </p>
            </template>
            <template v-slot:lab="{row}">
                {{ row.lab.name }}
            </template>
            <template v-slot:sick="{row}">
                {{ row.sick.name }}
            </template>
            <template v-slot:file="{row}">
                <a :href="`/storage/${row.file}`">
                    <Icon icon="akar-icons:download" class="text-xl" />
                </a>
            </template>
        </DataTable>
    </div>
</template>


<script>
import DataTable from "../../components/DataTable.vue"
import CheckUPForm from "../../components/forms/CheckUPForm.vue"
import Dialog from "../../components/Dialog.vue"
import { Icon } from '@iconify/vue2';
export default {
    components:{
        Icon,
        DataTable,
        Dialog,
        CheckUPForm
    },

    data(){
        return {
            columns: [
                {text:'#', name:'id', classes: 'w-4'},
                {text:'Sick', name:'sick', classes: 'w-45'},
                {text:'Lab', name:'lab', classes: 'w-45'},
                {text:'Notes', name:'notes', classes: 'w-15'},
                {text:'File', name:'file', classes: 'w-24'},
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
        currentCheckup(){

            return this.$store.state.checkup.current
        },
        dataCheckup() {

            return this.$store.state.checkup.data
        }
    },
    methods:{
        next(){
            this.dataCheckup.meta.current_page+=1
            this.getAll()
        },
        prev(){
            this.dataCheckup.meta.current_page-=1
            this.getAll()
        },

        submit() {
            this.isLoading=true
            let fd = new FormData(this.$refs.form.$el)

            if (this.currentCheckup.id) {

                this.$store.dispatch("checkup/update", {
                    formData: fd,
                    id: this.currentCheckup.id
                }).then( ()=>{
                    this.isLoading=false
                    alert("Succesufly update !!")
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
            } else {
                this.$store.dispatch("checkup/create", fd)
                    .then( ()=>{
                        this.isLoading=false
                        this.$refs.form.$el.reset()
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
            this.$store.commit("checkup/SET_CURRENT", {lab: {},sick: {},})
        },
        filterData(search="") {
            this.filter.search = search
            this.getAll()
        },
        edit(current) {
            this.isLoading=true
            this.$store.dispatch("checkup/get", current.id)
                .then(()=>{
                    this.showDialog=true
                    this.isLoading=false
                })
        },
        remove(current) {
            this.isLoading=true
            this.$store.dispatch("checkup/delete", current)
                .then(()=>{
                    this.isLoading = false
                })
        },
        getAll() {
            if (!this.isLoading){
                this.isLoading=true
                let page = this.dataCheckup.meta ? this.dataCheckup.meta .current_page : 1
                this.filter = {...this.filter, page: page}
                this.$store.dispatch("checkup/all", this.filter)
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