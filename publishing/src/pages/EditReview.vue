  
<template>
    <div class="page-header clear-filter" filter-color="orange">
      <parallax
        class=""
      >
      </parallax>
    <div class="content">


      <div class="container">

          <h1 slot="header" class="modal-title">나의 맛집 편집</h1>
          <br/>
          <br/>
          <div class="row justify-content-md-center">
              <h5 v-if="!isRealUserLogin">* 로그인하면 더 많은 기능을 사용 할 수 있습니다.</h5>
              <br/>

          </div>
          <div style="background-color: #FFFFFF; color:black; padding:20px;">
          <n-button v-if="!isRealUserLogin" v-on:click="moveJoinPage()" style="margin-top:0px;" type="warning">
              10초만에 가입
          </n-button>
          <n-button v-if="!isRealUserLogin" v-on:click="moveLoginPage()" style="margin-top:0px;" type="warning">
              로그인
          </n-button>
          <n-button v-if="!isRealUserLogin" v-on:click="help()" style="margin-top:0px;" type="info">
              설명충
          </n-button>
          <br/>


          <div class="row justify-content-md-center">
            <fieldset class="rating" style="margin-top: 0px; height:50px;">
                  <input v-if="rating==5" type="radio" id="5star" name="rating" value="5" v-on:click="clickStar('5')" checked/>
                  <input v-else type="radio" id="5star" name="rating" value="5" v-on:click="clickStar('5')"/>
                  <label class="full" for="5star" title="Excellent"></label>


                  <input v-if="rating==4.5" type="radio" id="4halfstar" name="rating" value="4.5" v-on:click="clickStar('4.5')"/>
                  <input v-else type="radio" id="4halfstar" name="rating" value="4.5"  v-on:click="clickStar('4.5')"/>
                  <label class="half" for="4halfstar" title="Good"></label>

                  <input v-if="rating==4" type="radio" id="4star" name="rating" value="4" v-on:click="clickStar('4')"/>
                  <input v-else type="radio" id="4star" name="rating" value="4"  v-on:click="clickStar('4')"/>
                  <label class="full" for="4star" title="Pretty good"></label>

                <input v-if="rating==3.5" type="radio" id="3halfstar" name="rating" value="3.5" v-on:click="clickStar('3.5')"/>
                <input v-else type="radio" id="3halfstar" name="rating" value="3.5"  v-on:click="clickStar('3.5')" />
                  <label class="half" for="3halfstar" title="Nice"></label>

                <input v-if="rating==3" type="radio" id="3star" name="rating" value="3" v-on:click="clickStar('3')"/>
                <input v-else type="radio" id="3star" name="rating" value="3"  v-on:click="clickStar('3')"/>
                  <label class="full" for="3star" title="Ok"></label>

                <input v-if="rating==2.5" type="radio" id="2halfstar" name="rating" value="2.5" v-on:click="clickStar('2.5')"/>
                <input v-else type="radio" id="2halfstar" name="rating" value="2.5"  v-on:click="clickStar('2.5')"/>
                  <label class="half" for="2halfstar" title="Kinda bad"></label>

                <input v-if="rating==2" type="radio" id="2star" name="rating" value="2" v-on:click="clickStar('2')"/>
                <input v-else type="radio" id="2star" name="rating" value="2"  v-on:click="clickStar('2')"/>
                  <label class="full" for="2star" title="Bad"></label>

                <input v-if="rating==1.5" type="radio" id="1halfstar" name="rating" value="1.5" v-on:click="clickStar('1.5')"/>
                <input v-else type="radio" id="1halfstar" name="rating" value="1.5" v-on:click="clickStar('1.5')" />
                  <label class="half" for="1halfstar" title="Meh"></label>

                <input v-if="rating==1" type="radio" id="1star" name="rating" value="1" v-on:click="clickStar('1')"/>
                <input v-else type="radio" id="1star" name="rating" value="1" v-on:click="clickStar('1')" />
                  <label class="full" for="1star" title="Umm"></label>

                <input v-if="rating==0.5" type="radio" id="halfstar" name="rating" value="0.5" v-on:click="clickStar('0.5')"/>
                <input v-else type="radio" id="halfstar" name="rating" value="0.5" v-on:click="clickStar('0.5')" />
                  <label class="half" for="halfstar" title="Worst"></label>

              </fieldset>
          </div>
          <div class="row justify-content-md-center">
                 <div class="form-check">
                  <label for="check1" class="form-check-label">
                      <input id="check1" type="checkbox" class="form-check-input" value="1" v-model="tags" />
                      <span class="form-check-sign"></span>
                      가성비　
                  </label>

                  <label for="check2" class="form-check-label">
                      <input id="check2" type="checkbox" class="form-check-input" value="2" v-model="tags" />
                      <span class="form-check-sign"></span>
                      분위기　
                  </label>

                  <label for="check3" class="form-check-label">
                      <input id="check3" type="checkbox" class="form-check-input" value="3" v-model="tags" />
                      <span class="form-check-sign"></span>
                      배달맛집　
                  </label>
                     <br/>
                     <br/>
              </div>
              <div class="form-check">
                  <label for="check4" class="form-check-label">
                      <input id="check4" type="checkbox" class="form-check-input" value="4" v-model="tags" />
                      <span class="form-check-sign"></span>
                      경치좋은　
                  </label>

                  <label for="check5" class="form-check-label">
                      <input id="check5" type="checkbox" class="form-check-input" value="5" v-model="tags" />
                      <span class="form-check-sign"></span>
                      깔끔한　
                  </label>

                  <label for="check6" class="form-check-label">
                      <input id="check6" type="checkbox" class="form-check-input" value="6" v-model="tags" />
                      <span class="form-check-sign"></span>
                      데이트　
                  </label>
                  <br/>
                  <br/>
              </div>
              <div class="form-check">
                  <label for="check7" class="form-check-label">
                      <input id="check7" type="checkbox" class="form-check-input" value="7" v-model="tags" />
                      <span class="form-check-sign"></span>
                      인스타　
                  </label>

                  <label for="check8" class="form-check-label">
                      <input id="check8" type="checkbox" class="form-check-input" value="8" v-model="tags" />
                      <span class="form-check-sign"></span>
                      회식　
                  </label>
                  <label for="check9" class="form-check-label">
                      <input id="check9" type="checkbox" class="form-check-input" value="9" v-model="tags" />
                      <span class="form-check-sign"></span>
                      술　
                  </label>
              </div>
              <br/>
              <br/>
              <br/>
              <br/>
              <fg-input placeholder="한줄기록 (안써도 됩니다)" class="col-10" v-model="memo"></fg-input>


              <!--div class="row" style="padding: 20px">
                 <n-button type="info" round @click.native="modals.notice = false" v-on:click="setEXP(item.mapx + '-' + item.mapy + '-' + item.title)">Sounds good!</n-button>
              </div-->
          </div>

          <n-button type="info" round @click.native="modals.notice = false" v-on:click="setEXP()">나의 맛집 등록</n-button>
          </div>

	   

	  

      </div>
    </div>
  </div>
  

  
  
</template>

<script>
import { Card, Button, FormGroupInput, Badge, Modal, Checkbox } from '@/components';
import { BUS } from './EventBus';
import MainFooter from '@/layout/MainFooter';
const axios = require('axios');
export default {
  name: 'login-page',
  bodyClass: 'login-page',
  components: {
    Card,
    MainFooter,
	Modal,
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput,
	[Badge.name]: Badge,
    Checkbox,
      BUS
  },
  data() {
    return {
      isRealUserLogin: true,
	  inputKeyword : '',
      modals: {
          classic: true
      },	  
	  list: [
		{
		    storeId: "",
			title: "검색해주세요!",
			link: "",
			category: "",
			description: "",
			telephone: "",
			address: "",
			roadAddress: "",
			mapx: "0",
			mapy: "0",
            isCheckEXP: false,
            isCheckBookmark: false
		}
	  ],
	  getData: function(){

		/*
        axios.get('https://raw.githubusercontent.com/joshua1988/doit-vuejs/master/data/demo.json')
//        axios.get('/api/searchRestaurant.php?keyword=')
          .then(function(response){
            alert("받아온 값 : " + response.data.fe3);
            console.log(response); // 객체 형태로 반환. 파싱작업 불필요
           });
		  */ 
      },

        markerDrawReq: null,


        rating: 0,
        tags: [],
        memo: "",
        targetId: "",
        visitYn: "Y"


    }
  },
    mounted: function(){

    },
    created: function() {
        let vm = this;
        BUS.$on('startDrawMaker',function(data){
            //this.showMeTheMap = true;
            console.log("그린다고하니 멈춥시다");
            clearInterval(vm.markerDrawReq);//지도 컴포넌트에서 그리겠다는 응답이 오면 요청 멈춰라
        })

        BUS.$on('editReview',function(data) {
            BUS.$emit('startEditReview', 1)
            console.log("에딧리뷰 요청이 왔어요 : " + data.tagList);
            vm.targetId = data.storeId;
            vm.memo = data.review;
            vm.rating = data.rating;
            if(data.tagList == '')
                vm.tags = [];
            else{
                vm.tags = data.tagList.split(',');
                vm.tags.slice().sort(function(a,b){return a - b}).reduce(function(a,b){if (a.slice(-1)[0] !== b) a.push(b);return a;},[]);
            }
            vm.visitYn = data.visitYn;
            /*
            storeId : storeId,
			rating : rating,
			tagList : taglist,
			review : memo

			        rating: 0,
        tags: [],
        memo: "",
        targetId: "",
        visitYn: "N"
            */
        });

        axios.get('/api/userAuth.php')
            .then(function(response){
                console.log(response);
                if(response.data.code == '2'){
                    vm.isRealUserLogin = true;
                }
                else{
                    vm.isRealUserLogin = false;
                }
            });
    },
  methods: {
  
	emptyList(){
     	this.list = [];
	},
    searchReq(){
	    var vm = this;
		/*
        axios.get('https://raw.githubusercontent.com/joshua1988/doit-vuejs/master/data/demo.json')
//        axios.get('/api/searchRestaurant.php?keyword=')
          .then(function(response){
            alert("받아온 값 : " + response.data.fe3);
			vm.list = [];
            console.log(response); // 객체 형태로 반환. 파싱작업 불필요
           });		
		*/
        axios.get('/api/searchRestaurantK.php?keyword=' + this.inputKeyword)
          .then(function(response){
            console.log(response);
			vm.list = [];
			for(var i = 0; i < response.data.documents.length; i++){

				vm.list.push({
					title: response.data.documents[i].place_name,
					link: response.data.documents[i].place_url,
					category: response.data.documents[i].category_name,
					description: response.data.documents[i].description,
					telephone: response.data.documents[i].phone,
					address: response.data.documents[i].address_name,
					roadAddress: response.data.documents[i].road_address_name,
                    mapx: response.data.documents[i].x,
                    mapy: response.data.documents[i].y,
                    isStoreInfo: true,
                    isCheckEXP: false,
                    isCheckBookmark: false,
                    storeId: response.data.documents[i].id
				})
			}
        });	
		
		

	},
    setBookmark(id){
	    var res = confirm("여기를 찜하기로 기록 할까요?");
	    if(res){
	        this.targetId = id;
	        this.visitYn = 'N';

            //전송부분 구현...
            var idBiff = this.targetId;

            let vm = this;
            let form = new FormData();
            form.append('storeId', this.targetId);
            form.append('rating',this.rating);
            form.append('review',this.memo);
            form.append('visitYn',this.visitYn);
            form.append('tags',this.tags.slice().sort(function(a,b){return a - b}).reduce(function(a,b){if (a.slice(-1)[0] !== b) a.push(b);return a;},[]));
            form.append('delYn',"N");


            axios.post('/api/saveReview.php', form)
                .then(function(response){
                    console.log(response);
                    if(response.data.result == 'success'){
                        if(response.data.code == '1'){
                            alert("찜했어요!");
                        }
                        else if(response.data.code == '100'){
                            alert("이미 찜한 맛집 입니다.");
                        }
                        else if(response.data.code == '101'){
                            alert("이미 리뷰한 맛집 입니다.");
                        }
                        else if(response.data.code == '102'){
                            alert("나의 맛집이 등록되었습니다!!");
                        }
                        else if(response.data.code == '103'){
                            alert("이미 리뷰했던 맛집이지만.. 내용을 최신본으로 업데이트 했어요!");
                        }
                        else{
                            alert("서버에 뭔가 문제가 있는 것 같습니다.. 관리자에게 문의하세요");
                        }
                        location.href="/#/";
                    }
                    else {
                        alert("에러가 발생하였습니다. 관리자에게 문의하세요");
                    }

                });
        }
    },
    setEXP(){
        //전송부분 구현...
        var idBiff = this.targetId;
        let vm = this;
        let form = new FormData();
        form.append('storeId', this.targetId);
        form.append('rating',this.rating);
        form.append('review',this.memo);
        form.append('visitYn','Y');
        //이 페이지의 tags는 emit의 특성으로 인해 여러개의 중첩된 소스를 갖고있을 가능성이 있다.. 중복된 녀석들을 제거해준다.
        form.append('tags',this.tags.slice().sort(function(a,b){return a - b}).reduce(function(a,b){if (a.slice(-1)[0] !== b) a.push(b);return a;},[]));
        form.append('delYn',"N");

        axios.post('/api/saveReview.php', form)
            .then(function(response){
                console.log(response);
                if(response.data.result == 'success'){
                    if(response.data.code == '1'){
                        alert("나의 맛집이 등록되었습니다!");
                    }
                    else if(response.data.code == '100'){
                        alert("이미 찜한 맛집 입니다.");
                    }
                    else if(response.data.code == '101'){
                        alert("이미 리뷰한 맛집 입니다.");
                    }
                    else if(response.data.code == '102'){
                        alert("나의 맛집이 등록되었습니다!!");
                    }
                    else if(response.data.code == '103'){
                        alert("이미 리뷰했던 맛집이지만 내용을 최신본으로 업데이트 했어요!");
                    }
                    else{
                        alert("서버에 뭔가 문제가 있는 것 같습니다.. 관리자에게 문의하세요");
                    }
                    vm.markerDrawReq =  setInterval(function() {
                        BUS.$emit('sessionState', '10');
                        console.log("마커를 그려달라 요청을 보냅니다");
                    }, 100);
                    location.href="/#/";
                }
                else {
                        alert("에러가 발생하였습니다. 관리자에게 문의하세요");
                }

            });
    },
      clickStar(score){
	    this.rating = score;
      },
      moveLoginPage(){
	    location.href="/#/login";
      },
      moveJoinPage(){
	    location.href="/#/join";
      },
      help(){
          alert('현재 비로그인 상태로 맛집기록을 하고 있습니다.\n' +
              '캐시 데이터가 삭제돼면 데이터를 잃을 수도 있으니 가입해서 맛집을 기록해주세요!\n' +
              '가입하면 자동으로 비회원 상태에서 쌓은 데이터도 이전됩니다.\n')
      }
  }
};


				
</script>
<style></style>
