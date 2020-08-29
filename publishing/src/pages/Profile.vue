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
          <img :src='"img/avatar/"+ userAvatar +".png"' alt=""/>
        </div>
        <h3 class="title">{{userId}}</h3>
        <p class="category">Lv. {{userLevel}}</p>
        <div class="content">
          <div class="social-description">
            <h2>{{reviewData.length}}</h2>
            <p>리뷰</p>
          </div>
          <div class="social-description">
            <h2>{{bookmarkData.length}}</h2>
            <p>찜</p>
          </div>

          <div class="social-description">
            <h2>{{following.length}}</h2>
            <p>팔로잉</p>
          </div>
          <div class="social-description">
            <h2>{{follower.length}}</h2>
            <p>팔로워</p>
          </div>
        </div>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="button-container">
          <template v-if="(friendship == 0 || friendship == 2) && code == 2">
            <a @click="followReq()" class="btn btn-primary btn-round btn-lg" style="color:white">팔로우</a>
          </template>
          <template v-if="(friendship == 1 || friendship >= 3) && code == 2">
            <a @click="unfollowReq()" class="btn btn-primary btn-round btn-lg" style="color:white">언팔하기</a>
          </template>
          <template v-if="code == 2">
            <a @click="goUserDetail('_my')" class="btn btn-default btn-round btn-lg" style="color:white">내 정보</a>
          </template>

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
            <tab-pane title="Visit" style="margin-bottom:20px;">
              <div slot="label">
                <i class="now-ui-icons ui-2_chat-round"></i>방명록
              </div>
              <div class="col-md-10 ml-auto mr-auto">
                <div class="row collections">
                  <div class="col-md-12">
                    <div slot="label">
                      <h5>
                        방명록
                        <br/>
                        <n-button v-on:click="setGuestbookModal(1, null,null, 'guestbook')" type="info" @click.native="modals.notice=true">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="10" y1="3" x2="13" y2="6" data-cap="butt" data-color="color-2"></line> <line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="2" y1="11" x2="5" y2="14" data-cap="butt" data-color="color-2"></line> <polygon fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="12,1 15,4 5,14 1,15 2,11 " data-cap="butt"></polygon> </g></svg>
                          방명록 쓰기
                        </n-button>

                      </h5>
                    </div>
                    <div class="card" style="width: 100%;"
                         v-for="item in guestbook" v-bind:key="item.index"
                         v-if="item.refGuestbookSeq == 0" >
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                          <p style="font-size: 24px;">
                            <img :src='"img/avatar/"+item.avatar+".png"' width="50px" style="border-radius: 25px">
                            {{item.fromUserId}}
                            <badge type="warning">
                              Lv. {{item.level}}
                            </badge>
                            　<n-button type="primary" icon round v-on:click="goUserDetail(item.fromUserId)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>
                          </p>
                          <i class="fa fa-clock-o">{{item.created}}</i>
                          <br/>
                          <template v-if="item.contents != null && item.contents != ''">
                            <template v-if="item.secretYn == 'N'">
                              <span style="padding:5px; background-color: #e4606d; color:#fff;">{{item.contents}}</span>
                            </template>
                            <template v-else >
                              <template v-if="item.fromUserId == myId || code == 1">
                                <i>[비밀글]</i> {{item.contents}}
                              </template>
                              <template else>
                                비밀글 입니다.
                              </template>
                            </template>

                            <br/>
                          </template>
                          <hr>


                          <span
                                  v-for="itemSub in guestbook.slice().reverse()" v-bind:key="itemSub.index"
                                  v-if="itemSub.refGuestbookSeq == item.guestbookSeq">
                            <a v-on:click="goUserDetail(itemSub.fromUserId)">{{itemSub.fromUserId}}</a> :
                            <template v-if="itemSub.secretYn == 'N'">
                             {{itemSub.contents}}
                            </template>
                            <template v-else >
                              <template v-if="itemSub.fromUserId == myId || code == 1">
                                <i>[비밀글]</i> {{itemSub.contents}}
                              </template>
                              <template else>
                                 비밀글 입니다.
                              </template>
                            </template>
                            <a style="color:gray">({{itemSub.created}})</a>
                            <n-button size="sm" type="info" v-if="myId == itemSub.fromUserId && itemSub.delYn == 'N'" v-on:click="setGuestbookModal(2, itemSub.guestbookSeq, itemSub.refGuestbookSeq, itemSub)"  @click.native="modals.notice=true">수정</n-button>
                             <n-button size="sm" type="info" v-if="myId == itemSub.fromUserId && itemSub.delYn == 'N'" v-on:click="setGuestbookModal(3, itemSub.guestbookSeq, itemSub.refGuestbookSeq, itemSub)">삭제</n-button>
                            <hr>
                          </span>
                          <n-button v-if="item.delYn == 'N'" v-on:click="setGuestbookModal(1, null, item.guestbookSeq, 'reply')" type="info" @click.native="modals.notice=true">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="10" y1="3" x2="13" y2="6" data-cap="butt" data-color="color-2"></line> <line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="2" y1="11" x2="5" y2="14" data-cap="butt" data-color="color-2"></line> <polygon fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="12,1 15,4 5,14 1,15 2,11 " data-cap="butt"></polygon> </g></svg>
                            댓글쓰기
                          </n-button>
                          <n-button v-if="myId == item.fromUserId && item.delYn == 'N'" v-on:click="setGuestbookModal(2, item.guestbookSeq, null, item)" type="info" @click.native="modals.notice=true">
                            수정
                          </n-button>
                          <n-button v-if="(myId == item.fromUserId || code == 1)  && item.delYn == 'N'" v-on:click="setGuestbookModal(3, item.guestbookSeq, null, item)" type="info">
                            삭제
                          </n-button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </tab-pane>

            <tab-pane title="Review" style="margin-bottom:20px;">
              <div slot="label">
                <i class="now-ui-icons location_bookmark"></i>리뷰/찜
              </div>
              <div class="row">
                <div class="col-md-12 ml-auto mr-auto">
                  <h4 class="title text-center">리뷰</h4>
                  <!-- <div class="card" style="width: 100%;"  v-for="item in friendsReviewData" v-bind:key="item.id">  -->
                  <div class="card" style="width: 100%;"  v-for="item in reviewData" v-bind:key="item.id">
                <!--card v-for="item in reviewData" v-bind:key="item.id" style="width: 100%;"-->
                  <ul slot="raw-content" class="list-group list-group-flush">
                    <li class="list-group-item">
                      <p style="font-size:24px;"><a v-on:click="goRestaurantDetail(item.store_id)">{{item.store_name}}</a>
                        <n-button type="primary" icon round v-on:click="goRestaurantDetail(item.store_id)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>
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
                <!--/card-->
                  </div>


                  <h4 class="title text-center">찜</h4>

                  <div class="card" style="width: 100%;"  v-for="item in bookmarkData" v-bind:key="item.id">
                <!--card v-for="item in bookmarkData" v-bind:key="item.id" style="width: 100%;"-->
                  <ul slot="raw-content" class="list-group list-group-flush">
                    <li class="list-group-item">
                      <p style="font-size:24px;"><a v-on:click="goRestaurantDetail(item.store_id)">{{item.store_name}}</a>
                        <n-button type="primary" icon round v-on:click="goRestaurantDetail(item.store_id)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>
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
                <!--/card-->
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
                  <div class="col-md-12">
                    <div slot="label">
                      <h5>팔로잉</h5>
                    </div>
                    <div class="card" style="width: 100%;"  v-for="item in following" v-bind:key="item.id">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                          <p style="font-size: 24px;">
                            <img :src='"img/avatar/"+item.avatar+".png"' width="50px" style="border-radius: 25px">
                            {{item.id}}
                            <badge type="warning">
                              Lv. {{item.level}}
                            </badge>
                            　<n-button type="primary" icon round v-on:click="goUserDetail(item.id)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>
                          </p>
                        </li>
                      </ul>
                    </div>
                    <div slot="label">
                      <h5>팔로워</h5>
                    </div>
                    <div class="card" style="width: 100%;"  v-for="item in follower" v-bind:key="item.id">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                          <p style="font-size: 24px;">
                            <img :src='"img/avatar/"+item.avatar+".png"' width="50px" style="border-radius: 25px">
                            {{item.id}}
                            <badge type="warning">
                              Lv. {{item.level}}
                            </badge>
                            　<n-button type="primary" icon round v-on:click="goUserDetail(item.id)"><i class="now-ui-icons ui-1_zoom-bold"></i></n-button>
                          </p>
                        </li>
                      </ul>
                    </div>
                  </div>-
                </div>
              </div>
            </tab-pane>



            <!--
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
            -->

          </tabs>


            <modal :show.sync="modals.notice"
                   footer-classes="justify-content-center"
                   type="notice" style="color:gray;margin-top:80px;">
              <br><br>

              <h5 slot="header" class="modal-title">{{modals.title}}</h5>
              <div class="row" style="padding-left: 20px">
                  <fg-input placeholder="입력해주세요" style="width:280px;" v-model="gbContents"></fg-input>
              </div>
              　　　　<label for="check4" class="form-check-label">
                　　<input id="check4" type="checkbox" class="form-check-input" true-value="Y" false-value="N" v-model="gbSecret" />
                <span class="form-check-sign"></span>
                비밀 남기기　
              </label>
              <div slot="footer" class="justify-content-center">
                <n-button type="info" round @click.native="modals.notice = false" v-on:click="reqGuestbook()">등록</n-button>
              </div>

            </modal>


          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { Tabs, TabPane, Badge, Button, FormGroupInput, Modal} from '@/components';
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
  data() {
    return {
      code: 2, //1 내프로필, 2 남의프로필
      myId: '',

      userId: '',
      userLevel: '',
      userAvatar: '',

      //reviewCnt: '',
      //bookmarkCnt: '',

      friendship: '', //0아무관계아님, 1내가 친구, 2상대가 친추, 3맞팔
      following: [],
      follower: [],

      reviewData: [],
      bookmarkData: [],

      guestbook: [],
      modals: {
        notice: false,
        title : ''
      },
      gbContents : '',
      gbMode : 1,
      gbSecret : 'N',
      gbRefId : null,
      gbId : null,
      gbEditTargetItem: null
    }
  },
  mounted() {
    let vm = this;
    this.userId = this.$route.params.id;

    if(this.$route.params.id != '_my'){
      //this.userId = localStorage.getItem('gmatUserId');
    }
    else{
    }

    axios.get('/api/profile.php?userId=' + this.userId)
            .then(function(response){
              console.log(response);

              if(response.data.code == '1' || response.data.code == '2') {//1:나의프로필 2:남의프로필

                vm.code = response.data.code;
                vm.myId = response.data.myId;
                vm.userId = response.data.userId;
                vm.userLevel = response.data.userLevel;
                vm.userAvatar = response.data.userAvatar;
                vm.friendship = response.data.friendship;
                vm.following = response.data.following;
                vm.follower = response.data.follower;

                vm.reviewData = response.data.reviewData;
                vm.bookmarkData = response.data.bookmarkData;

                vm.guestbook = response.data.guestbook;
              }
              else{
                alert("유저 정보를 가져오는데 실패하였습니다..");
              }
            });


  },
  methods :{
    followReq(){

      if(this.myId == '_tmpId' || this.myId == 'null' || this.myId == null){
        alert("로그인해야 이용할 수 있는 서비스 입니다.");
        return;
      }
      let vm = this;
      //전송부분 구현...
      let form = new FormData();
      form.append('friendId', this.userId);
      form.append('isFriendRequest', 'Y');

      axios.post('/api/friendRequest.php', form)
              .then(function(response){
                console.log(response);

                if(response.data.code == '1') {//1:나의프로필 2:남의프로필
                  vm.friendship = 1;
                  alert("팔로잉 하였습니다.");
                }
                else if (response.data.code == '-2'){
                  alert("로그인 상태가 아니면 이용 할 수 없는 기능 입니다.");
                }
                else if (response.data.code == '-4'){
                  alert("자신과 친구를 할 수 없습니다.");
                }
                else{
                  alert("오류가 발생하였습니다.");
                }
              });
    },
    unfollowReq(){
      if(this.myId == '_tmpId' || this.myId == 'null' || this.myId == null){
        alert("로그인해야 이용할 수 있는 서비스 입니다.");
        return;
      }

      let vm = this;
      //전송부분 구현...
      let form = new FormData();
      form.append('friendId', this.userId);
      form.append('isFriendRequest', 'N');

      axios.post('/api/friendRequest.php', form)
              .then(function(response){
                console.log(response);

                if(response.data.code == '2') {//1:나의프로필 2:남의프로필
                  vm.friendship = 0;
                  alert("언팔로잉 하였습니다.");
                }
                else if (response.data.code == '-2'){
                  alert("로그인 상태가 아니면 이용 할 수 없는 기능 입니다.");
                }
                else if (response.data.code == '-4'){
                  alert("자신과 언팔을 할 수 없습니다.");
                }
                else{
                  alert("오류가 발생하였습니다.");
                }
              });

    },
    goHome(){
      if(this.myId == '_tmpId' || this.myId == 'null' || this.myId == null){
        alert("로그인해야 이용할 수 있는 서비스 입니다.");
        return;
      }

      let vm = this;

      location.href="#";
      location.href="/#/profile/" + this.myId;
      this.userId = id;
      axios.get('/api/profile.php?userId=' + vm.myId)
              .then(function(response){
                console.log(response);

                if(response.data.code == '1' || response.data.code == '2') {//1:나의프로필 2:남의프로필

                  vm.code = response.data.code;
                  vm.myId = response.data.myId;
                  vm.userId = response.data.userId;
                  vm.userLevel = response.data.userLevel;
                  vm.userAvatar = response.data.userAvatar;
                  vm.friendship = response.data.friendship;
                  vm.following = response.data.following;
                  vm.follower = response.data.follower;
                  vm.reviewData = response.data.reviewData;
                  vm.bookmarkData = response.data.bookmarkData;

                  vm.guestbook = response.data.guestbook;

                }
                else{
                  alert("유저 정보를 가져오는데 실패하였습니다..");
                }
              });

    },
    goUserDetail(id){
      if(id == '_my' && (this.myId == '_tmpId' || this.myId == 'null' || this.myId == null)){
        alert("로그인해야 이용할 수 있는 서비스 입니다.");
        return;
      }
      let vm = this;

      location.href="#";
      location.href="/#/profile/" + id;
      this.userId = id;
      axios.get('/api/profile.php?userId=' + id)
              .then(function(response){
                console.log(response);

                if(response.data.code == '1' || response.data.code == '2') {//1:나의프로필 2:남의프로필
                  vm.code = response.data.code;
                  vm.myId = response.data.myId;
                  vm.userId = response.data.userId;
                  vm.userLevel = response.data.userLevel;
                  vm.userAvatar = response.data.userAvatar;
                  vm.friendship = response.data.friendship;
                  vm.following = response.data.following;
                  vm.follower = response.data.follower;

                  vm.reviewData = response.data.reviewData;
                  vm.bookmarkData = response.data.bookmarkData;

                  vm.guestbook = response.data.guestbook;

                }
                else{
                  alert("유저 정보를 가져오는데 실패하였습니다..");
                }
              });
    },
    goRestaurantDetail(id){
      location.href = "/#/restaurant/" + id;

    },
    setGuestbookModal(mode, gbid, refgbid, item){
      if(mode == 3){
        let confirm = window.confirm("정말 삭제하시겠습니까?");
        if(!confirm){
          return;
        }

        //초기화 및 세팅
        this.gbContents = '';
        this.gbMode = mode;
        this.gbSecret = false;
        this.gbRefId = '';
        this.gbId = gbid;
        this.gbEditTargetItem = item;

        this.reqGuestbook();
        return;
      }

      //초기화 및 세팅
      this.gbContents = '';
      this.gbMode = mode;
      this.gbSecret = false;
      this.gbRefId = refgbid;
      this.gbId = gbid;
      this.gbEditTargetItem = item;

      if(this.gbRefId == null || this.gbRefId == 0)
        this.gbRefId = '';
      if(this.gbId == null)
        this.gbId = '';

      if(mode == 1) {
        this.modals.title = '글작성';
      }
      else if(mode == 2) {
        this.gbContents = item.contents;
        this.gbSecret = item.secretYn == 'Y' ? 'Y' : 'N';
        this.modals.title = '글수정';
      }
    },
    reqGuestbook(){
      let vm = this;
      let updateItem = this.gbEditTargetItem;
      //전송부분 구현...
      let form = new FormData()

      if(this.gbSecret == 'true' || this.gbSecret == 'Y' || this.gbSecret == true)
        this.gbSecret = 'Y';
      if(this.gbSecret == 'false' || this.gbSecret == 'N' || this.gbSecret == false)
        this.gbSecret = 'N';

      form.append('guestbookSeq', this.gbId);
      form.append('refGuestbookSeq', this.gbRefId);
      form.append('toUserId', this.userId);
      form.append('fromUserId', this.myId);
      form.append('contents', this.gbContents);
      form.append('secretYn', this.gbSecret);
      form.append('order', this.gbMode);

      axios.post('/api/guestbook.php', form)
              .then(function(response){
                console.log(response);

                if(response.data.code == '1') {//1:나의프로필 2:남의프로필
                  alert("등록이 완료되었습니다.");
                  vm.guestbook.unshift(response.data.guestbook[0]);
                  if(updateItem == 'guestbook'){

                  }
                  else{

                  }
                }
                else if(response.data.code == '2') {//1:나의프로필 2:남의프로필
                  updateItem.contents = vm.gbContents;
                  updateItem.gbSecret = vm.gbSecret;
                  alert("수정이 완료되었습니다.");
                }
                else if(response.data.code == '3') {//1:나의프로필 2:남의프로필
                  updateItem.contents = "삭제 되었습니다.";
                  updateItem.delYn = "Y";
                  alert("삭제가 완료되었습니다.");
                }

                else if (response.data.code == '-2'){
                  alert("로그인 상태가 아니면 이용 할 수 없는 기능 입니다.");
                }
                else if (response.data.code == '-3'){
                  alert("권한이 없습니다.");
                }
                else{
                  alert("오류가 발생하였습니다.");
                }
              });
    }
  }

};
</script>
<style></style>
