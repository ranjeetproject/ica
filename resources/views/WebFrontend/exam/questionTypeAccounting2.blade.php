<div class="questionBlock">
    <p>{{ $question->indexKey }}. {{ $question->qus }}</p>
    <div class="qslImg"><img src="{{ $question->qus_image }}" alt="" title="" /></div>
    <div class="qbSelect">
        <div class="qbSelectB">
            <label>Primary Account</label>
            <select class="form-select" aria-label="Default select example" name="accounting2PrimaryAccount_{{$question->id}}"
                id="accounting2PrimaryAccount_{{$question->id}}">
                <option selected value=''>Select</option>
                @foreach ($question->primaryAccount as $primaryAccountValue)
                    <option value="{{ $primaryAccountValue->id }}">{{ $primaryAccountValue->account_name }}</option>
                @endForeach
            </select>
        </div>
        <div class="qbSelectB">
            <label>Secondary Account</label>
            <select class="form-select" aria-label="Default select example" name="accounting2SecondaryAccount_{{$question->id}}"
                id="accounting2SecondaryAccount_{{$question->id}}">
                <option selected value=''>Select</option>
                @foreach ($question->secondaryAccount as $secondaryAccountValue)
                    <option value="{{ $secondaryAccountValue->id }}">{{ $secondaryAccountValue->acc_name }}
                    </option>
                @endForeach
            </select>
        </div>
        <div class="qbSelectB">
            <label>Account Name</label>
            <select class="form-select" aria-label="Default select example" name="accounting2AccountName_{{$question->id}}"
                id="accounting2AccountName_{{$question->id}}">
                <option selected>Select</option>
                @foreach ($question->account as $accountValue)
                    <option value="{{ $accountValue->id }}">{{ $accountValue->accName }}
                    </option>
                @endForeach
            </select>
        </div>
        <div class="qbSelectB">
            <label>Amount</label>
            <input class="form-control" type="number" placeholder="Default input" aria-label="default input example" 
            name="accounting2Amount_{{$question->id}}" id="accounting2Amount_{{$question->id}}"/>
        </div>

    </div>
    <p>Debit / Credit</p>
    <div class="qInner qBtnB">
        <div class="qbLft">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="accounting2DebitCredit_{{$question->id}}" 
                id="accounting2DebitCreditDebit_{{$question->id}}" value="0" checked >
                <label class="form-check-label" for="accounting2DebitCreditDebit_{{$question->id}}">Debit</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="accounting2DebitCredit_{{$question->id}}" 
                id="accounting2DebitCreditCredit_{{$question->id}}" value="1">
                <label class="form-check-label" for="flexRadioDefault2">Credit</label>
            </div>
        </div>
        <button onClick="addLineItemAccounting2('{{$question->id}}')">Add a line</button>
    </div>
    <div class="questionTable baccountTable">
        <input type="hidden" name="accounting2credit_{{$question->id}}" id="accounting2credit_{{$question->id}}" value="0">
        <input type="hidden" name="accounting2Debit_{{$question->id}}" id="accounting2Debit_{{$question->id}}" value="0">
        <table cellpadding="10" cellspacing="1">
            <tr>
                <th>&nbsp;</th>
                <th>Account</th>
                <th>Dr.</th>
                <th>Cr.</th>
            </tr>
            <tbody id="accounting2TableBody_{{$question->id}}">                
            </tbody>
            <tr>
                <td>&nbsp;</td>
                <td>Total</td>
                <td id="accounting2_totalDebit_{{$question->id}}">0</td>
                <td id="accounting2_totalCredit_{{$question->id}}">0</td>
            </tr>
        </table>
    </div>
</div>

<script>
    function addLineItemAccounting2(questionId)
    {
        var accountName=$("#accounting2AccountName_"+questionId+" option:selected").text();
        var amount=$("#accounting2Amount_"+questionId).val();

        var radioNameString="accounting2DebitCredit_"+questionId;
        var type=$('input[name='+radioNameString+']:checked').val();

        if(amount > 0){
            var html='';
            if(type==0)
            {
                //debit
                var html='<tr><td><a href="#" class="rowDel"><i class="fas fa-trash-alt"></i></a></td><td>'+accountName+'</td><td>'+amount+'</td><td>0</td></tr>';
                
                var totalDebit=$("#accounting2Debit_"+questionId).val();
                var totalDebit = parseInt(totalDebit)+parseInt(amount);
                $("#accounting2Debit_"+questionId).val(totalDebit);
                $("#accounting2_totalDebit_"+questionId).html(totalDebit);                                
            }
            else{
                //credit
                var html='<tr><td><a href="#" class="rowDel"><i class="fas fa-trash-alt"></i></a></td><td>'+accountName+'</td><td>0</td><td>'+amount+'</td></tr>';
                
                var totalCredit=$("#accounting2credit_"+questionId).val();
                var totalCredit = parseInt(totalCredit)+parseInt(amount);
                $("#accounting2credit_"+questionId).val(totalCredit);
                $("#accounting2_totalCredit_"+questionId).html(totalCredit);
            }                         
            
            $("#accounting2TableBody_"+questionId).append(html);

            $(".rowDel").click(function()
            {
                var that = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't delete this row!",
                    icon: 'warning',
                    showCancelButton: true, 
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) 
                    {
                        $(this).parent().parent().remove();
                        Swal.fire(
                        'Deleted!',
                        'Your row has been deleted.',
                        'success'
                        )
                    }
                })                
            });
        }
    }
</script>
