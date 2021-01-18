<template>
  <auth-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-light leading-tight flex-1 pt-2">
        Manage Riders
      </h2>
    </template>
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
                        <label :class="labelStyles" for="mdetails"> Motorcycle Details <small>(Optional)</small> </label>
                        <input :class="inputStyles" id="mdetails" type="text" required v-model="mdetails" placeholder="Motorcycle Details (Optional)" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="branch"> Select Branch </label>
                        <select v-model="sbranch" :class="inputStyles" required>
                            <option value="" selected>Select Branch</option>
                            <option v-for="branch in branches" :key="branch.id" :value="branch.id" >{{ branch.name }}</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-4 text-right">
                    <button type="button" @click="closeModal()"
                    class="bg-red-500 text-white cursor-pointer py-1 px-2 rounded shadow"
                    >
                        <font-awesome-icon icon="times" /> Cancel
                    </button>
                    <button type="submit"
                    class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
                    >
                        <font-awesome-icon :icon="['far', 'save']" /> Save Rider
                    </button>
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
                                leading-tight focus:outline-none focus:bg-white border focus:border-black`,
                lname:'',
                fname:'',
                phone: '',
                email:'',
                sbranch:'',
                plate_no:'',
                mdetails:'',
                branches:[],
                refresh_state:false
            }
        },
        mounted(){
            this.fetchBraches();
        },
        methods:{
            closeModal(){
                this.showModal = false;
            },
            fetchBraches(){
                HttpClient.client
                .post('/branch/fetch_all')
                .then((response) => {
                    this.branches  = response.data;
                })
            },
            saveRider(){
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
                if (error.response) {
                    console.log(error.response.data.message);
                } else {
                    console.log("An error occoured probably due to network!");
                }
                console.log(error);
                });
            },
            handleSaveResponse(response){
                this.fname = '';
                this.lname = '';
                this.phone = '';
                this.email = '';
                this.sbranch = '';
                this.mdetails = '';
                this.plate_no = '';
                document.forms[0].reset();
                this.closeModal();
                this.refresh_state = true;
                setTimeout(() => {
                    this.refresh_state = false;
                }, 1000);
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