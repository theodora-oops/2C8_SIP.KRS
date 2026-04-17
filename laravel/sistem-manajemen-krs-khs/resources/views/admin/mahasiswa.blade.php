<!DOCTYPE html>
<html>
<head>
    <title>Kelola Mahasiswa</title>

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

    <h2>Kelola Mahasiswa</h2>

    <div class="card">

        <!-- cuma tambah id -->
        <button id="btnTambah" style="background:#28a745;color:white;padding:8px;border:none;border-radius:5px;">
            + Tambah Mahasiswa
        </button>

        <table id="tabelMahasiswa"></table>

    </div>

</div>

<script>
let mahasiswas = JSON.parse(localStorage.getItem('mahasiswas')) || [
    { nama: "Mahasiswa A", nim: "12345" }
];

let editIndex = null;

// render tabel
function renderTable() {
    const table = document.getElementById("tabelMahasiswa");

    table.innerHTML = `
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Aksi</th>
        </tr>
    `;

    mahasiswas.forEach((mhs, index) => {
        if (editIndex === index) {
            table.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td><input type="text" id="editNama" value="${mhs.nama}"></td>
                    <td><input type="text" id="editNim" value="${mhs.nim}"></td>
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
                    <td>${mhs.nama}</td>
                    <td>${mhs.nim}</td>
                    <td>
                        <button class="btn edit" onclick="startEdit(${index})">Edit</button>
                        <button class="btn delete" onclick="deleteMahasiswa(${index})">Hapus</button>
                    </td>
                </tr>
            `;
        }
    });

    localStorage.setItem('mahasiswas', JSON.stringify(mahasiswas));
}

// tambah
function tambahMahasiswa() {
    let nama = prompt("Masukkan nama mahasiswa:");
    if (!nama) return;

    let nim = prompt("Masukkan NIM:");
    if (!nim) return;

    mahasiswas.push({ nama, nim });
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
    let nim = document.getElementById("editNim").value;

    if (!nama || !nim) return;

    mahasiswas[index] = { nama, nim };
    editIndex = null;
    renderTable();
}

// batal edit
function cancelEdit() {
    editIndex = null;
    renderTable();
}

// hapus
function deleteMahasiswa(index) {
    if (confirm("Yakin mau hapus mahasiswa ini?")) {
        mahasiswas.splice(index, 1);
        renderTable();
    }
}

// tombol tambah
document.getElementById("btnTambah").addEventListener("click", tambahMahasiswa);

// load awal
renderTable();
</script>

</body>
</html>