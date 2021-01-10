<template>
    <inertia-link :href="href" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                            ? 'inline-flex items-center px-4 py-2 rounded bg-red-600 text-sm font-medium leading-5 text-gray-100 focus:outline-none focus:bg-red-700 transition duration-150 ease-in-out'
                            : 'inline-flex items-center px-4 py-2 rounded text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:bg-gray-300 focus:outline-none focus:text-gray-700 focus:bg-gray-300 transition duration-150 ease-in-out'
            }
        }
    }
</script>
