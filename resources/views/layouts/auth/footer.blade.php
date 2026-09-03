   <script>
       // 1. Fungsi Lihat/Sembunyikan Kata Sandi
       function togglePassword() {
           const passwordInput = document.getElementById('password');
           const toggleIcon = document.getElementById('toggleIcon');

           if (passwordInput.type === 'password') {
               passwordInput.type = 'text';
               toggleIcon.classList.remove('fa-eye-slash');
               toggleIcon.classList.add('fa-eye', 'text-emerald-500');
           } else {
               passwordInput.type = 'password';
               toggleIcon.classList.remove('fa-eye', 'text-emerald-500');
               toggleIcon.classList.add('fa-eye-slash');
           }
       }

       // 2. Fungsi Simulasi Login dengan Loading State
       function handleLogin(event) {
           event.preventDefault(); // Mencegah reload halaman

           const btnText = document.getElementById('btnText');
           const btnIcon = document.getElementById('btnIcon');
           const btnSpinner = document.getElementById('btnSpinner');
           const submitBtn = document.getElementById('submitBtn');

           // Set state ke "Loading"
           submitBtn.disabled = true;
           submitBtn.classList.add('opacity-90', 'cursor-not-allowed');
           btnText.textContent = 'Memverifikasi...';
           btnIcon.classList.add('hidden');
           btnSpinner.classList.remove('hidden');

           // Simulasi proses API Call (1.5 detik)
           setTimeout(() => {
               // Kembalikan tombol ke state awal
               submitBtn.disabled = false;
               submitBtn.classList.remove('opacity-90', 'cursor-not-allowed');
               btnText.textContent = 'Masuk ke Akun';
               btnIcon.classList.remove('hidden');
               btnSpinner.classList.add('hidden');

               // Munculkan Notifikasi Berhasil
               showToast('Login berhasil! Mengalihkan ke Dashboard...', 'fa-circle-check', 'bg-emerald-500');

               // Hapus isi input (opsional, karena ini hanya simulasi)
               document.getElementById('email').value = '';
               document.getElementById('password').value = '';

               // Simulasi Redirect (Bisa diganti `window.location.href = 'dashboard.html'`)
               /* setTimeout(() => {
                   window.location.href = 'index.html';
               }, 2000); */

           }, 1500);
       }

       // 3. Fungsi Toast Notification
       function showToast(message, iconClass, bgColorClass) {
           const toastContainer = document.getElementById('toastContainer');
           const toast = document.createElement('div');

           toast.className =
               `toast bg-white border border-gray-100 shadow-[0_10px_40px_rgba(0,0,0,0.08)] rounded-xl p-4 flex items-center gap-4 w-80 pointer-events-auto`;
           toast.innerHTML = `
                <div class="w-10 h-10 rounded-full ${bgColorClass} flex items-center justify-center text-white shrink-0 shadow-inner">
                    <i class="fa-solid ${iconClass} text-lg"></i>
                </div>
                <div class="flex-1">
                    <h4 class="text-sm font-bold text-gray-900 mb-0.5">Sukses</h4>
                    <p class="text-xs text-gray-500 leading-tight">${message}</p>
                </div>
            `;

           toastContainer.appendChild(toast);

           // Hilangkan Toast setelah 3.5 detik
           setTimeout(() => {
               toast.classList.add('hiding');
               toast.addEventListener('animationend', () => toast.remove());
           }, 3500);
       }
   </script>
   </body>

   </html>
