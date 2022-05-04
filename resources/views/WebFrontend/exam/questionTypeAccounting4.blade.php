<div class="questionBlock">
    <p>{{ $question->indexKey }}. {{ $question->qus }}</p>
    <div class="questionWorking">
        <div class="workingCap">
            <div class="wcHead">Assets</div>
            <ul class="qInner qaccord">
                <li>
                    <div class="radioInn">
                        <span class="radioLft increase"><input type="radio" id="test10" name="radio-group4"><label
                                for="test10">Increase</label></span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft decrease"><input type="radio" id="test11" name="radio-group4"><label
                                for="test11">Decrease</label></span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft noInpact"><input type="radio" id="test12" name="radio-group4"><label
                                for="test12">No-Impact</label></span>
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
                        <span class="radioLft increase"><input type="radio" id="test13" name="radio-group5"><label
                                for="test13">Increase</label></span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft decrease"><input type="radio" id="test14" name="radio-group5"><label
                                for="test14">Decrease</label></span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft noInpact"><input type="radio" id="test15" name="radio-group5"><label
                                for="test15">No-Impact</label></span>
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
                        <span class="radioLft increase"><input type="radio" id="test16" name="radio-group6"><label
                                for="test16">Increase</label></span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft decrease"><input type="radio" id="test17" name="radio-group6"><label
                                for="test17">Decrease</label></span>
                    </div>
                    <div class="qaFormbg">
                        <div class="qbSelect">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <input type="text" class="form-control" />
                    </div>
                </li>
                <li>
                    <div class="radioInn">
                        <span class="radioLft noInpact"><input type="radio" id="test18" name="radio-group6"><label
                                for="test18">No-Impact</label></span>
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
