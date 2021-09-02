<template>
    <div>
        <p>Hola</p>
        <!-- <div class="card mt-3"  v-for="category in categories" style="" :key="category.id"> -->
            <!-- <router-link class="btn btn-success"  :to="{name:'post-category',params:{category_id:category.id}}"> -->

            <!-- <img src='/images_category/1624321061.jpg' class="card-img-top" alt="..."> -->
            <!-- <div class="card-body"> -->
                <!-- <h5 class="card-title text-center"> {{post.title}}</h5> -->
                <!-- <p class="card-text">{{post.content}}</p>
                <button class="btn btn-primary" v-on:click="postClick(post)">Ver resumen</button>
                <router-link class="btn btn-success"  :to="{name:'detail',params:{id:post.id}}">Ver</router-link>  -->
                <!-- <router-link class="btn btn-success"  :to=" 'detail/'+post.id ">Ver</router-link> --> 

            
            <!-- </div> -->

            <!-- </router-link>  -->


        <!-- </div> -->

        
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

// import vPagination from 'vue-plain-pagination';

export default {
    // props:["posts","total","pCurrentPage"],
    created(){
        // this.getCategories();
    },
    
    methods:{
        
        getCategories:function(){
            fetch('/api/category/all')
                .then(response=>response.json())
                .then(json=>this.categories=json.data);
        },
        
    },
   
        // props:['title','final_posts'],
    data: function () {
      return {
          categories=""
      }
    },
}
</script>
