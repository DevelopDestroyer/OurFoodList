package com.th.geumat.ui.dashboard;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.ViewModelProviders;

import com.th.geumat.MainActivity;
import com.th.geumat.R;

//맛집등록 프레그먼트
public class DashboardFragment extends Fragment {

    private DashboardViewModel dashboardViewModel;

    public View onCreateView(@NonNull LayoutInflater inflater,
            ViewGroup container, Bundle savedInstanceState) {
        dashboardViewModel =
                ViewModelProviders.of(this).get(DashboardViewModel.class);
        View root = inflater.inflate(R.layout.fragment_dashboard, container, false);

        ((MainActivity)getActivity()).changeWebviewURL("http://geumat.iwinv.net/#/registRestaurant");
        ((MainActivity)getActivity()).loadAd();

        return root;
    }
}