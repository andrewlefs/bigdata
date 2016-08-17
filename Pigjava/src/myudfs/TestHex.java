package myudfs;

import java.io.IOException;
import java.net.URLDecoder;
import java.nio.ByteBuffer;
import java.nio.CharBuffer;
import java.nio.charset.Charset;
import java.util.ArrayList;
import java.util.List;

import org.apache.pig.EvalFunc;
import org.apache.pig.FuncSpec;
import org.apache.pig.data.DataByteArray;
import org.apache.pig.data.DataType;
import org.apache.pig.data.Tuple;
import org.apache.pig.impl.logicalLayer.FrontendException;
import org.apache.pig.impl.logicalLayer.schema.Schema;
import org.apache.commons.codec.DecoderException;

public class TestHex extends EvalFunc<String> {
	
	public String exec(Tuple input) throws IOException {
		String str = (String) input.get(0).toString();
		
		ByteBuffer buff = ByteBuffer.allocate(str.length()/2);
		for (int i = 0; i < str.length(); i+=3) {
		    buff.put((byte)Integer.parseInt(str.substring(i, i+2), 16));
		}
		buff.rewind();
		Charset cs = Charset.forName("UTF-8");
		
		CharBuffer cb = cs.decode(buff);
		//URLDecoder.decode(cb.toString(),"UTF-8");
		/*
		StringBuilder output = new StringBuilder();
		
	    for (int i = 0; i < str.length(); i+=3) {
	    	String str1 = str.substring(i, i + 2);
	        str1 = str1.trim();
	        output.append((char) Integer.parseInt(str1, 16));
	    }*/
        return cb.toString().trim();
        
	}
	/*public static String toHexString(byte[] ba) {
	    StringBuilder str = new StringBuilder();
	    for(int i = 0; i < ba.length; i++)
	        str.append(String.format("%x", ba[i]));
	    return str.toString();
	}
	
	
	@Override
	public Schema outputSchema(Schema input) {
		return new Schema(new Schema.FieldSchema(getSchemaName(this.getClass()
				.getName().toLowerCase(), input), DataType.BYTEARRAY));
	}
	
	@Override
	public List<FuncSpec> getArgToFuncMapping() throws FrontendException {
		List<FuncSpec> funcList = new ArrayList<FuncSpec>();
		Schema s = new Schema();
		s.add(new Schema.FieldSchema(null, DataType.BYTEARRAY));
		funcList.add(new FuncSpec(this.getClass().getName(), s));
		return funcList;
	}
	*/
}
