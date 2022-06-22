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

    <section class="exam-list-wr">
        <div class="container">
            <h3 class="e-title">
                Course Progress
                <span class="blue-bar"></span>
            </h3>
            <div class="prgMain">
           <!-- <h5>Tally</h5> -->
            <div class="prg">
                <span>Progress</span>
                <span>Below 20</span>
                <span>20-40</span>
                <span>40-60</span>
                <span>60-80</span>
                <span>80-100</span>
            </div>
        </div>
            <div class="pgcBtm">
                <canvas id="courseProgress"></canvas>
            </div> 
        </div>
    </section>
@endsection
@section('customJavascript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://www.chartjs.org/samples/2.9.4/utils.js"></script>    
    <script>       
        let labels = '{{$coursesProgress['courseName']}}';
        labels=labels.split(',');
        let courseBackground='{{@$coursesProgress['courseBackgroundColor']}}';
        courseBackground=courseBackground.split(',');
        let assignmentBackground='{{@$coursesProgress['assignmentBackgroundColor']}}';
        assignmentBackground=assignmentBackground.split(',');

        const data = {
            labels: labels,
            datasets: [
                {
                    label: 'Course',
                    data: [{{@$coursesProgress['readPercentageArray']}}],
                    backgroundColor: courseBackground,
                    borderColor: courseBackground
                },
                {
                    label: 'Assessm',
                    data: [{{@$coursesProgress['assessmentPercentgeArray']}}],
                    backgroundColor: assignmentBackground,
                    borderColor: assignmentBackground
                }

            ]
        };     
        

        const config = {
            type: 'bar',
            data: data,
            options: {
                indexAxis: 'y',
                // Elements options apply to all of the options unless overridden in a dataset
                // In this case, we are setting the border of each horizontal bar to be 2px wide
                elements: {
                bar: {
                    borderWidth: 2,
                }
                },
                responsive: true,
                plugins: {
                legend: {
                    display: false,
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Course Progress'
                }
                }
            },
            };

        
        const myChart = new Chart(
            document.getElementById('courseProgress'),
            config
        );
    </script>
@endsection
