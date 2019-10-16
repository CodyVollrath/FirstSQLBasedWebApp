var check = function() {
    document.getElementById('message').removeAttribute('hidden');
    if (document.getElementById('password').value ==
        document.getElementById('ConfirmPassword').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').style.fontSize = '20px';
        document.getElementById('message').innerHTML = '<img src="https://img.icons8.com/dusk/64/000000/good-pincode.png">';
        document.getElementById('submitButton').removeAttribute('disabled', true);
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').style.fontSize = '20px';
        document.getElementById('message').innerHTML = '<img src="https://img.icons8.com/dusk/64/000000/wrong-pincode.png">';
        document.getElementById('submitButton').setAttribute('disabled', true);
    }
    if (document.getElementById('password').value == "") {
        document.getElementById('message').setAttribute('hidden', true);
    }
}