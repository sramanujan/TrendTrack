package com.ris.taptotrack;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;
import java.util.Vector;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.protocol.HTTP;
import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;
import org.xml.sax.InputSource;
import org.xml.sax.SAXException;

import android.content.Context;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.graphics.PorterDuff;
import android.graphics.PorterDuffColorFilter;
import android.os.Bundle;
import android.os.StrictMode;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.ViewPager;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.PopupWindow;
import android.widget.Toast;

public class TapUI extends FragmentActivity 
{
	public static final String ClientID = "01";
	
	public static final String PREFS_NAME = "TTTPrefs";
	
    private String remoteAddr;
    
    private String APIKey;
    
    private String[] buttonNames;
    private int[] buttonColors;
    private String[] categoryStrings;
    private int[] categoryCounts;
    
    Frag1 frag1;
    Frag2 frag2;
    private PagerAdapter mPagerAdapter;
    private PopupWindow popUp;
    private View layout;
    
    @Override
    public void onCreate(Bundle savedInstanceState) 
    {

        
		if (android.os.Build.VERSION.SDK_INT > 9) 
		{
		      StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
		      StrictMode.setThreadPolicy(policy);
		}
		
		SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
		
		remoteAddr = settings.getString("remoteAddr", "http://1.23.205.210/~sramanujan/Serial/");
		
		APIKey = settings.getString("APIKey", "AIzaSyAXzcxp0IQ1S8aHhxpAWtQPE8hbjumzzNk");
		
		buttonNames = new String[8];
		buttonColors = new int[8];
		categoryStrings = new String[16];
		categoryCounts = new int[16];
		
		int i;
		for(i=0;i<8;i++)
		{
			buttonNames[i] = settings.getString("buttonNames"+i, "BTN"+i);
			buttonColors[i] = settings.getInt("buttonColors"+i, Color.DKGRAY);
		}
		
		for(i=0;i<16;i++)
			categoryStrings[i] = settings.getString("categoryStrings"+i, "Category"+i);
		
		frag1 = new Frag1();
		frag2 = new Frag2();
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tap_ui);
		this.initialisePaging();
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu)
    {
    	menu.add(1,1,Menu.FIRST,"Change Server IP");
    	menu.add(1,2,Menu.FIRST+1,"Refresh/Update");
    	return true;
    }
    
    @Override
    public boolean onOptionsItemSelected(MenuItem item)
    {
		switch(item.getItemId())
		{
			case 1:
		        LayoutInflater inflater = (LayoutInflater) TapUI.this.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
		        layout = inflater.inflate(R.layout.layout_settings,(ViewGroup) findViewById(R.id.settingslayout));
		        ((EditText)layout.findViewById(R.id.iptext)).setText(remoteAddr);
		        popUp = new PopupWindow(layout, 550, 280, true);
		        popUp.showAtLocation(layout, Gravity.CENTER, 0, 0);
		        Button saveButton = (Button) layout.findViewById(R.id.savebtn);
		        saveButton.setOnClickListener(new OnClickListener() 
		        {
		            public void onClick(View v) 
		            {
		            	remoteAddr = ((EditText) layout.findViewById(R.id.iptext)).getText().toString();
		                SharedPreferences settings = getSharedPreferences(PREFS_NAME, 0);
		                SharedPreferences.Editor editor = settings.edit();
		                editor.putString("remoteAddr", remoteAddr);
		                editor.commit();
		                retrieveSettings();
		                //setSettings();
		        		popUp.dismiss();
		            }
		        });
			return true;
			case 2:
				setSettings();
			return true;
		}
		return super.onOptionsItemSelected(item);
    }
    
    private void retrieveSettings()
    {
		try 
		{  
		    URL url = new URL(remoteAddr+"settings"+ClientID+".xml");
    		DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
    		DocumentBuilder db = dbf.newDocumentBuilder();
    		Document doc = db.parse(new InputSource(url.openStream()));
    		doc.getDocumentElement().normalize();

    		APIKey = ((Element)doc.getElementsByTagName("clientsetting").item(0)).getAttribute("APIKey");
    		
    		NodeList buttonList = doc.getElementsByTagName("button");
    		NodeList categoryList = doc.getElementsByTagName("category");
		    int j;
		    
		    for(j=0;j<8;j++)
		    {
		    	buttonNames[j] = ((Element)buttonList.item(j)).getAttribute("name");
		    	buttonColors[j] = Color.parseColor(((Element)buttonList.item(j)).getAttribute("color"));
		    }
		    for(j=0;j<16;j++)
		    	categoryStrings[j] = ((Element)categoryList.item(j)).getAttribute("name");  
		} 
		catch (MalformedURLException e) 
		{
			Toast.makeText(this, "Please check the URL -> "+remoteAddr, Toast.LENGTH_LONG).show();
		} 
		catch (IOException e) 
		{
			Toast.makeText(this, "File settings"+ClientID+".xml not accessible at "+remoteAddr, Toast.LENGTH_LONG).show();
		} 
		catch (SAXException e) 
		{
			Toast.makeText(this, "The xml at "+remoteAddr+"settings"+ClientID+".xml is not well formed!", Toast.LENGTH_LONG).show();
		} 
		catch (ParserConfigurationException e) 
		{
			Toast.makeText(this, "Remote address44 is: "+remoteAddr, Toast.LENGTH_SHORT).show();
		}
    }
    
    private void setSettings()
    {
    	int i;
    	PorterDuffColorFilter filter;
	    for(i=0;i<8;i++)
	    {
	    	filter = new PorterDuffColorFilter(buttonColors[i], PorterDuff.Mode.SRC_ATOP);
	    	((Button)frag1.layout1.findViewById(R.id.b000+i)).setText(buttonNames[i]);
	    	frag1.layout1.findViewById(R.id.b000+i).getBackground().setColorFilter(filter);
	    	((Button)frag2.layout2.findViewById(R.id.b100+i)).setText(buttonNames[i]);
	    	frag2.layout2.findViewById(R.id.b100+i).getBackground().setColorFilter(filter);
	    }
    }
    
    
	private void initialisePaging() 
	{
		List<Fragment> fragments = new Vector<Fragment>();
		fragments.add(frag1);
		fragments.add(frag2);
		this.mPagerAdapter  = new PagerAdapter(super.getSupportFragmentManager(), fragments);
		ViewPager pager = (ViewPager)super.findViewById(R.id.pager);
		pager.setAdapter(this.mPagerAdapter);
		pager.setOffscreenPageLimit(2);
	}
	
	public class PagerAdapter extends FragmentPagerAdapter 
	{
		private List<Fragment> fragments;
		public PagerAdapter(FragmentManager fm, List<Fragment> fragments) 
		{
			super(fm);
			this.fragments = fragments;
		}
		@Override
		public Fragment getItem(int position) 
		{
			return this.fragments.get(position);
		}
		@Override
		public int getCount() 
		{
			return this.fragments.size();
		}
	}

	public void onClick(View v) throws ClientProtocolException, IOException 
	{
		categoryCounts[v.getId()-R.id.b000]++;
		
		HttpClient client = new DefaultHttpClient(); 
        HttpPost post = new HttpPost("https://www.googleapis.com/fusiontables/v1/query"); 
        List<NameValuePair> nvps = new ArrayList<NameValuePair>(2); 
        nvps.add(new BasicNameValuePair("sql", "INSERT INTO 1JHGUdqD7FW9aLTxswbtcfwmPAYr7FFKtuFO_UMk (Text, Number, Location, Date) VALUES ('asdf',16,'location','02/02/02')"));
        //nvps.add(new BasicNameValuePair("sql", "SELECT * FROM 1JHGUdqD7FW9aLTxswbtcfwmPAYr7FFKtuFO_UMk")); 
        nvps.add(new BasicNameValuePair("key", "AIzaSyAXzcxp0IQ1S8aHhxpAWtQPE8hbjumzzNk")); 
        post.setEntity(new UrlEncodedFormEntity(nvps, HTTP.UTF_8)); 
        HttpResponse response = client.execute(post); 
        
        
        BufferedReader br = new BufferedReader(new InputStreamReader(response.getEntity().getContent()));
        String in = "",tot="";
        while ((in = br.readLine()) != null) 
        {
            tot=tot+in;
        }

		Toast.makeText(this, tot+"    Done! "+remoteAddr+": Ready!!", Toast.LENGTH_LONG).show();
		
	}
    
}