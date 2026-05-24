<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gows Auto | Catalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        :root {
            --bg-dark: #050505;
            --card-dark: #111111;
            --accent: #00d1b2;
            --text-muted: #cacaca;
        }

        body {
            background-color: var(--bg-dark);
            color: white;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .navbar {
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #222;
        }

        .hero-section {
            padding: 100px 0 60px;
            text-align: center;
            background: radial-gradient(circle at center, #111 0%, #050505 100%);
        }

        .product-card {
            background: var(--card-dark);
            border: 1px solid #222;
            border-radius: 20px;
            transition: all 0.3s ease;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-10px);
            border-color: var(--accent);
            box-shadow: 0 10px 30px rgba(0, 209, 178, 0.1);
        }

        .img-container {
            height: 220px;
            overflow: hidden;
            border-radius: 18px 18px 0 0;
            background-color: #1a1a1a;
        }

        .btn-buy {
            background: var(--accent);
            color: #000;
            font-weight: 700;
            border-radius: 12px;
            width: 100%;
            border: none;
            transition: 0.3s;
        }

        .btn-buy:hover {
            background: #00f2cf;
            transform: scale(1.02);
        }

        .badge-stock {
            background: rgba(0, 209, 178, 0.1);
            color: var(--accent);
            font-size: 0.7rem;
            padding: 5px 12px;
            border-radius: 50px;
        }

        /* Modal Styling */
        .modal-content {
            background-color: #0f0f0f;
            border: 1px solid #222;
            border-radius: 24px;
        }
        .modal-header { border-bottom: 1px solid #222; }
        .modal-footer { border-top: 1px solid #222; }
        
        /* Memaksa teks deskripsi agar selalu terlihat */
        .product-description-content * {
            color: var(--text-muted) !important;
        }

        .product-description-content strong, 
        .product-description-content b, 
        .product-description-content h1, 
        .product-description-content h2 {
            color: white !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Gows<span style="color: var(--accent)">Auto</span></a>
            <div class="ms-auto">
                <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="fa-solid fa-lock me-1"></i> Admin Panel
                </a>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Koleksi <span style="color: var(--accent)">Terbaik</span> Kami</h1>
            <p class="text-muted">Temukan produk impian Anda dengan harga dan kualitas terbaik di kelasnya.</p>
        </div>
    </section>

    <div class="container mb-5">
        <div class="row g-4">
            @forelse ($products as $product)
                <div class="col-md-4 col-lg-3">
                    <div class="card product-card">
                        <div class="img-container">
                            <img src="{{ asset('products/'.$product->image) }}" class="w-100 h-100" style="object-fit: cover;" onerror="this.src='https://placehold.co/600x400/111/00d1b2?text=Image+Not+Found'">
                        </div>
                        <div class="card-body p-4 text-center">
                            <span class="badge-stock mb-2 d-inline-block">{{ $product->stock }} Ready Stock</span>
                            <h5 class="fw-bold mb-1">{{ $product->title }}</h5>
                            <p class="text-muted small mb-3 text-truncate">{{ strip_tags($product->description) }}</p>
                            <h4 class="fw-bold text-white mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h4>
                            
                            <button class="btn btn-buy" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $product->id }}">
                                BELI SEKARANG
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalDetail{{ $product->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Detail <span style="color: var(--accent)">Unit</span></h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <img src="{{ asset('products/'.$product->image) }}" class="img-fluid rounded-4 border border-secondary shadow" onerror="this.src='https://placehold.co/600x400/111/00d1b2?text=Image+Not+Found'">
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="fw-bold mb-1 text-white">{{ $product->title }}</h3>
                                        <p class="text-muted mb-3 small">SKU: #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</p>
                                        
                                        <div class="mb-4">
                                            <h6 class="text-white fw-bold"><i class="fa-solid fa-align-left me-2" style="color: var(--accent)"></i> Deskripsi</h6>
                                            <div class="text-muted product-description-content" style="font-size: 0.9rem; line-height: 1.6;">
                                                {!! $product->description !!}
                                            </div>
                                        </div>

                                        <div class="p-3 rounded-3 mb-4" style="background: rgba(255,255,255,0.05);">
                                            <p class="text-muted small mb-1">Harga Unit:</p>
                                            <h3 class="fw-bold mb-0" style="color: var(--accent)">Rp {{ number_format($product->price, 0, ',', '.') }}</h3>
                                            <p class="mb-0 mt-2 small text-white"><i class="fa-solid fa-circle-check text-success me-1"></i> Tersedia {{ $product->stock }} Unit</p>
                                        </div>

                                        <a href="https://wa.me/6283131593799?text=Halo%20GowsAuto,%20saya%20ingin%20bertanya%20tentang%20{{ urlencode($product->title) }}" target="_blank" class="btn btn-buy py-3">
                                            <i class="fa-brands fa-whatsapp me-2"></i> HUBUNGI VIA WHATSAPP
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fa-solid fa-car-side fa-3x mb-3 text-muted opacity-25"></i>
                    <p class="text-muted">Maaf, saat ini katalog produk sedang kosong.</p>
                </div>
            @endforelse
        </div>
    </div>

    <footer class="py-4 text-center border-top border-secondary mt-5">
        <p class="text-muted small">© 2026 GowsAuto. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>