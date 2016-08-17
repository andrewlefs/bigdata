package myudfs;
import java.io.IOException; 
import java.util.Iterator; 
 
import org.apache.pig.EvalFunc; 
import org.apache.pig.data.DataBag; 
import org.apache.pig.data.Tuple; 
import org.apache.pig.data.TupleFactory; 
 
public class ConvertBagToTuple extends EvalFunc<Tuple> {
	private static TupleFactory tupleFactory = TupleFactory.getInstance(); 
	 
    @Override 
    public Tuple exec(Tuple input) throws IOException { 
        if (input == null || input.size() == 0) { 
            return null; 
        } 
 
        DataBag db = (DataBag) input.get(0); 
        Iterator<Tuple> iter = db.iterator(); 
        Tuple output = tupleFactory.newTuple(); 
        while (iter.hasNext()) { 
            Tuple t = iter.next(); 
            for (Object o : t.getAll()) { 
                output.append(o); 
            } 
        } 
 
        return output; 
    } 
}
