<template>
    <div>
        <div class="overflow-hidden flex mb-4">
            <div class="flex-1 py-2 px-4">
                <button
                @click="showList"
                class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
                >
                <font-awesome-icon icon="arrow-left" /> Back
                </button>
            </div>

            <div class="flex-2 text-right py-2 px-4">
            <button
                @click="showModal = !showModal"
                class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
            >
                <font-awesome-icon icon="share" /> Reply
            </button>
            </div>
        </div>

        <div class="bg-white py-3 px-4">
            <header class="grid grid-cols-10">
                <aside class="col-span-2 lg:col-span-1">
                    <strong>From:</strong>
                </aside>

                <aside class="col-span-8 lg:col-span-9 text-gray-900">
                    <p class="mb-1"> <font-awesome-icon :icon="['far', 'user']" /> {{ feedback.name }}</p>
                    <p class="mb-1"> <font-awesome-icon icon="envelope" /> {{ feedback.email }}</p>
                    <p class="mb-1"> <font-awesome-icon icon="phone-alt" /> {{ feedback.phone }}</p>
                </aside>
            </header>

            <header class="bg-red-600 text-white my-3 text-center py-2 px-2">
                <strong>
                    Requested Category: {{ feedback.category.category }}
                </strong>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="mb-3">
                    <label class="text-sm text-red-600">Departure Address</label>
                    <span class="block font-semibold">{{ feedback.departure_address }}</span>
                </div>
                <div class="mb-3">
                    <label class="text-sm text-red-600">Destination</label>
                    <span class="block font-semibold">{{ feedback.destination }}</span>
                </div>
                <div class="mb-3">
                    <label class="text-sm text-red-600">Category</label>
                    <span class="block font-semibold" v-if="feedback.category">{{ feedback.category.category }}</span>
                </div>
                <div class="mb-3">
                    <label class="text-sm text-red-600">Size/Weight</label>
                    <span class="block font-semibold">{{ feedback.weight }}</span>
                </div>
                <div class="mb-3 col-span-2">
                    <label class="text-sm text-red-600">Detailed Description/Info.</label>
                    <div class="py-3 px-4 bg-red-200" style="min-height:200px;">
                        <span class="block font-semibold">{{ feedback.description }}</span>
                    </div>
                </div>
            </div>
            
        </div>

        <modal-component :prop-show="showModal" @closeModal="closeModal()">
            <template #modal_title>
                <font-awesome-icon icon="plus" />
            </template>
            <div>
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                        <div class="mb-4">
                            <label :class="labelStyles" for="sender"> Sender </label>
                            <input :class="inputStyles" id="sender" type="text" readonly v-model="sender" placeholder="Sender's Email" />
                        </div>
                        <div class="mb-4">
                            <label :class="labelStyles" for="recipient"> Recipient </label>
                            <input :class="inputStyles" id="recipient" type="text" readonly v-model="recipient" placeholder="Recipient's Email" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="subject"> Message Subject </label>
                        <input :class="inputStyles" id="subject" type="text" v-model="subject" required placeholder="Enter a subject for message" />
                    </div>
                    <div class="mb-4">
                        <label :class="labelStyles" for="message"> Message </label>
                        <ckeditor :editor="editor" id="message" v-model="message" :class="inputStyles" placeholder="'Enter Message Body'"></ckeditor> 
                    </div>
                    <div class="mb-4 text-right">
                        <button type="button" @click="closeModal()"
                        class="bg-red-500 text-white cursor-pointer py-1 px-2 rounded shadow"
                        >
                            <font-awesome-icon icon="times" /> Cancel
                        </button>
                        <button type="submit"
                        class="bg-gray-900 text-white cursor-pointer py-1 px-2 rounded shadow"
                        >
                            <font-awesome-icon icon="paper-plane" /> Send Message
                        </button>
                    </div>
                </form>
            </div>
        </modal-component>

    </div>
</template>

<script>
import ModalComponent from './../ModalComponent';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    components:{
        ModalComponent
    },
    props:{
        feedbackData:Object
    },
    data(){
        return {
            showModal:false,
            feedback: this.feedbackData,
            labelStyles:'block text-gray-700 font-bold mb-1',
            inputStyles:`bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 
                            leading-tight focus:outline-none focus:bg-white border focus:border-black`,
            sender:'support@chinmarklog.com',
            recipient: this.feedbackData.email,
            subject:'',
            editor: ClassicEditor,
            message:''
        }
    },
    methods:{
        showList(){
            this.$emit('showContactList');
        },
        closeModal(){
            this.showModal = false
        }
    }
}
</script>

<style>
.ck-editor__editable{
    max-height: 300px !important;
    min-height: 150px !important;
}
</style>