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
			<h1>가입하기</h1>
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

			<fg-input
     		  v-model="inputPasswordConfirm"
			  label="패스워드 확인"
              class="no-border input-lg"
              addon-left-icon="now-ui-icons text_caps-small"
			  type="password"
              placeholder="패스워드를 다시 입력해주세요"
            >
            </fg-input>			
			
            <fg-input
     		  v-model="inputNickname"
     	      label="별명"
              class="no-border input-lg"
              addon-left-icon="now-ui-icons users_circle-08"
              placeholder="별명을 입력해주세요"
            >
            </fg-input>					
			
            <template slot="raw-content">
              <div class="card-footer text-center">
                <a
				  onclick="alert('ok');"
                  href="#pablo"
                  class="btn btn-primary btn-round btn-lg btn-block"
                  >확인</a
                >
              </div>

            </template>
          </card>
        </div>
      </div>
    </div>
    <main-footer></main-footer>
  </div>
</template>
<script>
import { Card, Button, FormGroupInput } from '@/components';
import MainFooter from '@/layout/MainFooter';
export default {
  name: 'login-page',
  bodyClass: 'login-page',
  components: {
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
