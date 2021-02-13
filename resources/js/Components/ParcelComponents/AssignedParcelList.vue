<template>
<div class="max-w-7xl mx-auto sm:px-6">
    <div class="container mx-auto sm:px-8">
    <div class="py-3">
        
        <div class="my-2 flex sm:flex-row flex-col px-2">
            <div class="flex flex-row mb-1 sm:mb-0 z-0">
                <div class="relative">
                    <span
                    class="h-full absolute inset-y-0 left-0 flex items-center pl-2"
                    >
                    <svg
                        viewBox="0 0 24 24"
                        class="h-4 w-4 fill-current text-gray-500"
                    >
                        <path
                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"
                        ></path>
                    </svg>
                    </span>
                    <input
                    placeholder="Search"
                    class="appearance-none rounded sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                    />
                </div>
            </div>
        </div>
        
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div
                class="inline-block min-w-full shadow rounded-lg overflow-hidden"
            >
                <table class="min-w-full leading-normal">
                <thead class="bg-red-600 text-white font-bold">
                    <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider"
                    >
                        Reciever
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider hidden sm:table-cell"
                    >
                        Reciever's Phone
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider hidden lg:table-cell"
                    >
                        Reciever's Email
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider"
                    >
                        Address
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase"
                    >
                        
                    </th>
                    </tr>
                </thead>
                <tbody v-if="parcels != ''">
                    <tr v-for="parcel in parcels" :key="parcel.id" class="cursor-pointer" @click="viewDetails(parcel)">
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{parcel.reciever}}
                        </p>
                    </td>
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden sm:table-cell"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{parcel.reciever_phone}}
                        </p>
                    </td>
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden lg:table-cell"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ parcel.reciever_email }}
                        </p>
                    </td>
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ parcel.reciever_address }}
                        </p>
                    </td>
                    <td class="bg-white">
                        <font-awesome-icon :icon="['fas', 'gift']" style="font-size:1.2rem;" class="text-blue-700" v-if="parcel.status == 'assigned'" />
                        <font-awesome-icon :icon="['fas', 'shipping-fast']" style="font-size:1.2rem;" class="text-green-600" v-if="parcel.status == 'transit'" />
                        <font-awesome-icon :icon="['far', 'stop-circle']" style="font-size:1.2rem;" class="text-red-600" v-if="parcel.status == 'stopped'" />
                        <font-awesome-icon :icon="['fas', 'check-circle']" style="font-size:1.2rem;" class="text-green-600" v-if="parcel.status == 'delivered'" />
                    </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" colspan="5">
                            No Parcel Record
                        </td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>

    
    </div>
    <!-- Modal -->
    <modal-component :prop-show="showDetails" @closeModal="closeModal()">
        <template #title>
             <div class="bg-red-600 text-white px-4 py-2 rounded-t">
                <div>
                    <h2 class="text-lg font-bold">
                        Parcel Details
                    </h2>
                </div>
            </div>
        </template>
            <div class="">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="mb-3">
                        <label class="text-sm text-red-600">Tracking ID</label>
                        <span class="block font-semibold">{{ sel_parcel.trackingid }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-sm text-red-600">Parcel Category</label>
                        <span class="block font-semibold" v-if="sel_parcel.category">{{ sel_parcel.category.category }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-sm text-red-600">Reciever</label>
                        <span class="block font-semibold">{{ sel_parcel.reciever }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-sm text-red-600">Reveiver's Phone</label>
                        <span class="block font-semibold">{{ sel_parcel.reciever_phone }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-sm text-red-600">Reveiver's Email</label>
                        <span class="block font-semibold">{{ sel_parcel.reciever_email }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-sm text-red-600">Sender</label>
                        <span class="block font-semibold">{{ sel_parcel.sender }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-sm text-red-600">Sender's Phone</label>
                        <span class="block font-semibold">{{ sel_parcel.sender_phone }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="text-sm text-red-600">Sender's Email</label>
                        <span class="block font-semibold">{{ sel_parcel.sender_email }}</span>
                    </div>
                    <div class="mb-3 col-span-2">
                        <label class="text-sm text-red-600">Additional Info.</label>
                        <span class="block font-semibold">{{ sel_parcel.description }}</span>
                    </div>
                </div>
            <hr class="my-3">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" v-if="sel_parcel.status == 'assigned'">
                    <div class="mb-4 col-span-2">
                        <button type="button" @click="confirmParcel" class="col-span-2 mx-1 rounded-md border border-transparent px-2 py-1 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-black focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            <font-awesome-icon :icon="['fas', 'check-circle']" /> Confirm Parcel <span class="hidden sm:inline">for Transit</span>   
                        </button>
                        <button type="button" @click="declineParcel" class="col-span-2 mx-1 rounded-md border border-transparent px-2 py-1 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-black focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            <font-awesome-icon :icon="['fas', 'times-circle']" /> Decline Parcel  
                        </button>
                    </div>
                    
                    <div v-if="errors.length > 0" class="mt-4">
                        <em v-for="error in errors" :key="error" class="text-red-600 text-sm font-bold">
                            {{ error.message }}
                        </em>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4" v-else>
                    <div class="mb-4 col-span-2 text-sm text-red-500">
                        Other operations can only be carried out on your app.
                    </div>
                </div>
            </div>
    </modal-component>

</div>
</template>


<script>
import HttpClient from "../../Mixins/HttpClient";
import ModalComponent from '../ModalComponent';

export default {
props: {
    refresh:Boolean,
},
components:{ModalComponent},
data() {
    return {
        labelStyles:'block text-gray-700 font-bold mb-1',
        inputStyles:`bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 
                        leading-tight focus:outline-none focus:bg-white border focus:border-red-500`,
        parcels: [],
        action:false, 
        showDetails:false,
        sel_parcel:{},
        filter:'all',
        srider:'',
        sstate:'0',
        states:[],
        riders:[],
        user: this.$page.user,
        errors:[]
    };
},
watch:{
    'refresh':function(state){
        if(state == true){
            this.fetchParcelList();
        }
    }
},
mounted() {
    this.fetchParcelList();
    this.loadStates();
    this.fetchRidersList()
},
methods: {
    fetchParcelList() {
        this.errors = [];
    HttpClient.client
        .post('/parcel/rider_parcel/fetch_list', {filter: this.filter, user:this.user})
        .then((response) => {
            this.handleParcelList(response.data);
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
            console.log(error);
        });
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
        },
        handleParcelList(list) {
            this.parcels = list;
        },
        closeModal(){
            this.showDetails = false;
            this.sel_rider = {};
        },
        viewDetails(parcel){
            this.sel_parcel = parcel;
            this.showDetails = true;
        },
        fetchRidersList() {
            this.errors = [];
            HttpClient.client
                .post('/riders/fetch', {filter: this.sstate, filter_by:'id'})
                .then((response) => {
                    this.riders = response.data;
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
                // console.log(error);
            });
        },
        assignRider(parcelid){
            this.errors= [];
            let data = {
                parcelid: parcelid,
                riderid: this.srider
            }
            HttpClient.client
                .post('/parcel/asign_rider', data)
                .then((response) => {
                    this.handleAssignSuccess(response.data)
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
                // console.log(error);
            });
        },
        handleAssignSuccess(res){
            if(res.status == 'success'){
                this.fetchParcelList();
                this.closeModal();
            }else{
                this.errors.push({message:res.message});
            }
        },
        confirmParcel(){
            this.errors = [];
            let data = {
                parcelid : this.sel_parcel.id,
                user : this.user
            }
            HttpClient.client
                .post('/parcel/rider_parcel/confirm', data)
                .then((response) => {
                    this.handleDeclineSuccess(response.data)
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
                // console.log(error);
            });
        },
        handleConfirmSuccess(res){
            if(res.status == 'success'){
                this.fetchParcelList();
                this.closeModal();
            }else{
                this.errors.push({message:res.message});
            }
        },
        declineParcel(){
            this.errors = [];
            let data = {
                parcelid : this.sel_parcel.id,
                user : this.user
            }
            HttpClient.client
                .post('/parcel/rider_parcel/decline', data)
                .then((response) => {
                    this.handleDeclineSuccess(response.data)
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
                // console.log(error);
            });
        },
        handleDeclineSuccess(res){
            if(res.status == 'success'){
                this.fetchParcelList();
                this.closeModal();
            }else{
                this.errors.push({message:res.message});
            }
        },
},
};
</script>

<style scoped>
    
</style>