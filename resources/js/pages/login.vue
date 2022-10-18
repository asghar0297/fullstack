<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 justify-content-center mt-4">
                <h2>Login</h2>
                <p class="text-danger" >{{ error }}</p>
                <form @submit.prevent="login">
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input v-model="form.email" type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input v-model="form.password" type="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label"><input type="checkbox"> Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import { reactive,ref } from 'vue'
    import {useRouter} from 'vue-router'
    export default{
        setup(){
           const router = useRouter()
           let form = reactive({
                email:'',
                password:''
           });
           let error = ref('')

           let login = async() => {
                await axios.post('api/login',form).then(res=>{

                    if(res.data.success){
                        localStorage.setItem('token',res.data.data.token)
                        router.push({name:'dashboard'})
                    }else{
                        error.value = res.data.message
                    }
                })
           }
           return {
               form,
               login,
               error
           }
        }
    }
</script>
