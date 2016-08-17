package myudfs;

import java.io.IOException;

import org.apache.pig.EvalFunc;
import org.apache.pig.data.Tuple;

public class TestfunctionMap extends EvalFunc<String>{
	public String exec(Tuple input) throws IOException {
		String str = (String) input.get(0).toString();
		String str1 = (String) input.get(1).toString();
		
        return str1.toString()+"______DKLP________"+str1.toString();
        
	}
}
