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
        <a href="#" v-on:click="gohome()" style="text-decoration:none;">그맛</a>
      </router-link>
      <el-popover
        ref="popover1"
        popper-class="popover"
        placement="bottom"
        width="500"
        trigger="hover"
      >
        <div class="popover-body">
          내가 아는 그 맛이 제일 맛있는 맛
        </div>
      </el-popover>
    </template>
    <template slot="navbar-menu">
      <li class="nav-item">
        <a
                class="nav-link"
                href="#"
                v-on:click="gohome"
        >
          <i class="now-ui-icons location_map-big"></i>
          <p>　맛집지도</p>
        </a>
      </li>
      <li v-if="!isUserLogin" class="nav-item">
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
      <!--li class="nav-item">
        <a
                class="nav-link"
                href="/#/"
                @click="closeNavbar"
        >
          <i class="now-ui-icons sport_trophy"></i>
          <p>　랭킹</p>
        </a>
      </li>
      <li v-if="isUserLogin" class="nav-item">
        <a
          class="nav-link"
          href="/#/"
		  @click="closeNavbar"
        >
          <i class="now-ui-icons users_circle-08"></i>
          <p>　내 정보</p>
        </a>
      </li-->
      <li class="nav-item">
        <a
                class="nav-link"
                @click="closeNavbar"
                href="/#/newsfeed"
        >
          <i class="fa fa-users"></i>
          <p>　친구들리뷰</p>
        </a>
      </li>
      <li v-if="isUserLogin" class="nav-item">
        <a
                class="nav-link"
                @click="closeNavbar"
                href="/#/profile/_my"
        >
          <i class="now-ui-icons users_circle-08"></i>
          <p>　내정보</p>
        </a>
      </li>
      <li v-if="isUserLogin" class="nav-item">
        <a
            class="nav-link"
            href="/#/coupon"
            @click="closeNavbar"
        >
          <i class="now-ui-icons business_money-coins"></i>
          <p>　쿠폰등록</p>
        </a>
      </li>
      <li v-if="isUserLogin" class="nav-item">
        <a
                class="nav-link"
                href="#"
                v-on:click="logout()"
        >
          <i class="now-ui-icons media-1_button-power"></i>
          <p>　로그아웃</p>
        </a>
      </li>
    </template>
  </navbar>
</template>

<script>
import { DropDown, NavbarToggleButton, Navbar, NavLink } from '@/components';
import { BUS } from '../pages/EventBus';
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
    [Popover.name]: Popover,
    BUS
  },
  data() {
    return {
	  isUserLogin : false,
      //showMeTheMap : false,
      markerDrawReq : null,
      markerDrawReqCnt : 0,
      closeNavbar: function(){
		toggleClick();
      }  
    }
  },
  mounted: function() {
    var vm = this;
    BUS.$on('startDrawMaker',function(data){
      //this.showMeTheMap = true;
      console.log("그린다고하니 멈춥시다");
      clearInterval(vm.markerDrawReq);//지도 컴포넌트에서 그리겠다는 응답이 오면 요청 멈춰라
      vm.markerDrawReqCnt = 0;
    })
  },
  created: function() {
    let vm = this;
    axios.get('/api/userAuth.php')
            .then(function(response){
              console.log(response);
              if(response.data.code == '2') {
                vm.isUserLogin = true;
                vm.sendEmit(2);
              }
              else if(response.data.code == '1'){
                vm.sendEmit(1);
              }
              if(response.data.code == '-1'){
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
                    localStorage.setItem('gmatTmpUserId', response.data.message);
                    vm.sendEmit(1);
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
                    vm.sendEmit(1);
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
                    vm.sendEmit(2);
                  }
                  else{
                  }
                }

              });
    },
    logout(){
      let vm = this;
      let form = new FormData();
      form.append('isTmpUser', '');
      form.append('isLoginReq', 'N');
      form.append('userId', '');
      form.append('userPw', '');

      axios.post('/api/userLogin.php', form)
              .then(function(response){
                console.log(response);
                if(response.data.result == 'success'){
                  if(response.data.code == '3'){
                    vm.isUserLogin = true;
                    console.log("자동로그인 off");
                    localStorage.setItem('gmatAutoLoginMode', 'off');
                    localStorage.setItem('gmatUserId', '');
                    localStorage.setItem('gmatUserPw', '');
                    location.href = "/";

                    location.href="/";

                  }
                  else{
                    alert("다시 시도해 주세요.");
                  }
                }

              });
    },
    sendEmit(msg){
      let vm = this;
      this.markerDrawReq =  setInterval(function() {
        BUS.$emit('sessionState', msg);
        console.log("마커를 그려달라 요청을 보냅니다" + vm.markerDrawReqCnt + ", " + vm.markerDrawReq + ", " + window.location.href);
        vm.markerDrawReqCnt++;
        if(vm.markerDrawReqCnt > 30){
          console.log("30회나 요청했으니 그냥 멈춥니다");
          clearInterval(vm.markerDrawReq);
          vm.markerDrawReqCnt = 0;
        }

      }, 100);
      //BUS.$emit('sessionState', msg);
    },
    gohome() {
      location.href="/#/";
      this.sendEmit(3);
      this.closeNavbar();
    }

  }
};

function toggleClick(){
		document.getElementById("navbarToggleButton").click();
}


</script>

<style scoped></style>
