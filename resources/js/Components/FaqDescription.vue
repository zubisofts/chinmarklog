<template>
    <div id="servdescr" class=" h-30">
        <div class="">
            <div class="container max-w-6xl py-6 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                <!-- Grid Colunm 6 -->
                <div class="py-2 px-3 text-black">
                    
                    <div id="app" class="container mx-auto bg-white border-grey-light border">
                        <accordion title="How do we work?">
                        <p class="pb-5">Coming soon...</p>
                        </accordion>
                        <accordion title="What services do we offer?">
                        <p class="pb-5">Coming soon...</p>
                        </accordion>
                        <accordion title="What does it cost to use your logistics service?">
                        <p class="pb-5">Costs for our logistics and delivery services will vary based upon the size and weight of the item, how quickly you need the item delivered and the distance from your pick up point and delivery point. Contact us or use our online request form for an accurate quote.</p>
                        </accordion>
                        <accordion title="How quickly can you deliver my package?">
                        <p class="pb-5">Our rush courier and delivery services can vary in terms of delivery time. We offer a rush service where a rider will pick up and deliver your package direct with no stops in between; which is usually delivered in under 60 minutes. </p>
                        <p class="pb-5">Other delivery services we offer include a 3 hour delivery, a 5 hour delivery, and a same day delivery which would deliver your package before end of business day. Contact us for more details regarding the types of services we provide.</p>
                        </accordion>    
                        <accordion title="How does your online delivery quote works?">
                        <p class="pb-5">Simply fill out your name, phone number, email, pick up and delivery destination, and details of your delivery and we will get back to you with a quote within minutes.</p>
                        </accordion> 
                        <accordion title="What hours are You open and when do you make deliveries?">
                        <p class="pb-5">We understand that not every delivery is going to fall in between normal business hours so we are conveniently open 24/7 and can make a delivery at legal work hours.</p>
                        </accordion>  
                    </div><!-- #app -->

                </div>
                <!-- Grid Colunm 6 -->
                <div class="text-white">
                    <div class="">
                        <img src="/images/img3.jpeg" alt="" class="mx-auto" style="max-height:100%; max-width:100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    #serv_descr{
        min-height: 200px;
        background-image: url('/images/atlas.png');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }
    .red_bg{
        background-color: rgba(252, 73, 73, 0.7);
    }
    .bg-color{
        background-color:  rgb(252, 73, 73);
    }
    .bg-color:hover{
        background-color:  rgb(175, 25, 25);
    }
</style>

<script>
var accordion = {
  props: [
    'title'
  ],
  data() {
    return {
      active: false,
    }
  },
  template: `
            <div class="">
                <div class="tab__header">
                    <a href="#" class="tab__link p-4 block bg-color no-underline text-white bg-red-700 hover:bg-red-500 border-b-2 border-white flex justify-between" @click.prevent="active = !active">
                        <strong>{{title}}</strong>
                        <span class="down-Arrow" v-show="!active">&#9660;</span>
                        <span class="up-Arrow" v-show="active">&#9650;</span>
                    </a>
                </div>
                <div class="tab__content p-2" v-show="active"><slot /></div>            
            </div>
`
}

// var app = new Vue({
//   el: '#app',
//   components: {
//     accordion
//   }
// });

export default {
 components: {
    accordion
  }

}

</script>