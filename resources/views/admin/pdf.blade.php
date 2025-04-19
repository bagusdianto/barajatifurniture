<!DOCTYPE html>
<html>
<head>
    <title>Order PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        h1 {
            text-align: center;
        }

        img {
            margin-top: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

    <h1>Order Details</h1>

    <table>
        <tr>
            <th>Customer Name</th>
            <td>{{ $order->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $order->email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $order->phone }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $order->address }}</td>
        </tr>
        <tr>
            <th>User ID</th>
            <td>{{ $order->user_id }}</td>
        </tr>
        <tr>
            <th>Product Title</th>
            <td>{{ $order->product_title }}</td>
        </tr>
        <tr>
            <th>Price</th>
            <td>Rp {{ number_format($order->price, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>{{ $order->quantity }}</td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td>{{ $order->payment_status }}</td>
        </tr>
        <tr>
            <th>Product ID</th>
            <td>{{ $order->product_id }}</td>
        </tr>
    </table>

    <img height="250" width="450" src="product/{{ $order->image }}" alt="Product Image">

</body>
</html>
