/**
 * XU LY SCRIPT DUNG CHUNG
 */
jQuery(function($){
	// XL XOA BOOKING
	$('.booking-delete').on('click', function(){
		if(!confirm('Bạn có chắc chắn xóa dữ liệu đang chọn?')){
			return false;
		}
		return true;
	});
});