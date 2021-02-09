<template>
    <div id="serv_descr" class=" h-30">
        <div class="" id="red_bg">
            <div class="container max-w-6xl py-6 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Grid Colunm 4 -->
                <div class="py-2 text-white grid grid-cols-4">
                    <h2 class="font-bold cols-span-1 text-center">
                        <font-awesome-icon icon="headset" size="2x" class="mt-3"></font-awesome-icon>
                    </h2>
                    <div class="col-span-3">
                        <span class="font-bold text-xl">Call Center</span>
                        <p class="text-sm">
                            Feel free to give us a call on <br>
                            <inertia-link href="tel:08000000000">080 0000 0000</inertia-link>
                        </p>
                    </div>
                </div>
                <!-- Grid Colunm 4 -->
                <div class="py-2 text-white grid grid-cols-4">
                    <h2 class="font-bold cols-span-1 text-center">
                        <font-awesome-icon icon="stopwatch" size="2x" class="mt-3"></font-awesome-icon>
                    </h2>
                    <div class="col-span-3">
                        <span class="font-bold text-xl">Working Hours</span>
                        <p class="text-sm">
                            <span class="font-bold">Mon - Fri: </span> 7AM-5PM <br>
                            <span class="font-bold">Sat: </span> 9AM-3PM
                        </p>
                    </div>
                </div>
                <!-- Grid Colunm 4 -->
                <div class="py-2 text-white grid grid-cols-4">
                    <h2 class="font-bold cols-span-1 text-center">
                        <font-awesome-icon icon="map-pin" size="2x" class="mt-3"></font-awesome-icon>
                    </h2>
                    <div class="col-span-3">
                        <span class="font-bold text-xl">Our Locations</span>
                        <p class="text-sm">
                            Our Head Office: Enugu <br>
                            <inertia-link href="#">See all our Branch Offices</inertia-link> 
                        </p>
                    </div>
                </div>
                <!-- Grid Colunm 4 -->
                <div class="py-2 text-white grid grid-cols-4">
                    <h2 class="font-bold cols-span-1 text-center">
                        <font-awesome-icon :icon="['far','file-alt']" size="2x" class="mt-3"></font-awesome-icon>
                    </h2>
                    <div class="col-span-3">
                        <span class="font-bold text-xl">Request Quote</span>
                        <p class="text-sm">
                            Get a Quote for any prefered logistics service.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container max-w-6xl py-8 my-6 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Grid Colunm 3 -->
            <div class="py-3">
                <div class="py-4 px-6 text-center md:text-right uppercase">
                    <h4 class="font-bold text-xl">OUR SERVICES</h4>
                    <h2 class="font-bold text-2xl md:text-3xl">
                        OUR COMPANY CORE VALUES
                    </h2>
                </div>
            </div>
            <!-- Grid Colunm 3 -->
            <div class="py-1 mx-4 md:mx-0">
                <div class="bg-white border rounded shadow-lg p-4 grid grid-cols-6 gap-4">
                    <div class="text-right font-bold text-red-600">
                        <font-awesome-icon icon="shipping-fast" size="2x" class="mt-3" />
                    </div>
                    <div class="col-span-5">
                        <h2 class="mb-3 font-bold text-red-600 text-2xl">Pickups</h2>
                        <p>
                            Our dynamic and swift response parcel managers are always ready do pickup 
                            from your location to your preffered location in less significant time.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Grid Colunm 3 -->
            <div class="py-1 mx-4 md:mx-0">
                <div class="bg-white border rounded shadow-lg p-4 grid grid-cols-6 gap-4">
                    <div class="text-right font-bold text-red-600">
                        <font-awesome-icon icon="thumbtack" size="2x" class="mt-3" />
                    </div>
                    <div class="col-span-5">
                        <h2 class="mb-3 font-bold text-red-600 text-2xl">Track Your Parcel</h2>
                        <p>
                            Track the movement of your parcel dynamically from pickup to delivery as you 
                            wait for it to get your parcel to arrive on time.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Grid Colunm 3 -->
            <div class="py-1 mx-4 md:mx-0">
                <div class="bg-white border rounded shadow-lg p-4 grid grid-cols-6 gap-4">
                    <div class="text-right font-bold text-red-600">
                        <font-awesome-icon :icon="['far','file-alt']" size="2x" class="mt-3" />
                    </div>
                    <div class="col-span-5">
                        <h2 class="mb-3 font-bold text-red-600 text-2xl">Request Quote</h2>
                        <p>
                            In Chinmark Logistics, we left a space for our users to place their 
                            quote request and get a response from us based on their quote request.
                            
                        </p>
                    </div>
                </div>
            </div>
            <!-- Grid Colunm 3 -->
            <div class="py-1 mx-4 md:mx-0">
                <div class="bg-white border rounded shadow-lg p-4 grid grid-cols-6 gap-4">
                    <div class="text-right font-bold text-red-600">
                        <font-awesome-icon icon="truck-moving" size="2x" class="mt-3" />
                    </div>
                    <div class="col-span-5">
                        <h2 class="mb-3 font-bold text-red-600 text-2xl">Fast Delivery</h2>
                        <p>
                            Our riders realiable and deliver speedily without stories. Buy it, we deliver 24/7, 
                            No stress, No stories.
                        </p>
                    </div>
                </div>
            </div>
            <!-- Grid Colunm 3 -->
            <div class="py-1 mx-4 md:mx-0">
                <div class="text-center">
                    <div class="col-span-6">
                        <img src="/images/bike.png" alt="" class="mx-auto" style="max-height:100%; max-width:100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    #serv_descr{
        min-height: 200px;
        background-image: url('/images/atlas.png');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }
    #red_bg{
        background-color: rgba(255, 0, 0, 0.7);
    }
</style>