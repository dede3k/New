function checkEmail() {
    let email = document.querySelector('#emailaddress').value;
    if (!email.includes('@')) alert('@ символы жоқ');
    else if (!email.includes('.')) alert('. символы жоқ');
    else alert('Бәрі дұрыс!');
}
document.addEventListener("DOMContentLoaded", function () {
    const button = document.getElementById("submitBtn");
    if (!button) {
        console.error("Ошибка: элемент submitBtn не найден!");
        return;
    }

    const form = document.getElementById("contactForm");
    form.addEventListener("input", function () {
        const inputs = form.querySelectorAll("input, textarea");
        let isFilled = [...inputs].every(input => input.value.trim() !== "");

        button.disabled = !isFilled;
        button.classList.toggle("active", isFilled);
    });
});





$(document).ready(function() {
    //E-mail Ajax Send
    $("form").submit(function() { //Change
        var th = $(this);
        $.ajax({
            type: "POST",
            url: "mail.php", //Change
            data: th.serialize()
        }).done(function() {
            alert("Thank you!");
            setTimeout(function() {
                // Done Functions
                th.trigger("reset");
            }, 1000);
        });
        return false;
    });
});


