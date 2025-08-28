function startTransition() {
  const transition = document.getElementById("transition");
  const rocket = document.querySelector(".rocket");
  const earth = document.querySelector(".earth");

  // mostra tela preta
  transition.style.visibility = "visible";
  transition.style.opacity = "1";

  // foguete sobe
  setTimeout(() => {
    rocket.style.animation = "fly 3s forwards";
  }, 500);

  // aparece a Terra
  setTimeout(() => {
    earth.style.opacity = 1;
    earth.style.transform = "scale(1)";
  }, 1500);

  // redireciona depois da animação
  setTimeout(() => {
    window.location.href = "missao3.php";
  }, 4500);
}
