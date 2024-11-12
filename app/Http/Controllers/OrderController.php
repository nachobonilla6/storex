<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Método para mostrar la lista de órdenes
    public function index()
    {
        // Obtener todas las órdenes del usuario autenticado
        $orders = Order::where('user_id', Auth::id())->get();

        // Retornar una vista con las órdenes
        return view('orders.index', compact('orders'));
    }

    // Método para mostrar el formulario de creación de una nueva orden
    public function create()
    {
        // Retornar una vista para crear una nueva orden
        return view('orders.create');
    }

    // Método para almacenar una nueva orden
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'total_price' => 'required|numeric|min:0',
            // Agrega otras validaciones necesarias, como productos, cantidades, etc.
        ]);

        // Crear la nueva orden
        $order = Order::create([
            'user_id' => Auth::id(), // Asigna el ID del usuario autenticado
            'status' => 'pending', // Estado por defecto
            'total_price' => $request->total_price, // Establece el precio total
        ]);

        // Redirigir a la lista de órdenes con un mensaje de éxito
        return redirect()->route('orders.index')->with('success', 'Orden creada con éxito.');
    }

    // Método para mostrar los detalles de una orden específica
    public function show(Order $order)
    {
        // Verifica si el usuario tiene acceso a la orden
        if ($order->user_id !== Auth::id()) {
            abort(403); // Acceso prohibido
        }

        return view('orders.show', compact('order'));
    }

    // Método para eliminar una orden
    public function destroy(Order $order)
    {
        // Verifica si el usuario tiene acceso a la orden
        if ($order->user_id !== Auth::id()) {
            abort(403); // Acceso prohibido
        }

        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Orden eliminada con éxito.');
    }
}
