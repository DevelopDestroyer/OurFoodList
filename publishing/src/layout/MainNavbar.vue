<template>
  <navbar
    position="fixed"
    type="primary"
    :transparent="transparent"
    :color-on-scroll="colorOnScroll"
    menu-classes="ml-auto"
  >
    <template slot-scope="{ toggle, isToggled }">
      <router-link v-popover:popover1 class="navbar-brand" to="/" style="font-size:24px;">
        그맛
      </router-link>
      <el-popover
        ref="popover1"
        popper-class="popover"
        placement="bottom"
        width="200"
        trigger="hover"
      >
        <div class="popover-body">
          그맛
        </div>
      </el-popover>
    </template>
    <template slot="navbar-menu">
      <li class="nav-item">
        <a
          class="nav-link"
          href="/#/login"
		  @click="closeNavbar"
        >
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="#ffffff" d="M12,9l3-3l-2.3-2.3l2-2l-1.4-1.4l-8,8C3.9,7.7,2.3,8,1.2,9.2c-1.6,1.6-1.6,4.1,0,5.7c1.6,1.6,4.1,1.6,5.7,0 C8.3,13.3,8.4,11,7,9.4l2.7-2.7L12,9z"></path></g></svg>
          <p>　로그인/가입</p>
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          href="/#/registRestaurant"
		  @click="closeNavbar"
        >
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="10" y1="3" x2="13" y2="6" data-cap="butt" data-color="color-2"></line> <line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="2" y1="11" x2="5" y2="14" data-cap="butt" data-color="color-2"></line> <polygon fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="12,1 15,4 5,14 1,15 2,11 " data-cap="butt"></polygon> </g></svg>
          <p>　맛집등록</p>
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          href="/#/"
		  @click="closeNavbar"
        >
          <i class="now-ui-icons users_circle-08"></i>
          <p>　내 정보</p>
        </a>
      </li>	  	  
      <!--drop-down
        tag="li"
        title="Components"
        icon="now-ui-icons design_app"
        class="nav-item"
      >
        <nav-link to="/">
          <i class="now-ui-icons business_chart-pie-36"></i> All components
        </nav-link>
        <a
          href="https://demos.creative-tim.com/vue-now-ui-kit/documentation"
          target="_blank"
          class="dropdown-item"
        >
          <i class="now-ui-icons design_bullet-list-67"></i> Documentation
        </a>
      </drop-down>
      <drop-down
              tag="li"
              title="Examples"
              icon="now-ui-icons design_image"
              class="nav-item"
      >
        <nav-link to="/landing">
          <i class="now-ui-icons education_paper"></i> Landing
        </nav-link>
        <nav-link to="/login">
          <i class="now-ui-icons users_circle-08"></i> Login
        </nav-link>
        <nav-link to="/profile">
          <i class="now-ui-icons users_single-02"></i> Profile
        </nav-link>
      </drop-down>
      <li class="nav-item">
        <a
          class="nav-link btn btn-neutral"
          href="https://www.creative-tim.com/product/vue-now-ui-kit-pro"
          target="_blank"
        >
          <i class="now-ui-icons arrows-1_share-66"></i>
          <p>Upgrade to PRO</p>
        </a>
      </li>

      <li class="nav-item">
        <a
          class="nav-link"
          rel="tooltip"
          title="Follow us on Twitter"
          data-placement="bottom"
          href="https://twitter.com/CreativeTim"
          target="_blank"
        >
          <i class="fab fa-twitter"></i>
          <p class="d-lg-none d-xl-none">Twitter</p>
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          rel="tooltip"
          title="Like us on Facebook"
          data-placement="bottom"
          href="https://www.facebook.com/CreativeTim"
          target="_blank"
        >
          <i class="fab fa-facebook-square"></i>
          <p class="d-lg-none d-xl-none">Facebook</p>
        </a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          rel="tooltip"
          title="Follow us on Instagram"
          data-placement="bottom"
          href="https://www.instagram.com/CreativeTimOfficial"
          target="_blank"
        >
          <i class="fab fa-instagram"></i>
          <p class="d-lg-none d-xl-none">Instagram</p>
        </a>
      </li-->
    </template>
  </navbar>
</template>

<script>
import { DropDown, NavbarToggleButton, Navbar, NavLink } from '@/components';
import { Popover } from 'element-ui';
const axios = require('axios');
export default {
  name: 'main-navbar',
  props: {
    transparent: Boolean,
    colorOnScroll: Number
  },
  components: {
    DropDown,
    Navbar,
    NavbarToggleButton,
    NavLink,
    [Popover.name]: Popover
  },
  data() {
    return {
	  isUserLogin : false,
	  closeNavbar: function(){
		toggleClick();
      }  
    }
  },
  created: function() {
    let vm = this;
    axios.get('/api/userAuth.php')
            .then(function(response){
              console.log(response);
              if(response.data.code == '1'){
                vm.isUserLogin = true;
              }
              //로그인 상태가 아닐 경우
              else{
                //오토로그인 유저의 경우 바로 로그인처리를 해줍니다
                if(localStorage.getItem('gmatAutoLoginMode') != null && localStorage.getItem('gmatAutoLoginMode') == 'on'){
                  vm.userAutoLogin();
                  console.log("로긴상태아님 : 오토로긴");
                }
                //비회원모드 유저의 경우 즉시 오토로그인
                else if(localStorage.getItem('gmatTmpUserId') == null){  //비회원모드 계정이 없을 경우
                  vm.createTmpUserAccount();  //계정생성 후 바로 로그인 처리 된다.
                  console.log("로긴상태아님 : 비회원모드 오토가입");
                }
                else { //비회원 계정정보를 갖고 있다면 비회원모드 로그인 처리
                  vm.tmpUserLogin();
                  console.log("로긴상태아님 : 비회원 로그인");

                }
              }

            });
  },
  methods: {
    createTmpUserAccount(){
      //유효성 검사
      let vm = this;
      let form = new FormData();
      form.append('isTmpUser', 'Y');
      form.append('tmpIdForUpgradeAccount', '');
      form.append('userId', '');
      form.append('userPw', '');

      axios.post('/api/userJoin.php', form)
              .then(function(response){
                console.log(response);
                if(response.data.result == 'success'){
                  if(response.data.code == '1'){
                    localStorage.setItem('gmatTmpUserId', response.data.result);
                  }
                }
              });
    },
    tmpUserLogin(){
      let vm = this;
      let form = new FormData();
      form.append('isTmpUser', 'Y');
      form.append('isLoginReq', 'Y');
      form.append('userId', localStorage.getItem('gmatTmpUserId'));
      form.append('userPw', '');

      axios.post('/api/userLogin.php', form)
              .then(function(response){
                console.log(response);
                if(response.data.result == 'success'){
                  if(response.data.code == '1'){

                  }
                }


              });
    },
    userAutoLogin(){
      let vm = this;
      let form = new FormData();
      form.append('isTmpUser', 'N');
      form.append('isLoginReq', 'Y');
      form.append('userId', localStorage.getItem('gmatUserId'));
      form.append('userPw', localStorage.getItem('gmatUserPw'));

      axios.post('/api/userLogin.php', form)
              .then(function(response){
                console.log(response);
                if(response.data.result == 'success'){
                  if(response.data.code == '2'){
                    vm.isUserLogin = true;

                  }
                  else{
                  }
                }

              });
    }
  }
};

function toggleClick(){
		document.getElementById("navbarToggleButton").click();
}
</script>

<style scoped></style>
