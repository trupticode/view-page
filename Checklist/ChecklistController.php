<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ChecklistController;


class ChecklistController extends Controller
{
    //
    public function FunChecklistJE(Request $request)
    {
        // dd('ok',$request);
        $workid=$request->workid;
        $tbill_id=$request->t_bill_Id;
        // dd($workid,$tbill_id);

        $stupulatedDate=DB::table('workmasters')
        ->where('Work_Id',$workid)
        ->value('Stip_Comp_Dt');
        // dd($stupulatedDate);

        $DBchklst_jeExist=DB::table('chklst_je')
        ->where('t_bill_Id',$tbill_id)
        ->first();
        // dd($workid,$tbill_id,$DBbillsExist);

        if ($DBchklst_jeExist !== null) 
        {
            // If the record exists, update it
            // dd('ifok');

            $DBChklst=DB::table('chklst_je')
            // ->select('chklst_Id','t_bill_Id','t_bill_No','Work_Nm')
            ->where('t_bill_Id',$tbill_id)
            ->first();
            // dd($DBChklst);
            
            $CTbillid=$DBChklst->t_bill_Id;
            // dd($CTbillid);
            $CTbillno=$DBChklst->t_bill_No;
            $workNM=$DBChklst->Work_Nm;
            $DBAgencyId=$DBChklst->Agency_id;
            $DBjeId=$DBChklst->jeid;

            $DBAgencyName=$DBChklst->agency_nm;
            $DBagency_pl=$DBChklst->Agency_Pl;
            $DBJeName=$DBChklst->je_Nm;

            $DBagency_pl = $DBagency_pl === null ? '' : $DBagency_pl;
            // dd($DBAgencyId,$DBagency_pl);            
            $concateresult=$DBChklst->t_bill_No;

            // dd($concateresult);
            $DBAgreeNO=$DBChklst->Agree_No;
            $DBAgreeDT=$DBChklst->Agree_Dt === null ? '' : $DBChklst->Agree_Dt;
            $A_B_Pc=$DBChklst->A_B_Pc;
            $Above_Below=$DBChklst->Above_Below === null ? '' : $DBChklst->Above_Below;
            $Stip_Comp_Dt=$DBChklst->Stip_Comp_Dt === null ? '' : $DBChklst->Stip_Comp_Dt;
            $Act_Comp_Dt=$DBChklst->Act_Comp_Dt === null ? '' : $DBChklst->Act_Comp_Dt;
            $DBMESUrementDate=$DBChklst->M_B_Dt;
            $Agency_MB_Accept=$DBChklst->Agency_MB_Accept;
            $Part_Red_per= $DBChklst->Part_Red_per;
            $Excess_Qty= $DBChklst->Excess_Qty;
            // dd($Excess_Qty);
            $Ex_qty_det= $DBChklst->Ex_qty_det;
            $Qc_Result= $DBChklst->Qc_Result;
            $Roy_Challen= $DBChklst->Roy_Challen;
            $Bitu_Challen= $DBChklst->Bitu_Challen;
            $Qc_Reports= $DBChklst->Qc_Reports;
            $Board= $DBChklst->Board;
            $CFinalbillhandover =$DBChklst->Handover;
            $CFinalbillForm65=$DBChklst->Form_65;
            $CFinalbill='';


            $Rec_Drg= $DBChklst->Rec_Drg;
            $Je_Chk= $DBChklst->Je_Chk;
            $Je_chk_Dt= $DBChklst->Je_chk_Dt;
            $Dye_chk= $DBChklst->Dye_chk;
            $Dye_chk_Dt= $DBChklst->Dye_chk_Dt;





            $partrtAnalysis=$DBChklst->part_Red_Rt;
            $materialconsu=$DBChklst->Mc_Stat;
            $Recoverystatement=$DBChklst->Rec_Stat;
            $Excesstatement=$DBChklst->Es_Stat;
            $Royaltystatement=$DBChklst->Roy_Stat;
            // dd($Royaltystatement);

            $Jephoto=$DBChklst->Photo_Docs;
            // dd($Jephoto);
            $photo=DB::table('bills')
            ->where('t_bill_id',$CTbillid)
            ->select('photo1','photo2','photo3','photo4','photo5')
            ->first();

            // dd($photo1);

            $countphoto = 0; // Initialize count to zero
            if ($photo !== null) {
                // Convert the object to an array and remove null values
                $photoArray = array_filter((array)$photo);
                // Count the non-null values
                $countphoto = count($photoArray);
            }

            // dd($Jephoto, $countphoto);


            $document = DB::table('bills')
            ->where('t_bill_id', $CTbillid)
            ->select('doc1', 'doc2', 'doc3', 'doc4', 'doc5', 'doc6', 'doc7', 'doc8', 'doc9', 'doc10')
            ->first();
        
        $countdoc = 0; // Initialize count to zero
        if ($document !== null) 
            {
                        // Convert the object to an array and remove null values
                        $documentArray = array_filter((array)$document);
                        // Count the non-null values
                        $countdoc = count($documentArray);
            }
        
        // dd($document, $countdoc);
        
        $vedio = DB::table('bills')
        ->where('t_bill_id', $CTbillid)
        ->value('vdo');
    
    $countvideo = $vedio ? 1 : 0; // If video exists, count it as 1, else 0
    
    // dd($vedio, $countvideo);

    $Agencychedate=DB::table('bills')
    ->where('t_bill_id', $CTbillid)
    ->value('Agency_Check_Date');
    // dd($Agencychedate);


        } 
        else 
        {
            $tbill_id=$request->t_bill_Id;

            // If the record does not exist, insert a new record save Record
            // dd('elseok',$tbill_id);
            $DBbillData=DB::table('bills')
            ->select('work_id','t_bill_Id','t_bill_No','final_bill')
            ->where('t_bill_Id',$tbill_id)
            ->first();
            // dd($DBbillData);
            $CTbillid=$DBbillData->t_bill_Id;
            $CTbillno=$DBbillData->t_bill_No;
            $CFinalbill=$DBbillData->final_bill;

            $CFinalbillForm65=$DBbillData->final_bill;
            $CFinalbillhandover =$DBbillData->final_bill;
            $Board =$DBbillData->final_bill;


            $DBbillWorkid=$DBbillData->work_id;
            // dd($DBbillData,$DBbillWorkid, $CTbillid,$CFinalbill);

            $CFinalbillForm65 = $CFinalbillForm65 === 1 ? 'Yes' : 'Not Applicable';
            $CFinalbillhandover = 'Not Applicable';
            $Board = $Board === 1 ? 'Yes' : 'Not Applicable';



            $DBWorkmaterDate=DB::table('workmasters')
            ->select('Work_Nm','Agency_Nm','Agency_Id','jeid','Agree_No','Agree_Dt','A_B_Pc','Above_Below','Stip_Comp_Dt'
            ,'Act_Comp_Dt')
            ->where('Work_Id',$DBbillWorkid)
            ->first();
            $workNM=$DBWorkmaterDate->Work_Nm;
            $DBAgencyId=$DBWorkmaterDate->Agency_Id;
            // dd($DBAgencyId);
            $DBjeId=$DBWorkmaterDate->jeid;

            $DBAgencyName=$DBWorkmaterDate->Agency_Nm;

            $DBagency_pl=DB::table('agencies')
            ->where('id',$DBAgencyId)
            ->value('Agency_Pl');
            $DBagency_pl = $DBagency_pl === null ? '' : $DBagency_pl;
            // dd($DBAgencyId,$DBagency_pl);
            $DBJeName=DB::table('jemasters')
            ->where('jeid',$DBAgencyId=$DBWorkmaterDate->jeid)
            ->value('name');
            // dd($DBAgencyId=$DBWorkmaterDate->jeid,$DBJeName);
            $tbillnoFUN=CommonHelper::formatTItemNo($CTbillno);
            $finalbillFun=CommonHelper:: getBillType($CFinalbill);

            // Add space to $tbillnoFUN
            $tbillnoFUN = str_pad($tbillnoFUN, strlen($tbillnoFUN) + 2, ' ', STR_PAD_RIGHT);
            // Add space to $finalbillFun
            $finalbillFun = str_pad($finalbillFun, strlen($finalbillFun) + 2, ' ', STR_PAD_RIGHT);

            $concateresult=$tbillnoFUN.$finalbillFun;
            // dd($concateresult);
            $DBAgreeNO=$DBWorkmaterDate->Agree_No;
            $DBAgreeDT=$DBWorkmaterDate->Agree_Dt === null ? '' : $DBWorkmaterDate->Agree_Dt;
            $A_B_Pc=$DBWorkmaterDate->A_B_Pc;
            $Above_Below=$DBWorkmaterDate->Above_Below === null ? '' : $DBWorkmaterDate->Above_Below;
            $Stip_Comp_Dt=$DBWorkmaterDate->Stip_Comp_Dt === null ? '' : $DBWorkmaterDate->Stip_Comp_Dt;
            $Act_Comp_Dt=$DBWorkmaterDate->Act_Comp_Dt === null ? '' : $DBWorkmaterDate->Act_Comp_Dt;
            $DBMESUrementDate=DB::table('embs')
            ->where('t_bill_id',$CTbillid)
            ->where('Work_Id',$DBbillWorkid)
            ->max('measurment_dt');
            // dd($DBMESUrementDate);
            // dd($DBAgreeNO,$DBAgreeDT,$A_B_Pc,$Above_Below,$Stip_Comp_Dt,$Act_Comp_Dt);

            $DBMESUrementDate=$DBMESUrementDate === null ? '' : $DBMESUrementDate;
            $partrtAnalysis=DB::table('part_rt_ms')
            ->where('t_bill_id',$CTbillid)->where('work_id',$DBbillWorkid)->value('t_bill_id');
            // dd($partrtAnalysis);
            // $partrtAnalysis=$partrtAnalysis === null ? '' : $partrtAnalysis;
            $partrtAnalysis = $partrtAnalysis !== null ? 'Yes' : 'Not Applicable';



            $materialconsu=DB::table('mat_cons_m')
            ->where('t_bill_id',$CTbillid)
            ->value('t_bill_id');
            // dd($materialconsu);
            // $materialconsu=$materialconsu === null ? '' : $materialconsu;
            $materialconsu = $materialconsu !== null ? 'Yes' : 'Not Applicable';


            $Recoverystatement=DB::table('recoveries')
            ->where('t_bill_id',$CTbillid)
            ->value('t_bill_id');
            // $Recoverystatement=$Recoverystatement === null ? '' : $Recoverystatement;
            $Recoverystatement = $Recoverystatement !== null ? 'Yes' : 'Not Applicable';

            // dd($Recoverystatement);

            $Excesstatement=DB::table('bil_item')
            ->where('t_bill_id',$CTbillid)
            ->value('t_bill_id');
            // $Excesstatement=$Excesstatement === null ? '' : $Excesstatement;
            $Excesstatement = $Excesstatement !== null ? 'Yes' : 'Not Applicable';

            // dd($Excesstatement);

            $Royaltystatement=DB::table('royal_m')
            ->where('t_bill_id',$CTbillid)
            ->value('t_bill_id');
            // $Royaltystatement=$Royaltystatement === null ? '' : $Royaltystatement;
            $Royaltystatement = $Royaltystatement !== null ? 'Yes' : 'Not Applicable';

            // dd($Royaltystatement);

            $photo=DB::table('bills')
            ->where('t_bill_id',$CTbillid)
            ->select('photo1','photo2','photo3','photo4','photo5')
            ->first();
            // dd($photo);
         $Jephoto = ($photo->photo1 || $photo->photo2 || $photo->photo3 || $photo->photo4 || $photo->photo5) ? 'Yes' : 'Not Applicable';
        // dd($Jephoto);
            $countphoto = 0; // Initialize count to zero
            if ($photo !== null) {
                // Convert the object to an array and remove null values
                $photoArray = array_filter((array)$photo);
                // Count the non-null values
                $countphoto = count($photoArray);
            }

            // dd($photo, $countphoto);


            $document = DB::table('bills')
            ->where('t_bill_id', $CTbillid)
            ->select('doc1', 'doc2', 'doc3', 'doc4', 'doc5', 'doc6', 'doc7', 'doc8', 'doc9', 'doc10')
            ->first();
        
        $countdoc = 0; // Initialize count to zero
        if ($document !== null) {
            // Convert the object to an array and remove null values
            $documentArray = array_filter((array)$document);
            // Count the non-null values
            $countdoc = count($documentArray);
        }
        
        // dd($document, $countdoc);
        
        $vedio = DB::table('bills')
        ->where('t_bill_id', $CTbillid)
        ->value('vdo');
    
    $countvideo = $vedio ? 1 : 0; // If video exists, count it as 1, else 0
    
    // dd($vedio, $countvideo);
    $Agency_MB_Accept='Yes';
    $Part_Red_per= 'Not Required';
    $Excess_Qty = 'No';
    $Ex_qty_det= 'Not Required';
    $Qc_Result= 'Yes';
    $Roy_Challen = 'No';
    $Bitu_Challen = 'No';
    $Qc_Reports= 'Yes';
    $Rec_Drg= 'No';
    $Je_Chk= '';
    $Je_chk_Dt= '';
    $Dye_chk= '';
    $Dye_chk_Dt= '';
    $Agencychedate=DB::table('bills')
    ->where('t_bill_id', $CTbillid)
    ->value('Agency_Check_Date');
    // dd($Agencychedate);

        }

        // $DBworkmaster::table('workmasters')
        // ->select('Work_Id',)
        return view('Checklist.Checklistje',compact('workid','stupulatedDate','workNM','CTbillid','DBAgencyName','DBagency_pl','DBJeName','concateresult','DBAgreeNO','DBAgreeDT',
    'A_B_Pc','Above_Below','Stip_Comp_Dt','Act_Comp_Dt','DBMESUrementDate','partrtAnalysis','materialconsu',
    'Recoverystatement','Excesstatement','Royaltystatement','Jephoto','countphoto','document','countdoc','vedio',
    'countvideo','CFinalbill','CTbillno','DBchklst_jeExist','DBAgencyId','DBjeId','CFinalbillForm65','CFinalbillhandover',
    'Agency_MB_Accept','Part_Red_per','Excess_Qty','Ex_qty_det','Qc_Result','Roy_Challen','Bitu_Challen',
'Qc_Reports','Board','Rec_Drg','Je_Chk','Je_chk_Dt','Dye_chk','Dye_chk_Dt','Agencychedate'));
    }


    public function FunSaveChecklistJE(Request $request)
    {
        // dd('ok',$request);
        $tbillid=$request->input('tbill_id');
        $Work_Id=DB::table('bills')
        ->where('t_bill_Id', $tbillid)
        ->value('work_id');
        // dd($tbillid,$workId);
        $action = $request->input('action');

        $Excess_Qty = 'No';
        $Ex_qty_det= 'Not Required';
        $Bitu_Challen = 'No';
        $CFinalbillhandover = 'Not Applicable';
        $Rec_Drg= 'No';

            if ($action === 'save') 
            {
                $tbillid=$request->input('tbill_id');
                $Stip_Comp_Dt=$request->input('Stip_Comp_Dt');
                $MBDT=$request->input('MBDT');
                // dd($MBDT,$Stip_Comp_Dt);

                $Work_Id=DB::table('bills')
                ->where('t_bill_Id', $tbillid)
                ->value('work_id');
                // dd($tbillid,$workId);
        
                        // dd('ok',$request);
                        $radio_excessquantity=$request->input('ExcessQty');
                        // dd('ok',$request,$radio_excessquantity);

                // dd($action);
        $workNM=$request->work_nm;
        // dd($workNM);
        $Savechklist = DB::table('chklst_je')->insert
        ([
            
        't_bill_Id' => $request->input('tbill_id'),
        'Work_Nm'=> $workNM,
        'Agency_id'=> $request->input('AgencyId'),
        'agency_nm'=> $request->input('AgencyNM'),
        'Agency_Pl'=> $request->input('Agency_PL'),
        'jeid'=> $request->input('JEId'),
        'je_Nm'=> $request->input('JeName'),
        't_bill_No'=> $request->input('concateresultbillno'),
        'Agree_No'=> $request->input('AgreeNO'),
        'Agree_Dt'=> $request->input('AgreeDT'),
        'A_B_Pc'=> $request->input('A_B_Pc'),
        'Above_Below'=> $request->input('Above_Below'),
        'Stip_Comp_Dt'=> $request->input('Stip_Comp_Dt'),
        'Act_Comp_Dt'=> $request->input('Act_Comp_Dt'),
        'M_B_No'=> $request->input('MBNO'),
        'M_B_Dt'=> $request->input('MBDT'),

        'Agency_MB_Accept'=> $request->input('radio_Contractorsigned'),
        'part_Red_Rt'=> $request->input('radio_Analysis'),
        'Part_Red_per'=> $request->input('radio_authority'),
        'Excess_Qty'=> $Excess_Qty,
        'Ex_qty_det'=> $Ex_qty_det,
        'Qc_Result'=> $request->input('radio_Q_C_Results'),
        'Mc_Stat'=> $request->input('radio_Material'),
        'Rec_Stat'=> $request->input('radio_Recovery'),
        'Es_Stat'=> $request->input('radio_Excess'),
        'Roy_Stat'=> $request->input('radio_Royalty'),
        'Photo_Docs'=> $request->input('radio_photo'),
        'Roy_Challen'=> $request->input('radio_RoyaltyChallen'),
        'Bitu_Challen'=> $Bitu_Challen,
        'Qc_Reports'=> $request->input('radio_Q_C'),
        'Board'=> $request->input('radio_Board'),
        'Form_65'=> $request->input('radio_Form_65'),
        'Handover'=> $CFinalbillhandover,
        'Rec_Drg'=> $Rec_Drg,

        'Je_Chk'=> 1,
        'Je_chk_Dt'=> $request->input('JEdate'),
        // 'Dye_chk'=> $request->input('tbill_id'),
        // 'Dye_chk_Dt'=> $request->input('tbill_id'),
            ]);
            }

            elseif ($action === 'update') 
            {
                $tbillid=$request->input('tbill_id');
                $Work_Id=DB::table('bills')
                ->where('t_bill_Id', $tbillid)
                ->value('work_id');
                // dd($tbillid,$Work_Id);
        
                // dd($action);
                // dd('ok',$request);

     $Update = DB::table('chklst_je')
    ->where('t_bill_Id', $request->input('tbill_id'))
    ->update([
        'Work_Nm' =>  $request->input('work_nm'),
        'Agency_id' => $request->input('AgencyId'),
        'agency_nm' => $request->input('AgencyNM'),
        'Agency_Pl' => $request->input('Agency_PL'),
        'jeid' => $request->input('JEId'),
        'je_Nm' => $request->input('JeName'),
        't_bill_No' => $request->input('concateresultbillno'),
        'Agree_No' => $request->input('AgreeNO'),
        'Agree_Dt' => $request->input('AgreeDT'),
        'A_B_Pc' => $request->input('A_B_Pc'),
        'Above_Below' => $request->input('Above_Below'),
        'Stip_Comp_Dt' => $request->input('Stip_Comp_Dt'),
        'Act_Comp_Dt' => $request->input('Act_Comp_Dt'),
        'M_B_No' => $request->input('MBNO'),
        'M_B_Dt' => $request->input('MBDT'),
        'Agency_MB_Accept' => $request->input('radio_Contractorsigned'),
        'part_Red_Rt' => $request->input('radio_Analysis'),
        'Part_Red_per' => $request->input('radio_authority'),
        'Excess_Qty' => $Excess_Qty,
        'Ex_qty_det' => $Ex_qty_det,
        'Qc_Result' => $request->input('radio_Q_C_Results'),
        'Mc_Stat' => $request->input('radio_Material'),
        'Rec_Stat' => $request->input('radio_Recovery'),
        'Es_Stat' => $request->input('radio_Excess'),
        'Roy_Stat' => $request->input('radio_Royalty'),
        'Photo_Docs' => $request->input('radio_photo'),
        'Roy_Challen' => $request->input('radio_RoyaltyChallen'),
        'Bitu_Challen' => $Bitu_Challen,
        'Qc_Reports' => $request->input('radio_Q_C'),
        'Board' => $request->input('radio_Board'),
        'Form_65' => $request->input('radio_Form_65'),
        'Handover' => $CFinalbillhandover,
        'Rec_Drg' => $Rec_Drg,
        'Je_Chk' => 1,
        'Je_chk_Dt' => $request->input('JEdate'),
        // 'Dye_chk' => $request->input('tbill_id'),
        // 'Dye_chk_Dt' => $request->input('tbill_id'),
        ]);

        // return redirect()->route('listemb', ['Work_Id' => $Work_Id]);


            }    

            $updateMbstatus = DB::table('bills')
            ->where('t_bill_id', $tbillid)
            ->update(['mb_status' => 7]);


            return redirect()->route('billlist', ['workid' => $Work_Id]);

        //     $id = $tbillid; // Assuming $Work_Id is already defined

        // // Construct the URL using the route() helper function
        // $url = route('emb.workmasterdata', ['id' => $id]);
        //     return redirect()->to($url);      
        
        }


        public function FunChecklistSDC(Request $request)
        {
            $workid=$request->workid;
            $tbill_id=$request->t_bill_Id;
            // dd($workid,$tbill_id);
            $stupulatedDate=DB::table('workmasters')
            ->where('Work_Id',$workid)
            ->value('Stip_Comp_Dt');
            // dd($stupulatedDate);
    
            $DBchklst_sdcExist=DB::table('chklst_sdc')
            ->where('t_bill_Id',$tbill_id)
            ->first();
            // dd($workid,$tbill_id,$DBchklst_sdcExist);
    
            if ($DBchklst_sdcExist !== null) 
            {
                // If the record exists, update it
                // dd('ifok');
                $DBChklstSDC=DB::table('chklst_sdc')
                // ->select('chklst_Id','t_bill_Id','t_bill_No','Work_Nm')
                ->where('t_bill_Id',$tbill_id)
                ->first();
                // dd($DBChklstSDC);

                $Jechecklast=DB::table('chklst_je')
                ->where('t_bill_Id',$tbill_id)
                ->value('Je_chk_Dt');
                // dd($Jechecklast);

                
                $CTbillid=$DBChklstSDC->t_bill_Id;
                $workNM=$DBChklstSDC->Work_Nm;
                $F_H_Code=$DBChklstSDC->F_H_Code;
                $fundheadList=DB::table('fundhdms')
                ->select('Fund_Hd_M')
                ->get();
                // dd($fundheadList);

                $Arith_chk=$DBChklstSDC->Arith_chk;
                $Sdc_chk=$DBChklstSDC->Sdc_chk;
                $Sdc_chk_dt=$DBChklstSDC->Sdc_chk_dt;


            } 
            else 
            {
                // If the record does not exist, insert a new record save Record
                // dd('elseok');
                $DBbillData=DB::table('bills')
                ->select('work_id','t_bill_Id','t_bill_No','final_bill')
                ->where('t_bill_Id',$tbill_id)
                ->first();
                
                $CTbillid=$DBbillData->t_bill_Id;
                $CTbillno=$DBbillData->t_bill_No;
                $CFinalbill=$DBbillData->final_bill;
                $DBbillWorkid=$DBbillData->work_id;
                // dd($DBbillData,$DBbillWorkid, $CTbillid,$CFinalbill);
                $CFinalbill = $CFinalbill === 1 ? 'Yes' : 'Not Applicable';
                $DBWorkmaterDate=DB::table('workmasters')
                ->select('Work_Nm','Agency_Nm','F_H_Code','Agency_Id','jeid','Agree_No','Agree_Dt','A_B_Pc','Above_Below','Stip_Comp_Dt'
                ,'Act_Comp_Dt')
                ->where('Work_Id',$DBbillWorkid)
                ->first();

                $Jechecklast=DB::table('chklst_je')
                ->where('t_bill_Id',$tbill_id)
                ->value('Je_chk_Dt');
                // dd($Jechecklast);
                $F_H_Code=$DBWorkmaterDate->F_H_Code;
                $fundheadList=DB::table('fundhdms')
                ->select('Fund_Hd_M')
                ->get();
                // dd($fundheadList);

                $workNM=$DBWorkmaterDate->Work_Nm;
                $Arith_chk='Yes';
                $Sdc_chk='';
                $Sdc_chk_dt='';

        
            }
            return view('Checklist.ChecklistSDC',compact('DBchklst_sdcExist','F_H_Code','workNM','CTbillid','Arith_chk',
        'Sdc_chk','Sdc_chk_dt','workid','Jechecklast','stupulatedDate','fundheadList'));
        }


        public function FunSaveChecklistSDC(Request $request)
        {

            $action=$request->action;
            $tbillid=$request->tbill_id;
            // dd($request,$action,$tbillid);


            if ($action === 'save') 
            {
                $tbillid=$request->input('tbill_id');
                $Work_Id=DB::table('bills')
                ->where('t_bill_Id', $tbillid)
                ->value('work_id');
                // dd($tbillid,$workId);
        
                        // dd('ok',$request);
                // dd($action);
        $workNM=$request->work_nm;
        // dd($workNM);
        $SavechklistSDC = DB::table('chklst_sdc')->insert
        ([
        't_bill_Id' => $request->input('tbill_id'),
        'Work_Nm'=> $workNM,
        'F_H_Code'=> $request->input('F_H_Code'),
        'Arith_chk'=> $request->input('Arith_chk'),
        'Sdc_chk'=> 1,
        'Sdc_chk_dt'=> $request->input('SDCdate'),
        // 'Dye_chk'=> $request->input('tbill_id'),
        // 'Dye_chk_Dt'=> $request->input('tbill_id'),
            ]);

            }

            if ($action === 'update') 
            {
                // dd($action);
                $tbillid=$request->input('tbill_id');
                $Work_Id=DB::table('bills')
                ->where('t_bill_Id', $tbillid)
                ->value('work_id');
                // dd($tbillid,$workId);
        
                        // dd('ok',$request);
                // dd($action);
        $workNM=$request->work_nm;
        // dd($workNM);

        $UpdatechklistSDC = DB::table('chklst_sdc')
        ->where('t_bill_Id', $request->input('tbill_id'))
        ->update([
        't_bill_Id' => $request->input('tbill_id'),
        'Work_Nm'=> $workNM,
        'F_H_Code'=> $request->input('F_H_Code'),
        'Arith_chk'=> $request->input('Arith_chk'),
        'Sdc_chk'=> 1,
        'Sdc_chk_dt'=> $request->input('SDCdate'),
        // 'Dye_chk'=> $request->input('tbill_id'),
        // 'Dye_chk_Dt'=> $request->input('tbill_id'),
            ]);

            // $Updateworkmaster = DB::table('workmasters')
            // ->where('Work_Id', $Work_Id)
            // ->update(['F_H_Code' => $request->input('F_H_Code')]);

        }
            $updateMbstatus = DB::table('bills')
            ->where('t_bill_id', $tbillid)
            ->update(['mb_status' => 8]);



            return redirect()->route('billlist', ['workid' => $Work_Id]);

        }


        public function FunChecklistDYE(Request $request)
        {
                // dd($request,'ok');
                $t_bill_Id=$request->t_bill_Id;
                // dd($request,$t_bill_Id);
                $workID=DB::table('bills')
                ->where('t_bill_id',$t_bill_Id)
                ->value('work_id');
                // dd($workID);
                $stupulatedDate=DB::table('workmasters')
                ->where('Work_Id',$workID)
                ->value('Stip_Comp_Dt');
                // dd($stupulatedDate);
    
                $DBchklst_jeRelatedTbillid=DB::table('chklst_je')
                ->where('t_bill_id',$t_bill_Id)
                ->first();
                // dd( $DBchklst_jeRelatedTbillid);
                $CTbillid=$t_bill_Id;
                $workNM=$DBchklst_jeRelatedTbillid->Work_Nm;
                // dd( $DBchklst_jeRelatedTbillid,$workNM);
                $DBAgencyId=$DBchklst_jeRelatedTbillid->Agency_id;
                $DBAgencyName=$DBchklst_jeRelatedTbillid->agency_nm;
                $DBagency_pl=$DBchklst_jeRelatedTbillid->Agency_Pl;
                $DBjeId=$DBchklst_jeRelatedTbillid->jeid;
                $DBJeName=$DBchklst_jeRelatedTbillid->je_Nm;
                $concateresult=$DBchklst_jeRelatedTbillid->t_bill_No;
                $DBAgreeNO=$DBchklst_jeRelatedTbillid->Agree_No;
                $DBAgreeDT=$DBchklst_jeRelatedTbillid->Agree_Dt;
                $A_B_Pc=$DBchklst_jeRelatedTbillid->A_B_Pc;
                $Above_Below=$DBchklst_jeRelatedTbillid->Above_Below;
                $Stip_Comp_Dt=$DBchklst_jeRelatedTbillid->Stip_Comp_Dt;
                $Act_Comp_Dt=$DBchklst_jeRelatedTbillid->Act_Comp_Dt;
                $CTbillid=$DBchklst_jeRelatedTbillid->M_B_No;
                $DBMESUrementDate=$DBchklst_jeRelatedTbillid->M_B_Dt;
                $Agency_MB_Accept=$DBchklst_jeRelatedTbillid->Agency_MB_Accept;
                $partrtAnalysis=$DBchklst_jeRelatedTbillid->part_Red_Rt;
                $Part_Red_per=$DBchklst_jeRelatedTbillid->Part_Red_per;
                $Excess_Qty=$DBchklst_jeRelatedTbillid->Excess_Qty;
                $Ex_qty_det=$DBchklst_jeRelatedTbillid->Ex_qty_det;
                $Qc_Result=$DBchklst_jeRelatedTbillid->Qc_Result;
                $materialconsu=$DBchklst_jeRelatedTbillid->Mc_Stat;
                $Recoverystatement=$DBchklst_jeRelatedTbillid->Rec_Stat;
                $Excesstatement=$DBchklst_jeRelatedTbillid->Es_Stat;
                $Royaltystatement=$DBchklst_jeRelatedTbillid->Roy_Stat;
                $photo=$DBchklst_jeRelatedTbillid->Photo_Docs;
                // dd($photo);

                $photo1=DB::table('bills')
                ->where('t_bill_id',$CTbillid)
                ->select('photo1','photo2','photo3','photo4','photo5')
                ->first();
                $photo1 = $photo !== null ? 'Yes' : 'Not Applicable';
    
                $countphoto = 0; // Initialize count to zero
                if ($photo1 !== null) {
                    // Convert the object to an array and remove null values
                    $photoArray = array_filter((array)$photo1);
                    // Count the non-null values
                    $countphoto = count($photoArray);
                }
    
                // dd($photo, $countphoto);
    
    
                $document = DB::table('bills')
                ->where('t_bill_id', $CTbillid)
                ->select('doc1', 'doc2', 'doc3', 'doc4', 'doc5', 'doc6', 'doc7', 'doc8', 'doc9', 'doc10')
                ->first();
            
            $countdoc = 0; // Initialize count to zero
            if ($document !== null) {
                // Convert the object to an array and remove null values
                $documentArray = array_filter((array)$document);
                // Count the non-null values
                $countdoc = count($documentArray);
            }
            
            // dd($document, $countdoc ,$photo1, $countphoto);
            
            $vedio = DB::table('bills')
            ->where('t_bill_id', $CTbillid)
            ->value('vdo');
        
        $countvideo = $vedio ? 1 : 0; // If video exists, count it as 1, else 0
    

                $Roy_Challen=$DBchklst_jeRelatedTbillid->Roy_Challen;
                $Bitu_Challen=$DBchklst_jeRelatedTbillid->Bitu_Challen;
                $Qc_Reports=$DBchklst_jeRelatedTbillid->Qc_Reports;
                $Board=$DBchklst_jeRelatedTbillid->Board;
                $CFinalbill=$DBchklst_jeRelatedTbillid->Form_65;
                $Handover=$DBchklst_jeRelatedTbillid->Handover;

                $Rec_Drg=$DBchklst_jeRelatedTbillid->Rec_Drg;
                $Je_Chk=$DBchklst_jeRelatedTbillid->Je_Chk;
                $Je_chk_Dt=$DBchklst_jeRelatedTbillid->Je_chk_Dt;
                $SODYEchk=$DBchklst_jeRelatedTbillid->Dye_chk;
                $SODYEchk_Dt=$DBchklst_jeRelatedTbillid->Dye_chk_Dt;

//UI SDC Form Nessasary data get

                $DBSDCgetdata=DB::table('chklst_sdc')
                ->where('t_bill_id',$t_bill_Id)
                ->first();
                // dd($DBSDCgetdata);
                $SDCTbillId=$DBSDCgetdata->t_bill_Id;
                $SDCWork_Nm=$DBSDCgetdata->Work_Nm;
                $SDCFHCODE=$DBSDCgetdata->F_H_Code;
                $SDCArith_chk=$DBSDCgetdata->Arith_chk;
                // dd($SDCArith_chk);
                $SDCSdc_chk=$DBSDCgetdata->Sdc_chk;
                $SDCSdc_chk_Dt=$DBSDCgetdata->Sdc_chk_dt;
                $SDCDye_chk=$DBSDCgetdata->Dye_chk;
                $SDCDye_chk_Dt=$DBSDCgetdata->Dye_chk_Dt;




                return view ('Checklist.ChecklistDYE',compact('workID','CTbillid','workNM','DBAgencyId','DBAgencyName','DBagency_pl','DBjeId',
            'DBJeName','concateresult','DBAgreeNO','DBAgreeDT','A_B_Pc','Above_Below','Stip_Comp_Dt','Act_Comp_Dt','CTbillid',
        'DBMESUrementDate','Agency_MB_Accept','partrtAnalysis','Part_Red_per','Excess_Qty','Ex_qty_det','Qc_Result','materialconsu',
    'Recoverystatement','Excesstatement','Royaltystatement','photo','Roy_Challen','Bitu_Challen','Qc_Reports','Board','CFinalbill','Handover','Rec_Drg',
'Je_Chk','Je_chk_Dt','countphoto','countdoc','countvideo','SODYEchk','SODYEchk_Dt',
'SDCTbillId','SDCWork_Nm','SDCFHCODE','SDCArith_chk','SDCSdc_chk','SDCSdc_chk_Dt','SDCDye_chk',
'SDCDye_chk_Dt','stupulatedDate'));
        }


        public function FunDyeChkAndDate(Request $request)
              {
                    // dd('ok',$request);
                    $tbill_id=$request->tbill_id;

                    $workID=DB::table('bills')
                    ->where('t_bill_id', $tbill_id)
                    ->value('work_id');
                    // dd($workID);
    

                    $UpdatejechklstTable = DB::table('chklst_je')
                    ->where('t_bill_id', $tbill_id)
                    ->update([
                        'Dye_chk' => 1,
                        'Dye_chk_Dt' => $request->SODYEdate
                    ]);

                    $UpdateSDCchklstTable = DB::table('chklst_sdc')
                    ->where('t_bill_Id', $tbill_id)
                    ->update([
                        'Dye_chk' => 1,
                        'Dye_chk_Dt' => $request->SDCDYEdate
                    ]);

                    $updateMbstatus = DB::table('bills')
                    ->where('t_bill_id', $tbill_id)
                    ->update(['mb_status' => 9]);
        
                    return redirect()->route('billlist', ['workid' => $workID]);
                }


                public function FunChecklistPO(Request $request)
                {
                    // dd($request);
                    $t_bill_Id=$request->t_bill_Id;
                    // dd($request,$t_bill_Id);

                    $DBchklst_POExist=DB::table('chklst_pb')
                    ->where('t_bill_Id',$t_bill_Id)
                    ->first();
                    // dd($DBchklst_POExist);
                    $workid=DB::table('bills')
                    ->where('t_bill_id',$t_bill_Id)
                    ->value('work_id');
                    // dd($workid);


                    $stupulatedDate=DB::table('workmasters')
                    ->where('Work_Id',$workid)
                    ->value('Stip_Comp_Dt');
                    // dd($stupulatedDate);
        


                    if ($DBchklst_POExist !== null) 
                    {
                        // If the record exists, update it
                        // dd('ifok');
                        $DBChklstpo=DB::table('chklst_pb')
                        // ->select('chklst_Id','t_bill_Id','t_bill_No','Work_Nm')
                        ->where('t_bill_Id',$t_bill_Id)
                        ->first();
                        // dd($DBChklstpo);
                        $workid=DB::table('bills')
                        ->where('t_bill_id',$t_bill_Id)
                        ->value('work_id');
                        // dd($workid);
                        // dd($DBChklstSDC);
                        $workNM=$DBChklstpo->Work_Nm;
                        $SD_chklst=$DBChklstpo->SD_chklst;
                        $QC_T_Done=$DBChklstpo->QC_T_Done;
                        $QC_T_No=$DBChklstpo->QC_T_No;
                        $QC_Result=$DBChklstpo->QC_Result;
                        $SQM_Chk = $DBChklstpo->SQM_Chk;
                        $Part_Red_Rt_Proper=$DBChklstpo->Part_Red_Rt_Proper;
                        $Excess_qty_125=$DBChklstpo->Excess_qty_125;
                        $CL_38_Prop=$DBChklstpo->CL_38_Prop;
                        $CFinalbillBoard=$DBChklstpo->Board;
                        $Rec_Drg=$DBChklstpo->Rec_Drg;
                        $TotRoy=$DBChklstpo->Tot_Roy;
                        $PreTotRoy=$DBChklstpo->Pre_Bill_Roy;
                        $Cur_Bill_Roy_Paid=$DBChklstpo->Cur_Bill_Roy_Paid;
                        $Roy_Rec=$DBChklstpo->Roy_Rec;
                        $Tnd_Amt=$DBChklstpo->Tnd_Amt;
                        $netAmt=$DBChklstpo->Net_Amt;
                        $c_netamt=$DBChklstpo->C_NetAmt;
                        $Act_Comp_Dt=$DBChklstpo->Act_Comp_Dt;
                        $MB_NO=$DBChklstpo->MB_NO;
                        $DBMB_Dt=$DBChklstpo->MB_Dt;
                        $Mess_Mode=$DBChklstpo->Mess_Mode;
                        $Mat_cons=$DBChklstpo->Mat_Cons;
                        $CFinalbillForm65=$DBChklstpo->Form_65;
                        $CFinalbillhandover=$DBChklstpo->Handover;
                        $Red_Est=$DBChklstpo->Red_Est;
                        $PO_Chk=$DBChklstpo->PO_Chk;
                        $PO_Chk_Dt=$DBChklstpo->PO_Chk_Dt;

                        $lstDYEcheckdate=DB::table('chklst_sdc')
                        ->where('t_bill_Id',$t_bill_Id)
                        ->value('Dye_chk_Dt');
                        // dd($lstDYEcheckdate);
                    } 
                    else 
                    {
                        // If the record does not exist, insert a new record save Record
                        // dd('elseok');
                        $workid=DB::table('bills')
                        ->where('t_bill_id',$t_bill_Id)
                        ->value('work_id');
                        // dd($workid);
                        $workNM=DB::table('workmasters')
                        ->where('Work_Id',$workid)
                        ->value('Work_Nm');
                        // dd($workNM);
                        $DBbillData=DB::table('bills')
                        ->select('work_id','t_bill_Id','t_bill_No','final_bill','net_amt','c_netamt')
                        ->where('t_bill_Id',$t_bill_Id)
                        ->first();
                        $CFinalbill=$DBbillData->final_bill;
                        // dd($CFinalbill);
                        $CFinalbill = $CFinalbill === 1 ? 'Yes' : 'Not Applicable';
                        $netAmt=$DBbillData->net_amt;
                        $c_netamt=$DBbillData->c_netamt;
                        $CFinalbillhandover=$DBbillData->final_bill;
                        $CFinalbillhandover = $CFinalbillhandover === 1 ? 'Yes' : 'Not Applicable';
                        $CFinalbillForm65 =$DBbillData->final_bill;
                        $CFinalbillForm65 = $CFinalbillForm65 === 1 ? 'Yes' : 'Not Applicable';
                        $CFinalbillBoard=$DBbillData->final_bill;
                        $CFinalbillBoard = $CFinalbillBoard === 1 ? 'Yes' : 'Not Applicable';


                        $TotRoy=DB::table('royal_m')
                        ->where('t_bill_id',$t_bill_Id)
                        ->sum('royal_amt');
                        // dd($TotRoy);
                        
                        $commonHelper = new CommonHelper();
                        // Call the customRound method on the instance
                        $TotRoy = $commonHelper->customRound($TotRoy); 
                        // dd($TotRoy);


                        
                        
                        if ($TotRoy == 0) 
                        {
                            $TotRoy = "0.00";
                        }
                        // dd($TotRoy);


                        $previous_t_bill_id = DB::table('royal_m')
                        ->where('t_bill_id', '<', $t_bill_Id)
                        ->max('t_bill_id');
                        // dd($t_bill_Id,$previous_t_bill_id);

                        if ($previous_t_bill_id !== null) 
                        {
                            $PreTotRoy = DB::table('royal_m')
                                ->where('t_bill_id', $previous_t_bill_id)
                                ->sum('royal_amt');
                                // dd($PreTotRoy);
                                
                                $commonHelper = new CommonHelper();
                                // Call the customRound method on the instance
                                $PreTotRoy = $commonHelper->customRound($PreTotRoy); 
                                // dd($PreTotRoy);

                        }
                        else
                        {
                            $PreTotRoy="0.00";
                            // dd($PreTotRoy);
                        }
                                                   
                        // dd($TotRoy,$PreTotRoy);


                        $WorkmasterData=DB::table('workmasters')
                        ->where('Work_Id', $workid)
                        ->select('Tnd_Amt','Act_Comp_Dt')
                        ->first();
                        $Tnd_Amt=$WorkmasterData->Tnd_Amt;
                        $Act_Comp_Dt=$WorkmasterData->Act_Comp_Dt;

                        $MB_NO=$workid;
                        $DBMB_Dt=DB::table('embs')
                        ->where('t_bill_id',$t_bill_Id)
                        ->where('Work_Id',$workid)
                        ->max('measurment_dt');
                        // dd($DBMB_Dt);

                        $Mat_cons=DB::table('mat_cons_m')
                        ->where('t_bill_id',$t_bill_Id)
                        ->value('t_bill_id');
                        // dd($Mat_cons);
                        $Mat_cons = $Mat_cons !== null ? 'Yes' : 'Not Applicable';


                        $SD_chklst='Yes';
                        $QC_T_Done='Yes';
                        $QC_T_No='Yes';
                        $QC_Result='Yes';
                        $SQM_Chk = 'Not Applicable';
                        $Part_Red_Rt_Proper='Not Applicable';
                        $Excess_qty_125='No';
                        $CL_38_Prop='Not Required';
                        $Rec_Drg='Yes';
                        $Cur_Bill_Roy_Paid='0.00';
                        $Roy_Rec='0.00';
                        $Mess_Mode='Yes';
                        $PO_Chk='';
                        $PO_Chk_Dt='';
                        $Red_Est = 'Not Required';


                        $lstDYEcheckdate=DB::table('chklst_sdc')
                        ->where('t_bill_Id',$t_bill_Id)
                        ->value('Dye_chk_Dt');
                        // dd($lstDYEcheckdate);
                
                    }
                    return view('Checklist.checklistPO',compact('workid','stupulatedDate','workNM','t_bill_Id','TotRoy','PreTotRoy',
                'Tnd_Amt','Act_Comp_Dt','netAmt','c_netamt','DBMB_Dt','Mat_cons','DBchklst_POExist','CFinalbillhandover',
            'CFinalbillForm65','CFinalbillBoard','Red_Est','SQM_Chk','MB_NO',
        'SD_chklst','QC_T_Done','QC_T_No','QC_Result','Part_Red_Rt_Proper','Excess_qty_125','CL_38_Prop',
    'Rec_Drg','Cur_Bill_Roy_Paid','Roy_Rec','Mess_Mode','PO_Chk','PO_Chk_Dt','lstDYEcheckdate'));
                }


                public function FunSaveChecklistPO(Request $request)
                {
                    // dd($request);
                    $action=$request->action;
                    $tbillid=$request->tbill_id;
                    // dd($request,$action,$tbillid);
                    $Work_Id=$request->Work_Id;
                    // dd($Work_Id);
                    // dd($tbillid);

        
        
                    if ($action === 'save') 
                    {
                        $tbillid=$request->input('tbill_id');
                        // $Work_Id=DB::table('bills')
                        // ->where('t_bill_Id', $tbillid)
                        // ->value('work_id');
                        // dd($tbillid,$Work_Id);
                
                        // dd('ok',$request);
                        // dd($action);
                $workNM=$request->work_nm;
                // dd($workNM);
                $SavechklistPB = DB::table('chklst_pb')->insert
                ([
                't_bill_Id' => $request->input('tbill_id'),
                'Work_Nm'=> $workNM,
                'SD_chklst'=> $request->input('SD_chklst'),
                'QC_T_Done'=> $request->input('QC_T_Done'),
                'QC_T_No'=> $request->input('QC_T_No'),
                'QC_Result'=> $request->input('QC_Result'),
                'SQM_Chk' => $request->input('SQM_Chk'),
                'Part_Red_Rt_Proper'=> $request->input('Part_Red_Rt_Proper'),
                'Excess_qty_125'=> $request->input('Excess_qty_125'),


                'CL_38_Prop' => $request->input('CL_38_Prop'),
                'Board'=> $request->input('Board'),
                'Rec_Drg'=> $request->input('Rec_Drg'),
                'Tot_Roy'=> $request->input('Tot_Roy'),
                'Pre_Bill_Roy'=> $request->input('Pre_Bill_Roy'),
                'Cur_Bill_Roy_Paid'=> $request->input('Cur_Bill_Roy_Paid'),
                'Roy_Rec'=> $request->input('Roy_Rec'),
                'Tnd_Amt'=> $request->input('Tnd_Amt'),

                'Net_Amt' => $request->input('Net_Amt'),
                'C_NetAmt'=> $request->input('C_NetAmt'),
                'Act_Comp_Dt'=> $request->input('Act_Comp_Dt'),
                'MB_NO'=> $request->input('MB_NO'),
                'MB_Dt'=> $request->input('MB_DT'),
                'Mess_Mode'=> $request->input('Mess_ModeMat_Cons'),
                'Mat_Cons'=> $request->input('Mat_Cons'),
                'Form_65'=> $request->input('Form_65'),

                'Handover' => $request->input('Handover'),
                'Red_Est' =>$request->input('Red_Est'),
                'PO_Chk'=> 1,
                'PO_Chk_Dt'=> $request->input('POdate'),
                // 'PA_Chk'=> $request->input('Arith_chk'),
                // 'PA_Chk_Dt'=> 1,
                // 'EE_Chk'=> $request->input('SDCdate'),
                // 'EE_Chk_Dt'=> $request->input('tbill_id'),



                    ]);
        
                    }
        
                    if ($action === 'update') 
                    {
                        // dd($action);
                        $tbillid=$request->input('tbill_id');
                        // dd($tbillid)
                        // $Work_Id=DB::table('bills')
                        // ->where('t_bill_Id', $tbillid)
                        // ->value('work_id');
                        // dd($tbillid,$workId);
                
                        // dd('ok',$request);
                        // dd($action);
                $workNM=$request->work_nm;
                // dd($workNM);
                $UpdatechklistPB = DB::table('chklst_pb')
                ->where('t_bill_Id', $request->input('tbill_id'))
                ->update([
                    
                'Work_Nm'=>$request->input('work_nm'),
                'SD_chklst'=> $request->input('SD_chklst'),
                'QC_T_Done'=> $request->input('QC_T_Done'),
                'QC_T_No'=> $request->input('QC_T_No'),
                'QC_Result'=> $request->input('QC_Result'),
                'SQM_Chk' => $request->input('SQM_Chk'),

                'Part_Red_Rt_Proper'=> $request->input('Part_Red_Rt_Proper'),
                'Excess_qty_125'=> $request->input('Excess_qty_125'),
                'CL_38_Prop' => $request->input('CL_38_Prop'),
                'Board'=> $request->input('Board'),
                'Rec_Drg'=> $request->input('Rec_Drg'),
                'Tot_Roy'=> $request->input('Tot_Roy'),
                'Pre_Bill_Roy'=> $request->input('Pre_Bill_Roy'),
                'Cur_Bill_Roy_Paid'=> $request->input('Cur_Bill_Roy_Paid'),
                'Roy_Rec'=> $request->input('Roy_Rec'),
                'Tnd_Amt'=> $request->input('Tnd_Amt'),
                'Net_Amt' => $request->input('Net_Amt'),
                'C_NetAmt'=> $request->input('C_NetAmt'),
                'Act_Comp_Dt'=> $request->input('Act_Comp_Dt'),
                'MB_NO'=> $request->input('MB_NO'),
                'MB_Dt'=> $request->input('MB_DT'),
                'Mess_Mode'=> $request->input('Mess_ModeMat_Cons'),
                'Mat_Cons'=> $request->input('Mat_Cons'),
                'Form_65'=> $request->input('Form_65'),
                'Handover' => $request->input('Handover'),
                'PO_Chk'=> 1,
                'PO_Chk_Dt'=> $request->input('POdate'),
                // 'PA_Chk'=> $request->input('Arith_chk'),
                // 'PA_Chk_Dt'=> 1,
                // 'EE_Chk'=> $request->input('SDCdate'),
                // 'EE_Chk_Dt'=> $request->input('tbill_id'),
                    ]);
                    }

                    // dd($Work_Id);

                    // $Work_Id=$Work_IdfINAL;
                    // DD($Work_Id);
                    // DD($tbillid);
                    $updateMbstatus = DB::table('bills')
                    ->where('t_bill_id', $tbillid)
                    ->update(['mb_status' => 10]);
                    // DD($updateMbstatus);
                    // dd($Work_Id);
                    return redirect()->route('billlist', ['workid' => $Work_Id]);
                        }


                        public function FunChecklistAB(Request $request)
                        {
                            // dd($request);
                            $t_bill_id = $request->input('t_bill_Id');
                            $workid = $request->input('workid');

                            $DBchklst_AudiExist=DB::table('chcklst_aud')
                            ->where('t_bill_Id',$t_bill_id)
                            ->first();
                            // dd($DBchklst_AudiExist);

                            $stupulatedDate=DB::table('workmasters')
                            ->where('Work_Id',$workid)
                            ->value('Stip_Comp_Dt');
                            // dd($stupulatedDate);
        
        
        
                            if ($DBchklst_AudiExist !== null) 
                            {
                                // dd('Data Availble in Auditor Table Update Record');
                                $DBAudiExist=DB::table('chcklst_aud')
                                ->where('t_bill_Id',$t_bill_id)
                                ->first();
                                // dd($DBAudiExist);
                                $BillsData = DB::table('bills')
                                ->where('t_bill_id', $t_bill_id)
                                ->select('work_id')
                                ->first();
                                // dd($BillsData);
                                $work_id = $BillsData->work_id;
                                $workNM=$DBAudiExist->Work_Nm;
                                $FH_code= $DBAudiExist->F_H_Code;
                                $Arith_chk = $DBAudiExist->Arith_chk;
                                $Ins_Policy_Agency = $DBAudiExist->Ins_Policy_Agency ;
                                $Ins_Prem_Amt_Agency = $DBAudiExist->Ins_Prem_Amt_Agency;
                                $Bl_Rec_Ded = $DBAudiExist->Bl_Rec_Ded ;
                                $C_netAmt = $DBAudiExist->C_netAmt;
                                $tot_ded = $DBAudiExist->Tot_Ded;
                                $chq_amt = $DBAudiExist->Chq_Amt ;
                                $Aud_chck=$DBAudiExist->Aud_chck;
                                $Aud_Chk_Dt=$DBAudiExist->Aud_Chk_Dt;
                                // dd($Aud_Chk_Dt);
                                $lastPOdate=DB::table('chklst_pb')
                                ->where('t_bill_Id',$t_bill_id)
                                ->value('PO_Chk_Dt');
        

                            }
                            else
                            {
                                // dd('Data not  Availble in Auditor Table  New Insert Record');

                            $BillsData = DB::table('bills')
                                            ->where('t_bill_id', $t_bill_id)
                                            ->select('work_id','c_netamt','tot_ded','tot_recovery','chq_amt')
                                            ->first();

                            $work_id = $BillsData->work_id;

                            $workmaster=DB::table('workmasters')            
                            ->where('Work_Id',$work_id) 
                            ->select('F_H_Code','Work_Nm')
                            ->first();
                            $workNM=$workmaster->Work_Nm;
                            $FH_code=$workmaster->F_H_Code;
                            $Arith_chk='Yes';
                            $Ins_Policy_Agency='No';
                            $Ins_Prem_Amt_Agency=0.00;
                            $Bl_Rec_Ded='Yes';
                            $C_netAmt=$BillsData->c_netamt;
                            $tot_ded=$BillsData->tot_ded;
                            $chq_amt=$BillsData->chq_amt;
                            $Aud_chck='';
                            $Aud_Chk_Dt='';

                        // dd($request,$t_bill_id);
                        $lastPOdate=DB::table('chklst_pb')
                        ->where('t_bill_Id',$t_bill_id)
                        ->value('PO_Chk_Dt');
                        // dd($lastPOdate);
                            }
                        
            return view('Checklist.ChecklistAB', compact('t_bill_id','work_id','stupulatedDate','workNM','FH_code',
        'Arith_chk','Ins_Policy_Agency','Ins_Prem_Amt_Agency','Bl_Rec_Ded','C_netAmt',
        'tot_ded','chq_amt','Aud_chck','Aud_Chk_Dt','DBchklst_AudiExist','lastPOdate'));
        }

        public function FunSaveChecklistAB(Request $request)
        {
            // dd($request);
            $action=$request->action;
            $t_bill_id=$request->t_bill_id;
            $work_id=$request->work_id;
            // dd($request,$action,$t_bill_id,$work_id);
            $ABChckbox=$request->ABcheckbox;
            // dd($ABChckbox);
            if($ABChckbox === 'on')
            {
                $ABChckbox=1;
            }
            else
            {
                $ABChckbox=0;
            }
            // dd($ABChckbox);


            if ($action === 'save') 
            {
                // dd($action);
                $insertData = [
                    't_bill_Id' => $t_bill_id,
                    'Work_Nm'=>$request->work_nm,
                    'F_H_Code' =>$request->F_H_Code,
                    'Arith_chk' =>$request->Arith_chk,
                    'Ins_Policy_Agency' =>$request->Ins_Policy_Agency,
                    'Ins_Prem_Amt_Agency' =>$request->Ins_Prem_Amt_Agency,
                    'Bl_Rec_Ded' =>$request->Bl_Rec_Ded,
                    'C_netAmt' =>$request->C_netAmt,
                    'Tot_Ded' =>$request->tot_ded,
                    'Chq_Amt' =>$request->chq_amt,
                    'Aud_chck' =>$ABChckbox ,
                    'Aud_Chk_Dt' =>$request->ABdate
                ];
                // Perform the insertion into the database
                DB::table('chcklst_aud')->insert($insertData);
            }

            else
            {
                // dd($action);
                $UpdateData = [
                    't_bill_Id' => $t_bill_id,
                    'Work_Nm'=>$request->work_nm,
                    'F_H_Code' =>$request->F_H_Code,
                    'Arith_chk' =>$request->Arith_chk,
                    'Ins_Policy_Agency' =>$request->Ins_Policy_Agency,
                    'Ins_Prem_Amt_Agency' =>$request->Ins_Prem_Amt_Agency,
                    'Bl_Rec_Ded' =>$request->Bl_Rec_Ded,
                    'C_netAmt' =>$request->C_netAmt,
                    'Tot_Ded' =>$request->tot_ded,
                    'Chq_Amt' =>$request->chq_amt,
                    'Aud_chck' =>$ABChckbox ,
                    'Aud_Chk_Dt' =>$request->ABdate
                ];
                DB::table('chcklst_aud')
                ->where('t_bill_Id',$t_bill_id)
                ->update($UpdateData);
            }

            $updateMbstatus = DB::table('bills')
            ->where('t_bill_id', $t_bill_id)
            ->update(['mb_status' => 11]);

            return redirect()->route('billlist', ['workid' => $work_id]);



        }


        public function FunChecklistAAO(Request $request)
        {

            $t_bill_id = $request->input('t_bill_Id');

            $DBchklst_AudiExist=DB::table('chcklst_aud')
            ->where('t_bill_Id',$t_bill_id)
            ->first();
            // dd($DBchklst_AudiExist);

                // dd('Data Availble in Auditor Table Update Record');
                $DBAudiExist=DB::table('chcklst_aud')
                ->where('t_bill_Id',$t_bill_id)
                ->first();
                // dd($DBAudiExist);
                $BillsData = DB::table('bills')
                ->where('t_bill_id', $t_bill_id)
                ->select('work_id')
                ->first();
                // dd($BillsData);
                $work_id = $BillsData->work_id;
                $stupulatedDate=DB::table('workmasters')
                ->where('Work_Id',$work_id)
                ->value('Stip_Comp_Dt');
                // dd($stupulatedDate);

                $workNM=$DBAudiExist->Work_Nm;
                $FH_code= $DBAudiExist->F_H_Code;
                $Arith_chk = $DBAudiExist->Arith_chk;
                $Ins_Policy_Agency = $DBAudiExist->Ins_Policy_Agency ;
                $Ins_Prem_Amt_Agency = $DBAudiExist->Ins_Prem_Amt_Agency;
                $Bl_Rec_Ded = $DBAudiExist->Bl_Rec_Ded ;
                $C_netAmt = $DBAudiExist->C_netAmt;
                $tot_ded = $DBAudiExist->Tot_Ded;
                $chq_amt = $DBAudiExist->Chq_Amt ;
                $Aud_chck=$DBAudiExist->Aud_chck;
                $Aud_Chk_Dt=$DBAudiExist->Aud_Chk_Dt;
                $AAO_Chk=$DBAudiExist->AAO_Chk;
                $AAO_Chk_Dt=$DBAudiExist->AAO_Chk_Dt;


                // dd($Aud_Chk_Dt);
                $lastPOdate=DB::table('chklst_pb')
                ->where('t_bill_Id',$t_bill_id)
                ->value('PO_Chk_Dt');


                // dd('Data not  Availble in Auditor Table  New Insert Record');
        
            return view('Checklist.ChecklistAAO', compact('t_bill_id','work_id','workNM','FH_code','stupulatedDate',
        'Arith_chk','Ins_Policy_Agency','Ins_Prem_Amt_Agency','Bl_Rec_Ded','C_netAmt',
        'tot_ded','chq_amt','Aud_chck','Aud_Chk_Dt','DBchklst_AudiExist','lastPOdate',
    'AAO_Chk','AAO_Chk_Dt'));


        }

        public function FunAAOChkAndDateUpdate(Request $request)
        {
            // dd($request);
            $work_id=$request->work_id;
            $t_bill_id=$request->t_bill_id;
            $chckAAO=$request->AAOcheckbox;
            $AAOdate=$request->AAOdate;

            // dd($chckAAO);
            if($chckAAO === 'on')
            {
                $chckAAO = 1;
            }
            else
            {
                $chckAAO = 0;
            }

            // dd($chckAAO,$AAOdate);

            $AAOCnetAmt = $request->AAOCnetAmt;
            // dd($AAOCnetAmt);
            $Updatechcklst_aud = DB::table('chcklst_aud')
            ->where('t_bill_Id', $t_bill_id)
            ->update([
                'C_netAmt' => $AAOCnetAmt,
                'AAO_Chk' => $chckAAO,
                'AAO_Chk_Dt' => $AAOdate
            ]);

            $updateMbstatus = DB::table('bills')
            ->where('t_bill_id', $t_bill_id)
            ->update(['mb_status' => 12]);

            return redirect()->route('billlist', ['workid' => $work_id]);

        }

        public function FunChecklistEE(Request $request)
        {
            // dd($request);
            $workid=$request->workid;
            $t_bill_Id=$request->t_bill_Id;
            // dd($t_bill_Id,$workid);

            //PO Detail

            $stupulatedDate=DB::table('workmasters')
            ->where('Work_Id',$workid)
            ->value('Stip_Comp_Dt');
            // dd($stupulatedDate);


                $DBChklstpo=DB::table('chklst_pb')
                ->where('t_bill_Id',$t_bill_Id)
                ->first();
                // dd($DBChklstpo);

                $workNM=$DBChklstpo->Work_Nm;
                $SD_chklst=$DBChklstpo->SD_chklst;
                $QC_T_Done=$DBChklstpo->QC_T_Done;
                $QC_T_No=$DBChklstpo->QC_T_No;
                $QC_Result=$DBChklstpo->QC_Result;
                $SQM_Chk = $DBChklstpo->SQM_Chk;
                $Part_Red_Rt_Proper=$DBChklstpo->Part_Red_Rt_Proper;
                $Excess_qty_125=$DBChklstpo->Excess_qty_125;
                $CL_38_Prop=$DBChklstpo->CL_38_Prop;
                $CFinalbillBoard=$DBChklstpo->Board;
                $Rec_Drg=$DBChklstpo->Rec_Drg;
                $TotRoy=$DBChklstpo->Tot_Roy;
                $PreTotRoy=$DBChklstpo->Pre_Bill_Roy;
                $Cur_Bill_Roy_Paid=$DBChklstpo->Cur_Bill_Roy_Paid;
                $Roy_Rec=$DBChklstpo->Roy_Rec;
                $Tnd_Amt=$DBChklstpo->Tnd_Amt;
                $netAmt=$DBChklstpo->Net_Amt;
                $c_netamt=$DBChklstpo->C_NetAmt;
                $Act_Comp_Dt=$DBChklstpo->Act_Comp_Dt;
                $MBNO=$DBChklstpo->MB_NO;
                $DBMB_Dt=$DBChklstpo->MB_Dt;
                $Mess_Mode=$DBChklstpo->Mess_Mode;
                $Mat_cons=$DBChklstpo->Mat_Cons;
                $CFinalbillForm65=$DBChklstpo->Form_65;
                $CFinalbillhandover=$DBChklstpo->Handover;
                $Red_Est = $DBChklstpo->Red_Est;
                $PO_Chk=$DBChklstpo->PO_Chk;
                $PO_Chk_Dt=$DBChklstpo->PO_Chk_Dt;
                $EE_Chk=$DBChklstpo->EE_Chk;
                $EE_Chk_Dt=$DBChklstpo->EE_Chk_Dt;


                $lstDYEcheckdate=DB::table('chklst_sdc')
                ->where('t_bill_Id',$t_bill_Id)
                ->value('Dye_chk_Dt');
                // dd($lstDYEcheckdate);



 ///////////////////// //Auditor Detail//////////////////////////
                $DBAudiExist=DB::table('chcklst_aud')
                ->where('t_bill_Id',$t_bill_Id)
                ->first();
                // dd($DBAudiExist,$t_bill_Id);
                $workNM=$DBAudiExist->Work_Nm;
                // dd($workNM);
                $FH_code= $DBAudiExist->F_H_Code;
                $Arith_chk = $DBAudiExist->Arith_chk;
                $Ins_Policy_Agency = $DBAudiExist->Ins_Policy_Agency ;
                $Ins_Prem_Amt_Agency = $DBAudiExist->Ins_Prem_Amt_Agency;
                $Bl_Rec_Ded = $DBAudiExist->Bl_Rec_Ded ;
                $C_netAmt = $DBAudiExist->C_netAmt;
                $tot_ded = $DBAudiExist->Tot_Ded;
                $chq_amt = $DBAudiExist->Chq_Amt ;
                $Aud_chck=$DBAudiExist->Aud_chck;
                $Aud_Chk_Dt=$DBAudiExist->Aud_Chk_Dt;
                $AAO_Chk=$DBAudiExist->AAO_Chk;
                $AAO_Chk_Dt=$DBAudiExist->AAO_Chk_Dt;
                $AAOEE_Chk=$DBAudiExist->EE_Chck;
                $AAOEE_Chk_Dt=$DBAudiExist->EE_Chck_Dt;


                // dd($Aud_Chk_Dt);
                $lastPOdate=DB::table('chklst_pb')
                ->where('t_bill_Id',$t_bill_Id)
                ->value('PO_Chk_Dt');


            return view('Checklist.ChecklistEE',compact('workid','stupulatedDate','workNM','t_bill_Id','TotRoy','PreTotRoy',
        'Tnd_Amt','Act_Comp_Dt','netAmt','c_netamt','DBMB_Dt','Mat_cons','CFinalbillhandover',
    'CFinalbillForm65','CFinalbillBoard','SQM_Chk','Red_Est','MBNO',
'SD_chklst','QC_T_Done','QC_T_No','QC_Result','Part_Red_Rt_Proper','Excess_qty_125','CL_38_Prop',
'Rec_Drg','Cur_Bill_Roy_Paid','Roy_Rec','Mess_Mode','PO_Chk','PO_Chk_Dt','lstDYEcheckdate','EE_Chk','EE_Chk_Dt',
//Auditor Detail return 
'workNM','FH_code', 'Arith_chk','Ins_Policy_Agency','Ins_Prem_Amt_Agency','Bl_Rec_Ded','C_netAmt',
'tot_ded','chq_amt','Aud_chck','Aud_Chk_Dt','lastPOdate','AAO_Chk','AAO_Chk_Dt','AAOEE_Chk',
'AAOEE_Chk_Dt'
));

        }

        public function FunEEChkAndDateUpdate(Request $request)
        {
            // dd($request);
            $EEcheckbox=$request->EEcheckbox;
            $t_bill_Id=$request->tbill_id;
            $Work_Id=$request ->Work_Id;
            // dd($t_bill_Id);
            // dd($EEcheckbox);
            if($EEcheckbox === 'on')
            {
                $EEcheckbox = 1 ;
            }
            else
            {
                $EEcheckbox = 0;
            }
            $EEdate=$request->EEdate;
            // dd($EEcheckbox,$EEdate);

            $EEcheckboxAuditor= $request->EEcheckboxAuditor;
            if($EEcheckboxAuditor === 'on')
            {
                $EEcheckboxAuditor = 1;
            }
             else
             {
                $EEcheckboxAuditor = 0;
             }
             $EEdateAuditor=$request->EEdateAuditor;
            //  dd($EEcheckboxAuditor,$EEdateAuditor);
             
        $Updatechklst_pb=DB::table('chklst_pb')
        ->where('t_bill_Id',$t_bill_Id)
        ->update(['EE_Chk' => $EEcheckbox,
        'EE_Chk_Dt' => $EEdate]);

        $Updatechcklst_aud=DB::table('chcklst_aud')
        ->where('t_bill_Id',$t_bill_Id)
        ->update(['EE_Chck' => $EEcheckboxAuditor,
        'EE_Chck_Dt' => $EEdateAuditor]);

        $updateMbstatus = DB::table('bills')
        ->where('t_bill_id', $t_bill_Id)
        ->update(['mb_status' => 13]);


        return redirect()->route('billlist', ['workid' => $Work_Id]);

        }
        
        

    }
