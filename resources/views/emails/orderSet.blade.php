<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Email Template</title>
    <style>
        table {
            /*width: 100%;*/
            border-collapse: collapse; /* Collapse borders into a single border */
        }
        th, td {
            border: 1px solid black; /* Solid border for all table cells */
            padding: 8px; /* Padding inside table cells */
            text-align: left; /* Align text to the left */
        }


        th {
            background-color: #f2f2f2; /* Light grey background for header cells */
        }
    </style>
</head>

<body style="font-family: 'Poppins', Arial, sans-serif">


Hello ,{{$order->user->name}}
<br>
<br>
your order has been set successfully with number <b> {{$order->order_number}}</b>
<br>
<br>

Total price : {{$order->total_amount}}
<br>
<br>
<table>

    <thead>

    <tr>
        <th>
            Product name
        </th>
        <th>
            Quantity
        </th>
        <th>
            Price for unit
        </th><th>
            total price
        </th>
    </tr>
    </thead>
    <tbody>

    @foreach($order->order_items as $orderItem )
        <tr>
            <td class="product-name">
                {{$orderItem->product->name}}
            </td>
            <td>{{$orderItem->quantity}}</td>
            <td>{{$orderItem->product->price}}</td>
            <td>{{$orderItem->product->price * $orderItem->quantity}}</td>

        </tr>
    @endforeach
    </tbody>
</table>

</body>

</html>
