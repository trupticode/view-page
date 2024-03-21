<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Emb;
use Dompdf\Options;
use App\Models\Workmaster;
use Illuminate\Support\Str;
use App\Imports\ExcelImport;
use Illuminate\Http\Request;
use App\Helpers\CommonHelper;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ReportController;
use League\Flysystem\Local\LocalFilesystemAdapter;


class ChecklistReportController extends Controller
{

public function subdivisionchecklist(Request $request , $tbillid)
{

    // dd($tbillid);

    $embsection2=DB::table('bills')->where('t_bill_Id' , $tbillid)->first();

    $subdivisioncheckreport='';
$recordentrynos=DB::table('recordms')->where('t_bill_id' , $tbillid)->get();


$headercheck='Subdivisionchecklist';

     // Resolve an instance of ReportController
     $reportController = app()->make(\App\Http\Controllers\ReportController::class);

     // Call the commonheader method
     $header = $reportController->commonheader($tbillid, $headercheck);
//$header=ReportController::commonheader($tbillid , $headercheck);
//dd($header);

$subdivisioncheckreport .=$header;


$tbilldata=DB::table('bills')->where('t_bill_Id' , $tbillid)->first();

$billitems=DB::table('bil_item')->where('t_bill_id' , $tbillid)->get();


$workid=DB::table('bills')->where('t_bill_Id' , $tbillid)->value('work_id');
//dd($workid);
$workdata=DB::table('workmasters')->where('Work_Id' , $workid)->first();
//dd($workdata);
$jeid=$workdata->jeid;
$dyeid=$workdata->DYE_id;
//dd($dyeid);
$sign=DB::table('dyemasters')->where('dye_id' , $dyeid)->first();
$sign2=DB::table('jemasters')->where('jeid' , $jeid)->first();
// Construct the full file path
$imagePath = public_path('Uploads/signature/' . $sign->sign);
$imageData = base64_encode(file_get_contents($imagePath));
$imageSrc = 'data:image/jpeg;base64,' . $imageData;

$imagePath2 = public_path('Uploads/signature/' . $sign2->sign);
$imageData2 = base64_encode(file_get_contents($imagePath2));
$imageSrc2 = 'data:image/jpeg;base64,' . $imageData2;



$jedesignation=DB::table('designations')->where('Designation' , $sign2->designation)->value('Designation');
//dd($jedesignation);
$jesubdivision=DB::table('subdivms')->where('Sub_Div_Id' , $sign2->subdiv_id)->value('Sub_Div');

$dyedesignation=DB::table('designations')->where('Designation' , $sign->designation)->value('Designation');
$dyesubdivision=DB::table('subdivms')->where('Sub_Div_Id' , $sign->subdiv_id)->value('Sub_Div');






//data creation
$DBchklst_jeRelatedTbillid=DB::table('chklst_je')
                ->where('t_bill_id',$tbillid)
                ->first();
                 //dd( $DBchklst_jeRelatedTbillid);
                $CTbillid=$tbillid;
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
                // dd($tbillid);
                $DBSDCgetdata=DB::table('chklst_sdc')
                ->where('t_bill_Id',$tbillid)
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


//$dyecheckdateSO=


if($embsection2->mb_status == 7 || $embsection2->mb_status >= 9)
{

                $subdivisioncheckreport  .= '<div class="" style="margin-top:20px;">
                <h4>Check List SO</h4>
              <div class="">
                <table class="table  table-bordered" style="width: 100%;">
                  <thead class="" style="background-color: #f2f2f2;">
                    <tr>
                        <th style="width: 8%;">SR.NO</th>
                      <th style="width: 50%;">Name</th>
                      <th style="width: 42%;">Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td style="text-align: right;">1</td>
                      <td>Name of Work</td>
                      <td >'. $workNM .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">2</td>
                      <td>Agency / Contractor</td>
                      <td>'. $DBAgencyName .'  '.$DBagency_pl.'</td>
                    </tr>
                    <tr>
                    <td style="text-align: right;">3</td>
                    <td>Name of Officer recording measurements </td>
                    <td name="JeName">'. $DBJeName .'</td>
                        </tr>
                    <tr>
                    <td style="text-align: right;">4</td>
            
                      <td>Bill No</td>
                      <td>'.$concateresult.'</td>
                    </tr>
                    <tr>';


                    $agreementDate = $DBAgreeDT ? date('d/m/Y', strtotime($DBAgreeDT)) : '';

                    $stipulatedcompletiondate= $Stip_Comp_Dt ? date('d/m/Y', strtotime($Stip_Comp_Dt)) : '';

                    $ActualCompletiondate=$Act_Comp_Dt ? date('d/m/Y', strtotime($Act_Comp_Dt)) : '';

                    $MESUrementDate=$DBMESUrementDate ? date('d/m/Y', strtotime($DBMESUrementDate)) : '';
                    //dd($ActualCompletiondate);

                    $subdivisioncheckreport  .= '<td style="text-align: right;">5</td>
                      <td>Agreement No & Date</td>
                      <td > '.$DBAgreeNO.'  '. $agreementDate .'</td>
                    </tr>
                    <tr>
                    <td style="text-align: right;">6</td>
            
                    <td>Quoted Above / Below percent</td>
                    <td name="Above_Below">'.$A_B_Pc.'% &nbsp;  '.$Above_Below.'</td>
                        </tr>
                        <tr>
                        <td style="text-align: right;">7</td>
            
                      <td>Stipulated Date of Completion</td>
                      <td>'. $stipulatedcompletiondate .'</td>
                    </tr>
                    <tr>
                    <td style="text-align: right;">8</td>
            
                      <td> Actual Date of Completion</td>
                      <input type="hidden" name="Act_Comp_Dt" value="{{$Act_Comp_Dt}}">       
            
                      <td>'. $ActualCompletiondate .'</td>
                    </tr>
                    <tr>
                    <td style="text-align: right;">9</td>
            
                      <td>M.B. No & Date of Recording</td>
                     
                      <td name="MBNO">'. $CTbillid .'  &nbsp;&nbsp;&nbsp;  Date:   '. $MESUrementDate .'</td>
                    </tr>
            
            
            
            <tr>
            <td style="text-align: right;">10</td>
            
                    <td>Whether Contractor has signed in token of acceptance of measurements ?</td>
                    <td> '. $Agency_MB_Accept .'
            </td>
                    </tr>
                    <tr>
                    <td style="text-align: right;">11</td>
            
                      <td>Part Rate / Reduced Rate Analysis</td>
                            <td> '. $partrtAnalysis.'
                    </td>  
            
            
            </tr>
                    <tr>
                    <td style="text-align: right;">12</td>
            
                    <td>If Reduced Rate, permissin of compitent authority is obtained ?</td>
                    <td> '. $Part_Red_per.'
            </td>
            
                        </tr>
                    <tr>
                    <td style="text-align: right;">13</td>
            
                      <td>Whether Results of Q.C. Tests are satisfactory ?</td>
                      <td> '. $Qc_Result.'
            </td>
            
                    </tr>
            
            
            
                    <tr>
                    <td style="text-align: right;">14</td>
                    <td>Is Material Consumption Statement attached ?</td>
                    <td>'. $materialconsu.'
                    </td>  
            
                    </tr>
                    <tr>
                    <td style="text-align: right;">15</td>
            
                      <td>Is Recovery Statement attached ?</td>
                      <td>'. $Recoverystatement.'
                    </td>  
            
                    </tr>
                    <tr>
                    <td style="text-align: right;">16</td>
            
                    <td>Is Excess Saving Statement attached ?</td>
                    <td> '. $Excesstatement.'
                    </td>  
            
                        </tr>
                        <tr>
                        <td style="text-align: right;">17</td>
                      <td>Is Royalty Statement attached ?</td>
                      <td> '. $Royaltystatement.'
                    </td>  
            
                    </tr>
                    <tr>
                    <td style="text-align: right;">18</td>
            
                      <td> Necessary Photographs of work / site attached ?</td>
                      <td> '. $photo.'  <br>';
                    
           
            if($countphoto > 0)
            {
                $subdivisioncheckreport  .= '<label>Total Photo : '.$countphoto.'</label>';

            }
           
            if($countdoc > 0)
            {
                $subdivisioncheckreport  .= '<label>Total Documents : '.$countdoc.'</label>';

            }
            if($countvideo > 0)
            {
                $subdivisioncheckreport  .= '<label>Video : '.$countvideo.'</label>';
            }
            
            $subdivisioncheckreport  .= '</td>  
                    </tr>
            
            
                    <tr>
                    <td style="text-align: right;">19</td>
            
                    <td>Challen of Royalty paid by Contractor attached ?</td>
                    <td>'. $Roy_Challen.'
            </td>
            
            
                    </tr>
            
                    <tr>
                    <td style="text-align: right;">20</td>
                      <td>Q.C. Test Reports attached ?</td>
                      <td>'. $Qc_Reports.'
            </td>
            
                    </tr>
            
                    <tr>
                    <td style="text-align: right;">21</td>
                      <td>Whether Board showing Name of Work, Name of Agency, DLP, etc. is fixed on site of work ?</td>
                      <td> '. $Board.'
            </td>
            
                    </tr>
            
            
                    <tr>
                    <td style="text-align: right;">22</td>
                      <td>Work Completion Certificate (Form-65) attached ?</td>
                      <td>'. $CFinalbill.'
            </td>';
            $formattedJeChkDt = $Je_chk_Dt ? date('d/m/Y', strtotime($Je_chk_Dt)) : '';
            $formattedSODYEChkDt = $SODYEchk_Dt ? date('d/m/Y', strtotime($SODYEchk_Dt)) : '';

            $subdivisioncheckreport  .= '</tr>
            
            
            
            
                    <tr>
                </tr>
                <tr>
                </tr>';



                $jeremark=$DBchklst_jeRelatedTbillid->Je_Chk;
                $dyeremark=$DBchklst_jeRelatedTbillid->Dye_chk;

                $subdivisioncheckreport .= '<tr>';

               
                
                
                $subdivisioncheckreport .= '<td colspan="2" style=" padding: 8px; max-width: 50%; text-align: center; line-height: 0;">';


                
                if($jeremark == 1)
                {
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong></strong></div>';
                $subdivisioncheckreport .= '<div style=" width: 150px; height: 50px; display: inline-block;"> <img src="' . $imageSrc2 . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;"></div>'; // Placeholder for signature box
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;">';
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sign2->name . '</strong></div>';
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $jedesignation . '</strong></div>';
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $jesubdivision .'</strong></div>';
                $subdivisioncheckreport .= '</div>';
                 }
                $subdivisioncheckreport .= '</td>'; // First cell for signature details
              
                $subdivisioncheckreport .= '<td  style=" padding: 8px; max-width: 50%; text-align: center; line-height: 0;">';
                if($dyeremark == 1)
                {
               
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong></strong></div>';
                $subdivisioncheckreport .= '<div style="width: 150px; height: 50px; display: inline-block;"> <img src="' . $imageSrc . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;"></div>'; // Placeholder for signature box
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;">'; // Adjusted line height and margin
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sign->name .'</strong></div>';
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $dyedesignation .'</strong></div>';
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong> '. $dyesubdivision .'</strong></div>';
                $subdivisioncheckreport .= '</div>';
                }
                $subdivisioncheckreport .= '</td>'; // First cell for signature details
                $subdivisioncheckreport .= '</tr>';
            
                
                $subdivisioncheckreport .= '</tbody>
                </table>
              </div>
            </div>';

        }

        if($embsection2->mb_status == 8 || $embsection2->mb_status >= 9)
{


            $subdivisioncheckreport  .= '<div class="" style="margin-top:20px;">
            <h4>Check List SDC</h4>
          <div class="">
          <table class="table  table-bordered" style="width: 100%;">
          <thead class="" style="background-color: #f2f2f2;">
            <tr>
                <th style="width: 8%;">SR.NO</th>
              <th style="width: 50%;">Name</th>
              <th style="width: 42%;">Description</th>
            </tr>
              </thead>
              <tbody>
                    <td style="text-align: right;">1</td>
                  <td>Name of Work</td>
                  <td >'.$SDCWork_Nm.'</td>
                </tr>
                <tr>
                    <td style="text-align: right;">2</td>
                  <td>Fund Head</td>
                  <td>'.$SDCFHCODE.'</td>
                </tr>
        
                <tr>
                    <td style="text-align: right;">3</td>
                    <td>Whether arithmatic check is done ?</td>
                <td> '.$SDCArith_chk .'</td>
                </tr>';
               
                $formattedJsdcChkDt = $SDCSdc_chk_Dt ? date('d/m/Y', strtotime($SDCSdc_chk_Dt)) : '';

                // Format $SODYEchk_Dt
                $formattedsdcDYEChkDt = $SDCDye_chk_Dt ? date('d/m/Y', strtotime($SDCDye_chk_Dt)) : '';
                $subdivisioncheckreport  .= '
                        <tr>
                    </tr>
                    <tr>
                    </tr>';

                    $dyeremark=$DBchklst_jeRelatedTbillid->Dye_chk;
                    $sdcremark=$DBSDCgetdata->Sdc_chk;


$sdcid=$workdata->SDC_id;
//dd($dyeid);
$sign3=DB::table('sdcmasters')->where('SDC_id' , $sdcid)->first();
// dd($sign3);
// Construct the full file path
$imagePath3 = public_path('Uploads/signature/' . $sign3->sign);
$imageData3 = base64_encode(file_get_contents($imagePath3));
$imageSrc3 = 'data:image/jpeg;base64,' . $imageData3;
// dd($imageSrc3);
$sdcdesignation=DB::table('designations')->where('Designation' , $sign3->designation)->value('Designation');
$sdcsubdivision=DB::table('subdivms')->where('Sub_Div_Id' , $sign3->subdiv_id)->value('Sub_Div');


                    $subdivisioncheckreport .= '<tr>';
                    $subdivisioncheckreport .= '<td colspan="2" style=" padding: 8px; max-width: 50%; text-align: center; line-height: 0;">';
                   
                  
                   
                    if($sdcremark == 1)
                {
                    $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong></strong></div>';
                    $subdivisioncheckreport .= '<div style=" width: 150px; height: 50px; display: inline-block;"> <img src="' . $imageSrc3 . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;"></div>'; // Placeholder for signature box
                    $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;">';
                    $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sign3->name . '</strong></div>';
                    $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sdcdesignation . '</strong></div>';
                    $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sdcsubdivision .'</strong></div>';
                        $subdivisioncheckreport .= '</div>';
                }
                    $subdivisioncheckreport .= '</td>'; // First cell for signature details
                    $subdivisioncheckreport .= '<td  style=" padding: 8px; max-width: 50%; text-align: center; line-height: 0;">';
                    if($dyeremark == 1)
                {
               
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong></strong></div>';
                $subdivisioncheckreport .= '<div style="width: 150px; height: 50px; display: inline-block;"> <img src="' . $imageSrc . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;"></div>'; // Placeholder for signature box
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;">'; // Adjusted line height and margin
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sign->name .'</strong></div>';
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $dyedesignation .'</strong></div>';
                $subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong> '. $dyesubdivision .'</strong></div>';
                $subdivisioncheckreport .= '</div>';
                }
                    $subdivisioncheckreport .= '</td>'; // First cell for signature details
                    $subdivisioncheckreport .= '</tr>
                
                </tbody>
            </table>
          </div>
        </div>';
        
}












return view('Checklistreport/Subdivisionchecklist' ,compact('embsection2' , 'subdivisioncheckreport'));}

//subdivisionchecklistreportpdf function


public function subdivisionchecklistreportpdf(Request $request , $tbillid)
{
//    dd($tbillid);

    $embsection2=DB::table('bills')->where('t_bill_Id' , $tbillid)->first();

    $subdivisioncheckreport='';
$recordentrynos=DB::table('recordms')->where('t_bill_id' , $tbillid)->get();


$headercheck='Subdivisionchecklist';

     // Resolve an instance of ReportController
     $reportController = app()->make(\App\Http\Controllers\ReportController::class);

     // Call the commonheader method
     $header = $reportController->commonheader($tbillid, $headercheck);
//$header=ReportController::commonheader($tbillid , $headercheck);
//dd($header);

$subdivisioncheckreport .=$header;


$tbilldata=DB::table('bills')->where('t_bill_Id' , $tbillid)->first();

$billitems=DB::table('bil_item')->where('t_bill_id' , $tbillid)->get();


$workid=DB::table('bills')->where('t_bill_Id' , $tbillid)->value('work_id');
//dd($workid);
$workdata=DB::table('workmasters')->where('Work_Id' , $workid)->first();
//dd($workdata);
$jeid=$workdata->jeid;
$dyeid=$workdata->DYE_id;
//dd($dyeid);
$sign=DB::table('dyemasters')->where('dye_id' , $dyeid)->first();
$sign2=DB::table('jemasters')->where('jeid' , $jeid)->first();
// Construct the full file path
$imagePath = public_path('Uploads/signature/' . $sign->sign);
$imageData = base64_encode(file_get_contents($imagePath));
$imageSrc = 'data:image/jpeg;base64,' . $imageData;

$imagePath2 = public_path('Uploads/signature/' . $sign2->sign);
$imageData2 = base64_encode(file_get_contents($imagePath2));
$imageSrc2 = 'data:image/jpeg;base64,' . $imageData2;



$jedesignation=DB::table('designations')->where('Designation' , $sign2->designation)->value('Designation');
//dd($jedesignation);
$jesubdivision=DB::table('subdivms')->where('Sub_Div_Id' , $sign2->subdiv_id)->value('Sub_Div');

$dyedesignation=DB::table('designations')->where('Designation' , $sign->designation)->value('Designation');
$dyesubdivision=DB::table('subdivms')->where('Sub_Div_Id' , $sign->subdiv_id)->value('Sub_Div');






//data creation
$DBchklst_jeRelatedTbillid=DB::table('chklst_je')
                ->where('t_bill_id',$tbillid)
                ->first();
                // dd( $DBchklst_jeRelatedTbillid);
                $CTbillid=$tbillid;
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

                // $photo1 = $photo !== null ? 'Yes' : 'Not Applicable';
    
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
                ->where('t_bill_id',$tbillid)
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


//$dyecheckdateSO=
//dd($embsection2);

if($embsection2->mb_status == 7 || $embsection2->mb_status >= 9)
{

  $subdivisioncheckreport  .= '<div class="" style="margin-top:20px; border-collapse: collapse;">
  <h4>Check List SO</h4>
      <table style="width: 100%; border-collapse: collapse;">
          <thead>
              <tr>
                  <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 8%;">SR.NO</th>
                  <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 50%;">Name</th>
                  <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 42%;">Description</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td style="text-align: right; border: 1px solid black; padding: 5px;">1</td>
                  <td style="border: 1px solid black; padding: 5px;">Name of Work</td>
                  <td style="border: 1px solid black; padding: 5px;">'. $workNM .'</td>
              </tr>
              <tr>
                  <td style="text-align: right; border: 1px solid black; padding: 5px;">2</td>
                  <td style="border: 1px solid black; padding: 5px;">Agency / Contractor</td>
                  <td style="border: 1px solid black; padding: 5px;">'. $DBAgencyName .'  '.$DBagency_pl.'</td>
              </tr>
              <tr>
                  <td style="text-align: right; border: 1px solid black; padding: 5px;">3</td>
                  <td style="border: 1px solid black; padding: 5px;">Name of Officer recording measurements</td>
                  <td style="border: 1px solid black; padding: 5px;" name="JeName">'. $DBJeName .'</td>
              </tr>
              <tr>
                  <td style="text-align: right; border: 1px solid black; padding: 5px;">4</td>
                  <td style="border: 1px solid black; padding: 5px;">Bill No</td>
                  <td style="border: 1px solid black; padding: 5px;">'.$concateresult.'</td>
              </tr><tr>';


                    $agreementDate = $DBAgreeDT ? date('d/m/Y', strtotime($DBAgreeDT)) : '';

                    $stipulatedcompletiondate= $Stip_Comp_Dt ? date('d/m/Y', strtotime($Stip_Comp_Dt)) : '';

                    $ActualCompletiondate=$Act_Comp_Dt ? date('d/m/Y', strtotime($Act_Comp_Dt)) : '';

                    $MESUrementDate=$DBMESUrementDate ? date('d/m/Y', strtotime($DBMESUrementDate)) : '';
                    //dd($ActualCompletiondate);

                    $subdivisioncheckreport  .= '<td style="text-align: right; border: 1px solid black; padding: 5px;">6</td>
                    <td style="border: 1px solid black; padding: 5px;">Quoted Above / Below percent</td>
                    <td style="border: 1px solid black; padding: 5px;" name="Above_Below">'.$A_B_Pc.'% &nbsp; '.$Above_Below.'</td>
                </tr>
                <tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;">7</td>
                    <td style="border: 1px solid black; padding: 5px;">Stipulated Date of Completion</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$stipulatedcompletiondate.'</td>
                </tr>
                <tr>

                    <td style="text-align: right; border: 1px solid black; padding: 5px;">8</td>
                    <td style="border: 1px solid black; padding: 5px;">Actual Date of Completion</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$ActualCompletiondate.'</td>
                </tr>
                <tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;">9</td>
                    <td style="border: 1px solid black; padding: 5px;">M.B. No & Date of Recording</td>
                    <td style="border: 1px solid black; padding: 5px;" name="MBNO">'.$CTbillid.' &nbsp;&nbsp; Date:'.$MESUrementDate.'</td>
                </tr>
                <tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;">10</td>
                    <td style="border: 1px solid black; padding: 5px;">Whether Contractor has signed in token of acceptance of measurements?</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$Agency_MB_Accept.'</td>
                </tr>
                <tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;">11</td>
                    <td style="border: 1px solid black; padding: 5px;">Part Rate / Reduced Rate Analysis</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$partrtAnalysis.'</td>
                </tr>
                <tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;">12</td>
                    <td style="border: 1px solid black; padding: 5px;">If Reduced Rate, permission of competent authority is obtained?</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$Part_Red_per.'</td>
                </tr>
                <tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;">13</td>
                    <td style="border: 1px solid black; padding: 5px;">Whether Results of Q.C. Tests are satisfactory?</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$Qc_Result.'</td>
                </tr>
                <tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;">14</td>
                    <td style="border: 1px solid black; padding: 5px;">Is Material Consumption Statement attached?</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$materialconsu.'</td>
                </tr>
                <tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;">15</td>
                    <td style="border: 1px solid black; padding: 5px;">Is Recovery Statement attached?</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$Recoverystatement.'</td>
                </tr>
                <tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;">16</td>
                    <td style="border: 1px solid black; padding: 5px;">Is Excess Saving Statement attached?</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$Excesstatement.'</td>
                </tr>
                <tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;">17</td>
                    <td style="border: 1px solid black; padding: 5px;">Is Royalty Statement attached?</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$Royaltystatement.'</td>
                </tr>
                <tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;">18</td>
                    <td style="border: 1px solid black; padding: 5px;">Necessary Photographs of work / site attached?</td>
                    <td style="border: 1px solid black; padding: 5px;">'.$photo.'<br>';
           
            if($countphoto > 0)
            {
                $subdivisioncheckreport  .= '<label>Total Photo : '.$countphoto.'</label>';

            }
           
            if($countdoc > 0)
            {
                $subdivisioncheckreport  .= '<label>Total Documents : '.$countdoc.'</label>';

            }
            if($countvideo > 0)
            {
                $subdivisioncheckreport  .= '<label>Video : '.$countvideo.'</label>';
            }
            
            $subdivisioncheckreport  .= '</td></tr>
<tr>
    <td style="text-align: right; border: 1px solid black; padding: 5px;">19</td>
    <td style="border: 1px solid black; padding: 5px;">Challen of Royalty paid by Contractor attached?</td>
    <td style="border: 1px solid black; padding: 5px;">'.$Roy_Challen.'</td>
</tr>
<tr>
    <td style="text-align: right; border: 1px solid black; padding: 5px;">20</td>
    <td style="border: 1px solid black; padding: 5px;">Q.C. Test Reports attached?</td>
    <td style="border: 1px solid black; padding: 5px;">'.$Qc_Reports.'</td>
</tr>
<tr>
    <td style="text-align: right; border: 1px solid black; padding: 5px;">21</td>
    <td style="border: 1px solid black; padding: 5px;">Whether Board showing Name of Work, Name of Agency, DLP, etc. is fixed on site of work?</td>
    <td style="border: 1px solid black; padding: 5px;">'.$Board.'</td>
</tr>
<tr>
    <td style="text-align: right; border: 1px solid black; padding: 5px;">22</td>
    <td style="border: 1px solid black; padding: 5px;">Work Completion Certificate (Form-65) attached?</td>
    <td style="border: 1px solid black; padding: 5px;">'.$CFinalbill.'</td>
</tr>';
    


            $formattedJeChkDt = $Je_chk_Dt ? date('d/m/Y', strtotime($Je_chk_Dt)) : '';

            // Format $SODYEchk_Dt
            $formattedSODYEChkDt = $SODYEchk_Dt ? date('d/m/Y', strtotime($SODYEchk_Dt)) : '';
        


            $subdivisioncheckreport  .= '</tr>
<tr>
</tr>';

$jeremark=$DBchklst_jeRelatedTbillid->Je_Chk;
 $dyeremark=$DBchklst_jeRelatedTbillid->Dye_chk;

$subdivisioncheckreport .= '</tbody>
</table>';

$subdivisioncheckreport .= '<table style="width: 100%; border-collapse: collapse;"><tbody><tr>';
$subdivisioncheckreport .= '<td colspan="" style="border: 1px solid black; padding: 8px; max-width: 50%; text-align: center; line-height: 0;">';




if($jeremark == 1)
{  
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong></strong></div>';
$subdivisioncheckreport .= '<div style=" width: 150px; height: 50px; display: inline-block;"> <img src="' . $imageSrc2 . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;"></div>'; // Placeholder for signature box
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;">';
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sign2->name . '</strong></div>';
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $jedesignation . '</strong></div>';
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $jesubdivision .'</strong></div>';
$subdivisioncheckreport .= '</div>';
}
$subdivisioncheckreport .= '</td>'; // First cell for signature details
$subdivisioncheckreport .= '<td colspan="" style="border: 1px solid black; padding: 8px; max-width: 50%; text-align: center; line-height: 0;">';

if($dyeremark == 1)
{
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong></strong></div>';
$subdivisioncheckreport .= '<div style="width: 150px; height: 50px; display: inline-block;"> <img src="' . $imageSrc . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;"></div>'; // Placeholder for signature box
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;">'; // Adjusted line height and margin
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sign->name .'</strong></div>';
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $dyedesignation .'</strong></div>';
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong> '. $dyesubdivision .'</strong></div>';
$subdivisioncheckreport .= '</div>';
}

$subdivisioncheckreport .= '</td>'; // First cell for signature details

$subdivisioncheckreport .= '</tr></tbody></table>';


$subdivisioncheckreport .= '</div>';


      }

        if($embsection2->mb_status == 8 || $embsection2->mb_status >= 9)
{


            $subdivisioncheckreport  .= '<div class="" style="margin-top:20px;">
            <h4>Check List SDC</h4>
         
            <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 8%;">SR.NO</th>
                    <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 50%;">Name</th>
                    <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 42%;">Description</th>
                </tr>
            </thead>
            <tbody>
            <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">1</td>
            <td style="border: 1px solid black; padding: 5px;">Name of Work</td>
            <td style="border: 1px solid black; padding: 5px;">'.$SDCWork_Nm.'</td>
        </tr>
        <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">2</td>
            <td style="border: 1px solid black; padding: 5px;">Fund Head</td>
            <td style="border: 1px solid black; padding: 5px;">'.$SDCFHCODE.'</td>
        </tr>
        <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">3</td>
            <td style="border: 1px solid black; padding: 5px;">Whether arithmetic check is done?</td>
            <td style="border: 1px solid black; padding: 5px;">'.$SDCArith_chk.'</td>
        </tr>';
               
                $formattedJsdcChkDt = $SDCSdc_chk_Dt ? date('d/m/Y', strtotime($SDCSdc_chk_Dt)) : '';

                // Format $SODYEchk_Dt
                $formattedsdcDYEChkDt = $SDCDye_chk_Dt ? date('d/m/Y', strtotime($SDCDye_chk_Dt)) : '';
                $subdivisioncheckreport  .= '
                <tr>
            </tr>
            <tr>
            </tr>';

                                                        

        
            $subdivisioncheckreport .= '</tbody>
            </table>';


            $dyeremark=$DBchklst_jeRelatedTbillid->Dye_chk;
            $sdcremark=$DBSDCgetdata->Sdc_chk;


$sdcid=$workdata->SDC_id;
//dd($dyeid);
$sign3=DB::table('sdcmasters')->where('SDC_id' , $sdcid)->first();
// Construct the full file path
$imagePath3 = public_path('Uploads/signature/' . $sign3->sign);
$imageData3 = base64_encode(file_get_contents($imagePath3));
$imageSrc3 = 'data:image/jpeg;base64,' . $imageData3;
// dd($imageSrc3);
$sdcdesignation=DB::table('designations')->where('Designation' , $sign3->designation)->value('Designation');
$sdcsubdivision=DB::table('subdivms')->where('Sub_Div_Id' , $sign3->subdiv_id)->value('Sub_Div');


$subdivisioncheckreport .= '<table style="width: 100%; border-collapse: collapse;"><tbody><tr>';
$subdivisioncheckreport .= '<td colspan="" style="border: 1px solid black; padding: 8px; max-width: 50%; text-align: center; line-height: 0;">';




if($sdcremark == 1)
{
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong></strong></div>';
$subdivisioncheckreport .= '<div style=" width: 150px; height: 50px; display: inline-block;"> <img src="' . $imageSrc3 . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;"></div>'; // Placeholder for signature box
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;">';
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sign3->name . '</strong></div>';
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sdcdesignation . '</strong></div>';
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sdcsubdivision .'</strong></div>';
$subdivisioncheckreport .= '</div>';
 }
$subdivisioncheckreport .= '</td>'; // First cell for signature details
$subdivisioncheckreport .= '<td colspan="" style="border: 1px solid black; padding: 8px; max-width: 50%; text-align: center; line-height: 0;">';

if($dyeremark == 1)
{
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong></strong></div>';
$subdivisioncheckreport .= '<div style="width: 150px; height: 50px; display: inline-block;"> <img src="' . $imageSrc . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;"></div>'; // Placeholder for signature box
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;">'; // Adjusted line height and margin
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $sign->name .'</strong></div>';
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong>' . $dyedesignation .'</strong></div>';
$subdivisioncheckreport .= '<div style="line-height: 1; margin: 0;"><strong> '. $dyesubdivision .'</strong></div>';
$subdivisioncheckreport .= '</div>';
}

$subdivisioncheckreport .= '</td>'; // First cell for signature details

$subdivisioncheckreport .= '</tr></tbody></table>';


$subdivisioncheckreport .= '</div>';
        
}
 

$pdf = new Dompdf();

// Read the image file and convert it to base64
//$imagePath = public_path('images/sign.jpg');
// $imageData = base64_encode(file_get_contents($imagePath));
//
//$imageSrc = 'data:image/jpeg;base64,' . $imageData;


// Image path using the asset helper function
$pdf->loadHtml($subdivisioncheckreport);
//$pdf->setPaper('auto', 'auto'); // Set paper size and orientation
$pdf->setPaper('A4', 'portrait'); // Set paper size and orientation

// (Optional) Set options for the PDF rendering
$options = new Options();
$options->set('isHtml5ParserEnabled', true); // Enable HTML5 parsing
$pdf->setOptions($options);

$pdf->render();

return $pdf->stream('Subdivisionchecklist-' . $tbillid . '-pdf.pdf');
}


public function Fundivisionchecklist( $tbillid)
{
    $DivisionCheck='';
    $DBchklst_POExist=DB::table('chklst_pb')
    ->where('t_bill_Id',$tbillid)
    ->first();
    // dd($DBchklst_POExist);
    $embsection2=DB::table('bills')->where('t_bill_Id' , $tbillid)->first();

    $headercheck='divchecklist';

    // Resolve an instance of ReportController
    $reportController = app()->make(\App\Http\Controllers\ReportController::class);

    // Call the commonheader method
    $header = $reportController->commonheader($tbillid, $headercheck);
        //$header=ReportController::commonheader($tbillid , $headercheck);
    //  dd($header);

    $DivisionCheck .=$header;
    //dd($DivisionCheck);

    $tbilldata=DB::table('bills')->where('t_bill_Id' , $tbillid)->first();

    $billitems=DB::table('bil_item')->where('t_bill_id' , $tbillid)->get();

    $workid=DB::table('bills')->where('t_bill_Id' , $tbillid)->value('work_id');
    //dd($workid);
    $workdata=DB::table('workmasters')->where('Work_Id' , $workid)->first();
    // dd($workdata->Div);
    $jeid=$workdata->jeid;
    $dyeid=$workdata->DYE_id;
    $poid=$workdata->PB_Id;
    $EEid=$workdata->EE_id;
    $Audiid=$workdata->AB_Id;
    // dd($Audiid);
    $Accid=$workdata->DAO_Id;
    $sign=DB::table('dyemasters')->where('dye_id' , $dyeid)->first();
    // dd($sign);
    $sign2=DB::table('jemasters')->where('jeid' , $jeid)->first();
    $posignid=DB::table('jemasters')->where('jeid' , $poid)->first();
    $eesignid=DB::table('eemasters')->where('eeid' , $EEid)->first();
    $Audisignid=DB::table('abmasters')->where('AB_Id' , $Audiid)->first();
    //dd($Audisignid);
    $Accsignid=DB::table('daomasters')->where('DAO_id' , $Accid)->first();

    // dd($posignid);
    // Construct the full file path
    $imagePath = public_path('Uploads/signature/' . $sign->sign);
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageSrc = 'data:image/jpeg;base64,' . $imageData;

    $imagePath2 = public_path('Uploads/signature/' . $sign2->sign);
    $imageData2 = base64_encode(file_get_contents($imagePath2));
    $imageSrc2 = 'data:image/jpeg;base64,' . $imageData2;

    $imagePathpo = public_path('Uploads/signature/' . $posignid->sign);
    $imageData2 = base64_encode(file_get_contents($imagePathpo));
    $imagePO = 'data:image/jpeg;base64,' . $imageData2;
    // dd($imagePO);

    $imagePathee= public_path('Uploads/signature/' . $eesignid->sign);
    $imageData2 = base64_encode(file_get_contents($imagePathee));
    $imageEE = 'data:image/jpeg;base64,' . $imageData2;
    // dd($Audisignid->sign);

    $imagePathAudi= public_path('Uploads/signature/' . $Audisignid->sign);
    $imageData2 = base64_encode(file_get_contents($imagePathAudi));
    $imageAudi = 'data:image/jpeg;base64,' . $imageData2;
     //dd($imageAudi,$imageData2);

    $imagePathacc= public_path('Uploads/signature/' . $Accsignid->sign);
    $imageData2 = base64_encode(file_get_contents($imagePathacc));
    $imageAcc = 'data:image/jpeg;base64,' . $imageData2;
    //dd($imagePathacc);

    $jedesignation=DB::table('designations')->where('Designation' , $sign2->designation)->value('Designation');
    //dd($jedesignation);
    $jesubdivision=DB::table('subdivms')->where('Sub_Div_Id' , $sign2->subdiv_id)->value('Sub_Div');
    // dd($eesignid);
    $dyedesignation=DB::table('designations')->where('Designation' , $sign->designation)->value('Designation');
    $eedesignation=DB::table('designations')->where('Designation' , $eesignid->Designation)->value('Designation');
    $podesignation=DB::table('designations')->where('Designation' , $posignid->designation)->value('Designation');
    $Audidesignation=DB::table('designations')->where('Designation' , $Audisignid->designation)->value('Designation');
    $Accdesignation=DB::table('designations')->where('Designation' , $Accsignid->designation)->value('Designation');

    // dd($dyedesignation,$eedesignation,$podesignation,$Audidesignation,$Accdesignation);

    $dyesubdivision=DB::table('subdivms')->where('Sub_Div_Id' , $sign->subdiv_id)->value('Sub_Div');

    //PO View Page------------------------------------------------------------------------------------------------------------------
    if($embsection2->mb_status >= 9 && auth()->user()->usertypes == "PO" || $embsection2->mb_status >= 9 && auth()->user()->usertypes == "EE")
    {
    $DBChklstpo=DB::table('chklst_pb')
    // ->select('chklst_Id','t_bill_Id','t_bill_No','Work_Nm')
    ->where('t_bill_Id',$tbillid)
    ->first();
    //dd($DBChklstpo);
    $workid=DB::table('bills')
    ->where('t_bill_id',$tbillid)
    ->value('work_id');
    //dd($workid);

    // dd($DBChklstpo);
    $workNM=$DBChklstpo->Work_Nm ;
    $SD_chklst=$DBChklstpo->SD_chklst;
    $QC_T_Done=$DBChklstpo->QC_T_Done;
    $QC_T_No=$DBChklstpo->QC_T_No;
    $QC_Result=$DBChklstpo->QC_Result;
    $SQM_Chk=$DBChklstpo->SQM_Chk;
    $Red_Est=$DBChklstpo->Red_Est;
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
    $t_bill_Id=$DBChklstpo->MB_NO;
    $DBMB_Dt=$DBChklstpo->MB_Dt;
    $Mess_Mode=$DBChklstpo->Mess_Mode;
    $Mat_cons=$DBChklstpo->Mat_Cons;
    $CFinalbillForm65=$DBChklstpo->Form_65;
    $CFinalbillhandover=$DBChklstpo->Handover;
    $PO_Chk=$DBChklstpo->PO_Chk;
    $PO_Chk_Dt=$DBChklstpo->PO_Chk_Dt;
    $EE_Chk_Dt=$DBChklstpo->EE_Chk_Dt;
$DivisionCheck  .= '<div class="" style="margin-top:20px; border-collapse: collapse;">
<h4>Check List PO</h4>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 8%;">SR.NO</th>
                <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 50%;">Name</th>
                <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 42%;">Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">1</td>
                <td style="border: 1px solid black; padding: 5px;">Name of Work</td>
                <td style="border: 1px solid black; padding: 5px;">'. $workNM .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">2</td>
                <td style="border: 1px solid black; padding: 5px;">	Whether Check List filled by Sub Division is proper ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $SD_chklst .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">3</td>
                <td style="border: 1px solid black; padding: 5px;">Whether all Q.C. Tests required for the work have been coducted ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $QC_T_Done .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">4</td>
                <td style="border: 1px solid black; padding: 5px;">Whether the number of tests are correct as per standards ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $QC_T_No .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">5</td>
                <td style="border: 1px solid black; padding: 5px;">Whether Q.C. Test results are satisfactory ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $QC_Result .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">6</td>
                <td style="border: 1px solid black; padding: 5px;">SQM checking /third party audit carried out for this work ?</td>
                <td style="border: 1px solid black; padding: 5px;">' .$SQM_Chk.'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">7</td>
                <td style="border: 1px solid black; padding: 5px;">Whether Part Rate / Reduced Rate are correct & technically proper ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Part_Red_Rt_Proper .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">8</td>
                <td style="border: 1px solid black; padding: 5px;">	Whether quantity of any item of work has been exceeded 125% of tender quantity ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Excess_qty_125 .'</td>
            </tr>

            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">9</td>
                <td style="border: 1px solid black; padding: 5px;">If yes, proposal for effecting Clause-38 has been submitted by Sub Division with proper reasons.</td>
                <td style="border: 1px solid black; padding: 5px;">'. $CL_38_Prop .'</td>
            </tr>


            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">10</td>
                <td style="border: 1px solid black; padding: 5px;">Whether record drawing is attached ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Rec_Drg .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">11A</td>
                <td style="border: 1px solid black; padding: 5px;">Uptodate Royalty Charges payable</td>
                <td style="border: 1px solid black; padding: 5px;">'. $TotRoy .'</td>
            </tr>

            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">11B</td>
                <td style="border: 1px solid black; padding: 5px;">	Royalty Charges previously paid / recovered	</td>
                <td style="border: 1px solid black; padding: 5px;">'. $PreTotRoy .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">11C</td>
                <td style="border: 1px solid black; padding: 5px;">Royalty Charges paid by contractor for this bill</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Cur_Bill_Roy_Paid .'</td>
            </tr>

            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">11D</td>
                <td style="border: 1px solid black; padding: 5px;">	Royalty Charges proposed to be recovered from this bill	</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Roy_Rec .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">12A</td>
                <td style="border: 1px solid black; padding: 5px;">	Tender cost of work</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Tnd_Amt .'</td>
            </tr>

            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">12B</td>
                <td style="border: 1px solid black; padding: 5px;">	Uptodate Bill Amount of work</td>
                <td style="border: 1px solid black; padding: 5px;">'. $netAmt .'</td>
                </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">12C</td>
                <td style="border: 1px solid black; padding: 5px;">	Current Bill Amount</td>
                <td style="border: 1px solid black; padding: 5px;">'. $c_netamt .'</td>
            </tr>
            <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">13</td>
            <td style="border: 1px solid black; padding: 5px;">	Actual Date of Completion</td>
            <td style="border: 1px solid black; padding: 5px;">'. $Act_Comp_Dt .'</td>
        </tr>


        <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">14</td>
            <td style="border: 1px solid black; padding: 5px;">Whether consumptions of material are correct ?</td>
            <td style="border: 1px solid black; padding: 5px;">'. $Mat_cons .' </td>
        </tr>
        <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">15</td>
            <td style="border: 1px solid black; padding: 5px;">Work Completion Certificate (Form-65) attached ?</td>
            <td style="border: 1px solid black; padding: 5px;">'. $CFinalbillForm65 .'</td>
        </tr>
        <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">16</td>
            <td style="border: 1px solid black; padding: 5px;">	Letter / Certificate regarding handover of work attached ?</td>
            <td style="border: 1px solid black; padding: 5px;">'. $CFinalbillhandover .'</td>
        </tr>
        <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">17</td>
            <td style="border: 1px solid black; padding: 5px;"> Has reduced estimate prepared and submitted for this work ?</td>
            <td style="border: 1px solid black; padding: 5px;">' .$SQM_Chk.'</td>
        </tr>';
           if(auth()->user()->usertypes === "PO" &&   $embsection2->mb_status >=10 ||  auth()->user()->usertypes === "EE" &&   $embsection2->mb_status >9)
            {
                $fPOChkDt = $PO_Chk_Dt ? date('d/m/Y', strtotime($PO_Chk_Dt)) : '';

                $DivisionCheck .='<tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                    <td style="border: 1px solid black; padding: 5px;">PO Check Date</td>
                    <td style="border: 1px solid black; padding: 5px;">'. $fPOChkDt .'</td>
                </tr>';
            }
            if( auth()->user()->usertypes === "EE" &&   $embsection2->mb_status===13 || auth()->user()->usertypes === "PO" &&   $embsection2->mb_status===13 )

                // if( $embsection2->mb_status === 12)
                {
                $fPOChkDt = $PO_Chk_Dt ? date('d/m/Y', strtotime($EE_Chk_Dt)) : '';

                $DivisionCheck .='<tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                    <td style="border: 1px solid black; padding: 5px;">EE Check Date</td>
                    <td style="border: 1px solid black; padding: 5px;">'. $fPOChkDt .'</td>
                </tr>
              ';
            }
            if(auth()->user()->usertypes === "PO" &&   $embsection2->mb_status >=10 && $embsection2->mb_status < 13  || auth()->user()->usertypes === "EE" &&   $embsection2->mb_status >=10 && $embsection2->mb_status < 13)
            {
                $DivisionCheck .='<tr>

                    <td colspan="3" style="border: 1px solid black; padding: 5px; text-align:center;"><img src="' . $imagePO  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                    <br>'.$posignid->name.' <br>'.$posignid->designation.' <br>'.$workdata->Div.'</td>

                </tr>
               ';
            }
            // if( $embsection2->mb_status === 12 )
            if(  auth()->user()->usertypes === "EE" &&   $embsection2->mb_status ===13 || auth()->user()->usertypes === "PO" &&   $embsection2->mb_status ===13 )
            {
                $DivisionCheck .='<tr>
                    <td colspan="2"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imagePO  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                    <br>'.$posignid->name.' <br>'.$posignid->designation.' <br>'.$workdata->Div.'</td>
                    <td colspan="1"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageEE  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                    <br>'.$eesignid->name.' <br>'.$eesignid->Designation.' <br>'.$workdata->Div.'</td>
                </tr>';
            }
            $DivisionCheck .= ' </tbody></table></div> ';
    }
    // dd($embsection2->mb_status);

    if($embsection2->mb_status >= 10 && auth()->user()->usertypes == "audit" || $embsection2->mb_status === 12 && auth()->user()->usertypes == "audit" )
    {
        $DivisionCheck  .= '<h4>Auditor Check List </h4>';
    }
    //Auditor View Page---------------------------------------------------------------------------------------------------------
    if($embsection2->mb_status >= 10 && auth()->user()->usertypes == "audit" || $embsection2->mb_status === 12 && auth()->user()->usertypes == "audit")
    {
        $t_bill_id=$tbillid;
        // dd('Data Availble in Auditor Table Update Record');
        $DBAudiExist=DB::table('chcklst_aud')
        ->where('t_bill_Id',$t_bill_id)
        ->first();
        //dd($DBAudiExist);
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
        $AAO_Chk_Dt=$DBAudiExist->AAO_Chk_Dt;
        $EE_Chk_Dt=$DBAudiExist->EE_Chck_Dt;
        // dd($Aud_Chk_Dt);
        $fAuditorChkDt = $Aud_Chk_Dt ? date('d/m/Y', strtotime($Aud_Chk_Dt)) : '';
                        $fAcountantChkDt = $AAO_Chk_Dt ? date('d/m/Y', strtotime($AAO_Chk_Dt)) : '';
        $lastPOdate=DB::table('chklst_pb')
        ->where('t_bill_Id',$t_bill_id)
        ->value('PO_Chk_Dt');
        $DivisionCheck  .= '<div class="" style="margin-top:20px; border-collapse: collapse;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 8%;">SR.NO</th>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 50%;">Name</th>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 42%;">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">1</td>
                        <td style="border: 1px solid black; padding: 5px;">Name of Work</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $workNM .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">2</td>
                        <td style="border: 1px solid black; padding: 5px;">Fund Head</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $FH_code .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">3</td>
                        <td style="border: 1px solid black; padding: 5px;">Whether arithmatic check is done ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Arith_chk .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">4</td>
                        <td style="border: 1px solid black; padding: 5px;">Whether Work Insurance Policy & Premium Paid Receipt submitted by Contractor ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Ins_Policy_Agency .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">5</td>
                        <td style="border: 1px solid black; padding: 5px;">If Yes, amount of premium paid</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Ins_Prem_Amt_Agency .'</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">6</td>
                        <td style="border: 1px solid black; padding: 5px;">Does necessary Deductions and Recoveries are considered while preparing bill ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Bl_Rec_Ded .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">7</td>
                        <td style="border: 1px solid black; padding: 5px;">		Gross Bill Amount</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $C_netAmt .'</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">8</td>
                        <td style="border: 1px solid black; padding: 5px;">	Total Deductions</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $tot_ded .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">10</td>
                        <td style="border: 1px solid black; padding: 5px;">	Cheque Amount</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $chq_amt .'</td>
                    </tr>';

                    if(auth()->user()->usertypes == "audit" &&   $embsection2->mb_status>=11 || auth()->user()->usertypes == "audit" &&   $embsection2->mb_status===13 ||auth()->user()->usertypes == "EE" &&   $embsection2->mb_status===13)
                    {
                    $fAuditorChkDt = $Aud_Chk_Dt ? date('d/m/Y', strtotime($Aud_Chk_Dt)) : '';

                    $DivisionCheck .='<tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                        <td style="border: 1px solid black; padding: 5px;">Auditor Check Date</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $fAuditorChkDt .'</td>
                    </tr>';
                    if($embsection2->mb_status>=12)
                    $DivisionCheck .='<tr>
                            <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                            <td style="border: 1px solid black; padding: 5px;">AAO Check Date</td>
                            <td style="border: 1px solid black; padding: 5px;">'. $fAcountantChkDt .'</td>
                        </tr>';
                }

                if( auth()->user()->usertypes == "EE" &&   $embsection2->mb_status ===13 || auth()->user()->usertypes == "audit" &&   $embsection2->mb_status===13 )
                {
                    $fEEChkDt = $EE_Chk_Dt ? date('d/m/Y', strtotime($EE_Chk_Dt)) : '';

                    $DivisionCheck .='<tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                        <td style="border: 1px solid black; padding: 5px;">EE Check Date</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $fEEChkDt .'</td>
                    </tr>';
                }
                if(auth()->user()->usertypes == "audit" &&   $embsection2->mb_status ===11  || auth()->user()->usertypes == "EE" &&   $embsection2->mb_status >13)
                {
                    $DivisionCheck .='<tr>
                            <td colspan="2" style="border: 1px solid black; padding: 5px;"></td>
                            <td colspan="1"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAudi  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                            <br>'.$Audisignid->name.' <br>'.$Audisignid->designation.' <br>'.$workdata->Div.'</td>
                    </tr>';
                }

                if(  auth()->user()->usertypes === "EE" &&   $embsection2->mb_status===13 || auth()->user()->usertypes === "audit" &&   $embsection2->mb_status >=12 )
                {
                $DivisionCheck .='<tr>
                    <td colspan="2"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAudi  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                    <br>'.$Audisignid->name.' <br>'.$Audisignid->designation.' <br>'.$workdata->Div.'</td>
                    <td colspan="1"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAcc  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                    <br>'.$Accsignid->name.' <br>'.$Accsignid->designation.' <br>'.$workdata->Div.'</td>
                </tr>';

                    if( $embsection2->mb_status>=13)
                $DivisionCheck .='<tr><td colspan="3"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageEE  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                <br>'.$eesignid->name.' <br>'.$eesignid->Designation.' <br>'.$workdata->Div.'</td> </tr>';
                 }


                     $DivisionCheck.= '</tbody></table></div> ';

    }
    //    dd($embsection2->mb_status >= 13 &&  == "EE");
    // dd($embsection2->mb_status);
    // dd(auth()->user()->usertypes);

    // Accountant View---------------------------------------------------------------------------------------------------------------
    if(auth()->user()->usertypes === "AAO" &&   $embsection2->mb_status >= 11 || auth()->user()->usertypes === "AAO" && $embsection2->mb_status==13 || auth()->user()->usertypes === "EE" && $embsection2->mb_status === 13 )
    {
        // dd('ok');
        $DivisionCheck  .= '<h4>Accountant Check List </h4>';
    }

    if(auth()->user()->usertypes === "EE" && $embsection2->mb_status >=11 || auth()->user()->usertypes === "AAO" &&   $embsection2->mb_status>=11 || auth()->user()->usertypes === "AAO" &&   $embsection2->mb_status===13)
    {
        $t_bill_id=$tbillid;
        // dd('Data Availble in Auditor Table Update Record');
        $DBAudiExist=DB::table('chcklst_aud')
        ->where('t_bill_Id',$t_bill_id)
        ->first();
        //dd($DBAudiExist);
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
        $AAO_Chk_Dt=$DBAudiExist->AAO_Chk_Dt;
        $EE_Chk_Dt=$DBAudiExist->EE_Chck_Dt;
        // dd($Aud_Chk_Dt);
        $lastPOdate=DB::table('chklst_pb')
        ->where('t_bill_Id',$t_bill_id)
        ->value('PO_Chk_Dt');

        $commonHelperDeduction = new CommonHelper();
        // Call the function using the instance
        $htmlDeduction = $commonHelperDeduction->convertAmountToWords($C_netAmt);


        $DivisionCheck  .= '<div class="" style="margin-top:20px; border-collapse: collapse;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 8%;">SR.NO</th>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 50%;">Name</th>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 42%;">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">1</td>
                        <td style="border: 1px solid black; padding: 5px;">Name of Work</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $workNM .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">2</td>
                        <td style="border: 1px solid black; padding: 5px;">Fund Head</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $FH_code .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">3</td>
                        <td style="border: 1px solid black; padding: 5px;">Whether arithmatic check is done ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Arith_chk .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">4</td>
                        <td style="border: 1px solid black; padding: 5px;">Whether Work Insurance Policy & Premium Paid Receipt submitted by Contractor ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Ins_Policy_Agency .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">5</td>
                        <td style="border: 1px solid black; padding: 5px;">If Yes, amount of premium paid</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Ins_Prem_Amt_Agency .'</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">6</td>
                        <td style="border: 1px solid black; padding: 5px;">Does necessary Deductions and Recoveries are considered while preparing bill ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Bl_Rec_Ded .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">7</td>
                        <td style="border: 1px solid black; padding: 5px;">		Gross Bill Amount</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $C_netAmt .'</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">8</td>
                        <td style="border: 1px solid black; padding: 5px;">	Total Deductions</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $tot_ded .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">10</td>
                        <td style="border: 1px solid black; padding: 5px;">	Cheque Amount</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $chq_amt .'</td>
                    </tr>
                    <tr>
                    <td colspan="3" style="text-align: right; border: 1px solid black; padding-right: 50px;"><strong>Passed for Rs.'.$C_netAmt.'('.$htmlDeduction.')</strong></td>

                </tr>';
                   $fAuditorChkDt = $Aud_Chk_Dt ? date('d/m/Y', strtotime($EE_Chk_Dt)) : '';
                      $fAcountantChkDt = $AAO_Chk_Dt ? date('d/m/Y', strtotime($AAO_Chk_Dt)) : '';
                    //   dd($embsection2->mb_status);
                      if(auth()->user()->usertypes === "EE" && $embsection2->mb_status>13 || auth()->user()->usertypes === "AAO" && $embsection2->mb_status===11)
                      {

                          $DivisionCheck .='<tr>
                              <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                              <td style="border: 1px solid black; padding: 5px;">Auditor Check Date</td>
                              <td style="border: 1px solid black; padding: 5px;">'. $fAuditorChkDt .'</td>
                          </tr>
                          <tr>
                          <td  colspan="2" style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                          <td colspan="1" style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAudi  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                          <br>'.$Audisignid->name.' <br>'.$Audisignid->designation.' <br>'.$workdata->Div.'</td>';
                      }

                //Date Conditions--------------------------------------------------
//                 if(auth()->user()->usertypes === "AAO" && $embsection2->mb_status>=11 )

// dd($embsection2->mb_status);
                if(auth()->user()->usertypes === "EE" && $embsection2->mb_status>=13 || auth()->user()->usertypes === "AAO" && $embsection2->mb_status>=12 )
                    {

                        $DivisionCheck .='<tr>
                            <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                            <td style="border: 1px solid black; padding: 5px;">Auditor Check Date</td>
                            <td style="border: 1px solid black; padding: 5px;">'. $fAuditorChkDt .'</td>
                        </tr>';


                        $DivisionCheck .='<tr>
                            <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                            <td style="border: 1px solid black; padding: 5px;">AAO Check Date</td>
                            <td style="border: 1px solid black; padding: 5px;">'. $fAcountantChkDt .'</td>
                        </tr>';
                    }
                    if(auth()->user()->usertypes === "EE" && $embsection2->mb_status>=13 ||  auth()->user()->usertypes === "AAO" && $embsection2->mb_status>=13  )
                    {


                        $DivisionCheck .='<tr>
                            <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                            <td style="border: 1px solid black; padding: 5px;">EE Check Date</td>
                            <td style="border: 1px solid black; padding: 5px;">'. $fAuditorChkDt .'</td>
                        </tr>';
                    }
                    //Sign Condition.................................
                 // dd($embsection2->mb_status);
                    if(auth()->user()->usertypes === "EE" && $embsection2->mb_status>=12 || auth()->user()->usertypes === "AAO" && $embsection2->mb_status >= 12  )
                    {
                        //dd($embsection2->mb_status);
                        $fAuditorChkDt = $Aud_Chk_Dt ? date('d/m/Y', strtotime($Aud_Chk_Dt)) : '';

                        $DivisionCheck .='
                        <tr>
                            <td colspan="2"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAudi  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                            <br>'.$Audisignid->name.' <br>'.$Audisignid->designation.' <br>'.$workdata->Div.'</td>
                            <td colspan="1"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAcc  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                            <br>'.$Accsignid->name.' <br>'.$Accsignid->designation.' <br>'.$workdata->Div.'</td>
                        </tr>';
                    }
                    if(auth()->user()->usertypes === "EE" && $embsection2->mb_status===13 || auth()->user()->usertypes === "AAO" && $embsection2->mb_status>=13 )
                    {
                        $fAuditorChkDt = $Aud_Chk_Dt ? date('d/m/Y', strtotime($EE_Chk_Dt)) : '';

                        $DivisionCheck .='<tr>

                        <td colspan="3"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageEE  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                        <br>'.$eesignid->name.' <br>'.$eesignid->Designation.' <br>'.$workdata->Div.'</td>
                    </tr>
        ';
                    }
                     $DivisionCheck.= '</tbody></table></div> ';

    }



    return view('Checklistreport/DivisionChecklist' ,compact('embsection2' , 'DivisionCheck'));
}

public function FundivisionchecklistPDF(Request $request , $tbillid)
{
    // dd("okkkkkkkkkkk");
    //dd($tbillid);
    $DivisionCheck='';
    $DBchklst_POExist=DB::table('chklst_pb')
    ->where('t_bill_Id',$tbillid)
    ->first();
    // dd($DBchklst_POExist);
    $embsection2=DB::table('bills')->where('t_bill_Id' , $tbillid)->first();

    $headercheck='divchecklist';

    // Resolve an instance of ReportController
    $reportController = app()->make(\App\Http\Controllers\ReportController::class);

    // Call the commonheader method
    $header = $reportController->commonheader($tbillid, $headercheck);
        //$header=ReportController::commonheader($tbillid , $headercheck);
    //  dd($header);

    $DivisionCheck .=$header;
    //dd($DivisionCheck);

    $tbilldata=DB::table('bills')->where('t_bill_Id' , $tbillid)->first();

    $billitems=DB::table('bil_item')->where('t_bill_id' , $tbillid)->get();

    $workid=DB::table('bills')->where('t_bill_Id' , $tbillid)->value('work_id');
    //dd($workid);
    $workdata=DB::table('workmasters')->where('Work_Id' , $workid)->first();
    // dd($workdata->Div);
    $jeid=$workdata->jeid;
    $dyeid=$workdata->DYE_id;
    $poid=$workdata->PB_Id;
    $EEid=$workdata->EE_id;
    $Audiid=$workdata->AB_Id;
    // dd($Audiid);
    $Accid=$workdata->DAO_Id;
    $sign=DB::table('dyemasters')->where('dye_id' , $dyeid)->first();
    // dd($sign);
    $sign2=DB::table('jemasters')->where('jeid' , $jeid)->first();
    $posignid=DB::table('jemasters')->where('jeid' , $poid)->first();
    $eesignid=DB::table('eemasters')->where('eeid' , $EEid)->first();
    $Audisignid=DB::table('abmasters')->where('AB_Id' , $Audiid)->first();
    //dd($Audisignid);
    $Accsignid=DB::table('daomasters')->where('DAO_id' , $Accid)->first();

    // dd($posignid);
    // Construct the full file path
    $imagePath = public_path('Uploads/signature/' . $sign->sign);
    $imageData = base64_encode(file_get_contents($imagePath));
    $imageSrc = 'data:image/jpeg;base64,' . $imageData;

    $imagePath2 = public_path('Uploads/signature/' . $sign2->sign);
    $imageData2 = base64_encode(file_get_contents($imagePath2));
    $imageSrc2 = 'data:image/jpeg;base64,' . $imageData2;

    $imagePathpo = public_path('Uploads/signature/' . $posignid->sign);
    $imageData2 = base64_encode(file_get_contents($imagePathpo));
    $imagePO = 'data:image/jpeg;base64,' . $imageData2;
    // dd($imagePO);

    $imagePathee= public_path('Uploads/signature/' . $eesignid->sign);
    $imageData2 = base64_encode(file_get_contents($imagePathee));
    $imageEE = 'data:image/jpeg;base64,' . $imageData2;
    // dd($Audisignid->sign);

    $imagePathAudi= public_path('Uploads/signature/' . $Audisignid->sign);
    $imageData2 = base64_encode(file_get_contents($imagePathAudi));
    $imageAudi = 'data:image/jpeg;base64,' . $imageData2;
     //dd($imageAudi,$imageData2);

    $imagePathacc= public_path('Uploads/signature/' . $Accsignid->sign);
    $imageData2 = base64_encode(file_get_contents($imagePathacc));
    $imageAcc = 'data:image/jpeg;base64,' . $imageData2;
    //dd($imagePathacc);

    $jedesignation=DB::table('designations')->where('Designation' , $sign2->designation)->value('Designation');
    //dd($jedesignation);
    $jesubdivision=DB::table('subdivms')->where('Sub_Div_Id' , $sign2->subdiv_id)->value('Sub_Div');
    // dd($eesignid);
    $dyedesignation=DB::table('designations')->where('Designation' , $sign->designation)->value('Designation');
    $eedesignation=DB::table('designations')->where('Designation' , $eesignid->Designation)->value('Designation');
    $podesignation=DB::table('designations')->where('Designation' , $posignid->designation)->value('Designation');
    $Audidesignation=DB::table('designations')->where('Designation' , $Audisignid->designation)->value('Designation');
    $Accdesignation=DB::table('designations')->where('Designation' , $Accsignid->designation)->value('Designation');

    // dd($dyedesignation,$eedesignation,$podesignation,$Audidesignation,$Accdesignation);

    $dyesubdivision=DB::table('subdivms')->where('Sub_Div_Id' , $sign->subdiv_id)->value('Sub_Div');

    //PO View Page------------------------------------------------------------------------------------------------------------------
    if($embsection2->mb_status >= 9 && auth()->user()->usertypes == "PO" || $embsection2->mb_status >= 9 && auth()->user()->usertypes == "EE")
    {
    $DBChklstpo=DB::table('chklst_pb')
    // ->select('chklst_Id','t_bill_Id','t_bill_No','Work_Nm')
    ->where('t_bill_Id',$tbillid)
    ->first();
    //dd($DBChklstpo);
    $workid=DB::table('bills')
    ->where('t_bill_id',$tbillid)
    ->value('work_id');
    //dd($workid);

    // dd($DBChklstpo);
    $workNM=$DBChklstpo->Work_Nm ;
    $SD_chklst=$DBChklstpo->SD_chklst;
    $QC_T_Done=$DBChklstpo->QC_T_Done;
    $QC_T_No=$DBChklstpo->QC_T_No;
    $QC_Result=$DBChklstpo->QC_Result;
    $SQM_Chk=$DBChklstpo->SQM_Chk;
    $Red_Est=$DBChklstpo->Red_Est;
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
    $t_bill_Id=$DBChklstpo->MB_NO;
    $DBMB_Dt=$DBChklstpo->MB_Dt;
    $Mess_Mode=$DBChklstpo->Mess_Mode;
    $Mat_cons=$DBChklstpo->Mat_Cons;
    $CFinalbillForm65=$DBChklstpo->Form_65;
    $CFinalbillhandover=$DBChklstpo->Handover;
    $PO_Chk=$DBChklstpo->PO_Chk;
    $PO_Chk_Dt=$DBChklstpo->PO_Chk_Dt;
    $EE_Chk_Dt=$DBChklstpo->EE_Chk_Dt;
$DivisionCheck  .= '<div class="" style="margin-top:20px; border-collapse: collapse;">
<h4>Check List PO</h4>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 8%;">SR.NO</th>
                <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 50%;">Name</th>
                <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 42%;">Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">1</td>
                <td style="border: 1px solid black; padding: 5px;">Name of Work</td>
                <td style="border: 1px solid black; padding: 5px;">'. $workNM .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">2</td>
                <td style="border: 1px solid black; padding: 5px;">	Whether Check List filled by Sub Division is proper ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $SD_chklst .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">3</td>
                <td style="border: 1px solid black; padding: 5px;">Whether all Q.C. Tests required for the work have been coducted ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $QC_T_Done .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">4</td>
                <td style="border: 1px solid black; padding: 5px;">Whether the number of tests are correct as per standards ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $QC_T_No .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">5</td>
                <td style="border: 1px solid black; padding: 5px;">Whether Q.C. Test results are satisfactory ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $QC_Result .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">6</td>
                <td style="border: 1px solid black; padding: 5px;">SQM checking /third party audit carried out for this work ?</td>
                <td style="border: 1px solid black; padding: 5px;">' .$SQM_Chk.'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">7</td>
                <td style="border: 1px solid black; padding: 5px;">Whether Part Rate / Reduced Rate are correct & technically proper ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Part_Red_Rt_Proper .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">8</td>
                <td style="border: 1px solid black; padding: 5px;">	Whether quantity of any item of work has been exceeded 125% of tender quantity ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Excess_qty_125 .'</td>
            </tr>

            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">9</td>
                <td style="border: 1px solid black; padding: 5px;">If yes, proposal for effecting Clause-38 has been submitted by Sub Division with proper reasons.</td>
                <td style="border: 1px solid black; padding: 5px;">'. $CL_38_Prop .'</td>
            </tr>


            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">10</td>
                <td style="border: 1px solid black; padding: 5px;">Whether record drawing is attached ?</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Rec_Drg .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">11A</td>
                <td style="border: 1px solid black; padding: 5px;">Uptodate Royalty Charges payable</td>
                <td style="border: 1px solid black; padding: 5px;">'. $TotRoy .'</td>
            </tr>

            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">11B</td>
                <td style="border: 1px solid black; padding: 5px;">	Royalty Charges previously paid / recovered	</td>
                <td style="border: 1px solid black; padding: 5px;">'. $PreTotRoy .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">11C</td>
                <td style="border: 1px solid black; padding: 5px;">Royalty Charges paid by contractor for this bill</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Cur_Bill_Roy_Paid .'</td>
            </tr>

            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">11D</td>
                <td style="border: 1px solid black; padding: 5px;">	Royalty Charges proposed to be recovered from this bill	</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Roy_Rec .'</td>
            </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">12A</td>
                <td style="border: 1px solid black; padding: 5px;">	Tender cost of work</td>
                <td style="border: 1px solid black; padding: 5px;">'. $Tnd_Amt .'</td>
            </tr>

            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">12B</td>
                <td style="border: 1px solid black; padding: 5px;">	Uptodate Bill Amount of work</td>
                <td style="border: 1px solid black; padding: 5px;">'. $netAmt .'</td>
                </tr>
            <tr>
                <td style="text-align: right; border: 1px solid black; padding: 5px;">12C</td>
                <td style="border: 1px solid black; padding: 5px;">	Current Bill Amount</td>
                <td style="border: 1px solid black; padding: 5px;">'. $c_netamt .'</td>
            </tr>
            <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">13</td>
            <td style="border: 1px solid black; padding: 5px;">	Actual Date of Completion</td>
            <td style="border: 1px solid black; padding: 5px;">'. $Act_Comp_Dt .'</td>
        </tr>


        <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">14</td>
            <td style="border: 1px solid black; padding: 5px;">Whether consumptions of material are correct ?</td>
            <td style="border: 1px solid black; padding: 5px;">'. $Mat_cons .' </td>
        </tr>
        <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">15</td>
            <td style="border: 1px solid black; padding: 5px;">Work Completion Certificate (Form-65) attached ?</td>
            <td style="border: 1px solid black; padding: 5px;">'. $CFinalbillForm65 .'</td>
        </tr>
        <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">16</td>
            <td style="border: 1px solid black; padding: 5px;">	Letter / Certificate regarding handover of work attached ?</td>
            <td style="border: 1px solid black; padding: 5px;">'. $CFinalbillhandover .'</td>
        </tr>
        <tr>
            <td style="text-align: right; border: 1px solid black; padding: 5px;">17</td>
            <td style="border: 1px solid black; padding: 5px;"> Has reduced estimate prepared and submitted for this work ?</td>
            <td style="border: 1px solid black; padding: 5px;">' .$SQM_Chk.'</td>
        </tr>';
           if(auth()->user()->usertypes === "PO" &&   $embsection2->mb_status >=10 ||  auth()->user()->usertypes === "EE" &&   $embsection2->mb_status >9)
            {
                $fPOChkDt = $PO_Chk_Dt ? date('d/m/Y', strtotime($PO_Chk_Dt)) : '';

                $DivisionCheck .='<tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                    <td style="border: 1px solid black; padding: 5px;">PO Check Date</td>
                    <td style="border: 1px solid black; padding: 5px;">'. $fPOChkDt .'</td>
                </tr>';
            }
            if( auth()->user()->usertypes === "EE" &&   $embsection2->mb_status===13 || auth()->user()->usertypes === "PO" &&   $embsection2->mb_status===13 )

                // if( $embsection2->mb_status === 12)
                {
                $fPOChkDt = $PO_Chk_Dt ? date('d/m/Y', strtotime($EE_Chk_Dt)) : '';

                $DivisionCheck .='<tr>
                    <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                    <td style="border: 1px solid black; padding: 5px;">EE Check Date</td>
                    <td style="border: 1px solid black; padding: 5px;">'. $fPOChkDt .'</td>
                </tr>
              ';
            }
            if(auth()->user()->usertypes === "PO" &&   $embsection2->mb_status >=10 && $embsection2->mb_status < 13  || auth()->user()->usertypes === "EE" &&   $embsection2->mb_status >=10 && $embsection2->mb_status < 13)
            {
                $DivisionCheck .='<tr>

                    <td colspan="3" style="border: 1px solid black; padding: 5px; text-align:center;"><img src="' . $imagePO  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                    <br>'.$posignid->name.' <br>'.$posignid->designation.' <br>'.$workdata->Div.'</td>

                </tr>
               ';
            }
            // if( $embsection2->mb_status === 12 )
            if(  auth()->user()->usertypes === "EE" &&   $embsection2->mb_status ===13 || auth()->user()->usertypes === "PO" &&   $embsection2->mb_status ===13 )
            {
                $DivisionCheck .='<tr>
                    <td colspan="2"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imagePO  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                    <br>'.$posignid->name.' <br>'.$posignid->designation.' <br>'.$workdata->Div.'</td>
                    <td colspan="1"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageEE  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                    <br>'.$eesignid->name.' <br>'.$eesignid->Designation.' <br>'.$workdata->Div.'</td>
                </tr>';
            }
            $DivisionCheck .= ' </tbody></table></div> ';
    }
    // dd($embsection2->mb_status);

    if($embsection2->mb_status >= 10 && auth()->user()->usertypes == "audit" || $embsection2->mb_status === 12 && auth()->user()->usertypes == "audit" )
    {
        $DivisionCheck  .= '<h4>Auditor Check List </h4>';
    }
        //Auditor View Page---------------------------------------------------------------------------------------------------------
    if($embsection2->mb_status >= 10 && auth()->user()->usertypes == "audit" || $embsection2->mb_status === 12 && auth()->user()->usertypes == "audit")
    {
        $t_bill_id=$tbillid;
        // dd('Data Availble in Auditor Table Update Record');
        $DBAudiExist=DB::table('chcklst_aud')
        ->where('t_bill_Id',$t_bill_id)
        ->first();
        //dd($DBAudiExist);
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
        $AAO_Chk_Dt=$DBAudiExist->AAO_Chk_Dt;
        $EE_Chk_Dt=$DBAudiExist->EE_Chck_Dt;
        // dd($Aud_Chk_Dt);
        $fAuditorChkDt = $Aud_Chk_Dt ? date('d/m/Y', strtotime($Aud_Chk_Dt)) : '';
                        $fAcountantChkDt = $AAO_Chk_Dt ? date('d/m/Y', strtotime($AAO_Chk_Dt)) : '';
        $lastPOdate=DB::table('chklst_pb')
        ->where('t_bill_Id',$t_bill_id)
        ->value('PO_Chk_Dt');
        $DivisionCheck  .= '<div class="" style="margin-top:20px; border-collapse: collapse;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 8%;">SR.NO</th>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 50%;">Name</th>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 42%;">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">1</td>
                        <td style="border: 1px solid black; padding: 5px;">Name of Work</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $workNM .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">2</td>
                        <td style="border: 1px solid black; padding: 5px;">Fund Head</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $FH_code .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">3</td>
                        <td style="border: 1px solid black; padding: 5px;">Whether arithmatic check is done ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Arith_chk .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">4</td>
                        <td style="border: 1px solid black; padding: 5px;">Whether Work Insurance Policy & Premium Paid Receipt submitted by Contractor ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Ins_Policy_Agency .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">5</td>
                        <td style="border: 1px solid black; padding: 5px;">If Yes, amount of premium paid</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Ins_Prem_Amt_Agency .'</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">6</td>
                        <td style="border: 1px solid black; padding: 5px;">Does necessary Deductions and Recoveries are considered while preparing bill ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Bl_Rec_Ded .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">7</td>
                        <td style="border: 1px solid black; padding: 5px;">		Gross Bill Amount</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $C_netAmt .'</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">8</td>
                        <td style="border: 1px solid black; padding: 5px;">	Total Deductions</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $tot_ded .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">10</td>
                        <td style="border: 1px solid black; padding: 5px;">	Cheque Amount</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $chq_amt .'</td>
                    </tr>';

                    if(auth()->user()->usertypes == "audit" &&   $embsection2->mb_status>=11 || auth()->user()->usertypes == "audit" &&   $embsection2->mb_status===13 ||auth()->user()->usertypes == "EE" &&   $embsection2->mb_status===13)
                    {
                    $fAuditorChkDt = $Aud_Chk_Dt ? date('d/m/Y', strtotime($Aud_Chk_Dt)) : '';

                    $DivisionCheck .='<tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                        <td style="border: 1px solid black; padding: 5px;">Auditor Check Date</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $fAuditorChkDt .'</td>
                    </tr>';
                    if($embsection2->mb_status>=12)
                    $DivisionCheck .='<tr>
                            <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                            <td style="border: 1px solid black; padding: 5px;">AAO Check Date</td>
                            <td style="border: 1px solid black; padding: 5px;">'. $fAcountantChkDt .'</td>
                        </tr>';
                }

                if( auth()->user()->usertypes == "EE" &&   $embsection2->mb_status ===13 || auth()->user()->usertypes == "audit" &&   $embsection2->mb_status===13 )
                {
                    $fEEChkDt = $EE_Chk_Dt ? date('d/m/Y', strtotime($EE_Chk_Dt)) : '';

                    $DivisionCheck .='<tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                        <td style="border: 1px solid black; padding: 5px;">EE Check Date</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $fEEChkDt .'</td>
                    </tr>';
                }
                if(auth()->user()->usertypes == "audit" &&   $embsection2->mb_status ===11  || auth()->user()->usertypes == "EE" &&   $embsection2->mb_status >13)
                {
                    $DivisionCheck .='<tr>
                            <td colspan="2" style="border: 1px solid black; padding: 5px;"></td>
                            <td colspan="1"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAudi  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                            <br>'.$Audisignid->name.' <br>'.$Audisignid->designation.' <br>'.$workdata->Div.'</td>
                    </tr>';
                }

                if(  auth()->user()->usertypes === "EE" &&   $embsection2->mb_status===13 || auth()->user()->usertypes === "audit" &&   $embsection2->mb_status >=12 )
                {
                $DivisionCheck .='<tr>
                    <td colspan="2"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAudi  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                    <br>'.$Audisignid->name.' <br>'.$Audisignid->designation.' <br>'.$workdata->Div.'</td>
                    <td colspan="1"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAcc  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                    <br>'.$Accsignid->name.' <br>'.$Accsignid->designation.' <br>'.$workdata->Div.'</td>
                </tr>';

                    if( $embsection2->mb_status>=13)
                $DivisionCheck .='<tr><td colspan="3"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageEE  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                <br>'.$eesignid->name.' <br>'.$eesignid->Designation.' <br>'.$workdata->Div.'</td> </tr>';
                 }


                     $DivisionCheck.= '</tbody></table></div> ';

    }

    // Accountant View---------------------------------------------------------------------------------------------------------------
    if(auth()->user()->usertypes === "AAO" &&   $embsection2->mb_status >= 11 || auth()->user()->usertypes === "AAO" && $embsection2->mb_status==13 || auth()->user()->usertypes === "EE" && $embsection2->mb_status === 13 )
    {
        // dd('ok');
        $DivisionCheck  .= '<h4>Accountant Check List </h4>';
    }

    if(auth()->user()->usertypes === "EE" && $embsection2->mb_status >=11 || auth()->user()->usertypes === "AAO" &&   $embsection2->mb_status>=11 || auth()->user()->usertypes === "AAO" &&   $embsection2->mb_status===13)
    {
        $t_bill_id=$tbillid;
        // dd('Data Availble in Auditor Table Update Record');
        $DBAudiExist=DB::table('chcklst_aud')
        ->where('t_bill_Id',$t_bill_id)
        ->first();
        //dd($DBAudiExist);
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
        $AAO_Chk_Dt=$DBAudiExist->AAO_Chk_Dt;
        $EE_Chk_Dt=$DBAudiExist->EE_Chck_Dt;
        // dd($Aud_Chk_Dt);
        $lastPOdate=DB::table('chklst_pb')
        ->where('t_bill_Id',$t_bill_id)
        ->value('PO_Chk_Dt');

        $commonHelperDeduction = new CommonHelper();
        // Call the function using the instance
        $htmlDeduction = $commonHelperDeduction->convertAmountToWords($C_netAmt);


        $DivisionCheck  .= '<div class="" style="margin-top:20px; border-collapse: collapse;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 8%;">SR.NO</th>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 50%;">Name</th>
                        <th style="border: 1px solid black; padding: 6px; background-color: #f2f2f2; text-align: center; width: 42%;">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">1</td>
                        <td style="border: 1px solid black; padding: 5px;">Name of Work</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $workNM .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">2</td>
                        <td style="border: 1px solid black; padding: 5px;">Fund Head</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $FH_code .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">3</td>
                        <td style="border: 1px solid black; padding: 5px;">Whether arithmatic check is done ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Arith_chk .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">4</td>
                        <td style="border: 1px solid black; padding: 5px;">Whether Work Insurance Policy & Premium Paid Receipt submitted by Contractor ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Ins_Policy_Agency .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">5</td>
                        <td style="border: 1px solid black; padding: 5px;">If Yes, amount of premium paid</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Ins_Prem_Amt_Agency .'</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">6</td>
                        <td style="border: 1px solid black; padding: 5px;">Does necessary Deductions and Recoveries are considered while preparing bill ?</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $Bl_Rec_Ded .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">7</td>
                        <td style="border: 1px solid black; padding: 5px;">		Gross Bill Amount</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $C_netAmt .'</td>
                    </tr>

                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">8</td>
                        <td style="border: 1px solid black; padding: 5px;">	Total Deductions</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $tot_ded .'</td>
                    </tr>
                    <tr>
                        <td style="text-align: right; border: 1px solid black; padding: 5px;">10</td>
                        <td style="border: 1px solid black; padding: 5px;">	Cheque Amount</td>
                        <td style="border: 1px solid black; padding: 5px;">'. $chq_amt .'</td>
                    </tr>
                    <tr>
                    <td colspan="3" style="text-align: right; border: 1px solid black; padding-right: 50px;"><strong>Passed for Rs.'.$C_netAmt.'('.$htmlDeduction.')</strong></td>

                </tr>';
                   $fAuditorChkDt = $Aud_Chk_Dt ? date('d/m/Y', strtotime($EE_Chk_Dt)) : '';
                      $fAcountantChkDt = $AAO_Chk_Dt ? date('d/m/Y', strtotime($AAO_Chk_Dt)) : '';
                    //   dd($embsection2->mb_status);
                      if(auth()->user()->usertypes === "EE" && $embsection2->mb_status>13 || auth()->user()->usertypes === "AAO" && $embsection2->mb_status===11)
                      {

                          $DivisionCheck .='<tr>
                              <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                              <td style="border: 1px solid black; padding: 5px;">Auditor Check Date</td>
                              <td style="border: 1px solid black; padding: 5px;">'. $fAuditorChkDt .'</td>
                          </tr>
                          <tr>
                          <td  colspan="2" style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                          <td colspan="1" style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAudi  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                          <br>'.$Audisignid->name.' <br>'.$Audisignid->designation.' <br>'.$workdata->Div.'</td>';
                      }

                //Date Conditions--------------------------------------------------
                 if(auth()->user()->usertypes === "EE" && $embsection2->mb_status>=13 || auth()->user()->usertypes === "AAO" && $embsection2->mb_status>=12 )
                    {

                        $DivisionCheck .='<tr>
                            <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                            <td style="border: 1px solid black; padding: 5px;">Auditor Check Date</td>
                            <td style="border: 1px solid black; padding: 5px;">'. $fAuditorChkDt .'</td>
                        </tr>';


                        $DivisionCheck .='<tr>
                            <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                            <td style="border: 1px solid black; padding: 5px;">AAO Check Date</td>
                            <td style="border: 1px solid black; padding: 5px;">'. $fAcountantChkDt .'</td>
                        </tr>';
                    }
                    if(auth()->user()->usertypes === "EE" && $embsection2->mb_status>=13 ||  auth()->user()->usertypes === "AAO" && $embsection2->mb_status>=13  )
                    {


                        $DivisionCheck .='<tr>
                            <td style="text-align: right; border: 1px solid black; padding: 5px;"></td>
                            <td style="border: 1px solid black; padding: 5px;">EE Check Date</td>
                            <td style="border: 1px solid black; padding: 5px;">'. $fAuditorChkDt .'</td>
                        </tr>';
                    }
                    //Sign Condition.................................
                 // dd($embsection2->mb_status);
                    if(auth()->user()->usertypes === "EE" && $embsection2->mb_status>=12 || auth()->user()->usertypes === "AAO" && $embsection2->mb_status >= 12  )
                    {
                        //dd($embsection2->mb_status);
                        $fAuditorChkDt = $Aud_Chk_Dt ? date('d/m/Y', strtotime($Aud_Chk_Dt)) : '';

                        $DivisionCheck .='
                        <tr>
                            <td colspan="2"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAudi  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                            <br>'.$Audisignid->name.' <br>'.$Audisignid->designation.' <br>'.$workdata->Div.'</td>
                            <td colspan="1"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageAcc  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                            <br>'.$Accsignid->name.' <br>'.$Accsignid->designation.' <br>'.$workdata->Div.'</td>
                        </tr>';
                    }
                    if(auth()->user()->usertypes === "EE" && $embsection2->mb_status===13 || auth()->user()->usertypes === "AAO" && $embsection2->mb_status>=13 )
                    {
                        $fAuditorChkDt = $Aud_Chk_Dt ? date('d/m/Y', strtotime($EE_Chk_Dt)) : '';

                        $DivisionCheck .='<tr>

                        <td colspan="3"style="border: 1px solid black; padding: 5px; text-align:center;"> <img src="' . $imageEE  . '" alt="Base64 Encoded Image" style="width: 100px; height: 60px;">
                        <br>'.$eesignid->name.' <br>'.$eesignid->Designation.' <br>'.$workdata->Div.'</td>
                    </tr>
        ';
                    }
                     $DivisionCheck.= '</tbody></table></div> ';

    }



$pdf = new Dompdf();
$pdf->loadHtml($DivisionCheck);
//$pdf->setPaper('auto', 'auto'); // Set paper size and orientation
$pdf->setPaper('A4', 'portrait'); // Set paper size and orientation

// (Optional) Set options for the PDF rendering
$options = new Options();
$options->set('isHtml5ParserEnabled', true); // Enable HTML5 parsing
$pdf->setOptions($options);

$pdf->render();

return $pdf->stream('Divisionchecklist-' . $tbillid . '-pdf.pdf');
}


}