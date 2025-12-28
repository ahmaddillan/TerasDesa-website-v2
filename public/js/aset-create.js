const form = document.getElementById("formTambahAset");

form.addEventListener("submit", async function (e) {
  e.preventDefault();

  const formData = new FormData();

  formData.append("nama", form.nama.value);
  formData.append("lokasi", form.lokasi.value);
  formData.append("status", form.status.value);
  formData.append("deskripsi", form.deskripsi.value);

  //yang diisi harus image
  if (form.image.files.length > 0) {
    formData.append("image", form.image.files[0]);
  }

  try {
    const response = await fetch("http://localhost:3000/api/assets", {
      method: "POST",
      body: formData,
    });

    const result = await response.json();

    if (!response.ok) {
      alert("Gagal menambahkan aset: " + result.message);
      return;
    }

    alert("Aset berhasil ditambahkan");

    //kembali ke page aset
    window.location.href = "/aset";
  } catch (err) {
    console.error(err);
    alert("Terjadi kesalahan server");
  }
});
