package com.th.geumat;

import android.app.Activity;
import android.content.Context;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import com.th.geumat.MainActivity;
import javax.net.ssl.HttpsURLConnection;


public class premiumActivity extends Activity {
    private Context context = this;

    @Override
    protected void onCreate(Bundle savedInstanceState){
       super.onCreate(savedInstanceState);
       setContentView(R.layout.activity_premium);


    }

    public void btnClick(View view){
        if(view.getId() == R.id.preButton){
            Toast.makeText(this, "프리미엄 결제가 완료 되었습니다.", Toast.LENGTH_LONG).show();

        }
        else if(view.getId() == R.id.couponButton){
            ((MainActivity)MainActivity.mContext).changeWebviewURL("http://geumat.iwinv.net/#/coupon");
            ((MainActivity)MainActivity.mContext).loadAd();
            finish();
        }

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
