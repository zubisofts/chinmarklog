<template>
    <div id="app-layout">
        <quick-action-bar></quick-action-bar>
        <!-- White Header with Navs -->
        <header class="xl:px-0 sticky top-0 bg-gray-100 shadow">
            <div class="container mx-auto max-w-7xl grid lg:grid-cols-3 grid-cols-1">
                <div class="py-2 px-4">
                    <img src="/images/logo.png" alt="logo" class="h-12 inline-block">
                    <!-- Hamburger -->
                    <div class="mr-2 mt-2 flex float-right items-center sm:hidden">
                        <button @click="showDropdown = ! showDropdown" class="inline-flex items-center justify-center rounded-md text-gray-400 focus:outline-none ml-auto mr-2 transition duration-150 ease-in-out">
                            <svg class="h-8 w-8 p-1 border rounded" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': showDropdown, 'inline-flex': ! showDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! showDropdown, 'inline-flex': showDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div>
                    <main-navbar :show-dropdown="showDropdown"></main-navbar>
                </div>
            </div>
        </header>

        <!-- Page Details -->
        <slot></slot>
    </div>
</template>

<style scoped>

</style>

<script>
import MainNavbar from "../Components/MainNavbar.vue";
import QuickActionBar from "../Components/QuickActionBar.vue";

export default {
    components: { MainNavbar, QuickActionBar },
    data(){
        return {
            showDropdown: false
        }
    }
}

</script>