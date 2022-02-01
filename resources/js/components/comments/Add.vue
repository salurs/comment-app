<template>
    <div class="row">
        <div class="col-md-12 mt-3">
<!--            <div v-if="result == 'Successfull'" class="alert alert-success">{{result}}</div>-->
<!--            <div v-else-if="result == 'Error'" class="alert alert-danger">{{result}}</div>-->
            <form @submit.prevent="save" v-model="isFormValid = !$v.$invalid">
                <div class="form-group">
                    <label for="message">Name<span class="text-danger">*</span></label>
                    <input v-model="$v.name.$model" type="text" id="name" name="name" class="form-control" placeholder="Name" required/>
                    <small class="text-danger" v-if="!$v.name.minLength">Name must have at least {{$v.name.$params.minLength.min}} letters.</small>
                </div>
                <div class="form-group mt-2">
                    <label for="message">Message<span class="text-danger">*</span></label>
                    <textarea v-model="message" name="message" id="message" cols="30" rows="3" class="form-control" placeholder="Message" required></textarea>
                    <small class="text-danger" v-if="!$v.message.minLength">Name must have at least {{$v.name.$params.minLength.min}} letters.</small>
                </div>
                <div class="form-group text-center mt-2">
                    <button :disabled="!isFormValid" class="btn btn-success">Send</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import { required,minLength } from 'vuelidate/lib/validators';
    export default {
        props:['parent_id'],
        data(){
            return{
                isFormValid: false,
                name: '',
                message: '',
                result: ''
            }
        },
        validations:{
            name: {
                required,
                minLength: minLength(5)
            },
            message: {
                required,
                minLength: minLength(5)
            },
        },
        methods: {
            save(){
                if (this.isFormValid){
                    let name = this.name;
                    let message = this.message;
                    let parent_id = this.parent_id;
                    this.$store.dispatch("saveComments",{
                        name,
                        message,
                        parent_id,
                    }).then(res=>{
                        this.result = res;
                        this.name = '';
                        this.message = '';
                        this.$emit('clearCurrentId');
                        this.$store.dispatch('getComments');
                    })
                }
            }
        },
    }
</script>
