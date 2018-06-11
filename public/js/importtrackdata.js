let importera = document.getElementById("importera");
importera.disabled = true;

let havecorrectfile = false;
let data = document.getElementById('data');
var _validFileExtensions = [".csv"];
function validateFile() {
	var sFileName = $('input[type=file]').val();
	if (sFileName.length > 0) {
		var blnValid = false;
		for (var j = 0; j < _validFileExtensions.length; j++) {
			var sCurExtension = _validFileExtensions[j];
			// console.log(sCurExtension);
			console.log(sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase());
			if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
				blnValid = true;
				havecorrectfile = true;
				if (havecorrectfile) {
					importera.disabled = false;
				}
				break;
			}
		}
		if (!blnValid) {
			havecorrectfile = false;
			importera.disabled = true;
			alert("Sorry, choosen file is invalid, allowed extension is: " + _validFileExtensions.join(", "));
		}
	}
}
