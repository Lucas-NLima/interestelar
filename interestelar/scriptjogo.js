// =================== CONFIGURAÇÕES INICIAIS ===================
const canvas = document.getElementById("game");
const ctx = canvas.getContext("2d");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const scoreEl = document.getElementById("score");
const livesEl = document.getElementById("lives");
const gameOverEl = document.getElementById("gameOver");
const shootSound = document.getElementById("shootSound");

let score = 0;
let animation;
let gameOver = false;
let lives = 3;

// =================== CARREGAR IMAGENS ===================
const playerImg = new Image();
playerImg.src = "../img/nave1.png"; // nave do jogador

const enemyImg = new Image();
enemyImg.src = "../img/naveINIMIGA.png"; // nave inimiga

const lifeImg = new Image();
lifeImg.src = "../img/vida.png"; // ícone vida

const fireImg = new Image();
fireImg.src = "../img/xp.png"; // power-up tiro rápido

const doubleImg = new Image();
doubleImg.src = "../img/xpBlue.png"; // power-up tiro duplo

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
  size: 60
};

function drawPlayer() {
  ctx.drawImage(playerImg, player.x - player.size/2, player.y - player.size/2, player.size, player.size);
}

// =================== TIROS DO JOGADOR ===================
let bullets = [];
let shootCooldown = 400; // tempo entre tiros (ms)
let lastShot = 0;
let doubleShot = false;
let rapidFire = false;

function drawBullets() {
  ctx.fillStyle = "yellow";
  bullets.forEach((b, i) => {
    ctx.fillRect(b.x - 2, b.y, 4, 10);
    b.y -= 8;
    if (b.y < 0) bullets.splice(i, 1);
  });
}

function shoot() {
  const now = Date.now();
  if (now - lastShot < shootCooldown) return;
  lastShot = now;

  bullets.push({ x: player.x, y: player.y - player.size/2 });

  if (doubleShot) {
    bullets.push({ x: player.x - 15, y: player.y - player.size/2 });
    bullets.push({ x: player.x + 15, y: player.y - player.size/2 });
  }

  shootSound.currentTime = 0;
  shootSound.play();
}

// =================== INIMIGOS ===================
let enemies = [];
function spawnEnemy() {
  enemies.push({
    x: Math.random() * (canvas.width - 40) + 20,
    y: -40,
    size: 50,
    speed: 2,
    canShoot: Math.random() < 0.5
  });
}

function drawEnemies() {
  enemies.forEach((e, i) => {
    ctx.drawImage(enemyImg, e.x - e.size/2, e.y - e.size/2, e.size, e.size);
    e.y += e.speed;

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

// =================== POWER-UPS ===================
let powerups = [];
function spawnPowerUp(x, y) {
  const type = Math.floor(Math.random() * 3); // 0 = vida, 1 = tiro rápido, 2 = tiro duplo
  let img, kind;
  if (type === 0) { img = lifeImg; kind = "life"; }
  if (type === 1) { img = fireImg; kind = "rapid"; }
  if (type === 2) { img = doubleImg; kind = "double"; }

  powerups.push({ x, y, size: 30, img, kind });
}

function drawPowerUps() {
  powerups.forEach((p, i) => {
    ctx.drawImage(p.img, p.x - p.size/2, p.y - p.size/2, p.size, p.size);
    p.y += 2;
    if (p.y > canvas.height) powerups.splice(i, 1);

    // colisão nave x power-up
    if (Math.hypot(p.x - player.x, p.y - player.y) < (p.size/2 + player.size/2)) {
      applyPowerUp(p.kind);
      powerups.splice(i, 1);
    }
  });
}

function applyPowerUp(kind) {
  if (kind === "life") {
    if (lives < 5) lives++;
    livesEl.textContent = "❤️".repeat(lives);
  }
  if (kind === "rapid") {
    rapidFire = true;
    shootCooldown = 150;
    setTimeout(() => { rapidFire = false; shootCooldown = 400; }, 10000);
  }
  if (kind === "double") {
    doubleShot = true;
    setTimeout(() => { doubleShot = false; }, 10000);
  }
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
    if (Math.hypot(e.x - player.x, e.y - player.y) < e.size/2 + player.size/2) {
      damagePlayer();
      enemies.splice(ei, 1);
      explosions.push({ x: e.x, y: e.y, radius: 10, alpha: 1 });
    }

    // colisão tiro x inimigo
    bullets.forEach((b, bi) => {
      if (b.x > e.x - e.size/2 && b.x < e.x + e.size/2 &&
          b.y > e.y - e.size/2 && b.y < e.y + e.size/2) {
        explosions.push({ x: e.x, y: e.y, radius: 10, alpha: 1 });

        // chance de soltar power-up (20%)
        if (Math.random() < 0.2) {
          spawnPowerUp(e.x, e.y);
        }

        enemies.splice(ei, 1);
        bullets.splice(bi, 1);
        score++;
        scoreEl.textContent = "Pontos: " + score;
      }
    });
  });

  // colisão tiro inimigo x nave
  enemyBullets.forEach((b, bi) => {
    if (Math.abs(b.x - player.x) < player.size/2 && Math.abs(b.y - player.y) < player.size/2) {
      damagePlayer();
      enemyBullets.splice(bi, 1);
    }
  });
}

// =================== VIDAS ===================
function damagePlayer() {
  lives--;
  livesEl.textContent = "❤️".repeat(lives);
  if (lives <= 0) endGame();
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
  drawPowerUps();
  drawExplosions();
  checkCollisions();
  if (!gameOver) animation = requestAnimationFrame(gameLoop);
}

setInterval(spawnEnemy, 1500);
gameLoop();




