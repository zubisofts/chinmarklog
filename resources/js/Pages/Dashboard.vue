<template>
    <auth-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-light leading-tight flex-1 pt-2">
                <span class="hidden sm:inline">Dashboard</span>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome />
                </div>
            </div>
        </div>
    </auth-layout>
</template>

<script>
    import AuthLayout from './../Layouts/AuthLayout'
    import Welcome from './../Components/Welcome'

    export default {
        components: {
            AuthLayout,
            Welcome,
        },
    }
</script>
