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
                Your Progress
                <span class="blue-bar"></span>
            </h3>

            <div class="progressChart">
                <div class="pgC">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="pgC">
                    <canvas id="myChart1"></canvas>
                </div>  
                                           
            </div> 
            <div class="pgcBtm">
                <canvas id="myChart2"></canvas>
            </div>             
            

            
            

            


        </div>
    </section>
@endsection
@section('customJavascript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://www.chartjs.org/samples/2.9.4/utils.js"></script>    
    <script>
        //const labels = Utils.months({count: 7});
        const labels = [
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '10'
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Exams',
                data: [{{$examProgressPercentage}}],
                backgroundColor: [
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)'
                ],
                borderColor: [
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)'
                ],
                borderWidth: 1
            }]
        };     
        

        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        display: false,
                    },
                    title: {
                        display: true,
                        text: 'Last 10 Exam Progress',
                        color: '#072F60',
                        font: {
                            size: 25,
                            weight: 'normal'                       
                        },
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Exams',
                            color: '#072f60',
                            font: {
                                size: 18,
                                style: 'normal',
                                lineHeight: 1.2
                            },
                            padding: {top: 7, left: 0, right: 0, bottom: 0}
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Percentage of Marks',
                            color: '#072f60',
                            // position: 'relative',
                            // left: '-20px',
                            font: {
                                size: 15,
                                style: 'normal',
                                lineHeight: 1.2
                            },
                            padding: {top: 0, left: 0, right: 30, bottom: 0},
                        }
                    }
                }
            },
        };

        
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        //myChart.canvas.parentNode.style.height = '400px';
        //myChart.canvas.parentNode.style.width = '800px';


        const data1 = {
            labels: labels,
            datasets: [{
                label: 'Competition',
                data: [{{$competitiveProgressPercentage}}],
                backgroundColor: [
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)'
                ],
                borderColor: [
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)'
                ],
                borderWidth: 1
            }]
        };  

        const config1 = {
            type: 'bar',
            data: data1,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        display: false,
                    },
                    title: {
                        display: true,
                        text: 'Last 10 Competition Progress',
                        color: '#072F60',
                        font: {
                            size: 20,
                            weight: 'normal'                       
                        },
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Exams',
                            color: '#072f60',
                            font: {
                                size: 18,
                                style: 'normal',
                                lineHeight: 1.2
                            },
                            padding: {top: 7, left: 0, right: 0, bottom: 0}
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Percentage of Marks',
                            color: '#072f60',
                            font: {
                                size: 15,
                                style: 'normal',
                                lineHeight: 1.2
                            },
                            padding: {top: 0, left: 0, right: 30, bottom: 0}
                        }
                    }
                }
            },
        };

        const myChart1 = new Chart(
            document.getElementById('myChart1'),
            config1
        );

        //myChart1.canvas.parentNode.style.height = '400px';
        //myChart1.canvas.parentNode.style.width = '800px';


         var labels2='{{$asseigmentProgress['chapterArray']}}';
         labels2=labels2.split(',');
        
        const data2 = {
            labels: labels2,
            datasets: [
                {
                label: 'Read',
                data: [{{$asseigmentProgress['percentgeReadArray']}}],
                backgroundColor: [
                'rgba(0, 177, 106, 1)',
                'rgba(0, 177, 106, 1)',
                'rgba(0, 177, 106, 1)',
                'rgba(0, 177, 106, 1)',
                'rgba(0, 177, 106, 1)',
                'rgba(0, 177, 106, 1)',
                'rgba(0, 177, 106, 1)'
                ],
                borderColor: [
                'rgb(0, 177, 106)',
                'rgb(0, 177, 106)',
                'rgb(0, 177, 106)',
                'rgb(0, 177, 106)',
                'rgb(0, 177, 106)',
                'rgb(0, 177, 106)',
                'rgb(0, 177, 106)'
                ],
                borderWidth: 1
            },
            {
                label: 'Assessment',
                data: [{{$asseigmentProgress['percentgeAssessmentArray']}}],
                backgroundColor: [
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)',
                'rgba(96, 7, 93, 1)'
                ],
                borderColor: [
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)',
                'rgb(96, 7, 93)'
                ],
                borderWidth: 1
            },
            {
                label: 'Total',
                data: [{{$asseigmentProgress['percentgeTotal']}}],
                backgroundColor: [
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)',
                'rgba(17, 110, 232, 1)'
                ],
                borderColor: [
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)',
                'rgb(17, 110, 232)'
                ],
                borderWidth: 1
            }
        ]
        };  

        const config2 = {
            type: 'bar',
            data: data2,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Courses Progress',
                        color: '#072F60',
                        font: {
                            size: 20,
                            weight: 'normal'                       
                        },
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Courses',
                            color: '#072f60',
                            font: {
                                size: 18,
                                style: 'normal',
                                lineHeight: 1.2
                            },
                            padding: {top: 7, left: 0, right: 0, bottom: 0}
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Percentage of Marks',
                            color: '#072f60',
                            position: 'relative',
                            left: '-20px',
                            font: {
                                size: 15,
                                style: 'normal',
                                lineHeight: 1.2
                            },
                            padding: {top: 0, left: 0, right: 30, bottom: 0}
                        }
                    }
                }
            },
        };

        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
        );

        //myChart2.canvas.parentNode.style.height = '400px';
        //myChart2.canvas.parentNode.style.width = '800px';

        
    </script>
@endsection
