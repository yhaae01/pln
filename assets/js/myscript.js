const flashData = $(".flash-data").data("flashdata");
if (flashData) {
	Swal.fire({
		title: "Data ",
		text: "Berhasil " + flashData,
		type: "success",
	});
}
