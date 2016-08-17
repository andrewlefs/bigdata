package myudfs;

import java.io.IOException;
import org.apache.pig.EvalFunc;
import org.apache.pig.data.DataByteArray;
import org.apache.pig.data.DataType;
import org.apache.pig.data.Tuple;
import org.apache.pig.impl.logicalLayer.schema.Schema;

public class HexConversion extends EvalFunc<DataByteArray> {
	/**
	 * UDF to convert ASCII to hexadecimal.It returns the string into Hex format
	 * as DataByteArray
	 */
	public DataByteArray exec(final Tuple input) throws IOException {
		DataByteArray output = new DataByteArray();
		if (input == null) {
			output = null;
		}
		try {
			final String str = input.get(0).toString();
			String code;
			int strlength = str.length();
			StringBuilder builder = new StringBuilder();
			char[] charArr = new char[strlength];
			for (int i = 0; i < str.length(); i++) {
				char ch = str.charAt(i);
				code = Integer.toHexString(ch).toUpperCase();
				//charArr[i] = code;

			}
			builder.append(charArr);
			//output.append(builder.toString());
		} catch (final Exception e) {
			//output.append(new byte[0]);
		}
		return output;
	}
	public Schema outputSchema(Schema input) {
        try{
            Schema tupleSchema = new Schema();
            tupleSchema.add(input.getField(1));
            tupleSchema.add(input.getField(0));
            return new Schema(new      Schema.FieldSchema(getSchemaName(this.getClass().getName().toLowerCase(),  input),tupleSchema, DataType.TUPLE));
        }catch (Exception e){
                return null;
        }
    }
}
