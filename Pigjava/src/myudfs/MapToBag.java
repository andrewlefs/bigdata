package myudfs;

import java.io.IOException;
import java.util.Map;
import java.util.Map.Entry;

import org.apache.pig.EvalFunc;
import org.apache.pig.data.BagFactory;
import org.apache.pig.data.DataBag;
import org.apache.pig.data.Tuple;
import org.apache.pig.data.TupleFactory;

public class MapToBag extends EvalFunc<DataBag> {
	private static final BagFactory bagFactory = BagFactory.getInstance();
    private static final TupleFactory tupleFactory = TupleFactory.getInstance();

    @Override
    public DataBag exec(Tuple input) throws IOException {
        try {
            @SuppressWarnings("unchecked")
            Map<String, Object> map = (Map<String, Object>) input.get(0);
            DataBag result = null;
            if (map != null) {
                result = bagFactory.newDefaultBag();
                for (Entry<String, Object> entry : map.entrySet()) {
                    Tuple tuple = tupleFactory.newTuple(2);
                    tuple.set(0, entry.getKey());
                    tuple.set(1, entry.getValue());
                    result.add(tuple);
                }
            }
            return result;

        }
        catch (Exception e) {
            throw new RuntimeException("MapToBag error", e);
        }
    }
}
