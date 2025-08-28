function startTransition() {
  const transition = document.getElementById("transition");
  const rocket = document.querySelector(".rocket");
  const earth = document.querySelector(".earth");
  const rocketSound = document.getElementById("rocket-sound");
  const spaceSound = document.getElementById("space-sound");

  // mostra tela preta
  transition.style.visibility = "visible";
  transition.style.opacity = "1";

  

  // toca som do foguete
  rocketSound.currentTime = 0;
  rocketSound.play();

  // foguete sobe
  setTimeout(() => {
    rocket.style.animation = "fly 3s forwards";
  }, 500);

  // aparece a Terra + som do espaço
  setTimeout(() => {
    earth.style.opacity = 1;
    earth.style.transform = "scale(1)";
    spaceSound.play();
  }, 1500);

  // redireciona depois da animação
  setTimeout(() => {
    spaceSound.pause(); // para o som do espaço antes de trocar
    window.location.href = "missao2.php";
  }, 4500);
}
