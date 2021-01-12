<template>
    <div>
        <!-- Red Top HD -->
        <div id="tophd" class="bg-red-600 px-4 xl:px-0 py-1 text-white">
            <div class="container mx-auto max-w-7xl grid md:grid-cols-2 grid-cols-1">
                <div>
                    <inertia-link href="#" class="text-sm mr-2">
                        <strong>
                            <font-awesome-icon :icon="['fas','shipping-fast']" />
                            <span class="hidden md:inline">Instant</span> Delivery
                        </strong>
                    </inertia-link>
                    <inertia-link href="#" class="text-sm mr-2">
                        <strong>
                            <font-awesome-icon icon="phone-square-alt" />
                            Call <span class="hidden md:inline">Now</span>
                        </strong>
                    </inertia-link>
                    <inertia-link href="#" class="text-sm mr-2">
                        <strong>
                            <font-awesome-icon :icon="['far','file-alt']" />
                            <span class="hidden md:inline">Request</span> Quote
                        </strong>
                    </inertia-link>
                </div>
                <div class="text-right">
                    <font-awesome-icon :icon="['fab','facebook-square']"  class="mr-1" />
                    <font-awesome-icon :icon="['fab','whatsapp']"  class="mr-1" />
                    <font-awesome-icon :icon="['fab','twitter']"  class="mr-1" />
                    <font-awesome-icon :icon="['fab','instagram']"  class="mr-1" />
                </div>
            </div>
        </div>

        <!-- Floating Button -->
        <div class="fixed bottom-3 right-3 md:bottom-6 md:right-6 p-2">
            <transition name="slide-fade">
                <tool-bar v-if="showBar"></tool-bar>
            </transition>
        </div>
    </div>
</template>

<script>
import ToolBar from './ToolBar.vue'
export default {
    components:{ToolBar},
    data(){
        return {
            windowTop:'',
            showBar:false,
        }
    },
    mounted() {
        window.addEventListener("scroll", this.onScroll)
    },
    beforeDestroy() {
        // window.removeEventListener("scroll", this.onScroll)
    },
    watch:{
        'windowTop':function (position) {
            var topdiv_height = document.getElementById('tophd').clientHeight;
            if(position > (topdiv_height)){
                this.showBar = true;
            }else{
                this.showBar = false;
            }
        }
    },
    methods: {
        onScroll(e) {
            this.windowTop = window.top.scrollY /* or: e.target.documentElement.scrollTop */
        },
        toggleTools(){
            if (this.showToolsBtn == true) {
                this.showToolsBtn = false
            } else {
                this.showToolsBtn = true
            }
        },
    }
}
</script>

<style scoped>
/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all .4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-leave-active {
  transition: all .4s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateY(10px);
  opacity: 0;
}
</style>