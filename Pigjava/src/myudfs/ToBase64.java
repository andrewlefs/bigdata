package myudfs;

import java.io.IOException;
import java.util.Base64;

import org.apache.pig.EvalFunc;
import org.apache.pig.data.Tuple;

public class ToBase64 extends EvalFunc<String> {

	public String exec(Tuple input) throws IOException {
		String str = (String) input.get(0).toString();
		final String encoded = Base64.getEncoder().encodeToString(str.getBytes("UTF-8"));
		return encoded.toString().trim();

	}
	
}
