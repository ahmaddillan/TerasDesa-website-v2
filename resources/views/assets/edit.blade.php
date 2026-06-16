<!doctype html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <title>Edit Aset Desa</title>

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    </head>
    <body class="bg-light">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header text-white" style="background-color: #556b2f">
                            <h5 class="mb-0">Edit Aset Desa</h5>
                        </div>

                        <div class="card-body">
                            <!-- FORM EDIT ASET -->
                            <form id="editAsetForm" enctype="multipart/form-data">
                                <!-- Nama Aset -->
                                <div class="mb-3">
                                    <label class="form-label">Nama Aset</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required />
                                </div>

                                <!-- Lokasi -->
                                <div class="mb-3">
                                    <label class="form-label">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" required />
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                                    </select>
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea
                                        class="form-control"
                                        id="deskripsi"
                                        name="deskripsi"
                                        rows="4"
                                        required
                                    ></textarea>
                                </div>

                                <!-- Gambar -->
                                <div class="mb-3">
                                    <label class="form-label">Upload Gambar</label>
                                    <input
                                        type="file"
                                        class="form-control"
                                        id="gambar"
                                        name="gambar"
                                        accept="image/*"
                                    />
                                    <small class="text-muted"> Kosongkan jika tidak ingin mengganti gambar </small>
                                </div>

                                <!-- Preview gambar lama -->
                                <div class="mb-3">
                                    <label class="form-label">Gambar Saat Ini</label><br />
                                    <img id="previewImage" src="" class="img-thumbnail" style="max-height: 200px" />
                                </div>

                                <!-- Tombol -->
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="/aset" class="btn text-white" style="background-color: #6c757d">
                                        Kembali
                                    </a>

                                    <button type="submit" class="btn text-white" style="background-color: #556b2f">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                            <!-- END FORM -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- SCRIPT EDIT ASET -->
        <script>
            const API_URL = "http://localhost:3000/api/assets";
            const IMAGE_BASE_URL = "http://localhost:3000/uploads/assets/";
            const asetId = window.location.pathname.split("/")[2];

            // LOAD DATA ASET
            fetch(`${API_URL}/${asetId}`)
                .then((res) => res.json())
                .then((aset) => {
                    document.getElementById("nama").value = aset.nama;
                    document.getElementById("lokasi").value = aset.lokasi;
                    document.getElementById("status").value = aset.status;
                    document.getElementById("deskripsi").value = aset.deskripsi;
                    document.getElementById("previewImage").src = IMAGE_BASE_URL + aset.gambar_url;
                });

            // SUBMIT EDIT
            document.getElementById("editAsetForm").addEventListener("submit", function (e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch(`${API_URL}/${asetId}`, {
                    method: "PUT",
                    body: formData,
                })
                    .then((res) => {
                        if (!res.ok) throw new Error();
                        return res.json();
                    })
                    .then(() => {
                        alert("Aset berhasil diperbarui");
                        window.location.href = "/aset";
                    })
                    .catch(() => alert("Gagal mengupdate aset"));
            });
        </script>
    </body>
</html>
