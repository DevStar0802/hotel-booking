import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import Hotel from './components/admin/hotel/Hotel.vue'

Vue.use(Router)

export default new Router({
  routes: [
    /**/
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/admin/hotel-details',
      name: 'hotel-details',
      component: Hotel
    },
    {
      path: '/admin/room-types',
      name: 'room-types',
      component: () => import(/* webpackChunkName: "about" */ './components/admin/roomtype/Index.vue')
    },
    {
      path: '/admin/room-capacities',
      name: 'room-capacities',
      component: () => import(/* webpackChunkName: "about" */ './components/admin/roomcapacity/Index.vue')
    },
    {
      path: '/admin/rooms',
      name: 'rooms',
      component: () => import(/* webpackChunkName: "about" */ './components/admin/room/Index.vue')
    },
    {
      path: '/admin/rooms/create',
      name: 'rooms-create',
      component: () => import(/* webpackChunkName: "about" */ './components/admin/room/Create.vue')
    },
    {
      path: '/admin/rooms/edit/:id',
      name: 'rooms-edit',
      component: () => import(/* webpackChunkName: "about" */ './components/admin/room/Create.vue')
    },
    {
      path: '/admin/prices',
      name: 'prices',
      component: () => import(/* webpackChunkName: "about" */ './components/admin/price/Index.vue')
    },
    {
      path: '/admin/prices/create',
      name: 'prices-create',
      component: () => import(/* webpackChunkName: "about" */ './components/admin/price/Create.vue')
    },
    {
      path: '/admin/prices/edit/:id',
      name: 'prices-edit',
      component: () => import(/* webpackChunkName: "about" */ './components/admin/price/Create.vue')
    },
    /*
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" *//* './views/About.vue')
    },
    */

  ],
  mode: 'history'
})
