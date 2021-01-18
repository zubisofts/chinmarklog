<template>
    <div>
        <div class="p-6 sm:px-20 bg-gray-900 border-b border-gray-200">
            <div>
                <img src="/images/logo.png" class="block h-16 w-auto" />
            </div>

            <div class="mt-4 text-2xl  text-yellow-400">
                <strong>Chinmark Logistics</strong> Dashboard!
            </div>

            <!-- <div class="mt-6 text-white">
                Manage all operations, orders, request and feedbacks.
            </div> -->
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 lg:grid-cols-2">
            <div class="p-6">
                <div class="flex items-center">
                    <svg class="h-8 w-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                        </path>
                    </svg>
                    <div  v-if="$page.user.usertype > 1" class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><inertia-link href="/Rental-Management">Manage Requests</inertia-link></div>
                    <div v-else class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><inertia-link href="/Rental-Management">My Requests</inertia-link></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        <span>
                            See the status of all the request made by you through this module. Re-affirm your 
                            request have been attended to or send feed back to customers services representatives.
                        </span>
                    </div>

                    <inertia-link href="/Rental-Management">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>View requests here</div>

                                <div class="ml-1 text-indigo-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                        </div>
                    </inertia-link>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                <div class="flex items-center">
                <svg class="h-8 w-8 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><inertia-link href="/Order-Managements">My Orders</inertia-link></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        <span>
                            See the status of all the orders made by you on this module. Re-affirm your 
                            request have been attended to or send feed back to customers services representatives.
                        </span>
                    </div>

                    <inertia-link href="/Order-Managements">
                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>View orders here</div>

                                <div class="ml-1 text-indigo-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </div>
                        </div>
                    </inertia-link>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200">
                <div class="flex items-center">
                    <font-awesome-icon icon="car" class="text-3xl text-gray-500" />
                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><inertia-link href="/Vehicle-Management">Manage Vehicles</inertia-link></div>
                </div>

                <div class="ml-12">
                    <div class="mt-2 text-sm text-gray-500">
                        Manage rental and sales vehicles! Add and edit vehicles, specifications, locations and 
                        manage all the information related to bond logistics vehicles.
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-200 md:border-l">
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