@extends('.app')
@section('sidebar')
    <nav class="navbar navbar-inverse navbar-fixed-left">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Дата</a>
            </div>
            <div id="navbar" class="navbar-collapse">
                <ul class="nav navbar-nav">
                    @foreach($data as $year => $row)
                        <li>
                            <b>{{$year}} ({{$row['count']}})</b>
                            <ul class="ul">
                                @foreach($row['data'] as $month)
                                    <li><a href="/?y={{$year}}&m={{$month->month}}">{{$month->month_name}}-{{$year}}
                                            ({{$month->count_rows}})</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>
@stop