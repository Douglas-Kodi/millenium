<template>
    <div class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card w3-round w3-white">
                <div class="w3-container w3-padding">
                <h6 class="w3-opacity">Social Media template by w3.css</h6>
                <input type="text" v-model="post.legend" />
                <button type="button" class="w3-button w3-theme" @click="addPost()" :class="[post.legend ? 'active' : 'inactive', 'plus']"><i class="fa fa-pencil"></i> &nbsp;Post</button> 
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Publication",
    data: function (){
        return {
            post: {
                legend: ""
            }
        }
    },
    methods:{
        addPost(){
            if(this.post.legend == ''){
                return;
            }
            axios.post('api/post/store',{
                post: this.post
            })
            .then(response=>{
                if(response.status == 201){
                    this.post.legend = "";
                    this.$emit('reloadPost');
                }
            })
            .catch(error =>{
                console.log(error);
            })

        }
    }
}
</script>

<style scoped>
.plus{
    font-size: 20px;
}
.active{
    color:green;
}
.inactive{
    color:red;
}
</style>