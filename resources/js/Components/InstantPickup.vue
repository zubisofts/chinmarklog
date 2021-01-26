<template>
    <div id="our-work-desc" class="">
        <div class="container mx-auto max-w-6xl">
            <div class="grid grid-col-1 lg:grid-cols-2 gap-4"> 
                <div class="text-white px-4 py-1 lg:py-20"  data-aos="fade-left">
                    <h1 class="text-2xl font-medium my-4">
                        <font-awesome-icon icon="shipping-fast" size="2x" class="mr-2"/> 
                        Request an 
                        <br><strong class="font-black text-4xl ml-12">Instant Pickup!</strong>
                    </h1>

                    <ul class="list-square text-lg ml-4">
                        <li class="mb-2">
                            Reach out to our management team to help you pickup your parcel swiftly for sending! 
                        </li>
                        <li class="mb-2">
                            Fast and Reliable delivery within a short period of time with less charges
                        </li>
                        <li class="mb-2">
                            Request immediately by filling the form 
                            <span class="hidden lg:inline">
                                <font-awesome-icon icon="hand-point-right" style="font-size:1.5rem;" /> by the side;
                            </span>
                            <span class="lg:hidden">
                                <font-awesome-icon icon="hand-point-down" style="font-size:1.5rem;" /> below;
                            </span>
                        </li>
                    </ul>

                </div>
                <div class="px-4 py-6" data-aos="fade-right">
                    <div class="">
                        <form method="post" @submit.prevent="requestPickup" ref="frmMessage">
                            <div class="row mb-3">
                                <div class="form-group grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <input v-model="fname" type="text" name="fullname" id="fullname" :class="form_input" placeholder="Enter your fullname" required>
                                    <input v-model="rfname" type="text" name="rfullname" id="rfullname" :class="form_input" placeholder="Reciever's fullname" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <input v-model="email" type="email" name="email" id="email" :class="form_input" placeholder="Email Address" required>
                                    <input v-model="remail" type="email" name="remail" id="remail" :class="form_input" placeholder="Reciever's Email Address" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <input v-model="phone" type="tel" name="phone" id="phone" :class="form_input" placeholder="Phone number" required>
                                    <input v-model="rphone" type="tel" name="rphone" id="rphone" :class="form_input" placeholder="Reciever's Phone number" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <input v-model="pickup" type="text" name="pickup" id="pickup" :class="form_input" placeholder="Pickup Address/Location" required>
                                    <input v-model="rlocation" type="text" name="rpickup" id="rpickup" :class="form_input" placeholder="Reciever's Address/Location" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <select v-model="category" name="category" id="category" :class="form_input" required>
                                        <option value="">Select Category Type</option>
                                        <!-- <span > -->
                                        <option :value="cat.id" v-for="(cat, i) in categories" :key="i">{{ cat.category }}</option>
                                        <!-- </span> -->
                                    </select>
                                    <input v-model="weight" type="text" name="weight" id="weight" :class="form_input" placeholder="Estimated Parcel Weight in Kg" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="form-group col-md-12">
                                    <textarea v-model="message" name="message" id="message" rows="4" :class="form_input" placeholder="Please, Enter detailed description of parcel."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group text-left">
                                    <div class="input-group">
                                        <div class="inline-grid grid-cols-8">
                                            <span class="input-group-text bg-white col-span-1 py-2 px-4 rounded-l text-red-600">
                                                <font-awesome-icon icon="paper-plane" v-if="sending === false" />
                                                <font-awesome-icon icon="circle-notch" pulse v-else />
                                            </span>
                                            <button type="submit" class="btn bg-gray-900 text-gray-100 col-span-5 py-2 px-2 rounded-r">
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

        
        <!-- Modal -->
        <modal-component :prop-show="showModal" :prop-size="'sm'" @closeModal="closeModal()">
            <div v-if="modal_type == 'success'" class="text-center">
                <h2 class="text-3xl">
                    <font-awesome-icon class="text-green-500" size="2x" icon="check-circle"></font-awesome-icon>
                </h2>
                <p v-html="modal_msg"></p>
            </div>
            <div v-else class="text-center">
                <h2 class="text-3xl">
                    <font-awesome-icon class="text-red-500" size="2x" icon="times-circle"></font-awesome-icon>
                </h2>
                <p v-html="modal_msg"></p>
            </div>
        </modal-component>

    </div>
</template>

<style scoped>
    #our-work-desc{
        min-height: 300px;
        background-image: url('/images/shapes-dark.png');
        background-size: cover;
        background-position: center;
    }
</style>

<script>
import HttpClient from "../Mixins/HttpClient";
import ModalComponent from '../Components/ModalComponent';

export default {
    components:{
        ModalComponent
    },
    data(){
        return{
            form_input:'border focus:border-red-500 w-full rounded px-3 py-2 resize-none text-gray-700',
            sending:false,
            categories:[],
            category:'',
            fname:'',
            rfname:'',
            phone:'',
            rphone:'',
            email:'',
            remail:'',
            pickup:'',
            rlocation:'',
            message:'',
            weight:'',
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
    beforeMount(){
        // fetch Categories
        HttpClient.client.post('parcel/category/fetch')
        .then((res) => {
            this.categories = res.data;
        })
    },
    methods:{
        requestPickup(){
            let data = {
                category: this.category,
                fname: this.fname,
                rfname: this.rfname,
                phone: this.phone,
                rphone: this.rphone,
                email: this.email,
                remail: this.remail,
                pickup: this.pickup,
                rlocation: this.rlocation,
                message: this.message,
                weight: this.weight
            }

            HttpClient.client.post('parcel/request_pickup', data)
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
            this.rphone = '';
            this.message = '';
            this.pickup = '';
            this.rlocation = '';
            this.email = '';
            this.remail = '';
            this.fname = '';
            this.rfname = '';
            this.weight = '';
            this.category = '';
            this.$refs.frmMessage.reset();
        },
        closeModal(){
            this.showModal = false;
        }
    }
}
</script>