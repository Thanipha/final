<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Management</title>
    <style>
        body {
            font-family: Itim, cursive;
            margin: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            color: #007bff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .alert {
            margin-bottom: 15px;
        }

        ul.item-list {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f0f0f0;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start; /* Align items to the top */
        }

        .item-info {
            font-weight: bold;
            font-size: 16px;
            flex-grow: 1; /* Allow the item-info to grow to take available space */
            margin-right: 10px; /* Add margin to separate item-info from item-actions */
        }

        .item-actions {
            display: flex;
            gap: 10px;
            align-items: center; /* Align items vertically */
        }

        .btn {
            padding: 5px 10px;
            border-radius: 5px;
            min-width: 80px; /* ปรับขนาดเพื่อให้ Edit และ Delete มีขนาดเท่ากัน */
        }

        .item-actions {
            display: flex;
            gap: 10px;
            align-items: center; /* จัดให้ปุ่ม Edit และ Delete อยู่ในระดับเดียวกัน */
        }

        .item-actions form {
            display: flex;
            gap: 10px;
            align-items: center; /* จัดให้ปุ่ม Edit และ Delete อยู่ในระดับเดียวกัน */
        }


        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create Item</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('items.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Item</button>
        </form>

        <h1>All Items</h1>

        @if ($items->isEmpty())
            <p>No items found.</p>
        @else
            <ul class="item-list">
                @foreach ($items as $item)
                    <li>
                        <span class="item-info">ID : {{ $item->id }}</span><br>
                        <span class="item-info">Name : {{ $item->name }}</span><br>
                        <span class="item-info">Description : {{ $item->description }}</span><br>
                        <div class="item-actions">
                            <form method="POST" action="{{ route('items.update', $item->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <input type="text" class="form-control" id="description" name="description">
                                </div>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>

                            <form method="POST" action="{{ route('items.delete', $item->id) }}" onsubmit="return confirm('Do you want to delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</body>

</html>
