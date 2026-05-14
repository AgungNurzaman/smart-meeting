// FILTER TANGGAL

document
.getElementById(
'filterTanggal'
)

.addEventListener(
'change',
function(){

let tanggal =
this.value;

let rows =
document.querySelectorAll(
'#tableBooking tbody tr'
);

rows.forEach(function(row){

let isiTanggal =
row.cells[1].innerText;

if(
tanggal == ''
||
isiTanggal == tanggal
){

row.style.display='';

}else{

row.style.display='none';

}

});

});

// CARI RUANGAN

document
.getElementById(
'cariRuangan'
)

.addEventListener(
'keyup',
function(){

let keyword =
this.value.toLowerCase();

let rows =
document.querySelectorAll(
'#tableBooking tbody tr'
);

rows.forEach(function(row){

let namaRuangan =
row.cells[3]
.innerText
.toLowerCase();

if(
namaRuangan.includes(keyword)
){

row.style.display='';

}else{

row.style.display='none';

}

});

});

// HAPUS DATA

function hapusData(id){

let kode = prompt(
'Ketik HAPUS'
);

if(kode == 'HAPUS'){

window.location =
'hapus.php?id='+id;

}else{

alert('Kode salah');

}

}
