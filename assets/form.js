// function index(phrases) {
//     const selectedPhrase = phrases[Math.floor(Math.random() * phrases.length)];
//     selectedPhrase.hiddenWords = getRandomWords(selectedPhrase.text, 50);
//     selectedPhrase.maskedText = maskText(selectedPhrase.text, selectedPhrase.hiddenWords);

//     return render('game/index.html.twig', {
//         phrase: selectedPhrase,
//     });
// }

// function getRandomWords(text, count) {
//     let words = [...new Set(text.match(/\b\w{4,}\b/g))]; // Mots uniques de plus de 3 lettres
//     words = words.sort(() => Math.random() - 0.5); // Mélanger les mots
//     return words.slice(0, count);
// }

// function maskText(text, hiddenWords) {
//     hiddenWords.forEach(word => {
//         const regex = new RegExp(`\\b${word}\\b`, 'g');
//         text = text.replace(regex, '_'.repeat(word.length));
//     });
//     return text;
// }

// function render(template, data) {
//     // Implémentez votre logique de rendu ici
//     console.log(`Rendering template: ${template} with data:`, data);
// }

// // Exemple d'utilisation
// const phrases = [
// ];

// console.log(index(phrases));







const foundWordsElement = document.getElementById('foundWords');
const scoreElement = document.getElementById('score');
let foundWords = [];
const btnRestart = document.getElementById('novo')
let score = localStorage.getItem('score') ? parseInt(localStorage.getItem('score')) : 0;
if(localStorage.getItem('score')=== null){
    localStorage.getItem('score', 0);
}
scoreElement.textContent = score;

document.getElementById('gameForm').addEventListener('submit', function(event) {
    event.preventDefault();
    checkWord();
});

function checkWord() {
    const wordInput = document.getElementById('wordInput').value;
    if (phrase.hiddenWords.includes(wordInput) && !foundWords.includes(wordInput)) {
        foundWords.push(wordInput);
        revealWord(wordInput);
        foundWordsElement.textContent = foundWords.join(', ');
        score += 10; 
        scoreElement.textContent = score;
        localStorage.setItem('score', 0);
        if (foundWords.length === phrase.hiddenWords.length) {
            document.getElementById('maskedText').textContent = phrase.text;
            launchConfetti();
        }
    }
    document.getElementById('wordInput').value = '';
}

function revealWord(word) {
    const regex = new RegExp(`\\b${word}\\b`, 'g');
    const maskedTextElement = document.getElementById('maskedText');
    maskedTextElement.innerHTML = maskedTextElement.innerHTML.replace(regex, `<span class="revealed">${word}</span>`);
}
btnRestart.addEventListener('click',()=>{
    restartGame();
})

function restartGame() {
    localStorage.setItem('score', score);
    window.location.reload();
    
}
function launchConfetti() {
    const confettiCanvas = document.getElementById('confetti');
    const confettiContext = confettiCanvas.getContext('2d');
    confettiCanvas.width = window.innerWidth;
    confettiCanvas.height = window.innerHeight;

    const confettiColors = ['#ff0', '#f00', '#0f0', '#00f', '#ff0', '#f0f', '#0ff'];
    const confettiCount = 300;
    const confetti = [];

    for (let i = 0; i < confettiCount; i++) {
        confetti.push({
            x: Math.random() * confettiCanvas.width,
            y: Math.random() * confettiCanvas.height - confettiCanvas.height,
            color: confettiColors[Math.floor(Math.random() * confettiColors.length)],
            size: Math.random() * 10 + 5,
            speed: Math.random() * 3 + 2,
            angle: Math.random() * 360
        });
    }

    function drawConfetti() {
        confettiContext.clearRect(0, 0, confettiCanvas.width, confettiCanvas.height);
        confetti.forEach((c, index) => {
            confettiContext.fillStyle = c.color;
            confettiContext.beginPath();
            confettiContext.arc(c.x, c.y, c.size, 0, 2 * Math.PI);
            confettiContext.fill();
            c.y += c.speed;
            c.angle += c.speed;
            if (c.y > confettiCanvas.height) {
                confetti[index].y = -c.size;
            }
        });
        requestAnimationFrame(drawConfetti);
    }

    drawConfetti();
}





















// ancien code avec php 

// document.getElementById('form').addEventListener('submit', function(event) {
//     event.preventDefault();
//     const guess = document.getElementById('guess').value;
//     const hiddenPhrase = "le monde"; // Phrase à deviner





//     const hiddenWords = hiddenPhrase.split(" ");
//     const message = document.getElementById('message');
//     const currentGuess = document.getElementById('current-guess');

//     let motsDevines = currentGuess.textContent.split(" ");
//     if (motsDevines.length !== hiddenWords.length) {
//         motsDevines = Array(hiddenWords.length).fill('...');
//     }

//     let motTrouve = false;
//     hiddenWords.forEach((word, index) => {
//         if (guess.toLowerCase() === word.toLowerCase()) {
//             motsDevines[index] = word;
//             motTrouve = true;
//         }
//     });

//     if (!motTrouve) {
//         message.textContent = "Mot incorrect. Réessayez !";
//         message.style.color = "red";
//     } else {
//         message.textContent = "Bien joué ! Continuez à deviner.";
//         message.style.color = "green";
//     }

//     currentGuess.textContent = motsDevines.join(" ");

//     if (!motsDevines.includes('...')) {
//         message.textContent = "Félicitations ! Vous avez trouvé toute la phrase.";
//         message.style.color = "green";
//     }
// });
