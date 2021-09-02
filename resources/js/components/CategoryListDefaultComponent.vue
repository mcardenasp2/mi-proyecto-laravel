<template>
    <div class="row">
        <!-- <p>hola</p>     -->
       <div class="col-md-3"  v-for="category in categories" style="" :key="category.id">

            <div class="card mt-3" >
            <router-link class=""  :to="{name:'post-category',params:{category_id:category.id}}">

            <img src='/images_categories/1624321061.jpg' class="card-img-top mt-3" alt="...">
            <div class="card-body">
                <h5 class="card-title text-center"> {{category.title}}</h5>
                

            
            </div>

            </router-link> 


        </div>
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
        this.getCategories();
    },
    methods:{
        // getPost:function(){
        //     // console.log("hola a todos"+p.title);
        //     // this.postSelected=p;
        // }

        getCategories:function(){
            fetch('/api/category/all')
                .then(response=>response.json())
                .then(json=>this.categories=json.data);
        },
    },
        // props:['title','final_posts'],
    data: function () {
      return {
          categories:""
          
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
