<template>
    <app-layout>
        <template #banner>
            <div style="z-index:1;" class="bg-gray-100">
                <page-banner></page-banner>
            </div>
        </template>

        <div class="container max-w-6xl mx-auto my-6">
            <div class="grid grid-cols-1 md:grid-cols-12 w-full">
                <div class="md:col-span-8 p-6">
                    <div class="p-4 shadow-sm border rounded">
                        <form>
                            <h2 class="uppercase text-lg sm:text-xl md:text-2xl my-4 font-bold">
                                <font-awesome-icon :icon="['far','file-alt']" class="text-red-600 mr-4" />
                                Request a quick quote
                            </h2>
                            <p class="text-gray-600 font-medium">
                                Please fill in your request and contact details, and we will contact you as soon as possible
                            </p>

                            <div class="my-8 grid grid-cols-1 lg:grid-cols-3">
                                <div class="text-red-600 text-lg font-bold mb-3 upercase">
                                    <font-awesome-icon icon="gift" class="text-red-600 mr-1" />
                                    Product areas
                                </div>
                                <div class="col-span-2 grid grid-cols-1 sm:grid-cols-2">
                                    <aside class="mb-3">
                                        <input type="radio" name="category" id="parcel" value="parcel" v-model="category"> 
                                        <label for="parcel">Parcels (35 kg or less) </label>
                                    </aside>
                                    <aside class="mb-3">
                                        <input type="radio" name="category" id="mail" value="mail" v-model="category"> 
                                        <label for="mail">Mails/Postal services  </label>
                                    </aside>
                                    <aside class="mb-3">
                                        <input type="radio" name="category" id="pickup" value="pickup" v-model="category"> 
                                        <label for="pickup">Pickups/Express deliveries </label>
                                    </aside>
                                    <aside class="mb-3">
                                        <input type="radio" name="category" id="warehouse" value="warehouse" v-model="category"> 
                                        <label for="warehouse">Warehouse services </label>
                                    </aside>
                                    <aside class="mb-3">
                                        <input type="radio" name="category" id="cargo" value="cargo" v-model="category"> 
                                        <label for="cargo">Truck/Cargo Logistics </label>
                                    </aside>
                                    <aside class="mb-3">
                                        <input type="radio" name="category" id="brokerage" value="brokerage" v-model="category"> 
                                        <label for="brokerage">Brokerage </label>
                                    </aside>
                                    <aside class="mb-3">
                                        <input type="radio" name="category" id="all" value="all" v-model="category"> 
                                        <label for="all">All Services </label>
                                    </aside>
                                </div>
                            </div>

                            <div class="my-8 grid grid-cols-1">
                                <p class="text-gray-600 font-medium mb-3">
                                    Your enquiry: Please give us as much detail as possible, in order to help 
                                    us respond in the most efficient manner possible.
                                </p>
                                <aside class="mb-3">
                                    <textarea name="desc" id="desc" cols="30" rows="6" placeholder="Enter Detailed Description"
                                    class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700"></textarea>
                                </aside>
                            </div>

                            <div class="my-8 grid grid-cols-1 gap-4">
                                <div class="text-red-600 text-lg font-bold mb-3 upercase">
                                    <font-awesome-icon :icon="['far', 'user']" class="text-red-600 mr-1" />
                                    Contact Information
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="mb-1">
                                        <strong>Fullname</strong>
                                        <input type="text" id="fname" placeholder="Enter your fulname"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700" />
                                    </div>
                                    <div class="mb-1">
                                        <strong>Contact Phone</strong>
                                        <input type="text" id="phone" placeholder="Enter contact phone"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700" />
                                    </div>
                                    <div class="mb-1">
                                        <strong>Email Address</strong>
                                        <input type="text" id="email" placeholder="Email Address"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700">
                                    </div>
                                    <div class="mb-1">
                                        <strong>Company Name <small>(Optional)</small></strong>
                                        <input type="text" id="company" placeholder="Company name (if any)"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700">
                                    </div>
                                    <div class="mb-1">
                                        <strong>Gross Weight <small>(in Kg.)</small></strong>
                                        <input type="text" id="weight" placeholder="Total Gross Weight in KG"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700">
                                    </div>
                                    <div class="mb-1">
                                        <strong>Address/City of Departure</strong>
                                        <input type="text" id="depature_addr" placeholder="Address of Departure"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700">
                                    </div>
                                    <div class="mb-1">
                                        <strong>Delivery Address/City </strong>
                                        <input type="text" id="delivery_addr" placeholder="Delivery Address/City"
                                            class="border focus:border-red-500 w-full rounded px-4 py-3 resize-none text-gray-700">
                                    </div>
                                    <div class="mb-1">
                                        <strong> &nbsp; </strong>
                                        <button type="text" id="fname" placeholder="Delivery Address/City"
                                            class="border focus:border-red-500 bg-red-500 text-white w-full rounded-lg px-4 py-3 resize-none">
                                            <font-awesome-icon icon="paper-plane" class="mr-4" />
                                            REQUEST QUOTE
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="md:col-span-4 bg-red-200 p-6">
                    Hello
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout.vue';
import HomeSlider from '../Components/HomeSlider.vue';
import PageBanner from '../Components/PageBanner.vue';
export default {
  components: { AppLayout, HomeSlider, PageBanner },
  data(){
      return{
          page_title: 'Request A Quote - Chimarklog',
          category:''
      }
  },
  beforeMount(){
      document.title = this.page_title;
  }
    
}
</script>
