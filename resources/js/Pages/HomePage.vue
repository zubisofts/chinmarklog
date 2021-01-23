<template>
    <app-layout>
        <template #banner>
            <div style="z-index:1;" class="bg-gray-100">
                <home-slider />
            </div>
        </template>
        <service-description></service-description>
        <instant-pickup></instant-pickup>

        
    </app-layout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout.vue';
import HomeSlider from '../Components/HomeSlider.vue';
import ServiceDescription from '../Components/ServiceDescription';
import InstantPickup from '../Components/InstantPickup.vue';
export default {
  components: { AppLayout, HomeSlider, ServiceDescription, InstantPickup },
  data(){
      return{
          page_title: 'Welcome to Chimarklog'
      }
  },
  beforeMount(){
      document.title = this.page_title;
  }
    
}
</script>