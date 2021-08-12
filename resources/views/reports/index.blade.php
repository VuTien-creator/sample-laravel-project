@extends('layouts.main')
@section('main')
<script src="{{ asset('public/js/Chart.min.js') }}"></script>
            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Place Capacity</h2>
                </div>
            </div>

            <canvas id="myChart"></canvas>

            <script>
                let sessions = @JSON($sessions);
                // console.log(sessions);

                let color = [],
                    capacity=[],
                    citizen=[],
                    title=[];

                    sessions.forEach(session=>{
                        capacity.push(session.capacity);
                        citizen.push(session.citizen);
                        title.push(session.title);
                        if(parseInt(session.citizen)>= parseInt(session.capacity)){
                            color.push('#ff0000');
                        }else{
                            color.push('#00ff00');
                        }
                    })
                    console.log(capacity);
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var chart = new Chart(ctx,{
                        type:'bar',
                        data:{
                            labels:title,
                            datasets:[
                                {
                                    data:citizen,
                                    label:'citizen',
                                    backgroundColor:color,
                                    borderColor:'#ff0000'
                                },
                                {
                                    data:capacity,
                                    label:'capacity',
                                    backgroundColor:'#0000ff',
                                    borderColor:'#ff0000'
                                }
                            ]
                        },
                        options:{}
                    })
            </script>
            <!-- TODO create chart here -->

@endsection
