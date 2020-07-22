import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Default from "../views/Default.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    component: Default,
    children: [
      {
        name: "Home",
        path: "",
        redirect: "news"
      },
      {
        path: "news",
        name: "News",
        component: Home
      },
      {
        path: "news/:id",
        name: "Read",
        component: () =>
          import(/* webpackChunkName: "about" */ "../views/news/Read.vue")
      },
      {
        path: "news/:id/edit",
        name: "Edit",
        component: () =>
          import(/* webpackChunkName: "about" */ "../views/news/Edit.vue")
      },

      {
        path: "/about",
        name: "About",
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
          import(/* webpackChunkName: "about" */ "../views/About.vue")
      }
    ]
  }
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
});

export default router;
