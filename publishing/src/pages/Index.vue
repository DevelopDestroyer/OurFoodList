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
		mapMarker: null,

		myReviewData: [{
			store_id: '',
			store_name: '',
			category: '',
			telephone: '',
			address: '',
			roadaddress: '',
			lon: '',
			//mapx: out_pt.x,
			//mapy: out_pt.y,
			lat: '33.450705',
			cnt: '',
			ratingav: '',
			review_seq: '',
			rating: '',
			review: '',
			visit_yn: '',
			taglist: ''

		}],
		myBookmarkData: [],
		othersReviewData: []
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

		  var positions = [];

		  alert("뷰 리스트 길이 : " + this.myReviewData.length);
		  for(let i = 0; i < this.myReviewData.length; i++){

			  positions.push({
				  content: '<div style="color:black;">'+this.myReviewData[i].store_name+'</div>',
				  latlng: new kakao.maps.LatLng(this.myReviewData[i].lat, this.myReviewData[i].lon)
			  })
		  }

		  alert("포지션즈 리스트 길이 : " + this.myReviewData.length);
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

/*
		  this.mapMarker.setMap(null);
		  var positions = [];
			alert(this.myReviewData.length);
		  for(let i = 0; i < this.myReviewData.length; i++){

			  positions.push({
				  content: this.myReviewData[i].store_name,
				  latlng: new kakao.maps.LatLng(this.myReviewData[i].lat, this.myReviewData[i].lon)
			  })
		  }
		  */




		  /*
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
		  */
/*
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
		  */
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
					  	alert("mydata 리스트 : " + response.data.mydata.length);
						  for(let i = 0; i < response.data.mydata.length; i++){
						  	if(response.data.mydata[i].visit_yn == 'Y'){//나의 리뷰
								//카텍좌표계 위경도로 변환
								var geo = new GeoTrans();
								geo.init("katec", "geo");
								var pt = new Point(response.data.mydata[i].lon, response.data.mydata[i].lat);
								var out_pt = geo.conv(pt);


								vm.myReviewData.push({
									store_id: response.data.mydata[i].store_id,
									store_name: response.data.mydata[i].store_name,
									category: response.data.mydata[i].category,
									telephone: response.data.mydata[i].telephone,
									address: response.data.mydata[i].address,
									roadaddress: response.data.mydata[i].roadaddress,
									lon: out_pt.x,
									//mapx: out_pt.x,
									//mapy: out_pt.y,
									lat: out_pt.y,
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

							}

						  }
						  alert("mydata 리스트 다넣었다 뷰는어때 : " + vm.myReviewData.length);
						  vm.maptest();

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




var Point = function(x, y) {
	this.x = x;
	this.y = y;
}

var GeoTrans = function() {
	this.srctype = "katec";
	this.dsttype = "geo";
	this.m_Ind = 0;
	this.m_Es = 0;
	this.m_Esp = 0;
	this.src_m = 0;
	this.dst_m = 0;

	this.EPSLN = 0.0000000001;
	this.m_arMajor = 6378137.0;
	this.m_arMinor = 6356752.3142;

	this.m_arScaleFactor = new Array();
	this.m_arLonCenter = new Array();
	this.m_arLatCenter = new Array();
	this.m_arFalseNorthing = new Array();
	this.m_arFalseEasting = new Array();
};

GeoTrans.prototype.init = function(srctype, dsttype) {
	this.m_arScaleFactor["geo"] = 1;
	this.m_arLonCenter["geo"] = 0.0;
	this.m_arLatCenter["geo"] = 0.0;
	this.m_arFalseNorthing["geo"] = 0.0;
	this.m_arFalseEasting["geo"] = 0.0;

	this.m_arScaleFactor["katec"] = 0.9999;
	this.m_arLonCenter["katec"] = 2.23402144255274;
	this.m_arLatCenter["katec"] = 0.663225115757845;
	this.m_arFalseNorthing["katec"] = 600000.0;
	this.m_arFalseEasting["katec"] = 400000.0;

	this.srctype = srctype;
	this.dsttype = dsttype;

	var tmp = this.m_arMinor / this.m_arMajor;
	this.m_Es = 1.0 - tmp * tmp;
	this.m_Esp = this.m_Es / (1.0 - this.m_Es);

	if(this.m_Es < 0.00001) {
		this.m_Ind = 1.0;
	} else {
		this.m_Ind = 0.0;
	}

	this.src_m = this.m_arMajor * this.mlfn(this.e0fn(this.m_Es), this.e1fn(this.m_Es), this.e2fn(this.m_Es), this.e3fn(this.m_Es), this.m_arLatCenter[srctype]);
	this.dst_m = this.m_arMajor * this.mlfn(this.e0fn(this.m_Es), this.e1fn(this.m_Es), this.e2fn(this.m_Es), this.e3fn(this.m_Es), this.m_arLatCenter[dsttype]);
}

GeoTrans.prototype.D2R = function(degree) {
	return degree* Math.PI / 180.0;
}

GeoTrans.prototype.R2D = function(radian) {
	return radian * 180.0 / Math.PI;
}

GeoTrans.prototype.e0fn = function(x) {
	return 1.0 - 0.25 * x * (1.0 + x / 16.0 * (3.0 + 1.25 * x));
}

GeoTrans.prototype.e1fn = function(x) {
	return 0.375 * x * (1.0 + 0.25 * x * (1.0 + 0.46875 * x));
}

GeoTrans.prototype.e2fn = function(x) {
	return 0.05859375 * x * x * (1.0 + 0.75 * x);
}

GeoTrans.prototype.e3fn = function(x) {
	return x * x * x * (35.0 / 3072.0);
}

GeoTrans.prototype.mlfn = function(e0, e1, e2, e3, phi) {
	return e0 * phi - e1 * Math.sin(2.0 * phi) + e2 * Math.sin(4.0 * phi) - e3 * Math.sin(6.0 * phi);
}

GeoTrans.prototype.asinz = function(value) {
	if(Math.abs(value) > 1.0) value = (value > 0 ? 1: -1);
	return Math.asin(value);
}

GeoTrans.prototype.conv = function(in_pt) {
	var inlon, inlat, outlon, outlat;

	var tmpPt = new Point();
	var out_pt = new Point();

	if(this.srctype == "geo") {
		tmpPt.x = this.D2R(in_pt.x);
		tmpPt.y = this.D2R(in_pt.y);
	} else {
		this.tm2geo(in_pt, tmpPt);
	}

	outlon = inlon;
	outlat = inlat;

	if(this.dsttype == "geo") {
		out_pt.x = this.R2D(tmpPt.x);
		out_pt.y = this.R2D(tmpPt.y);
	} else {
		this.geo2tm(tmpPt, out_pt);
		out_pt.x = Math.round(out_pt.x);
		out_pt.y = Math.round(out_pt.y);
	}

	return out_pt;
}

GeoTrans.prototype.geo2tm = function(in_pt, out_pt) {
	var delta_lon = in_pt.x - this.m_arLonCenter[this.dsttype];
	var sin_phi = Math.sin(in_pt.y);
	var cos_phi = Math.cos(in_pt.y);

	if(this.m_Ind != 0) {
		var b = cos_phi * Math.sin(delta_lon);

		if((Math.abs(Math.abs(b) - 1.0)) < this.EPSLN) {
			alert("무한대 에러");
		}
	} else {
		var b = 0;
		x = 0.5 * this.m_arMajor * this.m_arScaleFactor[this.dsttype] * Math.log((1.0 + b) / (1.0 - b));
		var con = Math.acos(cos_phi * Math.cos(delta_lon) / Math.sqrt(1.0 - b * b));

		if(in_pt.y < 0) {
			con = con * -1;
			y = this.m_arMajor * this.m_arScaleFactor[this.dsttype] * (con - this.m_arLatCenter[this.dsttype]);
		}
	}

	var al = cos_phi * delta_lon;
	var als = al * al;
	var c = this.m_Esp * cos_phi * cos_phi;
	var tq = Math.tan(in_pt.y);
	var t = tq * tq;
	var con = 1.0 - this.m_Es * sin_phi * sin_phi;
	var n = this.m_arMajor / Math.sqrt(con);
	var ml = this.m_arMajor * this.mlfn(this.e0fn(this.m_Es), this.e1fn(this.m_Es), this.e2fn(this.m_Es), this.e3fn(this.m_Es), in_pt.y);

	out_pt.x = this.m_arScaleFactor[this.dsttype] * n * al * (1.0 + als / 6.0 * (1.0 - t + c + als / 20.0 * (5.0 - 18.0 * t + t * t + 72.0 * c - 58.0 * this.m_Esp))) + this.m_arFalseEasting[this.dsttype];
	out_pt.y = this.m_arScaleFactor[this.dsttype] * (ml - this.dst_m + n * tq * (als * (0.5 + als / 24.0 * (5.0 - t + 9.0 * c + 4.0 * c * c + als / 30.0 * (61.0 - 58.0 * t + t * t + 600.0 * c - 330.0 * this.m_Esp))))) + this.m_arFalseNorthing[this.dsttype];
}


GeoTrans.prototype.tm2geo = function(in_pt, out_pt) {
	var max_iter = 6;

	if(this.m_Ind != 0) {
		var f = Math.exp(in_pt.x / (this.m_arMajor * this.m_arScaleFactor[this.srctype]));
		var g = 0.5 * (f - 1.0 / f);
		var temp = this.m_arLatCenter[this.srctype] + in_pt.y / (this.m_arMajor * this.m_arScaleFactor[this.srctype]);
		var h = Math.cos(temp);
		var con = Math.sqrt((1.0 - h * h) / (1.0 + g * g));
		out_pt.y = asinz(con);

		if(temp < 0) out_pt.y *= -1;

		if((g == 0) && (h == 0)) {
			out_pt.x = this.m_arLonCenter[this.srctype];
		} else {
			out_pt.x = Math.atan(g / h) + this.m_arLonCenter[this.srctype];
		}
	}

	in_pt.x -= this.m_arFalseEasting[this.srctype];
	in_pt.y -= this.m_arFalseNorthing[this.srctype];

	var con = (this.src_m + in_pt.y / this.m_arScaleFactor[this.srctype]) / this.m_arMajor;
	var phi = con;

	var i = 0;

	while(true) {
		var delta_Phi = ((con + this.e1fn(this.m_Es) * Math.sin(2.0 * phi) - this.e2fn(this.m_Es) * Math.sin(4.0 * phi) + this.e3fn(this.m_Es) * Math.sin(6.0 * phi)) / this.e0fn(this.m_Es)) - phi;
		phi = phi + delta_Phi;

		if(Math.abs(delta_Phi) <= this.EPSLN) break;

		if(i >= max_iter) {
			alert("무한대 에러");
			break;
		}

		i++;
	}

	if(Math.abs(phi) < (Math.PI / 2)) {
		var sin_phi = Math.sin(phi);
		var cos_phi = Math.cos(phi);
		var tan_phi = Math.tan(phi);
		var c = this.m_Esp * cos_phi * cos_phi;
		var cs = c * c;
		var t = tan_phi * tan_phi;
		var ts = t * t;
		var con = 1.0 - this.m_Es * sin_phi * sin_phi;
		var n = this.m_arMajor / Math.sqrt(con);
		var r = n * (1.0 - this.m_Es) / con;
		var d = in_pt.x / (n * this.m_arScaleFactor[this.srctype]);
		var ds = d * d;
		out_pt.y = phi - (n * tan_phi * ds / r) * (0.5 - ds / 24.0 * (5.0 + 3.0 * t + 10.0 * c - 4.0 * cs - 9.0 * this.m_Esp - ds / 30.0 * (61.0 + 90.0 * t + 298.0 * c + 45.0 * ts - 252.0 * this.m_Esp - 3.0 * cs)));
		out_pt.x = this.m_arLonCenter[this.srctype] + (d * (1.0 - ds / 6.0 * (1.0 + 2.0 * t + c - ds / 20.0 * (5.0 - 2.0 * c + 28.0 * t - 3.0 * cs + 8.0 * this.m_Esp + 24.0 * ts))) / cos_phi);
	} else {
		out_pt.y = Math.PI * 0.5 * Math.sin(in_pt.y);
		out_pt.x = this.m_arLonCenter[this.srctype];
	}
}

GeoTrans.prototype.getDistancebyGeo = function(pt1, pt2) {
	var lat1 = this.D2R(pt1.y);
	var lon1 = this.D2R(pt1.x);
	var lat2 = this.D2R(pt2.y);
	var lon2 = this.D2R(pt2.x);

	var longitude = lon2 - lon1;
	var latitude = lat2 - lat1;

	var a = Math.pow(Math.sin(latitude / 2.0), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(longitude / 2.0), 2);
	return 6376.5 * 2.0 * Math.atan2(Math.sqrt(a), Math.sqrt(1.0 - a));
}

GeoTrans.prototype.getDistancebyKatec = function(pt1, pt2) {
	var geo = new GeoTrans("katec", "geo");
	pt1 = geo.conv(pt1);
	pt2 = geo.conv(pt2);

	return this.getDistancebyGeo(pt1, pt2);
}

GeoTrans.prototype.getTimebySec = function(distance) {
	return Math.round(3600 * distance / 4);
}

GeoTrans.prototype.getTimebyMin = function(distance) {
	return Number(Math.ceil(this.getTimebySec(distance) / 60));
}

</script>
<style></style>