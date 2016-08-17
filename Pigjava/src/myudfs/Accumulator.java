package myudfs;

import java.io.IOException;

import org.apache.pig.data.Tuple;

public interface Accumulator<T> {
	/**
	 * Process tuples. Each DataBag may contain 0 to many tuples for current key
	 */
	public void accumulate(Tuple b) throws IOException;

	/**
	 * Called when all tuples from current key have been passed to the
	 * accumulator.
	 * 
	 * @return the value for the UDF for this key.
	 */
	public T getValue();

	/**
	 * Called after getValue() to prepare processing for next key.
	 */
	public void cleanup();
}
