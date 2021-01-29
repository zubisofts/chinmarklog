<template>
    <app-layout>
        <template #banner>
            <div style="z-index:1;" class="bg-gray-100">
                <page-banner></page-banner>
            </div>
        </template>
        <faq-description></faq-description>
        <service-description></service-description>
    </app-layout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout.vue';
import HomeSlider from '../Components/HomeSlider.vue';
import FaqDescription from '../Components/FaqDescription';
import ServiceDescription from '../Components/ServiceDescription';
import PageBanner from '../Components/PageBanner.vue';

export default {
  components: { AppLayout, HomeSlider, PageBanner, FaqDescription, ServiceDescription },
  data(){
      return{
          page_title: 'Faq - Chimarklog'
      }
  },
  beforeMount(){
      document.title = this.page_title;
  }
    
}
</script>