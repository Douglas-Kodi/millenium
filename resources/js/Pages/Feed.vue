<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Home" />

    <BreezeAuthenticatedLayout>
        <!-- <Navbar /> -->
        <div class="w3-container w3-content" style="max-width:1400px;margin-top:40px">    
            <div class="w3-row">

                <!-- Left Column --> 
                <div class="w3-col m3">
                    <Profile />
                    <Accordion />
                    <Interests />
                </div>
                <!-- Middle Column -->
                <div class="w3-col m7">
                    <Publication 
                        v-on:reloadPost="getPost()"
                    />
                    <Post 
                        :posts="posts"
                        v-on:reloadPost="getPost()"
                    />
                </div>
                <!-- Right Column -->
                <div class="w3-col m2">
                    <Events />
                    <Solicitation />
                    <ADS />
                </div>

            </div>
        </div>


    </BreezeAuthenticatedLayout>
</template>

<script>
import Navbar from '../Components/Generic/Navbar.vue'
import Profile from '../Components/Feed/Profile.vue'
import Accordion from '../Components/Feed/Accordion.vue'
import Interests from '../Components/Feed/Interests.vue'
import Publication from '../Components/Generic/Publication.vue'
import Post from '../Components/Generic/Post.vue'
import Events from '../Components/Feed/Events.vue'
import Solicitation from '../Components/Generic/Solicitation.vue'
import ADS from '../Components/Feed/ADS.vue'

export default {
    name:"Feed",
    components:{
        Navbar,
        Profile,
        Accordion,
        Interests,
        Publication,
        Post,
        Events,
        Solicitation,
        ADS
    },
    data: function () {
        return {
            posts: []
        }
    },
    methods: {
        getPost(){
            axios.get('api/posts')
            .then(response => {
                this.posts = response.data
            })
            .catch(error => {
                console.log(error);
            })
        }
    },
    created(){
        this.getPost();
    }
}
</script>
