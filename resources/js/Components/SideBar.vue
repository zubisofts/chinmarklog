<template>
    <div id="side_bar" class="bg-gray-900 shadow h-full fixed transition-all overflow-auto duration-150 ease-in-out" :class="{'open': openState}">
              
        <div class="user-details mt-5">
            <div class="text-center px-4">
                <div class="text-center">
                    <jet-nav-link :href="route('profile.show')" v-if="$page.user.type > 1">
                        <img class="h-20 w-20 mx-auto rounded-full" :src="$page.user.profile_photo_url" :alt="$page.user.firstname" />
                    </jet-nav-link>
                    <jet-nav-link :href="route('profile.show')" v-else>
                        <input type="hidden" :value="$page.user.id" :title="$page.user.usertype" id="hidden_email_input">
                        <img class="h-20 w-20 mx-auto rounded-full" :src="rider_photo != '' ? `/storage/images/riders/${rider_photo}` : ''" :alt="$page.user.firstname" />
                    </jet-nav-link>
                </div>

                <div class="text-center">
                    <div class="font-large text-base text-white">{{ `${$page.user.firstname} ${$page.user.lastname}` }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ $page.user.email }}</div>
                </div>
            </div>
        </div>

        <!-- Navigations -->
        <nav class="mt-5">
            <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/dashboard"  :active="$page.currentRouteName == 'dashboard'">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                </svg>

                <span class="mx-3">Dashboard</span>
            </inertia-link>

            <!-- <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                href="/Rental-Management" :active="$page.currentRouteName == 'rentals'">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                    </path>
                </svg>

                <span class="mx-3" v-if="$page.user.usertype > 1">
                    Manage Requests
                </span>
                <span class="mx-3" v-else>
                    My Requests
                </span>
            </inertia-link> -->

            <!-- <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                href="/Order-Managements" :active="$page.currentRouteName == 'orders'">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
                <span class="mx-3" v-if="$page.user.usertype > 1">
                    Manage Orders
                </span>
                <span  class="mx-3" v-else>
                    My Orders
                </span>
            </inertia-link> -->

            <span v-if="$page.user.usertype > 1">

                <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/Manage-Offices" :active="$page.currentRouteName == 'branch'">
                    <font-awesome-icon :icon="['fas','hotel']" class="text-xl" />

                    <span class="mx-3">Branch Offices</span>
                </inertia-link>

                <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/Manage-Parcels" :active="$page.currentRouteName == 'parcels'">
                    <font-awesome-icon :icon="['fas','gift']" class="text-xl" />

                    <span class="mx-3">Parcel Management</span>
                </inertia-link>

                <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/Manage-Instant-Pickups" :active="$page.currentRouteName == 'pickups'">
                    <font-awesome-icon icon="shipping-fast" class="text-xl" />

                    <span class="mx-3">Instant Pickups</span>
                </inertia-link>

                <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/Manage-Requested-Quotes" :active="$page.currentRouteName == 'quote_feedback'">
                    <font-awesome-icon :icon="['far','file-alt']" class="text-xl" />

                    <span class="mx-3">Requested Quotes</span>
                </inertia-link>

                <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/Riders-Management" :active="$page.currentRouteName == 'riders'">
                    <font-awesome-icon icon="motorcycle" class="text-xl" />

                    <span class="mx-3">Manage Riders</span>
                </inertia-link>

                <!-- <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/Profile-Management" :active="$page.currentRouteName == 'profile'">
                    <font-awesome-icon icon="user-cog" class="text-xl" />

                    <span class="mx-3">Manage Profile</span>
                </inertia-link> -->
                
                <!-- <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/Customer-Management" :active="$page.currentRouteName == 'customers'">
                    <font-awesome-icon icon="users" class="text-xl" />

                    <span class="mx-3">Manage Customers</span>
                </inertia-link> -->

                <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/Manage-Feedbacks" :active="$page.currentRouteName == 'feedbacks'">
                    <font-awesome-icon icon="headset" class="text-xl" />

                    <span class="mx-3">Contacts/Feedbacks</span>
                </inertia-link>
            </span>
            <span v-else>
                <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/Parcels" :active="$page.currentRouteName == 'rider_parcel'">
                    <font-awesome-icon icon="gift" class="text-xl" />

                    <span class="mx-3">Assigned Parcels</span>
                </inertia-link>
                <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                    href="/Instant-Pickups" :active="$page.currentRouteName == 'pickups'">
                    <font-awesome-icon icon="shipping-fast" class="text-xl" />

                    <span class="mx-3">Instant Pickups</span>
                </inertia-link>
            </span>

            <inertia-link class="flex items-center mt-4 py-2 px-6 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                href="" @click.prevent="logout()">
                <font-awesome-icon icon="sign-out-alt" class="text-xl" />

                <span class="mx-3">Logout</span>
            </inertia-link>
        </nav>
    </div>
</template>

<script>
import JetNavLink from './../Jetstream/NavLink'
import HttpClient from "../Mixins/HttpClient";
export default {
    props:{
        openState: Boolean
    },
    components:{
        JetNavLink
    },
    data(){
        return{
            rider_photo:''
        }
    },
    mounted(){
        let userid = document.getElementById('hidden_email_input').value;
        let usertype = document.getElementById('hidden_email_input').getAttribute('title');
        this.riderPhoto(userid, usertype);
    },
    methods:{
        logout(){
            HttpClient.client.post('http://chinmarklog.com/logout')
            .then((res) => {
                window.location.href = '/';
            })
            .catch((error)=>{
                
            })
        },
        riderPhoto(user_id, type){
            if (type == 1) {
                HttpClient.client.post('/riders/fetch_photo', {id:user_id})
                .then((res) => {
                    this.rider_photo = res.data
                })
                .catch((error)=>{
                    
                })
            }
        }
    }
}
</script>

<style scoped>
    #side_bar{
        z-index: 5;
        width: 250px;
        left: 0;
    }
    #side_bar a[active=true]{
        --text-opacity: 1;
        color: #f4f5f7;
        color: rgba(244, 245, 247, var(--text-opacity));
    }
    @media screen and (max-width: 767px){
        #side_bar{
            left: -250px;
        }
        .open{
            left:0 !important;
        }
    }
</style>