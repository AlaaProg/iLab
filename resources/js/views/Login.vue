<template>
    <div class="w-full flex h-full justify-center items-start py-12">
        <div class="card-form ">
            <h1 class="text-3xl text-gray-800 py-4 text-center ">Login Page</h1>
            <form class="flex gap-6 flex-col items-start ju" @submit.prevent="login" ref="form">
                <template v-if="isError">
                    <div class="py-3 px-4 bg-rose-400 w-full rounded text-white font-semibold ">
                        Username or Password is incorrect 
                    </div>
                </template>
                <div class="field">
                    <input type="text" name="username" placeholder="Enter username" required>
                </div>
                <div class="field">
                    <input type="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="px-4">
                    <button type="submit" class="btn btn-blue ">
                        <span v-if="isLoading">
                            loading ...
                        </span>
                        <span v-else>Log IN</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>


<script>
export default {
    data: ()=>({
        isLoading: false,
        isError: false
    }),
    methods:{
        login(){
            let formData = new FormData(this.$refs.form)
            this.isLoading = true 
            this.isError = false
            this.$store.dispatch("auth/login", formData)
                .then(()=>  {})
                .catch(()=> this.isError=true)
                .then(()=>{
                    this.isLoading = false
                    this.$store.dispatch('auth/getProfile')
                    .then( ()=> {
                        this.$router.push("/")
                    })
                })
        }
    }
}
</script>

<style lang="postcss" >
.card-form {
    @apply p-12 shadow-lg rounded-xl xl:w-1/3 lg:w-1/2 w-10/12;
}
</style>