  
<template>
    <div class="page-header clear-filter" filter-color="orange">
      <parallax
        class=""
      >
      </parallax>
    <div class="content">


      <div class="container">
      <h1 id="menu_title">내 맛집등록</h1>
          <p v-if="!isRealUserLogin">* 맛집기록은 할 수 있지만 로그인하면 더 많은 기능을 사용 할 수 있습니다.</p>
          <n-button v-if="!isRealUserLogin" v-on:click="moveJoinPage()" style="margin-top:0px;" type="warning">
              10초만에 가입
          </n-button>
          <n-button v-if="!isRealUserLogin" v-on:click="moveLoginPage()" style="margin-top:0px;" type="warning">
              로그인
          </n-button>
          <n-button v-if="!isRealUserLogin" v-on:click="help()" style="margin-top:0px;" type="info">
              설명충
          </n-button>
	  <template>
        <div class="row justify-content-md-center" style="margin-left:12px;">
          <fg-input class="col-10"
 	        	v-model="inputKeyword"
                placeholder="맛집을 검색해주세요" v-on:keyup.enter="searchReq()">
          </fg-input>
				  
		  <n-button v-on:click="searchReq()" style="margin-top:1px;" type="primary" icon round>
			<i class="fa fa-search"></i>
		  </n-button>

        </div>
		<br/>
		<br/>
        <div class="row justify-content-md-center">
          <div class="col-md-1 col-lg-1"></div>
		  
		  <div class="col-md-10 col-lg-10" style="border:0px solid white;width:100%;height:500px; overflow-y:scroll;overflow-x:hidden">



 <card style="width: 100%; color:black; text-align:left">

    <ul v-for="item in list" v-bind:key="item.id"
	  slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>{{item.title}}</h5>
   	   <i class="now-ui-icons location_bookmark"></i> {{item.category}}<br/><br/>
	   <badge type="primary">지번</badge> {{item.address}} <br/>
	   <badge type="primary">도로명</badge> {{item.roadAddress}} <br/>
	   <!--input type="hidden" :value=item.mapx></input>
	   <input type="hidden" :value=item.mapy></input-->
	   
	   
       <n-button type="primary" size="sm" v-if="item.mapx != 0 && !item.isCheckEXP" @click.native="modals.notice=true" v-on:click="setEXPForm(item.storeId)">
           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="10" y1="3" x2="13" y2="6" data-cap="butt" data-color="color-2"></line> <line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="2" y1="11" x2="5" y2="14" data-cap="butt" data-color="color-2"></line> <polygon fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="12,1 15,4 5,14 1,15 2,11 " data-cap="butt"></polygon> </g></svg>
           가봤던 곳
       </n-button>
       <n-button type="primary" size="sm"  v-if="item.mapx != 0 && item.isCheckEXP" disabled>
           ✔ 가봤던 곳
       </n-button>
       <n-button type="primary" size="sm" v-if="item.mapx != 0 && !item.isCheckBookmark && !item.isCheckEXP" v-on:click="setBookmark(item.storeId)">
           <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="10" y1="3" x2="13" y2="6" data-cap="butt" data-color="color-2"></line> <line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="2" y1="11" x2="5" y2="14" data-cap="butt" data-color="color-2"></line> <polygon fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="12,1 15,4 5,14 1,15 2,11 " data-cap="butt"></polygon> </g></svg>
           찜하기
       </n-button>
       <n-button type="primary" size="sm" v-if="item.mapx != 0 && item.isCheckBookmark && !item.isCheckEXP" disabled>
           ✔ 찜하기
       </n-button>

     </li> 
   </ul>


	<!--샘플카드-->
   <!--ul slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>이태리 부대찌개2</h5>
	   <badge type="primary">도로명</badge> 성남시 분당구 판교로 <br/>
       <n-button type="primary" size="sm">등록하기</n-button>
     </li> 
   </ul-->
  
  </card>

		  
		  </div>
		  <div class="col-md-1 col-lg-1"></div>
        </div>	
	   
<template>
<modal :show.sync="modals.notice"
             footer-classes="justify-content-center"
             type="notice" style="color:gray;margin-top:80px;">
			 <br><br>
		 
        <h5 slot="header" class="modal-title">맛집 등록</h5>
    <div class="row">
        <fieldset class="rating" style="margin-top: -70px; height:50px;">

            <input type="radio" id="5star" name="rating" value="5" v-on:click="clickStar('5')"/>
            <label class="full" for="5star" title="Excellent"></label>

            <input type="radio" id="4halfstar" name="rating" value="4.5"  v-on:click="clickStar('4.5')"/>
            <label class="half" for="4halfstar" title="Good"></label>

            <input type="radio" id="4star" name="rating" value="4"  v-on:click="clickStar('4')"/>
            <label class="full" for="4star" title="Pretty good"></label>

            <input type="radio" id="3halfstar" name="rating" value="3.5"  v-on:click="clickStar('3.5')"/>
            <label class="half" for="3halfstar" title="Nice"></label>

            <input type="radio" id="3star" name="rating" value="3"  v-on:click="clickStar('3')"/>
            <label class="full" for="3star" title="Ok"></label>

            <input type="radio" id="2halfstar" name="rating" value="2.5"  v-on:click="clickStar('2.5')"/>
            <label class="half" for="2halfstar" title="Kinda bad"></label>

            <input type="radio" id="2star" name="rating" value="2"  v-on:click="clickStar('2')"/>
            <label class="full" for="2star" title="Bad"></label>

            <input type="radio" id="1halfstar" name="rating" value="1.5" v-on:click="clickStar('1.5')" />
            <label class="half" for="1halfstar" title="Meh"></label>

            <input type="radio" id="1star" name="rating" value="1" v-on:click="clickStar('1')" />
            <label class="full" for="1star" title="Umm"></label>

            <input type="radio" id="halfstar" name="rating" value="0.5" v-on:click="clickStar('0.5')" />
            <label class="half" for="halfstar" title="Worst"></label>

        </fieldset>
    </div>
    <div class="row">
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
                비오는날　
            </label>
        </div>
        <div class="form-check">
            <label for="check7" class="form-check-label">
                <input id="check7" type="checkbox" class="form-check-input" value="7" v-model="tags" />
                <span class="form-check-sign"></span>
                럭셔리　
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
        <div class="row" style="padding-left: 20px">
        　　<fg-input placeholder="한줄기록 (안써도 됩니다)" style="width:280px;" v-model="memo"></fg-input>
        </div>
        <!--div class="row" style="padding: 20px">
           <n-button type="info" round @click.native="modals.notice = false" v-on:click="setEXP(item.mapx + '-' + item.mapy + '-' + item.title)">Sounds good!</n-button>
        </div-->
    </div>

        <div slot="footer" class="justify-content-center">
          <n-button type="info" round @click.native="modals.notice = false" v-on:click="setEXP()">나의 맛집 등록</n-button>
        </div>

</modal>
</template>

		
       </template>

	   

	  

      </div>
    </div>
  </div>
  

  
  
</template>

<script>
import { Card, Button, FormGroupInput, Badge, Modal, Checkbox } from '@/components';
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
    Checkbox
  },
  data() {
    return {
      isRealUserLogin: true,
	  inputKeyword : '',
      modals: {
          notice: false
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
        rating: 0,
        tags: [],
        memo: "",
        targetId: "",
        visitYn: "N"


    }
  },
    created: function() {
        let vm = this;
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
            form.append('tags',this.tags);
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
                        for(var i = 0; i < vm.list.length; i++){
                            if(vm.list[i].storeId == idBiff){
                                vm.list[i].isCheckBookmark = true;
                                break;
                            }
                        }
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
        form.append('visitYn',this.visitYn);
        form.append('tags',this.tags);
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
                    for(var i = 0; i < vm.list.length; i++){
                        if(vm.list[i].storeId == idBiff){
                            vm.list[i].isCheckEXP = true;
                            break;
                        }
                    }
                }
                else {
                        alert("에러가 발생하였습니다. 관리자에게 문의하세요");
                }

            });
    },
    setEXPForm(id){
        //폼 초기화
        this.targetId = id;
        this.memo = "";
        this.tags = [];
        this.visitYn = "Y";
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
