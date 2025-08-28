// =================== CONFIGURAÇÕES INICIAIS ===================
const canvas = document.getElementById("game");
const ctx = canvas.getContext("2d");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const scoreEl = document.getElementById("score");
const gameOverEl = document.getElementById("gameOver");
const shootSound = document.getElementById("shootSound");

let score = 0;
let animation;
let gameOver = false;

// =================== FUNDO ESTRELADO ===================
let stars = [];
for (let i = 0; i < 200; i++) {
  stars.push({
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height,
    size: Math.random() * 2,
    speed: Math.random() * 1 + 0.5
  });
}

function drawStars() {
  ctx.fillStyle = "black";
  ctx.fillRect(0, 0, canvas.width, canvas.height);
  ctx.fillStyle = "white";
  stars.forEach(star => {
    ctx.beginPath();
    ctx.arc(star.x, star.y, star.size, 0, Math.PI * 2);
    ctx.fill();
    star.y += star.speed;
    if (star.y > canvas.height) star.y = 0;
  });
}

// =================== NAVE DO JOGADOR ===================
let player = {
  x: canvas.width / 2,
  y: canvas.height - 100,
  size: 40
};

function drawPlayer() {
  ctx.fillStyle = "cyan";
  ctx.beginPath();
  ctx.moveTo(player.x, player.y);
  ctx.lineTo(player.x - player.size / 2, player.y + player.size);
  ctx.lineTo(player.x + player.size / 2, player.y + player.size);
  ctx.closePath();
  ctx.fill();
}

// =================== TIROS DO JOGADOR ===================
let bullets = [];
function drawBullets() {
  ctx.fillStyle = "yellow";
  bullets.forEach((b, i) => {
    ctx.fillRect(b.x - 2, b.y, 4, 10);
    b.y -= 8;
    if (b.y < 0) bullets.splice(i, 1);
  });
}

function shoot() {
  bullets.push({ x: player.x, y: player.y });
  shootSound.currentTime = 0;
  shootSound.play();
}

// =================== INIMIGOS ===================
let enemies = [];
function spawnEnemy() {
  enemies.push({
    x: Math.random() * (canvas.width - 40) + 20,
    y: -40,
    size: 30,
    speed: 2,
    canShoot: Math.random() < 0.5 // 50% chance de atirar
  });
}

function drawEnemies() {
  ctx.fillStyle = "red";
  enemies.forEach((e, i) => {
    ctx.beginPath();
    ctx.arc(e.x, e.y, e.size, 0, Math.PI * 2);
    ctx.fill();
    e.y += e.speed;

    // Atirar aleatoriamente
    if (e.canShoot && Math.random() < 0.005) {
      enemyBullets.push({ x: e.x, y: e.y });
    }

    if (e.y > canvas.height) enemies.splice(i, 1);
  });
}

// =================== TIROS DOS INIMIGOS ===================
let enemyBullets = [];
function drawEnemyBullets() {
  ctx.fillStyle = "orange";
  enemyBullets.forEach((b, i) => {
    ctx.fillRect(b.x - 2, b.y, 4, 10);
    b.y += 6;
    if (b.y > canvas.height) enemyBullets.splice(i, 1);
  });
}

// =================== EXPLOSÕES ===================
let explosions = [];
function drawExplosions() {
  explosions.forEach((ex, i) => {
    ctx.beginPath();
    ctx.arc(ex.x, ex.y, ex.radius, 0, Math.PI * 2);
    ctx.fillStyle = `rgba(255,165,0,${ex.alpha})`;
    ctx.fill();
    ex.radius += 2;
    ex.alpha -= 0.05;
    if (ex.alpha <= 0) explosions.splice(i, 1);
  });
}

// =================== COLISÕES ===================
function checkCollisions() {
  enemies.forEach((e, ei) => {
    // colisão nave x inimigo
    if (Math.hypot(e.x - player.x, e.y - player.y) < e.size + player.size / 2) {
      endGame();
    }

    // colisão tiro x inimigo
    bullets.forEach((b, bi) => {
      if (b.x > e.x - e.size && b.x < e.x + e.size && b.y > e.y - e.size && b.y < e.y + e.size) {
        explosions.push({ x: e.x, y: e.y, radius: 10, alpha: 1 });
        enemies.splice(ei, 1);
        bullets.splice(bi, 1);
        score++;
        scoreEl.textContent = "Pontos: " + score;
      }
    });
  });

  // colisão tiro inimigo x nave
  enemyBullets.forEach((b, bi) => {
    if (Math.abs(b.x - player.x) < player.size / 2 && Math.abs(b.y - player.y) < player.size) {
      endGame();
    }
  });
}

// =================== GAME OVER ===================
function endGame() {
  gameOver = true;
  gameOverEl.style.display = "block";
  cancelAnimationFrame(animation);
}

// =================== CONTROLES ===================
document.addEventListener("mousemove", e => {
  player.x = e.clientX;
  player.y = e.clientY;
});
document.addEventListener("click", shoot);
document.addEventListener("keydown", e => {
  if (e.code === "Space") shoot();
});

// =================== LOOP PRINCIPAL ===================
function gameLoop() {
  drawStars();
  drawPlayer();
  drawBullets();
  drawEnemies();
  drawEnemyBullets();
  drawExplosions();
  checkCollisions();
  if (!gameOver) animation = requestAnimationFrame(gameLoop);
}

setInterval(spawnEnemy, 1500);
gameLoop();
