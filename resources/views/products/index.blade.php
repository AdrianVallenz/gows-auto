<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management | Dark UI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

        body { background-color: var(--bg-body); color: var(--text-main); font-family: 'Plus Jakarta Sans', sans-serif; }
        .page-header { padding: 50px 0 30px; text-align: center; }
        .card { background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .table { --bs-table-bg: transparent; --bs-table-color: var(--text-main); --bs-table-border-color: var(--border-color); --bs-table-hover-bg: #1a1a1a; margin-bottom: 0; }
        .table thead th { background-color: #161616 !important; color: var(--text-muted) !important; border-bottom: 2px solid var(--border-color) !important; padding: 18px; font-size: 0.8rem; letter-spacing: 1px; }
        .table tbody td { background-color: var(--bg-table-row) !important; border-bottom: 1px solid var(--border-color) !important; padding: 16px; vertical-align: middle; }
        .btn-add { background-color: var(--accent-green); color: #000; font-weight: 700; border: none; padding: 10px 20px; border-radius: 10px; transition: 0.3s; text-decoration: none; display: inline-block; }
        .btn-add:hover { background-color: #00f2cf; box-shadow: 0 0 15px rgba(0, 209, 178, 0.4); color: #000; }
        .btn-action { border: 1px solid var(--border-color); color: var(--text-muted); background: transparent; width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; transition: 0.2s; }
        .btn-action:hover { color: #fff; border-color: var(--text-muted); background: rgba(255,255,255,0.05); }
        .img-wrapper { width: 80px; height: 55px; border-radius: 8px; overflow: hidden; border: 1px solid var(--border-color); }
        .badge-custom { background: rgba(0, 209, 178, 0.1); color: var(--accent-green); border: 1px solid rgba(0, 209, 178, 0.2); padding: 5px 10px; border-radius: 6px; font-size: 0.75rem; }
    </style>
</head>
<body>

    <div class="page-header">
        <h3 class="fw-bold text-white">CATALOGUE <span style="color: var(--accent-green)">STOK</span></h3>
        <p class="text-muted small">Kelola data inventaris Anda dengan tampilan gelap yang nyaman.</p>
    </div>

    <div class="container mb-5">
        <div class="card">
            <div class="p-4 d-flex justify-content-between align-items-center" style="border-bottom: 1px solid var(--border-color)">
                <h6 class="mb-0 fw-bold"><i class="fa-solid fa-list me-2"></i>Product List</h6>
                <a href="{{ route('products.create') }}" class="btn btn-add">
                    <i class="fa-solid fa-plus me-1"></i> NEW PRODUCT
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>IMAGE</th>
                            <th>PRODUCT DETAILS</th>
                            <th class="text-end">PRICE</th>
                            <th class="text-center">STOCK</th>
                            <th class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    <div class="img-wrapper">
                                        <img src="{{ asset('/storage/products/'.$product->image) }}" class="w-100 h-100" style="object-fit: cover;">
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-white mb-0">{{ $product->title }}</div>
                                    <small class="text-muted">SKU: #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</small>
                                </td>
                                <td class="text-end fw-bold text-white">
                                    {{ "Rp " . number_format($product->price,0,',','.') }}
                                </td>
                                <td class="text-center">
                                    <span class="badge-custom">{{ $product->stock }} Units</span>
                                </td>
                                <td class="text-center">
                                    <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-action" title="View"><i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-action mx-1" title="Edit"><i class="fa-solid fa-pen"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-action text-danger" title="Delete" onclick="confirmDelete({{ $product->id }})">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-3 opacity-20"></i>
                                    <p>Belum ada produk yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Hapus Produk?',
                text: "Data akan hilang selamanya, dawg!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#00d1b2',
                cancelButtonColor: '#ff3860',
                confirmButtonText: 'Ya, Sikat!',
                cancelButtonText: 'Batal',
                background: '#121212',
                color: '#fff'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }

        // Notifikasi Sukses
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Mantap!',
                text: "{{ session('success') }}",
                background: '#121212',
                color: '#fff',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>