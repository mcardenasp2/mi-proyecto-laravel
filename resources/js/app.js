/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue').default;

// import VueRouter from 'vue-router';

import router from './assets/router.js';

var MyUploadAdapter =require('./assets/ckeditor/MyUploadAdapter.js') ;


import ClassicEditor from '@ckeditor/ckeditor5-build-classic';





function MyCustomUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader );
    };
}






// const ClassicEditor =require('@ckeditor/ckeditor5-build-classic');
ClassicEditor
    .create( document.querySelector( '#content' ),{
        extraPlugins: [ MyCustomUploadAdapterPlugin ],
    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );



/* SkEditor */





/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



Vue.component('example-component', require('./components/ExampleComponent.vue').default);


// Vue.component('list-posts', require('./components/PostListComponent.vue').default);


Vue.component('modal-post', require('./components/PostModalComponent.vue').default);

Vue.component('post-list-default', require('./components/PostListDefaultComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 * ` `
 */

//  Vue.component('list-posts', {
//     props:['title','final_posts'],
//     data: function () {
//       return {
          
//         posts2:[
//             {
//                 title:'Titulo 1', 
//                 image:'1624321061.jpg',
//                 content:'Contenido ....'
//             },
//             {
//                 title:'Titulo 2', 
//                 image:'1624321061.jpg',
//                 content:'Contenido ....'
//             },
//             {
//                 title:'Titulo 3', 
//                 image:'1624321061.jpg',
//                 content:'Contenido ....'
//             },
//             {
//                 title:'Titulo 4', 
//                 image:'1624321061.jpg',
//                 content:'Contenido ....'
//             },
//             {
//                 title:'Titulo 5', 
//                 image:'1624321061.jpg',
//                 content:'Contenido ....'
//             }
//         ]
//       }
//     },
//     template: '<div> <h1>{{title}}</h1> <div class="card"  v-for="post in final_posts">  <div class="card-body"> <h5 class="card-title"> @{{post.title}}</h5> <p class="card-text">@{{post.content}}</p> <a href="#" class="btn btn-primary">Ver resumen</a> </div> </div> </div>'
//   })


const app = new Vue({
    el: '#app',
    router
    // data:{
    //     message:"Hola Vue",
        // posts:['titulo 1','titulo 2','titulo 3','titulo 1']
        // posts:[
        //     {
        //         title:'Titulo 100', 
        //         image:'1624321061.jpg',
        //         content:'Contenido ....'
        //     },
        //     {
        //         title:'Titulo 2', 
        //         image:'1624321061.jpg',
        //         content:'Contenido ....'
        //     },
        //     {
        //         title:'Titulo 3', 
        //         image:'1624321061.jpg',
        //         content:'Contenido ....'
        //     },
        //     {
        //         title:'Titulo 4', 
        //         image:'1624321061.jpg',
        //         content:'Contenido ....'
        //     },
        //     {
        //         title:'Titulo 5', 
        //         image:'1624321061.jpg',
        //         content:'Contenido ....'
        //     }
        // ]
    // }
});
