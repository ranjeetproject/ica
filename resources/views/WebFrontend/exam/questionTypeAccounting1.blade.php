<div class="questionBlock">
    <p>{{ $question->indexKey }}. {{ $question->qus }}</p>
    @if($question->qus_image!=null)
        <div class="qslImg"><img class="imgZoom" src="{{ $question->qus_image }}" alt="" title=""/></div>
    @endif
    <div class="questionWorking">
        <div class="workingCap">
            <div class="wcHead">Assets</div>
            <div class="qInner">
                <div class="radioInn">
                    <span class="radioLft increase">
                        <input type="radio" id="accounting1AssetsIncrease_{{ $question->id }}" name="accounting1_Assets_{{ $question->id }}" value='1'>
                        <label for="accounting1AssetsIncrease_{{ $question->id }}">Increase</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft decrease">
                        <input type="radio" id="accounting1AssetsDecrease_{{ $question->id }}" name="accounting1_Assets_{{ $question->id }}" value='2'>
                        <label for="accounting1AssetsDecrease_{{ $question->id }}">Decrease</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft noInpact">
                        <input type="radio" id="accounting1AssetsNoImpact_{{ $question->id }}" name="accounting1_Assets_{{ $question->id }}" value='3'>
                        <label for="accounting1AssetsNoImpact_{{ $question->id }}">No-Impact</label>
                    </span>
                </div>
            </div>
        </div>
        <div class="eql">&#61;</div>
        <div class="workingCap">
            <div class="wcHead">Liabilities</div>
            <div class="qInner">
                <div class="radioInn">
                    <span class="radioLft increase">
                        <input type="radio" id="accounting1LiabilitiesIncrease_{{ $question->id }}" name="accounting1_Liabilities_{{ $question->id }}" value='1'>
                        <label for="accounting1LiabilitiesIncrease_{{ $question->id }}">Increase</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft decrease">
                        <input type="radio" id="accounting1LiabilitiesDecrease_{{ $question->id }}" name="accounting1_Liabilities_{{ $question->id }}" value='2'>
                        <label for="accounting1LiabilitiesDecrease_{{ $question->id }}">Decrease</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft noInpact">
                        <input type="radio" id="accounting1LiabilitiesNoImpact_{{ $question->id }}" name="accounting1_Liabilities_{{ $question->id }}" value='3'>
                        <label for="accounting1LiabilitiesNoImpact_{{ $question->id }}">No-Impact</label>
                    </span>
                </div>
            </div>
        </div>
        <div class="eql">&#43;</div>
        <div class="workingCap">
            <div class="wcHead">Equity</div>
            <div class="qInner">
                <div class="radioInn">
                    <span class="radioLft increase">
                        <input type="radio" id="accounting1EquityIncrease_{{ $question->id }}" name="accounting1_Equity_{{ $question->id }}" value='1'>
                        <label for="accounting1EquityIncrease_{{ $question->id }}">Increase</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft decrease">
                        <input type="radio" id="accounting1EquityDecrease_{{ $question->id }}" name="accounting1_Equity_{{ $question->id }}" value='2'>
                        <label for="accounting1EquityDecrease_{{ $question->id }}">Decrease</label>
                    </span>
                </div>
                <div class="radioInn">
                    <span class="radioLft noInpact">
                        <input type="radio" id="accounting1EquityDecreaseNoImpact_{{ $question->id }}" name="accounting1_Equity_{{ $question->id }}" value='3'>
                        <label for="accounting1EquityDecreaseNoImpact_{{ $question->id }}">No-Impact</label>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
