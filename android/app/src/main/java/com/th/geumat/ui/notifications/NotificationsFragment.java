package com.th.geumat.ui.notifications;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.lifecycle.ViewModelProviders;

import com.th.geumat.MainActivity;
import com.th.geumat.R;

//친구들맛집 프레그먼트
public class NotificationsFragment extends Fragment {

    private NotificationsViewModel notificationsViewModel;

    public View onCreateView(@NonNull LayoutInflater inflater,
            ViewGroup container, Bundle savedInstanceState) {

        notificationsViewModel =
                ViewModelProviders.of(this).get(NotificationsViewModel.class);
        View root = inflater.inflate(R.layout.fragment_notifications, container, false);

        ((MainActivity)getActivity()).changeWebviewURL("http://geumat.iwinv.net/#/newsfeed");
        ((MainActivity)getActivity()).loadAd();


        return root;
    }
}