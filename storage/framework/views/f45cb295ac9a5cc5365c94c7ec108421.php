<!DOCTYPE html>
<html>
<head>
    <title>Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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
    <h1 class="mb-4 text-center text-dark pt-4">Add Product</h1>

    <div class="d-flex justify-content-center align-items-center w-100">
        <form id="productForm">
            <div class="mb-3">
                <label for="product" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="product" name="product" required>
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity in Stock</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price per Item</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>

            <div class="text-center mb-4">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>

    <div class="mt-4 product-list">
        <div class="table-head">
            <h2>Product List</h2>
        </div>
        <div class="table-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Datetime Submitted</th>
                        <th scope="col">Total Value Number</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody id="list-table"></tbody>
                <tfoot>
                    <tr>
                        <td colspan="5"><strong>Total Sum:</strong></td>
                        <td id="total-number"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        function loadFoam() {
            $.ajax({
                url: "/products",
                method: "GET",
                success: function (data) {
                    let total_price = 0;
                    data.forEach(list => {
                        total_price += parseFloat(list.price) || 0;
                        $("#list-table").append(`
                            <tr>
                                <td>${list.product}</td>
                                <td>${list.quantity}</td>
                                <td>${list.price}</td>
                                <td>${list.date}</td>
                                <td>${list.total}</td>
                                <td><a href="/edit?id=${list.id}"><button type="button" class="btn btn-primary">Edit</button></a></td>
                            </tr>
                        `);
                    });
                    $("#total-number").text(total_price);
                }
            });
        }

        $(function() {
            loadFoam();

            $("#productForm").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/submit',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        product: $('#product').val(),
                        quantity: $('#quantity').val(),
                        price: $('#price').val()
                    },
                    success: function() {
                        $('#productForm')[0].reset();
                        $("#list-table").empty();
                        loadFoam();
                    },
                    error: function(error) {
                        console.error('Error:', error.responseJSON);
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Laravel\inventory-app\resources\views/home.blade.php ENDPATH**/ ?>