<template>
    <div class="container">
        <div class="row">
            <div class="col-md-10 justify-content-center mt-4">

                <h2>Register</h2>

                <p class="text-danger" v-for="error in errors" :key="error" >
                    <span v-for="err in error" :key="err">{{ err }}</span>
                </p>

                <form @submit.prevent="register">
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input v-model="form.name" type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail">Email</label>
                        <input v-model="form.email" type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input v-model="form.password" type="password" class="form-control" id="inputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="inputCPassword">Confirm Password</label>
                        <input v-model="form.c_password" type="password" class="form-control" id="inputCPassword" placeholder="Confirm Password">
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
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
                name:'',
                email:'',
                password:'',
                c_password:''
           });

           let errors = ref([])
           let register = async() => {
                await axios.post('api/register',form).then(res=>{

                    if(res.data.success){
                        localStorage.setItem('token',res.data.data.token)
                        router.push({name:'dashboard'})
                    }
                }).catch(e=>{
                    errors.value = e.response.data.message
                })
           }
           return {
               form,
               register,
               errors
           }
        }
    }
</script>
