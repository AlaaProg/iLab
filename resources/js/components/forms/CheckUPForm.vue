<template>
<form class="w-full" @submit.prevent="$emit('submit')" > 
    <p class="text-sm text-red-500 font-semibold px-2">
        <span v-for="(err, i) in errors.message" :key="i">
            {{ err }}
        </span>
    </p>   
    <div class="field" >
        <input type="file" hidden name="file" ref="file" @change="selectFile">
        <div class="">
            <div v-if="file">
                <a :href="file" class="text-ellipsis flex items-center p-4 gap-6">
                    <Icon icon="fa-solid:file-download" class="text-3xl text-blue-500" />
                    <span class="truncate">
                        {{ file }}
                    </span>
                </a>
            </div>
            <div class="bottom-0 left-0 w-full p-2 bg-gray-500 bg-opacity-30">
                <a class="w-full cursor-pointer flex items-center justify-center" @click="$refs.file.click()">
                    <Icon icon="codicon:cloud-upload" class="text-4xl" />
                </a>
            </div>
        </div>
        <p class="text-sm text-red-500 font-semibold px-2">
            <span v-for="(err, i) in errors.password" :key="i">
                {{ err }}
            </span>
        </p>
    </div>
    
    <template v-if="!isLab">
        <div class="field" v-if="current.lab">
            <label for="select-lab" class="px-2 text-sm text-gray-400">Select lab</label>
            <select name="lab" id="select-lab" v-model="current.lab.id">
                <option v-for="lab in labUsers" :key="lab.id" :value="lab.id">
                    {{ lab.name }}
                </option>
            </select>
            <p class="text-sm text-red-500 font-semibold px-2">
                <span v-for="(err, i) in errors.lab" :key="i">
                    {{ err }}
                </span>
            </p>
        </div>
    </template>

    <div class="field" >
        <label for="select-sick" class="px-2 text-sm text-gray-400">Select sick</label>
        <select name="sick" id="select-sick" v-model="current.sick.id">
            <option v-for="sick in sickUsers" :key="sick.id" :value="sick.id">
                {{ sick.name }}
            </option>
        </select>
        <p class="text-sm text-red-500 font-semibold px-2">
            <span v-for="(err, i) in errors.sick" :key="i">
                {{ err }}
            </span>
        </p>
    </div>

    <div class="field">
        <textarea 
            name="notes" 
            placeholder="Notes"
            cols="30" 
            rows="10" 
            v-model="current.notes"
        ></textarea>
        <p class="text-sm text-red-500 font-semibold px-2">
            <span v-for="(err, i) in errors.notes" :key="i">
                {{ err }}
            </span>
        </p>
    </div>

    <div class="p-3 flex gap-6">
        <button class="btn btn-blue" type="submit">
            <template v-if="!loading">
                Save
            </template>
            <template v-else>
                loading ...
            </template>
        </button>
        <a 
            @click="$emit('close-dialog')" 
            class="btn bg-red-500 cursor-pointer !ring-red-500 active:!ring-1 text-white">
            close
        </a>
    </div>
</form>
</template>

<script>
import { Icon } from '@iconify/vue2';
// import axios from "./../axios"
export default {
    components:{
        Icon,
    },
    props: ["current", 'loading', 'errors'],
    data(){
        return {
            file: this.current.file,
            users: []
        }
    },
    computed:{
        isLab() {
            return this.$store.state.auth.profile.role == "lab"
        },
        labUsers() {
            return this.users.filter(user=>{
                return user.role=='lab'
            })
        },
        sickUsers() {
            return this.users.filter(user=>{
                return user.role=='sick'
            })
        }
    },
    methods:{
        selectFile() {
            let file = this.$refs.file.files[0]
            this.file = file.name
        },
        getUsers() {
            return this.$store.dispatch("checkup/getUsers")
                .then( data=>{
                    this.users = data.data.data
                })
        }
    },
    created(){
        this.getUsers()
    }
}
</script>