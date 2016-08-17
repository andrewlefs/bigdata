package myudfs;

import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Locale;

import org.apache.pig.EvalFunc;
import org.apache.pig.data.Tuple;

public class UnixtimetoDate extends EvalFunc<String> {

	public String exec(Tuple input) throws IOException {
		String str = (String) input.get(0).toString();
		if (str.equals(null) || str.equals("") || str.equals(0)) {
			return String.valueOf(0);
		} else {
			long timestamp = Long.parseLong(str);
			SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd H:mm:ss",Locale.CHINA);
			String date = sdf.format(timestamp);
			return date.toString();
		}

	}
}
