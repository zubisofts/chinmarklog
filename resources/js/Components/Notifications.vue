<template>
    <div>
        <strong @click="notify">
            <font-awesome-icon :icon="['far','bell']" style="font-size:1.3rem;" />
        </strong>
        <ul>
            <li v-for="(message, i) in messages" :key="i">
                {{'Notification ' + (i + 1)}}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data(){
        return {
            messages:[]
        }
    },
    created(){
        this.notify();
    },
    methods:{
        notify(){
            let component = this;
            var channel = pusher.subscribe('parcel-update');
            channel.bind('parcel-changes', function(data) {
                component.messages.push(JSON.stringify(data));
            });

        }
    }
}
</script>