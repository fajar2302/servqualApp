// import { jsPDF } from 'jspdf';
// $(document).ready(function () {
//   let spesialElementHandler = {
//     '#editor': function (element, rendered) {
//       return true;
//     },
//   };
//   $('#downloadBtn').click(function () {
//     let doc = new jsPDF();
//     doc.fromHTML($('content').html(), 15, 15, 15, {
//       width: 170,
//       elementHandler: spesialElementHandler,
//     });

//     doc.save('Hasil SERVQUAL.pdf');
//   });
// });
function preparePrint() {
  let button = document.getElementById('downloadBtn');
  button.style.display = 'none'; // Menghilangkan tombol download
  let excelBtn = document.getElementById('excelBtn');
  excelBtn.classList.add('none');

  window.print(); // Memanggil fungsi cetak bawaan browser
  location.reload(); // Me-refresh halaman setelah pencetakan untuk mengembalikan baris yang dihapus
}
function excelFile(id) {
  // let id = this.getAttribute('print-id');
  let directLink = 'cetak.php?id=' + id;

  // Mengarahkan browser ke direct link
  window.open(directLink, '_blank');
}
