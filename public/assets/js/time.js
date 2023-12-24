window.setTimeout("waktu()", 1000);

function waktu() {
    var waktu = new Date();
    var options = { timeZone: "Asia/Makassar" };
    waktu.toLocaleString("en-US", options);
    setTimeout("waktu()", 1000);

    var jam = waktu.getHours();

    // Mengganti format waktu AM/PM menjadi "WITA"
    var ampm = jam >= 12 ? "WITA" : "WITA";
    jam = jam % 12;
    jam = jam ? jam : 12;

    document.getElementById("waktu").innerHTML = getHari(waktu.getDay()) + ', ' + waktu.getDate().toString().padStart(2, '0') + ' ' + getBulan(waktu.getMonth()) + ' ' + waktu.getFullYear() + ' ' + waktu.getHours().toString().padStart(2, '0') + ':' + waktu.getMinutes().toString().padStart(2, '0') + ':'+ waktu.getSeconds().toString().padStart(2, '0') + ' ' + ampm;
}

function getHari(angkaHari) {
    var daftarHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    return daftarHari[angkaHari];
}

function getBulan(angkaBulan) {
    var daftarBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    return daftarBulan[angkaBulan];
}
