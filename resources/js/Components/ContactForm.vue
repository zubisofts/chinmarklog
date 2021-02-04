<template>
    <div>
        <div class="container-fluid">
            <div class="container mx-auto">
                <div class="row grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div class="col-md-6" style="">
                        <div class="">
                            <img src="/images/red_truck.jpg" alt="" class="mx-auto mt-6" style="max-height:100%; max-width:100%;">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Heading -->
                        <div class="col-md-12 py-4 px-6 bg-red-600 text-white" data-aos="fade-right">
                            <h3>
                                <strong>
                                    <font-awesome-icon :icon="['fas','envelope']" class="mr-2"></font-awesome-icon>
                                    Send Us A Message
                                </strong>
                            </h3>
                        </div>
                        <!-- Form -->
                        <div class="container">
                            <div class="row">
                                <div class="py-3 px-4" data-aos="fade-up">
                                    <form method="post" @submit.prevent="sendMessage" ref="frmMessage">
                                        <div class="row mb-3">
                                            <div class="form-group grid grid-cols-1 md:grid-cols-2 gap-3">
                                                <input v-model="fname" type="text" name="fullname" id="fullname" :class="form_input" placeholder="Full Name" required>
                                                <input v-model="email" type="email" name="email" id="email" :class="form_input" placeholder="Email Address" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="form-group grid grid-cols-1 md:grid-cols-2 gap-3">
                                                <input v-model="phone" type="tel" name="phone" id="phone" :class="form_input" placeholder="Phone Number" required>
                                                <input v-model="subject" type="text" name="subject" id="subject" :class="form_input" placeholder="Subject" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="form-group col-md-12">
                                                <textarea v-model="message" name="message" id="message" rows="4" :class="form_input" placeholder="Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group text-left">
                                                <div class="input-group">
                                                    <div class="inline-grid grid-cols-8">
                                                        <span class="input-group-text text-white col-span-1 py-3 px-4 rounded-l bg-red-600">
                                                            <font-awesome-icon icon="paper-plane" v-if="sending === false" />
                                                            <font-awesome-icon icon="circle-notch" pulse v-else />
                                                        </span>
                                                        <button type="submit" class="btn bg-gray-900 text-gray-100 col-span-5 py-3 px-2 rounded-r">
                                                            Send Message
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- Modal -->
        <modal-component :prop-show="showModal" :prop-size="'sm'" @closeModal="closeModal()">
            <div v-if="modal_type == 'success'" class="text-center">
                <h2 class="text-3xl">
                    <font-awesome-icon class="text-green-500" size="2x" icon="check-circle"></font-awesome-icon>
                </h2>
                <p>
                    {{ modal_msg }}
                </p>
            </div>
            <div v-else class="text-center">
                <h2 class="text-3xl">
                    <font-awesome-icon class="text-red-500" size="2x" icon="times-circle"></font-awesome-icon>
                </h2>
                <p>
                    {{ modal_msg }}
                </p>
            </div>
        </modal-component>
    </div>
</template>
<script>
import Api from "../Mixins/HttpClient";
import ModalComponent from '../Components/ModalComponent';

export default {
    components:{
        ModalComponent
    },
    data(){
        return {
            form_input:'border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700',
            sending: false,
            fname:'',
            email:'',
            phone:'',
            subject: '',
            message:'',
            showModal:false,
            modal_msg: '',
            modal_type:'',
            sent_status: 'initial'
        }
    },
    watch:{
        'sent_status': function (value) {
            if(value === 'done'){
                this.resetForm();
                this.sent_status = 'initial'
            }
        }
    },
    methods:{
        sendMessage(event){
            this.sending = true;
            let data = {
                fname: this.fname,
                email: this.email,
                phone: this.phone,
                subject: this.subject,
                message: this.message
            };
            Api.client.post('contacts/store', data)
            .then((res) => {
                if(res.data.status == 'success'){
                    this.handleSuccess(res.data);
                }else{
                    this.handleError(res.data);
                }
            })
            .catch((e) => {
                if(e.response){
                    alert(e.response.data.message);
                }else{
                    alert('Network Error! Please check your internet connection');
                }
            });
        },
        handleSuccess(response_data){
            this.sent_status = 'done';
            this.sending = false;
            this.modal_type = 'success';
            this.modal_msg = response_data.message;
            this.resetForm()
            this.showModal = true;
        },
        handleError(response_data){
            this.sending = false;
            this.modal_type = 'error';
            this.modal_msg = response_data.message;
            this.showModal = true;
        },
        resetForm(){
            this.phone = '';
            this.message = '';
            this.subject = '';
            this.email = '';
            this.fname= '';
            this.$refs.frmMessage.reset();
        },
        closeModal(){
            this.showModal = false;
        }
    }
}
</script>

<style scoped>
    
</style>