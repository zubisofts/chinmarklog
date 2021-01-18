<template>
    <div>
        <section>
            <transition name="slide-fade">
                <div class="q-buttons-containers" v-if="show">
                    <inertia-link href="#" class="my-1 block">
                        <button type="button" @click="show = !show" class="rounded-full w-9 h-9 bg-red-600 text-white">
                            <font-awesome-icon :icon="['fas','shipping-fast']" style="font-size:1.3rem;" class="mt-1 mx-auto" />
                        </button>
                    </inertia-link>
                    <inertia-link href="#" class="my-1 block">
                        <button type="button" @click="show = !show" class="rounded-full w-9 h-9 bg-red-600 text-white">
                            <font-awesome-icon  icon="phone-square-alt" style="font-size:1.3rem;" class="mt-1 mx-auto" />
                        </button>
                    </inertia-link>
                    <inertia-link :href="route('quote')" class="my-1 block">
                        <button type="button" @click="show = !show" class="rounded-full w-9 h-9 bg-red-600 text-white">
                            <font-awesome-icon :icon="['far','file-alt']" style="font-size:1.3rem;" class="mt-1 mx-auto" />
                        </button>
                    </inertia-link>
                </div>
            </transition>
            <button type="button" @click="show = !show" class="rounded-full w-9 h-9 bg-red-600 text-white">
                <font-awesome-icon v-if="show" :icon="['fas', 'times']" style="font-size:1.3rem;" class="mt-1 mx-auto" />
                <font-awesome-icon v-else :icon="['far', 'hand-pointer']" style="font-size:1.3rem;" class="mt-1 mx-auto" />
            </button>
        </section>
    </div>
</template>

<script>
export default {
    data(){
        return {
            show:false
        }
    },
    watch:{
        'show': function (val) {
            this.show = val
        }
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