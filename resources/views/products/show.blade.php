<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details | Dark UI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        :root {
            --bg-body: #0a0a0a;
            --bg-card: #121212;
            --bg-table-row: #121212; 
            --accent-green: #00d1b2;
            --border-color: #2a2a2a;
            --text-main: #e0e0e0;
            --text-muted: #7a7a7a;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .page-header {
            padding: 50px 0 30px;
            text-align: center;
        }

        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .btn-add {
            background-color: var(--accent-green);
            color: #000;
            font-weight: 700;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
        }

        .btn-action {
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            background: transparent;
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            transition: 0.2s;
            text-decoration: none;
        }

        .product-img {
            width: 100%;
            max-height: 420px;
            object-fit: cover;
            border-radius: 16px;
            border: 1px solid var(--border-color);
        }

        .badge-custom {
            background: rgba(0, 209, 178, 0.1);
            color: var(--accent-green);
            border: 1px solid rgba(0, 209, 178, 0.2);
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
        }
    </style>
</head>
<body>

<div class="page-header">
    <h3 class="fw-bold text-white">
        DETAIL <span style="color: var(--accent-green)">PRODUK</span>
    </h3>
    <p class="text-muted small">Melihat informasi rinci inventaris.</p>
</div>

<div class="container mb-5">
    <div class="card">
        <div class="p-4 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid var(--border-color)">
            <h6 class="mb-0 fw-bold">
                <i class="fa-solid fa-info-circle me-2"></i>Product Information
            </h6>

            <a href="{{ route('products.index') }}" class="btn btn-add">
                <i class="fa-solid fa-arrow-left me-1"></i> BACK TO LIST
            </a>
        </div>

        <div class="p-4">
            <div class="row g-4">
                <div class="col-md-5">
                    <img
                        src="{{ asset('storage/products/'.$product->image) }}"
                        class="product-img"
                        onerror="this.src='https://placehold.co/600x400/111/00d1b2?text=No+Image'"
                        alt="{{ $product->title }}"
                    >
                </div>

                <div class="col-md-7">
                    <h3 class="fw-bold text-white mb-2">
                        {{ $product->title }}
                    </h3>

                    <p class="text-muted small mb-3">
                        SKU: #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}
                    </p>

                    <div class="mb-3">
                        <span class="badge-custom">
                            {{ $product->stock }} Units
                        </span>
                    </div>

                    <h4 class="fw-bold mb-4" style="color: var(--accent-green);">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </h4>

                    <h6 class="text-white">Description:</h6>

                    <div class="text-muted mb-4">
                        {!! $product->description !!}
                    </div>

                    <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" action="{{ route('products.destroy', $product->id) }}" method="POST">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-action mx-1" title="Edit">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-action text-danger" title="Delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>