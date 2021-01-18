<template>
  <auth-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-light leading-tight flex-1 pt-2">
        Manage Feedbacks
      </h2>
    </template>
    <div class="py-3 mt-3">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow sm:rounded-sm flex">
          <div class="flex-1">
            <h3 class="px-4 py-2 text-xl">
              <font-awesome-icon icon="headset" class="text-xl" /> Customers' Feedbacks
            </h3>
          </div>
        </div>
      </div>
    </div>
    <div class="py-3">
      <feedback-list></feedback-list>
    </div>
  </auth-layout>
</template>

<script>
    import AuthLayout from '../Layouts/AuthLayout'
    import FeedbackList from '../Components/FeedbackList'

    export default {
        components: {
            AuthLayout,
            FeedbackList,
        },
         data(){
            return {
                showModal: false
            }
        },
        methods:{
            closeModal(){
                this.showModal = false;
            }
        }
    }
</script>