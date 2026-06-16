//config
const API_URL = "/api/assets";
const IMAGE_BASE_URL = "/api/uploads/assets/";

 // menyimpan semua data aset
let allAssets = [];

//load aset
document.addEventListener("DOMContentLoaded", () => {
  loadAset();

  // event search realtime
  const searchInput = document.getElementById("searchInput");
  if (searchInput) {
    searchInput.addEventListener("input", handleSearch);
  }

  // pastikan popup hapus tertutup
  const hapusPopup = document.getElementById("hapusPopup");
  if (hapusPopup) hapusPopup.style.display = "none";
});

function loadAset() {
  fetch(API_URL)
    .then((res) => res.json())
    .then((data) => {
      if (!Array.isArray(data)) {
        alert("Format data API salah");
        return;
      }
      // simpan semua data dan render ulang
      allAssets = data; 
      renderAset(data);
    })
    .catch((err) => {
      console.error(err);
      alert("Gagal mengambil data dari API");
    });
}

//function render aset
function renderAset(data) {
  const container = document.getElementById("asetContainer");
  container.innerHTML = "";

  if (data.length === 0) {
    container.innerHTML = `<p style="color:#333">Aset tidak ditemukan</p>`;
    return;
  }

  data.forEach((aset) => {
    container.innerHTML += `
      <div class="card aset-card">
        <img src="${IMAGE_BASE_URL}${aset.gambar_url}" alt="${aset.nama}">

        <h3>${aset.nama}</h3>

        <p class="aset-status ${aset.status.toLowerCase()}">
          Status: <strong>${aset.status}</strong>
        </p>

        <div class="card-actions">
          <button class="btn detail"
            onclick='cekDetail(${JSON.stringify(aset)})'>
            Detail
          </button>

          <button class="btn edit"
            onclick="editAset(${aset.id})">
            Edit
          </button>

          <button class="btn hapus"
            onclick="confirmHapus(${aset.id})">
            Hapus
          </button>
        </div>
      </div>
    `;
  });
}

//function search
function handleSearch(e) {
  const keyword = e.target.value.toLowerCase();

  const filtered = allAssets.filter((aset) => {
    return (
      aset.nama.toLowerCase().includes(keyword) ||
      aset.lokasi.toLowerCase().includes(keyword) ||
      aset.status.toLowerCase().includes(keyword) ||
      (aset.deskripsi && aset.deskripsi.toLowerCase().includes(keyword))
    );
  });

  renderAset(filtered);
}

//function pop up detail aset
function cekDetail(aset) {
  document.getElementById("detailImage").src =
    IMAGE_BASE_URL + aset.gambar_url;

  document.getElementById("detailNama").innerText = aset.nama;
  document.getElementById("detailDeskripsi").innerText = aset.deskripsi;
  document.getElementById("detailLokasi").innerText = aset.lokasi;
  document.getElementById("detailStatus").innerText = aset.status;

  document.getElementById("detailPopup").style.display = "flex";
}

document.getElementById("popupClose").onclick = () => {
  document.getElementById("detailPopup").style.display = "none";
};

//function edit aset
function editAset(id) {
  window.location.href = `/aset/${id}/edit`;
}

//function hapus aset
let asetIdHapus = null;

function confirmHapus(id) {
  asetIdHapus = id;
  document.getElementById("hapusPopup").style.display = "flex";
}

function batalHapus() {
  asetIdHapus = null;
  document.getElementById("hapusPopup").style.display = "none";
}

function hapusAset() {
  fetch(`${API_URL}/${asetIdHapus}`, {
    method: "DELETE",
  })
    .then((res) => {
      if (!res.ok) throw new Error("Gagal hapus");
      return res.json();
    })
    .then(() => {
      batalHapus();
      //reload data
      loadAset(); 
    })
    .catch(() => alert("Gagal menghapus aset"));
}
