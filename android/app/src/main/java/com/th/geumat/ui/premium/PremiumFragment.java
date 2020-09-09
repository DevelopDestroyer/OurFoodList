package com.th.geumat.ui.premium;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

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
        ((MainActivity)getActivity()).loadAd();

        return root;
    }
}