<template>
    <div>
        <div v-if="post">
        <!-- <p>Hola</p> -->
        <div class="card mt-3" >
            <div class="card-header">
                    <img v-bind:src=" '/images/' +  post.image.image" class="card-img-top"/>
            </div>
            
            <div class="card-body">

                  <h1 class="card-title"> {{post.title}}</h1>

                <router-link class="btn btn-success"  :to="{name:'post-category',params:{category_id:post.category.id}}">{{post.category.title}}</router-link> 

                <p class="card-text">{{post.content}}</p>
                <p>{{post.image.image }}</p>
                <button class="btn btn-primary" v-on:click="postClick(post)">Ver resumen</button>
            </div>
        </div>

       

        </div>

        <div v-else>
             <p>Post no Existe</p>   
        </div>
    </div>
</template>

<script>
// import { defineComponent } from '@vue/composition-api'

//  export default {
//         created() {
//             print();
//         }
//     }

//     function print(){
//             console.log('Component created en Post - print.')
//     }

export default {
    created(){
        // console.log("detalle "+this.$route.params.id);
        // this.post=this.$route.params.id;
        // console.log(this.$route.params.id);
        this.getPost();
    },
    methods:{
        // getPost:function(){
        //     // console.log("hola a todos"+p.title);
        //     // this.postSelected=p;
        // }

        getPost:function(){

            fetch('/api/post/'+this.$route.params.id)
                .then(response=>response.json())
                
                 
                // console.log(response);

            // )
                .then(json=>this.post=json.data);
                // .then(json=>console.log('jjj'));
                // console.log(json.data.data[0].title);
            // })


            /*fetch('/api/post/').then(function(response){
                return response.json()
                // console.log(response);

            })
            .then(function(json){
                console.log(json.data.data[0].title);
            })*/
        }
    },
        // props:['title','final_posts'],
    data: function () {
      return {
          postSelected:"",
          post:""
          
        // post:
        //     {
        //         title:'Titulo 11', 
        //         image:'1624321061.jpg',
        //         content:'Contenido ....'
        //     }
            
        
      };
    },
}
</script>
