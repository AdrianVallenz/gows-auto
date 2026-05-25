<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | Premium Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --main-bg: #0b0e14;
            --card-bg: #161b22;
            --accent-color: #58a6ff;
            --input-bg: #0d1117;
            --border-color: #30363d;
            --text-main: #c9d1d9;
            --text-dim: #8b949e;
        }

        body {
            background-color: var(--main-bg);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            padding-top: 50px;
        }

        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.5);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }

        .section-title::before {
            content: "";
            width: 4px;
            height: 20px;
            background: var(--accent-color);
            margin-right: 12px;
            border-radius: 2px;
        }

        .form-label {
            font-weight: 500;
            color: var(--text-dim);
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .form-control {
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            color: #ffffff !important;
            border-radius: 8px;
            padding: 10px 15px;
        }

        .form-control:focus {
            background-color: var(--input-bg);
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(88, 166, 255, 0.15);
        }

        .image-upload-wrapper {
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            background: rgba(255,255,255,0.02);
        }

        .btn-save {
            background-color: var(--accent-color);
            border: none;
            color: #0b0e14;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 8px;
        }

        .btn-reset {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-dim);
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
        }

        .alert-custom {
            background-color: rgba(248, 81, 73, 0.1);
            border: 1px solid rgba(248, 81, 73, 0.2);
            color: #ff7b72;
            font-size: 0.85rem;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="text-white mb-1">Create New Product</h3>
                    <p class="text-muted small">Kelola stok dan informasi produk Anda dengan mudah.</p>
                </div>

                <a href="{{ route('products.index') }}" class="btn btn-sm btn-reset">
                    ← Back
                </a>
            </div>

            <div class="card">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="section-title">Product Image</div>

                        <div class="mb-4">
                            <div class="image-upload-wrapper">
                                <input
                                    type="file"
                                    class="form-control @error('image') is-invalid @enderror"
                                    name="image"
                                    accept="image/png,image/jpeg,image/jpg,image/webp"
                                    required
                                >
                                <p class="text-muted small mt-2 mb-0">
                                    Format: JPG, JPEG, PNG, WEBP. Maksimal 2MB.
                                </p>
                            </div>

                            @error('image')
                                <div class="alert alert-custom mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4" style="border-color: var(--border-color);">

                        <div class="section-title">General Information</div>

                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="form-label">Product Title</label>
                                <input
                                    type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    name="title"
                                    value="{{ old('title') }}"
                                    placeholder="Contoh: Toyota Supra MK4"
                                    required
                                >

                                @error('title')
                                    <div class="alert alert-custom mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label">Description</label>
                                <textarea
                                    id="editor"
                                    class="form-control @error('description') is-invalid @enderror"
                                    name="description"
                                    rows="5"
                                    required
                                >{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="alert alert-custom mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Price (IDR)</label>

                                <div class="input-group">
                                    <span class="input-group-text" style="background: var(--main-bg); border-color: var(--border-color); color: var(--text-dim);">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        class="form-control @error('price') is-invalid @enderror"
                                        name="price"
                                        value="{{ old('price') }}"
                                        placeholder="0"
                                        min="0"
                                        required
                                    >
                                </div>

                                @error('price')
                                    <div class="alert alert-custom mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">Stock Inventory</label>
                                <input
                                    type="number"
                                    class="form-control @error('stock') is-invalid @enderror"
                                    name="stock"
                                    value="{{ old('stock') }}"
                                    placeholder="0"
                                    min="0"
                                    required
                                >

                                @error('stock')
                                    <div class="alert alert-custom mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <button type="reset" class="btn btn-reset px-4">
                                Reset Form
                            </button>

                            <button type="submit" class="btn btn-save px-5">
                                Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <footer class="text-center mt-5">
                <p class="text-muted small">&copy; 2026 Admin Portal. All rights reserved.</p>
            </footer>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.25.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>

</body>
</html>