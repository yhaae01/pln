const flashData = $(".flash-data").data("flashdata");

if (flashData) {
	Swal.fire({
		title: "Gagal",
		text: "Oops! " + flashData,
		icon: "warning",
		showCloseButton: true,
	});
}
