package myudfs;

import java.io.IOException;

import org.apache.pig.EvalFunc;
import org.apache.pig.data.Tuple;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class LibMenTH extends EvalFunc<String> {
	public String exec(Tuple input) throws IOException {
		JSONObject jsonObj;
		try {
			jsonObj = new JSONObject((String) input.get(0).toString());
			JSONObject member_param =  jsonObj.getJSONObject("member_param");
		    JSONArray arrvalue =  (JSONArray)member_param.get("value");
		    JSONArray myArray = new JSONArray();
		    JSONObject testparams = new JSONObject();
		    for (int i = 0 ; i < arrvalue.length(); i++) {
		    	JSONArray arr1 =  (JSONArray)arrvalue.getJSONArray(i);
		    	JSONObject j = new JSONObject();
		    	//String member_name
		    	j.put("member_role_id",arr1.get(0));
		    	j.put("member_name",String.valueOf(arr1.get(1)));
		    	j.put("member_level",arr1.get(2));
		    	j.put("member_vip",arr1.get(6));
		    	j.put("join_time",arr1.get(10));
		    	j.put("last_login",arr1.get(11));
		    	j.put("member_can_reap_flag",arr1.get(12));
		    	myArray.put(j);
		    }
		    testparams.put("value", myArray);
		    return testparams.toString();
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
    	
       return null;
	}
}
