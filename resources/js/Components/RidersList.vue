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
                    class="appearance-none rounded border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                    @keyup="fetchRidersList()" v-model="filter"
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
                        Rider's Name
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider hidden sm:table-cell"
                    >
                        Phone Number
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider hidden lg:table-cell"
                    >
                        Email
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider"
                    >
                        Branch
                    </th>
                    </tr>
                </thead>
                <tbody v-if="riders != ''">
                    <tr v-for="rider in riders" :key="rider.id" class="cursor-pointer" @click="viewDetails(rider)">
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                    >
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    <img :src="`/storage/images/riders/${rider.photo}`" alt="" class="w-6 inline">
                                    {{rider.firstname }} {{ rider.lastname }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden sm:table-cell"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                        {{rider.phone}}
                        </p>
                    </td>
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden lg:table-cell"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ rider.email }}
                        </p>
                    </td>
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ rider.branch.name }}
                        </p>
                    </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm" colspan="3">
                            No Riders Record
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
                <div>
                    <img :src="`/storage/images/riders/${sel_rider.photo}`" alt="" class="w-full inline">
                </div>
                <div>
                    <ul>
                        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-3">
                            <li class="mb-2">
                                <strong class="block text-sm text-red-600">Firstname: </strong>
                                <span class="text-base font-bold">{{ sel_rider.firstname }} </span>
                            </li>
                            <li class="mb-2">
                                <strong class="block text-sm text-red-600">Lastname: </strong>
                                <span class="text-base font-bold">{{ sel_rider.lastname }} </span>
                            </li>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-3">
                            <li class="mb-2">
                                <strong class="block text-sm text-red-600">Phone Number: </strong>
                                <span class="text-base font-bold">{{ sel_rider.phone }} </span>
                            </li>
                            <li class="mb-2">
                                <strong class="block text-sm text-red-600">Plate Number: </strong>
                                <span class="text-base font-bold">{{ sel_rider.plate_number }} </span>
                            </li>
                        </div>
                        <li class="mb-2">
                            <strong class="block text-sm text-red-600">Email Address: </strong>
                            <span class="text-base font-bold">{{ sel_rider.email }} </span>
                        </li>
                        <li class="mb-2">
                            <strong class="block text-sm text-red-600">Branch: </strong>
                            <span class="text-base font-bold" v-if="sel_rider.branch">{{ sel_rider.branch.name }} </span>
                        </li>
                        <li class="mb-2">
                            <strong class="block text-sm text-red-600">Other Info.: </strong>
                            <span class="text-base font-bold" v-html="sel_rider.motorcycle"> </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="my-2 p-3 bg-red-600 text-white">
                <span class="font-bold">
                    Assigned Parcels
                </span>
            </div>
            <table class="min-w-full leading-normal">
                <thead class="bg-red-600 text-white font-bold" v-if="sel_rider.parcel && sel_rider.parcel.length > 0">
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">Parcel ID</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">Destination</th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody v-if="sel_rider.parcel && sel_rider.parcel.length > 0">
                    <tr v-for="(parcel, i) in sel_rider.parcel" :key="i">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"> {{ parcel.trackingid }} </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"> {{ parcel.reciever_address }} </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"> 
                            <font-awesome-icon :icon="['fas', 'gift']" style="font-size:1.2rem;" class="text-gray-700" v-if="parcel.status == 'unassigned'" />
                            <font-awesome-icon :icon="['fas', 'gift']" style="font-size:1.2rem;" class="text-blue-700" v-if="parcel.status == 'assigned'" />
                            <font-awesome-icon :icon="['fas', 'shipping-fast']" style="font-size:1.2rem;" class="text-green-600" v-if="parcel.status == 'transit'" />
                            <font-awesome-icon :icon="['far', 'stop-circle']" style="font-size:1.2rem;" class="text-red-600" v-if="parcel.status == 'stopped'" />
                            <font-awesome-icon :icon="['fas', 'check-circle']" style="font-size:1.2rem;" class="text-green-600" v-if="parcel.status == 'delivered'" />
                            <span class="text-gray-700" v-if="parcel.status == 'unassigned'">{{ parcel.status }}</span>
                            <span class="text-blue-700" v-if="parcel.status == 'assigned'">{{ parcel.status }}</span>
                            <span class="text-green-600" v-if="parcel.status == 'transit'" >{{ parcel.status }}</span>
                            <span class="text-red-600" v-if="parcel.status == 'stopped'">{{ parcel.status }}</span>
                            <span class="text-green-600" v-if="parcel.status == 'delivered'">{{ parcel.status }}</span>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">No Parcel Assigned to {{ sel_rider.firstname }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </modal-component>
</div>
</template>


<script>
import HttpClient from "./../Mixins/HttpClient";
import ModalComponent from '../Components/ModalComponent.vue';

export default {
props: {
    refresh:Boolean,
},
components:{ModalComponent},
data() {
    return {
    riders: [],
    action:false, 
    showDetails:false,
    sel_rider:{},
    filter:''
    };
},
watch:{
    'refresh':function(state){
        if(state == true){
            this.fetchRidersList();
        }
    }
},
mounted() {
    this.fetchRidersList();
},
methods: {
    fetchRidersList() {
    // Url to fetch the list of rented vehicles
    var url = "/riders/fetch";
    // send a post http request to fetch list of rental vehicles
    HttpClient.client
        .post(url, {filter: this.filter})
        .then((response) => {
            this.handleRidersList(response.data);
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
    handleRidersList(list) {
        this.riders = list;
    },
    closeModal(){
        this.showDetails = false;
        this.sel_rider = {};
    },
    viewDetails(rider){
        this.sel_rider = rider;
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