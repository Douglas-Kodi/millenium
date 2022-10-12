<template>
    <div v-for="(post, index) in posts" :key="index" class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <content-post
            :post="post"
            class="post"
            v-on:postchanged="$emit('reloadPost')"
        />
    </div>
</template>

<script>
import ContentPost from './ContentPost.vue'
export default {
    props:['posts'],
    components: { 
        ContentPost 
    },
    name:"Post"
}
</script>