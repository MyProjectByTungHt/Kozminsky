$(function() {
	var $galitem = $('.mainslideshow').children();
    // �?m c�c ?nh trong gallery
	var $galsize = $('.mainslideshow img').size();
    // Th�m n�t Prev v� Next v�o gallery
	$('.mainslideshow').append('<div class="slide-nav"><a class="prev" style="display:block">prev</a><a class="next" style="display:block">next</a></div>');
	// ?n t?t c? c�c ?nh v� hi?n ?nh d?u ti�n
	$('.mainslideshow img:gt(0)').hide();
    $currentimg = 0;
	// Th�m id d? ph�n bi?t ri�ng t?ng ?nh
	$galitem.attr("id", function (arr) {
		return "galleryitem" + arr;
	});
	
    // Th�m s? ki?n click v�o n�t Prev
	$('.prev').click(function () { 
		if ($currentimg > 0) {
			previmg($currentimg);
			$currentimg = $currentimg - 1;
		}
	});
    // Th�m s? ki?n click v�o n�t Next
	$('.next').click(function () { 
		if ($currentimg < $galsize - 1) {
			nextimg($currentimg, $galsize);
			$currentimg = $currentimg + 1;
		}
	});
})

// H�m x? l� khi n�t Next du?c ?n
function nextimg($img, $size) {
	$n_img = $img + 1;
	if ($n_img < $size) {
		$('#galleryitem' + $img).fadeOut();
		$('#galleryitem' + $n_img).fadeIn();
	}
}
// H�m x? l� khi n�t Previous du?c ?n
function previmg($img) {
	$p_img = $img - 1;
	if ($p_img >= 0) {
		$('#galleryitem' + $img).fadeOut();
		$('#galleryitem' + $p_img).fadeIn();
	}
}