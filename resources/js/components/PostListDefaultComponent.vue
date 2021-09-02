<template>
    <div>
        <!-- <p>Hola</p> -->
        <div class="card mt-3"  v-for="post in posts" style="" :key="post.title">
            <img v-bind:src=" '/images/' +  post.image" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"> {{post.title}}</h5>
                <p class="card-text">{{post.content}}</p>
                <button class="btn btn-primary" v-on:click="postClick(post)">Ver resumen</button>
                <router-link class="btn btn-success"  :to="{name:'detail',params:{id:post.id}}">Ver</router-link> 
                <!-- <router-link class="btn btn-success"  :to=" 'detail/'+post.id ">Ver</router-link> --> 

            
            </div>
        </div>

        <modal-post :post="postSelected"></modal-post>

        <v-pagination 
        class="mt-3"
        v-model="currentPage" :page-count="total"
        :classes="bootstrapPaginationClasses"
                  :labels="paginationAnchorTexts"
        ></v-pagination>
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

import vPagination from 'vue-plain-pagination';

export default {
    props:["posts","total","pCurrentPage"],
    created(){
        this.currentPage=this.pCurrentPage;
            // this.getPost();
    },
    components: { vPagination },
    methods:{
        
        postClick:function(p){
            // console.log("hola a todos"+p.title);
            this.postSelected=p;
        },
        
    },
    watch:{
        // la propiedad del mismo template
        currentPage:function (newVal, oldVal) {
            console.log(newVal);
            this.$emit('getCurrentPage', newVal);
            
        }
    },
        // props:['title','final_posts'],
    data: function () {
      return {
          postSelected:"",
          currentPage: 1,
        //   total:9,
          bootstrapPaginationClasses: {
            ul: 'pagination',
            li: 'page-item',
            liActive: 'active',
            liDisable: 'disabled',
            button: 'page-link'  
            },
            paginationAnchorTexts: {
                // first: 'First',
                first: '',
                prev: '&laquo',
                // prev: 'Previous',
                next: '&raquo',
                last: ''
            }
        //   posts:[]
          
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
