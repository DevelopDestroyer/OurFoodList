package com.th.geumat.ui.notificationsq;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.ViewModelProviders;

import com.th.geumat.MainActivity;
import com.th.geumat.R;

//내정보 프레그먼트
public class NotificationsqFragment extends Fragment {

    private NotificationsqViewModel notificationsqViewModel;

    public View onCreateView(@NonNull LayoutInflater inflater,
            ViewGroup container, Bundle savedInstanceState) {
        notificationsqViewModel =
                ViewModelProviders.of(this).get(NotificationsqViewModel.class);
        View root = inflater.inflate(R.layout.fragment_notificationsq, container, false);

        ((MainActivity)getActivity()).changeWebviewURL("http://geumat.iwinv.net/#/profile/_my");
        ((MainActivity)getActivity()).loadAd();

        return root;
    }
}