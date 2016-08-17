package myudfs;

import java.io.IOException;
import org.apache.pig.EvalFunc;
import org.apache.pig.PigWarning;
import org.apache.pig.data.DataType;
import org.apache.pig.data.Tuple;
import org.apache.pig.impl.logicalLayer.schema.Schema;

public class IsNumeric extends EvalFunc {
	public Boolean exec(Tuple input) throws IOException {
		if (input == null || input.size() == 0)
			return false;
		try {
			String str = (String) input.get(0);
			if (str == null || str.length() == 0)
				return false;
			if (str.startsWith("-"))
				str = str.substring(1);
			return str.matches("\\d+(\\.\\d+)?");
		} catch (ClassCastException e) {
			warn("Unable to cast input " + input.get(0) + " of class "
					+ input.get(0).getClass() + " to String",
					PigWarning.UDF_WARNING_1);
			return false;
		}
	}

	@Override
	public Schema outputSchema(Schema input) {
		return new Schema(new Schema.FieldSchema(null, DataType.BOOLEAN));
	}

}
