<template>
<div class="max-w-7xl mx-auto sm:px-6">
    <div class="container mx-auto sm:px-8">
    <div class="py-3" v-if="!showDetails">
        
        <div class="my-2 flex sm:flex-row flex-col px-2">
            <div class="flex flex-row mb-1 sm:mb-0 z-0">
                <div class="relative">
                    <select @change="fetchContactList()" v-model="filter"
                        class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    >
                        <option value="all">All</option>
                        <option value="unseen">Unseen</option>
                        <option value="seen">Seen</option>
                        <option value="replied">Replied</option>
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
                        Customer
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider"
                    >
                        Subject
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider hidden md:table-cell"
                    >
                        Date
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="contact in contacts" :key="contact.id" :class="contact.status" class="cursor-pointer" @click="showFeedbackDetails(contact)">
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                    >
                        <div class="flex items-center">
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap">
                                {{contact.fulname}}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                        {{contact.subject}}
                        </p>
                    </td>
                    <td
                        class="px-5 py-5 border-b border-gray-200 bg-white text-sm hidden md:table-cell"
                    >
                        <p class="text-gray-900 whitespace-no-wrap">
                            {{ formatDate(contact.created_at) }}
                        </p>
                    </td>
                    </tr>
                </tbody>
                </table>
                <!-- <div
                class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between"
                >
                <span class="text-xs xs:text-sm text-gray-900">
                    Showing 1 to 4 of 50 Entries
                </span>
                <div class="inline-flex mt-2 xs:mt-0">
                    <button
                    class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l"
                    >
                    Prev
                    </button>
                    <button
                    class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r"
                    >
                    Next
                    </button>
                </div>
                </div> -->
            </div>
        </div>
    </div>

    <div class="py-3" v-else>
        <feadback-details :feedback-data="feedback" @showContactList="showList()"></feadback-details>
    </div>
    </div>
</div>
</template>


<script>
import HttpClient from "../Mixins/HttpClient";
import FeadbackDetails from './FeadbackDetails.vue'; 

export default {
props: {},
components: {FeadbackDetails},
data() {
    return {
    contacts: [],
    action:false, 
    filter:'all',
    feedback:{},
    showDetails:false
    };
},
mounted() {
    this.fetchContactList();
},
methods: {
    fetchContactList() {
    // Url to fetch the list of rented vehicles
    var url = "/contacts/fetch";
    // send a post http request to fetch list of rental vehicles
    HttpClient.client
        .post(url, {filter: this.filter})
        .then((response) => {
            this.handleContactList(response.data);
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
    handleContactList(list) {
    this.contacts = list;
    console.log(list);
    },
    formatDate(date){
        let d_date = new Date(date);
        let testDate = d_date.toDateString();
        return testDate;
    },
    showFeedbackDetails(contact){
        this.feedback = contact;
        this.showDetails = true;
        this.updateStatus('seen', contact.id);
    },
    showList(){
        this.showDetails = false;
    },
    updateStatus(status, id){
         HttpClient.client
        .post('/contacts/update', {status: status, id: id})
        .then((response) => {
            this.fetchContactList();
        })
        .catch((error) => {
            if (error.response) {
                console.log(error.response.data.message);
            } else {
                console.log("An error occoured probably due to network!");
            }
            console.log(error);
        });
    }
},
};
</script>

<style scoped>
    tr.unseen{
        font-weight: bold;
    }
</style>