<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $showBtn= "<a href='".route('admin.order.show', $query->id)."'class='btn btn-primary'><i class='far fa-eye'></i></a>";
                $deleteBtn= "<a href='".route('admin.order.destroy', $query->id)."'class='btn btn-danger ml-2 delete-item'><i class='fas fa-trash'></i></a>";


                return $showBtn.$deleteBtn;
            })
            ->addColumn('customer', function ($query) {
                return $query->user->name;
            })
            ->addColumn('date', function ($query) {
                return date('d-M-Y', strtotime($query->user->created_at));
            })
            ->addColumn('order_status', function ($query) {
                switch ($query->order_status) {
                    case 'pending':
                        return "<span class='badge bg-warning white_color' >pending</span>";
                        break;
                    case 'processed_and_ready_to_ship':
                        return "<span class='badge bg-info white_color' >processed</span>";
                        break;
                    case 'dropped_off':
                        return "<span class='badge bg-info white_color' >dropped off</span>";
                        break;
                    case 'shipped':
                        return "<span class='badge bg-info white_color' >shipped</span>";
                        break;
                    case 'out_for_delivery':
                        return "<span class='badge bg-primary white_color' >out delivery</span>";
                        break;
                    case 'delivered':
                        return "<span class='badge bg-success white_color' >delivered</span>";
                        break;
                    case 'cancelled':
                        return "<span class='badge bg-danger white_color' >cancelled</span>";
                        break;
                    default:
                        return "<span class='badge bg-warning white_color' >pending</span>";
                        break;

                }
            })
            ->addColumn('payment_status', function ($query) {
                if($query->payment_status===1){
                    return "<span class='badge bg-success white_color' >Complete</span>";
                }else{
                    return "<span class='badge bg-warning white_color'>Pending</span>";
                }
            })
            ->addColumn('amount', function($query){
                return $query->currency_icon.$query->amount;
            })
            ->rawColumns(['action', 'order_status', 'payment_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('order-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('invoice_id'),
            Column::make('customer'),
            Column::make('date')
                ->width(120),
            Column::make('product_qty')
                ->width(40),
            Column::make('amount'),
            Column::make('order_status')
                ->width(60),
            Column::make('payment_status'),
            Column::make('payment_method')
                ->width(50),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(180)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}
