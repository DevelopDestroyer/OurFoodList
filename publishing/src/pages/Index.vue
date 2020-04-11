<template>


  <div>
    <div class="page-header clear-filter" filter-color="orange">
      <parallax
        class="page-header-image"
      >
      </parallax>
	  <!--
        style="background-image:url('img/header.jpg')"-->
	  
	  <br><br><br><br>

		<div id="dmap" style="width:100%;height:100%;">
          <div id="map" style="width:100%;height:100%;"></div>
        </div>
		
		<transition name="slide-fade">
		  <a v-if="show" id="buttonBottomAllow" href="#gmatList" class="float"><!--  onclick="clickBottomAllow();" -->
		    <i class="fa fa-arrow-down my-float"></i>
          </a>
		</transition>
		<!--a id="buttonTopAllow" href="#" class="float" style="display:none" onclick="clickTopAllow();">
		  <i class="fa fa-arrow-up my-float"></i>
        </a-->		
		
      <div class="container">
        <div class="content-center brand">
    
		
		</div>
		
      </div>
    </div>

	<template>
    	<div id="gmatList" class="container">
		  <br>
		  <br>
		  <br>
		  <br>
			<tabs type="primary">
				<tab-pane label="내 맛집">
					<div class="row">
						<card v-for="item in myReviewData" v-bind:key="item.id" style="width: 100%;">
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
					</div>
				</tab-pane>
				<tab-pane label="내 찜하기">
					<div class="row">
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
				<tab-pane label="다른 맛집">
					<div class="row">
						<card v-for="item in othersReviewData" v-bind:key="item.id" style="width: 100%;">
							<ul slot="raw-content" class="list-group list-group-flush">
								<li class="list-group-item">
									<p style="font-size:24px;"><a v-on:click="goRestaurantDetail(item.store_id)">{{item.store_name}}</a>
										<n-button type="primary" icon round v-on:click="goEditReview(item.store_id, 0, '', '', 'Y')"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="10" y1="3" x2="13" y2="6" data-cap="butt" data-color="color-2"></line> <line fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" x1="2" y1="11" x2="5" y2="14" data-cap="butt" data-color="color-2"></line> <polygon fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" points="12,1 15,4 5,14 1,15 2,11 " data-cap="butt"></polygon> </g></svg></n-button>
										<n-button type="primary" icon round v-on:click="setBookmark(item)"><i class="now-ui-icons ui-2_favourite-28"></i></n-button>
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
						</card>
					</div>
				</tab-pane>
			</tabs>
		  <div class="row">
			  <button type="button" onclick="location.href='#'" class="btn btn-round btn-info" style="width: 100%;">올라가용!</button>

           </div>
          </div>		   
			 
	</template>
	<br>
	<br>
  </div>
</template>
<script>
import { Parallax } from '@/components';
import BasicElements from './components/BasicElementsSection';
import Navigation from './components/Navigation';
import TabsSection from './components/Tabs';
import ProgressPagination from './components/ProgressPagination';
import Notifications from './components/Notifications';
import Typography from './components/Typography';
import JavascriptComponents from './components/JavascriptComponents';
import CarouselSection from './components/CarouselSection';
import NucleoIconsSection from './components/NucleoIconsSection';
import SignupForm from './components/SignupForm';
import ExamplesSection from './components/ExamplesSection';
import DownloadSection from './components/DownloadSection';
import { Card, Tabs , TabPane, Badge, Button, Alert} from '@/components';
import { BUS } from './EventBus';
const axios = require('axios');


export default {
  name: 'index',
  bodyClass: 'index-page',
  components: {
    Parallax,
	Card,
	Tabs,
	TabPane,
	BasicElements,
	[Badge.name]: Badge,
	[Button.name]: Button,
	Alert,
	/*
    //BasicElements,
    //Navigation,
    //TabsSection,
    //ProgressPagination,
    //Notifications,
    //Typography,
    //JavascriptComponents,
    //CarouselSection,
    //NucleoIconsSection,
    */
	SignupForm,
    ExamplesSection,
    DownloadSection,
	BUS
	
  },
  data() {
    return {
      show: true,
		mapData: null,
		mapMarker: null,
		mapOverlay: null,
		shoeMeTheMap: false,

		myReviewData: [],
		myBookmarkData: [],
		othersReviewData: [],
		editReviewReq: null
	}
  },
  mounted() {
      var container = document.getElementById('map');
        var mapOptions = {
            center: new kakao.maps.LatLng(37.4011778,127.1112022),
            level: 12 //지도의 레벨(확대, 축소 정도)
        };
        this.mapData = new kakao.maps.Map(container, mapOptions);

	  let vm = this;
	  BUS.$on('sessionState',function(data){
		  console.log("메인네브바에서 보낸 메시지 : " + data); //abc
		  BUS.$emit('startDrawMaker', 1);
		  if(vm.shoeMeTheMap) {
		  	console.log("이미 그리기 시작했으니 더이상 마커그리기 요청은 무시합니다");
			  return;
		  }
		  //vm.shoeMeTheMap = true;
		  axios.get('/api/gmatList.php')
				  .then(function(response){
					  console.log(response);
					  if(response.data.code == '1') {

						  /*
					  			myReviewData: [],
								myBookmarkData: [],
								othersReviewData: []
					  	 */
						  vm.myReviewData = [];
						  vm.myBookmarkData = [];
						  vm.othersReviewData = [];
						  for(let i = 0; i < response.data.mydata.length; i++){
							  if(response.data.mydata[i].visit_yn == 'Y'){//나의 리뷰
								  vm.myReviewData.push({
									  store_id: response.data.mydata[i].store_id,
									  store_name: response.data.mydata[i].store_name,
									  category: response.data.mydata[i].category,
									  telephone: response.data.mydata[i].telephone,
									  address: response.data.mydata[i].address,
									  roadaddress: response.data.mydata[i].roadaddress,
									  lon: response.data.mydata[i].lon,
									  //mapx: out_pt.x,
									  //mapy: out_pt.y,
									  lat: response.data.mydata[i].lat,
									  cnt: response.data.mydata[i].cnt,
									  ratingav: Number.parseFloat(response.data.mydata[i].ratingav).toFixed(2),
									  review_seq: response.data.mydata[i].review_seq,
									  rating: response.data.mydata[i].rating,
									  review: response.data.mydata[i].review,
									  visit_yn: response.data.mydata[i].visit_yn,
									  taglist: response.data.mydata[i].taglist
								  })
							  }

							  else{//나의 북마크
								  vm.myBookmarkData.push({
									  store_id: response.data.mydata[i].store_id,
									  store_name: response.data.mydata[i].store_name,
									  category: response.data.mydata[i].category,
									  telephone: response.data.mydata[i].telephone,
									  address: response.data.mydata[i].address,
									  roadaddress: response.data.mydata[i].roadaddress,
									  lon: response.data.mydata[i].lon,
									  //mapx: out_pt.x,
									  //mapy: out_pt.y,
									  lat: response.data.mydata[i].lat,
									  cnt: response.data.mydata[i].cnt,
									  ratingav: Number.parseFloat(response.data.mydata[i].ratingav).toFixed(2),
									  review_seq: response.data.mydata[i].review_seq,
									  rating: response.data.mydata[i].rating,
									  review: response.data.mydata[i].review,
									  visit_yn: response.data.mydata[i].visit_yn,
									  taglist: response.data.mydata[i].taglist
								  })
							  }

						  }
						  for(let i = 0; i < response.data.othersdata.length; i++){
							  vm.othersReviewData.push({
								  store_id: response.data.othersdata[i].store_id,
								  store_name: response.data.othersdata[i].store_name,
								  category: response.data.othersdata[i].category,
								  telephone: response.data.othersdata[i].telephone,
								  address: response.data.othersdata[i].address,
								  roadaddress: response.data.othersdata[i].roadaddress,
								  review_seq: response.data.othersdata[i].review_seq,
								  lon: response.data.othersdata[i].lon,
								  lat: response.data.othersdata[i].lat,
								  cnt: response.data.othersdata[i].cnt,
								  ratingav: Number.parseFloat(response.data.othersdata[i].ratingav).toFixed(2)
							  })
						  }

						  vm.makeMarkerOthersReview();
						  vm.makeMarkerMyBookmark();
						  vm.makeMarkerMyReview();

						  console.log("마커를 다 그렸습니다.");

					  }
					  else{
						  alert("맛집 리스트를 가져오는데 실패했습니다.. 서버 문제 같습니다..");
					  }
				  });
	  });

	  BUS.$on('startEditReview',function(data){
		  //this.showMeTheMap = true;
		  console.log("에딧리뷰를 쓴다하니 멈춥시다");
		  clearInterval(vm.editReviewReq);//지도 컴포넌트에서 그리겠다는 응답이 오면 요청 멈춰라
	  })
  },
  methods : {
	  goRestaurantDetail(id){
	  	location.href = "/#/restaurant/" + id;

	  },
    handleScroll (event){
	  if(this.show && 95 >= document.getElementById("gmatList").getBoundingClientRect().top){
		this.show = false;
		}
	  else if (!this.show && 110 < document.getElementById("gmatList").getBoundingClientRect().top){
		this.show = true;
	  }
	},
	  deleteReview(revSeq){
    	let con = confirm("정말 삭제하시겠습니까?");
    	if(con){
    		let con2 = confirm("지우면 복구가 어렵습니다.. 그래도 진짜 지우실건가요?");
    		if(con2){
				let vm = this;
				let form = new FormData();
				let reviewSeqBuf = revSeq;
				form.append('reviewSeq',revSeq);
				axios.post('/api/deleteReview.php', form)
						.then(function(response){
							console.log(response);
							if(response.data.result == 'success'){
								if(response.data.code == '1'){
									alert("삭제처리 되었습니다.");

									//뷰단에서도 제거
									const idx = vm.myBookmarkData.findIndex(function(item) {return item.review_seq == reviewSeqBuf}) // findIndex = find + indexOf
									if (idx > -1) vm.myBookmarkData.splice(idx, 1)

									const idx2 = vm.myReviewData.findIndex(function(item2) {return item2.review_seq == reviewSeqBuf}) // findIndex = find + indexOf
									if (idx2 > -1) vm.myReviewData.splice(idx2, 1)
								}
								else if(response.data.code == '-1'){
									alert("잘못된 시도입니다. 문제 지속 시 관리자에게 문의하세요");
								}
								else if(response.data.code == '-5000'){
									alert("로그인이 필요한 서비스 입니다. 로그인 상태인지 확인해주세요");
								}
								else if(response.data.code == '-3'){
									alert("유효하지 않은 리뷰id입니다..");
								}
								else{
									alert("서버에 뭔가 문제가 있는 것 같습니다.. 관리자에게 문의하세요");
								}
							}
							else {
								alert("에러가 발생하였습니다. 관리자에게 문의하세요");
							}

						});
			}
		}
	  },
	  closeOverlay() {
	      this.mapOverlay.setMap(null);
      },
	  ratingImgMaker(num){
    	  var msg = "";
		  var calcul = Math.ceil(num *2 ) / 2;
		  for(var i = calcul; i > 0; i--){
		  	  if(i == 0.5) {
				  msg += "<img src='img/marker/star_half.png' height='10px'/>";
				  break;
			  }
			  msg += "<img src='img/marker/star.png' height='10px'/>";
		  }

		  return msg;
	  },
	  setBookmark(item){
		  var res = confirm("여기를 찜하기로 기록 할까요?");
		  if(res){

			  //전송부분 구현...

			  let item2 = item;
			  let vm = this;
			  let form = new FormData();
			  form.append('storeId', item.store_id);
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
								  alert("찜했어요!");
								  vm.myBookmarkData.push({
									  store_id: item2.store_id,
									  store_name: item2.store_name,
									  category: item2.category,
									  telephone: item2.telephone,
									  address: item2.address,
									  roadaddress: item2.roadaddress,
									  lon: item2.lon,
									  lat: item2.lat,
									  cnt: item2.cnt,
									  ratingav: item2.ratingav,
									  review_seq: item2.review_seq,
									  rating: item2.rating,
									  review: item2.review,
									  visit_yn: item2.visit_yn,
									  taglist: item2.taglist
								  });
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
						  }
						  else {
							  alert("에러가 발생하였습니다. 관리자에게 문의하세요");
						  }

					  });
		  }
	  },
	  makeMarkerMyReview() {
			  for (let i = 0; i < this.myReviewData.length; i++) {
				  if (this.myReviewData[i].visit_yn == 'Y') {  //사용자 리뷰만..
					  var imageSrc = 'img/marker/my_review.png', // 마커이미지의 주소입니다
							  imageSize = new kakao.maps.Size(20, 25), // 마커이미지의 크기입니다
							  imageOption = {offset: new kakao.maps.Point(45, 40)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
					  var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
							  markerPosition = new kakao.maps.LatLng(this.myReviewData[i].lat, this.myReviewData[i].lon); // 마커가 표시될 위치입니다


					  let mapMarker = new kakao.maps.Marker({
						  //map: this.mapData,
						  //position: new kakao.maps.LatLng(this.myReviewData[i].lat, this.myReviewData[i].lon)
						  image: markerImage,
						  position: markerPosition,
					  });
					  mapMarker.setMap(this.mapData);

					  var myRatingImg = this.ratingImgMaker(this.myReviewData[i].rating);
					  var othersRatingImg = this.ratingImgMaker(this.myReviewData[i].ratingav);


					  var content = '<div class="wrap" id="over' + i + '" style="display:none;">' +
							  '    <div class="info">' +
							  '        <div class="title" style="background-color: #e4606d">' +
							  '            나의 맛집' +
							  '            <div class="close" onclick="document.getElementById(\'over' + i + '\').style.display=\'none\';" title="닫기"></div>' +
							  '        </div>' +
							  '        <div class="body">' +
							  '            <!--div class="img">' +
							  '                <img src="http://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
							  '           </div-->' +
							  '            <div class="desc">' +
							  '                <div class="ellipsis" style="color:black;text-decoration:underline;" onclick="location.href=\'/#/restaurant/' + this.myReviewData[i].store_id + '\'"><b>' + this.myReviewData[i].store_name + '</b><br/><a onclick="location.href=\'/#/restaurant/' + this.myReviewData[i].store_id + '\'" href="#" style="color:gray;"> (리뷰/찜하기 개수 : ' + this.myReviewData[i].cnt + '개)</a></div>' +
							  '                <div class="ellipsis" style="color:gray;">' + this.myReviewData[i].category + '</div>' +
							  '                <div class="ellipsis" style="color:black;"> 나의별점 ' + myRatingImg + '<br/>평균별점 ' + othersRatingImg + ' (' + this.myReviewData[i].ratingav + '점)</div>' +
							  '                <!--div><a href="http://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div-->' +
							  '            </div>' +
							  '        </div>' +
							  '    </div>' +
							  '</div>';

					  // 마커 위에 커스텀오버레이를 표시합니다
					  // 마커를 중심으로 커스텀 오버레이를 표시하기위해 CSS를 이용해 위치를 설정했습니다
					  this.mapOverlay = new kakao.maps.CustomOverlay({
						  content: content,
						  map: this.mapData,
						  position: mapMarker.getPosition()
					  });

					  // 마커를 클릭했을 때 커스텀 오버레이를 표시합니다
					  kakao.maps.event.addListener(mapMarker, 'click', function () {
						  if ("block" == document.getElementById("over" + i).style.display)
							  document.getElementById("over" + i).style.display = "none";
						  else
							  document.getElementById("over" + i).style.display = "block";

					  });
				  }
			  }

	  },
	  makeMarkerMyBookmark() {
		  for (let i = 0; i < this.myBookmarkData.length; i++) {

			  if (this.myBookmarkData[i].visit_yn == 'N') {  //사용자 리뷰만..
			  	//alert(this.myReviewData[i].store_name);
				  var imageSrc = 'img/marker/my_bookmark.png', // 마커이미지의 주소입니다
						  imageSize = new kakao.maps.Size(20, 25), // 마커이미지의 크기입니다
						  imageOption = {offset: new kakao.maps.Point(45, 40)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
				  var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
						  markerPosition = new kakao.maps.LatLng(this.myBookmarkData[i].lat, this.myBookmarkData[i].lon); // 마커가 표시될 위치입니다


				  let mapMarker = new kakao.maps.Marker({
					  //map: this.mapData,
					  //position: new kakao.maps.LatLng(this.myReviewData[i].lat, this.myReviewData[i].lon)
					  image: markerImage,
					  position: markerPosition,
				  });
				  mapMarker.setMap(this.mapData);

				  var othersRatingImg = this.ratingImgMaker(this.myBookmarkData[i].ratingav);


				  var content = '<div class="wrap" id="overB' + i + '" style="display:none;">' +
						  '    <div class="info">' +
						  '        <div class="title" style="background-color: #ffac27">' +
						  '            나의 찜' +
						  '            <div class="close" onclick="document.getElementById(\'overB' + i + '\').style.display=\'none\';" title="닫기"></div>' +
						  '        </div>' +
						  '        <div class="body">' +
						  '            <!--div class="img">' +
						  '                <img src="http://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
						  '           </div-->' +
						  '            <div class="desc">' +
						  '                <div class="ellipsis" style="color:black;text-decoration:underline;" onclick="location.href=\'/#/restaurant/' + this.myBookmarkData[i].store_id + '\'"><b>' + this.myBookmarkData[i].store_name + '</b> <br/><a onclick="location.href=\'/#/restaurant/' + this.myBookmarkData[i].store_id + '\'" href="#" style="color:gray;"> (리뷰/찜하기 개수 : ' + this.myBookmarkData[i].cnt + '개)</a></div>' +
						  '                <div class="ellipsis" style="color:gray;">' + this.myBookmarkData[i].category + '</div>' +
						  '                <div class="ellipsis" style="color:black;"> 평균별점 ' + othersRatingImg + ' (' + this.myBookmarkData[i].ratingav + '점)</div>' +
						  '                <!--div><a href="http://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div-->' +
						  '            </div>' +
						  '        </div>' +
						  '    </div>' +
						  '</div>';

				  // 마커 위에 커스텀오버레이를 표시합니다
				  // 마커를 중심으로 커스텀 오버레이를 표시하기위해 CSS를 이용해 위치를 설정했습니다
				  this.mapOverlay = new kakao.maps.CustomOverlay({
					  content: content,
					  map: this.mapData,
					  position: mapMarker.getPosition()
				  });

				  // 마커를 클릭했을 때 커스텀 오버레이를 표시합니다
				  kakao.maps.event.addListener(mapMarker, 'click', function () {
					  if ("block" == document.getElementById("overB" + i).style.display)
						  document.getElementById("overB" + i).style.display = "none";
					  else
						  document.getElementById("overB" + i).style.display = "block";

				  });
			  }
		  }

	  },
	  makeMarkerOthersReview() {
		  for (let i = 0; i < this.othersReviewData.length; i++) {
				  var imageSrc = 'img/marker/others_review.png', // 마커이미지의 주소입니다
						  imageSize = new kakao.maps.Size(20, 25), // 마커이미지의 크기입니다
						  imageOption = {offset: new kakao.maps.Point(45, 40)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
				  var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
						  markerPosition = new kakao.maps.LatLng(this.othersReviewData[i].lat, this.othersReviewData[i].lon); // 마커가 표시될 위치입니다

				  let mapMarker = new kakao.maps.Marker({
					  //map: this.mapData,
					  //position: new kakao.maps.LatLng(this.myReviewData[i].lat, this.myReviewData[i].lon)
					  image: markerImage,
					  position: markerPosition,
				  });
				  mapMarker.setMap(this.mapData);

				  var othersRatingImg = this.ratingImgMaker(this.othersReviewData[i].ratingav);


				  var content = '<div class="wrap" id="overO' + i + '" style="display:none;">' +
						  '    <div class="info">' +
						  '        <div class="title" style="background-color: #1da2ff ">' +
						  '            다른사람이 등록한 맛집' +
						  '            <div class="close" onclick="document.getElementById(\'overO' + i + '\').style.display=\'none\';" title="닫기"></div>' +
						  '        </div>' +
						  '        <div class="body">' +
						  '            <!--div class="img">' +
						  '                <img src="http://cfile181.uf.daum.net/image/250649365602043421936D" width="73" height="70">' +
						  '           </div-->' +
						  '            <div class="desc">' +
						  '                <div class="ellipsis" style="color:black;text-decoration:underline;" onclick="location.href=\'/#/restaurant/' + this.othersReviewData[i].store_id + '\'"><b>' + this.othersReviewData[i].store_name + '</b><br/> <a onclick="location.href=\'/#/restaurant/' + this.othersReviewData[i].store_id + '\'" href="#" style="color:gray;"> (리뷰/찜하기 개수 : ' + this.othersReviewData[i].cnt + '개)</a></div>' +
						  '                <div class="ellipsis" style="color:gray;">' + this.othersReviewData[i].category + '</div>' +
						  '                <div class="ellipsis" style="color:black;"> 평균별점 ' + othersRatingImg + ' (' + this.othersReviewData[i].ratingav + '점)</div>' +
						  '                <!--div><a href="http://www.kakaocorp.com/main" target="_blank" class="link">홈페이지</a></div-->' +
						  '            </div>' +
						  '        </div>' +
						  '    </div>' +
						  '</div>';

				  // 마커 위에 커스텀오버레이를 표시합니다
				  // 마커를 중심으로 커스텀 오버레이를 표시하기위해 CSS를 이용해 위치를 설정했습니다
				  this.mapOverlay = new kakao.maps.CustomOverlay({
					  content: content,
					  map: this.mapData,
					  position: mapMarker.getPosition()
				  });

				  // 마커를 클릭했을 때 커스텀 오버레이를 표시합니다
				  kakao.maps.event.addListener(mapMarker, 'click', function () {
					  if ("block" == document.getElementById("overO" + i).style.display)
						  document.getElementById("overO" + i).style.display = "none";
					  else
						  document.getElementById("overO" + i).style.display = "block";

				  });
		  }

	  },
	  goEditReview(storeId, rating, taglist, memo, visitYn){
    	let reviewObj = {
    		storeId : storeId,
			rating : rating,
			tagList : taglist,
			review : memo,
			visitYn: visitYn
		};
    	this.editReviewReq =  setInterval(function() {
			BUS.$emit('editReview', reviewObj);
			console.log("리뷰를 수정하기위한 요청을 보냅니다");
		}, 100);

    	location.href="/#/EditReview";
	  }
  },
  created () {
    window.addEventListener('scroll', this.handleScroll);

  },
  destroyed () {
    window.removeEventListener('scroll', this.handleScroll);
  }
};

// 인포윈도우를 표시하는 클로저를 만드는 함수입니다
function makeOverListener(map, marker, infowindow) {
	return function() {

		infowindow.open(map, marker);


	};
}

// 인포윈도우를 닫는 클로저를 만드는 함수입니다
function makeOutListener(infowindow) {
	return function() {
		infowindow.close();
	};
}


</script>
<style></style>