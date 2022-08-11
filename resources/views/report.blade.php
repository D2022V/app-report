@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h2>Ваш отчет за период с {{ $dateAt}} по {{ $dateBy}}: </h2>
        <table class="table table-bordered table-sm table-striped table-hover ">
            <thead class="table-info text-center">
            <tr>
                <th rowspan="2" width="350px">Ф.И.О</th>
                <th colspan="4">Категории</th>
                <th rowspan="2">Всего</th>
            </tr>
            <tr>
                <th>Отключение</th>
                <th>Проверка/удешевление</th>
                <th>Тех. вопрос</th>
                <th>Прочее</th>
            </tr>
            </thead>
            <tbody class="table-light table-bordered text-center">
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order['full_name'] }}</td>
                        <td>{{ $order['disconnected'] }}</td>
                        <td>{{ $order['check/cheapening'] }}</td>
                        <td>{{ $order['tech_question'] }}</td>
                        <td>{{ $order['other'] }}</td>
                        <td style="font-weight: bold">{{ $order['total'] }}</td>
                    </tr>

                @endforeach
                @if(!empty($sum_total))
                    <tr>
                        <td colspan="5"></td>
                        <td style="font-weight: bold" class="table-dark">{{ $sum_total }}</td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>

@endsection

