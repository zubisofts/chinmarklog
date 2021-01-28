<template>
<div class="max-w-7xl mx-auto sm:px-6">
    <div class="container mx-auto sm:px-8">
    <div class="py-3">
        
        <div class="my-2 flex sm:flex-row flex-col px-2">
            <div class="flex flex-row mb-1 sm:mb-0 z-0">
                <div class="relative">
                    <select @change="fetchParcelList()" v-model="filter"
                        class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    >
                        <option value="all">All</option>
                        <option value="new">New</option>
                        <option value="assigned">Assigned</option>
                        <option value="on_transit">On Transit</option>
                        <option value="delivered">Delivered</option>
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                    >
                        <svg
                        class="fill-current h-4 w-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        >
                        <path
                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                        />
                        </svg>
                    </div>
                    </div>
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
                    class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
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
                        Parcel ID
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider hidden sm:table-cell"
                    >
                        Reciever
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider hidden lg:table-cell"
                    >
                        Sender
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider"
                    >
                        Status
                    </th>
                    </tr>
                </thead>
                <tbody v-if="parcels != ''">
                    <tr v-for="parcel in parcels" :key="parcel.id" class="cursor-pointer" @click="viewDetails(parcel)">
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{parcel.trackingid}}
                        </p>
                    </td>
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden sm:table-cell"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{parcel.reciever}}
                        </p>
                    </td>
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden lg:table-cell"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ parcel.sender }}
                        </p>
                    </td>
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ parcel.status }}
                        </p>
                    </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" colspan="4">
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
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <h2>Parcel Details</h2>


                <h2>Assign to Rider</h2>
                <form @submit.prevent="assignRider">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label :class="labelStyles" for="sender"> Sender's Name <sup class="text-red-500">*</sup> </label>
                            <select :class="inputStyles" v-model="sstate">
                                <option value="all"> All Riders </option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label :class="labelStyles" for="sphone"> Select Rider <sup class="text-red-500">*</sup> </label>
                            <select :class="inputStyles" v-model="srider">
                                <option v-for="rider in riders" :key="rider.id" :value="rider.id"> {{ rider.firstname + ' ' +  rider.firstname }} </option>
                            </select>
                        </div>
                    </div>
                </form>
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
    parcels: [],
    action:false, 
    showDetails:false,
    sel_parcel:{},
    filter:'all'
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
},
methods: {
    fetchParcelList() {
    // Url to fetch the list of rented vehicles
    var url = "/parcel/fetch";
    // send a post http request to fetch list of rental vehicles
    HttpClient.client
        .post(url, {filter: this.filter})
        .then((response) => {
            this.handleParcelList(response.data);
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
    }
},
};
</script>

<style scoped>
    tr.unseen{
        font-weight: bold;
    }
</style>