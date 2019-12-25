<template>
    <div class="page-header clear-filter" filter-color="orange">
      <parallax
        class="page-header-image"
      >
      </parallax>
    <div class="content">


      <div class="container">
      <h1>맛집등록</h1>	
	  <template>
        <div class="row">
          <fg-input class="col-10"
 	        	v-model="inputKeyword"
                placeholder="맛집을 검색해주세요">
          </fg-input>

            </fg-input>					  
		  <n-button  style="margin-top:1px;" type="primary" icon round>
			<i class="fa fa-heart"></i>
		  </n-button>			  
		  
        </div>
		<br/>
		<br/>
        <div class="row">
          
		  <div style="border:0px solid white;width:90%;height:500px; overflow-y:scroll;overflow-x:hidden">



 <card style="width: 100%; color:black; text-align:left">
   <ul slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>이태리 부대찌개</h5>
	   성남시 분당구 판교로 <br/>
       <n-button type="primary" size="sm">등록하기</n-button>
     </li> 
   </ul>
    <ul slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>이태리 부대찌개</h5>
	   성남시 분당구 판교로 <br/>
       <n-button type="primary" size="sm">등록하기</n-button>
     </li> 
   </ul>
   <ul slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>이태리 부대찌개</h5>
	   성남시 분당구 판교로 <br/>
       <n-button type="primary" size="sm">등록하기</n-button>
     </li> 
   </ul>
   <ul slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>이태리 부대찌개</h5>
	   성남시 분당구 판교로 <br/>
       <n-button type="primary" size="sm">등록하기</n-button>
     </li> 
   </ul>
   <ul slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>이태리 부대찌개</h5>
	   성남시 분당구 판교로 <br/>
       <n-button type="primary" size="sm">등록하기</n-button>
     </li> 
   </ul>
   <ul slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>이태리 부대찌개</h5>
	   성남시 분당구 판교로 <br/>
       <n-button type="primary" size="sm">등록하기</n-button>
     </li> 
   </ul>
   <ul slot="raw-content" class="list-group list-group-flush">
     <li class="list-group-item">
	   <h5>이태리 부대찌개</h5>
	   성남시 분당구 판교로 <br/>
       <n-button type="primary" size="sm">등록하기</n-button>
     </li> 
   </ul>
  
  </card>

		  
		  </div>
        </div>		
       </template>



      </div>
    </div>
  </div>
</template>
<script>
import { Card, Button, FormGroupInput, Badge } from '@/components';
import MainFooter from '@/layout/MainFooter';
export default {
  name: 'login-page',
  bodyClass: 'login-page',
  components: {
    Card,
    MainFooter,
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput
  },
  data() {
    return {
	  inputKeyword : ''
    }
  }
  
};
</script>
<style></style>
