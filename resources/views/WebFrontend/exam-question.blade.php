@extends('WebFrontend.layout.afterLoginApp')
@section('content')
    <section class="header">
        <div class="header-top">
            @include('WebFrontend.layout.afterLoginHeaderTop')
        </div>
        <div class="header-bottom">
            @include('WebFrontend.layout.afterLoginNav')
        </div>

    </section>

    <section class="crs-dtls-wrp">
        <div class="container">

            <div class="examSlider">
                <!-- Button trigger modal -->
                <button type="button" class="examCount" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span id="exam-count">1</span>/3
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="numberIcn" aria-current="true" aria-label="Slide 1"><span data-bs-dismiss="modal">1</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" data-bs-dismiss="modal" class="numberIcn" aria-label="Slide 2"><span data-bs-dismiss="modal">2</span></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" data-bs-dismiss="modal" class="numberIcn" aria-label="Slide 3"><span data-bs-dismiss="modal">3</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="carouselExampleIndicators" class="carousel" data-bs-interval="false">

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="questionBlock">
                                <p>Select appropriate option from dropdown list</p>
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
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="questionBlock">
                                <p>What is working capital?</p>
                                <div class="questionWorking">
                                    <div class="workingCap">
                                        <div class="wcHead">Assets</div>
                                        <div class="qInner">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">Increase</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2">Decrease</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                                <label class="form-check-label" for="flexRadioDefault3">Decrease</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="eql">&#61;</div>
                                    <div class="workingCap">
                                        <div class="wcHead">Liabilities</div>
                                    </div>
                                    <div class="eql">&#43;</div>
                                    <div class="workingCap">
                                        <div class="wcHead">Equity</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="questionBlock">
                                <p>Slide 3 content</p>
                                <div class="qbSelect">
                                    <div class="qbSelectB">
                                        <label>Primary Account</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="qbSelectB">
                                        <label>Secondary Account</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="qbSelectB">
                                        <label>Account Name</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="qbSelectB">
                                        <label>Amount</label>
                                        <input class="form-control" type="text" placeholder="Default input" aria-label="default input example" />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="questionBlock">
                                dsfds
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="questionBlock">
                                dsfds
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="questionBlock">
                                dsfds
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="questionBlock">
                                dsfds
                            </div>
                        </div>
                    </div>
                    <div class="carouselFlow">
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <!--                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
                            <span class="">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <!--                            <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
                            <span class="">Skip</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <!--                            <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
                            <span class="">Next</span>
                        </button>
                    </div>
                </div>


            </div>


        </div>
    </section>
@endsection
@section('customJavascript')
    <script>
    $(".numberIcn"). click(function() {
        var button = $(this). text();
        $('#exam-count').text(button)
    });
    </script>
@endsection