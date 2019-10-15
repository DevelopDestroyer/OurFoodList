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

			 
		     <!--card style="width: 100%;">
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
             </card-->	
           </div>
          </div>		   
			 
	</template>
    <!--basic-elements></basic-elements>
    <navigation></navigation>
    <tabs-section></tabs-section>
    <progress-pagination></progress-pagination>
    <notifications></notifications>
    <typography></typography>
    <javascript-components></javascript-components>
    <carousel-section></carousel-section>
    <nucleo-icons-section></nucleo-icons-section>
    <div class="section">
      <div class="container text-center">
        <div class="row justify-content-md-center">
          <div class="col-md-12 col-lg-8">
            <h2 class="title">Completed with examples</h2>
            <h5 class="description">
              The kit comes with three pre-built pages to help you get started
              faster. You can change the text and images and you're good to go.
              More importantly, looking at them will give you a picture of what
              you can built with this powerful Bootstrap 4 ui kit.
            </h5>
          </div>
        </div>
      </div>
    </div>
    <signup-form></signup-form>
    <examples-section></examples-section>
    <download-section></download-section-->
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
    DownloadSection
	
  },
  data() {
    return {
      show: true
	}
  },
  mounted() {
      var container = document.getElementById('map');
        var mapOptions = {
            center: new daum.maps.LatLng(37.4011778,127.1112022),
            level: 4 //지도의 레벨(확대, 축소 정도)
        };
        var map = new daum.maps.Map(container, mapOptions);
  },
  methods : {
    handleScroll (event){
	  if(this.show && 95 >= document.getElementById("gmatList").getBoundingClientRect().top){
		this.show = false;
		}
	  else if (!this.show && 110 < document.getElementById("gmatList").getBoundingClientRect().top){
		this.show = true;
	  }
	}
  },
  created () {
    window.addEventListener('scroll', this.handleScroll);
  },
  destroyed () {
    window.removeEventListener('scroll', this.handleScroll);
  }
};


</script>
<style></style>