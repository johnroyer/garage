/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package hichannel_wmv;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;

/**
 *
 * @author zero
 */
public class Get {

    	public String go(String myUrl){
		String mpdata = "";

		// get media playter url
		try {
			URL player = new URL(myUrl);
			URLConnection conn = player.openConnection();
			BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
			String line = null;
			line = reader.readLine();
			while(line!=null){
				if( line.indexOf("param")!= -1 && line.indexOf("name=\"URL")!= -1){
					mpdata = line;
					break;
				}
				line = reader.readLine();
			}
			reader.close();
		} catch (MalformedURLException e) {
			// TODO Auto-generated catch block
			//System.out.println("網址錯誤\n");
                        return "網址錯誤";
			//e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			//e.printStackTrace();
		}
		if( mpdata == ""){
                        return "找不到影片位置";
			//System.exit(0);
		}
		String mpurl = "http://hichannel.hinet.net/2008olympic/";
		mpurl += mpdata.substring(mpdata.indexOf("value=\"")+7, mpdata.lastIndexOf("\""));

		//System.out.println("mpurl: " + mpurl);
		//System.out.println();


		// get wmv alocation
		String wmvloc = "";
		try {
			URL player = new URL(mpurl);
			URLConnection conn = player.openConnection();
			BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
			String line = null;
			line = reader.readLine();
			while(line!=null){
				if( line.indexOf("<REF")!= -1){
					//System.out.println("wmv line: " + line);
					wmvloc = line.substring(line.indexOf("\"")+1, line.lastIndexOf("\""));
					break;
				}
				line = reader.readLine();
			}
			reader.close();
		} catch (MalformedURLException e) {
			// TODO Auto-generated catch block
			//System.out.println("WMV 網址錯誤\n");
                        return "WMV 網址錯誤";
			//e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		//System.out.println("wmvloc: " + wmvloc);





		// get mms alocation
		String mms = "";
		try {
			URL player = new URL(wmvloc);
			URLConnection conn = player.openConnection();
			BufferedReader reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
			String line = null;
			line = reader.readLine();
			while(line!=null){
				if( line.indexOf("<Ref")!= -1){
					//System.out.println("wmv line: " + line);
					//System.out.println("line: " + line);
					mms = line.substring(line.indexOf("mms:"), line.lastIndexOf("\""));
					break;
				}
				line = reader.readLine();
			}
			reader.close();
		} catch (MalformedURLException e) {
			// TODO Auto-generated catch block
			//System.out.println("WMV2 網址錯誤\n");
			//e.printStackTrace();
                        return "WMV2 網址錯誤";
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		//System.out.println("mms: " + mms);

		return mms;
	}
    
}
