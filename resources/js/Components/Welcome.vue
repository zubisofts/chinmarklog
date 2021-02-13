<template>
    <div>
        <div class="p-6 sm:px-20 bg-gray-900 border-b border-gray-200">
            <div>
                <img src="/images/logo.png" class="block h-16 w-auto" />
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 lg:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <font-awesome-icon icon="gift" class="text-3xl text-gray-500" />
                    <div  v-if="$page.user.usertype > 1" class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><inertia-link href="/Manage-Parcels">Manage All Parcels</inertia-link></div>
                    <div v-else class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><inertia-link href="/Parcels">Assigned Parcels</inertia-link></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        <span v-if="$page.user.usertype > 1">
                            See the status of all the parcels that have been logged through this module. Re-affirm your 
                            parcel status or assigned them to riders for transit and fast delivery...
                        </span>
                        <span v-else>
                            See the status of all the parcels that have been logged through this module. Accept or decline parcels 
                            that are assigned to you for transit.
                        </span>
                    </div>

                    <inertia-link href="/Manage-Parcels" v-if="$page.user.usertype > 1">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>View parcels here</div>

                                <div class="ml-1 text-indigo-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                        </div>
                    </inertia-link>
                    <inertia-link href="/Parcels" v-else>
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>View parcels here</div>

                                <div class="ml-1 text-indigo-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                        </div>
                    </inertia-link>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l" v-if="$page.user.usertype > 1">
                <div class="flex items-center">
                    <font-awesome-icon icon="motorcycle" class="text-3xl text-gray-500" />
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><inertia-link href="/Riders-Management">Manage Riders</inertia-link></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        <span>
                            Add riders and assign parcels and pickups to them based on their various states, branches and routes. 
                            Manage and view the status of rider's committments as they carry-out thier fundamental duties.
                        </span>
                    </div>

                    <inertia-link href="/Riders-Management">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>View list of riders</div>

                                <div class="ml-1 text-indigo-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                        </div>
                    </inertia-link>
                </div>
            </div>
            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l" v-else>
                <div class="flex items-center">
                    <font-awesome-icon icon="shipping-fast" class="text-3xl text-gray-500" />
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><inertia-link href="/Instant-Pickups">Instant Pickups</inertia-link></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        <span>
                            View and conirm all instant pickup requests that have been assigned to you. 
                        </span>
                    </div>

                    <inertia-link href="/Instant-Pickups">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>View Pickup Requests</div>

                                <div class="ml-1 text-indigo-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                        </div>
                    </inertia-link>
                </div>
            </div>


            <div class="p-6 border-t border-gray-200" v-if="$page.user.usertype > 1">
                <div class="flex items-center">
                    <font-awesome-icon icon="shipping-fast" class="text-3xl text-gray-500" />
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><inertia-link href="/Manage-Instant-Pickups">Instant Pickup Request</inertia-link></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        View and manage all instant pickup request from customers and assign them to riders for fast pickup 
                        and delivery.
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-l" v-if="$page.user.usertype > 1">
                <div class="flex items-center">
                    <font-awesome-icon icon="headset" class="text-3xl text-gray-500" />
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><inertia-link href="/Manage-Feedbacks">Contacts/Feedbacks</inertia-link></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        View, reply and manage all contacts, complaints, feedbacks and suggestions recieved from 
                        bond logistic users.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>