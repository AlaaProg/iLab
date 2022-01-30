<template>
    <div class="block">
        <div class="p-4 flex items-center">
            <button class="btn btn-blue !py-1.5" @click="showDialog=true">
                Create
            </button>
            <div class="flex-1"></div>
            <div class="w-1/2">
                <div class="field ">
                    <select name="role" v-model="filter.role" @change="getAll">
                        <option value='' selected >All</option>
                        <option value="sick">Sick</option>
                        <option value="admin">Admin</option>
                        <option value="lab">Lab</option>
                    </select>
                </div>
            </div>
           
        </div>

        <template v-if="showDialog">
            <Dialog>
                <h1 class="text-xl p-4">Form User</h1>
                <div>
                    <UserForm
                        ref="form"
                        :errors="errors"
                        :current="currentUser" 
                        @submit="submit" @close-dialog="close" 
                        :loading="isLoading"
                    />   
                </div>
            </Dialog>
        </template>

        <template v-if="isLoading">
            <Dialog>
                <h1>Loading .. .. . . .</h1>
            </Dialog>
        </template>

        <DataTable 
            @next="next"
            @prev="prev"
            @search="filterUsers"
            @delete="deleteUser"
            @update="eidtUser"
            :columns="columns"
            :data="users"
        >
            <template v-slot:created_at="{created_at}">
                {{ created_at|moment }}
            </template>
        </DataTable>
    </div>
</template>


<script>
import DataTable from "../../components/DataTable.vue"
import Dialog from "../../components/Dialog.vue"
import UserForm from "../../components/forms/UserForm.vue"
import { Icon } from '@iconify/vue2';
export default {
    components:{
        Icon,
        DataTable,
        Dialog,
        UserForm
    },

    data(){
        return {
            columns: [
                {text:'#', name:'id'},
                {text:'Name', name:'name'},
                {text:'Username', name:'username'},
                {text:'Role', name:'role'},
                {text:'Created At', name:'created_at'},
            ],
            role: null,
            showDialog: false,
            isLoading: false,
            filter: {
                role: '',
                search: ''
            },
            errors: []
        }
    },
    computed:{
        currentUser(){

            return this.$store.state.users.currentUser
        },
        users() {

            return this.$store.state.users.dataUsers
        }
    },
    methods:{
        next(){
            this.users.meta.current_page+=1
            this.getAll()
        },
        prev(){
            this.users.meta.current_page-=1
            this.getAll()
        },
        selectImage(){

        },
        submit() {
            this.isLoading=true
            let fd = new FormData(this.$refs.form.$el)
            if (this.currentUser.id) {
                if(!fd.get("password")){
                    fd.delete("password")
                }
                this.$store.dispatch("users/update", {
                    formData: fd,
                    id: this.currentUser.id
                }).then( ()=>{
                    this.isLoading=false
                    alert("Succesufly update !!")
                }).catch( err=>{
                    try {
                        this.errors = err.response.data.errors
                    } catch (error) {
                        this.errors = ['Opps Same errors']
                    }
                    this.isLoading=false
                })
            } else {
                this.$store.dispatch("users/create", fd)
                    .then( ()=>{
                        this.isLoading=false
                        this.$refs.form.$el.reset()
                        alert("Succesufly Create !!")
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
            this.$store.commit("users/SET_CURRENT_USER", {info: {}})
        },
        filterUsers(search="") {
            this.filter.search = search
            this.getAll()
        },
        eidtUser(user) {
            this.isLoading=true
            this.$store.dispatch("users/get", user.id)
                .then(()=>{
                    this.showDialog=true
                    this.isLoading=false
                })
        },
        deleteUser(user) {
            this.isLoading=true
            this.$store.dispatch("users/delete", user)
                .then(()=>{
                    this.isLoading = false
                })
        },
        getAll() {
            if (!this.isLoading){
                this.isLoading=true
                let page = this.users.meta ? this.users.meta .current_page : 1
                this.filter = {...this.filter, page: page}
                this.$store.dispatch("users/all", this.filter)
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