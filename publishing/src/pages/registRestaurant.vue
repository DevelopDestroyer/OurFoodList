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
	   <input type="hidden" :value=item.mapx></input>
	   <input type="hidden" :value=item.mapy></input>
	   
	   
       <n-button type="primary" size="sm">등록하기</n-button>
     </li> 
   </ul>



   <ul slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>이태리 부대찌개2</h5>
	   <badge type="primary">도로명</badge> 성남시 분당구 판교로 <br/>
       <n-button type="primary" size="sm">등록하기</n-button>
     </li> 
   </ul>
  
  </card>

		  
		  </div>
		  <div class="col-md-1 col-lg-1"></div>
        </div>		
       </template>



      </div>
    </div>
  </div>
</template>
<!--script src="/js/axios.js"></script-->
<script>
import { Card, Button, FormGroupInput, Badge } from '@/components';
import MainFooter from '@/layout/MainFooter';
const axios = require('axios');
export default {
  name: 'login-page',
  bodyClass: 'login-page',
  components: {
    Card,
    MainFooter,
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput,
	[Badge.name]: Badge
  },
  data() {
    return {
	  inputKeyword : '',
	  list: [
		{
			title: "수진역 8호선",
			link: "",
			category: "교통,운수>지하철,전철",
			description: "",
			telephone: "02-6311-8251",
			address: "경기도 성남시 수정구 수진동 2205-1",
			roadAddress: "경기도 성남시 수정구 산성대로 200",
			mapx: "324127",
			mapy: "537592"
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
					mapx: response.data.items[i].mapx,
					mapy: response.data.items[i].mapy
				})
			}
        });	
		
		

	}
  }
};
</script>
<style></style>
