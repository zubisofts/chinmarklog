<template>
    <div id="servdescr" class=" h-30" v-if="!openParcelDetails">
        <div class="">
            <div class="container max-w-6xl py-6 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                <!-- Grid Colunm 6 -->
                <div class="py-2 px-3" id="track-left-div">
                    <div id="trackicon">
                        <font-awesome-icon icon="map-marker" id="icon"  class="mr-1" />
                    </div>
                </div>
                <div class="py-2 px-3 text-black">
                    <!-- <img src="images/logo.png" style="width:170px"> -->
                    <div class="mb-4 mt-5">
                        <h2 class="font-bold text-2xl md:text-3xl">TRACK YOUR GOODS</h2>
                    </div>
                    <form method="post" name="tracking_form"  @submit.prevent="checkTrackid">
                        <div class="row mb-5">
                            <div class="form-group">
                                <input v-model="trackid" type="text" name="trackingid" id="fullname" :class="form_input" placeholder="Enter your Tracking Number" required style="padding: 0.9rem 0.8rem; font-size:1.2em">
                            </div>
                        </div>
                         <button type="submit" class="btn bg-red-500 font-bold text-gray-100 col-span-5 py-2 px-2 w-full rounded-r">
                            TRACK GOODS
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <parcel-description  v-else :track-id="trackid"></parcel-description>
</template>

<style scoped>
    #track-left-div{
        background-color:  rgb(252, 73, 73);
        clip-path: polygon(0 0, 100% 0, 61% 100%, 0% 100%);
        min-height: 200px;
        background-image: url('/images/atlas.png');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat
    }
    #trackicon{
        font-size: 5.0em;
        margin: 40px 0;
        text-align: center;
    }
    /* #icon{
        color: linear-gradient(to right, #fd0606, #000000);
    } */
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
import HttpClient from "../Mixins/HttpClient";
import ParcelDescription from "../Components/ParcelDescription.vue"
export default {
    components:{
        ParcelDescription
    },
    data(){
        return{
            form_input:'border focus:border-red-500 w-full rounded px-3 py-2 resize-none text-gray-700',
            trackid:'',
            openParcelDetails:false,
            displayParcelDetails:[],
        }
    },
    watch:{
        'openParcelDetails': function (state) {
            console.log(state);
        }
    },
    methods:{
        checkTrackid(){
            let data = new FormData;
            data.append('trackid', this.trackid);

            HttpClient.client
            .post("/parcel/check_trackid", data)
            .then((response) => {
                this.handleDisplayParcel(response.data);
            })
        },
        handleDisplayParcel(response){
            console.log(response);
            
            if(response.count > 0){
                this.displayParcelDetails = response.parceldetail;
                this.openParcelDetails = true;
            }else{
                alert('Invalid Tracking Number')
                // this.modal_msg = 'Invalid Tracking Number';
                // this.modal_type = 'error';
                this.modalShowState = true;
            }
        }
    }
}
</script>