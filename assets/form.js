document.getElementById('form').addEventListener('submit', function(event) {
    event.preventDefault();
    const guess = document.getElementById('guess').value;
    const hiddenPhrase = ""; // Phrase à deviner
    const hiddenWords = hiddenPhrase.split(" ");
    const message = document.getElementById('message');
    const currentGuess = document.getElementById('current-guess');

    let motsDevines = currentGuess.textContent.split(" ");
    if (motsDevines.length !== hiddenWords.length) {
        motsDevines = Array(hiddenWords.length).fill('...');
    }

    let motTrouve = false;
    hiddenWords.forEach((word, index) => {
        if (guess.toLowerCase() === word.toLowerCase()) {
            motsDevines[index] = word;
            motTrouve = true;
        }
    });

    if (!motTrouve) {
        message.textContent = "Mot incorrect. Réessayez !";
        message.style.color = "red";
    } else {
        message.textContent = "Bien joué ! Continuez à deviner.";
        message.style.color = "green";
    }

    currentGuess.textContent = motsDevines.join(" ");

    if (!motsDevines.includes('...')) {
        message.textContent = "Félicitations ! Vous avez trouvé toute la phrase.";
        message.style.color = "green";
    }
});
