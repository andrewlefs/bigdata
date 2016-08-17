package myudfs;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.io.ObjectOutputStream;
import java.nio.ByteBuffer;
import java.nio.CharBuffer;
import java.nio.charset.Charset;
import java.sql.Date;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;
import java.util.TimeZone;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import myudfs.GangAction;
import myudfs.GangAction.GangActionParam;
import myudfs.GangAction.GangApplyMemberInfoMessage;
import myudfs.GangAction.GangConstructInfoMessage;
import myudfs.GangAction.GangDescInfoMessage;
import myudfs.GangAction.GangDetailInfoMessage;
import myudfs.GangAction.GangExchangeMessage;
import myudfs.GangAction.GangManageInfoMessage;
import myudfs.GangAction.GangMemberInfoMessage;
import myudfs.GangAction.GangRankMessage;
import myudfs.GangAction.MapItem5;
import myudfs.GangAction.PlayerGangApplyInfoMessage;
import myudfs.GangAction.PlayerGangDetailInfoMessage;
import myudfs.GangAction.PlayerHasGangInfoMessage;
import myudfs.GangAction.PlayerNoGangInfoMessage;

public class ListGang {
	static void Print(PlayerHasGangInfoMessage gangaction) {
		System.out.println(gangaction);
		GangDetailInfoMessage gangapply = gangaction.getGangDetailInfo();
		GangManageInfoMessage gangmana = gangaction.getGangManageInfo();
		
		System.out.println("********PROPERTY*********");
		System.out.println("*****************");
		System.out.println("1:********PlayerHasGangInfoMessage*********");
		System.out.println("DISBAND: "+gangaction.getGangDisbandTime());
		System.out.println("CancelDisband: "+gangaction.getGangCancelDisbandTime());
		System.out.println("DisbandCD: "+gangaction.getGangDisbandCDTime());
		System.out.println("CancelDisbandCD: "+gangaction.getGangCancelDisbandCDTime());
		System.out.println("*****************");
		
		System.out.println("********descInfo*********");
		System.out.println("*****************");
		GangDescInfoMessage gangdes = gangapply.getDescInfo();
		System.out.println("GANGNAME: "+gangdes.getGangName());
		System.out.println("ID: "+gangdes.getGangId());
		System.out.println("LV: "+gangdes.getGangLv());
		System.out.println("NOTICE: "+gangapply.getGangNotice());
		System.out.println("*****************");
		
		//System.out.println(gangaction.getGangDisbandCDTime());
		for (GangMemberInfoMessage memberlist:gangapply.getMemberListList()) {
			System.out.println("memberId: "+memberlist.getMemberId()+"  joinTime: "+memberlist.getJoinTime());
		}
		System.out.println("********THE END*********");
		
    }

    // Main function:  Reads the entire address book from a file and prints all
    //   the information inside.
    public static void main(String[] args) throws Exception {
        if (args.length != 1) {
            System.err.println("Usage:  ListPeople ADDRESS_BOOK_FILE");
            System.exit(-1);
        }
        String strfirst ="0a b1 4b 0a 61 0a 09 48 e1 bb 95 20 42 c3 a1 6f 10 14 18 48 20 50 28 b8 91 02 30 37 38 01 40 03 48 00 50 ea 84 01 5a 26 48 6f 61 6e 20 6e 67 68 c3 aa 6e 68 20 6d e1 bb 8d 69 20 6e 67 c6 b0 e1 bb 9d 69 20 76 c3 a0 6f 20 62 61 6e 67 21 60 64 68 64 70 f2 f9 a0 05 78 b8 91 02 88 01 a8 90 2b 90 01 14 98 01 0e 12 43 56 75 69 20 6c c3 a0 20 39 20 2e 20 61 63 65 20 63 68 c4 83 6d 20 63 e1 bb 91 6e 67 20 67 c3 b3 70 20 63 68 6f 20 62 61 6e 67 20 2e 20 6c e1 bb a3 69 20 6d c3 ac 6e 68 20 6c e1 bb a3 69 20 62 61 6e 67 1a 20 20 03 28 bc e1 05 30 ee f3 cf ce bc 2a 40 03 58 81 ea 05 60 00 68 8c e2 01 70 00 78 00 88 01 00 1a 1f 20 03 28 cc 12 30 88 eb 8e 81 a4 2a 40 03 58 80 e8 06 60 00 68 aa f0 03 70 00 78 00 88 01 00 1a 20 20 03 28 f9 b7 01 30 bb 9b f0 df bc 2a 40 04 58 80 8a 06 60 00 68 f5 ce 02 70 00 78 00 88 01 00 1a 1f 20 03 28 c1 03 30 c3 ef d3 b1 a1 2a 40 03 58 85 e0 06 60 00 68 f0 e0 0d 70 00 78 00 88 01 00 1a 20 20 03 28 fb d9 08 30 c5 ab eb c8 a4 2a 40 04 58 85 dd 06 60 00 68 96 94 14 70 00 78 00 88 01 00 1a 20 20 03 28 84 f5 0e 30 96 ae 93 89 9d 2a 40 04 58 86 a6 06 60 00 68 a1 9d 1d 70 00 78 00 88 01 00 1a 20 20 03 28 8f 91 01 30 8c 91 da a9 a0 2a 40 03 58 86 b4 05 60 00 68 84 c3 07 70 00 78 00 88 01 00 1a 1f 20 03 28 c2 5d 30 d7 a7 86 d9 a1 2a 40 03 58 86 e3 05 60 00 68 a7 e1 0a 70 00 78 00 88 01 00 1a 20 20 03 28 98 9f 02 30 8d db 92 80 bd 2a 40 03 58 8a ee 06 60 00 68 90 9b 02 70 00 78 00 88 01 00 1a 1f 20 03 28 9a a0 03 30 86 9e bf ca c3 2a 40 04 58 91 c2 05 60 00 68 86 2a 70 00 78 00 88 01 00 1a 20 20 03 28 f9 99 06 30 94 dd 95 f7 c0 2a 40 03 58 91 e1 0e 60 00 68 fa fa 02 70 00 78 00 88 01 00 1a 25 20 02 28 95 b5 1e 30 ab f7 c6 ed 9b 2a 40 04 58 92 cd 05 60 01 68 9d fa 2d 70 00 78 da 8c d1 ed af 2a 88 01 00 1a 20 20 03 28 8d 91 01 30 a3 e5 af cf bc 2a 40 03 58 94 f9 0f 60 00 68 82 82 05 70 00 78 00 88 01 00 1a 1f 20 03 28 de 24 30 ae c8 ae a7 a0 2a 40 03 58 98 e3 05 60 00 68 9a a6 12 70 00 78 00 88 01 00 1a 20 20 03 28 df b6 03 30 f2 cc 96 d0 bc 2a 40 03 58 9b 85 07 60 00 68 de a1 03 70 00 78 00 88 01 00 1a 20 20 03 28 b6 81 09 30 af 96 d8 a2 a3 2a 40 04 58 9c ff 06 60 00 68 b1 f4 18 70 00 78 00 88 01 00 1a 1f 20 03 28 da 9a 01 30 dc ab 95 8c c4 2a 40 04 58 9c 8e 05 60 00 68 f6 51 70 00 78 00 88 01 00 1a 1f 20 03 28 b3 20 30 a2 d1 99 e2 ba 2a 40 00 58 9e e3 07 60 00 68 a0 da 03 70 00 78 00 88 01 04 1a 1f 20 03 28 b8 48 30 f5 d1 f4 e4 a8 2a 40 03 58 a2 db 07 60 00 68 f8 c2 06 70 00 78 00 88 01 00 1a 1f 20 03 28 be 45 30 99 c0 96 b7 bd 2a 40 03 58 a2 87 07 60 00 68 92 c9 05 70 00 78 00 88 01 00 1a 1f 20 03 28 f0 88 01 30 ef bf d4 94 c2 2a 40 00 58 a2 da 06 60 00 68 aa 2e 70 00 78 00 88 01 04 1a 20 20 03 28 f7 b0 04 30 ef a3 a9 8c 9d 2a 40 03 58 ab dd 05 60 00 68 e6 c2 0b 70 00 78 00 88 01 00 1a 20 20 03 28 df a8 0a 30 cb c6 b2 a4 a0 2a 40 04 58 aa 84 06 60 00 68 c8 e0 1d 70 00 78 00 88 01 00 1a 20 20 03 28 f1 e9 04 30 d5 e2 c3 c3 ba 2a 40 00 58 b1 a5 04 60 00 68 b1 e1 06 70 00 78 00 88 01 03 1a 20 20 03 28 f7 bb 02 30 ac ae eb cf bc 2a 40 04 58 b2 df 06 60 00 68 a0 98 01 70 00 78 00 88 01 00 1a 20 20 03 28 ba ea 15 30 ce aa e4 ed 9e 2a 40 04 58 b5 96 06 60 00 68 ea 87 20 70 00 78 00 88 01 00 1a 20 20 03 28 e3 c8 02 30 ec 88 fd c4 bc 2a 40 04 58 b6 ca 06 60 00 68 8c ad 03 70 00 78 00 88 01 00 1a 1f 20 03 28 ed 8f 03 30 a5 a8 c7 9f be 2a 40 03 58 b7 c7 03 60 00 68 b2 28 70 00 78 00 88 01 00 1a 20 20 03 28 8b cd 0c 30 e0 b3 ae ff 9c 2a 40 03 58 b9 bd 05 60 00 68 91 c3 17 70 00 78 00 88 01 00 1a 20 20 03 28 9f cd 01 30 da c9 b4 fc b8 2a 40 03 58 b9 fb 04 60 00 68 e3 b5 03 70 00 78 00 88 01 00 1a 1f 20 03 28 87 0c 30 fd d3 ca b5 ba 2a 40 04 58 b8 f6 07 60 00 68 f5 fa 01 70 00 78 00 88 01 00 1a 1f 20 03 28 82 14 30 8f d3 9b f9 bc 2a 40 04 58 b8 e4 06 60 00 68 91 f8 01 70 00 78 00 88 01 00 1a 20 20 03 28 cb 9e 08 30 a7 a1 9f b4 be 2a 40 04 58 bc 85 06 60 00 68 c4 97 04 70 00 78 00 88 01 00 1a 20 20 03 28 cd 8f 02 30 95 d5 9c ad a0 2a 40 04 58 bf fc 06 60 00 68 e1 d8 06 70 00 78 00 88 01 00 1a 20 20 03 28 e8 ee 01 30 81 93 a9 87 bc 2a 40 04 58 bf f4 06 60 00 68 a3 d9 04 70 00 78 00 88 01 00 1a 20 20 03 28 b1 e0 02 30 86 a6 d1 d6 ba 2a 40 03 58 c1 cb 07 60 00 68 85 a5 05 70 00 78 00 88 01 00 1a 1f 20 03 28 e2 67 30 98 c5 c5 c8 ad 2a 40 00 58 c3 d0 06 60 00 68 b1 d5 11 70 00 78 00 88 01 04 1a 20 20 03 28 b8 81 0e 30 93 b7 ca bf bd 2a 40 04 58 c2 9f 06 60 00 68 d4 83 05 70 00 78 00 88 01 00 1a 1f 20 03 28 e5 22 30 9a a8 ed fb bf 2a 40 00 58 c1 96 08 60 00 68 ff c7 02 70 00 78 00 88 01 04 1a 1f 20 03 28 cd c2 04 30 b8 ab 88 f5 bc 2a 40 03 58 c6 df 08 60 00 68 f5 48 70 00 78 00 88 01 00 1a 20 20 03 28 ef ca 0c 30 c5 d1 f7 de a3 2a 40 04 58 c7 d8 06 60 00 68 9e b1 15 70 00 78 00 88 01 00 1a 1f 20 03 28 ee 15 30 98 9a 8d 96 ba 2a 40 03 58 c6 c4 03 60 00 68 93 d9 04 70 00 78 00 88 01 00 1a 20 20 03 28 b2 9e 03 30 b3 ad f1 c4 bc 2a 40 03 58 c7 c4 03 60 00 68 e5 e7 03 70 00 78 00 88 01 00 1a 20 20 03 28 fa d3 0b 30 f5 86 a3 cb a4 2a 40 04 58 c8 af 08 60 00 68 fe 95 24 70 00 78 00 88 01 00 1a 20 20 03 28 cd fe 08 30 c1 a9 9e ee 9b 2a 40 04 58 cf b9 05 60 00 68 95 ef 16 70 00 78 00 88 01 00 1a 20 20 03 28 fb c3 1b 30 f1 f2 ae aa a6 2a 40 00 58 d0 d3 06 60 00 68 9c 82 23 70 00 78 00 88 01 04 1a 1e 20 03 28 e1 37 30 e8 ec 80 a6 be 2a 40 03 58 d6 e4 0c 60 00 68 9c 72 70 00 78 00 88 01 00 1a 25 20 01 28 93 c0 20 30 e2 e0 fb fe 9c 2a 40 04 58 d6 b0 05 60 02 68 d0 b2 30 70 00 78 99 e1 89 83 b3 2a 88 01 00 1a 1f 20 03 28 e6 86 02 30 db c9 9d cb be 2a 40 03 58 d8 92 04 60 00 68 80 4b 70 00 78 00 88 01 00 1a 20 20 03 28 a0 ee 01 30 cd a5 a3 b6 b2 2a 40 04 58 dd cd 07 60 00 68 b7 af 05 70 00 78 00 88 01 00 1a 20 20 03 28 ca e8 02 30 c6 c3 a5 bd a7 2a 40 03 58 dc fd 06 60 00 68 ca be 0a 70 00 78 00 88 01 00 1a 20 20 03 28 93 fe 0c 30 88 bf 84 8c 9d 2a 40 04 58 de a5 06 60 00 68 b0 f4 1a 70 00 78 00 88 01 00 1a 20 20 03 28 ff ba 04 30 94 fc c8 bb b1 2a 40 04 58 e1 f0 06 60 00 68 8f b3 0f 70 00 78 00 88 01 00 1a 20 20 03 28 a9 df 03 30 b7 88 84 a6 be 2a 40 04 58 e1 d6 03 60 00 68 ac c1 01 70 00 78 00 88 01 00 1a 20 20 03 28 d3 b5 01 30 b5 90 ee 80 ad 2a 40 04 58 e0 f8 10 60 00 68 ba bc 07 70 00 78 00 88 01 00 1a 1e 20 03 28 a8 39 30 c3 e5 b8 a5 c0 2a 40 03 58 e7 d3 06 60 00 68 e6 3c 70 00 78 00 88 01 00 1a 1e 20 03 28 86 72 30 c8 ae ec b9 b9 2a 40 03 58 e8 e3 05 60 00 68 ed 42 70 00 78 00 88 01 00 1a 1f 20 03 28 ca ef 05 30 9b 98 b2 e1 bd 2a 40 04 58 eb ee 05 60 00 68 f0 6d 70 00 78 00 88 01 00 1a 1f 20 03 28 de 2e 30 b1 e1 e1 c4 bc 2a 40 02 58 ee 93 06 60 00 68 e6 d3 03 70 00 78 00 88 01 01 1a 1f 20 03 28 e6 a3 06 30 8b c6 8a 81 bd 2a 40 04 58 f1 8b 06 60 00 68 d4 67 70 00 78 00 88 01 00 1a 20 20 03 28 c3 c6 10 30 ab ea cc ec 9b 2a 40 00 58 f0 bb 05 60 00 68 a4 a8 23 70 00 78 00 88 01 04 1a 1f 20 03 28 a2 11 30 ca 97 ed fa af 2a 40 04 58 f5 85 10 60 00 68 d6 a5 07 70 00 78 00 88 01 00 1a 20 20 03 28 90 b2 15 30 a4 93 e5 9f a3 2a 40 04 58 f0 b2 0e 60 00 68 b9 c0 22 70 00 78 00 88 01 00 1a 20 20 03 28 ec ad 10 30 f2 a0 bd ed 9b 2a 40 04 58 f5 e3 05 60 00 68 c2 cd 23 70 00 78 00 88 01 00 1a 20 20 03 28 8d e5 04 30 ae 9d b3 94 af 2a 40 04 58 f5 f4 06 60 00 68 d9 e3 18 70 00 78 00 88 01 00 1a 20 20 03 28 dc a1 18 30 e7 99 c7 ce bc 2a 40 04 58 f7 e5 05 60 00 68 f1 b0 07 70 00 78 00 88 01 00 1a 20 20 03 28 e4 f1 05 30 87 be c1 d9 be 2a 40 03 58 f5 84 08 60 00 68 80 e5 03 70 00 78 00 88 01 00 1a 1f 20 03 28 b1 79 30 f1 bb 86 c5 ba 2a 40 03 58 fa f6 05 60 00 68 c7 ce 06 70 00 78 00 88 01 00 1a 20 20 03 28 e8 89 12 30 c5 e8 fa b4 a6 2a 40 04 58 fc e5 06 60 00 68 e9 b0 1a 70 00 78 00 88 01 00 1a 20 20 03 28 eb 89 0b 30 94 97 f0 d0 a4 2a 40 01 58 ff b2 06 60 00 68 82 c3 14 70 00 78 00 88 01 02 1a 1f 20 03 28 e0 01 30 e4 d7 fa b9 bd 2a 40 00 58 ff b1 03 60 00 68 e4 f7 01 70 00 78 00 88 01 03 1a 1f 20 03 28 ab b0 01 30 87 e5 ec d6 c1 2a 40 03 58 fd f2 09 60 00 68 83 12 70 00 78 00 88 01 00 22 20 08 08 10 b9 e1 dd dd c4 2a 1a 0a 41 6e 68 20 c4 90 e1 bb a9 63 1a 03 31 30 30 1a 04 31 30 30 30 22 20 08 08 10 95 cc dd dd c4 2a 1a 0a 41 6e 68 20 c4 90 e1 bb a9 63 1a 03 31 30 30 1a 04 31 30 30 30 22 20 08 08 10 d9 b5 dd dd c4 2a 1a 0a 41 6e 68 20 c4 90 e1 bb a9 63 1a 03 31 30 30 1a 04 31 30 30 30 22 20 08 08 10 d1 9f dd dd c4 2a 1a 0a 41 6e 68 20 c4 90 e1 bb a9 63 1a 03 31 30 30 1a 04 31 30 30 30 22 25 08 08 10 ea d7 84 d8 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 22 25 08 08 10 ec c2 84 d8 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 22 25 08 08 10 86 af 84 d8 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 22 22 08 08 10 ce c1 a0 d6 c4 2a 1a 0c 4d 79 20 54 c3 ad 6e 20 43 68 c6 b0 1a 03 31 30 30 1a 04 31 30 30 30 22 22 08 08 10 c0 9c a0 d6 c4 2a 1a 0c 4d 79 20 54 c3 ad 6e 20 43 68 c6 b0 1a 03 31 30 30 1a 04 31 30 30 30 22 24 08 07 10 e1 be 8d d6 c4 2a 1a 0d 54 6f 61 20 48 c6 b0 6e 67 20 42 61 6f 1a 05 31 30 30 30 30 1a 03 31 30 30 22 24 08 07 10 97 a5 8d d6 c4 2a 1a 0d 54 6f 61 20 48 c6 b0 6e 67 20 42 61 6f 1a 05 31 30 30 30 30 1a 03 31 30 30 22 23 08 08 10 91 fb 8c d6 c4 2a 1a 0d 54 6f 61 20 48 c6 b0 6e 67 20 42 61 6f 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 07 10 f0 8c d5 d5 c4 2a 1a 0a 42 75 69 43 6f 6e 67 54 61 6e 1a 05 31 30 30 30 30 1a 03 31 30 30 22 21 08 07 10 85 f8 d4 d5 c4 2a 1a 0a 42 75 69 43 6f 6e 67 54 61 6e 1a 05 31 30 30 30 30 1a 03 31 30 30 22 21 08 07 10 d7 e2 d4 d5 c4 2a 1a 0a 42 75 69 43 6f 6e 67 54 61 6e 1a 05 31 30 30 30 30 1a 03 31 30 30 22 21 08 07 10 ef ce d4 d5 c4 2a 1a 0a 42 75 69 43 6f 6e 67 54 61 6e 1a 05 31 30 30 30 30 1a 03 31 30 30 22 21 08 07 10 db 8d dc d4 c4 2a 1a 0a 64 75 63 64 69 65 6e 31 30 32 1a 05 31 30 30 30 30 1a 03 31 30 30 22 21 08 07 10 f3 ec db d4 c4 2a 1a 0a 64 75 63 64 69 65 6e 31 30 32 1a 05 31 30 30 30 30 1a 03 31 30 30 22 21 08 07 10 e3 d5 db d4 c4 2a 1a 0a 64 75 63 64 69 65 6e 31 30 32 1a 05 31 30 30 30 30 1a 03 31 30 30 22 21 08 07 10 db b8 db d4 c4 2a 1a 0a 64 75 63 64 69 65 6e 31 30 32 1a 05 31 30 30 30 30 1a 03 31 30 30 22 21 08 08 10 b1 84 f2 d3 c4 2a 1a 0b 54 48 49 45 4e 20 56 55 4f 4e 47 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 ce eb f1 d3 c4 2a 1a 0b 54 48 49 45 4e 20 56 55 4f 4e 47 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 e8 d0 f1 d3 c4 2a 1a 0b 54 48 49 45 4e 20 56 55 4f 4e 47 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 b1 b6 f1 d3 c4 2a 1a 0b 54 48 49 45 4e 20 56 55 4f 4e 47 1a 03 31 30 30 1a 04 31 30 30 30 22 1f 08 08 10 d7 bc bf d3 c4 2a 1a 09 4c 6f 6e 67 20 54 e1 bb a9 1a 03 31 30 30 1a 04 31 30 30 30 22 1f 08 08 10 d6 a7 bf d3 c4 2a 1a 09 4c 6f 6e 67 20 54 e1 bb a9 1a 03 31 30 30 1a 04 31 30 30 30 22 1f 08 08 10 e6 92 bf d3 c4 2a 1a 09 4c 6f 6e 67 20 54 e1 bb a9 1a 03 31 30 30 1a 04 31 30 30 30 22 1f 08 08 10 86 fe be d3 c4 2a 1a 09 4c 6f 6e 67 20 54 e1 bb a9 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 ea a2 e6 d2 c4 2a 1a 08 48 61 54 72 69 41 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 d9 83 db d1 c4 2a 1a 08 48 69 65 75 44 61 72 74 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 ba ec da d1 c4 2a 1a 08 48 69 65 75 44 61 72 74 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 fe d5 da d1 c4 2a 1a 08 48 69 65 75 44 61 72 74 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 f7 bc da d1 c4 2a 1a 08 48 69 65 75 44 61 72 74 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 80 d9 b7 cb c4 2a 1a 08 48 61 54 72 69 41 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 aa c2 b7 cb c4 2a 1a 08 48 61 54 72 69 41 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 a8 ab b7 cb c4 2a 1a 08 48 61 54 72 69 41 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 ad bf 97 cb c4 2a 1a 0b 54 6f c3 a0 6e 20 43 e1 ba ad 75 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 9b a8 97 cb c4 2a 1a 0b 54 6f c3 a0 6e 20 43 e1 ba ad 75 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 9b 94 97 cb c4 2a 1a 0b 54 6f c3 a0 6e 20 43 e1 ba ad 75 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 b1 ff 96 cb c4 2a 1a 0b 54 6f c3 a0 6e 20 43 e1 ba ad 75 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 ba 9d c7 ca c4 2a 1a 08 4e 68 c6 b0 20 4c 61 69 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 ca 89 c7 ca c4 2a 1a 08 4e 68 c6 b0 20 4c 61 69 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 8d f5 c6 ca c4 2a 1a 08 4e 68 c6 b0 20 4c 61 69 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 d7 de c6 ca c4 2a 1a 08 4e 68 c6 b0 20 4c 61 69 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 fb c2 aa c9 c4 2a 1a 0b 50 68 e1 ba ad 74 20 54 e1 bb 95 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 b5 ae aa c9 c4 2a 1a 0b 50 68 e1 ba ad 74 20 54 e1 bb 95 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 cd 9a aa c9 c4 2a 1a 0b 50 68 e1 ba ad 74 20 54 e1 bb 95 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 91 86 aa c9 c4 2a 1a 0b 50 68 e1 ba ad 74 20 54 e1 bb 95 1a 03 31 30 30 1a 04 31 30 30 30 22 1f 08 08 10 ef c3 99 c9 c4 2a 1a 09 48 c6 b0 20 74 72 c3 ba 63 1a 03 31 30 30 1a 04 31 30 30 30 22 1f 08 08 10 96 a5 99 c9 c4 2a 1a 09 48 c6 b0 20 74 72 c3 ba 63 1a 03 31 30 30 1a 04 31 30 30 30 22 1f 08 08 10 f7 89 99 c9 c4 2a 1a 09 48 c6 b0 20 74 72 c3 ba 63 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 92 bc de c7 c4 2a 1a 0b 53 65 73 73 68 6f 75 6d 61 72 75 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 cd 81 de c7 c4 2a 1a 0b 53 65 73 73 68 6f 75 6d 61 72 75 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 ee ea dd c7 c4 2a 1a 0b 53 65 73 73 68 6f 75 6d 61 72 75 1a 03 31 30 30 1a 04 31 30 30 30 22 21 08 08 10 9c a2 dd c7 c4 2a 1a 0b 53 65 73 73 68 6f 75 6d 61 72 75 1a 03 31 30 30 1a 04 31 30 30 30 22 25 08 08 10 af 88 bb c7 c4 2a 1a 11 54 69 c3 aa cc 89 75 59 c3 aa 75 48 c3 a2 cc 80 75 1a 02 32 30 1a 03 32 30 30 22 28 08 07 10 be f2 ba c7 c4 2a 1a 11 54 69 c3 aa cc 89 75 59 c3 aa 75 48 c3 a2 cc 80 75 1a 05 31 30 30 30 30 1a 03 31 30 30 22 28 08 07 10 e1 dc ba c7 c4 2a 1a 11 54 69 c3 aa cc 89 75 59 c3 aa 75 48 c3 a2 cc 80 75 1a 05 31 30 30 30 30 1a 03 31 30 30 22 25 08 08 10 dd c6 ba c7 c4 2a 1a 11 54 69 c3 aa cc 89 75 59 c3 aa 75 48 c3 a2 cc 80 75 1a 02 32 30 1a 03 32 30 30 22 25 08 08 10 d8 82 d2 c5 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 22 25 08 08 10 a6 ee d1 c5 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 22 25 08 08 10 f3 d9 d1 c5 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 ce ce bf c5 c4 2a 1a 08 65 6d 20 54 6f 75 79 61 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 91 ba bf c5 c4 2a 1a 08 65 6d 20 54 6f 75 79 61 1a 03 31 30 30 1a 04 31 30 30 30 22 1e 08 08 10 b3 d7 ee c3 c4 2a 1a 08 65 6d 20 54 6f 75 79 61 1a 03 31 30 30 1a 04 31 30 30 30 22 25 08 08 10 91 e4 8b c3 c4 2a 1a 11 54 72 c6 b0 c6 a1 6e 67 20 56 c3 b4 20 4b e1 bb b5 1a 02 32 30 1a 03 32 30 30 22 25 08 08 10 96 c6 8b c3 c4 2a 1a 11 54 72 c6 b0 c6 a1 6e 67 20 56 c3 b4 20 4b e1 bb b5 1a 02 32 30 1a 03 32 30 30 22 25 08 08 10 cf b1 8b c3 c4 2a 1a 11 54 72 c6 b0 c6 a1 6e 67 20 56 c3 b4 20 4b e1 bb b5 1a 02 32 30 1a 03 32 30 30 22 25 08 08 10 e9 9c 8b c3 c4 2a 1a 11 54 72 c6 b0 c6 a1 6e 67 20 56 c3 b4 20 4b e1 bb b5 1a 02 32 30 1a 03 32 30 30 22 24 08 08 10 9b aa f1 c2 c4 2a 1a 0e 48 6f 61 20 4e 67 c3 b4 6e 20 4d c3 a3 6f 1a 03 31 30 30 1a 04 31 30 30 30 22 1c 08 07 10 ba da c8 bf c4 2a 1a 05 41 6e 67 6c 65 1a 05 31 30 30 30 30 1a 03 31 30 30 22 1c 08 07 10 d2 c3 c8 bf c4 2a 1a 05 41 6e 67 6c 65 1a 05 31 30 30 30 30 1a 03 31 30 30 22 1c 08 07 10 d1 9e c8 bf c4 2a 1a 05 41 6e 67 6c 65 1a 05 31 30 30 30 30 1a 03 31 30 30 22 22 08 08 10 cf f1 a7 bf c4 2a 1a 0c 54 e1 bb ab 20 4e 67 75 79 c3 aa 6e 1a 03 31 30 30 1a 04 31 30 30 30 22 22 08 08 10 ff da a7 bf c4 2a 1a 0c 54 e1 bb ab 20 4e 67 75 79 c3 aa 6e 1a 03 31 30 30 1a 04 31 30 30 30 22 22 08 08 10 ff b6 a7 bf c4 2a 1a 0c 54 e1 bb ab 20 4e 67 75 79 c3 aa 6e 1a 03 31 30 30 1a 04 31 30 30 30 22 28 08 08 10 c5 8d 8f bf c4 2a 1a 12 4f c3 a1 6e 68 20 48 e1 ba a3 6f 20 4e 67 68 e1 bb 87 1a 03 31 30 30 1a 04 31 30 30 30 22 28 08 08 10 f4 ec bc be c4 2a 1a 12 4f c3 a1 6e 68 20 48 e1 ba a3 6f 20 4e 67 68 e1 bb 87 1a 03 31 30 30 1a 04 31 30 30 30 22 28 08 08 10 80 98 b9 be c4 2a 1a 12 4f c3 a1 6e 68 20 48 e1 ba a3 6f 20 4e 67 68 e1 bb 87 1a 03 31 30 30 1a 04 31 30 30 30 22 1d 08 08 10 94 c9 a7 be c4 2a 1a 09 64 61 69 20 74 68 61 6e 68 1a 02 32 30 1a 03 32 30 30 22 1d 08 08 10 de ad a7 be c4 2a 1a 09 64 61 69 20 74 68 61 6e 68 1a 02 32 30 1a 03 32 30 30 22 1d 08 08 10 86 95 a7 be c4 2a 1a 09 64 61 69 20 74 68 61 6e 68 1a 02 32 30 1a 03 32 30 30 22 1d 08 08 10 bd ba a2 be c4 2a 1a 07 41 6e 68 4b 68 6f 61 1a 03 31 30 30 1a 04 31 30 30 30 22 1d 08 08 10 e3 a5 a2 be c4 2a 1a 07 41 6e 68 4b 68 6f 61 1a 03 31 30 30 1a 04 31 30 30 30 22 28 08 08 10 ea f8 ff b9 c4 2a 1a 12 50 68 e1 bb 89 20 4c c3 a3 6e 67 20 56 69 e1 bb 87 74 1a 03 31 30 30 1a 04 31 30 30 30 22 28 08 08 10 e1 dd ff b9 c4 2a 1a 12 50 68 e1 bb 89 20 4c c3 a3 6e 67 20 56 69 e1 bb 87 74 1a 03 31 30 30 1a 04 31 30 30 30 22 28 08 08 10 b5 c4 ff b9 c4 2a 1a 12 50 68 e1 bb 89 20 4c c3 a3 6e 67 20 56 69 e1 bb 87 74 1a 03 31 30 30 1a 04 31 30 30 30 22 1d 08 08 10 91 d0 b8 b9 c4 2a 1a 07 41 6e 68 44 61 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 22 1d 08 08 10 94 a2 b8 b9 c4 2a 1a 07 41 6e 68 44 61 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 22 1d 08 08 10 c2 ee b7 b9 c4 2a 1a 07 41 6e 68 44 61 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 22 1d 08 08 10 b5 c2 f8 b7 c4 2a 1a 07 41 6e 68 4b 68 6f 61 1a 03 31 30 30 1a 04 31 30 30 30 22 1d 08 08 10 94 f2 d6 b7 c4 2a 1a 07 41 6e 68 4b 68 6f 61 1a 03 31 30 30 1a 04 31 30 30 30 22 26 08 08 10 c7 88 80 b7 c4 2a 1a 10 4e 67 e1 bb 8d 63 20 c3 81 6e 68 20 48 c3 a0 6e 1a 03 31 30 30 1a 04 31 30 30 30 22 26 08 08 10 d3 f2 ff b6 c4 2a 1a 10 4e 67 e1 bb 8d 63 20 c3 81 6e 68 20 48 c3 a0 6e 1a 03 31 30 30 1a 04 31 30 30 30 22 26 08 08 10 fd dc ff b6 c4 2a 1a 10 4e 67 e1 bb 8d 63 20 c3 81 6e 68 20 48 c3 a0 6e 1a 03 31 30 30 1a 04 31 30 30 30 22 26 08 08 10 e7 c6 ff b6 c4 2a 1a 10 4e 67 e1 bb 8d 63 20 c3 81 6e 68 20 48 c3 a0 6e 1a 03 31 30 30 1a 04 31 30 30 30 22 22 08 08 10 aa a5 fb b6 c4 2a 1a 0c 4d 79 20 54 c3 ad 6e 20 43 68 c6 b0 1a 03 31 30 30 1a 04 31 30 30 30 22 22 08 08 10 a0 8d fb b6 c4 2a 1a 0c 4d 79 20 54 c3 ad 6e 20 43 68 c6 b0 1a 03 31 30 30 1a 04 31 30 30 30 22 22 08 08 10 8d f8 fa b6 c4 2a 1a 0c 4d 79 20 54 c3 ad 6e 20 43 68 c6 b0 1a 03 31 30 30 1a 04 31 30 30 30 22 23 08 08 10 e8 f1 e0 b6 c4 2a 1a 0d 70 68 75 20 74 69 c3 aa 6e 20 73 69 68 1a 03 31 30 30 1a 04 31 30 30 30 2a 20 08 08 10 b9 e1 dd dd c4 2a 1a 0a 41 6e 68 20 c4 90 e1 bb a9 63 1a 03 31 30 30 1a 04 31 30 30 30 2a 20 08 08 10 95 cc dd dd c4 2a 1a 0a 41 6e 68 20 c4 90 e1 bb a9 63 1a 03 31 30 30 1a 04 31 30 30 30 2a 20 08 08 10 d9 b5 dd dd c4 2a 1a 0a 41 6e 68 20 c4 90 e1 bb a9 63 1a 03 31 30 30 1a 04 31 30 30 30 2a 20 08 08 10 d1 9f dd dd c4 2a 1a 0a 41 6e 68 20 c4 90 e1 bb a9 63 1a 03 31 30 30 1a 04 31 30 30 30 2a 25 08 08 10 ea d7 84 d8 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 2a 25 08 08 10 ec c2 84 d8 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 2a 25 08 08 10 86 af 84 d8 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 2a 22 08 08 10 ce c1 a0 d6 c4 2a 1a 0c 4d 79 20 54 c3 ad 6e 20 43 68 c6 b0 1a 03 31 30 30 1a 04 31 30 30 30 2a 22 08 08 10 c0 9c a0 d6 c4 2a 1a 0c 4d 79 20 54 c3 ad 6e 20 43 68 c6 b0 1a 03 31 30 30 1a 04 31 30 30 30 2a 24 08 07 10 e1 be 8d d6 c4 2a 1a 0d 54 6f 61 20 48 c6 b0 6e 67 20 42 61 6f 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 24 08 07 10 97 a5 8d d6 c4 2a 1a 0d 54 6f 61 20 48 c6 b0 6e 67 20 42 61 6f 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 23 08 08 10 91 fb 8c d6 c4 2a 1a 0d 54 6f 61 20 48 c6 b0 6e 67 20 42 61 6f 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 07 10 f0 8c d5 d5 c4 2a 1a 0a 42 75 69 43 6f 6e 67 54 61 6e 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 21 08 07 10 85 f8 d4 d5 c4 2a 1a 0a 42 75 69 43 6f 6e 67 54 61 6e 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 21 08 07 10 d7 e2 d4 d5 c4 2a 1a 0a 42 75 69 43 6f 6e 67 54 61 6e 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 21 08 07 10 ef ce d4 d5 c4 2a 1a 0a 42 75 69 43 6f 6e 67 54 61 6e 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 21 08 07 10 db 8d dc d4 c4 2a 1a 0a 64 75 63 64 69 65 6e 31 30 32 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 21 08 07 10 f3 ec db d4 c4 2a 1a 0a 64 75 63 64 69 65 6e 31 30 32 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 21 08 07 10 e3 d5 db d4 c4 2a 1a 0a 64 75 63 64 69 65 6e 31 30 32 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 21 08 07 10 db b8 db d4 c4 2a 1a 0a 64 75 63 64 69 65 6e 31 30 32 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 21 08 08 10 b1 84 f2 d3 c4 2a 1a 0b 54 48 49 45 4e 20 56 55 4f 4e 47 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 ce eb f1 d3 c4 2a 1a 0b 54 48 49 45 4e 20 56 55 4f 4e 47 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 e8 d0 f1 d3 c4 2a 1a 0b 54 48 49 45 4e 20 56 55 4f 4e 47 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 b1 b6 f1 d3 c4 2a 1a 0b 54 48 49 45 4e 20 56 55 4f 4e 47 1a 03 31 30 30 1a 04 31 30 30 30 2a 1f 08 08 10 d7 bc bf d3 c4 2a 1a 09 4c 6f 6e 67 20 54 e1 bb a9 1a 03 31 30 30 1a 04 31 30 30 30 2a 1f 08 08 10 d6 a7 bf d3 c4 2a 1a 09 4c 6f 6e 67 20 54 e1 bb a9 1a 03 31 30 30 1a 04 31 30 30 30 2a 1f 08 08 10 e6 92 bf d3 c4 2a 1a 09 4c 6f 6e 67 20 54 e1 bb a9 1a 03 31 30 30 1a 04 31 30 30 30 2a 1f 08 08 10 86 fe be d3 c4 2a 1a 09 4c 6f 6e 67 20 54 e1 bb a9 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 ea a2 e6 d2 c4 2a 1a 08 48 61 54 72 69 41 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 d9 83 db d1 c4 2a 1a 08 48 69 65 75 44 61 72 74 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 ba ec da d1 c4 2a 1a 08 48 69 65 75 44 61 72 74 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 fe d5 da d1 c4 2a 1a 08 48 69 65 75 44 61 72 74 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 f7 bc da d1 c4 2a 1a 08 48 69 65 75 44 61 72 74 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 80 d9 b7 cb c4 2a 1a 08 48 61 54 72 69 41 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 aa c2 b7 cb c4 2a 1a 08 48 61 54 72 69 41 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 a8 ab b7 cb c4 2a 1a 08 48 61 54 72 69 41 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 ad bf 97 cb c4 2a 1a 0b 54 6f c3 a0 6e 20 43 e1 ba ad 75 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 9b a8 97 cb c4 2a 1a 0b 54 6f c3 a0 6e 20 43 e1 ba ad 75 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 9b 94 97 cb c4 2a 1a 0b 54 6f c3 a0 6e 20 43 e1 ba ad 75 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 b1 ff 96 cb c4 2a 1a 0b 54 6f c3 a0 6e 20 43 e1 ba ad 75 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 ba 9d c7 ca c4 2a 1a 08 4e 68 c6 b0 20 4c 61 69 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 ca 89 c7 ca c4 2a 1a 08 4e 68 c6 b0 20 4c 61 69 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 8d f5 c6 ca c4 2a 1a 08 4e 68 c6 b0 20 4c 61 69 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 d7 de c6 ca c4 2a 1a 08 4e 68 c6 b0 20 4c 61 69 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 fb c2 aa c9 c4 2a 1a 0b 50 68 e1 ba ad 74 20 54 e1 bb 95 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 b5 ae aa c9 c4 2a 1a 0b 50 68 e1 ba ad 74 20 54 e1 bb 95 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 cd 9a aa c9 c4 2a 1a 0b 50 68 e1 ba ad 74 20 54 e1 bb 95 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 91 86 aa c9 c4 2a 1a 0b 50 68 e1 ba ad 74 20 54 e1 bb 95 1a 03 31 30 30 1a 04 31 30 30 30 2a 1f 08 08 10 ef c3 99 c9 c4 2a 1a 09 48 c6 b0 20 74 72 c3 ba 63 1a 03 31 30 30 1a 04 31 30 30 30 2a 1f 08 08 10 96 a5 99 c9 c4 2a 1a 09 48 c6 b0 20 74 72 c3 ba 63 1a 03 31 30 30 1a 04 31 30 30 30 2a 1f 08 08 10 f7 89 99 c9 c4 2a 1a 09 48 c6 b0 20 74 72 c3 ba 63 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 92 bc de c7 c4 2a 1a 0b 53 65 73 73 68 6f 75 6d 61 72 75 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 cd 81 de c7 c4 2a 1a 0b 53 65 73 73 68 6f 75 6d 61 72 75 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 ee ea dd c7 c4 2a 1a 0b 53 65 73 73 68 6f 75 6d 61 72 75 1a 03 31 30 30 1a 04 31 30 30 30 2a 21 08 08 10 9c a2 dd c7 c4 2a 1a 0b 53 65 73 73 68 6f 75 6d 61 72 75 1a 03 31 30 30 1a 04 31 30 30 30 2a 25 08 08 10 af 88 bb c7 c4 2a 1a 11 54 69 c3 aa cc 89 75 59 c3 aa 75 48 c3 a2 cc 80 75 1a 02 32 30 1a 03 32 30 30 2a 28 08 07 10 be f2 ba c7 c4 2a 1a 11 54 69 c3 aa cc 89 75 59 c3 aa 75 48 c3 a2 cc 80 75 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 28 08 07 10 e1 dc ba c7 c4 2a 1a 11 54 69 c3 aa cc 89 75 59 c3 aa 75 48 c3 a2 cc 80 75 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 25 08 08 10 dd c6 ba c7 c4 2a 1a 11 54 69 c3 aa cc 89 75 59 c3 aa 75 48 c3 a2 cc 80 75 1a 02 32 30 1a 03 32 30 30 2a 25 08 08 10 d8 82 d2 c5 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 2a 25 08 08 10 a6 ee d1 c5 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 2a 25 08 08 10 f3 d9 d1 c5 c4 2a 1a 0f 44 c6 b0 c6 a1 6e 67 20 54 72 e1 ba a1 6e 67 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 ce ce bf c5 c4 2a 1a 08 65 6d 20 54 6f 75 79 61 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 91 ba bf c5 c4 2a 1a 08 65 6d 20 54 6f 75 79 61 1a 03 31 30 30 1a 04 31 30 30 30 2a 1e 08 08 10 b3 d7 ee c3 c4 2a 1a 08 65 6d 20 54 6f 75 79 61 1a 03 31 30 30 1a 04 31 30 30 30 2a 25 08 08 10 91 e4 8b c3 c4 2a 1a 11 54 72 c6 b0 c6 a1 6e 67 20 56 c3 b4 20 4b e1 bb b5 1a 02 32 30 1a 03 32 30 30 2a 25 08 08 10 96 c6 8b c3 c4 2a 1a 11 54 72 c6 b0 c6 a1 6e 67 20 56 c3 b4 20 4b e1 bb b5 1a 02 32 30 1a 03 32 30 30 2a 25 08 08 10 cf b1 8b c3 c4 2a 1a 11 54 72 c6 b0 c6 a1 6e 67 20 56 c3 b4 20 4b e1 bb b5 1a 02 32 30 1a 03 32 30 30 2a 25 08 08 10 e9 9c 8b c3 c4 2a 1a 11 54 72 c6 b0 c6 a1 6e 67 20 56 c3 b4 20 4b e1 bb b5 1a 02 32 30 1a 03 32 30 30 2a 24 08 08 10 9b aa f1 c2 c4 2a 1a 0e 48 6f 61 20 4e 67 c3 b4 6e 20 4d c3 a3 6f 1a 03 31 30 30 1a 04 31 30 30 30 2a 1c 08 07 10 ba da c8 bf c4 2a 1a 05 41 6e 67 6c 65 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 1c 08 07 10 d2 c3 c8 bf c4 2a 1a 05 41 6e 67 6c 65 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 1c 08 07 10 d1 9e c8 bf c4 2a 1a 05 41 6e 67 6c 65 1a 05 31 30 30 30 30 1a 03 31 30 30 2a 22 08 08 10 cf f1 a7 bf c4 2a 1a 0c 54 e1 bb ab 20 4e 67 75 79 c3 aa 6e 1a 03 31 30 30 1a 04 31 30 30 30 2a 22 08 08 10 ff da a7 bf c4 2a 1a 0c 54 e1 bb ab 20 4e 67 75 79 c3 aa 6e 1a 03 31 30 30 1a 04 31 30 30 30 2a 22 08 08 10 ff b6 a7 bf c4 2a 1a 0c 54 e1 bb ab 20 4e 67 75 79 c3 aa 6e 1a 03 31 30 30 1a 04 31 30 30 30 2a 28 08 08 10 c5 8d 8f bf c4 2a 1a 12 4f c3 a1 6e 68 20 48 e1 ba a3 6f 20 4e 67 68 e1 bb 87 1a 03 31 30 30 1a 04 31 30 30 30 2a 28 08 08 10 f4 ec bc be c4 2a 1a 12 4f c3 a1 6e 68 20 48 e1 ba a3 6f 20 4e 67 68 e1 bb 87 1a 03 31 30 30 1a 04 31 30 30 30 2a 28 08 08 10 80 98 b9 be c4 2a 1a 12 4f c3 a1 6e 68 20 48 e1 ba a3 6f 20 4e 67 68 e1 bb 87 1a 03 31 30 30 1a 04 31 30 30 30 2a 1d 08 08 10 94 c9 a7 be c4 2a 1a 09 64 61 69 20 74 68 61 6e 68 1a 02 32 30 1a 03 32 30 30 2a 1d 08 08 10 de ad a7 be c4 2a 1a 09 64 61 69 20 74 68 61 6e 68 1a 02 32 30 1a 03 32 30 30 2a 1d 08 08 10 86 95 a7 be c4 2a 1a 09 64 61 69 20 74 68 61 6e 68 1a 02 32 30 1a 03 32 30 30 2a 1d 08 08 10 bd ba a2 be c4 2a 1a 07 41 6e 68 4b 68 6f 61 1a 03 31 30 30 1a 04 31 30 30 30 2a 1d 08 08 10 e3 a5 a2 be c4 2a 1a 07 41 6e 68 4b 68 6f 61 1a 03 31 30 30 1a 04 31 30 30 30 2a 28 08 08 10 ea f8 ff b9 c4 2a 1a 12 50 68 e1 bb 89 20 4c c3 a3 6e 67 20 56 69 e1 bb 87 74 1a 03 31 30 30 1a 04 31 30 30 30 2a 28 08 08 10 e1 dd ff b9 c4 2a 1a 12 50 68 e1 bb 89 20 4c c3 a3 6e 67 20 56 69 e1 bb 87 74 1a 03 31 30 30 1a 04 31 30 30 30 2a 28 08 08 10 b5 c4 ff b9 c4 2a 1a 12 50 68 e1 bb 89 20 4c c3 a3 6e 67 20 56 69 e1 bb 87 74 1a 03 31 30 30 1a 04 31 30 30 30 2a 1d 08 08 10 91 d0 b8 b9 c4 2a 1a 07 41 6e 68 44 61 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 2a 1d 08 08 10 94 a2 b8 b9 c4 2a 1a 07 41 6e 68 44 61 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 2a 1d 08 08 10 c2 ee b7 b9 c4 2a 1a 07 41 6e 68 44 61 6e 68 1a 03 31 30 30 1a 04 31 30 30 30 2a 1d 08 08 10 b5 c2 f8 b7 c4 2a 1a 07 41 6e 68 4b 68 6f 61 1a 03 31 30 30 1a 04 31 30 30 30 2a 1d 08 08 10 94 f2 d6 b7 c4 2a 1a 07 41 6e 68 4b 68 6f 61 1a 03 31 30 30 1a 04 31 30 30 30 2a 26 08 08 10 c7 88 80 b7 c4 2a 1a 10 4e 67 e1 bb 8d 63 20 c3 81 6e 68 20 48 c3 a0 6e 1a 03 31 30 30 1a 04 31 30 30 30 2a 26 08 08 10 d3 f2 ff b6 c4 2a 1a 10 4e 67 e1 bb 8d 63 20 c3 81 6e 68 20 48 c3 a0 6e 1a 03 31 30 30 1a 04 31 30 30 30 2a 26 08 08 10 fd dc ff b6 c4 2a 1a 10 4e 67 e1 bb 8d 63 20 c3 81 6e 68 20 48 c3 a0 6e 1a 03 31 30 30 1a 04 31 30 30 30 2a 26 08 08 10 e7 c6 ff b6 c4 2a 1a 10 4e 67 e1 bb 8d 63 20 c3 81 6e 68 20 48 c3 a0 6e 1a 03 31 30 30 1a 04 31 30 30 30 2a 22 08 08 10 aa a5 fb b6 c4 2a 1a 0c 4d 79 20 54 c3 ad 6e 20 43 68 c6 b0 1a 03 31 30 30 1a 04 31 30 30 30 2a 22 08 08 10 a0 8d fb b6 c4 2a 1a 0c 4d 79 20 54 c3 ad 6e 20 43 68 c6 b0 1a 03 31 30 30 1a 04 31 30 30 30 2a 22 08 08 10 8d f8 fa b6 c4 2a 1a 0c 4d 79 20 54 c3 ad 6e 20 43 68 c6 b0 1a 03 31 30 30 1a 04 31 30 30 30 2a 23 08 08 10 e8 f1 e0 b6 c4 2a 1a 0d 70 68 75 20 74 69 c3 aa 6e 20 73 69 68 1a 03 31 30 30 1a 04 31 30 30 30 12 00 18 00 22 24 0a 04 08 03 10 0a 0a 04 08 06 10 0a 0a 04 08 01 10 14 0a 04 08 04 10 0a 0a 04 08 02 10 0a 0a 04 08 05 10 0a 28 00";
        String str = strfirst.replaceAll("\\s+","");
		ByteBuffer buff = ByteBuffer.allocate(str.length()/2);
		for (int i = 0; i < str.length(); i+=2) {
		    buff.put((byte)Integer.parseInt(str.substring(i, i+2), 16));
		}
		buff.rewind();
		//Charset cs = Charset.forName("UTF-8");
		
		//CharBuffer output = cs.decode(buff);
		/*
		String strInput2 = "testfile.txt";
	    FileOutputStream out = new FileOutputStream(strInput2);
	    out.write(buff.array());
	    out.close();
	    */
	    //write file
	    //System.out.print(output.toString().getBytes());
		
	    GangAction.PlayerHasGangInfoMessage gangaction = null; 
	    gangaction =	GangAction.PlayerHasGangInfoMessage.parseFrom(buff.array());
	    String formatted_timestamp;
	    String unix_timestamp = "1460979243367";
	    formatted_timestamp = unixToDate(unix_timestamp);
	    long timestamp = Long.parseLong(unix_timestamp);
	    SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd H:mm:ss", Locale.CHINA);
        String date = sdf.format(timestamp);
	    Date now = new Date(timestamp);
	    System.out.println(date);
	    System.out.println(formatted_timestamp);
	   
	    //GangAction.PlayerHasGangInfoMessage gangaction = GangAction.PlayerHasGangInfoMessage.parseFrom(new FileInputStream(args[0]));
        //System.out.println(gangaction);
       
        String jsonmap = printGuildMember(gangaction);
        System.out.print(gangaction);
        System.out.print(jsonmap);
    }
    private static String unixToDate(String unix_timestamp) throws ParseException {    
        long timestamp = Long.parseLong(unix_timestamp) * 1000;

        SimpleDateFormat sdf = new SimpleDateFormat("MMMM d, yyyy 'at' h:mm a", Locale.CANADA);
        String date = sdf.format(timestamp);

        return date.toString();
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
		
		
		JSONArray myArray = new JSONArray();
		GangDescInfoMessage gangdes = gangapply.getDescInfo();
		try {
			
			
			
			for (GangMemberInfoMessage memberlist:gangapply.getMemberListList()) {
				//System.out.println(memberlist);
				JSONObject j = new JSONObject();
				j.put("guildid", gangdes.getGangId());
				j.put("guildname", gangdes.getGangName());
				j.put("joindate", memberlist.getJoinTime());
				j.put("roleid", memberlist.getMemberId());
				myArray.put(j);
			}
			System.out.println(myArray);
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		String json = myArray.toString();
		return json;
	}
}

