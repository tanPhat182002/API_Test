<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test API - Product List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Product List</h2>
        <p>This table displays the list of products fetched from the API using Axios.</p>
        <table class="table">
            <thead>
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Mô tả</th>
                    <th>Ảnh</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
                <!-- Product data will be inserted here -->
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            axios.get('http://127.0.0.1:8000/api/products')
                .then(function (response) {
                    console.log('API Response:', response.data);
                    const data = response.data;
                    const tableBody = document.getElementById('productTableBody');
                    
                    // Check if data is an array
                    if (Array.isArray(data)) {
                        data.forEach(product => {
                            const row = `
                                <tr>
                                    <td>${product.name}</td>
                                    <td>${product.price}</td>
                                    <td>${product.description || 'N/A'}</td>
                                    <td>${product.image ? `<img src="${product.image}" alt="${product.name}" style="max-width: 100px;">` : 'No image'}</td>
                                </tr>
                            `;
                            tableBody.innerHTML += row;
                        });
                    } else if (typeof data === 'object' && data !== null) {
                        // If data is an object, it might be paginated or have a different structure
                        const products = data.data || data.products || Object.values(data);
                        if (Array.isArray(products)) {
                            products.forEach(product => {
                                const row = `
                                    <tr>
                                        <td>${product.name}</td>
                                        <td>${product.price}</td>
                                        <td>${product.description || 'N/A'}</td>
                                        <td>${product.image ? `<img src="${product.image}" alt="${product.name}" style="max-width: 100px;">` : 'No image'}</td>
                                    </tr>
                                `;
                                tableBody.innerHTML += row;
                            });
                        } else {
                            throw new Error('Unexpected data structure');
                        }
                    } else {
                        throw new Error('Unexpected data type');
                    }
                })
                .catch(function (error) {
                    console.error('There was a problem with the axios request:', error);
                    const tableBody = document.getElementById('productTableBody');
                    tableBody.innerHTML = `<tr><td colspan="4">Error loading products: ${error.message}</td></tr>`;
                });
        });
    </script>
</body>
</html>