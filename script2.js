//let operators = ["+", "-", "*"];
let operators = ["*"];
const startBtn = document.getElementById("start-btn");
const question = document.getElementById("question");
const controls = document.querySelector(".controls-container");
const result = document.getElementById("result");
const submitBtn = document.getElementById("submit-btn");
const errorMessage = document.getElementById("error-msg");
let answerValue;
let operatorQuestion;

//Zufallswerte generieren
const randomValue = (min, max) => Math.floor(Math.random() * (max - min)) + min;

const questionGenerator = () => {
  //Zwei Zufallszahlen zwischen 1 und 20
  let [num1, num2] = [randomValue(1, 10), randomValue(1, 10)];

  //Zufälliges Rechenzeichen
  let randomOperator = operators[Math.floor(Math.random() * operators.length)];

  if (randomOperator == "-" && num2 > num1) {
    [num1, num2] = [num2, num1];
  }

  //Aufgabe
  let solution = eval(`${num1}${randomOperator}${num2}`);

  //Eingabe an zufälliger Stelle innerhalb der Aufgabe
  //(1 für num1, 2 für num2, 3 for Rechenzeichen, alle anderen(4) für Ergebnis)
  //let randomVar = randomValue(1, 5);
  let randomVar = randomValue(1, 3);

  if (randomVar == 1) {
    answerValue = num1;
    question.innerHTML = `<input type="number" id="inputValue" placeholder="?"\> ${randomOperator} ${num2} = ${solution}`;
  } else if (randomVar == 2) {
    answerValue = num2;
    question.innerHTML = `${num1} ${randomOperator}<input type="number" id="inputValue" placeholder="?"\> = ${solution}`;
  } else if (randomVar == 3) {
    answerValue = randomOperator;
    operatorQuestion = true;
    question.innerHTML = `${num1} <input type="text" id="inputValue" placeholder="?"\> ${num2} = ${solution}`;
  } else {
    answerValue = solution;
    question.innerHTML = `${num1} ${randomOperator} ${num2} = <input type="number" id="inputValue" placeholder="?"\>`;
  }

  //Nutzereingabe prüfen
  submitBtn.addEventListener("click", () => {
    errorMessage.classList.add("hide");
    let userInput = document.getElementById("inputValue").value;
    //Wenn Eingabe nicht leer
    if (userInput) {
      //Bei richtiger Eingabe
      if (userInput == answerValue) {
        stopGame(`Das war richtig!!`);
      }
      //Wenn der Nutzer ein anderes Rechenzeichen als +,-,* eingibt
      else if (operatorQuestion && !operators.includes(userInput)) {
        errorMessage.classList.remove("hide");
        errorMessage.innerHTML = "Gib bitte ein gültiges Rechenzeichen ein.";
      }
      //Bei falscher Antwort
      else {
        stopGame(`Ups!! Das war leider falsch.`);
      }
    }
    //Wenn Nutzereingabe leer ist
    else {
      errorMessage.classList.remove("hide");
      errorMessage.innerHTML = "Die Eingabe darf nicht leer sein.";
    }
  });
};

//Spiel starten
startBtn.addEventListener("click", () => {
  operatorQuestion = false;
  answerValue = "";
  errorMessage.innerHTML = "";
  errorMessage.classList.add("hide");
  //Sichtbarkeit Buttons und Controls
  controls.classList.add("hide");
  startBtn.classList.add("hide");
  questionGenerator();
});

//Spiel beenden
const stopGame = (resultText) => {
  rightCounter += 1;
  result.innerHTML = resultText;
  startBtn.innerText = "Weiter";
  controls.classList.remove("hide");
  startBtn.classList.remove("hide");
};