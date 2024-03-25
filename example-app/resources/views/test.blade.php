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
    <ul>
        @foreach ($items as $item)
            <li>
               id: {{ $item->id }} - name:{{ $item->name }} - des:{{ $item->description }}
            </li>

            <form method="POST" action="{{ route('items.update', $item->id) }}">
                @csrf
                @method('PUT')
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <label for="description">description:</label>
                    <input type="text" class="form-control" id="description" name="description">
                <button type="submit" class="btn btn-primary">Update Item</button>
            </form>
        @endforeach
    </ul>
@endif
@if ($errors->any())
    @endif
