<template>
    <div>
        <div class="sm:px-2">
            <div class="container max-w-6xl py-6 mx-auto grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1" style="text-align:center; padding:50px 0 30px; color:#261c6a;">
                <div class="" id="trackText">
                    <h2 class="font-bold text-2xl md:text-3xl">YOUR PARCEL DETAILS</h2>
                </div>
            </div>
            <!-- Tracking number row -->
            <div class="container max-w-6xl py-6 mx-auto grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1">
                <div class="bg-gray">
                    <p class="pTextBold">
                        <strong>
                            Tracking ID: 
                            <i style="padding:10px 10px 1px; display:inline-block; border-bottom: 2pt solid #ff7900; font-style:normal;">DF9937</i>
                        </strong>
                    </p>
                </div>
            </div>
            <!-- Estimated parcel delivery dates and destination row -->
            <div class="container max-w-6xl py-6 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                <div class="">
                    <div class="card-body cardHeadEdit">
                        <p class="pTextBold">SHIPMENT DATES</p>
                    </div>
                    <div class="table-responsive mt-1">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>Estimated Time of Departuer (ETD)</td>
                                    <td><b>today</b></td>
                                </tr>
                                <tr>
                                    <td>Estimated Time of Arrival (ETA)</td>
                                    <td><b>tomorrow</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="">
                    <div class="card-body cardHeadEdit ">
                        <p class="pTextBold">PARCEL'S ROUTE</p> 
                    </div>
                    <div class="table-responsive mt-1">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>From</td>
                                    <td><b>pickup</b></td>
                                </tr>
                                <tr>
                                    <td>To</td>
                                    <td><strong>dropoff</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Sender and Recievers Details row -->
            <div class="container max-w-6xl py-2 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                <div class="">
                    <div class="card-body cardHeadEdit ">
                        <p class="pTextBold">SENDER'S DETAILS</p>
                    </div>
                    <div class="table-responsive mt-1">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td><b>Chinmark Foods</b></td>
                                </tr>
                                <tr>
                                    <td>Origin</td>
                                    <td><b>send location</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="">
                    <div class="card-body cardHeadEdit ">
                        <p class="pTextBold">RECIEVER'S DETAILS</p>
                    </div>
                    <div class="table-responsive mt-1">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td><b>Noble Okechi</b></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><b>ok@gmail.com</b></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><strong>090</strong></td>
                                </tr>
                                 <tr>
                                    <td>Address</td>
                                    <td><strong>64 Abagana Str</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Shipment/Parcel Details row -->
            <div class="container max-w-6xl py-2 mx-auto grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1">
                <div class="">
                    <div class="card-body cardHeadEdit ">
                    <p class="pTextBold">SHIPMENT DETAILS</p>
                    </div>
                </div>
            </div>
            <div class="container max-w-6xl py-2 mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                <div class="">
                    <div class="table-responsive mt-1">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>Item Description</td>
                                    <td><b>description</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="">
                    <div class="table-responsive mt-1">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <tr>
                                    <td>Weight and Dimension</td>
                                    <td><b>dimension</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Travel Timeline row -->
            <div class="container max-w-6xl py-2 mx-auto grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1">
                <div class="">
                    <div class="card-body cardHeadEdit ">
                    <p class="pTextBold">TRAVEL TIMELINE</p>
                    </div>
                </div>
            </div>
            <div class="container max-w-6xl py-2 mx-auto grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <!-- <div class="mt-1"> -->
                        <table class="min-w-full leading-normal">
                            <thead class="text-black font-bold">
                                <tr >
                                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">DATE</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">TIME</th>
                                    <th class="hidden md:table-cell px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">ACTIVITY</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">LOCATION</th>
                                </tr>
                            </thead>
                            <tbody class="flex-1">
                                <tr class="wrap sm:table-row mb-2 sm:mb-0">
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">date</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">time</td>
                                    <td class="hidden md:table-cell px-5 py-5 border-b border-gray-200 bg-white text-sm">activity</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">location</td>
                                </tr>
                            </tbody>
                        </table>
                    <!-- </div> -->
                </div>
            </div>

            <!-- PROGRESS BAR ROW -->
            <div class="container max-w-6xl py-6 mx-auto grid grid-cols-1 md:grid-cols-1 lg:grid-cols- progressBarRow">
                <div class="">
                    <div class="card-body">
                        <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="alert alert-success" >
                            <p><b>Receiver Name</b>, your parcel is safely intransit and its currently at</p>
                        </div>
                        <div class="alert alert-danger" >
                            <p><b>Message</b></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<style scoped>
    .cardHeadEdit{
        background-color: #f30909;
        padding: 4px 10px !important;
        color: #fff;
    }
    .progressBarRow{
        background-color: #f30000;
        padding: 60px 20px !important;
        color: #fff;
    }
</style>

<script>
import HttpClient from "../Mixins/HttpClient";
export default {
    props:{
        trackId : String
    },
    data(){
        return {
            displayParcelDetails : {},
            trackid:this.trackId,
            // displayParcelDetails: []
            // startDate:'',
            // displayParcelTimeline:[],
            // pacs:'',
            // test:'50%'
        }
    },
    beforeCreate(){
        
    },
    mounted(){
        // var _token = this.token;
        // Request for the parcel detail from the database using the trackid
        this.fetchParcelDetails();

    },
    methods:{
        fetchParcelDetails(){
            console.log(this.trackId);
            // trackid:this.trackId
            let data = new FormData;
            data.append('trackid', this.trackid);

            HttpClient.client
            .post("/parcel/check_trackid", data)
            .then((response) => {
                this.handleDisplayParcel(response.data);
            })
            // RETRIEVING TIMELINE INFO
            // Api.client.post('parcel/getparceltimeline', getDetails)
            // .then((res)=>{
            //     this.displayParcelTimeLine(res);
            // });
        },
        handleDisplayParcel(response){
            console.log(response);
            if(response.count > 0){
                this.displayParcelDetails = response.parceldetail[0];
                // let currentnow = response.data.now;
                // console.log(this.displayParcelDetails.endint);
                // let total = this.displayParcelDetails.endint - this.displayParcelDetails.startint;
                // // console.log(total);
                // let now = currentnow - this.displayParcelDetails.startint;
                // // console.log(now +'this is it');
                // this.pacs = (now/total*100)-10;
                // // console.log(this.pacs);
                // if (this.pacs > 90){
                //     this.pacs = 90;
                // }
                // console.log(this.pacs); 
            }else{
                alert('Invalid Tracking Number')
            }
        },
        displayParcelTimeLine(response){
            if(response.count > 0){
                this.displayParcelTimeline = response.parceldetail;
                // console.log(this.displayParcelTimeLine);
            }else{
                // alert('Invalid Tracking Number');
            }
        }

        
    }
}
</script>