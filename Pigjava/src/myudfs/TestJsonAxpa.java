package myudfs;

import java.util.Arrays;

import org.json.JSONArray;
import org.json.JSONObject;

public class TestJsonAxpa {
	public static void main(String[] args) throws Exception {
	    String jsonStr = "{\"member_param\": {\"key\": {\"member_role_id\": 0,\"member_name\": 1,\"member_level\": 2,\"member_avatar\": 3,\"member_professional\": 4,\"member_post\": 5},\"value\": [[175, \"FUCKYOU\", 52, 51, 4, 3, 0, 194, 3674, 0, 1451790914, 1454026699, 1, 486539380, 0, 15342, 13263, []],[382, \"OHMYCHUỐI\", 50, 50, 2, 4, 0, 526, 616, 0, 1451981997, 1452157178, 1, 117440628, 0, 12797, 7217, []],[902, \"PiKaChu\", 52, 52, 4, 4, 2, 184, 1934, 0, 1451757955, 1452963535, 1, 201326708, 0, 20843, 15887, []]]} }";
	    String army_id = "2";
	    JSONObject jsonObj = new JSONObject(jsonStr);
	    
	    
	    JSONObject member_param =  jsonObj.getJSONObject("member_param");
	    JSONArray arrvalue =  (JSONArray)member_param.get("value");
	    JSONArray myArray = new JSONArray();
	    JSONObject testparams = new JSONObject();
	    String finishstring = "";
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
	    	//System.out.println(j.toString());
	    	//testparams.put(String.valueOf(arr1.get(0)),j);
	    	
	    }
	    System.out.println(myArray.toString());
	    /*
	    JSONObject finishvalue = new JSONObject();
	    finishvalue.put("value", testparams);
	    JSONObject finishmember_param = new JSONObject();
	    finishmember_param.put("member_param", finishvalue);
	    */
	    //System.out.println(finishmember_param.toString());
	}
}
