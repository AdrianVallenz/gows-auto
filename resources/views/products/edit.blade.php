<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | Dark UI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #0a0a0a;
            color: #e0e0e0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .card {
            background-color: #121212;
            border: 1px solid #2a2a2a;
            border-radius: 16px;
        }

        .form-control {
            background-color: #1a1a1a;
            border: 1px solid #2a2a2a;
            color: #fff;
        }

        .form-control:focus {
            background-color: #1a1a1a;
            color: #fff;
            border-color: #00d1b2;
            box-shadow: none;
        }

        .btn-update {
            background-color: #00d1b2;
            color: #000;
            font-weight: 700;
            border: none;
        }

        .preview-img {
            width: 180px;
            height: 120px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #2a2a2a;
        }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm rounded">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-white mb-4">EDIT PRODUCT</h4>

                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="fw-bold text-muted mb-2">CURRENT IMAGE</label>
                            <br>
                            <img
                                src="{{ asset('storage/products/'.$product->image) }}"
                                class="preview-img mb-3"
                                onerror="this.src='https://placehold.co/300x220/111/00d1b2?text=No+Image'"
                                alt="{{ $product->title }}"
                            >
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold text-muted mb-2">NEW IMAGE</label>
                            <input
                                type="file"
                                class="form-control @error('image') is-invalid @enderror"
                                name="image"
                                accept="image/png,image/jpeg,image/jpg,image/webp"
                            >

                            <small class="text-secondary">
                                Biarkan kosong jika tidak ingin mengubah gambar.
                            </small>

                            @error('image')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold text-muted mb-2">TITLE</label>
                            <input
                                type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                name="title"
                                value="{{ old('title', $product->title) }}"
                                placeholder="Masukkan Judul Produk"
                                required
                            >

                            @error('title')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-bold text-muted mb-2">DESCRIPTION</label>
                            <textarea
                                class="form-control @error('description') is-invalid @enderror"
                                name="description"
                                rows="5"
                                placeholder="Masukkan Deskripsi Produk"
                                required
                            >{{ old('description', $product->description) }}</textarea>

                            @error('description')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold text-muted mb-2">PRICE</label>
                                    <input
                                        type="number"
                                        class="form-control @error('price') is-invalid @enderror"
                                        name="price"
                                        value="{{ old('price', $product->price) }}"
                                        placeholder="Masukkan Harga Produk"
                                        min="0"
                                        required
                                    >

                                    @error('price')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="fw-bold text-muted mb-2">STOCK</label>
                                    <input
                                        type="number"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        name="stock"
                                        value="{{ old('stock', $product->stock) }}"
                                        placeholder="Masukkan Stok Produk"
                                        min="0"
                                        required
                                    >

                                    @error('stock')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-update me-2 p-2 px-4">
                            UPDATE
                        </button>

                        <a href="{{ route('products.index') }}" class="btn btn-dark p-2 px-4">
                            BACK
                        </a>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>