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
		mapMarker: null
	}
  },
  mounted() {
      var container = document.getElementById('map');
        var mapOptions = {
            center: new kakao.maps.LatLng(37.4011778,127.1112022),
            level: 4 //지도의 레벨(확대, 축소 정도)
        };
        this.mapData = new kakao.maps.Map(container, mapOptions);

// 마커를 표시할 위치와 내용을 가지고 있는 객체 배열입니다
	  var positions = [
		  {
			  content: '카카오',
			  latlng: new kakao.maps.LatLng(33.450705, 126.570677)
		  },
		  {
			  content: '생태연못',
			  latlng: new kakao.maps.LatLng(33.450936, 126.569477)
		  },
		  {
			  content: '<div style="color:black;">텃밭</div>',
			  latlng: new kakao.maps.LatLng(33.450879, 126.569940)
		  },
		  {
			  content: '<div style="color:black;">근린공원</div>',
			  latlng: new kakao.maps.LatLng(33.451393, 126.570738)
		  }
	  ];

	  for (var i = 0; i < positions.length; i ++) {
		  // 마커를 생성합니다
		  this.mapMarker = new kakao.maps.Marker({
			  map: this.mapData, // 마커를 표시할 지도
			  position: positions[i].latlng // 마커의 위치
		  });

		  // 마커에 표시할 인포윈도우를 생성합니다
		  var infowindow = new kakao.maps.InfoWindow({
			  content: positions[i].content // 인포윈도우에 표시할 내용
		  });

		  // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
		  // 이벤트 리스너로는 클로저를 만들어 등록합니다
		  // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
		  kakao.maps.event.addListener(this.mapMarker, 'click', makeOverListener(this.mapData, this.mapMarker, infowindow));
		  kakao.maps.event.addListener(this.mapMarker, 'mouseout', makeOutListener(infowindow));
		  //this.mapData = map;
	  }
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
	  maptest() {

// 마커를 표시할 위치와 내용을 가지고 있는 객체 배열입니다

		  this.mapMarker.setMap(null);
		  var positions = [

			  {
				  content: '테스트111',
				  latlng: new kakao.maps.LatLng(33.450805, 126.570777)
			  },
			  {
				  content: '테스트2222',
				  latlng: new kakao.maps.LatLng(33.450836, 126.569377)
			  }


		  ];

		  for (var i = 0; i < positions.length; i++) {
			  // 마커를 생성합니다
			  this.mapMarker = new kakao.maps.Marker({
				  map: this.mapData, // 마커를 표시할 지도
				  position: positions[i].latlng // 마커의 위치
			  });

			  // 마커에 표시할 인포윈도우를 생성합니다
			  var infowindow = new kakao.maps.InfoWindow({
				  content: positions[i].content // 인포윈도우에 표시할 내용
			  });

			  // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
			  // 이벤트 리스너로는 클로저를 만들어 등록합니다
			  // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
			  kakao.maps.event.addListener(this.mapMarker, 'click', makeOverListener(this.mapData, this.mapMarker, infowindow));
			  kakao.maps.event.addListener(this.mapMarker, 'mouseout', makeOutListener(infowindow));
		  }
	  },

  },
  created () {
    window.addEventListener('scroll', this.handleScroll);

	  BUS.$on('sessionState',function(data){
		  console.log("메인네브바에서 보낸 메시지 : " + data); //abc
		  let vm = this;
		  axios.get('/api/gmatList.php')
				  .then(function(response){
					  console.log(response);
					  if(response.data.code == '1') {
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