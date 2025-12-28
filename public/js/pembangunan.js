document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("proj-form");
  const list = document.getElementById("list");
  const clearBtn = document.getElementById("clear");
  const bar = document.getElementById("bar");
  const percent = document.getElementById("percent");
  const filterBtns = document.querySelectorAll(".filter-btn");

  const LS_KEY = "terasdesa_projects_v1";
  let filter = "all";
  let projects = load();

  function load() {
    try {
      return JSON.parse(localStorage.getItem(LS_KEY) || "[]");
    } catch {
      return [];
    }
  }

  function save() {
    localStorage.setItem(LS_KEY, JSON.stringify(projects));
  }

  function avgProgress(items) {
    if (!items.length) return 0;
    const sum = items.reduce((a, b) => a + Number(b.progress || 0), 0);
    return sum / items.length;
  }

  function fmtRp(n) {
    const num = Number(n || 0);
    return "Rp " + num.toLocaleString("id-ID");
  }

  function filtered() {
    if (filter === "all") return projects;
    return projects.filter(p => p.status === filter);
  }

  function render() {
    const items = filtered();
    list.innerHTML = "";

    items.forEach((p, idx) => {
      const div = document.createElement("div");
      div.className = "item";
      div.innerHTML = `
        <div style="display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;">
          <div>
            <strong>${escapeHtml(p.name)}</strong>
            <div class="meta">
              Status: <b>${p.status}</b> • Progress: <b>${p.progress}%</b><br>
              PJ: ${escapeHtml(p.owner)}<br>
              ${escapeHtml(p.start)} → ${escapeHtml(p.end)}<br>
              Estimasi: <b>${fmtRp(p.est)}</b> • Total: <b>${fmtRp(p.total)}</b>
            </div>
          </div>
          <button class="btn secondary" data-del="${p.id}" type="button">Hapus</button>
        </div>
        <div class="meta" style="margin-top:10px;">
          ${escapeHtml(p.desc)}
        </div>
      `;
      list.appendChild(div);
    });

    
    const a = avgProgress(projects);
    bar.style.width = `${a}%`;
    percent.textContent = `${Math.round(a)}% rata-rata progress`;

    
    list.querySelectorAll("[data-del]").forEach(btn => {
      btn.addEventListener("click", () => {
        const id = btn.getAttribute("data-del");
        projects = projects.filter(p => p.id !== id);
        save();
        render();
        if (typeof showPopup === "function") showPopup("🗑️ Proyek dihapus");
      });
    });
  }

  function escapeHtml(str) {
    return String(str ?? "")
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }

  
  filterBtns.forEach(b => {
    b.addEventListener("click", () => {
      filter = b.dataset.filter || "all";
      render();
    });
  });

  
  form.addEventListener("submit", (e) => {
    e.preventDefault();

    const project = {
      id: crypto.randomUUID ? crypto.randomUUID() : String(Date.now()),
      name: document.getElementById("p-name").value.trim(),
      status: document.getElementById("p-status").value,
      progress: Number(document.getElementById("p-progress").value),
      owner: document.getElementById("p-owner").value.trim(),
      start: document.getElementById("p-start").value,
      end: document.getElementById("p-end").value,
      est: Number(document.getElementById("p-est").value),
      total: Number(document.getElementById("p-total").value),
      desc: document.getElementById("p-desc").value.trim(),
    };

    projects.unshift(project);
    save();
    render();
    form.reset();
    document.getElementById("p-progress").value = 0;

    if (typeof showPopup === "function") showPopup("✅ Proyek tersimpan!");
  });

  
  clearBtn.addEventListener("click", () => {
    projects = [];
    save();
    render();
    if (typeof showPopup === "function") showPopup("🧹 Semua proyek dihapus");
  });

  render();
});
