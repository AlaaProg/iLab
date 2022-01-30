<template>
    <div class="flex items-center  h-full w-full md:px-12">
        <form class="md:w-1/3 w-full" @submit.prevent="submit" ref="form">
            <h1 class="text-xl text-gray-800 p-8">
                Hello , {{ profile.username }}
            </h1>
            <div class="field">
                <input type="file" placeholder="Avatar" hidden name="avatar" ref="avatar" @change="selectImage">
                <div class="w-52 h-52 relative border">
                    <img 
                        :src="avatar"
                        alt=""
                        class="w-full h-full"
                    >
                    <div class="absolute bottom-0 left-0 w-full p-2 bg-gray-500 bg-opacity-30">
                        <a class="w-full cursor-pointer flex items-center justify-center" @click="$refs.avatar.click()">
                            <Icon icon="codicon:cloud-upload" class="text-4xl" />
                        </a>
                    </div>
                </div>
                
            </div>
            <div class="field">
                <input  :value="profile.name" type="text" name="name" placeholder="Name">
                
            </div>
            <template v-if="profile.role == 'sick' && profile.info">
                 <div class="field">
                    <input  :value="profile.info.age" type="text" name="age" placeholder="Age">
                </div>
                <div class="field">
                    <select name="gender" :value="profile.info.gender" >
                        <option value="null" disabled>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="field">
                    <input  :value="profile.info.phone" type="text" name="phone" placeholder="Phone">
                </div>
            </template>
            <div class="field">
                <input type="password" name="password" placeholder="Password">
            </div>

            <div class="p-3">
                <button class="btn btn-blue" type="submit">
                    <template v-if="!isLoading">
                        Save
                    </template>
                    <template v-else>
                        loading ...
                    </template>
                </button>
            </div>
        </form>
    </div>
</template>


<script>
import { Icon } from '@iconify/vue2';
export default {
    components:{
        Icon,
    },
    computed: {
        profile() {
            let profile =  this.$store.state.auth.profile
            this.avatar = `storage/${profile.avatar}`
            return profile
        },
        isLoading() {

            return this.$store.state.auth.isLoadingProfile
        }
    },
    data:()=>({
        avatar: ''
    }),
    methods:{
        submit() {
            let fd = new FormData(this.$refs.form)
            if (!fd.get("password")) {
                fd.delete("password")
            }
            if (!this.isLoading){

                this.$store.dispatch("auth/updateProfile", fd)
            }
        },
        selectImage() {
            let file = this.$refs.avatar.files[0]
            let reader = new FileReader
            reader.onload = e => {
                this.avatar = e.target.result
            }
            reader.readAsDataURL(file)
        }
    }
}
</script>