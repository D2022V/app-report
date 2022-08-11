<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('request');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), [
            "dateAt" => "string|date|required",
            "dateBy" => "string|date|required",
        ]);
        if (!$validator->errors()) {
            return redirect()->route('order.index')->withErrors($validator->errors())->withInput();
        }

        $dateAt = $request->input('dateAt');
        $dateBy = $request->input('dateBy');

        $collections = DB::table('orders')
            ->select(DB::raw('concat(managers.name, " ",managers.surname) as full_name'), 'categories.category as category', DB::raw('count(categories.category) as count'))
            ->join('managers', 'orders.manager_id', '=', 'managers.id')
            ->join('categories', 'orders.category_id', '=', 'categories.id')
            ->whereBetween('date_close', [$dateAt, $dateBy])
            ->groupBy('categories.category', 'managers.name', 'managers.surname')
            ->get();

        $managers = array_unique(array_column($collections->all(), 'full_name'));
        $orders = [];
        $sum_total = 0;
        foreach ($managers as $manager) {
            $list = [];
            foreach ($collections as $collection) {
                if ($manager === $collection->full_name) {
                    $list['full_name'] = $collection->full_name;
                    if ($collection->category === 'disconnected') {
                        $list['disconnected'] = $collection->count;
                    }
                    if ($collection->category === 'check/cheapening') {
                        $list['check/cheapening'] = $collection->count;
                    }
                    if ($collection->category === 'tech_question') {
                        $list['tech_question'] = $collection->count;
                    }
                    if ($collection->category === 'other') {
                        $list['other'] = $collection->count;
                    }

                }

            }
            $list['total'] = array_sum($list);
            $orders[] = $list;
            $sum_total += $list['total'];
        }

        return view('report', [
            'orders' => $orders,
            'dateAt' => $dateAt,
            'dateBy' => $dateBy,
            'sum_total' => $sum_total,
        ]);

    }

}
