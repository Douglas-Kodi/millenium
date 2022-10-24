<template>
    <div class="post">
        <!----------------------------------------- SHOW ----------------------------------------->
        <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <div v-if="post.user_id == $page.props.auth.user.id" class="dropdown w3-right">
            <a class="btn w3-opacity" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M6 12a2 2 0 11-4 0 2 2 0 014 0zm8 0a2 2 0 11-4 0 2 2 0 014 0zm6 2a2 2 0 100-4 2 2 0 000 4z"></path></svg>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" v-on:click="updateModal(post.id)">Editar</a>
                <a class="dropdown-item" v-on:click="removeModal(post.id)">Excluir</a>
            </div>
        </div>
        <!----------------------------------------- UPDATE ----------------------------------------->
        <div :id="'updateModal'+post.id" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-top">
                <header class="w3-container w3-teal w3-display-container w3-padding-16 w3-large"> 
                    <span v-on:click="updateModalClose(post.id)" @click="clearUpdate" class="w3-button w3-teal w3-display-topright"><i class="fa fa-remove"></i></span>
                    <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                    <div v-for="(user, index) in users" :key="index">
                        <h2 v-if="post.user_id == user.id">{{ user.name }}</h2>
                    </div>
                    <h5 v-if="post.created_at == post.updated_at">{{ myOwnTime }}</h5><h5 v-else>{{ myOwnTimeUp }} - Editado</h5><br>
                </header>
                <form>
                    <div class="w3-container w3-padding-16 w3-center" style="width:100%;">
                        <textarea v-model="post.legend" />
                    </div>
                    <div v-if="avatarUp == null">
                        <div class="w3-auto" v-for="(photo, index) in photos" :key="index">
                            <img v-if="post.id == photo.post_id" v-bind:src="'/storage/img/post/'+photo.src" style="max-width:100%;max-height:120px;" class="w3-margin-bottom w3-auto" v-bind:alt="photo.src">
                        </div>
                    </div>
                    <div v-else>
                        <div class="w3-auto">
                            <img :src="avatarUp" class="w3-margin-bottom w3-auto" style="max-width:100%;max-height:120px;">
                        </div>
                    </div>
                    <center>
                        <label for="imagesArrayUp" class="w3-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M2.25 4a.25.25 0 00-.25.25v15.5c0 .138.112.25.25.25h3.178L14 10.977a1.75 1.75 0 012.506-.032L22 16.44V4.25a.25.25 0 00-.25-.25H2.25zm3.496 17.5H21.75a1.75 1.75 0 001.75-1.75V4.25a1.75 1.75 0 00-1.75-1.75H2.25A1.75 1.75 0 00.5 4.25v15.5c0 .966.784 1.75 1.75 1.75h3.496zM22 19.75v-1.19l-6.555-6.554a.25.25 0 00-.358.004L7.497 20H21.75a.25.25 0 00.25-.25zM9 9.25a1.75 1.75 0 11-3.5 0 1.75 1.75 0 013.5 0zm1.5 0a3.25 3.25 0 11-6.5 0 3.25 3.25 0 016.5 0z"></path></svg></label>
                        <input id="imagesArrayUp" type="file" name="imageUp" @change="getFileUp" />
                    </center>
                    <footer class="w3-container w3-teal w3-padding-16">
                        <button type="button" class="w3-button w3-right w3-theme" @click="updatePost(post.id)" v-on:click="updateModalClose(post.id)"><i class="fa fa-pencil"></i> &nbsp;Edit</button> 
                    </footer>
                </form>
            </div>
        </div>
        <!----------------------------------------- DELETE ----------------------------------------->
        <div :id="'removeModal'+post.id" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-top">
                <header class="w3-container w3-teal w3-display-container w3-padding-16 w3-large"> 
                    <span v-on:click="removeModalClose(post.id)" class="w3-button w3-teal w3-display-topright"><i class="fa fa-remove"></i></span>
                    <h5>Atenção!!!</h5>
                </header>
                <div class="w3-container w3-padding-24 w3-center">
                    <p>Deseja mesmo excluir essa publicação? {{ post.id }}</p>
                </div>
                <footer class="w3-container w3-teal w3-padding-16">
                    <button type="button" class="w3-button w3-theme-d1 w3-right" @click="removePost(post.id)" v-on:click="removeModalClose(post.id)"><i class="fa fa-trash"></i> &nbsp;Excluir</button>
                </footer>
            </div>
        </div>
        <!----------------------------------------- SHOW ----------------------------------------->
        <div v-for="(user, index) in users" :key="index">
            <h2 v-if="post.user_id == user.id">{{ user.name }}</h2>
        </div>
        <h5 v-if="post.created_at == post.updated_at">{{ myOwnTime }}</h5><h5 v-else>{{ myOwnTimeUp }} - Editado</h5><br>
        <hr class="w3-clear w3-margin-bottom w3-margin-top">
        <p class="w3-margin-bottom">{{ post.legend }}</p>
        <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-auto" v-for="(photo, index) in photos" :key="index">
                <img v-if="post.id == photo.post_id" v-bind:src="'/storage/img/post/'+photo.src" style="max-width:100%;max-height:400px;" class="w3-margin-bottom w3-auto" v-bind:alt="photo.src">
            </div>
        </div><br>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i> &nbsp;Like</button> 
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i> &nbsp;Comment</button>
    </div>
</template>
<script>
export default {
    props:['post', 'users', 'photos'],
    data: function (){
        return {
            avatarUp:null,
        };
    },
    methods:{
        updateModal:function(event){
            return document.getElementById('updateModal'+event).style.display='block';
        },
        updateModalClose:function(event){
            return document.getElementById('updateModal'+event).style.display='none';
        },
        removeModal:function(event){
            return document.getElementById('removeModal'+event).style.display='block';
        },
        removeModalClose:function(event){
            return document.getElementById('removeModal'+event).style.display='none';
        },
        getFileUp(e){
            console.log(e.target.files[0])
            this.imageUp = e.target.files[0]
            
            let loadImageUp = e.target.files[0]
            let loadReaderUp = new FileReader();
            loadReaderUp.readAsDataURL(loadImageUp);
            loadReaderUp.onload = e => {
                this.avatarUp = e.target.result
            }
        },
        clearUpdate(){
            this.imageUp = "";
            this.avatarUp = null;
        },
        updatePost(event){
            let config = {
                header: {
                    "Content-Type": "multipart/form-data",
                },
            };
            var formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('legend', this.post.legend);
            formData.append('imageUp', this.imageUp);
            for (var value of formData.values()) {
                console.log(value);
            }
            axios.post('api/post/'+ event, formData, config)
            .then(response=>{
                if(response.status == 200){
                    this.avatarUp = null;
                    this.$emit('postchanged');
                }
            })
            .catch(error =>{
                console.log(error);
            })
        },
        removePost(event){
            axios.delete('api/post/' + event)
            .then(response => {
                if(response.status == 200){
                    this.$emit('postchanged');
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    },
    computed:{
        myOwnTime(){
            return moment(this.post.created_at).fromNow();
        },
        myOwnTimeUp(){
            return moment(this.post.updated_at).fromNow();
        }
    }
}
</script>

<style scoped>
textarea {
  width: 100%;
  height: 80px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
}
input[type="file"] { 
   display: none;
}
</style>