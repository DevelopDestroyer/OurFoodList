package com.th.geumat.ui.home;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.ViewModelProviders;

import com.th.geumat.MainActivity;
import com.th.geumat.R;

//맛집지도 프레그먼트
public class HomeFragment extends Fragment {

    private HomeViewModel homeViewModel;

    public View onCreateView(@NonNull LayoutInflater inflater,
            ViewGroup container, Bundle savedInstanceState) {
        homeViewModel =
                ViewModelProviders.of(this).get(HomeViewModel.class);
        View root = inflater.inflate(R.layout.fragment_home, container, false);

        ((MainActivity)getActivity()).changeWebviewURL("http://geumat.iwinv.net/#/");
        ((MainActivity)getActivity()).loadAd();

        return root;
    }
}