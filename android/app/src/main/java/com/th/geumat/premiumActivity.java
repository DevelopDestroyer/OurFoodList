package com.th.geumat;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

import com.anjlab.android.iab.v3.BillingProcessor;
import com.anjlab.android.iab.v3.TransactionDetails;
import com.th.geumat.MainActivity;
import javax.net.ssl.HttpsURLConnection;


public class premiumActivity  extends AppCompatActivity implements BillingProcessor.IBillingHandler {
    private Context context = this;
    private BillingProcessor bp;
    public static String[] Animals = {"crab", "dog", "elephant", "flamingo", "bat", "bee", "goat", "horse", "Mammoth", "Mink",
            "mosquito", "Penguin", "Toad", "Whale", "Wallaby", "Toucan", "Baboon", "cat", "Chinchilla", "Deer"};

    @Override
    protected void onCreate(Bundle savedInstanceState){
       super.onCreate(savedInstanceState);
       setContentView(R.layout.activity_premium);

        bp = new BillingProcessor(this, "test", this);
        bp.initialize();

    }

    public void btnClick(View view){
        if(view.getId() == R.id.preButton){

            bp.purchase(this, "premium" );

        }
        else if(view.getId() == R.id.couponButton){
            ((MainActivity)MainActivity.mContext).changeWebviewURL("http://geumat.iwinv.net/#/coupon");
            //((MainActivity)MainActivity.mContext).loadAd();
            finish();
        }

    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (!bp.handleActivityResult(requestCode, resultCode, data)) {
            super.onActivityResult(requestCode, resultCode, data);
        }
    }

    @Override
    public void onDestroy() {
        if (bp != null) {
            bp.release();
        }
        super.onDestroy();
    }

    @Override
    public void onProductPurchased(String productId, TransactionDetails details) {
        // 이 메소드는 구매 '성공'시에만 호출된다.
        if (productId.equals("premium")) {
            // TODO: 구매 해 주셔서 감사합니다! 메세지 보내기
            Toast.makeText(this, "프리미엄 결제가 완료 되었습니다.", Toast.LENGTH_LONG).show();

            // * 광고 제거는 1번 구매하면 영구적으로 사용하는 것이므로 consume하지 않지만,
            // 만약 게임 아이템 100개를 주는 것이라면 아래 메소드를 실행시켜 다음번에도 구매할 수 있도록 소비처리를 해줘야한다.
            bp.consumePurchase("premium");

            ((MainActivity)MainActivity.mContext).savePremium();
            ((MainActivity)MainActivity.mContext).premiumCheck();
            //enc법 : key + 681248369 * 2 - 14325 (우선순위 무시)
            long L = System.currentTimeMillis() / 1000;

            String tmp_L = Long.toString(L);
            int animalCode = Integer.parseInt(tmp_L.split(";")[0].substring(tmp_L.split(";")[0].length()-2, tmp_L.split(";")[0].length()-1)) + Integer.parseInt(tmp_L.split(";")[0].substring(tmp_L.split(";")[0].length()-1));
            L = L + 681248369;
            L = L * 2;
            L = L - 14325;
            String param = L + ";" + Animals[animalCode];

            ((MainActivity)MainActivity.mContext).changeWebviewURL("http://geumat.iwinv.net/#/premium/" + param);
            finish();
        }

    }

    @Override
    public void onPurchaseHistoryRestored() {
        // * 구매 정보가 복원되었을때 호출
        // bp.loadOwnedPurchasesFromGoogle() 하면 호출 가능
    }

    @Override
    public void onBillingError(int errorCode, Throwable error) {
        // * 구매 오류시 호출
        // errorCode == Constants.BILLING_RESPONSE_RESULT_USER_CANCELED 일때는
        // 사용자가 단순히 구매 창을 닫은것임으로 이것 제외하고 핸들링하기.
    }

    @Override
    public void onBillingInitialized() {
        // * 처음에 초기화됬을때.
    }


    class RequestThread extends Thread {
        public void run(){

            try {
                URL url = new URL("https://geumat.iwinv.net/api/coupon?couponId=taeho");
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();

                if(conn != null){
                    conn.setConnectTimeout(10000); // 10초 대기 후 응답이 없으면 끝
                    conn.setRequestMethod("GET");
                    conn.setDoInput(true); // 서버에서 받기 가능
                    conn.setDoOutput(true); // 서버에 보내기 가능

                    int resCode = conn.getResponseCode(); // 서버에 연결 시도

                    // reader는 바이트 배열이 아니라, 문자열로 처리할 수 있음
                    // BufferedReader는 한줄씩 읽어들임
                    BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                    String line = null;

                    while(true){
                        line = reader.readLine();
                        if(line == null) break;

                        System.out.println("API 결과" + line);
                    }

                    reader.close();
                    conn.disconnect();
                }

            } catch(Exception e){
                e.printStackTrace();
            }
        }
    }


}
