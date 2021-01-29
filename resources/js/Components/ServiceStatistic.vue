<template>
    <div id="services_stat">
        <div class="" id="red_bg">
            <div class="container max-w-6xl py-6 mx-auto grid grid-cols-1 lg:grid-cols-4 gap-4" id="top_stat_hd">
                <div class="lg:col-span-1 text-center" id="stat_side" data-aos="fade-right" style="color:#ffffff">
                    <aside class="mb-5">
                        <h1 class="font-bold text-2xl md:text-3xl text-center">BASE FACTS AND FIGURES</h1>
                    </aside>
                    <aside class="mb-5">
                        <h1 class="font-bold text-2xl md:text-3xl">{{ statistics.customers }}</h1>
                        <span>
                            Clients/Customers
                        </span>
                    </aside>
                    <aside class="mb-5">
                        <h1 class="font-bold text-2xl md:text-3xl">{{ statistics.branches }}</h1> 
                        <span>
                            Branches
                        </span>
                    </aside>
                    <aside>
                        <h1 class="font-bold text-2xl md:text-3xl">{{ statistics.vehicles }}</h1>
                        <span>
                            Owned Vehicles 
                        </span>
                    </aside>
                </div>
                <div class="lg:col-span-3" data-aos="zoom-in">
                    <img src="/images/logistic_vehicles.jpg" alt=" " class="mx-auto" style="max-width:100%;">
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    #top_stat_hd{
        text-align: center;
    }
    #top_stat_hd h2{
        color: #261c6a;
        font-weight: bolder;
    }
    #top_stat_hd p{
        font-size: 1.2rem;
    }
    #stat_side{
        text-align:center;
    }

    #services_stat{
        min-height: 200px;
        background-image: url('/images/img5.jpeg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
    }
    #red_bg{
        background-color: rgba(251, 61, 61, 0.7);
    }
    
</style>

<script>
export default {
    data(){
        return {
            statistics:{
                customers: 0,
                vehicles: 0,
                branches: 0
            },
            interval: false,
            actualStat:{
                customers: 8200,
                vehicles: 237,
                branches: 357
            }
        }
    },
    created () {
        window.addEventListener('scroll', this.handleScroll);
    },
    destroyed () {
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
        handleScroll () {
        let myComponent = document.getElementById('services_stat');
        let myComponentHD = document.getElementById('top_stat_hd');
        let winCurrentPos = window.scrollY;
            if ((winCurrentPos + window.innerHeight) >= (myComponent.offsetTop + myComponentHD.scrollHeight + 50)) {
                this.animateNumbers();
            } 
        },
        animateNumbers(){
            if(this.statistics.customers >= this.actualStat.customers){
                clearInterval(this.interval);
                return;
            }
            let stat = this.statistics;
            let aStat = this.actualStat;
            this.interval = window.setInterval(function () {
                if(stat.customers < aStat.customers){
                    stat.customers += 5
                }
                if(stat.vehicles < aStat.vehicles){
                    stat.vehicles += 1
                }
                if(stat.branches < aStat.branches){
                    stat.branches += 1
                }
            },20)
        }
    }
}
</script>