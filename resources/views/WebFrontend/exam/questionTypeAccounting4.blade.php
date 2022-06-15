<div class="questionBlock">
    <p>{{ $question->indexKey }}. {{ $question->qus }}</p>
    @if($question->qus_image!=null)
        <div class="qslImg"><img class="imgZoom" src="{{ $question->qus_image }}" alt="" title=""/></div>
    @endif
    <div class="questionWorking">
        <div class="workingCap">
            <div class="wcHead">Assets</div>
            <ul class="qInner qaccord">
                <li>
                    <div class="radioInn">
                        <span class="radioLft increase">
                            <input type="radio" id="accounting4_{{$question->id}}_Assets_Increase" name="accounting4_{{ $question->id }}_Assets" value="1" divType='assets'>
                            <label for="accounting4_{{$question->id}}_Assets_Increase">Increase</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4_{{$question->id}}_Assets_Increase_Option" id="accounting4_{{$question->id}}_Assets_Increase_Option">
                                <option selected value="">Select</option>
                                @foreach ($question->reasonEquity as $reasonEquityValue)
                                    <option value="{{ $reasonEquityValue->id }}">{{ $reasonEquityValue->reason_name	}}</option>
                                @endForeach
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4_{{$question->id}}_Assets_Increase_Text" id="accounting4_{{$question->id}}_Assets_Increase_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft decrease">
                            <input type="radio" id="accounting4_{{$question->id}}_Assets_Decrease" name="accounting4_{{ $question->id }}_Assets" value="2" divType='assets'>
                            <label for="accounting4_{{$question->id}}_Assets_Decrease">Decrease</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4_{{$question->id}}_Assets_Decrease_Option" id="accounting4_{{$question->id}}_Assets_Decrease_Option">
                                <option selected value="">Select</option>
                                @foreach ($question->reasonEquity as $reasonEquityValue)
                                    <option value="{{ $reasonEquityValue->id }}">{{ $reasonEquityValue->reason_name	}}</option>
                                @endForeach
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4_{{$question->id}}_Assets_Decrease_Text" id="accounting4_{{$question->id}}_Assets_Decrease_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft noInpact">
                            <input type="radio" id="accounting4AssetsNoImpact_{{ $question->id }}" name="accounting4_{{ $question->id }}_Assets" value="3" divType='assets'><label
                                for="accounting4AssetsNoImpact_{{ $question->id }}">No-Impact</label>
                        </span>
                    </div>
                </li>

            </ul>
        </div>
        <div class="eql">&#61;</div>
        <div class="workingCap">
            <div class="wcHead">Liabilities</div>
            <ul class="qInner qaccord">
                <li>
                    <div class="radioInn">
                        <span class="radioLft increase">
                            <input type="radio" id="accounting4_{{$question->id}}_Liabilities_Increase" name="accounting4_{{$question->id}}_Liabilities" value="1" divType='liabilities'>
                            <label for="accounting4_{{$question->id}}_Liabilities_Increase">Increase</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4_{{$question->id}}_Liabilities_Increase_Option1" id="accounting4_{{$question->id}}_Liabilities_Increase_Option1">
                                <option selected value="">Select</option>
                                @foreach ($question->reasonEquity as $reasonEquityValue)
                                    <option value="{{ $reasonEquityValue->id }}">{{ $reasonEquityValue->reason_name	}}</option>
                                @endForeach
                            </select>
                            <select class="form-select" aria-label="Default select example" name="accounting4_{{$question->id}}_Liabilities_Increase_Option2" id="accounting4_{{$question->id}}_Liabilities_Increase_Option2">
                                <option selected value="">Select</option>
                                @foreach ($question->secondaryAccount as $secondaryAccountValue)
                                    <option value="{{ $secondaryAccountValue->id }}">{{ $secondaryAccountValue->acc_name }}
                                    </option>
                                @endForeach
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4_{{$question->id}}_Liabilities_Increase_Text" id="accounting4_{{$question->id}}_Liabilities_Increase_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft decrease">
                            <input type="radio" id="accounting4_{{$question->id}}_Liabilities_Decrease" name="accounting4_{{$question->id}}_Liabilities" value="2" divType='liabilities'>
                            <label for="accounting4_{{$question->id}}_Liabilities_Decrease">Decrease</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4_{{$question->id}}_Liabilities_Decrease_Option1" id="accounting4_{{$question->id}}_Liabilities_Decrease_Option1">
                                <option selected value="">Select</option>
                                @foreach ($question->reasonEquity as $reasonEquityValue)
                                    <option value="{{ $reasonEquityValue->id }}">{{ $reasonEquityValue->reason_name	}}</option>
                                @endForeach
                            </select>
                            <select class="form-select" aria-label="Default select example" name="accounting4_{{$question->id}}_Liabilities_Decrease_Option2" id="accounting4_{{$question->id}}_Liabilities_Decrease_Option2">
                                <option selected value="">Select</option>
                                @foreach ($question->secondaryAccount as $secondaryAccountValue)
                                    <option value="{{ $secondaryAccountValue->id }}">{{ $secondaryAccountValue->acc_name }}
                                    </option>
                                @endForeach
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4_{{$question->id}}_Liabilities_Decrease_Text" id="accounting4_{{$question->id}}_Liabilities_Decrease_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft noInpact">
                            <input type="radio" id="accounting4LiabilitiesNoImpact_{{ $question->id }}" name="accounting4_{{ $question->id }}_Liabilities" value="3" divType='liabilities'>
                            <label for="accounting4LiabilitiesNoImpact_{{ $question->id }}">No-Impact</label>
                        </span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="eql">&#43;</div>
        <div class="workingCap">
            <div class="wcHead">Equity</div>
            <ul class="qInner qaccord">
                <li>
                    <div class="radioInn">
                        <span class="radioLft increase">
                            <input type="radio" id="accounting4_{{$question->id}}_Equity_Increase" name="accounting4_{{ $question->id }}_Equity" value="1" divType='equity'>
                            <label for="accounting4_{{$question->id}}_Equity_Increase">Increase</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4_{{$question->id}}_Equity_Increase_Option1" id="accounting4_{{$question->id}}_Equity_Increase_Option1">
                                <option selected value="">Select</option>
                                @foreach ($question->reasonEquity as $reasonEquityValue)
                                    <option value="{{ $reasonEquityValue->id }}">{{ $reasonEquityValue->reason_name	}}</option>
                                @endForeach
                            </select>
                            <select class="form-select" aria-label="Default select example" name="accounting4_{{$question->id}}_Equity_Increase_Option2" id="accounting4_{{$question->id}}_Equity_Increase_Option2">
                                <option selected value="">Select</option>
                                @foreach ($question->secondaryAccount as $secondaryAccountValue)
                                    <option value="{{ $secondaryAccountValue->id }}">{{ $secondaryAccountValue->acc_name }}
                                    </option>
                                @endForeach
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4_{{$question->id}}_Equity_Increase_Text" id="accounting4_{{$question->id}}_Equity_Increase_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft decrease">
                            <input type="radio" id="accounting4_{{$question->id}}_Equity_Decrease" name="accounting4_{{ $question->id }}_Equity" value="2" divType='equity'>
                            <label for="accounting4_{{$question->id}}_Equity_Decrease">Decrease</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4_{{$question->id}}_Equity_Decrease_Option1" id="accounting4_{{$question->id}}_Equity_Decrease_Option1">
                                <option selected value="">Select</option>
                                @foreach ($question->reasonEquity as $reasonEquityValue)
                                    <option value="{{ $reasonEquityValue->id }}">{{ $reasonEquityValue->reason_name	}}</option>
                                @endForeach
                            </select>
                            <select class="form-select" aria-label="Default select example" name="accounting4_{{$question->id}}_Equity_Decrease_Option2" id="accounting4_{{$question->id}}_Equity_Decrease_Option2">
                                <option selected value="">Select</option>
                                @foreach ($question->secondaryAccount as $secondaryAccountValue)
                                    <option value="{{ $secondaryAccountValue->id }}">{{ $secondaryAccountValue->acc_name }}
                                    </option>
                                @endForeach
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4_{{$question->id}}_Equity_Decrease_Text" id="accounting4_{{$question->id}}_Equity_Decrease_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft noInpact">
                            <input type="radio" id="accounting4EquityNoImpact_{{ $question->id }}" name="accounting4_{{ $question->id }}_Equity" value="3" divType='equity'>
                            <label for="accounting4EquityNoImpact_{{ $question->id }}">No-Impact</label>
                        </span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    var menuLis = document.querySelectorAll(".qaccord > li");
    for (var li of menuLis) {
        li.addEventListener("click", function() {
            // 1. Remove Class from All Lis
            for (var li of menuLis) {
                li.classList.remove('selected');
            }
            // 2. Add Class to Relevant Li
            this.classList.add('selected');            
        });
    }
</script>
