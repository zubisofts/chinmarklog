<template>
    <app-layout>
        <template #banner>
            <div style="z-index:1;" class="bg-gray-100">
                <page-banner></page-banner>
            </div>
        </template>

        <div class="container max-w-6xl mx-auto my-6">
            <div class="grid grid-cols-1 md:grid-cols-12 w-full">
                <div class="md:col-span-8 p-6">
                    <div class="p-4 shadow-sm border rounded">
                        <form @submit.prevent="requestQuote" ref="frmQuote">
                            <h2 class="uppercase text-lg sm:text-xl md:text-2xl my-4 font-bold">
                                <font-awesome-icon :icon="['far','file-alt']" class="text-red-600 mr-4" />
                                Request a quick quote
                            </h2>
                            <p class="text-gray-600 font-medium">
                                Please fill in your request and contact details, and we will contact you as soon as possible
                            </p>

                            <div class="my-8 grid grid-cols-1 lg:grid-cols-3">
                                <div class="text-red-600 text-lg font-bold mb-3 upercase">
                                    <font-awesome-icon icon="gift" class="text-red-600 mr-1" />
                                    Product areas
                                </div>
                                <div class="col-span-2 grid grid-cols-1 sm:grid-cols-2">
                                    <aside class="mb-3" v-for="category in categories" :key="category.id">
                                        <input type="radio" name="category" :id="category.id" :value="category.id" v-model="sel_category"> 
                                        <label :for="category.id"> {{ category.category }} </label>
                                    </aside>
                                </div>
                            </div>

                            <div class="my-8 grid grid-cols-1">
                                <p class="text-gray-600 font-medium mb-3">
                                    Your enquiry: Please give us as much detail as possible, in order to help 
                                    us respond in the most efficient manner possible.
                                </p>
                                <aside class="mb-3">
                                    <textarea name="desc" id="desc" cols="30" rows="6" placeholder="Enter Detailed Description" v-model="desc"
                                    class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700"></textarea>
                                </aside>
                            </div>

                            <div class="my-8 grid grid-cols-1 gap-4">
                                <div class="text-red-600 text-lg font-bold mb-3 upercase">
                                    <font-awesome-icon :icon="['far', 'user']" class="text-red-600 mr-1" />
                                    Contact Information
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-1">
                                        <strong>Fullname</strong>
                                        <input type="text" id="fname" placeholder="Enter your fulname" v-model="fname"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700" />
                                    </div>
                                    <div class="mb-1">
                                        <strong>Contact Phone</strong>
                                        <input type="text" id="phone" placeholder="Enter contact phone" v-model="phone"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700" />
                                    </div>
                                    <div class="mb-1">
                                        <strong>Email Address</strong>
                                        <input type="text" id="email" placeholder="Email Address" v-model="email"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700">
                                    </div>
                                    <div class="mb-1">
                                        <strong>Company Name <small>(Optional)</small></strong>
                                        <input type="text" id="company" placeholder="Company name (if any)" v-model="company"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700">
                                    </div>
                                    <div class="mb-1">
                                        <strong>Gross Weight <small>(in Kg.)</small></strong>
                                        <input type="text" id="weight" placeholder="Total Gross Weight in KG" v-model="weight"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700">
                                    </div>
                                    <div class="mb-1">
                                        <strong>Address/City of Departure</strong>
                                        <input type="text" id="departure_addr" placeholder="Address of Departure" v-model="departure_addr"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700">
                                    </div>
                                    <div class="mb-1">
                                        <strong>Delivery Address/City </strong>
                                        <input type="text" id="delivery_addr" placeholder="Delivery Address/City" v-model="delivery_addr"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700">
                                    </div>
                                    <div class="mb-1">
                                        <strong> &nbsp; </strong>
                                        <div class="inline-grid grid-cols-8">
                                            <span class="input-group-text text-white col-span-1 py-3 px-4 rounded-l bg-red-600">
                                                <font-awesome-icon icon="paper-plane" v-if="sending === false" />
                                                <font-awesome-icon icon="circle-notch" pulse v-else />
                                            </span>
                                            <button type="submit" class="btn bg-gray-900 text-gray-100 col-span-5 py-3 px-2 rounded-r">
                                                Request Quote
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="md:col-span-4 bg-red-200 p-6">
                    Hello
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

    </app-layout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout.vue';
import HomeSlider from '../Components/HomeSlider.vue';
import PageBanner from '../Components/PageBanner.vue';
import HttpClient from "../Mixins/HttpClient";
import ModalComponent from "../Components/ModalComponent"
export default {
  components: { AppLayout, HomeSlider, PageBanner, ModalComponent },
  data(){
      return{
        page_title: 'Request A Quote - Chimarklog',
        showModal:false,
        sending:false,
        modal_msg: '',
        modal_type:'',
        sent_status: 'initial',
        category:'',
        categories:[],
        sel_category:'',
        desc:'',
        fname:'',
        phone:'',
        email:'',
        weight:'',
        departure_addr:'',
        delivery_addr:'',
        company:''
      }
  },
  beforeMount(){
      document.title = this.page_title;
      this.loadCategory();
  },
  methods:{
      loadCategory(){
            HttpClient.client
            .post("/parcel/category/fetch")
            .then((response) => {
                this.categories = response.data;
            })
            .catch((error) => {
                if(error.response){
                    console.log(error.response.message.data);
                }else{
                    alert('An error occured due to Network!');
                }
            });
        },
        requestQuote(){
            let data = {
                category_id: this.sel_category,
                desc: this.desc,
                fname: this.fname,
                phone:this.phone,
                email:this.email,
                weight:this.weight,
                departure_addr:this.departure_addr,
                delivery_addr:this.delivery_addr,
                company:this.company
            }
            this.sending = true;

            HttpClient.client
            .post("/parcel/request_quote", data)
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
            this.company = '';
            this.desc = '';
            this.email = '';
            this.fname= '';
            this.weight= '';
            this.departure_addr= '';
            this.delivery_addr= '';
            this.sel_category = '';
            this.$refs.frmQuote.reset();
        },
        closeModal(){
            this.showModal = false;
        }

    }
    
}
</script>
