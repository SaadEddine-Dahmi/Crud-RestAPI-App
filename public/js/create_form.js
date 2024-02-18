var showFormBtn = document.getElementById("showFormBtn");
var closeFormBtn = document.getElementById("closeFormBtn");
// var form = document.getElementById("myForm");
var form2 = document.getElementById("form");
var content = document.getElementById("content");
var body = document.body;

showFormBtn.addEventListener("click", function () {
    // form.classList.remove('hidden');
    form2.classList.remove("hidden");
    showFormBtn.classList.add("hidden");
    closeFormBtn.classList.remove("hidden");
    content.classList.add("blurred");
    body.style.overflow = "hidden";
    content.style.pointerEvents = "none";
});

closeFormBtn.addEventListener("click", function () {
    // form.classList.add('hidden');
    form2.classList.add("hidden");
    showFormBtn.classList.remove("hidden");
    closeFormBtn.classList.add("hidden");
    content.classList.remove("blurred");
    body.style.overflow = "";
    content.style.pointerEvents = "auto";
});
