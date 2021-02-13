<template>
    <auth-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-light leading-tight flex-1 pt-2">
                Pickup Request
            </h2>
        </template>

        <!-- Header -->
        <div class="py-3 mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow sm:rounded-sm sm:flex">
                    <div class="flex-1">
                        <h3 class="px-4 py-2 text-xl">
                            <font-awesome-icon icon="shipping-fast" class="text-xl" /> Request List
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="py-3">
            <rider-pickup-list :refresh="refresh_state" />
        </div>


    </auth-layout>
</template>

<script>
import ParcelList from '../Components/ParcelComponents/ParcelList.vue';
import AuthLayout from '../Layouts/AuthLayout.vue';
import ParcelCategory from "../Components/ParcelComponents/ParcelCategory";
import ModalComponent from '../Components/ModalComponent.vue';
import RiderPickupList from '../Components/ParcelComponents/RiderPickupList';
// import HttpClient from '../Mixins/HttpClient';

export default {
    components: { AuthLayout, ParcelList, ParcelCategory, ModalComponent, RiderPickupList },
    data(){
        return {
            refresh_state:false,

        }
    },
    beforeMount(){
        document.title = "Manage Parcels";
    },
    mounted(){
    },
    methods:{
    }
    
}
</script>