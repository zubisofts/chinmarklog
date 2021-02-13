<template>
    <auth-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-light leading-tight flex-1 pt-2">
                Manage Parcels
            </h2>
        </template>

        <transition name="fade"> 
        <div v-if="(states.length < 1) && (showAlert == true)" class="max-w-7xl mx-auto py-3 px-4 bg-red-200 text-red-900">
            <strong>No State Detected!</strong> You maybe required to specify the parcel departure and destination state. 
            Please add states first.
        </div>
        <div v-if="(categories.length < 1) && (showAlert == true)" class="max-w-7xl mx-auto py-3 px-4 bg-red-200 text-red-900">
            <strong>No Category Record!</strong> Every parcel must belong to a particular category. Kindly add a new category.
        </div>
        </transition>

        <!-- Header -->
        <div class="py-3 mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow sm:rounded-sm sm:flex">
                    <div class="flex-1">
                        <h3 class="px-4 py-2 text-xl">
                            <font-awesome-icon icon="gift" class="text-xl" /> Parcel's List
                        </h3>
                    </div>

                    <div class="flex-2 text-right py-2 px-4">
                        <button
                        @click="showAddModal = true"
                        class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
                        v-if="(categories.length > 0) && (states.length > 0)"
                        >
                            <font-awesome-icon icon="plus" /> <span class="hidden md:inline">Add</span> New Parcel
                        </button>

                        <button @click="showCategories = true"
                        class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
                        >
                            <font-awesome-icon icon="cogs" /> <span class="hidden lg:inline">Manage</span> Category
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="py-3">
            <parcel-list :refresh="refresh_state" />
        </div>

        <!-- Modal -->
        <modal-component :prop-show="showCategories" @closeModal="closeModal()">
            <div>
                <parcel-category></parcel-category>
            </div>
        </modal-component>

        
        <!-- Modal -->
        <modal-component :prop-show="showAddModal" @closeModal="closeModal()">
            <form @submit.prevent="storeParcel">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label :class="labelStyles" for="sender"> Sender's Name <sup class="text-red-500">*</sup> </label>
                        <input :class="inputStyles" id="sender" type="text" required v-model="sender" placeholder="Sender's Fulname" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="sphone"> Sender's Phone Number <sup class="text-red-500">*</sup> </label>
                        <input :class="inputStyles" id="sphone" type="tel" required v-model="sphone" placeholder="Sender's Phone Number" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="semail"> Sender's Email </label>
                        <input :class="inputStyles" id="semail" type="email" v-model="semail" placeholder="Sender's Email Address" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="sphone"> Reciever's Name <sup class="text-red-500">*</sup></label>
                        <input :class="inputStyles" id="sphone" type="text" required v-model="reciever" placeholder="Reciever's Fulname" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="sphone"> Reciever's Phone Number <sup class="text-red-500">*</sup> </label>
                        <input :class="inputStyles" id="sphone" type="tel" required v-model="rphone" placeholder="Reciever's Phone Number" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="remail"> Reciever's Email  <sup class="text-red-500">*</sup></label>
                        <input :class="inputStyles" id="remail" type="email" required v-model="remail" placeholder="Reciever's Email Address" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="raddress"> Reciever's Address  <sup class="text-red-500">*</sup></label>
                        <input :class="inputStyles" id="raddress" type="text" required v-model="raddress" placeholder="Reciever's Address" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for=""> Destination / Reciever's State  </label>
                        <select :class="inputStyles" v-model="sstate" placeholder="Reciever's state">
                            <option v-for="state in states" :key="state.id" :value="state.id"> {{ state.name }} </option>
                        </select>
                    </div>
                    <!-- Column with three rows -->
                    <div>
                        <div class="mb-4">
                            <label :class="labelStyles" for="paddress"> Parcel Category </label>
                            <select v-model="category" name="category" id="category" :class="inputStyles" required>
                                <option value="">Select Category Type</option>
                                <!-- <span > -->
                                <option :value="cat.id" v-for="(cat, i) in categories" :key="i">{{ cat.category }}</option>
                                <!-- </span> -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label :class="labelStyles" for="weight"> Estimated Dimension/Weight  </label>
                            <input :class="inputStyles" id="weight" type="text" v-model="weight" placeholder="Lenght x Width x Height (kg)" />
                        </div>
                        <div class="mb-4">
                            <label :class="labelStyles" for="paddress"> Parcel Current State </label>
                            <select :class="inputStyles" v-model="paddress" placeholder="Reciever's state">
                                <option v-for="state in states" :key="state.id" :value="state.id"> {{ state.name }} </option>
                            </select>
                        </div>
                    </div>
                    <!-- Column with textarea -->
                    <div>
                        <div class="mb-4">
                            <label :class="labelStyles" for="desc"> Parcel Description </label>
                            <textarea :class="inputStyles" id="desc" v-model="desc" placeholder="Parcel Description" rows="7"></textarea>
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="mb-4">
                        <button type="submit" class="col-span-2 mx-1 rounded-md border border-transparent px-2 py-1 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-black focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            <font-awesome-icon :icon="['far', 'save']" />  Save Branch
                        </button>
                    </div>
                </div>
                <div v-if="errors.length > 0" class="mt-4">
                    <em v-for="error in errors" :key="error" class="text-red-600 text-sm font-bold">
                        {{ error.message }}
                    </em>
                </div>
            </form>
        </modal-component>

    </auth-layout>
</template>

<script>
import ParcelList from '../Components/ParcelComponents/ParcelList.vue';
import AuthLayout from '../Layouts/AuthLayout.vue';
import ParcelCategory from "../Components/ParcelComponents/ParcelCategory";
import ModalComponent from '../Components/ModalComponent.vue';
import HttpClient from '../Mixins/HttpClient';

export default {
    components: { AuthLayout, ParcelList, ParcelCategory, ModalComponent },
    data(){
        return {
            showCategories:false,
            showAddModal:false,
            refresh_state:false,
            labelStyles:'block text-gray-700 font-bold mb-1',
            inputStyles:`bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 
                            leading-tight focus:outline-none focus:bg-white border focus:border-red-500`,
            states:'',
            categories:'',
            category:'',
            sender:'',
            sphone:'',
            semail:'',
            reciever:'',
            raddress:'',
            remail:'',
            rphone:'',
            sstate:'',
            paddress:'',
            weight:'',
            desc:'',
            errors:[],
            showAlert:false

        }
    },
    beforeMount(){
        document.title = "Manage Parcels";
        this.fetchCategories();
    },
    mounted(){
        this.loadStates();
        setTimeout(() => {
            this.showAlert = true;
        }, 1500);
    },
    methods:{
        fetchCategories(){
            // fetch Categories
            HttpClient.client.post('parcel/category/fetch')
            .then((res) => {
                this.categories = res.data;
            })
        },
        loadStates(){
            this.errors = [];
            HttpClient.client
            .post("/parcel/fetch_states")
            .then((response) => {
                this.states = response.data;
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
        closeModal(){
            this.showCategories = false;
            this.showAddModal = false;
            this.fetchCategories();
        },
        storeParcel(){
            this.errors = [];
            let data = {
                sender:this.sender,
                sphone:this.sphone,
                semail:this.semail,
                reciever:this.reciever,
                raddress:this.raddress,
                remail:this.remail,
                rphone:this.rphone,
                sstate: this.sstate,
                paddress: this.paddress,
                weight: this.weight,
                desc: this.desc,
                category: this.category
            }
            // Send Request 
            HttpClient.client
            .post("/parcel/store" , data)
            .then((response) => {
                this.handleStoreSuccess(response.data);
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
        handleStoreSuccess(data){
            if(data.status == 'success'){
                this.refresh_state = true;
                this.closeModal();
            }else{
                this.errors.push({message:data.message});
            }
        }
    }
    
}
</script>