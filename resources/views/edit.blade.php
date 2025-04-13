<!DOCTYPE html>
<html>
<head>
    <title>Edit Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<style>
    .product-list {
        width: calc(100% - 60px);
        background-color: #ffffff;
        border-radius: 16px;
        margin: 0 30px;
    }

    .product-list .table-head {
        padding-top: 20px;
    }

    .product-list .table-head h2 {
        padding-left: 20px;
        font-size: 24px;
        color: #072635;
        font-weight: bold;
    }

    .table-body  {
        padding: 10px 20px;
    }

    .form-control {
        width: 400px;
    }
</style>
<body class="py-4 bg-light">
    <h1 class="mb-4 text-center text-dark pt-4">Edit {{ $product_id['product'] }} Product</h1>

    <div class="d-flex justify-content-center align-items-center w-100">
        <form action="/edit?id={{ $product_id['id'] }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="product" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product" name="product" value="{{ $product_id['product'] }}" required>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity in Stock</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product_id['quantity'] }}" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price per Item</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $product_id['price'] }}" required>
            </div>

            <div class="text-center mb-4">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>