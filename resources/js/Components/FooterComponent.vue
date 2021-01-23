<template>
    <div class="py-8 text-white" id="footer">

        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            <!-- First Column -->
            <div class="col-span-1 py-2 px-4 lg:col-span-1">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center text-center">
                    <inertia-link :href="route('home')" class="mx-auto">
                        <img src="/images/foot_logo.png" class="mh-100 mx-auto" style="max-width:100%; max-height:200px;" />
                    </inertia-link>
                </div>
            </div>
            <!-- Second Column -->
            <div class="col-span-1 py-2 px-4">
                <h3 class="font-bold pb-3">
                    OUR SERVICES
                </h3>

                <hr class="border-2 border-red-300" style="max-width:20%;">
                <hr class="border-1 border-red-300 mt-0 mb-3" style="max-width:80%;">

                <ul class="py-2 px-4 md:px-1">
                    <li class="mb-3">
                        <inertia-link href="" class="hover:text-red-300 my-2">
                            <font-awesome-icon icon="stopwatch" class="mr-1"></font-awesome-icon>
                            Pickup/Fast Delivery
                        </inertia-link>
                    </li>
                    <li class="mb-3">
                        <inertia-link href="" class="hover:text-red-300 my-2">
                            <font-awesome-icon icon="truck-moving" class="mr-1"></font-awesome-icon>
                            Trucks/Cargo Logistics
                        </inertia-link>
                    </li>
                    <li class="mb-3">
                        <inertia-link href="" class="hover:text-red-300 my-2">
                            <font-awesome-icon icon="warehouse" class="mr-1"></font-awesome-icon>
                            Parcel Warehousing
                        </inertia-link>
                    </li>
                </ul>
            </div>
            <!-- Third Column -->
            <div class="col-span-1 py-2 px-4">
                <h3 class="font-bold pb-3">
                    QUICK LINKS
                </h3>
                
                <hr class="border-2 border-red-300" style="max-width:20%;">
                <hr class="border-1 border-red-300 mt-0 mb-3" style="max-width:80%;">

                <ul class="py-2 px-4 md:px-1">
                    <li class="mb-3">
                        <inertia-link href="" class="hover:text-red-300 my-2">
                            <font-awesome-icon :icon="['far','file-alt']" class="mr-1"></font-awesome-icon>
                            Request a Quick Quote
                        </inertia-link>
                    </li>
                </ul>
            </div>

            <!-- Fouth Column -->
            <div class="col-span-1 py-2 px-4">
                <h3 class="font-bold pb-3">
                    CONTACTS
                </h3>
                
                <hr class="border-2 border-red-300" style="max-width:20%;">
                <hr class="border-1 border-red-300 mt-0 mb-3" style="max-width:80%;">

                <ul class="py-2 px-4 md:px-1">
                    <li class="mb-3">
                        <inertia-link href="" class="hover:text-red-300 my-2">
                            <font-awesome-icon :icon="['fab','markdown']" class="mr-1"></font-awesome-icon>
                            108 Marshall Avenue, Enugu State, Nigeria
                        </inertia-link>
                    </li>
                    <li class="mb-3">
                        <inertia-link href="tel:+2348000000000" class="hover:text-red-300 my-2">
                            <font-awesome-icon icon="phone-alt" class="mr-1"></font-awesome-icon>
                            080 0000 0000
                        </inertia-link>
                    </li>
                    <li class="mb-3">
                        <inertia-link href="" class="hover:text-red-300 my-2">
                            <font-awesome-icon icon="envelope" class="mr-1"></font-awesome-icon>
                            support@Chimarklog.com
                        </inertia-link>
                    </li>
                    <li class="mt-2 pt-2">
                        <a href="" target="blank" class="h-8 w-8 text-center inline-block rounded-full bg-red-600 mx-1">
                            <font-awesome-icon :icon="['fab', 'facebook-square']" class="mt-2" />
                        </a>
                        <a href="" target="blank" class="h-8 w-8 text-center inline-block rounded-full bg-red-600 mx-1">
                            <font-awesome-icon :icon="['fab', 'whatsapp']" class="mt-2" />
                        </a>
                        <a href="" target="blank" class="h-8 w-8 text-center inline-block rounded-full bg-red-600 mx-1">
                            <font-awesome-icon :icon="['fab', 'instagram']" class="mt-2" />
                        </a>
                        <a href="" target="blank" class="h-8 w-8 text-center inline-block rounded-full bg-red-600 mx-1">
                            <font-awesome-icon :icon="['fab', 'twitter']" class="mt-2" />
                        </a>
                        <a href="" target="blank" class="h-8 w-8 text-center inline-block rounded-full bg-red-600 mx-1">
                            <font-awesome-icon :icon="['fab', 'youtube']" class="mt-2" />
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="border-gray-800 mt-6">
        <div class="text-center text-gray-100 p-4">
            Copyright &copy; Chinmark Group of Company Ltd. {{ year.getFullYear() }}
        </div>
    </div>
</template>

<script>
import HttpClient from "./../Mixins/HttpClient";

export default {
    data(){
        return {
            year: new Date(),
            email:'',
        }
    },
    methods:{
        saveSubscibtion(){
            let data = new FormData();

            console.log(this.email);

            // data appending
            data.append('email', this.email);

            HttpClient.client
            .post('/customer/store_subscribtion_email', data)
            .then((response) => {
                this.handleSave(response.data);
            })
            .catch((error) => {
                if(error.response){
                    console.log(error.response.data.message);
                }else{
                    console.log("A Network Error Occured");
                }
            });
        },
        handleSave(data){
            if(data.status == "success"){
                document.forms['form_subscribtion'].reset();
                alert("Thanks for Subscribing");
            }else{
                console.log(data.message);
            }
        }
    }
}
</script>


<style scoped>
    #footer{
        min-height: 200px;
        background-image: url('/images/atlas.png');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-color: rgba(0, 0, 0, 0.9);
    }

    @media only screen and (max-width: 580px) {
        .newsCarDiv{
            display: none;
        }
    }
</style>