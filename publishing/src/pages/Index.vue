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
		  <div class="row">
		     <card style="width: 100%;">
                <ul slot="raw-content" class="list-group list-group-flush">
                  <li class="list-group-item">
					<p style="font-size:24px;">이태리 부대찌개 </p>
					<i class="now-ui-icons location_pin"></i>경기 성남시 분당구 판교역로 230　　<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="none" stroke="#444444" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M12,10l-2,2L4,6l2-2 L3,1L1,3c0,6.627,5.373,12,12,12l2-2L12,10z" data-cap="butt"></path> </g></svg> 031-696-0310<br>
					  <table style="width:100%">
					    <tr>
					      <td>
					        <button type="button" class="btn btn-round btn-info" v-on:click="maptest()"> <i class="now-ui-icons ui-1_zoom-bold"></i>　상세보기</button>
					      </td>
					      <td style="text-align:right;">
						    <button type="button" class="btn btn-round btn-primary"> <i class="now-ui-icons ui-2_chat-round"></i>　5</button>　　
					        <button type="button" class="btn btn-round btn-primary"> <i class="now-ui-icons ui-2_like"></i>　19</button>
		      			  </td>
					    </tr>
					</table>
			      </li>
			  
                </ul>
             </card>
		     <card style="width: 100%;">
                <ul slot="raw-content" class="list-group list-group-flush">
                  <li class="list-group-item">
					<p style="font-size:24px;">이태리 부대찌개 </p>
					<i class="now-ui-icons location_pin"></i>경기 성남시 분당구 판교역로 230　　<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g transform="translate(0, 0)"><path fill="none" stroke="#444444" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M12,10l-2,2L4,6l2-2 L3,1L1,3c0,6.627,5.373,12,12,12l2-2L12,10z" data-cap="butt"></path> </g></svg> 031-696-0310<br>
					  <table style="width:100%">
					    <tr>
					      <td>
					        <button type="button" class="btn btn-round btn-info"> <i class="now-ui-icons ui-1_zoom-bold"></i>　상세보기</button>
					      </td>
					      <td style="text-align:right;">
						    <button type="button" class="btn btn-round btn-primary"> <i class="now-ui-icons ui-2_chat-round"></i>　5</button>　　
					        <button type="button" class="btn btn-round btn-primary"> <i class="now-ui-icons ui-2_like"></i>　19</button>
		      			  </td>
					    </tr>
					</table>
			      </li>
			  
                </ul>
             </card>
			  <input id="closeOverlay" type="button" value="0" v-on:click="closeOverlay()" />
			  <script>
				  let overlayCnt = 1000;

				  // 커스텀 오버레이를 닫기 위해 호출되는 함수입니다
				  function closeOverlayClassicJavas() {
				  	alert("나 여깄어!");document.getElementById('closeOverlay').dispatchEvent(document.createEvent("HTMLEvents").initEvent("click", true, false));

//				  document.getElementById('closeOverlay').value = overlayCnt;
				  overlayCnt++;
				  }

			  </script>
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
import { Card } from '@/components';
import { BUS } from './EventBus';
const axios = require('axios');


export default {
  name: 'index',
  bodyClass: 'index-page',
  components: {
    Parallax,
	Card,
	BasicElements,
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

		myReviewData: [],
		myBookmarkData: [],
		othersReviewData: []
	}
  },
  mounted() {
      var container = document.getElementById('map');
        var mapOptions = {
            center: new kakao.maps.LatLng(37.4011778,127.1112022),
            level: 9 //지도의 레벨(확대, 축소 정도)
        };
        this.mapData = new kakao.maps.Map(container, mapOptions);

  },
  methods : {
    handleScroll (event){
	  if(this.show && 95 >= document.getElementById("gmatList").getBoundingClientRect().top){
		this.show = false;
		}
	  else if (!this.show && 110 < document.getElementById("gmatList").getBoundingClientRect().top){
		this.show = true;
	  }
	},
	  closeOverlay() {
    	  alert("으아아아");
    	  console.log("으아아아ㅏ아아ㅏㅏ");
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
							  '                <div class="ellipsis" style="color:black;"><b>' + this.myReviewData[i].store_name + '</b> <a href="#" style="color:gray;"> (리뷰 개수 : ' + this.myReviewData[i].cnt + '개)</a></div>' +
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
						  '                <div class="ellipsis" style="color:black;"><b>' + this.myBookmarkData[i].store_name + '</b> <a href="#" style="color:gray;"> (리뷰 개수 : ' + this.myBookmarkData[i].cnt + '개)</a></div>' +
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
						  '                <div class="ellipsis" style="color:black;"><b>' + this.othersReviewData[i].store_name + '</b> <a href="#" style="color:gray;"> (리뷰 개수 : ' + this.othersReviewData[i].cnt + '개)</a></div>' +
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
					  if ("block" == document.getElementById("over" + i).style.display)
						  document.getElementById("overO" + i).style.display = "none";
					  else
						  document.getElementById("overO" + i).style.display = "block";

				  });
		  }

	  },
  },
  created () {
    window.addEventListener('scroll', this.handleScroll);
	  let vm = this;
	  BUS.$on('sessionState',function(data){
		  console.log("메인네브바에서 보낸 메시지 : " + data); //abc

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
									ratingav: response.data.mydata[i].ratingav,
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
									ratingav: response.data.mydata[i].ratingav,
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
									  lon: response.data.othersdata[i].lon,
									  lat: response.data.othersdata[i].lat,
									  cnt: response.data.othersdata[i].cnt,
									  ratingav: response.data.othersdata[i].ratingav
								  })
						  }

						  vm.makeMarkerOthersReview();
						  vm.makeMarkerMyBookmark();
						  vm.makeMarkerMyReview();

					  }
					  else{
					  	alert("맛집 리스트를 가져오는데 실패했습니다.. 서버 문제 같습니다..");
					  }
				  });
	  });
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