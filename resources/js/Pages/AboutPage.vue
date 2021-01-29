<template>
    <app-layout>
        <template #banner>
            <div style="z-index:1;" class="bg-gray-100">
                <page-banner></page-banner>
            </div>
        </template>
        <about-description></about-description>
        <service-statistic></service-statistic>
        <service-description></service-description>

    </app-layout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout.vue';
import HomeSlider from '../Components/HomeSlider.vue';
import AboutDescription from '../Components/AboutDescription';
import ServiceStatistic from '../Components/ServiceStatistic';
import ServiceDescription from '../Components/ServiceDescription';
import PageBanner from '../Components/PageBanner.vue';

export default {
  components: { AppLayout, HomeSlider, PageBanner, AboutDescription, ServiceStatistic, ServiceDescription },
  data(){
      return{
          page_title: 'About Us - Chimark Logistics'
      }
  },
  beforeMount(){
      document.title = this.page_title;
  }
    
}
</script>