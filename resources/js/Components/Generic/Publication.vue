<template>
    <div class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card w3-round w3-white">
                <div class="w3-container w3-padding">
                    <h6 class="w3-opacity">O que você está fazendo?</h6>
                    <form>
                        <textarea v-model="post.legend" />
                        <label for="imagesArray" class="w3-button w3-left"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M2.25 4a.25.25 0 00-.25.25v15.5c0 .138.112.25.25.25h3.178L14 10.977a1.75 1.75 0 012.506-.032L22 16.44V4.25a.25.25 0 00-.25-.25H2.25zm3.496 17.5H21.75a1.75 1.75 0 001.75-1.75V4.25a1.75 1.75 0 00-1.75-1.75H2.25A1.75 1.75 0 00.5 4.25v15.5c0 .966.784 1.75 1.75 1.75h3.496zM22 19.75v-1.19l-6.555-6.554a.25.25 0 00-.358.004L7.497 20H21.75a.25.25 0 00.25-.25zM9 9.25a1.75 1.75 0 11-3.5 0 1.75 1.75 0 013.5 0zm1.5 0a3.25 3.25 0 11-6.5 0 3.25 3.25 0 016.5 0z"></path></svg></label>
                        <input id="imagesArray" multiple type="file" name="image" @change="getFile" />
                        <button type="button" class="w3-button w3-right w3-theme" @click="addPost()"><i class="fa fa-pencil"></i> &nbsp;Post</button> 
                        <img :src="avatar" class="w3-round" style="max-height:40px;padding:0px 10px;">
                    </form>
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
                user_id: this.$page.props.auth.user.id,
                legend:"",
                image:"",
            },
            avatar:null
        };
    },
    methods:{
        getFile(e){
            console.log(e.target.files[0])
            this.image = e.target.files[0]
            
            let loadImage = e.target.files[0]
            let loadReader = new FileReader();
            loadReader.readAsDataURL(loadImage);
            loadReader.onload = e => {
                this.avatar = e.target.result
            }
        },
        addPost(){
            let config = {
                header: {
                    "Content-Type": "multipart/form-data",
                },
            };
            var formData = new FormData();
            formData.append('user_id', this.post.user_id);
            formData.append('legend', this.post.legend);
            formData.append('image', this.image);
            for (var value of formData.values()) {
                console.log(value);
            }
            axios.post('api/post/store', formData, config)
            .then(response=>{
                if(response.status == 201){
                    this.post.legend = "";
                    this.image = "";
                    this.avatar = null;
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
textarea {
  width: 100%;
  height: 125px;
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