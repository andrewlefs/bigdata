package myudfs;
import java.util.Collection;
import java.util.HashSet;
import java.util.Map;
import java.util.Set;
public class MapValuesToBag extends MapFieldToBag{
	 @Override
	    public Set<?> getFieldSet(Map<String, Object> map) {
	        Collection<?> values = map.values();
	        Set<Object> valuesTyped = new HashSet<Object>(values);
	        return valuesTyped;
	    }
}
