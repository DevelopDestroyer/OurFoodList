package com.th.geumat;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.KeyEvent;
import android.os.Handler;
import android.view.View;
import android.webkit.JavascriptInterface;
import android.webkit.WebChromeClient;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Toast;

import com.google.android.gms.ads.AdListener;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;
import com.google.android.gms.ads.InterstitialAd;
import com.google.android.gms.ads.MobileAds;
import com.google.android.material.bottomnavigation.BottomNavigationView;
import androidx.appcompat.app.AppCompatActivity;
import androidx.navigation.NavController;
import androidx.navigation.Navigation;
import androidx.navigation.ui.AppBarConfiguration;
import androidx.navigation.ui.NavigationUI;

public class MainActivity extends AppCompatActivity {

    private WebView mWebView;
    private AdView mAdView; //배너광고
    private InterstitialAd mInterstitialAd; //전면광고
    public int countForExposeAds = 0;
    private final Handler handler = new Handler();

    public boolean isPremiumDevice = false;
    public static Context mContext;
    public static String[] Animals = {"crab", "dog", "elephant", "flamingo", "bat", "bee", "goat", "horse", "Mammoth", "Mink",
                                           "mosquito", "Penguin", "Toad", "Whale", "Wallaby", "Toucan", "Baboon", "cat", "Chinchilla", "Deer"};

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        BottomNavigationView navView = findViewById(R.id.nav_view);
        // Passing each menu ID as a set of Ids because each
        // menu should be considered as top level destinations.
        AppBarConfiguration appBarConfiguration = new AppBarConfiguration.Builder(
                R.id.navigation_home, R.id.navigation_dashboard, R.id.navigation_notifications,
                R.id.navigation_notificationsq, R.id.navigation_notificationsw)
                .build();
        NavController navController = Navigation.findNavController(this, R.id.nav_host_fragment);
        NavigationUI.setupWithNavController(navView, navController);

        /////////////////////////////////////
        // 웹뷰 셋팅
        /////////////////////////////////////
        mWebView = (WebView) findViewById(R.id.geumat_web_view);//xml 자바코드 연결
        mWebView.getSettings().setJavaScriptEnabled(true);//자바스크립트 허용

        mWebView.loadUrl("http://geumat.iwinv.net");//웹뷰 실행
        mWebView.setWebChromeClient(new WebChromeClient());//웹뷰에 크롬 사용 허용//이 부분이 없으면 크롬에서 alert가 뜨지 않음
        mWebView.setWebViewClient(new WebViewClientClass());//새창열기 없이 웹뷰 내에서 다시 열기//페이지 이동 원활히 하기위해 사용
        mWebView.getSettings().setDomStorageEnabled(true); //로컬스토리지 사용

        // Bridge 인스턴스 등록
        mWebView.addJavascriptInterface(new AndroidBridge(), "geumatApp");


        mContext = this;

        ////////////////////////////////////
        //애드몹 세팅
        ////////////////////////////////////
        //애드몹 배너 광고
        MobileAds.initialize(this, getString(R.string.admob_app_id));
        mAdView = findViewById(R.id.adView);
        AdRequest adRequest = new AdRequest.Builder().build();
        mAdView.loadAd(adRequest);

        // 광고가 제대로 로드 되는지 테스트 하기 위한 코드입니다.
        mAdView.setAdListener(new AdListener() {
            @Override
            public void onAdLoaded() {
                // Code to be executed when an ad finishes loading.
                // 광고가 문제 없이 로드시 출력됩니다.
                Log.d("@@@", "onAdLoaded");
            }

            @Override
            public void onAdFailedToLoad(int errorCode) {
                // Code to be executed when an ad request fails.
                // 광고 로드에 문제가 있을시 출력됩니다.
                Log.d("@@@", "onAdFailedToLoad " + errorCode);
            }

            @Override
            public void onAdOpened() {
                // Code to be executed when an ad opens an overlay that
                // covers the screen.
            }

            @Override
            public void onAdClicked() {
                // Code to be executed when the user clicks on an ad.
            }

            @Override
            public void onAdLeftApplication() {
                // Code to be executed when the user has left the app.
            }

            @Override
            public void onAdClosed() {
                // Code to be executed when the user is about to return
                // to the app after tapping on an ad.
                // Load the next interstitial.
            }
        }); //애드몹 배너광고 테스트코드 끝

        //애드몹 전면광고
        mInterstitialAd = new InterstitialAd(this);
        mInterstitialAd.setAdUnitId("ca-app-pub-3940256099942544/1033173712");
        mInterstitialAd.loadAd(new AdRequest.Builder().build());
        mInterstitialAd.setAdListener(new AdListener() {
            @Override
            public void onAdLoaded() {
                // Code to be executed when an ad finishes loading.
            }

            @Override
            public void onAdFailedToLoad(int errorCode) {
                // Code to be executed when an ad request fails.
            }

            @Override
            public void onAdOpened() {
                // Code to be executed when the ad is displayed.
            }

            @Override
            public void onAdClicked() {
                // Code to be executed when the user clicks on an ad.
            }

            @Override
            public void onAdLeftApplication() {
                // Code to be executed when the user has left the app.
            }

            @Override
            public void onAdClosed() {
                // Code to be executed when the interstitial ad is closed.
                mInterstitialAd.loadAd(new AdRequest.Builder().build());    //새 광고 로드
            }
        });

        /////////////////////////////////////
        // 프리미엄 디바이스 체크
        /////////////////////////////////////
        premiumCheck();

    }

    private class WebViewClientClass extends WebViewClient {//페이지 이동
        @Override
        public boolean shouldOverrideUrlLoading(WebView view, String url) {
            Log.d("check URL",url);
            view.loadUrl(url);
            return true;
        }
    }

    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {//뒤로가기 버튼 이벤트
        if ((keyCode == KeyEvent.KEYCODE_BACK) && mWebView.canGoBack()) {//웹뷰에서 뒤로가기 버튼을 누르면 뒤로가짐
            mWebView.goBack();
            return true;
        }
        return super.onKeyDown(keyCode, event);
    }

    public void changeWebviewURL(String url){
        mWebView.loadUrl(url);
    }

    public void movePremiumActivity(){
        //프리미엄 액티비티 인텐트
        Intent intent = new Intent(this, premiumActivity.class);
        startActivity(intent);
    }

    //전면광고
    public void loadAd(){
        countForExposeAds++;

        if (mInterstitialAd.isLoaded()
                && !isPremiumDevice
                && (countForExposeAds % 10 == 0)) {
            mInterstitialAd.show();
        } else {
            Log.d("TAG", "The interstitial wasn't loaded yet.");
        }
    }

    public void premiumCheck(){
        //저장된 값을 불러오기 위해 같은 네임파일을 찾음.
        SharedPreferences sf = getSharedPreferences("geumat", MODE_PRIVATE);
        //text라는 key에 저장된 값이 있는지 확인
        String geumatPremiumDataString = sf.getString("premium","ek4k3nb4u234hjdfcn23jshqknkf34");

        if(geumatPremiumDataString.contains("zmxncbvalskdjfh")) {
            isPremiumDevice = true;
        }
        if(isPremiumDevice){
            mAdView.removeAllViews();
        }
    }

    public void savePremium(){
        //SharedPreferences를 sFile이름, 기본모드로 설정
        SharedPreferences sharedPreferences = getSharedPreferences("geumat",MODE_PRIVATE);

        //저장을 하기위해 editor를 이용하여 값을 저장시켜준다.
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putString("premium","pewroiu45cvnjd32cfzmxncbvalskdjfhk03hjjkh3bdjf"); // key, value를 이용하여 저장하는 형태

        //최종 커밋
        editor.commit();
    }

    public void cancelPremium(){
        //SharedPreferences를 sFile이름, 기본모드로 설정
        SharedPreferences sharedPreferences = getSharedPreferences("geumat",MODE_PRIVATE);

        //저장을 하기위해 editor를 이용하여 값을 저장시켜준다.
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putString("premium",""); // key, value를 이용하여 저장하는 형태

        //최종 커밋
        editor.commit();
        isPremiumDevice = false;
    }

    private class AndroidBridge {
        @JavascriptInterface
        public void couponSuccess(final String code, final String key) { // 웹뷰내의 페이지에서 호출하는 함수
            //enc법 : key + 681248369 * 2 - 14325 (우선순위 무시)
            long keyDescription = Long.parseLong(key.split(";")[0]);
            String animalCode = key.split(";")[1];
            boolean animalCodeFlag = false;

            keyDescription = keyDescription + 14325;
            keyDescription = keyDescription / 2;
            keyDescription = keyDescription - 681248369;
            long L = System.currentTimeMillis() / 1000;
            for(int i = 0; i < Animals.length; i++){
                if(animalCode.equals(Animals[i]) &&
                        (Integer.parseInt(Long.toString(keyDescription).substring(Long.toString(keyDescription).length()-2, Long.toString(keyDescription).length()-1))
                      + Integer.parseInt(Long.toString(keyDescription).substring(Long.toString(keyDescription).length()-1)) ) == i ){
                    animalCodeFlag = true;
                    break;
                }
            }
            if(L < keyDescription + 120 &&
                    L > keyDescription - 120 &&
                    animalCodeFlag == true) {
                handler.post(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(MainActivity.this, "쿠폰 등록이 완료되었습니다.", Toast.LENGTH_SHORT).show();
                        savePremium();
                        premiumCheck();
                    }
                });
            }
            else{
                handler.post(new Runnable() {
                    @Override
                    public void run() {
                        Toast.makeText(MainActivity.this, "유효하지 않습니다. 관리자에게 문의하세요.", Toast.LENGTH_SHORT).show();
                        savePremium();
                        premiumCheck();
                    }
                });
            }
        }

        @JavascriptInterface
        public void premiumSuccess(final String key) { // 웹뷰내의 페이지에서 호출하는 함수
            handler.post(new Runnable() {
                @Override
                public void run() {
                    Toast.makeText(MainActivity.this, "프리미엄 회원이 되신 것을 환영합니다!", Toast.LENGTH_SHORT).show();
                    savePremium();
                    premiumCheck();
                }
            });
        }

        @JavascriptInterface
        public void adOn(final String key) { // 웹뷰내의 페이지에서 호출하는 함수
            handler.post(new Runnable() {
                @Override
                public void run() {
                    Toast.makeText(MainActivity.this, "[테스트 기능] 프리미엄 캔슬2" + key, Toast.LENGTH_SHORT).show();
                    cancelPremium();
                    premiumCheck();
                }
            });
        }
    }

    public void changeCouponPage(){
        Toast.makeText(MainActivity.this, "쿠폰 페이지로 가고 싶어요", Toast.LENGTH_SHORT).show();
    }



}