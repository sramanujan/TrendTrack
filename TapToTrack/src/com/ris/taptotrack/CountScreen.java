package com.ris.taptotrack;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.Timer;
import java.util.TimerTask;

import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.StatusLine;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.ConnectivityManager;
import android.os.Bundle;
import android.os.Handler;
import android.os.Vibrator;
import android.view.Display;
import android.view.KeyEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.WindowManager;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.Toast;
import android.widget.ViewFlipper;

import com.ris.taptotrack.CustomMenu.OnMenuItemSelectedListener;
public class CountScreen extends Activity implements OnMenuItemSelectedListener
{
    private CustomMenu mMenu;
    ViewFlipper viewFlipper;
    private static final int HTTP_STATUS_OK = 200;
    public static final int MENU_ITEM_1 = 1;
    public static final int MENU_ITEM_2 = 2;
    public static final int MENU_ITEM_3 = 3;
    public static final int MENU_ITEM_4 = 4;
    private Animation slideLeftIn;
    private Animation slideLeftOut;
    private Animation slideRightIn;
    private Animation slideRightOut;
    public static Context context1;
    
    View.OnTouchListener gestureListener;

    static String COUNT = "tttcount.txt";
    int width;
    int cnt[] = new int[12];
    String storeid="";
    String data="";
    ArrayList<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>();
    HttpClient httpclient = new DefaultHttpClient();
    HttpPost httppost;
    TimerTask sendTask;
    boolean safesend;
    final Handler handler = new Handler();
    Timer t = new Timer();
    Thread thread;
    @Override
    public void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.countscr);

        viewFlipper = (ViewFlipper)findViewById(R.id.flipper);
        slideLeftIn = AnimationUtils.loadAnimation(this, R.anim.slide_left_in);
        slideLeftOut = AnimationUtils.loadAnimation(this, R.anim.slide_left_out);
        slideRightIn = AnimationUtils.loadAnimation(this, R.anim.slide_right_in);
        slideRightOut = AnimationUtils.loadAnimation(this, R.anim.slide_right_out);

        mMenu = new CustomMenu(this, this, getLayoutInflater());
        mMenu.setHideOnSelect(true);
        mMenu.setItemsPerLineInPortraitOrientation(4);
        mMenu.setItemsPerLineInLandscapeOrientation(8);
        loadMenuItems();
        
        Display display = ((WindowManager)getSystemService(WINDOW_SERVICE)).getDefaultDisplay();
        width = display.getWidth();
        Button mobutton = (Button) this.findViewById(R.id.mobutton);
        mobutton.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('A');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        Button mabutton = (Button) this.findViewById(R.id.mabutton);
        mabutton.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('B');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        Button mybutton = (Button) this.findViewById(R.id.mybutton);
        mybutton.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('C');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        Button fobutton = (Button) this.findViewById(R.id.fobutton);
        fobutton.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('D');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        Button fabutton = (Button) this.findViewById(R.id.fabutton);
        fabutton.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('E');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        Button fybutton = (Button) this.findViewById(R.id.fybutton);
        fybutton.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('F');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        Button mobutton1 = (Button) this.findViewById(R.id.mobutton1);
        mobutton1.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('G');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        Button mabutton1 = (Button) this.findViewById(R.id.mabutton1);
        mabutton1.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('H');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        Button mybutton1 = (Button) this.findViewById(R.id.mybutton1);
        mybutton1.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('I');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        Button fobutton1 = (Button) this.findViewById(R.id.fobutton1);
        fobutton1.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('J');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        Button fabutton1 = (Button) this.findViewById(R.id.fabutton1);
        fabutton1.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('K');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        Button fybutton1 = (Button) this.findViewById(R.id.fybutton1);
        fybutton1.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                vibrator.vibrate(50);
                    try
                    {
                        FileOutputStream fos = openFileOutput(COUNT, Context.MODE_APPEND);
                        fos.write('L');
                        fos.close();
                    }
                    catch(FileNotFoundException e) {}
                    catch (IOException e) {};
            }
        });
        sendTask = new TimerTask()
        {
            public void run()
            {
                handler.post(new Runnable()
                {
                    public void run()
                    {
                        thread = new Thread(null, dosendBackground,"Background");
                		thread.start();
                    }
                });
            }
        };
        t.schedule(sendTask,500,60000);
    }
    private Runnable dosendBackground = new Runnable()
    {
    	public void run()
    	{
    		sendBackground();
    	}
    };
    private void sendBackground()
    {
    	String vibratorService = Context.VIBRATOR_SERVICE;
        final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
        @SuppressWarnings("unused")
		Thread thread;
        SharedPreferences settings = getSharedPreferences(SettingsScreen.SETTINGS, 0);
        storeid = settings.getString("storeid", "rf_mantri");
        boolean con = checkConnectivity("http://www.ris.eu.pn/cpcsqldb.php");safesend=false;
        if(con)
        {
        	try
            {
                FileInputStream fis = openFileInput(COUNT);
                InputStreamReader inputreader = new InputStreamReader(fis);
                BufferedReader buffreader = new BufferedReader(inputreader);
                data = buffreader.readLine();
                for(int c=0;c<12;c++)
                	cnt[c]=0;
                for(int l=0;l<data.length();l++)
                {
                	switch(data.charAt(l))
                	{
                	case 'A':cnt[0]++;break;
                	case 'B':cnt[1]++;break;
                	case 'C':cnt[2]++;break;
                	case 'D':cnt[3]++;break;
                	case 'E':cnt[4]++;break;
                	case 'F':cnt[5]++;break;
                	case 'G':cnt[6]++;break;
                	case 'H':cnt[7]++;break;
                	case 'I':cnt[8]++;break;
                	case 'J':cnt[9]++;break;
                	case 'K':cnt[10]++;break;
                	case 'L':cnt[11]++;break;
                	}
                }
                fis.close();
            }
            catch(FileNotFoundException e) {}
            catch (IOException e) {}
            httppost = new HttpPost("http://www.ris.eu.pn/cpcsqldb.php");
             
            nameValuePairs.add(new BasicNameValuePair("cnt0", Integer.toString(cnt[0])));
            nameValuePairs.add(new BasicNameValuePair("cnt1", Integer.toString(cnt[1])));
            nameValuePairs.add(new BasicNameValuePair("cnt2", Integer.toString(cnt[2])));
            nameValuePairs.add(new BasicNameValuePair("cnt3", Integer.toString(cnt[3])));
            nameValuePairs.add(new BasicNameValuePair("cnt4", Integer.toString(cnt[4])));
            nameValuePairs.add(new BasicNameValuePair("cnt5", Integer.toString(cnt[5])));
            nameValuePairs.add(new BasicNameValuePair("cnt6", Integer.toString(cnt[6])));
            nameValuePairs.add(new BasicNameValuePair("cnt7", Integer.toString(cnt[7])));
            nameValuePairs.add(new BasicNameValuePair("cnt8", Integer.toString(cnt[8])));
            nameValuePairs.add(new BasicNameValuePair("cnt9", Integer.toString(cnt[9])));
            nameValuePairs.add(new BasicNameValuePair("cnt10", Integer.toString(cnt[10])));
            nameValuePairs.add(new BasicNameValuePair("cnt11", Integer.toString(cnt[11])));
            nameValuePairs.add(new BasicNameValuePair("db",storeid));
            
            try
            {
                httppost.setEntity(new UrlEncodedFormEntity(nameValuePairs));
            }
            catch (UnsupportedEncodingException e1)
            {
                e1.printStackTrace();
            }
			try 
			{
				httpclient.execute(httppost);safesend=true;
			} 
			catch (ClientProtocolException e) 
			{
				Toast.makeText(getApplicationContext(),"Sending Error...", 3).show();
			} 
			catch (IOException e) 
			{
				e.printStackTrace();
			}
            if(safesend)
            {
                try
                {
                    FileOutputStream fos = openFileOutput(COUNT, Context.MODE_PRIVATE);
                    fos.close();
                }
                catch(FileNotFoundException e) {}
                catch (IOException e) {}
            }
        }
        else
        {
          	vibrator.vibrate(1000);
        }
    }
    
    public boolean checkConnectivity(String host)
    {
    	String vibratorService = Context.VIBRATOR_SERVICE;
    	final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
    	ConnectivityManager con = (ConnectivityManager) getSystemService(Activity.CONNECTIVITY_SERVICE);
        if(con.getNetworkInfo(ConnectivityManager.TYPE_MOBILE).isConnectedOrConnecting())
        {
            HttpClient client = new DefaultHttpClient();
            HttpPost request = new HttpPost(host);
        	try 
            {
            	HttpResponse response = client.execute(request);  	
            	StatusLine status = response.getStatusLine();
            	if (status.getStatusCode() == HTTP_STATUS_OK) 
            		return true;   
            	else
            		return false; 
            } 
            catch (Exception e) 
            {
            	e.printStackTrace();
            	vibrator.vibrate(1000);
            	return false;
            }         
    	}
        else
        {
        	vibrator.vibrate(200);
        	return false;
        }
    }
    
    public boolean onKeyDown(int keyCode, KeyEvent event)
    {
        if (keyCode == KeyEvent.KEYCODE_MENU)
        {
            doMenu();
            return true; //always eat it!
        }
        else if (keyCode == KeyEvent.KEYCODE_VOLUME_UP)
        {
            viewFlipper.setInAnimation(slideLeftIn);
            viewFlipper.setOutAnimation(slideLeftOut);
            viewFlipper.showNext();
            return true; //always eat it!
        }
        else if (keyCode == KeyEvent.KEYCODE_VOLUME_DOWN)
        {
            viewFlipper.setInAnimation(slideRightIn);
            viewFlipper.setOutAnimation(slideRightOut);
            viewFlipper.showPrevious();
            return true; //always eat it!
        }
        
        return super.onKeyDown(keyCode, event);
    }
    private void loadMenuItems()
    {

        ArrayList<CustomMenuItem> menuItems = new ArrayList<CustomMenuItem>();
        CustomMenuItem cmi = new CustomMenuItem();
        cmi.setCaption("Settings");
        cmi.setImageResourceId(R.drawable.ic_menu_manage);
        cmi.setId(MENU_ITEM_1);
        menuItems.add(cmi);
        if (!mMenu.isShowing())
            try
            {
                mMenu.setMenuItems(menuItems);
            }
            catch (Exception e)
            {
                AlertDialog.Builder alert = new AlertDialog.Builder(this);
                alert.setTitle("Egads!");
                alert.setMessage(e.getMessage());
                alert.show();
            }
    }
    private void doMenu()
    {
        if (mMenu.isShowing())
        {
            mMenu.hide();
        }
        else
        {
            mMenu.show(findViewById(R.id.fobutton));
        }
    }
    public void MenuItemSelectedEvent(CustomMenuItem selection)
    {
        Intent intent1;
        switch(selection.getId())
        {
        case 1:
            intent1 = new Intent(this, SettingsScreen.class);
            startActivity(intent1);
            break;

        }
    }
}
