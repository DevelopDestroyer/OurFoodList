package com.th.geumat.ui.premium;

import android.app.Activity;
import android.content.Context;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.Observer;
import androidx.lifecycle.ViewModelProviders;

import com.th.geumat.MainActivity;
import com.th.geumat.R;

//프리미엄 프레그먼트
public class PremiumFragment extends Fragment {

    private PremiumViewModel preemiumViewModel;

    public View onCreateView(@NonNull LayoutInflater inflater,
            ViewGroup container, Bundle savedInstanceState) {
        preemiumViewModel =
                ViewModelProviders.of(this).get(PremiumViewModel.class);
        View root = inflater.inflate(R.layout.fragment_notificationsq, container, false);


        ((MainActivity)getActivity()).movePremiumActivity();
        //((MainActivity)getActivity()).savePremium();
        ((MainActivity)getActivity()).loadAd();


        

        return root;
    }
/*
    public void btnClick(View view){
        if(view.getId() == R.id.preButton){
            Toast.makeText((MainActivity)getActivity(), "프리미엄 결제가 완료 되었습니다.", Toast.LENGTH_LONG).show();

        }
        else if(view.getId() == R.id.couponButton){
            Toast.makeText((MainActivity)getActivity(), "쿠폰이 정상적으로 사용 되었습니다.", Toast.LENGTH_LONG).show();

        }
    }
*/
}