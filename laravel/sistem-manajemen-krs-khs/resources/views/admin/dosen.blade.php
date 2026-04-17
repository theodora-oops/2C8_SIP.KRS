<!DOCTYPE html>
<html>
<head>
    <title>Kelola Dosen</title>

    <style>
        body { font-family: Arial; background:#f4f6f9; margin:0; }

        .content {
            padding: 20px;
        }

        .card {
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 2px 8px rgba(0,0,0,0.1);
        }

        table {
            width:100%;
            border-collapse: collapse;
            margin-top:15px;
        }

        th, td {
            border:1px solid #ddd;
            padding:10px;
            text-align:left;
        }

        th {
            background:#4facfe;
            color:white;
        }

        .btn {
            padding:6px 10px;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        .edit { background:orange; color:white; }
        .delete { background:red; color:white; }
        .save { background:green; color:white; }
        .cancel { background:gray; color:white; }

        input {
            padding:5px;
            width:90%;
        }
    </style>
</head>

<body>

<div class="content">

    <h2>Kelola Dosen</h2>

    <div class="card">

        <button class="btn" id="btnTambah" style="background:#28a745;color:white;">
            + Tambah Dosen
        </button>

        <table id="tabelDosen"></table>

    </div>

</div>

<script>
let dosens = JSON.parse(localStorage.getItem('dosens')) || [
    { nama: "Dosen A", email: "dosenA@mail.com" },
    { nama: "Dosen B", email: "dosenB@mail.com" }
];

let editIndex = null;

// render tabel
function renderTable() {
    const table = document.getElementById("tabelDosen");

    table.innerHTML = `
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    `;

    dosens.forEach((dosen, index) => {
        if (editIndex === index) {
            // mode edit
            table.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td><input type="text" id="editNama" value="${dosen.nama}"></td>
                    <td><input type="email" id="editEmail" value="${dosen.email}"></td>
                    <td>
                        <button class="btn save" onclick="saveEdit(${index})">Simpan</button>
                        <button class="btn cancel" onclick="cancelEdit()">Batal</button>
                    </td>
                </tr>
            `;
        } else {
            // mode normal
            table.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${dosen.nama}</td>
                    <td>${dosen.email}</td>
                    <td>
                        <button class="btn edit" onclick="startEdit(${index})">Edit</button>
                        <button class="btn delete" onclick="deleteDosen(${index})">Hapus</button>
                    </td>
                </tr>
            `;
        }
    });

    localStorage.setItem('dosens', JSON.stringify(dosens));
}

// tambah
function tambahDosen() {
    let nama = prompt("Masukkan nama dosen:");
    if (!nama) return;

    let email = prompt("Masukkan email dosen:");
    if (!email) return;

    dosens.push({ nama, email });
    renderTable();
}

// mulai edit
function startEdit(index) {
    editIndex = index;
    renderTable();
}

// simpan edit
function saveEdit(index) {
    let nama = document.getElementById("editNama").value;
    let email = document.getElementById("editEmail").value;

    if (!nama || !email) return;

    dosens[index] = { nama, email };
    editIndex = null;
    renderTable();
}

// batal edit
function cancelEdit() {
    editIndex = null;
    renderTable();
}

// hapus
function deleteDosen(index) {
    if (confirm("Yakin mau hapus dosen ini?")) {
        dosens.splice(index, 1);
        renderTable();
    }
}

// tombol tambah
document.getElementById("btnTambah").addEventListener("click", tambahDosen);

// load pertama
renderTable();
</script>

</body>
</html>