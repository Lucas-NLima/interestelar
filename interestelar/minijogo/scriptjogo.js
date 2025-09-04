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
let lastBossScore = 0;
let paused = false;
let invincible = false;


// =================== BOTÃO PAUSE ===================
document.getElementById("pauseBtn").addEventListener("click", () => {
  paused = !paused;
  document.getElementById("pauseBtn").textContent = paused ? "▶️ Continuar" : "⏸️ Pausar";
  if (!paused) gameLoop();
});

// =================== CARREGAR IMAGENS ===================
const playerImg = new Image();
playerImg.src = "../../img/nave1.png";

const enemyImg = new Image();
enemyImg.src = "../../img/naveINIMIGA.png";

const lifeImg = new Image();
lifeImg.src = "../../img/vida.png";

const fireImg = new Image();
fireImg.src = "../../img/xp.png";

const doubleImg = new Image();
doubleImg.src = "../../img/xpBlue.png";

const bossImg = new Image();
bossImg.src = "../../img/boss.png";

const shieldImg = new Image();
shieldImg.src = "../../img/shield.png"; 

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
let player = { x: canvas.width / 2, y: canvas.height - 100, size: 60 };

  function drawPlayer() {
  ctx.drawImage(playerImg, player.x - player.size/2, player.y - player.size/2, player.size, player.size);

  // Se invencível, desenha escudo
  if (invincible) {
    ctx.beginPath();
    ctx.arc(player.x, player.y, player.size/2 + 10, 0, Math.PI * 2);
    ctx.strokeStyle = "cyan";      // cor do escudo
    ctx.lineWidth = 4;
    ctx.shadowColor = "cyan";      // efeito de brilho
    ctx.shadowBlur = 15;
    ctx.stroke();
    ctx.shadowBlur = 0;            // reseta shadowBlur
  }
}



// =================== TIROS DO JOGADOR ===================
let bullets = [];
let shootCooldown = 400;
let lastShot = 0;
let doubleShot = false;
let rapidFire = false;

function drawBullets() {
  for (let i = bullets.length - 1; i >= 0; i--) {
    const b = bullets[i];
    ctx.fillStyle = "blue";
    ctx.fillRect(b.x - 2, b.y, 4, 10);
    b.y -= 8;
    if (b.y < 0) bullets.splice(i, 1);
  }
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
  for (let i = enemies.length - 1; i >= 0; i--) {
    const e = enemies[i];
    ctx.drawImage(enemyImg, e.x - e.size/2, e.y - e.size/2, e.size, e.size);
    e.y += e.speed;

    if (e.canShoot && Math.random() < 0.005) enemyBullets.push({ x: e.x, y: e.y });
    if (e.y > canvas.height) enemies.splice(i, 1);
  }
}

// =================== TIROS DOS INIMIGOS ===================
let enemyBullets = [];
function drawEnemyBullets() {
  for (let i = enemyBullets.length - 1; i >= 0; i--) {
    const b = enemyBullets[i];
    ctx.fillStyle = "orange";
    ctx.fillRect(b.x - 2, b.y, 4, 10);
    b.y += 6;

    if (b.y > canvas.height) enemyBullets.splice(i, 1);
    else if (Math.hypot(b.x - player.x, b.y - player.y) < player.size/2) {
      damagePlayer();
      enemyBullets.splice(i, 1);
    }
  }
}

// =================== POWER-UPS ===================
let powerUps = [];
function spawnPowerUp(x, y) {
 const types = ["life", "rapid", "double", "shield"]; // adicionado "shield"
  const type = types[Math.floor(Math.random() * types.length)];
  powerUps.push({ x, y, size: 30, type });
}
function drawPowerUps() {
  for (let i = powerUps.length - 1; i >= 0; i--) {
    const p = powerUps[i];
    if (p.type === "life") ctx.drawImage(lifeImg, p.x - 15, p.y - 15, 30, 30);
    if (p.type === "rapid") ctx.drawImage(fireImg, p.x - 15, p.y - 15, 30, 30);
    if (p.type === "double") ctx.drawImage(doubleImg, p.x - 15, p.y - 15, 30, 30);
    if (p.type === "shield") {
  ctx.drawImage(shieldImg, p.x - 15, p.y - 15, 30, 30);
}


    p.y += 2;

    if (Math.hypot(p.x - player.x, p.y - player.y) < player.size/2) {
      if (p.type === "life") {
        lives++;
        livesEl.textContent = "❤️".repeat(lives);
      }
      if (p.type === "rapid") {
        rapidFire = true;
        shootCooldown = 150;
        setTimeout(() => { rapidFire = false; shootCooldown = 400; }, 5000);
      }
      if (p.type === "double") {
        doubleShot = true;
        setTimeout(() => { doubleShot = false; }, 5000);
      }

       if (p.type === "shield") {
        invincible = true;
        setTimeout(() => { invincible = false; }, 5000); // 5 segundos de invencibilidade
      }
      powerUps.splice(i, 1);
    } else if (p.y > canvas.height) powerUps.splice(i, 1);
  }
}



// =================== EXPLOSÕES ===================
let explosions = [];
function drawExplosions() {
  for (let i = explosions.length - 1; i >= 0; i--) {
    const ex = explosions[i];
    ctx.beginPath();
    ctx.arc(ex.x, ex.y, ex.radius, 0, Math.PI * 2);
    ctx.fillStyle = `rgba(255,165,0,${ex.alpha})`;
    ctx.fill();
    ex.radius += 2;
    ex.alpha -= 0.05;
    if (ex.alpha <= 0) explosions.splice(i, 1);
  }
}

// =================== BOSS ===================
let boss = null;
let bossBullets = [];
let bossActive = false;

function spawnBoss() {
  if (bossActive) return;
  boss = { x: canvas.width / 2, y: 100, size: 150, hp: 20, speed: 2, dir: 1 };
  bossActive = true;
  bossBullets = [];
}

function drawBoss() {
  if (!boss) return;
  boss.x += boss.speed * boss.dir;
  if (boss.x < 100 || boss.x > canvas.width - 100) boss.dir *= -1;

  ctx.drawImage(bossImg, boss.x - boss.size/2, boss.y - boss.size/2, boss.size, boss.size);

  ctx.fillStyle = "red";
  ctx.fillRect(boss.x - 75, boss.y - 100, 150, 10);
  ctx.fillStyle = "lime";
  ctx.fillRect(boss.x - 75, boss.y - 100, (boss.hp / 20) * 150, 10);

  if (Math.random() < 0.02) {
    for (let angle = -0.5; angle <= 0.5; angle += 0.25) {
      bossBullets.push({ x: boss.x, y: boss.y, dx: Math.sin(angle)*5, dy:5 });
    }
  }
}

function drawBossBullets() {
  for (let i = bossBullets.length - 1; i >= 0; i--) {
    const b = bossBullets[i];
    ctx.beginPath();
    ctx.arc(b.x, b.y, 6, 0, Math.PI*2);
    ctx.fill();
    b.x += b.dx;
    b.y += b.dy;
    if (b.y > canvas.height) bossBullets.splice(i,1);
    else if (Math.hypot(b.x - player.x, b.y - player.y) < player.size/2) {
      damagePlayer();
      bossBullets.splice(i,1);
    }
  }
}

// =================== COLISÕES ===================
function checkCollisions() {
  // Inimigos
  for (let ei = enemies.length-1; ei>=0; ei--) {
    const e = enemies[ei];
    if (Math.hypot(e.x - player.x, e.y - player.y) < e.size/2 + player.size/2) {
      damagePlayer();
      explosions.push({ x:e.x, y:e.y, radius:10, alpha:1 });
      enemies.splice(ei,1);
      continue;
    }

    for (let bi = bullets.length-1; bi>=0; bi--) {
      const b = bullets[bi];
      if (Math.hypot(b.x - e.x, b.y - e.y) < e.size/2) {
        explosions.push({ x:e.x, y:e.y, radius:10, alpha:1 });
        if (Math.random() < 0.2) spawnPowerUp(e.x,e.y);
        enemies.splice(ei,1);
        bullets.splice(bi,1);
        score++;
        scoreEl.textContent = "Pontos: " + score;
        break;
      }
    }
  }

  // Boss
  if (bossActive) handleBossHit();
}

// Função para colisões do boss
function handleBossHit() {
  if (!boss) return;

  for (let bi = bullets.length-1; bi>=0; bi--) {
    const b = bullets[bi];
    if (Math.hypot(b.x - boss.x, b.y - boss.y) < boss.size/2) {
      boss.hp--;
      bullets.splice(bi,1);
      explosions.push({ x:b.x, y:b.y, radius:10, alpha:1 });

      if (boss.hp<=0) {
        for (let i=0;i<8;i++) {
          explosions.push({
            x: boss.x + (Math.random()*120-60),
            y: boss.y + (Math.random()*120-60),
            radius:20,
            alpha:1
          });
        }
        boss = null;
        bossActive = false;
        bossBullets = [];
        lastBossScore = score;
        score += 10;
        scoreEl.textContent = "Pontos: " + score;
        if (Math.random()<0.5) spawnPowerUp(player.x, player.y-50);
      }
    }
  }

  if (boss && Math.hypot(boss.x - player.x, boss.y - player.y) < boss.size/2 + player.size/2) {
    damagePlayer();
    for (let i=0;i<5;i++) {
      explosions.push({
        x: boss.x + (Math.random()*100-50),
        y: boss.y + (Math.random()*100-50),
        radius:20,
        alpha:1
      });
    }
  }
}

// =================== VIDAS ===================
function damagePlayer() {
  if (invincible) return; // não perde vida enquanto estiver invencível
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
let keys = {};
document.addEventListener("keydown", e => {
  keys[e.code] = true;
  if (e.code === "Space") shoot();
});
document.addEventListener("keyup", e => keys[e.code] = false);
function updatePlayerMovement() {
  const speed = 6;
  if (keys["ArrowLeft"] && player.x>0) player.x -= speed;
  if (keys["ArrowRight"] && player.x<canvas.width) player.x += speed;
  if (keys["ArrowUp"] && player.y>0) player.y -= speed;
  if (keys["ArrowDown"] && player.y<canvas.height) player.y += speed;
}

// =================== SPAWN AUTOMÁTICO ===================
setInterval(() => {
  if (!gameOver && !paused) spawnEnemy();
}, 1500);

// =================== LOOP PRINCIPAL ===================
function gameLoop() {
  if (paused) return;

  drawStars();
  updatePlayerMovement();
  drawPlayer();
  drawBullets();
  drawEnemies();
  drawEnemyBullets();
  drawPowerUps();
  drawExplosions();

  if (bossActive) {
    drawBoss();
    drawBossBullets();
    handleBossHit();
  }

  if (!bossActive && score>0 && score % 30 ===0 && score !== lastBossScore) spawnBoss();

  checkCollisions();

  if (!gameOver) animation = requestAnimationFrame(gameLoop);
}

// Inicia o jogo
gameLoop();
