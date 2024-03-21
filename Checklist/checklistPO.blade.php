@extends("layouts.header")
@section('content')

<ul class="breadcrumb">
            <li><a href="{{ url('/home')}}">Home</a></li>
            <li><a href="{{ url('/listworkmasters')}}">Workmaster</a></li>
            <li><a href="{{ url('billlist', $workid ?? '') }}">Bill</a></li>

        </ul>



        <form  action="{{ url('SaveChklstPO') }}" method="post">
@csrf
    <input type="hidden" name="tbill_id" value="{{$t_bill_Id}}">
    <input type="hidden" name="Work_Id" value="{{$workid}}">


<div class="container">
    <h4 style="margin-top:100px;">CheckList Of Project Officer</h4>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-success">
        <tr>
        <th style="width: 0.2%;">SR.NO</th>
          <th style="width: 45%;">Name</th>
          <th style="width: 40%;">Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
                        <td>1</td>
                        <td>Name of Work</td>
                        <input type="hidden" name="work_nm" value="{{$workNM}}">
                        <td >{{$workNM}}</td>
        </tr>
        <tr>
                    <td>2</td>
                    <td>Whether Check List filled by Sub Division is proper ?</td>
                        <input type="hidden" name="" value="{{$SD_chklst}}">
                    <td>     
                        
                        <label class="btn btn-outline-primary">
                        <input type="radio" name="SD_chklst" value="Yes" checked {{ $SD_chklst === 'Yes' ? 'checked' : '' }} > Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="SD_chklst" value="No"  {{ $SD_chklst === 'No' ? 'checked' : '' }} > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="SD_chklst" value="Not Required"  {{ $SD_chklst === 'Not Required' ? 'checked' : '' }}  > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="SD_chklst" value="Not Applicable" {{ $SD_chklst === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
                        </label>
                    </td>
        </tr>
        <tr>
                <td>3</td>
                <td>Whether all Q.C. Tests required for the work have been coducted ?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_T_Done" value="Yes"  checked {{ $QC_T_Done === 'Yes' ? 'checked' : '' }}> Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_T_Done" value="No" {{ $QC_T_Done === 'No' ? 'checked' : '' }} > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_T_Done" value="Not Required" {{ $QC_T_Done === 'Not Required' ? 'checked' : '' }} > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_T_Done" value="Not Applicable"  {{ $QC_T_Done === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
                        </label>
                </td>
        </tr>
        <tr>
                <td>4</td>
                <td>Whether the number of tests are correct as per standards ?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_T_No" value="Yes"   {{ $QC_T_No === 'Yes' ? 'checked' : '' }}> Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_T_No" value="No" {{ $QC_T_No === 'No' ? 'checked' : '' }}  > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_T_No" value="Not Required" {{ $QC_T_No === 'Not Required' ? 'checked' : '' }}  > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_T_No" value="Not Applicable" {{ $QC_T_No === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
                        </label>
                </td>
        </tr>
        <tr>
                <td>5</td>
                <td>Whether Q.C. Test results are satisfactory ?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_Result" value="Yes"   {{ $QC_Result === 'Yes' ? 'checked' : '' }}> Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_Result" value="No" {{ $QC_Result === 'No' ? 'checked' : '' }}  > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_Result" value="Not Required" {{ $QC_Result === 'Not Required' ? 'checked' : '' }}  > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="QC_Result" value="Not Applicable" {{ $QC_Result === 'Not Applicable' ? 'checked' : '' }}  > Not Applicable
                        </label>
                </td>
        </tr>

        <tr>
                <td>6</td>
                <td>SQM Checking / Third Party Audit carried out For this Work?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="SQM_Chk" value="Yes" {{ $SQM_Chk === 'Yes' ? 'checked' : '' }} > Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="SQM_Chk" value="No"{{ $SQM_Chk === 'No' ? 'checked' : '' }}  > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="SQM_Chk" value="Not Required" {{ $SQM_Chk === 'Not Required' ? 'checked' : '' }}  > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="SQM_Chk" value="Not Applicable"   {{ $SQM_Chk === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
                        </label>
                </td>
        </tr>




        <tr>
                <td>7</td>
                <td>Whether Part Rate / Reduced Rate are correct & technically proper ?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Part_Red_Rt_Proper" value="Yes" {{ $Part_Red_Rt_Proper === 'Yes' ? 'checked' : '' }} > Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Part_Red_Rt_Proper" value="No"{{ $Part_Red_Rt_Proper === 'No' ? 'checked' : '' }}  > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Part_Red_Rt_Proper" value="Not Required" {{ $Part_Red_Rt_Proper === 'Not Required' ? 'checked' : '' }}  > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Part_Red_Rt_Proper" value="Not Applicable"   {{ $Part_Red_Rt_Proper === 'Not Applicable' ? 'checked' : '' }}> Not Applicable
                        </label>
                </td>
        </tr>
        <tr>
                <td>8</td>
                <td>Whether quantity of any item of work has been exceeded 125% of tender quantity ?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Excess_qty_125" value="Yes"{{ $Excess_qty_125 === 'Yes' ? 'checked' : '' }}   > Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Excess_qty_125" value="No"   {{ $Excess_qty_125 === 'No' ? 'checked' : '' }}> No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Excess_qty_125" value="Not Required" {{ $Excess_qty_125 === 'Not Required' ? 'checked' : '' }} > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Excess_qty_125" value="Not Applicable" {{ $Excess_qty_125 === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
                        </label>
                </td>
        </tr>

        <tr>
                <td>9</td>
                <td>If yes, proposal for effecting Clause-38 has been submitted by Sub Division with proper reasons.</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="CL_38_Prop" value="Yes" {{ $CL_38_Prop === 'Yes' ? 'checked' : '' }}   > Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="CL_38_Prop" value="No" {{ $CL_38_Prop === 'No' ? 'checked' : '' }} > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="CL_38_Prop" value="Not Required" {{ $CL_38_Prop === 'Not Required' ? 'checked' : '' }} > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="CL_38_Prop" value="Not Applicable"  {{ $CL_38_Prop === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
                        </label>
                </td>
        </tr>

        <tr>
                <td>10</td>
                <td>Whether Board showing Name of Work, Name of Agency, DLP, etc. is fixed on site of work ?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Board" value="Yes"  {{ $CFinalbillBoard === 'Yes' ? 'checked' : '' }}  > Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Board" value="No" {{ $CFinalbillBoard === 'No' ? 'checked' : '' }}   > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Board" value="Not Required" {{ $CFinalbillBoard === 'Not Required' ? 'checked' : '' }}   > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Board" value="Not Applicable" {{ $CFinalbillBoard === 'Not Applicable' ? 'checked' : '' }}   > Not Applicable
                        </label>
                </td>
        </tr>

        <tr>
        <input type="hidden" name="Rec_Drg" value="{{ $Rec_Drg}}"  > 

                <!-- <td>10</td>
                <td>Whether record drawing is attached ?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Rec_Drg" value="Yes"   {{ $Rec_Drg === 'Yes' ? 'checked' : '' }} > Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Rec_Drg" value="No" {{ $Rec_Drg === 'No' ? 'checked' : '' }} > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Rec_Drg" value="Not Required"  {{ $Rec_Drg === 'Not Required' ? 'checked' : '' }} > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Rec_Drg" value="Not Applicable" {{ $Rec_Drg === 'Not Applicable' ? 'checked' : '' }}   > Not Applicable
                        </label>
                </td> -->
        </tr>
        <tr>
                <td>11A</td>
                <td>Uptodate Royalty Charges payable</td>
                <td>

                <input type="text" class="form-control" id="Tot_Roy" name="Tot_Roy" value="{{$TotRoy}}" oninput="updateField11D()">
                </td>
        </tr>

        <tr>
                <td>11B</td>
                <td>Royalty Charges previously paid / recovered </td>
                <td>
                <input type="text" class="form-control" id="Pre_Bill_Roy" name="Pre_Bill_Roy" value="{{$PreTotRoy}}"  oninput="updateField11D()"> 
                </td>
        </tr>

        <tr>
                <td>11C</td>
                <td>Royalty Charges paid by contractor for this bil</td>
                <td>
                <input type="text" class="form-control" id="Cur_Bill_Roy_Paid" value="{{$Cur_Bill_Roy_Paid}}" name="Cur_Bill_Roy_Paid" oninput="updateField11D()"> 
                </td>
        </tr>

        <tr>
                <td>11D</td>
                <td>Royalty Charges proposed to be recovered from this bill</td>
                <td>
                <input type="text" class="form-control" id="Roy_Rec" name="Roy_Rec"  value="{{$Roy_Rec}}" > 
                </td>
        </tr>

        <tr>
                <td>12A</td>
                <td>Tender cost of work</td>
                <input type="hidden" name="Tnd_Amt" value="{{$Tnd_Amt}}"  > 
                <td> {{$Tnd_Amt}}
                </td>
        </tr>

        <tr>
                <td>12B</td>
                <td>Uptodate Bill Amount of work</td>
                <input type="hidden" name="Net_Amt" value="{{$netAmt}}"  > 

                <td>{{$netAmt}}
                </td>
        </tr>

        <tr>
                <td>12C</td>
                <td>Current Bill Amount</td>
                <input type="hidden" name="C_NetAmt" value="{{$c_netamt}}"  > 

                <td>{{$c_netamt}}
                </td>
        </tr>

        <tr>
                <td>13</td>
                <td>Actual Date of Completion </td>
                <input type="hidden" name="Act_Comp_Dt" value="{{$Act_Comp_Dt}}" > 
                <td>{{ date('d/m/Y', strtotime($Act_Comp_Dt)) }}</td>
                            </td>
        </tr>

        <tr>
                <td>14</td>
                <td>M.B. No & Date of Recording </td>
                <input type="hidden" name="MB_NO" value="{{$MB_NO}}"  >
                <input type="hidden" name="MB_DT" value="{{$DBMB_Dt}}"  > 
                <td> {{$MB_NO}}   &nbsp; &nbsp;  Date:  {{ $DBMB_Dt ? date('d/m/Y', strtotime($DBMB_Dt)) : '' }}
                </td>
        </tr>

        <tr>
        <input type="hidden" name="Mess_ModeMat_Cons" value="{{$Mess_Mode}}"   > 

                <!-- <td>15</td>
                <td>Whether Mode of Measurement are correct ?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Mess_ModeMat_Cons" value="Yes"   {{ $Mess_Mode === 'Yes' ? 'checked' : '' }}> Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Mess_ModeMat_Cons" value="No" {{ $Mess_Mode === 'No' ? 'checked' : '' }} > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Mess_ModeMat_Cons" value="Not Required" {{ $Mess_Mode === 'Not Required' ? 'checked' : '' }} > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Mess_ModeMat_Cons" value="Not Applicable" {{ $Mess_Mode === 'Not Applicable' ? 'checked' : '' }}  > Not Applicable
                        </label>
                </td> -->
        </tr>

        <tr>
        <input type="hidden" name="Mat_Cons" value="{{ $Mat_cons}}"> 

                <!-- <td>16</td>
                <td>Whether consumptions of material are correct ?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Mat_Cons" value="Yes" {{ $Mat_cons === 'Yes' ? 'checked' : '' }} > Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Mat_Cons" value="No"  {{ $Mat_cons === 'No' ? 'checked' : '' }} > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Mat_Cons" value="Not Required" {{ $Mat_cons === 'Not Required' ? 'checked' : '' }} > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Mat_Cons" value="Not Applicable" {{ $Mat_cons === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
                        </label>
                </td> -->
        </tr>

        <tr>
                <td>15</td>
                <td>Work Completion Certificate (Form-65) attached ?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Form_65" value="Yes" {{ $CFinalbillForm65 === 'Yes' ? 'checked' : '' }}  > Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Form_65" value="No" {{ $CFinalbillForm65 === 'No' ? 'checked' : '' }}  > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Form_65" value="Not Required" {{ $CFinalbillForm65 === 'Not Required' ? 'checked' : '' }} > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Form_65" value="Not Applicable"  {{ $CFinalbillForm65 === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
                        </label>
                </td>
        </tr>

        <tr>
                <td>16</td>
                <td>Letter / Certificate regarding handover of work attached ?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Handover" value="Yes" {{ $CFinalbillhandover === 'Yes' ? 'checked' : '' }} > Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Handover" value="No" {{ $CFinalbillhandover === 'No' ? 'checked' : '' }} > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Handover" value="Not Required" {{ $CFinalbillhandover === 'Not Required' ? 'checked' : '' }} > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Handover" value="Not Applicable" {{ $CFinalbillhandover === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
                        </label>
                </td>
        </tr>

        <tr>
                <td>17</td>
                <td>Reduced Estimate Prepaired And Submitted For this Work?</td>
                <td>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Red_Est" value="Yes" {{ $Red_Est === 'Yes' ? 'checked' : '' }} > Yes
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Red_Est" value="No" {{ $Red_Est === 'No' ? 'checked' : '' }} > No
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Red_Est" value="Not Required" {{ $Red_Est === 'Not Required' ? 'checked' : '' }} > Not Required
                        </label>
                        <label class="btn btn-outline-primary">
                            <input type="radio" name="Red_Est" value="Not Applicable" {{ $Red_Est === 'Not Applicable' ? 'checked' : '' }} > Not Applicable
                        </label>
                </td>
        </tr>


        
        
 <!-- <tr>
    <td colspan="2">
        <label style="font-weight: bold;">Project officer Checked</label>
        @if($PO_Chk === 1)
            <input  class="checkbox col-md-1" type="checkbox" name="POcheckbox" required checked value="{{$PO_Chk}}">
            @else
            <input  class="checkbox col-md-1" type="checkbox" name="POcheckbox" required value="{{$PO_Chk}}" >
            @endif
    </td>
    <td>
    <div class="row">
        <div class="col-md-7">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input  class="form-control" style="margin-left: -100px;" type="date" name="POdate" 
        required value="{{$PO_Chk_Dt}}" min="{{$lstDYEcheckdate}}" max="{{$stupulatedDate}}">
        </div>
    </div>
</td>
</tr> -->



@if(auth()->user()->usertypes === "PA") 
        <tr>
    <td colspan="2">
        <label style="font-weight: bold;">Deputy Engineer Checked</label>
        @if($SODYEchk===1)
                <input id="DYEcheckbox" class="checkbox col-md-1" type="checkbox" name="SODYEcheckbox" required checked>
                @else
                <input id="DYEcheckbox" class="checkbox col-md-1" type="checkbox" name="SODYEcheckbox" required>
                @endif
    </td>
    <td colspan="3">
    <div class="row">
        <div class="col-md-7">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -100px;"  id="DYEdate" class="form-control" type="date" name="SODYEdate"
                 value="{{$SODYEchk_Dt}}" required min="{{$Je_chk_Dt}}" max="{{$stupulatedDate}}">
        </div>
    </div>
    </td>
</tr>

        @endif



        </tbody>
    </table>
  </div>
</div>




<div class="row justify-content-center">
    <div class="col-md-3 col-xl-2">
    @if($DBchklst_POExist !== null)
    <button type="submit" name="action" value="update" class="btn btn-primary mt-5" style="" >Update</button>
    @else
    <button type="submit" name="action" value="save" class="btn btn-primary mt-5" style="" >Submit</button>
@endif
    </div>
</div>



</form>

<br><br><br>
        @endsection()


        <script>
            document.addEventListener("DOMContentLoaded", function() 
            {
        // Call updateField11D function on page load
        updateField11D();
            });
    function updateField11D() {
        var Tot_Roy = parseFloat(document.getElementById('Tot_Roy').value) || 0.00;
        var Pre_Bill_Roy = parseFloat(document.getElementById('Pre_Bill_Roy').value) || 0.00;
        var Cur_Bill_Roy_Paid = parseFloat(document.getElementById('Cur_Bill_Roy_Paid').value) || 0.00;
        var Roy_Rec = Tot_Roy - Pre_Bill_Roy - Cur_Bill_Roy_Paid;
        console.log(Roy_Rec.toFixed(2));
        // Ensure Roy_Rec is never less than 0
        Roy_Rec = Math.max(Roy_Rec, 0);

        document.getElementById('Roy_Rec').value = Roy_Rec.toFixed(2);
    }
</script>