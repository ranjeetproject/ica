<div class="questionBlock">
    <p>{{ $question->indexKey }}/Accounting4. {{ $question->qus }}</p>
    <div class="questionWorking">
        <div class="workingCap">
            <div class="wcHead">Assets</div>
            <ul class="qInner qaccord">
                <li>
                    <div class="radioInn">
                        <span class="radioLft increase">
                            <input type="radio" id="accounting4AssetsIncrease_{{ $question->id }}" name="accounting4Assets_{{ $question->id }}" value="1" divType='assets'>
                            <label for="accounting4AssetsIncrease_{{ $question->id }}">Increase</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4AssetsIncrease_{{$question->id}}_Option" id="accounting4AssetsIncrease_{{$question->id}}_Option">
                                <option selected value="">Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4AssetsIncrease_{{ $question->id }}_Text" id="accounting4AssetsIncrease_{{ $question->id }}_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft decrease">
                            <input type="radio" id="accounting4AssetsDecrease_{{ $question->id }}" name="accounting4Assets_{{ $question->id }}" value="2" divType='assets'>
                            <label for="accounting4AssetsDecrease_{{ $question->id }}">Decrease</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4AssetsDecrease_{{$question->id}}_Option" id="accounting4AssetsDecrease_{{$question->id}}_Option">
                                <option selected value="">Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4AssetsDecrease_{{ $question->id }}_Text" id="accounting4AssetsDecrease_{{ $question->id }}_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft noInpact">
                            <input type="radio" id="accounting4AssetsNoImpact_{{ $question->id }}" name="accounting4Assets_{{ $question->id }}" value="3" divType='assets'><label
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
                            <input type="radio" id="accounting4LiabilitiesIncrease_{{ $question->id }}" name="accounting4Liabilities_{{ $question->id }}" value="1" divType='liabilities'>
                            <label for="accounting4LiabilitiesIncrease_{{ $question->id }}">Increase</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4LiabilitiesIncrease_{{ $question->id }}_Option1" id="accounting4LiabilitiesIncrease_{{ $question->id }}_Option1">
                                <option selected value="">Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example" name="accounting4LiabilitiesIncrease_{{ $question->id }}_Option2" id="accounting4LiabilitiesIncrease_{{ $question->id }}_Option2">
                                <option selected value="">Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4LiabilitiesIncrease_{{ $question->id }}_Text" id="accounting4LiabilitiesIncrease_{{ $question->id }}_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft decrease">
                            <input type="radio" id="accounting4LiabilitiesDecrease_{{ $question->id }}" name="accounting4Liabilities_{{ $question->id }}" value="2" divType='liabilities'>
                            <label for="accounting4LiabilitiesDecrease_{{ $question->id }}">Decrease</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4LiabilitiesDecrease_{{ $question->id }}_Option1" id="accounting4LiabilitiesDecrease_{{ $question->id }}_Option1">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example" name="accounting4LiabilitiesDecrease_{{ $question->id }}_Option2" id="accounting4LiabilitiesDecrease_{{ $question->id }}_Option2">
                                <option selected value="">Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4LiabilitiesDecrease_{{ $question->id }}_Text" id="accounting4LiabilitiesDecrease_{{ $question->id }}_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft noInpact">
                            <input type="radio" id="accounting4LiabilitiesNoImpact_{{ $question->id }}" name="accounting4Liabilities_{{ $question->id }}" value="3" divType='liabilities'>
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
                            <input type="radio" id="accounting4EquityIncrease_{{ $question->id }}" name="accounting4Equity_{{ $question->id }}" value="1" divType='equity'>
                            <label for="accounting4EquityIncrease_{{ $question->id }}">Increase</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4EquityIncrease_{{ $question->id }}_Option1" id="accounting4EquityIncrease_{{ $question->id }}_Option1">
                                <option selected value="">Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example" name="accounting4EquityIncrease_{{ $question->id }}_Option2" id="accounting4EquityIncrease_{{ $question->id }}_Option2">
                                <option selected value="">Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4EquityIncrease_{{ $question->id }}_Text" id="accounting4EquityIncrease_{{ $question->id }}_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft decrease">
                            <input type="radio" id="accounting4EquityDecrease_{{ $question->id }}" name="accounting4Equity_{{ $question->id }}" value="2" divType='equity'>
                            <label for="accounting4EquityDecrease_{{ $question->id }}">Decrease</label>
                        </span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example" name="accounting4EquityDecrease_{{ $question->id }}_Option1" id="accounting4EquityDecrease_{{ $question->id }}_Option1">
                                <option selected value="">Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example" name="accounting4EquityDecrease_{{ $question->id }}_Option2" id="accounting4EquityDecrease_{{ $question->id }}_Option2">
                                <option selected value="">Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" name="accounting4EquityDecrease_{{ $question->id }}_Text" id="accounting4EquityDecrease_{{ $question->id }}_Text" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft noInpact">
                            <input type="radio" id="accounting4EquityNoImpact_{{ $question->id }}" name="accounting4Equity_{{ $question->id }}" value="3" divType='equity'>
                            <label for="accounting4EquityNoImpact_{{ $question->id }}">No-Impact</label>
                        </span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    const menuLis = document.querySelectorAll(".qaccord > li");
    for (let li of menuLis) {
        li.addEventListener("click", function() {
            // 1. Remove Class from All Lis
            for (let li of menuLis) {
                li.classList.remove('selected');
            }
            // 2. Add Class to Relevant Li
            this.classList.add('selected');            
        });
    }
</script>
