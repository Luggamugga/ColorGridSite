export function hashConvert() {
    console.log("asdf")
    const crypto = require('crypto')
    let hash = crypto.getHashes();
    let convertButt = document.getElementById("convert-button")
    let input = document.getElementById("hash-input-text")
    let type = document.getElementById("hash-type-select")
    let output = document.getElementById("hash-output")
    convertButt.addEventListener("click", () => {
        console.log("asdf")
        if (!input.value) {
            window.alert("please set a value to convert")
            return;
        }
        if (!type.value) {
            window.alert("please select a type");
            return;
        }
        console.log("asdf")
        let hashOut = crypto.createHash(type.value).update(input.value).digest("hex")
        console.log(hashOut)
    })
}