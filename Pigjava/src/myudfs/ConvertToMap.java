package myudfs;
import java.io.IOException;
import org.apache.pig.EvalFunc;

import java.util.Map;
import java.util.HashMap;
import java.util.Iterator;
import org.apache.pig.data.Tuple;
import org.apache.pig.data.DataBag;

import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.ObjectMapper;

public class ConvertToMap extends EvalFunc<Map>{
	
	public Map exec(Tuple input) throws IOException {
		String json = (String) input.get(0).toString();
		
		ObjectMapper mapper = new ObjectMapper();

		Map<String, Object> map = new HashMap<String, Object>();

		// convert JSON string to Map
		map = mapper.readValue(json, new TypeReference<Map<String, String>>(){});
		return map;
    }
}
