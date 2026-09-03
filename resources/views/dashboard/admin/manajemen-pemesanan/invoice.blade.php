<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pesanan | GM 200 Hydroponik</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            400: '#34d399',
                            500: '#10B981',
                            600: '#059669',
                            900: '#065F46'
                        },
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #F3F4F6;
            /* Gray 100 background to make the white receipt pop */
            color: #1F2937;
        }

        .border-dashed-receipt {
            border-bottom: 2px dashed #E5E7EB;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background-color: #FFFFFF;
            }

            .print-shadow-none {
                box-shadow: none !important;
                border: 1px solid #E5E7EB;
            }

            .print-bg-transparent {
                background: transparent !important;
            }
        }
    </style>
</head>

<body class="antialiased relative min-h-screen flex flex-col items-center py-10 px-4 sm:px-6">
    @php
        $canEditReview = false;

        if ($review) {
            $created = \Carbon\Carbon::parse($review->created_at);
            $canEditReview = $created->diffInHours(now()) <= 24;
        }
    @endphp

    <div class="absolute top-0 left-0 w-full h-96 bg-emerald-500 rounded-b-full z-0 print-bg-transparent"></div>


    <div class="relative z-10 w-full max-w-lg mx-auto">


        <div class="bg-white rounded-3xl shadow-2xl print-shadow-none overflow-hidden pb-8">


            <div class="p-6 sm:p-8 flex justify-between items-start">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-leaf text-emerald-500 text-2xl sm:text-3xl"></i>
                    <div class="leading-tight">
                        <span class="text-lg sm:text-xl font-extrabold text-gray-900 tracking-tight block">GM <span
                                class="text-emerald-500">200</span></span>
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Hydroponics</span>
                    </div>
                </div>
                <h2 class="text-2xl font-extrabold text-emerald-500 tracking-tight">Invoice</h2>
            </div>


            <div class="px-6 sm:px-8 text-right mb-6">
                <p class="text-sm text-gray-600 font-medium">No Nota <span class="font-bold text-gray-900"
                        id="inv-id"> #INV-{{ $order->id }}
                    </span></p>
                <p class="text-sm text-gray-500">
                    Tanggal: {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y H:i') }}
                </p>
            </div>


            <div class="px-6 sm:px-8 mb-8">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 mb-4">GM 200 Hydroponik</h1>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Halo, <span class="font-bold text-gray-900" id="inv-name"><span class="font-bold text-gray-900">
                            {{ $order->name }}
                        </span></span>.<br>
                    Terima kasih telah mempercayakan kebutuhan sayur sehat Anda kepada kami.
                </p>
            </div>


            <div class="px-6 sm:px-8 grid grid-cols-2 gap-6 mb-8">

                <div>
                    <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">Billing Information
                    </h3>
                    <p class="text-sm font-bold text-gray-900 mb-1">
                        {{ $order->name }}
                    </p>
                    <p class="text-sm text-gray-600 leading-tight mb-2">
                        {{ $order->address }}
                    </p>
                    <p class="text-sm text-emerald-600 font-medium" id="bill-phone">No: {{ $order->phone }}</p>
                    <p class="text-xs text-gray-500 mt-2 italic" id="bill-note">Catatan: {{ $order->note ?? '-' }}</p>
                </div>


                <div class="text-right">
                    <h3 class="text-xs font-extrabold text-gray-400 uppercase tracking-wider mb-2">Payment Method</h3>
                    <p class="text-sm font-bold text-gray-900 mb-1">QRIS</p>
                    <p class="text-sm text-gray-600 mb-2">Status:
                        <span
                            class="
inline-block px-2 py-0.5 rounded text-xs font-bold uppercase tracking-wider
{{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
{{ $order->status == 'dibayar' ? 'bg-blue-100 text-blue-700' : '' }}
{{ $order->status == 'dikirim' ? 'bg-indigo-100 text-indigo-700' : '' }}
{{ $order->status == 'selesai' ? 'bg-green-100 text-green-700' : '' }}
">
                            {{ $order->status }}
                        </span>
                    </p>
                    <p class="text-sm text-gray-600 mt-2">
                        Review:
                        @if ($review)
                            <span class="text-green-600 font-bold">Sudah</span>
                        @else
                            <span class="text-gray-400">Belum</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="px-6 sm:px-8">
                <div class="border-dashed-receipt mb-4"></div>
            </div>


            <div class="px-6 sm:px-8 mb-6">

                <div class="flex text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">
                    <div class="w-1/2">Nama Barang</div>
                    <div class="w-1/6 text-center">Qty</div>
                    <div class="w-1/3 text-right">Harga Total</div>
                </div>


                <div class="space-y-4">
                    @foreach ($order->items as $item)
                        <div class="flex text-sm items-center">


                            <div class="w-1/2 font-semibold text-gray-800">
                                {{ $item->product->name }}
                            </div>


                            <div class="w-1/6 text-center text-gray-600">
                                x{{ $item->quantity }}
                            </div>


                            <div class="w-1/3 text-right font-bold text-gray-900">
                                Rp {{ number_format($item->price * $item->quantity) }}
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="px-6 sm:px-8">
                <div class="border-dashed-receipt mb-6"></div>
            </div>
            @php
                $subtotal = $order->items->sum(fn($i) => $i->price * $i->quantity);
            @endphp
            @if (session('success'))
                <div id="successAlert"
                    class="fixed bottom-6 left-6 bg-emerald-500 text-white px-6 py-3 rounded-xl shadow-xl z-50 transition-all duration-500 opacity-0 translate-y-4">

                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="px-6 sm:px-8 space-y-3 mb-8">
                <div class="flex justify-end items-center gap-8 text-sm">
                    <span class="text-gray-500 w-24 text-right">Sub Total</span>
                    <span class="font-semibold text-gray-900 w-24 text-right" id="calc-subtotal"><span
                            class="font-semibold text-gray-900 w-24 text-right">
                            Rp {{ number_format($subtotal) }}
                        </span></span>
                </div>
                <div class="flex justify-end items-center gap-8 text-base pt-2">
                    <span class="font-extrabold text-gray-900 w-24 text-right">Total Harga</span>
                    <span class="font-extrabold text-emerald-600 w-24 text-right" id="calc-total"><span
                            class="font-extrabold text-emerald-600 w-24 text-right">
                            Rp {{ number_format($subtotal) }}
                        </span></span>
                </div>
            </div>


            <div class="px-6 sm:px-8 text-center bg-gray-50/50 py-6 mx-4 rounded-2xl">
                <i class="fa-solid fa-heart text-emerald-500 mb-2"></i>
                <p class="text-sm font-bold text-gray-900">Terima Kasih!</p>
                <p class="text-xs text-gray-500 mt-1">Struk ini adalah bukti pembayaran yang sah.</p>
            </div>

        </div>



    </div>


    @if ($order->status === 'selesai')
        @if (!$review)
            <button onclick="openReview()"
                class="fixed bottom-6 right-6 bg-emerald-500 hover:bg-emerald-600 text-white w-14 h-14 rounded-full shadow-xl flex items-center justify-center z-50 transition">
                <i class="fas fa-star text-xl"></i>
            </button>
        @elseif ($canEditReview)
            <button onclick="openReview()"
                class="fixed bottom-6 right-6 bg-yellow-500 hover:bg-yellow-600 text-white w-14 h-14 rounded-full shadow-xl flex items-center justify-center z-50 transition">
                <i class="fas fa-edit text-xl"></i>
            </button>
        @endif
    @endif


    <div id="reviewOverlay" class="fixed inset-0 bg-black/40 hidden z-50 flex items-center justify-center">

        <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl">

            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg">Beri Review</h3>
                <button onclick="closeReview()">✕</button>
            </div>
            <form action="{{ route('review.store') }}" method="POST">
                @csrf

                <input type="hidden" name="order_id" value="{{ $order->id }}">

                <input type="text" name="name" value="{{ $review->name ?? $order->name }}"
                    class="w-full mb-3 border rounded-lg p-2">

                <input type="text" name="phone" value="{{ $review->phone ?? $order->phone }}"
                    class="w-full mb-3 border rounded-lg p-2">

                <select name="rating" class="w-full border rounded-lg p-2 mb-3">
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}"
                            {{ isset($review) && $review->rating == $i ? 'selected' : '' }}>
                            {{ str_repeat('⭐', $i) }}
                        </option>
                    @endfor
                </select>

                <textarea name="review" placeholder="Berikan testimonimu..." class="w-full border rounded-lg p-2 mb-3">{{ $review->review ?? '' }}</textarea>

                <input type="hidden" name="tampil" value="ya">

                @if ($review && !$canEditReview)
                    <div class="text-red-500 text-sm mb-2">
                        ❌ Review sudah tidak bisa diedit (lebih dari 24 jam)
                    </div>
                @endif

                <button class="w-full bg-emerald-500 text-white py-2 rounded-lg"
                    {{ $review && !$canEditReview ? 'disabled' : '' }}>
                    Simpan Review
                </button>
            </form>

        </div>
    </div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alertBox = document.getElementById('successAlert');

        if (alertBox) {

            setTimeout(() => {
                alertBox.classList.remove('opacity-0', 'translate-y-4');
            }, 100);


            setTimeout(() => {
                alertBox.classList.add('opacity-0', 'translate-y-4');
            }, 2000);


            setTimeout(() => {
                alertBox.remove();
            }, 2500);
        }
    });

    function openReview() {
        document.getElementById('reviewOverlay').classList.remove('hidden');
    }

    function closeReview() {
        document.getElementById('reviewOverlay').classList.add('hidden');
    }
</script>

</html>
