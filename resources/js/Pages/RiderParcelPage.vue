<template>
    <auth-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-light leading-tight flex-1 pt-2">
                Manage Parcels
            </h2>
        </template>

        <!-- Header -->
        <div class="py-3 mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow sm:rounded-sm sm:flex">
                    <div class="flex-1">
                        <h3 class="px-4 py-2 text-xl">
                            <font-awesome-icon icon="gift" class="text-xl" /> Parcel's List
                        </h3>
                    </div>

                    <!-- <div class="flex-2 text-right py-2 px-4">
                        <button
                        @click="showAddModal = true"
                        class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
                        >
                            <font-awesome-icon icon="plus" /> <span class="hidden md:inline">Add</span> New Parcel
                        </button>

                        <button @click="showCategories = true"
                        class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
                        >
                            <font-awesome-icon icon="cogs" /> <span class="hidden lg:inline">Manage</span> Category
                        </button>
                    </div> -->
                </div>
            </div>
        </div>

        
        <div class="py-3">
            <assigned-parcel-list :refresh="refresh_state" />
        </div>

        <!-- Modal -->
        <modal-component :prop-show="showCategories" @closeModal="closeModal()">
            <div>
                
            </div>
        </modal-component>

    </auth-layout>
</template>

<script>
import AssignedParcelList from '../Components/ParcelComponents/AssignedParcelList.vue';
import AuthLayout from '../Layouts/AuthLayout.vue';
import ModalComponent from '../Components/ModalComponent.vue';
import HttpClient from '../Mixins/HttpClient';

export default {
    components: { AuthLayout, AssignedParcelList, ModalComponent },
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

        }
    },
    beforeMount(){
        document.title = "Manage Parcels";
        // fetch Categories
        HttpClient.client.post('parcel/category/fetch')
        .then((res) => {
            this.categories = res.data;
        })
    },
    mounted(){
        this.loadStates();
    },
    methods:{
        loadStates(){
            HttpClient.client
            .post("/parcel/fetch_states")
            .then((response) => {
                this.states = response.data;
            })
            .catch((error) => {
                if(error.response){
                    console.log(error.response.message.data);
                }else{
                    alert('An error occured due to Network!');
                }
            });
        },
        closeModal(){
            this.showCategories = false;
            this.showAddModal = false;
        },
        storeParcel(){
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
                    console.log(error.response.message.data);
                }else{
                    alert('An error occured due to Network!');
                }
            });
        },
        handleStoreSuccess(data){
            if(data.status == 'success'){
                this.refresh_state = true;
                this.closeModal();
            }
        }
    }
    
}
</script>