@extends("layouts.header")
@section('content')
<ul class="breadcrumb">
            <li><a href="{{ url('/home')}}">Home</a></li>
            <li><a href="{{ url('/listworkmasters')}}">Workmaster</a></li>
            <li><a href="{{ url('billlist', $workid ?? '') }}">Bill</a></li>
            <li><a href="javascript:void(0)">Check List SO</a></li>
            <!-- <li><a href="">Check List SO</a></li> -->

        </ul>


<style>
    /* Define custom color for checked radio button */
    .form-check-input:checked {
        color: red; /* Change this to the desired color */
    }
</style>


<form  action="{{ url('SaveChklstJe') }}" method="post">
@csrf
    <input type="hidden" name="tbill_id" value="{{$CTbillid}}">
    <input type="hidden" name="T_billno" value="{{$CTbillno}}">               
   <input type="hidden" name="JEId" value="{{ $DBjeId }}">
   <input type="hidden" name="CFinalbill" value="{{ $CFinalbill }}">


   <input type="hidden" name="mesurmentDT" value="{{ $DBMESUrementDate }}">



<div class="container">
    <h4>CheckList Of Sectional Engineer </h4>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-success">
        <tr>
            <th>SR.NO</th>
          <th>Name</th>
<th style="width: 45%;">Description</th>
</tr>
      </thead>
      <tbody>
        <tr>
            <td>1</td>
          <td>Name of Work</td>
          <input type="hidden" name="work_nm" value="{{ $workNM }}">
          <td >{{$workNM}}</td>
        </tr>
        <tr>
            <td>2</td>
          <td>Agency / Contractor</td>
          <input type="hidden" name="AgencyId" value="{{ $DBAgencyId }}">
          <input type="hidden" name="AgencyNM" value="{{ $DBAgencyName }}">
          <input type="hidden" name="Agency_PL" value="{{ $DBagency_pl }}">
          <td>{{$DBAgencyName}}   {{$DBagency_pl}}</td>
        </tr>
        <tr>
        <td>3</td>
        <td>Name of Officer recording measurements </td>
        <input type="hidden" name="JeName" value="{{$DBJeName}}">
        <td name="JeName">{{$DBJeName}}</td>
            </tr>
        <tr>
        <td>4</td>

          <td>Bill No</td>
          <input type="hidden" name="concateresultbillno" value="{{$concateresult}}">
          <td >{{$concateresult}}</td>
        </tr>
        <tr>
        <td>5</td>

          <td>Agreement No & Date</td>
          <input type="hidden" name="AgreeNO" value="{{$DBAgreeNO}}">       
        <input type="hidden" name="AgreeDT" value="{{$DBAgreeDT}}">       
          <!--<td > {{$DBAgreeNO}}  {{ $DBAgreeDT ? date('d/m/Y', strtotime($DBAgreeDT)) : '' }}</td>-->
         <td > {{$DBAgreeNO}} &nbsp;&nbsp; {{$DBAgreeDT ? ' Date: ' . date('d/m/Y', strtotime($DBAgreeDT)) : ''}}</td>

        </tr>
        <tr>
        <td>6</td>

        <td>Quoted Above / Below percent</td>
        <input type="hidden" name="A_B_Pc" value="{{$A_B_Pc}}">       
       <input type="hidden" name="Above_Below" value="{{$Above_Below}}">       
        <td name="Above_Below">{{$A_B_Pc}}%  {{$Above_Below}}</td>
            </tr>
            <tr>
            <td>7</td>

          <td>Stipulated Date of Completion</td>
          <input type="hidden" name="Stip_Comp_Dt" value="{{$Stip_Comp_Dt}}">       
          <td>{{ $Stip_Comp_Dt ? date('d/m/Y', strtotime($Stip_Comp_Dt)) : '' }}</td>
        </tr>
        <tr>
        <td>8</td>

          <td> Actual Date of Completion</td>
          <input type="hidden" name="Act_Comp_Dt" value="{{$Act_Comp_Dt}}">       

          <td>{{ $Act_Comp_Dt ? date('d/m/Y', strtotime($Act_Comp_Dt)) : '' }}</td>
        </tr>
        <tr>
        <td>9</td>

          <td>M.B. No & Date of Recording</td>
          <input type="hidden" name="MBNO" value="{{$workid}}">       
         <input type="hidden" name="MBDT" value="{{$DBMESUrementDate}}">   

          <td name="MBNO">{{$workid}} &nbsp; &nbsp; Date:{{ $DBMESUrementDate ? date('d/m/Y', strtotime($DBMESUrementDate)) : ''}}</td>
        </tr>



<tr>
<td>10</td>

        <td>Whether Contractor has signed in token of acceptance of measurements ?</td>
        <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Contractorsigned" value="Yes" {{ $Agency_MB_Accept === 'Yes' ? 'checked' : '' }}> Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Contractorsigned" value="No" {{ $Agency_MB_Accept === 'No' ? 'checked' : '' }}> No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Contractorsigned" value="Not Required" {{ $Agency_MB_Accept === 'Not Required' ? 'checked' : '' }} > Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Contractorsigned" value="Not Applicable" {{ $Agency_MB_Accept === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
    </label>
</td>
        </tr>
        <tr>
        <td>11</td>

          <td>Part Rate / Reduced Rate Analysis</td>
                <td>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Analysis" value="Yes" {{ $partrtAnalysis === 'Yes' ? 'checked' : '' }}> Yes
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Analysis" value="No" {{ $partrtAnalysis === 'No' ? 'checked' : '' }} > No
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Analysis" value="Not Required" {{ $partrtAnalysis === 'Not Required' ? 'checked' : '' }}  > Not Required
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Analysis" value="Not Applicable" {{ $partrtAnalysis === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
            </label>
        </td>  


</tr>
        <tr>
        <td>12</td>

        <td>If Reduced Rate, permission of compitent authority is obtained ?</td>
        <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_authority" value="Yes" {{ $Part_Red_per === 'Yes' ? 'checked' : '' }}> Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_authority" value="No" {{ $Part_Red_per === 'No' ? 'checked' : '' }}> No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_authority" value="Not Required" {{ $Part_Red_per === 'Not Required' ? 'checked' : '' }}> Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_authority" value="Not Applicable" {{ $Part_Red_per === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
    </label>
</td>

            </tr>

            <!-- <tr>
            <td>13</td>

          <td>Any excess quantity is occurred over the tender quantity ?</td>
          <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="ExcessQty" value="Yes" {{ $Excess_Qty === 'Yes' ? 'checked' : '' }}> Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="ExcessQty" value="No" {{ $Excess_Qty === 'No' ? 'checked' : '' }}> No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="ExcessQty" value="Not Required" {{ $Excess_Qty === 'Not Required' ? 'checked' : '' }}> Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="ExcessQty" value="Not Applicable" {{ $Excess_Qty === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
    </label>
</td>

        </tr> -->
        <!-- <tr>
        <td>14</td>

          <td> If Yes, whether details of excess quantity with reason for excess is mentioned in Excess - Saving Statement ?</td>
          <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_ExcessSaving" value="Yes" {{ $Ex_qty_det === 'Yes' ? 'checked' : '' }}> Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_ExcessSaving" value="No" {{ $Ex_qty_det === 'No' ? 'checked' : '' }}> No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_ExcessSaving" value="Not Required" {{ $Ex_qty_det === 'Not Required' ? 'checked' : '' }}> Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_ExcessSaving" value="Not Applicable" {{ $Ex_qty_det === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
    </label>
</td>

        </tr> -->
        <tr>
        <td>13</td>

          <td>Whether Results of Q.C. Tests are satisfactory ?</td>
          <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Q_C_Results" value="Yes" {{ $Qc_Result === 'Yes' ? 'checked' : '' }}> Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Q_C_Results" value="No" {{ $Qc_Result === 'No' ? 'checked' : '' }}> No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Q_C_Results" value="Not Required" {{ $Qc_Result === 'Not Required' ? 'checked' : '' }}> Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Q_C_Results" value="Not Applicable" {{ $Qc_Result === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
    </label>
</td>

        </tr>



        <tr>
        <td>14</td>
        <td>Is Material Consumption Statement attached ?</td>
        <td>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Material" value="Yes" {{ $materialconsu === 'Yes' ? 'checked' : '' }}> Yes
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Material" value="No" {{ $materialconsu === 'No' ? 'checked' : '' }}> No
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Material" value="Not Required" {{ $materialconsu === 'Not Required' ? 'checked' : '' }}> Not Required
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Material" value="Not Applicable" {{ $materialconsu === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
            </label>
        </td>  

        </tr>
        <tr>
        <td>15</td>

          <td>Is Recovery Statement attached ?</td>
          <td>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Recovery" value="Yes" {{ $Recoverystatement === 'Yes' ? 'checked' : '' }}> Yes
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Recovery" value="No" {{ $Recoverystatement === 'No' ? 'checked' : '' }}> No
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Recovery" value="Not Required" {{ $Recoverystatement === 'Not Required' ? 'checked' : '' }}> Not Required
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Recovery" value="Not Applicable" {{ $Recoverystatement === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
            </label>
        </td>  

        </tr>
        <tr>
        <td>16</td>

        <td>Is Excess Saving Statement attached ?</td>
        <td>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Excess" value="Yes" {{ $Excesstatement === 'Yes' ? 'checked' : '' }}> Yes
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Excess" value="No" {{ $Excesstatement === 'No' ? 'checked' : '' }}> No
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Excess" value="Not Required" {{ $Excesstatement === 'Not Required' ? 'checked' : '' }}> Not Required
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Excess" value="Not Applicable" {{ $Excesstatement === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
            </label>
        </td>  

            </tr>
            <tr>
            <td>17</td>
          <td>Is Royalty Statement attached ?</td>
          <td>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Royalty" value="Yes" {{ $Royaltystatement === 'Yes' ? 'checked' : '' }}> Yes
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Royalty" value="No" {{ $Royaltystatement === 'No' ? 'checked' : '' }}> No
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Royalty" value="Not Required" {{ $Royaltystatement === 'Not Required' ? 'checked' : '' }}> Not Required
            </label>
            <label class="btn btn-outline-primary">
                <input type="radio" name="radio_Royalty" value="Not Applicable" {{ $Royaltystatement === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
            </label>
        </td>  

        </tr>
        <tr>
        <td>18</td>

          <td> Necessary Photographs of work / site attached ?</td>
          <td>
          <label class="btn btn-outline-primary">
    <input type="radio" name="radio_photo" value="Yes" {{ $Jephoto === 'Yes' ? 'checked' : '' }}> Yes
</label>
<label class="btn btn-outline-primary">
    <input type="radio" name="radio_photo" value="No"  {{ $Jephoto === 'No' ? 'checked' : '' }}> No
</label>
<label class="btn btn-outline-primary">
    <input type="radio" name="radio_photo" value="Not Required" {{ $Jephoto === 'Not Required'  ? 'checked' : '' }}> Not Required
</label>
<label class="btn btn-outline-primary">
    <input type="radio" name="radio_photo" value="Not Applicable" {{ $Jephoto === 'Not Applicable'  ? 'checked' : '' }}> Not Applicable
</label><br>
<!-- <lable>Total Photo : {{$countphoto}} Total Documents : {{$countdoc}} Video : {{$countvideo}}</lable> -->
@if($countphoto > 0)
    <label>Total Photo : {{$countphoto}}</label>
@endif
@if($countdoc > 0)
    <label>Total Documents : {{$countdoc}}</label>
@endif
@if($countvideo > 0)
    <label>Video : {{$countvideo}}</label>
@endif

        </td>  
        

        </tr>


        <tr>
        <td>19</td>

        <td>Challen of Royalty paid by Contractor attached ?</td>
        <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_RoyaltyChallen" value="Yes" {{ $Roy_Challen === 'Yes' ? 'checked' : '' }}> Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_RoyaltyChallen" value="No" {{ $Roy_Challen === 'No' ? 'checked' : '' }}> No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_RoyaltyChallen" value="Not Required" {{ $Roy_Challen === 'Not Required' ? 'checked' : '' }}> Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_RoyaltyChallen" value="Not Applicable" {{ $Roy_Challen === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
    </label>
</td>


        </tr>
        <!-- <tr>
        <td>22</td>
          <td>Bitumen Challen / Invoice attached ?</td>
          <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Bitumen" value="Yes" {{ $Bitu_Challen === 'Yes' ? 'checked' : '' }}> Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Bitumen" value="No" {{ $Bitu_Challen === 'No' ? 'checked' : '' }}> No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Bitumen" value="Not Required" {{ $Bitu_Challen === 'Not Required' ? 'checked' : '' }}> Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Bitumen" value="Not Applicable" {{ $Bitu_Challen === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
    </label>
</td>

        </tr> -->

        <tr>
        <td>20</td>
          <td>Q.C. Test Reports attached ?</td>
          <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Q_C" value="Yes" {{ $Qc_Reports === 'Yes' ? 'checked' : '' }}> Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Q_C" value="No" {{ $Qc_Reports === 'No' ? 'checked' : '' }} > No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Q_C" value="Not Required"  {{ $Qc_Reports === 'Not Required' ? 'checked' : '' }}> Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Q_C" value="Not Applicable" {{ $Qc_Reports === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
    </label>
</td>

        </tr>

        <tr>
        <td>21</td>
          <td>Whether Board showing Name of Work, Name of Agency, DLP, etc. is fixed on site of work ?</td>
          <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Board" value="Yes" {{ $Board === 'Yes' ? 'checked' : '' }}> Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Board" value="No" {{ $Board === 'No' ? 'checked' : '' }}> No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Board" value="Not Required" {{ $Board === 'Not Required' ? 'checked' : '' }}> Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Board" value="Not Applicable" {{ $Board === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
    </label>
</td>

        </tr>


        <tr>
        <td>22</td>
          <td>Work Completion Certificate (Form-65) attached ?</td>
          <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Form_65" value="Yes" {{ $CFinalbillForm65 === 'Yes' ? 'checked' : '' }}> Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Form_65" value="No"  {{ $CFinalbillForm65 === 'No' ? 'checked' : '' }}> No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Form_65" value="Not Required" {{ $CFinalbillForm65 === 'Not Required' ? 'checked' : '' }}> Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_Form_65" value="Not Applicable" {{ $CFinalbillForm65 === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
    </label>
</td>
        </tr>


        <!-- <tr>
        <td>26</td>
          <td>Letter / Certificate regarding handover of work attached ?</td>
          <td>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_handover" value="Yes" {{ $CFinalbillhandover === 'Yes' ? 'checked' : '' }}> Yes
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_handover" value="No" {{ $CFinalbillhandover === 'No' ? 'checked' : '' }}> No
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_handover" value="Not Required" {{ $CFinalbillhandover === 'Not Required' ? 'checked' : '' }}> Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="radio_handover" value="Not Applicable" {{ $CFinalbillhandover === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
    </label>
</td>
        </tr>
 -->

        <!-- <tr>
        <td>27</td>
          <td>Whether record drawing is attached ?</td>
          <td>
          <label class="btn btn-outline-primary">
        <input type="radio" name="radio_drawing" id="radioYes" value="Yes" {{ $Rec_Drg === 'Yes' ? 'checked' : '' }}>Yes
</label>
    <label class="btn btn-outline-primary">
        <input  type="radio" name="radio_drawing" id="radioNo" value="No" {{ $Rec_Drg === 'No' ? 'checked' : '' }}>No
        </label>
    <label class="btn btn-outline-primary">
        <input  type="radio" name="radio_drawing" id="radioNotRequired" value="Not Required" {{ $Rec_Drg === 'Not Required' ? 'checked' : '' }}>Not Required

        </label>
    <label class="btn btn-outline-primary">
        <input  type="radio" name="radio_drawing" id="radioNotApplicable" value="Not Applicable" {{ $Rec_Drg === 'Not Applicable' ? 'checked' : '' }}>Not Applicable
        </label>
</td>

   <tr> -->
    <!-- <td colspan="2">
        <label style="font-weight: bold;">Sectional office/Engineer Checked</label>
        @if($Je_Chk === 1)
            <input class="checkbox col-md-2 form-control-md" style="margin-left: 20px;" type="checkbox" name="JEcheckbox"  checked>
        @else
            <input class="checkbox col-md-2 form-control-md" style="margin-left: 20px;" type="checkbox" name="JEcheckbox" >
        @endif
    </td>
    <td>
    <div class="row">
        <div class="col-md-5">
            <label style="font-weight: bold;">Date of Checking</label>
            </div>
            <div class="col-md-5">
            <input style="" class="form-control" type="date" name="JEdate" value="{{$Je_chk_Dt}}" min="{{$Agencychedate}}" max="{{$stupulatedDate}}" >
        </div>
    </div>
</td>
</tr> -->
        @if(auth()->user()->usertypes === "DYE")
        <tr>
    <td>
        <label style="font-weight: bold;">Deputy Engineer Checked</label>
        @if($Je_Chk === 1)
            <input style="margin-left: 20px;" class="form-check-input" type="checkbox" name="DYEcheckbox" required checked>
        @else
            <input style="margin-left: 20px;" class="form-check-input" type="checkbox" name="DYEcheckbox" required>
        @endif
    </td>
    <td colspan="3">
        <label style="font-weight: bold;">Date of Checking</label>
        <input style="margin-left: 20px;" class="form-control" type="date" name="DYEdate">
    </td>
</tr>

        @endif

   


      </tbody>
    </table>
  </div>
</div>







<!-- <div class="row" style="margin-left: 80px;">
    <div class="col-md-2 col-xl-2 col-lg-2">
<label style="font-weight: bold;">JE Check </label>
        @if($Je_Chk === 1)
<input  class="checkbox col-md-1" style="margin-left: 20px;" type="checkbox" name="JEcheckbox" required checked>
        @else
<input  class="checkbox col-md-1" style="margin-left: 20px;" type="checkbox" name="JEcheckbox" required >
        @endif
        </div>
        <div class="col-md-3 col-xl-2 col-lg-6">
<input style="margin-left: -100px;" class="form-control" type="hidden" name="JEdate" value="{{$Agencychedate}}">
<input style="margin-left: -100px;" class="form-control" type="hidden" name="stupulatedDate" value="{{$stupulatedDate}}">

<input style="" class="form-control" type="date" name="JEdate"
 value="{{$Je_chk_Dt}}" min="{{$Agencychedate}}" max="{{$stupulatedDate}}">
</div>
</div>




@if(auth()->user()->usertypes === "DYE") 
<div class="col-md-4 col-lg-8  col-xl-2" style="margin-left: 80px;">
<label style="margin-left: 380px;  font-weight: bold;">DYE Check </label>
        @if($Je_Chk === 1)
<input style="margin-left: 80px; padding-left: 20px;" class="form-check-input" type="checkbox" name="DYEcheckbox" required checked>
        @else
<input style="margin-left: 80px; padding-left: 20px;" class="form-check-input" type="checkbox" name="DYEcheckbox" required >
        @endif
<input style="margin-left: 100px;" type="date" name="DYEdate" >
</div>
@endif -->


<div class="row justify-content-center">
    <div class="col-md-3 col-xl-2">
        @if ($DBchklst_jeExist !== null)
            <button type="submit" name="action" value="update" class="btn btn-primary mt-5">Update</button>
        @else
            <button type="submit" name="action" value="save" class="btn btn-primary mt-5">Submit</button>
        @endif
    </div>
</div>

</form>






<br><br><br>

@endsection()





