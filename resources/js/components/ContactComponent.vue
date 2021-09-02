<template>
    <div class="col-8 offset-2">
       <div class="card">
           <div class="card-header">
               <img src="/images/1624321061.jpg" class="logo_200 mx-auto d-block" alt="">
           </div>
           <div class="card-body">
               <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Nombre</span>
                    </div>
                    <input type="text" class="form-control" v-model="name">
                    <!-- <input type="text" class="form-control"> -->
                </div>

                <div class="input-group mt-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Apellido</span>
                    </div>
                    <input type="text" class="form-control" v-model="surname">
                    <!-- <input type="text" class="form-control"> -->
                </div>

                <div class="input-group mt-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="">Email</span>
                    </div>
                    <input type="email" class="form-control" v-model="email">
                    <!-- <input type="text" class="form-control"> -->
                </div>

                <div class="input-group mt-3">
                    <textarea class="form-control" placeholder="Comentarios" name="" id="" cols="30" rows="10" v-model="content"></textarea>
                    <!-- <input type="text" class="form-control"> -->
                </div>

                <button @click="saveContact" class="btn btn-primary float-right mt-3 btn-lg">Enviar</button>
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
        this.saveContact();
    },
    methods:{
        // getPost:function(){
        //     // console.log("hola a todos"+p.title);
        //     // this.postSelected=p;
        // }

        saveContact:function(){
            console.log(this.name+" "+this.surname+" "+this.email+" "+this.content);
            return ;

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
          name:"",
          surname:"",
          email:"",
          content:"",
          
      };
    },
}
</script>
