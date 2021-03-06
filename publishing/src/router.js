import Vue from 'vue';
import Router from 'vue-router';
import Index from './pages/Index.vue';
import Landing from './pages/Landing.vue';
import Login from './pages/Login.vue';
import Join from './pages/Join.vue';
import Coupon from './pages/Coupon.vue';
import Premium from './pages/Premium.vue';
import Profile from './pages/Profile.vue';
import Restaurant from './pages/Restaurant.vue';
import registRestaurant from './pages/registRestaurant.vue';
import EditReview from "./pages/EditReview";
import Newsfeed from "./pages/Newsfeed";
import MainNavbar from './layout/MainNavbar.vue';
import MainFooter from './layout/MainFooter.vue';

Vue.use(Router);
export default new Router({
  linkExactActiveClass: 'active',
  routes: [
    {
      path: '/',
      name: 'index',
      components: { default: Index, header: MainNavbar, footer: MainFooter },
      props: {
        header: { colorOnScroll: 400 },
        footer: { backgroundColor: 'black' }
      }
    },
    {
      path: '/landing',
      name: 'landing',
      components: { default: Landing, header: MainNavbar, footer: MainFooter },
      props: {
        header: { colorOnScroll: 400 },
        footer: { backgroundColor: 'black' }
      }
    },
    {
      path: '/login',
      name: 'login',
      components: { default: Login, header: MainNavbar },
      props: {
        header: { colorOnScroll: 400 }
      }
    },
    {
      path: '/join',
      name: 'join',
      components: { default: Join, header: MainNavbar },
      props: {
        header: { colorOnScroll: 400 }
      }
    },
    {
      path: '/coupon',
      name: 'coupon',
      components: { default: Coupon, header: MainNavbar },
      props: {
        header: { colorOnScroll: 400 }
      }
    },
    {
      path: '/premium/:param',
      name: 'premium',
      components: { default: Premium, header: MainNavbar },
      props: {
        header: { colorOnScroll: 400 }
      }
    },
    {
      path: '/profile/:id',
      name: 'profile',
      components: { default: Profile, header: MainNavbar, footer: MainFooter },
      props: {
        header: { colorOnScroll: 400 },
        footer: { backgroundColor: 'black' }
      }
    },
    {
      path: '/registRestaurant',
      name: 'registRestaurant',
      components: { default: registRestaurant, header: MainNavbar, footer: MainFooter},
      props: {
        header: { colorOnScroll: 400 }
      }
    },
    {
      path: '/Restaurant/:id',
      name: 'restaurant',
      components: { default: Restaurant, header: MainNavbar, footer: MainFooter},
      props: {
        header: { colorOnScroll: 400 }
      }
    },
    {
      path: '/newsfeed',
      name: 'newsfeed',
      components: { default: Newsfeed, header: MainNavbar, footer: MainFooter},
      props: {
        header: { colorOnScroll: 400 }
      }
    },
    {
      path: '/EditReview',
      name: 'EditReview',
      components: { default: EditReview, header: MainNavbar, footer: MainFooter},
      props: {
        header: { colorOnScroll: 400 }
      }
    }
  ],
  scrollBehavior: to => {
    if (to.hash) {
      return { selector: to.hash };
    } else {
      return { x: 0, y: 0 };
    }
  }
});
