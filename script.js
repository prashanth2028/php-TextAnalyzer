document.getElementById('textForm').addEventListener('submit', function (e) {
    e.preventDefault();
    let name = document.getElementById('name').value;
    let text = document.getElementById('text').value;
    const nameErr = document.getElementById('nameerr');
    const textErr = document.getElementById('texterr');

    nameErr.textContent = '';
    textErr.textContent = '';

    let valid = true;

    if (name.trim() === "") {
        nameErr.textContent = "* Please enter your name";
        document.getElementById('name').style.borderColor = "red";
        valid = false;
    }

    if (text.trim() === "") {
        textErr.textContent = "* Please enter your text";
        document.getElementById('text').style.borderColor = "red";
        valid = false;
    }

    if (valid) {
        fetch('backend.php', {
            method: 'POST',
            body: JSON.stringify({ name, text }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            displayResults(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});

function displayResults(data) {
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = '';

    const nameDiv = document.createElement('div');
    nameDiv.textContent = `Name: ${data.name}`;
    resultsDiv.appendChild(nameDiv);

    const countDiv = document.createElement('div');
    countDiv.textContent = `Count: ${data.count}`;
    resultsDiv.appendChild(countDiv);

    const totalWordsDiv = document.createElement('div');
    totalWordsDiv.textContent = `Total Words: ${data.totalWords}`;
    resultsDiv.appendChild(totalWordsDiv);

    const totalCharactersDiv = document.createElement('div');
    totalCharactersDiv.textContent = `Total Characters: ${data.totalCharacters}`;
    resultsDiv.appendChild(totalCharactersDiv);

    const reversedTextDiv = document.createElement('div');
    reversedTextDiv.textContent = `Text Reversed: ${data.reversedText}`;
    resultsDiv.appendChild(reversedTextDiv);

    const textCapDiv = document.createElement('div');
    textCapDiv.textContent = `Text Cap: ${data.capitalizedText}`;
    resultsDiv.appendChild(textCapDiv);

    const textArrayDiv = document.createElement('div');
    textArrayDiv.textContent = `Text as Array: ${data.textArray.join(', ')}`;
    resultsDiv.appendChild(textArrayDiv);
}
