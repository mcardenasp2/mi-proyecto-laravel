<template>
    <div>
        <!-- <p>Hola</p> -->
        <h1>{{category.title}}</h1>

         <post-list-default 
         :key="currentPage"
        :pCurrentPage=currentPage
        @getCurrentPage="getCurrentPages"
         
         v-if="total>0" :posts="posts" :total="total"
         
         ></post-list-default>
        <!-- <div class="card mt-3"  v-for="post in posts" style="" :key="post.title">
            <img v-bind:src=" '/images/' +  post.image" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"> {{post.title}}</h5>
                <p class="card-text">{{post.content}}</p>
                <button class="btn btn-primary" v-on:click="postClick(post)">Ver resumen</button>
                <router-link class="btn btn-success"  :to="{name:'detail',params:{id:post.id}}">Ver</router-link>  -->
                <!-- <router-link class="btn btn-success"  :to=" 'detail/'+post.id ">Ver</router-link> --> 

            
            <!-- </div>
        </div> -->

        <!-- <modal-post :post="postSelected"></modal-post> -->
<!-- 
        <router-link to="/foo">Go to Foo</router-link>
        <router-link to="/bar">Go to Bar</router-link>
        <router-link to="/">Go to List</router-link> -->

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
            this.getPosts();
    },
    methods:{
        
        postClick:function(p){
            // console.log("hola a todos"+p.title);
            this.postSelected=p;
        },
        getPosts(){

            fetch('/api/post/'+this.$route.params.category_id+'/category?page='+this.currentPage)
                .then(response=>response.json())
                .then(json=>{
                    this.posts=json.data.posts.data;
                     this.category=json.data.category;
                    //  console.log(json.data.last_page)
                     this.total=json.data.posts.last_page;
                });
            

            /*fetch('/api/post/').then(function(response){
                return response.json()
                // console.log(response);

            })
            .then(function(json){
                console.log(json.data.data[0].title);
            })*/
        },
        getCurrentPages:function (currentPage) {
            // recibo el valor de la propiedad
            // console.log(" Post List CurrentPage "+currentPage);
            this.currentPage=currentPage;
            this.getPosts()
            
        }
    },
        // props:['title','final_posts'],
    data: function () {
      return {
          postSelected:"",

          posts:[],
          category:"",
          total:0,
          currentPage:1
          
        // posts:[
        //     {
        //         id:1,
        //         title:'Titulo 0001', 
        //         image:'1624321061.jpg',
        //         content:'Contenido ....'
        //     },
        //     {
        //         id:2,
        //         title:'Titulo 2', 
        //         image:'1624321061.jpg',
        //         content:'Contenido ....'
        //     },
        //     {
        //         id:3,
        //         title:'Titulo 3', 
        //         image:'1624321061.jpg',
        //         content:'Contenido ....'
        //     },
        //     {
        //         id:4,
        //         title:'Titulo 4', 
        //         image:'1624321061.jpg',
        //         content:'Contenido ....'
        //     },
        //     {
        //         id:5,
        //         title:'Titulo 5', 
        //         image:'1624321061.jpg',
        //         content:'Contenido ....'
        //     }
        // ]
      }
    },
}
</script>
