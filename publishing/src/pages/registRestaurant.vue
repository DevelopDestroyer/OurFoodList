  
<template>
    <div class="page-header clear-filter" filter-color="orange">
      <parallax
        class=""
      >
      </parallax>
    <div class="content">


      <div class="container">
      <h1 id="menu_title">맛집등록</h1>	
	  <template>
        <div class="row justify-content-md-center" style="margin-left:12px;">
          <fg-input class="col-10"
 	        	v-model="inputKeyword"
                placeholder="맛집을 검색해주세요">
          </fg-input>
				  
		  <n-button v-on:click="searchReq()" style="margin-top:1px;" type="primary" icon round>
			<i class="fa fa-heart"></i>
		  </n-button>			  
		  
        </div>
		<br/>
		<br/>
        <div class="row justify-content-md-center">
          <div class="col-md-1 col-lg-1"></div>
		  
		  <div class="col-md-10 col-lg-10" style="border:0px solid white;width:100%;height:500px; overflow-y:scroll;overflow-x:hidden">



 <card style="width: 100%; color:black; text-align:left">

    <ul v-for="item in list" v-bind:key="item.id"
	  slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>{{item.title}}</h5>
   	   <i class="now-ui-icons location_bookmark"></i> {{item.category}}<br/><br/>
	   <badge type="primary">지번</badge> {{item.address}} <br/>
	   <badge type="primary">도로명</badge> {{item.roadAddress}} <br/>
	   <!--input type="hidden" :value=item.mapx></input>
	   <input type="hidden" :value=item.mapy></input-->
	   
	   
       <n-button type="primary" size="sm" @click.native="modals.notice=true">등록하기</n-button>
     </li> 
   </ul>


	<!--샘플카드-->
   <!--ul slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>이태리 부대찌개2</h5>
	   <badge type="primary">도로명</badge> 성남시 분당구 판교로 <br/>
       <n-button type="primary" size="sm">등록하기</n-button>
     </li> 
   </ul-->
  
  </card>

		  
		  </div>
		  <div class="col-md-1 col-lg-1"></div>
        </div>	
	   
<template>
<modal :show.sync="modals.notice"
             footer-classes="justify-content-center"
             type="notice" style="color:gray;margin-top:80px;">
			 <br><br>
		 
        <h5 slot="header" class="modal-title">How Do You Become an Affiliate?</h5>
        <template>
<div class="col-md-12 col-lg-12" style="border:0px solid white;width:100%;height:400px; overflow-y:scroll;overflow-x:hidden">			
          <div class="instruction"  style="color:gray">
            <div class="row">
              <div class="col-md-8">
                <strong>1. Register</strong>
                <p class="description"  style="color:gray">The first step is to create an account at <a
                  href="http://www.creative-tim.com/">Creative Tim</a>. You can choose a social network or
                  go for the classic version, whatever works best for you.</p>
              </div>
              <div class="col-md-4">
                <div class="picture">
                  <img src="/img/bg1.jpg" alt="Thumbnail Image" class="rounded img-raised">
                </div>
              </div>
            </div>
          </div>
          <div class="instruction">
            <div class="row">
              <div class="col-md-8">
                <strong>2. Apply</strong>
                <p class="description"  style="color:gray">The first step is to create an account at <a
                  href="http://www.creative-tim.com/">Creative Tim</a>. You can choose a social network or
                  go for the classic version, whatever works best for you.</p>
              </div>
              <div class="col-md-4">
                <div class="picture">
                  <img src="/img/bg3.jpg" alt="Thumbnail Image" class="rounded img-raised">
                </div>
              </div>
            </div>
          </div>
          <p>If you have more questions, don't hesitate to contact us or send us a tweet @creativetim. We're
            here to help!</p>
			</div><!--스크롤 영역 끝-->
        </template>
        <div slot="footer" class="justify-content-center">
          <n-button type="info" round @click.native="modals.notice = false">Sounds good!</n-button>
        </div>

</modal>
</template>

		
       </template>

	   

	  

      </div>
    </div>
  </div>
  

  
  
</template>

<script>
import { Card, Button, FormGroupInput, Badge, Modal } from '@/components';
import MainFooter from '@/layout/MainFooter';
const axios = require('axios');
export default {
  name: 'login-page',
  bodyClass: 'login-page',
  components: {
    Card,
    MainFooter,
	Modal,
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput,
	[Badge.name]: Badge
  },
  data() {
    return {
	  inputKeyword : '',
      modals: {
          notice: false
      },	  
	  list: [
		{
			title: "검색해주세요!",
			link: "",
			category: "",
			description: "",
			telephone: "",
			address: "",
			roadAddress: "",
			mapx: "",
			mapy: ""
		},
		{
			title: "Cafe Kudeta",
			link: "",
			category: "음식점>카페,디저트",
			description: "",
			telephone: "031-757-6364",
			address: "경기도 성남시 수정구 수진동 2207",
			roadAddress: "경기도 성남시 수정구 산성대로 199-1",
			mapx: "324117",
			mapy: "537639"

		}
	  ],
	  getData: function(){
		//alert('보이루');
	  	
		/*
        axios.get('https://raw.githubusercontent.com/joshua1988/doit-vuejs/master/data/demo.json')
//        axios.get('/api/searchRestaurant.php?keyword=')
          .then(function(response){
            alert("받아온 값 : " + response.data.fe3);
            console.log(response); // 객체 형태로 반환. 파싱작업 불필요
           });
		  */ 
      }  
    }
  },
  methods: {
  
	emptyList(){
     	this.list = [];
	},
    searchReq(){
	    var vm = this;
		/*
        axios.get('https://raw.githubusercontent.com/joshua1988/doit-vuejs/master/data/demo.json')
//        axios.get('/api/searchRestaurant.php?keyword=')
          .then(function(response){
            alert("받아온 값 : " + response.data.fe3);
			vm.list = [];
            console.log(response); // 객체 형태로 반환. 파싱작업 불필요
           });		
		*/
        axios.get('/api/searchRestaurant.php?keyword=' + this.inputKeyword)
          .then(function(response){
            console.log(response);
			vm.list = [];
			for(var i = 0; i < response.data.items.length; i++){
			    //카텍좌표계 위경도로 변환
			    var geo = new GeoTrans();
				geo.init("katec", "geo");
				var pt = new Point(response.data.items[i].mapx, response.data.items[i].mapy);
				var out_pt = geo.conv(pt);
				
				//타이틀에 있는 태그 제거
				var remove_tag_title = response.data.items[i].title;
				remove_tag_title = remove_tag_title.replace('<b>', '');
				remove_tag_title = remove_tag_title.replace('</b>', '');

				vm.list.push({
					title: remove_tag_title,
					link: response.data.items[i].link,
					category: response.data.items[i].category,
					description: response.data.items[i].description,
					telephone: response.data.items[i].telephone,
					address: response.data.items[i].address,
					roadAddress: response.data.items[i].roadAddress,
					mapx: out_pt.x,
					mapy: out_pt.y
				})
			}
        });	
		
		

	}
  }
};



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
