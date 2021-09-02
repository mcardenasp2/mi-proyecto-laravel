

window.Vue = require('vue').default;

import VueRouter from 'vue-router';
import PostList from '../components/PostListComponent.vue';
import PostDetail from '../components/PostDetailComponent.vue';
import PostCategory from '../components/PostCategoryComponent.vue';

// import CategoryListDefault from '../components/PostCategoryComponent.vue';
import CategoryListDefault from '../components/CategoryListDefaultComponent.vue';


import Contact from '../components/ContactComponent.vue';

// const Foo = { 
//     template:  
//     '<div>foo <router-link to="/foo">Go to Foo</router-link><router-link to="/bar">Go to Bar</router-link> <router-link to="/">Go to List</router-link> </div>' 
// }
// const Bar = { 
//     template: 
//     '<div>bar <router-link to="/foo">Go to Foo</router-link><router-link to="/bar">Go to Bar</router-link></div>' 
// }

// const router = new VueRouter({
//     routes:[
//         { path: '/', component: PostList },
//         { path: '/foo', component: Foo },
//         { path: '/bar', component: Bar }
//     ]
//   });
Vue.use(VueRouter);
  export default new VueRouter({
      mode:'history',
    routes:[
        { path: '/', component: PostList, name:"list" },
        { path: '/categories', component: CategoryListDefault, name:"list-category" },
        { path: '/detail/:id', component: PostDetail,name:"detail" },
        { path: '/post-category/:category_id', component: PostCategory,name:"post-category" },
        { path: '/contact', component: Contact,name:"contact" },
        // { path: '/foo', component: Foo   },
        // { path: '/bar', component: Bar }
    ]
  });