package com.th.geumat.ui.notificationsq;

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

import com.th.geumat.R;

public class NotificationsqFragment extends Fragment {

    private NotificationsqViewModel notificationsqViewModel;

    public View onCreateView(@NonNull LayoutInflater inflater,
            ViewGroup container, Bundle savedInstanceState) {
        System.out.println("왜안대냐");
        notificationsqViewModel =
                ViewModelProviders.of(this).get(NotificationsqViewModel.class);
        View root = inflater.inflate(R.layout.fragment_notificationsq, container, false);
        final TextView textView = root.findViewById(R.id.text_notificationsq);
        notificationsqViewModel.getText().observe(getViewLifecycleOwner(), new Observer<String>() {
            @Override
            public void onChanged(@Nullable String s) {
                textView.setText(s);
            }
        });
        return root;
    }
}