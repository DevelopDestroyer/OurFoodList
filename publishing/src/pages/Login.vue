<template>
  <div class="page-header clear-filter" filter-color="orange">
    <div
      class="page-header-image"

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

            <div class="form-check">
              <label v-if="checkAutoLogin" for="check1" class="form-check-label">
                <input id="check1" type="checkbox" class="form-check-input" v-model="checkAutoLogin" checked/>
                <span class="form-check-sign"></span>
                자동로그인 (체크됨)
              </label>
              <label v-else for="check1" class="form-check-label">
                <input id="check1" type="checkbox" class="form-check-input" v-model="checkAutoLogin" checked/>
                <span class="form-check-sign"></span>
                자동로그인 (해제됨, 그치만.. 개인장치에서 이용 중이시라면 체크하는게 편리합니다)
              </label>
            </div>
			
            <template slot="raw-content">
              <div class="card-footer text-center">
                <a
                  v-on:click="loginReq()"
                  href="#"
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
import { Card, Button, FormGroupInput, NavLink, Checkbox} from '@/components';
import MainFooter from '@/layout/MainFooter';
const axios = require('axios');
export default {
  name: 'login-page',
  bodyClass: 'login-page',
  components: {
    NavLink,
    Card,
    MainFooter,
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput,
    Checkbox
  },
  data() {
    return {
	  inputPassword : '',
	  inputID : '',
      checkAutoLogin : true
    }
  },
  methods:{
    loginReq(){

      let vm = this;
      let form = new FormData();
      form.append('isTmpUser', 'N');
      form.append('isLoginReq', 'Y');
      form.append('userId', this.inputID);
      form.append('userPw', SHA256(this.inputPassword));

      axios.post('/api/userLogin.php', form)
              .then(function(response){
                console.log(response);
                if(response.data.result == 'success'){
                  if(response.data.code == '2'){
                    if(vm.checkAutoLogin){
                      console.log("자동로그인 on");
                      localStorage.setItem('gmatAutoLoginMode', 'on');
                      localStorage.setItem('gmatUserId', vm.inputID);
                      localStorage.setItem('gmatUserPw', SHA256(vm.inputPassword));
                      location.href = "/";
                    }
                    else{
                      console.log("자동로그인 off");
                      localStorage.setItem('gmatAutoLoginMode', 'off');
                      localStorage.setItem('gmatUserId', '');
                      localStorage.setItem('gmatUserPw', '');
                      location.href = "/";
                    }
                  }
                  else{
                    alert("서버에 뭔가 문제가 있는 것 같습니다.. 관리자에게 문의하세요\n에러코드 : " + response.data.code);
                  }
                }
                else if(response.data.result == 'error' && response.data.code == '-200'){
                  alert("아이디 또는 비밀번호가 맞지 않습니다.");
                }
                else {
                  alert("에러가 발생하였습니다. 관리자에게 문의하세요\n에러코드 : " + response.data.code);
                }

              });
    }

  }
  
};




function SHA256(s){

  var chrsz   = 8;
  var hexcase = 0;

  function safe_add (x, y) {
    var lsw = (x & 0xFFFF) + (y & 0xFFFF);
    var msw = (x >> 16) + (y >> 16) + (lsw >> 16);
    return (msw << 16) | (lsw & 0xFFFF);
  }

  function S (X, n) { return ( X >>> n ) | (X << (32 - n)); }
  function R (X, n) { return ( X >>> n ); }
  function Ch(x, y, z) { return ((x & y) ^ ((~x) & z)); }
  function Maj(x, y, z) { return ((x & y) ^ (x & z) ^ (y & z)); }
  function Sigma0256(x) { return (S(x, 2) ^ S(x, 13) ^ S(x, 22)); }
  function Sigma1256(x) { return (S(x, 6) ^ S(x, 11) ^ S(x, 25)); }
  function Gamma0256(x) { return (S(x, 7) ^ S(x, 18) ^ R(x, 3)); }
  function Gamma1256(x) { return (S(x, 17) ^ S(x, 19) ^ R(x, 10)); }

  function core_sha256 (m, l) {

    var K = new Array(0x428A2F98, 0x71374491, 0xB5C0FBCF, 0xE9B5DBA5, 0x3956C25B, 0x59F111F1,
            0x923F82A4, 0xAB1C5ED5, 0xD807AA98, 0x12835B01, 0x243185BE, 0x550C7DC3,
            0x72BE5D74, 0x80DEB1FE, 0x9BDC06A7, 0xC19BF174, 0xE49B69C1, 0xEFBE4786,
            0xFC19DC6, 0x240CA1CC, 0x2DE92C6F, 0x4A7484AA, 0x5CB0A9DC, 0x76F988DA,
            0x983E5152, 0xA831C66D, 0xB00327C8, 0xBF597FC7, 0xC6E00BF3, 0xD5A79147,
            0x6CA6351, 0x14292967, 0x27B70A85, 0x2E1B2138, 0x4D2C6DFC, 0x53380D13,
            0x650A7354, 0x766A0ABB, 0x81C2C92E, 0x92722C85, 0xA2BFE8A1, 0xA81A664B,
            0xC24B8B70, 0xC76C51A3, 0xD192E819, 0xD6990624, 0xF40E3585, 0x106AA070,
            0x19A4C116, 0x1E376C08, 0x2748774C, 0x34B0BCB5, 0x391C0CB3, 0x4ED8AA4A,
            0x5B9CCA4F, 0x682E6FF3, 0x748F82EE, 0x78A5636F, 0x84C87814, 0x8CC70208,
            0x90BEFFFA, 0xA4506CEB, 0xBEF9A3F7, 0xC67178F2);

    var HASH = new Array(0x6A09E667, 0xBB67AE85, 0x3C6EF372, 0xA54FF53A, 0x510E527F,
            0x9B05688C, 0x1F83D9AB, 0x5BE0CD19);

    var W = new Array(64);
    var a, b, c, d, e, f, g, h, i, j;
    var T1, T2;

    m[l >> 5] |= 0x80 << (24 - l % 32);
    m[((l + 64 >> 9) << 4) + 15] = l;

    for ( var i = 0; i<m.length; i+=16 ) {
      a = HASH[0];
      b = HASH[1];
      c = HASH[2];
      d = HASH[3];
      e = HASH[4];
      f = HASH[5];
      g = HASH[6];
      h = HASH[7];

      for ( var j = 0; j<64; j++) {
        if (j < 16) W[j] = m[j + i];
        else W[j] = safe_add(safe_add(safe_add(Gamma1256(W[j - 2]), W[j - 7]), Gamma0256(W[j - 15])), W[j - 16]);

        T1 = safe_add(safe_add(safe_add(safe_add(h, Sigma1256(e)), Ch(e, f, g)), K[j]), W[j]);
        T2 = safe_add(Sigma0256(a), Maj(a, b, c));

        h = g;
        g = f;
        f = e;
        e = safe_add(d, T1);
        d = c;
        c = b;
        b = a;
        a = safe_add(T1, T2);
      }

      HASH[0] = safe_add(a, HASH[0]);
      HASH[1] = safe_add(b, HASH[1]);
      HASH[2] = safe_add(c, HASH[2]);
      HASH[3] = safe_add(d, HASH[3]);
      HASH[4] = safe_add(e, HASH[4]);
      HASH[5] = safe_add(f, HASH[5]);
      HASH[6] = safe_add(g, HASH[6]);
      HASH[7] = safe_add(h, HASH[7]);
    }
    return HASH;
  }

  function str2binb (str) {
    var bin = Array();
    var mask = (1 << chrsz) - 1;
    for(var i = 0; i < str.length * chrsz; i += chrsz) {
      bin[i>>5] |= (str.charCodeAt(i / chrsz) & mask) << (24 - i%32);
    }
    return bin;
  }

  function Utf8Encode(string) {
    string = string.replace(/\r\n/g,"\n");
    var utftext = "";

    for (var n = 0; n < string.length; n++) {

      var c = string.charCodeAt(n);

      if (c < 128) {
        utftext += String.fromCharCode(c);
      }
      else if((c > 127) && (c < 2048)) {
        utftext += String.fromCharCode((c >> 6) | 192);
        utftext += String.fromCharCode((c & 63) | 128);
      }
      else {
        utftext += String.fromCharCode((c >> 12) | 224);
        utftext += String.fromCharCode(((c >> 6) & 63) | 128);
        utftext += String.fromCharCode((c & 63) | 128);
      }

    }

    return utftext;
  }

  function binb2hex (binarray) {
    var hex_tab = hexcase ? "0123456789ABCDEF" : "0123456789abcdef";
    var str = "";
    for(var i = 0; i < binarray.length * 4; i++) {
      str += hex_tab.charAt((binarray[i>>2] >> ((3 - i%4)*8+4)) & 0xF) +
              hex_tab.charAt((binarray[i>>2] >> ((3 - i%4)*8  )) & 0xF);
    }
    return str;
  }

  s = Utf8Encode(s);
  return binb2hex(core_sha256(str2binb(s), s.length * chrsz));

}
</script>
<style></style>
