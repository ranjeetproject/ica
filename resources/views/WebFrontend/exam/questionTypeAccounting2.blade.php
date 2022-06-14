<div class="questionBlock">
    <p>{{ $question->indexKey }}. {{ $question->qus }}</p>
    <div class="qslImg imgZoom">
        @if($question->qus_image!='' || $question->qus_image!=null)
            <img src="{{ $question->qus_image }}" alt="" title=""/>
        @endif
    </div>
    <div class="qbSelect">
        <div class="qbSelectB">
            <label>Primary Account</label>
            <select class="form-select" aria-label="Default select example"
                id="accounting2PrimaryAccount_{{$question->id}}">
                <option selected value=''>Select</option>
                @foreach ($question->primaryAccount as $primaryAccountValue)
                    <option value="{{ $primaryAccountValue->id }}">{{ $primaryAccountValue->account_name }}</option>
                @endForeach
            </select>
        </div>
        <div class="qbSelectB">
            <label>Secondary Account</label>
            <select class="form-select" aria-label="Default select example"
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
            <select class="form-select" aria-label="Default select example"
                id="accounting2AccountName_{{$question->id}}">
                <option selected value=''>Select</option>
                @foreach ($question->account as $accountValue)
                    <option value="{{ $accountValue->id }}">{{ $accountValue->accName }}
                    </option>
                @endForeach
            </select>
        </div>
        <div class="qbSelectB">
            <label>Amount</label>
            <input class="form-control" type="number" placeholder="Default input" aria-label="default input example"
             id="accounting2Amount_{{$question->id}}"/>
        </div>

    </div>
    <p>Debit / Credit</p>
    <div class="qInner qBtnB">
        <div class="qbLft">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="accounting2DebitCredit_{{$question->id}}"
                id="accounting2DebitCreditDebit_{{$question->id}}" value="1" checked >
                <label class="form-check-label" for="accounting2DebitCreditDebit_{{$question->id}}">Debit</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="accounting2DebitCredit_{{$question->id}}"
                id="accounting2DebitCreditCredit_{{$question->id}}" value="2">
                <label class="form-check-label" for="flexRadioDefault2">Credit</label>
            </div>
        </div>
        <button onClick="addLineItemAccounting2('{{$question->id}}')" type="button">Add a line</button>
    </div>
    <div class="questionTable baccountTable">
        <input type="hidden"  id="accounting2credit_{{$question->id}}" value="0">
        <input type="hidden"  id="accounting2Debit_{{$question->id}}" value="0">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Account</th>
                    <th>Dr.</th>
                    <th>Cr.</th>
                </tr>
            </thead>
            <tbody id="accounting2TableBody_{{$question->id}}">
            </tbody>
            <tfoot>
                <tr>
                    <td>&nbsp;</td>
                    <td>Total</td>
                    <td id="accounting2_totalDebit_{{$question->id}}">0</td>
                    <td id="accounting2_totalCredit_{{$question->id}}">0</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    function addLineItemAccounting2(questionId)
    {
        var primaryAccountValue=$("#accounting2PrimaryAccount_"+questionId).val();
        var secondaryAccountValue=$("#accounting2SecondaryAccount_"+questionId).val();
        var accountNameValue=$("#accounting2AccountName_"+questionId).val();

        var accountName=$("#accounting2AccountName_"+questionId+" option:selected").text();
        var amount=$("#accounting2Amount_"+questionId).val();

        

        var radioNameString="accounting2DebitCredit_"+questionId;
        var type=$('input[name='+radioNameString+']:checked').val();

        if(amount > 0)
        {
            var html='';
            if(type==1)
            {
                console.log("Debit Add : "+amount);
                //debit
                var html='<tr><td><a href="#" class="rowDel" deleteType="1"><i class="fas fa-trash-alt"></i></a></td><td>'+accountName+'</td><td class="amount_track">'+amount+'</td><td>0<input type="hidden" name="accounting2_LineItem_'+questionId+'[]" value="{'+primaryAccountValue+','+secondaryAccountValue+','+accountNameValue+','+amount+','+type+'}"></td></tr>';
                var totalDebit=$("#accounting2Debit_"+questionId).val();
                var totalDebit = parseInt(totalDebit)+parseInt(amount);
                $("#accounting2Debit_"+questionId).val(totalDebit);
                $("#accounting2_totalDebit_"+questionId).html(totalDebit);
            }
            else{
                //credit
                console.log("Credit Add : "+amount);
                var html='<tr><td><a href="#" class="rowDel" deleteType="2"><i class="fas fa-trash-alt"></i></a></td><td>'+accountName+'</td><td>0</td><td class="amount_track">'+amount+'<input type="hidden" name="accounting2_LineItem_'+questionId+'[]" value="{'+primaryAccountValue+','+secondaryAccountValue+','+accountNameValue+','+amount+','+type+'}"></td></tr>';

                var totalCredit=$("#accounting2credit_"+questionId).val();
                var totalCredit = parseInt(totalCredit)+parseInt(amount);
                $("#accounting2credit_"+questionId).val(totalCredit);
                $("#accounting2_totalCredit_"+questionId).html(totalCredit);
            }

            $("#accounting2TableBody_"+questionId).append(html);

            

            $("#accounting2PrimaryAccount_"+questionId).val('');
            $("#accounting2SecondaryAccount_"+questionId).val('');
            $("#accounting2AccountName_"+questionId).val('');
            $("#accounting2Amount_"+questionId).val('');

            $(".rowDel").click(function()
            {
                var deleteType=$(this).attr('deleteType');
                var amount=$(this).parent().siblings('.amount_track').html(); 

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
                        if(deleteType==1)
                        {
                            var totalDebitAmount = $("#accounting2_totalDebit_"+questionId).html();
                            totalDebitAmount = totalDebitAmount - amount;
                            $("#accounting2_totalDebit_"+questionId).html(totalDebitAmount);
                            $("#accounting2Debit_"+questionId).val(totalDebitAmount);
                            
                        }

                        if(deleteType==2)
                        {
                            var totalCreditAmount = $("#accounting2_totalCredit_"+questionId).html();
                            totalCreditAmount = totalCreditAmount - amount;   
                            $("#accounting2_totalCredit_"+questionId).html(totalCreditAmount);    
                            $("#accounting2credit_"+questionId).val(totalCreditAmount);    
                                                 
                        }
                        
                       
                        Swal.fire(
                        'Deleted!',
                        'Your row has been deleted.',
                        'success'
                        );
                    }
                })
            });
        }
    }
</script>
