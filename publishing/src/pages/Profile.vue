<template>
  <div>
    <div class="page-header clear-filter" filter-color="orange">
      <parallax
        class="page-header-image"
        style="background-image:url('img/bg5.jpg')"
      >
      </parallax>
      <div class="container">
        <div class="photo-container">
          <img src="img/avatar/8.png" alt=""/>
        </div>
        <h3 class="title">이거좀먹어봐</h3>
        <p class="category">개발자</p>
        <div class="content">
          <div class="social-description">
            <h2>26</h2>
            <p>리뷰</p>
          </div>
          <div class="social-description">
            <h2>126</h2>
            <p>찜</p>
          </div>

          <div class="social-description">
            <h2>35</h2>
            <p>팔로잉</p>
          </div>
          <div class="social-description">
            <h2>1023</h2>
            <p>팔로워</p>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="button-container">
          <a href="#button" class="btn btn-primary btn-round btn-lg">Follow</a>
          <a
            href="#button"
            class="btn btn-default btn-round btn-lg btn-icon"
            rel="tooltip"
            title="Follow me on Twitter"
          >
            <i class="fab fa-twitter"></i>
          </a>
          <a
            href="#button"
            class="btn btn-default btn-round btn-lg btn-icon"
            rel="tooltip"
            title="Follow me on Instagram"
          >
            <i class="fab fa-instagram"></i>
          </a>
        </div>
        <!--h3 class="title">About me</h3-->
        <!--div class="row">
          <tabs type="primary">
            <tab-pane label="리뷰">
              리뷰리스트가 들어갈 자리... 남일때만 보임
            </tab-pane>
            <tab-pane label="찜">
              찜리스트가 들어갈 자리... 남일때만 보임
            </tab-pane>
            <tab-pane label="방명록">
              방명록은<br>
              모두에게 보인다
            </tab-pane>
            <tab-pane label="친구들">
              <div class="row">
                친구들 리스트..<br>
                팔로잉/팔로워..
              </div>
            </tab-pane>
            <tab-pane label="계정관리">
              아바타설정<br>
              비번변경<br>
              탈퇴기능
            </tab-pane>
          </tabs>
        </div-->

        <h5 class="description">
          An artist of considerable range, Ryan — the name taken by
          Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and
          records all of his own music, giving it a warm, intimate feel with a
          solid groove structure. An artist of considerable range.
        </h5>
        <div class="row">
          <div class="col-md-12 ml-auto mr-auto">
            <h4 class="title text-center">프로필</h4>
          </div>
          <br/>

          <div class="col-md-12 ml-auto mr-auto">
          <tabs
            pills
            class="nav-align-center"
            tab-content-classes="gallery"
            tab-nav-classes="nav-pills-just-icons"
            type="primary"
          >
            <tab-pane title="Review" style="margin-bottom:20px;">
              <div slot="label">
                <i class="now-ui-icons location_bookmark"></i>리뷰/찜
              </div>

              <div class="row">
                <h5>이 사람의 리뷰</h5>
                <card v-for="item in reviewData" v-bind:key="item.id" style="width: 100%;">
                  <ul slot="raw-content" class="list-group list-group-flush">
                    <li class="list-group-item">
                      <p style="font-size:24px;"><a v-on:click="goRestaurantDetail(item.store_id)">{{item.store_name}}</a>
                        <n-button type="primary" icon round v-on:click="goEditReview(item.store_id, item.rating, item.taglist, item.review, 'Y')"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="10" y1="3" x2="13" y2="6" data-cap="butt" data-color="color-2"></line> <line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="2" y1="11" x2="5" y2="14" data-cap="butt" data-color="color-2"></line> <polygon fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="12,1 15,4 5,14 1,15 2,11 " data-cap="butt"></polygon> </g></svg></n-button>
                        <n-button type="primary" icon round v-on:click="goRestaurantDetail(item.store_id)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>
                        <n-button type="primary" icon round v-on:click="deleteReview(item.review_seq)"><i class="now-ui-icons ui-1_simple-remove"></i></n-button>
                      </p>
                      <i class="now-ui-icons location_pin"></i>{{item.roadaddress}}<br/>
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="none" stroke="#444444" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M12,10l-2,2L4,6l2-2 L3,1L1,3c0,6.627,5.373,12,12,12l2-2L12,10z" data-cap="butt"></path> </g></svg> {{item.telephone}}<br>
                      <i class="fa fa-star-o"></i> 내 별점　
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

                      <br>
                      <i class="fa fa-star-o"></i>  별점 평균
                      <template v-if="item.ratingav > 4.5 && item.ratingav <= 5">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 4 && item.ratingav <= 4.5">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star_half.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 3.5 && item.ratingav <= 4">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 3 && item.ratingav <= 3.5">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star_half.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 2.5 && item.ratingav <= 3">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 2 && item.ratingav <= 2.5">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star_half.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 1.5 && item.ratingav <= 2">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 1 && item.ratingav <= 1.5">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star_half.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 0.5 && item.ratingav <= 1">
                        <img src='img/marker/star.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else>
                        <img src='img/marker/star_half.png' height='20px'/> (아직 점수없음)
                      </template>

                      <br/>
                      <br/>
                      <template v-if="item.review != null && item.review != ''">
                        <span style="padding:5px; background-color: #e4606d; color:#fff;">{{item.review}}</span>
                        <br/>
                        <br/>
                      </template>
                      <badge type="primary">
                        <i class="now-ui-icons ui-2_favourite-28"></i>　리뷰/찜　{{item.cnt}}개
                      </badge>　　
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
                </card>
                <h5>이 사람의 찜</h5>
                <card v-for="item in myBookmarkData" v-bind:key="item.id" style="width: 100%;">
                  <ul slot="raw-content" class="list-group list-group-flush">
                    <li class="list-group-item">
                      <p style="font-size:24px;"><a v-on:click="goRestaurantDetail(item.store_id)">{{item.store_name}}</a>
                        <n-button type="primary" icon round v-on:click="goEditReview(item.store_id, item.rating, item.taglist, item.review, 'Y')"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="10" y1="3" x2="13" y2="6" data-cap="butt" data-color="color-2"></line> <line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="2" y1="11" x2="5" y2="14" data-cap="butt" data-color="color-2"></line> <polygon fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="12,1 15,4 5,14 1,15 2,11 " data-cap="butt"></polygon> </g></svg></n-button>
                        <n-button type="primary" icon round v-on:click="goRestaurantDetail(item.store_id)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>
                        <n-button type="primary" icon round v-on:click="deleteReview(item.review_seq)"><i class="now-ui-icons ui-1_simple-remove"></i></n-button>
                      </p>
                      <i class="now-ui-icons location_pin"></i>{{item.roadaddress}}<br/>
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="none" stroke="#444444" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M12,10l-2,2L4,6l2-2 L3,1L1,3c0,6.627,5.373,12,12,12l2-2L12,10z" data-cap="butt"></path> </g></svg> {{item.telephone}}<br>

                      <i class="fa fa-star-o"></i>  별점 평균
                      <template v-if="item.ratingav > 4.5 && item.ratingav <= 5">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 4 && item.ratingav <= 4.5">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star_half.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 3.5 && item.ratingav <= 4">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 3 && item.ratingav <= 3.5">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star_half.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 2.5 && item.ratingav <= 3">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 2 && item.ratingav <= 2.5">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star_half.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 1.5 && item.ratingav <= 2">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 1 && item.ratingav <= 1.5">
                        <img src='img/marker/star.png' height='20px'/>
                        <img src='img/marker/star_half.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else-if="item.ratingav > 0.5 && item.ratingav <= 1">
                        <img src='img/marker/star.png' height='20px'/>
                        ({{item.ratingav}} 점)
                      </template>
                      <template v-else>
                        <img src='img/marker/star_half.png' height='20px'/> (아직 점수없음)
                      </template>

                      <br/>
                      <br/>
                      <badge type="primary">
                        <i class="now-ui-icons ui-2_favourite-28"></i>　리뷰/찜　{{item.cnt}}개
                      </badge>　　
                    </li>
                  </ul>
                </card>
              </div>
            </tab-pane>

            <tab-pane title="Visit" style="margin-bottom:20px;">
              <div slot="label">
                <i class="now-ui-icons ui-2_chat-round"></i>방명록
              </div>

              <div class="col-md-10 ml-auto mr-auto">
                <div class="row collections">
                  <div class="col-md-6">
                    <img src="img/bg1.jpg" alt="" class="img-raised" />
                    <img src="img/bg3.jpg" alt="" class="img-raised" />
                  </div>
                  <div class="col-md-6">
                    <img src="img/bg8.jpg" alt="" class="img-raised" />
                    <img src="img/bg7.jpg" alt="" class="img-raised" />
                  </div>
                </div>
              </div>
            </tab-pane>

            <tab-pane title="Friends" style="margin-bottom:20px;">
              <div slot="label">
                <i class="now-ui-icons users_single-02"></i>친구들
              </div>

              <div class="col-md-10 ml-auto mr-auto">
                <div class="row collections">
                  <div class="col-md-6">
                    <img src="img/bg3.jpg" alt="" class="img-raised" />
                    <img src="img/bg8.jpg" alt="" class="img-raised" />
                  </div>
                  <div class="col-md-6">
                    <img src="img/bg7.jpg" alt="" class="img-raised" />
                    <img src="img/bg6.jpg" class="img-raised" />
                  </div>
                </div>
              </div>
            </tab-pane>

            <tab-pane title="Settings" style="margin-bottom:20px;">
              <div slot="label">
                <i class="now-ui-icons ui-1_settings-gear-63"></i>계정관리
              </div>

              <div class="col-md-10 ml-auto mr-auto">
                <div class="row collections">
                  <div class="col-md-6">
                    <img src="img/bg3.jpg" alt="" class="img-raised" />
                    <img src="img/bg8.jpg" alt="" class="img-raised" />
                  </div>
                  <div class="col-md-6">
                    <img src="img/bg7.jpg" alt="" class="img-raised" />
                    <img src="img/bg6.jpg" class="img-raised" />
                  </div>
                </div>
              </div>
            </tab-pane>

          </tabs>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { Tabs, TabPane, Badge } from '@/components';

export default {
  name: 'profile',
  bodyClass: 'profile-page',
  components: {
    Tabs,
    TabPane,
    [Badge.name]: Badge
  }
};
</script>
<style></style>
