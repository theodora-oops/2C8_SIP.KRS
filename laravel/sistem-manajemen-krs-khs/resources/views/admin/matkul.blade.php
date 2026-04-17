<!DOCTYPE html>
<html>
<head>
    <title>Kelola Mata Kuliah</title>

    <style>
        body { font-family: Arial; background:#f4f6f9; margin:0; }
        .content { padding:20px; }

        .card {
            background:white;
            padding:20px;
            border-radius:10px;
        }

        table {
            width:100%;
            border-collapse: collapse;
            margin-top:15px;
        }

        th, td {
            border:1px solid #ddd;
            padding:10px;
        }

        th {
            background:#4facfe;
            color:white;
        }

        .btn { padding:6px 10px; border:none; border-radius:5px; }
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

    <h2>Kelola Mata Kuliah</h2>

    <div class="card">

        <!-- tambah id doang -->
        <button id="btnTambah" style="background:#28a745;color:white;padding:8px;border:none;border-radius:5px;">
            + Tambah Matkul
        </button>

        <table id="tabelMatkul"></table>

    </div>

</div>

<script>
let matkuls = JSON.parse(localStorage.getItem('matkuls')) || [
    { nama: "Pemrograman Web", sks: "3" }
];

let editIndex = null;

// render tabel
function renderTable() {
    const table = document.getElementById("tabelMatkul");

    table.innerHTML = `
        <tr>
            <th>No</th>
            <th>Nama Mata Kuliah</th>
            <th>SKS</th>
            <th>Aksi</th>
        </tr>
    `;

    matkuls.forEach((matkul, index) => {
        if (editIndex === index) {
            table.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td><input type="text" id="editNama" value="${matkul.nama}"></td>
                    <td><input type="number" id="editSks" value="${matkul.sks}"></td>
                    <td>
                        <button class="btn save" onclick="saveEdit(${index})">Simpan</button>
                        <button class="btn cancel" onclick="cancelEdit()">Batal</button>
                    </td>
                </tr>
            `;
        } else {
            table.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${matkul.nama}</td>
                    <td>${matkul.sks}</td>
                    <td>
                        <button class="btn edit" onclick="startEdit(${index})">Edit</button>
                        <button class="btn delete" onclick="deleteMatkul(${index})">Hapus</button>
                    </td>
                </tr>
            `;
        }
    });

    localStorage.setItem('matkuls', JSON.stringify(matkuls));
}

// tambah
function tambahMatkul() {
    let nama = prompt("Masukkan nama matkul:");
    if (!nama) return;

    let sks = prompt("Masukkan jumlah SKS:");
    if (!sks) return;

    matkuls.push({ nama, sks });
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
    let sks = document.getElementById("editSks").value;

    if (!nama || !sks) return;

    matkuls[index] = { nama, sks };
    editIndex = null;
    renderTable();
}

// batal edit
function cancelEdit() {
    editIndex = null;
    renderTable();
}

// hapus
function deleteMatkul(index) {
    if (confirm("Yakin mau hapus matkul ini?")) {
        matkuls.splice(index, 1);
        renderTable();
    }
}

// tombol tambah
document.getElementById("btnTambah").addEventListener("click", tambahMatkul);

// load awal
renderTable();
</script>

</body>
</html>