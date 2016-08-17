package myudfs;
import java.io.IOException;
import java.util.Map;

import myudfs.JsonMap.ERRORS;

import org.apache.pig.EvalFunc;
import org.apache.pig.data.Tuple;
import org.codehaus.jackson.JsonParseException;
import org.codehaus.jackson.map.JsonMappingException;
import org.codehaus.jackson.map.ObjectMapper;

public class MapToJson extends EvalFunc<String>{
	private final ObjectMapper jsonMapper = new ObjectMapper();
	    
	    @SuppressWarnings("unchecked")
	    @Override
	    public String exec(Tuple input) throws IOException {
	        if (input == null || input.size() == 0) {
	            return null;
	        }
	
	        try {
	            String json = jsonMapper.writeValueAsString((Map<String,Object>)input.get(0));
	            return json;
	        } catch(JsonParseException e) {
	            pigLogger.warn(this, "JSON Parse Error", ERRORS.JSONParseError);
	        } catch(JsonMappingException e) {
	            pigLogger.warn(this, "JSON Mapping Error", ERRORS.JSONMappingError);
	        }
	        
	        return null;
	    }
}
