// check all
$(document).on(' change','input[name="check_all"]',function() {
        $('.idRow').prop("checked" , this.checked);
});

//scroll to top
$(document).ready(function(){

//Check to see if the window is top if not then display button
$(window).scroll(function(){
  if ($(this).scrollTop() > 100) {
    $('.scrollToTop').fadeIn();
  } else {
    $('.scrollToTop').fadeOut();
  }
});

//news ticker
function tick(){
    $('#ticker li:first').slideUp( function () { $(this).appendTo($('#ticker')).slideDown(); });
}
setInterval(function(){ tick () }, 4000);



//Click event to scroll to top
$('.scrollToTop').click(function(){
      $('html, body').animate({scrollTop : 0},800);
      return false;
    });
});


$('.smoothscroll').click(function(){
    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top
    }, 800);
    return false;
});

$('.scrollToTop2').click(function(){
    $('html, body').animate({scrollTop : 0},800);
    return false;
});


// drop down menu
$(function(){
    if(screen.width >= 992){
        $('ul.nav li.dropdown').hover(function(){
            $('.dropdown-menu',this).fadeIn();
        },function(){
            $('.dropdown-menu',this).fadeOut('fast');
        });
    }
});

//tooltip
$('.tooltip-demo').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
})

// membuka halaman  tab daftar atau login
$(function(){
	var hash= window.location.hash;
	hash &&$('ul.nav a[href="' + hash + '"]').tab('show')
})


//modal publish
$('.publish').on('click',function(){
	$('#modalpublish').modal({
		show: true,
	})

	var myvalue = this.value;

	$('#publishid').attr('value',myvalue);
});

//modal unpublish
$('.unpublish').on('click',function(){
	$('#modalunpublish').modal({
		show: true,
	})

	var myvalue = this.value;

	$('#unpublishid').attr('value',myvalue);
});

//modal 1
$('.modal1').on('click',function(){
    $('#modal1show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal1id').attr('value',myvalue);
    $('#modal1id2').attr('value',myvalue2);
});

//modal 2
$('.modal2').on('click',function(){
    $('#modal2show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal2id').attr('value',myvalue);
    $('#modal2id2').attr('value',myvalue2);
});

//modal 3
$('.modal3').on('click',function(){
    $('#modal3show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal3id').attr('value',myvalue);
    $('#modal3id2').attr('value',myvalue2);
});

//modal 4
$('.modal4').on('click',function(){
    $('#modal4show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal4id').attr('value',myvalue);
    $('#modal4id2').attr('value',myvalue2);
});

//modal 5
$('.modal5').on('click',function(){
    $('#modal5show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal5id').attr('value',myvalue);
    $('#modal5id2').attr('value',myvalue2);
});

//modal 6
$('.modal6').on('click',function(){
    $('#modal6show').modal({
        show: true,
    })

    var myvalue = this.name;
    var myvalue2 = this.title;
    $('#modal6id').attr('value',myvalue);
    $('#modal6id2').attr('value',myvalue2);
});

//modal flickr
$('.modalflickr img').on('click',function(){
    $('#modalflickrshow').modal({
        show: true,
    })

    var myscr = this.alt;
    $('#modalflickr').attr('src',myscr);
    $('#modalflickr').on('click',function(){
        $('#modalflickrshow').modal('hide')
    })
})

//modal photo
$('.modalphotos img').on('click',function(){
	$('#modalphotoshow').modal({
		show: true,
	})

	var myscr = this.src;
	$('#modalimage').attr('src',myscr);
	$('#modalimage').on('click',function(){
		$('#modalphotoshow').modal('hide')
	})
})

//modal pemilihan
$(document).ready(function(){
    $("#modalpemilihan").on('show.bs.modal', function(event){

        // Get button that triggered the modal
        var button = $(event.relatedTarget);

        // Extract value from data-* attributes
        var tipe = button.data('tipe');
        var image = button.data('image');
        var nama = button.data('nama');
        var lahir = button.data('lahir');
        var status = button.data('status');
        var agama = button.data('agama');
        var pekerjaan = button.data('pekerjaan');
        var asal = button.data('asal');
        var pengusung = button.data('pengusung');
        var jabatan = button.data('jabatan');

        $(this).find('.modal-tipe').text(tipe);
        $(this).find('.modal-image').attr('src',image);;
        $(this).find('.modal-nama').text(nama);
        $(this).find('.modal-lahir').text(lahir);
        $(this).find('.modal-status').text(status);
        $(this).find('.modal-agama').text(agama);
        $(this).find('.modal-pekerjaan').text(pekerjaan);
        $(this).find('.modal-asal').text(asal);
        $(this).find('.modal-pengusung').text(pengusung);
        $(this).find('.modal-jabatan').text(jabatan);
    });
});

//centering modal
function centerModal() {
    $(this).css('display', 'block');
    var $dialog = $(this).find(".modal-dialog");
    var offset = ($(window).height() - $dialog.height()) / 2;
    // Center modal vertically in window
    $dialog.css("margin-top", offset);
}

$('.modal').on('show.bs.modal', centerModal);
$(window).on("resize", function () {
    $('.modal:visible').each(centerModal);
});

// input hanya angka
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

//preview gambar upload
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        $('#tampilgambar').attr('src', e.target.result);
       }
        reader.readAsDataURL(input.files[0]);
       }
}

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#tampilgambar2').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

//munculkan dan hilangkan objek
function changeFunc($i) {
    if($i == "tambah"){
		document.getElementById('pilihan').style.display='inline';
	}else{
		document.getElementById('pilihan').style.display='none';
	}
}

function changeFunc2($i) {
    if($i == "1" || $i == "2"){
        document.getElementById('pilihan').style.display='inline';
    }else{
        document.getElementById('pilihan').style.display='none';
    }
}

function changeFuncUser($i) {
    if($i == "2"){
        document.getElementById('pilihan').style.display='inline';
        document.getElementById('pilihan2').style.display='none';
    }else{
        document.getElementById('pilihan').style.display='none';
        document.getElementById('pilihan2').style.display='inline';
    }
}

$("#tampilinputgambar").change(function() {
    if(this.checked) {
        document.getElementById('inputgambar').style.display='inline';
		document.getElementById('gambartext').value ='Iya, gambar akan muncul di list artikel dan view artikel';
    }else{
    	document.getElementById('inputgambar').style.display='none';
		document.getElementById('gambartext').value ='Tidak';
    }
});

$("#artikelpilihan").change(function() {
    if(this.checked) {
		document.getElementById('artikeltext').value ='Iya, artikel akan muncul di slideshow';
    }else{
		document.getElementById('artikeltext').value ='Tidak';
    }
});

$("#terbitkanartikel").change(function() {
    if(this.checked) {
        document.getElementById('statustext').value ='Iya, artikel akan di terbitkan';
    }else{
        document.getElementById('statustext').value ='Tidak';
    }
});

// hak akses button
jQuery(function () {
    var $checks = $('input.access');
    $('input[type="radio"][data-access-type]').change(function () {
        var type = $(this).data('accessType');
        $checks.filter('[data-access-' + type + ']').prop('checked', true)
        $checks.not('[data-access-' + type + ']').prop('checked', false)
    })
})


//date time picker
$(function() {
    $( "#datepicker" ).datepicker();
  });

 //currency
document.getElementById("number").onblur =function (){
    this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

//tab activate
var hash = window.location.hash;
hash && $('ul.nav a[href="' + hash + '"]').tab('show');
