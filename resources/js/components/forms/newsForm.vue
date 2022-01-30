<template>
<form class="w-full" @submit.prevent="$emit('submit')" > 
    <p class="text-sm text-red-500 font-semibold px-2">
        <span v-for="(err, i) in errors.message" :key="i">
            {{ err }}
        </span>
    </p>   
    <div class="field" >
        <input type="file" hidden name="image" ref="image" @change="selectImage">
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
            <span v-for="(err, i) in errors.password" :key="i">
                {{ err }}
            </span>
        </p>
    </div>

    <div class="field">
        <input type="text" name="title" v-model="current.title">
        <p class="text-sm text-red-500 font-semibold px-2">
            <span v-for="(err, i) in errors.password" :key="i">
                {{ err }}
            </span>
        </p>
    </div>

    <div class="field">
        <input type="text" name="text" v-model="current.text">
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
            image: `storage/${this.current.image}`
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