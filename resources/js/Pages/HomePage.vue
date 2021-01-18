<template>
    <app-layout>
        <div style="z-index:1;" class="bg-gray-100">
            <home-slider />
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../Layouts/AppLayout.vue';
import HomeSlider from '../Components/HomeSlider.vue';
export default {
  components: { AppLayout, HomeSlider },
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