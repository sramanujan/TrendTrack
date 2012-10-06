package com.ris.taptotrack;

import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

public class Frag2 extends Fragment
{
	public View layout2;
	public View onCreateView(LayoutInflater inflater, ViewGroup container,Bundle savedInstanceState) 
	{
		if (container == null) 
            return null;
		layout2 = inflater.inflate(R.layout.layout_2, container, false);
		return layout2;
	}
}