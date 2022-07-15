<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <Navbar />
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
                    <Publication />
                    <Post />
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
import Navbar from '../Components/w3css/Navbar.vue'
import Profile from '../Components/w3css/Profile.vue'
import Accordion from '../Components/w3css/Accordion.vue'
import Interests from '../Components/w3css/Interests.vue'
import Publication from '../Components/w3css/Publication.vue'
import Post from '../Components/w3css/Post.vue'
import Events from '../Components/w3css/Events.vue'
import Solicitation from '../Components/w3css/Solicitation.vue'
import ADS from '../Components/w3css/ADS.vue'

export default {
    name:"Dashboard",
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
    }
}
</script>
