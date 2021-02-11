<template>
    <auth-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-light leading-tight flex-1 pt-2">
                Manage Branch Offices
            </h2>
        </template>

    
    <transition name="fade"> 
    <div v-if="(states.length < 1) && (showAlert == true)" class="max-w-7xl mx-auto py-3 px-4 bg-red-200 text-red-900">
        <strong>No State Detected!</strong> Every branch must belong to a state. Please click on the "Manage States" button to add states where chinmark 
        logistics will operate.
    </div>
    </transition>

        <!-- Header -->
        <div class="py-3 mt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow sm:rounded-sm sm:flex">
                    <div class="flex-1">
                        <h3 class="px-4 py-2 text-xl">
                            <font-awesome-icon icon="hotel" class="text-xl" /> Branch Offices
                        </h3>
                    </div>

                    <div class="flex-2 text-right py-2 px-4">
                        <button
                        @click="showAddModal = true"
                        class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
                         v-if="states.length > 0"
                        >
                            <font-awesome-icon icon="plus" /> <span class="hidden md:inline">Add</span> New Branch
                        </button>

                        <button @click="showCategories = true"
                        class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
                        >
                            <font-awesome-icon icon="cogs" /> <span class="hidden lg:inline">Manage</span> States
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="py-3">
            <branch-list  :refresh="refresh_state" />
        </div>

        <!-- Modal -->
        <modal-component :prop-show="showCategories" @closeModal="closeModal()">
            <div>
                <states-component />
            </div>
        </modal-component>

        
        <!-- Modal -->
        <modal-component :prop-show="showAddModal" @closeModal="closeModal()">
            <form @submit.prevent="addBranch" ref="addform">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label :class="labelStyles" for="sender"> Branch Name <sup class="text-red-500">*</sup> </label>
                        <input :class="inputStyles" id="sender" type="text" required v-model="branch" placeholder="Branch Name" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="phone"> Contact Phone </label>
                        <input :class="inputStyles" id="phone" type="tel" required v-model="phone" placeholder="Contact Phone Number" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="address"> Address </label>
                        <input :class="inputStyles" id="address" type="text" v-model="address" placeholder="Branch Address" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="city"> City </label>
                        <input :class="inputStyles" id="city" type="text" v-model="city" placeholder="City Located" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="state"> State <sup class="text-red-500">*</sup> </label>
                        <select :class="inputStyles" v-model="sstate" placeholder="Reciever's state">
                            <option v-for="state in states" :key="state.id" :value="state.id"> {{ state.name }} </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="desc"> Additional Info <small> (if any?) </small> </label>
                        <input :class="inputStyles" id="desc" type="text" v-model="desc" placeholder="Additional Information/Description" />
                    </div>
                    <div class="mb-2">
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
import ModalComponent from '../Components/ModalComponent.vue';
import StatesComponent from '../Components/ParcelComponents/StatesComponent.vue';
import httpClient from '../Mixins/HttpClient';
import BranchList from '../Components/BranchList.vue';

export default {
    components: { AuthLayout, ParcelList, ModalComponent, StatesComponent , BranchList},
    data(){
        return {
            branch:'',
            phone:'',
            address:'',
            city:'',
            desc: '',
            sstate: '',
            showCategories:false,
            showAddModal:false,
            refresh_state:false,
            showAlert:false,
            states:[],
            labelStyles:'block text-gray-700 font-bold mb-1',
            inputStyles:`bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 
                            leading-tight focus:outline-none focus:bg-white border focus:border-red-500`,
            showAlert:false,
            errors:[]
        }
    },
    beforeMount(){
        document.title = "Manage Branch Offices";
        this.loadStates();
        setTimeout(() => {
            this.showAlert = true;
        }, 1000);
    },
    methods:{
        loadStates(){
            this.errors = [];
            httpClient.client
            .post("/parcel/fetch_states")
            .then((response) => {
                this.states = response.data;
                this.sstate = this.states[0];
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
            this.loadStates()
        },
        addBranch(){
            this.errors = [];
            let data = {
                branch:this.branch,
                phone:this.phone,
                address:this.address,
                city:this.city,
                desc: this.desc,
                sstate: this.sstate,
            }
            httpClient.client
            .post("/parcel/store_branch", data)
            .then((response) => {
                this.handleSaveBranch(response.data)
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
        handleSaveBranch(){
            this.branch = '';
            this.phone = '';
            this.address = '';
            this.city = '';
            this.desc = '';
            this.sstate = '';
            this.$refs.addform.reset();
            this.showAddModal = false;
            this.refresh_state = true;
            setTimeout(() => {
                this.refresh_state = false;
            }, 500);
        }
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