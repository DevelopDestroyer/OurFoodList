<template>
  <div>
    <div class="page-header clear-filter" filter-color="orange">
      <parallax
        class="page-header-image"
        style="background-image:url('img/bg6.jpg')"
      >
      </parallax>
      <div class="container">

        <h1 class="title">친구들리뷰/소식</h1>
        <p class="category">친구/다른사람의 리뷰와 그맛 새소식을 확인할 수 있습니다.</p>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <tabs type="primary">
          <tab-pane label="내 친구의 최근 리뷰">

            <table style="margin-left:15px;">
              <tr>
                <td style="width:200px;">
                  <fg-input
                      v-model="friendID"
                      class="no-border input-lg"
                      addon-left-icon="now-ui-icons users_circle-08"
                      placeholder="친구검색하기"
                      maxlength="20"
                      length="20"
                  >
                  </fg-input>
                </td>
                <td>
                  <n-button v-on:click="searchFriend()" style="margin-top:-8px;" type="primary" icon round>
                    <i class="fa fa-search"></i>
                  </n-button>
                </td>
              </tr>
            </table>



            <card v-if="friendsReviewData.length == 0" style="width: 100%;">
            <ul slot="raw-content" class="list-group list-group-flush">
              <li class="list-group-item">
                <p style="font-size:24px;">
                  친구의 리뷰가 없습니다. :(
                </p>
              </li>
            </ul>
          </card>


          <div class="card" style="width: 100%;"  v-for="item in friendsReviewData" v-bind:key="item.id">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                <p style="font-size: 24px;">
                  <img :src=item.avatar width="50px" style="border-radius: 25px">
                  {{item.userId}}
                  <n-button type="primary" icon round v-on:click="goUserDetail(item.userId)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>

                </p>
                <p style="font-size: 24px;">
                  <i class="fa fa-flag"></i>
                  {{item.storeName}}
                  <n-button type="primary" icon round v-on:click="goRestaurantDetail(item.storeId)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>

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
          </tab-pane>

          <tab-pane label="모든이들의 최근 리뷰">
            <table style="margin-left:15px;">
              <tr>
                <td style="width:200px;">
                  <fg-input
                      v-model="friendID"
                      class="no-border input-lg"
                      addon-left-icon="now-ui-icons users_circle-08"
                      placeholder="친구검색하기"
                      maxlength="20"
                      length="20"
                  >
                  </fg-input>
                </td>
                <td>
                  <n-button v-on:click="searchFriend()" style="margin-top:-8px;" type="primary" icon round>
                    <i class="fa fa-search"></i>
                  </n-button>
                </td>
              </tr>
            </table>

            <card v-if="reviewData.length == 0" style="width: 100%;">
              <ul slot="raw-content" class="list-group list-group-flush">
                <li class="list-group-item">
                  <p style="font-size:24px;">
                    리뷰가 없습니다. :(
                  </p>
                </li>
              </ul>
            </card>

            <div class="card" style="width: 100%;"  v-for="item in reviewData" v-bind:key="item.id">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <p style="font-size: 24px;">
                    <img :src=item.avatar width="50px" style="border-radius: 25px">
                    {{item.userId}}
                    <n-button type="primary" icon round v-on:click="goUserDetail(item.userId)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>

                  </p>
                  <p style="font-size: 24px;">
                    <i class="fa fa-flag"></i>
                    {{item.storeName}}
                    <n-button type="primary" icon round v-on:click="goRestaurantDetail(item.storeId)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>

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
          </tab-pane>

          <tab-pane label="공지/이벤트">

            <div class="card" style="width: 100%;">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <p style="font-size: 24px;">
                    <img src="/img/avatar/10001.png" width="50px" style="border-radius: 25px">
                    짬뽕in
                    <n-button type="primary" icon round v-on:click="goUserDetail('짬뽕in')"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>

                  </p>
                  <p style="font-size: 24px;">
                    <i class="fa fa-flag"></i>
                    짬뽕in 이벤트 계정 출시 안내
                  </p>
                  <i class="fa fa-clock"></i> 날짜 : 2021-05-27
                  <br/>
                  <br/>
                  <!--div style="padding: 5px; background-color: #CC99FF; color: rgb(255, 255, 255);"-->
                    안녕하세요 그맛 입니다.<br/>
                    '배방읍보안관' 회원님의 건의로 짬뽕in 이벤트 계정을 생성하였습니다.<br/>
                    짬뽕in 계정에는 짬뽕을 사랑하는 모든 이들을 위해 짬뽕스토리 카페의 짬뽕여지도를 기반으로<br/>
                    전국의 내노라하는 모든 짬뽕맛집을 기록해두었습니다.<br/>
                    짬뽕맛집에 관심이 있으신 분들이라면 팔로우해두고 요긴하게 사용해보세요 ! <br/>
                    <br/>
                    또한 '배방읍보안관' 회원님께서 짬뽕길드원을 모집함에 따라 모집공고를 하단에 첨부해드리며,<br/>
                    자세한 문의는 '배방읍보안관' 회원님께 부탁드립니다.<br/>
                    감사합니다 ! <br/>
                    <br/>
                    <br/>
                    ----------------------------------<br/>
                    <b>제1기 짬뽕in 멤버를 찾습니다.</b><br/>
                    <br/>
                    [모집 조건]<br/>
                    - 밀가루(면) 음식을 좋아하는 사람<br/>
                    - 법적으로 문제가 없는 사람<br/>
                    - 긍정적인 사고와 적극적인 태도로 상업적 목적이 아닌 본인 입맛에 솔직한 사람<br/>
                    <br/>
                    [모임 활동]<br/>
                    - 해당 지도를 토대로 맛집 체험 및 재평가<br/>
                    - 연 1회 짬뽕 투어 예정<br/>
                    <br/>
                    <br/>
                    문의처 : 배방읍보안관 그맛 회원님<br/>
                    ----------------------------------<br/>
                  <!--/div-->
                  <br/>
                  <br/>
                </li>
              </ul>
            </div>

            <div class="card" style="width: 100%;">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <p style="font-size: 24px;">
                    <img src="/img/avatar/3.png" width="50px" style="border-radius: 25px">
                    그맛
                    <n-button type="primary" icon round v-on:click="goUserDetail('그맛')"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>

                  </p>
                  <p style="font-size: 24px;">
                    <i class="fa fa-flag"></i>
                    그맛 안드로이드 앱 출시
                  </p>
                  <i class="fa fa-clock"></i> 날짜 : 2021-03-15
                  <br/>
                  <br/>
                  안녕하세요 그맛 입니다.<br/>
                  그맛이 사용성 증대를 위해 안드로이드앱으로 출시하였습니다. <br/>
                  안드로이드 플레이스토어에서 그맛을 검색해보세요 !<br/>
                  <br/>
                  <a href="https://play.google.com/store/apps/details?id=com.th.geumat">[바로가기 클릭]</a><br/>
                  <br/>
                  감사합니다 ! <br/>
                </li>
              </ul>
            </div>

          </tab-pane>

        </tabs>

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
import { Tabs, TabPane , Badge, Button, FormGroupInput, Modal} from '@/components';
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
      alertMsg : '',
      alertModal : false,
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
      friendsReviewData : [],
      editReviewReqCnt : 0,
      friendID: ''
    }
  },
  mounted() {
    this.restaurantId = this.$route.params.id;
    let vm = this;
    axios.get('/api/newsfeed.php')
            .then(function(response){
              console.log(response);
              if(response.data.code == '1') {
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
                      storeName: response.data.reviewData[i].storeName,
                      avatar: avatarURL
                    })

                }

                for(let i = 0; i < response.data.friendsReviewData.length; i++){
                  let avatarURL = response.data.friendsReviewData[i].avatar;
                  if(avatarURL == null || avatarURL == ''){
                    avatarURL = "img/avatar/1.png";
                  }
                  else{
                    avatarURL = "img/avatar/" + avatarURL + ".png";
                  }

                  vm.friendsReviewData.push({
                    userId: response.data.friendsReviewData[i].userId,
                    storeId: response.data.friendsReviewData[i].storeId,
                    rating: response.data.friendsReviewData[i].rating,
                    review: response.data.friendsReviewData[i].review,
                    visitYn: response.data.friendsReviewData[i].visitYn,
                    taglist: response.data.friendsReviewData[i].taglist,
                    created: response.data.friendsReviewData[i].created,
                    storeName: response.data.friendsReviewData[i].storeName,
                    avatar: avatarURL
                  })

                }


              }
              else{
                vm.alertMsg = '식당정보를 가져오는데 실패하였습니다..';
                vm.alertModal = true;
              }
            });
  },
  methods:{
    goUserDetail(id){
      let vm = this;

      location.href="/#/profile/" + id;
    },
    goRestaurantDetail(id){
      location.href = "/#/restaurant/" + id;

    },
    searchFriend(){
      let vm = this;
      if(this.friendID == ''){
        vm.alertMsg = '친구의 아이디를 입력해주세요';
        vm.alertModal = true;

        return;
      }
      axios.get('/api/friendCheck.php?friendId=' + this.friendID)
          .then(function(response){
            console.log(response);
            if(response.data.code == '1') {
              vm.goUserDetail(vm.friendID);
            }
            else{
              vm.alertMsg = '읭? 존재하지 않는 사용자입니다.';
              vm.alertModal = true;
            }
          });
    }
  }

};
</script>
<style></style>
