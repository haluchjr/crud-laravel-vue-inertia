<?php

namespace App\Http\Controllers\Financeiro;

use App\Http\Controllers\Controller; 

use Illuminate\Http\Request;
use Inertia\Inertia;

class PedidoController extends Controller
{
    public function listar(){return Inertia::render('Producao/Index');}    

    public function novoPedido(){ 
        dd('novo pedido');
        return Inertia::render('Pedido/Index');
    }

    public function relatorioPedidos(){ 
        dd('relatorio pedidos');
        return Inertia::render('Pedido/Relatorio');
    }
    
    public function dashBoard(){ 
        // Simulando dados para o gráfico de linhas (Evolução de Vendas)
        $chartDataLine = [
            'labels' => ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
            'datasets' => [
                [
                    'label' => 'Produto A (2026)',
                    'backgroundColor' => '#3b82f6',
                    'borderColor' => '#3b82f6',
                    'tension' => 0.3,
                    'data' => [40, 25, 35, 50, 70, 85]
                ],
                [
                    'label' => 'Produto B (2026)',
                    'backgroundColor' => '#10b981',
                    'borderColor' => '#10b981',
                    'tension' => 0.3,
                    'data' => [20, 30, 25, 40, 55, 60]
                ],
                [
                    'label' => 'Média de Mercado',
                    'backgroundColor' => '#f59e0b',
                    'borderColor' => '#f59e0b',
                    'borderDash' => [5, 5],
                    'tension' => 0.3,
                    'data' => [30, 30, 30, 45, 50, 65]
                ]
            ]
        ];

        // Simulando dados para o gráfico de barras (Financeiro)
        $chartDataBar = [
            'labels' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            'datasets' => [
                [
                    'label' => 'Faturamento (R$)',
                    'backgroundColor' => '#0d6efd',
                    'borderRadius' => 4,
                    'data' => [12000, 19000, 15000, 25000, 22000, 30000]
                ],
                [
                    'label' => 'Custos (R$)',
                    'backgroundColor' => '#dc3545',
                    'borderRadius' => 4,
                    'data' => [8000, 11000, 9500, 14000, 12000, 18000]
                ]
            ]
        ];

        // Retorna a view do Inertia passando as props
        return Inertia::render('Financeiro/Dashboard', [
            'chartDataLine' => $chartDataLine,
            'chartDataBar' => $chartDataBar,
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
