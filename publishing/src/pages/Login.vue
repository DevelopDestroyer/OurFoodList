<template>
  <div class="page-header clear-filter" filter-color="orange">
    <div
      class="page-header-image"
      style="background-image: url('img/login.jpg')"
    ></div>
    <div class="content">
      <div class="container">
        <div class="col-md-5 ml-auto mr-auto">
          <card type="login" plain>
            <!--div slot="header" class="logo-container">
              <img v-lazy="'img/now-logo.png'" alt="" />
            </div-->
			<h1>로그인</h1>
            <fg-input
     		  v-model="inputID"
     	      label="아이디"
              class="no-border input-lg"
              addon-left-icon="now-ui-icons users_circle-08"
              placeholder="아이디를 입력해주세요"
            >
            </fg-input>		
			
            <fg-input
     		  v-model="inputPassword"
			  label="패스워드"
              class="no-border input-lg"
              addon-left-icon="now-ui-icons text_caps-small"
			  type="password"
              placeholder="패스워드를 입력해주세요"
            >
            </fg-input>			
			
            <template slot="raw-content">
              <div class="card-footer text-center">
                <a
                  href="#pablo"
                  class="btn btn-primary btn-round btn-lg btn-block"
                  >로그인</a
                >
              </div>
              <div class="card-footer text-center">
                
				<a
                  href="/#/join"
                  class="btn btn-default btn-round btn-lg btn-block"
                  >회원가입</a
                >
              </div>			  
              <!--div class="pull-left">
                <h6>
                  <a href="#pablo" class="link footer-link">Create Account</a>
                </h6>
              </div>
              <div class="pull-right">
                <h6>
                  <a href="#pablo" class="link footer-link">Need Help?</a>
                </h6>
              </div-->
            </template>
          </card>
        </div>
      </div>
    </div>
    <main-footer></main-footer>
  </div>
</template>
<script>
import { Card, Button, FormGroupInput, NavLink } from '@/components';
import MainFooter from '@/layout/MainFooter';
export default {
  name: 'login-page',
  bodyClass: 'login-page',
  components: {
    NavLink,
    Card,
    MainFooter,
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput
  },
  data() {
    return {
	  inputPassword : '',
	  inputID : ''
    }
  }
  
};
</script>
<style></style>
