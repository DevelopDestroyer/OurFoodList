<template>
  <div>
    <div class="page-header clear-filter" filter-color="orange">
      <parallax
        class="page-header-image"
        style="background-image:url('img/bg6.jpg')"
      >
      </parallax>
      <div class="container">

        <h1 class="title">{{storeName}}</h1>
        <p class="category">{{address}}</p>
        <p class="category">{{category}}</p>
        <p class="category">{{telephone}}</p>
        <div class="content">
          <div class="social-description">
            <h2>{{reviewCnt}}</h2>
            <p>리뷰</p>
          </div>
          <div class="social-description">
            <h2>{{bookmarkCnt}}</h2>
            <p>찜하기</p>
          </div>
          <div class="social-description">
            <h2>{{Number.parseFloat(score).toFixed(2)}}</h2>
            <p>별점</p>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="button-container">
          <a href="#button" class="btn btn-primary btn-round btn-lg" v-on:click="goEditReview(restaurantId)">리뷰하기</a>
          <a href="#button" class="btn btn-default btn-round btn-lg" v-on:click="setBookmark(restaurantId)">찜하기</a>
        </div>
        <h3 class="title">리뷰</h3>


        <div class="card" style="width: 100%;"  v-for="item in reviewData" v-bind:key="item.id">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <p style="font-size: 24px;">
                <img :src=item.avatar width="50px" style="border-radius: 25px">
                {{item.userId}}
                <n-button type="primary" icon round v-on:click="goUserDetail(item.userId)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>
              </p>
              <i class="fa fa-clock"></i> 날짜 : {{item.created}}
              <br/>　
              <i class="fa fa-star-o"></i> 별점 :
              <template v-if="item.rating > 4.5 && item.rating <= 5">
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
              </template>
              <template v-else-if="item.rating > 4 && item.rating <= 4.5">
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star_half.png' height='20px'/>
              </template>
              <template v-else-if="item.rating > 3.5 && item.rating <= 4">
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
              </template>
              <template v-else-if="item.rating > 3 && item.rating <= 3.5">
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star_half.png' height='20px'/>
              </template>
              <template v-else-if="item.rating > 2.5 && item.rating <= 3">
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
              </template>
              <template v-else-if="item.rating > 2 && item.rating <= 2.5">
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star_half.png' height='20px'/>
              </template>
              <template v-else-if="item.rating > 1.5 && item.rating <= 2">
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star.png' height='20px'/>
              </template>
              <template v-else-if="item.rating > 1 && item.rating <= 1.5">
                <img src='img/marker/star.png' height='20px'/>
                <img src='img/marker/star_half.png' height='20px'/>
              </template>
              <template v-else-if="item.rating > 0.5 && item.rating <= 1">
                <img src='img/marker/star.png' height='20px'/>
              </template>
              <template v-else>
                <img src='img/marker/star_half.png' height='20px'/>
              </template>

              <br/>
              <br/>
              <span v-if="item.review != null && item.review != ''" style="padding: 5px; background-color: rgb(228, 96, 109); color: rgb(255, 255, 255);">
                {{item.review}}
              </span>
              <br/>
              <br/>
              <badge type="warning" v-for="tagItem in item.taglist.split(',')" v-bind:key="tagItem.id" >
                <template v-if="tagItem == '1'">
                  # 가성비
                </template>
                <template v-else-if="tagItem == '2'">
                  # 분위기
                </template>
                <template v-else-if="tagItem == '3'">
                  # 배달맛집
                </template>
                <template v-else-if="tagItem == '4'">
                  # 경치좋은
                </template>
                <template v-else-if="tagItem == '5'">
                  # 깔끔한
                </template>
                <template v-else-if="tagItem == '6'">
                  # 데이트
                </template>
                <template v-else-if="tagItem == '7'">
                  # 인스타
                </template>
                <template v-else-if="tagItem == '8'">
                  # 회식
                </template>
                <template v-else-if="tagItem == '9'">
                  # 술
                </template>
                <template v-else-if="tagItem == '10'">
                  # 혼밥
                </template>
                <template v-else-if="tagItem == '11'">
                  # 기념일
                </template>
                <template v-else-if="tagItem == '12'">
                  # 가족외식
                </template>
                <template v-else-if="tagItem == '13'">
                  # 숨은맛집
                </template>
                <template v-else-if="tagItem == '14'">
                  # 무료주차
                </template>
                <template v-else-if="tagItem == '15'">
                  # 24시간영업
                </template>
              </badge>
            </li>
          </ul>
        </div>


      </div>
    </div>

    <modal :show.sync="alertModal">
      <template slot="header">
        <h5 class="modal-title" id="alertModalLabel" style="color:gray;">알림</h5>
      </template>
      <div style="color:gray;">
        {{alertMsg}}
      </div>
      <template slot="footer">
        <n-button type="primary" v-on:click="alertModal = false">확인</n-button>
      </template>
    </modal>

  </div>
</template>
<script>
import { Tabs, TabPane , Badge, Button, FormGroupInput, Modal } from '@/components';
import {BUS} from "./EventBus";
const axios = require('axios');

export default {
  name: 'profile',
  bodyClass: 'profile-page',
  components: {
    Tabs,
    TabPane,
    [Badge.name]: Badge,
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput,
    Modal
  },
  data(){
    return {
      alertModal : false,
      alertMsg : '',

      restaurantId : '',
      storeName : '',
      category : '',
      telephone : '',
      address : '',
      roadaddress : '',
      reviewCnt : '',
      bookmarkCnt : '',
      score : '',
      reviewData : [],
      editReviewReqCnt : 0
    }
  },
  mounted() {
    this.restaurantId = this.$route.params.id;
    let vm = this;
    axios.get('/api/restaurantDetail.php?restaurantId=' + this.restaurantId)
            .then(function(response){
              console.log(response);
              if(response.data.code == '1') {

                vm.storeName = response.data.storeName;
                vm.category = response.data.category;
                vm.telephone = response.data.telephone;
                vm.address = response.data.address;
                vm.roadaddress = response.data.roadaddress;
                vm.reviewCnt = response.data.reviewCnt;
                vm.bookmarkCnt = response.data.bookmarkCnt;
                vm.score = response.data.score;

                for(let i = 0; i < response.data.reviewData.length; i++){
                  let avatarURL = response.data.reviewData[i].avatar;
                  if(avatarURL == null || avatarURL == ''){
                    avatarURL = "img/avatar/1.png";
                  }
                  else{
                    avatarURL = "img/avatar/" + avatarURL + ".png";
                  }

                    vm.reviewData.push({
                      userId: response.data.reviewData[i].userId,
                      storeId: response.data.reviewData[i].storeId,
                      rating: response.data.reviewData[i].rating,
                      review: response.data.reviewData[i].review,
                      visitYn: response.data.reviewData[i].visitYn,
                      taglist: response.data.reviewData[i].taglist,
                      created: response.data.reviewData[i].created,
                      avatar: avatarURL
                    })

                }

              }
              else{
                vm.alertMsg = '식당정보를 가져오는데 실패였습니다..';
                vm.alertModal = true;
              }
            });
  },
  methods:{
    goUserDetail(id){
      let vm = this;

      location.href="#";
      location.href="/#/profile/" + id;
      this.userId = id;
      axios.get('/api/profile.php?userId=' + id)
              .then(function(response){
                console.log(response);

                if(response.data.code == '1' || response.data.code == '2') {//1:나의프로필 2:남의프로필

                  vm.friendship = response.data.friendship;
                  vm.following = response.data.following;
                  vm.follower = response.data.follower;

                }
                else{
                  vm.alertMsg = '유저정보를 가져오는데 실패였습니다..';
                  vm.alertModal = true;
                }
              });
    },
    goEditReview(storeId){
      let reviewObj = {
        storeId : storeId,
        rating : '5',
        tagList : '',
        review : '',
        visitYn: 'Y'
      };
      var vm = this;
      this.editReviewReq =  setInterval(function() {
        BUS.$emit('editReview', reviewObj);
        console.log("리뷰를 수정하기위한 요청을 보냅니다");
        vm.editReviewReqCnt++;
        if(vm.editReviewReqCnt > 30){
          clearInterval(vm.editReviewReq);
          vm.editReviewReqCnt = 0;
        }
      }, 100);

      location.href="/#/EditReview";
    },
    setBookmark(store_id){
      var res = confirm("여기를 찜하기로 기록 할까요?");
      if(res){
        let vm = this;

        //전송부분 구현...
        let form = new FormData();
        form.append('storeId', store_id);
        form.append('rating', '0');
        form.append('review','');
        form.append('visitYn','N');
        form.append('tags','');
        form.append('delYn',"N");


        axios.post('/api/saveReview.php', form)
                .then(function(response){
                  console.log(response);
                  if(response.data.result == 'success'){
                    if(response.data.code == '1'){
                      vm.alertMsg = '찜했어요!';
                      vm.alertModal = true;
                    }
                    else if(response.data.code == '100'){
                      vm.alertMsg = '이미 찜한 맛집 입니다.';
                      vm.alertModal = true;
                    }
                    else if(response.data.code == '101'){
                      vm.alertMsg = '이미 리뷰한 맛집 입니다.';
                      vm.alertModal = true;
                    }
                    else if(response.data.code == '102'){
                      vm.alertMsg = '나의 맛집이 등록되었습니다!';
                      vm.alertModal = true;
                    }
                    else if(response.data.code == '103'){
                      vm.alertMsg = '리뷰를 업데이트 했습니다';
                      vm.alertModal = true;
                    }
                    else{
                      vm.alertMsg = '서버에 뭔가 문제가 있는 것 같습니다.. 관리자에게 문의하세요';
                      vm.alertModal = true;
                    }
                  }
                  else {
                    vm.alertMsg = '에러가 발생하였습니다. 관리자에게 문의하세요';
                    vm.alertModal = true;
                  }

                });
      }
    }
  }

};
</script>
<style></style>
