package myudfs;

import java.io.EOFException;
import java.io.FileInputStream;
import java.io.IOException;
import java.nio.ByteBuffer;
import java.nio.CharBuffer;
import java.nio.charset.Charset;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.apache.pig.EvalFunc;
import org.apache.pig.data.BagFactory;
import org.apache.pig.data.DataBag;
import org.apache.pig.data.Tuple;
import org.apache.pig.data.TupleFactory;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import com.fasterxml.jackson.core.JsonParseException;
import com.fasterxml.jackson.core.type.TypeReference;
import com.fasterxml.jackson.databind.JsonMappingException;
import com.fasterxml.jackson.databind.ObjectMapper;

import myudfs.GangAction;
import myudfs.GangAction.GangDescInfoMessage;
import myudfs.GangAction.GangDetailInfoMessage;
import myudfs.GangAction.GangManageInfoMessage;
import myudfs.GangAction.GangMemberInfoMessage;
import myudfs.GangAction.PlayerHasGangInfoMessage;
import myudfs.JsonMap.ERRORS;

public class ParseprotoQHV extends EvalFunc<Map<String, Object>>{
	static void printAccount(){
		//STOCK_FINAL = FOREACH STOCK_D_G GENERATE $2 as date,$gameid as game_id,
		// player $0 as accid,$0 as msi,
		//graph_mobo_vn $3 as mobo_id,(chararray)$5 as fullname;
		
	}
	static void printRole(){
		/*
		 * $6 as date,$6 as date_modify,
		 * $gameid as game_id,$serverid as server_id,
		 * player:  $7 as accid,$7 as msi,(chararray)$5 as role_id,(chararray)$1 as role_name,
		 * $2 as create_role_date,$3 as last_login_date,$4 as level;
		 * graph_mobo_vn: $9 as mobo_id,(chararray)$11 as fullname,
		 * 
		 * 
		 */
	}
	
	public static enum ERRORS {
        JSONParseError, JSONMappingError, EOFError, GenericError
    };

    private static final BagFactory bagFactory = BagFactory.getInstance();
    protected static final TupleFactory tupleFactory = TupleFactory.getInstance();
    protected final ObjectMapper jsonMapper = new ObjectMapper();

    /**
     * Converts List objects to DataBag to keep Pig happy
     * 
     * @param l
     * @return
     */
    @SuppressWarnings("unchecked")
    private DataBag convertListToBag(List<Object> l) {
        DataBag dbag = bagFactory.newDefaultBag();
        Tuple t = tupleFactory.newTuple();
        for (Object o : l) {
            if (o instanceof List) {
                dbag.addAll(convertListToBag((List<Object>) o));
            } else {
                t.append(o);
            }
        }

        if (t.size() > 0) {
            dbag.add(t);
        }

        return dbag;
    }

    /**
     * Convert map and its values to types that Pig can handle
     * 
     * @param m
     * @return
     */
    @SuppressWarnings("unchecked")
    protected Map<String, Object> makeSafe(Map<String, Object> m) {
        Map<String, Object> safeValues = new HashMap<String, Object>();
        for (Map.Entry<String, Object> entry : m.entrySet()) {
            Object v = entry.getValue();
            if (v != null && v instanceof List) {
                DataBag db = convertListToBag((List<Object>) v);
                safeValues.put(entry.getKey(), db);
            } else if (v != null && v instanceof Map) {
                safeValues.put(entry.getKey(), makeSafe((Map<String, Object>) v));
            } else {
                safeValues.put(entry.getKey(), entry.getValue());
            }
        }

        return safeValues;
    }
    static String printGuild(PlayerHasGangInfoMessage gangaction){
		/*
		 * $4 as date,$4 as date_modify,$gameid as game_id,$serverid as server_id,
		 * CONCAT((chararray)'$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$0)))) as game_guild_id,
		 * CONCAT((chararray)'$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,CONCAT('_',(chararray)$1)))) as game_guild_name,
		 * $2 as game_guild_create_date//trung voi jointime bang chu,
		 * (chararray)$5 as game_guild_leader_name,
		 * (chararray)$15 as msi_leader,$17 as mobo_id,(chararray)$19 as fullname,
		 * $15 as accid_leader ,(chararray)
		 * $3 as role_id_leader;
		 */
    	GangDetailInfoMessage gangapply = gangaction.getGangDetailInfo();
		
		JSONObject j = new JSONObject();
		
		GangDescInfoMessage gangdes = gangapply.getDescInfo();
		try {
			j.put("guildid", gangdes.getGangId());
			j.put("guildname", gangdes.getGangName());
			
			//System.out.println(gangaction.getGangDisbandCDTime());
			for (GangMemberInfoMessage memberlist:gangapply.getMemberListList()) {
				if(memberlist.getPosition().toString() == "GANG_POSITION_BOSS"){
					
					j.put("guildcreatedate", memberlist.getJoinTime());
					
					j.put("roleid", memberlist.getMemberId());
					break;
				}
			}
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		String json = j.toString();
		return json;
	}
    static String printGuildMember(PlayerHasGangInfoMessage gangaction){
		/*
		 * CONCAT((chararray)'$ALIAS',CONCAT('_',CONCAT((chararray)$serverid,
		 * CONCAT('_',(chararray)$1)))) as game_guild_id,$4 as date,
		 * $2 as join_date,$11 as msi_mem,$11 as accid_mem,
		 * $13 as mobo_id,(chararray)$15 as fullname,
		 * (chararray)$3 as role_id_mem,0 as statussend;
		 */
    	GangDetailInfoMessage gangapply = gangaction.getGangDetailInfo();
		
		JSONObject j = new JSONObject();
		JSONArray myArray = new JSONArray();
		GangDescInfoMessage gangdes = gangapply.getDescInfo();
		try {
			
			
			//System.out.println(gangaction.getGangDisbandCDTime());
			for (GangMemberInfoMessage memberlist:gangapply.getMemberListList()) {
				j.put("guildid", gangdes.getGangId());
				j.put("guildname", gangdes.getGangName());
				j.put("joindate", memberlist.getJoinTime());
				j.put("roleid", memberlist.getMemberId());
				myArray.put(j);
			}
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		String json = myArray.toString();
		return json;
	}
    @Override
    public Map<String, Object> exec(Tuple input) throws IOException {
        if (input == null || input.size() == 0) {
            return null;
        }

        try {
        	String strfirst = (String) input.get(0).toString();
        	String str = strfirst.replaceAll("\\s+","");
        	ByteBuffer buff = ByteBuffer.allocate(str.length()/2);
    		for (int i = 0; i < str.length(); i+=2) {
    		    buff.put((byte)Integer.parseInt(str.substring(i, i+2), 16));
    		}
    		buff.rewind();
    		GangAction.PlayerHasGangInfoMessage gangaction = GangAction.PlayerHasGangInfoMessage.parseFrom(buff.array());
    		String jsonmap = printGuild(gangaction);
    		
            Map<String, Object> values = jsonMapper.readValue((String) jsonmap,
                                                              new TypeReference<Map<String, Object>>() {});
            return makeSafe(values);
        } catch (JsonParseException e) {
            warn("JSON Parse Error: " + e.getMessage(), ERRORS.JSONParseError);
        } catch (JsonMappingException e) {
            warn("JSON Mapping Error: " + e.getMessage(), ERRORS.JSONMappingError);
        } catch (EOFException e) {
            warn("Hit EOF unexpectedly", ERRORS.EOFError);
        } catch (Exception e) {
            warn("Generic error during JSON mapping", ERRORS.GenericError);
        }

        return null;
    }
}

