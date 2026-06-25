document.addEventListener("DOMContentLoaded", () => {
  const viewMode = document.getElementById("viewMode");
  const editMode = document.getElementById("editMode");
  const btnEdit = document.getElementById("btnEdit");
  const btnCancel = document.getElementById("btnCancel");

  if (btnEdit) {
    btnEdit.addEventListener("click", () => {
      viewMode.style.display = "none";
      editMode.style.display = "block";
    });
  }

  if (btnCancel) {
    btnCancel.addEventListener("click", () => {
      editMode.style.display = "none";
      viewMode.style.display = "block";
      const pw = document.getElementById("newPassword");
      if (pw) pw.value = "";
    });
  }

  
  const avatarInput = document.getElementById("avatarInput");
  const avatarPreview = document.getElementById("avatarPreview");
  if (avatarInput && avatarPreview) {
    avatarInput.addEventListener("change", function(){
      const file = this.files && this.files[0];
      if(!file) return;
      avatarPreview.src = URL.createObjectURL(file);
    });
  }
});
