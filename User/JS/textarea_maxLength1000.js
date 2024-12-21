function countCharacters(textarea) {
    const maxLength = 1000;
    const currentLength = textarea.value.length;
    const remaining = maxLength - currentLength;

    const charCountElement = document.getElementById("charCount");
    charCountElement.textContent = `Characters remaining: (${remaining}/1000)`;
}