<template>
    <div class="post">
        <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
        <div v-if="post.user_id == $page.props.auth.user.id" class="dropdown w3-right">
            <a class="btn w3-opacity" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M6 12a2 2 0 11-4 0 2 2 0 014 0zm8 0a2 2 0 11-4 0 2 2 0 014 0zm6 2a2 2 0 100-4 2 2 0 000 4z"></path></svg>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item">Editar</a>
                <a class="dropdown-item" onclick="document.getElementById('id01').style.display='block'">Excluir</a>
            </div>
        </div>
        <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-top">
            <header class="w3-container w3-teal w3-display-container w3-padding-16 w3-large"> 
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-teal w3-display-topright"><i class="fa fa-remove"></i></span>
                <h5>Atenção!!!</h5>
            </header>
            <div class="w3-container w3-padding-24 w3-center">
                <p>Deseja mesmo excluir essa publicação?</p>
            </div>
            <footer class="w3-container w3-teal w3-padding-16">
                <button type="button" class="w3-button w3-theme-d1 w3-right" @click="removePost()" onclick="document.getElementById('id01').style.display='none'"><i class="fa fa-trash"></i> &nbsp;Excluir</button>
            </footer>
        </div>
        </div>
        <div v-for="(user, index) in users" :key="index">
            <h2 v-if="post.user_id == user.id">{{ user.name }}</h2>
        </div>
        <h5>{{ post.created_at }}</h5><br>
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
        }
    }
}
</script>