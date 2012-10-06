package com.ris.taptotrack;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

public class Frag1 extends Fragment
{
	public View layout1;
	public View onCreateView(LayoutInflater inflater, ViewGroup container,Bundle savedInstanceState) 
	{
		if (container == null) 
            return null;
		layout1 = inflater.inflate(R.layout.layout_1, container, false);
		return layout1;
	}
}