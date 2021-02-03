<template>
    <app-layout>
        <template #banner>
            <div style="z-index:1;" class="bg-gray-100">
                <page-banner></page-banner>
            </div>
        </template>
        <parcel-description></parcel-description>
    </app-layout>
</template>

<script>
    import AppLayout from '../Layouts/AppLayout.vue';
    import HomeSlider from '../Components/HomeSlider.vue';
    import ParcelDescription from '../Components/ParcelDescription';
    import PageBanner from '../Components/PageBanner.vue';

    export default {
    components: { AppLayout, HomeSlider, PageBanner, ParcelDescription  },
    data(){
        return{
            page_title: 'Tracking - Chimarklog'
        }
    },
    beforeMount(){
        document.title = this.page_title;
    }
        
    }
</script>