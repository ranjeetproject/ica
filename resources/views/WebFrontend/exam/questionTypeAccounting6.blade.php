<div class="questionBlock">
    <p>{{ $question->indexKey }}/ Accounting 6. {{ $question->qus }}</p>
    <div class="questionWorking wCapital">
        <div class="workingCap">
            <div class="wcHead">Assets</div>
            <div class="qInner">
                <div class="radioInn">
                    <span class="radioLft increase">
                        <input type="radio" id="accounting6AssetsIncrease_{{ $question->id }}" name="accounting6Assets_{{ $question->id }}">
                        <label for="accounting6AssetsIncrease_{{ $question->id }}">Increase</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft decrease">
                        <input type="radio" id="accounting6AssetsDecrease_{{ $question->id }}" name="accounting6Assets_{{ $question->id }}">
                        <label for="accounting6AssetsDecrease_{{ $question->id }}">Decrease</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft noInpact">
                        <input type="radio" id="accounting6AssetsNoImpact_{{ $question->id }}" name="accounting6Assets_{{ $question->id }}">
                        <label for="accounting6AssetsNoImpact_{{ $question->id }}">No-Impact</label>
                    </span>
                </div>
            </div>
        </div>

        <div class="workingCap">
            <div class="wcHead">Liabilities</div>
            <div class="qInner">
                <div class="radioInn">
                    <span class="radioLft increase">
                        <input type="radio" id="accounting6LiabilitiesIncrease_{{ $question->id }}" name="accounting6Liabilities_{{ $question->id }}">
                        <label for="accounting6LiabilitiesIncrease_{{ $question->id }}">Increase</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft decrease">
                        <input type="radio" id="accounting6LiabilitiesDecrease_{{ $question->id }}" name="accounting6Liabilities_{{ $question->id }}">
                        <label for="accounting6LiabilitiesDecrease_{{ $question->id }}">Decrease</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft noInpact">
                        <input type="radio" id="accounting6LiabilitiesNoImpact_{{ $question->id }}" name="accounting6Liabilities_{{ $question->id }}">
                        <label for="accounting6LiabilitiesNoImpact_{{ $question->id }}">No-Impact</label>
                    </span>
                </div>
            </div>
        </div>

        <div class="workingCap">
            <div class="wcHead">Income</div>
            <div class="qInner">
                <div class="radioInn">
                    <span class="radioLft increase">
                        <input type="radio" id="accounting6IncomeIncrease_{{ $question->id }}" name="accounting6Income_{{ $question->id }}">
                        <label for="accounting6IncomeIncrease_{{ $question->id }}">Increase</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft decrease">
                        <input type="radio" id="accounting6IncomeDecrease_{{ $question->id }}" name="accounting6Income_{{ $question->id }}">
                        <label for="accounting6IncomeDecrease_{{ $question->id }}">Decrease</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft noInpact">
                        <input type="radio" id="accounting6IncomeNoImpact_{{ $question->id }}" name="accounting6Income_{{ $question->id }}">
                        <label for="accounting6IncomeNoImpact_{{ $question->id }}">No-Impact</label>
                    </span>
                </div>
            </div>
        </div>
        <div class="workingCap">
            <div class="wcHead">Expenses</div>
            <div class="qInner">
                <div class="radioInn">
                    <span class="radioLft increase">
                        <input type="radio" id="accounting6ExpensesIncrease_{{ $question->id }}" name="accounting6Expenses_{{ $question->id }}">
                        <label for="accounting6ExpensesIncrease_{{ $question->id }}">Increase</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft decrease">
                        <input type="radio" id="accounting6ExpensesDecrease_{{ $question->id }}" name="accounting6Expenses_{{ $question->id }}">
                        <label for="accounting6ExpensesDecrease_{{ $question->id }}">Decrease</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft noInpact">
                        <input type="radio" id="accounting6ExpensesNoImpact_{{ $question->id }}" name="accounting6Expenses_{{ $question->id }}">
                        <label for="accounting6ExpensesNoImpact_{{ $question->id }}">No-Impact</label>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
