package myudfs;

import java.io.IOException;
import java.util.Map;
import org.apache.pig.FilterFunc;
import org.apache.pig.PigException;
import org.apache.pig.backend.executionengine.ExecException;
import org.apache.pig.data.DataBag;
import org.apache.pig.data.Tuple;
import org.apache.pig.data.DataType;

/**
 * Determine whether a bag or map is empty.
 */
public class IsEmpty extends FilterFunc {
	
    @Override
    public Boolean exec(Tuple input) throws IOException {
    	System.out.println("starting......");
        try {
            Object values = input.get(0);
            if (values instanceof DataBag){
            	System.out.println("test empty DataBag");
                return ((DataBag)values).size() == 0;
        	}else if (values instanceof Map){
            	System.out.println("test empty map");
                return ((Map)values).size() == 0;
            }else {
                int errCode = 2102;
                String msg = "Cannot test a " +
                DataType.findTypeName(values) + " for emptiness.";
                System.out.println("test empty full");
                throw new ExecException(msg, errCode, PigException.BUG);
            }
        } catch (ExecException ee) {
        	System.out.println("error......");
            throw ee;
        }
        
    }
} 