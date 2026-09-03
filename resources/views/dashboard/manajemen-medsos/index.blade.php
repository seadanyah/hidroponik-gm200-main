@include('layouts.dashboard.header')
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Manajemen Medsos</h1>
        </div>

        <div class="section-body">

            <h2 class="section-title">Buat Konten</h2>
            <p class="section-lead">
                Upload gambar & generate caption untuk Instagram.
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upload Gambar</label>
                                        <input type="file" id="imageInput" class="form-control" required
                                            accept="image/*">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Deskripsi Konten</label>
                                        <textarea id="deskripsiInput" class="form-control" required rows="4"
                                            placeholder="Contoh: promo selada hidroponik..."></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tipe Konten</label>
                                        <select id="tipeInput" required class="form-control">
                                            <option value="Promo">Promo</option>
                                            <option value="Edukasi">Edukasi</option>
                                            <option value="Testimoni">Testimoni</option>
                                            <option value="Tips">Tips</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group text-right">
                                        <button id="btnGenerate" class="btn btn-success"
                                            onclick="generateRekomendasi()">
                                            Generate Rekomendasi AI
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Hasil Caption (AI)</label>
                                        <div class="input-group">
                                            <textarea id="aiCaption" class="form-control" rows="4" placeholder="Hasil caption akan muncul di sini..."></textarea>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary"
                                                    onclick="copyText('aiCaption')"><i class="fas fa-copy"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Rekomendasi Jam Tayang</label>
                                        <div class="input-group">
                                            <input type="text"  readonly id="aiTime" class="form-control"
                                                placeholder="Jam tayang akan muncul di sini...">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-info"
                                                    onclick="copyText('aiTime')"><i class="fas fa-copy"></i></button>
                                            </div>
                                        </div>
                                        <small id="timeWarning" class="text-danger d-none mt-1">
                                            <i class="fas fa-exclamation-circle"></i> Jam awal tidak boleh lebih besar
                                            atau sama dengan jam akhir!
                                        </small>
                                    </div>
                                </div>
                            </div>


                            <hr class="mb-4">
                            <div class="form-group text-right">
                                <button id="btnSave" class="btn btn-warning" onclick="simpanDanJadwalkan()">Simpan &
                                    Jadwalkan</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <h2 class="section-title mt-5">Riwayat Konten</h2>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Gambar</th>
                                        <th>Tipe</th>
                                        <th>Caption</th>
                                        <th>Jadwal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="historyTableBody">
                                    @foreach ($posts as $index => $post)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $post->image) }}" width="60"
                                                    style="object-fit: cover; border-radius: 4px;">
                                            </td>
                                            <td>{{ str_replace('Konten ', '', explode(' - ', $post->title)[0]) }}</td>

                                            <td class="caption-text">
                                                {{ \Illuminate\Support\Str::limit($post->ai_caption, 50) }}</td>

                                            <td>{{ $post->scheduled_at }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $post->status == 'Scheduled' ? 'badge-info' : 'badge-success' }}">
                                                    {{ ucfirst($post->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info"
                                                    data-caption="{{ $post->ai_caption }}"
                                                    onclick="copyRowCaption(this)">
                                                    <i class="fas fa-copy"></i> Copy
                                                </button>
                                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                                    data-target="#editStatusModal"
                                                    onclick="siapkanDataEdit({{ $post->id }}, '{{ strtolower($post->status) }}')">
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

</div>
<div class="modal fade" id="editStatusModal" tabindex="-1" role="dialog" aria-labelledby="editStatusModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStatusModalLabel">Ubah Status Konten</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditStatus">
                    <input type="hidden" id="editPostId">

                    <div class="form-group">
                        <label>Status Saat Ini</label>
                        <select class="form-control" id="editStatusSelect">
                            <option value="draft">Draft</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="posted">Posted</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="simpanStatus()">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>
</section>


<script>
    // FUNGSI 1: GENERATE CAPTION AI
    async function generateRekomendasi() {
        const btn = document.getElementById('btnGenerate');
        const imageFile = document.getElementById('imageInput').files[0];
        const deskripsi = document.getElementById('deskripsiInput').value;
        const tipe = document.getElementById('tipeInput').value;

        if (!imageFile) {
            alert('Tolong upload gambar terlebih dahulu!');
            return;
        }

        const originalText = btn.innerHTML;
        btn.innerHTML = 'Sedang Berpikir... <i class="fas fa-spinner fa-spin"></i>';
        btn.disabled = true;

        const formData = new FormData();
        formData.append('image', imageFile);
        formData.append('deskripsi', deskripsi);
        formData.append('tipe', tipe);

        try {
            const response = await fetch("{{ route('manajemen-medsos.generate') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                document.getElementById('aiCaption').value = data.caption;
                document.getElementById('aiTime').value = data.jam_tayang;
            } else {
                alert('Gagal: ' + (data.message || 'Terjadi kesalahan internal.'));
            }
        } catch (error) {
            console.error(error);
            alert('Koneksi ke server gagal saat generate AI.');
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    }

    // FUNGSI 2: SIMPAN & JADWALKAN
    async function simpanDanJadwalkan() {
        const btnSave = document.getElementById('btnSave');

        const imageFile = document.getElementById('imageInput').files[0];
        const deskripsi = document.getElementById('deskripsiInput').value;
        const tipe = document.getElementById('tipeInput').value;
        const caption = document.getElementById('aiCaption').value;
        const jamTayang = document.getElementById('aiTime').value;

        if (!imageFile || !caption) {
            alert('Gambar dan Hasil Caption tidak boleh kosong!');
            return;
        }

        const originalText = btnSave.innerHTML;
        btnSave.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
        btnSave.disabled = true;

        const formData = new FormData();
        formData.append('image', imageFile);
        formData.append('deskripsi', deskripsi);
        formData.append('tipe', tipe);
        formData.append('caption', caption);
        formData.append('jam_tayang', jamTayang);

        try {
            const response = await fetch("{{ route('manajemen-medsos.post') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (response.ok && data.success) {
                alert(data.message);

                const tbody = document.getElementById('historyTableBody');
                const newRow = document.createElement('tr');
                const postData = data.data;

                newRow.innerHTML = `
                <td><span class="badge badge-success">Baru</span></td>
                <td>
                    <img src="${postData.image_url}" width="60" style="object-fit: cover; border-radius: 4px;">
                </td>
                <td>${postData.tipe}</td>
                <td class="caption-text">${postData.caption_potong}</td>
                <td>${postData.jadwal}</td>
                <td><span class="badge badge-info">${postData.status}</span></td>
                <td>
                    <button class="btn btn-sm btn-info" data-caption="${postData.caption_full}" onclick="copyRowCaption(this)">
                        <i class="fas fa-copy"></i> Copy
                    </button>
                   <button class="btn btn-sm btn-warning"
        data-toggle="modal"
        data-target="#editStatusModal"
        onclick="siapkanDataEdit(${postData.id}, '${postData.status.toLowerCase()}')">
    Edit
</button>
                </td>
            `;

                tbody.insertBefore(newRow, tbody.firstChild);

                // Kosongkan form
                document.getElementById('deskripsiInput').value = '';
                document.getElementById('imageInput').value = '';
                document.getElementById('aiCaption').value = '';
                document.getElementById('aiTime').value = '';

            } else {
                alert('Gagal: ' + (data.message || 'Terjadi kesalahan internal.'));
            }
        } catch (error) {
            console.error(error);
            alert('Koneksi ke server gagal saat menyimpan data.');
        } finally {
            btnSave.innerHTML = originalText;
            btnSave.disabled = false;
        }
    }

    // FUNGSI 3: COPY TEXT
    function copyText(elementId) {
        const el = document.getElementById(elementId);
        el.select();
        document.execCommand("copy");
        alert("Teks disalin!");
    }

    function copyRowCaption(buttonElement) {
        const textToCopy = buttonElement.getAttribute('data-caption');

        if (!textToCopy) {
            alert("Teks caption tidak ditemukan.");
            return;
        }

        navigator.clipboard.writeText(textToCopy).then(() => {
            const originalText = buttonElement.innerHTML;
            buttonElement.innerHTML = '<i class="fas fa-check"></i> Copied!';
            buttonElement.classList.replace('btn-info', 'btn-success');

            setTimeout(() => {
                buttonElement.innerHTML = originalText;
                buttonElement.classList.replace('btn-success', 'btn-info');
            }, 2000);
        }).catch(err => {
            console.error('Gagal mencopy teks: ', err);
            alert('Gagal menyalin teks.');
        });
    }
    // FUNGSI 4: MODAL & UPDATE STATUS

    function siapkanDataEdit(id, currentStatus) {
        document.getElementById('editPostId').value = id;
        document.getElementById('editStatusSelect').value = currentStatus;
    }

    async function simpanStatus() {
        const id = document.getElementById('editPostId').value;
        const statusBaru = document.getElementById('editStatusSelect').value;

        try {
            const response = await fetch("{{ route('manajemen-medsos.update-status') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    id: id,
                    status: statusBaru
                })
            });

            const data = await response.json();

            if (response.ok && data.success) {
                alert(data.message);

                window.location.reload();
            } else {
                alert('Gagal: ' + (data.message || 'Terjadi kesalahan internal.'));
            }
        } catch (error) {
            console.error(error);
            alert('Koneksi ke server gagal.');
        }
    }
    // document.addEventListener("DOMContentLoaded", function() {
    //     const aiTimeInput = document.getElementById('aiTime');
    //     const timeWarning = document.getElementById('timeWarning'); // Ambil elemen peringatan
    //     let previousValue = aiTimeInput.value;

    //     aiTimeInput.addEventListener('input', function(e) {
    //         let cursorStart = this.selectionStart;
    //         let inputValue = this.value;

    //         // 1. Lacak ada berapa 'angka' di sebelah kiri kursor saat ini
    //         let digitsBeforeCursor = 0;
    //         for (let i = 0; i < cursorStart; i++) {
    //             if (/\d/.test(inputValue[i])) {
    //                 digitsBeforeCursor++;
    //             }
    //         }

    //         // 2. Ambil hanya angkanya saja (maksimal 8 digit)
    //         let numbers = inputValue.replace(/\D/g, '').substring(0, 8);

    //         // 3. VALIDASI FORMAT ANGKA (TANPA ALERT)
    //         let isInvalid = false;
    //         if (numbers.length > 0 && parseInt(numbers[0]) > 2) isInvalid = true;
    //         if (numbers.length > 1 && numbers[0] === '2' && parseInt(numbers[1]) > 3) isInvalid = true;
    //         if (numbers.length > 2 && parseInt(numbers[2]) > 5) isInvalid = true;
    //         if (numbers.length > 4 && parseInt(numbers[4]) > 2) isInvalid = true;
    //         if (numbers.length > 5 && numbers[4] === '2' && parseInt(numbers[5]) > 3) isInvalid = true;
    //         if (numbers.length > 6 && parseInt(numbers[6]) > 5) isInvalid = true;

    //         if (isInvalid) {
    //             this.value = previousValue;
    //             let prevCursor = Math.max(0, cursorStart - 1);
    //             this.setSelectionRange(prevCursor, prevCursor);
    //             return;
    //         }

    //         // 4. FORMATTING OTOMATIS
    //         let formatted = '';
    //         for (let i = 0; i < numbers.length; i++) {
    //             if (i === 2) formatted += ':';
    //             if (i === 4) formatted += ' - ';
    //             if (i === 6) formatted += ':';
    //             formatted += numbers[i];
    //         }

    //         if (numbers.length >= 8) {
    //             formatted += ' WIB';
    //         }

    //         this.value = formatted;
    //         previousValue = formatted;

    //         // 5. KEMBALIKAN KURSOR KE POSISI YANG BENAR
    //         let newCursorPos = 0;
    //         let digitsFound = 0;

    //         for (let i = 0; i < formatted.length; i++) {
    //             if (digitsFound === digitsBeforeCursor) {
    //                 newCursorPos = i;
    //                 break;
    //             }
    //             if (/\d/.test(formatted[i])) {
    //                 digitsFound++;
    //             }
    //         }

    //         if (digitsFound === digitsBeforeCursor && newCursorPos === 0 && digitsBeforeCursor > 0) {
    //             newCursorPos = formatted.indexOf(' WIB') !== -1 ? formatted.indexOf(' WIB') : formatted
    //                 .length;
    //         }

    //         this.setSelectionRange(newCursorPos, newCursorPos);

    //         // 6. VALIDASI LOGIKA JAM (AWAL VS AKHIR)
    //         // Hanya cek jika angkanya sudah lengkap 8 digit
    //         if (numbers.length === 8) {
    //             let startHour = parseInt(numbers.substring(0, 2));
    //             let startMin = parseInt(numbers.substring(2, 4));
    //             let endHour = parseInt(numbers.substring(4, 6));
    //             let endMin = parseInt(numbers.substring(6, 8));

    //             // Konversi ke total menit untuk memudahkan perbandingan
    //             let totalStartMins = (startHour * 60) + startMin;
    //             let totalEndMins = (endHour * 60) + endMin;

    //             if (totalStartMins >= totalEndMins) {
    //                 // Tampilkan pesan merah di bawah input
    //                 timeWarning.classList.remove('d-none');
    //                 aiTimeInput.classList.add(
    //                 'is-invalid'); // Bikin border input jadi merah (opsional, bawaan Bootstrap)
    //             } else {
    //                 // Sembunyikan pesan merah
    //                 timeWarning.classList.add('d-none');
    //                 aiTimeInput.classList.remove('is-invalid');
    //             }
    //         } else {
    //             // Sembunyikan pesan merah kalau digit belum lengkap (sedang diketik/dihapus)
    //             timeWarning.classList.add('d-none');
    //             aiTimeInput.classList.remove('is-invalid');
    //         }
    //     });

    //     // Cegah kursor nyasar ke dalam tulisan " WIB"
    //     aiTimeInput.addEventListener('click', function() {
    //         if (this.value.includes(' WIB') && this.selectionStart > this.value.length - 4) {
    //             let target = this.value.length - 4;
    //             this.setSelectionRange(target, target);
    //         }
    //     });
    // });
</script>

@include('layouts.dashboard.footer')
