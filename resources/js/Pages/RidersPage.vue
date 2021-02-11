<template>
  <auth-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-light leading-tight flex-1 pt-2">
        Manage Riders
      </h2>
    </template>
    
    <transition name="fade"> 
    <div v-if="(branches.length < 1) && (showAlert == true)"  class="max-w-7xl mx-auto py-3 px-4 bg-red-200 text-red-900">
        <strong>No Branch Detected!</strong> you cannot add a rider without his branch specified. 
        Kindly 
        <inertia-link href="/Manage-Offices" class="bg-green-500 text-white cursor-pointer py-1 px-2 mx-1 rounded shadow"> Add Branch </inertia-link>   
        before adding rider(s)
    </div>
    </transition>

    <div class="py-3 mt-4">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow sm:rounded-sm flex">
          <div class="flex-1">
            <h3 class="px-4 py-2 text-xl">
              <font-awesome-icon icon="motorcycle" class="text-xl" /> Rider's List
            </h3>
          </div>

          <div class="flex-2 text-right py-2 px-4">
            <button
            @click="showModal = true"
              class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
              v-if="branches.length > 0"
            >
              <font-awesome-icon icon="plus" /> Add New Rider
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="py-3">
      <riders-list :refresh="refresh_state"></riders-list>
    </div>

    <modal-component :prop-show="showModal" @closeModal="closeModal()">
        <template #modal_title>
            <font-awesome-icon icon="plus" />
        </template>
        <div>
            <form @submit.prevent="saveRider()">
                <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                    <div class="mb-4 text-center">
                        <div id="image-container" class="flex content-center flex-wrap mx-auto justify-center bg-gray-900 rounded" style="width:150px; height:170px;">
                        <img src="" alt="Vehicle Image" class="text-white text-lg" id="image_preview" style="max-width:100%; max-height:100%;">
                        </div>
                        <input class="bg-gray-200 hidden" type="file" id="simage" @change="changeImage" />
                        <button type="button" class="py-1 px-2 mt-2 mb-4 bg-blue-500 text-white rounded" @click="BrowseImage">
                            Upload Image
                        </button>
                    </div>
                    <div>
                        <div class="mb-4">
                            <label :class="labelStyles" for="fname"> Firstname </label>
                            <input :class="inputStyles" id="fname" type="text" required v-model="fname" placeholder="Firstname" />
                        </div>
                        <div class="mb-4">
                            <label :class="labelStyles" for="lname"> Lastname </label>
                            <input :class="inputStyles" id="lname" type="text" required v-model="lname" placeholder="Lastname" />
                        </div>
                        <div class="mb-4">
                            <label :class="labelStyles" for="phone"> Phone Number </label>
                            <input :class="inputStyles" id="phone" type="text" required v-model="phone" placeholder="Phone Number" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="email"> Email Address </label>
                        <input :class="inputStyles" id="email" type="text" required v-model="email" placeholder="Recipient's Email" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="plate_no"> Plate Number </label>
                        <input :class="inputStyles" id="plate_no" type="text" required v-model="plate_no" placeholder="Plate Number" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="mdetails"> Motorcycle/Vehicle Details <small>(Optional)</small> </label>
                        <input :class="inputStyles" id="mdetails" type="text" v-model="mdetails" placeholder="Motorcycle Details (Optional)" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="branch"> Select Branch </label>
                        <select v-model="sbranch" :class="inputStyles" required>
                            <option value="" selected>Select Branch</option>
                            <option v-for="branch in branches" :key="branch.id" :value="branch.id" >{{ branch.name }}</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-2 text-right">
                    <button type="button" @click="closeModal()"
                    class="bg-red-500 text-white cursor-pointer py-1 px-2 rounded shadow"
                    >
                        <font-awesome-icon icon="times" /> Cancel
                    </button>
                    <button type="submit"
                    class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
                    >
                        <font-awesome-icon v-if="processing == false" :icon="['far', 'save']" /> 
                        <font-awesome-icon v-else :icon="['fas', 'circle-notch']" pulse /> 
                        Save Rider
                    </button>
                </div>
                <div v-if="errors.length > 0" class="mt-4">
                    <em v-for="(error, i) in errors" :key="i" class="text-red-600 text-sm font-bold">
                        {{ error.message }}
                    </em>
                </div>
            </form>
        </div>
    </modal-component>
  </auth-layout>
</template>

<script>
    import HttpClient from "../Mixins/HttpClient";
    import AuthLayout from '../Layouts/AuthLayout'
    import RidersList from '../Components/RidersList'
    // import ReservationForm from "./../../Components/ReservationForm"
    import ModalComponent from '../Components/ModalComponent.vue'

    export default {
        components: {
            AuthLayout,
            RidersList,
            // ReservationForm,
            ModalComponent
        },
         data(){
            return {
                showModal: false,
                labelStyles:'block text-gray-700 font-bold mb-1',
                inputStyles:`bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 
                                leading-tight focus:outline-none focus:bg-white border focus:border-red-500`,
                lname:'',
                fname:'',
                phone: '',
                email:'',
                sbranch:'',
                plate_no:'',
                mdetails:'',
                branches:[],
                refresh_state:false,
                showAlert:false,
                errors:[],
                processing:false,
            }
        },
        mounted(){
            this.fetchBraches();
            setTimeout(() => {
                this.showAlert = true;
            }, 1000);
        },
        methods:{
            closeModal(){
                this.showModal = false;
            },
            fetchBraches(){
                this.errors = [];
                HttpClient.client
                .post('/branch/fetch_all')
                .then((response) => {
                    this.branches  = response.data;
                })
                .catch((error) => {
                    if(error.response){
                        this.errors.push({message:error.response.message.data});
                        console.log(error.response.message.data);
                    }else{
                        this.errors.push({message:`An error occured and might be due to Network!
                                                    Please check your network connection.`});
                        console.log('An error occured due to Network!');
                    }
                });
            },
            saveRider(){
                this.errors = [];
                this.processing = true;
                this.image = document.querySelector('#simage').files[0];
                // create a new form data object
                let data = new FormData();
                // append data to the form data object
                data.append('image', this.image);
                data.append('lname', this.lname);
                data.append('fname', this.fname);
                data.append('phone', this.phone);
                data.append('plate_no', this.plate_no);
                data.append('branch', this.sbranch);
                data.append('details', this.mdetails);
                data.append('email', this.email);

                HttpClient.client
                .post('/riders/add', data)
                .then((response) => {
                    this.handleSaveResponse(response.data);
                })
                .catch((error) => {
                    this.processing = false;
                    if(error.response){
                        this.errors.push({message:error.response.message.data});
                        console.log(error.response.message.data);
                    }else{
                        this.errors.push({message:`An error occured and might be due to Network!
                                                    Please check your network connection.`});
                        console.log('An error occured due to Network!');
                    }
                console.log(error);
                });
            },
            handleSaveResponse(response){
                if (response.status == 'success') {
                    this.fname = '';
                    this.lname = '';
                    this.phone = '';
                    this.email = '';
                    this.sbranch = '';
                    this.mdetails = '';
                    this.plate_no = '';
                    document.forms[0].reset();
                    this.processing = false;
                    this.closeModal();
                    this.refresh_state = true;
                    setTimeout(() => {
                        this.refresh_state = false;
                    }, 1000);
                }else{
                    this.errors.push({message:response.message});
                }
            },
            BrowseImage(){
                document.getElementById('simage').click();
            },
            changeImage(e){
                if(e.target.files && e.target.files[0]){
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('image_preview').setAttribute('src', e.target.result);
                    }
                    reader.readAsDataURL(e.target.files[0]);
                }
            },
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to { /* .fade-leave-active below version 2.1.8 */
        opacity: 0;
    }
</style>