package com.th.geumat;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;

import com.android.billingclient.api.BillingClient;
import com.android.billingclient.api.BillingClientStateListener;
import com.android.billingclient.api.BillingFlowParams;
import com.android.billingclient.api.BillingResult;
import com.android.billingclient.api.ConsumeParams;
import com.android.billingclient.api.ConsumeResponseListener;
import com.android.billingclient.api.Purchase;
import com.android.billingclient.api.PurchasesUpdatedListener;
import com.android.billingclient.api.SkuDetails;
import com.android.billingclient.api.SkuDetailsParams;
import com.android.billingclient.api.SkuDetailsResponseListener;
import com.anjlab.android.iab.v3.BillingProcessor;
import com.anjlab.android.iab.v3.TransactionDetails;
import com.th.geumat.MainActivity;
import com.th.geumat.ui.Seller;

import javax.net.ssl.HttpsURLConnection;


public class premiumActivity  extends AppCompatActivity implements PurchasesUpdatedListener {
    //public class premiumActivity   extends AppCompatActivity implements PurchasesUpdatedListener {
    private BillingClient billingClient;
    SkuDetails skuDetailsPremium;
    private PurchasesUpdatedListener purchasesUpdatedListener;
    Context mContext;

    //private BillingProcessor bp;
    public static String[] Animals = {"crab", "dog", "elephant", "flamingo", "bat", "bee", "goat", "horse", "Mammoth", "Mink",
            "mosquito", "Penguin", "Toad", "Whale", "Wallaby", "Toucan", "Baboon", "cat", "Chinchilla", "Deer"};

    @Override
    protected void onCreate(Bundle savedInstanceState){
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_premium);

        //bp = new BillingProcessor(this, "test", this);
        //bp.initialize();

        mContext = premiumActivity.this;

        billingClient = BillingClient.newBuilder(mContext).setListener(this).enablePendingPurchases().build();
        billingClient.startConnection(new BillingClientStateListener() {
            @Override
            public void onBillingSetupFinished(BillingResult billingResult) {
                // Logic from ServiceConnection.onServiceConnected should be moved here.
                if (billingResult.getResponseCode() == BillingClient.BillingResponseCode.OK) {
                    // The billing client is ready. You can query purchases here.
                    List<String> skuList = new ArrayList<> ();
                    skuList.add("premium");
                    SkuDetailsParams.Builder params = SkuDetailsParams.newBuilder();
                    params.setSkusList(skuList).setType(BillingClient.SkuType.INAPP);
                    billingClient.querySkuDetailsAsync(params.build(), new SkuDetailsResponseListener() {
                        @Override
                        public void onSkuDetailsResponse(@NonNull BillingResult billingResult, @Nullable List<SkuDetails> list) {
                            // Process the result.
                            if (billingResult.getResponseCode() == BillingClient.BillingResponseCode.OK && list != null) {
                                for (SkuDetails skuDetails : list) {
                                    String sku = skuDetails.getSku();
                                    String price = skuDetails.getPrice();

                                    if("premium".equals(sku)) {
                                        skuDetailsPremium = skuDetails;
                                    }
                                }
                                System.out.println("sku 정보를 받아왔습니다.");
                            }
                            else {
                                System.out.println("sku 정보를 받아오는데 실패하였습니다..");
                            }
                        }});
                }
            }

            @Override
            public void onBillingServiceDisconnected() {
                // Logic from ServiceConnection.onServiceDisconnected should be moved here.
            }
        });
    }



    public void btnClick(View view){
        if(view.getId() == R.id.preButton){

/*
            if (bp.isPurchased("premium")) {
                bp.consumePurchase("premium");
            }

            bp.purchase(this, "premium");
*/
            String skuToSell = "premium";
            List<String> skuList = new ArrayList<> ();
            skuList.add(skuToSell);
            SkuDetailsParams.Builder params = SkuDetailsParams.newBuilder();
            params.setSkusList(skuList).setType(BillingClient.SkuType.INAPP);
            billingClient.querySkuDetailsAsync(params.build(),
                    new SkuDetailsResponseListener() {
                        @Override
                        public void onSkuDetailsResponse(BillingResult billingResult,
                                                         List<SkuDetails> skuDetailsList) {
                            // Process the result.
                            if (billingResult.getResponseCode() == BillingClient.BillingResponseCode.OK && skuDetailsList != null) {
                                for (SkuDetails skuDetails : skuDetailsList) {
                                    String sku = skuDetails.getSku();
                                    String price = skuDetails.getPrice();

                                    if("premium".equals(sku)) {
                                        skuDetailsPremium = skuDetails;
                                    }
                                }
                            }
                            else {
                            }
                        }
                    });

            // SkuDetails object obtained above.

                        BillingFlowParams purchaseParams =
                                BillingFlowParams.newBuilder()
                                        .setSkuDetails(skuDetailsPremium)
                                        .build();

            billingClient.launchBillingFlow(premiumActivity.this, purchaseParams);

            // Purchase is handled in onPurchasesUpdated illustrated in the previous section.


        }
        else if(view.getId() == R.id.couponButton){
            ((MainActivity)MainActivity.mContext).changeWebviewURL("http://geumat.iwinv.net/#/coupon");
            finish();
        }

    }


    /* onPurchasesUpdated
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (!bp.handleActivityResult(requestCode, resultCode, data)) {
            super.onActivityResult(requestCode, resultCode, data);
        }
    }
     */



    @Override
    public void onPurchasesUpdated(@NonNull BillingResult billingResult, @Nullable List<Purchase> list) {
        if (billingResult.getResponseCode() == BillingClient.BillingResponseCode.OK
                && list != null) {
            for (Purchase purchase : list) {
                consumePurchase(purchase.getPurchaseToken());

                // 이 메소드는 구매 '성공'시에만 호출된다.
                //if (productId.equals("premium")) {
                Toast.makeText(this, "프리미엄 결제가 완료 되었습니다 :) ", Toast.LENGTH_LONG).show();

                // * 광고 제거는 1번 구매하면 영구적으로 사용하는 것이므로 consume하지 않지만,
                // 만약 게임 아이템 100개를 주는 것이라면 아래 메소드를 실행시켜 다음번에도 구매할 수 있도록 소비처리를 해줘야한다.
                //bp.consumePurchase("premium");

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
        } else if (billingResult.getResponseCode() == BillingClient.BillingResponseCode.USER_CANCELED) {
            // Handle an error caused by a user cancelling the purchase flow.
            Toast.makeText(this, "프리미엄 결제가 취소 되었습니다 :) ", Toast.LENGTH_LONG).show();
        } else {
            // Handle any other error codes.
            Toast.makeText(this, "이미 보유한 상품이라고 뜨면 잠시 후 다시 시도해보세요! 추가구매가 가능합니다", Toast.LENGTH_LONG).show();
        }
    }

    public void consumePurchase(String purchaseToken) {
        ConsumeParams consumeParams =
                ConsumeParams.newBuilder()
                        .setPurchaseToken(purchaseToken)
                        .build();
        //Toast.makeText(this, "프리미엄 컨슘", Toast.LENGTH_LONG).show();
    }
}




