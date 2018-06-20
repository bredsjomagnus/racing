function toForm(divid, id, value, field) {

    console.log("value: " + value);
    console.log("field: " + field);
    console.log("id: " + id);

	// Variable and creating form and inupttags
    var paramholder = document.getElementById(divid);
    var form = document.createElement("form");
    var input = document.createElement("input");
    var inputhiddenfield = document.createElement("input");
    var inputhiddenid = document.createElement("input");

	// setting form attributes
	let editurl = "/data/teams/edit/"+id;
	if(window.location.host == 'localhost') {
		editurl = "/pwww/Race/public/data/teams/edit/"+id;
	}

    form.setAttribute("action", editurl);
    form.setAttribute("method", "post");

	// setting input attributes
    input.setAttribute("value", value);
    input.setAttribute("type", "text");
    input.setAttribute("name", "newvalue");
    input.setAttribute("class", "form-control");

	// setting input attributes
    inputhiddenfield.setAttribute("type", "hidden");
    inputhiddenfield.setAttribute("name", "field");
    inputhiddenfield.setAttribute("value", field);

	// setting input attributes
    // inputhiddenid.setAttribute("type", "hidden");
    // inputhiddenid.setAttribute("name", "id");
    // inputhiddenid.setAttribute("value", id);


    // input.blur(function() {
    //     console.log("Tappar fokus");
    //     // form.parentNode.replaceChild(paramholder, form);
    // });

	// Putting form with inputfields on screen
    form.appendChild(input);
    form.appendChild(inputhiddenfield);
    // form.appendChild(inputhiddenid);
    paramholder.parentNode.replaceChild(form, paramholder);
}

function toFormAdd() {
    var paramholder = document.getElementById('addteam');
    var form = document.createElement("form");
    var formgroupdiv = document.createElement("div");
    var nameinput = document.createElement("input");
    var carbrandinput = document.createElement("input");
    var noinput = document.createElement("input");
    var classinput = document.createElement("input");
    var submit = document.createElement("input");

	let addurl = "/data/addoneprocess";
	if(window.location.host == 'localhost') {
		addurl = "/pwww/Race/public/data/addoneprocess";
	}
    form.setAttribute("action", addurl);
    form.setAttribute("method", "post");
    form.setAttribute("class", "form-inline");

    // input.setAttribute("value", "");
    nameinput.setAttribute("placeholder", "Team namn");
    nameinput.setAttribute("type", "text");
    nameinput.setAttribute("name", "name");
    nameinput.setAttribute("class", "form-control");

    carbrandinput.setAttribute("placeholder", "Bilmärke");
    carbrandinput.setAttribute("type", "text");
    carbrandinput.setAttribute("name", "carbrand");
    carbrandinput.setAttribute("class", "form-control");

    noinput.setAttribute("placeholder", "Nummer");
    noinput.setAttribute("type", "number");
    noinput.setAttribute("name", "no");
    noinput.setAttribute("class", "form-control");

    classinput.setAttribute("placeholder", "Class");
    classinput.setAttribute("type", "text");
    classinput.setAttribute("name", "class");
    classinput.setAttribute("class", "form-control");

	formgroupdiv.setAttribute('class', 'form-group');

	formgroupdiv.appendChild(nameinput);
	formgroupdiv.appendChild(carbrandinput);
    formgroupdiv.appendChild(noinput);
    formgroupdiv.appendChild(classinput);

    submit.setAttribute("value", "Lägg till");
    submit.setAttribute("type", "submit");
    submit.setAttribute("name", "addteambtn");
    submit.setAttribute("class", "btn btn-primary btn-sm");


    // inputhiddenid.setAttribute("type", "hidden");
    // inputhiddenid.setAttribute("name", "groupid");
    // inputhiddenid.setAttribute("value", groupid);



    form.appendChild(formgroupdiv);
    form.appendChild(submit);
    // form.appendChild(inputhiddenid);
    paramholder.parentNode.replaceChild(form, paramholder);
}
