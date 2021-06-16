/* Main JS File */
{/* <script type="text/javascript"> */ }
function add_row() {
	$rowno = $("#employee_table tr").length;
	$rowno = $rowno + 1;
	$("#employee_table tr:last").after("<tr id='row" + $rowno + "'><td><input type='text' name='name[]' placeholder='Enter Name'></td><td><input type='text' name='age[]' placeholder='Enter Age'></td><td><input type='text' name='job[]' placeholder='Enter Job'></td><td><input type='button' value='DELETE' onclick=delete_row('row" + $rowno + "')></td></tr>");
}

function delete_row(rowno) {
	$('#' + rowno).remove();
}
// </script>


$(function () {
	$(document).ready(function () {
		$('#example').DataTable();
	});
});



/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
	document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
	var input, filter, ul, li, a, i;
	input = document.getElementById("myInput");
	filter = input.value.toUpperCase();
	div = document.getElementById("myDropdown");
	a = div.getElementsByTagName("a");
	for (i = 0; i < a.length; i++) {
		txtValue = a[i].textContent || a[i].innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
			a[i].style.display = "";
		} else {
			a[i].style.display = "none";
		}
	}
}


$(document).ready(function () {
	$('.minus').click(function () {
		var $nrinput = $(this).parent().find('input');
		var count = parseInt($nrinput.val()) - 1;
		count = count < 1 ? 1 : count;
		$nrinput.val(count);
		$nrinput.change();
		return false;
	});
	$('.plus').click(function () {
		var $nrinput = $(this).parent().find('input');
		$nrinput.val(parseInt($nrinput.val()) + 1);
		$nrinput.change();
		return false;
	});
});