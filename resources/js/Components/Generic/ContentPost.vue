<template>
    <div class="post">
        <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <button v-if="post.user_id == $page.props.auth.user.id" class="w3-right w3-opacity" @click="removePost()">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M16 1.75V3h5.25a.75.75 0 010 1.5H2.75a.75.75 0 010-1.5H8V1.75C8 .784 8.784 0 9.75 0h4.5C15.216 0 16 .784 16 1.75zm-6.5 0a.25.25 0 01.25-.25h4.5a.25.25 0 01.25.25V3h-5V1.75z"></path><path d="M4.997 6.178a.75.75 0 10-1.493.144L4.916 20.92a1.75 1.75 0 001.742 1.58h10.684a1.75 1.75 0 001.742-1.581l1.413-14.597a.75.75 0 00-1.494-.144l-1.412 14.596a.25.25 0 01-.249.226H6.658a.25.25 0 01-.249-.226L4.997 6.178z"></path><path d="M9.206 7.501a.75.75 0 01.793.705l.5 8.5A.75.75 0 119 16.794l-.5-8.5a.75.75 0 01.705-.793zm6.293.793A.75.75 0 1014 8.206l-.5 8.5a.75.75 0 001.498.088l.5-8.5z"></path></svg>
        </button>
        <div v-for="(user, index) in user" :key="index">
            <h2>{{ user.name }}</h2>
        </div>
        <h5>{{ post.created_at }}</h5><br>
        <hr class="w3-clear">
        <p>{{ post.legend }}</p>
        <div class="w3-row-padding" style="margin:0 -16px" v-for="(photo, index) in photo" :key="index">
            <div class="w3-half">
                <img v-bind:src="'/storage/img/post/'+photo.src" class="w3-border" alt="" style="padding:4px;width:100%">
            </div>
        </div><br>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i> &nbsp;Like</button> 
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button>
    </div>
</template>
<script>
export default {
    props:['post'],
    data: function () {
        return {
            user:"",
            photo:""
        }
    },
    methods:{
        removePost(){
            axios.delete('api/post/' + this.post.id)
            .then(response => {
                if(response.status == 200){
                    this.$emit('postchanged');
                }
            })
            .catch(error => {
                console.log(error);
            })
        },
        getUser(){
            axios.get('api/user/' + this.post.user_id)
            .then(response => {
                console.log(this.user = response.data);
            })
            .catch(error => {
                console.log(error);
            })
        },
        getPhoto(){
            axios.get('api/photo/' + this.post.id)
            .then(response => {
                this.photo = response.data
            })
            .catch(error => {
                console.log(error);
            })
        }
    },
    created(){
        this.getUser();
        this.getPhoto();
    }
}
</script>