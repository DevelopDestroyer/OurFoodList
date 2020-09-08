package com.th.geumat.ui.notificationsq;

import androidx.lifecycle.LiveData;
import androidx.lifecycle.MutableLiveData;
import androidx.lifecycle.ViewModel;

public class NotificationsqViewModel extends ViewModel {

    private MutableLiveData<String> mText;

    public NotificationsqViewModel() {
        mText = new MutableLiveData<>();
        mText.setValue("돼냐");
    }

    public LiveData<String> getText() {
        return mText;
    }
}