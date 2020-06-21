<template>
  <div>
    <div class="page-header clear-filter" filter-color="orange">
      <parallax
        class="page-header-image"
        style="background-image:url('img/bg6.jpg')"
      >
      </parallax>
      <div class="container">

        <h1 class="title">친구들리뷰</h1>
        <p class="category">친구 및 다른사람의 리뷰를 확인할 수 있습니다.</p>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <tabs type="primary">
          <tab-pane label="내 친구의 최근 리뷰">
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
        </tabs>

      </div>
    </div>
  </div>
</template>
<script>
import { Tabs, TabPane , Badge, Button, FormGroupInput} from '@/components';
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
    [FormGroupInput.name]: FormGroupInput
  },
  data(){
    return {
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
      editReviewReqCnt : 0
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
                alert("식당 정보를 가져오는데 실패하였습니다..");
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

    }
  }

};
</script>
<style></style>
