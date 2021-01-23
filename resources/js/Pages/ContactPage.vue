<template>
    <app-layout>
        <template #banner>
            <div style="z-index:1;" class="bg-gray-100">
                <page-banner></page-banner>
            </div>
        </template>

        <div class="container max-w-6xl mx-auto sm:px-6 lg:px-8">
            <contact-details></contact-details>
            <contact-form></contact-form>
        </div>
    </app-layout>
</template>

<script>
import ContactDetails from '../Components/ContactDetails.vue';
import ContactForm from '../Components/ContactForm.vue';
import AppLayout from '../Layouts/AppLayout'
import PageBanner from '../Components/PageBanner.vue';

    export default {
        components: {
            AppLayout,
            ContactDetails,
            ContactForm,
            PageBanner
        },
        data(){
            return {
                page_title: 'Contact Us'
            }
        },
        beforeMount(){
            document.title = this.page_title;
        }
    }
</script>
