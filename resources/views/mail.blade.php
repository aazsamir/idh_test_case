<html>

<head>

</head>

<body>
    <p>
        New product was added<br>
        <b>Name:</b> {{ $product->name }}<br>
        <b>Description:</b> {{ $product->description }}<br>
        <b>Price:</b> {{ $product->price }}<br>
        <b>Created at</b> {{ $product->created_at }}<br>
    </p>
</body>

</html>
