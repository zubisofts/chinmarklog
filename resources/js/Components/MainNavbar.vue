<template>
    <div id="main_nav">
        <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-right">
                <!-- Navigation Links -->
                <div class="hidden py-4 sm:-my-px sm:ml-auto sm:inline-flex">
                    <jet-nav-link :href="route('home')" :active="$page.currentRouteName == 'home'">
                        <font-awesome-icon icon="home" class="mr-1" /> Home
                    </jet-nav-link>
                    <jet-nav-link :href="route('about')" :active="$page.currentRouteName == 'about'">
                        <font-awesome-icon icon="info-circle"  class="mr-1" /> About
                    </jet-nav-link>
                    <jet-nav-link :href="route('services')" :active="$page.currentRouteName == 'services'">
                        <font-awesome-icon :icon="['fab','servicestack']"  class="mr-1" /> Services
                    </jet-nav-link>
                    <jet-nav-link :href="route('faq')" :active="$page.currentRouteName == 'faq'">
                        <font-awesome-icon :icon="['far','question-circle']"  class="mr-1" /> FAQ
                    </jet-nav-link>
                    <jet-nav-link :href="route('reviews')" :active="$page.currentRouteName == 'reviews'">
                        <font-awesome-icon :icon="['fab','rev']"  class="mr-1" /> Reviews
                    </jet-nav-link>
                    <jet-nav-link :href="route('contact')" :active="$page.currentRouteName == 'contact'">
                        <font-awesome-icon icon="map-marker"  class="mr-1" /> Contact
                    </jet-nav-link>
                    <jet-nav-link :href="route('tracking')" :active="$page.currentRouteName == 'tracking'">
                        <font-awesome-icon icon="thumbtack"  class="mr-1" /> Tracking
                    </jet-nav-link>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden bg-white">
                <div class="space-y-1">
                    <jet-responsive-nav-link :href="route('home')" :active="$page.currentRouteName == 'home'">
                        <font-awesome-icon icon="home" class="mr-1" /> Home
                    </jet-responsive-nav-link>
                    
                    <jet-responsive-nav-link :href="route('about')" :active="$page.currentRouteName == 'about'">
                        <font-awesome-icon icon="info-circle"  class="mr-1" /> About
                    </jet-responsive-nav-link>
                    
                    <jet-responsive-nav-link :href="route('services')" :active="$page.currentRouteName == 'services'">
                        <font-awesome-icon :icon="['fab','servicestack']"  class="mr-1" /> Services
                    </jet-responsive-nav-link>
                    
                    <jet-responsive-nav-link :href="route('faq')" :active="$page.currentRouteName == 'faq'">
                        <font-awesome-icon :icon="['far','question-circle']"  class="mr-1" /> FAQ
                    </jet-responsive-nav-link>
                    
                    <jet-responsive-nav-link :href="route('reviews')" :active="$page.currentRouteName == 'reviews'">
                        <font-awesome-icon :icon="['fab','rev']"  class="mr-1" /> Reviews
                    </jet-responsive-nav-link>
                    
                    <jet-responsive-nav-link :href="route('contact')" :active="$page.currentRouteName == 'contact'">
                        <font-awesome-icon icon="map-marker"  class="mr-1" /> Contact
                    </jet-responsive-nav-link>
                    
                    <jet-responsive-nav-link :href="route('tracking')" :active="$page.currentRouteName == 'tracking'">
                        <font-awesome-icon icon="thumbtack"  class="mr-1" /> Tracking
                    </jet-responsive-nav-link>
                </div>
            </div>
    </div>
</template>

<script>
    import JetNavLink from './../Jetstream/NavLink'
    import JetResponsiveNavLink from './../Jetstream/ResponsiveNavLink'

    export default {
        props:{showDropdown:Boolean},
        components:{
            JetNavLink,
            JetResponsiveNavLink
        },
        data() {
            return {
                showingNavigationDropdown: false,
                classes: ''
            }
        },
        watch:{
            'showDropdown': function (state) {
                this.showingNavigationDropdown = state;
            }
        },
        
    }
</script>

<style scoped>
    
</style>