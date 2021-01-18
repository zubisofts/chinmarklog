<template>
    <hooper :autoPlay="true" :playSpeed="5000" :infiniteScroll="true"
    class="bg-gray-300 text-center">

        <slide v-for="(item, index) in slides" :key="index" :style="{'background-image': `url(${item.image})`}"
         style="background-repeat:no-repeat; background-position:center; background-size:cover;">
            <!-- Inner Content -->

        </slide>

        <hooper-pagination slot="hooper-addons"></hooper-pagination>
        <hooper-navigation slot="hooper-addons"></hooper-navigation>
    </hooper>
</template>

<script>
import { Hooper, Slide, Pagination as HooperPagination, Navigation as HooperNavigation } from 'hooper';
export default {
    components: {
        Hooper,
        Slide,
        HooperPagination,
        HooperNavigation
    },
    data(){
        return {
            slides: [
                {
                    image: '/images/slider/slide1.jpg',
                    h2:'Hello My friend'
                },
                {
                    image: '/images/slider/slide2.jpg',
                    h2:'How are you doing'
                },
                {
                    image: '/images/slider/slide3.png',
                    h2:'How are you doing'
                }
            ],
            slideStyles: {
                'background-repeat':'no-repeat'
            }
        }
    }
}
</script>

<style>
    .hooper-slide {
        flex-shrink: 0;
        height: 100%;
        margin: 0;
        padding: 0;
        list-style: none;
        background-color: rgba(20, 30, 46, 1);
        color: white;
    }
    .hooper {
        position: relative;
        box-sizing: border-box;
        width: 100%;
        height: 450px;
    }
    .hooper * {
        box-sizing: border-box;
    }
    .hooper-list {
        overflow: hidden;
        width: 100%;
        height: 100%;
    }
    .hooper-track {
        display: flex;
        box-sizing: border-box;
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
    }
    .hooper.is-vertical .hooper-track {
        flex-direction: column;
        height: 200px;
    }

    .hooper.is-rtl {
        direction: rtl;
    }

    .hooper-sr-only {
        position: absolute;
        width: 1px;
        height: 1px;
        padding: 0;
        margin: -1px;
        overflow: hidden;
        clip: rect(0, 0, 0, 0);
        border: 0;
    }
    /* Pagination */
    .hooper-pagination {
        position: absolute;
        bottom: 0;
        right: 50%;
        transform: translateX(50%);
        display: flex;
        padding: 5px 10px;
    }
    .hooper-indicators {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
    }
    .hooper-indicator:hover,
    .hooper-indicator.is-active {
        background-color: #4285f4;
    }
    .hooper-indicator {
        margin: 0 2px;
        width: 12px;
        height: 4px;
        border-radius: 4px;
        border: none;
        padding: 0;
        background-color: #fff;
        cursor: pointer;
    }
    .hooper-pagination.is-vertical {
        bottom: auto;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
    }
    .hooper-pagination.is-vertical .hooper-indicators {
        flex-direction: column;
    }
    .hooper-pagination.is-vertical .hooper-indicator {
        width: 6px;
    }
    /* Navigation */
    .hooper-next,
    .hooper-prev {
        background-color: rgba(255,255,255,.5);
        border: none;
        padding: 1em;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }
    .hooper-next.is-disabled,
    .hooper-prev.is-disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }
    .hooper-next {
        right: 0;
    }
    .hooper-prev {
        left: 0;
    }
    .hooper-navigation.is-vertical .hooper-next {
        top: auto;
        bottom: 0;
        transform: initial;
    }
    .hooper-navigation.is-vertical .hooper-prev {
        top: 0;
        bottom: auto;
        right: 0;
        left: auto;
        transform: initial;
    }
    .hooper-navigation.is-rtl .hooper-prev {
        left: auto;
        right: 0;
    }
    .hooper-navigation.is-rtl .hooper-next {
        right: auto;
        left: 0;
    }
</style>

