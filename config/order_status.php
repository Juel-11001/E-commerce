<?php
return [
    'order_status_admin'=> [
        'pending' =>[
            'status'=> 'Pending',
            'details' => 'Your order is currently pending'
        ],
        'processed_and_ready_to_ship'=>[
            'status'=> 'Processed and ready to ship',
            'details' => 'Your package has been processed and will be with our devlivery partner soon'
        ],
        'dropped_off'=>[
            'status'=> 'Dropped off',
            'details' => 'Your package has been delivered to your doorstep'
        ],
        'shipped'=>[
            'status'=> 'Shipped',
            // 'details' => 'Your package has been shipped and is on its way'
            'details'=> 'Your package has arrived at our logistics facility'
        ],
        'out_for_delivery' =>[
            'status'=> 'Out for delivery',
            'details' => 'Our delivery partner will attempt to delivery your package'
        ],
        'delivered'=>[
            'status'=> 'Delivered',
            'details' => 'Your package has been delivered to your destination'
        ],
        'cancelled'=>[
            'status'=> 'Cancelled',
            'details' => 'Your order has been cancelled'
        ],

    ],
    //vendor order_status:
        'order_status_vendor'=> [
        'pending' =>[
            'status'=> 'Pending',
            'details' => 'Your order is currently pending'
        ],
        'processed_and_ready_to_ship'=>[
            'status'=> 'Processed and ready to ship',
            'details' => 'Your package has been processed and will be with our devlivery partner soon'
        ]

    ]
];
