package com.ris.taptotrack;

import com.ris.taptotrack.R;
import android.app.Activity;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Vibrator;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;




public class SettingsScreen extends Activity
{
	static String SETTINGS = "TTTSETTINGS";
    static String ID_SETTING = "TTTID";
    String storeid="";
    @Override
    public void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.settingsscr);
        SharedPreferences settings = getSharedPreferences(SettingsScreen.SETTINGS, 0);
        storeid = settings.getString("storeid", "rf_mantri");
        final EditText storetext = (EditText)this.findViewById(R.id.storetext);
        storetext.setText(storeid);
        Button savebutton = (Button) this.findViewById(R.id.savebutton);
        savebutton.setOnClickListener(new OnClickListener()
        {
            public void onClick(View v)
            {
                String vibratorService = Context.VIBRATOR_SERVICE;
                final Vibrator vibrator = (Vibrator) getSystemService(vibratorService);
                try
                {
                    storeid=storetext.getText().toString();
                }
                catch(Exception e)
                {
                    vibrator.vibrate(50);
                    Toast.makeText(getApplicationContext(), "Enter valid settings please..",2).show();
                }
                if((storeid!="")&&(storeid!="UNKN"))
                {
                    SharedPreferences settings = getSharedPreferences(SETTINGS, 0);
                    SharedPreferences.Editor editor = settings.edit();
                    editor.putString("storeid",storeid);
                    editor.commit();
                    vibrator.vibrate(50);
                    Toast.makeText(getApplicationContext(),"Saving...", 2).show();
                	finish();
                }
                else
                {
                	Toast.makeText(getApplicationContext(), "Enter valid settings please..",2).show();
                }
            }
        });
    }
}
