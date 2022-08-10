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

        $orders = DB::table('orders')
            ->select(DB::raw('concat(managers.name, " ",managers.surname) as full_name'), 'categories.category as category', DB::raw('count(categories.category) as count'))
            ->join('managers', 'orders.manager_id', '=', 'managers.id')
            ->join('categories', 'orders.category_id', '=', 'categories.id')
            ->whereBetween('date_close', [$dateAt, $dateBy])
            ->groupBy('categories.category', 'managers.name', 'managers.surname')
            ->get();

        return view('report', [
            'orders' => $orders,
            'dateAt' => $dateAt,
            'dateBy' => $dateBy,
        ]);

    }

}
