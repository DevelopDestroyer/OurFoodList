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
          <a href="#button" class="btn btn-primary btn-round btn-lg">리뷰하기</a>
          <a href="#button" class="btn btn-default btn-round btn-lg">찜하기</a>
        </div>
        <h3 class="title">리뷰</h3>


        <div class="card" style="width: 100%;"  v-for="item in reviewData" v-bind:key="item.id">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <p style="font-size: 24px;">
                <img :src=item.avatar width="50px" style="border-radius: 25px">
                {{item.userId}}
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
              <span style="padding: 5px; background-color: rgb(228, 96, 109); color: rgb(255, 255, 255);">
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
              </badge>
            </li>
          </ul>
        </div>



        <div class="card" style="width: 100%;">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">
              <p style="font-size: 24px;">
                <img src="img/avatar/8.png" width="50px" style="border-radius: 25px">
                배방읍보안관
              </p>
              <i class="fa fa-clock"></i> 날짜 : 2020-04-04
              <br/>　
              <i class="fa fa-star-o"></i> 별점 :
              <img src="img/marker/star.png" height="20px"><img src="img/marker/star.png" height="20px"><img src="img/marker/star.png" height="20px"><img src="img/marker/star.png" height="20px"><img src="img/marker/star.png" height="20px">
              <br/>
              <br/>
              <span style="padding: 5px; background-color: rgb(228, 96, 109); color: rgb(255, 255, 255);">
                진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!진짜 맛있음 !!!
              </span>
              <br/>
              <br/>
              <span class="badge badge-warning">
                # 분위기
			  </span>
              <span class="badge badge-warning">
			    # 배달맛집
			  </span>
              <span class="badge badge-warning">
                # 가성비
              </span>
            </li>
          </ul>
        </div>





      </div>
    </div>
  </div>
</template>
<script>
import { Tabs, TabPane , Badge} from '@/components';
const axios = require('axios');

export default {
  name: 'profile',
  bodyClass: 'profile-page',
  components: {
    Tabs,
    TabPane,
    [Badge.name]: Badge
  },
  data(){
    return {
      restaurantId : '',
      storeName : '도안',
      category : '음식점 > 카페',
      telephone : '070-8884-1204',
      address : '경기 수원시 팔달구 인계동 1118-7',
      roadaddress : '경기 수원시 팔달구 효원로307번길 61',
      reviewCnt : '3',
      bookmarkCnt : '12',
      score : '4.4499999',
      reviewData : [
        {
          userId :"테스트3",
          storeId:"1574833588",
          rating:"4.5",
          review:"공하기 조아여55",
          visitYn:"Y",
          taglist:"1,2,3",
          created:"2020-03-16 14:57:15",
          avatar : "img/avatar/1.png"
        }

      ]
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
                    vm.reviewData.push({
                      userId: response.data.reviewData[i].userId,
                      storeId: response.data.reviewData[i].storeId,
                      rating: response.data.reviewData[i].rating,
                      review: response.data.reviewData[i].review,
                      visitYn: response.data.reviewData[i].visitYn,
                      taglist: response.data.reviewData[i].taglist,
                      created: response.data.reviewData[i].created,
                      avatar: "img/avatar/" + response.data.reviewData[i].avatar + ".png"
                    })

                }

              }
              else{
                alert("식당 정보를 가져오는데 실패하였습니다..");
              }
            });
  }
};
</script>
<style></style>
