@include('layouts.auth.header')
<a href="{{ route('login') }}"
    class="absolute top-6 left-6 z-50 flex items-center gap-2 text-gray-500 hover:text-emerald-600 font-semibold bg-white/80 backdrop-blur-md px-4 py-2 rounded-full shadow-sm border border-gray-100 transition-all hover:shadow-md hover:-translate-x-1 lg:bg-transparent lg:border-transparent lg:shadow-none lg:text-white lg:hover:text-emerald-300">
    <i class="fa-solid fa-arrow-left"></i> <span class="hidden sm:inline">Kembali ke Login</span>
</a>

<div class="hidden lg:flex w-1/2 relative items-center justify-center bg-gray-900">
    <img src="{{ asset('img/auth/auth.jpeg') }}" alt="Kebun Hidroponik"
        class="absolute inset-0 w-full h-full object-cover opacity-60">
    <div class="absolute inset-0 bg-gradient-to-t from-emerald-900 via-gray-900/60 to-transparent"></div>

    <div class="relative z-10 p-12 max-w-lg text-white fade-in">
        <h2 class="text-4xl font-extrabold mb-6 leading-tight">Pulihkan <span class="text-emerald-400">Akses
                Akunmu</span> dengan Mudah.</h2>
        <p class="text-gray-300 text-lg mb-10 leading-relaxed">Jangan khawatir jika kamu lupa kata sandi. Masukkan
            emailmu dan kami akan membantu mengamankan kembali kebun digitalmu di GM 200.</p>
    </div>
</div>

<div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 relative bg-white min-h-screen">

    <div class="glow-blob bg-emerald-100 w-[300px] h-[300px] top-[-50px] right-[-50px]"></div>
    <div class="glow-blob bg-teal-50 w-[400px] h-[400px] bottom-[-100px] left-[-100px]"></div>

    <div class="w-full max-w-md relative z-10 fade-in" style="animation-delay: 200ms;">

        <div class="lg:hidden flex justify-center mb-8">
            <a href="index.html" class="text-3xl font-extrabold flex items-center gap-2">
                <i class="fa-solid fa-leaf text-emerald-500 text-4xl"></i>
                <span class="text-gray-900 tracking-tight">GM <span class="text-emerald-500">200</span></span>
            </a>
        </div>

        <div class="text-center lg:text-left mb-10">
            <div class="hidden lg:flex items-center gap-2 mb-8">
                <i class="fa-solid fa-leaf text-emerald-500 text-3xl"></i>
                <span class="text-2xl font-extrabold text-gray-900 tracking-tight">GM 200</span>
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Lupa Kata Sandi?</h1>
            <p class="text-gray-500 text-sm">Masukkan alamat email yang terdaftar. Kami akan mengirimkan tautan
                untuk mengatur ulang kata sandi Anda ke email tersebut.</p>
        </div>

        <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <label for="email" class="text-sm font-bold text-gray-700">Email Terdaftar</label>
                <div class="relative input-group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-regular fa-envelope text-gray-400 input-icon transition-all duration-300"></i>
                    </div>
                    <input type="email" name="email" id="email" required placeholder="halo@gm200.id" autofocus
                        class="input-field w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white outline-none">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <button type="submit" id="submitBtn"
                class="w-full py-4 px-6 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-bold transition-all shadow-[0_4px_14px_rgba(16,185,129,0.4)] hover:shadow-[0_6px_20px_rgba(16,185,129,0.4)] hover:-translate-y-0.5 flex items-center justify-center gap-2 group">
                <span id="btnText">Kirim Tautan Reset</span>
                <i id="btnIcon"
                    class="fa-regular fa-paper-plane transition-transform group-hover:translate-x-1 group-hover:-translate-y-1"></i>
                <svg id="btnSpinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </button>

            <div class="text-center mt-6">
                <a href="{{ route('login') }}"
                    class="text-sm text-gray-500 hover:text-emerald-600 font-semibold transition-colors">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke halaman Masuk
                </a>
            </div>

        </form>

    </div>
</div>

<div id="toastContainer" class="fixed top-6 right-6 z-[100] flex flex-col gap-2 pointer-events-none"></div>

@include('layouts.auth.footer')
