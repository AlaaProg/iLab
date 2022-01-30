<template>
<form class="w-full" @submit.prevent="$emit('submit')" >
    <p class="text-sm text-red-500 font-semibold px-2">
        <span v-for="(err, i) in errors.message" :key="i">
            {{ err }}
        </span>
    </p>
    <div class="field" v-if="current.id">
        <input type="file" placeholder="Avatar" hidden name="avatar" ref="image" @change="selectImage">
        <div class="w-52 h-52 relative border">
            <img 
                :src="image"
                alt=""
                class="w-full h-full"
            >
            <div class="absolute bottom-0 left-0 w-full p-2 bg-gray-500 bg-opacity-30">
                <a class="w-full cursor-pointer flex items-center justify-center" @click="$refs.image.click()">
                    <Icon icon="codicon:cloud-upload" class="text-4xl" />
                </a>
            </div>
        </div>
        <p class="text-sm text-red-500 font-semibold px-2">
            <span v-for="(err, i) in errors.avatar" :key="i">
                {{ err }}
            </span>
        </p>
    </div>
    <div class="field">
        <input   type="text" name="username" placeholder="Username" :value="current.username">
        <p class="text-sm text-red-500 font-semibold px-2">
            <span v-for="(err, i) in errors.username" :key="i">
                {{ err }}
            </span>
        </p>
    </div>
    <div class="field">
        <input   type="text" name="name" placeholder="Name" :value="current.name">
        <p class="text-sm text-red-500 font-semibold px-2">
            <span v-for="(err, i) in errors.name" :key="i">
                {{ err }}
            </span>
        </p>
    </div>
    <div class="field">
        <label for="select" class="px-2 text-sm text-gray-400">Select Role</label>
        <select name="role" v-model="current.role" aria-placeholder="Selec Role" >
            <option value="sick">Sick</option>
            <option value="admin">Admin</option>
            <option value="lab">Lab</option>
        </select>
        <p class="text-sm text-red-500 font-semibold px-2">
            <span v-for="(err, i) in errors.role" :key="i">
                {{ err }}
            </span>
        </p>
    </div>
    <template v-if="current.role && current.role=='sick'">
        <div class="field">
            <input  type="text" :value="current.info.age" name="age" placeholder="Age">
            <p class="text-sm text-red-500 font-semibold px-2">
                <span v-for="(err, i) in errors.age" :key="i">
                    {{ err }}
                </span>
            </p>
        </div>
        <div class="field">
            <label for="select" class="px-2 text-sm text-gray-400">Select Gender</label>
            <select name="gender"  :value="current.info.gender">
                <option value="null" disabled>Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <p class="text-sm text-red-500 font-semibold px-2">
                <span v-for="(err, i) in errors.gender" :key="i">
                    {{ err }}
                </span>
            </p>
        </div>
        <div class="field">
            <input   type="text" :value="current.info.phone" name="phone" placeholder="Phone">
            <p class="text-sm text-red-500 font-semibold px-2">
                <span v-for="(err, i) in errors.phone" :key="i">
                    {{ err }}
                </span>
            </p>
        </div>
    </template>
    <div class="field">
        <input type="password" name="password" placeholder="Password">
        <p class="text-sm text-red-500 font-semibold px-2">
            <span v-for="(err, i) in errors.password" :key="i">
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
        <a @click="$emit('close-dialog')" class="btn bg-red-500 cursor-pointer !ring-red-500 active:!ring-1 text-white">
            close
        </a>
    </div>
</form>
</template>


<script>
import { Icon } from '@iconify/vue2';
export default {
    components:{
        Icon,
    },
    props: ["current", 'loading', 'errors'],
    data(){
        return {
            image: `storage/${this.current.avatar}`
        }
    },
    methods:{
        selectImage() {
            let file = this.$refs.image.files[0]
            let reader = new FileReader
            reader.onload = e => {
                this.image = e.target.result
            }
            reader.readAsDataURL(file)
        }
    }
}
</script>