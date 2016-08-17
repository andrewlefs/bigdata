package myudfs;
import java.util.Map;
import java.util.Set;
public class MapKeysToBag extends MapFieldToBag {
	 @Override
	    public Set<String> getFieldSet(Map<String, Object> map) {
	        return map.keySet();
	    }   
}
