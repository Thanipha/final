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
                    <span class="item-info">ID: {{ $item->id }} - Name:{{ $item->name }} - Description:{{ $item->description }}</span>
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
<style>
    body {
        font-family: itim,'Courier New', Courier, monospace;
        margin: 20px;
        background-color: #f8f9fa; /* เปลี่ยนสีพื้นหลัง */
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #fff; /* เปลี่ยนสีพื้นหลังของคอนเทนเนอร์ */
        padding: 20px;
        border-radius: 8px; /* เพิ่มขอบมนของคอนเทนเนอร์ */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* เพิ่มเงาใต้คอนเทนเนอร์ */
    }

    h1 {
        margin-bottom: 20px;
        color: #007bff; /* เปลี่ยนสีข้อความให้ตรงกับสีปุ่ม */
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
        background-color: #f0f0f0; /* เปลี่ยนสีพื้นหลังของรายการไอเทม */
        border-radius: 8px; /* เพิ่มขอบมนของรายการไอเทม */
    }

    .item-info {
        font-weight: bold;
        font-size: 16px;
    }

    .item-actions {
        margin-top: 10px;
    }

    .btn-primary {
        margin-top: 10px;
    }
</style>
