function temp_addInput(value) {
  value = value + 1;
  document.getElementById("divInput" + value).innerHTML =
    '<tr><th><input type="text" id="code1" name="temp_text1[]" /></th><th><input type="text" name="temp_text2[]" /></th><th><input type="text" name="temp_text3[]" /></th><th><input type="text" name="temp_text4[]" /></th></tr><tr id="divInput' +
    (value + 1) +
    '"><th><button type="button" onClick="temp_addInput(' +
    value +
    ')">+</button></th> ';
}

function open_CreTemp() {
  window.open("/lib/controller/librarian/template/new.php", " ");
}

function open_CreCode() {
  window.open("/lib/controller/librarian/code/code_main.php", " ");
}

function open_Add() {
  window.open("/lib/controller/librarian/addbook/add-2.php", " ");
}

function open_Edit() {
  window.open("/lib/controller/librarian/edit_book/edit.php", " ");
}

//scrollbars=yes,top=30%,left=30%,width=400,height=400 -- ตั้งค่าwindow -->
