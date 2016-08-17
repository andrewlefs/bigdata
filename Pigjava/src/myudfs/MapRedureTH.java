package myudfs;

import java.io.EOFException;
import java.io.IOException;
import java.util.HashMap;
import java.util.Iterator;
import java.util.List;
import java.util.Map;

import myudfs.JsonMap.ERRORS;

import org.apache.pig.EvalFunc;
import org.apache.pig.data.BagFactory;
import org.apache.pig.data.DataBag;
import org.apache.pig.data.Tuple;
import org.apache.pig.data.TupleFactory;
import org.json.JSONArray;
import org.json.JSONObject;

import com.fasterxml.jackson.core.JsonParseException;
import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.JsonMappingException;
import com.fasterxml.jackson.databind.ObjectMapper;

public class MapRedureTH extends  EvalFunc<Map<String, Object>>{
	public static enum ERRORS {
        JSONParseError, JSONMappingError, EOFError, GenericError
    };

    private static final BagFactory bagFactory = BagFactory.getInstance();
    protected static final TupleFactory tupleFactory = TupleFactory.getInstance();
    protected final ObjectMapper jsonMapper = new ObjectMapper();
    @SuppressWarnings("unchecked")
    private DataBag convertListToBag(List<Object> l) {
        DataBag dbag = bagFactory.newDefaultBag();
        Tuple t = tupleFactory.newTuple();
        for (Object o : l) {
            if (o instanceof List) {
                dbag.addAll(convertListToBag((List<Object>) o));
            } else {
                t.append(o);
            }
        }

        if (t.size() > 0) {
            dbag.add(t);
        }

        return dbag;
    }

    /**
     * Convert map and its values to types that Pig can handle
     * 
     * @param m
     * @return
     */
    @SuppressWarnings("unchecked")
    protected Map<String, Object> makeSafe(Map<String, Object> m) {
        Map<String, Object> safeValues = new HashMap<String, Object>();
        for (Map.Entry<String, Object> entry : m.entrySet()) {
            Object v = entry.getValue();
            if (v != null && v instanceof List) {
                DataBag db = convertListToBag((List<Object>) v);
                safeValues.put(entry.getKey(), db);
            } else if (v != null && v instanceof Map) {
                safeValues.put(entry.getKey(), makeSafe((Map<String, Object>) v));
            } else {
                safeValues.put(entry.getKey(), entry.getValue());
            }
        }

        return safeValues;
    }

    public Map<String, Object> exec(Tuple input) throws IOException {
        try {
        	JSONObject jsonObj = new JSONObject((String) input.get(0).toString());
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
    	    
    	    //String strex = "{\"SV\":1,\"AD\":[{\"ID\":\"46931606\",\"C1\":\"46\",\"C2\":\"469\",\"ST\":\"46931\",\"PO\":1},{\"ID\":\"46721489\",\"C1\":\"46\",\"C2\":\"467\",\"ST\":\"46721\",\"PO\":5}]}";
    	    //JSONObject jsonObjtest = new JSONObject(strex);
    	    
    	    Map<String, Object> values = jsonMapper.readValue((String) testparams.toString(),new TypeReference<Map<String, Object>>() {});
    	    
            // Map<String, Object> values = jsonMapper.readValue((String) input.get(0),
    	    return makeSafe(values);
           // return makeSafe(values);
        } catch (Exception e) {
            warn("Generic error during JSON mapping", ERRORS.GenericError);
        }
        return null;
    }
}
