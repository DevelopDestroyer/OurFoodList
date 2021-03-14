package com.th.geumat.ui;

import android.app.Activity;
import android.content.Context;
import android.widget.Toast;

import androidx.annotation.Nullable;

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

import java.util.ArrayList;
import java.util.List;

public class Seller  implements PurchasesUpdatedListener {
    private final Context ctx;
    private BillingClient mBillingClient;

    // 아이템 상세정보 리스트
    private List<SkuDetails> mSkuDetailsList_item;

    // 아이템 소비 리스너
    private ConsumeResponseListener mConsumeListener;

    public Seller(Context ctx) {
        this.ctx = ctx;
        System.out.println("구글 결제 매니저를 초기화 하고 있습니다.");

        mBillingClient = BillingClient.newBuilder(ctx).setListener(this).enablePendingPurchases().build();
        mBillingClient.startConnection(new BillingClientStateListener() {
            @Override
            public void onBillingSetupFinished(BillingResult billingResult) {
                if (billingResult.getResponseCode() == BillingClient.BillingResponseCode.OK) {
                    System.out.println("구글 결제 서버에 접속을 성공하였습니다.");
                    getSkuDetailList();

                    // 아이템 결제 히스토리 가져옴
                    Purchase.PurchasesResult result_item = mBillingClient.queryPurchases(BillingClient.SkuType.INAPP);

                    // 소모가 안된 상품 존재시 - 리스트에 아이템이 존재하게 된다
                    List<Purchase> list_item = result_item.getPurchasesList();

                    for (int i = 0; i < list_item.size(); i++) {
                        Purchase purchase = list_item.get(i);
                        // 계속 보류중일때
                        if (purchase.getPurchaseState() != Purchase.PurchaseState.PURCHASED) {
                            // 카드사 승인중인 결제 또는 결제 보류중
                        } else {
                            // 결제 승인된 경우
                            handlePurchase(list_item.get(i));
                        }
                    }
                } else {
                    System.out.println("구글 결제 서버 접속에 실패하였습니다.\n오류코드: " + billingResult.getResponseCode());
                    // case 구글 플레이스토어 계정 정보 인식 안될 때
                }
            }

            @Override
            public void onBillingServiceDisconnected() {
                System.out.println("구글 결제 서버와 접속이 끊어졌습니다.");
            }
        });

        // 상품 소모결과 리스너
        mConsumeListener = new ConsumeResponseListener() {
            @Override
            public void onConsumeResponse(BillingResult billingResult, String purchaseToken) {
                if (billingResult.getResponseCode() == BillingClient.BillingResponseCode.OK) {
                    System.out.println("상품을 성공적으로 소모하였습니다. 소모된 상품 => " + purchaseToken);
                    return;
                } else {
                    System.out.println("상품 소모에 실패하였습니다. 오류코드 (" + billingResult.getResponseCode() + "), 대상 상품 코드: " + purchaseToken);
                    return;
                }
            }
        };
    }

    // 구입 가능한 상품의 리스트를 받아 오는 메소드
    private void getSkuDetailList() {
        // 구글 상품 정보들의 ID를 만들어 줌
        List<String> Sku_ID_List_INAPP = new ArrayList<>();

        Sku_ID_List_INAPP.add("premium");

        // SkuDetailsList 객체를 만듬
        SkuDetailsParams.Builder params_item = SkuDetailsParams.newBuilder();
        params_item.setSkusList(Sku_ID_List_INAPP).setType(BillingClient.SkuType.INAPP);

        // 비동기 상태로 앱의 정보를 가지고 옴
        mBillingClient.querySkuDetailsAsync(params_item.build(), new SkuDetailsResponseListener() {
            @Override
            public void onSkuDetailsResponse(BillingResult billingResult, List<SkuDetails> skuDetailsList) {
                // 상품 정보를 가지고 오지 못한 경우
                if (billingResult.getResponseCode() != BillingClient.BillingResponseCode.OK) {
                    System.out.println("(인앱) 상품 정보를 가지고 오던 중 오류가 발생했습니다.\n오류코드: " + billingResult.getResponseCode());
                    return;
                }
                if (skuDetailsList == null) {
                    System.out.println("(인앱) 상품 정보가 존재하지 않습니다.");
                    return;
                }
                //응답 받은 데이터들의 숫자를 출력
                System.out.println("(인앱) 응답 받은 데이터 숫자: " + skuDetailsList.size());

                //받아온 상품 정보를 차례로 호출
                for (int sku_idx = 0; sku_idx < skuDetailsList.size(); sku_idx++) {
                    //해당 인덱스의 객체를 가지고 옴
                    SkuDetails _skuDetail = skuDetailsList.get(sku_idx);
                    //해당 인덱스의 상품 정보를 출력
                    System.out.println( _skuDetail.getSku() + ": " + _skuDetail.getTitle() + ", " + _skuDetail.getPrice());
                    System.out.println(_skuDetail.getOriginalJson());
                }

                //받은 값을 멤버 변수로 저장
                mSkuDetailsList_item = skuDetailsList;
            }
        });
    }

    //실제 구입 처리를 하는 메소드
    public void purchase(String item, Activity act) {
        SkuDetails skuDetails = null;
        if (null != mSkuDetailsList_item) {
            for (int i = 0; i < mSkuDetailsList_item.size(); i++) {
                SkuDetails details = mSkuDetailsList_item.get(i);
                if (details.getSku().equals(item)) {
                    skuDetails = details;
                    break;
                }
            }

            BillingFlowParams flowParams = BillingFlowParams.newBuilder()
                    .setSkuDetails(skuDetails)
                    .build();
            mBillingClient.launchBillingFlow(act, flowParams);
        }
    }
    // 결제 요청 후 상품에대해 소비시켜주는 함수
    void handlePurchase(Purchase purchase) {
        if (purchase.getPurchaseState() == Purchase.PurchaseState.PURCHASED) {

            // 인앱 소비
            // TODO 인앱 구매 결과전송 함수 호출
            ConsumeParams consumeParams =
                    ConsumeParams.newBuilder()
                            .setPurchaseToken(purchase.getPurchaseToken())
                            .build();
            mBillingClient.consumeAsync(consumeParams, mConsumeListener);

        } else if (purchase.getPurchaseState() == Purchase.PurchaseState.PENDING) {
            // Here you can confirm to the user that they've started the pending
            // purchase, and to complete it, they should follow instructions that
            // are given to them. You can also choose to remind the user in the
            // future to complete the purchase if you detect that it is still
            // pending.
            // ex 해당 아이템에 대해 소모되지 않은 결제가 있을시
        }
    }
    @Override
    public void onPurchasesUpdated(BillingResult billingResult, @Nullable List<Purchase> purchases) {
        //결제에 성공한 경우
        if (billingResult.getResponseCode() == BillingClient.BillingResponseCode.OK && purchases != null) {
            System.out.println( "결제에 성공했으며, 아래에 구매한 상품들이 나열됨");
            for (Purchase _pur : purchases) {
                System.out.println( "purchases: " + purchases);
                handlePurchase(_pur);
            }
        }

        // 사용자가 결제를 취소한 경우
        else if (billingResult.getResponseCode() == BillingClient.BillingResponseCode.USER_CANCELED) {
            System.out.println( "사용자에 의해 결제취소");
        }

        // 그 외에 다른 결제 실패 이유
        else {
            System.out.println( "결제가 취소 되었습니다. 종료코드: " + billingResult.getResponseCode());
            if (billingResult.getResponseCode() == BillingClient.BillingResponseCode.ITEM_ALREADY_OWNED) {
                // ex 해당 아이템에 대해 소모되지 않은 결제가 있을시
            }
        }
    }


}
