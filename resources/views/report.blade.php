@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <h2>Ваш отчет за период с {{$dateAt}} по {{$dateBy}}: </h2>
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
                    <td>{{ $order->full_name }}</td>

                    @if($order->category === 'disconnected')
                        <td>{{ $order->count }}</td>
                    @else
                        <td></td>
                    @endif

                    @if($order->category === 'check/cheapening')
                        <td>{{ $order->count }}</td>
                    @else
                        <td></td>
                    @endif

                    @if($order->category === 'tech_question')
                        <td>{{ $order->count }}</td>
                    @else
                        <td></td>
                    @endif

                    @if($order->category === 'other')
                        <td>{{ $order->count }}</td>
                    @else
                        <td></td>
                    @endif

                    <td>{{ $order->count }}</td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection

