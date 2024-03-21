@extends("layouts.header")
@section('content')

<ul class="breadcrumb">
            <li><a href="{{ url('/home')}}">Home</a></li>
            <li><a href="{{ url('/listworkmasters')}}">Workmaster</a></li>
            <li><a href="{{ url('billlist', $workID ?? '') }}">Bill</a></li>
        </ul>

        

        <style>
    /* Define custom color for checked radio button */
    .form-check-input:checked {
        color: blue; /* Change this to the desired color */
    }
    
</style>
<!-- <form  action="{{ url('SaveChklstJe') }}" method="post"> -->
@csrf
    <input type="hidden" name="tbill_id" value="{{$CTbillid}}">
   <input type="hidden" name="JEId" value="{{ $DBjeId }}">
   <input type="hidden" name="CFinalbill" value="{{ $CFinalbill }}">


   <input type="hidden" name="mesurmentDT" value="{{ $DBMESUrementDate }}">



<div class="container">
    <h4>CheckList Of Sectional Engineer</h4>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-success">
        <tr>
            <th>SR.NO</th>
          <th>Name</th>
          <th>Description</th>
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
          <td > {{$DBAgreeNO}}  {{ $DBAgreeDT ? date('d/m/Y', strtotime($DBAgreeDT)) : '' }}</td>
        </tr>
        <tr>
        <td>6</td>

        <td>Quoted Above / Below percent</td>
        <input type="hidden" name="A_B_Pc" value="{{$A_B_Pc}}">       
       <input type="hidden" name="Above_Below" value="{{$Above_Below}}">       
        <td name="Above_Below">{{$A_B_Pc}}%   {{$Above_Below}}</td>
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
          <input type="hidden" name="MBNO" value="{{$CTbillid}}">       
         <input type="hidden" name="MBDT" value="{{$DBMESUrementDate}}">   

          <td name="MBNO">{{$workID}}     Date:   {{ $DBMESUrementDate ? date('d/m/Y', strtotime($DBMESUrementDate)) : ''}}</td>
        </tr>



<tr>
<td>10</td>

        <td>Whether Contractor has signed in token of acceptance of measurements ?</td>
        <td> {{ $Agency_MB_Accept}}
</td>
        </tr>
        <tr>
        <td>11</td>

          <td>Part Rate / Reduced Rate Analysis</td>
                <td> {{ $partrtAnalysis}}
        </td>  


</tr>
        <tr>
        <td>12</td>

        <td>If Reduced Rate, permissin of compitent authority is obtained ?</td>
        <td> {{ $Part_Red_per}}
</td>

            </tr>

            <!-- <tr>
            <td>13</td>
          <td>Any excess quantity is occurred over the tender quantity ?</td>
          <td> {{ $Excess_Qty}}
        </td>
        </tr> -->

        <!-- <tr>
        <td>14</td>

          <td> If Yes, whether details of excess quantity with reason for excess is mentioned in Excess - Saving Statement ?</td>
          <td> {{ $Ex_qty_det}}
</td>
        </tr> -->


        <tr>
        <td>13</td>

          <td>Whether Results of Q.C. Tests are satisfactory ?</td>
          <td> {{ $Qc_Result}}
        </td>
        </tr>



        <tr>
        <td>14</td>
        <td>Is Material Consumption Statement attached ?</td>
        <td>{{ $materialconsu}}
        </td>  

        </tr>
        <tr>
        <td>15</td>

          <td>Is Recovery Statement attached ?</td>
          <td>{{ $Recoverystatement}}
        </td>  

        </tr>
        <tr>
        <td>16</td>

        <td>Is Excess Saving Statement attached ?</td>
        <td> {{ $Excesstatement}}
        </td>  

            </tr>
            <tr>
            <td>17</td>
          <td>Is Royalty Statement attached ?</td>
          <td> {{ $Royaltystatement}}
        </td>  

        </tr>
        <tr>
        <td>18</td>

          <td> Necessary Photographs of work / site attached ?</td>
          <td> {{ $photo}}
<br>
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
        <td>{{ $Roy_Challen}}
</td>


        </tr>

        <!-- <tr>
        <td>22</td>
          <td>Bitumen Challen / Invoice attached ?</td>
          <td>{{ $Bitu_Challen}}
        </td>
        </tr> -->

        <tr>
        <td>20</td>
          <td>Q.C. Test Reports attached ?</td>
          <td>{{ $Qc_Reports}}
</td>

        </tr>

        <tr>
        <td>21</td>
          <td>Whether Board showing Name of Work, Name of Agency, DLP, etc. is fixed on site of work ?</td>
          <td> {{ $Board}}
</td>

        </tr>


        <tr>
        <td>22</td>
          <td>Work Completion Certificate (Form-65) attached ?</td>
          <td>{{ $CFinalbill}}
</td>
        </tr>


        <!-- <tr>
        <td>26</td>
          <td>Letter / Certificate regarding handover of work attached ?</td>
          <td>{{ $Handover}}
</td>
        </tr> -->


        <!-- <tr>
        <td>27</td>
          <td>Whether record drawing is attached ?</td>
          <td>{{ $Rec_Drg}}
</td>

        </tr> -->
        
        
        <!-- <tr>
    <td colspan="2">
        <label style="font-weight: bold;">Sectional office/Engineer Checked</label>
        @if($Je_Chk === 1)
        <input class="checkbox col-md-2" disabled type="checkbox" name="JEcheckbox" required checked>
        @else
        <input class="checkbox col-md-2" disabled type="checkbox" name="JEcheckbox" required>
        @endif
    </td>
    <td>
    <div class="row">
        <div class="col-md-7">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -100px;" type="date" class="form-control" readonly id="JEdate" name="JEdate" value="{{$Je_chk_Dt}}">
        </div>
    </div>
</td>
</tr> -->

@if(auth()->user()->usertypes === "DYE")
<form id="dyeForm" action="{{ url('submitDyeChkAndDate') }}" method="POST">
@csrf
        <!-- <tr>
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
</tr> -->

        <!-- @endif -->
      </tbody>
    </table>
  </div>
</div>


<!-- <div class="row" style="margin-left: 80px;">
  <div class="col-md-2 col-xl-2 col-lg-3">
        <label style="font-weight: bold;">JE Check</label>
        @if($Je_Chk === 1)
        <input class="checkbox col-md-2" disabled type="checkbox" name="JEcheckbox" required checked>
        @else
        <input class="checkbox col-md-2" disabled type="checkbox" name="JEcheckbox" required>
        @endif
    </div>
    <div class="col-md-3 col-xl-2 col-lg-6">
        <input style="margin-left: -100px;" type="date" class="form-control" readonly id="JEdate" name="JEdate" value="{{$Je_chk_Dt}}">
    </div>
</div>





@if(auth()->user()->usertypes === "DYE") 
<form id="dyeForm" action="{{ url('submitDyeChkAndDate') }}" method="POST">
    @csrf

    <input type="hidden" name="tbill_id" value="{{$CTbillid}}">
    <div class="row" style="margin-left: 80px;">
  <div class="col-md-2 col-xl-2 col-lg-3">
        <label style="font-weight: bold;">DYE Check</label>
                @if($SODYEchk===1)
                <input id="DYEcheckbox" class="checkbox col-md-1" type="checkbox" name="SODYEcheckbox" required checked>
                @else
                <input id="DYEcheckbox" class="checkbox col-md-1" type="checkbox" name="SODYEcheckbox" required>
                @endif
            </div>
            <div class="col-md-3 col-xl-2 col-lg-6">

                <input style="margin-left: -100px;"  id="DYEdate" class="form-control" type="date" name="SODYEdate"
                 value="{{$SODYEchk_Dt}}" required min="{{$Je_chk_Dt}}" max="{{$stupulatedDate}}">
            </div>
    </div>
@endif -->



<!-- //SDC check List Start  form start UI-->
<input type="hidden" name="tbill_id" value="{{$SDCTbillId}}">
<div class="container">
    <h4 style="margin-top:100px;">CheckList Of Sub Divisional Clerk</h4>
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-success">
        <tr>
            <th>SR.NO</th>
          <th>Name</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>1</td>
          <td>Name of Work</td>
          <input type="hidden" name="work_nm" value="{{$SDCWork_Nm}}">
          <td >{{$SDCWork_Nm}}</td>
        </tr>
        <tr>
            <td>2</td>
          <td>Fund Head</td>
          <input type="hidden" name="F_H_Code" value="{{$SDCFHCODE}}">
          <td> {{$SDCFHCODE}}</td>
        </tr>

        <tr>
            <td>3</td>
            <td>Whether arithmatic check is done ?</td>
        <td> {{$SDCArith_chk }}
    <!-- <label>
        <input type="text" class="form-control" value="{{$SDCArith_chk }}" > 
    </label> -->
    <!-- <label class="btn btn-outline-primary">
        <input type="radio" name="Arith_chk" value="{{ $SDCArith_chk  }}" >
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Arith_chk" value="{{ $SDCArith_chk  }}" > Not Required
    </label>
    <label class="btn btn-outline-primary">
        <input type="radio" name="Arith_chk" value="{{ $SDCArith_chk  }}"> Not Applicable
    </label> -->
</td>
        </tr>

        <!-- <tr>
    <td colspan="2">
    <label style="font-weight: bold;">Sub Divisional Clerk Checked</label>
    @if($SDCSdc_chk === 1)
        <input  class="checkbox col-md-1" disabled type="checkbox" name="SDCcheckbox" required checked>
        @else
        <input  class="checkbox col-md-1" disabled type="checkbox" name="SDCcheckbox" required >
        @endif
    </td>
    <td>
    <div class="row">
        <div class="col-md-5">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -100px;" class="form-control" type="date" name="SDCdate" readonly value="{{$SDCSdc_chk_Dt}}">
        </div>
    </div>
</td>
</tr> -->

@if(auth()->user()->usertypes === "DYE")
        <!-- <tr>
    <td colspan="2">
        <label style="font-weight: bold;">Deputy Engineer Checked</label>
        @if($SDCDye_chk === 1)
            <input  class="checkbox col-md-2" type="checkbox" name="SDCDYEcheckbox" required checked >
                    @else
            <input  class="checkbox col-md-2" type="checkbox" name="SDCDYEcheckbox" required  >
            @endif  
    </td>
    <td colspan="3">
    <div class="row">
        <div class="col-md-5">
            <label style="font-weight: bold;">Date of Checking :</label>
            </div>
            <div class="col-md-5">
            <input style="margin-left: -100px;"  type="date" class="form-control"
             name="SDCDYEdate" required value="{{$SDCDye_chk_Dt}}" min="{{$SDCSdc_chk_Dt}}" max="{{$stupulatedDate}}" >
        </div>
    </div>
    </td> -->
<!-- </tr> -->
@endif
        </tbody>
    </table>
  </div>
</div>



<div class="row justify-content-center">
    <div class="col-md-3 col-xl-2">
    <button type="submit"  class="btn btn-primary " style="">Submit</button>
    </div>
</div>


</form>

<br><br><br>

      @endsection()
<!-- <script>
// Function to compare dates and display alert if DYE date is not greater than JE date
function compareDates() {
    var JEDate = new Date(document.getElementById("JEdate").value);
    var DYEDate = new Date(document.getElementById("DYEdate").value);
    console.log(JEDate,DYEDate);

    if (DYEDate <= JEDate) 
    {
        alert("DYE Check date must be greater than JE Check date");
        return false;
        document.getElementById("DYEdate").value = ''; // Clear DYE date field
    }
}

// Add event listeners to JE date and DYE date inputs
// document.getElementById("JEdate").addEventListener("change", compareDates);
// document.getElementById("DYEdate").addEventListener("change", compareDates);
</script> -->