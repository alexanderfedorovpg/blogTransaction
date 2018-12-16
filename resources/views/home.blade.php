@extends('.app')
@include('sidebar',['data'])
@section('content')
    <section class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Номер карты</th>
                <th scope="col">Дата</th>
                <th scope="col">Объем</th>
                <th scope="col">Услуга</th>
                <th scope="col">ID заправочной станции</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($rows))
                @foreach($rows as $row)
                    <tr>
                        <th scope="row">{{$row->id}}</th>
                        <td>{{$row->card_number}}</td>
                        <td>{{$row->date}}</td>
                        <td>{{$row->volume}}</td>
                        <td>{{$row->service}}</td>
                        <td>{{$row->address_id}}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </section>
@stop